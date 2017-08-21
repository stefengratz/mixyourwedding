<?php
/**
 * Template Name: Page Fullscreen
 * The main template file for display contact page.
 *
 * @package WordPress
*/

/**
*	Get Current page object
**/
$current_page = get_page($post->ID);
$current_page_id = '';

if(isset($current_page->ID))
{
    $current_page_id = $current_page->ID;
}

//important to apply dynamic header & footer style
global $pp_homepage_style;
$pp_homepage_style = 'fullscreen';

get_header(); 

//Check if post has featured image
$page_header_background = get_post_meta($current_page_id, 'page_header_background', true);
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
<div id="page_background" <?php if(!empty($pp_page_bg)) { ?>style="background-image:url('<?php echo $background_image; ?>');"<?php } ?>></div>
<?php
}
?>

<div class="page_control_static">
    <a id="page_maximize" href="#"></a>
</div>

<div id="page_content_wrapper" class="fixed">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    		
    		<div class="sidebar_content full_width">
    		
    		<div class="page_caption_full">
	    		<?php
				    //Get Page Header
				    $page_tagline = get_post_meta($current_page_id, 'page_tagline', true);
				?>
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
    		
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>		

    			<?php the_content(); ?>

    		<?php endwhile; ?>
	    	
    		</div>
    	</div>
    </div>
</div>
<?php get_footer(); ?>