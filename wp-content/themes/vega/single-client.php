<?php
/**
 * The main template file for display client galleries
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

global $pp_homepage_style;
$pp_homepage_style = 'blog_grid';

//Check if password protected
$client_password = get_post_meta($current_page_id, 'client_password', true);
if(!empty($client_password))
{
	session_start();
	
	if(!isset($_SESSION['gallery_page_'.$current_page_id]) OR empty($_SESSION['gallery_page_'.$current_page_id]))
	{
		get_template_part("/templates/template-client-password");
		exit;
	}
}

get_header();

//Check if disable slideshow hover effect
$pp_gallery_disable_hover_slide = get_option( "pp_gallery_disable_hover_slide" );

if(empty($pp_gallery_disable_hover_slide))
{
	wp_enqueue_script("jquery.cycle2.min", get_template_directory_uri()."/js/jquery.cycle2.min.js", false, THEMEVERSION, true);
	wp_enqueue_script("custom_cycle", get_template_directory_uri()."/js/custom_cycle.js", false, THEMEVERSION, true);
}
?>
<div id="client_header">
    <?php
    	//Get client thumbnail
    	$client_thumbnail = '';
    	if(has_post_thumbnail($current_page_id, 'thumbnail') && empty($term))
        {
            $image_id = get_post_thumbnail_id($current_page_id); 
            $image_thumb = wp_get_attachment_image_src($image_id, 'thumbnail', true);
            
            if(isset($image_thumb[0]) && !empty($image_thumb[0]))
            {
            	$client_thumbnail = $image_thumb[0];
            }
        }
        
        if(!empty($client_thumbnail))
        {
    ?>
    	<div class="client_thumbnail">
    		<img src="<?php echo esc_url($client_thumbnail); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"/>
    	</div>
    <?php
        }
    ?>

    <?php 
        if(have_posts()) 
    	{
    ?>
    	 <div class="client_content">
    	 	<h1><?php the_title(); ?></h1>
    	 	
    	 	<?php
    		    while ( have_posts() ) : the_post(); ?>		
    			    <?php the_content(); break;  ?>
    		<?php endwhile; ?>
    	</div>
    <?php
    }
    ?>
    <br class="clear"/>
</div>


<!-- Begin content -->
<div id="page_content_wrapper" class="two">
    
    <div class="inner">

    	<div class="inner_wrapper">
		
			<div id="blog_grid_wrapper">
			<?php
			    //Get galleries
			    $client_galleries = get_post_meta($current_page_id, 'client_galleries', true);
			
			    $key = 0;
			    if (!empty($client_galleries) && is_array($client_galleries))
			    {
			    	foreach($client_galleries as $client_gallery)
			    	{
				    	$small_image_url = array();
				        $image_url = '';
				        $gallery_ID = $client_gallery;
				        		
				        if(has_post_thumbnail($gallery_ID, 'original'))
				        {
				            $image_id = get_post_thumbnail_id($gallery_ID);
				            $small_image_url = wp_get_attachment_image_src($image_id, 'gallery_c', true);
				        }
				        
				        $permalink_url = get_permalink($gallery_ID);
				        $obj_gallery = get_post($gallery_ID);
			?>
			
			<div class="wall_entry type-post post gallery masonry element">
			    <?php 
			    	if(!empty($small_image_url[0]))
					{
						$all_photo_arr = array();
						
						if(empty($pp_gallery_disable_hover_slide))
						{
							//Get gallery images
							$all_photo_arr = get_post_meta($gallery_ID, 'wpsimplegallery_gallery', true);
							
							//Get only 5 recent photos
							$all_photo_arr = array_slice($all_photo_arr, 0, 5);
						}
			    ?>
			    <div class="image_grid_frame">
				    <div class="wall_thumbnail post_archive">
				    	<a href="<?php echo esc_url($permalink_url); ?>" class="gallery_wrapper">
				    		<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="" class="portfolio_img static"/>
				            <div class="mask transparent">
							    <div class="mask_frame">
							    	<?php
								    	if(!empty($all_photo_arr))
								    	{
								    ?>
								    <ul class="gallery_img_slides">
								    <?php
								    	foreach($all_photo_arr as $photo)
								    	{
								    		$slide_image_url = wp_get_attachment_image_src($photo, 'gallery_c', true);
								    ?>
								    <li><img src="<?php echo esc_url($slide_image_url[0]); ?>" alt="" class="static"/></li>
								    <?php
								    	}
								    ?>
								    </ul>
								    <?php
								    	}
								    ?>
							    </div>
							</div>
						</a>
						<br class="clear"/>
						<h6><?php echo esc_html($obj_gallery->post_title); ?></h6>
		    			<div class="gallery_excerpt"><?php echo strip_tags(pp_get_the_excerpt($gallery_ID)); ?></div>
				    </div>
			    </div>
			    <?php
			    	}
			    ?>
			
			</div>
			
			<?php
					}
			    $key++;
				}
			?>
			</div>
			
			<?php
			    //Get Social Share
			    get_template_part("/templates/template-share");
			?>
			<br class="clear"/>

		</div>

	</div>

</div>
<?php	
	get_footer();
?>