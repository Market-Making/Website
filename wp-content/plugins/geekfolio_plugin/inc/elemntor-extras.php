<?php
namespace Elementor;

class Geekfolio_Page_Controls {

    public function __construct() {

        /**
         * Section Controls
         */
        add_action( 'elementor/documents/register_controls', [$this, 'register_page_controls'] );
    }

    /**
     * Section Controls
     */
    public function register_page_controls( $element ) {
        
        $element->start_controls_section(
            'geekfolio_dark_page_bg',
            [
                'label'         => esc_html__( 'Geekfolio Dark Mode Background', 'geekfolio_plg' ),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $element->add_control(
			'page_dark_choose_bg_type',
			[
				'label' => __( 'Dark Mode Background', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'classic' => [
						'title' => __( 'Classic', 'geekfolio_plg' ),
						'icon' => 'eicon-paint-brush',
					],
					'gradient' => [
						'title' => __( 'Gradient', 'geekfolio_plg' ),
						'icon' => 'eicon-barcode',
					],
				],
				'toggle' => true,
			]
		);

        $element->add_control(
            'page_dark_classic_bg_color',
            [
                'label' => _x( 'Background Color', 'Background Control', 'geekfolio_plg' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'title' => _x( 'Background Color', 'Background Control', 'geekfolio_plg' ),
                'selectors' => [
                    '@media(prefers-color-scheme:dark){ {{WRAPPER}}.geekfolio-auto-mode' => 'background-color: {{VALUE}};',
                    '} {{WRAPPER}}.geekfolio-dark-mode' => 'background-color: {{VALUE}};',
                    '@media(prefers-color-scheme:dark){ {{WRAPPER}}.geekfolio-auto-mode:not(.elementor-motion-effects-element-type-background)' => 'background-color: {{VALUE}};',
                    '} {{WRAPPER}}.geekfolio-dark-mode:not(.elementor-motion-effects-element-type-background)' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'page_dark_choose_bg_type' => [ 'classic'],
                ],
            ]
        );

        $element->add_control(
            'page_dark_gradient_bg_color1',
            [
                'label' => _x( 'First Color', 'Background Control', 'geekfolio_plg' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'title' => _x( 'First Color', 'Background Control', 'geekfolio_plg' ),
                'render_type' => 'ui',
                'condition' => [
                    'page_dark_choose_bg_type' => [ 'gradient'],
                ],
                'of_type' => 'gradient',
            ]
        );


        $element->add_control(
            'page_dark_gradient_bg_color1_stop', 
            [
                'label' => _x( 'Location', 'Background Control', 'geekfolio_plg' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'default' => [
                    'unit' => '%',
                    'size' => 0,
                ],
                'render_type' => 'ui',
                'condition' => [
                    'page_dark_choose_bg_type' => [ 'gradient'],
                ],
                'of_type' => 'gradient',
            ]
        );

        $element->add_control(
            'page_dark_gradient_bg_color2',
            [
                'label' => _x( 'Second Color', 'Background Control', 'geekfolio_plg' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#f2295b',
                'render_type' => 'ui',
                'condition' => [
                    'page_dark_choose_bg_type' => [ 'gradient'],
                ],
                'of_type' => 'gradient',
            ]
        );

        $element->add_control(
            'page_dark_gradient_bg_color2_stop', 
            [
                'label' => _x( 'Location', 'Background Control', 'geekfolio_plg' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'render_type' => 'ui',
                'condition' => [
                    'page_dark_choose_bg_type' => [ 'gradient'],
                ],
                'of_type' => 'gradient',
            ]
        );

        $element->add_control(
            'page_dark_gradient_type', 
            [
                'label' => _x( 'Type', 'Background Control', 'geekfolio_plg' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'linear' => _x( 'Linear', 'Background Control', 'geekfolio_plg' ),
                    'radial' => _x( 'Radial', 'Background Control', 'geekfolio_plg' ),
                ],
                'default' => 'linear',
                'render_type' => 'ui',
                'condition' => [
                    'page_dark_choose_bg_type' => [ 'gradient'],
                ],
                'of_type' => 'gradient',
            ]
        );

        $element->add_control(
            'page_dark_gradient_angle', 
            [
                'label' => _x( 'Angle', 'Background Control', 'geekfolio_plg' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'deg' ],
                'default' => [
                    'unit' => 'deg',
                    'size' => 180,
                ],
                'range' => [
                    'deg' => [
                        'step' => 10,
                    ],
                ],
                'selectors' => [
                    '@media (prefers-color-scheme: dark) { {{WRAPPER}}.geekfolio-auto-mode' => 'background: linear-gradient({{SIZE}}{{UNIT}}, {{page_dark_gradient_bg_color1.VALUE}} {{page_dark_gradient_bg_color1_stop.SIZE}}{{page_dark_gradient_bg_color1_stop.UNIT}},{{page_dark_gradient_bg_color2.VALUE}} {{page_dark_gradient_bg_color2_stop.SIZE}}{{page_dark_gradient_bg_color2_stop.UNIT}});',
                    '} {{WRAPPER}}.geekfolio-dark-mode' => 'background: linear-gradient({{SIZE}}{{UNIT}}, {{page_dark_gradient_bg_color1.VALUE}} {{page_dark_gradient_bg_color1_stop.SIZE}}{{page_dark_gradient_bg_color1_stop.UNIT}},{{page_dark_gradient_bg_color2.VALUE}} {{page_dark_gradient_bg_color2_stop.SIZE}}{{page_dark_gradient_bg_color2_stop.UNIT}});',
                ],

                'condition' => [
                    'page_dark_choose_bg_type' => [ 'gradient'],
                    'page_dark_gradient_type' => 'linear',
                ],
                'of_type' => 'gradient',
            ]
        );

        $element->end_controls_section();

        $element->start_controls_section(
            'geekfolio_page_border_section',
            [
                'label'         => esc_html__( 'Geekfolio Border', 'geekfolio_plg' ),
                'tab'           => Controls_Manager::TAB_STYLE,
                'hide_in_inner' => true,
            ]
        );

        $element->add_control(
            'geekfolio_page_border_style', 
            [
                'label' => esc_html__( 'Border Type', 'geekfolio_plg' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Default', 'geekfolio_plg' ),
                    'none' => esc_html__( 'None', 'geekfolio_plg' ),
                    'solid' => esc_html__( 'Solid', 'geekfolio_plg' ),
                    'double' => esc_html__( 'Double', 'geekfolio_plg' ),
                    'dotted' => esc_html__( 'Dotted', 'geekfolio_plg' ),
                    'dashed' => esc_html__( 'Dashed', 'geekfolio_plg' ),
                    'groove' => esc_html__( 'Groove', 'geekfolio_plg' ),
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'border-style: {{VALUE}};',
                    'html' => 'height: auto;',
                ],
            ]
        );

        $element->add_control(
            'geekfolio_page_border_width', 
            [
                'label' => esc_html__( 'Width', 'geekfolio_plg' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}}' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'geekfolio_page_border_style!' => [ '', 'none' ],
                ],
                'responsive' => true,
            ]
        );

        $element->add_control(
            'geekfolio_page_border_color', 
            [
                'label' => esc_html__( 'Color', 'geekfolio_plg' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'geekfolio_page_border_style!' => [ '', 'none' ],
                ],
            ]
        );

        $element->end_controls_section();

    }
};
new Geekfolio_Page_Controls();

class Geekfolio_Extend_section {

    public function __construct() {

        /**
         * Section Controls
         */
        add_action( 'elementor/element/section/section_advanced/after_section_end', [$this, 'register_section_controls'] );
    }

    /**
     * Section Controls
     */
    public function register_section_controls( Controls_Stack $element ) {
        $element->start_controls_section(
            'geekfolio_onepagescroll_section',
            [
                'label'         => esc_html__( 'Geekfolio Sticky Settings', 'geekfolio_plg' ),
                'tab'           => Controls_Manager::TAB_ADVANCED,
                'hide_in_inner' => false,
            ]
        );
        // $element->add_control(
        //     'geekfolio_is_sticky',
        //     [
        //         'label'                 => esc_html__( 'Enable Sticky', 'geekfolio_plg' ),
        //         'type'                  => Controls_Manager::SWITCHER,
        //         'frontend_available'    => true,
        //         'return_value'          => 'section',
        //         'prefix_class'          => 'geekfolio-sticky-', 
        //     ]
        // );

		$element->add_control(
			'sticky',
			[
				'label' => __( 'Sticky', 'geekfolio_plg' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'None', 'geekfolio_plg' ),
					'top' => __( 'Top', 'geekfolio_plg' ),
					'bottom' => __( 'bottom', 'geekfolio_plg' ),
				],
				'separator' => 'before',
				'render_type' => 'none',
				'frontend_available' => true,
				'prefix_class'          => 'geekfolio-sticky-',
			]
		);

        $element->add_control(
            'sticky_background',
            [
                'label'     => __( 'Background Scroll', 'geekfolio_plg' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.elementor-section.is-stuck' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'sticky' => 'top',
                ],
            ]
        );

        // $element->add_control(
        //     'sticky_background4',
        //     [
        //         'label'     => __( 'Background Scroll', 'geekfolio_plg' ),
        //         'type'      => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}}.elementor-section' => 'background: {{VALUE}};',
        //             '{{WRAPPER}}.elementor-section' => 'background: linear-gradient( #12c2e9, #c471ed, #f64f59);',
        //         ],
        //         'condition' => [
        //             'sticky' => 'top',
        //         ],
        //     ]
        // );
        
        $element->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'scroll_box_shadow',
                'label'     => __( 'Scroll Shadow', 'geekfolio_plg' ),
                'selector' => '{{WRAPPER}} .elementor-section.is-stuck',
            ]
        );


        $element->add_responsive_control(
            'offset_space',
            [
                'label' => __( 'Offset', 'geekfolio_plg' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}.is-stuck' => 'top: {{SIZE}}{{UNIT}} !important;',
                    '.admin-bar {{WRAPPER}}.is-stuck' => 'top: calc({{SIZE}}{{UNIT}} + 32px);', 
                ],
                'condition' => [
                    'sticky' => 'top',
                ],
            ]
        );

        $element->add_control(
            'separator_panel_style',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $element->add_control(
            'enable_gradient',
            [
                'label' => __( 'Enable Gradient (3rd)', 'geekfolio_plg' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'geekfolio_plg' ),
                'label_off' => __( 'No', 'geekfolio_plg' ),
                'return_value' => 'yes',
                'default' => false,
            ]
        );

        $element->add_control(
            'color',
            [
                'label' => _x( 'Gradient Color', 'Background Control', 'geekfolio_plg' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'title' => _x( 'Background Color', 'Background Control', 'geekfolio_plg' ),
                'condition' => [
                    'enable_gradient' => [ 'yes'],
                ],
            ]
        );


        $element->add_control(
            'color_stop', 
            [
                'label' => _x( 'Location', 'Background Control', 'geekfolio_plg' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'default' => [
                    'unit' => '%',
                    'size' => 0,
                ],
                'render_type' => 'ui',
                'condition' => [
                    'enable_gradient' => [ 'yes'],
                ],
                'of_type' => 'gradient',
            ]
        );
        $element->add_control(
            'color_a',
            [
                'label' => _x( 'Second Color', 'Background Control', 'geekfolio_plg' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#f2295b',
                'render_type' => 'ui',
                'condition' => [
                    'enable_gradient' => [ 'yes'],
                ],
                'of_type' => 'gradient',
            ]
        );

        $element->add_control(
            'color_a_stop', 
            [
                'label' => _x( 'Location', 'Background Control', 'geekfolio_plg' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'render_type' => 'ui',
                'condition' => [
                    'enable_gradient' => [ 'yes'],
                ],
                'of_type' => 'gradient',
            ]
        );

        $element->add_control(
            'color_b',
            [
                'label' => _x( 'Second Color', 'Background Control', 'geekfolio_plg' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#f2295b',
                'render_type' => 'ui',
                'condition' => [
                    'enable_gradient' => [ 'yes'],
                ],
                'of_type' => 'gradient',
            ]
        );

        $element->add_control(
            'color_b_stop', 
            [
                'label' => _x( 'Location', 'Background Control', 'geekfolio_plg' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'render_type' => 'ui',
                'condition' => [
                    'enable_gradient' => [ 'yes'],
                ],
                'of_type' => 'gradient',
            ]
        );

        $element->add_control(
            'gradient_type', 
            [
                'label' => _x( 'Type', 'Background Control', 'geekfolio_plg' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'linear' => _x( 'Linear', 'Background Control', 'geekfolio_plg' ),
                    'radial' => _x( 'Radial', 'Background Control', 'geekfolio_plg' ),
                ],
                'default' => 'linear',
                'render_type' => 'ui',
                'condition' => [
                    'enable_gradient' => [ 'yes'],
                ],
                'of_type' => 'gradient',
            ]
        );

        $element->add_control(
            'gradient_angle', 
            [
                'label' => _x( 'Angle', 'Background Control', 'geekfolio_plg' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'deg' ],
                'default' => [
                    'unit' => 'deg',
                    'size' => 180,
                ],
                'range' => [
                    'deg' => [
                        'step' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}.elementor-section' => 'background: linear-gradient({{SIZE}}{{UNIT}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}},{{color_a.VALUE}} {{color_a_stop.SIZE}}{{color_a_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}});',
                ],

                'condition' => [
                    'enable_gradient' => [ 'yes'],
                    'gradient_type' => 'linear',
                ],
                'of_type' => 'gradient',
            ]
        );


        $element->end_controls_section();

        $element->start_controls_section(
            'geekfolio_header_absolute_section',
            [
                'label'         => esc_html__( 'Geekfolio Header Absolute', 'geekfolio_plg' ),
                'tab'           => Controls_Manager::TAB_ADVANCED,
                'hide_in_inner' => false,
            ]
        );

		$element->add_control(
			'enable_header_absolute',
			[
				'label' => __( 'Enable Header Absolute', 'geekfolio_plg' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'on' => __( 'On', 'geekfolio_plg' ),
					'off' => __( 'Off', 'geekfolio_plg' ),
				],
				'separator' => 'before',
                'default' => 'off',
				'render_type' => 'off',
				'frontend_available' => true,
				'prefix_class'          => 'geekfolio-header-absolute-',
			]
		);

        $element->end_controls_section();
        
        $element->start_controls_section(
            'geekfolio_background_section',
            [
                'label'         => esc_html__( 'Geekfolio Background Settings', 'geekfolio_plg' ),
                'tab'           => Controls_Manager::TAB_ADVANCED,
                'hide_in_inner' => false,
            ]
        );

        $element->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'geekfolio_light_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}}.elementor-section',
			]
		);

        $element->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'geekfolio_dark_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}}.elementor-section',
                'fields_options' => [
                    'color' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-color: {{VALUE}};',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-color: {{VALUE}};',
                        ],
                    ],
                    'gradient_angle' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}})',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}})',
                        ],
                    ],
                    'gradient_position' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}})',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}})',
                        ],
                    ],
                    'image' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-image: url("{{URL}}");',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-image: url("{{URL}}");',
                        ],
                    ],
                    'position' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-position: {{VALUE}};',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-position: {{VALUE}};',
                        ],
                    ],
                    'xpos' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-position: {{SIZE}}{{UNIT}} {{ypos.SIZE}}{{ypos.UNIT}}',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-position: {{SIZE}}{{UNIT}} {{ypos.SIZE}}{{ypos.UNIT}}',
                        ],
                    ],
                    'ypos' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-position: {{SIZE}}{{UNIT}} {{ypos.SIZE}}{{ypos.UNIT}}',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-position: {{SIZE}}{{UNIT}} {{ypos.SIZE}}{{ypos.UNIT}}',
                        ],
                    ],
                    'attachment' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode (desktop+){{SELECTOR}}' => 'background-attachment: {{VALUE}};',
                            '} body.geekfolio-dark-mode (desktop+){{SELECTOR}}' => 'background-attachment: {{VALUE}};',
                        ],
                    ],
                    'repeat' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-repeat: {{VALUE}};',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-repeat: {{VALUE}};',
                        ],
                    ],
                    'size' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-size: {{VALUE}};',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-size: {{VALUE}};',
                        ],
                    ],
                    'bg_width' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-size: {{SIZE}}{{UNIT}} auto',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-size: {{SIZE}}{{UNIT}} auto',
                        ],
                    ],
                    'video_fallback' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background: url("{{URL}}") 50% 50%; background-size: cover;',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background: url("{{URL}}") 50% 50%; background-size: cover;',
                        ],
                    ],
                ]
			]
		);

		$element->add_control(
			'geekfolio_bg_blur',
			[
				'label' => esc_html__('Background Blur', 'zumor_plg'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-section' => '    backdrop-filter: blur({{SIZE}}px);',
				],
			]
		);

        $element->end_controls_section();
        
    }
    
}
new Geekfolio_Extend_section();



class Geekfolio_Dark_Mode_Controls {

    public function __construct() {

        /**
         * Section Controls
         */
        add_action( 'elementor/element/divider/section_divider_style/after_section_end', [$this, 'register_divider_controls'] );
        add_action( 'elementor/element/common/_section_border/before_section_end', [$this, 'register_common_border_controls'] );
        add_action( 'elementor/element/common/_section_background/before_section_end', [$this, 'register_common_background_controls'] );
        add_action( 'elementor/element/column/section_border/before_section_end', [$this, 'register_column_controls'] );
        add_action( 'elementor/element/section/section_border/before_section_end', [$this, 'register_section_controls'] );
        add_action( 'elementor/element/icon/section_style_icon/after_section_end', [$this, 'register_icon_controls'] );
    }

    /**
     * Element Controls
     */
    public function register_common_background_controls( $element ) { 

        $element->start_controls_tabs( '_tabs_background' );

		$element->start_controls_tab(
			'_tab_background_normal',
			[
				'label' => esc_html__( 'Normal', 'elementor' ),
			]
		);

		$element->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'geekfolio_element_background_darkmode',
				'selector' => '{{WRAPPER}} > .elementor-widget-container',
                'fields_options' => [
                    'color' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-color: {{VALUE}};',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-color: {{VALUE}};',
                        ],
                    ],
                    'gradient_angle' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}})',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}})',
                        ],
                    ],
                    'gradient_position' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}})',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}})',
                        ],
                    ],
                    'image' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-image: url("{{URL}}");',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-image: url("{{URL}}");',
                        ],
                    ],
                    'position' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-position: {{VALUE}};',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-position: {{VALUE}};',
                        ],
                    ],
                    'xpos' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-position: {{SIZE}}{{UNIT}} {{ypos.SIZE}}{{ypos.UNIT}}',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-position: {{SIZE}}{{UNIT}} {{ypos.SIZE}}{{ypos.UNIT}}',
                        ],
                    ],
                    'ypos' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-position: {{SIZE}}{{UNIT}} {{ypos.SIZE}}{{ypos.UNIT}}',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-position: {{SIZE}}{{UNIT}} {{ypos.SIZE}}{{ypos.UNIT}}',
                        ],
                    ],
                    'attachment' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode (desktop+){{SELECTOR}}' => 'background-attachment: {{VALUE}};',
                            '} body.geekfolio-dark-mode (desktop+){{SELECTOR}}' => 'background-attachment: {{VALUE}};',
                        ],
                    ],
                    'repeat' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-repeat: {{VALUE}};',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-repeat: {{VALUE}};',
                        ],
                    ],
                    'size' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-size: {{VALUE}};',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-size: {{VALUE}};',
                        ],
                    ],
                    'bg_width' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-size: {{SIZE}}{{UNIT}} auto',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-size: {{SIZE}}{{UNIT}} auto',
                        ],
                    ],
                    'video_fallback' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background: url("{{URL}}") 50% 50%; background-size: cover;',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background: url("{{URL}}") 50% 50%; background-size: cover;',
                        ],
                    ],
                ]
			]
		);

		$element->end_controls_tab();

		$element->start_controls_tab(
			'_tab_background_hover',
			[
				'label' => esc_html__( 'Hover', 'elementor' ),
			]
		);

		$element->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'geekfolio_element_background_hover_darkmode',
				'selector' => '{{WRAPPER}}:hover .elementor-widget-container',
                'fields_options' => [
                    'color' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-color: {{VALUE}};',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-color: {{VALUE}};',
                        ],
                    ],
                    'gradient_angle' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}})',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}})',
                        ],
                    ],
                    'gradient_position' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}})',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}})',
                        ],
                    ],
                    'image' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-image: url("{{URL}}");',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-image: url("{{URL}}");',
                        ],
                    ],
                    'position' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-position: {{VALUE}};',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-position: {{VALUE}};',
                        ],
                    ],
                    'xpos' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-position: {{SIZE}}{{UNIT}} {{ypos.SIZE}}{{ypos.UNIT}}',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-position: {{SIZE}}{{UNIT}} {{ypos.SIZE}}{{ypos.UNIT}}',
                        ],
                    ],
                    'ypos' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-position: {{SIZE}}{{UNIT}} {{ypos.SIZE}}{{ypos.UNIT}}',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-position: {{SIZE}}{{UNIT}} {{ypos.SIZE}}{{ypos.UNIT}}',
                        ],
                    ],
                    'attachment' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode (desktop+){{SELECTOR}}' => 'background-attachment: {{VALUE}};',
                            '} body.geekfolio-dark-mode (desktop+){{SELECTOR}}' => 'background-attachment: {{VALUE}};',
                        ],
                    ],
                    'repeat' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-repeat: {{VALUE}};',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-repeat: {{VALUE}};',
                        ],
                    ],
                    'size' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-size: {{VALUE}};',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-size: {{VALUE}};',
                        ],
                    ],
                    'bg_width' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background-size: {{SIZE}}{{UNIT}} auto',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background-size: {{SIZE}}{{UNIT}} auto',
                        ],
                    ],
                    'video_fallback' => [
                        'selectors' => [
                            '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{SELECTOR}}' => 'background: url("{{URL}}") 50% 50%; background-size: cover;',
                            '} body.geekfolio-dark-mode {{SELECTOR}}' => 'background: url("{{URL}}") 50% 50%; background-size: cover;',
                        ],
                    ],
                ]
			]
		);

		$element->end_controls_tab();

		$element->end_controls_tabs();

    }

    /**
     * Column Controls
     */
    public function register_section_controls( $element ) { 

        $element->add_control(
            'geekfolio_section_border_color_dark_mode', 
            [
                'label' => esc_html__( 'Border Color (Dark Mode)', 'geekfolio_plg' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}}' => 'border-color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}}' => 'border-color: {{VALUE}};',
				],
            ]
        );

    }

    /**
     * Column Controls
     */
    public function register_column_controls( $element ) { 

        $element->add_control(
            'geekfolio_column_border_color_dark_mode', 
            [
                'label' => esc_html__( 'Border Color (Dark Mode)', 'geekfolio_plg' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} > .elementor-element-populated' => 'border-color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} > .elementor-element-populated' => 'border-color: {{VALUE}};',
				],
            ]
        );

    }

    /**
     * Common Controls
     */
    public function register_common_border_controls( $element ) {

        $element->add_control(
            'geekfolio_border_color_dark_mode', 
            [
                'label' => esc_html__( 'Border Color (Dark Mode)', 'geekfolio_plg' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} > .elementor-widget-container' => 'border-color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} > .elementor-widget-container' => 'border-color: {{VALUE}};',
				],
            ]
        );

    }

    /**
     * Divider Controls
     */
    public function register_divider_controls( $element ) {
        

        $element->start_controls_section(
            'geekfolio_dark_mode_section',
            [
                'label'         => esc_html__( 'Dark Mode Style', 'geekfolio_plg' ),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $element->add_control(
            'geekfolio_color_dark_mode', 
            [
                'label' => esc_html__( 'Color', 'geekfolio_plg' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}}' => '--divider-color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}}' => '--divider-color: {{VALUE}};',
				],
            ]
        );

        $element->end_controls_section();

    }

    /**
     * Icon Controls
     */
    public function register_icon_controls( $element ) {
        

        $element->start_controls_section(
            'geekfolio_dark_mode_section',
            [
                'label'         => esc_html__( 'Dark Mode Style', 'geekfolio_plg' ),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $element->add_control(
            'geekfolio_icon_color_dark_mode', 
            [
                'label' => esc_html__( 'Color', 'geekfolio_plg' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}};',
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}}.elementor-view-framed .elementor-icon' => 'color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}}.elementor-view-framed .elementor-icon' => 'color: {{VALUE}};',
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}}.elementor-view-default .elementor-icon' => 'color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}}.elementor-view-default .elementor-icon' => 'color: {{VALUE}};',
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}}.elementor-view-framed .elementor-icon' => 'fill: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}}.elementor-view-framed .elementor-icon' => 'fill: {{VALUE}};',
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}}.elementor-view-default .elementor-icon svg' => 'fill: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}}.elementor-view-default .elementor-icon svg' => 'fill: {{VALUE}};',
				],
            ]
        );

        $element->end_controls_section();

    }
};
new Geekfolio_Dark_Mode_Controls();