<?php
    function allowedImgSize($imgSize) {
        if($imgSize > 2000000) return false;
        else return true;
    }

    function allowedImgExt($imgType) {
        if($imgType[0] != 'image') return false;
        else {
            $imgExt = end($imgType);
            $allowedImgExt = ['png','jpeg', 'jpg', 'gif'];
            if(!in_array($imgExt, $allowedImgExt)) return false;
            else return true;
        }
    }
?>