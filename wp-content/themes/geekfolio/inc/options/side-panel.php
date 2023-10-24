<?php
/**
 * Side panel Tab For Theme Option.
 *
 * @package geekfolio
 */
Redux::setSection($geekfolio_pre, array(
	'title'  => esc_html__( 'Side Panel', 'geekfolio' ),
	'icon' => 'el-icon-lines',
));

Redux::setSection($geekfolio_pre, array(
	"subsection" => true,
	'title' => esc_html__('Side Panel settings', 'geekfolio'),
	'desc' => esc_html__('Assign menu for side panel section.', 'geekfolio'),
	'icon' => 'el el-brush',
	'fields' => array(
		array(
			'id'       => 'geekfolio_sidepanel_set',
			'type'     => 'select',
			'title'    => esc_html__('Side Panel', 'geekfolio'),
			'options' => array(
				'default' => esc_html__('Standard Side panel', 'geekfolio'),
				'custom' => esc_html__('Custom Side panel', 'geekfolio'),
			),
		),
		array(
			'id'    => 'geekfolio_sidepanel_set_list',
			'type'  => 'select',
			'title'    => esc_html__('Side panel', 'geekfolio'),
			'data'  => 'posts',
			'args'  => array(
				'post_type' => 'sidepanel',
				'orderby'   => 'title',
				'order'     => 'ASC',
			)
		),     
	),
));

?>