<?php
    session_start();
    $_SESSION = [];
    session_destroy();
    session_start();
    $_SESSION['notification'] = "You have signed out successfully";
    header("Location: index.php");
    exit();
?>