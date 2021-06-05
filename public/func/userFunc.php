<?php
    //main functions
    function createUser($conn, &$errorsSignUp, &$username, &$email, &$password1, &$password2)
    {
        if (isset($_POST['signup'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password1 = $_POST['password1'];
            $password2 = $_POST['password2'];

            if (!checkValidUsername($username))
                $errorsSignUp['username'] = 'Username must be between 5 and 20 characters';
            if (!checkExistData($conn, $username, "user_username"))
                $errorsSignUp['username'] = 'Username is already taken';
            if (!checkValidEmail($email))
                $errorsSignUp['email'] = 'Invalid email';
            if (!checkExistData($conn, $email, "user_email"))
                $errorsSignUp['email'] = 'Email is already taken';
            if (!checkPassword($password1))
                $errorsSignUp['password1'] = 'Password must be atleast 6 characters';
            if (!checkMatchingPasswords($password1, $password2))
                $errorsSignUp['password2'] = "Passwords don't match";
            if (empty($errorsSignUp)) {
                if (createUserInDB($conn, $username, $email, $password2) == false) {
                    //sth went wrong
                }
            }
        }
    }

    function logInUser($conn, &$errorsSignIn, &$email)
    {
        if (isset($_POST['signin'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            if (empty($email))
                $errorsSignIn['email'] = "Email can't be empty";
            else if (checkExistData($conn, $email, "user_email"))
                $errorsSignIn['email'] = 'Email not found';
            else if (empty($password))
                $errorsSignIn['password'] = "Password can't be empty";
            else if (!checkLogIn($conn, $email, $password))
                $errorsSignIn['password'] = 'Password incorrect';
        }
    }


    //helper functions
    function checkValidUsername($username)
    {
        if (mb_strlen($username, "utf-8") < 5 || mb_strlen($username, "utf-8") > 20) return false;
        else return true;
    }

    function checkExistData($conn, $data, $type)
    {
        $sql = "SELECT * FROM users WHERE $type = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $data);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows >= 1) return false;
        else return true;
    }

    function checkValidEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;
        else return true;
    }

    function checkPassword($password)
    {
        if (mb_strlen($password, "utf-8") < 6) return false;
        else return true;
    }

    function checkMatchingPasswords($password1, $password2)
    {
        if ($password1 != $password2) return false;
        else return true;
    }

    function createUserInDB($conn, $username, $email, $password2)
    {
        $hashPW = password_hash($password2, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (user_username, user_email, user_password) VALUES (?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $hashPW);
        $stmt->execute();
        if ($stmt->affected_rows == 1) {
            $_SESSION['signedIn'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['userID'] = $stmt->insert_id;
            $_SESSION['userRole'] = 'user';
            $_SESSION['notification'] = 'Your account has been created';
            header("Location: index.php");
            exit();
        } else return false;
    }

    function checkLogIn($conn, $email, $password)
    {
        $sql = "SELECT * FROM users WHERE user_email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['user_password'])) {
                $_SESSION['signedIn'] = true;
                $_SESSION['username'] = $row['user_username'];
                $_SESSION['email'] = $row['user_email'];
                $_SESSION['userID'] = $row['user_ID'];
                $_SESSION['userRole'] = $row['user_role'];
                $_SESSION['notification'] = 'You have signed in successfully';
                header("Location: index.php");
                exit();
            }
        } else return false;
    }

    function outputProfile($conn) {
        if(isset($_GET['id'])) {
            $userID = $_GET['id'];
            if(checkOwnedProfileOrAdmin($userID)) {
                $editBtn = '<button type="button" class="btn btn-dark text-dark btn-sm bg-white edit-profile-btn"><i class="bi bi-pencil-square"></i></button>';
                $editCoverBGBtn = ' <div class="option-btn-wrapper d-none">
                                        <button type="button" name="edit-coverbg" class="btn btn-outline-secondary bg-white d-flex justify-content-center option-btn" data-toggle="modal" data-target="#edit-coverbg">
                                            <span class= "notification" data-container="body" data-toggle="popover" data-trigger="manual" data-placement="right" data-content="'. notifyErrorEditImg() .'">
                                                <i class="bi bi-pencil-square text-primary"></i>
                                            </span>
                                        </button>
                                    </div>';

                $addCoverBGBtn = '  <div class="option-btn-wrapper d-none">
                                        <button type="button" name="add-coverbg" class="btn btn-outline-secondary bg-white d-flex justify-content-center option-btn" data-toggle="modal" data-target="#add-coverbg">
                                        <span class= "notification" data-container="body" data-toggle="popover" data-trigger="manual" data-placement="right" data-content="'. notifyErrorEditImg() .'">
                                            <i class="bi bi-plus-lg text-secondary"></i>
                                        </span>
                                        </button>
                                    </div>';

                $editAvatarBtn = '  <div class="option-btn-wrapper d-none">
                                        <button type="button" name="edit-avatar" class="btn btn-outline-secondary bg-white d-flex justify-content-center option-btn" data-toggle="modal" data-target="#edit-avatar">
                                            <span class= "notification" data-container="body" data-toggle="popover" data-trigger="manual" data-placement="right" data-content="'. notifyErrorEditImg() .'">
                                                <i class="bi bi-pencil-square text-primary"></i>
                                            </span>
                                        </button>
                                    </div>';

                $addAvatarBtn = '   <div class="option-btn-wrapper d-none">
                                        <button type="button" name="add-avatar" class="btn btn-outline-secondary bg-white d-flex justify-content-center option-btn" data-toggle="modal" data-target="#add-avatar">
                                        <span class= "notification" data-container="body" data-toggle="popover" data-trigger="manual" data-placement="right" data-content="'. notifyErrorEditImg() .'">
                                            <i class="bi bi-plus-lg text-secondary"></i>
                                        </span>
                                        </button>
                                    </div>';

                $editBioBtn = ' <div class="option-btn-wrapper d-none">
                                        <button type="button" name="edit-bio" class="btn btn-outline-secondary bg-white d-flex justify-content-center option-btn" data-toggle="modal" data-target="#edit-bio">
                                            <span class= "notification" data-container="body" data-toggle="popover" data-trigger="manual" data-placement="right" data-content="'. notifyErrorEditImg() .'">
                                                <i class="bi bi-pencil-square text-primary"></i>
                                            </span>
                                        </button>
                                    </div>';
                if(getBio($conn, $userID) != false) {
                    $bio = getBio($conn, $userID);
                }
                else $bio = '" Write something about yourself "';

                $createPost = ' <div class="create-post mt-5">
                                    <div class="row my-3">
                                        <div class="col-md-8 offset-md-2">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="create-form d-flex">
                                                        <div class="avatar-wrapper d-flex justify-content-center align-items-center">
                                                            <img class="avatar mr-3" src="image.php?userID=' . $userID . '&avatar" alt="">
                                                        </div>
                                                        <form class="w-100 form-create" method="post" action="index.php">
                                                            <div class="form-group m-0">
                                                                <input type="text" name="createpost" class="form-control input-create async-task" placeholder="' .getUserName($conn, $userID) . ', how are you doing today?">
                                                            </div>
                                                        </form>
                                                        <form method="post" action="index.php" class="embedded d-flex justify-content-center align-items-center">
                                                            <button type="submit" name="createpost" id="embedded-btn" class="text-dark input-create async-task p-0"><i class="bi bi-image fa-lg mx-2"></i></button>
                                                            <button type="submit" name="createpost" id="embedded-btn" class="text-dark input-create async-task p-0"><i class="bi bi-link-45deg fa-lg"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';

                if(isSetBGCover($conn, $userID))
                    $optionCoverBGBtn =  $editCoverBGBtn;
                else $optionCoverBGBtn = $addCoverBGBtn;

                if(isSetAvatar($conn, $userID))
                    $optionAvatarBtn =  $editAvatarBtn;
                else $optionAvatarBtn = $addAvatarBtn;

            }
            else {
                $editBtn = '';
                $optionCoverBGBtn = '';
                $optionAvatarBtn = '';
                $editBioBtn = '';
                $createPost = '';
                $bio = getBio($conn, $userID);
            }

            $output = ' <div class="user-profile bg-white rounded pb-3" data-userid= "' . $_GET['id'] . '">
                            <div class="coverbg-wrapper">
                                <img class="rounded coverbg" src="image.php?userID=' . $userID . '&coverbg" alt="">';
            $output .= $optionCoverBGBtn;
            $output .=     '</div>

                            <div class="row mt-3 justify-content-center">
                                <div class="col-md-3 d-flex justify-content-center">
                                    <div class="main-avatar-wrapper">
                                        <img class="main-avatar" src="image.php?userID=' . $userID . '&avatar" alt="">';
            $output .= $optionAvatarBtn;
            $output .=             '</div>
                                </div>

                                <div class="col-md-7 d-flex align-items-center justify-content-center">
                                    <div class="user-info">
                                        <div class="username-wrapper d-flex">
                                            <h5 class="username m-0 mr-3 align-middle ' . isAdmin($conn, $userID) . '">' . getUserName($conn, $userID) . '</h5>';
            $output .= $editBtn;
            $output .=                 '</div>

                                        <div class="bio-wrapper my-4">
                                            <p class="bio text-start m-0">' . $bio . '</p>';
                    $output .= $editBioBtn;
                    $output .=
                                        '</div>


                                        <div class="statistics mt-3 d-flex">

                                            <div class="post-created mr-5">
                                                <h5 class="stat-title">Posts created</h5>
                                                <div class="stat-content d-flex justify-content-center">
                                                    <p class="mr-2">' . getTotalPostCreated($conn, $userID) . '</p>
                                                    <i class="bi bi-file-post text-primary"></i>
                                                </div>
                                            </div>

                                            <div class="post-liked mr-5">
                                                <h5 class="stat-title">Posts liked by community</h5>
                                                <div class="stat-content d-flex justify-content-center">
                                                    <p class="mr-2">' . getTotalPostLiked($conn, $userID) . '</p>
                                                    <i class="bi bi-heart-fill text-danger"></i>
                                                </div>
                                            </div>

                                            <div class="comments">
                                                <h5 class="stat-title">Comments</h5>
                                                <div class="stat-content d-flex justify-content-center">
                                                    <p class="mr-2">' . getTotalComments($conn, $userID) . '</p>
                                                    <i class="bi bi-chat-left-fill text-secondary"></i>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>



                        </div>';

            $output .= $createPost;

            echo $output;
        }
    }

    function editProfile($conn, &$errorsEdit) {
        if(isset($_POST['submit-new-coverbg'])) {
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
                    if($_POST['submit-new-coverbg'] == 'edit-coverbg') {
                        unlink(getOldProfileImgURL($conn, 'user_cover_bg'));
                    }

                    if(move_uploaded_file($newImgTmpName, $finalPath)) {
                        updateProfileImgToDB($conn, 'user_cover_bg', $finalPath);
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

        else if(isset($_POST['submit-delete-coverbg'])) {
            unlink(getOldProfileImgURL($conn, 'user_cover_bg'));
            updateProfileImgToDB($conn, 'user_cover_bg', '../images/default/empty-coverbg.jpg');
        }

        else if(isset($_POST['submit-new-avatar'])) {
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
                    if($_POST['submit-new-avatar'] == 'edit-avatar') {
                        unlink(getOldProfileImgURL($conn, 'user_avatar'));
                    }

                    if(move_uploaded_file($newImgTmpName, $finalPath)) {
                        updateProfileImgToDB($conn, 'user_avatar', $finalPath);
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

        else if(isset($_POST['submit-delete-avatar'])) {
            unlink(getOldProfileImgURL($conn, 'user_avatar'));
            updateProfileImgToDB($conn, 'user_avatar', '../images/default/defaultUserAvatar.png');
        }

        else if(isset($_POST['submit-edit-bio'])) {
            $bio = $_POST['bio'];

            if(!checkBio($bio))
                $errorsEdit['bio'] = "Bio must be less than 200 characters";

            if(empty($errorsEdit)) {
                updateBioToDB($conn, $bio);
            }
        }

    }

    function getOldProfileImgURL($conn, $columnName) {
        $sql = "SELECT $columnName FROM users WHERE user_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $_GET['id']);
        $stmt->execute();
        $row = $stmt->get_result();
        $result = $row->fetch_assoc();
        return $result[$columnName];
    }

    function updateProfileImgToDB($conn, $columnName, $newColumnValue) {
        $sql = "UPDATE users SET $columnName = ? WHERE user_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $newColumnValue, $_GET['id']);
        $stmt->execute();
        if($stmt->affected_rows == 1) {
            $_SESSION['notification'] = "Your profile has been edited";
            $location = "Location: profile.php?id=" . $_GET['id'];
            header($location);
            exit();
        }
    }

    function updateBioToDB($conn, $bio) {
        $sql = "UPDATE users SET user_bio = ? WHERE user_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $bio, $_GET['id']);
        $stmt->execute();
        if($stmt->affected_rows == 1) {
            $_SESSION['notification'] = "Your profile has been edited";
            $location = "Location: profile.php?id=" . $_GET['id'];
            header($location);
            exit();
        }
    }

    function isSetAvatar($conn, $userID) {
        $sql = "SELECT user_avatar FROM users WHERE user_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $row = $stmt->get_result();
        if ($row->num_rows == 1) {
            $result = $row->fetch_assoc();
            if($result['user_avatar'] == '../images/default/defaultUserAvatar.png') return false;
            else return true;
        }
    }

    function isSetBGCover($conn, $userID) {
        $sql = "SELECT user_cover_bg FROM users WHERE user_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $row = $stmt->get_result();
        if ($row->num_rows == 1) {
            $result = $row->fetch_assoc();
            if($result['user_cover_bg'] == '../images/default/empty-coverbg.jpg') return false;
            else return true;
        }
    }

    function isSetBio($conn, $userID) {
        $sql = "SELECT user_bio FROM users WHERE user_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $row = $stmt->get_result();
        if ($row->num_rows == 1) {
            $result = $row->fetch_assoc();
            if($result['user_bio'] == NULL) return false;
            else return true;
        }
    }

    function checkOwnedProfileOrAdmin($userID) {
        if($userID == $_SESSION['userID'] || (isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'admin'))
            return true;
        else return false;
    }

    function isAdmin($conn, $userID) {
        $sql = "SELECT user_role FROM users WHERE user_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $row = $stmt->get_result();
        if ($row->num_rows == 1) {
            $result = $row->fetch_assoc();
            if($result['user_role'] == 'admin') return 'text-danger';
            else return '';
        }
    }

    function getUserName($conn, $userID) {
        $sql = "SELECT user_username FROM users WHERE user_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $row = $stmt->get_result();
        if ($row->num_rows == 1) {
            $result = $row->fetch_assoc();
            return $result['user_username'];
        }
    }

    function getTotalPostCreated($conn, $userID) {
        $sql = "SELECT COUNT(*) as 'totalPost' FROM posts WHERE post_author_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $row = $stmt->get_result();
        if ($row->num_rows == 1) {
            $result = $row->fetch_assoc();
            return $result['totalPost'];
        }
    }

    function getTotalPostLiked($conn, $userID) {
        $sql = "SELECT SUM(post_no_likes) as 'totalLike' FROM posts WHERE post_author_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $row = $stmt->get_result();
        if ($row->num_rows == 1) {
            $result = $row->fetch_assoc();
            return $result['totalLike'];
        }
    }

    function getTotalComments($conn, $userID) {
        $sql = "SELECT COUNT(*) as 'totalCmt' FROM comments WHERE cmt_author_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $row = $stmt->get_result();
        if ($row->num_rows == 1) {
            $result = $row->fetch_assoc();
            return $result['totalCmt'];
        }
    }

    function getBio($conn, $userID) {
        $sql = "SELECT user_bio FROM users WHERE user_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $row = $stmt->get_result();
        if ($row->num_rows == 1) {
            $result = $row->fetch_assoc();
            if($result['user_bio'] == NULL)
                return false;
            else return $result['user_bio'];
        }
    }

    function checkBio($bio) {
        if(mb_strlen($bio, "utf-8") > 200)
            return false;
        else return true;
    }
?>
