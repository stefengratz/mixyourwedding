<?php
/**
 * The main template file for display single post page.
 *
 * @package WordPress
*/

/**
*	Get current page id
**/

$current_page_id = $post->ID;

if($post->post_type=='attachment')
{
	get_template_part("single-attachment");
	exit;
}

if($post_type == 'galleries')
{
	//Get gallery template
	$gallery_template = get_post_meta($current_page_id, 'gallery_template', true);
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
		
		case 'Gallery Metro':
			get_template_part("gallery_metro");
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
		
		case 'Gallery Photo Proofing':
			get_template_part("gallery_proofing");
		break;
	}

	exit;
}
elseif($post_type == 'portfolios')
{
	get_template_part("single-portfolio");
	exit;
}
elseif($post_type == 'clients')
{
	get_template_part("single-client");
}
else
{
	$post_layout = get_post_meta($current_page_id, 'post_layout', true);
	switch($post_layout)
	{	
		case 'Left Sidebar':
			get_template_part("single-post-l");
		break;
		
		case 'Right Sidebar':
			get_template_part("single-post-r");
		break;
		
		case 'Fullscreen':
			get_template_part("single-post-fullscreen");
		break;
		
		case 'Fullwidth':
		default:
			get_template_part("single-post-f");
		break;
	}
}
?>