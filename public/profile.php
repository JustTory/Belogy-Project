<?php
    include "includes/header.php";
    include "func/postFunc.php";
    directToCreatePost();
    include "includes/nav.php";
    include "func/timeFunc.php";
    include "func/userFunc.php";
    include "func/imgFunc.php";
    $errorsEdit = [];
    if(isset($_GET['id']))
        $postList = getUserPostList($conn, $_GET['id'], 5);
    editProfile($conn, $errorsEdit);
    mapErrorsToSession($errorsEdit);
?>

<div class="loading-logo d-none">
    <img src="image.php?loadinglogo" alt="">
</div>

<div class="container main-cont">
    <?php
        outputProfile($conn);
    ?>

    <div class="posts">
        <?php
            outputPostList($conn, $postList);
        ?>

    </div>

    <div class="row my-3 mt-5 loading">
        <div class="col-md-8 offset-md-2 d-flex justify-content-center">
            <img src="image.php?loadinggif" width="35px" alt="">
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade show" id="add-coverbg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add background cover</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="profile.php?id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="custom-file my-3">
                            <input type="file" accept="image/jpeg, image/png, image/gif, image/webp" name="new-image" class="custom-file-input" id="inputFile">
                            <label class="custom-file-label" for="customFile">Choose background cover</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit-new-coverbg" value="add-coverbg" class="async-task btn btn-primary btn-sm">Add background</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade show" id="edit-coverbg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit background cover</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="profile.php?id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="custom-file my-3">
                            <input type="file" accept="image/jpeg, image/png, image/gif, image/webp" name="new-image" class="custom-file-input" id="inputFile">
                            <label class="custom-file-label" for="customFile">Choose new background cover</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="button" name="submit-delete-post" class="btn btn-danger btn-sm" data-dismiss="modal" data-toggle="modal" data-target="#delete-coverbg">Delete</button>
                        <button type="submit" name="submit-new-coverbg" value="edit-coverbg" class="async-task btn btn-primary btn-sm">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete-coverbg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete background cover</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="profile.php?id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <h6 class="my-3">Are you sure you want to delete this background cover?</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit-delete-coverbg" class="async-task btn btn-danger btn-sm">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade show" id="add-avatar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add avatar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="profile.php?id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="custom-file my-3">
                            <input type="file" accept="image/jpeg, image/png, image/gif, image/webp" name="new-image" class="custom-file-input" id="inputFile">
                            <label class="custom-file-label" for="customFile">Choose avatar</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit-new-avatar" value="add-avatar" class="async-task btn btn-primary btn-sm">Add avatar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade show" id="edit-avatar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit avatar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="profile.php?id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="custom-file my-3">
                            <input type="file" accept="image/jpeg, image/png, image/gif, image/webp" name="new-image" class="custom-file-input" id="inputFile">
                            <label class="custom-file-label" for="customFile">Choose new avatar</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="button" name="submit-delete-post" class="btn btn-danger btn-sm" data-dismiss="modal" data-toggle="modal" data-target="#delete-avatar">Delete</button>
                        <button type="submit" name="submit-new-avatar" value="edit-avatar" class="async-task btn btn-primary btn-sm">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete-avatar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete avatar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="profile.php?id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <h6 class="my-3">Are you sure you want to delete this avatar?</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit-delete-avatar" class="async-task btn btn-danger btn-sm">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-bio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit bio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="profile.php?id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <textarea name="bio" class="form-control my-3" placeholder="New bio" rows="8" cols="80"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit-edit-bio" class="async-task btn btn-primary btn-sm">Edit bio</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<?php
    include "includes/footer.php";
    unsetNotification();
?>