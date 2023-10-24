<?php
//Elementor Editor view

//display menu list
function geekfolio_navmenu_navbar_menu_choices() {
	$menus = wp_get_nav_menus();
	$items = array();
	$i     = 0;
	foreach ( $menus as $menu ) {
		if ( $i == 0 ) {
			$default = $menu->slug;
			$i ++;
		}
		$items[ $menu->slug ] = $menu->name;
	}

	return $items;
}

//display Side panel list
function geekfolio_side_panel_choices() {
   $geekfolio_custom_sidepanels = new WP_Query( array( 'post_type' => 'sidepanel' ) );
   $posts = $geekfolio_custom_sidepanels->posts; 
   $items = array();
   $i     = 0;
   foreach ( $posts as $sidepanel ) {
      if ( $i == 0 ) {
         $default = $sidepanel->slug;
         $i ++;
      }
      $items[ $sidepanel->slug ] = $sidepanel->post_name;
   }

   return $items;

}

//display category blog list
function geekfolio_category_choice() {
    $categories = get_categories( );
	$blogs = array();
	$i     = 0;
	foreach ( $categories as $category ) {
		if ( $i == 0 ) {
			$default = $category->name ;
			$i ++;
		}
		$blogs[ $category->term_id ] = $category->name;
	}
	return $blogs;
}

function geekfolio_portfolio_tag_choice()
{
	$tags = get_terms('porto_tag', array(
		'hide_empty' => true,
	));
	$blogs = array();
	$i     = 0;
	foreach ($tags as $tag) {
		if ($i == 0) {
			$default = $tag->name;
			$i++;
		}
		$blogs[$tag->term_id] = $tag->name;
	}
	return $blogs;
}


//display taxnonomy
function geekfolio_tax_choice() {
    $categories = get_terms('portfolio_category' );
	$blogs = array();
	$i     = 0;
	foreach ( $categories as $category ) {
		if ( $i == 0 ) {
			$default = $category->name ;
			$i ++;
		}
		$blogs[ $category->term_id ] = $category->name;
	}
	return $blogs;
}

//add new category elementor
add_action( 'elementor/init', function () {
	$elementsManager = Elementor\Plugin::instance()->elements_manager;
	$elementsManager->add_category(
		'geekfolio-elements',
		array(
			'title' => 'Geekfolio General Elements',
			'icon'  => 'font',
		),
		1
	);
} );

//add new category elementor
add_action( 'elementor/init', function () {
	$elementsManager = Elementor\Plugin::instance()->elements_manager;
	$elementsManager->add_category(
		'geekfolio-menu-elements',
		array(
			'title' => 'Geekfolio Custom Menu Elements',
			'icon'  => 'font',
		),
		2
	);
} );

//add new category elementor
add_action( 'elementor/init', function () {
	$elementsManager = Elementor\Plugin::instance()->elements_manager;
	$elementsManager->add_category(
		'geekfolio-portfolio-elements',
		array(
			'title' => 'Geekfolio Single Portfolio Elements',
			'icon'  => 'font',
		),
		3
	);
} );

//add new category elementor
add_action( 'elementor/init', function () {
	$elementsManager = Elementor\Plugin::instance()->elements_manager;
	$elementsManager->add_category(
		'geekfolio-blog-elements',
		array(
			'title' => 'Geekfolio Blog Post Elements',
			'icon'  => 'font',
		),
		4
	);
} );




add_action('elementor/element/before_section_end', function( $section, $section_id, $args ) {
	if( $section->get_name() == 'google_maps' && $section_id == 'section_map' ){
		// we are at the end of the "section_image" area of the "image-box"
		$section->add_control(
			'map_style' ,
			[
				'label'        => 'Map Style',
				'type'         => Elementor\Controls_Manager::SELECT,
				'default'      => 'default',
				'options'      => array( 'default' => 'Default', 'gray' => 'Grayscale Map' ),
				'prefix_class' => 'map-',
				'label_block'  => true,
			]
		);
	}
}, 10, 3 );


add_action( 'elementor/editor/after_register_scripts', function() {  wp_register_script('jquery-swiper',GEEKFOLIO_URL .'widgets/js/swiper.min.js', array('jquery'), null, true  );} ); 
add_action( 'elementor/editor/after_enqueue_styles', function() {  wp_enqueue_style('fa-style-addons',GEEKFOLIO_URL .'assets/fonts/fa/css/fontawesome.min.css', array(), null, 'all'  );} );
add_action( 'elementor/editor/after_enqueue_styles', function() {  wp_enqueue_style('flaticons-style-addons',GEEKFOLIO_URL .'assets/fonts/flaticon/flaticon.css', array(), null, 'all'  );} );
add_action( 'elementor/editor/after_enqueue_styles', function() {  wp_enqueue_style('peicon-style-addons',GEEKFOLIO_URL .'assets/fonts/peicon/pe-icon-7-stroke.css', array(), null, 'all'  );} );
add_action( 'elementor/editor/after_enqueue_styles', function() {  wp_enqueue_style('bootstrap-icons',GEEKFOLIO_URL .'assets/fonts/bootstrap-icons/bootstrap-icons.css', array(), null, 'all'  );} );


add_action( 'elementor/editor/after_register_scripts', function() {  wp_register_script('geekfolio-post-list',GEEKFOLIO_URL .'widgets/js/post-list.js', array('jquery'), null, true  );} ); 


