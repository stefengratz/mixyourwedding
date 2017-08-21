<?php
/**
 * The main template file for display portfolio page.
 *
 * @package WordPress
 */

/**
*	Get Current page object
**/

global $page_gallery_id;

if(!is_page())
{
	$page = get_page($post->ID);
	$current_page_id = '';
	
	if(isset($page->ID))
	{
	    $current_page_id = $page->ID;
	}
	
	//Check if gallery template
	if(!empty($page_gallery_id))
	{
		$current_page_id = $page_gallery_id;
	}
	
	//Get gallery images
	$all_photo_arr = array();
	
	if(!isset($_GET['view'])) 
	{
		$all_photo_arr = get_post_meta($current_page_id, 'wpsimplegallery_gallery', true);
	}
	else if(isset($_GET['view']) && $_GET['view'] == 'approve')
	{
		$all_photo_arr = get_post_meta($current_page_id, 'gallery_images_approve', true);
	}
	else if(isset($_GET['view']) && $_GET['view'] == 'reject')
	{
		$all_photo_arr = get_post_meta($current_page_id, 'wpsimplegallery_gallery', true);
		$current_images_approve = get_post_meta($current_page_id, 'gallery_images_approve', true);
		
		$all_photo_arr = array_diff($all_photo_arr, $current_images_approve);
	}
}
else
{
	$current_page_id = $page_gallery_id;
	
	//Get gallery images
	$all_photo_arr = get_post_meta($page_gallery_id, 'wpsimplegallery_gallery', true);
}

//Check if password protected
$gallery_password = get_post_meta($current_page_id, 'gallery_password', true);
if(!empty($gallery_password))
{
	session_start();
	
	if(!isset($_SESSION['gallery_page_'.$current_page_id]) OR empty($_SESSION['gallery_page_'.$current_page_id]))
	{
		get_template_part("/templates/template-password");
		exit;
	}
}

wp_register_script("vega-script-gallery-image-proofing-".$current_page_id, get_template_directory_uri()."/js/custom_proofing.js", false, THEMEVERSION, true);

$params = array(
  'ajaxurl' => esc_url(admin_url('admin-ajax.php')),
  'ajax_nonce' => wp_create_nonce('tgajax-post-contact-nonce'),
);

wp_localize_script("vega-script-gallery-image-proofing-".$current_page_id, 'tgAjax', $params );

wp_enqueue_script("vega-script-gallery-image-proofing-".$current_page_id, get_template_directory_uri()."/js/custom_proofing.js", false, THEMEVERSION, true);

//Get current approved images
$current_images_approve = get_post_meta($current_page_id, 'gallery_images_approve', true);
if(!is_array($current_images_approve))
{
	$current_images_approve = array();
}

//Get global gallery sorting
$all_photo_arr = pp_resort_gallery_img($all_photo_arr);

global $pp_homepage_style;
$pp_homepage_style = 'blog_grid';
get_header(); 

?>

<input type="hidden" id="gallery_proofing_status" name="gallery_proofing_status" value="0"/>

<?php
//Check if hide header on this page
$gallery_hide_header = get_post_meta($current_page_id, 'gallery_hide_header', true);
if(empty($gallery_hide_header))
{
?>
<div id="page_caption">
    <div id="page_caption_wrapper">
    	<div class="page_tagline">
    		<?php the_excerpt(); ?>
    	</div>
    	<h1><?php the_title(); ?></h1>
    </div>
</div>
<?php
}
?>

<ul class="portfolio_wall_filters filter full"> 
    <li>
    	<a <?php if(!isset($_GET['view'])) { ?>class="active"<?php } ?> href="<?php echo esc_url(get_permalink($current_page_id)); ?>"><?php echo esc_html_e('All', 'photography-translation' ); ?></a>
    	<span class="separator">/</span>
    </li>
    <li>
    	<a <?php if(isset($_GET['view']) && $_GET['view'] == 'approve') { ?>class="active"<?php } ?> href="<?php echo esc_url(add_query_arg('view', 'approve', get_permalink($current_page_id))); ?>"><?php echo esc_html_e('Approved Photos', 'photography-translation' ); ?></a>
    	<span class="separator">/</span>
    </li>
    <li>
    	<a <?php if(isset($_GET['view']) && $_GET['view'] == 'reject') { ?>class="active"<?php } ?> href="<?php echo esc_url(add_query_arg('view', 'reject', get_permalink($current_page_id))); ?>"><?php echo esc_html_e('Rejected Photos', 'photography-translation' ); ?></a>
    	<span class="separator">/</span>
    </li>
</ul>

<!-- Begin content -->
<div id="page_content_wrapper" class="two">
    
    <div class="inner">

    	<div class="inner_wrapper">
    	
    		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>		
					
		    	<?php the_content(); ?>
		
		    <?php endwhile; ?>
		
			<div id="blog_grid_wrapper">
	    	
	    	<?php
	    		foreach($all_photo_arr as $photo_id)
	    		{
	    			$small_image_url = '';
	    			$hyperlink_url = get_permalink($photo_id);
	    			$thumb_image_url = '';
	    			
	    			if(!empty($photo_id))
	    			{
	    				$image_url = wp_get_attachment_image_src($photo_id, 'original', true);
	    			    $small_image_url = wp_get_attachment_image_src($photo_id, 'gallery_c', true);
	    			}
	    			
	    			$thumb_image_url = $small_image_url[0];
	    			$thumb_width = $small_image_url[1];
	    			$thumb_height = $small_image_url[2];
	    			
	    			//Get image meta data
	    			$image_caption = get_post_field('post_excerpt', $photo_id);
	    			$image_alt = get_post_meta($photo_id, '_wp_attachment_image_alt', true);
	    	?>
	    	<div class="mansory_entry type-post post gallery">
	    		<?php 
	    			if(!empty($thumb_image_url))
	    			{
	    		?>
	    			<div class="image_grid_frame">
					<?php
						$is_approved = in_array($photo_id, $current_images_approve);
	    				$pp_image_lightbox_title = get_option('pp_image_lightbox_title');
	    				$pp_image_link_single = get_option('pp_image_link_single');
					?>		
	    				<div id="image<?php echo esc_attr($photo_id); ?>_wrapper" class="image_wrapper">
	    					<img src="<?php echo esc_url($thumb_image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" class="portfolio_img"/>
	    					<div class="loading hidden"><i class="fa fa-circle-o-notch fa-spin"></i></div>
	    					
	    					<div class="onapprove <?php if(!$is_approved) { ?>hidden<?php } ?>"><?php esc_html_e('Approve', 'photography-translation' ); ?></div>
			        
							<div class="proofing_id">#<?php echo esc_html($photo_id); ?></div>
	    					
	    					<div class="mask">
			    				<div class="mask_frame">
			    					<div class="mask_image_content">
			    						<div class="mask_image_content_frame">
			    							<a <?php if(!empty($pp_image_lightbox_title)) { ?>title="<?php if(!empty($image_caption)) { ?><?php echo esc_attr($image_caption); ?><?php } ?>"<?php } ?> class="fancy-gallery" href="<?php echo esc_url($image_url[0]); ?>">
							    				<i class="fa fa-search-plus"></i>
			    							</a>
			    							<a id="image<?php echo esc_attr($photo_id); ?>_approve" href="javascript:;" class="image_approve <?php if($is_approved) { ?>hidden<?php } ?>" data-image="<?php echo esc_attr($photo_id); ?>" data-gallery="<?php echo esc_attr($current_page_id); ?>">
									    		<i class="fa fa-check"></i>
									    	</a>
									    	
									    	<a id="image<?php echo esc_attr($photo_id); ?>_unapprove" href="javascript:;" class="image_unapprove <?php if(!$is_approved) { ?>hidden<?php } ?>" data-image="<?php echo esc_attr($photo_id); ?>" data-gallery="<?php echo esc_attr($current_page_id); ?>">
									    		<i class="fa fa-minus"></i>
									    	</a>
			    						</div>
			    					</div>
			    				</div>
			    			</div>
	    				</div>
	    				<br class="clear"/>
	    				<div class="image_caption"><?php echo $image_caption;?></div>
	    			</div>
	    		<?php
	    			}		
	    		?>			
	    	
	    	</div>
	    	
	    	<?php
	    		}
	    	?>
	    </div>
	    
	    <?php
		    //Get Social Share
		    get_template_part("/templates/template-share");
		?>
		<br class="clear"/>
		
		<?php
		if (comments_open($post->ID)) 
		{
		?>
		<div class="fullwidth_comment_wrapper">
		    <?php comments_template( '', true ); ?>
		</div><br class="clear"/>
		<?php
		}
		?>
		
		</div>
	    	
	</div>
	    
</div>

<?php get_footer(); ?>