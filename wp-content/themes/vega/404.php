<?php
/**
 * The main template file for display error page.
 *
 * @package WordPress
*/

global $pp_homepage_style;
$pp_homepage_style = 'password';

get_header(); 
?>

<br class="clear"/>
<div class="password_container">
	<div class="password_wrapper">
		<!-- Begin main content -->
	    <div class="vertical_center_wrapper transparentbg" style="text-align:center">
	    
	        <div class="lock_wrapper"><i class="fa fa-exclamation"></i></div>
	        
	        <p><?php _e( 'Apologies, but the content you requested could not be found.', THEMEDOMAIN ); ?></p><br/>
	        
	    </div>
	</div>
</div>
<?php get_footer(); ?>