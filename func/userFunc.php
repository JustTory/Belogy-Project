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
        $_SESSION['signUpSuccess'] = 'Your account has been created';
        header("Location: index.php?signup=success");
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
            $_SESSION['signInSuccess'] = 'You have signed in successfully';
            header("Location: index.php");
        }
    } else return false;
}
