<?php
/**
 * The main template file for display single post page.
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

get_header(); 

?>

<?php
//Check if post has featured image
$post_ft_bg = get_post_meta($current_page_id, 'post_ft_bg', true);
$pp_page_bg = '';

if(!empty($post_ft_bg) && has_post_thumbnail($current_page_id, 'original'))
{
	$image_id = get_post_thumbnail_id($current_page_id); 
	$image_thumb = wp_get_attachment_image_src($image_id, 'original', true);
	$pp_page_bg = $image_thumb[0];
	
	$background_image = $image_thumb[0];
	$background_image_width = $image_thumb[1];
	$background_image_height = $image_thumb[2];
?>
<div id="page_caption" <?php if(!empty($pp_page_bg)) { ?> data-stellar-background-ratio="0.5" style="background-image:url('<?php echo esc_url($background_image); ?>');" class="hasbg parallax"<?php } ?>>
	<div id="page_caption_wrapper_bg">
		<?php
		    //Get Post's Categories
		    $post_categories = wp_get_post_categories($post->ID);
		?>
		<div class="page_tagline">
		<?php
		    if(!empty($post_categories))
		    {
		    	foreach($post_categories as $c)
		    	{
		    		$cat = get_category( $c );
		?>
		    	<a class="uppercase" href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><?php echo $cat->name; ?></a>&nbsp;
		<?php
		    	}
		?>
		</div>
		<?php
		    }
		?>
		<h1><?php the_title(); ?></h1>
		<div class="post_detail">
		    <?php echo get_the_time(THEMEDATEFORMAT); ?>
		</div>
		<?php
		    //Get Social Share
		    get_template_part("/templates/facebook-social");
		?>
	</div>
</div>
<?php
}
else
{
?>
<div id="page_caption">
	<div id="page_caption_wrapper">
		<?php
		    //Get Post's Categories
		    $post_categories = wp_get_post_categories($post->ID);
		?>
		<div class="page_tagline">
		<?php
		    if(!empty($post_categories))
		    {
		    	foreach($post_categories as $c)
		    	{
		    		$cat = get_category( $c );
		?>
		    	<a class="uppercase" href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><?php echo $cat->name; ?></a>&nbsp;
		<?php
		    	}
		?>
		</div>
		<?php
		    }
		?>
		<h1><?php the_title(); ?></h1>
		<div class="post_detail">
		    <?php echo get_the_time(THEMEDATEFORMAT); ?>
		</div>
	</div>
</div>
<?php
}
?>

<div id="page_content_wrapper" class="two">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">

	    	<div class="sidebar_content full_width">
					
			<?php
			if (have_posts()) : while (have_posts()) : the_post();
			
				$image_thumb = '';
											
				if(has_post_thumbnail(get_the_ID(), 'blog_f'))
				{
				    $image_id = get_post_thumbnail_id(get_the_ID());
				    $image_thumb = wp_get_attachment_image_src($image_id, 'blog_f', true);
				}
			?>
			
			<!-- Begin each blog post -->
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
				<div class="post_wrapper">
				
					<?php
					//Check if display featured content
					$pp_blog_display_ft = get_option('pp_blog_display_ft');
					$post_ft_type = '';
					
					if(!empty($pp_blog_display_ft))
					{
						//Get post featured content
						$post_ft_type = get_post_meta(get_the_ID(), 'post_ft_type', true);
						
						switch($post_ft_type)
						{
							case 'Image':
							default:
						    	if(!empty($image_thumb))
						    	{
						    		$small_image_url = wp_get_attachment_image_src($image_id, 'blog_f', true);
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
				    }
				    ?>
				    
				    <?php
				    	the_content();
				    	wp_link_pages();
				    ?>
				    
				    <br/><br/>
				    <?php
				    	$pp_blog_display_tags = get_option('pp_blog_display_tags');
				    
					    if(has_tag() && !empty($pp_blog_display_tags))
					    {
					?>
					    <div class="post_excerpt post_tag">
					    	<i class="fa fa-tags"></i>
					    	<?php the_tags('', ', ', '<br />'); ?>
					    </div>
					<?php
					    }
					?>
					
					<?php
					    $pp_blog_display_author = get_option('pp_blog_display_author');
					    
					    if($pp_blog_display_author)
					    {
					?>
					
					<div id="about_the_author">
					    <div class="gravatar"><?php echo get_avatar( get_the_author_meta('email'), '80' ); ?></div>
					    <div class="author_detail">
						    <?php echo _e( 'Written By', THEMEDOMAIN ); ?>&nbsp;<?php echo get_the_author('user_nicename'); ?>
						    <?php echo _e( 'On', THEMEDOMAIN ); ?>&nbsp;<?php echo get_the_time(THEMEDATEFORMAT); ?>
					    </div>
					</div>
					
					<?php
					    }
					?>
					
					<?php
						//Get Social Share
						get_template_part("/templates/template-share");
					?>
					
					<?php
						$pp_blog_next_prev = get_option('pp_blog_next_prev');
						
						if($pp_blog_next_prev)
						{
						
						    //Get Previous and Next Post
						    $prev_post = get_previous_post();
						    $next_post = get_next_post();
						
						    //If has previous or next post then add line break
						    if(!empty($prev_post) OR !empty($next_post))
						    {
						    	echo '<br/><br/><br/><hr/>';
						    }
						?>
						    
						<?php
						   //Get Previous Post
						   if (!empty($prev_post)): 
						?>
							<a href="<?php echo esc_url(get_permalink( $prev_post->ID )); ?>">
						     	<div class="post_previous">
						     		<div class="post_previous_content">
						     			<h6><?php echo _e( 'Previous Post', THEMEDOMAIN ); ?></h6>
						     			<h5 class="title"><?php echo $prev_post->post_title; ?></h5>
						     		</div>
						     	</div>
							</a>
						<?php endif; ?>
						
						<?php
						   //Get Next Post
						   if (!empty($next_post)): 
						?>
							<a href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>">
						     	<div class="post_next">
						     		<div class="post_next_content">
						     			<h6><?php echo _e( 'Next Post', THEMEDOMAIN ); ?></h6>
						     			<h5 class="title"><?php echo $next_post->post_title; ?></h5>
						     		</div>
						     	</div>
							</a>
						<?php endif; ?>
						
						<?php
						    //If has previous or next post then add line break
						    if(!empty($prev_post) OR !empty($next_post))
						    {
						    	echo '<br class="clear"/><br/>';
						    }
						
						}
					?>
    
			</div>
			<!-- End each blog post -->
			
			<div class="fullwidth_comment_wrapper">
				<?php comments_template( '' ); ?>
			</div>
			<br class="clear"/><br/>

			<?php wp_link_pages(); ?>
			
			<?php endwhile; endif; ?>
			</div>
    	
    	</div>
    
    </div>
    <!-- End main content -->
   
</div>

</div> 

<?php get_footer(); ?>