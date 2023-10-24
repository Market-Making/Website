<?php
/*
Template Name: Blank Page Builder
Template Post Type: page, portfolio 
Description:One Page Builder with container.
*/
get_header(); 
		
	//custom header
	if ( class_exists('ReduxFrameworkPlugin') ) { 
		do_action('geekfolio-custom-header','geekfolio_header_start') ;        
	} else { ?>
		<!--Fall back if no reduxoptions instalgeekfolio-->
		<!--HOME START-->
		<div class="default-header clearfix">
			<!--HEADER START-->
			<?php get_template_part( 'inc/menu','normal'); ?>
			<!--HEADER END-->
		</div><!--/home end-->
		<!--HOME END-->
	<?php }

	//custom side panel
	echo'<div class="side-panel">';
	echo'<div class="close-black-block-offcanvas"><a href="#"><i class="fa fa-times"></i></a></div>';

	if ( class_exists('ReduxFrameworkPlugin') ) { 
		do_action('geekfolio-custom-sidepanel','geekfolio_sidepanel_start');
	}
	echo'</div>';
	
	//page content
	echo'<div class="blank-builder">';
	while (have_posts()) : the_post();
		the_content();
	endwhile;
	echo'</div>';

	//custom footer
	if ( class_exists('ReduxFrameworkPlugin') ) { 
		do_action('geekfolio-custom-footer','geekfolio_footer_start');
	} else {
		//Fall back if no reduxoptions instalgeekfolio
		get_template_part( 'inc/bottom','footer'); 
	}
		
get_footer(); ?>