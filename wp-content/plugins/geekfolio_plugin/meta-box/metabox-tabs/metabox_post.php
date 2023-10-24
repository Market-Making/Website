<?php
/**
 * Metabox For Single Post.
 *
 * @package Geekfolio  
 */
?>
<?php 
geekfolio_meta_box_dropdown('geekfolio_single_type_layout',
	esc_html__('Post Image', 'geekfolio_plg'),
	array('default' => esc_html__('Global Settings (in Theme Options)', 'geekfolio_plg'),
		'1' => esc_html__( 'Elegant', 'geekfolio_plg' ),
		'2' => esc_html__( 'Classic', 'geekfolio_plg' ),
		'3' => esc_html__( 'Overlay Image', 'geekfolio_plg' ),
	)
);

geekfolio_meta_box_dropdown('geekfolio_sidebar_layout',
	esc_html__('Post Sidebar Layout', 'geekfolio_plg'),
	array('default' => esc_html__('Global Settings (in Theme Options)', 'geekfolio_plg'),
		'1' => esc_html__( 'Clean Style', 'geekfolio_plg' ),
		'2' => esc_html__( 'Boundary Style', 'geekfolio_plg' ),
		'3' => esc_html__( 'Elegant Style', 'geekfolio_plg' ),
	)
);

geekfolio_meta_box_dropdown('geekfolio_single_sidebar_layout',
	esc_html__('Post Sidebar Layout', 'geekfolio_plg'),
	array('default' => esc_html__('Global Settings (in Theme Options)', 'geekfolio_plg'),
		'left' => esc_html__( 'Left', 'geekfolio_plg' ),
		'none' => esc_html__( 'None', 'geekfolio_plg' ),
		'right' => esc_html__( 'Right', 'geekfolio_plg' ),
	)
);





