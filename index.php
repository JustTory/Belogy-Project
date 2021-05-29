<?php
    include "includes/header.php";
    include "includes/nav.php";
    include "func/postFunc.php";
    directToCreatePost();
?>

<div class="container main-cont">
  <div class="create-post">
    <div class="row my-3">
      <div class="col-md-8 offset-md-2">
        <div class="card">
          <div class="card-body">
            <div class="create-form d-flex">
              <div class="avatar-wrapper d-flex justify-content-center align-items-center">
                <img class="avatar mr-3" src="images\defaultUserAvatar.png" alt="">
              </div>
              <form class="w-100 form-create" method="post" action="index.php">
                <div class="form-group m-0">
                  <input type="text" type="submit" name="createpost" class="form-control input-create" placeholder="<?php
                    if($_SESSION['signedIn'] == true) {
                      echo htmlspecialchars($_SESSION['username']) . ", t";
                    } else echo "T";
                  ?>ell us what are you up to?">
                </div>
              </form>
              <form method="post" action="index.php" class="embedded d-flex justify-content-center align-items-center">
                <button type="submit" name="createpost" id="embedded-btn" class="text-dark input-create p-0"><i class="bi bi-image fa-lg mx-2"></i></button>
                <button type="submit" name="createpost" id="embedded-btn" class="text-dark input-create p-0"><i class="bi bi-link-45deg fa-lg"></i></button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="posts">

    <div class="row my-3">
      <div class="col-md-8 offset-md-2">
        <div class="card post">
          <img class="card-img-top post-img" src="images/loginbg.jpg" alt="Card image cap">
          <div class="card-body post-body pb-2">
            <h5 class="card-title post-title">Card title</h5>
            <p class="card-text post-content">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <div class="author-date d-flex">
              <a class="text-dark font-weight-bold" href="#">
                <img class="avatar mr-2" src="images\default\defaultUserAvatar.png" alt="">
                <?php echo htmlspecialchars("Author") ?>
              </a>
              <p class="font-weight-light my-2 post-info ml-auto">14 hours ago</p>
            </div>
            <div class="no-like-cmt d-flex mt-2">
              <p class="post-info mb-0 mr-3"><i class="bi bi-hand-thumbs-up-fill text-primary"></i> 25</p>
              <p class="post-info mb-0"><i class="bi bi-chat-left-fill text-secondary"></i> 8</p>
            </div>
            <hr class="mb-2">
            <div class="interaction">
              <div class="row">
                <a class="text-dark col-md-6 text-center" href="#">
                  <i class="bi bi-hand-thumbs-up"></i>
                  Like   
                </a> 
                <a class="text-dark col-md-6 text-center" href="#">
                  <i class="bi bi-chat-left"></i>
                  Comment     
                </a> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row my-3">
      <div class="col-md-8 offset-md-2">
        <div class="card post">
          <img class="card-img-top post-img" src="images/loginbg.jpg" alt="Card image cap">
          <div class="card-body post-body pb-2">
            <h5 class="card-title post-title">Card title</h5>
            <p class="card-text post-content">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <div class="author-date d-flex">
              <a class="text-dark font-weight-bold" href="#">
                <img class="avatar mr-2" src="images\default\defaultUserAvatar.png" alt="">
                <?php echo htmlspecialchars("Author") ?>
              </a>
              <p class="font-weight-light my-2 post-info ml-auto">14 hours ago</p>
            </div>
            <div class="no-like-cmt d-flex mt-2">
              <p class="post-info mb-0 mr-3"><i class="bi bi-hand-thumbs-up-fill text-primary"></i> 25</p>
              <p class="post-info mb-0"><i class="bi bi-chat-left-fill text-secondary"></i> 8</p>
            </div>
            <hr class="mb-2">
            <div class="interaction">
              <div class="row">
                <a class="text-dark col-md-6 text-center" href="#">
                  <i class="bi bi-hand-thumbs-up"></i>
                  Like   
                </a> 
                <a class="text-dark col-md-6 text-center" href="#">
                  <i class="bi bi-chat-left"></i>
                  Comment     
                </a> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row my-3">
      <div class="col-md-8 offset-md-2">
        <div class="card post">
          <img class="card-img-top post-img" src="images/loginbg.jpg" alt="Card image cap">
          <div class="card-body post-body pb-2">
            <h5 class="card-title post-title">Card title</h5>
            <p class="card-text post-content">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <div class="author-date d-flex">
              <a class="text-dark font-weight-bold" href="#">
                <img class="avatar mr-2" src="images\default\defaultUserAvatar.png" alt="">
                <?php echo htmlspecialchars("Author") ?>
              </a>
              <p class="font-weight-light my-2 post-info ml-auto">14 hours ago</p>
            </div>
            <div class="no-like-cmt d-flex mt-2">
              <p class="post-info mb-0 mr-3"><i class="bi bi-hand-thumbs-up-fill text-primary"></i> 25</p>
              <p class="post-info mb-0"><i class="bi bi-chat-left-fill text-secondary"></i> 8</p>
            </div>
            <hr class="mb-2">
            <div class="interaction">
              <div class="row">
                <a class="text-dark col-md-6 text-center" href="#">
                  <i class="bi bi-hand-thumbs-up"></i>
                  Like   
                </a> 
                <a class="text-dark col-md-6 text-center" href="#">
                  <i class="bi bi-chat-left"></i>
                  Comment     
                </a> 
              </div>
            </div>
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
    unset($_SESSION['notSignedInOnCreatePost']);
?>
      


