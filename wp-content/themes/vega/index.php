<?php
/**
 * The main template file for index (latest posts)
 *
 * @package WordPress
*/

get_header(); 
?>

<div id="page_caption">
	<div id="page_caption_wrapper">
		<div class="page_tagline">
			<?php echo get_bloginfo('description'); ?>
		</div>
		<h1><?php echo get_bloginfo('name'); ?></h1>
	</div>
</div>

<!-- Begin content -->
<div id="page_content_wrapper" class="two">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    		
    		<div class="sidebar_content full_width">
					
			<?php
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
			
			<?php endwhile; endif; ?>

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
	    <!-- End main content -->

	</div>
	
</div>
<?php get_footer(); ?>