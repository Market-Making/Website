<?php 

//function custom header by global settings 
function geekfolio_custom_header_global () {

	global $post ;  
	global $geekfolio_theme_settings;  
	$header_id =  geekfolio_option( 'geekfolio_header_set_list' );  

	$geekfolio_header = new WP_Query(array(
		'posts_per_page' => -1,
		'post_type' =>  'header',
		'p' => $header_id, 
	)); 
	
	if ($geekfolio_header->have_posts()) : 
		while  ($geekfolio_header->have_posts()) : $geekfolio_header->the_post();$header_id; ?>
			<nav class="geekfolio-custom-header clearfix 1 <?php if (class_exists('ReduxFrameworkPlugin') && (geekfolio_option( 'geekfolio_header_position' ) =='head_white')){ 
					echo 'white-header';
				} else { 
					echo 'custom-absolute-menu';
				} ?> ">
				<?php the_content(); ?>
			</nav>
	
		<?php endwhile; 
	endif; 
	wp_reset_postdata();
}

//function custom header by page settings  
function geekfolio_custom_header_page () {
	global $post ;
	$header_id =  get_post_meta( $post->ID, 'geekfolio_header_list', true ); 
	$geekfolio_header = new WP_Query( array(
		'posts_per_page' => 1,
		'post_type' =>  'header',
		'p' => $header_id,
	) ); 
	
	if ($geekfolio_header->have_posts()) : 
		while  ($geekfolio_header->have_posts()) : $geekfolio_header->the_post();?>
			<nav class="geekfolio-custom-header clearfix 2  <?php if (class_exists('ReduxFrameworkPlugin') && (geekfolio_option( 'geekfolio_header_position' ) =='head_white')){ 
				echo 'white-header';
			} else { 
				echo 'custom-absolute-menu';
			} ?>">
				<?php the_content(); ?>
			</nav>
		<?php endwhile; 
	endif; 
	wp_reset_postdata();
}

//function for output custom header
function geekfolio_header_start () {
	if ( is_singular()) { //if single page/post
		global $post;
		global $geekfolio_theme_settings; 
		if (get_post_meta($post->ID, 'geekfolio_header_format', true) =='custom_header' && get_post_meta($post->ID, 'geekfolio_header_list', true)) {
			//if page setting choose header custom
			do_action('geekfolio-header-page','geekfolio_custom_header_page') ;  
		} 
			 
		//if page setting choose header global
		else if (get_post_meta($post->ID, 'geekfolio_header_format', true) =='default'){ 
			//if custom header & list are selected in theme options
			if (geekfolio_option( 'geekfolio_header_set' ) =='custom' && geekfolio_option( 'geekfolio_header_set_list' ) !='' ) {
				do_action('geekfolio-header-global','geekfolio_custom_header_global') ; 
			} else {
				get_template_part( 'inc/menu','normal');
			} 
		}
			 
	//if page setting choose no header 
	else if (get_post_meta($post->ID, 'geekfolio_header_format', true) =='no_header'){
		//display nothing       
	}
			 
	//if page setting choose header standard 
	else { ?>
		<?php get_template_part( 'inc/menu');
	}
			
	} else { //if not single page/post 

		//if custom header & list are selected in theme options
		if (geekfolio_option( 'geekfolio_header_set' ) =='custom' && geekfolio_option( 'geekfolio_header_set_list' ) !='' ) {
			do_action('geekfolio-header-global','geekfolio_custom_header_global') ;  

		} else { 
			//if not use normal menu
			get_template_part( 'inc/menu','normal');
		}
	}
}

//function custom header by page settings  
function geekfolio_custom_menu_page ($menu) {
	global $post ;
	$geekfolio_header_menu =  geekfolio_option( $menu );
	if (!empty($geekfolio_header_menu)):
		wp_nav_menu( array(
			'menu'            => $geekfolio_header_menu,
			'items_wrap' => '<ul id="%1$s" class="home-nav nn navigation %2$s">%3$s</ul>',
			'menu_id'         => '',
			'echo'            => true,
		) );
	elseif(has_nav_menu('primary_menu')):
		$menu = '';
		wp_nav_menu( array(
			'menu_id'         => '',
			'items_wrap' => '<ul id="%1$s" class="home-nav mm navigation %2$s">%3$s</ul>',
			'theme_location' => 'primary_menu',
			  
		) );
	endif;
}

//function custom header by page settings
function geekfolio_custom_flat_menu_page ($flatmenu) {
	global $post ;
	$geekfolio_header_flat_menu = geekfolio_option( $flatmenu );
	if ( !empty($geekfolio_header_flat_menu) ):
		$menuParameters_flat = array(
			'menu' => $geekfolio_header_flat_menu,
			'container'       => true,
			'items_wrap'      => '<ul id="%1$s" class="mob-nav  %2$s">%3$s</ul>',
			'depth'           => 0,
		);
	else:
		$menuParameters_flat = array(
			'theme_location' => 'primary_menu',
			'container'       => false,
			'items_wrap'      => '<ul id="%1$s" class="mob-nav  %2$s">%3$s</ul>',
			'depth'           => 0,
		);
	endif;
	echo strip_tags(wp_nav_menu( $menuParameters_flat ), '<a>' );
}



