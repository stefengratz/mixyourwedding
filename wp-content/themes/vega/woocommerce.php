<?php
/**
 * The main template file for display page.
 *
 * @package WordPress
*/

/**
*	Get current page id
**/
$current_page_id = get_option( 'woocommerce_shop_page_id' );

get_header();

//Get Shop Sidebar
$page_sidebar = '';

//Get Shop Sidebar Display Settting
$pp_shop_layout = get_option('pp_shop_layout');
if($pp_shop_layout == 'sidebar')
{
	$page_sidebar = 'Shop Sidebar';
}
?>

<?php
if(!is_category())
{
    $page_title = get_the_title($current_page_id);
}
else
{
    $page_title = get_the_title();
}

//Check if hide header on this page
$page_hide_header = get_post_meta($current_page_id, 'page_hide_header', true);

if(empty($page_hide_header))
{
	//Check if post has featured image
	$page_header_background = get_post_meta($current_page_id, 'page_header_background', true);
	$page_tagline = get_post_meta($current_page_id, 'page_tagline', true);
	$pp_page_bg = '';
	
	if(!empty($page_header_background))
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
			<h1><?php echo $page_title; ?></h1>
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
			<h1><?php echo $page_title; ?></h1>
		</div>
	</div>
	<?php
	}
	?>
<?php
} // End if don't hide header
?>

<!-- Begin content -->
<?php
global $page_content_class;
?>
<div id="page_content_wrapper" class="<?php if(!empty($pp_page_bg)) { ?>hasbg <?php } ?><?php if(!empty($pp_page_bg) && !empty($global_pp_topbar)) { ?>withtopbar <?php } ?><?php if(!empty($page_content_class)) { echo $page_content_class; } ?>">
    <div class="inner ">
    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    		<div class="sidebar_content <?php if(empty($page_sidebar)) { ?>full_width<?php } ?>">
				
				<?php woocommerce_content();  ?>
				
    		</div>
    		<?php 
    		if(!empty($page_sidebar)) { ?>
    		<div class="sidebar_wrapper">
	            <div class="sidebar">
	            
	            	<div class="content">
						<ul class="sidebar_widget">
		    	    	<?php dynamic_sidebar($page_sidebar); ?>
		    	    	</ul>
	            	</div>
	        
	            </div>
            <br class="clear"/>
        
            <div class="sidebar_bottom"></div>
			</div>
			<br class="clear"/><br/>
    		<?php } ?>
    	</div>
    	<!-- End main content -->
    </div>
</div>
<!-- End content -->
<?php get_footer(); ?>