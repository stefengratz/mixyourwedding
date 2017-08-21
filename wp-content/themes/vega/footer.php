<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 */
?>
	
<?php
	/**
    *	Setup Google Analyric Code
    **/
    include (get_template_directory() . "/google-analytic.php");
?>

</div>

<div class="footer_bar">
	
	<!-- Begin logo -->	
	<?php
	    //get custom logo
	    $pp_logo = get_option('pp_footer_logo');
	    $pp_retina_logo = get_option('pp_footer_retina_logo');
	    $pp_retina_logo_width = 0;
	    $pp_retina_logo_height = 0;
	    
	    if(!empty($pp_retina_logo))
	    {
	    	if(empty($pp_retina_logo_width) && empty($pp_retina_logo_height))
	    	{
	    		//Get image width and height
	    		$pp_retina_logo_id = pp_get_image_id($pp_retina_logo);
	    		$image_logo = wp_get_attachment_image_src($pp_retina_logo_id, 'original');
	    		
	    		$pp_retina_logo = $image_logo[0];
	    		$pp_retina_logo_width = intval($image_logo[1]/2);
	    		$pp_retina_logo_height = intval($image_logo[2]/2);
	    	}
	    	
	    	if(isset($_GET['vegastyle']) && $_GET['vegastyle']==2 && THEMEDEMO) 
			{
				$pp_retina_logo = 'http://themes.themegoods.com/vega/wp-content/uploads/2014/11/photography-by-john-copy.png';
			}
	?>		
	    <a class="logo_wrapper" href="<?php echo home_url(); ?>">
	    	<img src="<?php echo esc_url($pp_retina_logo); ?>" alt="" width="<?php echo esc_attr($pp_retina_logo_width); ?>" height="<?php echo esc_attr($pp_retina_logo_height); ?>"/>
	    </a>
	<?php
	    }
	    elseif(!empty($pp_logo)) //if not retina logo
	    {
	?>
	    <a class="logo_wrapper" href="<?php echo home_url(); ?>">
	    	<img src="<?php echo esc_url($pp_logo); ?>" alt=""/>
	    </a>
	<?php
	    }
	?>
	<!-- End logo -->
	
	<?php
	global $pp_homepage_style;
	
	if($pp_homepage_style!='fullscreen')
	{
	    $pp_footer_display_sidebar = get_option('pp_footer_display_sidebar');
	
	    if(!empty($pp_footer_display_sidebar))
	    {
	    	$pp_footer_style = get_option('pp_footer_style');
	    	$footer_class = '';
	    	
	    	switch($pp_footer_style)
	    	{
	    		case 1:
	    			$footer_class = 'one';
	    		break;
	    		case 2:
	    			$footer_class = 'two';
	    		break;
	    		case 3:
	    			$footer_class = 'three';
	    		break;
	    		case 4:
	    			$footer_class = 'four';
	    		break;
	    		default:
	    			$footer_class = 'four';
	    		break;
	    	}
	    	
	    	global $pp_homepage_style;
	?>
	<div id="footer" class="<?php if(isset($pp_homepage_style) && !empty($pp_homepage_style)) { echo esc_attr($pp_homepage_style); } ?>">
	<ul class="sidebar_widget <?php echo esc_attr($footer_class); ?>">
	    <?php dynamic_sidebar('Footer Sidebar'); ?>
	</ul>
	
	<br class="clear"/>
	</div>
	<?php
	    }
	}
	?>

	<?php
		global $pp_homepage_style;
	?>
    <div class="footer_bar_wrapper">
    	<?php
			if($pp_homepage_style!='fullscreen')
			{	
				get_template_part("/templates/template-social");
			}
		?>
    
        <?php
            $pp_footer_text = get_option('pp_footer_text');
            if(!empty($pp_footer_text))
            {
            	echo '<div id="copyright">'.htmlspecialchars_decode((stripslashes($pp_footer_text))).'</div>';
            }
        ?>
    </div>
    
</div>

<?php
	$totop_class = '';
	if(!is_null($post) && has_post_thumbnail($post->ID, 'original'))
	{
		$totop_class = 'withbg';
	}
	
	$pp_enable_totop = get_option('pp_enable_totop');
	
	if(!empty($pp_enable_totop))
	{
?>
<div id="toTop" class="<?php echo $totop_class; ?>">
	<i class="fa fa-angle-up"></i>
</div>
<?php
	}
?>
<div id="overlay_background"></div>

<?php
	/**
    *	Setup code before </body>
    **/
	$pp_before_body_code = get_option('pp_before_body_code');
	
	if(!empty($pp_before_body_code))
	{
		echo stripslashes($pp_before_body_code);
	}
?>

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
