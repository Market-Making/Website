<?php
/**
 * Portfolio Tab For Theme Option.
 *
 * @package geekfolio
 */
Redux::setSection($geekfolio_pre, array(
	'title'  => esc_html__( 'portfolio', 'geekfolio' ),
	'icon'=>'el el-briefcase',
));
Redux::setSection($geekfolio_pre, array(
	"subsection" => true,
	'title' => esc_html__('Portfolio settings', 'geekfolio'),
	'desc' => esc_html__('Configuration portfolio settings', 'geekfolio'),
	'icon' => 'el el-brush',
	'fields' => array(
		array(
			'id'       => 'geekfolio_portfolio_all',
			'type'     => 'text',
			'title'    => esc_html__('All categories filter', 'geekfolio'), 
			'subtitle' => esc_html__('Portfolio Text Filter for all categories', 'geekfolio'),
			'desc' => esc_html__('Insert your text for portfolio filter for all categories. The default text is "All"', 'geekfolio'),
			'default'  => 'All',
		),  
		array(
			'id'       => 'geekfolio_other_port_sub',
			'type'     => 'text',
			'title'    => esc_html__('Other Portfolio Section Subtitle', 'geekfolio'), 
			'desc' => esc_html__('Insert your text for subt title of other portfolio section on single portfolio page.<br/>Leave it blank if you want to use the default text.', 'geekfolio'),
			'default'  => 'See our other portfolio',
		),
		array(
			'id'       => 'geekfolio_other_port_title',
			'type'     => 'text',
			'title'    => esc_html__('Other Portfolio Section Title', 'geekfolio'), 
			'desc' => esc_html__('Insert your text for title of other portfolio section on single portfolio page.<br/>Leave it blank if you want to use the default text.', 'geekfolio'),
			'default'  => 'Other portfolio',
		),
	),
));


?>