<?php include('imageupload.php');

if($_SERVER["REQUEST_METHOD"] == "POST")
 {

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Create image instances
$dest = imagecreatefromjpeg('testimages/Frame.jpg');
$image = new SimpleImage();
$image->load($_FILES["file"]["tmp_name"]);

if($image->getWidth() > 200 && $image->getHeight() > 200 ){
    
$image->resize(710,565);
$i=dirname(__FILE__).DIRECTORY_SEPARATOR.'testimages'.DIRECTORY_SEPARATOR.'resize_'.$_FILES["file"]["name"];
$image->save($i);
$srcimg = new SimpleImage();
$srcimg->load($i);
// Copy and merge
imagecopymerge($dest, $srcimg->image, 150, 150, 0, 0, $srcimg->getWidth(), $srcimg->getHeight(), 70);

// Output and free from memory
//header('Content-Type: image/jpeg');
$timestamp = 'frame_'.time().$_FILES["file"]["name"];
imagejpeg($dest,dirname(__FILE__).DIRECTORY_SEPARATOR.'testimages'.DIRECTORY_SEPARATOR.$timestamp);
saveoption($_SESSION["userid"],$_POST["optionchosen"],$timestamp);
imagedestroy($dest);
imagedestroy($srcimg->image);

}
else{
    echo "Please upload image of size more than 200X200";
}
 }
?>


