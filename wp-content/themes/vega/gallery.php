<?php
/**
 * Template Name: Gallery
 * The main template file for display gallery page
 *
 * @package WordPress
*/

$page_gallery_id = get_post_meta($post->ID, 'page_gallery_id', true);
$gallery_template = get_post_meta($page_gallery_id, 'gallery_template', true);
global $page_gallery_id;

switch($gallery_template)
{	
    case 'Gallery Classic':
		get_template_part("gallery_classic");
	break;
	
	case 'Gallery Classic 2':
		get_template_part("gallery_classic2");
	break;
	
	case 'Gallery Horizontal':
		get_template_part("gallery_horizontal");
	break;
    
    case 'Gallery Masonry':
    	get_template_part("gallery_masonry");
    break;
    
    case 'Gallery Fullscreen':
    default:
		get_template_part("gallery_f");
	break;
	
	case 'Gallery Fullscreen Cover':
		get_template_part("gallery_fc");
	break;
    
    case 'Gallery Kenburns':
    	get_template_part("gallery_kenburns");
    break;
    
    case 'Gallery Grid':
    	get_template_part("gallery_grid");
    break;
    
    case 'Gallery Wall':
    	get_template_part("gallery_wall");
    break;
    
    case 'Gallery Wall Fixed Width':
    	get_template_part("gallery_wall_fixed");
    break;
    
    case 'Gallery Flow':
    	get_template_part("gallery_flow");
    break;
}

exit;
?>

