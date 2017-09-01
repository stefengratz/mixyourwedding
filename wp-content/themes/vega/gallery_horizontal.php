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

//Get gallery images
$all_photo_arr = get_post_meta($current_page_id, 'wpsimplegallery_gallery', true);

//Get global gallery sorting
$all_photo_arr = pp_resort_gallery_img($all_photo_arr);

get_header();

wp_enqueue_script("jquery.mousewheel", get_template_directory_uri()."/js/jquery.mousewheel.min.js", false, THEMEVERSION, true);
wp_enqueue_script("horizontal_gallery", get_template_directory_uri()."/js/horizontal_gallery.js", false, THEMEVERSION, true);
?>

<div class="page_control_static">
    <a id="page_maximize" href="#"></a>
</div>

<!-- Begin content -->
<div id="page_content_wrapper" class="transparent">
	<div id="horizontal_gallery">
	<table id="horizontal_gallery_wrapper">
	<tbody><tr>
	<td style="padding:30px;">
		<div class="horizontal_gallery_info">
			<div class="page_tagline"><?php echo get_the_excerpt(); ?></div>
			<h1><?php the_title(); ?></h1>
			<?php
			    //Get Social Share
			    get_template_part("/templates/facebook-social");
			?>
		</div>
	</td>
	<?php
	    foreach($all_photo_arr as $photo_id)
		{
		    $small_image_url = '';
		    $hyperlink_url = get_permalink($photo_id);
		    $thumb_image_url = '';
		    
		    if(!empty($photo_id))
		    {
		    	$image_url = wp_get_attachment_image_src($photo_id, 'original', true);
		    }
		    
		    //Get image meta data
		    $image_caption = get_post_field('post_excerpt', $photo_id);
		    $image_description = get_post_field('post_content', $photo_id);
		    $pp_image_lightbox_title = get_option('pp_image_lightbox_title');
		    $image_alt = get_post_meta($photo_id, '_wp_attachment_image_alt', true);
	?>
	
	<td style="padding:30px;">
	    <?php 
	    	if(isset($image_url[0]) && !empty($image_url[0]))
	    	{
	    ?>
	    	<a <?php if(!empty($pp_image_lightbox_title)) { ?>title="<?php if(!empty($image_caption)) { ?><?php echo esc_attr($image_caption); ?><?php } ?>"<?php } ?> class="fancy-gallery" href="<?php echo esc_url($image_url[0]); ?>">
	    	<div class="gallery_image_wrapper">
		    	<img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($image_alt); ?>" class="horizontal_gallery_img"/>
		    	<?php
		    		if(!empty($pp_image_lightbox_title)) 
		    		{
		    	?>
	
		    	<div class="image_caption"><?php echo $image_caption;?></div>
		    	<div class="image_description"><?php echo $image_description;?></div>
		    	<?php
		    		}
		    	?>
	    	</div>
	    	</a>
	    <?php
	    	}		
	    ?>
	
	</td>
	
	<?php
	    }
	?>
	</tr></tbody>
	</table>
	
	</div>
	<br class="clear"/>
	<?php
	    //Get Social Share
	    get_template_part("/templates/template-share");
	?>
</div>

<?php
$page_audio = get_post_meta($current_page_id, 'page_audio', true);

if(!empty($page_audio))
{
?>
<div class="page_audio">
	<?php echo do_shortcode('[audio width="30" height="30" src="'.$page_audio.'"]'); ?>
</div>
<?php
}
?>

<?php
	get_footer();
?>