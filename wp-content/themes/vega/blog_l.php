<?php
/**
 * Template Name: Blog Left Sidebar
 * The main template file for display blog page.
 *
 * @package WordPress
*/

/**
*	Get Current page object
**/
if(!is_null($post))
{
	$page = get_page($post->ID);
}

$current_page_id = '';

/**
*	Get current page id
**/

if(!is_null($post) && isset($page->ID))
{
    $current_page_id = $page->ID;
}

get_header(); 

//Get Page Header
get_template_part("/templates/template-blog-header");

if(!is_home() && !is_archive() && !is_category() && !is_search() && !is_tag())
{
	$page_sidebar = get_post_meta($current_page_id, 'page_sidebar', true);
}
elseif(is_archive() && !is_category() && !is_tag())
{
	$page_sidebar = 'Archives Sidebar';
}
elseif(is_category())
{
	$page_sidebar = 'Category Sidebar';
}
elseif(is_search())
{
	$page_sidebar = 'Search Sidebar';
}
elseif(is_tag())
{
	$page_sidebar = 'Tag Sidebar';
}

//If not select sidebar then select default one
if(empty($page_sidebar))
{
	$page_sidebar = 'Blog Sidebar';
}
?>

<div id="page_content_wrapper" class="two">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    			
    		<div class="sidebar_wrapper left_sidebar">
	    	
	    	    <div class="sidebar_top"></div>
	    	
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
    	

    		<div class="sidebar_content left_sidebar">
					
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
				
					<div class="post_wrapper fullwidth">
					
						<div class="post_header fullwidth">
						
							<?php
								//Get post featured content
								$post_ft_type = get_post_meta(get_the_ID(), 'post_ft_type', true);
								
								switch($post_ft_type)
								{
									case 'Image':
									default:
								    	if(!empty($image_thumb))
								    	{
								    		$small_image_url = wp_get_attachment_image_src($image_id, 'blog', true);
						    ?>
						    
									    <div class="post_img">
									    	<a href="<?php echo esc_url(get_permalink()); ?>">
									    		<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="" class=""/>
									    	</a>
									    </div>
									    <br class="clear"/>
						    
						    <?php
						    			}
						    		break;
						    		
						    		case 'Vimeo Video':
						    			$post_ft_vimeo = get_post_meta(get_the_ID(), 'post_ft_vimeo', true);
						    ?>
										<?php echo do_shortcode('[tg_vimeo video_id="'.$post_ft_vimeo.'" width="880" height="495"]'); ?>
									    <br class="clear"/>
						    <?php
						    		break;
						    		
						    		case 'Youtube Video':
						    			$post_ft_youtube = get_post_meta(get_the_ID(), 'post_ft_youtube', true);
						    ?>
										<?php echo do_shortcode('[tg_youtube video_id="'.$post_ft_youtube.'" width="880" height="495"]'); ?>
									    <br class="clear"/>
						    <?php
						    		break;
						    		
						    		case 'Gallery':
						    			$post_ft_gallery = get_post_meta(get_the_ID(), 'post_ft_gallery', true);
						    ?>
										<?php echo do_shortcode('[tg_gallery_slider gallery_id="'.$post_ft_gallery.'" width="880" height="495"]'); ?>
										<br class="clear"/>
						    <?php
						    		break;
						    		
						    	} //End switch
						    ?>
						
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
					    	<h4><a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></h4>
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
					    <br class="clear"/>
					    
					    <?php
					    	$pp_blog_display_full = get_option('pp_blog_display_full');
					    	
					    	if(!empty($pp_blog_display_full))
					    	{
					    		the_content();
					    	}
					    	else
					    	{
					    ?>
					    	<div class="post_excerpt">
					    		<p><?php echo get_the_excerpt(); ?></p>
					    	</div>
					    	
					    	<div class="post_readmore">
					    		<div class="post_readmore_line"></div>
					    		<a class="readmore button" href="<?php echo esc_url(get_permalink()); ?>"><?php echo _e( 'Read More', THEMEDOMAIN ); ?></a>
					    	</div>
					    <?php
					    	}
					    ?>
						<br class="clear"/>
					    
					</div>
				
				</div>
				<!-- End each blog post -->
				
				<?php endwhile; else: ?>
			
					<div class="search_form_wrapper">
		    			<h3><?php _e( 'New Search', THEMEDOMAIN ); ?></h3>
		    			<?php _e( "Oops, The Content Could Not Be Found. Please try a new search.", THEMEDOMAIN ); ?><br/><br/>
		    			
		    			<form class="searchform" role="search" method="get" action="<?php echo home_url(); ?>">
							<input style="width:96%" type="text" class="field searchform-s" name="s" value="<?php the_search_query(); ?>" title="<?php _e( 'Type and hit enter', THEMEDOMAIN ); ?>"><br/><br/>
							<input type="submit" value="<?php _e( 'Search', THEMEDOMAIN ); ?>"/>
						</form>
	    			</div>	
				
				<?php endif; ?>
		
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
	    	
	    	<br class="clear"/>
    	</div>
    	
    </div>
    <!-- End main content -->

</div>  

<?php get_footer(); ?>