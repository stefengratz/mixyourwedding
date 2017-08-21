<?php
	$current_ggfont = get_option(SHORTNAME."_ggfont");
	
	if(!isset($current_ggfont['Montserrat']))
	{
	    $current_ggfont['Montserrat'] = 'Montserrat';
	}
		
	if(!empty($current_ggfont))
	{
		update_option( SHORTNAME."_ggfont", $current_ggfont );
	}
	else
	{
		add_option( SHORTNAME."_ggfont", $current_ggfont );
	}
?>