<?php
    session_start();
    include 'includes/db.php';
    if(isset($_POST['id'])) {
        if(isset($_POST['addlike']) && isset($_POST['addlike']) == true){
            // check whether the user has liked the post
            if(checkLiked($conn) == false) { 
                //insert new like into DB
                $sqlInsert = "INSERT INTO likes (like_author_ID, like_post_ID) VALUES (?,?)";
                $stmtInsert = $conn->prepare($sqlInsert);
                $stmtInsert->bind_param("ii", $_SESSION['userID'], $_POST['id']);
                $stmtInsert->execute();

                //update total likes of post
                updateTotal($conn, "add");
            }  
            else {
                $_SESSION['notification'] = "You already liked this post";
                $likeError['post_no_likes'] = "error";
                echo json_encode($likeError);
            }
        } 

        else if(isset($_POST['removelike']) && isset($_POST['removelike']) == true) {
            //remove like from DB
            $sqlInsert = "DELETE FROM likes WHERE like_author_ID = ? AND like_post_ID = ?";
            $stmtInsert = $conn->prepare($sqlInsert);
            $stmtInsert->bind_param("ii", $_SESSION['userID'], $_POST['id']);
            $stmtInsert->execute();

            //update total likes of post
            if($stmtInsert->affected_rows >= 1) {
                updateTotal($conn, "remove"); 
            }
            else {
                $_SESSION['notification'] = "You already unliked this post";
                $likeError['post_no_likes'] = "error";
                echo json_encode($likeError);
            }
        }
    }

    function checkLiked($conn) {
        $sqlCheck = "SELECT * FROM likes WHERE like_author_ID = ? AND like_post_ID = ?";
        $stmtCheck = $conn->prepare($sqlCheck);
        $stmtCheck->bind_param("ii", $_SESSION['userID'], $_POST['id']);
        $stmtCheck->execute();
        $result = $stmtCheck->get_result();
        if($result->num_rows >= 1)
            return true;
        else return false;
    }

    function updateTotal($conn, $action) {
        if($action == "add")
            $sqlUpdate = "UPDATE posts SET post_no_likes = post_no_likes + 1 WHERE post_ID = ?";
        else if($action == "remove") 
            $sqlUpdate = "UPDATE posts SET post_no_likes = post_no_likes - 1 WHERE post_ID = ?";

        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("i", $_POST['id']);
        $stmtUpdate->execute();

        $sqlGetTotal = "SELECT post_no_likes FROM posts WHERE post_ID = ?";
        $stmtGetTotal = $conn->prepare($sqlGetTotal);
        $stmtGetTotal->bind_param("i", $_POST['id']);
        $stmtGetTotal->execute();
        $resTotal = $stmtGetTotal->get_result();
        $total = $resTotal->fetch_assoc();
        $newTotal['post_no_likes'] = $total['post_no_likes'];
        echo json_encode($newTotal); 
    }

?>