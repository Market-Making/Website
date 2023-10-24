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
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;


if (!defined('ABSPATH')) exit; // Exit if accessed directly



/**
 * @since 1.0.0
 */
class Geekfolio_Button extends Widget_Base
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
		return 'geekfolio-button';
	}

	public function get_script_depends()
    {
        return ['lity'];
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
		return __('Geekfolio Button', 'geekfolio_plg');
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
		return 'eicon-button';
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
	protected function _register_controls()
	{

		$this->start_controls_section(
			'section_content',
			[
				'label' => __('Button Settings', 'geekfolio_plg'),
			]
		);

		$this->add_control(
            'btn_type',
            [
				'label'         => __( 'Button Type', 'geekfolio_plg' ),
				'type'          => Controls_Manager::SELECT,
				'options' => [
					'normal' => esc_html__('Normal', 'geekfolio_plg'),
					'icon' => esc_html__('Icon Button', 'geekfolio_plg'),
				],
				'default'  		=> 'normal',
			]
        );

		
		$this->add_control(
			'video_popup',
			[
				'label' => __('Video Popup', 'geekfolio_plg'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'geekfolio_plg' ),
				'label_off' => __( 'No', 'geekfolio_plg' ),
				'default' => '',
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label' => __('Button Text', 'geekfolio_plg'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
				'default' => 'Click now',
				'condition' => [
					'btn_type' => 'normal'
				]
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __('Button Link', 'geekfolio_plg'),
				'type' => Controls_Manager::URL,
				'placeholder' => 'Leave Link here',
			]
		);
		$this->add_control(
			'button_alignment',
			[
				'label' => __('Button Text Alignment', 'geekfolio_plg'),
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
				'prefix_class' => 'elementor-align-',
				'default' => 'left',
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label' => esc_html__('Icon', 'geekfolio_plg'),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin' => 'inline',
				'label_block' => false,
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label' => esc_html__('Icon Position', 'geekfolio_plg'),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__('Before', 'geekfolio_plg'),
					'right' => esc_html__('After', 'geekfolio_plg'),
				],
				'condition' => [
					'selected_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label' => esc_html__('Icon Spacing', 'geekfolio_plg'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-button .geekfolio-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-button .geekfolio-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_position_end',
			[
				'label' => esc_html__( 'Icon Position End', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'geekfolio_plg' ),
				'label_off' => esc_html__( 'Off', 'geekfolio_plg' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'circle_bg',
			[
				'label' => esc_html__( 'Circle Backgorund', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'geekfolio_plg' ),
				'label_off' => esc_html__( 'Off', 'geekfolio_plg' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'additional_border',
			[
				'label' => esc_html__( 'Additional Border', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'geekfolio_plg' ),
				'label_off' => esc_html__( 'Off', 'geekfolio_plg' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'view',
			[
				'label' => esc_html__('View', 'geekfolio_plg'),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->add_control(
			'button_css_id',
			[
				'label' => esc_html__('Button ID', 'geekfolio_plg'),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => '',
				'title' => esc_html__('Add your custom id WITHOUT the Pound key. e.g: my-id', 'elementor'),
				'description' => sprintf(
					/* translators: %1$s Code open tag, %2$s: Code close tag. */
					esc_html__('Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows %1$sA-z 0-9%2$s & underscore chars without spaces.', 'elementor'),
					'<code>',
					'</code>'
				),
				'separator' => 'before',

			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__('Button', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_display',
			[
				'label' => esc_html__('Button Display Type', 'geekfolio_plg'),
				'type' => Controls_Manager::SELECT,
				'default' => 'inline-block',
				'options' => [
					'block' => esc_html__('Block', 'geekfolio_plg'),
					'inline-block' => esc_html__('Inline Block', 'geekfolio_plg'),
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-button' => 'display: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .geekfolio-button',
			]
		);

		$this->start_controls_tabs('tabs_button_style');

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__('Normal', 'geekfolio_plg'),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .geekfolio-button',
				'condition' => [
					'btn_type' => 'normal'
				]
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-button' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
				'condition' => [
					'btn_type' => 'normal'
				]
			]
		);

		$this->add_control(
			'button_text_color_dark_mode',
			[
				'label' => esc_html__( 'Text Color (Dark Mode)', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-button' => 'color: {{VALUE}}; fill: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-button' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
				'condition' => [
					'btn_type' => 'normal'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__('Background', 'geekfolio_plg'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .geekfolio-button, {{WRAPPER}} .geekfolio-button.reverse .btn-animated-gr',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
					'color' => [
						'selectors' => [
							'{{SELECTOR}}' => 'background: {{color.VALUE}}; background-image: none;',
						],
					],
				],
			]
		);

		$this->add_control(
			'button_background_dark_mode',
			[
				'label' => esc_html__( 'Background (Dark Mode)', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-button' => 'background: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-button' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .geekfolio-button',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .geekfolio-button',
				'separator' => 'before',
			]
		);

        $this->add_control(
            'border_color_dark',
            [
                'label' => __('Border Color ( Dark Mode )', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-button' => 'border-color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-button' => 'border-color: {{VALUE}};',
				],
            ]
        );

		$this->add_control(
			'border_radius',
			[
				'label' => esc_html__('Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-button.addi-border:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-button .btn-animated-gr' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
					'{{WRAPPER}} .geekfolio-button' => 'width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .geekfolio-button' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__('Hover', 'geekfolio_plg'),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_hover',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .geekfolio-button:hover, {{WRAPPER}} .geekfolio-button:focus',
				'condition' => [
					'btn_type' => 'normal'
				]
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => esc_html__('Text Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-button:hover, {{WRAPPER}} .geekfolio-button:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-button:hover svg, {{WRAPPER}} .geekfolio-button:focus svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_button_text_color_dark_mode',
			[
				'label' => esc_html__( 'Text Color (Dark Mode)', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-button:hover' => 'color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-button:hover' => 'color: {{VALUE}};',
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-button:focus' => 'color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-button:focus' => 'color: {{VALUE}};',
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-button:hover svg' => 'fill: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-button:hover svg' => 'fill: {{VALUE}};',
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-button:focus svg' => 'fill: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-button:focus svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'btn_type' => 'normal'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_background_hover',
				'label' => esc_html__('Background', 'geekfolio_plg'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .geekfolio-button:hover, {{WRAPPER}} .geekfolio-button:focus, {{WRAPPER}} .geekfolio-button .btn-animated-gr, {{WRAPPER}} .geekfolio-button:focus .btn-animated-gr',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
					'color' => [
						'selectors' => [
							'{{SELECTOR}}' => 'background: {{color.VALUE}}; background-image: none;',
						],
					],
				],
			]
		);

		$this->add_control(
			'button_background_hover_dark_mode',
			[
				'label' => esc_html__( 'Background (Dark Mode)', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-button:hover' => 'background: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-button:hover' => 'background: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_hover',
				'selector' => '{{WRAPPER}} .geekfolio-button:hover',
				'separator' => 'before',
			]
		);

        $this->add_control(
            'border_color_hover_dark',
            [
                'label' => __('Border Color ( Dark Mode )', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-button:hover' => 'border-color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-button:hover' => 'border-color: {{VALUE}};',
				],
            ]
        );

		$this->add_control(
			'border_radius_hover',
			[
				'label' => esc_html__('Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-button:hover .btn-animated-gr' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .geekfolio-button:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'text_padding',
			[
				'label' => esc_html__('Padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => esc_html__('Button Icon', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'selected_icon!' => '',
				]
			]
		);

		$this->start_controls_tabs('tabs_button_icon_style');

		$this->start_controls_tab(
			'tab_button_icon',
			[
				'label' => esc_html__('Normal', 'geekfolio_plg'),
			]
		);

		$this->add_control(
			'button_icon_color',
			[
				'label' => __('Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-button .geekfolio-button-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-button .geekfolio-button-icon svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-button .geekfolio-button-icon svg path' => 'fill: {{VALUE}};',
				],
			]
		);

        $this->add_control(
            'button_icon_color_dark',
            [
                'label' => __('Icon Color ( Dark Mode )', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-button .geekfolio-button-icon' => 'color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-button .geekfolio-button-icon' => 'color: {{VALUE}};',
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-button .geekfolio-button-icon svg' => 'fill: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-button .geekfolio-button-icon svg' => 'fill: {{VALUE}};',
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-button .geekfolio-button-icon svg path' => 'fill: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-button .geekfolio-button-icon svg path' => 'fill: {{VALUE}};',
				],
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_icon_background',
				'label' => __('Button Icon Background', 'geekfolio_plg'),
				'types' => [ 'classic','gradient' ],
				'selector' => '{{WRAPPER}} .geekfolio-button .geekfolio-button-icon',
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'selector' => '{{WRAPPER}} .geekfolio-button .geekfolio-button-icon',
				'separator' => 'before',
			]
		);

        $this->add_control(
            'icon_border_color_dark',
            [
                'label' => __('Border Color ( Dark Mode )', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-button .geekfolio-button-icon' => 'border-color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-button .geekfolio-button-icon' => 'border-color: {{VALUE}};',
				],
            ]
        );

		$this->add_control(
			'icon_border_radius',
			[
				'label' => esc_html__('Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-button .geekfolio-button-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_icon_box_shadow',
				'selector' => '{{WRAPPER}} .geekfolio-button .geekfolio-button-icon',
			]
		);
		
		$this->add_control(
			'button_icon_margin',
			[
				'label' => esc_html__('Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-button .geekfolio-button-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_icon_hover',
			[
				'label' => esc_html__('Hover', 'geekfolio_plg'),
			]
		);

		$this->add_control(
			'button_icon_background_color_hover',
			[
				'label' => __('Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-button:hover .geekfolio-button-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_icon_background_hover',
				'label' => __('Button Icon Background', 'geekfolio_plg'),
				'types' => [ 'classic','gradient' ],
				'selector' => '{{WRAPPER}} .geekfolio-button:hover .geekfolio-button-icon',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_border_hover',
				'selector' => '{{WRAPPER}} .geekfolio-button:hover .geekfolio-button-icon',
				'separator' => 'before',
			]
		);

        $this->add_control(
            'icon_border_color_dark',
            [
                'label' => __('Border Color ( Dark Mode )', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-button:hover .geekfolio-button-icon' => 'border-color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-button:hover .geekfolio-button-icon' => 'border-color: {{VALUE}};',
				],
            ]
        );

		$this->add_control(
			'icon_border_radius_hover',
			[
				'label' => esc_html__('Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-button:hover .geekfolio-button-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_icon_box_shadow_hover',
				'selector' => '{{WRAPPER}} .geekfolio-button:hover .geekfolio-button-icon',
			]
		);

		$this->add_control(
			'button_icon_animation_hover',
			[
				'label' => esc_html__('Icon Animation', 'geekfolio_plg'),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__('None', 'geekfolio_plg'),
					'right-to-left' => esc_html__('Right to Left', 'geekfolio_plg'),
				],
			]
		);
		
		$this->add_control(
			'button_icon_margin_hover',
			[
				'label' => esc_html__('Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-button:hover .geekfolio-button-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'button_icon_wrapper',
			[
				'label' => esc_html__( 'Icon Wrapper', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-button .geekfolio-button-icon' => 'line-height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; text-align: center;',
					'{{WRAPPER}} .geekfolio-button .geekfolio-button-icon i' => 'line-height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		

		$this->add_control(
			'button_icon_size',
			[
				'label' => esc_html__( 'Icon size', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-button .geekfolio-button-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-button .geekfolio-button-icon svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'button_icon_padding',
			[
				'label' => esc_html__('Padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-button .geekfolio-button-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'drop_shadow',
			[
				'label' => esc_html__('Drop Shadow', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'drop_shadow_offset_x',
			[
				'label' => esc_html__('Offset x', 'geekfolio_plg'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 200,
						'min' => 0,
						'step' => 1,
					],
				],
                'render_type' => 'ui',
			]
		);

		$this->add_control(
			'drop_shadow_offset_y',
			[
				'label' => esc_html__('Offset y', 'geekfolio_plg'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 200,
						'min' => 0,
						'step' => 1,
					],
				],
                'render_type' => 'ui',
			]
		);

		$this->add_control(
			'drop_shadow_blur_radius',
			[
				'label' => esc_html__('Blur Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 200,
						'min' => 0,
						'step' => 1,
					],
				],
                'render_type' => 'ui',
			]
		);

		$this->add_control(
			'drop_shadow_color',
			[
				'label' => __('Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-button' => 'filter: drop-shadow({{drop_shadow_offset_x.SIZE}}px {{drop_shadow_offset_y.SIZE}}px {{drop_shadow_blur_radius.SIZE}}px {{VALUE}});',
				],
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$btn_type = $settings['btn_type'];

		$migrated = isset($settings['__fa4_migrated']['selected_icon']);
		$is_new = empty($settings['icon']) && Icons_Manager::is_migration_allowed();

		if (!$is_new && empty($settings['icon_align'])) {
			// @todo: remove when deprecated
			// added as bc in 2.6
			//old default
			$settings['icon_align'] = $this->get_settings('icon_align');
		}


		$add_classes = '';

		if($settings['icon_position_end'] == 'yes') $add_classes .= ' icon-end';

		if($settings['circle_bg'] == 'yes') $add_classes .= ' circle-bg';

		if($settings['additional_border'] == 'yes') $add_classes .= ' addi-border';

		$this->add_render_attribute([
			'content-wrapper' => [
				'class' => ['geekfolio-button-content-wrapper'],
			],
			'icon-align' => [
				'class' => [
					'geekfolio-button-icon',
					'geekfolio-align-icon-' . $settings['icon_align'],
					'hover-animation-' . $settings['button_icon_animation_hover']
				],
			],
			'btn_text' => [
				'class' => ['geekfolio-button-text'],
			],
		]);

		$this->add_inline_editing_attributes('btn_text', 'none');
?>

		<a <?php if($settings['video_popup'] == 'yes'){echo 'data-lity';} ?> href="<?php echo esc_url($settings['link']['url']); ?>" <?php if ( $settings['link']['is_external'] ) {echo'target="_blank"';} ?> class="geekfolio-button <?php if($btn_type == 'icon'){ echo esc_attr('d-flex align-items-center justify-content-center', 'geekfolio_plg'); } ?> <?php echo esc_attr($add_classes); ?>">
			<span <?php $this->print_render_attribute_string('content-wrapper'); ?>>
				<?php if (!empty($settings['icon']) or !empty($settings['selected_icon']['value']) and ($settings['icon_align'] == 'left')) : ?>
					<span <?php $this->print_render_attribute_string('icon-align'); ?>>
						<?php if ($is_new || $migrated) :
							Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true']);
						else : ?>
							<i class="<?php echo esc_attr($settings['icon']); ?>" aria-hidden="true"></i>
						<?php endif; ?>
					</span>
				<?php endif; ?>
				<span <?php $this->print_render_attribute_string('btn_text'); ?>>
					<?php $this->print_unescaped_setting('btn_text'); ?>
				</span>
				<?php if (!empty($settings['icon']) or !empty($settings['selected_icon']['value'])  and ($settings['icon_align'] == 'right')) : ?>
					<span <?php $this->print_render_attribute_string('icon-align'); ?>>
						<?php if ($is_new || $migrated) :
							Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true']);
						else : ?>
							<i class="<?php echo esc_attr($settings['icon']); ?>" aria-hidden="true"></i>
						<?php endif; ?>
					</span>
				<?php endif; ?>
			</span>
		</a>

<?php

	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function content_template()
	{
	}
}
