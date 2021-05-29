<?php
    include "includes/header.php";
    include "includes/nav.php";
    include "func/postFunc.php";
    $post = getPost($conn);
?>

<div class="container main-cont">
    <?php
        outputPost($conn, $post);
    ?>
</div>

<?php
    include "includes/footer.php";
    unsetNotification();   
?>