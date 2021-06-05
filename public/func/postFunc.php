<?php
    //main functions
    function createPost($conn, &$errorsPost, &$title, &$content) {
        if(isset($_POST['submit'])) {
            $title = $_POST['title'];
            $content = $_POST['content'];

            $image = $_FILES['image'];
            $imgError = $image['error'];

            if(!checkTitle($title))
                $errorsPost['title'] = "Title can't be empty and must be less than 100 characters";
            if(!checkContent($content))
                $errorsPost['content'] = "Content can't be empty and must be less than 2000 characters";
            if($imgError == 1) { //default php.ini max file size is also 2mb
                $errorsPost['file'] = "Image size must be less than 2mb";
            }

            if($imgError == 0) { // if an image was uploaded
                $imgName = $image['name'];
                $imgType = explode("/", $image['type']);
                $imgExt = end($imgType);
                $imgTmpName = $image['tmp_name'];
                $imgSize = $image['size'];

                if(!allowedImgSize($imgSize)) {
                    $errorsPost['file'] = "Image size must be less than 2mb";
                }

                if(!allowedImgExt($imgType))
                    $errorsPost['file'] = "Only png, jpeg, jpg, gif images are allowed";

                if(empty($errorsPost)) {
                    $hashedImgName = uniqid('', false) . "." . $imgExt;
                    $finalPath = "../images/useruploads/" . $hashedImgName;
                    if(move_uploaded_file($imgTmpName, $finalPath))
                        writeToDB($conn, $title, $content, $_SESSION['userID'], $finalPath);
                    else $errorsPost['file'] = "There was an error uploading the image";
                }
            }

            else if(empty($errorsPost) && $imgError == 4)  // no image was uploaded
                writeToDB($conn, $title, $content, $_SESSION['userID']);
            //else $errorsPost['imgError'] = "Something is wrong with the file";
        }
    }

    function editPost($conn, &$errorsEdit) {
        if(isset($_POST['submit-new-img'])) {
            $newImage = $_FILES['new-image'];
            $newImgError = $newImage['error'];
            if($newImgError == 0) { // if an image was uploaded
                $newImgName = $newImage['name'];
                $newImgType = explode("/", $newImage['type']);
                $newImgExt = end($newImgType);
                $newImgTmpName = $newImage['tmp_name'];
                $newImgSize = $newImage['size'];
                if(!allowedImgSize($newImgSize))
                    $errorsEdit['img'] = "New image size must be less than 2mb";
                if(!allowedImgExt($newImgType))
                    $errorsEdit['img'] = "Only png, jpeg, jpg, gif new images are allowed";

                if(empty($errorsEdit)) {
                    $hashedImgName = uniqid('', false) . "." . $newImgExt;
                    $finalPath = "../images/useruploads/" . $hashedImgName;

                    //delete old image from folder if the user edit the img (replace the img)
                    if($_POST['submit-new-img'] == 'edit-img') {
                        unlink(getOldImgURL($conn));
                    }

                    if(move_uploaded_file($newImgTmpName, $finalPath)) {
                        updateToDB($conn, "post_img_url", $finalPath);
                    }
                    else $errorsEdit['img'] = "There was an error uploading the new image";
                }
            }
            else if($newImgError == 4) {
                $errorsEdit['img'] = "No new image was selected";
            }
            else if($newImgError == 1) { //default php.ini max file size is also 2mb
                $errorsEdit['img'] = "New image size must be less than 2mb";
            }
        }

        else if(isset($_POST['submit-delete-img'])) {
            unlink(getOldImgURL($conn));
            updateToDB($conn, "post_img_url", NULL);
        }

        else if(isset($_POST['submit-edit-title'])) {
            $newTitle = $_POST['new-title'];

            if(!checkTitle($newTitle))
                $errorsEdit['title'] = "New title can't be empty and must be less than 100 characters";

            if(empty($errorsEdit)) {
                updateToDB($conn, "post_title", $newTitle);
            }
        }

        else if(isset($_POST['submit-edit-content'])) {
            $newContent = $_POST['new-content'];

            if(!checkContent($newContent))
                $errorsEdit['content'] = "New content can't be empty and must be less than 2000 characters";

            if(empty($errorsEdit)) {
                updateToDB($conn, "post_content", $newContent);
            }
        }

        else if(isset($_POST['submit-delete-post'])) {
            if(getOldImgURL($conn) != NULL)
                unlink(getOldImgURL($conn));
            deleteFromDB($conn);
        }

    }

    function getPost($conn) {
        if(isset($_GET['id'])) {
            $postID = $_GET['id'];
            $sql = "SELECT p.post_ID, p.post_title, p.post_content, p.post_img_url, p.post_author_ID, u.user_username, u.user_role, p.post_no_likes, p.post_no_comments, p.post_date_created, p.post_last_modified FROM posts p, users u WHERE p.post_ID = ? AND p.post_author_ID = u.user_ID";
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
        $sql = "SELECT p.post_ID, p.post_title, p.post_content, p.post_img_url, p.post_author_ID, u.user_username, u.user_role, p.post_no_likes, p.post_no_comments, p.post_date_created, p.post_last_modified FROM posts p, users u WHERE p.post_author_ID = u.user_ID ORDER BY post_ID DESC LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $results = $stmt->get_result();
        return $results->fetch_all(MYSQLI_ASSOC);
    }

    function getUserPostList($conn, $userID, $limit, $offset = 0) {
        $sql = "SELECT p.post_ID, p.post_title, p.post_content, p.post_img_url, p.post_author_ID, u.user_username, u.user_role, p.post_no_likes, p.post_no_comments, p.post_date_created, p.post_last_modified FROM posts p, users u WHERE p.post_author_ID = u.user_ID AND p.post_author_ID = ? ORDER BY post_ID DESC LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $userID, $limit, $offset);
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
        $ownedPostButton = '<a class="ml-auto edit-btn async-task" href="editpost.php?id=' . $post['post_ID'] . '">
                                <i class="bi bi-pencil-square"></i>
                            </a>';
        $output .= '
        <div class="row my-5">
            <div class="col-md-8 offset-md-2">
                <a class="a-post async-task" href="post.php?id=' . $post['post_ID'] . '">
                    <div class="card post">';

        if ($post['post_img_url'] != null) {
            $output.= '
                        <img class="card-img-top post-img" src="image.php?postID=' . $post['post_ID'] . '" alt="Post image">';
        }
            $output .= '
                        <div class="card-body post-body pb-2">
                            <div class="title-edit d-flex">
                                <h5 class="card-title post-title font-weight-normal">' . $post['post_title'] . '</h5>';
        if(checkOwnedPostOrAdmin($post['post_author_ID'])){
            $output .= $ownedPostButton;
        }
            $output .='

                            </div>
                            <p class="card-text post-content">' . readMoreAtIndex($post['post_content'], $post['post_ID']) . '</p>
                            <div class="author-date d-flex mt-4">
                                <a class="' .outputUserRoleColor($post['user_role']) . ' font-weight-bold d-flex align-items-center" href="profile.php?id=' . $post['post_author_ID'] . '">
                                    <img class="avatar-post mr-2" src="image.php?userID=' . $post['post_author_ID'] . '&avatar" alt="">'
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
                                    <div class="col-md-6 d-flex justify-content-center">
                                        <button type="button" data-postid="'. $post['post_ID'] .'" name="like-btn" class="like-btn ' . $isLikedClass[0] . ' text-center">
                                            <i class="like-logo bi '. $isLikedClass[1] . '"></i>
                                            Like
                                        </button>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-center">
                                        <a class="text-dark text-center cmt-btn async-task" href="post.php?id=' . $post['post_ID'] . '">
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
        <div class="row my-5">
            <div class="col-md-8 offset-md-2">
                <div class="card post">
                    <div class="post-content-wrapper">
                        <div class="options-img">';

        if ($post['post_img_url'] != null) {
            $output.= '
                            <button type="button" name="edit-img" class="btn btn-outline-secondary bg-white d-flex justify-content-center option-btn" data-toggle="modal" data-target="#edit-img">
                                <span class= "notification" data-container="body" data-toggle="popover" data-trigger="manual" data-placement="right" data-content="'. notifyErrorEditImg() .'">
                                    <i class="bi bi-pencil-square text-primary"></i>
                                </span>
                            </button>
                            <button type="button" name="delete-img" class="btn btn-outline-secondary bg-white d-flex justify-content-center mt-2 option-btn" data-toggle="modal" data-target="#delete-img">
                                <i class="bi bi-trash text-danger"></i>
                            </button>
                        </div>
                        <a class="a-post async-task" href="post.php?id=' . $post['post_ID'] . '">
                            <img class="card-img-top post-img low-opacity" src="image.php?postID=' . $post['post_ID'] . '" alt="Post image">
                        </a>
                    </div>';
        } else {
            $output.= '
                            <button type="button" name="add-img" class="btn btn-outline-secondary bg-white d-flex justify-content-center option-btn" data-toggle="modal" data-target="#add-img">
                                <span class= "notification" data-container="body" data-toggle="popover" data-trigger="manual" data-placement="right" data-content="'. notifyErrorEditImg() .'">
                                    <i class="bi bi-plus-lg text-secondary"></i>
                                </span>
                            </button>
                        </div>
                        <a class="a-post" href="post.php?id=' . $post['post_ID'] . '">
                            <img class="card-img-top post-img low-opacity" src="image.php?emptyimg" alt="Post image">
                        </a>
                    </div>';
        }
            $output .= '
                    <div class="card-body post-body pb-2">
                        <div class="post-content-wrapper">
                            <div class="options-title">
                                <button type="button" name="edit-title" class="btn btn-outline-secondary bg-white d-flex justify-content-center option-btn" data-toggle="modal" data-target="#edit-title">
                                    <span class= "notification" data-container="body" data-toggle="popover" data-trigger="manual" data-placement="right" data-content="'. notifyErrorEditTitle() .'">
                                        <i class="bi bi-pencil-square text-primary"></i>
                                    </span>
                                </button>
                            </div>
                            <a class="a-post" href="post.php?id=' . $post['post_ID'] . '">
                                <h5 class="card-title post-title font-weight-normal low-opacity">' . $post['post_title'] . '</h5>
                            </a>
                        </div>
                        <div class="post-content-wrapper">
                            <div class="options-content">
                                <button type="button" name="edit-content" class="btn btn-outline-secondary bg-white d-flex justify-content-center option-btn" data-toggle="modal" data-target="#edit-content">
                                    <span class= "notification" data-container="body" data-toggle="popover" data-trigger="manual" data-placement="right" data-content="'. notifyErrorEditContent() .'">
                                        <i class="bi bi-pencil-square text-primary"></i>
                                    </span>
                                </button>
                            </div>
                            <a class="a-post" href="post.php?id=' . $post['post_ID'] . '">
                                <p class="card-text post-content low-opacity">' . $post['post_content'] . '</p>
                            </a>
                        </div>
                        <div class="author-date d-flex mt-4">
                            <a class="' .outputUserRoleColor($post['user_role']) . ' font-weight-bold d-flex align-items-center" href="profile.php?id=' . $post['post_author_ID'] . '">
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
                                <div class="col-md-6 d-flex justify-content-center">
                                    <a class="like-btn ' . $isLikedClass[0] . ' text-center" href="post.php?id=' . $post['post_ID'] . '">
                                        <i class="like-logo bi '. $isLikedClass[1] . '"></i>
                                        Like
                                    </a>
                                </div>
                                <div class="col-md-6 d-flex justify-content-center">
                                    <a class="text-dark text-center cmt-btn async-task" href="post.php?id=' . $post['post_ID'] . '">
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
    function readMoreAtIndex($postContent, $postID) {
        $PHPName = basename($_SERVER['SCRIPT_NAME'], ".php");
        if($PHPName == 'index' || $PHPName == 'profile') {
            if (mb_strlen($postContent, "utf-8") > 190) {
                $postContentCut = mb_substr($postContent, 0, 190, "utf-8");
                $lastSpacePost = mb_strrpos($postContentCut, ' ', "utf-8");

                if($lastSpacePost != false)
                    $finalPostContent = mb_substr($postContentCut, 0, $lastSpacePost, "utf-8");
                else $finalPostContent = $postContentCut;

                $finalPostContent  .= '... <a class="text-secondary async-task" href="post.php?id=' . $postID . '">Read more</a>';
                return $finalPostContent;
            }
            else return $postContent;
        }
        else return $postContent;
    }

    function outputUserRoleColor($userRole) {
        if($userRole == 'admin') {
            return "text-danger";
        }
        else return "text-dark";
    }

    function mapErrorsToSession($errorsEdit) {
        if(isset($errorsEdit['img']))
            $_SESSION['errorEditImg'] = $errorsEdit['img'];
        else if(isset($errorsEdit['title']))
            $_SESSION['errorEditTitle'] = $errorsEdit['title'];
        else if(isset($errorsEdit['content']))
            $_SESSION['errorEditContent'] = $errorsEdit['content'];
    }

    function checkTitle($title) {
        if(mb_strlen($title, "utf-8") > 100 || $title == '')
            return false;
        else return true;
    }

    function checkContent($content) {
        if(mb_strlen($content, "utf-8") > 2000 || $content == '')
            return false;
        else return true;
    }

    function checkOwnedPostOrAdmin($postAuthorID) {
        if($postAuthorID == $_SESSION['userID'] || (isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'admin'))
            return true;
        else return false;
    }

    function writeToDB($conn, $title, $content, $authorID, $imgPath = null) {
        $sql = "INSERT INTO posts (post_title, post_content, post_img_url, post_author_ID) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $title, $content, $imgPath, $authorID);
        $stmt->execute();
        if($stmt->affected_rows == 1) {
            $_SESSION['notification'] = "You have created a new post";
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
            $_SESSION['notification'] = "Your post has been edited";
            $location = "Location: editpost.php?id=" . $_GET['id'];
            header($location);
            exit();
        }
    }

    function deleteFromDB($conn) {
        $sql = "DELETE FROM posts WHERE post_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $_GET['id']);
        $stmt->execute();
        if($stmt->affected_rows == 1) {
            $_SESSION['notification'] = "Your post has been deleted";
            $location = "Location: index.php";
            header($location);
            exit();
        }
    }

    function getOldImgURL($conn) {
        $sql = "SELECT post_img_url FROM posts WHERE post_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $_GET['id']);
        $stmt->execute();
        $row = $stmt->get_result();
        $result = $row->fetch_assoc();
        return $result['post_img_url'];
    }
?>
