<?php

namespace GeekfolioPlugin\Widgets;

use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Utils;
use Elementor\Plugin;
use Elementor\Frontend;
use Elementor\Icons_Manager;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Image_Size;
use Elementor\Scheme_Base;
use Elementor\Repeater;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;


if (!defined('ABSPATH')) exit; // Exit if accessed directly



/**
 * @since 1.0.0
 */
class Geekfolio_Testimonials_Cards extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'geekfolio-testimonials-cards';
	}


	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return __('Geekfolio Testimonials Cards', 'geekfolio_plg');
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-testimonial-carousel';
	}

    public function get_script_depends()
    {
        return ['wow', 'custom-scripts', 'jquery-swiper', 'jquery-swiper-controls'];
    }

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return ['geekfolio-elements'];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */

	protected function register_controls(){
		$this->start_controls_section(
            'content',
            [
                'label' => __('Content', 'geekfolio_plg')
            ]
        );

		$this->add_control(
			'layout',
			[
				'label' => __('Layout', 'geekfolio_plg'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'swiper' => __('Swiper', 'geekfolio_plg'),
					'marquee' => __('Marquee', 'geekfolio_plg'),
					'cards' => __('Cards', 'geekfolio_plg')
				],
				'default' => 'swiper'
			]
		);

		$this->add_control(
			'items_per_slide',
			[
				'label' => __('Items Per Slide', 'geekfolio_plg'),
				'type' => Controls_Manager::NUMBER,
				'default' => '3',
				'min' => '0',
				'step' => '1',
			]
		);

		$this->add_control(
			'space',
			[
				'label' => __('Space', 'geekfolio_plg'),
				'type' => Controls_Manager::NUMBER,
				'default' => '30',
				'min' => '0',
				'max' => '100',
				'step' => '1'
			]
		);
		$this->add_control(
			'heading_show',
			[
				'label' => __('Heading Show', 'geekfolio_plg'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'geekfolio_plg'),
				'label_off' => __('Hide', 'geekfolio_plg'),
				'return_value' => 'yes',
				'default' => ''
			]
		);

		$this->add_control(
			'controls_show',
			[
				'label' => __('Controls Show', 'geekfolio_plg'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'geekfolio_plg'),
				'label_off' => __('Hide', 'geekfolio_plg'),
				'return_value' => 'yes',
				'default' => 'yes'
			]
		);

		$this->add_control(
			'center_slides',
			[
				'label' => __('Centeralized Slides', 'geekfolio_plg'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'geekfolio_plg'),
				'label_off' => __('Hide', 'geekfolio_plg'),
				'return_value' => 'yes',
				'default' => ''
			]
		);

		$this->add_control(
			'heading_pos',
			[
				'label' => __('Heading Position', 'geekfolio_plg'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'onTop' => __('Default', 'geekfolio_plg'),
					'onSide' => __('On Side', 'geekfolio_plg')
				],
				'default' => 'onTop'
			]
		);

		$this->add_control(
			'heading',
			[
				'label' => __('Heading', 'geekfolio_plg'),
				'type' => Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'sub-heading',
			[
				'label' => __('Sub Heading', 'geekfolio_plg'),
				'type' => Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'controls_position',
			[
				'label' => __('Controls Position', 'geekfolio_plg'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'on_the_top' => __('Default', 'geekfolio_plg'),
					'uHeading' => __('Under Heading', 'geekfolio_plg'),

				],
				'default' => 'on_the_top'
			]
		);

        $repeater = new Repeater();

        $repeater->add_control(
			'rating',
			[
				'label' => __('Rating Stars', 'geekfolio_plg'),
				'type' => Controls_Manager::NUMBER,
				'max' => '5',
				'default' => '5',
				'step' => '1',
			]
		);

        $repeater->add_control(
            'quote',
            [
                'label' => __('Quote', 'geekfolio_plg'),
                'default' => __('I have been hiring people in this space for a number of years and I have never seen this level of professionalism.', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXTAREA
            ]
        );

        $repeater->add_control(
            'author_name',
            [
                'label' => __('Author Name', 'geekfolio_plg'),
                'default' => __('adrian parody', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT
            ]
        );

        $repeater->add_control(
            'author_position',
            [
                'label' => __('Position', 'geekfolio_plg'),
                'default' => __('Co-Founder', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT
            ]
        );

        $repeater->add_control(
            'author_photo',
            [
                'label' => __('Author Photo', 'geekfolio_plg'),
                'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
            ]
        );

        $this->add_control(
			'sliders',
			[
				'label' => __('Sliders', 'geekfolio_plg'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
                'default' => [
					[
						'author_name' => esc_html__( 'adrian parody', 'textdomain' ),
						'author_position' => esc_html__( 'Co-Founder', 'textdomain' ),
					],
					[
						'author_name' => esc_html__( 'adrian parody', 'textdomain' ),
						'author_position' => esc_html__( 'Co-Founder', 'textdomain' ),
					],
				],
                'title_field' => '{{{author_name}}}'
			]
		);
        $this->end_controls_section();

		

		$this->start_controls_section(
            'image_styles',
            [
                'label' => __('Image Styles', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_responsive_control(
			'width',
			[
				'label' => esc_html__( 'Width', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 150,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-testimonials-cards .avatar' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label' => esc_html__( 'Height', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units' => [ 'px', 'vh', '%' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
					'%' => [
						'min' => 1,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-testimonials-cards .avatar' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();

		$this->start_controls_section(
			'quote_style',
			[
				'label' => esc_html('Quote Style', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'quote_color',
			[
				'label' => esc_html__('Quote Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-testimonials-cards .item .quote' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Quote Typography', 'geekfolio_plg'),
				'name' => 'quote_typography',
				'selector' => '{{WRAPPER}} .geekfolio-testimonials-cards .item .quote',
			]
		);

		$this->add_control(
			'quote_align',
			[
				'label' => __('Quote Align', 'geekfolio_plg'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'geekfolio_plg'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __('Center', 'geekfolio_plg'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __('Right', 'geekfolio_plg'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-testimonials-cards .item .quote' => 'text-align: {{VALUE}}'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
            'card_styles',
            [
                'label' => __('Card Styles', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
			'card_margin',
			[
				'label' => esc_html__('Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-testimonials-cards .item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-testimonials-cards .overlayed-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'card_padding',
			[
				'label' => esc_html__('Padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-testimonials-cards .item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-testimonials-cards .overlayed-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'card_border_radius',
			[
				'label' => esc_html__('Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-testimonials-cards .item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-testimonials-cards .overlayed-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'controls_margin',
			[
				'label' => esc_html__('Controls Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-testimonials-cards .swiper-controls' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'card_width',
			[
				'label' => esc_html__( 'Width', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 150,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-testimonials-cards .item' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-testimonials-cards .overlayed-item' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);


        $this->start_controls_tabs('card_tabs');
        $this->start_controls_tab(
            'normal_card',
            [
                'label' => __('Normal', 'geekfolio_plg'),
            ]
        );
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'card_background',
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .geekfolio-testimonials-cards .item , .geekfolio-testimonials-cards .overlayed-item',
            ]
		);
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'card_border',
				'selector' => '{{WRAPPER}} .geekfolio-testimonials-cards .item , .geekfolio-testimonials-cards .overlayed-item',
			]
		);

        $this->add_control(
            'card_border_color_dark',
            [
                'label' => __('Card Border Color ( Dark Mode )', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-testimonials-cards .item , .geekfolio-testimonials-cards .overlayed-item' => 'border-color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-testimonials-cards .item , .geekfolio-testimonials-cards .overlayed-item' => 'border-color: {{VALUE}};',
				],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'hover_card',
            [
                'label' => __('Hover', 'geekfolio_plg')
            ]
        );
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'card_background_hover',
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .geekfolio-testimonials-cards .item:hover , .geekfolio-testimonials-cards .overlayed-item:hover',
            ]
		);
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'card_border_hover',
				'selector' => '{{WRAPPER}} .geekfolio-testimonials-cards .item:hover , .geekfolio-testimonials-cards .overlayed-item:hover',
			]
		);
        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->end_controls_section();

		$this->start_controls_section(
			'client_style',
			[
				'label' => esc_html('Client Style', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'client_arrow_color',
			[
				'label' => esc_html__('Arrow Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-testimonials-cards .item.info-left .arrow' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'client_name_color',
			[
				'label' => esc_html__('Client Name Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-testimonials-cards .item .info .name' => 'color: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-testimonials-cards .overlayed-item .name' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'client_position_color',
			[
				'label' => esc_html__('Client Position Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-testimonials-cards .item .info .position' => 'color: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-testimonials-cards .overlayed-item .position' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Client name Typography', 'geekfolio_plg'),
				'name' => 'client_name_typography',
				'selector' => '{{WRAPPER}} .geekfolio-testimonials-cards .item .info .name',
				'selector' => '{{WRAPPER}} .geekfolio-testimonials-cards .overlayed-item .name',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Client Position Typography', 'geekfolio_plg'),
				'name' => 'client_position_typography',
				'selector' => '{{WRAPPER}} .geekfolio-testimonials-cards .item .info .position',
				'selector' => '{{WRAPPER}} .geekfolio-testimonials-cards .overlayed-item .position',
			]
		);

		$this->add_control(
			'client_name_pos_align',
			[
				'label' => __('Client Name & Pos Align', 'geekfolio_plg'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'geekfolio_plg'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __('Center', 'geekfolio_plg'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __('Right', 'geekfolio_plg'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .client-info .item .info' => 'text-align: {{VALUE}}'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
            'stars_style',
            [
                'label' => __('Stars Style', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
			'stars_color',
			[
				'label' => esc_html__('Stars Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-testimonials-cards .item .rate' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Stars Typography', 'geekfolio_plg'),
				'name' => 'stars_typography',
				'selector' => '{{WRAPPER}} .geekfolio-testimonials-cards .item .rate i',
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'heading_styles',
			[
				'label' => __('Heading Styles', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
            'heading_color',
            [
                'label' => __('Color', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-testimonials-cards .heading' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'selector' => '{{WRAPPER}} .geekfolio-testimonials-cards .heading',
			]
		);

		$this->add_responsive_control(
			'heading_margin',
			[
				'label' => esc_html__('Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-testimonials-cards .heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'heading_padding',
			[
				'label' => esc_html__('Padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-testimonials-cards .heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'heading_border-rad',
			[
				'label' => esc_html__(' Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-testimonials-cards .heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'heading_border',
				'selector' => '{{WRAPPER}} .geekfolio-testimonials-cards .heading',
			]
		);

        $this->add_control(
            'heading_border_color_dark',
            [
                'label' => __('Item Border Color ( Dark Mode )', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-testimonials-cards .heading' => 'border-color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-testimonials-cards .heading' => 'border-color: {{VALUE}};',
				],
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'sub-heading_styles',
			[
				'label' => __('Sub Heading Styles', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
            'sub-heading_color',
            [
                'label' => __('Color', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-testimonials-cards .sub-heading' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'sub-heading_typography',
				'selector' => '{{WRAPPER}} .geekfolio-testimonials-cards .sub-heading',
			]
		);

		$this->add_responsive_control(
			'sub-heading_margin',
			[
				'label' => esc_html__('Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-testimonials-cards .sub-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'sub-heading_padding',
			[
				'label' => esc_html__('Padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-testimonials-cards .sub-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'sub-heading_border-rad',
			[
				'label' => esc_html__(' Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-testimonials-cards .sub-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'sub-heading_border',
				'selector' => '{{WRAPPER}} .geekfolio-testimonials-cards .sub-heading',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'arrows_styles',
			[
				'label' => __('Arrows Styles', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
            'arrows_color',
            [
                'label' => __('Color', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-testimonials-cards .swiper-controls .left svg path, {{WRAPPER}} .geekfolio-testimonials-cards .swiper-controls .right svg path' => 'fill: {{VALUE}}'
                ]
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'arrows_border',
				'selector' => '{{WRAPPER}} .geekfolio-testimonials-cards .swiper-controls .left, {{WRAPPER}} .geekfolio-testimonials-cards .swiper-controls .right',
			]
		);
		$this->end_controls_section();
	}

	protected function render(){
		$settings = $this->get_settings();
		?>

		<div class="geekfolio-testimonials-cards">
			<div class="<?php if($settings['layout'] != 'cards' ) echo 'row'; ?> <?php if($settings['heading_pos'] == 'onSide') echo 'align-items-center'; ?>">
				<?php if($settings['layout'] == 'swiper') : ?>
				<?php if($settings['heading_show'] == 'yes' && $settings['heading_pos'] == 'onTop') : ?>
				<div class="position-re col-md-<?php if($settings['controls_show'] == 'yes') echo '6'; else echo '12'; ?>">
					<h6 class="heading d-inline-block"><?php echo __($settings['heading'], 'geekfolio_plg'); ?></h6>
					<h2 class="sub-heading "><?php echo __($settings['sub-heading'], 'geekfolio_plg'); ?></h2>
					<?php if($settings['controls_position'] == 'uHeading') : ?>
						<?php if($settings['controls_show'] == 'yes') : ?>
						<div class="swiper-controls testim-controls d-flex  justify-end-sm full-width">
							<div class="d-flex ">
								<div class="swiper-button-prev">
									<span class="left">
										<svg width="20" height="20" viewBox="0 0 20 20" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path
												d="M17.2031 10.3281L11.5781 15.9531C11.535 15.9961 11.4839 16.0303 11.4276 16.0536C11.3713 16.077 11.3109 16.089 11.25 16.089C11.1891 16.089 11.1287 16.077 11.0724 16.0536C11.0161 16.0303 10.965 15.9961 10.9219 15.9531C10.8788 15.91 10.8446 15.8588 10.8213 15.8025C10.798 15.7462 10.786 15.6859 10.786 15.6249C10.786 15.564 10.798 15.5036 10.8213 15.4473C10.8446 15.391 10.8788 15.3399 10.9219 15.2968L15.7422 10.4687H3.125C3.00068 10.4687 2.88145 10.4193 2.79354 10.3314C2.70564 10.2435 2.65625 10.1242 2.65625 9.99993C2.65625 9.87561 2.70564 9.75638 2.79354 9.66847C2.88145 9.58056 3.00068 9.53118 3.125 9.53118H15.7422L10.9219 4.70305C10.8349 4.61603 10.786 4.498 10.786 4.37493C10.786 4.25186 10.8349 4.13383 10.9219 4.0468C11.0089 3.95978 11.1269 3.91089 11.25 3.91089C11.3731 3.91089 11.4911 3.95978 11.5781 4.0468L17.2031 9.6718C17.2476 9.71412 17.2829 9.76503 17.3071 9.82143C17.3313 9.87784 17.3438 9.93856 17.3438 9.99993C17.3438 10.0613 17.3313 10.122 17.3071 10.1784C17.2829 10.2348 17.2476 10.2857 17.2031 10.3281Z"
												fill="#1d1d1d"></path>
										</svg>
									</span>
								</div>
								<div class="swiper-button-next ml-50">
									<span class="right">
										<svg width="20" height="20" viewBox="0 0 20 20" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path
												d="M17.2031 10.3281L11.5781 15.9531C11.535 15.9961 11.4839 16.0303 11.4276 16.0536C11.3713 16.077 11.3109 16.089 11.25 16.089C11.1891 16.089 11.1287 16.077 11.0724 16.0536C11.0161 16.0303 10.965 15.9961 10.9219 15.9531C10.8788 15.91 10.8446 15.8588 10.8213 15.8025C10.798 15.7462 10.786 15.6859 10.786 15.6249C10.786 15.564 10.798 15.5036 10.8213 15.4473C10.8446 15.391 10.8788 15.3399 10.9219 15.2968L15.7422 10.4687H3.125C3.00068 10.4687 2.88145 10.4193 2.79354 10.3314C2.70564 10.2435 2.65625 10.1242 2.65625 9.99993C2.65625 9.87561 2.70564 9.75638 2.79354 9.66847C2.88145 9.58056 3.00068 9.53118 3.125 9.53118H15.7422L10.9219 4.70305C10.8349 4.61603 10.786 4.498 10.786 4.37493C10.786 4.25186 10.8349 4.13383 10.9219 4.0468C11.0089 3.95978 11.1269 3.91089 11.25 3.91089C11.3731 3.91089 11.4911 3.95978 11.5781 4.0468L17.2031 9.6718C17.2476 9.71412 17.2829 9.76503 17.3071 9.82143C17.3313 9.87784 17.3438 9.93856 17.3438 9.99993C17.3438 10.0613 17.3313 10.122 17.3071 10.1784C17.2829 10.2348 17.2476 10.2857 17.2031 10.3281Z"
												fill="#1d1d1d"></path>
										</svg>
									</span>
								</div>
							</div>
						</div>
					<?php endif; ?>
					<?php endif; ?>
				</div>
				<?php endif; ?>
				<?php if($settings['controls_show'] == 'yes') : ?>
				<?php if($settings['controls_position'] == 'on_the_top') : ?>
				<div class="col-md-<?php if($settings['heading_show'] == 'yes' && $settings['heading_pos'] == 'onTop') echo '6'; else echo '12'; ?> text-lg-end text-md-end valign">
				<div class="swiper-controls testim-controls d-flex justify-content-end justify-end-sm full-width">
						<div class="d-flex ">
							<div class="swiper-button-prev">
								<span class="left">
									<svg width="20" height="20" viewBox="0 0 20 20" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path
											d="M17.2031 10.3281L11.5781 15.9531C11.535 15.9961 11.4839 16.0303 11.4276 16.0536C11.3713 16.077 11.3109 16.089 11.25 16.089C11.1891 16.089 11.1287 16.077 11.0724 16.0536C11.0161 16.0303 10.965 15.9961 10.9219 15.9531C10.8788 15.91 10.8446 15.8588 10.8213 15.8025C10.798 15.7462 10.786 15.6859 10.786 15.6249C10.786 15.564 10.798 15.5036 10.8213 15.4473C10.8446 15.391 10.8788 15.3399 10.9219 15.2968L15.7422 10.4687H3.125C3.00068 10.4687 2.88145 10.4193 2.79354 10.3314C2.70564 10.2435 2.65625 10.1242 2.65625 9.99993C2.65625 9.87561 2.70564 9.75638 2.79354 9.66847C2.88145 9.58056 3.00068 9.53118 3.125 9.53118H15.7422L10.9219 4.70305C10.8349 4.61603 10.786 4.498 10.786 4.37493C10.786 4.25186 10.8349 4.13383 10.9219 4.0468C11.0089 3.95978 11.1269 3.91089 11.25 3.91089C11.3731 3.91089 11.4911 3.95978 11.5781 4.0468L17.2031 9.6718C17.2476 9.71412 17.2829 9.76503 17.3071 9.82143C17.3313 9.87784 17.3438 9.93856 17.3438 9.99993C17.3438 10.0613 17.3313 10.122 17.3071 10.1784C17.2829 10.2348 17.2476 10.2857 17.2031 10.3281Z"
											fill="#1d1d1d"></path>
									</svg>
								</span>
							</div>
							<div class="swiper-button-next ml-50">
								<span class="right">
									<svg width="20" height="20" viewBox="0 0 20 20" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path
											d="M17.2031 10.3281L11.5781 15.9531C11.535 15.9961 11.4839 16.0303 11.4276 16.0536C11.3713 16.077 11.3109 16.089 11.25 16.089C11.1891 16.089 11.1287 16.077 11.0724 16.0536C11.0161 16.0303 10.965 15.9961 10.9219 15.9531C10.8788 15.91 10.8446 15.8588 10.8213 15.8025C10.798 15.7462 10.786 15.6859 10.786 15.6249C10.786 15.564 10.798 15.5036 10.8213 15.4473C10.8446 15.391 10.8788 15.3399 10.9219 15.2968L15.7422 10.4687H3.125C3.00068 10.4687 2.88145 10.4193 2.79354 10.3314C2.70564 10.2435 2.65625 10.1242 2.65625 9.99993C2.65625 9.87561 2.70564 9.75638 2.79354 9.66847C2.88145 9.58056 3.00068 9.53118 3.125 9.53118H15.7422L10.9219 4.70305C10.8349 4.61603 10.786 4.498 10.786 4.37493C10.786 4.25186 10.8349 4.13383 10.9219 4.0468C11.0089 3.95978 11.1269 3.91089 11.25 3.91089C11.3731 3.91089 11.4911 3.95978 11.5781 4.0468L17.2031 9.6718C17.2476 9.71412 17.2829 9.76503 17.3071 9.82143C17.3313 9.87784 17.3438 9.93856 17.3438 9.99993C17.3438 10.0613 17.3313 10.122 17.3071 10.1784C17.2829 10.2348 17.2476 10.2857 17.2031 10.3281Z"
											fill="#1d1d1d"></path>
									</svg>
								</span>
							</div>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<?php endif; ?>
				<?php endif; ?>

				<?php if($settings['heading_show'] == 'yes' && $settings['heading_pos'] == 'onSide'): ?>
					<div class="position-re col-lg-4 col-sm-12">
						<h6 class="heading d-inline-block"><?php echo __($settings['heading'], 'geekfolio_plg'); ?></h6>
						<h2 class="sub-heading "><?php echo __($settings['sub-heading'], 'geekfolio_plg'); ?></h2>
						<?php if($settings['controls_position'] == 'uHeading') : ?>
						<?php if($settings['controls_show'] == 'yes') : ?>
							<div class="swiper-controls testim-controls d-flex  justify-end-sm full-width">
							<div class="d-flex ">
								<div class="swiper-button-prev">
									<span class="left">
										<svg width="20" height="20" viewBox="0 0 20 20" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path
												d="M17.2031 10.3281L11.5781 15.9531C11.535 15.9961 11.4839 16.0303 11.4276 16.0536C11.3713 16.077 11.3109 16.089 11.25 16.089C11.1891 16.089 11.1287 16.077 11.0724 16.0536C11.0161 16.0303 10.965 15.9961 10.9219 15.9531C10.8788 15.91 10.8446 15.8588 10.8213 15.8025C10.798 15.7462 10.786 15.6859 10.786 15.6249C10.786 15.564 10.798 15.5036 10.8213 15.4473C10.8446 15.391 10.8788 15.3399 10.9219 15.2968L15.7422 10.4687H3.125C3.00068 10.4687 2.88145 10.4193 2.79354 10.3314C2.70564 10.2435 2.65625 10.1242 2.65625 9.99993C2.65625 9.87561 2.70564 9.75638 2.79354 9.66847C2.88145 9.58056 3.00068 9.53118 3.125 9.53118H15.7422L10.9219 4.70305C10.8349 4.61603 10.786 4.498 10.786 4.37493C10.786 4.25186 10.8349 4.13383 10.9219 4.0468C11.0089 3.95978 11.1269 3.91089 11.25 3.91089C11.3731 3.91089 11.4911 3.95978 11.5781 4.0468L17.2031 9.6718C17.2476 9.71412 17.2829 9.76503 17.3071 9.82143C17.3313 9.87784 17.3438 9.93856 17.3438 9.99993C17.3438 10.0613 17.3313 10.122 17.3071 10.1784C17.2829 10.2348 17.2476 10.2857 17.2031 10.3281Z"
												fill="#1d1d1d"></path>
										</svg>
									</span>
								</div>
								<div class="swiper-button-next ml-50">
									<span class="right">
										<svg width="20" height="20" viewBox="0 0 20 20" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path
												d="M17.2031 10.3281L11.5781 15.9531C11.535 15.9961 11.4839 16.0303 11.4276 16.0536C11.3713 16.077 11.3109 16.089 11.25 16.089C11.1891 16.089 11.1287 16.077 11.0724 16.0536C11.0161 16.0303 10.965 15.9961 10.9219 15.9531C10.8788 15.91 10.8446 15.8588 10.8213 15.8025C10.798 15.7462 10.786 15.6859 10.786 15.6249C10.786 15.564 10.798 15.5036 10.8213 15.4473C10.8446 15.391 10.8788 15.3399 10.9219 15.2968L15.7422 10.4687H3.125C3.00068 10.4687 2.88145 10.4193 2.79354 10.3314C2.70564 10.2435 2.65625 10.1242 2.65625 9.99993C2.65625 9.87561 2.70564 9.75638 2.79354 9.66847C2.88145 9.58056 3.00068 9.53118 3.125 9.53118H15.7422L10.9219 4.70305C10.8349 4.61603 10.786 4.498 10.786 4.37493C10.786 4.25186 10.8349 4.13383 10.9219 4.0468C11.0089 3.95978 11.1269 3.91089 11.25 3.91089C11.3731 3.91089 11.4911 3.95978 11.5781 4.0468L17.2031 9.6718C17.2476 9.71412 17.2829 9.76503 17.3071 9.82143C17.3313 9.87784 17.3438 9.93856 17.3438 9.99993C17.3438 10.0613 17.3313 10.122 17.3071 10.1784C17.2829 10.2348 17.2476 10.2857 17.2031 10.3281Z"
												fill="#1d1d1d"></path>
										</svg>
									</span>
								</div>
							</div>
							</div>
						<?php endif; ?>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<?php if($settings['layout'] == 'cards') : ?>
					<div class="row">
				<?php else: ?>
				<div class=" col-sm-12 col-lg-<?php if($settings['heading_show'] == 'yes' && $settings['heading_pos'] == 'onSide') echo '8'; else '12 mt-80'; ?>">
				<?php endif; ?>
					<?php if($settings['layout'] == 'swiper') : ?>
						<div class="swiper-container" data-space="<?php echo esc_attr($settings['space']); ?>" data-centered="<?php echo esc_attr($settings['center_slides']); ?>" data-items="<?php echo esc_attr($settings['items_per_slide']); ?>">
							<div class="swiper-wrapper">
					<?php endif; ?>
					<?php if($settings['layout'] == 'marquee') : ?>
						<div class="main-marqv">
							<div class="slide-vertical st1">
								<div class="box">
					<?php endif; ?>
							<?php foreach ($settings['sliders'] as $index => $item) :
								if($settings['layout'] == 'swiper') : ?>
								<div class="swiper-slide wow fadeIn">
								<?php endif; ?>
								<?php if($settings['layout'] == 'cards') : ?>
									<div class="col-lg-4">
										<?php endif; ?>
									<div class="item">
										<div class="cont mb-40">
											<div class="rate-stars mb-20 fz-14">
												<span class="rate">
													<?php
													$a = 1;
													while ($a <= $item['rating']) {
														echo '<i class="fas fa-star me-1"></i>';
														$a++;
													}
													?>
												</span>
											</div>
											<p class="quote"><?php echo __($item['quote'], 'geekfolio_plg'); ?></p>
										</div>
										<div class="d-flex align-items-center">
											<div>
												<div class="avatar">
													<img src="<?php echo esc_url($item['author_photo']['url']); ?>" alt="avatar">
												</div>
											</div>
											<div class="ml-30">
												<div class="info">
													<h6 class="name"><?php echo __($item['author_name'], 'geekfolio_plg'); ?></h6>
													<span class="position"><?php echo __($item['author_position'], 'geekfolio_plg'); ?></span>
												</div>
											</div>
										</div>
									</div>
								<?php if($settings['layout'] == 'swiper') : ?>
								</div>
								<?php endif; ?>
								<?php if($settings['layout'] == 'cards') : ?>
								</div>
								<?php endif; ?>
							<?php endforeach; ?>

							<?php if($settings['layout'] == 'swiper') : ?>
							</div>
						</div>
						<?php endif; ?>
						<?php if($settings['layout'] == 'marquee') : ?>
							</div>
							<div class="box">
							<?php foreach ($settings['sliders'] as $index => $item) : ?>
									<div class="item">
										<div class="cont mb-40">
											<div class="rate-stars mb-20 fz-14">
												<span class="rate">
													<?php
													$a = 1;
													while ($a <= $item['rating']) {
														echo '<i class="fas fa-star me-1"></i>';
														$a++;
													}
													?>
												</span>
											</div>
											<p class="quote"><?php echo __($item['quote'], 'geekfolio_plg'); ?></p>
										</div>
										<div class="d-flex align-items-center">
											<div>
												<div class="avatar">
													<img src="<?php echo esc_url($item['author_photo']['url']); ?>" alt="avatar">
												</div>
											</div>
											<div class="ml-30">
												<div class="info">
													<h6 class="name"><?php echo __($item['author_name'], 'geekfolio_plg'); ?></h6>
													<span class="position"><?php echo __($item['author_position'], 'geekfolio_plg'); ?></span>
												</div>
											</div>
										</div>
									</div>
							<?php endforeach; ?>
							</div>
							</div>
							</div>
						<?php endif; ?>
				</div>
			</div>
			</div>
		<?php
	}
}