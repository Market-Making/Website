<?php
/**
 * Footer Tab For Theme Option.
 *
 * @package geekfolio
 */

Redux::setSection($geekfolio_pre, array(
	'title'  => esc_html__( 'Footer', 'geekfolio' ),
	'icon' => 'el el-photo',
));

Redux::setSection($geekfolio_pre, array(
	"subsection" => true,
	'title' => esc_html__('Footer settings', 'geekfolio'),
	'desc' => esc_html__('Assign menu for footer section.', 'geekfolio'),
	'icon' => 'el el-brush',
	'fields' => array(
		array(
			'id'       => 'geekfolio_footer_set',
			'type'     => 'select',
			'title'    => esc_html__('Footer type', 'geekfolio'),
			'options' => array(
				'default' => esc_html__('Standard Footer', 'geekfolio'),
				'custom' => esc_html__('Custom Footer', 'geekfolio'),
			),
			'default' => 'default',
		),
		array(
			'id'    => 'geekfolio_footer_set_list',
			'type'  => 'select',
			'title'    => esc_html__('Custom Header name', 'geekfolio'),
			'data'  => 'posts',
			'args'  => array(
				'post_type' => 'footer',
				'orderby'   => 'title',
				'order'     => 'ASC',
			),
			'required' => ['geekfolio_footer_set', '=', 'custom'],
		),     
	),
));

Redux::setSection($geekfolio_pre, array(
	'id' => 'logo',
	"subsection" => true,
	'title' => esc_html__('Footer logo', 'geekfolio'),
	'desc' => esc_html__('Configuration the style settings', 'geekfolio'),
	'icon' => 'el el-brush',
	'fields' => array(
		array(
			'id'       => 'geekfolio_footer_logo_white',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__('Logo White Text', 'geekfolio'), 
			'subtitle' => esc_html__('Upload your logo for white text (standard) footer (Recommended size 240x80px)', 'geekfolio'),
			'default'  => array('url'=>get_template_directory_uri().'/assets/images/logo-dark.png'),
		),

		array(
			'id'       => 'geekfolio_footer_logo_dark',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__('Logo Dark Text', 'geekfolio'), 
			'subtitle' => esc_html__('Upload your logo for dark text (standard) footer (Recommended size 240x80px)', 'geekfolio'),
			'default'  => array('url'=>get_template_directory_uri().'/assets/images/logo-white.png'),
		), 
		array(
			'id'       => 'geekfolio_footer_text',
			'type'     => 'editor',
			'title'    => esc_html__('Footer Text', 'geekfolio'), 
			'subtitle' => esc_html__('Upload your logo for dark text (standard) footer (Recommended size 240x80px)', 'geekfolio'),
			'default' => '',
			'args'   => array('teeny'  => true,'textarea_rows'=> 10)
		), 
	)
));

Redux::setSection($geekfolio_pre, array(
	'id' => 'geekfolio_footer_social',
	"subsection" => true,
	'title' => esc_html__('Footer social', 'geekfolio'),
	'desc' => esc_html__('Configuration the footer social icons', 'geekfolio'),
	'icon' => 'el el-brush',
	'fields' => array(
		array(
			'id'       => 'geekfolio_footer_enable_social',
			'type'     => 'switch',
			'title'    => esc_html__('Enable Footer Social', 'geekfolio'), 
			'default'  => true,
		), 
		array(
			'id'       => 'geekfolio_footer_facebook',
			'type'     => 'text',
			'title'    => esc_html__('Facebook Link', 'geekfolio'), 
			'subtitle' => esc_html__('Input facebook link here', 'geekfolio'),
			'required'  => array('geekfolio_footer_enable_social', 'equals',true),
		),  
		array(
			'id'       => 'geekfolio_footer_twitter',
			'type'     => 'text',
			'title'    => esc_html__('Twitter Link', 'geekfolio'), 
			'subtitle' => esc_html__('Input Twitter link here', 'geekfolio'),
			'required'  => array('geekfolio_footer_enable_social', 'equals',true),
		), 
		array(
			'id'       => 'geekfolio_footer_instagram',
			'type'     => 'text',
			'title'    => esc_html__('Instagram Link', 'geekfolio'), 
			'subtitle' => esc_html__('Input Instagram link here', 'geekfolio'),
			'required'  => array('geekfolio_footer_enable_social', 'equals',true),
		),  
		array(
			'id'       => 'geekfolio_footer_pinterest',
			'type'     => 'text',
			'title'    => esc_html__('Pinterest Link', 'geekfolio'), 
			'subtitle' => esc_html__('Input Pinterest link here', 'geekfolio'),
			'required'  => array('geekfolio_footer_enable_social', 'equals',true),
		), 
		array(
			'id'       => 'geekfolio_footer_xing',
			'type'     => 'text',
			'title'    => esc_html__('Xing Link', 'geekfolio'), 
			'subtitle' => esc_html__('Input Xing link here', 'geekfolio'),
			'required'  => array('geekfolio_footer_enable_social', 'equals',true),
		),  
		array(
			'id'       => 'geekfolio_footer_linkedin',
			'type'     => 'text',
			'title'    => esc_html__('LinkedIn Link', 'geekfolio'), 
			'subtitle' => esc_html__('Input LinkedIn link here', 'geekfolio'),
			'required'  => array('geekfolio_footer_enable_social', 'equals',true),
		),  
	)
));

?>