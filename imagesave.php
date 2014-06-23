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
header('Content-Type: image/jpeg');
imagejpeg($dest);
imagedestroy($dest);
imagedestroy($srcimg->image);

}
else{
    echo "Please upload image of size more than 200X200";
}
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<title>Insert Movie</title> 
</head>
<body>
    <form method="post" action="" enctype="multipart/form-data" name="insert" class="cls_insert" >
        <input type="file" name="file" id="imgfile" class="inp cls_uplimg"  />
        <input type="submit" name="submit" value="Submit" class="cls_submit" />
    </form>
</body>
</html>

