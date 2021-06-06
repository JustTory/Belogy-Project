<?php
    session_start();
    include 'includes/db.php';
    include 'func/timeFunc.php';

    if(isset($_POST['comment']) && isset($_POST['id'])) {
        //insert new comment into DB
        $sqlInsert = "INSERT INTO comments (cmt_content, cmt_author_ID, cmt_post_ID) VALUE (?,?,?)";
        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->bind_param("sii", $_POST['comment'], $_SESSION['userID'], $_POST['id']);
        $stmtInsert->execute();
        if($stmtInsert->affected_rows == 1) {
            //get the new comment from DB and encode it into json to send back
            $id = $stmtInsert->insert_id;
            $sqlGetCmt = "SELECT c.cmt_ID, c.cmt_content, u.user_ID, u.user_username, u.user_role, c.cmt_date_created FROM comments c JOIN users u ON u.user_ID = c.cmt_author_ID WHERE c.cmt_ID = ?";
            $stmtGetCmt = $conn->prepare($sqlGetCmt);
            $stmtGetCmt->bind_param("i", $id);
            $stmtGetCmt->execute();
            $resNewComment = $stmtGetCmt->get_result();
            $newComment = $resNewComment->fetch_assoc();
            $newComment['cmt_date_time'] = outputContentDateTime($conn, $newComment['cmt_date_created']);

            //update total comment of the post
            $sqlUpdate = "UPDATE posts SET post_no_comments = post_no_comments + 1 WHERE post_ID = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("i", $_POST['id']);
            $stmtUpdate->execute();

            $sqlGetNumberOfComments = "SELECT post_no_comments FROM posts WHERE post_ID = ?";
            $stmtGetNumberOfComments = $conn->prepare($sqlGetNumberOfComments);
            $stmtGetNumberOfComments->bind_param("i", $_POST['id']);
            $stmtGetNumberOfComments->execute();
            $resNumberOfComments = $stmtGetNumberOfComments->get_result();
            $numberOfComments = $resNumberOfComments->fetch_assoc();
            $newComment['post_no_comments'] = $numberOfComments['post_no_comments'];
            echo json_encode($newComment);
        }
    }
?>