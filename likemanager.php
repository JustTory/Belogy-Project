<?php
    session_start();
    include 'includes/db.php';

    if(isset($_GET['addlike']) && isset($_GET['addlike']) == true){
        //insert new like into DB
        $sqlInsert = "INSERT INTO likes (like_author_ID, like_post_ID) VALUES (?,?)";
        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->bind_param("ii", $_SESSION['userID'], $_SESSION['lastPostIDVisited']);
        $stmtInsert->execute();

        //update total likes of post
        updateTotal($conn, "add");  
    } 

    else if(isset($_GET['removelike']) && isset($_GET['removelike']) == true) {
        //remove like from DB
        $sqlInsert = "DELETE FROM likes WHERE like_author_ID = ? AND like_post_ID = ?";
        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->bind_param("ii", $_SESSION['userID'], $_SESSION['lastPostIDVisited']);
        $stmtInsert->execute();

        //update total likes of post
        updateTotal($conn, "remove"); 
    }

    function updateTotal($conn, $action) {
        if($action == "add")
            $sqlUpdate = "UPDATE posts SET post_no_likes = post_no_likes + 1 WHERE post_ID = ?";
        else if($action == "remove") 
            $sqlUpdate = "UPDATE posts SET post_no_likes = post_no_likes - 1 WHERE post_ID = ?";

        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("i", $_SESSION['lastPostIDVisited']);
        $stmtUpdate->execute();

        $sqlGetTotal = "SELECT post_no_likes FROM posts WHERE post_ID = ?";
        $stmtGetTotal = $conn->prepare($sqlGetTotal);
        $stmtGetTotal->bind_param("i", $_SESSION['lastPostIDVisited']);
        $stmtGetTotal->execute();
        $resTotal = $stmtGetTotal->get_result();
        $total = $resTotal->fetch_assoc();
        $newTotal['post_no_likes'] = $total['post_no_likes'];
        echo json_encode($newTotal); 
    }

?>