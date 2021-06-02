<?php
    function notify() {
        if(isset($_SESSION['notification']))
            echo htmlspecialchars($_SESSION['notification']);
        else if(($_SESSION['signedIn'] == false && isset($_POST['createpost'])) || isset($_SESSION['notSignedInOnCreatePost']))
            echo htmlspecialchars("You must be signed in to create post");
        else if($_SESSION['signedIn'] == false && isset($_SESSION['notSignedInOnPost']))
            echo htmlspecialchars("You must be signed in to view posts");
    }

    function unsetNotification() {
        unset($_SESSION['notSignedInOnCreatePost']);
        unset($_SESSION['notSignedInOnPost']);
        unset($_SESSION['notification']);
    }
?>