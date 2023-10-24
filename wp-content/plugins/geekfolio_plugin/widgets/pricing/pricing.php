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


class Geekfolio_Pricing extends Widget_Base{

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
		return 'geekfolio-pricing';
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
		return __('Geekfolio Pricing Card ', 'geekfolio_plg');
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
		return 'eicon-price-table';
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
	protected function _register_controls() {
	
        $this->start_controls_section(
			'section_content',
			[
				'label' => __('Content', 'geekfolio_plg'),
			]
		);
        $this->add_control(
			'card_name',
			[
				'label' => esc_html__( 'Name', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Standard', 'geekfolio_plg' ),
				'placeholder' => esc_html__( 'Type your name of the package here', 'geekfolio_plg' ),
			]
		);
        $this->add_control(
			'card_description',
			[
				'label' => esc_html__( 'Description', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 5,
				'default' => esc_html__( 'Have a design ready to build?  or small budget', 'geekfolio_plg' ),
				'placeholder' => esc_html__( 'Type your description here', 'geekfolio_plg' ),
			]
		);

        $this->add_control(
			'card_price',
			[
				'label' => esc_html__( 'Price', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '$799', 'geekfolio_plg' ),
				'placeholder' => esc_html__( 'Type your price  here', 'geekfolio_plg' ),
			]
		);
		$this->add_control(
			'show_badge',
			[
				'label' => esc_html__( 'Show Badge', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'geekfolio_plg' ),
				'label_off' => esc_html__( 'Hide', 'geekfolio_plg' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		
		$this->add_control(
			'badge_name',
			[	
				'label' => esc_html__( 'Badge', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Popular', 'geekfolio_plg' ),
				'condition' => [
					'show_badge' => 'yes',
				],
			]
		);
        $this->add_control(
			'card_button',
			[
				'label' => esc_html__( 'Button', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'pick this package ', 'geekfolio_plg' ),
				'placeholder' => esc_html__( 'Type your button text here', 'geekfolio_plg' ),
			]
		);
		$this->add_control(
			'btn_icon',
			[
				'label' => __('Button Icon', 'geekfolio_plg'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'geekfolio_plg'),
				'label_off' => __('Hide', 'geekfolio_plg'),
				'return_value' => 'yes',
				'default' => ''
			]
		);
		$this->add_control(
			'btn_link',
			[
				'label' => __('Button Link', 'geekfolio_plg'),
				'type' => Controls_Manager::URL,
				'default' => [
					'url' => '#0',
                ]
			]
		);
        $this->add_control(
			'card_duration',
			[
				'label' => esc_html__( 'Per', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Month',
			]
		);

		$this->add_control(
			'per_text',
			[
				'label' => __('Per Text', 'geekfolio_plg'),
				'type' => Controls_Manager::TEXT,
				'default' => 'Per',
			]
		);
        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'feature',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'name', 'geekfolio_plg' ),
				'default' => esc_html__( 'Need your wireframe', 'geekfolio_plg' ),
			]
		);
        $this->add_control(
            'repeater',
            [
                'label' => esc_html__('Features ', 'geekfolio_plg'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ feature }}}',
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'card_bg_styles',
			[
				'label' => __('Card Background', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->start_controls_tabs('background_tabs');

        $this->start_controls_tab(
			'background_normal_tab',
			[
				'label' => __('Normal', 'geekfolio_plg')
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'card_background',
				'types' => [ 'classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .geekfolio-pricing-card'
			]
		);

		$this->add_control(
			'background_img',
			[
				'label' => __('Background Overlay Image', 'geekfolio_plg'),
				'type' => Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'background_img_opacity',
			[
				'label' => __('Background Image Opacity', 'geekfolio_plg'),
				'type' => Controls_Manager::NUMBER,
				'step' => '0.1',
				'default' => '0.1',
				'min' => '0',
				'max' => '1',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card .background_pattern' => 'opacity: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'background_daek_mode_tab',
			[
				'label' => __('Dark Mode', 'geekfolio_plg')
			]
		);

		$this->add_control(
			'background_color_dark_mode',
			[
				'label' => esc_html__( 'Color (Dark Mode)', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-pricing-card' => 'background-color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-pricing-card' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_img_dark_mode',
			[
				'label' => __('Background Overlay Image', 'geekfolio_plg'),
				'type' => Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'background_img_opacity_dark_mode',
			[
				'label' => __('Background Image Opacity', 'geekfolio_plg'),
				'type' => Controls_Manager::NUMBER,
				'step' => '0.1',
				'default' => '0.1',
				'min' => '0',
				'max' => '1',
				'selectors' => [
                    '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-pricing-card .background_patternd' => 'opacity: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-pricing-card .background_patternd' => 'opacity: {{VALUE}};',
				],
			]
		);
        
		$this->end_controls_tab();

		$this->end_controls_tabs();

        $this->end_controls_section();

		$this->start_controls_section(
			'card_styles',
			[
				'label' => __('Card Styles', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'card_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border_card',
				'selector' => '{{WRAPPER}} .geekfolio-pricing-card',
			]
		);

        $this->add_control(
            'border_card_color_dark',
            [
                'label' => __('Border Color ( Dark Mode )', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-pricing-card' => 'border-color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-pricing-card' => 'border-color: {{VALUE}};',
				],
            ]
        );

		$this->add_responsive_control(
			'card_margin',
			[
				'label' => esc_html__( 'Card Margin', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card  ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'card_padding',
			[
				'label' => esc_html__( 'Card Padding', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card  ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after'
			]
		);
		$this->add_responsive_control(
			'card_features_margin',
			[
				'label' => esc_html__( 'Features Margin', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .card-body  ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'card_features_padding',
			[
				'label' => esc_html__( 'Features Padding', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .card-body  ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
        
        $this->start_controls_section(
			'name_style',
			[
				'label' => __('name', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'selector' => '{{WRAPPER}} .geekfolio-pricing-card .geekfolio-name',
			]
		);
        $this->add_control(
			'name_color',
			[
				'label' => esc_html__( 'Text Color', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => "#000",
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-name' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_responsive_control(
			'name_margin',
			[
				'label' => esc_html__( 'Margin', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-name ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'name_padding',
			[
				'label' => esc_html__( 'Padding', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
        
        $this->start_controls_section(
			'description_style',
			[
				'label' => __('Description', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .geekfolio-pricing-card .geekfolio-description',
			]
		);
        $this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Text Color', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => "#000",
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-description' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_responsive_control(
			'description_margin',
			[
				'label' => esc_html__( 'Margin', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-description ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'description_padding',
			[
				'label' => esc_html__( 'Padding', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border_description',
				'selector' => '{{WRAPPER}} .geekfolio-pricing-card .geekfolio-description',
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'badge_style',
			[
				'label' => __('Badge', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'badge_typography',
				'selector' => '{{WRAPPER}} .geekfolio-pricing-card .geekfolio-badge',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'badge_background',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .geekfolio-pricing-card .geekfolio-badge'
			]
		);
        $this->add_control(
			'badge_color',
			[
				'label' => esc_html__( 'Text Color', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => "#0c56ed",
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-badge' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_responsive_control(
			'badge_margin',
			[
				'label' => esc_html__( 'Margin', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-badge ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'badge_padding',
			[
				'label' => esc_html__( 'Padding', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' =>[
					'unit ' => "px",
					'top' => 3,
					'right' => 15,
					'left' => 15,
					'bottom' => 3,
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'badge_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' =>[
					'unit ' => "px",
					'top' => 30,
					'right' => 30,
					'left' => 30,
					'bottom' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'price_style',
			[
				'label' => __('price', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'selector' => '{{WRAPPER}} .geekfolio-pricing-card .geekfolio-price',
			]
		);
        $this->add_control(
			'price_color',
			[
				'label' => esc_html__( 'Text Color', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => "#000",
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-price' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_responsive_control(
			'price_margin',
			[
				'label' => esc_html__( 'Margin', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'price_padding',
			[
				'label' => esc_html__( 'Padding', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
        
        $this->start_controls_section(
			'duration_style',
			[
				'label' => __('Duration', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'duration_typography',
				'selector' => '{{WRAPPER}} .geekfolio-pricing-card .geekfolio-duration',
			]
		);
        $this->add_control(
			'duration_color',
			[
				'label' => esc_html__( 'Text Color', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => "#000",
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-duration' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_responsive_control(
			'duration_margin',
			[
				'label' => esc_html__( 'Margin', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-duration' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'duration_padding',
			[
				'label' => esc_html__( 'Padding', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-duration' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'feature_style',
			[
				'label' => __('Feature', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
		$this->add_control(
			'list_bullets',
			[
				'label' => esc_html__( 'List Bullets', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'geekfolio_plg' ),
				'label_off' => esc_html__( 'Hide', 'geekfolio_plg' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'feature_typography',
				'selector' => '{{WRAPPER}} .geekfolio-pricing-card .geekfolio-feature',
			]
		);
        $this->add_control(
			'feature_color',
			[
				'label' => esc_html__( 'Text Color', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => "#000",
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-feature' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_responsive_control(
			'feature_margin',
			[
				'label' => esc_html__( 'Margin', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-feature' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'feature_padding',
			[
				'label' => esc_html__( 'Padding', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-feature' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
			'button_width',
			[
				'label' => esc_html__( 'Width', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-button-container' => 'width: {{SIZE}}{{UNIT}};',
				],
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
				'selector' => '{{WRAPPER}} .geekfolio-pricing-card .geekfolio-button .geekfolio-button-text',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .geekfolio-pricing-card .geekfolio-button',
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
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-button' => 'color: {{VALUE}}; fill: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'button_text_color_dark_mode',
			[
				'label' => esc_html__('Text Color (Dark Mode)', 'zumar_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-pricing-card .geekfolio-button' => 'color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-pricing-card .geekfolio-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_normal',
				'label' => esc_html__('Background', 'geekfolio_plg'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .geekfolio-pricing-card .geekfolio-button',
			]
		);


		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .geekfolio-pricing-card .geekfolio-button',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .geekfolio-pricing-card .geekfolio-button',
			]	
		);

		$this->add_control(
			'border_color_dark_mode',
			[
				'label' => esc_html__('Border Color (Dark Mode)', 'zumar_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-pricing-card .geekfolio-button' => 'border-color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-pricing-card .geekfolio-button' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label' => esc_html__('Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-button-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'button_margin',
			[
				'label' => esc_html__('Marign', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%','rem'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card  .geekfolio-button-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]	
		);
		$this->add_responsive_control(
			'button_padding',
			[
				'label' => esc_html__('Padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'name' => 'hover_typography',
				'selector' => '{{WRAPPER}} .geekfolio-pricing-card .geekfolio-button:hover .geekfolio-button-text',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'hover_text_shadow',
				'selector' => '{{WRAPPER}} .geekfolio-pricing-card .geekfolio-button:hover',
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => esc_html__('Text Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-button:hover, {{WRAPPER}} .geekfolio-button:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-button:hover svg path, {{WRAPPER}} .geekfolio-button:focus svg path' => 'fill: {{VALUE}} !important ;',
				],
			]
		);

		$this->add_control(
			'hover_button_text_color_dark_mode',
			[
				'label' => esc_html__('Text Color (Dark Mode)', 'zumar_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-pricing-card .geekfolio-button:hover' => 'color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-pricing-card .geekfolio-button:hover' => 'color: {{VALUE}};',
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-button:focus' => 'color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-button:focus' => 'color: {{VALUE}};',
				],
			]
		);
        
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'hover_background',
				'label' => esc_html__('Background', 'geekfolio_plg'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .geekfolio-pricing-card .geekfolio-button:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .geekfolio-pricing-card .geekfolio-button:hover',
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_hover',
				'selector' => '{{WRAPPER}} .geekfolio-pricing-card .geekfolio-button:hover'
			]
		);

		$this->add_control(
			'border_color_hover_dark_mode',
			[
				'label' => esc_html__('Border Color (Dark Mode)', 'zumar_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-pricing-card .geekfolio-button:hover' => 'border-color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-pricing-card .geekfolio-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'border_radius_hover',
			[
				'label' => esc_html__('Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'button_margin_hover',
			[
				'label' => esc_html__('Marign', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-button:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			
			]	
		);
		$this->add_responsive_control(
			'button_paddin_hover',
			[
				'label' => esc_html__('Padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-pricing-card .geekfolio-button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			
			]	
		);
		$this->end_controls_tab();

		

		$this->end_controls_tabs();

		

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
        ?>
	   
            <div class="geekfolio-pricing-card">
                <div class="card-title">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <h5 class="geekfolio-name "> <?php echo $settings["card_name"];?> <span class="geekfolio-badge"> <?php  if ($settings["show_badge"]=="yes"){echo $settings["badge_name"];}?> </span> </h5>
                            <div class="price">
								<span class="geekfolio-price"> <?php echo $settings["card_price"];?> </span>
                                <span class="geekfolio-duration"> <?php echo __($settings['per_text'], 'geekfolio_plg'); ?> <?php echo $settings ["card_duration"];?> </span>
                            </div>
							<p class="geekfolio-description"> <?php echo $settings["card_description"];?> </p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            if ( $settings['repeater'] ) :
                                foreach (  $settings['repeater'] as $item ) :
									?>
                                        <div class="geekfolio-feature <?php if($settings['list_bullets'] =='yes') echo ' list_bullets'; ?>"> <?php echo $item["feature"];?></div>
                                        <?php endforeach;
                                
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="geekfolio-button-container">	
					<a href="<?php echo esc_url($settings['btn_link']['url']); ?>" class="geekfolio-button" >
						<span>
							<span class="geekfolio-text-warpper">
								<span class ='geekfolio-button-text'>
									<?php echo $settings["card_button"];?>
								</span>
								<?php if($settings['btn_icon'] == 'yes') : ?>
									<i><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.922 4.5V11.8125C13.922 11.9244 13.8776 12.0317 13.7985 12.1108C13.7193 12.1899 13.612 12.2344 13.5002 12.2344C13.3883 12.2344 13.281 12.1899 13.2018 12.1108C13.1227 12.0317 13.0783 11.9244 13.0783 11.8125V5.51953L4.79547 13.7953C4.71715 13.8736 4.61092 13.9176 4.50015 13.9176C4.38939 13.9176 4.28316 13.8736 4.20484 13.7953C4.12652 13.717 4.08252 13.6108 4.08252 13.5C4.08252 13.3892 4.12652 13.283 4.20484 13.2047L12.4806 4.92188H6.18765C6.07577 4.92188 5.96846 4.87743 5.88934 4.79831C5.81023 4.71919 5.76578 4.61189 5.76578 4.5C5.76578 4.38811 5.81023 4.28081 5.88934 4.20169C5.96846 4.12257 6.07577 4.07813 6.18765 4.07812H13.5002C13.612 4.07813 13.7193 4.12257 13.7985 4.20169C13.8776 4.28081 13.922 4.38811 13.922 4.5Z" fill="currentColor"></path>
                                    </svg></i>
								<?php endif; ?>
							</span>
						</span>
					</a>
				</div>
				<?php if($settings['background_img']['url'] != '') : ?>
				    <div data-background="<?php echo esc_url($settings['background_img']['url']); ?>" class="bg-img background_pattern"></div>
				<?php endif;
                if($settings['background_img_dark_mode']['url'] != '') : ?>
				    <div data-background="<?php echo esc_url($settings['background_img_dark_mode']['url']); ?>" class="bg-img background_pattern dark-mode"></div>
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
