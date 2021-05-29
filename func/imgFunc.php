<?php
    function uploadIMG() {
        
    }

    function allowedImgSize($imgSize) {
        if($imgSize > 2000000) return false;
        else return true;
    }

    function allowedImgExt($imgExt) {
        $allowedImgExt = ['png','jpeg', 'jpg', 'gif'];
        if(!in_array($imgExt, $allowedImgExt)) return false;
        else return true;
    }
?>