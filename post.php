<?php
    include "includes/header.php";
    include "includes/nav.php";
    include "func/postFunc.php";
    $post = getPost($conn);
    var_dump($post);
    
?>

<div class="container main-cont">
    <div class="row my-3">
        <div class="col-md-8 offset-md-2">
            <div class="card post">
                <?php if ($post['post_img_url'] != null): ?>
                    <img class="card-img-top post-img" src="<?php echo htmlspecialchars($post['post_img_url']);?>" alt="Post image">
                <?php endif; ?>
                <div class="card-body post-body pb-2">

                    <h5 class="card-title post-title"><?php echo htmlspecialchars($post['post_title']);?></h5>
                    <p class="card-text post-content"><?php echo htmlspecialchars($post['post_content']);?></p>
                    <div class="author-date d-flex">
                        <a class="text-dark font-weight-bold" href="#">
                            <img class="avatar mr-2" src="images\default\defaultUserAvatar.png" alt="">
                            <?php echo htmlspecialchars($post['user_username']) ?>
                        </a>
                        <p class="font-weight-light my-2 post-info ml-auto"><?php echo htmlspecialchars(outputPostDateTime($conn, $post['post_date_created']));?></p>
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

<?php
    include "includes/footer.php";
    unsetNotification();   
?>