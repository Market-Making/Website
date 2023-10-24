<?php
// Registers the new post type 

function geekfolio_footer_post_type() {
	register_post_type( 'footer',
		array(
			'labels' => array(
				'name' => __( 'Custom Footer', 'geekfolio_plg' ),
				'singular_name' => __( 'Custom Footer' , 'geekfolio_plg'),
				'add_new' => __( 'Add New Custom Footer', 'geekfolio_plg' ),
				'add_new_item' => __( 'Add New Custom Footer', 'geekfolio_plg' ),
				'edit_item' => __( 'Edit Custom Footer', 'geekfolio_plg' ),
				'new_item' => __( 'Add New Custom Footer', 'geekfolio_plg' ),
				'view_item' => __( 'View Custom Footer', 'geekfolio_plg' ),
				'search_items' => __( 'Search Custom Footer', 'geekfolio_plg' ),
				'not_found' => __( 'No Custom Footer found', 'geekfolio_plg' ),
				'not_found_in_trash' => __( 'No Custom Footer found in trash', 'geekfolio_plg' )
			),
			'public' => true,
			'supports' => array( 'title'),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "footer"), // Permalinks format
			'menu_position' => 5,
			'menu_icon'           => 'dashicons-art',
			'exclude_from_search' => true 
		)
	);

}

add_action( 'init', 'geekfolio_footer_post_type' );


add_action( 'admin_init', 'geekfolio_footer_mb' );
function geekfolio_footer_mb() {
  
  /**
   * Create a custom meta boxes array that we pass to 
   * the reduxoptions Meta Box API Class.
   */
  $geekfolio_footer_mb = array(
    'id'          => 'footer_meta_box',
    'title'       => esc_html__( 'Notes:', 'geekfolio_plg' ),
    'desc'        => '',
    'pages'       => array( 'footer' ),
    'context'     => 'normal',
    'priority'    => 'high',
	'fields'      => array(
	  array(
        'id'          => 'footer_setting_block',
        'label'       => '',
        'desc'        => esc_html__('You can build your custom footer with elementor and use it in any page using the page settings.<br/>
		Make sure you have checklist the Custom Header in Elementor Settings-> Post Type', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'textblock-titgeekfolio',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  
    )
  );
  
  /**
   * Register our meta boxes using the 
   * ot_register_meta_box() function.
   */
  if ( function_exists( 'ot_register_meta_box' ) )
    ot_register_meta_box( $geekfolio_footer_mb );

}




