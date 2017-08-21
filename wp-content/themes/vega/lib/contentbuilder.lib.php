<?php
function ppb_text_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'custom_css' => '',
	), $atts));

	$return_html = '<div class="'.esc_attr($size).'" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode(esc_attr($custom_css)).'" ';
	}
	
	$return_html.= '><div class="page_content_wrapper"><div class="inner">';
	//Display Title
	if(!empty($title))
	{
		$return_html.= '<h2 class="ppb_title">'.rawurldecode($title).'</h2>';
	}
	
	$return_html.= do_shortcode(tg_apply_content($content)).'</div></div>';
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_text', 'ppb_text_func');


function ppb_divider_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one'
	), $atts));

	$return_html = '<br class="clear">';

	return $return_html;

}

add_shortcode('ppb_divider', 'ppb_divider_func');


function ppb_blog_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'cat' => '',
		'items' => '',
		'custom_css' => '',
	), $atts));
	
	$return_html = '<div class="'.esc_attr($size).'" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode(esc_attr($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	$return_html.= '<div class="page_content_wrapper"><div class="inner">';
	
	//Display Title
	if(!empty($title))
	{
		$return_html.= '<h2 class="ppb_title">'.$title.'</h2>';
	}
	
	if(!empty($content))
	{
		$return_html.= do_shortcode(tg_apply_content($content)).'<br class="clear"/><br/>';
	}
	
	if(!is_numeric($items))
	{
		$items = 3;
	}
	
	//Get blog posts
	$args = array(
	    'numberposts' => $items,
	    'order' => 'DESC',
	    'orderby' => 'post_date',
	    'post_type' => array('post'),
	    'suppress_filters' => 0,
	);

	if(!empty($cat))
	{
		$args['category'] = $cat;
	}
	$posts_arr = get_posts($args);
	
	if(!empty($posts_arr) && is_array($posts_arr))
	{
		$return_html.= '<div class="blog_grid_wrapper">';
	
		foreach($posts_arr as $key => $ppb_post)
		{
			$image_thumb = '';
										
			if(has_post_thumbnail($ppb_post->ID, 'large'))
			{
			    $image_id = get_post_thumbnail_id($ppb_post->ID);
			    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
			}
			
			$return_html.= '
			<div id="post-'.$ppb_post->ID.'" class="post type-post">
				<div class="post_wrapper grid_layout">';
			
			if(!empty($image_thumb))
			{
			    $small_image_url = wp_get_attachment_image_src($image_id, 'gallery_c', true);
			    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			    
			    $return_html.= '
			    	<div class="post_img">
					    <a href="'.esc_url(get_permalink($ppb_post->ID)).'">
					    	<img src="'.esc_url($small_image_url[0]).'" alt="'.esc_attr($image_alt).'" class=""/>
					    </a>
					</div>';
			}
			
			$return_html.= '<div class="post_header grid_layout">';
			
			//Get Post's Categories
			$post_categories = wp_get_post_categories($ppb_post->ID);
			if(!empty($post_categories))
			{
				$return_html.= '<div class="post_subtitle">';
				
				foreach($post_categories as $c)
				{
				    $cat = get_category( $c );
				 	
				 	$return_html.= '<a href="'.esc_url(get_category_link($cat->term_id)).'">'.$cat->name.'</a>&nbsp;';   
				}
				
				$return_html.= '</div>';
			}
			
			$return_html.= '<h5><a href="'.esc_url(get_permalink($ppb_post->ID)).'" title="'.esc_attr(get_the_title($ppb_post->ID)).'">'.get_the_title($ppb_post->ID).'</a></h5>';
			
			$return_html.= '<div class="post_detail">';
			$return_html.= get_the_time(THEMEDATEFORMAT, $ppb_post->ID).'&nbsp;';
			
			//Get post author meta
			$author_name = get_the_author_meta('display_name', $ppb_post->post_author);
			$author_url = get_the_author_meta('user_url', $ppb_post->post_author);
			if(!empty($author_name))
			{
				$return_html.= __( 'by', THEMEDOMAIN ).'&nbsp;<a href="'.esc_url($author_url).'">'.$author_name.'</a>&nbsp;';
			}			    	
			
			$return_html.= '</div>';
			$return_html.= '</div><br class="clear"/><br/>';
			
			$post_excerpt = pp_get_the_excerpt($ppb_post->ID);
			$return_html.= pp_substr(strip_shortcodes($post_excerpt), 100).'<br/><br/><br/>
				    		<a class="readmore button transparent" href="'.esc_url(get_permalink($ppb_post->ID)).'">'.__( 'Read More', THEMEDOMAIN ).'</a>';
		    
		    $return_html.= '
			    </div>    
			</div>';
		}
		
		$return_html.= '</div>';
	}
	
	$return_html.= '<br class="clear"/></div></div></div>';
	
	return $return_html;
}

add_shortcode('ppb_blog', 'ppb_blog_func');


function ppb_portfolio_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'cat' => '',
		'items' => '',
		'custom_css' => '',
	), $atts));
	
	$return_html = '<div class="'.esc_attr($size).'" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode(esc_attr($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	$return_html.= '<div class="page_content_wrapper"><div class="inner">';
	
	//Display Title
	if(!empty($title))
	{
		$return_html.= '<h2 class="ppb_title">'.$title.'</h2>';
	}
	
	if(!empty($content))
	{
		$return_html.= do_shortcode(tg_apply_content($content)).'<br class="clear"/><br/>';
	}
	
	if(!is_numeric($items))
	{
		$items = 3;
	}
	
	//Get blog posts
	$args = array(
	    'numberposts' => $items,
	    'order' => 'DESC',
	    'orderby' => 'post_date',
	    'post_type' => array('portfolios'),
	    'suppress_filters' => 0,
	);

	if(!empty($cat))
	{
		$args['portfoliosets'] = $cat;
	}
	$posts_arr = get_posts($args);
	
	if(!empty($posts_arr) && is_array($posts_arr))
	{
		$return_html.= '<div class="blog_grid_wrapper">';
	
		foreach($posts_arr as $key => $ppb_post)
		{
			$image_url = '';
			$portfolio_ID = $ppb_post->ID;
			    	
			if(has_post_thumbnail($portfolio_ID, 'original'))
			{
			    $image_id = get_post_thumbnail_id($portfolio_ID);
			    $image_url = wp_get_attachment_image_src($image_id, 'original', true);
			    $small_image_url = wp_get_attachment_image_src($image_id, 'gallery_c', true);
			}
			
			$portfolio_link_url = get_post_meta($portfolio_ID, 'portfolio_link_url', true);
			
			if(empty($portfolio_link_url))
			{
			    $permalink_url = get_permalink($portfolio_ID);
			}
			else
			{
			    $permalink_url = $portfolio_link_url;
			}
			
			//Get portfolio type
			$portfolio_type = get_post_meta($portfolio_ID, 'portfolio_type', true);
			
			$return_html.= '
			<div class="wall_entry type-post post gallery masonry element" data-id="post-'.$ppb_post->ID.'">';
			
			if(!empty($image_url[0]))
			{
				$return_html.= 
				'<div class="wall_thumbnail">
			    	<div class="image_grid_frame">
				    	<div class="image_wrapper">';
			
			    $small_image_url = wp_get_attachment_image_src($image_id, 'gallery_c', true);
			    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			    
			    $portfolio_video_id = get_post_meta($portfolio_ID, 'portfolio_video_id', true);
							    
				switch($portfolio_type)
				{
					case 'Image':
					default:
						$return_html.= '
						<img src="'.$small_image_url[0].'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/> 	
				        <div class="mask">
				    	    <div class="mask_frame">
				    	    	<div class="mask_image_content">
				    	    		<div class="mask_image_content_frame">
				    	    			<a href="'.esc_url($image_url[0]).'" class="fancy-gallery">
						    				<i class="fa fa-search-plus"></i>
				    	    			</a>
				    	    		</div>
				    	    	</div>
				    	    </div>
				    	</div>
						';	
					break;
					
					case 'External Link':
						$return_html.= '
						<img src="'.$small_image_url[0].'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/> 	
				        <div class="mask">
				    	    <div class="mask_frame">
				    	    	<div class="mask_image_content">
				    	    		<div class="mask_image_content_frame">
				    	    			<a target="_blank" href="'.esc_url($permalink_url).'">
						    				<i class="fa fa-search-plus"></i>
				    	    			</a>
				    	    		</div>
				    	    	</div>
				    	    </div>
				    	</div>
						';	
					break;
					
					case 'Portfolio Content':
						$return_html.= '
						<img src="'.$small_image_url[0].'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/> 	
				        <div class="mask">
				    	    <div class="mask_frame">
				    	    	<div class="mask_image_content">
				    	    		<div class="mask_image_content_frame">
				    	    			<a href="'.esc_url($permalink_url).'">
						    				<i class="fa fa-search-plus"></i>
				    	    			</a>
				    	    		</div>
				    	    	</div>
				    	    </div>
				    	</div>
						';	
					break;
					
					case 'Youtube Video':
						$return_html.= '
						<img src="'.$small_image_url[0].'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/> 	
				        <div class="mask">
				    	    <div class="mask_frame">
				    	    	<div class="mask_image_content">
				    	    		<div class="mask_image_content_frame">
				    	    			<a href="#video_'.$portfolio_video_id.'" class="fancy_video">
						    				<i class="fa fa-search-plus"></i>
				    	    			</a>
				    	    		</div>
				    	    	</div>
				    	    </div>
				    	</div>
				    	
				    	<div style="display:none;">
						    <div id="video_'.$portfolio_video_id.'" class="lightbox_video_wrapper">
						        
						        <iframe title="YouTube video player" width="960" height="540" src="http://www.youtube.com/embed/'.$portfolio_video_id.'?theme=dark&rel=0&wmode=transparent" frameborder="0" allowfullscreen></iframe>
						        
						    </div>	
						</div>
						';	
					break;
					
					case 'Vimeo Video':
						$return_html.= '
						<img src="'.$small_image_url[0].'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/> 	
				        <div class="mask">
				    	    <div class="mask_frame">
				    	    	<div class="mask_image_content">
				    	    		<div class="mask_image_content_frame">
				    	    			<a href="#video_'.$portfolio_video_id.'" class="fancy_video">
						    				<i class="fa fa-search-plus"></i>
				    	    			</a>
				    	    		</div>
				    	    	</div>
				    	    </div>
				    	</div>
				    	
				    	<div style="display:none;">
						    <div id="video_'.$portfolio_video_id.'" class="lightbox_video_wrapper">
						        
						        <iframe src="http://player.vimeo.com/video/'.$portfolio_video_id.'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="960" height="540" frameborder="0"></iframe>
						        
						    </div>	
						</div>
						';	
					break;
					
					case 'Self-Hosted Video':
						$return_html.= '
						<img src="'.$small_image_url[0].'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/> 	
				        <div class="mask">
				    	    <div class="mask_frame">
				    	    	<div class="mask_image_content">
				    	    		<div class="mask_image_content_frame">
				    	    			<a href="#video_self_'.$portfolio_video_id.'" class="fancy_video">
						    				<i class="fa fa-search-plus"></i>
				    	    			</a>
				    	    		</div>
				    	    	</div>
				    	    </div>
				    	</div>
				    	
				    	<div style="display:none;">
						    <div id="video_self_'.$portfolio_video_id.'" class="lightbox_video_wrapper">
						        
						        '.do_shortcode('[tg_video video_src="'.$portfolio_mp4_url.'" img_src="'.$small_image_url[0].'"]').'
						        
						    </div>	
						</div>
						';	
					break;
				}
				
				$return_html.= '</div>
						<br class="clear"/>
		    			<div class="image_caption">'.get_the_title($portfolio_ID).'</div>';
					    		
				$return_html.= '
					</div>
				</div>';
			}
		    
		    $return_html.= '
			    </div>';
		}
		
		$return_html.= '</div>';
	}
	
	$return_html.= '<br class="clear"/></div></div></div>';
	
	return $return_html;
}

add_shortcode('ppb_portfolio', 'ppb_portfolio_func');


function ppb_portfolio_masonry_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'cat' => '',
		'items' => '',
		'custom_css' => '',
	), $atts));
	
	$return_html = '<div class="'.esc_attr($size).'" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode(esc_attr($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	$return_html.= '<div class="page_content_wrapper"><div class="inner">';
	
	//Display Title
	if(!empty($title))
	{
		$return_html.= '<h2 class="ppb_title">'.$title.'</h2>';
	}
	
	if(!empty($content))
	{
		$return_html.= do_shortcode(tg_apply_content($content)).'<br class="clear"/><br/>';
	}
	
	if(!is_numeric($items))
	{
		$items = 3;
	}
	
	//Get blog posts
	$args = array(
	    'numberposts' => $items,
	    'order' => 'DESC',
	    'orderby' => 'post_date',
	    'post_type' => array('portfolios'),
	    'suppress_filters' => 0,
	);

	if(!empty($cat))
	{
		$args['portfoliosets'] = $cat;
	}
	$posts_arr = get_posts($args);
	
	if(!empty($posts_arr) && is_array($posts_arr))
	{
		$return_html.= '<div class="blog_grid_wrapper">';
	
		foreach($posts_arr as $key => $ppb_post)
		{
			$image_url = '';
			$portfolio_ID = $ppb_post->ID;
			    	
			if(has_post_thumbnail($portfolio_ID, 'original'))
			{
			    $image_id = get_post_thumbnail_id($portfolio_ID);
			    $image_url = wp_get_attachment_image_src($image_id, 'original', true);
			    $small_image_url = wp_get_attachment_image_src($image_id, 'gallery_cm', true);
			}
			
			$portfolio_link_url = get_post_meta($portfolio_ID, 'portfolio_link_url', true);
			
			if(empty($portfolio_link_url))
			{
			    $permalink_url = get_permalink($portfolio_ID);
			}
			else
			{
			    $permalink_url = $portfolio_link_url;
			}
			
			//Get portfolio type
			$portfolio_type = get_post_meta($portfolio_ID, 'portfolio_type', true);
			
			$return_html.= '
			<div class="wall_entry type-post post gallery masonry element" data-id="post-'.$ppb_post->ID.'">';
			
			if(!empty($image_url[0]))
			{
				$return_html.= 
				'<div class="wall_thumbnail">
			    	<div class="image_grid_frame">
				    	<div class="image_wrapper">';
			
			    $small_image_url = wp_get_attachment_image_src($image_id, 'gallery_cm', true);
			    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			    
			    $portfolio_video_id = get_post_meta($portfolio_ID, 'portfolio_video_id', true);
							    
				switch($portfolio_type)
				{
					case 'Image':
					default:
						$return_html.= '
						<img src="'.$small_image_url[0].'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/> 	
				        <div class="mask">
				    	    <div class="mask_frame">
				    	    	<div class="mask_image_content">
				    	    		<div class="mask_image_content_frame">
				    	    			<a href="'.esc_url($image_url[0]).'" class="fancy-gallery">
						    				<i class="fa fa-search-plus"></i>
				    	    			</a>
				    	    		</div>
				    	    	</div>
				    	    </div>
				    	</div>
						';	
					break;
					
					case 'External Link':
						$return_html.= '
						<img src="'.$small_image_url[0].'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/> 	
				        <div class="mask">
				    	    <div class="mask_frame">
				    	    	<div class="mask_image_content">
				    	    		<div class="mask_image_content_frame">
				    	    			<a target="_blank" href="'.esc_url($permalink_url).'">
						    				<i class="fa fa-search-plus"></i>
				    	    			</a>
				    	    		</div>
				    	    	</div>
				    	    </div>
				    	</div>
						';	
					break;
					
					case 'Portfolio Content':
						$return_html.= '
						<img src="'.$small_image_url[0].'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/> 	
				        <div class="mask">
				    	    <div class="mask_frame">
				    	    	<div class="mask_image_content">
				    	    		<div class="mask_image_content_frame">
				    	    			<a href="'.esc_url($permalink_url).'">
						    				<i class="fa fa-search-plus"></i>
				    	    			</a>
				    	    		</div>
				    	    	</div>
				    	    </div>
				    	</div>
						';	
					break;
					
					case 'Youtube Video':
						$return_html.= '
						<img src="'.$small_image_url[0].'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/> 	
				        <div class="mask">
				    	    <div class="mask_frame">
				    	    	<div class="mask_image_content">
				    	    		<div class="mask_image_content_frame">
				    	    			<a href="#video_'.$portfolio_video_id.'" class="fancy_video">
						    				<i class="fa fa-search-plus"></i>
				    	    			</a>
				    	    		</div>
				    	    	</div>
				    	    </div>
				    	</div>
				    	
				    	<div style="display:none;">
						    <div id="video_'.$portfolio_video_id.'" class="lightbox_video_wrapper">
						        
						        <iframe title="YouTube video player" width="960" height="540" src="http://www.youtube.com/embed/'.$portfolio_video_id.'?theme=dark&rel=0&wmode=transparent" frameborder="0" allowfullscreen></iframe>
						        
						    </div>	
						</div>
						';	
					break;
					
					case 'Vimeo Video':
						$return_html.= '
						<img src="'.$small_image_url[0].'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/> 	
				        <div class="mask">
				    	    <div class="mask_frame">
				    	    	<div class="mask_image_content">
				    	    		<div class="mask_image_content_frame">
				    	    			<a href="#video_'.$portfolio_video_id.'" class="fancy_video">
						    				<i class="fa fa-search-plus"></i>
				    	    			</a>
				    	    		</div>
				    	    	</div>
				    	    </div>
				    	</div>
				    	
				    	<div style="display:none;">
						    <div id="video_'.$portfolio_video_id.'" class="lightbox_video_wrapper">
						        
						        <iframe src="http://player.vimeo.com/video/'.$portfolio_video_id.'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="960" height="540" frameborder="0"></iframe>
						        
						    </div>	
						</div>
						';	
					break;
					
					case 'Self-Hosted Video':
						$return_html.= '
						<img src="'.$small_image_url[0].'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/> 	
				        <div class="mask">
				    	    <div class="mask_frame">
				    	    	<div class="mask_image_content">
				    	    		<div class="mask_image_content_frame">
				    	    			<a href="#video_self_'.$portfolio_video_id.'" class="fancy_video">
						    				<i class="fa fa-search-plus"></i>
				    	    			</a>
				    	    		</div>
				    	    	</div>
				    	    </div>
				    	</div>
				    	
				    	<div style="display:none;">
						    <div id="video_self_'.$portfolio_video_id.'" class="lightbox_video_wrapper">
						        
						        '.do_shortcode('[tg_video video_src="'.$portfolio_mp4_url.'" img_src="'.$small_image_url[0].'"]').'
						        
						    </div>	
						</div>
						';	
					break;
				}
				
				$return_html.= '</div>
						<br class="clear"/>
		    			<div class="image_caption">'.get_the_title($portfolio_ID).'</div>';
					    		
				$return_html.= '
					</div>
				</div>';
			}
		    
		    $return_html.= '
			    </div>';
		}
		
		$return_html.= '</div>';
	}
	
	$return_html.= '<br class="clear"/></div></div></div>';
	
	return $return_html;
}

add_shortcode('ppb_portfolio_masonry', 'ppb_portfolio_masonry_func');


function ppb_gallery_slider_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'gallery' => '',
		'autoplay' => 0,
		'caption' => 0,
		'timer' => 5,
		'custom_css' => '',
	), $atts));
	
	$return_html = '<div class="'.esc_attr($size).'" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode(esc_attr($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Display Title
	if(!empty($title))
	{
		$return_html.= '<h2 class="ppb_title">'.$title.'</h2>';
	}
	
	$return_html.= do_shortcode('[tg_gallery_slider gallery_id="'.esc_attr($gallery).'" size="full" autoplay="'.esc_attr($autoplay).'" caption="'.esc_attr($caption).'" timer="'.esc_attr($timer).'"]');
	
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('ppb_gallery_slider', 'ppb_gallery_slider_func');


function ppb_gallery_slider_fixed_width_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'gallery' => '',
		'autoplay' => 0,
		'caption' => 0,
		'timer' => 5,
		'custom_css' => '',
	), $atts));
	
	$return_html = '<div class="'.esc_attr($size).'" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode(esc_attr($custom_css)).'" ';
	}
	
	$return_html.= '><div class="page_content_wrapper nopadding"><div class="inner">';
	
	//Display Title
	if(!empty($title))
	{
		$return_html.= '<h2 class="ppb_title">'.$title.'</h2>';
	}
	
	$return_html.= do_shortcode('[tg_gallery_slider gallery_id="'.esc_attr($gallery).'" size="full" autoplay="'.esc_attr($autoplay).'" caption="'.esc_attr($caption).'"  timer="'.esc_attr($timer).'"]');
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('ppb_gallery_slider_fixed_width', 'ppb_gallery_slider_fixed_width_func');


function ppb_gallery_horizontal_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'gallery' => '',
		'items' => -1,
		'custom_css' => '',
	), $atts));
	
	$return_html = '<div class="'.esc_attr($size).'" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode(esc_attr($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Get gallery images
	$all_photo_arr = get_post_meta($gallery, 'wpsimplegallery_gallery', true);
	
	//Get global gallery sorting
	$all_photo_arr = pp_resort_gallery_img($all_photo_arr);
	
	if(!empty($all_photo_arr) && is_array($all_photo_arr))
	{
		$gallery_excerpt = get_post_field('post_excerpt', $gallery);
	
		$return_html.= '
		<div id="horizontal_gallery">
			<table id="horizontal_gallery_wrapper">
				<tbody><tr>';
			
		$return_html.= '
		<td style="padding:30px;">
			<div class="horizontal_gallery_info">
				<div class="page_tagline">'.$gallery_excerpt.'</div>
				<h1>'.get_the_title($gallery).'</h1>
			</div>
		</td>';
		
		foreach($all_photo_arr as $photo_id)
		{
		    $small_image_url = '';
		    $hyperlink_url = get_permalink($photo_id);
		    $thumb_image_url = '';
		    
		    if(!empty($photo_id))
		    {
		    	$image_url = wp_get_attachment_image_src($photo_id, 'original', true);
		    }
		    
		    //Get image meta data
		    $image_caption = get_post_field('post_excerpt', $photo_id);
		    $image_description = get_post_field('post_content', $photo_id);
		    $pp_image_lightbox_title = get_option('pp_image_lightbox_title');
		    $image_alt = get_post_meta($photo_id, '_wp_attachment_image_alt', true);
		 
		 	$return_html.= '<td style="padding:30px;">';
		 	
		 	if(isset($image_url[0]) && !empty($image_url[0]))
	    	{
	    		$return_html.= '<a ';
	    		
	    		if(!empty($pp_image_lightbox_title)) 
	    		{ 
	    			$return_html.= 'title="';
	    			
	    			if(!empty($image_caption)) 
	    			{ 
	    				$return_html.= esc_attr($image_caption);
	    			} 
	    			
	    			$return_html.= '"';
	    		} 
	    			$return_html.= 'class="fancy-gallery" href="'.esc_url($image_url[0]).'">
			    	<div class="gallery_image_wrapper">
				    	<img src="'.esc_url($image_url[0]).'" alt="'.esc_attr($image_alt).'" class="horizontal_gallery_img"/>';
				    	
				    	if(!empty($pp_image_lightbox_title)) 
				    	{
				    	$return_html.= '<div class="image_caption">'.$image_caption.'</div>
				    	<div class="image_description">'.$image_description.'</div>';
				    	}
			    	$return_html.= '</div>
	    	</a>';
	    	}
		 	
		 	$return_html.= '</td>';   
		}
			
		$return_html.= '
				</tr></tbody>
			</table>
		</div>
		';
	}
	
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('ppb_gallery_horizontal', 'ppb_gallery_horizontal_func');


function ppb_gallery_wall_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'gallery' => '',
		'layout' => 'fullwidth',
		'items' => -1,
		'custom_css' => '',
	), $atts));
	
	$return_html = '<div class="'.esc_attr($size).'" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode(esc_attr($custom_css)).'" ';
	}
	
	$return_html.= '>';
	
	//Check if fixed width layout
	if($layout=='fixed_width')
	{
		$return_html.= '<div class="page_content_wrapper"><div class="inner">';
	}
	
	//Display Title
	if(!empty($title))
	{
		$return_html.= '<h2 class="ppb_title">'.$title.'</h2>';
	}
	
	//Get images from selected gallery
	if(!empty($gallery))
	{
		$images_arr = get_post_meta($gallery, 'wpsimplegallery_gallery', true);
		
		if(!empty($images_arr) && is_array($images_arr))
		{
			$return_html.= '<div class="photo_wall_wrapper">';
			$counter = 1;
		
			foreach($images_arr as $key => $image)
			{
				if($items > 0 && $counter<=$items)
				{
					$return_html.= '<div class="wall_entry masonry">';
				
					$image_url = wp_get_attachment_image_src($image, 'gallery_c', true);
					$full_image_url = wp_get_attachment_image_src($image, 'original', true);
					$image_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
					
					if(isset($image_url[0]) && !empty($image_url[0]))
					{
						$return_html.= '<div class="wall_thumbnail">
						<a rel="gallery" class="fancy-gallery"" href="'.esc_url($full_image_url[0]).'">
				    		<img src="'.esc_url($image_url[0]).'" alt="'.esc_attr($image_alt).'" class="portfolio_img static"/>
				    	</a>
				    	</div>';
					}
					
					$return_html.= '</div>';
					$counter++;
				}
			}
			
			$return_html.= '</div>';
		}
	}
	else
	{
		$return_html.= 'Empty gallery item. Please make sure you have upload image to it.';
	}
	
	//Check if fixed width layout
	if($layout=='fixed_width')
	{
		$return_html.= '</div>';
		$return_html.= '</div>';
	}
	$return_html.= '</div>';
	
	return $return_html;
}

add_shortcode('ppb_gallery_wall', 'ppb_gallery_wall_func');


function ppb_galleries_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'cat' => '',
		'items' => '',
		'custom_css' => '',
	), $atts));
	
	if(!is_numeric($items))
	{
		$items = 3;
	}

	$return_html = '<div class="'.esc_attr($size).' ppb_galleries" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode(esc_attr($custom_css)).'" ';
	}
	
	$return_html.= '><div class="page_content_wrapper"><div class="inner">';
	//Display Title
	if(!empty($title))
	{
		$return_html.= '<h2 class="ppb_title">'.$title.'</h2>';
	}
	
	//Display galleries items
	$args = array(
	    'numberposts' => $items,
	    'order' => 'ASC',
	    'orderby' => 'menu_order',
	    'post_type' => array('galleries'),
	    'suppress_filters' => 0,
	);
	
	if(!empty($cat))
	{
		$args['gallerycat'] = $cat;
	}
	$galleris_arr = get_posts($args);
	
	if(!empty($galleris_arr) && is_array($galleris_arr))
	{
		//Check if disable slideshow hover effect
		$pp_gallery_disable_hover_slide = get_option( "pp_gallery_disable_hover_slide" );
		
		if(empty($pp_gallery_disable_hover_slide))
		{
			wp_enqueue_script("jquery.cycle2.min", get_template_directory_uri()."/js/jquery.cycle2.min.js", false, THEMEVERSION, true);
			wp_enqueue_script("custom_cycle", get_template_directory_uri()."/js/custom_cycle.js", false, THEMEVERSION, true);
		}
		
		$return_html.= '<div class="blog_grid_wrapper">';
		
		foreach($galleris_arr as $key => $gallery)
		{
			$image_url = '';
			$gallery_ID = $gallery->ID;
			    	
			if(has_post_thumbnail($gallery_ID, 'original'))
			{
			    $image_id = get_post_thumbnail_id($gallery_ID);
			    $small_image_url = wp_get_attachment_image_src($image_id, 'gallery_c', true);
			}
			
			$permalink_url = get_permalink($gallery_ID);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			
			$return_html.= '<div class="wall_entry type-post post gallery masonry element">';
			if(!empty($small_image_url[0]))
			{
				$all_photo_arr = array();
						
				if(empty($pp_gallery_disable_hover_slide))
				{
				    //Get gallery images
				    $all_photo_arr = get_post_meta($gallery_ID, 'wpsimplegallery_gallery', true);
				    
				    //Get only 5 recent photos
				    $all_photo_arr = array_slice($all_photo_arr, 0, 5);
				}
			    
			    $return_html.= '<div class="image_grid_frame">
				    <div class="wall_thumbnail post_archive">
				    	<a href="'.esc_url($permalink_url).'" class="gallery_wrapper">
				    		<img src="'.esc_url($small_image_url[0]).'" alt="'.esc_attr($image_alt).'" class="portfolio_img static"/>
				            <div class="mask transparent">
							    <div class="mask_frame">';

				if(!empty($all_photo_arr))
				{

					 $return_html.= '<ul class="gallery_img_slides">';

					foreach($all_photo_arr as $photo)
					{
						$slide_image_url = wp_get_attachment_image_src($photo, 'gallery_c', true);
						$return_html.= '<li><img src="'.esc_url($slide_image_url[0]).'" alt="" class="static"/></li>';
					}
					
					$return_html.= '</ul>';
				}

				$return_html.= '</div>
							</div>
						</a>
						<br class="clear"/>
						<h6>'.$gallery->post_title.'</h6>
		    			<div class="gallery_excerpt">'.strip_tags(pp_get_the_excerpt($gallery_ID)).'</div>
				    </div>
			    </div>';
			}
			$return_html.= '</div>';
		}
		
		$return_html.= '</div>';
	}
	
	$return_html.= '</div></div>';
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_galleries', 'ppb_galleries_func');


function ppb_image_fullwidth_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'image' => '',
		'height' => 400,
		'display_caption' => 1,
		'custom_css' => '',
	), $atts));

	if(!is_numeric($height))
	{
		$height = 400;
	}

	$return_html = '<div class="'.esc_attr($size).'" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode(esc_attr($custom_css)).'" ';
	}
	
	$return_html.= '><div class="page_content_wrapper"';
	
	if(!empty($image))
	{
		$return_html.= ' style="background-image:url('.esc_url($image).');background-size:cover;background-position:center center;height:'.$height.'px;position:relative;"';
	}
	
	$return_html.= '>';
	
	if(!empty($display_caption))
	{
		//Get image meta data
		$image_id = pp_get_image_id($image);
		$image_caption = get_post_field('post_excerpt', $image_id);
		
		if(!empty($image_caption))
		{
			$return_html.= '<div id="gallery_caption" class="ppb_fullwidth"><h2>'.$image_caption.'</h2></div>';
		}
	}
	
	$return_html.= '</div>';
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_image_fullwidth', 'ppb_image_fullwidth_func');


function ppb_image_fixed_width_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'image' => '',
		'display_caption' => 1,
		'custom_css' => '',
	), $atts));

	$return_html = '<div class="'.esc_attr($size).'" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode(esc_attr($custom_css)).'" ';
	}
	
	$return_html.= '><div class="page_content_wrapper"><div class="inner">';
	
	$image_id = pp_get_image_id($image);
	$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	if(!is_string($image_alt))
	{
		$image_alt = '';
	}
	
	if(!empty($image))
	{
		$return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
		$return_html.= '<a href="'.esc_url($image).'" class="img_frame"><img src="'.esc_url($image).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/></a>';
		$return_html.= '</div>';
	}
	
	if(!empty($display_caption))
	{
		//Get image meta data
		$image_id = pp_get_image_id($image);
		$image_caption = get_post_field('post_excerpt', $image_id);
		$image_description = get_post_field('post_content', $image_id);
		
		if(!empty($image_caption) OR !empty($image_description))
		{
			$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
			$return_html.= '<div class="image_description">'.$image_description.'</div>';
		}
	}
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	$return_html.= '</div>';
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_image_fixed_width', 'ppb_image_fixed_width_func');


function ppb_image_half_fixed_width_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'image' => '',
		'align' => 1,
		'custom_css' => '',
	), $atts));
	
	if(empty($align))
	{
		$align = 'left';
	}

	$return_html = '<div class="'.esc_attr($size).'" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode(esc_attr($custom_css)).'" ';
	}
	
	$return_html.= '><div class="page_content_wrapper"><div class="inner">';
	
	//Display Title
	if(!empty($title))
	{
		$return_html.= '<h2 class="ppb_title">'.$title.'</h2>';
	}
	
	$image_id = pp_get_image_id($image);
	$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	if(!is_string($image_alt))
	{
		$image_alt = '';
	}
	
	if($align=='left')
	{
		$return_html.= '<div class="one_half">';
		if(!empty($image))
		{
			$return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
			$return_html.= '<a href="'.esc_url($image).'" class="img_frame"><img src="'.esc_url($image).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/></a>';
			$return_html.= '</div></div>';
		}
		$return_html.= '</div>';
		
		$return_html.= '<div class="one_half last content_middle animate">';
		if(!empty($content))
		{
			$return_html.= $content;
		}
		$return_html.= '</div>';
	}
	else
	{	
		$return_html.= '<div class="one_half content_middle animate textright">';
		if(!empty($content))
		{
			$return_html.= $content;
		}
		$return_html.= '</div>';
		
		$return_html.= '<div class="one_half last">';
		if(!empty($image))
		{
			$return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
			$return_html.= '<a href="'.esc_url($image).'" class="img_frame"><img src="'.esc_url($image).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/></a>';
			$return_html.= '</div></div>';
		}
		$return_html.= '</div>';
	}
	
	$return_html.= '<br class="clear"/></div>';
	$return_html.= '</div>';
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_image_half_fixed_width', 'ppb_image_half_fixed_width_func');


function ppb_image_half_fullwidth_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'image' => '',
		'height' => 500,
		'align' => 1,
		'custom_css' => '',
	), $atts));
	
	if(empty($align))
	{
		$align = 'left';
	}
	
	if(!is_numeric($height))
	{
		$height = 500;
	}

	$return_html = '<div class="'.esc_attr($size).'" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode(esc_attr($custom_css)).'" ';
	}
	
	$return_html.= '><div class="page_content_wrapper nopadding">';
	
	//Display Title
	if(!empty($title))
	{
		$return_html.= '<h2 class="ppb_title">'.$title.'</h2>';
	}
	
	if($align=='left')
	{
		$return_html.= '<div class="one_half_bg animate"';
		if(!empty($image))
		{
			$return_html.= ' style="background-image:url('.esc_url($image).');height:'.esc_attr($height).'px;"';
		}
		$return_html.= '></div>';
		
		$return_html.= '<div class="one_half_bg content_middle animate">';
		if(!empty($content))
		{
			$return_html.= '<div class="nicepadding">'.$content.'</div>';
		}
		$return_html.= '</div>';
	}
	else
	{	
		$return_html.= '<div class="one_half_bg content_middle animate textright">';
		if(!empty($content))
		{
			$return_html.= '<div class="nicepadding">'.$content.'</div>';
		}
		$return_html.= '</div>';
		
		$return_html.= '<div class="one_half_bg animate"';
		if(!empty($image))
		{
			$return_html.= ' style="background-image:url('.esc_url($image).');height:'.esc_attr($height).'px;"';
		}
		$return_html.= '></div>';
	}
	
	$return_html.= '<br class="clear"/></div>';
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_image_half_fullwidth', 'ppb_image_half_fullwidth_func');


function ppb_two_cols_images_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'image1' => '',
		'image2' => '',
		'display_caption' => 1,
		'custom_css' => '',
	), $atts));

	$return_html = '<div class="'.esc_attr($size).'" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode(esc_attr($custom_css)).'" ';
	}
	
	$return_html.= '><div class="page_content_wrapper"><div class="inner">';
	
	$return_html.= '<div class="one_half">';
	if(!empty($image1))
	{
		$image_id = pp_get_image_id($image1);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
		if(!is_string($image_alt))
		{
			$image_alt = '';
		}
	
	    $return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
	    $return_html.= '<a href="'.esc_url($image1).'" class="img_frame"><img src="'.esc_url($image1).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/></a>';
	    $return_html.= '</div>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = pp_get_image_id($image1);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	$return_html.= '</div>';
	
	$return_html.= '<div class="one_half last">';
	if(!empty($image2))
	{
		$image_id = pp_get_image_id($image2);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
		if(!is_string($image_alt))
		{
			$image_alt = '';
		}
	
	    $return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
	    $return_html.= '<a href="'.esc_url($image2).'" class="img_frame"><img src="'.esc_url($image2).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/></a>';
	    $return_html.= '</div>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = pp_get_image_id($image2);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	$return_html.= '</div>';
	
	$return_html.= '<br class="clear"/>';
	
	//Display Title
	if(!empty($title))
	{
		$return_html.= '<br/><br/><h2 class="ppb_title animate">'.$title.'</h2>';
	}
	
	//Display Content
	if(!empty($title))
	{
		$return_html.= '<div class="animate">'.do_shortcode(tg_apply_content($content)).'</div>';
	}
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_two_cols_images', 'ppb_two_cols_images_func');


function ppb_three_cols_images_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'image1' => '',
		'image2' => '',
		'image3' => '',
		'display_caption' => 1,
		'custom_css' => '',
	), $atts));

	$return_html = '<div class="'.esc_attr($size).'" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode(esc_attr($custom_css)).'" ';
	}
	
	$return_html.= '><div class="page_content_wrapper"><div class="inner">';
	
	//First image
	$return_html.= '<div class="one_third">';
	if(!empty($image1))
	{
		$image_id = pp_get_image_id($image1);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
		if(!is_string($image_alt))
		{
			$image_alt = '';
		}
	
	    $return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
	    $return_html.= '<a href="'.esc_url($image1).'" class="img_frame"><img src="'.esc_url($image1).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/></a>';
	    $return_html.= '</div>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = pp_get_image_id($image1);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	$return_html.= '</div>';
	
	//Second image
	$return_html.= '<div class="one_third">';
	if(!empty($image2))
	{
		$image_id = pp_get_image_id($image2);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
		if(!is_string($image_alt))
		{
			$image_alt = '';
		}
	
	    $return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
	    $return_html.= '<a href="'.esc_url($image2).'" class="img_frame"><img src="'.esc_url($image2).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/></a>';
	    $return_html.= '</div>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = pp_get_image_id($image2);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	$return_html.= '</div>';
	
	//Third image
	$return_html.= '<div class="one_third last animate">';
	if(!empty($image3))
	{
		$image_id = pp_get_image_id($image3);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
		if(!is_string($image_alt))
		{
			$image_alt = '';
		}
	
	    $return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
	    $return_html.= '<a href="'.esc_url($image3).'" class="img_frame"><img src="'.esc_url($image3).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/></a>';
	    $return_html.= '</div>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = pp_get_image_id($image3);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	$return_html.= '</div>';
	
	$return_html.= '<br class="clear"/>';
	
	//Display Title
	if(!empty($title))
	{
		$return_html.= '<br/><br/><h2 class="ppb_title animate">'.$title.'</h2>';
	}
	
	//Display Content
	if(!empty($title))
	{
		$return_html.= '<div class="animate">'.do_shortcode(tg_apply_content($content)).'</div>';
	}
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_three_cols_images', 'ppb_three_cols_images_func');


function ppb_four_images_block_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'image1' => '',
		'image2' => '',
		'image3' => '',
		'image4' => '',
		'display_caption' => 1,
		'custom_css' => '',
	), $atts));

	$return_html = '<div class="'.esc_attr($size).'" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode(esc_attr($custom_css)).'" ';
	}
	
	$return_html.= '><div class="page_content_wrapper"><div class="inner">';
	
	//First image
	$return_html.= '<div class="one_half">';
	if(!empty($image1))
	{
		$image_id = pp_get_image_id($image1);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
		if(!is_string($image_alt))
		{
			$image_alt = '';
		}
	
	    $return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
	    $return_html.= '<a href="'.esc_url($image1).'" class="img_frame"><img src="'.esc_url($image1).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/></a>';
	    $return_html.= '</div>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = pp_get_image_id($image1);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	$return_html.= '</div>';
	
	//Second image
	$return_html.= '<div class="one_half last">';
	if(!empty($image2))
	{
		$image_id = pp_get_image_id($image2);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
		if(!is_string($image_alt))
		{
			$image_alt = '';
		}
	
	    $return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
	    $return_html.= '<a href="'.esc_url($image2).'" class="img_frame"><img src="'.esc_url($image2).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/></a>';
	    $return_html.= '</div>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = pp_get_image_id($image2);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	$return_html.= '</div>';
	
	$return_html.= '<br class="clear"/><br/>';
	
	//Third image
	$return_html.= '<div class="one_half">';
	if(!empty($image3))
	{
		$image_id = pp_get_image_id($image3);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
		if(!is_string($image_alt))
		{
			$image_alt = '';
		}
	
	    $return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
	    $return_html.= '<a href="'.esc_url($image3).'" class="img_frame"><img src="'.esc_url($image3).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/></a>';
	    $return_html.= '</div>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = pp_get_image_id($image3);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	$return_html.= '</div>';
	
	//Fourth image
	$return_html.= '<div class="one_half last animate">';
	if(!empty($image4))
	{
		$image_id = pp_get_image_id($image4);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
		if(!is_string($image_alt))
		{
			$image_alt = '';
		}
	
	    $return_html.= '<div class="image_classic_frame expand"><div class="image_wrapper">';
	    $return_html.= '<a href="'.esc_url($image4).'" class="img_frame"><img src="'.esc_url($image4).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/></a>';
	    $return_html.= '</div>';
	    if(!empty($display_caption))
	    {
	    	//Get image meta data
	    	$image_id = pp_get_image_id($image4);
	    	$image_caption = get_post_field('post_excerpt', $image_id);
	    	
	    	if(!empty($image_caption))
	    	{
	    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
	    	}
	    }
	    $return_html.= '</div>';
	}
	$return_html.= '</div>';
	
	$return_html.= '<br class="clear"/>';
	
	//Display Title
	if(!empty($title))
	{
		$return_html.= '<br/><br/><h2 class="ppb_title animate">'.$title.'</h2>';
	}
	
	//Display Content
	if(!empty($title))
	{
		$return_html.= '<div class="animate">'.do_shortcode(tg_apply_content($content)).'</div>';
	}
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_four_images_block', 'ppb_four_images_block_func');


function ppb_three_images_block_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'image_portrait' => '',
		'image_portrait_align' => 'left',
		'image2' => '',
		'image3' => '',
		'display_caption' => 1,
		'custom_css' => '',
	), $atts));
	
	if(empty($image_portrait_align))
	{
		$image_portrait_align = 'left';
	}

	$return_html = '<div class="'.esc_attr($size).'" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode(esc_attr($custom_css)).'" ';
	}
	
	$return_html.= '><div class="page_content_wrapper"><div class="inner">';
	
	if($image_portrait_align=='left')
	{
		//First column
		$return_html.= '<div class="one_half">';
		if(!empty($image_portrait))
		{
			$image_id = pp_get_image_id($image_portrait);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			if(!is_string($image_alt))
			{
				$image_alt = '';
			}
		
		    $return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
		    $return_html.= '<a href="'.esc_url($image_portrait).'" class="img_frame"><img src="'.esc_url($image_portrait).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/></a>';
		    $return_html.= '</div>';
		    if(!empty($display_caption))
		    {
		    	//Get image meta data
		    	$image_id = pp_get_image_id($image_portrait);
		    	$image_caption = get_post_field('post_excerpt', $image_id);
		    	
		    	if(!empty($image_caption))
		    	{
		    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
		    	}
		    }
		    $return_html.= '</div>';
		}
		$return_html.= '</div>';
		
		//Second column
		$return_html.= '<div class="one_half last">';
		if(!empty($image2))
		{
			$image_id = pp_get_image_id($image2);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			if(!is_string($image_alt))
			{
				$image_alt = '';
			}
		
		    $return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
		    $return_html.= '<a href="'.esc_url($image2).'" class="img_frame"><img src="'.esc_url($image2).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/></a>';
		    $return_html.= '</div>';
		    if(!empty($display_caption))
		    {
		    	//Get image meta data
		    	$image_id = pp_get_image_id($image2);
		    	$image_caption = get_post_field('post_excerpt', $image_id);
		    	
		    	if(!empty($image_caption))
		    	{
		    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
		    	}
		    }
		    $return_html.= '</div>';
		}
		
		$return_html.= '<br class="clear"/>';
		
		if(!empty($image3))
		{
			$image_id = pp_get_image_id($image3);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			if(!is_string($image_alt))
			{
				$image_alt = '';
			}
		
		    $return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
		    $return_html.= '<a href="'.esc_url($image3).'" class="img_frame"><img src="'.esc_url($image3).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/></a>';
		    $return_html.= '</div>';
		    if(!empty($display_caption))
		    {
		    	//Get image meta data
		    	$image_id = pp_get_image_id($image3);
		    	$image_caption = get_post_field('post_excerpt', $image_id);
		    	
		    	if(!empty($image_caption))
		    	{
		    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
		    	}
		    }
		    $return_html.= '</div>';
		}
		
		$return_html.= '</div>';
	}
	else
	{
		//First column
		$return_html.= '<div class="one_half">';
		if(!empty($image2))
		{
			$image_id = pp_get_image_id($image2);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			if(!is_string($image_alt))
			{
				$image_alt = '';
			}
		
		    $return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
		    $return_html.= '<a href="'.esc_url($image2).'" class="img_frame"><img src="'.esc_url($image2).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/></a>';
		    $return_html.= '</div>';
		    if(!empty($display_caption))
		    {
		    	//Get image meta data
		    	$image_id = pp_get_image_id($image2);
		    	$image_caption = get_post_field('post_excerpt', $image_id);
		    	
		    	if(!empty($image_caption))
		    	{
		    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
		    	}
		    }
		    $return_html.= '</div>';
		}
		
		$return_html.= '<br class="clear"/>';
		
		if(!empty($image3))
		{
			$image_id = pp_get_image_id($image3);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			if(!is_string($image_alt))
			{
				$image_alt = '';
			}
		
		    $return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
		    $return_html.= '<a href="'.esc_url($image3).'" class="img_frame"><img src="'.esc_url($image3).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/></a>';
		    $return_html.= '</div>';
		    if(!empty($display_caption))
		    {
		    	//Get image meta data
		    	$image_id = pp_get_image_id($image3);
		    	$image_caption = get_post_field('post_excerpt', $image_id);
		    	
		    	if(!empty($image_caption))
		    	{
		    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
		    	}
		    }
		    $return_html.= '</div>';
		}
		
		$return_html.= '</div>';
		
		//Second column
		$return_html.= '<div class="one_half last">';
		if(!empty($image_portrait))
		{
			$image_id = pp_get_image_id($image_portrait);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			if(!is_string($image_alt))
			{
				$image_alt = '';
			}
		
		    $return_html.= '<div class="image_classic_frame expand animate"><div class="image_wrapper">';
		    $return_html.= '<a href="'.esc_url($image_portrait).'" class="img_frame"><img src="'.esc_url($image_portrait).'" alt="'.esc_attr($image_alt).'" class="portfolio_img"/></a>';
		    $return_html.= '</div>';
		    if(!empty($display_caption))
		    {
		    	//Get image meta data
		    	$image_id = pp_get_image_id($image_portrait);
		    	$image_caption = get_post_field('post_excerpt', $image_id);
		    	
		    	if(!empty($image_caption))
		    	{
		    		$return_html.= '<div class="image_caption">'.$image_caption.'</div>';
		    	}
		    }
		    $return_html.= '</div>';
		}
		$return_html.= '</div>';
	}
	
	$return_html.= '<br class="clear"/>';
	
	//Display Title
	if(!empty($title))
	{
		$return_html.= '<br/><br/><h2 class="ppb_title animate">'.$title.'</h2>';
	}
	
	//Display Content
	if(!empty($title))
	{
		$return_html.= '<div class="animate">'.do_shortcode(tg_apply_content($content)).'</div>';
	}
	
	$return_html.= '</div>';
	$return_html.= '</div>';
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_three_images_block', 'ppb_three_images_block_func');


function ppb_rev_slider_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'slider' => '',
		'custom_css' => '',
	), $atts));

	$return_html = '<div class="'.esc_attr($size).'" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode(esc_attr($custom_css)).'" ';
	}
	
	if(!empty($slider))
	{
		$return_html.= do_shortcode('[rev_slider '.$slider.']');
	}
	
	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_rev_slider', 'ppb_rev_slider_func');
?>