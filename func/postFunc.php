<?php
    include "func/imgFunc.php";
    include "func/timeFunc.php";

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
        $sql = "SELECT p.post_ID, p.post_title, p.post_content, p.post_img_url, u.user_username, p.post_no_upvotes, p.post_no_comments,	p.post_date_created, p.post_last_modified FROM posts p, users u WHERE p.post_ID = ? AND p.post_author_ID = u.user_ID";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $postID);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1) {
            $post = $result->fetch_assoc();
            if($_SESSION['signedIn'] == true) {
                $_SESSION['lastPostIDVisited'] = $post['post_ID'];
            }
            return $post;
        } else {
            return false;
        }
    }

    function getPostList($conn, $limit , $offset = 0) {
        $sql = "SELECT p.post_ID, p.post_title, p.post_content, p.post_img_url, u.user_username, p.post_no_upvotes, p.post_no_comments,	p.post_date_created, p.post_last_modified FROM posts p, users u WHERE p.post_author_ID = u.user_ID ORDER BY post_ID DESC LIMIT ?,?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $offset, $limit);
        $stmt->execute();
        $results = $stmt->get_result();
        return $results->fetch_all(MYSQLI_ASSOC);
    }

    function outputPost($conn, $post, $type) {
        $output = '';
        $output .= '
        <div class="row my-3">
            <div class="col-md-8 offset-md-2">
                <a class="a-post" href="post.php?id=' . $post['post_ID'] . '">
                    <div class="card post">';
                  
        if ($post['post_img_url'] != null) {
            $output.= '
                        <img class="card-img-top post-img" src="' . $post['post_img_url'] . '" alt="Post image">';
        }
            $output .= '
                        <div class="card-body post-body pb-2">
                            <h5 class="card-title post-title font-weight-normal">' . $post['post_title'] . '</h5>
                            <p class="card-text post-content">' . $post['post_content'] . '</p>
                            <div class="author-date d-flex mt-4">
                                <a class="text-dark font-weight-bold d-flex align-items-center" href="profile.php?id=">
                                    <img class="avatar-post mr-2" src="images\default\defaultUserAvatar.png" alt="">'
                                    . $post['user_username'] . '
                                </a>
                                <p class="font-weight-light my-2 post-info ml-auto">' . outputPostDateTime($conn, $post['post_date_created']) . '</p>
                            </div>
                            <div class="no-like-cmt d-flex mt-2">
                                <p class="post-info mb-0 mr-3"><i class="bi bi-hand-thumbs-up-fill text-primary"></i> 25</p>
                                <p class="post-info mb-0"><i class="bi bi-chat-left-fill text-secondary"></i> 8</p>
                            </div>
                            <hr class="mb-2">
                            <div class="interaction">
                                <div class="row">
                                    <a class="text-dark col-md-6 text-center" href="like">
                                        <i class="bi bi-hand-thumbs-up"></i>
                                        Like
                                    </a>
                                    <a class="text-dark col-md-6 text-center" href="post.php?id=' . $post['post_ID'] . '">
                                        <i class="bi bi-chat-left"></i>
                                        Comment
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>    
            </div>
        </div>
        ';
        if($type == "echo") echo $output;
        else if($type == "return") return $output;
    }

    //$post['post_ID']
    function outputPostList($conn, $postList) {
        $output = '';
        foreach ($postList as $post) {
            $output .= outputPost($conn, $post, "return");
        }
        echo $output;
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
