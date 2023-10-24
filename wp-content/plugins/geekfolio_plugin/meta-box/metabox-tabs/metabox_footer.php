<?php
/**
 * Metabox For Footer.
 *
 * @package Geekfolio
 */
?>
<?php 
geekfolio_meta_box_dropdown('geekfolio_footer_format',
	esc_html__('Footer Format', 'geekfolio_plg'),
	array('global' => esc_html__( 'Use Global Settings (in Theme Options)', 'geekfolio_plg' ),
		  'custom_footer' => esc_html__( 'Use Custom Footer', 'geekfolio_plg' ),
		  'no_footer' => esc_html__( 'No Footer', 'geekfolio_plg' )
	)
);

geekfolio_meta_box_dropdown_custom_footers('geekfolio_footer_list',
	esc_html__('Choose Custom Footer', 'geekfolio_plg'),
	'',
	esc_html__('Only if used "Custom Footer" format', 'geekfolio_plg')
);

geekfolio_meta_box_colorpicker( 'geekfolio_footer_color',
	esc_html__( 'Footer color', 'geekfolio_plg' )
);


