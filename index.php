<?php
    include "includes/header.php";
    $displayNone = "='display: none'";
    $displayShow = '';
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand ml-3" href="index.php">Belogy</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto mr-5">

      <li class="nav-item" style <?php 
        if($_SESSION['signedIn'] == true) {
          echo $displayNone;
        } 
        else echo $displayShow;
      ?>>
        <a class="nav-link" data-container="body" data-toggle="popover" data-placement="bottom" data-content="<?php
            // if(isset($_SESSION['signInSuccess']))
            // echo $_SESSION['signInSuccess'];
          ?>" 
        href="signin.php">Login <i class="bi bi-box-arrow-in-right fa-lg"></i></a> 
      </li>

      <li class="nav-item dropdown" style <?php 
          if($_SESSION['signedIn'] == true) echo $displayShow;
          else echo $displayNone;
        ?>  
     >
        <a tabindex="0" class="nav-link p-0" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img class="avatar mr-2" src="images\defaultUserAvatar.png" alt="">
          <?php
            echo $_SESSION['username'];
          ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="profile.php"><i class="bi bi-person mr-2"></i>Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="signout.php"><i class="bi bi-box-arrow-right mr-2"></i>Sign out</a>
        </div>
      </li>

      <li class="nav-item ml-4 notification d-flex align-items-center" data-container="body" data-toggle="popover" data-trigger="manual" data-placement="bottom" data-content="<?php
          if(isset($_SESSION['signUpSuccess']))
            echo $_SESSION['signUpSuccess'];
          else if(isset($_SESSION['signInSuccess']))
            echo $_SESSION['signInSuccess'];
          else if(isset($_SESSION['signOutSuccess']))
            echo $_SESSION['signOutSuccess'];
        ?>">
      <i class="bi bi-bell fa-lg"></i>
      </li>

    </ul>

  </div>
</nav>




<?php
    include "includes/footer.php";
    unset($_SESSION['signUpSuccess']);
    unset($_SESSION['signInSuccess']);
    unset($_SESSION['signOutSuccess']);
?>
      


