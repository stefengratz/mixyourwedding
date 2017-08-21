<?php

/**
*	Get Current page object
**/
$current_page = get_page($post->ID);
$current_page_id = '';

if(isset($current_page->ID))
{
    $current_page_id = $current_page->ID;
}

if(!is_home() && !is_archive() && !is_category() && !is_search() && !is_tag())
{
	//Check if hide header on this page
	$page_hide_header = get_post_meta($current_page_id, 'page_hide_header', true);
	
	if(empty($page_hide_header))
	{
		//Check if post has featured image
		$page_header_background = get_post_meta($current_page_id, 'page_header_background', true);
		$page_tagline = get_post_meta($current_page_id, 'page_tagline', true);
		$pp_page_bg = '';
		
		if(!empty($page_header_background) && empty($pp_contact_display_map))
		{
			/*$image_id = pp_get_image_id($page_header_background);
			$image_thumb = wp_get_attachment_image_src($image_id, 'original', true);
			$pp_page_bg = $image_thumb[0];
			
			$background_image = $image_thumb[0];
			$background_image_width = $image_thumb[1];
			$background_image_height = $image_thumb[2];*/
			$pp_page_bg = $page_header_background;
			$background_image = $page_header_background;
		?>
		<div id="page_caption" <?php if(!empty($pp_page_bg)) { ?> data-stellar-background-ratio="0.5" style="background-image:url('<?php echo esc_url($background_image); ?>');" class="hasbg parallax"<?php } ?>>
			<div id="page_caption_wrapper_bg">
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
		</div>
		<?php
		}
		else
		{
		?>
		<div id="page_caption">
			<div id="page_caption_wrapper">
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
		</div>
		<?php
		}
	}
}
else
{
	if(is_archive() && !is_category() && !is_tag())
	{
		$pp_bg_archives = get_option('pp_bg_archives');
		
		if ( is_day() ) : 
			$page_title = get_the_date(); 
	    elseif ( is_month() ) : 
	    	$page_title = get_the_date('F Y'); 
	    elseif ( is_year() ) : 
	    	$page_title = get_the_date('Y'); 
	    else :
	    	$page_title = __( 'Blog Archives', THEMEDOMAIN); 
	    endif; 
	    
	    $page_tagline = __( 'Posts archives ', THEMEDOMAIN );
		$pp_page_bg = '';
		
		if(!empty($pp_bg_archives))
		{
			$pp_page_bg = $pp_bg_archives;
			
			$image_id = pp_get_image_id($pp_page_bg);
			$image_thumb = wp_get_attachment_image_src($image_id, 'original', true);
			
			$pp_page_bg = $image_thumb[0];
			$background_image = $image_thumb[0];
			$background_image_width = $image_thumb[1];
			$background_image_height = $image_thumb[2];
		}
		?>
		<div id="page_caption" <?php if(!empty($pp_page_bg)) { ?> data-stellar-background-ratio="0.5" style="background-image:url('<?php echo esc_url($background_image); ?>');" class="hasbg parallax"<?php } ?>>
			<div <?php if(!empty($pp_page_bg)) { ?>id="page_caption_wrapper_bg"<?php } else { ?>id="page_caption_wrapper"<?php } ?>>
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
				<h1><?php echo $page_title; ?></h1>
			</div>
		</div>
<?php
	}
	elseif(is_category())
	{
		$pp_bg_categories = get_option('pp_bg_categories');
		
		$page_title = single_cat_title( '', false );
		$page_tagline = __( 'Posts category ', THEMEDOMAIN ).single_cat_title( '', false );
		
		if(!empty($pp_bg_categories))
		{
			$pp_page_bg = $pp_bg_categories;
			
			$image_id = pp_get_image_id($pp_page_bg);
			$image_thumb = wp_get_attachment_image_src($image_id, 'original', true);
			
			$pp_page_bg = $image_thumb[0];
			$background_image = $image_thumb[0];
			$background_image_width = $image_thumb[1];
			$background_image_height = $image_thumb[2];
		}
		?>
		<div id="page_caption" <?php if(!empty($pp_page_bg)) { ?> data-stellar-background-ratio="0.5" style="background-image:url('<?php echo esc_url($background_image); ?>');" class="hasbg parallax"<?php } ?>>
			<div <?php if(!empty($pp_page_bg)) { ?>id="page_caption_wrapper_bg"<?php } else { ?>id="page_caption_wrapper"<?php } ?>>
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
				<h1><?php echo $page_title; ?></h1>
			</div>
		</div>
<?php
	}
	elseif(is_search())
	{
		$pp_bg_search = get_option('pp_bg_search');
		
		$page_title = get_search_query();
		$page_tagline = __( 'Search Results for ', THEMEDOMAIN ).get_search_query();
		
		if(!empty($pp_bg_search))
		{
			$pp_page_bg = $pp_bg_search;
			
			$image_id = pp_get_image_id($pp_page_bg);
			$image_thumb = wp_get_attachment_image_src($image_id, 'original', true);
			
			$pp_page_bg = $image_thumb[0];
			$background_image = $image_thumb[0];
			$background_image_width = $image_thumb[1];
			$background_image_height = $image_thumb[2];
		}
		?>
		<div id="page_caption" <?php if(!empty($pp_page_bg)) { ?> data-stellar-background-ratio="0.5" style="background-image:url('<?php echo esc_url($background_image); ?>');" class="hasbg parallax"<?php } ?>>
			<div <?php if(!empty($pp_page_bg)) { ?>id="page_caption_wrapper_bg"<?php } else { ?>id="page_caption_wrapper"<?php } ?>>
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
				<h1><?php echo $page_title; ?></h1>
			</div>
		</div>
<?php
	}
	elseif(is_tag())
	{
		$pp_bg_tags = get_option('pp_bg_tags');
		
		$page_title = single_cat_title( '', false );
		$page_tagline = __( 'Posts tagged ', THEMEDOMAIN ).single_cat_title( '', false );
		
		if(!empty($pp_bg_tags))
		{
			$pp_page_bg = $pp_bg_tags;
			
			$image_id = pp_get_image_id($pp_page_bg);
			$image_thumb = wp_get_attachment_image_src($image_id, 'original', true);
			
			$pp_page_bg = $image_thumb[0];
			$background_image = $image_thumb[0];
			$background_image_width = $image_thumb[1];
			$background_image_height = $image_thumb[2];
		}
		?>
		<div id="page_caption" <?php if(!empty($pp_page_bg)) { ?> data-stellar-background-ratio="0.5" style="background-image:url('<?php echo esc_url($background_image); ?>');" class="hasbg parallax"<?php } ?>>
			<div <?php if(!empty($pp_page_bg)) { ?>id="page_caption_wrapper_bg"<?php } else { ?>id="page_caption_wrapper"<?php } ?>>
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
				<h1><?php echo $page_title; ?></h1>
			</div>
		</div>
<?php
	}
}
?>