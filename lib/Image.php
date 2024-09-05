<?php

namespace lib;

class Image {

    public static function save($file, $path) {
        if ($file['type'] == 'image/png') {
            $imageObject = imagecreatefrompng($file['tmp_name']);
        }
    
        if ($file['type'] == 'image/jpeg') {
            $imageObject = imagecreatefromjpeg($file['tmp_name']);
        }

        if (!$imageObject) {
            return;
        }
    
        //$imageSize = getimagesize($file['tmp_name']);
    
        $quality = 100 / $file['size'];
    
        return imagejpeg($imageObject, $path, $quality);
    }
}
