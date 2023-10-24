<?php
/**
 * Metabox For General.
 *
 * @package Geekfolio 
 */
?>
<?php 
global $mode;
If ($mode==true):
	geekfolio_meta_box_dropdown('geekfolio_theme_mode', 
		esc_html__('Webpage Dark/Light Mode', 'geekfolio_plg'),
		array('default' => esc_html__( 'Use Global Settings (in Theme Options)', 'geekfolio_plg' ),
			  'light_mode' => esc_html__( 'Light', 'geekfolio_plg' ),
			  'auto_mode' => esc_html__( 'Auto','geekfolio_plg'),
			  'dark_mode' => esc_html__( 'Dark', 'geekfolio_plg' )
		)
	);
	geekfolio_meta_box_dropdown('geekfolio_mode_switcher', 
		esc_html__('Color mode switcher', 'geekfolio_plg'),
		array('default' => esc_html__( 'Use Global Settings (in Theme Options)', 'geekfolio_plg' ),
			  'on' => esc_html__( 'On', 'geekfolio_plg' ),
			  'off' => esc_html__( 'Off','geekfolio_plg'),
			  
		)
	);
endif;

geekfolio_meta_box_dropdown('geekfolio_sidebar_format', 
	esc_html__('Sidebar Format', 'geekfolio_plg'),
	array('default' => esc_html__( 'Use Global Settings (in Theme Options)', 'geekfolio_plg' ),
		  'right_sidebar' => esc_html__( 'Right Sidebar', 'geekfolio_plg' ),
		  'left_sidebar' => esc_html__( 'Left Sidebar','geekfolio_plg'),
		  'no_sidebar' => esc_html__( 'No Sidebar', 'geekfolio_plg' )
	)
);


geekfolio_meta_box_colorpicker( 'geekfolio_color_general',
	esc_html__( 'General scheme color ', 'geekfolio_plg' )
); 

geekfolio_meta_box_colorpicker( 'geekfolio_custom_hovers',
	esc_html__( 'Custom hovers', 'geekfolio_plg' )
);

geekfolio_meta_box_colorpicker( 'geekfolio_color_scheme',
	esc_html__( 'Color scheme', 'geekfolio_plg' )
);
geekfolio_meta_box_colorpicker( 'general_color',
	esc_html__( 'General color', 'geekfolio_plg' )
);

