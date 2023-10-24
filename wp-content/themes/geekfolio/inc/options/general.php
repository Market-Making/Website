<?php
/**
 * Genaral Tab For Theme Option.
 *
 * @package geekfolio
 */

Redux::setSection($geekfolio_pre, array(
	'id' => 'general',
	'icon' => 'el el-home',
	'title' => esc_html__('General', 'geekfolio'),
	'desc' => esc_html__('Welcome to the theme options', 'geekfolio'),
));

$mode=true;
If ($mode==true):
	Redux::setSection($geekfolio_pre, array(
		'id' => 'geekfolio_mode',
		"subsection" => true,
		'title' => esc_html__('Geekfolio Mode', 'geekfolio'),
		'icon' => 'el el-brush',
		'fields' => array(
			array(
				'id'       => 'geekfolio_theme_mode',
				'type'     => 'button_set',
				'customizer' => true,
				'title'    => esc_html__('Website Dark/Light Mode', 'geekfolio'),
				'subtitle' => esc_html__('Enable dark color scheme for your website', 'geekfolio'),
				'desc' => esc_html__('Auto: Mode at the Operating System of each user', 'geekfolio'),
				'options' => array(
					'light_mode' => esc_html__( 'Light', 'geekfolio' ),
					'auto_mode' => esc_html__( 'Auto','geekfolio'),
					'dark_mode' => esc_html__( 'Dark','geekfolio'),
					),
				'default' => 'light_mode',
			),
			array(
				'id'       => 'geekfolio_mode_switcher',
				'type'     => 'button_set',
				'customizer' => true,
				'title'    => esc_html__('Color mode switcher', 'geekfolio'),
				'desc' => esc_html__('Enable color mode switcher for your website', 'geekfolio'),
				'options' => array(
					'on' => esc_html__( 'On', 'geekfolio' ),
					'off' => esc_html__( 'Off','geekfolio'),
					),
				'default' => 'off',
			),  
		),
	));
endif;

Redux::setSection($geekfolio_pre, array(
	'id' => 'style',
	"subsection" => true,
	'title' => esc_html__('Styling', 'geekfolio'),
	'desc' => esc_html__('Configuration the style settings', 'geekfolio'),
	'icon' => 'el el-brush',
	'fields' => array(
		array(
			'id'       => 'geekfolio_main_color', 
			'type'     => 'color',
			'title'    => esc_html__('Main Color Scheme', 'geekfolio'), 
			'subtitle' => esc_html__('Pick your color scheme (default: #501E9C).', 'geekfolio'),
			'default'  => '#501E9C',
			'validate' => 'color',
		),
		array(
			'id'       => 'geekfolio_primary_color', 
			'type'     => 'color',
			'title'    => esc_html__('primary Color Scheme', 'geekfolio'), 
			'subtitle' => esc_html__('Pick your color scheme (default: #8169F1).', 'geekfolio'),
			'default'  => '#8169F1',
			'validate' => 'color',
		), 
		array(
			'id'       => 'geekfolio_secondary_color',
			'type'     => 'color',
			'title'    => esc_html__('Secondary Color Scheme', 'geekfolio'), 
			'subtitle' => esc_html__('Pick your color scheme (default: #A44CEE).', 'geekfolio'),
			'default'  => '#A44CEE',
			'validate' => 'color',
		), 
		array(
			'id'       => 'geekfolio_ternary_color',
			'type'     => 'color',
			'title'    => esc_html__('Ternary Color Scheme', 'geekfolio'), 
			'subtitle' => esc_html__('Pick your color scheme (default: #FF847F).', 'geekfolio'),
			'default'  => '#FF847F',
			'validate' => 'color',
		), 
		array(
			'id'       => 'geekfolio_color_scheme',
			'type'     => 'color',
			'title'    => esc_html__('Hyperlink Color', 'geekfolio'), 
			'subtitle' => esc_html__('Pick your color for hyperlink. Default color is black #999999', 'geekfolio'),
			'default'  => '#999999',
			'validate' => 'color',
		), 
		array(
			'id'       => 'geekfolio_custom_hovers',
			'type'     => 'color',
			'title'    => esc_html__('Hyperlink color on hover state', 'geekfolio'), 
			'subtitle' => esc_html__('Pick your color for hover state in hyperlink. Default color is #12c2e9', 'geekfolio'),
			'default'  => '#12c2e9',
			'validate' => 'color',
		),  
		array(
			'id'       => 'geekfolio_heading_color',
			'type'     => 'color',
			'title'    => esc_html__('Color on Heading', 'geekfolio'), 
			'subtitle' => esc_html__('Pick your color for heading text. Default color is black #000000', 'geekfolio'),
			'default'  => '#000000',
			'validate' => 'color',
		), 
		array(
			'id'       => 'geekfolio_general_color',
			'type'     => 'color',
			'title'    => esc_html__('Color on General Paragraph', 'geekfolio'), 
			'subtitle' => esc_html__('Pick your color for general paragraph text. Default color is black #666', 'geekfolio'),
			'default'  => '#666666',
			'validate' => 'color', 
		), 
		array(
			'id'       => 'geekfolio_stick_menu',
			'type'     => 'color',
			'title'    => esc_html__('Sticky Menu Background color (for menu with black background & All Sticky Custom Menu)', 'geekfolio'), 
			'subtitle' => esc_html__('Pick your background color for sticky menu in white text header. Default color is #fff', 'geekfolio'),
			'default'  => '#ffffff',
			'validate' => 'color',
		), 
		array(
			'id'       => 'geekfolio_stick_menu2',
			'type'     => 'color',
			'title'    => esc_html__('Sticky Menu Background color (for menu with white background)', 'geekfolio'), 
			'subtitle' => esc_html__('Pick your background color for sticky menu in white text header. Default color is #ffffff', 'geekfolio'),
			'default'  => '#ffffff',
			'validate' => 'color',
		), 
		 array(
			'id'       => 'geekfolio_menu_border',
			'type'     => 'color',
			'title'    => esc_html__('Sticky Menu BBorder color (for menu with transparent background)', 'geekfolio'), 
			'subtitle' => esc_html__('Pick your border color for sticky menu in transparent text header. Default color is #ffffff', 'geekfolio'),
			'default'  => '#ffffff',
			'validate' => 'color',
		),
		array(
			'id'       => 'geekfolio_footer_color',
			'type'     => 'color',
			'title'    => esc_html__('Standard Footer Background color', 'geekfolio'), 
			'subtitle' => esc_html__('Pick your background color for standard footer. Default color is black #202020', 'geekfolio'),
			'default'  => '#13161D',
			'validate' => 'color',
		),
		array(
			'id'       => 'geekfolio_footer_color',
			'type'     => 'color',
			'title'    => esc_html__('Standard Footer Background color', 'geekfolio'), 
			'subtitle' => esc_html__('Pick your background color for standard footer. Default color is black #202020', 'geekfolio'),
			'default'  => '#13161D',
			'validate' => 'color',
		),
	),
));

Redux::setSection($geekfolio_pre, array(
	'id' => 'preloader',
	"subsection" => true,
	'title' => esc_html__('Preloader', 'geekfolio'),
	'desc' => esc_html__('Configuration the style settings', 'geekfolio'),
	'icon' => 'el el-brush',
	'fields' => array(
		array(
			'id'       => 'geekfolio_preloader_set',
			'type'     => 'button_set',
			'title'    => esc_html__('Preloader Setting', 'geekfolio'),
			'options' => array(
					'show_all' => esc_html__('Show in All pages', 'geekfolio'),
					'show_home' => esc_html__('Show in Home page only', 'geekfolio'),
					'not_show' => esc_html__('Hide in all pages', 'geekfolio'),
				),
		),
		array(
			'id'       => 'geekfolio_preloader_type',
			'type'     => 'button_set',
			'title'    => esc_html__('Preloader Type', 'geekfolio'),
			'options' => array(
					'circle' => esc_html__('Circle', 'geekfolio'),
					'progress' => esc_html__('Progress', 'geekfolio'),
				),
			'default'  => 'progress',
		),

		array(
			'id'       => 'geekfolio_loader_color',
			'type'     => 'color',
			'title'    => esc_html__('Color Scheme', 'geekfolio'), 
			'subtitle' => esc_html__('Pick your color scheme (default: #12c2e9).', 'geekfolio'),
			'default'  => '#12c2e9',
			'validate' => 'color',
		),       
	),
)); 

Redux::setSection($geekfolio_pre, array(
	'id' => 'cursor',
	"subsection" => true,
	'title' => esc_html__('Cursor', 'geekfolio'),
	'desc' => esc_html__('Select your cursor type', 'geekfolio'),
	'icon' => 'el el-brush',
	'fields' => array(
		array(
			'id'       => 'geekfolio_cursor_set',
			'type'     => 'button_set',
			'customizer' => true,
			'title'    => esc_html__('Theme Cursor Type', 'geekfolio'),
			'options' => array(
					'none' => esc_html__('None', 'geekfolio'),
					'1' => esc_html__('Style 1', 'geekfolio'),
				),
			'default' => 'none',
		),      
	),
));

Redux::setSection($geekfolio_pre, array(
	"subsection" => true,
	'title'  => esc_html__( 'Typography', 'geekfolio' ),
	'icon' => 'el el-fontsize',
	'fields' => array(

		array(
			'title' => esc_html__( 'Body', 'geekfolio' ),
			'subtitle' => esc_html__("Choose Size and Style for Body", 'geekfolio' ),
			'id' => 'font_body',
			'type' => 'typography',
			'font-backup' => false,
			'letter-spacing' => true,
			'text-transform' => true,
			'all_styles' => true,
			'output' => array( 'body' ),
			'default' => array(
				'font-family' =>'',
				'color' =>"",
				'font-style' =>'',
				'font-size' =>'',
				'line-height' =>''
			),
		),

        array(
            'title' => esc_html__( 'Paragraph', 'geekfolio' ),
            'subtitle' => esc_html__("Choose Size and Style for paragraph", 'geekfolio' ),
            'id' => 'font_p',
            'type' => 'typography',
            'font-backup' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'all_styles' => true,
            'output' => array( 'p, body.has-paragraph-style p' ),
            'default' => array(
                'font-family' =>'',
                'color' =>"",
                'font-style' =>'',
                'font-size' =>'',
                'line-height' =>''
            ),
        ),

        array(
            'title' => esc_html__( 'H1 Headings', 'geekfolio' ),
            'subtitle' => esc_html__("Choose Size and Style for h1", 'geekfolio' ),
            'id' => 'font_h1',
            'type' => 'typography',
            'font-backup' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'all_styles' => true,
            'output' => array( 'h1' ),
            'default' => array(
                'color' => '',
                'font-style' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => ''
            ),
        ),
        array(
            'title' => esc_html__( 'H2 Headings', 'geekfolio' ),
            'subtitle' => esc_html__("Choose Size and Style for h2", 'geekfolio' ),
            'id' => 'font_h2',
            'type' => 'typography',
            'font-backup' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'all_styles' => true,
            'output' => array( 'h2' ),
            'default' => array(
                'color' => '',
                'font-style' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => ''
            ),
        ),
        array(
            'title' => esc_html__( 'H3 Headings', 'geekfolio' ),
            'subtitle' => esc_html__("Choose Size and Style for h3", 'geekfolio' ),
            'id' => 'font_h3',
            'type' => 'typography',
            'font-backup' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'all_styles' => true,
            'output' => array( 'h3' ),
            'default' => array(
                'color' => '',
                'font-style' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => ''
            ),
        ),
        array(
            'title' => esc_html__( 'H4 Headings', 'geekfolio' ),
            'subtitle' => esc_html__("Choose Size and Style for h4", 'geekfolio' ),
            'id' => 'font_h4',
            'type' => 'typography',
            'font-backup' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'all_styles' => true,
            'output' => array( 'h4' ),
            'default' => array(
                'color' => '',
                'font-style' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => ''
            ),
        ),
        array(
            'title' => esc_html__( 'H5 Headings', 'geekfolio' ),
            'subtitle' => esc_html__("Choose Size and Style for h5", 'geekfolio' ),
            'id' => 'font_h5',
            'type' => 'typography',
            'font-backup' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'all_styles' => true,
            'output' => array( 'h5' ),
            'default' => array(
                'color' => '',
                'font-style' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => ''
            ),
        ),
        array(
            'title' => esc_html__( 'H6 Headings', 'geekfolio' ),
            'subtitle' => esc_html__("Choose Size and Style for h6", 'geekfolio' ),
            'id' => 'font_h6',
            'type' => 'typography',
            'font-backup' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'all_styles' => true,
            'output' => array( 'h6' ),
            'units' => 'px',
            'default' => array(
                'color' => '',
                'font-style' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => ''
            ),
        ),
		
	),

));

Redux::set_section(
	$geekfolio_pre,
	array(
		'title'      => __( 'Custom fonts', 'geekfolio' ),
		'subsection' => true,
		'icon' => 'el el-fontsize',
		'fields'     => array(

			array(
				'id'   => 'custom_fonts',
				'type' => 'custom_fonts',
				'convert' => false,
				'title'       => esc_html__( 'List of uploaded Fonts', 'geekfolio' ),
			),


			array(
				'id'          => 'repeater-field-id',
				'type'        => 'repeater',
				'title'       => esc_html__( 'List of dedicated Fonts for Elementor Builder ', 'geekfolio' ),
				'full_width'  => true,
				'subtitle'    => esc_html__( 'Elementor custom fonts', 'geekfolio' ),
				'item_name'   => '',
				'sortable'    => true,
				'active'      => false,
				'collapsible' => false,
				'fields'      => array(

					array(
						'id'          => 'custom_fonts_typography', 
						'type'        => 'typography',
						'title'       => esc_html__( 'Custom Fonts Typography', 'geekfolio' ),
						'subtitle'    => 'This will modify the font family of the .entry-title classes.',
						'output'      => '.site-title, .widget-title, .entry-title, .wp-block-site-title',
						'font-weight'   => false,
						'font-size'   => false,
						'line-height' => false,
						'text-align'  => false,
						'subsets' => false,
						'color' => false,
						'all_styles' => false,
						'font-style' => false,
					),

				),
			),
		),
	)
);

?>