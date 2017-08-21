<?php
/**
 * The main template file for display error page.
 *
 * @package WordPress
*/

if(session_id() == '') {
	session_start();
}

/**
*	Get current page id
**/
$current_page_id = '';

/**
*	Get Current page object
**/
$page = get_page($post->ID);

if(isset($page->ID))
{
    $current_page_id = $page->ID;
}

$notice_text = '';
if(isset($_POST['gallery_password']))
{
	//check gallery password
	$client_password = get_post_meta($current_page_id, 'client_password', true);
	
	if($_POST['gallery_password'] != $client_password)
	{
		$notice_text = __( 'Error Password is incorrect', THEMEDOMAIN );
	}
	else
	{	
		if(session_id() == '') {
			session_start();
		}
		$_SESSION['gallery_page_'.$current_page_id] = $current_page_id;
		
		$permalink = get_permalink($current_page_id);
		header("Location: ".$permalink);
		exit;
	}
}

global $pp_homepage_style;
$pp_homepage_style = 'password';

get_header(); 
?>

<br class="clear"/>

<div class="password_container">
	<div class="password_wrapper">
		<!-- Begin main content -->
	    <div class="vertical_center_wrapper transparentbg" style="text-align:center">
	    
	        <div class="lock_wrapper"><i class="fa fa-lock"></i></div>
	        
	        <p><?php _e( 'To view it please enter your password below', THEMEDOMAIN ); ?></p><br/>
	        	
	        <?php 
	            if(!empty($notice_text))
	            {
	        ?>
	            	<span class="error"><?php echo $notice_text; ?></span>
	        <?php
	            }
	        ?>
	        <form id="gallery_password_form" method="post" action="<?php echo curPageURL(); ?>">
	            <input id="gallery_password" name="gallery_password" type="password" placeholder="<?php echo esc_attr(__( 'Password', THEMEDOMAIN )); ?>" style="width:30%"/><br/><br/>
	            <input type="submit" value="Login" class="login_gallery"/>
	        </form>
	        
	    </div>
	</div>
</div>
<?php get_footer(); ?>