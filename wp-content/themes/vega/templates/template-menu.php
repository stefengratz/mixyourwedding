<?php
    //Get main menu layout
    $pp_menu_layout = get_option('pp_menu_layout');
    
    if(THEMEDEMO && isset($_GET['vegastyle']) && $_GET['vegastyle']==4)
	{
		$pp_menu_layout = 2;
	}
    
    switch($pp_menu_layout)
    {
    	case '':
    	case 0:
    	case 1:
    	default:
?>

<?php 	
    if ( has_nav_menu( 'left-menu' ) ) 
    {
        //Get page nav
        wp_nav_menu( 
            	array(
            		'container_class' 	=> 'main_menu_container',
            		'menu_id'			=> 'main_menu_left',
            		'menu_class'		=> 'nav',
            		'theme_location' 	=> 'left-menu',
            		'walker' => new Arrow_Walker_Nav_Menu,
            	) 
        ); 
    }
    else
    {
     		echo '<div class="notice">Please setup "Main Menu Left Side"</div>';
    }
?>

<!-- Begin logo -->	
<?php
    //get custom logo
    $pp_logo = get_option('pp_logo');
    $pp_retina_logo = get_option('pp_retina_logo');
    $pp_retina_logo_width = 0;
    $pp_retina_logo_height = 0;
    			
    if(empty($pp_logo) && empty($pp_retina_logo))
    {
    	$pp_retina_logo = get_template_directory_uri().'/images/logo@2x.png';
    	$pp_retina_logo_width = 173;
    	$pp_retina_logo_height = 66;
    }
    
    if(!empty($pp_retina_logo))
    {
    	$pp_retina_logo_id = '';
    
    	if(empty($pp_retina_logo_width) && empty($pp_retina_logo_height))
    	{
    		//Get image width and height
    		$pp_retina_logo_id = pp_get_image_id($pp_retina_logo);
    		$image_logo = wp_get_attachment_image_src($pp_retina_logo_id, 'original');
    		
    		$pp_retina_logo = $image_logo[0];
    		$pp_retina_logo_width = intval($image_logo[1]/2);
    		$pp_retina_logo_height = intval($image_logo[2]/2);
    	}
    	
    	$image_alt = get_post_meta($pp_retina_logo_id, '_wp_attachment_image_alt', true);
?>		
    <a id="custom_logo" class="logo_wrapper" href="<?php echo esc_url(home_url()); ?>">
    	<img src="<?php echo esc_url($pp_retina_logo); ?>" alt="<?php echo esc_attr($image_alt); ?>" width="<?php echo esc_attr($pp_retina_logo_width); ?>" height="<?php echo esc_attr($pp_retina_logo_height); ?>"/>
    </a>
<?php
    }
    else //if not retina logo
    {
    	$pp_logo_id = pp_get_image_id($pp_logo);
    	$image_alt = get_post_meta($pp_logo_id, '_wp_attachment_image_alt', true);
?>
    <a id="custom_logo" class="logo_wrapper" href="<?php echo esc_url(home_url()); ?>">
    	<img src="<?php echo esc_url($pp_logo); ?>" alt="<?php echo esc_attr($image_alt); ?>"/>
    </a>
<?php
    }
?>
<!-- End logo -->

<?php 	
    if ( has_nav_menu( 'right-menu' ) ) 
    {
        //Get page nav
        wp_nav_menu( 
            	array( 
            		'container_class' 	=> 'main_menu_container',
            		'menu_id'			=> 'main_menu_right',
            		'menu_class'		=> 'nav',
            		'theme_location' 	=> 'right-menu',
            		'walker' => new Arrow_Walker_Nav_Menu,
            	) 
        ); 
    }
    else
    {
     		echo '<div class="notice">Please setup "Main Menu Right Side"</div>';
    }
?>
<?php
if (class_exists('Woocommerce')) {
    //Check if display cart in header

    global $woocommerce;
    $cart_url = $woocommerce->cart->get_cart_url();
    $cart_count = $woocommerce->cart->cart_contents_count;
?>
<div class="header_cart_wrapper">
    <div class="cart_count"><?php echo esc_html($cart_count); ?></div>
    <a href="<?php echo esc_url($cart_url); ?>"><i class="fa fa-shopping-cart"></i></a>
</div>
<br class="clear"/>
<?php
}
?>
<?php
	break;
	
	case 2:
?>

<!-- Begin logo -->	
<?php
    //get custom logo
    $pp_logo = get_option('pp_logo');
    $pp_retina_logo = get_option('pp_retina_logo');
    $pp_retina_logo_width = 0;
    $pp_retina_logo_height = 0;
    			
    if(empty($pp_logo) && empty($pp_retina_logo))
    {
    	$pp_retina_logo = get_template_directory_uri().'/images/logo@2x.png';
    	$pp_retina_logo_width = 173;
    	$pp_retina_logo_height = 66;
    }
    
    if(!empty($pp_retina_logo))
    {
    	$pp_retina_logo_id = '';
    
    	if(empty($pp_retina_logo_width) && empty($pp_retina_logo_height))
    	{
    		//Get image width and height
    		$pp_retina_logo_id = pp_get_image_id($pp_retina_logo);
    		$image_logo = wp_get_attachment_image_src($pp_retina_logo_id, 'original');
    		
    		$pp_retina_logo = $image_logo[0];
    		$pp_retina_logo_width = intval($image_logo[1]/2);
    		$pp_retina_logo_height = intval($image_logo[2]/2);
    	}
    	
    	$image_alt = get_post_meta($pp_retina_logo_id, '_wp_attachment_image_alt', true);
?>		
    <a id="custom_logo" class="logo_wrapper" href="<?php echo esc_url(home_url()); ?>">
    	<img src="<?php echo esc_url($pp_retina_logo); ?>" alt="<?php echo esc_attr($image_alt); ?>" width="<?php echo esc_attr($pp_retina_logo_width); ?>" height="<?php echo esc_attr($pp_retina_logo_height); ?>"/>
    </a>
<?php
    }
    else //if not retina logo
    {
    	$pp_logo_id = pp_get_image_id($pp_logo);
    	$image_alt = get_post_meta($pp_logo_id, '_wp_attachment_image_alt', true);
?>
    <a id="custom_logo" class="logo_wrapper" href="<?php echo esc_url(home_url()); ?>">
    	<img src="<?php echo esc_url($pp_logo); ?>" alt="<?php echo esc_attr($image_alt); ?>"/>
    </a>
<?php
    }
?>
<!-- End logo -->

<?php 	
    if ( has_nav_menu( 'left-menu' ) ) 
    {
        //Get page nav
        wp_nav_menu( 
            	array(
            		'container_class' 	=> 'main_menu_container',
            		'menu_id'			=> 'main_menu_left',
            		'menu_class'		=> 'nav',
            		'theme_location' 	=> 'left-menu',
            		'walker' => new Arrow_Walker_Nav_Menu,
            	) 
        ); 
    }
    else
    {
     		echo '<div class="notice">Please setup "Main Menu Left Side"</div>';
    }
?>

<?php 	
    if ( has_nav_menu( 'right-menu' ) ) 
    {
        //Get page nav
        wp_nav_menu( 
            	array( 
            		'container_class' 	=> 'main_menu_container',
            		'menu_id'			=> 'main_menu_right',
            		'menu_class'		=> 'nav',
            		'theme_location' 	=> 'right-menu',
            		'walker' => new Arrow_Walker_Nav_Menu,
            	) 
        ); 
    }
    else
    {
     		echo '<div class="notice">Please setup "Main Menu Right Side"</div>';
    }
?>
<?php
if (class_exists('Woocommerce')) {
    //Check if display cart in header

    global $woocommerce;
    $cart_url = $woocommerce->cart->get_cart_url();
    $cart_count = $woocommerce->cart->cart_contents_count;
?>
<div class="header_cart_wrapper">
    <div class="cart_count"><?php echo esc_html($cart_count); ?></div>
    <a href="<?php echo esc_url($cart_url); ?>"><i class="fa fa-shopping-cart"></i></a>
</div>
<?php
}
?>
<div class="main_menu_container">
	<form role="search" method="get" name="searchform" id="searchform" action="<?php echo home_url(); ?>/">
	    <div>
	    	<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" autocomplete="off" placeholder="<?php _e( 'Type to search and hit enter...', THEMEDOMAIN ); ?>"/>
	    	<button>
	        	<i class="fa fa-search"></i>
	        </button>
	    </div>
	    <div id="autocomplete"></div>
	</form>
</div>
<?php
	break;
?>

<?php
	} //End case
?>