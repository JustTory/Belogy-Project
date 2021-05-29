<?php
    include "func/imgFunc.php";

    //main functions
    function createPost($conn, &$errorsPost) {
        if(isset($_POST['submit'])) {
            $title = $_POST['title'];
            $content = $_POST['content'];

            $image = $_FILES['image'];
            $imgError = $image['error'];

            if(!checkTitle($title)) 
                $errorsPost['title'] = "Title can't be empty";
            if(!checkContent($content)) 
                $errorsPost['content'] = "Content can't be empty";
            
            if($imgError == 0) { // if an image was uploaded
                $imgName = $image['name'];
                $imgType = explode("/", $image['type']);
                $imgExt = end($imgType);
                $imgTmpName = $image['tmp_name'];
                $imgSize = $image['size'];

                if(!allowedImgSize($imgSize))
                    $errorsPost['imgSize'] = "Image size must be less than 2mb";
                if(!allowedImgExt($imgExt))
                    $errorsPost['imgExt'] = "Only png, jpeg, jpg, gif images are allowed";

                if(empty($errorsPost)) {
                    $newImgName = uniqid('', false) . "." . $imgExt;
                    $finalPath = "images/useruploads/" . $newImgName;
                    if(move_uploaded_file($imgTmpName, $finalPath)) 
                        writeToDB($conn, $title, $content, $_SESSION['userID'], $finalPath);
                    else $errorsPost['imgUpload'] = "There was an error uploading the image";
                }
            }

            else if(empty($errorsPost) && $imgError == 4)  // no image was uploaded
                writeToDB($conn, $title, $content, $_SESSION['userID']);
            //else $errorsPost['imgError'] = "Something is wrong with the file";
        }
    }

    function getPost($conn) {
        $postID = $_GET['id'];
        $sql = "SELECT p.post_title, p.post_content, p.post_img_url, u.user_username, p.post_no_upvotes, p.post_no_comments,	p.post_date_created, p.post_last_modified FROM posts p, users u WHERE p.post_ID = ? AND p.post_author_ID = u.user_ID";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $postID);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }


    //check signedin functions
    function directToCreatePost() {
        if($_SESSION['signedIn'] == true && isset($_POST['createpost'])) {
            header("Location: createpost.php");
            exit();
        }
    }

    function checkSignedIn() {
        if($_SESSION['signedIn'] == false) {
            $_SESSION['notSignedInOnCreatePost'] = true;
            header("Location: index.php");
            exit();
        }
    }


    //helper functions
    function checkTitle($title) {
        if($title == '') return false;
        else return true;
    }

    function checkContent($content) {
        if($content == '') return false;
        else return true;
    }

    function writeToDB($conn, $title, $content, $authorID, $imgPath = null) {
        $sql = "INSERT INTO posts (post_title, post_content, post_img_url, post_author_ID) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $title, $content, $imgPath, $authorID);
        $stmt->execute();
        if($stmt->affected_rows == 1) {
            $_SESSION['newPost'] = "You have created a new post";
            $location = "Location: post.php?id=" . $stmt->insert_id;
            header($location);
            exit();
        }
    }


    //time functions
    function getMonthName($monthNum) {
        switch ($monthNum) {
            case '1':
                $monthName = 'January';
                break;
            case '2':
                $monthName = 'February';
                break;
            case '3':
                $monthName = 'March';
                break;
            case '4':
                $monthName = 'April';
                break;
            case '5':
                $monthName = 'May';
                break;
            case '6':
                $monthName = 'June';
                break;
            case '7':
                $monthName = 'July';
                break;
            case '8':
                $monthName = 'August';
                break;
            case '9':
                $monthName = 'September';
                break;
            case '10':
                $monthName = 'October';
                break;
            case '11':
                $monthName = 'November';
                break;
            case '12':
                $monthName = 'December';
                break;    
          }  
          return $monthName;
    }

    function getYear($date) {
        $date = explode('-', $date);
        return $date[0];
    }
    function getMonth($date) {
        $date = explode('-', $date);
        return $date[1];
    }
    function getDay($date) {
        $date = explode('-', $date);
        return $date[2];
    }
    function getHour($time) {
        $time = explode(':', $time);
        return $time[0];
    }
    function getMinute($time) {
        $time = explode(':', $time);
        return $time[1];
    }
    function getDateOnly($dateTime) {
        $dateTime = explode(' ', $dateTime);
        return $dateTime[0];
    }
    function getTimeOnly($dateTime) {
        $dateTime = explode(' ', $dateTime);
        return $dateTime[1];
    }
    function getDetailDateTime($dateTime) {
        $date = getDateOnly($dateTime);
        $time = getTimeOnly($dateTime);
        $detailDateTime['year'] = getYear($date);
        $detailDateTime['day'] = getDay($date);
        $detailDateTime['hour'] = getHour($time);
        $detailDateTime['minute'] = getMinute($time);
        return $detailDateTime;
    }

    function getCurDateTime($conn) {
        $stmt = $conn->query("SELECT CURRENT_TIMESTAMP() as 'CurDateTime'");
        $res = $stmt->fetch_assoc();
        return $res['CurDateTime'];
    }

    function outputPostDateTime($conn, $postDateTime) {
        $currDateTime = getCurDateTime($conn);
        $detailCurDateTime = getDetailDateTime($currDateTime);
        $detailPostDateTime = getDetailDateTime($postDateTime);
        if($detailCurDateTime['year'] == $detailPostDateTime['year']) {
            if($detailCurDateTime['day'] == $detailPostDateTime['day']) {
                if($detailCurDateTime['hour'] == $detailPostDateTime['hour']) {
                    if($detailCurDateTime['minute'] - $detailPostDateTime['minute'] == 0) 
                        $res = "Just now";
                    else if($detailCurDateTime['minute'] - $detailPostDateTime['minute'] == 1) 
                        $res = "1 minute ago";
                    else $res = $detailCurDateTime['minute'] - $detailPostDateTime['minute'] . " minutes ago";
                }
                else {
                    if($detailCurDateTime['hour'] - $detailPostDateTime['hour'] == 1) 
                        $res = "1 hour ago";
                    else $res = $detailCurDateTime['hour'] - $detailPostDateTime['hour'] . " hours ago";
                }
            }
            else if($detailCurDateTime['day'] - $detailPostDateTime['day'] == 1) {
                $res = "Yesterday at " . getTimeOnly($postDateTime);
            }
            else {
                $res = getMonthName(getMonth(getDateOnly($postDateTime))) . " " . getDay(getDateOnly($postDateTime));
            }
        }


        return $res;
       
    }
?>
