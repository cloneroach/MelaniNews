<?php
/*
Plugin Name: Viva Thumb-Zoom
Plugin URI: http://mediatricks.biz/zoom
Description: Using the power of Viva theme thumbnails are created automatically from images linked to posts (or image paths specified by you.) Click on a thumbnail and it zooms out to a full size image - again resampled by Viva to improve page loading time. You've gotta love Viva Thumb Zoom!
Author: Tim Waddell
Version: 2.0
Author URI: http://mediatricks.biz/
This plugin is coyright 2008 Mediatricks.biz can only be used as per the licenses detaield at http://www.mediatricks.biz/faq/

##########################################################################################################
#                                                                                                        #
#     Usage: There are three ways to insert the Viva Thumb Zoom call into your theme code:               #
#                                                                                                        #
#     1. Inside The WP Loop - Thumbnail drawn from the post that links to a zooming full size image.     #
#                                                                                                        #
#      <?php vz_inloop($processor-file,$default-cat,$Read-more-text); ?>   // Edit the variables         #
#                                                                                                        #
#     2. Outside The WP Loop - Thumb provided by an image url that links to a zooming full size image3   #
#                                                                                                        #
#     <?php vz_noloop($processor-file,$url,$nameid,$alt,$caption); ?>  // Edit the variables             #
#                                                                                                        #
#     3. In Loop Thumb Only. (No Zoom) Generates thumbnails from the first image uploaded with a post.   #
#                                                                                                        #
#     <img src="<?php viva($processor-file,$default-category); ?>" />  // Edit the variables             #
#                                                                                                        #
#                                                                                                        #
#     For more details on the above formats check the tutorial documnet included in the download pack.   #
#                                                                                                        #
##########################################################################################################
*/


/* Assign Global Variables. Edit the lines below to set your temporary and final image folders.
All folders must be CHMOD 777 (Writable)

----- The default values will work for most people. Change carefully! ------

*/
$rootpath=get_option(siteurl);
//Example for non standard installation:  $rootpath=get_option(siteurl)."/mywpfiles";

$uploadspath="wp-content/uploads"; //Your folder path from blog root where WP stores your uploads (most users can leave this as is)
$cachepath="cache";  //This is a folder inside the above folder that will store the image thumbnails Viva creates.

//  NOTHING MORE TO EDIT  //

/*###################################################################################################################################*/

/* VivaZoom function for generating the <A> tag image location. */

function vivazoom($ending,$categ) {
global $wpdb, $post, $uploadspath,$cachepath,$rootpath ;

$thumbt=get_post_meta($post->ID, "thumbnail", true);
$pID=$post->ID;
$ending = $ending;
$categ=$categ;
if ($categ=="") {
$categories = (array) get_the_category();
$thelist = '';
foreach($categories as $category) {
$thelist = $category->cat_ID;
   }
$categ=$thelist;
}


$attachment_id = $wpdb->get_var("SELECT guid FROM $wpdb->posts WHERE post_parent = '$pID' AND post_type='attachment' AND (post_mime_type='image/jpeg' OR post_mime_type='image/gif' OR post_mime_type='image/png') ORDER BY post_date ASC LIMIT 1");
$attachm= split($uploadspath,$attachment_id);
$attachm=$attachm[1];

$thumbt=$thumbt;

$catcache="false";
if ($thumbt=="" AND $attachm=="")
{
$filename=$rootpath.'/'.$uploadspath.'/'.$cachepath.'/cat'.$categ.'_'.$ending.'.jpg';
$catcache="true";
}


if ($thumbt!="" OR $attachm!="" )
{
$filename=$rootpath.'/'.$uploadspath.'/'.$cachepath.'/'.$pID.'_'.$ending.'.jpg';
 }



$filepath=split($uploadspath,$filename);
$filepath=$filepath[1];
$filepath=$uploadspath.$filepath;


  if(!file_exists($filepath)) {
$cached=0;

if($thumbt =="") {
$thumbt=$attachm; }


$attachpath=$uploadspath.$thumbt;


if(!file_exists($attachpath))
	{
$catcache="true";
$catpath=$uploadspath.'/'.$cachepath.'/cat'.$categ.'_'.$ending.'.jpg';

if(!file_exists($catpath)) {

}

else {
$thesrc=$rootpath.'/'.$uploadspath.'/'.$cachepath.'/cat'.$categ.'_'.$ending.'.jpg';
$cached='1';
}

}


if ($cached!='1'){
$thesrc="$rootpath/show_image_$ending.php?filename=$thumbt&amp;cat=$categ&amp;pid=$pID&amp;cache=$catcache";
}
echo $thesrc;

 }



else {
 echo $filename;
}
}//end function


/* VZ_inloop function for generating a Viva Zoom popup from and image within the loop using the db info for linked images. */

function vz_inloop($ending,$categ,$more) {
global $wpdb, $post, $rootpath, $uploadspath, $cachepath;

$thumbt=get_post_meta($post->ID, "thumbnail", true);
$pID=$post->ID;
$ending = $ending;
$categ = $categ;
if ($categ=="") {
$categories = (array) get_the_category();
$thelist = '';
foreach($categories as $category) {
$thelist = $category->cat_ID;
   }
$categ=$thelist;
}
$attachment_id = $wpdb->get_var("SELECT guid FROM $wpdb->posts WHERE post_parent = '$pID' AND post_type='attachment' AND (post_mime_type='image/jpeg' OR post_mime_type='image/gif' OR post_mime_type='image/png') ORDER BY post_date ASC LIMIT 1");
$attachm= split($uploadspath,$attachment_id);
$attachm=$attachm[1];

$cap_id = $wpdb->get_var("SELECT post_excerpt FROM $wpdb->posts WHERE post_parent = '$pID' AND post_type='attachment' AND (post_mime_type ='image/gif' OR post_mime_type ='image/jpeg')  ORDER BY post_date ASC LIMIT 1");

$desc_id = $wpdb->get_var("SELECT post_content FROM $wpdb->posts WHERE post_parent = '$pID' AND post_type='attachment' AND (post_mime_type ='image/gif' OR post_mime_type ='image/jpeg')  ORDER BY post_date ASC LIMIT 1");

$title_id = $wpdb->get_var("SELECT post_title FROM $wpdb->posts WHERE post_parent = '$pID' AND post_type='attachment' AND (post_mime_type ='image/gif' OR post_mime_type ='image/jpeg')  ORDER BY post_date ASC LIMIT 1");


$urlink=get_permalink($pID);
$art_title=$wpdb->get_var("SELECT post_title FROM $wpdb->posts WHERE ID = '$pID' ");
if ($cap_id=="") {$cap_id="<b>".$art_title."</b>"; }
if ($desc_id!="") {
$cap_id="<b>".$cap_id."</b>";
$desc_id="<br /><br />".$desc_id; }

$captiona=$cap_id.$desc_id."&nbsp;&nbsp;| <a href=\"".$urlink."\" />".$more."</a>";



$caption='<a href="'.$urlink.'" />'.$art_title.'</a>';
if ($captiona=="") {$captiona=$caption; }
$alta=$title_id;
$thumbt=$thumbt;

$catcache="false";
if ($thumbt=="" AND $attachm=="")
{
$filename=$rootpath.'/'.$uploadspath.'/'.$cachepath.'/cat'.$categ.'_'.$ending.'.jpg';
$catcache="true";
}


if ($thumbt!="" OR $attachm!="" )
{
$filename=$rootpath.'/'.$uploadspath.'/'.$cachepath.'/'.$pID.'_'.$ending.'.jpg';
 }



$filepath=split($uploadspath,$filename);
$filepath=$filepath[1];
$filepath=$uploadspath.$filepath;


  if(!file_exists($filepath)) {
$cached=0;

if($thumbt =="") {
$thumbt=$attachm; }


$attachpath=$uploadspath.$thumbt;


if(!file_exists($attachpath))
	{
$catcache="true";
$catpath=$uploadspath.'/'.$cachepath.'/cat'.$categ.'_'.$ending.'.jpg';

if(!file_exists($catpath)) {

}

else {
$thesrc=$rootpath.'/'.$uploadspath.'/'.$cachepath.'/cat'.$categ.'_'.$ending.'.jpg';
$cached='1';
}

}


if ($cached!='1'){
$thesrc="$rootpath/show_image_$ending.php?filename=$thumbt&amp;cat=$categ&amp;pid=$pID&amp;cache=$catcache";
}

 }



else {
$thesrc=$filename;
}
if ($thumbt=="") {$thumbt=$attachm; }
?>
				  <a href="<?php vivazoom(thumbzoom,''); ?>" class="highslide"  onclick="return vz.expand(this)" />

              <img src="<?php echo $thesrc; ?> " alt="<?php echo $alta; ?>" border="0"  /></a>

<div class="highslide-caption" /> <?php echo $captiona; ?> </div>

<?php
} //end function




/* Viva No Zoom Function for generating the Link <a> tag image resize. This saves server resources and page loading time. */

function vivanzoom($ending,$url,$nameid,$alt,$caption,$categ) {
global $rootpath, $uploadspath, $cachepath;

$pID=$nameid;
$thumbt=$url;
$attachm=$url;
$ending = $ending;
$categ=$categ;
$catcache="false";

if ($thumbt!="")
{
$filename=$rootpath.'/'.$uploadspath.'/'.$cachepath.'/'.$pID.'_'.$ending.'.jpg';
 }



$filepath=split($uploadspath,$filename);
$filepath=$filepath[1];
$filepath=$uploadspath.$filepath;


  if(!file_exists($filepath)) {
$cached=0;
$attachpath=$uploadspath.$thumbt;
if(!file_exists($attachpath))
	{
$catcache="true";
$catpath=$uploadspath.'/'.$cachepath.'/cat'.$categ.'_'.$ending.'.jpg';
if(!file_exists($catpath)) {
}
else {
$thesrc=$rootpath.'/'.$uploadspath.'/'.$cachepath.'/cat'.$categ.'_'.$ending.'.jpg';
$cached='1';
}

}


if ($cached!='1'){
$thesrc="$rootpath/show_image_$ending.php?filename=$thumbt&amp;cat=$categ&amp;pid=$pID&amp;cache=$catcache";
}
echo $thesrc;

 }



else {
 echo $filename;
}
}//end function


/* VZ - No Loop function for generating the POP Outs , outside of the wordpress loop by specifying an image url */

function vz_noloop($ending,$url,$nameid,$alt,$caption) {
global $rootpath, $uploadspath, $cachepath;

$pID=$nameid;
$thumbt=$url;
$attachm=$url;
$ending = $ending;
$categ="";
if ($categ=="") {
$categories = (array) get_the_category();
$thelist = '';
foreach($categories as $category) {
$thelist = $category->cat_ID;
   }
$categ=$thelist;
}
$catcache="false";
if ($thumbt=="" AND $attachm=="")
{
$filename=$rootpath.'/'.$uploadspath.'/'.$cachepath.'/cat'.$categ.'_'.$ending.'.jpg';
$catcache="true";
}


if ($thumbt!="")
{
$filename=$rootpath.'/'.$uploadspath.'/'.$cachepath.'/'.$pID.'_'.$ending.'.jpg';
 }



$filepath=split($uploadspath,$filename);
$filepath=$filepath[1];
$filepath=$uploadspath.$filepath;


  if(!file_exists($filepath)) {
$cached=0;
$thumbt=split($uploadspath,$thumbt);
$thumbt=$thumbt[1];
$attachpath=$uploadspath.$thumbt;
if(!file_exists($attachpath))
	{
$catcache="true";
$catpath=$uploadspath.'/'.$cachepath.'/cat'.$categ.'_'.$ending.'.jpg';

if(!file_exists($catpath)) {

}

else {
$thesrc=$rootpath.'/'.$uploadspath.'/'.$cachepath.'/cat'.$categ.'_'.$ending.'.jpg';
$cached='1';
}

}


if ($cached!='1'){

$thesrc="$rootpath/show_image_$ending.php?filename=$thumbt&amp;cat=$categ&amp;pid=$pID&amp;cache=$catcache";
}

 }



else {
$thumbt=split($uploadspath,$thumbt);
$thumbt=$thumbt[1];
$thesrc=$filename;
}


?>
				  <a href="<?php vivanzoom(thumbzoom,$thumbt,$nameid,$alt,$caption,$categ); ?>" class="highslide"  onclick="return vz.expand(this)" />

              <img src="<?php echo $thesrc; ?> " alt="<?php echo $alt; ?>" border="0"  /></a>

<div class="highslide-caption" /> <?php echo $caption; ?> </div>

<?php
} //end function




/* ORIGINAL VIVA THUMBS FOR  NO ZOOM USAGE   */

function viva($ending,$categ) {
global $wpdb, $post, $uploadspath, $cachepath, $rootpath;
$thumbg=get_post_meta($post->ID, "gabimage", true);

if (!$thumbg) {


$thumbt=get_post_meta($post->ID, "thumbnail", true);
$pID=$post->ID;
$ending = $ending;
$categ=$categ;

if ($categ=="") {
$categories = (array) get_the_category();
$thelist = '';
foreach($categories as $category) {
$thelist = $category->cat_ID;
   }
$categ=$thelist;
}
$attachment_id = $wpdb->get_var("SELECT guid FROM $wpdb->posts WHERE post_parent = '$pID' AND post_type='attachment' AND (post_mime_type='image/jpeg' OR post_mime_type='image/gif' OR post_mime_type='image/png') ORDER BY post_date ASC LIMIT 1");
$attachm= split($uploadspath,$attachment_id);
$attachm=$attachm[1];

$thumbt=$thumbt;

$catcache="false";
if ($thumbt=="" AND $attachm=="")
{
$filename=$rootpath.'/'.$uploadspath.'/cat'.$categ.'_'.$ending.'.jpg';
$catcache="true";
}


if ($thumbt!="" OR $attachm!="" )
{
$filename=$rootpath.'/'.$uploadspath.'/'.$cachepath.'/'.$pID.'_'.$ending.'.jpg';
 }



$filepath=split($uploadspath,$filename);
$filepath=$filepath[1];
$filepath=$uploadspath.$filepath;


  if(!file_exists($filepath)) {
$cached=0;

if($thumbt =="") {
$thumbt=$attachm; }


$attachpath=$uploadspath.$thumbt;


if(!file_exists($attachpath))
	{
$catcache="true";
$catpath=$uploadspath.'/'.$cachepath.'/cat'.$categ.'_'.$ending.'.jpg';

if(!file_exists($catpath)) {

}

else {
$thesrc=$rootpath.'/'.$uploadspath.'/'.$cachepath.'/cat'.$categ.'_'.$ending.'.jpg';
$cached='1';
}

}


if ($cached!='1'){
$thesrc="$rootpath/show_image_$ending.php?filename=$thumbt&amp;cat=$categ&amp;pid=$pID&amp;cache=$catcache";
}
echo $thesrc;

 }



else {
 echo $filename;
}

} else { echo $thumbg;}

} // end function

/* NEXT ADD THE HEADER TO INCLUDE THE VIVA ZOOM JS IN WORDPRESS PAGED */

function viva_zoom_wp_head() {

global $rootpath;

?>

<link rel="stylesheet" type="text/css" href="<?php echo $rootpath; ?>/wp-content/plugins/Viva-ThumbZoom/lib/v-zoom/viva-zoom.css"  />

				<script type='text/javascript' src='<?php echo $rootpath; ?>/wp-content/plugins/Viva-ThumbZoom/lib/v-zoom/viva-zoom-mini.js'></script>

				<script type='text/javascript'>
               // 26f2c0bd88ed1fe0be78a57439b97490
	 			vz.graphicsDir = '<?php echo $rootpath; ?>/wp-content/plugins/Viva-ThumbZoom/lib/v-zoom/graphics/';

	    		vz.outlineType = 'rounded-white';

			</script>
<?php
}// end function

// constants for adding Viva Zoom Options to ADD MEDIA WINDOW
define ('HI_TEXTDOMAIN', 'Viva-Zoom');
define ('HI_FOLDERNAME', 'Viva-Zoom');
// load translation
load_plugin_textdomain(HI_TEXTDOMAIN, PLUGINDIR . '/' . HI_FOLDERNAME);
// add highslide option to media dialog
function viva_zoom_attachment_fields_to_edit( $form_fields, $post ) {
   if(get_option('hi_enabledForDefault') == 1)
      $checkedHighslide = 'checked="checked" ';
   $my_form_fields = array(
      'highslide' => array(
         'label'     => __('Enlargement', HI_TEXTDOMAIN),
         'input'     => 'html',
         'html'      => "
            <input type='checkbox' name='highslide-{$post->ID}' id='highslide-{$post->ID}' value='1' $checkedHighslide/>
            <label for='highslide-{$post->ID}'>" . __('Use Viva Zoom Effect', HI_TEXTDOMAIN) . "</label>" )
    );
    if( $post->post_mime_type == 'image/jpeg' OR  $post->post_mime_type == 'image/gif' OR $post->post_mime_type == 'image/png' OR $post->post_mime_type == 'image/tiff')
      return array_merge( $form_fields, $my_form_fields );
    else
      return $form_fields;
}
add_filter( 'attachment_fields_to_edit', 'viva_zoom_attachment_fields_to_edit', 66, 2 );

// filter and modify html code send to editor

function viva_zoom_send_to_editor( $html, $send_id, $attachment ) {
   if( isset($_POST["highslide-$send_id"]) )
      return str_replace('<a', '<a class="highslide" onclick="return vz.expand(this)"', $html);
   else
      return $html;
}

add_filter( 'media_send_to_editor', 'viva_zoom_send_to_editor', 66, 3 );

// activating the plugin

function viva_zoom_activate() {

   // save plugin options to database
   add_option('hi_enabledForDefault', 1);
}

register_activation_hook( __FILE__, 'viva_zoom_activate' );

// backend option page

function viva_zoom_options_page() {

?>
   <div class="wrap">
   	<h2><?php _e('Viva Zoom', HI_TEXTDOMAIN); ?></h2>
   	<form method="post" action="options.php">
         <?php wp_nonce_field('update-options') ?>
      	<table class="form-table">
         	<tr valign="top">
         		<th scope="row"><?php _e('Settings', HI_TEXTDOMAIN); ?></th>
         		<td>
            		<label for="hi_enabledForDefault">
                  <input type="checkbox" name="hi_enabledForDefault" id="hi_enabledForDefault" value="1" <?php checked('1', get_option('hi_enabledForDefault')); ?> />
                  <?php _e('Activate Viva Zoom by default in the attachment dialog of your editor for in-post images', HI_TEXTDOMAIN); ?></label>
       		</td>
         	</tr>
           	</table>
      	<p class="submit">
      		<input type="submit" name="Submit" value="<?php _e('Update Options', HI_TEXTDOMAIN); ?> »" />
      		<input type="hidden" name="action" value="update" />
      		<input type="hidden" name="page_options" value="hi_enabledForDefault,hi_library,hi_jsSettings" />
      	</p>
   	</form><br/><br/>
<input type='button'
      onclick='MakeRequest();'
      value='Clear The Cache'/>
    <div id='ResponseDiv'>

    </div>

   </div>
<?php
}

// add option page to backend

function viva_zoom_admin_menu() {
   add_options_page(__('Viva Zoom', HI_TEXTDOMAIN), __('Viva Zoom', HI_TEXTDOMAIN), 'manage_options', basename(__FILE__), 'viva_zoom_options_page');
}

	function clear_cacher() {
		$rootpath=get_option(siteurl);
		?>
				<script type='text/javascript' src='<?php echo $rootpath; ?>/wp-content/plugins/Viva-ThumbZoom/lib/v-zoom/vzajax.js'></script>
				<?php
	}

add_action('admin_menu', 'viva_zoom_admin_menu');
add_action('admin_head', 'clear_cacher'   );
add_action('wp_head', 'viva_zoom_wp_head');
?>