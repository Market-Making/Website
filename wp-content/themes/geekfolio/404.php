<?php
/*--Start 404 Error page--*/

get_template_part('templates/custom','header'); 
if (geekfolio_option( 'geekfolio_enable_custom_404' ) ==true && geekfolio_option( 'geekfolio_custom_404_page' ) !='' ) {

	global $post ;  
	global $geekfolio_theme_settings;  
	$page_404_id =  geekfolio_option( 'geekfolio_custom_404_page' );  

	$geekfolio_404_page = new WP_Query(array(
		'posts_per_page' => -1,
		'post_type' =>  'page',
		'p' => esc_html($page_404_id), 
	));  
	
	if ($geekfolio_404_page->have_posts()) : 
		while  ($geekfolio_404_page->have_posts()) : $geekfolio_404_page->the_post();$page_404_id; ?>
			<?php the_content(); ?>
		<?php endwhile; 
	endif; 
	wp_reset_postdata();

} else {
	get_template_part('templates/404');
} 
get_template_part('templates/custom','footer');