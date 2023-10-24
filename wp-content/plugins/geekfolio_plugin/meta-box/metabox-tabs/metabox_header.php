<?php
/**
 * Metabox For Header.
 *
 * @package Geekfolio
 */
?>
<?php 
geekfolio_meta_box_dropdown('geekfolio_header_format', 
	esc_html__('Header Position/Format', 'geekfolio_plg'),
	array('default' => esc_html__( 'Global Settings (in Theme Options)', 'geekfolio_plg' ),
		  'standard_header' => esc_html__( 'Standard Header', 'geekfolio_plg' ),
		  'custom_header' => esc_html__( 'Custom Header', 'geekfolio_plg' ),
		  'no_header' => esc_html__( 'No Header', 'geekfolio_plg' )
	)
);

geekfolio_meta_box_dropdown_custom_headers('geekfolio_header_list',
	esc_html__('Choose Custom Header', 'geekfolio_plg'),
	'',
	esc_html__('Only if (Header Position/Format= "Custom Header")', 'geekfolio_plg') 
);

geekfolio_meta_box_dropdown('geekfolio_header_position',
	esc_html__('Header Position/Format', 'geekfolio_plg'),
	array(
		'default' => esc_html__( 'Global Settings (in Theme Options)', 'geekfolio_plg' ),
		'head_white' => esc_html__( 'Relative Position with Background, ', 'geekfolio_plg' ),
		'head_trans' => esc_html__( 'Absolute Position, Transperant','geekfolio_plg'),
	)
);


geekfolio_meta_box_dropdown_menu('geekfolio_header_menu',
	esc_html__('Select Menu', 'geekfolio_plg'), 
	'',
	esc_html__('You can manage menu using Appearance > Menus', 'geekfolio_plg')
);
geekfolio_meta_box_dropdown('geekfolio_menu_position',
	esc_html__('Menu Alignment', 'geekfolio_plg'),
	array('default' => esc_html__('Global Settings (in Theme Options)', 'geekfolio_plg'),
		  'right' => esc_html__( 'Right', 'geekfolio_plg' ),
		  'center' => esc_html__( 'Center', 'geekfolio_plg' ),
	)
);

geekfolio_meta_box_dropdown('geekfolio_header_enable_social',
	esc_html__('Show Social', 'geekfolio_plg'),
	array('default' => esc_html__('Global Settings (in Theme Options)', 'geekfolio_plg'),
		  'on' => esc_html__( 'On', 'geekfolio_plg' ),
		  'off' => esc_html__( 'Off', 'geekfolio_plg' ),
	)
);

geekfolio_meta_box_dropdown('geekfolio_header_search',
	esc_html__('Show Search icon', 'geekfolio_plg'),
	array('default' => esc_html__('Global Settings (in Theme Options)', 'geekfolio_plg'),
		  'on' => esc_html__( 'On', 'geekfolio_plg' ),
		  'off' => esc_html__( 'Off', 'geekfolio_plg' ),
	)
);
geekfolio_meta_box_dropdown('geekfolio_header_cart',
	esc_html__('Show Cart', 'geekfolio_plg'),
	array('default' => esc_html__('Global Settings (in Theme Options)', 'geekfolio_plg'),
		  'on' => esc_html__( 'On', 'geekfolio_plg' ),
		  'off' => esc_html__( 'Off', 'geekfolio_plg' ),
	)
);
geekfolio_meta_box_dropdown('geekfolio_header_btn',
	esc_html__('Show Button', 'geekfolio_plg'),
	array('default' => esc_html__('Global Settings (in Theme Options)', 'geekfolio_plg'),
		  'on' => esc_html__( 'On', 'geekfolio_plg' ),
		  'off' => esc_html__( 'Off', 'geekfolio_plg' ),
	)
);

geekfolio_meta_box_upload('geekfolio_header_logo_white', 
				esc_html__('Light Logo', 'geekfolio_plg'),
				esc_html__('Upload Dark logo in the header', 'geekfolio_plg'),
				'',
				esc_html__( 'Menu Logo', 'geekfolio_plg' ),
				esc_html__( 'Set Menu Logo', 'geekfolio_plg' ) 
			);
geekfolio_meta_box_upload('geekfolio_header_logo_dark', 
				esc_html__('Dark Logo', 'geekfolio_plg'),
				esc_html__('Upload lihgt logo in the header', 'geekfolio_plg'),
				'',
				esc_html__( 'Menu Logo', 'geekfolio_plg' ),
				esc_html__( 'Set Menu Logo', 'geekfolio_plg' ) 
			);


