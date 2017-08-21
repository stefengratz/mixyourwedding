<?php
/**
 * Template Name: Page Right Sidebar
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

$page_sidebar = get_post_meta($current_page_id, 'page_sidebar', true);

if(empty($page_sidebar))
{
	$page_sidebar = 'Page Sidebar';
}

get_header(); 
?>

<?php
    //Get Page Header
    get_template_part("/templates/template-page-header");
?>

<!-- Begin content -->
<div id="page_content_wrapper" class="two">

    <div class="inner">
    
    <!-- Begin main content -->
    <div class="inner_wrapper">
        
        <div class="sidebar_content">
        
        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>		
        	
        	<?php the_content(); ?>

        <?php endwhile; ?>
        
        </div>
        
        <div class="sidebar_wrapper">
            <div class="sidebar">
            
            	<div class="content">
            
            		<ul class="sidebar_widget">
            		<?php dynamic_sidebar($page_sidebar); ?>
            		</ul>
            	
            	</div>
        
            </div>
            <br class="clear"/>
        
            <div class="sidebar_bottom"></div>
        </div>
    
        </div>
        <br class="clear"/><br/>
    
    </div>
    <!-- End main content -->
</div>

<?php get_footer(); ?>
