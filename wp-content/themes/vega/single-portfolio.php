<?php
/**
 * The main template file for display single post portfolio.
 *
 * @package WordPress
*/

get_header(); 

?>

<?php

/**
*	Get current page id
**/

$current_page_id = $post->ID;
$portfolio_gallery_id = get_post_meta($current_page_id, 'portfolio_gallery_id', true);
?>

<?php
//Check if post has featured image
$portfolio_header_background = get_post_meta($current_page_id, 'portfolio_header_background', true);
$pp_page_bg = '';

if(!empty($portfolio_header_background))
{
	$image_id = pp_get_image_id($portfolio_header_background);
	$image_thumb = wp_get_attachment_image_src($image_id, 'original', true);
	$pp_page_bg = $image_thumb[0];
	
	$background_image = $image_thumb[0];
	$background_image_width = $image_thumb[1];
	$background_image_height = $image_thumb[2];
?>
<div id="page_caption" <?php if(!empty($pp_page_bg)) { ?> data-stellar-background-ratio="0.5" style="background-image:url('<?php echo esc_url($background_image); ?>');" class="hasbg parallax"<?php } ?>>
	<div id="page_caption_wrapper_bg">
		<h1><?php the_title(); ?></h1>
		<div class="post_detail">
		    <?php echo get_the_excerpt(); ?>
		</div>
	</div>
</div>
<?php
}
else
{
?>
<div id="page_caption">
	<div id="page_caption_wrapper">
		<h1><?php the_title(); ?></h1>
		<div class="post_detail">
		    <?php echo get_the_excerpt(); ?>
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
					if (have_posts())
					{ 
						while (have_posts()) : the_post();
		
						the_content();
		    		    
		    		    endwhile; 
		    		}
		    	?>
    		</div>
    		
    		<?php
			    //Get Social Share
			    get_template_part("/templates/template-share");
			?>
			<br class="clear"/>
			
			<?php	
		    $pp_portfolio_next_prev = get_option('pp_portfolio_next_prev');
			if(!empty($pp_portfolio_next_prev))
			{
			?>
			<div class="portfolio_post_wrapper">
			<?php
			    //Get Previous and Next Post
			    $prev_post = get_previous_post();
			    $next_post = get_next_post();
			?>
			
			<?php
			   //Get Next Post
			   if (!empty($next_post)): 
			   $next_image_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($next_post->ID), 'thumbnail', true);
			   if(isset($next_image_thumb[0]))
			   {
			       $image_file_name = basename($next_image_thumb[0]);
			   }
			?>
			   <div class="portfolio_post_next">
			   		<a class="portfolio_next" href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>">
			     		<i class="fa fa-angle-right"></i>
			     	</a>
			    </div>
			<?php endif; ?>
			
			<?php
			   //Get Previous Post
			   if (!empty($prev_post)): 
			   	$prev_image_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($prev_post->ID), 'thumbnail', true);
			   	if(isset($prev_image_thumb[0]))
			   	{
			   	    $image_file_name = basename($prev_image_thumb[0]);
			   	}
			?>
			   	<div class="portfolio_post_previous">
			   		<a class="portfolio_prev" href="<?php echo esc_url(get_permalink( $prev_post->ID )); ?>">
			     		<i class="fa fa-angle-left"></i>
			     	</a>
			    </div>
			<?php endif; ?>
			
			<?php
			    //If has previous or next post then add line break
			    if(!empty($prev_post) OR !empty($next_post))
			    {
			    	echo '<br class="clear"/>';
			    }
			?>
			</div>
			<?php
			}
			?>
			 </div>
    
    </div>
    <!-- End main content -->
   
</div> 

<?php get_footer(); ?>