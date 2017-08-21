<?php
/**
 * Template Name: Background Image Page
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
global $pp_homepage_style;
$pp_homepage_style = 'fullscreen';

get_header(); 
?>

<?php
$page_header_background = get_post_meta($current_page_id, 'page_header_background', true);
if(!empty($page_header_background))
{  
?>
<div id="page_background" <?php if(!empty($page_header_background)) { ?>style="background-image:url('<?php echo $page_header_background; ?>');"<?php } ?>></div>
<?php
}
?>

<?php get_footer(); ?>