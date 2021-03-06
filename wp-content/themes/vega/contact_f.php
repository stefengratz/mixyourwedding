<?php
/**
 * Template Name: Contact Fullscreen
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
	    	
	    	<!-- Begin main content -->
    			<?php
    				$pp_contact_form = unserialize(get_option('pp_contact_form_sort_data'));
    				wp_register_script("script-contact-form", get_template_directory_uri()."/templates/script-contact-form.php", false, THEMEVERSION, true);
					$params = array(
					  'ajaxurl' => admin_url('admin-ajax.php'),
					  'ajax_nonce' => wp_create_nonce('tgajax-post-contact-nonce'),
					);
					wp_localize_script( 'script-contact-form', 'tgAjax', $params );
					wp_enqueue_script("script-contact-form", get_template_directory_uri()."/templates/script-contact-form.php", false, THEMEVERSION, true);
    			?>
    			<div id="reponse_msg"><ul></ul></div>
    			
    			<form id="contact_form" method="post" action="<?php echo esc_url(get_permalink($current_page->ID)); ?>">
					<input type="hidden" id="action" name="action" value="pp_contact_mailer"/>
    				<?php 
			    		if(is_array($pp_contact_form) && !empty($pp_contact_form))
			    		{
			    			foreach($pp_contact_form as $form_input)
			    			{
			    				switch($form_input)
			    				{
			    					case 1:
			    	?>
			    					<p>
			        				<input id="your_name" name="your_name" type="text" class="required_field" placeholder="<?php echo _e( 'Name', THEMEDOMAIN ); ?>*" />
			    					</p>
			    					
			    	<?php
			    					break;
			    					
			    					case 2:
			    	?>
			    					<p>
			        				<input id="email" name="email" type="text" class="required_field email" placeholder="<?php echo _e( 'Email', THEMEDOMAIN ); ?>*" />
			    					</p>		
			    	<?php
			    					break;
			    					
			    					case 3:
			    	?>
			    					<p class="textarea">
			        				<textarea id="message" name="message" rows="7" cols="10" class="required_field" placeholder="<?php echo _e( 'Message', THEMEDOMAIN ); ?>*" ></textarea>
			        				</p>			
			    	<?php
			    					break;
			    					
			    					case 4:
			    	?>
			    					<p>
			        				<input id="address" name="address" type="text" placeholder="<?php echo _e( 'Address', THEMEDOMAIN ); ?>" />
			        				</p>		
			    	<?php
			    					break;
			    					
			    					case 5:
			    	?>
			    					<p>
			        				<input id="phone" name="phone" type="text" placeholder="<?php echo _e( 'Phone', THEMEDOMAIN ); ?>" />
			        				</p>		
			    	<?php
			    					break;
			    					
			    					case 6:
			    	?>
			    					<p>
			        				<input id="mobile" name="mobile" type="text" placeholder="<?php echo _e( 'Mobile', THEMEDOMAIN ); ?>" />
			        				</p>			
			    	<?php
			    					break;
			    					
			    					case 7:
			    	?>
			    					<p>
			        				<input id="company" name="company" type="text" placeholder="<?php echo _e( 'Company Name', THEMEDOMAIN ); ?>" />
			    					</p>			
			    	<?php
			    					break;
			    					
			    					case 8:
			    	?>
			    					<p>		
			        				<input id="country" name="country" type="text" placeholder="<?php echo _e( 'Country', THEMEDOMAIN ); ?>" />
			        				</p>			
			    	<?php
			    					break;
			    				}
			    			}
			    		}
			    	?>
			    	
			    	<?php
			    		$pp_contact_enable_captcha = get_option('pp_contact_enable_captcha');
			    		
			    		if(!empty($pp_contact_enable_captcha))
			    		{
			    	?>
			    		<div id="captcha-wrap">
							<div class="captcha-box">
								<img src="<?php echo get_template_directory_uri(); ?>/get_captcha.php" alt="" id="captcha" />
							</div>
							<div class="text-box">
								<label><?php _e( 'Type the two words', THEMEDOMAIN ); ?></label>
								<input name="captcha-code" type="text" id="captcha-code">
							</div>
							<div class="captcha-action">
								<img src="<?php echo get_template_directory_uri(); ?>/images/refresh.jpg"  alt="" id="captcha-refresh" />
							</div>
						</div>
						<br class="clear"/><br/>
					<?php
					}
					?>
			    			    
			    	<p>
    					<input id="contact_submit_btn" type="submit" value="<?php echo _e( 'Send Message', THEMEDOMAIN ); ?>"/>
    				</p>
    				<br/>
    			</form>
    			
    			<div id="ajax_loading"><i class="fa fa-spinner fa-spin"></i></div>
    			<br class="clear"/>

    		</div>
    	</div>
    	<!-- End main content -->
    </div>
</div>
<?php get_footer(); ?>