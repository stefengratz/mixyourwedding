<?php
/**
 * The main template file for display portfolio page.
 *
 * Template Name: Portfolio Grid
 * @package WordPress
 */

/**
*	Get Current page object
**/
$page = get_page($post->ID);
$current_page_id = '';

if(isset($page->ID))
{
    $current_page_id = $page->ID;
}

//prepare data for pagintion
$offset_query = '';
if(!isset($_GET['page']) OR empty($_GET['page']) OR $_GET['page'] == 1)
{
    $current_page = 1;
}

$portfolio_sets_query = '';
if(!empty($term))
{
	$portfolio_sets_query.= $term;
	
	$obj_term = get_term_by('slug', $term, 'portfoliosets');
	$page_title = $obj_term->name;
	$page_tagline = $obj_term->description;
}
else
{
	$page_title = get_the_title();
	$page_tagline = get_post_meta($current_page_id, 'page_tagline', true);
}

global $wp_query;

$pp_portfolio_items_page = get_option('pp_portfolio_items_page');
if(empty($pp_portfolio_items_page))
{
    $pp_portfolio_items_page = 9;
}

$args = array(
	'paged' => $paged,
    'post_type' => 'portfolios',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'posts_per_page' =>  $pp_portfolio_items_page,
    'suppress_filters' => false,
    'numberposts' => -1
);

if(!empty($term))
{
    $args['posts_per_page'] = -1;
    $args['portfoliosets'] = $term;
}

$the_query = new WP_Query( $args );

//important to apply dynamic header & footer style
global $pp_homepage_style;
$pp_homepage_style = 'blog_grid';

get_header();
?>

<?php
if(is_archive())
{
	//Get featured header background
	$term_meta = get_option( "taxonomy_term_$obj_term->term_id" );
	$pp_page_bg = $term_meta['portfoliosets_ft_img'];
?>
	<div id="page_header_bg" style="background-image:url(<?php echo $pp_page_bg; ?>);"></div>
<?php
}		
elseif(has_post_thumbnail($current_page_id, 'original'))
{
	$image_id = get_post_thumbnail_id($current_page_id); 
	$image_thumb = wp_get_attachment_image_src($image_id, 'original', true);
	$pp_page_bg = $image_thumb[0];
?>
<div id="page_header_bg" style="background-image:url(<?php echo $pp_page_bg; ?>);"></div>
<?php
}
else
{
?>
<div id="page_header_bg"></div>
<?php
}
?>

<?php
//Check if hide header on this page
$page_hide_header = get_post_meta($current_page_id, 'page_hide_header', true);

if(empty($page_hide_header))
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
    	<h1><?php echo $page_title; ?></h1>
    </div>
</div>
<?php
}
?>

<!-- Begin content -->
<div id="page_content_wrapper" class="two nopadding gallery">

	<?php
	    //Get all sets and sorting option
		$pp_portfolio_set_sort = get_option('pp_portfolio_set_sort');	
	     
		//Get all portfolio sets
		$sets_arr = get_terms('portfoliosets', 'hide_empty=0&hierarchical=0&parent=0&orderby='.$pp_portfolio_set_sort);
		    
		if(!empty($sets_arr) && empty($term))
		{
	?>
		    <ul id="portfolio_wall_filters" class="portfolio-main filter full"> 
		    	<li class="all-projects active">
		    		<a class="active" href="javascript:;" data-filter="*"><?php echo _e( 'All', THEMEDOMAIN ); ?></a>
		    		<span class="separator">/</span>
		    	</li>
		    	<?php
		    		foreach($sets_arr as $key => $set_item)
		    		{
		    	?>
		    	<li class="cat-item <?php echo esc_attr($set_item->slug); ?>" data-type="<?php echo esc_attr($set_item->slug); ?>" style="clear:none">
		    		<a data-filter=".<?php echo esc_attr($set_item->slug); ?>" href="javascript:;" title="<?php echo esc_attr($set_item->name); ?>"><?php echo $set_item->name; ?></a>
		    		<span class="separator">/</span>
		    	</li> 
		    	<?php
		    		}
		    	?>
		    </ul>
		    <br class="clear"/><br/>
	<?php
		}
	?>
    
    <div class="inner">

    	<div class="inner_wrapper">
		
			<div id="blog_grid_wrapper">
	    	
	    	<?php
	    		$key = 0;
			    if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
				    $image_url = '';
				    $portfolio_ID = get_the_ID();
				    		
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
				    
				    $portfolio_item_set = '';
				    $portfolio_item_sets = wp_get_object_terms($portfolio_ID, 'portfoliosets');
				    
				    if(is_array($portfolio_item_sets))
				    {
				        foreach($portfolio_item_sets as $set)
				        {
				        	$portfolio_item_set.= $set->slug.' ';
				        }
				    }
				    
				    //Get portfolio type
				    $portfolio_type = get_post_meta($portfolio_ID, 'portfolio_type', true);
	    	?>
	    	<div class="wall_entry type-post post gallery masonry element <?php echo esc_attr($portfolio_item_set); ?>" data-id="post-<?php echo $key+1; ?>" data-type="<?php echo esc_attr($portfolio_item_set); ?>">
	    		<?php 
			    	if(!empty($image_url[0]))
					{
			    ?>		
			    <div class="wall_thumbnail">
			    	<div class="image_grid_frame">
				    	<div class="image_wrapper">
				    		<?php
							    $portfolio_video_id = get_post_meta($portfolio_ID, 'portfolio_video_id', true);
							    
							    switch($portfolio_type)
							    {
							    case 'Image':
							    default:
							?>						
				            	<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="" class="portfolio_img"/>
				            	
				            	<div class="mask">
				    				<div class="mask_frame">
				    					<div class="mask_image_content">
				    						<div class="mask_image_content_frame">
				    							<a href="<?php echo esc_url($image_url[0]); ?>" class="fancy-gallery">
								    				<i class="fa fa-search-plus"></i>
				    							</a>
				    						</div>
				    					</div>
				    				</div>
				    			</div>
							<?php
								break;
							    //end image
							
							    case 'External Link':
							?>
				            	<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="" class="portfolio_img"/>
				            	
				            	<div class="mask">
				    				<div class="mask_frame">
				    					<div class="mask_image_content">
				    						<div class="mask_image_content_frame">
				    							<a target="_blank" href="<?php echo esc_url($permalink_url); ?>">
								    				<i class="fa fa-chain"></i>
				    							</a>
				    						</div>
				    					</div>
				    				</div>
				    			</div>
							
							<?php
							    break;
							    //end external link
							    
							    case 'Portfolio Content':
				        	?>
				            	<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="" class="portfolio_img"/>
				            	
				            	<div class="mask">
				    				<div class="mask_frame">
				    					<div class="mask_image_content">
				    						<div class="mask_image_content_frame">
				    							<a href="<?php echo esc_url($permalink_url); ?>">
								    				<i class="fa fa-chain"></i>
				    							</a>
				    						</div>
				    					</div>
				    				</div>
				    			</div>
				        	
				        	<?php
				        	    break;
				        	    //end Portfolio Content
							    
							    case 'Youtube Video':
							?>
				            	<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="" class="portfolio_img"/>
				            	
				            	<div class="mask">
				    				<div class="mask_frame">
				    					<div class="mask_image_content">
				    						<div class="mask_image_content_frame">
				    							<a href="#video_<?php echo $portfolio_video_id; ?>" class="fancy_video">
								    				<i class="fa fa-play"></i>
				    							</a>
				    						</div>
				    					</div>
				    				</div>
				    			</div>
							    
								<div style="display:none;">
								    <div id="video_<?php echo $portfolio_video_id; ?>" class="lightbox_video_wrapper">
								        
								        <iframe title="YouTube video player" width="960" height="540" src="http://www.youtube.com/embed/<?php echo $portfolio_video_id; ?>?theme=dark&rel=0&wmode=transparent" frameborder="0" allowfullscreen></iframe>
								        
								    </div>	
								</div>
							
							<?php
							    break;
							    //end youtube
							
							case 'Vimeo Video':
							?>
				            	<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="" class="portfolio_img"/>
				            	
				            	<div class="mask">
				    				<div class="mask_frame">
				    					<div class="mask_image_content">
				    						<div class="mask_image_content_frame">
				    							<a href="#video_<?php echo $portfolio_video_id; ?>" class="fancy_video">
								    				<i class="fa fa-play"></i>
				    							</a>
				    						</div>
				    					</div>
				    				</div>
				    			</div>
							    
								<div style="display:none;">
								    <div id="video_<?php echo $portfolio_video_id; ?>" class="lightbox_video_wrapper">
								    
								        <iframe src="http://player.vimeo.com/video/<?php echo $portfolio_video_id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="960" height="540" frameborder="0"></iframe>
								        
								    </div>	
								</div>
							
							<?php
							    break;
							    //end vimeo
							    
							case 'Self-Hosted Video':
							
							    //Get video URL
							    $portfolio_mp4_url = get_post_meta($portfolio_ID, 'portfolio_mp4_url', true);
							?>
				            	<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="" class="portfolio_img"/>
				            	
				            	<div class="mask">
				    				<div class="mask_frame">
				    					<div class="mask_image_content">
				    						<div class="mask_image_content_frame">
				    							<a href="#video_self_<?php echo $key; ?>" class="fancy_video">
								    				<i class="fa fa-play"></i>
				    							</a>
				    						</div>
				    					</div>
				    				</div>
				    			</div>
							    
								<div style="display:none;">
								    <div id="video_self_<?php echo $key; ?>" class="lightbox_video_wrapper">
								    
								        <?php echo do_shortcode('[tg_video video_src="'.$portfolio_mp4_url.'" img_src="'.$small_image_url[0].'"]'); ?>
								        
								    </div>	
								</div>
							
							<?php
							    break;
							    //end self-hosted
							?>
							
						<?php
						    }
						    //end switch
						?>
						</div>
					
						<br class="clear"/>
		    			<div class="image_caption"><?php echo get_the_title();?></div>
	    			
	    			</div>
					
				<?php
					}
					//end if has featured image
				?>	
				</div>
	    	
	    	</div>
	    	
	    	<?php
			    $key++;
			    endwhile; endif;	
			?>
	    </div>
	    
	    <?php
		    //Get Social Share
		    get_template_part("/templates/template-share");
		?>
		<br class="clear"/><br/>
		
		<?php
	    if($the_query->max_num_pages > 1)
	    {
	    	if (function_exists("wpapi_pagination")) 
	    	{
	    	    wpapi_pagination($the_query->max_num_pages);
	    	}
	    	else
	    	{
	    	?>
	    	    <div class="pagination"><p><?php posts_nav_link(' '); ?></p></div>
	    	<?php
	    	}
	     }
		 ?>
    	</div>
	    	
	</div>
	    
</div>

<?php get_footer(); ?>