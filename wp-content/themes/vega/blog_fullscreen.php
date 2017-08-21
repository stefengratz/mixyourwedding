<?php
/**
 * Template Name: Blog Fullscreen
 * The main template file for display blog page.
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

if(!is_home() && !is_archive() && !is_category() && !is_search() && !is_tag())
{
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
}
else
{
	if(is_archive() && !is_category() && !is_tag())
	{
		$pp_bg_archives = get_option('pp_bg_archives');
		$pp_page_bg = '';
		
		if(!empty($pp_bg_archives))
		{
			$pp_page_bg = $pp_bg_archives;
			
			$image_id = pp_get_image_id($pp_page_bg);
			$image_thumb = wp_get_attachment_image_src($image_id, 'original', true);
			
			$pp_page_bg = $image_thumb[0];
			$background_image = $image_thumb[0];
			$background_image_width = $image_thumb[1];
			$background_image_height = $image_thumb[2];
		}
		?>
		<div id="page_background" <?php if(!empty($pp_page_bg)) { ?>style="background-image:url('<?php echo $background_image; ?>');"<?php } ?>></div>
<?php
	}
	elseif(is_category())
	{
		$pp_bg_categories = get_option('pp_bg_categories');
		
		if(!empty($pp_bg_categories))
		{
			$pp_page_bg = $pp_bg_categories;
			
			$image_id = pp_get_image_id($pp_page_bg);
			$image_thumb = wp_get_attachment_image_src($image_id, 'original', true);
			
			$pp_page_bg = $image_thumb[0];
			$background_image = $image_thumb[0];
			$background_image_width = $image_thumb[1];
			$background_image_height = $image_thumb[2];
		?>
		<div id="page_background" <?php if(!empty($pp_page_bg)) { ?>style="background-image:url('<?php echo $background_image; ?>');"<?php } ?>></div>
		<?php
		}
	}
	elseif(is_search())
	{
		$pp_bg_search = get_option('pp_bg_search');
		
		if(!empty($pp_bg_search))
		{
			$pp_page_bg = $pp_bg_search;
			
			$image_id = pp_get_image_id($pp_page_bg);
			$image_thumb = wp_get_attachment_image_src($image_id, 'original', true);
			
			$pp_page_bg = $image_thumb[0];
			$background_image = $image_thumb[0];
			$background_image_width = $image_thumb[1];
			$background_image_height = $image_thumb[2];
		?>
		<div id="page_background" <?php if(!empty($pp_page_bg)) { ?>style="background-image:url('<?php echo $background_image; ?>');"<?php } ?>></div>
		<?php
		}
	}
	elseif(is_tag())
	{
		$pp_bg_tags = get_option('pp_bg_tags');
		
		if(!empty($pp_bg_tags))
		{
			$pp_page_bg = $pp_bg_tags;
			
			$image_id = pp_get_image_id($pp_page_bg);
			$image_thumb = wp_get_attachment_image_src($image_id, 'original', true);
			
			$pp_page_bg = $image_thumb[0];
			$background_image = $image_thumb[0];
			$background_image_width = $image_thumb[1];
			$background_image_height = $image_thumb[2];
		?>
		<div id="page_background" <?php if(!empty($pp_page_bg)) { ?>style="background-image:url('<?php echo $background_image; ?>');"<?php } ?>></div>
		<?php
		}
	}
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
	    			if(!is_home() && !is_archive() && !is_category() && !is_search() && !is_tag())
					{
						$page_title = get_the_title();
						$page_tagline = get_post_meta($current_page_id, 'page_tagline', true);
					}
					elseif(is_archive() && !is_category() && !is_tag())
					{
						if ( is_day() ) : 
							$page_title = get_the_date(); 
					    elseif ( is_month() ) : 
					    	$page_title = get_the_date('F Y'); 
					    elseif ( is_year() ) : 
					    	$page_title = get_the_date('Y'); 
					    else :
					    	$page_title = __( 'Blog Archives', THEMEDOMAIN); 
					    endif; 
					    
					    $page_tagline = __( 'Posts archives ', THEMEDOMAIN );
					}
					elseif(is_category())
					{
						$page_title = single_cat_title( '', false );
						$page_tagline = __( 'Posts category ', THEMEDOMAIN ).single_cat_title( '', false );
					}
					elseif(is_search())
					{
						$page_title = get_search_query();
						$page_tagline = __( 'Search Results for ', THEMEDOMAIN ).get_search_query();
					}
					elseif(is_tag())
					{
						$page_title = single_cat_title( '', false );
						$page_tagline = __( 'Posts tagged ', THEMEDOMAIN ).single_cat_title( '', false );
					}
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
				<h1><?php echo $page_title; ?></h1>
    		</div>
    		
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
											
				if(has_post_thumbnail(get_the_ID(), 'blog'))
				{
				    $image_id = get_post_thumbnail_id(get_the_ID());
				    $image_thumb = wp_get_attachment_image_src($image_id, 'blog', true);
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
    	</div>
    	<!-- End main content -->
    </div>
</div>
<?php get_footer(); ?>