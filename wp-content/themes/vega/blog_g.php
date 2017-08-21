<?php
/**
 * Template Name: Blog Grid
 * The main template file for display blog page.
 *
 * @package WordPress
*/

/**
*	Get Current page object
**/
$page = get_page($post->ID);

/**
*	Get current page id
**/

if(!isset($current_page_id) && isset($page->ID))
{
    $current_page_id = $page->ID;
}

global $pp_homepage_style;
$pp_homepage_style = 'blog_grid';
get_header(); 

//Get Page Header
get_template_part("/templates/template-blog-header");
?>

<div id="page_content_wrapper" class="two">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    		
    		<div id="blog_grid_wrapper">
					
			<?php
			//Get current page number
			if(is_front_page())
			{
				$paged = (get_query_var('page')) ? get_query_var('page') : 1;
			}
			else
			{
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			}
			
			if(!is_archive() && !is_category() && !is_search() && !is_tag())
			{
			    $query_string ="post_type=post&paged=$paged";
			    query_posts($query_string);
			}
			
			if (have_posts()) : while (have_posts()) : the_post();
			
				$image_thumb = '';
											
				if(has_post_thumbnail(get_the_ID(), 'large'))
				{
				    $image_id = get_post_thumbnail_id(get_the_ID());
				    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
				}
			?>
			
			<!-- Begin each blog post -->
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
				<div class="post_wrapper grid_layout">
				
					<?php
						if(!empty($image_thumb))
						{
						    $small_image_url = wp_get_attachment_image_src($image_id, 'gallery_c', true);
				    ?>
						<div class="post_img">
						    <a href="<?php echo esc_url(get_permalink()); ?>">
						    	<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="" class=""/>
						    </a>
						</div>
				    <?php
				    	}
				    ?>
				
					<div class="post_header grid_layout">
				    	<?php
						    //Get Post's Categories
						    $post_categories = wp_get_post_categories($post->ID);
						    if(!empty($post_categories))
						    {
						?>
						<div class="post_subtitle">
						<?php
						    	foreach($post_categories as $c)
						    	{
						    		$cat = get_category( $c );
						?>
						    	<a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><?php echo $cat->name; ?></a>&nbsp;
						<?php
						    	}
						?>
						</div>
						<?php
						    }
						?>
					    <h5><a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></h5>
					    <div class="post_detail">
						    <?php echo get_the_time(THEMEDATEFORMAT); ?>&nbsp;
						    <?php
						    	$author_ID = get_the_author_meta('ID');
						    	$author_name = get_the_author();
						    	$author_url = get_author_posts_url($author_ID);
						    	
						    	if(!empty($author_name))
						    	{
						    ?>
						    	<?php echo _e( 'by', THEMEDOMAIN ); ?>&nbsp;<a href="<?php echo esc_url($author_url); ?>"><?php echo $author_name; ?></a>&nbsp;
						    <?php
						    	}
						    ?>
						</div>
				    </div>
				    <br class="clear"/><br/>
				    
				    <?php echo pp_substr(strip_shortcodes(get_the_excerpt()), 100); ?><br/><br/><br/>
				    		<a class="readmore button transparent" href="<?php echo esc_url(get_permalink()); ?>"><?php echo _e( 'Read More', THEMEDOMAIN ); ?></a>
				    
				    <br class="clear"/>
				    
				</div>
			
			</div>
			<!-- End each blog post -->
			
			<?php endwhile; endif; ?>
    		</div>
    		
    	</div>
    	
    </div>
    <!-- End main content -->
    
    <?php
	    if (function_exists("wpapi_pagination")) 
	    {
	        wpapi_pagination($wp_query->max_num_pages);
	    }
	    else
	    {
	    ?>
	        <div class="pagination"><p><?php posts_nav_link(' '); ?></p></div>
	    <?php
	    }
	?>

</div>  

<?php get_footer(); ?>