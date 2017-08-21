<?php
/**
 * The main template file for display gallery archives
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

global $page_gallery_cat;

if(empty($page_gallery_cat))
{
	//Get title
	$obj_term = get_term_by('slug', $term, 'gallerycat');
	$page_title = $obj_term->name;
	
	//Get description
	$page_tagline = $obj_term->description;
	
	//Get featured header background
	$term_meta = get_option( "taxonomy_term_$obj_term->term_id" );
	$pp_page_bg = $term_meta['gallerycat_ft_img'];
}
else
{
	//Get title
	$page_title = get_the_title();
	
	//Get description
	$page_tagline = get_post_meta($current_page_id, 'page_tagline', true);
}

global $pp_homepage_style;
$pp_homepage_style = 'blog_grid';

get_header();

//Check if disable slideshow hover effect
$pp_gallery_disable_hover_slide = get_option( "pp_gallery_disable_hover_slide" );

if(empty($pp_gallery_disable_hover_slide))
{
	wp_enqueue_script("jquery.cycle2.min", get_template_directory_uri()."/js/jquery.cycle2.min.js", false, THEMEVERSION, true);
	wp_enqueue_script("custom_cycle", get_template_directory_uri()."/js/custom_cycle.js", false, THEMEVERSION, true);
}
?>

<?php
//Check if hide header on this page
$page_hide_header = get_post_meta($current_page_id, 'page_hide_header', true);

if(empty($page_hide_header))
{
?>
<div id="page_caption">
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
<?php
}
?>

<!-- Begin content -->
<div id="page_content_wrapper" class="two">
    
    <div class="inner">

    	<div class="inner_wrapper">
		
			<div id="blog_grid_wrapper">
			<?php
				//Get galleries
				global $wp_query;
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$pp_portfolio_items_page = -1;
				
				$query_string = 'paged='.$paged.'&orderby=menu_order&order=ASC&post_type=galleries&posts_per_page=-1&suppress_filters=0';
				
				if(!empty($page_gallery_cat))
				{
				    $query_string .= '&gallerycat='.$page_gallery_cat;
				}
				else
				{
				    $query_string .= '&gallerycat='.$term;
				}
				
				query_posts($query_string);
			
				$key = 0;
			    if (have_posts()) : while (have_posts()) : the_post();
				    $image_url = '';
				    $gallery_ID = get_the_ID();
				    		
				    if(has_post_thumbnail($gallery_ID, 'original'))
				    {
				        $image_id = get_post_thumbnail_id($gallery_ID);
				        $small_image_url = wp_get_attachment_image_src($image_id, 'gallery_c', true);
				    }
				    
				    $permalink_url = get_permalink($gallery_ID);
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
						<h6><?php echo get_the_title(); ?></h6>
		    			<div class="gallery_excerpt"><?php echo strip_tags(pp_get_the_excerpt($gallery_ID)); ?></div>
				    </div>
			    </div>
			    <?php
			    	}
			    ?>
			
			</div>
			
			<?php
			    $key++;
			    endwhile; endif;	
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