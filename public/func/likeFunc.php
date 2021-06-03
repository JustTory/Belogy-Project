<?php
    function checkSignedInOnLike() {
        if($_SESSION['signedIn'] == false) {
            $_SESSION['notification'] = 'You must be signed in to like posts';
            return false;
        }
        else return true;
    }
?>