<?php
namespace GeekfolioPlugin\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Widget_Base;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Utils;
use Elementor\Group_Control_Background;


/**
 * Elementor heading widget.
 *
 * Elementor widget that displays an eye-catching headlines.
 *
 * @since 1.0.0
 */
class Geekfolio_Heading extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve heading widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'geekfolio-heading';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve heading widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Geekfolio Heading', 'geekfolio_plg' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve heading widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-t-letter';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the heading widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'geekfolio-elements' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'heading', 'title', 'text' ];
	}

	public function get_script_depends() {
		return ['geekfolio-mirror-heading'];
	}

	/**
	 * Register heading widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'geekfolio_plg' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'geekfolio_plg' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'Enter your title', 'geekfolio_plg' ),
				'default' => esc_html__( 'Add Your Heading Text Here', 'geekfolio_plg' ),
				'description' => esc_html__( 'Note: use <span>...</span> to highlight text & <strong>...</strong> to bold text', 'geekfolio_plg' ),
			]
		);

		$this->add_control(
            'res_br',
            [
				'label'         => __( 'Responsive br', 'geekfolio_plg' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => __( 'Show', 'geekfolio_plg' ),
				'label_off'     => __( 'Hide', 'geekfolio_plg' ),
				'return_value'  => 'yes',
				'default'  		=> 'yes',
			]
        );

		$this->add_control(
            'vertical-rl',
            [
				'label'         => __( 'Vertical rl', 'geekfolio_plg' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => __( 'On', 'geekfolio_plg' ),
				'label_off'     => __( 'Off', 'geekfolio_plg' ),
				'return_value'  => 'yes',
				'default'  		=> 'no',
			]
		);

		$this->add_control(
        	'sticky',
            [
				'label'         => __( 'Sticky', 'geekfolio_plg' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => __( 'Yes', 'geekfolio_plg' ),
				'label_off'     => __( 'No', 'geekfolio_plg' ),
				'return_value'  => 'yes',
				'default'  		=> '',
			]
        );
        
		$this->add_control(
        	'rotate_animation',
            [
				'label'         => __( 'Rotate Animation', 'geekfolio_plg' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => __( 'Yes', 'geekfolio_plg' ),
				'label_off'     => __( 'No', 'geekfolio_plg' ),
				'return_value'  => 'yes',
				'default'  		=> 'no',
			]
        );

		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'elementor' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => '',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
            'after_icon',
            [
				'label'         => __( 'Icon', 'geekfolio_plg' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => __( 'Yes', 'geekfolio_plg' ),
				'label_off'     => __( 'No', 'geekfolio_plg' ),
				'return_value'  => 'yes',
				'default'  		=> 'no',
			]
        );
		
		$this->add_control(
			'selected_icon_after',
			[
				'label' => esc_html__('Icon', 'geekfolio_plg'),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin' => 'inline',
				'label_block' => false,
				'condition' => [
					'after_icon' => 'yes'
				]
			]
		);

		$this->add_control(
			'img_after',
			[
				'label' => __('Image After', 'geekfolio_plg'),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'after_icon' => 'yes'
				]
			]
		);

		$this->add_control(
			'icon_position',
			[
				'label' => esc_html__( 'Icon Position', 'geekfolio_plg' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'geekfolio_plg' ),
						'icon' => 'eicon-order-start',
					],
					'both' => [
						'title' => esc_html__( 'Both', 'geekfolio_plg' ),
						'icon' => 'eicon-grow',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'geekfolio_plg' ),
						'icon' => 'eicon-order-end',
					],
				],
				'default' => 'right',
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__( 'Alignment', 'geekfolio_plg' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'geekfolio_plg' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'geekfolio_plg' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'geekfolio_plg' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'geekfolio_plg' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'html_tag',
			[
				'label' => __( 'HTML Tag', 'geekfolio_plg' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => __( 'H1', 'geekfolio_plg' ),
					'h2' => __( 'H2', 'geekfolio_plg' ),
					'h3' => __( 'H3', 'geekfolio_plg' ),
					'h4' => __( 'H4', 'geekfolio_plg' ),
					'h5' => __( 'H5', 'geekfolio_plg' ),
					'h6' => __( 'H6', 'geekfolio_plg' ),
					'div' => __( 'div', 'geekfolio_plg' ),
					'span' => __( 'span', 'geekfolio_plg' ),
					'p' => __( 'P', 'geekfolio_plg' ),
				],
				'default' => 'h2',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title', 'geekfolio_plg' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('heading_style');
		$this->start_controls_tab(
			'normal_title',
			[
				'label' => esc_html__( 'Normal', 'geekfolio_plg' ),
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Text Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .geekfolio-heading' => 'color: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-heading a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_color_dark_mode',
			[
				'label' => esc_html__('Text Color (Dark Mode)', 'zumar_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-heading' => 'color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-heading' => 'color: {{VALUE}};',
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-heading a' => 'color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-heading a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_stroke_color_dark_mode',
			[
				'label' => esc_html__('stroke Color (Dark Mode)', 'zumar_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-heading' => '-webkit-text-stroke-color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-heading' => '-webkit-text-stroke-color: {{VALUE}}; stroke: {{VALUE}};',
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-heading a' => '-webkit-text-stroke-color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-heading a' => '-webkit-text-stroke-color: {{VALUE}}; stroke: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',

				'selector' => '{{WRAPPER}} .geekfolio-heading',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'hover_title',
			[
				'label' => esc_html__( 'Hover', 'geekfolio_plg' ),
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label' => esc_html__( 'Text Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .geekfolio-heading:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-heading a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_hover',

				'selector' => '{{WRAPPER}} .geekfolio-heading:hover, {{WRAPPER}} .geekfolio-heading a:hover',
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();		

        $this->add_control(
			'divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
        
        $this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'text_stroke',
				'selector' => '{{WRAPPER}} .geekfolio-heading',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'opacity',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Opacity', 'geekfolio_plg' ),
				'selectors' => [
					'{{WRAPPER}} .geekfolio-heading' => 'opacity: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .geekfolio-heading',
			]
		);

		$this->add_control(
			'blend_mode',
			[
				'label' => esc_html__( 'Blend Mode', 'geekfolio_plg' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'Normal', 'geekfolio_plg' ),
					'multiply' => 'Multiply',
					'screen' => 'Screen',
					'overlay' => 'Overlay',
					'darken' => 'Darken',
					'lighten' => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'saturation' => 'Saturation',
					'color' => 'Color',
					'difference' => 'Difference',
					'exclusion' => 'Exclusion',
					'hue' => 'Hue',
					'luminosity' => 'Luminosity',
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-heading' => 'mix-blend-mode: {{VALUE}}',
				],
				'separator' => 'none',
			]
		);
		$this->end_controls_section();

		//**********************************************************************************************************

        //*****Span Style*****//
		$this->start_controls_section(
			'span_styles',
			[
				'label' => __('Span Styles', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'span_typography',
				'label' => esc_html__('Span Text Typograpghy', 'geekfolio_plg'),
				'selector' => '{{WRAPPER}} span',
			]
		);

		$this->add_control(
			'span_text_color',
			[
				'label' => esc_html__( 'Span Text Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'span_color_dark_mode',
			[
				'label' => esc_html__('Span Text (Dark Mode)', 'zumar_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} span' => 'color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'span_stroke_color_dark_mode',
			[
				'label' => esc_html__('Span stroke Color (Dark Mode)', 'zumar_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} span' => '-webkit-text-stroke-color: {{VALUE}}; stroke: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} span' => '-webkit-text-stroke-color: {{VALUE}}; stroke: {{VALUE}};',
				],
			]
		);
        
        $this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
				'name' => '_span_text_stroke',
				'selector' => '{{WRAPPER}} .geekfolio-heading span',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'span_border',
				'selector' => '{{WRAPPER}} span',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'span_padding',
			[
				'label' => esc_html__('Padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem'],
				'selectors' => [
					'{{WRAPPER}} span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'span_border_radius',
			[
				'label' => esc_html__('Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em','rem'],
				'selectors' => [
					'{{WRAPPER}} span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'span_opacity',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Opacity', 'geekfolio_plg' ),
				'selectors' => [
					'{{WRAPPER}} span' => 'opacity: {{VALUE}}'
				]
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__('Icon Style', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->start_controls_tabs('after_icon_tabs');
		$this->start_controls_tab(
			'normal_icon',
			[
				'label' => __('Normal', 'geekfolio_plg')
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__('Icon Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-heading-title i' => 'color: {{VALUE}}; fill: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-heading-title svg path' => ' fill: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'icon_color_dark',
			[
				'label' => esc_html__('Icon Color ( Dark )', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-heading-title i' => 'color: {{VALUE}}; fill: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-heading-title i' => 'color: {{VALUE}}; fill: {{VALUE}};',
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-heading-title svg path' => 'fill: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-heading-title svg path' => 'fill: {{VALUE}};',
				]
			]
		);

        $left = is_rtl() ? 'right' : 'left';
        $right = is_rtl() ? 'left' : 'right';

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
					'{{WRAPPER}} .geekfolio-heading-title .right ' => 'margin-'. $left .': {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-heading-title .left ' => 'margin-'. $right .': {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__('Icon Size', 'geekfolio_plg'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-heading-title i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-heading-title svg ' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important',
					'{{WRAPPER}} .geekfolio-heading-title .icon-img' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important',
				],
			]
		);

		$this->add_control(
			'icon_opacity',
			[
				'label' => __('Opacity', 'geekfolio_plg'),
				'type' => Controls_Manager::NUMBER,
				'default' => '1',
				'step' => '0.1',
				'max' => '1',
				'min' => '0',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-heading-title i' => 'opacity: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-heading-title svg ' => 'opacity: {{VALUE}}',
					'{{WRAPPER}} .geekfolio-heading-title .icon-img ' => 'opacity: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		/////
		$this->start_controls_tab(
			'hover_after_icon',
			[
				'label' => __('Hover', 'geekfolio_plg')
			]
		);
		$this->add_control(
			'icon_color_hover',
			[
				'label' => esc_html__('Icon Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-heading-title a:hover i' => 'color: {{VALUE}} !important; fill: {{VALUE}} !important;',
					'{{WRAPPER}} .geekfolio-heading-title a:hover svg path' => ' fill: {{VALUE}} !important;',
				]
			]
		);
		$this->add_control(
			'icon_indent_hover',
			[
				'label' => esc_html__('Icon Spacing', 'geekfolio_plg'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-heading-title a:hover .right ' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-heading-title a:hover .left ' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_size_hover',
			[
				'label' => esc_html__('Icon Size', 'geekfolio_plg'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-heading-title a:hover i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-heading-title a:hover svg ' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important',
					'{{WRAPPER}} .geekfolio-heading-title a:hover .icon-img' => 'opacity: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_opacity_hover',
			[
				'label' => __('Opacity', 'geekfolio_plg'),
				'type' => Controls_Manager::NUMBER,
				'default' => '1',
				'step' => '0.1',
				'max' => '1',
				'min' => '0',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-heading-title a:hover i' => 'opacity: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-heading-title a:hover svg ' => 'opacity: {{VALUE}}',
					'{{WRAPPER}} .geekfolio-heading-title a:hover .icon-img ' => 'opacity: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'icon_y',
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
				'selectors' => [
					'{{WRAPPER}} .geekfolio-heading-title i' => 'bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-heading-title svg ' => 'bottom: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .geekfolio-heading-title .icon-img ' => 'bottom: {{SIZE}}{{UNIT}}',
				],
                'render_type' => 'ui',
			]
		);
		$this->end_controls_section();

	}

	/**
	 * Render heading widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$geekfolio_gradient = 'yes' == $settings['text_additional_color'] ? ' geekfolio-additional-color' : ''; 
		$geekfolio_inline = 'yes' == $settings['after_icon'] || 'yes' == $settings['before_icon'] ? ' geekfolio-inline' : '';
		if ( '' === $settings['title'] ) {
			return;
		}
		$br = 'yes' == $settings['res_br'] ? ' hide-br' : '';
		$rotate_animation = 'yes' == $settings['rotate_animation'] ? ' d-rotate wow' : '';
		$rotate_animation_child = 'yes' == $settings['rotate_animation'] ? ' rotate-text' : '';
		$vertical_rl = 'yes' == $settings['vertical-rl'] ? ' vertical-rl' : '';

		$this->add_render_attribute( 'title', 'class', 'geekfolio-heading'. $geekfolio_inline . $geekfolio_gradient . $br . $rotate_animation_child . $vertical_rl . '' );
		
		if ( ! empty( $settings['size'] ) ) {
			$this->add_render_attribute( 'title', 'class', 'geekfolio-size-' . $settings['size'] );
		}

		$this->add_inline_editing_attributes( 'title' );

		$title = $settings['title'];

		$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', Utils::validate_html_tag( $settings['html_tag'] ), $this->get_render_attribute_string( 'title' ), $title );
		// PHPCS - the variable $title_html holds safe data.
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		?>
		<div class="geekfolio-heading-title<?php echo $rotate_animation; ?>" <?php if($settings['sticky'] == 'yes') echo 'id="sticky_item"'; ?>>
			<?php if ( ! empty( $settings['link']['url'] ) ) : ?>
			<a href="<?php echo $settings['link']['url'] ?>">
			<?php endif;
			if($settings['icon_position'] == 'left' || $settings['icon_position'] == 'both'):
				if(!empty($settings['selected_icon_after']['value'])) :
				echo '<span class="left">';
					\Elementor\Icons_Manager::render_icon( $settings['selected_icon_after'], [ 'aria-hidden' => 'true' ] );
				echo '</span>';
				endif;
				if(!empty($settings['img_after']['url'])) : ?>
				<span class="icon-img left">
					<img src="<?php echo esc_url($settings['img_after']['url']); ?>" alt="heading-image">
				</span>
				<?php endif; 
			endif; ?>
			<?php echo $title_html;
			if($settings['icon_position'] == 'right' || $settings['icon_position'] == 'both'):
				if(!empty($settings['selected_icon_after']['value'])) :
					echo '<span class="right">';
						\Elementor\Icons_Manager::render_icon( $settings['selected_icon_after'], [ 'aria-hidden' => 'true' ] );
					echo '</span>';
				endif;
				if(!empty($settings['img_after']['url'])) : ?>
				<span class="icon-img right">
					<img src="<?php echo esc_url($settings['img_after']['url']); ?>" alt="heading-image">
				</span>
				<?php endif;
			endif; ?>
			<?php if ( ! empty( $settings['link']['url'] ) ) : ?>
			</a>
			<?php endif; ?>
		</div>
		<?php
	}

	/**
	 * Render heading widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */
	protected function content_template() {

	}
}
