<!-- TO DO LIST
  - delete posts (admin role)
  - edit or delete own post (user role)
  - fix infinite scrolling in index (when ending div is on screen, triggers ajax)
  - add infinite scrolling to comments / if cannot add load more comments button to trigger ajax
  - fix createpost UI
  - likable posts at index
  - profile.php
  - debugging and fixing

  - index: new signed up users table on the right 
  - notification when someone comments or likes your post 
-->

<?php
    include "includes/header.php";
    include "includes/nav.php";
    include "func/postFunc.php";
    include "func/timeFunc.php";
    directToCreatePost();
    $postList = getPostList($conn, 5);
?>

<div class="container main-cont">
  <div class="create-post">
    <div class="row my-3">
      <div class="col-md-8 offset-md-2">
        <div class="card">
          <div class="card-body">
            <div class="create-form d-flex">
              <div class="avatar-wrapper d-flex justify-content-center align-items-center">
                <img class="avatar mr-3" src="images\default\defaultUserAvatar.png" alt="">
              </div>
              <form class="w-100 form-create" method="post" action="index.php">
                <div class="form-group m-0">
                  <input type="text" type="submit" name="createpost" class="form-control input-create" placeholder="<?php
                    if($_SESSION['signedIn'] == true) {
                      echo htmlspecialchars($_SESSION['username']) . ", h";
                    } else echo htmlspecialchars("H");
                  ?>ow are you doing today?">
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
    <?php
      outputPostList($conn, $postList);
    ?>

  </div>

  <div class="row my-3 mt-5 loading">
    <div class="col-md-8 offset-md-2 d-flex justify-content-center">
      <img src="images/default/loading.gif" width="35px" alt="">
    </div>
  </div>

</div>

<?php
    include "includes/footer.php";
    unsetNotification();       
?>
      


