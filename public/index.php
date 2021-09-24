<!-- TO DO LIST
  - retain title and content value when click on edit post button
  - debugging and fixing
-->

<?php
    include "includes/header.php";
    include "func/postFunc.php";
    directToCreatePost();
    include "includes/nav.php";
    include "func/timeFunc.php";
    $postList = getPostList($conn, 8);
?>

<div class="loading-logo d-none">
    <img src="image.php?loadinglogo" alt="">
</div>

<div class="container main-cont">
  <div class="create-post">
    <div class="row my-3">
      <div class="col-md-8 offset-md-2">
        <div class="card">
          <div class="card-body">
            <div class="create-form d-flex">
              <div class="avatar-wrapper d-flex justify-content-center align-items-center">
                <img class="avatar mr-3" src="image.php?<?php
                if($_SESSION['signedIn'] == true)
                  echo htmlspecialchars("userID=") . htmlspecialchars($_SESSION['userID']);
                else echo htmlspecialchars("defaultAvatar")?>&avatar" alt="">
              </div>
              <form class="w-100 form-create" method="post" action="index.php">
                <div class="form-group m-0">
                  <input type="text" name="createpost" class="form-control input-create async-task" placeholder="<?php
                    if($_SESSION['signedIn'] == true) {
                      echo htmlspecialchars($_SESSION['username']) . ", h";
                    } else echo htmlspecialchars("H");
                  ?>ow are you doing today?">
                </div>
              </form>
              <form method="post" action="index.php" class="embedded d-flex justify-content-center align-items-center">
                <button type="submit" name="createpost" id="embedded-btn" class="text-dark input-create async-task p-0"><i class="bi bi-image fa-lg mx-2"></i></button>
                <button type="submit" name="createpost" id="embedded-btn" class="text-dark input-create async-task p-0"><i class="bi bi-link-45deg fa-lg"></i></button>
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

      foreach ($postList as $post) {
        echo '<h5>PostID: ' . $post['post_ID']. '</h5>';
        echo '<h5>Title: ' . $post['post_title'] . ' (' . outputContentDateTime($conn, $post['post_date_created']) . ')</h5>';
        echo '<h5>Author: [' . $post['post_author_ID'] . '], ' . $post['user_role']. ', ' . $post['user_username'] . '</h5>';
        echo '<p>Likes: ' . $post['post_no_likes'] . '</p>';
        echo '<p>Comments: ' . $post['post_no_comments'] . '</p>';
        echo '<img class="card-img-top post-img" src="image.php?postID=' . $post['post_ID'] . '" alt="Post image">';
      }
    ?>

  </div>

  <div class="row my-3 mt-5 loading">
    <div class="col-md-8 offset-md-2 d-flex justify-content-center">
      <img src="image.php?loadinggif" width="35px" alt="">
    </div>
  </div>

</div>

<?php
    include "includes/footer.php";
    unsetNotification();
?>