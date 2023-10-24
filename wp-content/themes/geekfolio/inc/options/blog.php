<?php
/**
 * Blog Tab For Theme Option.
 *
 * @package geekfolio
 */

// -> START Blog Options
Redux::setSection($geekfolio_pre, array(
        'title' => esc_html__('Blog', 'geekfolio'),
        'id' => 'blog-option',
        'icon' => 'el-icon-th',
)); 
Redux::setSection($geekfolio_pre, array(
	'id' => 'blog',
	"subsection" => true,
	'title' => esc_html__('Blog setting', 'geekfolio'),
	'desc' => esc_html__('Configuration blog settings', 'geekfolio'),
    'icon' => 'el el-brush',
	'fields' => array(

		array(
			'id'       => 'geekfolio_related_image', 
			'type'     => 'select',
			'title'    => esc_html__('Featured Image in Related Posts', 'geekfolio'),
			'options' => array(
					'show' => esc_html__('Show', 'geekfolio'),
					'hide' => esc_html__('Hide', 'geekfolio'),
			),
			'default'  => 'hide',
		),

		array( 
			'id'       => 'geekfolio_blog_slide_delay',
			'type'     => 'slider',
			'title'    => esc_html__('Blog Slider Delay', 'geekfolio'), 
			'desc' => esc_html__('Insert the slider delay for slider in blog sidebar,blog wide and single blog post here. The default value 8000', 'geekfolio'),
			'default'  => 8000,
			"min"       => 1,
			"step"      => 1,
			"max"       => 10000,
			'display_value' => 'label'
		), 
        
        [
            'id' => 'blog_article',
            'type' => 'section',
            'title' => esc_html__('Blog Articles', 'geekfolio'),
            'indent' => true,
        ],

        [
            'id' => 'geekfolio_blog_article_layout',
            'type' => 'button_set',
            'title' => esc_html__('Default Blog Article Layout', 'geekfolio'),
            'desc' => esc_html__('Note: each Style can be additionally customized within the chiled theme.', 'geekfolio'),
            'options' => [
                '1' => esc_html__('Clean Style', 'geekfolio'),
                '2' => esc_html__('Boundary Style', 'geekfolio'),
                '3' => esc_html__('Elegant Style', 'geekfolio'),
            ],
            'default' => '1'
        ],

		array(
			'id'       => 'geekfolio_blog_slider',
			'type'     => 'button_set',
			'title'    => esc_html__('Show latest blog slider', 'geekfolio'),
			'options' => array(
					'show' => esc_html__('Show', 'geekfolio'),
					'hide' => esc_html__('Hide', 'geekfolio'),
			),
			'default'  => 'hide',
		),

		array(
			'id'       => 'geekfolio_blog_slider_title',
			'type'     => 'text',
			'title'    => esc_html__('Blog slider title', 'geekfolio'), 
			'default'  => 'Our Journal',
			'required' => array( 'geekfolio_blog_slider', '=', 'show')
		),
		array(
			'id'       => 'geekfolio_blog_slider_subtitle',
			'type'     => 'text',
			'title'    => esc_html__('Blog slider sub-title', 'geekfolio'), 
			'default'  => 'Get the latest articles from our journal, writing, discuss and share',
			'required' => array( 'geekfolio_blog_slider', '=', 'show')
		),

		array(
			'id'       => 'geekfolio_blog_popular',
			'type'     => 'button_set',
			'title'    => esc_html__('Show Popular blog', 'geekfolio'),
			'options' => array(
					'show' => esc_html__('Show', 'geekfolio'),
					'hide' => esc_html__('Hide', 'geekfolio'),
			),
			'default'  => 'hide',
		),
		array(
			'id'       => 'geekfolio_blog_popular_title',
			'type'     => 'text',
			'title'    => esc_html__('Blog popular title', 'geekfolio'), 
			'default'  => 'Popular Posts',
			'required' => array( 'geekfolio_blog_popular', '=', 'show')
		),

        array(
			'id'       => 'geekfolio_blog_tags',
			'type'     => 'button_set',
			'customizer' => true,
			'title'    => esc_html__('Blog Tags', 'geekfolio'),
			'subtitle' => esc_html__('Enable Tags', 'geekfolio'),
			'options' => array(
				'on' => esc_html__( 'Show', 'geekfolio' ),
				'off' => esc_html__( 'Hide','geekfolio'),
				),
			'default' => 'on',
            'required' => array( 'geekfolio_blog_article_layout', '=', '3' )
		), 
        array(
			'id'       => 'geekfolio_blog_button',
			'type'     => 'button_set',
			'customizer' => true,
			'title'    => esc_html__('Blog Button (Continue Reading)', 'geekfolio'),
			'subtitle' => esc_html__('Enable Blog Button (Continue Reading)', 'geekfolio'),
			'options' => array(
				'on' => esc_html__( 'Show', 'geekfolio' ),
				'off' => esc_html__( 'Hide','geekfolio'),
				),
			'default' => 'on',
            'required' => array( 'geekfolio_blog_article_layout', '=', '3' )
		),
        array(
            'title' => esc_html__( 'Post Excerpt Size (max word count)', 'geekfolio' ),
            'subtitle' => esc_html__( 'You can control blog post excerpt size with this option.', 'geekfolio' ),
            'id' => 'excerpt_size',
            'type' => 'slider',
            'default' => 100,
            'min' => 0,
            'step' => 1,
            'max' => 300,
            'display_value' => 'text',
            'required' => array( 'geekfolio_blog_article_layout', '=', '3' )
        ),
	),

));

?>