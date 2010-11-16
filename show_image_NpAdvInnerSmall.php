<?php
/**
 * show_image_.php
 * 
 * Utility file for dynamically resizing and cropping images with Viva Thumbs
 * @author      Tim Waddell
 * @version     4.1
 */
 
$filesuffix='NpAdvInnerSmall'; //The last part of this file name - ie. the name of this manipulation file that you enter in a Viva call.

$newwidth=74;  //The thumbnail width
$newheight=50;  //The thumbnail height
$caching=1; // File caching on/off - saves server resources and improves page loading speed. (Set to 1 after testing your crop and resize settings)

$jpgcompression=80; //JPG compression setting default is 80% used for display and save
$reflect=0; //reflection on or off  - 1 = on, 0 = off
$reflectheight=40; //height in pixels of the reflection
$border=1;  //Border on or off   - true or false (Only works if reflection is set to 1 ( you can set reflection to 0 to have no relfection depth)
$intellicrop=1; //Intelligent cropping on or off - 1 = On, 0 = off - OFF means the image is cropped from the very top not the logical centre

$onlyresize=0; //dont crop just resize the image. This preserves the original image means only newwidth or newheight attribute is used to keep image in proportion
$onlywhat="height"; //If onlyresize is ON (1) then you must say which dimension to use w or h (width or height)

$uploadspath="wp-content/uploads"; //edit this to your folder path from blog root to where WP stores your uploads (most users can leave this as is)
$cachepath="cache";  //This is the folder under the above folder that will store the image thumbnails Viva creates.


//Don't Edit below This Line


$relation=(($newheight/$newwidth)*2);
if ($relation==2) {$relation=1;}
$reflectheightb=(($reflectheight/100)*90);
$thub=$_GET['filename'];
$pid=$_GET['pid'];
$cache=$_GET['cache'];
$cat=$_GET['cat'];
if ($thub!=''){
$thum=$uploadspath.'/'.$thub;
}
else {
$thum=$_GET['filename'];
}
   $ext=end(explode('.',$thum));
if ($ext =="tiff" || $ext =="bmp")
 { $thum = $uploadspath.'/'.$cat.'.jpg';}
 
        //check to see if file exists
        if(!file_exists($thum)) {
            $thum = $uploadspath.'/'.$cat.'.jpg';

        }		
		      //check to see if file is readable
        elseif(!is_readable($thum)) {
 $thum = $uploadspath.'/'.$cat.'.jpg';
        }    
		
					if(!file_exists($thum)) {
            $thum = $uploadspath.'/1.jpg';
			$onlyresize=1;
			 $onlywhat="w";

        }	  
		        elseif(!is_readable($thum)) {
 $thum = $uploadspath.'/1.jpg';
 $onlyresize=1;
 $onlywhat="w";
        }   
		
if ($border==1) {$border=true; } else {$border=false;}

if ($onlyresize==0) {
list($width,$height)=getimagesize($thum);
$resolution=$width/$height;
$resolutionb=$height/$width;

if ($newheight > $newwidth) {
$resizelimit=($newheight*1.5); 
$croptvalue=$resizelimit/(10*$relation);
$croplvalue=$resizelimit/(20/$relation);
}
if ($newwidth > $newheight) {
$resizelimit=($newwidth*1.5);
$croptvalue=$resizelimit/(6*$relation);
$croplvalue=$resizelimit/(15/$relation);
}
if ($newwidth == $newheight) {
$resizelimit=($newheight*($relation*1.5));
$croptvalue=$resizelimit/(8/$relation);
$croplvalue=$resizelimit/(10/$relation);
}

$maxheight=$resizelimit;
$maxwidth=$resizelimit;


if ($resolution>1.329 || $resolution <0.751) {
if ($width > $height) {
$maxheight=0; 
 }
else {
if ($height > $width) 
{
$maxwidth=0; 
}
}
}
else{
if (($resolution<1.329) AND ($resolution >0.751))  {
 $maxheight=0; 
}
}
if ($intellicrop==0) { $croptvalue=(($newheight/100)*15); }

include_once('viva.inc.php');
$thumb = new Thumbnail($thum,$cat);
$thumb->resize($maxwidth,$maxheight);
$thumb->crop($croplvalue,$croptvalue,$newwidth,$newheight);
}
else {
include_once('viva.inc.php');
$thumb = new Thumbnail($thum,$cat);
if ($onlywhat=="w" || $onlywhat=="width") {
$thumb->resize($newwidth,0);
} else {
$thumb->resize(0,$newheight);
}
} 
if ($reflect==1) {
$thumb->createReflection($reflectheightb,$reflectheight,90,$border,'#a4a4a4');
}
$thumb->show($jpgcompression);
if ($caching==1) {
if ($cache!="true") {
$thumb->save($uploadspath.'/'.$cachepath.'/'.$pid.'_'.$filesuffix.'.jpg',$jpgcompression);
}
else
 {
 if (file_exists($uploadspath.'/'.$cat.'.jpg')) 
$thumb->save($uploadspath.'/'.$cachepath.'/cat'.$cat.'_'.$filesuffix.'.jpg',$jpgcompression); 
}
}
$thumb->destruct();
?>