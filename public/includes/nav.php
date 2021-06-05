<?php
  include "func/notificationFunc.php";
?>

<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
  <a class="navbar-brand async-task ml-5" href="index.php">
    <img class="web-logo" src="image.php?weblogo" alt="">
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse bg-white" id="navbarSupportedContent">

    <ul class="navbar-nav ml-auto mr-auto">
      <li class="nav-item mr-5">
        <a class="async-task nav-a" href="index.php">
          <i class="bi bi-house fa-lg"></i> Home
          <?php if ($PHPName == 'index'): ?>
            <div class="gradient-line w-100 mt-1"></div>
          <?php endif; ?>
        </a>

      </li>

      <li class="nav-item ml-5">
        <a class="async-task nav-a" href="createpost.php">
          <i class="bi bi-pencil-square fa-lg"></i> Create post
          <?php if ($PHPName == 'createpost'): ?>
            <div class="gradient-line w-100 mt-1"></div>
          <?php endif; ?>
        </a>

      </li>
    </ul>


    <ul class="navbar-nav mr-5">


      <?php if ($_SESSION['signedIn'] == true): ?>
        <li class="nav-item dropdown">
          <a tabindex="0" class="nav-link p-0" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="avatar mr-2" src="image.php?userID=<?php echo htmlspecialchars($_SESSION['userID']); ?>&avatar" alt="">
            <?php echo htmlspecialchars($_SESSION['username']); ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item async-task" href="profile.php?id=<?php echo htmlspecialchars($_SESSION['userID']); ?>"><i class="bi bi-person mr-2"></i>Profile</a>
            <a class="dropdown-item async-task" href="createpost.php"><i class="bi bi-pencil-square mr-2"></i>Create post</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger async-task" href="signout.php"><i class="bi bi-box-arrow-right mr-2"></i>Sign out</a>
          </div>
        </li>
      <?php else: ?>
        <li class="nav-item">
          <a class="nav-link async-task" href="signin.php">Login <i class="bi bi-box-arrow-in-right fa-lg"></i></a>
        </li>
      <?php endif; ?>

      <li class="nav-item ml-4 notification d-flex align-items-center" data-container="body" data-toggle="popover" data-trigger="manual" data-placement="bottom" data-content="<?php notify(); ?>">
        <i class="bi bi-bell fa-lg"></i>
      </li>

    </ul>
  </div>
</nav>