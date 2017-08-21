<?php
/**
 * The main template file for display archive page.
 *
 * @package WordPress
*/

//Check if portfolio post type then go to another template
$post_type = get_post_type();
if($post_type == 'portfolios')
{
	$pp_portfolio_archives_layout = get_option('pp_portfolio_archives_layout');
	switch($pp_portfolio_archives_layout)
	{
		case 'grid':
		default:
			get_template_part("portfolio_grid");
		break;
		
		case 'masonry':
			get_template_part("portfolio_masonry");
		break;
	}
	exit;
}
elseif($post_type == 'galleries')
{
	get_template_part("galleries");
	exit;
}
else
{
	$pp_blog_archives_layout = get_option('pp_blog_archives_layout');
	
	switch($pp_blog_archives_layout)
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
	exit;
}

?>