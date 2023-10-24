<?php
   //custom Sidebar
   if ( class_exists('ReduxFrameworkPlugin')) { 
	$style = geekfolio_option( 'geekfolio_sidebar_layout' );
	get_template_part('templates/sidebar/sidebar', $style);
} else {
	//Fall back if no redux options install
	get_template_part('templates/sidebar/sidebar','1'); 
}
