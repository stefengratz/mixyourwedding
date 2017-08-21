<?php
/**
 * The main template file for display search page.
 *
 * @package WordPress
*/

$pp_blog_search_layout = get_option('pp_blog_search_layout');
	
switch($pp_blog_search_layout)
{
    case 'right_sidebar':
    default:
    	get_template_part("blog_r");
    break;
    
    case 'left_sidebar':
    	get_template_part("blog_l");
    break;
    
    case 'fullwidth':
    	get_template_part("blog_f");
    break;
    
    case 'grid':
    	get_template_part("blog_g");
    break;
    
    case 'fullscreen':
    	get_template_part("blog_fullscreen");
    break;
}
?>