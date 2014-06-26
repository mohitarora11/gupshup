<?php
include_once('imageupload.php');
include_once('sql.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    // Create image instances
    $dest  = imagecreatefrompng('images/img.png');
    $image = new SimpleImage();
    $image->load($_FILES["file"]["tmp_name"]);
    if ($image->getWidth() > 200 && $image->getHeight() > 200) {
        $resizedphotourl = 'resize_' . time() . $_FILES["file"]["name"];
        $image->resize(210, 210);
        $i = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'resizedimages' . DIRECTORY_SEPARATOR . $resizedphotourl;
        $image->save($i);
        $srcimg = new SimpleImage();
        $srcimg->load($i);
        // Copy and merge
        imagecopymerge($dest, $srcimg->image, 21, 21, 0, 0, $srcimg->getWidth(), $srcimg->getHeight(), 100);
        // Output and free from memory
        //header('Content-Type: image/jpeg');
        $framephotourl = 'frame_' . time() . $_FILES["file"]["name"];
        imagejpeg($dest, dirname(__FILE__) . DIRECTORY_SEPARATOR . 'resizedimages' . DIRECTORY_SEPARATOR . $framephotourl);
        saveoption($_SESSION["userid"], $_POST["optionchosen"], $framephotourl, $resizedphotourl);
        savestatus($_SESSION["userid"], 1);
        imagedestroy($dest);
        imagedestroy($srcimg->image);
    } else {
        echo "Please upload image of size more than 200X200";
    }
}