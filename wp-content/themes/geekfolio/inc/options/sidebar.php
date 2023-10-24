<?php
/**
 * Extras Tab For Theme Option.
 *
 * @package geekfolio
 */
Redux::setSection($geekfolio_pre, array(
	'title' => esc_html__('Sidebar', 'geekfolio'),
	'id' => 'sidebar-option',
	'icon' => 'el el-pause',
));

Redux::setSection($geekfolio_pre, array(
	'title'  => esc_html__( 'Sidebar Settings', 'geekfolio' ),
	"subsection" => true,
	'icon' => 'el el-brush',
	'desc' => esc_html__('Note: each Style can be additionally customized within the chiled theme.', 'geekfolio'),

	'fields' => array(

		array(
			'id' => 'style_sidebar-start',
			'type' => 'section',
			'title' => esc_html__('Style', 'geekfolio'),
			'indent' => true,
		),

		array(
            'id' => 'geekfolio_sidebar_layout',
            'type' => 'button_set',
            'title' => esc_html__('Default Sidebar Layout', 'geekfolio'),
			'subtitle' => esc_html__('Select the style for Sidebar', 'geekfolio'),
            'options' => [
                '1' => esc_html__('Clean Style', 'geekfolio'),
                '2' => esc_html__('Boundary Style', 'geekfolio'),
                '3' => esc_html__('Elegant Style', 'geekfolio'),
            ],
            'default' => '1'
		),

		array(
			'id' => 'style_sidebar-end',
			'type' => 'section',
			'indent' => false,
		),


		array(
			'id' => 'blog_single_sidebar-start',
			'type' => 'section',
			'title' => esc_html__('Layout', 'geekfolio'),
			'indent' => true,
		),

		array(
			'id' => 'geekfolio_single_sidebar_layout',
			'type' => 'button_set',
			'title' => esc_html__('Post Sidebar Layout', 'geekfolio'),
			'options' => [
				'left' => esc_html__('Left', 'geekfolio'),
                'none' => esc_html__('None', 'geekfolio'),
                'right' => esc_html__('Right', 'geekfolio'),
			],
			'default' => 'right'
		),

		array(
			'id' => 'blog_sidebar_layout',
			'type' => 'image_select',
			'title' => esc_html__('Blog Sidebar Layout', 'geekfolio'),
			'options' => [

				'left' => [
					'alt' => 'Left',
					'img' => get_template_directory_uri() . '/assets/images/2cl.png'
				],
				'none' => [
					'alt' => 'None',
					'img' => get_template_directory_uri() . '/assets/images/1co.png'
				],
				'right' => [
					'alt' => 'Right',
					'img' => get_template_directory_uri() . '/assets/images/2cr.png'
				]
			],
			'default' => 'right'
		),

		array(
			'id' => 'search_sidebar_layout',
			'type' => 'image_select',
			'title' => esc_html__('Search Sidebar Layout', 'geekfolio'),
			'options' => [

				'left' => [
					'alt' => 'Left',
					'img' => get_template_directory_uri() . '/assets/images/2cl.png'
				],
				'none' => [
					'alt' => 'None',
					'img' => get_template_directory_uri() . '/assets/images/1co.png'
				],
				'right' => [
					'alt' => 'Right',
					'img' => get_template_directory_uri() . '/assets/images/2cr.png'
				]
			],
			'default' => 'right'
		),

		array(
			'id' => 'blog_single_sidebar-end',
			'type' => 'section',
			'indent' => false,
		)
	),

));

?>