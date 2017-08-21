<?php 
header("content-type: application/x-javascript");
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );

$pp_contact_enable_captcha = get_option('pp_contact_enable_captcha');
?>
<?php
 if(!empty($pp_contact_enable_captcha))
 {
?>
 // refresh captcha
 jQuery('img#captcha-refresh').click(function() {  
     	
     	change_captcha();
 });
 
 function change_captcha()
 {
     document.getElementById('captcha').src="<?php echo get_template_directory_uri(); ?>/get_captcha.php?rnd=" + Math.random();
 }
 
 <?php
 }
?>

jQuery(document).ready(function() {
	jQuery('form#contact_form').submit(function() {
		jQuery('form#contact_form .error').remove();
		var hasError = false;
		jQuery('.required_field').each(function() {
			if(jQuery.trim(jQuery(this).val()) == '') {
				var labelText = jQuery(this).attr('placeholder');
				jQuery('#reponse_msg ul').append('<li class="error"><?php echo _e( 'Please enter', THEMEDOMAIN ); ?> '+labelText+'</li>');
				hasError = true;
			} else if(jQuery(this).hasClass('email')) {
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if(!emailReg.test(jQuery.trim(jQuery(this).val()))) {
					var labelText = jQuery(this).prev('label').text();
					jQuery('#reponse_msg ul').append('<li class="error"><?php echo _e( 'Please enter valid', THEMEDOMAIN ); ?> '+labelText+'</li>');
					hasError = true;
				}
			}
		});
		if(!hasError) {

			<?php
			if(!empty($pp_contact_enable_captcha))
			{
			?>
			var contactData = jQuery('#contact_form').serialize();
			
			jQuery.ajax({
			    type: 'POST',
			    url: '<?php echo get_template_directory_uri(); ?>/get_captcha.php?check=true',
			    data: jQuery('#contact_form').serialize(),
			    success: function(msg){
			    	if(msg == 'true')
			    	{
			    		jQuery('#contact_submit_btn').fadeOut('normal', function() {
							jQuery('#ajax_loading').addClass('visible');
						});
						
			    		jQuery.ajax({
						    type: 'POST',
						    url: tgAjax.ajaxurl,
						    data: contactData+'&tg_security='+tgAjax.ajax_nonce,
						    success: function(results){
						    	jQuery('#contact_form').hide();
						    	jQuery('#ajax_loading').removeClass('visible');
						    	jQuery('#reponse_msg').html(results);
						    }
						});
			    	}
			    	else
			    	{
			    		alert(msg);
			    		return false;
			    	}
			    }
			});
			<?php
 			} else {
 			?>
 			jQuery('#contact_submit_btn').fadeOut('normal', function() {
				jQuery(this).parent().append('<img src="<?php echo get_template_directory_uri(); ?>/images/loading.gif" alt="Loading" />');
			});
			
			var contactData = jQuery('#contact_form').serialize();
 			
 			jQuery.ajax({
			    type: 'POST',
			    url: tgAjax.ajaxurl,
			    data: contactData+'&tg_security='+tgAjax.ajax_nonce,
			    success: function(results){
			    	jQuery('#contact_form').hide();
			    	jQuery('#reponse_msg').html(results);
			    }
			});
 			<?php
			}
			?>
		}
		
		return false;
		
	});
});