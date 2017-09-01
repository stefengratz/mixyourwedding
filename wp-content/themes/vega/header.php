<?php
/**
 * The Header for the template.
 *
 * @package WordPress
 */
 
if ( ! isset( $content_width ) ) $content_width = 960;

if(session_id() == '') {
	session_start();
}
global $pp_homepage_style;

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<?php
	$pp_enable_responsive = get_option('pp_enable_responsive');
	if(!empty($pp_enable_responsive))
	{
?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<?php
	}
?>

<title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php
if(is_single())
{
	if(has_post_thumbnail(get_the_ID(), 'blog_f'))
	{
	    $image_id = get_post_thumbnail_id(get_the_ID());
	    $fb_thumb = wp_get_attachment_image_src($image_id, 'thumbnail', true);
	}

	if(isset($fb_thumb[0]) && !empty($fb_thumb[0]))
	{
		$post_content = get_post_field('post_excerpt', $post->ID);
	?>
	<meta property="og:image" content="<?php echo $fb_thumb[0]; ?>"/>
	<meta property="og:title" content="<?php the_title(); ?>"/>
	<meta property="og:url" content="<?php echo get_permalink($post->ID); ?>"/>
	<meta property="og:description" content="<?php echo strip_tags($post_content); ?>"/>
	<?php
	}
}
?>

<?php
	/**
	*	Get favicon URL
	**/
	$pp_favicon = get_option('pp_favicon');
	
	if(!empty($pp_favicon))
	{
?>
		<link rel="shortcut icon" href="<?php echo $pp_favicon; ?>" />
<?php
	}
?> 

<?php
	/**
    *	Setup code before </head>
    **/
	$pp_before_head_code = get_option('pp_before_head_code');
	
	if(!empty($pp_before_head_code))
	{
		echo stripslashes($pp_before_head_code);
	}
?>

<?php
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>

</head>

<body <?php body_class(); ?> <?php if(isset($pp_homepage_style) && !empty($pp_homepage_style)) { echo 'data-style="'.$pp_homepage_style.'"'; } ?>>
	<?php do_action('after_body_open_tag'); ?>
	<?php
		//Check if disable right click
		$pp_enable_right_click = get_option('pp_enable_right_click');
		
		//Check if disable image dragging
		$pp_enable_dragging = get_option('pp_enable_dragging');
		
		//Check if sticky menu
		$pp_fixed_menu = get_option('pp_fixed_menu');
		
		//Check if enable page frame
		$pp_page_frame = get_option('pp_page_frame');
		if(isset($_GET['vegastyle']) && $_GET['vegastyle']>1 && THEMEDEMO) 
		{
			$pp_page_frame = 'true';
		}
		
		//Get main menu layout
		$pp_menu_layout = get_option('pp_menu_layout');
	?>
	<input type="hidden" id="pp_enable_right_click" name="pp_enable_right_click" value="<?php echo esc_attr($pp_enable_right_click); ?>"/>
	<input type="hidden" id="pp_enable_dragging" name="pp_enable_dragging" value="<?php echo esc_attr($pp_enable_dragging); ?>"/>
	<input type="hidden" id="pp_fixed_menu" name="pp_fixed_menu" value="<?php echo esc_attr($pp_fixed_menu); ?>"/>
	<input type="hidden" id="pp_page_frame" name="pp_page_frame" value="<?php echo esc_attr($pp_page_frame); ?>"/>
	<input type="hidden" id="pp_menu_layout" name="pp_menu_layout" value="<?php echo esc_attr($pp_menu_layout); ?>"/>
	<input type="hidden" id="pp_image_path" name="pp_image_path" value="<?php echo get_template_directory_uri(); ?>/images/"/>
	<input type="hidden" id="pp_homepage_url" name="pp_homepage_url" value="<?php echo esc_url(home_url()); ?>"/>
	
	<!--Begin Template Frame -->
	<div class="fixed frame_top"></div>
	<div class="fixed frame_bottom"></div>
	<div class="fixed frame_left"></div>
	<div class="fixed frame_right"></div>
	<!--End Template Frame -->
	
	<!-- Begin mobile menu -->
	<div class="mobile_menu_wrapper">
	    <a id="close_mobile_menu" href="#"><i class="fa fa-times-circle"></i></a>
	    <?php 	
	    	if ( has_nav_menu( 'left-menu' ) ) 
	    	{
	    	    //Get page nav
	    	    wp_nav_menu( 
	    	        	array( 
	    	        		'menu_id'			=> 'mobile_main_menu1',
	    		    		'menu_class'		=> 'mobile_main_nav',
	    	        		'theme_location' 	=> 'left-menu',
	    	        	) 
	    	    ); 
	    	}
	    	
	    	if ( has_nav_menu( 'right-menu' ) ) 
	    	{
	    	    //Get page nav
	    	    wp_nav_menu( 
	    	        	array( 
	    	        		'menu_id'			=> 'mobile_main_menu2',
	    		    		'menu_class'		=> 'mobile_main_nav',
	    	        		'theme_location' 	=> 'right-menu',
	    	        	) 
	    	    ); 
	    	}
	    ?>
	</div>
	<!-- End mobile menu -->
	
	<?php
	    //Check if theme demo then enable layout switcher
	    if(THEMEDEMO)
	    {
	?>
	    <div id="option_wrapper">
	    <div class="inner">
	    	<div style="text-align:center">
	    	<a target="_blank" href="http://themeforest.net/item/photography-portfolio-gallery-vega-theme/9678282?ref=ThemeGoods&license=regular&open_purchase_for_item_id=9678282&purchasable=source&ref=ThemeGoods" class="button buy">BUY THIS THEME NOW!</a>
	    	<br/><br/><hr/>
	    	<h6 style="margin-top:10px;">Sample Demos</h6>
	    	<p> Vega is so powerful theme allow you to easily create your own style of photography and portfolio site. Here are example that can be imported with one click.</p>
	    	<ul class="demo_list">
	    		<li>
		    		<img src="<?php echo get_template_directory_uri(); ?>/cache/demos/vega_demo1.jpg" alt=""/>
		    		<div class="demo_thumb_hover_wrapper">
		    		    <div class="demo_thumb_hover_inner">
		    		    	<div class="demo_thumb_desc">
			    	    		<h6>Original</h6>
			    	    		<a href="http://themes.themegoods.com/vega/demo/" class="button white">Launch</a>
		    		    	</div> 
		    		    </div>	   
		    		</div>		   
	    		</li>
	    		<li>
		    		<img src="<?php echo get_template_directory_uri(); ?>/cache/demos/vega_demo2.jpg" alt=""/>
		    		<div class="demo_thumb_hover_wrapper">
		    		    <div class="demo_thumb_hover_inner">
		    		    	<div class="demo_thumb_desc">
			    	    		<h6>Minimal</h6>
			    	    		<a href="http://themes.themegoods.com/vega/demo/?vegastyle=2" target="_blank" class="button white">Launch</a>
		    		    	</div> 
		    		    </div>	   
		    		</div>		   
	    		</li>
	    		<li>
		    		<img src="<?php echo get_template_directory_uri(); ?>/cache/demos/vega_demo3.jpg" alt=""/>
		    		<div class="demo_thumb_hover_wrapper">
		    		    <div class="demo_thumb_hover_inner">
		    		    	<div class="demo_thumb_desc">
			    	    		<h6>Contrast</h6>
			    	    		<a href="http://themes.themegoods.com/vega/demo/?vegastyle=3" target="_blank" class="button white">Launch</a>
		    		    	</div> 
		    		    </div>	   
		    		</div>		   
	    		</li>
	    		<li>
		    		<img src="<?php echo get_template_directory_uri(); ?>/cache/demos/vega_demo4.jpg" alt=""/>
		    		<div class="demo_thumb_hover_wrapper">
		    		    <div class="demo_thumb_hover_inner">
		    		    	<div class="demo_thumb_desc">
			    	    		<h6>Left Align Menu</h6>
			    	    		<a href="http://themes.themegoods.com/vega/demo/homepage-6-revslider/?vegastyle=4" target="_blank" class="button white">Launch</a>
		    		    	</div> 
		    		    </div>	   
		    		</div>		   
	    		</li>
	    	</ul>
	    	</div>
	    </div>
	    </div>
	    <div id="option_btn">
	    	<i class="fa fa-cog fa-spin"></i>
	    </div>
	<?php
	    	wp_enqueue_script("script-demo", get_template_directory_uri()."/templates/script-demo.php", false, THEMEVERSION, true);
	    }
	?>

	<!-- Begin template wrapper -->
	<div id="wrapper">
	
		<!--Begin Template Menu -->
		<div class="top_bar">
		
			<div class="top_bar_wrapper">
			
				<div id="menu_wrapper">
					
					<div id="mobile_nav_icon"></div>
				
					<?php
						//include main menu layout
						get_template_part("/templates/template-menu");
					?>
		
				</div> 
			</div>
		
		</div> 