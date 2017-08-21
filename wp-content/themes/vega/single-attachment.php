<?php
/**
 * The main template file for display single post page.
 *
 * @package WordPress
*/

get_header(); 

?>

<div id="page_content_wrapper" class="two">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">

	    	<div class="sidebar_content full_width">
					
				<?php
				if (have_posts()) : while (have_posts()) : the_post();
				
					$small_image_url = wp_get_attachment_image_src(get_the_ID(), 'blog_f', true);
				?>
										
				<!-- Begin each blog post -->
				<div class="post_wrapper">
				
					<?php
				    	if(isset($small_image_url[0]) && !empty($small_image_url[0]))
				    	{	
				    		//Get image meta data
				    		$image_caption = get_post_field('post_excerpt', get_the_ID());
				    		$image_description = get_post_field('post_content', get_the_ID());
				    ?>
				
					<div class="image_classic_frame single">
				    	<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="" class=""/>
	    				<div class="image_caption"><?php echo $image_caption;?></div>
						<div class="image_description"><?php echo $image_description;?></div>
				    </div>
				    
				    <?php
				    	}
				    ?>
				    
				</div>
				<!-- End each blog post -->
				
				<?php endwhile; endif; ?>
				
				<br class="clear"/>
				
				<?php
				    //Get Social Share
				    get_template_part("/templates/template-share");
				?>
				
				<div class="fullwidth_comment_wrapper">
					<?php comments_template( '' ); ?>
				</div>
				
				<?php wp_link_pages(); ?>
				
				<br class="clear"/><br/>
			</div>
						
    	</div>
    
    </div>
    <!-- End main content -->
   
</div> 

<?php get_footer(); ?>