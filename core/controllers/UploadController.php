<?php

/**
 * Created by PhpStorm.
 * User: david
 * Date: 29/10/2016
 * Time: 3:25
 */
class UploadController
{
    const dirUpload = 'C:/xampp/htdocs/photoapp/photos/';

    public static function uploadImage($fileName)
    {
        $baseName = basename($_FILES[$fileName]['name']);
        $targetFile = self::dirUpload . $baseName;

        if (move_uploaded_file($_FILES[$fileName]['tmp_name'], $targetFile)) {
            return $baseName;
        }

        return null;
    }
}