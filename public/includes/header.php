<?php
    session_start();
    if(!isset($_SESSION['signedIn'])) {
      $_SESSION['signedIn'] = false;
    }

    //include "includes/db.php";
    include "func/linkFunc.php";

    $PHPName = basename($_SERVER['SCRIPT_NAME'], ".php");
    $pageTitle = PHPNameToPageName($PHPName);
    $CSSName = PHPNameToCSSName($PHPName);
    $JSName = PHPNameToJSName($PHPName);
?>

<!doctype html>
<html lang="en">
  <head>
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1.0, user-scalable=no">

    <!-- library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;800&display=swap" rel="stylesheet">

    <!-- css must be below libary -->
    <link rel="stylesheet" href="css/<?php echo htmlspecialchars($CSSName); ?>">

    <!-- web icon -->
    <link rel="icon" href="image.php?webicon">

  </head>
  <body>
  <div class="inside-body">