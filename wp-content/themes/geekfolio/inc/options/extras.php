<?php
/**
 * Extras Tab For Theme Option.
 *
 * @package geekfolio
 */

Redux::setSection($geekfolio_pre, array(
	'title'  => esc_html__( 'Extras', 'geekfolio' ),
	'icon' => 'el el-plus-sign',
));

Redux::setSection($geekfolio_pre, array( 
	'id' => 'page_404',
	"subsection" => true,
	'title' => esc_html__('404 Page', 'geekfolio'),
	'icon' => 'el el-brush',
	'fields' => array(
		array(
			'id'       => 'geekfolio_enable_custom_404',
			'type'     => 'switch',
			'customizer' => true,
			'title'    => esc_html__('Enable custom 404 page', 'geekfolio'),
			'default' => false,
		),  
		array(
			'id'       => 'geekfolio_custom_404_page',
			'type'     => 'select',
			'customizer' => true,
			'title'    => esc_html__('Custom 404 page', 'geekfolio'),
			'data'  => 'pages',

			'required' => array('geekfolio_enable_custom_404','=',true),
		),
	),
));

?>