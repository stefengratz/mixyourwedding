<?php header("Content-Type: text/css");
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );
?>
<?php
	$pp_advance_combine_css = get_option('pp_advance_combine_css');

	if(!empty($pp_advance_combine_css))
	{
		//Function for compressing the CSS as tightly as possible
		function compress($buffer) {
		    //Remove CSS comments
		    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
		    //Remove tabs, spaces, newlines, etc.
		    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
		    return $buffer;
		}
	
		//This GZIPs the CSS for transmission to the user
		//making file size smaller and transfer rate quicker
		ob_start("ob_gzhandler");
		ob_start("compress");
	}

	//Hack animation CSS for Safari
	$current_browser = getBrowser();
	
	//If enable animation
	$pp_animation = get_option('pp_animation');
	if(!empty($pp_animation))
	{
?>
.fadeIn, .mansory_img, #photo_wall_wrapper .wall_entry .wall_thumbnail, #ajax_portfolio_content, #menu_close_icon, #blog_grid_wrapper .post.type-post, #page_content_wrapper .inner .sidebar_content:not(.full_width), #page_content_wrapper .inner .sidebar_wrapper, .animate, .post.type-post .mask .mask_frame .mask_image_content .mask_image_content_frame i, .wall_thumbnail .mask .mask_frame .mask_image_content .mask_image_content_frame i, #horizontal_gallery.visible, #blog_grid_wrapper .post.type-post, .blog_grid_wrapper .post.type-post { opacity: 1 !important; visibility: visible !important; }
<?php
	}
	//If IE later than IE 10
	if(isset($current_browser['name']) && $current_browser['name'] == 'Internet Explorer' && intval($current_browser['version']) < 11)
	{
?>
.fadeIn, .mansory_img, #photo_wall_wrapper .wall_entry .wall_thumbnail, #ajax_portfolio_content, #menu_close_icon, #blog_grid_wrapper .post.type-post, #page_content_wrapper .inner .sidebar_content:not(.full_width), #page_content_wrapper .inner .sidebar_wrapper, .animate, #horizontal_gallery, .post.type-post .mask .mask_frame .mask_image_content .mask_image_content_frame i, .wall_thumbnail .mask .mask_frame .mask_image_content .mask_image_content_frame i, #blog_grid_wrapper .post.type-post, .blog_grid_wrapper .post.type-post, #photo_wall_wrapper .wall_entry .wall_thumbnail, .photo_wall_wrapper .wall_entry .wall_thumbnail, #blog_grid_wrapper .post.type-post, .blog_grid_wrapper .post.type-post { opacity: 1 !important; visibility: visible !important; }
.isotope-item { z-index: 2 !important; }
.isotope-hidden.isotope-item { pointer-events: none; display: none; z-index: 1 !important; }
.wall_thumbnail .mask .mask_frame .mask_image_content.hascycle
{
	position: absolute;
}
.wall_thumbnail .mask .mask_frame .mask_image_content, .wall_thumbnail .mask .mask_frame .mask_image_content .mask_image_content_frame
{
	display: block !important;
}
.wall_thumbnail .mask .mask_frame .mask_image_content .mask_image_content_frame
{
	margin-top: 43%;
}
.page_control_static
{
	display: none;
}
<?php
	}
?>

<?php
	//If IE later than IE 10
	if(isset($current_browser['name']) && $current_browser['name'] == 'Internet Explorer' && intval($current_browser['version']) < 10)
	{
?>
.wall_thumbnail .mask .mask_frame .mask_image_content .mask_image_content_frame
{
	opacity: 1;
	visibility: visible;
}
<?php
	}
?>

<?php
$pp_logo_margin_top = get_option('pp_logo_margin_top');

if(is_numeric($pp_logo_margin_top))
{
?>
.top_bar { padding-top: <?php echo $pp_logo_margin_top; ?>px; }		
<?php
}
?>

<?php
$pp_logo_margin_bottom = get_option('pp_logo_margin_bottom');

if(is_numeric($pp_logo_margin_bottom))
{
?>
.top_bar { padding-bottom: <?php echo $pp_logo_margin_bottom; ?>px; }		
<?php
}
?>

<?php
$pp_logo_full_max_height = get_option('pp_logo_full_max_height');

if(is_numeric($pp_logo_full_max_height))
{
?>
body[data-style=fullscreen] .top_bar .logo_wrapper img { max-height: <?php echo $pp_logo_full_max_height; ?>px; }		
<?php
}
?>

<?php
$pp_logo_full_margin_top = get_option('pp_logo_full_margin_top');

if(is_numeric($pp_logo_full_margin_top))
{
?>
body[data-style=fullscreen] .top_bar { padding-top: <?php echo $pp_logo_full_margin_top; ?>px; }		
<?php
}
?>

<?php
$pp_logo_full_margin_bottom = get_option('pp_logo_full_margin_bottom');

if(is_numeric($pp_logo_full_margin_bottom))
{
?>
body[data-style=fullscreen] .top_bar { padding-bottom: <?php echo $pp_logo_full_margin_bottom; ?>px; }		
<?php
}
?>

<?php
$pp_menu_font = get_option('pp_menu_font');

if(!empty($pp_menu_font))
{
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a, .mobile_main_nav li a { font-family: '<?php echo urldecode($pp_menu_font); ?>' !important; }		
<?php
}
?>

<?php
$pp_menu_weight = get_option('pp_menu_weight');

if(!empty($pp_menu_weight))
{
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a, .mobile_main_nav li a { font-weight: <?php echo $pp_menu_weight; ?>; }		
<?php
}
?>

<?php
$pp_menu_font_size = get_option('pp_menu_font_size');

if(!empty($pp_menu_font_size))
{
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a, .mobile_main_nav li a { font-size: <?php echo $pp_menu_font_size; ?>px; }		
<?php
}
?>

<?php
$pp_submenu_font_size = get_option('pp_submenu_font_size');

if(!empty($pp_submenu_font_size))
{
?>
#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a { font-size: <?php echo $pp_submenu_font_size; ?>px; line-height:<?php echo $pp_submenu_font_size+19; ?>px; }		
<?php
}
?>

<?php
	$pp_menu_upper = get_option('pp_menu_upper');

	if(empty($pp_menu_upper))
	{
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a, .mobile_main_nav li a { text-transform: none; }		
<?php
	}

	$pp_submenu_upper = get_option('pp_submenu_upper');

	if(empty($pp_submenu_upper))
	{
?>
#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a { text-transform: none; }		
<?php
	}
?>

<?php
$pp_menu_font_color = get_option('pp_menu_font_color');

if(!empty($pp_menu_font_color))
{
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a { color: <?php echo $pp_menu_font_color; ?>; }
@media only screen and (max-width: 767px) {
	#menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-item ul li a, #menu_wrapper div .nav li ul li.current-menu-item a, #menu_wrapper .nav ul li ul li a, #menu_wrapper .nav ul li.current-menu-item ul li a, #menu_wrapper .nav ul li ul li.current-menu-item a, #menu_wrapper div .nav li.current-menu-parent ul li a, #menu_wrapper div .nav li ul li.current-menu-parent a, .mobile_main_nav li a { color: <?php echo $pp_menu_font_color; ?> !important; }
}
body.js_nav #menu_close_icon:hover #menu_toggle:before, body.js_nav #menu_close_icon:hover #menu_toggle:after 
{
	background: <?php echo $pp_menu_font_color; ?> !important;
}
<?php
}
?>

<?php
$pp_menu_hover_font_color = get_option('pp_menu_hover_font_color');

if(!empty($pp_menu_hover_font_color))
{
?>
#menu_wrapper .nav ul li a.hover, #menu_wrapper .nav ul li a:hover, #menu_wrapper div .nav li a.hover, #menu_wrapper div .nav li a:hover { color: <?php echo $pp_menu_hover_font_color; ?>; }		
<?php
}
?>

<?php
$pp_menu_active_font_color = get_option('pp_menu_active_font_color');

if(!empty($pp_menu_active_font_color))
{
?>
#menu_wrapper div .nav li.current-menu-item > a, #menu_wrapper div .nav li.current-menu-parent > a, #menu_wrapper div .nav li.current-menu-ancestor > a, #menu_wrapper div .nav li ul li.current-menu-ancestor > a, .page_control_static #page_maximize:after, #close_mobile_menu i, .mobile_main_nav li a:before { color: <?php echo $pp_menu_active_font_color; ?> !important; }
#mobile_nav_icon { border-color: <?php echo $pp_menu_active_font_color; ?>; }	
<?php
}
?>

<?php
$pp_menu_bg_color = get_option('pp_menu_bg_color');

if(!empty($pp_menu_bg_color))
{
?>
.top_bar, .page_control_static, .mobile_menu_wrapper { background: <?php echo $pp_menu_bg_color; ?>; }
@media only screen and (max-width: 767px) {
	#menu_wrapper .nav ul li ul, #menu_wrapper div .nav li ul { background: <?php echo $pp_menu_bg_color; ?> !important; }
}
<?php
}
?>

<?php
$pp_submenu_bg_color = get_option('pp_submenu_bg_color');

if(!empty($pp_submenu_bg_color))
{
?>
#menu_wrapper .nav ul li ul, #menu_wrapper div .nav li ul { background: <?php echo $pp_submenu_bg_color; ?>; }
<?php
}
?>

<?php
$pp_submenu_border_color = get_option('pp_submenu_border_color');

if(!empty($pp_submenu_border_color))
{
?>
#menu_wrapper .nav ul li ul, #menu_wrapper div .nav li ul { border-color: <?php echo $pp_submenu_border_color; ?>; }
.mobile_main_nav li { border-top: 1px solid <?php echo $pp_submenu_border_color; ?>; }
<?php
}
?>

<?php
$pp_submenu_font_color = get_option('pp_submenu_font_color');

if(!empty($pp_submenu_font_color))
{
?>
#menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-item ul li a, #menu_wrapper div .nav li ul li.current-menu-item a, #menu_wrapper .nav ul li ul li a, #menu_wrapper .nav ul li.current-menu-item ul li a, #menu_wrapper .nav ul li ul li.current-menu-item a, #menu_wrapper div .nav li.current-menu-parent ul li a, #menu_wrapper div .nav li ul li.current-menu-parent a { color: <?php echo $pp_submenu_font_color; ?>; }		
<?php
}
?>

<?php
$pp_submenu_hover_font_color = get_option('pp_submenu_hover_font_color');

if(!empty($pp_submenu_hover_font_color))
{
?>
#menu_wrapper .nav ul li ul li a:hover, #menu_wrapper .nav ul li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li.current-menu-item ul li a:hover, #menu_wrapper div .nav li.current-menu-parent ul li a:hover { color: <?php echo $pp_submenu_hover_font_color; ?>; }		
<?php
}
?>

<?php
$pp_page_header_bg_color = get_option('pp_page_header_bg_color');

if(!empty($pp_page_header_bg_color))
{
?>
#page_caption, #portfolio_wall_filters { background: <?php echo $pp_page_header_bg_color; ?>; }		
<?php
}
?>

<?php
$pp_page_header_padding_top = get_option('pp_page_header_padding_top');

if(!empty($pp_page_header_padding_top))
{
?>
#page_caption { padding-top: <?php echo $pp_page_header_padding_top; ?>px; }		
<?php
}
?>

<?php
$pp_page_header_padding_bottom = get_option('pp_page_header_padding_bottom');

if(!empty($pp_page_header_padding_bottom))
{
?>
#page_caption { padding-bottom: <?php echo $pp_page_header_padding_bottom; ?>px; }		
<?php
}
?>

<?php
	$pp_page_title_font_color = get_option('pp_page_title_font_color');
	
	if(!empty($pp_page_title_font_color))
	{
?>
#page_caption h1 { color:<?php echo $pp_page_title_font_color; ?>; }
<?php
	}
?>

<?php
	$pp_page_title_font_size = get_option('pp_page_title_font_size');
	
	if(!empty($pp_page_title_font_size))
	{
?>
#page_caption h1 { font-size:<?php echo $pp_page_title_font_size; ?>px; }
<?php
	}
?>

<?php
	$pp_page_title_upper = get_option('pp_page_title_upper');

	if(!empty($pp_page_title_upper))
	{
?>
#page_caption h1 { text-transform: uppercase; }		
<?php
	}
?>

<?php
	$pp_page_tagline_font_color = get_option('pp_page_tagline_font_color');
	
	if(!empty($pp_page_tagline_font_color))
	{
?>
.page_tagline { color:<?php echo $pp_page_tagline_font_color; ?>; }
<?php
	}
?>

<?php
	$pp_page_tagline_font_size = get_option('pp_page_tagline_font_size');
	
	if(!empty($pp_page_tagline_font_size))
	{
?>
.page_tagline { font-size:<?php echo $pp_page_tagline_font_size; ?>px; }
<?php
	}
?>

<?php
	$pp_page_tagline_upper = get_option('pp_page_tagline_upper');

	if(empty($pp_page_tagline_upper))
	{
?>
.page_tagline { text-transform: none; }		
<?php
	}
?>

<?php
	$pp_page_tagline_letter_spacing = get_option('pp_page_tagline_letter_spacing');
	
	if(!empty($pp_page_tagline_letter_spacing))
	{
?>
.page_tagline { letter-spacing:<?php echo $pp_page_tagline_letter_spacing; ?>px; }
<?php
	}
?>

<?php
$pp_footer_bg_color = get_option('pp_footer_bg_color');

if(!empty($pp_footer_bg_color))
{
?>
.footer_bar, #toTop:hover { background: <?php echo $pp_footer_bg_color; ?>; }
<?php
}
?>

<?php
$pp_footer_font_color = get_option('pp_footer_font_color');

if(!empty($pp_footer_font_color))
{
?>
#copyright { color: <?php echo $pp_footer_font_color; ?>; }
<?php
}
?>

<?php
$pp_footer_link_color = get_option('pp_footer_link_color');

if(!empty($pp_footer_link_color))
{
?>
#copyright a, #copyright a:active, .footer_bar .social_wrapper ul li a, #toTop:hover { color: <?php echo $pp_footer_link_color; ?>; }
<?php
}
?>

<?php
$pp_footer_hover_link_color = get_option('pp_footer_hover_link_color');

if(!empty($pp_footer_hover_link_color))
{
?>
#copyright a:hover, .footer_bar .social_wrapper ul li a:hover { color: <?php echo $pp_footer_hover_link_color; ?>; }
<?php
}
?>

<?php
$pp_totop_bg_color = get_option('pp_totop_bg_color');

if(!empty($pp_totop_bg_color))
{
?>
#toTop { background: <?php echo $pp_totop_bg_color; ?>; }
<?php
}
?>

<?php
$pp_totop_icon_color = get_option('pp_totop_icon_color');

if(!empty($pp_totop_icon_color))
{
?>
#toTop { color: <?php echo $pp_totop_icon_color; ?>; }
<?php
}
?>

<?php
	$pp_sidebar_font_color = get_option('pp_sidebar_font_color');
	
	if(!empty($pp_sidebar_font_color))
	{
?>
#page_content_wrapper .inner .sidebar_wrapper .sidebar .content { color:<?php echo $pp_sidebar_font_color; ?>; }
<?php
	}
?>

<?php
	$pp_sidebar_link_color = get_option('pp_sidebar_link_color');
	
	if(!empty($pp_sidebar_link_color))
	{
?>
#page_content_wrapper .inner .sidebar_wrapper a, #post_more_close i.fa { color:<?php echo $pp_sidebar_link_color; ?>; }
<?php
	}
?>

<?php
	$pp_sidebar_hover_link_color = get_option('pp_sidebar_hover_link_color');
	
	if(!empty($pp_sidebar_hover_link_color))
	{
?>
#page_content_wrapper .inner .sidebar_wrapper a:hover, #page_content_wrapper .inner .sidebar_wrapper a:active { color:<?php echo $pp_sidebar_hover_link_color; ?>; }
<?php
	}
?>

<?php
	$pp_sidebar_title_color = get_option('pp_sidebar_title_color');
	
	if(!empty($pp_sidebar_title_color))
	{
?>
#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle { color:<?php echo $pp_sidebar_title_color; ?>; }
<?php
	}
?>

<?php
	$pp_sidebar_title_bg_color = get_option('pp_sidebar_title_bg_color');
	
	if(!empty($pp_sidebar_title_bg_color))
	{
?>
#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle { background:<?php echo $pp_sidebar_title_bg_color; ?>; }
<?php
	}
?>

<?php
	$pp_sidebar_title_font_size = get_option('pp_sidebar_title_font_size');
	
	if(!empty($pp_sidebar_title_font_size))
	{
?>
#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle { font-size:<?php echo $pp_sidebar_title_font_size; ?>px; }
<?php
	}
?>

<?php
	$pp_sidebar_title_upper = get_option('pp_sidebar_title_upper');

	if(empty($pp_sidebar_title_upper))
	{
?>
#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle { text-transform: none; }		
<?php
	}
?>

<?php
	$pp_sidebar_title_letter_spacing = get_option('pp_sidebar_title_letter_spacing');

	if(!empty($pp_sidebar_title_letter_spacing))
	{
?>
#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle { letter-spacing:<?php echo $pp_sidebar_title_letter_spacing; ?>px; }		
<?php
	}
?>

<?php
	$pp_sidebar_title_font = get_option('pp_sidebar_title_font');
	
	if(!empty($pp_sidebar_title_font))
	{
?>
#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle { font-family: '<?php echo urldecode($pp_sidebar_title_font); ?>'; }		
<?php
	}
?>

<?php
	$pp_header_font = get_option('pp_header_font');
	
	if(!empty($pp_header_font))
	{
?>
	h1, h2, h3, h4, h5, h6, h7, #page_caption h1, .footer_bar .social_wrapper ul li a, input[type=submit], input[type=button], a.button, .button, .filter li a { font-family: '<?php echo urldecode($pp_header_font); ?>'; }		
<?php
	}
?>

<?php
	$pp_h1_weight = get_option('pp_h1_weight');
	
	if(!empty($pp_h1_weight))
	{
?>
	h1, h2, h3, h4, h5, h6, h7 { font-weight: <?php echo $pp_h1_weight; ?>; }		
<?php
	}
?>

<?php
	$pp_h1_size = get_option('pp_h1_size');
	
	if(!empty($pp_h1_size))
	{
?>
h1 { font-size:<?php echo $pp_h1_size; ?>px; }
<?php
	}
?>

<?php
	$pp_h2_size = get_option('pp_h2_size');
	
	if(!empty($pp_h2_size))
	{
?>
h2 { font-size:<?php echo $pp_h2_size; ?>px; }
<?php
	}
?>

<?php
	$pp_h3_size = get_option('pp_h3_size');
	
	if(!empty($pp_h3_size))
	{
?>
h3 { font-size:<?php echo $pp_h3_size; ?>px; }
<?php
	}
?>

<?php
	$pp_h4_size = get_option('pp_h4_size');
	
	if(!empty($pp_h4_size))
	{
?>
h4 { font-size:<?php echo $pp_h4_size; ?>px; }
<?php
	}
?>

<?php
	$pp_h5_size = get_option('pp_h5_size');
	
	if(!empty($pp_h5_size))
	{
?>
h5 { font-size:<?php echo $pp_h5_size; ?>px; }
<?php
	}
?>

<?php
	$pp_h6_size = get_option('pp_h6_size');
	
	if(!empty($pp_h6_size))
	{
?>
h6 { font-size:<?php echo $pp_h6_size; ?>px; }
<?php
	}
?>

<?php
	$pp_body_font = get_option('pp_body_font');
	
	if(!empty($pp_body_font))
	{
?>
	body, .fancybox-title-outside-wrap { font-family: '<?php echo urldecode($pp_body_font); ?>'; }		
<?php
	}
?>

<?php
	$pp_body_font_size = get_option('pp_body_font_size');
	
	if(!empty($pp_body_font_size))
	{
?>
body { font-size:<?php echo $pp_body_font_size; ?>px; }
<?php
	}
?>

<?php
    $pp_content_bg_color = get_option('pp_content_bg_color');

    if(!empty($pp_content_bg_color))
    {
?>
#page_content_wrapper, .page_content_wrapper, #page_content_wrapper.fixed
{
    background: <?php echo $pp_content_bg_color; ?>;
}
<?php
    }
?>

<?php
    $pp_photoframe_bg_color = get_option('pp_photoframe_bg_color');

    if(!empty($pp_photoframe_bg_color))
    {
?>
.image_classic_frame, body[data-style=blog_grid] .post.type-post, body.page-template-galleries-php .gallery.type-gallery, body[data-style=blog_grid] .post.type-post, .ppb_galleries .post.type-post, #horizontal_gallery_wrapper
{
    background: <?php echo $pp_photoframe_bg_color; ?>;
}
<?php
    }
?>

<?php
	$pp_page_frame = get_option('pp_page_frame');
	
	if(empty($pp_page_frame))
	{
?>
.frame_top, .frame_bottom,.frame_left, .frame_right { display:none; }
#wrapper { padding: 0; }
body[data-style=fullscreen] .top_bar { top: 0; }
#page_content_wrapper.fixed { top: 65px; right: 0; bottom: 0; }
<?php
	}
?>

<?php
    $pp_page_frame_color = get_option('pp_page_frame_color');

    if(!empty($pp_page_frame_color))
    {
?>
.frame_top, .frame_bottom,.frame_left, .frame_right
{
    background: <?php echo $pp_page_frame_color; ?>;
}
<?php
    }
?>

<?php
$pp_font_color = get_option('pp_font_color');

if(!empty($pp_font_color))
{
?>
body, .pagination a { color: <?php echo $pp_font_color; ?>; }
<?php
}
?>

<?php
	$pp_link_color = get_option('pp_link_color');
	
	if(!empty($pp_link_color))
	{
?>
a, .post_date { color:<?php echo $pp_link_color; ?>; }
::selection { background:<?php echo $pp_link_color; ?>; }
<?php
	}
?>

<?php
	$pp_hover_link_color = get_option('pp_hover_link_color');
	
	if(!empty($pp_hover_link_color))
	{
?>
a:hover, a:active { color:<?php echo $pp_hover_link_color; ?>; }
<?php
	}
?>

<?php
$pp_h1_font_color = get_option('pp_h1_font_color');
if(!empty($pp_h1_font_color))
{
?>
h1, h2, h3, h4, h5, pre, code, tt, blockquote, .post_header h5 a, .post_header h3 a, .post_header.grid h6 a, #imageFlow .title h6, .post_header.fullwidth h4 a, .post_header h5 a
{
	color: <?php echo $pp_h1_font_color; ?>;
}
<?php
}
?>

<?php
	$pp_hr_color = get_option('pp_hr_color');

	if(!empty($pp_hr_color))
	{
	
?>
hr, .post_wrapper, h1.product_title, #respond.comment-respond
{
	border-color: <?php echo $pp_hr_color; ?>;
}
<?php
	}
?>

<?php
	$pp_input_bg_color = get_option('pp_input_bg_color');

	if(!empty($pp_input_bg_color))
	{
	
?>
input[type=text], input[type=password], .woocommerce table.cart td.actions .coupon .input-text, .woocommerce-page table.cart td.actions .coupon .input-text, .woocommerce #content table.cart td.actions .coupon .input-text, .woocommerce-page #content table.cart td.actions .coupon .input-text, textarea
{
	background: <?php echo $pp_input_bg_color; ?>;
}
<?php
	}
?>

<?php
	$pp_input_font_color = get_option('pp_input_font_color');

	if(!empty($pp_input_font_color))
	{
	
?>
input[type=text], input[type=password], .woocommerce table.cart td.actions .coupon .input-text, .woocommerce-page table.cart td.actions .coupon .input-text, .woocommerce #content table.cart td.actions .coupon .input-text, .woocommerce-page #content table.cart td.actions .coupon .input-text, textarea, .top_bar #searchform input
{
	color: <?php echo $pp_input_font_color; ?>;
}
<?php
	}
?>

<?php
	$pp_input_border_color = get_option('pp_input_border_color');

	if(!empty($pp_input_border_color))
	{
	
?>
input[type=text], input[type=password], .woocommerce table.cart td.actions .coupon .input-text, .woocommerce-page table.cart td.actions .coupon .input-text, .woocommerce #content table.cart td.actions .coupon .input-text, .woocommerce-page #content table.cart td.actions .coupon .input-text, textarea, .top_bar #searchform input
{
	border-color: <?php echo $pp_input_border_color; ?>;
}
<?php
	}
?>

<?php
	$pp_input_focus_border_color = get_option('pp_input_focus_border_color');

	if(!empty($pp_input_border_color))
	{
	
?>
input[type=text]:focus, input[type=password]:focus, .woocommerce table.cart td.actions .coupon .input-text:focus, .woocommerce-page table.cart td.actions .coupon .input-text:focus, .woocommerce #content table.cart td.actions .coupon .input-text:focus, .woocommerce-page #content table.cart td.actions .coupon .input-text:focus, textarea:focus
{
	border-color: <?php echo $pp_input_focus_border_color; ?>;
}
<?php
	}
?>

<?php
	$pp_button_bg_color = get_option('pp_button_bg_color');
	
	if(!empty($pp_button_bg_color))
	{
?>
input[type=submit], input[type=button], a.button, .button, .woocommerce button.button.alt, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button { 
	background: <?php echo $pp_button_bg_color; ?>;
	background-color: <?php echo $pp_button_bg_color; ?>;
}
.pagination span, .pagination a:hover
{
	background: <?php echo $pp_button_bg_color; ?> !important;
	border-color: <?php echo $pp_button_bg_color; ?>;
}
<?php
	}
	
?>

<?php
	$pp_button_font_color = get_option('pp_button_font_color');
	
	if(!empty($pp_button_font_color))
	{
?>
input[type=submit], input[type=button], a.button, .button { 
	color: <?php echo $pp_button_font_color; ?>;
}
.woocommerce-page ul.products li.product a.add_to_cart_button.loading, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button, .woocommerce .widget_shopping_cart .widget_shopping_cart_content a.button, .woocommerce table.cart td.actions .button.alt.checkout-button, .woocommerce #payment #place_order, .woocommerce-page #payment #place_order, .woocommerce table.cart td.actions .button.alt {
	color: <?php echo $pp_button_font_color; ?> !important;
}
<?php
	}
	
?>

<?php
	$pp_button_border_color = get_option('pp_button_border_color');
	
	if(!empty($pp_button_border_color))
	{
?>
input[type=submit], input[type=button], a.button, .button, .woocommerce button.button.alt, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button { 
	border: 1px solid <?php echo $pp_button_border_color; ?>;
}
<?php
	}	
?>

<?php
	$pp_full_image_title = get_option('pp_full_image_title');
	
	if(empty($pp_full_image_title))
	{
?>
#slidecaption { 
	display: none;
}
<?php
	}	
?>

<?php
$pp_portfolio_hover_bg_color = get_option('pp_portfolio_hover_bg_color');

if(!empty($pp_portfolio_hover_bg_color))
{
?>
.mansory_thumbnail .mask, .wall_thumbnail .mask .mask_frame .mask_image_content.hascycle, .post.type-post .mask { background-color: <?php echo $pp_portfolio_hover_bg_color; ?>; }
<?php
}

//Calculate background color for fullscreen content
$ori_pp_portfolio_hover_bg_color = $pp_portfolio_hover_bg_color;
$pp_portfolio_hover_bg_color = HexToRGB($pp_portfolio_hover_bg_color);
$pp_portfolio_hover_opacity_color = get_option('pp_portfolio_hover_opacity_color');
$pp_portfolio_hover_opacity_color = $pp_portfolio_hover_opacity_color/100;
?>
.mansory_thumbnail .mask, .wall_thumbnail .mask .mask_frame .mask_image_content.hascycle, .post.type-post .mask
{
	background: <?php echo $ori_pp_portfolio_hover_bg_color; ?>;
	background: rgb(<?php echo $pp_portfolio_hover_bg_color['r']; ?>, <?php echo $pp_portfolio_hover_bg_color['g']; ?>, <?php echo $pp_portfolio_hover_bg_color['b']; ?>, <?php echo $pp_portfolio_hover_opacity_color; ?>);
	background: rgba(<?php echo $pp_portfolio_hover_bg_color['r']; ?>, <?php echo $pp_portfolio_hover_bg_color['g']; ?>, <?php echo $pp_portfolio_hover_bg_color['b']; ?>, <?php echo $pp_portfolio_hover_opacity_color; ?>);
}

<?php
	$pp_gallery_cover_bg_color = get_option('pp_gallery_cover_bg_color');
	
	if(!empty($pp_gallery_cover_bg_color))
	{
?>
.grid_cover_wrapper .mask { 
	background: <?php echo $pp_gallery_cover_bg_color; ?>;
}
<?php
	}

	$ori_pp_gallery_cover_bg_color = $pp_gallery_cover_bg_color;
	$pp_gallery_cover_bg_color = HexToRGB($pp_gallery_cover_bg_color);
	$pp_gallery_cover_opacity_color = get_option('pp_gallery_cover_opacity_color');
	$pp_gallery_cover_opacity_color = $pp_gallery_cover_opacity_color/100;
?>
.grid_cover_wrapper .mask
{
	background: <?php echo $ori_pp_gallery_cover_bg_color; ?>;
	background: rgb(<?php echo $pp_gallery_cover_bg_color['r']; ?>, <?php echo $pp_gallery_cover_bg_color['g']; ?>, <?php echo $pp_gallery_cover_bg_color['b']; ?>, <?php echo $pp_gallery_cover_opacity_color; ?>);
	background: rgba(<?php echo $pp_gallery_cover_bg_color['r']; ?>, <?php echo $pp_gallery_cover_bg_color['g']; ?>, <?php echo $pp_gallery_cover_bg_color['b']; ?>, <?php echo $pp_gallery_cover_opacity_color; ?>);
}

<?php
	$pp_portfolio_hover_blur = get_option('pp_portfolio_hover_blur');
	
	if(empty($pp_portfolio_hover_blur))
	{
?>
.post.type-post.gallery:hover img:not(.static), .wall_thumbnail:hover img:not(.static)
{
	-webkit-filter: blur(0px);
	filter: blur(0px);
	-moz-filter: blur(0px);
}	
<?php
	}
?>

<?php
	$pp_gallery_cover_title_font = get_option('pp_gallery_cover_title_font');
	
	if(!empty($pp_gallery_cover_title_font))
	{
?>
.grid_cover_wrapper .frame .gallery_content h1 { font-family: '<?php echo urldecode($pp_gallery_cover_title_font); ?>'; }		
<?php
	}
?>

<?php
	$pp_gallery_cover_title_font_size = get_option('pp_gallery_cover_title_font_size');
	
	if(!empty($pp_gallery_cover_title_font_size))
	{
?>
.grid_cover_wrapper .frame .gallery_content h1 { 
	font-size: <?php echo $pp_gallery_cover_title_font_size; ?>px;
	line-height: <?php echo $pp_gallery_cover_title_font_size+10; ?>px;
	<?php
		if($pp_gallery_cover_title_font_size<80)
		{
	?>
		letter-spacing: 0px;
	<?php
		}
	?>
}
<?php
	}	
?>

<?php
	$pp_gallery_cover_title_font_color = get_option('pp_gallery_cover_title_font_color');
	
	if(!empty($pp_gallery_cover_title_font_color))
	{
?>
.grid_cover_wrapper .frame .gallery_content h1 { color: <?php echo $pp_gallery_cover_title_font_color; ?>; }		
<?php
	}
?>

<?php
	$pp_gallery_cover_desc_font_size = get_option('pp_gallery_cover_desc_font_size');
	
	if(!empty($pp_gallery_cover_desc_font_size))
	{
?>
.grid_cover_wrapper .frame .gallery_content .gallery_desc { font-size: <?php echo $pp_gallery_cover_desc_font_size; ?>px; }		
<?php
	}
?>

<?php
	$pp_gallery_cover_desc_upper = get_option('pp_gallery_cover_desc_upper');

	if(empty($pp_gallery_cover_desc_upper))
	{
?>
.grid_cover_wrapper .frame .gallery_content .gallery_desc { text-transform: none; }		
<?php
	}
?>

<?php
	$pp_gallery_cover_desc_letter_space = get_option('pp_gallery_cover_desc_letter_space');
	if(empty($pp_gallery_cover_desc_letter_space))
	{
		$pp_gallery_cover_desc_letter_space = 0;
	}
?>
.grid_cover_wrapper .frame .gallery_content .gallery_desc { letter-spacing: <?php echo $pp_gallery_cover_desc_letter_space; ?>px; }

<?php
	$pp_gallery_cover_button_font_color = get_option('pp_gallery_cover_button_font_color');
	
	if(!empty($pp_gallery_cover_button_font_color))
	{
?>
.view_gallery, .view_gallery_full { color: <?php echo $pp_gallery_cover_button_font_color; ?>; }		
<?php
	}
?>

<?php
	$pp_gallery_cover_button_border_color = get_option('pp_gallery_cover_button_border_color');
	
	if(!empty($pp_gallery_cover_button_border_color))
	{
?>
.view_gallery, .view_gallery_full { border-color: <?php echo $pp_gallery_cover_button_border_color; ?>; }		
<?php
	}
?>

<?php
	$pp_filterable_font_color = get_option('pp_filterable_font_color');
	
	if(!empty($pp_filterable_font_color))
	{
?>
.filter li a, #portfolio_wall_filters li a { color: <?php echo $pp_filterable_font_color; ?>; }		
<?php
	}
?>

<?php
	$pp_filterable_active_color = get_option('pp_filterable_active_color');
	
	if(!empty($pp_filterable_active_color))
	{
?>
.filter li a:hover, .filter li a.active, #portfolio_wall_filters li a.active,  #portfolio_wall_filters li a:hover { color: <?php echo $pp_filterable_active_color; ?>; }		
<?php
	}
?>

<?php
	$pp_filterable_active_bg_color = get_option('pp_filterable_active_bg_color');
	
	if(!empty($pp_filterable_active_bg_color))
	{
?>
.filter li a:hover, .filter li a.active, #portfolio_wall_filters li a.active,  #portfolio_wall_filters li a:hover { background: <?php echo $pp_filterable_active_bg_color; ?>; }		
<?php
	}
?>

<?php
	$pp_full_title_font_color = get_option('pp_full_title_font_color');
	
	if(!empty($pp_full_title_font_color))
	{
?>
#gallery_caption h2, #gallery_caption .gallery_desc, a#prevslide:before, a#nextslide:before, #gallery_caption a, #gallery_caption a:hover, #gallery_caption a:activ, .slider_wrapper .gallery_image_caption h2e { color: <?php echo $pp_full_title_font_color; ?> !important; }		
<?php
	}
?>

<?php
	$pp_image_desc_font = get_option('pp_image_desc_font');
	
	if(!empty($pp_image_desc_font))
	{
?>
.wall_thumbnail .mask .mask_frame .mask_image_content span, .mansory_thumbnail .mask .mask_frame .mask_image_content span, #gallery_caption .gallery_desc, #imageFlow .legend, #imageFlow .legend a, #imageFlow .legend a:hover, #imageFlow .legend a:active { font-family: '<?php echo urldecode($pp_image_desc_font); ?>'; }		
<?php
	}
?>

<?php
	$pp_image_caption_font_size = get_option('pp_image_caption_font_size');
	
	if(!empty($pp_image_caption_font_size))
	{
?>
#horizontal_gallery_wrapper .gallery_image_wrapper .image_caption, .image_caption, .mfp-title { font-size: <?php echo $pp_image_caption_font_size; ?>px; }	
<?php
	}
?>

<?php
	$pp_image_caption_upper = get_option('pp_image_caption_upper');
	
	if(empty($pp_image_caption_upper))
	{
?>
#horizontal_gallery_wrapper .gallery_image_wrapper .image_caption, .image_caption, .mfp-title, .wp-caption p.wp-caption-text { text-transform: none; }	
<?php
	}
?>

<?php
	$pp_image_caption_weight = get_option('pp_image_caption_weight');
	
	if(!empty($pp_image_caption_weight))
	{
?>
#horizontal_gallery_wrapper .gallery_image_wrapper .image_caption, .image_caption, .mfp-title, .wp-caption p.wp-caption-text { font-weight: <?php echo $pp_image_caption_weight; ?>; }	
<?php
	}
?>

<?php
	$pp_image_caption_letter_spacing = get_option('pp_image_caption_letter_spacing');
	
	if(!empty($pp_image_caption_letter_spacing))
	{
?>
#horizontal_gallery_wrapper .gallery_image_wrapper .image_caption, .image_caption, .mfp-title, .wp-caption p.wp-caption-text { letter-spacing: <?php echo $pp_image_caption_letter_spacing; ?>px; }	
<?php
	}
?>

<?php
	$pp_shop_price_font_color = get_option('pp_shop_price_font_color');
	
	if(!empty($pp_shop_price_font_color))
	{
?>
.woocommerce ul.products li.product .price ins, .woocommerce-page ul.products li.product .price ins, .woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, p.price ins span.amount, p.price span.amount, .woocommerce #content div.product p.price, .woocommerce #content div.product span.price, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce-page #content div.product p.price, .woocommerce-page #content div.product span.price, .woocommerce-page div.product p.price, .woocommerce-page div.product span.price { 
	color: <?php echo $pp_shop_price_font_color; ?>;
}
<?php
	}	
?>

<?php
	//Get main menu layout
    $pp_menu_layout = get_option('pp_menu_layout');
    
    switch($pp_menu_layout)
    {
    	case 2:	
?>
.top_bar_wrapper { width: 960px; margin: auto; text-align:right; }
.main_menu_container { margin: 0 0 0 5px; }
#menu_wrapper { float: left; width: 100%; }
.logo_wrapper { float: left; }
#page_caption { clear: both; }
.top_bar.fixed #menu_wrapper .nav ul, #menu_wrapper div .nav { padding-top: 0; }
.footer_bar { float: left; }
.footer_bar .logo_wrapper { float: none; }
.top_bar #searchform { margin-top: -8px; }
#menu_wrapper div .nav.hide { display: none; }
body[data-style=fullscreen] .top_bar .main_menu_container { margin-top: 0 !important; }
.header_cart_wrapper { margin-left: 20px; top: -3px; margin-top: 0 !important; }
.main_menu_container{ margin-top: 0 !important; }
@media only screen and (max-width: 959px) {
	.logo_wrapper { margin-left: 40px !important; }
}
<?php
		if(THEMEDEMO)
		{
?>
.top_bar .logo_wrapper img { width: auto; max-height: 40px; }
<?php
		}

    	break;

	} //End switch
?>

<?php
if(THEMEDEMO)
{
?>
@media only screen and (min-width: 768px) and (max-width: 960px) {
	img.thumbnail_gallery
	{
		max-width: 212px !important;
		height: auto;
	}
}
<?php
}
?>

<?php
/**
*	Get custom CSS
**/
$pp_custom_css = get_option('pp_custom_css');


if(!empty($pp_custom_css))
{
    echo stripslashes($pp_custom_css);
}
?>

<?php
if(!empty($pp_advance_combine_css))
{
	ob_end_flush();
	ob_end_flush();
}
?>