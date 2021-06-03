<?php
    function notify() {
        if(isset($_SESSION['notification']))
            echo htmlspecialchars($_SESSION['notification']);
        else if(($_SESSION['signedIn'] == false && isset($_POST['createpost'])) || isset($_SESSION['notSignedInOnCreatePost']))
            echo htmlspecialchars("You must be signed in to create post");
        else if($_SESSION['signedIn'] == false && isset($_SESSION['notSignedInOnPost']))
            echo htmlspecialchars("You must be signed in to view posts");

    }

    function notifyErrorEditImg() {
        if(isset($_SESSION['errorEditImg']))
            return $_SESSION['errorEditImg'];
    }

    function notifyErrorEditTitle() {
        if(isset($_SESSION['errorEditTitle']))
            return $_SESSION['errorEditTitle'];
    }

    function notifyErrorEditContent() {
        if(isset($_SESSION['errorEditContent']))
            return $_SESSION['errorEditContent'];
    }

    function unsetNotification() {
        unset($_SESSION['notSignedInOnCreatePost']);
        unset($_SESSION['notSignedInOnPost']);
        unset($_SESSION['notification']);
        unset($_SESSION['errors']);
        unset($_SESSION['errorEditImg']);
        unset($_SESSION['errorEditTitle']);
        unset($_SESSION['errorEditContent']);
    }
?>