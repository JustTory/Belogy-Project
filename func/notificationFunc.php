<?php
    function notify() {
        if(isset($_SESSION['signUpSuccess']))
            echo htmlspecialchars($_SESSION['signUpSuccess']);
        else if(isset($_SESSION['signInSuccess']))
            echo htmlspecialchars($_SESSION['signInSuccess']);
        else if(isset($_SESSION['signOutSuccess']))
            echo htmlspecialchars($_SESSION['signOutSuccess']);
        else if(($_SESSION['signedIn'] == false && isset($_POST['createpost'])) || isset($_SESSION['notSignedInOnCreatePost']))
            echo htmlspecialchars("You must be signed in to create post");
        else if($_SESSION['signedIn'] == false && isset($_SESSION['notSignedInOnPost']))
            echo htmlspecialchars("You must be signed in to view posts");
        else if(isset($_SESSION['newPost']))
            echo htmlspecialchars($_SESSION['newPost']);
    }

    function unsetNotification() {
        unset($_SESSION['signUpSuccess']);
        unset($_SESSION['signInSuccess']);
        unset($_SESSION['signOutSuccess']);
        unset($_SESSION['notSignedInOnCreatePost']);
        unset($_SESSION['notSignedInOnPost']);
        unset($_SESSION['newPost']);
    }
?>