<?php
    include "includes/header.php";
?>

<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
  <a class="navbar-brand ml-3" href="index.php">Belogy</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse bg-white" id="navbarSupportedContent">
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search posts" aria-label="Search">
        <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
      </form>
    <ul class="navbar-nav ml-auto mr-5">
    
      <?php if ($_SESSION['signedIn'] == true): ?>
        <li class="nav-item dropdown">
          <a tabindex="0" class="nav-link p-0" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="avatar mr-2" src="images\defaultUserAvatar.png" alt="">
            <?php echo htmlspecialchars($_SESSION['username']); ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="profile.php"><i class="bi bi-person mr-2"></i>Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="signout.php"><i class="bi bi-box-arrow-right mr-2"></i>Sign out</a>
          </div>
        </li>
      <?php else: ?>
        <li class="nav-item">
          <a class="nav-link" href="signin.php">Login <i class="bi bi-box-arrow-in-right fa-lg"></i></a> 
        </li>
      <?php endif; ?>

      <li class="nav-item ml-4 notification d-flex align-items-center" data-container="body" data-toggle="popover" data-trigger="manual" data-placement="bottom" data-content="<?php
          if(isset($_SESSION['signUpSuccess']))
            echo htmlspecialchars($_SESSION['signUpSuccess']);
          else if(isset($_SESSION['signInSuccess']))
            echo htmlspecialchars($_SESSION['signInSuccess']);
          else if(isset($_SESSION['signOutSuccess']))
            echo htmlspecialchars($_SESSION['signOutSuccess']);
        ?>">
        <i class="bi bi-bell fa-lg"></i>
      </li>

    </ul>
  </div>
</nav>

<div class="container main-cont">
  
  <div class="create-post">

  </div>
  <div class="posts">
    <div class="row my-3">
      <div class="col-md-8 offset-md-2">
        <div class="card" style="width: 100%;">
          <img class="card-img-top" src="images/loginbg.jpg" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
    </div>

    <div class="row my-3">
      <div class="col-md-8 offset-md-2">
        <div class="card" style="width: 100%;">
          <img class="card-img-top" src="images/loginbg.jpg" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
    </div>

    <div class="row my-3">
      <div class="col-md-8 offset-md-2">
        <div class="card" style="width: 100%;">
          <img class="card-img-top" src="images/loginbg.jpg" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<?php
    include "includes/footer.php";
    unset($_SESSION['signUpSuccess']);
    unset($_SESSION['signInSuccess']);
    unset($_SESSION['signOutSuccess']);
?>
      


