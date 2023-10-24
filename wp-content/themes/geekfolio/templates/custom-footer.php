
<?php 
//custom footer
if ( class_exists('ReduxFrameworkPlugin') ) { 
	do_action('geekfolio-custom-footer','geekfolio_footer_start');
} else {
	//Fall back if no reduxoptions instalgeekfolio
	get_template_part( 'inc/bottom','footer'); 
}

get_footer(); ?>