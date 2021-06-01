<?php
    include 'includes/db.php';
    include 'func/postFunc.php';
    include 'func/timeFunc.php';
    session_start();

    if(isset($_GET['offset'])) {
        $newPostList['posts'] = getPostList($conn, $_GET['limit'] , $_GET['offset']);

        foreach ($newPostList['posts'] as &$newPost) {
            $newPost['post_date_time'] = outputContentDateTime($conn, $newPost['post_date_created']);
            if(in_array($newPost['post_ID'], likedPostList($conn))) {
                $newPost['liked'] = true;
            } else $newPost['liked'] = false;
        }
        $newPostList['currentUserID'] = $_SESSION['userID'];
        
        echo json_encode($newPostList);
    }
?>