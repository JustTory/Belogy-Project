<?php
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
                    $hashedImgName = uniqid('', false) . "." . $imgExt;
                    $finalPath = "../images/useruploads/" . $hashedImgName;
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

    function editPost($conn, &$errorsNewImg) {

        if(isset($_POST['submit-edit-img'])) { 
            $newImage = $_FILES['new-image'];
            $newImgError = $newImage['error'];
            if($newImgError == 0) { // if an image was uploaded
                $newImgName = $newImage['name'];
                $newImgType = explode("/", $newImage['type']);
                $newImgExt = end($newImgType);
                $newImgTmpName = $newImage['tmp_name'];
                $newImgSize = $newImage['size'];
                if(!allowedImgSize($newImgSize))
                    $errorsNewImg['imgSize'] = "Image size must be less than 2mb";
                if(!allowedImgExt($newImgExt))
                    $errorsNewImg['imgExt'] = "Only png, jpeg, jpg, gif images are allowed";

                if(empty($errorsNewImg)) {
                    $hashedImgName = uniqid('', false) . "." . $newImgExt;
                    $finalPath = "../images/useruploads/" . $hashedImgName;


                    //delete old image from folder


                    if(move_uploaded_file($newImgTmpName, $finalPath)) 
                        updateToDB($conn, "post_img_url", $finalPath);
                    else $errorsNewImg['imgUpload'] = "There was an error uploading the image";
                }
            }
        }

        if(isset($_POST['submit-delete-img'])) { 
            
        }

        if(isset($_POST['submit-edit-title'])) { 
            
        }

        if(isset($_POST['submit-edit-content'])) { 
            
        }
    
    }


    function getPost($conn) {
        if(isset($_GET['id'])) {
            $postID = $_GET['id'];
            $sql = "SELECT p.post_ID, p.post_title, p.post_content, p.post_img_url, p.post_author_ID, u.user_username, p.post_no_likes, p.post_no_comments, p.post_date_created, p.post_last_modified FROM posts p, users u WHERE p.post_ID = ? AND p.post_author_ID = u.user_ID";
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
        } else {
            header("Location: index.php");
            exit();
        }
    }

    function getPostList($conn, $limit , $offset = 0) {
        $sql = "SELECT p.post_ID, p.post_title, p.post_content, p.post_img_url, p.post_author_ID, u.user_username, p.post_no_likes, p.post_no_comments, p.post_date_created, p.post_last_modified FROM posts p, users u WHERE p.post_author_ID = u.user_ID ORDER BY post_ID DESC LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $results = $stmt->get_result();
        return $results->fetch_all(MYSQLI_ASSOC);
    }

    function outputPost($conn, $post, $type) {
        $likePostList = likedPostList($conn);
        $output = '';
        $isLikedClass = [];
        if(in_array($post['post_ID'], $likePostList, true)) {
            array_push($isLikedClass, "text-danger");
            array_push($isLikedClass, "bi-heart-fill");
        } else {
            array_push($isLikedClass, "text-dark");
            array_push($isLikedClass, "bi-heart");
        }
        $ownedPostButton = '<a class="ml-auto" href="editpost.php?id=' . $post['post_ID'] . '">
                                <i class="bi bi-pencil-square"></i>
                            </a>';
        $output .= '
        <div class="row my-3">
            <div class="col-md-8 offset-md-2">
                <a class="a-post" href="post.php?id=' . $post['post_ID'] . '">
                    <div class="card post">';
                  
        if ($post['post_img_url'] != null) {
            $output.= '
                        <img class="card-img-top post-img" src="image.php?postID=' . $post['post_ID'] . '" alt="Post image">';
        }
            $output .= '
                        <div class="card-body post-body pb-2">
                            <div class="title-edit d-flex">
                                <h5 class="card-title post-title font-weight-normal">' . $post['post_title'] . '</h5>';
        if(checkOwnedPost($post['post_author_ID'])){
            $output .= $ownedPostButton;
        }                    
            $output .='
                            </div>
                            <p class="card-text post-content">' . $post['post_content'] . '</p>
                            <div class="author-date d-flex mt-4">
                                <a class="text-dark font-weight-bold d-flex align-items-center" href="profile.php?id=' . $post['post_author_ID'] . '">
                                    <img class="avatar-post mr-2" src="image.php?defaultAvatar" alt="">'
                                    . $post['user_username'] . '
                                </a>
                                <p class="font-weight-light my-2 post-info ml-auto">' . outputContentDateTime($conn, $post['post_date_created']) . '</p>
                            </div>
                            <div class="no-like-cmt d-flex mt-2">
                                <p class="post-info post-no-likes mb-0 mr-3"><i class="bi bi-heart-fill text-danger"></i> ' . $post['post_no_likes'] . '</p>
                                <p class="post-info post-no-comments mb-0"><i class="bi bi-chat-left-fill text-secondary"></i> ' . $post['post_no_comments'] . '</p>
                            </div>
                            <hr class="mb-2">
                            <div class="interaction">
                                <div class="row">
                                    <form class="like-form col-md-6 d-flex justify-content-center" method="POST" action="createlike.php">
                                        <button type="submit" data-postid="'. $post['post_ID'] .'" name="like-submit" class="like-btn ' . $isLikedClass[0] . ' text-center">
                                            <i class="like-logo bi '. $isLikedClass[1] . '"></i>
                                            Like
                                        </button>
                                    </form> 
                                    <div class="col-md-6 d-flex justify-content-center">
                                        <a class="text-dark text-center" href="post.php?id=' . $post['post_ID'] . '">
                                            <i class="bi bi-chat-left"></i>
                                            Comment
                                        </a>
                                    </div>
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

    function outputPostEdit($conn, $post) {
        $likePostList = likedPostList($conn);
        $output = '';
        $isLikedClass = [];
        if(in_array($post['post_ID'], $likePostList, true)) {
            array_push($isLikedClass, "text-danger");
            array_push($isLikedClass, "bi-heart-fill");
        } else {
            array_push($isLikedClass, "text-dark");
            array_push($isLikedClass, "bi-heart");
        }
        $output .= '
        <div class="row my-3">
            <div class="col-md-8 offset-md-2">
                <div class="card post">';
                  
        if ($post['post_img_url'] != null) {
            $output.= ' 
                    <div class="post-content-wrapper">
                        <div class="options-img">
                            <button type="button" name="edit-img" class="btn btn-outline-secondary bg-white d-flex justify-content-center option-btn" data-toggle="modal" data-target="#edit-img">
                                <i class="bi bi-pencil-square text-primary"></i>
                            </button>
                            <button type="button" name="delete-img" class="btn btn-outline-secondary bg-white d-flex justify-content-center mt-2 option-btn" data-toggle="modal" data-target="#delete-img">
                                <i class="bi bi-trash text-danger"></i>
                            </button>
                        </div>
                        <a class="a-post" href="post.php?id=' . $post['post_ID'] . '">
                            <img class="card-img-top post-img low-opacity" src="image.php?postID=' . $post['post_ID'] . '" alt="Post image">
                        </a>
                    </div>';
        }
            $output .= '
                    <div class="card-body post-body pb-2">
                        <div class="post-content-wrapper">
                            <div class="options-title">
                                <button type="button" name="edit-title" class="btn btn-outline-secondary bg-white d-flex justify-content-center option-btn" data-toggle="modal" data-target="#edit-title">
                                    <i class="bi bi-pencil-square text-primary"></i>
                                </button>
                            </div>
                            <a class="a-post" href="post.php?id=' . $post['post_ID'] . '">
                                <h5 class="card-title post-title font-weight-normal low-opacity">' . $post['post_title'] . '</h5>
                            </a>
                        </div>
                        <div class="post-content-wrapper">
                            <div class="options-content">
                                <button type="button" name="edit-content" class="btn btn-outline-secondary bg-white d-flex justify-content-center option-btn" data-toggle="modal" data-target="#edit-content">
                                    <i class="bi bi-pencil-square text-primary"></i>
                                </button>
                            </div>
                            <a class="a-post" href="post.php?id=' . $post['post_ID'] . '">
                                <p class="card-text post-content low-opacity">' . $post['post_content'] . '</p>
                            </a>
                        </div>
                        <div class="author-date d-flex mt-4">
                            <a class="text-dark font-weight-bold d-flex align-items-center" href="profile.php?id=' . $post['post_author_ID'] . '">
                                <img class="avatar-post mr-2" src="image.php?defaultAvatar" alt="">'
                                    . $post['user_username'] . '
                            </a>
                            <p class="font-weight-light my-2 post-info ml-auto">' . outputContentDateTime($conn, $post['post_date_created']) . '</p>
                        </div>
                        <div class="no-like-cmt d-flex mt-2">
                            <p class="post-info post-no-likes mb-0 mr-3"><i class="bi bi-heart-fill text-danger"></i> ' . $post['post_no_likes'] . '</p>
                            <p class="post-info post-no-comments mb-0"><i class="bi bi-chat-left-fill text-secondary"></i> ' . $post['post_no_comments'] . '</p>
                        </div>
                        <hr class="mb-2">
                        <div class="interaction">
                            <div class="row">
                                <form class="like-form col-md-6 d-flex justify-content-center" method="POST" action="createlike.php">
                                    <button type="submit" name="like-submit" class="like-btn ' . $isLikedClass[0] . ' text-center">
                                        <i class="like-logo bi '. $isLikedClass[1] . '"></i>
                                            Like
                                    </button>
                                </form> 
                                <div class="col-md-6 d-flex justify-content-center">
                                    <a class="text-dark text-center" href="post.php?id=' . $post['post_ID'] . '">
                                        <i class="bi bi-chat-left"></i>
                                        Comment
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
        ';
        echo $output;
    }

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

    function checkSignedInOnCreatePost() {
        if($_SESSION['signedIn'] == false) {
            $_SESSION['notSignedInOnCreatePost'] = true;
            header("Location: index.php");
            exit();
        }
    }

    function checkSignedInOnPost() {
        if($_SESSION['signedIn'] == false) {
            $_SESSION['notSignedInOnPost'] = true;
            header("Location: index.php");
            exit();
        }
    }

    //check whether the post is liked
    function likedPostList($conn) {
        $sql = "SELECT like_post_ID FROM likes WHERE like_author_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $_SESSION['userID']);
        $stmt->execute();
        $results = $stmt->get_result();
        $rows = $results->fetch_all(MYSQLI_ASSOC);
        $likedPostList = array_column($rows, 'like_post_ID');
        return $likedPostList;
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

    function checkOwnedPost($postAuthorID) {
        if($postAuthorID == $_SESSION['userID']) 
            return true;
        else return false;
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

    function updateToDB($conn, $columnName, $newColumnValue) {
        $sql = "UPDATE posts SET $columnName = ? WHERE post_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $newColumnValue, $_GET['id']);
        $stmt->execute();
        if($stmt->affected_rows == 1) {
            $_SESSION['editedPost'] = "Your post has been edited";
            $location = "Location: editpost.php?id=" . $_GET['id'];
            header($location);
            exit();
        }
    }
?>
