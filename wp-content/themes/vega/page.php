<?php
/**
 * The main template file for display page.
 *
 * @package WordPress
*/

/**
*	Get Current page object
**/
$page = get_page($post->ID);

/**
*	Get current page id
**/

if(!isset($current_page_id) && isset($page->ID))
{
    $current_page_id = $page->ID;
}

get_header(); 
?>

<?php
    //Get Page Header
    get_template_part("/templates/template-page-header");
?>

<?php
	//Check if use page builder
	$ppb_form_data_order = '';
	$ppb_form_item_arr = array();
	$ppb_enable = get_post_meta($current_page_id, 'ppb_enable', true);
?>
<?php
	if(!empty($ppb_enable))
	{
?>
<div class="ppb_wrapper">
<?php
		tg_apply_builder($current_page_id);
?>
</div>
<?php
	}
	else
	{
?>
<div id="page_content_wrapper" class="two">

    <div class="inner">
    
    <!-- Begin main content -->
    <div class="inner_wrapper">
        
        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>		
        	
        	<div class="sidebar_content full_width">
        	
        		<?php the_content(); ?>
        			
        	</div>

        <?php endwhile; ?>
    
    </div>
    <!-- End main content -->
</div>
<?php
}
?>

</div>
<?php get_footer(); ?>