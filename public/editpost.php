<?php
    include "includes/header.php";
    include "includes/nav.php";
    include "func/postFunc.php";
    include "func/timeFunc.php";
    include "func/imgFunc.php";
    checkSignedInOnPost();
    $errorsEdit = [];
    $post = getPost($conn);
    editPost($conn, $errorsEdit);
    mapErrorsToSession($errorsEdit);
?>

<div class="container main-cont">
    <?php
        outputPostEdit($conn, $post);
    ?>
    <div class="row my-3 mt-5 delete-post">
        <div class="col-md-8 offset-md-2 d-flex justify-content-center">
            <button type="button" class="btn btn-danger">
            <i class="bi bi-trash"></i>
            Delete post</button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade show" id="add-img" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Post Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="editpost.php?id=<?php echo htmlspecialchars($post['post_ID']); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="custom-file my-3">
                            <input type="file" name="new-image" class="custom-file-input" id="inputFile">
                            <label class="custom-file-label" for="customFile">Choose image</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit-new-img" value="add-img" class="btn btn-primary">Add image</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade show" id="edit-img" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit post image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="editpost.php?id=<?php echo htmlspecialchars($post['post_ID']); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="custom-file my-3">
                            <input type="file" name="new-image" class="custom-file-input" id="inputFile">
                            <label class="custom-file-label" for="customFile">Choose new image</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit-new-img" value="edit-img" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete-img" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete post image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="editpost.php?id=<?php echo htmlspecialchars($post['post_ID']); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <h6 class="my-3">Are you sure you want to delete this post image?</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit-delete-img" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-title" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit post title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="editpost.php?id=<?php echo htmlspecialchars($post['post_ID']); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="text" name="new-title" class="form-control my-3" placeholder="New title" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit-edit-title" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-content" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit post content</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="editpost.php?id=<?php echo htmlspecialchars($post['post_ID']); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <textarea name="new-content" class="form-control my-3" placeholder="New content" rows="8" cols="80"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit-edit-content" class="btn btn-primary">Save changes</button>
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