<?php
/**
 * Metabox For sidepanel.
 *
 * @package Geekfolio 
 */
?>
<?php 
geekfolio_meta_box_dropdown('geekfolio_sidepanel_format',
	esc_html__('sidepanel Format.', 'geekfolio_plg'),
	array('default' => esc_html__('Default', 'geekfolio_plg'),
		  'global' => esc_html__( 'Use Global Settings (in Theme Options)', 'geekfolio_plg' ),
		  'custom_sidepanel' => esc_html__( 'Use Custom sidepanel', 'geekfolio_plg' ),
		  'no_sidepanel' => esc_html__( 'No sidepanel', 'geekfolio_plg' )
	)
);

geekfolio_meta_box_dropdown_custom_sidepanels('geekfolio_sidepanel_list',
	esc_html__('Choose Custom sidepanel.', 'geekfolio_plg'),
	'',
	esc_html__('Only if used "Custom sidepanel" format', 'geekfolio_plg')
);


