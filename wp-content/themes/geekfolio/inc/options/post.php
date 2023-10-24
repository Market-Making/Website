<?php
/**
 * Single post Tab For Theme Option.
 *
 * @package geekfolio
 */

// -> START Single post Options

Redux::setSection($geekfolio_pre, array(
        'title' => esc_html__('Single', 'geekfolio'),
        'id' => 'blog-single-option',
        'subsection' => true,
        'icon' => 'el el-brush',
        'fields' => [
            [
                'id' => 'geekfolio_single_type_layout',
                'type' => 'button_set',
                'title' => esc_html__('Default Post Layout', 'geekfolio'),
                'desc' => esc_html__('Note: each Post can be additionally customized within its Meta boxes section.', 'geekfolio'),
                'options' => [
                    '1' => esc_html__('Elegant', 'geekfolio'),
                    '2' => esc_html__('Classic', 'geekfolio'),
                    '3' => esc_html__('Overlay Image', 'geekfolio')
                ],
                'default' => '2'
            ],
            [
                'id' => 'blog_single_page_title-start',
                'type' => 'section',
                'title' => esc_html__('Page Title', 'geekfolio'),
                'indent' => true,
            ],
            [
                'id' => 'blog_title_conditional',
                'type' => 'switch',
                'title' => esc_html__('Page Title Text', 'geekfolio'),
                'on' => esc_html__('Custom', 'geekfolio'),
                'off' => esc_html__('Default', 'geekfolio'),
                'default' => true,
            ],
            [
                'id' => 'post_single_page_title_text',
                'type' => 'text',
                'title' => esc_html__('Custom Page Title Text', 'geekfolio'),
                'default' => esc_html__('Blog Post', 'geekfolio'),
                'required' => ['blog_title_conditional', '=', true],
            ],
            [
                'id' => 'blog_single_page_title_breadcrumbs_switch',
                'type' => 'switch',
                'title' => esc_html__('Breadcrumbs', 'geekfolio'),
                'on' => esc_html__('Use', 'geekfolio'),
                'off' => esc_html__('Hide', 'geekfolio'),
                'default' => true,
            ],
            [
                'id' => 'post_single_page_title_bg_image',
                'type' => 'background',
                'title' => esc_html__('Background Image', 'geekfolio'),
                'preview' => false,
                'preview_media' => true,
                'background-color' => false,
                'default' => [
                    'background-repeat' => 'repeat',
                    'background-size' => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position' => 'center center',
                    'background-color' => '#101d27',
                ],
            ],
            [
                'id' => 'single_padding_layout_3',
                'type' => 'spacing',
                'mode' => 'padding',
                'all' => false,
                'bottom' => true,
                'top' => true,
                'left' => false,
                'right' => false,
                'title' => esc_html__('Padding Top/Bottom', 'geekfolio'),
                'desc' => esc_html__('Note: this setting affects only the "Overlay Image" post layout.', 'geekfolio'),
                'default' => [
                    'padding-top' => '320px',
                    'padding-bottom' => '0px',
                ],
            ],
            [
                'id' => 'blog_single_page_title-end',
                'type' => 'section',
                'indent' => false,
            ],

            [
                'id' => 'blog_single_appearance-start',
                'type' => 'section',
                'title' => esc_html__('Appearance', 'geekfolio'),
                'indent' => true,
            ],
            [
                'id' => 'featured_image_type',
                'type' => 'button_set',
                'title' => esc_html__('Featured Image', 'geekfolio'),
                'options' => [
                    'default' => esc_html__('Default', 'geekfolio'),
                    'off' => esc_html__('Off', 'geekfolio'),
                    'replace' => esc_html__('Replace', 'geekfolio')
                ],
                'default' => 'default'
            ],
            [
                'id' => 'featured_image_replace',
                'type' => 'media',
                'title' => esc_html__('Image To Replace On', 'geekfolio'),
                'required' => ['featured_image_type', '=', 'replace'],
            ],


            [
                'id' => 'blog_single_appearance-end',
                'type' => 'section',
                'indent' => false,
            ],



            [
                'id' => 'single_post_related-start',
                'type' => 'section',
                'title' => esc_html__('Related posts', 'geekfolio'),
                'indent' => true,
            ],
            [
                'title' => esc_html__( 'Single Related Post Count', 'geekfolio' ),
                'id' => 'related_perpage',
                'type' => 'slider',
                'default' => 3,
                'min' => 1,
                'step' => 1,
                'max' => 24,
                'display_value' => 'text',
                //'required' => array( 'single_related_visibility', '=', '1' )
            ],
            [
                'id' => 'geekfolio_related_layout',
                'type' => 'button_set',
                'title' => esc_html__('Default Post Layout', 'geekfolio'),
                'desc' => esc_html__('Note: each Post can be additionally customized within its Meta boxes section.', 'geekfolio'),
                'options' => [
                    '0' => esc_html__('None', 'geekfolio'),
                    '1' => esc_html__('Standard', 'geekfolio'),
                    '2' => esc_html__('Slider', 'geekfolio')
                ],
                'default' => '1'
            ],
            [
                'id' => 'single_post_extras-start',
                'type' => 'section',
                'title' => esc_html__('Post Extras', 'geekfolio'),
                'indent' => true,
            ],

            [
                'id' => 'geekfolio_post_share_box',
                'type' => 'switch',
                'title' => esc_html__('Share Box', 'geekfolio'),
                'default' => false
            ],
        ]
));

?>