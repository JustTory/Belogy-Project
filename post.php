<?php
    include "includes/header.php";
    include "includes/nav.php";
    include "func/postFunc.php";
    $post = getPost($conn);
    var_dump($_SESSION);
?>

<div class="container main-cont">
    <?php
        outputPost($conn, $post, "echo");
    ?>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="create-comment d-flex">
                <div class="avatar-wrapper">
                    <img class="avatar-post mr-3" src="images\default\defaultUserAvatar.png" alt="">
                </div>
                <form class="comment-form w-100" method="POST" action="createcomment.php">
                    <textarea class="form-control comment" name="comment" id="exampleFormControlTextarea1" value="" placeholder="Write a comment..." rows="3"></textarea>
                    <div class="btn-wrapper d-flex justify-content-end">
                        <button class="btn btn-secondary mt-2" name="comment-submit" type="submit"><i class="bi bi-chat-left"></i> Comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <hr>

    <div class="comments">

        <div class="row my-2">
            <div class="col-md-8 offset-md-2">
                <div class="create-comment card">
                    <div class="user-cmt-info d-flex">
                        <a class="text-dark font-weight-bold d-flex align-items-center" href="profile.php?id=">
                            <img class="avatar-post mr-2" src="images\default\defaultUserAvatar.png" alt="">User
                        </a>
                        <p class="font-weight-light my-2 post-info ml-auto">16 minutes ago</p>
                    </div>
                    <p class="mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit harum facilis aliquid minus fugit inventore ex eius, voluptatem dicta ut neque pariatur possimus quisquam quod amet laudantium laboriosam! Inventore, esse.</p>
                </div>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-8 offset-md-2">
                <div class="create-comment card">
                    <div class="user-cmt-info d-flex">
                        <a class="text-dark font-weight-bold d-flex align-items-center" href="profile.php?id=">
                            <img class="avatar-post mr-2" src="images\default\defaultUserAvatar.png" alt="">User
                        </a>
                        <p class="font-weight-light my-2 post-info ml-auto">16 minutes ago</p>
                    </div>
                    <p class="mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit harum facilis aliquid minus fugit inventore ex eius, voluptatem dicta ut neque pariatur possimus quisquam quod amet laudantium laboriosam! Inventore, esse.</p>
                </div>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-8 offset-md-2">
                <div class="create-comment card">
                    <div class="user-cmt-info d-flex">
                        <a class="text-dark font-weight-bold d-flex align-items-center" href="profile.php?id=">
                            <img class="avatar-post mr-2" src="images\default\defaultUserAvatar.png" alt="">User
                        </a>
                        <p class="font-weight-light my-2 post-info ml-auto">16 minutes ago</p>
                    </div>
                    <p class="mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit harum facilis aliquid minus fugit inventore ex eius, voluptatem dicta ut neque pariatur possimus quisquam quod amet laudantium laboriosam! Inventore, esse.</p>
                </div>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-8 offset-md-2">
                <div class="create-comment card">
                    <div class="user-cmt-info d-flex">
                        <a class="text-dark font-weight-bold d-flex align-items-center" href="profile.php?id=">
                            <img class="avatar-post mr-2" src="images\default\defaultUserAvatar.png" alt="">User
                        </a>
                        <p class="font-weight-light my-2 post-info ml-auto">16 minutes ago</p>
                    </div>
                    <p class="mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit harum facilis aliquid minus fugit inventore ex eius, voluptatem dicta ut neque pariatur possimus quisquam quod amet laudantium laboriosam! Inventore, esse.</p>
                </div>
            </div>
        </div>

    </div>

  

</div>

<?php
include "includes/footer.php";
unsetNotification();
?>