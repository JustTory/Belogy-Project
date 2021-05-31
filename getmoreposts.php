<?php
    include 'includes/db.php';
    include 'func/postFunc.php';
    include 'func/timeFunc.php';
    session_start();

    if(isset($_GET['offset'])) {
        $sql = "SELECT p.post_ID, p.post_title, p.post_content, p.post_img_url, u.user_username, p.post_no_likes, p.post_no_comments, p.post_date_created, p.post_last_modified FROM posts p, users u WHERE p.post_author_ID = u.user_ID ORDER BY post_ID DESC LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $_GET['limit'] ,$_GET['offset']);
        $stmt->execute();
        $results = $stmt->get_result();
        $newPostList = $results->fetch_all(MYSQLI_ASSOC);

        foreach ($newPostList as &$newPost) {
            $newPost['post_date_time'] = outputContentDateTime($conn, $newPost['post_date_created']);
            if(in_array($newPost['post_ID'], likedPostList($conn))) {
                $newPost['liked'] = true;
            } else $newPost['liked'] = false;
        }
        
        echo json_encode($newPostList);
    }
?>