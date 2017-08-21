<?php
//Check if display social profiles
$pp_social_profiles = get_option('pp_social_profiles');
if($pp_social_profiles != 'hide')
{
	//Check if open link in new window
    $pp_footer_social_link_blank = get_option('pp_footer_social_link_blank');
	
	if($pp_social_profiles == 'text')
	{
?>
<div class="social_wrapper">
    <ul>
    	<?php
    		$pp_facebook_username = get_option('pp_facebook_username');
    		
    		if(!empty($pp_facebook_username))
    		{
    	?>
    	<li class="facebook"><a <?php if(!empty($pp_footer_social_link_blank)) { ?>target="_blank"<?php } ?> href="<?php echo esc_url($pp_facebook_username); ?>"><?php _e( 'Facebook', THEMEDOMAIN ); ?></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_twitter_username = get_option('pp_twitter_username');
    		
    		if(!empty($pp_twitter_username))
    		{
    	?>
    	<li class="twitter"><a <?php if(!empty($pp_footer_social_link_blank)) { ?>target="_blank"<?php } ?> href="http://twitter.com/<?php echo $pp_twitter_username; ?>"><?php _e( 'Twitter', THEMEDOMAIN ); ?></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_flickr_username = get_option('pp_flickr_username');
    		
    		if(!empty($pp_flickr_username))
    		{
    	?>
    	<li class="flickr"><a <?php if(!empty($pp_footer_social_link_blank)) { ?>target="_blank"<?php } ?> title="Flickr" href="http://flickr.com/people/<?php echo $pp_flickr_username; ?>"><?php _e( 'Flickr', THEMEDOMAIN ); ?></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_youtube_username = get_option('pp_youtube_username');
    		
    		if(!empty($pp_youtube_username))
    		{
    	?>
    	<li class="youtube"><a <?php if(!empty($pp_footer_social_link_blank)) { ?>target="_blank"<?php } ?> title="Youtube" href="http://youtube.com/channel/<?php echo $pp_youtube_username; ?>"><?php _e( 'Youtube', THEMEDOMAIN ); ?></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_vimeo_username = get_option('pp_vimeo_username');
    		
    		if(!empty($pp_vimeo_username))
    		{
    	?>
    	<li class="vimeo"><a <?php if(!empty($pp_footer_social_link_blank)) { ?>target="_blank"<?php } ?> title="Vimeo" href="http://vimeo.com/<?php echo $pp_vimeo_username; ?>"><?php _e( 'Vimeo', THEMEDOMAIN ); ?></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_tumblr_username = get_option('pp_tumblr_username');
    		
    		if(!empty($pp_tumblr_username))
    		{
    	?>
    	<li class="tumblr"><a <?php if(!empty($pp_footer_social_link_blank)) { ?>target="_blank"<?php } ?> title="Tumblr" href="http://<?php echo $pp_tumblr_username; ?>.tumblr.com"><?php _e( 'Tumblr', THEMEDOMAIN ); ?></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_google_username = get_option('pp_google_username');
    		
    		if(!empty($pp_google_username))
    		{
    	?>
    	<li class="google"><a <?php if(!empty($pp_footer_social_link_blank)) { ?>target="_blank"<?php } ?> title="Google+" href="<?php echo esc_url($pp_google_username); ?>"><?php _e( 'Google+', THEMEDOMAIN ); ?></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_dribbble_username = get_option('pp_dribbble_username');
    		
    		if(!empty($pp_dribbble_username))
    		{
    	?>
    	<li class="dribbble"><a <?php if(!empty($pp_footer_social_link_blank)) { ?>target="_blank"<?php } ?> title="Dribbble" href="http://dribbble.com/<?php echo $pp_dribbble_username; ?>"><?php _e( 'Dribbble', THEMEDOMAIN ); ?></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_linkedin_username = get_option('pp_linkedin_username');
    		
    		if(!empty($pp_linkedin_username))
    		{
    	?>
    	<li class="linkedin"><a <?php if(!empty($pp_footer_social_link_blank)) { ?>target="_blank"<?php } ?> title="Linkedin" href="<?php echo esc_url($pp_linkedin_username); ?>"><?php _e( 'Linkedin', THEMEDOMAIN ); ?></a></li>
    	<?php
    		}
    	?>
    	<?php
            $pp_pinterest_username = get_option('pp_pinterest_username');
            
            if(!empty($pp_pinterest_username))
            {
        ?>
        <li class="pinterest"><a <?php if(!empty($pp_footer_social_link_blank)) { ?>target="_blank"<?php } ?> title="Pinterest" href="http://pinterest.com/<?php echo $pp_pinterest_username; ?>"><?php _e( 'Pinterest', THEMEDOMAIN ); ?></a></li>
        <?php
            }
        ?>
        <?php
        	$pp_instagram_username = get_option('pp_instagram_username');
        	
        	if(!empty($pp_instagram_username))
        	{
        ?>
        <li class="instagram"><a <?php if(!empty($pp_footer_social_link_blank)) { ?>target="_blank"<?php } ?> title="Instagram" href="http://instagram.com/<?php echo $pp_instagram_username; ?>"><?php _e( 'Instagram', THEMEDOMAIN ); ?></a></li>
        <?php
        	}
        ?>
        <?php
    	    $pp_behance_username = get_option('pp_behance_username');
    	    
    	    if(!empty($pp_behance_username))
    	    {
    	?>
    	<li class="behance"><a <?php if(!empty($pp_topbar_social_link_blank)) { ?>target="_blank"<?php } ?> title="Behance" href="http://behance.net/<?php echo $pp_behance_username; ?>"><?php _e( 'Behance', THEMEDOMAIN ); ?></a></li>
    	<?php
    	    }
    	?>
    	<?php
        	$pp_500px_username = get_option('pp_500px_username');
        	
        	if(!empty($pp_500px_username))
        	{
        ?>
        <li class="500px"><a <?php if(!empty($pp_footer_social_link_blank)) { ?>target="_blank"<?php } ?> title="500px" href="http://500px.com/<?php echo $pp_500px_username; ?>"><?php _e( '500px', THEMEDOMAIN ); ?></a></li>
        <?php
        	}
        ?>
    </ul>
</div>
<?php
	} //End if display as text
	elseif($pp_social_profiles == 'icon')
	{
?>
<div class="social_wrapper">
    <ul>
    	<?php
    		$pp_facebook_username = get_option('pp_facebook_username');
    		
    		if(!empty($pp_facebook_username))
    		{
    	?>
    	<li class="facebook"><a <?php if(!empty($pp_footer_social_link_blank)) { ?>target="_blank"<?php } ?> href="<?php echo esc_url($pp_facebook_username); ?>"><i class="fa fa-facebook"/></i></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_twitter_username = get_option('pp_twitter_username');
    		
    		if(!empty($pp_twitter_username))
    		{
    	?>
    	<li class="twitter"><a <?php if(!empty($pp_footer_social_link_blank)) { ?>target="_blank"<?php } ?> href="http://twitter.com/<?php echo $pp_twitter_username; ?>"><i class="fa fa-twitter"/></i></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_flickr_username = get_option('pp_flickr_username');
    		
    		if(!empty($pp_flickr_username))
    		{
    	?>
    	<li class="flickr"><a <?php if(!empty($pp_footer_social_link_blank)) { ?>target="_blank"<?php } ?> title="Flickr" href="http://flickr.com/people/<?php echo $pp_flickr_username; ?>"><i class="fa fa-flickr"/></i></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_youtube_username = get_option('pp_youtube_username');
    		
    		if(!empty($pp_youtube_username))
    		{
    	?>
    	<li class="youtube"><a <?php if(!empty($pp_footer_social_link_blank)) { ?>target="_blank"<?php } ?> title="Youtube" href="http://youtube.com/channel/<?php echo $pp_youtube_username; ?>"><i class="fa fa-youtube"/></i></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_vimeo_username = get_option('pp_vimeo_username');
    		
    		if(!empty($pp_vimeo_username))
    		{
    	?>
    	<li class="vimeo"><a <?php if(!empty($pp_footer_social_link_blank)) { ?>target="_blank"<?php } ?> title="Vimeo" href="http://vimeo.com/<?php echo $pp_vimeo_username; ?>"><i class="fa fa-vimeo-square"></i></i></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_tumblr_username = get_option('pp_tumblr_username');
    		
    		if(!empty($pp_tumblr_username))
    		{
    	?>
    	<li class="tumblr"><a <?php if(!empty($pp_footer_social_link_blank)) { ?>target="_blank"<?php } ?> title="Tumblr" href="http://<?php echo $pp_tumblr_username; ?>.tumblr.com"><i class="fa fa-tumblr"></i></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_google_username = get_option('pp_google_username');
    		
    		if(!empty($pp_google_username))
    		{
    	?>
    	<li class="google"><a <?php if(!empty($pp_footer_social_link_blank)) { ?>target="_blank"<?php } ?> title="Google+" href="<?php echo $pp_google_username; ?>"><i class="fa fa-google-plus"></i></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_dribbble_username = get_option('pp_dribbble_username');
    		
    		if(!empty($pp_dribbble_username))
    		{
    	?>
    	<li class="dribbble"><a <?php if(!empty($pp_footer_social_link_blank)) { ?>target="_blank"<?php } ?> title="Dribbble" href="http://dribbble.com/<?php echo $pp_dribbble_username; ?>"><i class="fa fa-dribbble"></i></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_linkedin_username = get_option('pp_linkedin_username');
    		
    		if(!empty($pp_linkedin_username))
    		{
    	?>
    	<li class="linkedin"><a <?php if(!empty($pp_footer_social_link_blank)) { ?>target="_blank"<?php } ?> title="Linkedin" href="<?php echo $pp_linkedin_username; ?>"><i class="fa fa-linkedin"></i></a></li>
    	<?php
    		}
    	?>
    	<?php
            $pp_pinterest_username = get_option('pp_pinterest_username');
            
            if(!empty($pp_pinterest_username))
            {
        ?>
        <li class="pinterest"><a <?php if(!empty($pp_footer_social_link_blank)) { ?>target="_blank"<?php } ?> title="Pinterest" href="http://pinterest.com/<?php echo $pp_pinterest_username; ?>"><i class="fa fa-pinterest"></i></a></li>
        <?php
            }
        ?>
        <?php
        	$pp_instagram_username = get_option('pp_instagram_username');
        	
        	if(!empty($pp_instagram_username))
        	{
        ?>
        <li class="instagram"><a <?php if(!empty($pp_footer_social_link_blank)) { ?>target="_blank"<?php } ?> title="Instagram" href="http://instagram.com/<?php echo $pp_instagram_username; ?>"><i class="fa fa-instagram"></i></a></li>
        <?php
        	}
        ?>
        <?php
    	    $pp_behance_url = get_option('pp_behance_url');
    	    
    	    if(!empty($pp_behance_url))
    	    {
    	?>
    	<li class="behance"><a <?php if(!empty($pp_footer_social_link_blank)) { ?>target="_blank"<?php } ?> title="Behance" href="<?php echo $pp_behance_url; ?>"><i class="fa fa-behance-square"></i></a></li>
    	<?php
    	    }
    	?>
    	<?php
        	$pp_500px_username = get_option('pp_500px_username');
        	
        	if(!empty($pp_500px_username))
        	{
        ?>
        <li class="500px"><a <?php if(!empty($pp_footer_social_link_blank)) { ?>target="_blank"<?php } ?> title="500px" href="http://500px.com/<?php echo $pp_500px_username; ?>"><i class="fa fa-500px"></i></a></li>
        <?php
        	}
        ?>
    </ul>
</div>
<?php
	}
} //End if display social profiles
?>