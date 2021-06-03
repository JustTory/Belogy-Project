<?php
    session_start();
    include "includes/db.php";
    include "func/postFunc.php";

    if(isset($_GET['defaultAvatar'])) {
        outputIMG("../images/default/defaultUserAvatar.png");
    }

    else if(isset($_GET['loadinggif'])) {
        outputIMG("../images/default/loading.gif");
    }

    else if(isset($_GET['loginbg'])) {
        outputIMG("../images/default/loginbg.jpg");
    }

    else if(isset($_GET['weblogo'])) {
        outputIMG("../images/default/web-logo.png");
    }

    else if(isset($_GET['webicon'])) {
        outputIMG("../images/default/web-icon.png");
    }

    else if(isset($_GET['emptyimg'])) {
        outputIMG("../images/default/emptyimg.png");
    }

    else if(isset($_GET['postID'])) {
        $postID = $_GET['postID'];
        $sql = "SELECT post_img_url FROM posts WHERE post_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $postID);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $imgURL = $row['post_img_url'];
            outputIMG($imgURL);
        }
    }

    else if(isset($_GET['userID']) && isset($_GET['avatar'])) {
        $userID = $_GET['userID'];
        $sql = "SELECT user_avatar FROM users WHERE user_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $imgURL = $row['user_avatar'];
            outputIMG($imgURL);
        }
    }

    else if(isset($_GET['userID']) && isset($_GET['coverbg'])) {
        $userID = $_GET['userID'];
        $sql = "SELECT user_cover_bg FROM users WHERE user_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $imgURL = $row['user_cover_bg'];
            outputIMG($imgURL);
        }
    }

    function outputIMG($imgURL) {
        $fp = fopen($imgURL, 'rb');
        // send the right headers
        header("Content-Type: image/png");
        header("Content-Length: " . filesize($imgURL));
        // dump the picture and stop the script
        fpassthru($fp);
        exit;
    }
?>