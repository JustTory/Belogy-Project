<?php
    include "includes/header.php";
    include "includes/nav.php";
    include "func/postFunc.php";
    include "func/imgFunc.php";
    checkSignedInOnCreatePost();
    $errorsPost = [];
    createPost($conn, $errorsPost);
?>

<div class="container main-cont">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h5>Create a post</h5>
            <form class="" action="createpost.php" method="post" enctype="multipart/form-data">
                <input type="text" name="title" class="form-control" placeholder="Title" value="">
                <textarea name="content" class="form-control" placeholder="Content" rows="8" cols="80"></textarea>
                <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
                <button type="submit" name="submit" class="btn btn-outline-dark btn-block"> <i class="fas fa-edit"></i>Post</button>
            </form>
        </div>
    </div>
</div>

<?php
    include "includes/footer.php";
    unsetNotification();   
?>