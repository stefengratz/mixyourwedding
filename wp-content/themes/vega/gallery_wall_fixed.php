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

global $pp_homepage_style;
$pp_homepage_style = 'wall';
get_header();
?>

<?php
//Check if hide header on this page
$gallery_hide_header = get_post_meta($current_page_id, 'gallery_hide_header', true);
if(empty($gallery_hide_header))
{
?>
<div id="page_caption">
    <div id="page_caption_wrapper">
    	<div class="page_tagline">
    		<?php the_excerpt(); ?>
    	</div>
    	<h1><?php the_title(); ?></h1>
    </div>
</div>
<?php
}
?>

<!-- Begin content -->
<div id="page_content_wrapper" class="two">

    <div class="inner">
    
	    <div class="inner_wrapper">
	    
	    	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>		
					
		    	<?php the_content(); ?>
		
		    <?php endwhile; ?>
	
			<div id="photo_wall_wrapper">
			<?php
			    foreach($all_photo_arr as $photo_id)
				{
				    $small_image_url = '';
				    $hyperlink_url = get_permalink($photo_id);
				    $thumb_image_url = '';
				    
				    if(!empty($photo_id))
				    {
				    	$image_url = wp_get_attachment_image_src($photo_id, 'original', true);
				        $small_image_url = wp_get_attachment_image_src($photo_id, 'gallery_c', true);
				    }
				    
				    $thumb_image_url = $small_image_url[0];
				    $thumb_width = $small_image_url[1];
				    $thumb_height = $small_image_url[2];
				    
				    //Get image meta data
				    $image_caption = get_post_field('post_excerpt', $photo_id);
				    $image_alt = get_post_meta($photo_id, '_wp_attachment_image_alt', true);
			?>
			
			<div class="wall_entry masonry">
			    <?php 
			    	if(!empty($thumb_image_url))
			    	{
			    		$pp_image_lightbox_title = get_option('pp_image_lightbox_title');
			    		$pp_image_link_single = get_option('pp_image_link_single');
			    ?>		
			    	<div class="wall_thumbnail">
			    		<img src="<?php echo esc_url($thumb_image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" class="portfolio_img"/>
				    				
				    	<div class="mask">
						    <div class="mask_frame">
						    	<div class="mask_image_content">
						    		<div class="mask_image_content_frame">
						    			<a <?php if(!empty($pp_image_lightbox_title)) { ?>title="<?php if(!empty($image_caption)) { ?><?php echo esc_attr($image_caption); ?><?php } ?>"<?php } ?> class="fancy-gallery" href="<?php echo esc_url($image_url[0]); ?>">
						    				<i class="fa fa-search-plus"></i>
						    			</a>
						    			<?php
			    						if(empty($pp_image_link_single))
			    						{
			    						?>
			    						<a href="<?php echo esc_url($hyperlink_url); ?>">
								    	    <i class="fa fa-chain"></i>
			    						</a>
			    						<?php
			    						}
			    						?>
						    		</div>
						    	</div>
						    </div>
						</div>
			    	</div>
			    <?php
			    	}		
			    ?>
			
			</div>
			
			<?php
			    }
			?>
			</div>
		</div>
	</div>
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
	//important to apply dynamic footer style
	global $pp_homepage_style;
	$pp_homepage_style = 'wall';
	
	get_footer();
?>