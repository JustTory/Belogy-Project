<?php
    session_start();
    include 'includes/db.php';
    include 'func/timeFunc.php';

    if(isset($_POST['comment'])) {
        $sql = "INSERT INTO comments (cmt_content, cmt_author_ID, cmt_post_ID) VALUE (?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sii", $_POST['comment'], $_SESSION['userID'], $_SESSION['lastPostIDVisited']);
        $stmt->execute();
        if($stmt->affected_rows == 1) {
            $id = $stmt->insert_id;
            $sql = "SELECT c.cmt_ID, c.cmt_content, u.user_ID, u.user_username, c.cmt_date_created FROM comments c JOIN users u ON u.user_ID = c.cmt_author_ID WHERE c.cmt_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $newComment = $result->fetch_assoc();
            $newComment['cmt_date_time'] = outputContentDateTime($conn, $newComment['cmt_date_created']);
            echo json_encode($newComment);
        }
    }
?>