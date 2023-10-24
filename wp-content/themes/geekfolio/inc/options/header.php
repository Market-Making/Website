<?php
/**
 * Header Tab For Theme Option.
 *
 * @package geekfolio
 */

Redux::setSection($geekfolio_pre, array(
	'title'  => esc_html__( 'Header', 'geekfolio' ),
	'icon' => 'el el-credit-card',
));

Redux::setSection($geekfolio_pre, array(
	"subsection" => true,
	'title' => esc_html__('Header settings', 'geekfolio'),
	'desc' => esc_html__('Assign menu for header section.', 'geekfolio'),
	'icon' => 'el el-brush',
	'fields' => [
		[
			'id'       => 'geekfolio_header_set', 
			'type'     => 'select',
			'title'    => esc_html__('Header type', 'geekfolio'),
			'options' => array(
				'default' => esc_html__('Standard Header', 'geekfolio'),
				'custom' => esc_html__('Custom Header', 'geekfolio'),
				'no_header' => esc_html__( 'No Header', 'geekfolio' )
			),
			'default'     => 'default',
		],

		[
			'id'    => 'geekfolio_header_set_list',
			'type'  => 'select',
			'desc' => esc_html__('(Only if custom header selected as header type))', 'geekfolio'),
			'title'    => esc_html__('Custom Header format', 'geekfolio'),
			'data'  => 'posts',
			'args'  => array(
				'post_type' => 'header',
				'orderby'   => 'title',
				'order'     => 'ASC',
			),
			'required' => ['geekfolio_header_set', '=', 'custom'],
		],  

		[
			'id'       => 'geekfolio_header_position',
			'type'     => 'select',
			'title'    => esc_html__('Header Position', 'geekfolio'), 
			'options' => array(
				'head_white' => esc_html__( 'Relative Position with Background, ', 'geekfolio' ),
				'head_trans' => esc_html__( 'Absolute Position, Transperant','geekfolio'),
			), 
			'default'  => 'head_white',
			
		],

		[
			'id'       => 'geekfolio_menu_position',
			'type'     => 'select',
			'title'    => esc_html__('Menu Position', 'geekfolio'), 
			'options' => array(
				'right' => esc_html__('Right', 'geekfolio'),
				'center' => esc_html__('Center', 'geekfolio'),
			), 
			'default'  => 'right',
		],

	]
));

Redux::setSection($geekfolio_pre, array(
	'id' => 'header_logo',
	"subsection" => true,
	'title' => esc_html__('Header logo', 'geekfolio'),
	'desc' => esc_html__('Configuration the style settings', 'geekfolio'),
	'icon' => 'el el-brush',
	'fields' => array(
		array(
			'id'       => 'geekfolio_header_logo_white',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__('Logo White Text', 'geekfolio'), 
			'subtitle' => esc_html__('Upload your logo for white text (standard) header (Recommended size 240x80px)', 'geekfolio'),
			'default'  => array('url'=>get_template_directory_uri().'/assets/images/logo-white.png'),
		), 
		array(
			'id'       => 'geekfolio_header_logo_dark',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__('Logo Dark Text', 'geekfolio'), 
			'subtitle' => esc_html__('Upload your logo for dark text (standard) header (Recommended size 240x80px)', 'geekfolio'),
			'default'  => array('url'=>get_template_directory_uri().'/assets/images/logo-dark.png'),
		),
		array(
			'id'       => 'geekfolio_logo_dim',
			'type'     => 'dimensions',
			'height' => true,
             'width' => false,
			'units'    => array('em','px','%'),
			'title'    => esc_html__('Logo dimensions Height', 'geekfolio'), 
			'subtitle' => esc_html__('Enable or disable any piece of this field. Width, Height, or Units.)', 'geekfolio'),
			'default' => ['height' => 25], 
		), 
     
	)
));

Redux::setSection($geekfolio_pre, array(
	'id' => 'geekfolio_header_social',
	"subsection" => true,
	'title' => esc_html__('Header social', 'geekfolio'),
	'desc' => esc_html__('Configuration the header social icons', 'geekfolio'),
	'icon' => 'el el-brush',
	'fields' => array( 
		array(
			'id'       => 'geekfolio_header_enable_topmenu',
			'type'     => 'select',
			'title'    => esc_html__('Enable Top Menu', 'geekfolio'),
			'options' => array(
				'on' => esc_html__('On', 'geekfolio'),
				'off' => esc_html__('Off', 'geekfolio'),
			), 
			'default'  => 'off',
		), 
		array(
			'id'       => 'geekfolio_header_phone',
			'type'     => 'text',
			'title'    => esc_html__('Phone', 'geekfolio'), 
			'subtitle' => esc_html__('Input phone number', 'geekfolio'),
			'required'  => array('geekfolio_header_enable_topmenu', 'equals','on'),
		),
		array(
			'id'       => 'geekfolio_header_mail',
			'type'     => 'text',
			'title'    => esc_html__('Mail', 'geekfolio'), 
			'subtitle' => esc_html__('Input mail address', 'geekfolio'),
			'required'  => array('geekfolio_header_enable_topmenu', 'equals','on'),
		),
		array(
			'id'       => 'geekfolio_header_address',
			'type'     => 'text',
			'title'    => esc_html__('Address', 'geekfolio'), 
			'subtitle' => esc_html__('Input address', 'geekfolio'),
			'required'  => array('geekfolio_header_enable_topmenu', 'equals','on'),
		),
		array(
			'id'       => 'geekfolio_header_join',
			'type'     => 'text',
			'title'    => esc_html__('Join', 'geekfolio'), 
			'subtitle' => esc_html__('Input Join text', 'geekfolio'),
			'required'  => array('geekfolio_header_enable_topmenu', 'equals','on'),
		),
		array(
			'id'       => 'geekfolio_header_joinlink',
			'type'     => 'text',
			'title'    => esc_html__('Join', 'geekfolio'), 
			'subtitle' => esc_html__('Input Join link', 'geekfolio'),
			'required'  => array('geekfolio_header_enable_topmenu', 'equals','on'),
		),
		array(
			'id'       => 'geekfolio_header_enable_social',
			'type'     => 'select',
			'title'    => esc_html__('Enable Header Social', 'geekfolio'),
			'options' => array(
				'on' => esc_html__('On', 'geekfolio'),
				'off' => esc_html__('Off', 'geekfolio'),
			), 
			'default'  => 'off',
		), 
		array(
			'id'       => 'geekfolio_header_facebook',
			'type'     => 'text',
			'title'    => esc_html__('Facebook Link', 'geekfolio'), 
			'subtitle' => esc_html__('Input facebook link here', 'geekfolio'),
			'required'  => array('geekfolio_header_enable_social', 'equals','on'),
		),  
		array(
			'id'       => 'geekfolio_header_twitter',
			'type'     => 'text',
			'title'    => esc_html__('Twitter Link', 'geekfolio'), 
			'subtitle' => esc_html__('Input Twitter link here', 'geekfolio'),
			'required'  => array('geekfolio_header_enable_social', 'equals','on'),
		), 
		array(
			'id'       => 'geekfolio_header_instagram',
			'type'     => 'text',
			'title'    => esc_html__('Instagram Link', 'geekfolio'), 
			'subtitle' => esc_html__('Input Instagram link here', 'geekfolio'),
			'required'  => array('geekfolio_header_enable_social', 'equals','on'),
		),  
		array(
			'id'       => 'geekfolio_header_pinterest',
			'type'     => 'text',
			'title'    => esc_html__('Pinterest Link', 'geekfolio'), 
			'subtitle' => esc_html__('Input Pinterest link here', 'geekfolio'),
			'required'  => array('geekfolio_header_enable_social', 'equals','on'),
		), 
		array(
			'id'       => 'geekfolio_header_xing',
			'type'     => 'text',
			'title'    => esc_html__('Xing Link', 'geekfolio'), 
			'subtitle' => esc_html__('Input Xing link here', 'geekfolio'),
			'required'  => array('geekfolio_header_enable_social', 'equals','on'),
		),  
		array(
			'id'       => 'geekfolio_header_linkedin',
			'type'     => 'text',
			'title'    => esc_html__('LinkedIn Link', 'geekfolio'), 
			'subtitle' => esc_html__('Input LinkedIn link here', 'geekfolio'),
			'required'  => array('geekfolio_header_enable_social', 'equals','on'),
		),   
		array(
			'id'       => 'geekfolio_header_search',
			'type'     => 'select',
			'title'    => esc_html__('Search Icon', 'geekfolio'), 
			'subtitle' => esc_html__('To show search icon in header', 'geekfolio'),
			'options' => array(
				'on' => esc_html__('On', 'geekfolio'),
				'off' => esc_html__('Off', 'geekfolio'),
			), 
			'default'  => 'off',
		),  
		array(
			'id'       => 'geekfolio_header_btn',
			'type'     => 'select',
			'title'    => esc_html__('Button', 'geekfolio'), 
			'subtitle' => esc_html__('To show Button in header', 'geekfolio'),
			'options' => array(
				'on' => esc_html__('On', 'geekfolio'),
				'off' => esc_html__('Off', 'geekfolio'),
			), 
			'default'  => 'off',
		), 
		array(
			'id'       => 'geekfolio_menu_btn',
			'type'     => 'text',
			'title'    => esc_html__('Button Text', 'geekfolio'), 
			'required'  => array('geekfolio_header_btn', 'equals','on'),
		),
		array(
			'id'       => 'geekfolio_menu_btn_url',
			'type'     => 'text',
			'title'    => esc_html__('Button URL', 'geekfolio'),
			'required'  => array('geekfolio_header_btn', 'equals','on'), 
		),
	)
));

?>