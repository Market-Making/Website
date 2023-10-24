<?php
namespace GeekfolioPlugin\Widgets;

use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


		
/**
 * @since 1.0.0
 */
class Geekfolio_MailChimp extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'geekfolio-mailchimp';
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
	public function get_title() {
		return __( 'Geekfolio MailChimp Form', 'geekfolio_plg' );
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
	public function get_icon() {
		return 'fa fa-wpforms';
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
		return [ 'from', 'input', 'contact' ];
	}

    
    public function geekfolio_mailChimp_forms(){
        $formlist = array();
        $forms_args = array( 
        	'posts_per_page' => -1,
        	'post_status' => 'publish',
        	'post_type'=> 'mwp_form', 
        );

        $forms = get_posts( $forms_args );
        if( $forms ){
            foreach ( $forms as $form ){
                $formlist[$form->ID] = $form->form_id;
            }
        }else{
            $formlist['0'] = __('Form not found', 'geekfolio_plg');
        }
        return $formlist;
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
			'section_title',
			[
				'label' => __( 'MailChimp form', 'geekfolio_plg' ),
			]
		);

        $this->add_control(
			'form_id',
			[
				'label' => __( 'Select MailChimp form', 'geekfolio_plg' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => array_keys($this->geekfolio_mailChimp_forms())[0],
			]
		);

		$this->add_control(
			'form_layout',
			[
				'label' => __( 'Layout', 'geekfolio_plg' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'button-inside' => __( 'Button Inside', 'geekfolio_plg' ),
					'button-under' => __( 'Button Under', 'geekfolio_plg' ),
				],
				'default' => 'button-inside',
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'form_settings',
			[
				'label' => __( 'Form Setting','geekfolio_plg' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'input_height',
			[
				'label' => __( 'Input height', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp.button-inside input' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'form_layout' => 'button-inside'
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'form_placeholder_typography',
				'label'     => __( 'Typography', 'geekfolio_plg' ),
				'selector'  => '{{WRAPPER}} .geekfolio-mailchimp input',
			]
		);
		
		$this->add_control(
			'form_placeholder',
			[
				'label' => __( 'Placeholder Color','geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp input::-webkit-input-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-mailchimp input::-moz-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-mailchimp input:-ms-input-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-mailchimp input:-moz-placeholder' => 'color: {{VALUE}};',
				],
			]
		);
		
		
		$this->add_control(
			'form_text',
			[
				'label' => __( 'Text Color','geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .geekfolio-mailchimp input:not(.wpcf7-submit) ' => 'color: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-mailchimp textarea' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'form_bg',
			[
				'label' => __( 'Background Color','geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp input' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-mailchimp textarea' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'form_height',
			[
				'label' => __( 'Fields height', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp input' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'form_group_alignment',
			[
				'label' => __('Alignment', 'geekfolio_plg'),
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
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp input, {{WRAPPER}} .geekfolio-mailchimp textarea' => 'text-align: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'form_border',
				'label' => esc_html__( 'Border', 'geekfolio_plg' ),
				'selector' => '{{WRAPPER}} .geekfolio-mailchimp input, {{WRAPPER}} .geekfolio-mailchimp textarea',
			]
		);
		
		$this->add_responsive_control(
			'form_border_radius',
			[
				'label' => __( 'Border Radius', 'geekfolio_plg' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp input' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-mailchimp textarea' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'form_padding',
			[
				'label' => __( 'Padding', 'geekfolio_plg' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp input' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-mailchimp textarea' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'form_margin',
			[
				'label' => __( 'Margin', 'geekfolio_plg' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp input' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-mailchimp textarea' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'form_group_margin',
			[
				'label' => __( 'Form Group Margin', 'geekfolio_plg' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp .form-group' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'form_border_color',
			[
				'label' => __( 'Border Color','geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .geekfolio-mailchimp input' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-mailchimp textarea' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'form_border_color_active',
			[
				'label' => __( 'Border Color on Focus','geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp input:focus' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-mailchimp textarea:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'fields_box_shadow',
				'selector' => '{{WRAPPER}} .geekfolio-mailchimp input, {{WRAPPER}} .geekfolio-mailchimp select, {{WRAPPER}} .geekfolio-mailchimp textarea',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'icon_settings',
			[
				'label' => __( 'Icon Setting','geekfolio_plg' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'x_positioning',
			[
				'label' => __('X Positioning', 'geekfolio_plg'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'geekfolio_plg'),
						'icon' => 'eicon-text-align-left',
					],
					'right' => [
						'title' => __('Right', 'geekfolio_plg'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
			]
		);

		$this->add_responsive_control(
			'icon_x',
			[
				'label' => __( 'Icon X Position', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp .icon' => 'left: {{SIZE}}{{UNIT}}; right: auto !important;',
				],
				'condition' => [
					'x_positioning' => 'left'
				]
			]
		);

		$this->add_responsive_control(
			'icon_x_right',
			[
				'label' => __( 'Icon X Position', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp .icon' => 'right: {{SIZE}}{{UNIT}}; left: auto !important;',
				],
				'condition' => [
					'x_positioning' => 'right'
				]
			]
		);

		$this->add_responsive_control(
			'icon_y',
			[
				'label' => __( 'Icon Y position', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp .icon' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp .icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_wrapper_width',
			[
				'label' => __( 'Icon Wrapper Width', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp .icon' => 'width: {{SIZE}}{{UNIT}}; text-align: center;',
				],
			]
		);

		$this->add_responsive_control(
			'icon_wrapper_height',
			[
				'label' => __( 'Icon Wrapper Height', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp .icon' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'label' => esc_html__( 'Border', 'geekfolio_plg' ),
				'selector' => '{{WRAPPER}} .geekfolio-mailchimp .icon',
			]
		);
		
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color','geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp .icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'btn_settings',
			[
				'label' => __( 'Button Setting','geekfolio_plg' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'btn_width',
			[
				'label' => __( 'Button Width', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp.button-inside button' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-mailchimp .geekfolio-button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_height',
			[
				'label' => __( 'Button height', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp.button-inside button' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'form_layout' => 'button-inside'
				]
			]
		);

		$this->add_responsive_control(
			'btn_x',
			[
				'label' => __( 'Button X Position', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp.button-inside button' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'form_layout' => 'button-inside'
				]
			]
		);

		$this->add_responsive_control(
			'btn_y',
			[
				'label' => __( 'Button Y position', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp.button-inside button' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'form_layout' => 'button-inside'
				]
			]
		);

		$this->add_control(
			'btn_color',
			[
				'label' => esc_html__( 'Button Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp button' => 'color: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-mailchimp button span' => 'color: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-mailchimp .geekfolio-button' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'btn_typography',
				'label'     => __( 'Button Typography', 'geekfolio_plg' ),
				'selector'  => '{{WRAPPER}} .geekfolio-mailchimp button',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'btn_background',
				'label' => __('Button Backround', 'geekfolio_plg'),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .geekfolio-mailchimp button, {{WRAPPER}} .geekfolio-mailchimp .geekfolio-button',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'btn_background_hover',
				'label' => __('Button Backround', 'geekfolio_plg'),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .geekfolio-mailchimp button:hover',
			]
		);

		$this->add_control(
			'btn_background_hover_animation',
			[
				'label' => esc_html__( 'Button Hover Animation Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp .geekfolio-button .geekfolio-button-circle' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'btn_margin',
			[
				'label' => __( 'Margin', 'geekfolio_plg' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp .geekfolio-button' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-mailchimp.button-inside button' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'btn_padding',
			[
				'label' => __( 'Padding', 'geekfolio_plg' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp button' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_border',
                'selector' => '{{WRAPPER}} .geekfolio-mailchimp .geekfolio-button, {{WRAPPER}} .geekfolio-mailchimp button',
                'separator' => 'before',
            ]
        );
		
		$this->add_responsive_control(
			'btn_border_radius',
			[
				'label' => __( 'Border Radius', 'geekfolio_plg' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp .geekfolio-button' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-mailchimp button' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'btn_icon_settings',
			[
				'label' => __( 'Button Icon Setting','geekfolio_plg' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'btn_icon_color',
			[
				'label' => esc_html__( 'Button Icon Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp button i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-mailchimp button svg' => 'fill: {{VALUE}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'btn_icon_margin',
			[
				'label' => __( 'Button Icon Margin', 'geekfolio_plg' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp button i' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-mailchimp button svg' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_icon_size',
			[
				'label' => __( 'Icon Size', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-mailchimp button i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-mailchimp button svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
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
	protected function render() {
		$settings = $this->get_settings_for_display();
		$id = $settings['form_id' ];
		$shortcode=do_shortcode( '[mc4wp_form id="'. $id .'"]' );

		?>

		<div class="geekfolio-mailchimp <?php echo esc_attr($settings['form_layout']); ?>"><?php echo $shortcode; ?></div>

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
	protected function content_template() { 
	
	}
}


