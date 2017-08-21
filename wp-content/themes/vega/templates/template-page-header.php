<?php
/**
*	Get Current page object
**/
$current_page = get_page($post->ID);
$current_page_id = '';

if(isset($current_page->ID))
{
    $current_page_id = $current_page->ID;
}

global $pp_contact_display_map;

//Check if hide header on this page
$page_hide_header = get_post_meta($current_page_id, 'page_hide_header', true);

if(empty($page_hide_header))
{
	//Check if post has featured image
	$page_header_background = get_post_meta($current_page_id, 'page_header_background', true);
	$page_tagline = get_post_meta($current_page_id, 'page_tagline', true);
	$pp_page_bg = '';
	
	if(!empty($page_header_background) && empty($pp_contact_display_map))
	{
		$image_id = pp_get_image_id($page_header_background);
		$image_thumb = wp_get_attachment_image_src($image_id, 'original', true);
		$pp_page_bg = $image_thumb[0];
		
		$background_image = $image_thumb[0];
		$background_image_width = $image_thumb[1];
		$background_image_height = $image_thumb[2];
	?>
	<div id="page_caption" <?php if(!empty($pp_page_bg)) { ?> data-stellar-background-ratio="0.5" style="background-image:url('<?php echo esc_url($background_image); ?>');" class="hasbg parallax"<?php } ?>>
		<div id="page_caption_wrapper_bg">
			<?php
	    	if(!empty($page_tagline))
	    	{
	    	?>
	    	<div class="page_tagline">
	    		<?php echo $page_tagline; ?>
	    	</div>
	    	<?php
	    	}
	    	?>
			<h1><?php the_title(); ?></h1>
		</div>
	</div>
	<?php
	}
	else if(empty($pp_contact_display_map))
	{
	?>
	<div id="page_caption">
		<div id="page_caption_wrapper">
			<?php
	    	if(!empty($page_tagline))
	    	{
	    	?>
	    	<div class="page_tagline">
	    		<?php echo $page_tagline; ?>
	    	</div>
	    	<?php
	    	}
	    	?>
			<h1><?php the_title(); ?></h1>
		</div>
	</div>
	<?php
	}
	?>
	
	<?php
	if(!empty($pp_contact_display_map))
	    {	
	    	wp_enqueue_script("script-contact-map", get_template_directory_uri()."/templates/script-contact-map.php?id=map_contact", false, THEMEVERSION, true);
	?>
	<div id="page_caption_with_map">
		<div id="page_caption_with_map_bg">
			<?php
	    	if(!empty($page_tagline))
	    	{
	    	?>
	    	<div class="page_tagline">
	    		<?php echo $page_tagline; ?>
	    	</div>
	    	<?php
	    	}
	    	?>
			<h1><?php the_title(); ?></h1>
		</div>
		<div id="map_contact"></div>
	</div>
<?php
	    }
} // End if don't hide header
?>