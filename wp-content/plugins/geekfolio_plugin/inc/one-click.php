<?php

//oneclick importer
function ocdi_import_files() {
	return array(
		array(
			'import_file_name'           => 'Main',
			'categories'                  => array( 'Elementor' ),
			'import_file_url'            => plugins_url( '/demo-data/elementor/main/content.xml' , __FILE__ ),
			'import_widget_file_url'     => plugins_url( '/demo-data/elementor/main/widgets.wie' , __FILE__ ),
			'import_customizer_file_url'  => plugins_url( '/demo-data/elementor/main/customizer.dat' , __FILE__ ),
			'import_redux'           => array(
				array(
					'file_url'   => plugins_url( '/demo-data/elementor/main/redux.json' , __FILE__ ),
					'option_name' => 'geekfolio_theme_setting',
				),
			),
			'import_preview_image_url'   => plugins_url( '/demo-data/elementor/main/preview.jpg' , __FILE__ ),
			'import_notice'                => __( '<p>To prevent any error, please use the clean wordpress site to import the demo data. </p><p>Or you can use this plugin 
			<a href="https://wordpress.org/plugins/wordpress-database-reset/" target="_blank">WordPress Database Reset</a> to reset/clear the database first.</p><p>After you import this demo, you will have to setup the elementor page builder .</p>', 'geekfolio_plg' ),
			'preview_url'                => 'https://wpgeekfolio.themescamp.com/',
		),

		array(
			'import_file_name'           => 'Corporate',
			'categories'                  => array( 'Elementor' ),
			'import_file_url'            => plugins_url( '/demo-data/elementor/corporate/content.xml' , __FILE__ ),
			'import_widget_file_url'     => plugins_url( '/demo-data/elementor/corporate/widgets.wie' , __FILE__ ),
			'import_customizer_file_url'  => plugins_url( '/demo-data/elementor/corporate/customizer.dat' , __FILE__ ),
			'import_redux'           => array(
				array(
					'file_url'   => plugins_url( '/demo-data/elementor/corporate/redux.json' , __FILE__ ),
					'option_name' => 'geekfolio_theme_setting',
				),
			),
			'import_preview_image_url'   => plugins_url( '/demo-data/elementor/corporate/preview.jpg' , __FILE__ ),
			'import_notice'                => __( '<p>To prevent any error, please use the clean wordpress site to import the demo data. </p><p>Or you can use this plugin 
			<a href="https://wordpress.org/plugins/wordpress-database-reset/" target="_blank">WordPress Database Reset</a> to reset/clear the database first.</p><p>After you import this demo, you will have to setup the elementor page builder .</p>', 'geekfolio_plg' ),
			'preview_url'                => 'https://wpgeekfolio.themescamp.com/corporate',
		),

		array(
			'import_file_name'           => 'One Page',
			'categories'                  => array( 'Elementor' ),
			'import_file_url'            => plugins_url( '/demo-data/elementor/one-page/content.xml' , __FILE__ ),
			'import_widget_file_url'     => plugins_url( '/demo-data/elementor/one-page/widgets.wie' , __FILE__ ),
			'import_customizer_file_url'  => plugins_url( '/demo-data/elementor/one-page/customizer.dat' , __FILE__ ),
			'import_redux'           => array(
				array(
					'file_url'   => plugins_url( '/demo-data/elementor/one-page/redux.json' , __FILE__ ),
					'option_name' => 'geekfolio_theme_setting',
				),
			),
			'import_preview_image_url'   => plugins_url( '/demo-data/elementor/one-page/preview.jpg' , __FILE__ ),
			'import_notice'                => __( '<p>To prevent any error, please use the clean wordpress site to import the demo data. </p><p>Or you can use this plugin 
			<a href="https://wordpress.org/plugins/wordpress-database-reset/" target="_blank">WordPress Database Reset</a> to reset/clear the database first.</p><p>After you import this demo, you will have to setup the elementor page builder .</p>', 'geekfolio_plg' ),
			'preview_url'                => 'https://wpgeekfolio.themescamp.com/one-page',
		),
		array(
			'import_file_name'           => 'Digital Agency',
			'categories'                  => array( 'Elementor' ),
			'import_file_url'            => plugins_url( '/demo-data/elementor/digital-agency/content.xml' , __FILE__ ),
			'import_widget_file_url'     => plugins_url( '/demo-data/elementor/digital-agency/widgets.wie' , __FILE__ ),
			'import_customizer_file_url'  => plugins_url( '/demo-data/elementor/digital-agency/customizer.dat' , __FILE__ ),
			'import_redux'           => array(
				array(
					'file_url'   => plugins_url( '/demo-data/elementor/digital-agency/redux.json' , __FILE__ ),
					'option_name' => 'geekfolio_theme_setting',
				),
			),
			'import_preview_image_url'   => plugins_url( '/demo-data/elementor/digital-agency/preview.jpg' , __FILE__ ),
			'import_notice'                => __( '<p>To prevent any error, please use the clean wordpress site to import the demo data. </p><p>Or you can use this plugin 
			<a href="https://wordpress.org/plugins/wordpress-database-reset/" target="_blank">WordPress Database Reset</a> to reset/clear the database first.</p><p>After you import this demo, you will have to setup the elementor page builder .</p>', 'geekfolio_plg' ),
			'preview_url'                => 'https://wpgeekfolio.themescamp.com/digital-agency',
		),
		array(
			'import_file_name'           => 'Freelancer',
			'categories'                  => array( 'Elementor' ),
			'import_file_url'            => plugins_url( '/demo-data/elementor/freelancer/content.xml' , __FILE__ ),
			'import_widget_file_url'     => plugins_url( '/demo-data/elementor/freelancer/widgets.wie' , __FILE__ ),
			'import_customizer_file_url'  => plugins_url( '/demo-data/elementor/freelancer/customizer.dat' , __FILE__ ),
			'import_redux'           => array(
				array(
					'file_url'   => plugins_url( '/demo-data/elementor/freelancer/redux.json' , __FILE__ ),
					'option_name' => 'geekfolio_theme_setting',
				),
			),
			'import_preview_image_url'   => plugins_url( '/demo-data/elementor/freelancer/preview.jpg' , __FILE__ ),
			'import_notice'                => __( '<p>To prevent any error, please use the clean wordpress site to import the demo data. </p><p>Or you can use this plugin 
			<a href="https://wordpress.org/plugins/wordpress-database-reset/" target="_blank">WordPress Database Reset</a> to reset/clear the database first.</p><p>After you import this demo, you will have to setup the elementor page builder .</p>', 'geekfolio_plg' ),
			'preview_url'                => 'https://wpgeekfolio.themescamp.com/freelance',
		),
		array(
			'import_file_name'           => 'Marketing',
			'categories'                  => array( 'Elementor' ),
			'import_file_url'            => plugins_url( '/demo-data/elementor/marketing/content.xml' , __FILE__ ),
			'import_widget_file_url'     => plugins_url( '/demo-data/elementor/marketing/widgets.wie' , __FILE__ ),
			'import_customizer_file_url'  => plugins_url( '/demo-data/elementor/marketing/customizer.dat' , __FILE__ ),
			'import_redux'           => array(
				array(
					'file_url'   => plugins_url( '/demo-data/elementor/marketing/redux.json' , __FILE__ ),
					'option_name' => 'geekfolio_theme_setting',
				),
			),
			'import_preview_image_url'   => plugins_url( '/demo-data/elementor/marketing/preview.jpg' , __FILE__ ),
			'import_notice'                => __( '<p>To prevent any error, please use the clean wordpress site to import the demo data. </p><p>Or you can use this plugin 
			<a href="https://wordpress.org/plugins/wordpress-database-reset/" target="_blank">WordPress Database Reset</a> to reset/clear the database first.</p><p>After you import this demo, you will have to setup the elementor page builder .</p>', 'geekfolio_plg' ),
			'preview_url'                => 'https://wpgeekfolio.themescamp.com/marketing',
		),
		array(
			'import_file_name'           => 'Creative Agency',
			'categories'                  => array( 'Elementor' ),
			'import_file_url'            => plugins_url( '/demo-data/elementor/creative-agency/content.xml' , __FILE__ ),
			'import_widget_file_url'     => plugins_url( '/demo-data/elementor/creative-agency/widgets.wie' , __FILE__ ),
			'import_customizer_file_url'  => plugins_url( '/demo-data/elementor/creative-agency/customizer.dat' , __FILE__ ),
			'import_redux'           => array(
				array(
					'file_url'   => plugins_url( '/demo-data/elementor/creative-agency/redux.json' , __FILE__ ),
					'option_name' => 'geekfolio_theme_setting',
				),
			),
			'import_preview_image_url'   => plugins_url( '/demo-data/elementor/creative-agency/preview.jpg' , __FILE__ ),
			'import_notice'                => __( '<p>To prevent any error, please use the clean wordpress site to import the demo data. </p><p>Or you can use this plugin 
			<a href="https://wordpress.org/plugins/wordpress-database-reset/" target="_blank">WordPress Database Reset</a> to reset/clear the database first.</p><p>After you import this demo, you will have to setup the elementor page builder .</p>', 'geekfolio_plg' ),
			'preview_url'                => 'https://wpgeekfolio.themescamp.com/creative-agency',
		),
		array(
			'import_file_name'           => 'Startup',
			'categories'                  => array( 'Elementor' ),
			'import_file_url'            => plugins_url( '/demo-data/elementor/startup/content.xml' , __FILE__ ),
			'import_widget_file_url'     => plugins_url( '/demo-data/elementor/startup/widgets.wie' , __FILE__ ),
			'import_customizer_file_url'  => plugins_url( '/demo-data/elementor/startup/customizer.dat' , __FILE__ ),
			'import_redux'           => array(
				array(
					'file_url'   => plugins_url( '/demo-data/elementor/startup/redux.json' , __FILE__ ),
					'option_name' => 'geekfolio_theme_setting',
				),
			),
			'import_preview_image_url'   => plugins_url( '/demo-data/elementor/startup/preview.jpg' , __FILE__ ),
			'import_notice'                => __( '<p>To prevent any error, please use the clean wordpress site to import the demo data. </p><p>Or you can use this plugin 
			<a href="https://wordpress.org/plugins/wordpress-database-reset/" target="_blank">WordPress Database Reset</a> to reset/clear the database first.</p><p>After you import this demo, you will have to setup the elementor page builder .</p>', 'geekfolio_plg' ),
			'preview_url'                => 'https://wpgeekfolio.themescamp.com/startup',
		),
		array(
			'import_file_name'           => 'Architecture',
			'categories'                  => array( 'Elementor' ),
			'import_file_url'            => plugins_url( '/demo-data/elementor/architecture/content.xml' , __FILE__ ),
			'import_widget_file_url'     => plugins_url( '/demo-data/elementor/architecture/widgets.wie' , __FILE__ ),
			'import_customizer_file_url'  => plugins_url( '/demo-data/elementor/architecture/customizer.dat' , __FILE__ ),
			'import_redux'           => array(
				array(
					'file_url'   => plugins_url( '/demo-data/elementor/architecture/redux.json' , __FILE__ ),
					'option_name' => 'geekfolio_theme_setting',
				),
			),
			'import_preview_image_url'   => plugins_url( '/demo-data/elementor/architecture/preview.jpg' , __FILE__ ),
			'import_notice'                => __( '<p>To prevent any error, please use the clean wordpress site to import the demo data. </p><p>Or you can use this plugin 
			<a href="https://wordpress.org/plugins/wordpress-database-reset/" target="_blank">WordPress Database Reset</a> to reset/clear the database first.</p><p>After you import this demo, you will have to setup the elementor page builder .</p>', 'geekfolio_plg' ),
			'preview_url'                => 'https://wpgeekfolio.themescamp.com/architecture',
		),
		array(
			'import_file_name'           => 'Showcases',
			'categories'                  => array( 'Elementor' ),
			'import_file_url'            => plugins_url( '/demo-data/elementor/showcases/content.xml' , __FILE__ ),
			'import_widget_file_url'     => plugins_url( '/demo-data/elementor/showcases/widgets.wie' , __FILE__ ),
			'import_customizer_file_url'  => plugins_url( '/demo-data/elementor/showcases/customizer.dat' , __FILE__ ),
			'import_redux'           => array(
				array(
					'file_url'   => plugins_url( '/demo-data/elementor/showcases/redux.json' , __FILE__ ),
					'option_name' => 'geekfolio_theme_setting',
				),
			),
			'import_preview_image_url'   => plugins_url( '/demo-data/elementor/showcases/preview.jpg' , __FILE__ ),
			'import_notice'                => __( '<p>To prevent any error, please use the clean wordpress site to import the demo data. </p><p>Or you can use this plugin 
			<a href="https://wordpress.org/plugins/wordpress-database-reset/" target="_blank">WordPress Database Reset</a> to reset/clear the database first.</p><p>After you import this demo, you will have to setup the elementor page builder .</p>', 'geekfolio_plg' ),
			'preview_url'                => 'https://wpgeekfolio.themescamp.com/showcases/',
		),
		array(
			'import_file_name'           => 'Portfolios',
			'categories'                  => array( 'Elementor' ),
			'import_file_url'            => plugins_url( '/demo-data/elementor/portfolios/content.xml' , __FILE__ ),
			'import_widget_file_url'     => plugins_url( '/demo-data/elementor/portfolios/widgets.wie' , __FILE__ ),
			'import_customizer_file_url'  => plugins_url( '/demo-data/elementor/portfolios/customizer.dat' , __FILE__ ),
			'import_redux'           => array(
				array(
					'file_url'   => plugins_url( '/demo-data/elementor/portfolios/redux.json' , __FILE__ ),
					'option_name' => 'geekfolio_theme_setting',
				),
			),
			'import_preview_image_url'   => plugins_url( '/demo-data/elementor/portfolios/preview.jpg' , __FILE__ ),
			'import_notice'                => __( '<p>To prevent any error, please use the clean wordpress site to import the demo data. </p><p>Or you can use this plugin 
			<a href="https://wordpress.org/plugins/wordpress-database-reset/" target="_blank">WordPress Database Reset</a> to reset/clear the database first.</p><p>After you import this demo, you will have to setup the elementor page builder .</p>', 'geekfolio_plg' ),
			'preview_url'                => 'https://wpgeekfolio.themescamp.com/portfolios',
		),
		array(
			'import_file_name'           => 'RTL',
			'categories'                  => array( 'Elementor' ),
			'import_file_url'            => plugins_url( '/demo-data/elementor/rtl/content.xml' , __FILE__ ),
			'import_widget_file_url'     => plugins_url( '/demo-data/elementor/rtl/widgets.wie' , __FILE__ ),
			'import_customizer_file_url'  => plugins_url( '/demo-data/elementor/rtl/customizer.dat' , __FILE__ ),
			'import_redux'           => array(
				array(
					'file_url'   => plugins_url( '/demo-data/elementor/rtl/redux.json' , __FILE__ ),
					'option_name' => 'geekfolio_theme_setting',
				),
			),
			'import_preview_image_url'   => plugins_url( '/demo-data/elementor/rtl/preview.jpg' , __FILE__ ),
			'import_notice'                => __( '<p>To prevent any error, please use the clean wordpress site to import the demo data. </p><p>Or you can use this plugin 
			<a href="https://wordpress.org/plugins/wordpress-database-reset/" target="_blank">WordPress Database Reset</a> to reset/clear the database first.</p><p>After you import this demo, you will have to setup the elementor page builder .</p>', 'geekfolio_plg' ),
			'preview_url'                => 'https://wpgeekfolio.themescamp.com/rtl',
		),
		array(
			'import_file_name'           => 'Shop',
			'categories'                  => array( 'Elementor' ),
			'import_file_url'            => plugins_url( '/demo-data/elementor/shop/content.xml' , __FILE__ ),
			'import_widget_file_url'     => plugins_url( '/demo-data/elementor/shop/widgets.wie' , __FILE__ ),
			'import_customizer_file_url'  => plugins_url( '/demo-data/elementor/shop/customizer.dat' , __FILE__ ),
			'import_redux'           => array(
				array(
					'file_url'   => plugins_url( '/demo-data/elementor/shop/redux.json' , __FILE__ ),
					'option_name' => 'geekfolio_theme_setting',
				),
			),
			'import_preview_image_url'   => plugins_url( '/demo-data/elementor/shop/preview.jpg' , __FILE__ ),
			'import_notice'                => __( '<p>To prevent any error, please use the clean wordpress site to import the demo data. </p><p>Or you can use this plugin 
			<a href="https://wordpress.org/plugins/wordpress-database-reset/" target="_blank">WordPress Database Reset</a> to reset/clear the database first.</p><p>After you import this demo, you will have to setup the elementor page builder .</p>', 'geekfolio_plg' ),
			'preview_url'                => 'https://wpgeekfolio.themescamp.com/shop',
		)

	);
}
add_filter( 'pt-ocdi/import_files', 'ocdi_import_files' );

/*-----------automatically assign "Front page", "Posts page" and menu locations ---------------------------*/



function ocdi_after_import( $selected_import ) {

	// Assign menus to their locations.
	$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'primary_menu' => $main_menu->term_id, // replace 'main-menu' here with the menu location identifier from register_nav_menu() function
		)
	);

	if ( 'App Landing' === $selected_import['import_file_name'] ) {
		// Assign front page.
		$front_page_id = get_page_by_title( 'Home App');
	}
	elseif ( 'Marketing Startup' === $selected_import['import_file_name'] ) {
		// Assign front page.
		$front_page_id = get_page_by_title( 'Home Marketing' );
	}
	elseif ( 'Saas Technology' === $selected_import['import_file_name'] ) {
		// Assign front page.
		$front_page_id = get_page_by_title( 'Home' );
	}
	elseif ( 'IT Solution (Elementor)' === $selected_import['import_file_name'] ) {
		// Assign front page.
		$front_page_id = get_page_by_title( 'Home' );
	}
	elseif ( 'Marketing (Elementor)' === $selected_import['import_file_name'] ) {
		// Assign front page.
		$front_page_id = get_page_by_title( 'Home' );
	}
	elseif ( 'Software (Elementor)' === $selected_import['import_file_name'] ) {
		// Assign front page.
		$front_page_id = get_page_by_title( 'Home Saas' );
	}
	elseif ( 'Digital Ageny' === $selected_import['import_file_name'] ) {
		// Assign front page.
		$front_page_id = get_page_by_title( 'Home Agency' );
	}
	elseif ( 'Software Company' === $selected_import['import_file_name'] ) {
		// Assign front page.
		$front_page_id = get_page_by_title( 'Home Software' );
	}
	elseif ( 'IT Solutions' === $selected_import['import_file_name'] ) {
		// Assign front page.
		$front_page_id = get_page_by_title( 'Home IT' );
	}
	elseif ( 'Creative IT Solution' === $selected_import['import_file_name'] ) {
		// Assign front page.
		$front_page_id = get_page_by_title( 'Creative Home' );
	}
	elseif ( 'Data Analysis' === $selected_import['import_file_name'] ) {
		// Assign front page.
		$front_page_id = get_page_by_title( 'Data Analysis Home' );
	}
	elseif ( 'Cloud hosting' === $selected_import['import_file_name'] ) {
		// Assign front page.
		$front_page_id = get_page_by_title( 'Cloud Hosting Home' );
	}
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'elementor_disable_color_schemes', 'yes' ); 
	update_option( 'elementor_disable_typography_schemes', 'yes' ); 
	update_option( 'elementor_load_fa4_shim', 'yes' ); 
	update_option( 'elementor_container_width', 1200 );
	$cpt_support = [ 'page', 'post','product','portfolio','footer','header','sidepanel' ];
	update_option( 'elementor_cpt_support', $cpt_support ); //update 'Costom post type'
}
add_action( 'pt-ocdi/after_import', 'ocdi_after_import' );

/*------------------disable the ProteusThemes branding notice -----------------------------------*/

add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

/*------------------Adding notes -----------------------------------*/

function ocdi_plugin_intro_text( $default_text ) {
	$default_text .= '<div class="ocdi__intro-text"><strong>Server requirements:</strong></div>';
	$default_text .= '<div class="ocdi__intro-text"><ul>
		<li>max_execution_time 3000</li>
		<li>memory_limit 128M</li>
		<li>post_max_size 64M</li>
		<li>upload_max_filesize 64M</li>
		<li>max_input_time 180</li>
	</ul></div><hr>';

	return $default_text;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'ocdi_plugin_intro_text' );
