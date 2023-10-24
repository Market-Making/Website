<?php 
//preloader custom setting
function geekfolio_preloader_set() {
	if  ( class_exists('ReduxFrameworkPlugin')){
		$color =  geekfolio_option( 'geekfolio_loader_color' );
		$loader_bg = "
		.load-circle{border-top-color: $color;}
		";   
		if ( class_exists('ReduxFrameworkPlugin') && geekfolio_option( 'geekfolio_loader_color' )) {           
			wp_add_inline_style( 'geekfolio-style', $loader_bg );
		}
	}
} 

function geekfolio_preloader() {
	if  ( class_exists('ReduxFrameworkPlugin')){
		$preload = geekfolio_option( 'geekfolio_preloader_set' );
		if ( class_exists('ReduxFrameworkPlugin') ) : if ($preload == 'show_home') :
			wp_enqueue_script( 'preloader', get_template_directory_uri() . '/assets/js/loader.js',array(),'', 'in_footer');
		endif ;  endif;
		
		if ( class_exists('ReduxFrameworkPlugin') ) : if ($preload == 'show_all') :
			wp_enqueue_script( 'preloader', get_template_directory_uri() . '/assets/js/loader.js',array(),'', 'in_footer');
		endif ;  endif;
	}
}    