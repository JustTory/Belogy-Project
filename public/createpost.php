<?php
    include "includes/header.php";
    include "includes/nav.php";
    include "func/postFunc.php";
    include "func/imgFunc.php";
    checkSignedInOnCreatePost();
    $errorsPost = [];
    createPost($conn, $errorsPost, $title, $content);
?>

<div class="loading-logo d-none">
    <img src="image.php?loadinglogo" alt="">
</div>

<div class="container main-cont">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h5>Create a post</h5>
            <form class="mt-4" action="createpost.php" method="post" enctype="multipart/form-data">

                <input type="text" name="title" id="inputTitle" class="form-control <?php
                    if(isset($errorsPost['title'])) echo htmlspecialchars("border-error");
                ?>" placeholder="Title" value="<?php
                    if (isset($title)) echo htmlspecialchars($title);
                ?>">
                <p class="m-0 error-msg" id="errorTitle"><?php
                    if(isset($errorsPost['title'])) echo htmlspecialchars($errorsPost['title']);
                    ?>
                </p>

                <textarea name="content" id="inputContent" class="form-control mt-2 <?php
                    if(isset($errorsPost['content'])) echo htmlspecialchars("border-error");
                ?>" placeholder="Content" rows="8" cols="80"><?php
                    if (isset($content)) echo htmlspecialchars($content);
                ?></textarea>
                <p class="m-0 error-msg" id="errorContent"><?php
                    if(isset($errorsPost['content'])) echo htmlspecialchars($errorsPost['content']);
                    ?>
                </p>

                <div class="custom-file mt-2">
                    <input type="file" accept="image/jpeg, image/png, image/gif, image/webp" name="image" id="inputFile" class="custom-file-input">
                    <label class="custom-file-label" for="customFile">Choose image</label>
                </div>
                <p class="m-0 error-msg" id="errorFile"><?php
                    if(isset($errorsPost['file'])) echo htmlspecialchars($errorsPost['file']);
                    ?>
                </p>

                <button type="submit" name="submit" class="btn btn-outline-dark btn-block mt-5 async-task"><i class="bi bi-pencil-square"></i> Post</button>
            </form>
        </div>
    </div>
</div>

<?php
    include "includes/footer.php";
    unsetNotification();
?>