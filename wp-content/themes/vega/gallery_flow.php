<?php
/**
 * The main template file for display portfolio page.
 *
 * @package WordPress
 */

/**
*	Get Current page object
**/
$page = get_page($post->ID);
$current_page_id = '';

if(isset($page->ID))
{
    $current_page_id = $page->ID;
}

//Check if gallery template
global $page_gallery_id;
if(!empty($page_gallery_id))
{
	$current_page_id = $page_gallery_id;
}

$all_photo_arr = get_post_meta($current_page_id, 'wpsimplegallery_gallery', true);

//Check if password protected
$gallery_password = get_post_meta($current_page_id, 'gallery_password', true);
if(!empty($gallery_password))
{
	session_start();
	
	if(!isset($_SESSION['gallery_page_'.$current_page_id]) OR empty($_SESSION['gallery_page_'.$current_page_id]))
	{
		get_template_part("/templates/template-password");
		exit;
	}
}

//important to apply dynamic header and footer style
global $pp_homepage_style;
$pp_homepage_style = 'flow';

get_header(); 

//Run flow gallery data
wp_enqueue_script("jquery.ppflip", get_template_directory_uri()."/js/jquery.ppflip.js", false, THEMEVERSION, true);
wp_enqueue_script("jquery.touchwipe", get_template_directory_uri()."/js/jquery.touchwipe.1.1.1.js", false, THEMEVERSION, true);
wp_enqueue_script("script-flow-gallery", get_template_directory_uri()."/templates/script-flow-gallery.php?gallery_id=".$current_page_id, false, THEMEVERSION, true);
?>

</div>

<a id="imgflow-prevslide" class="load-item"></a>
<a id="imgflow-nextslide" class="load-item"></a>

<div id="imageFlow">
	<div class="text">
		<div class="title"></div>
		<div class="legend"></div>
	</div>
</div>

<input type="hidden" id="tg_flow_enable_reflection" name="tg_flow_enable_reflection" value="1"/>

<div id="fancy_gallery" style="display:none">
<?php
$pp_image_lightbox_title = get_option('pp_image_lightbox_title');

foreach($all_photo_arr as $key => $photo)
{
	$full_image_url = wp_get_attachment_image_src( $photo, 'original' );
	$image_caption = get_post_field('post_excerpt', $photo);
?>
<a id="fancy_gallery<?php echo esc_attr($key); ?>" href="<?php echo esc_url($full_image_url[0]); ?>" class="fancy-gallery" <?php if(!empty($pp_image_lightbox_title)) { ?> title="<?php echo esc_html($image_caption); ?>" <?php } ?>></a>
<?php
}
?>
</div>

<?php
	//important to apply dynamic footer style
	$pp_homepage_style = 'flow';
	
	get_footer();
?>