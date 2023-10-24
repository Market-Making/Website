<?php

get_header(); 

//custom header
if ( class_exists('ReduxFrameworkPlugin') ) { 
	do_action('geekfolio-custom-header','geekfolio_header_start') ;        
} else { 
	?>
	<!--Fall back if no reduxoptions instalgeekfolio-->
	<div class="default-header clearfix">
		<?php get_template_part( 'inc/menu','normal'); ?>
	</div><!--/home end-->
	<?php 
} ?>
