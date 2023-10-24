<?php
namespace GeekfolioPlugin\Widgets;

use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 


		
/**
 * @since 1.0.0
 */
class Geekfolio_Contact_Form extends Widget_Base {

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
		return 'geekfolio-contact-form';
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
		return __( 'Geekfolio Contact Form Shortcode', 'geekfolio_plg' );
	}
	
	//script depend
	public function get_script_depends() { return [ 'geekfolio-contact-form']; }

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
		return [ 'form', 'input', 'contact' ];
	}

    
    public function geekfolio_contact_forms(){
        $formlist = array();
        $forms_args = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $forms = get_posts( $forms_args );
        if( $forms ){
            foreach ( $forms as $form ){
                $formlist[$form->ID] = $form->post_title;
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
				'label' => __( 'Title', 'geekfolio_plg' ),
			]
		);

        $this->add_control(
			'form_id',
			[
				'label' => __( 'Select contact form', 'geekfolio_plg' ),
				'type' => Controls_Manager::SELECT,
				'default' => array_keys($this->geekfolio_contact_forms())[0],
				'options' => $this->geekfolio_contact_forms(),
			]
		);

		$this->add_control(
			'fields_in_row',
			[
				'label'         => __( 'Fields in Row', 'geekfolio_plg' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => __( 'Yes', 'geekfolio_plg' ),
				'label_off'     => __( 'No', 'geekfolio_plg' ),
				'return_value'  => 'yes',
				'default'  		=> false,
			]
		);

		$this->add_control(
			'animated_btn',
			[
				'label'         => __( 'Animated Button', 'geekfolio_plg' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => __( 'Yes', 'geekfolio_plg' ),
				'label_off'     => __( 'No', 'geekfolio_plg' ),
				'return_value'  => 'yes',
				'default'  		=> false,
			]
		);

		$this->add_control(
			'animated_btn_icon',
			[
				'label' => __('Button Icon', 'geekfolio_plg'),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => __( 'Yes', 'geekfolio_plg' ),
				'label_off'     => __( 'No', 'geekfolio_plg' ),
				'return_value'  => 'true',
				'default'  		=> 'true',
			]
		);

		$this->add_control(
			'animated_btn_img',
			[
				'label' => __('Button Image', 'geekfolio_plg'),
				'type' => Controls_Manager::MEDIA
			]
		);

		$this->add_control(
			'styled_attach',
			[
				'label'         => __( 'Styled Attachment', 'geekfolio_plg' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => __( 'Yes', 'geekfolio_plg' ),
				'label_off'     => __( 'No', 'geekfolio_plg' ),
				'return_value'  => 'yes',
				'default'  		=> false,
			]
		);

        $this->add_control(
			'styled_attach_style',
			[
				'label' => __( 'Styled Attachment Style', 'geekfolio_plg' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'attach-style-1' => __( 'Style 1', 'geekfolio_plg' ),
					'attach-style-2' => __( 'Style 2', 'geekfolio_plg' )
				]
			]
		);

		$this->add_control(
			'attach-text',
			[
				'label' => __('Text', 'geekfolio_plg'),
				'type' => Controls_Manager::TEXT,
				'default' => 'ADD AN ATTACHMENT',
				'condition' => [
					'styled_attach' => 'yes'
				]
			]
		);

		$this->add_control(
			'attach-icon',
			[
				'label' => __('Icon (Code)', 'geekfolio_plg'),
				'type' => Controls_Manager::TEXT,
				'default' => 'la la-paperclip',
				'placeholder' => 'Embed Icon',
				'condition' => [
					'styled_attach' => 'yes'
				]
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'fields_settings',
			[
				'label' => __( 'Fields Setting','geekfolio_plg' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_responsive_control(
			'fields_width',
			[
				'label' => esc_html__( 'Field Width', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode .form-group' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'fields_in_row' => 'yes',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'fields_typography',
				'label'     => __('Typography', 'geekfolio_plg'),
				'selector'  => '{{WRAPPER}} .geekfolio-contact-shortcode input:not([type="submit"]), {{WRAPPER}} .geekfolio-contact-shortcode select, {{WRAPPER}} .geekfolio-contact-shortcode textarea, {{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-textarea, {{WRAPPER}} .geekfolio-contact-shortcode input::placeholder, {{WRAPPER}} .geekfolio-contact-shortcode textarea::placeholder',
			]
		);

		$this->add_control(
			'fields_text_color',
			[
				'label' => __('Input Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode input:not([type="submit"]), {{WRAPPER}} .geekfolio-contact-shortcode select, {{WRAPPER}} .geekfolio-contact-shortcode textarea' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'field_background',
				'label' => esc_html__('Field Background', 'geekfolio_plg'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .geekfolio-contact-shortcode input,{{WRAPPER}} .geekfolio-contact-shortcode select',
			]
		);

		$this->add_responsive_control(
			'fields_padding',
			[
				'label' => __('Padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode input:not([type="submit"], [type="checkbox"]), {{WRAPPER}} .geekfolio-contact-shortcode select, {{WRAPPER}} .geekfolio-contact-shortcode textarea' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'fields_margin',
			[
				'label' => __('Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode .form-group' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-form-control-wrap' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'fields_select_padding',
			[
				'label' => __('Select Padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode select' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'fields_select_margin',
			[
				'label' => __('Select Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode select' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'fields_height',
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
					'{{WRAPPER}} .geekfolio-contact-shortcode input:not([type="submit"], [type="checkbox"]), {{WRAPPER}} .geekfolio-contact-shortcode select, {{WRAPPER}} .geekfolio-contact-shortcode textarea' => 'min-height:{{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs('tabs_fields_style');

		$this->start_controls_tab(
			'tab_fields_normal',
			[
				'label' => esc_html__('Normal', 'geekfolio_plg'),
			]
		);

		$this->add_control(
			'fields_placeholder_color',
			[
				'label' => __('Placeholder Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode input::placeholder, {{WRAPPER}} .geekfolio-contact-shortcode textarea::placeholder' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'field_alignment',
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
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode input:not([type="submit"], [type="checkbox"]), {{WRAPPER}} .geekfolio-contact-shortcode select, {{WRAPPER}} .geekfolio-contact-shortcode textarea' => 'text-align: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'fields_border',
				'selector' => '{{WRAPPER}} .geekfolio-contact-shortcode input:not([type="submit"], [type="checkbox"]), {{WRAPPER}} .geekfolio-contact-shortcode select, {{WRAPPER}} .geekfolio-contact-shortcode textarea',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'fields_border_radius',
			[
				'label' => __('Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode input:not([type="submit"], [type="checkbox"]), {{WRAPPER}} .geekfolio-contact-shortcode select, {{WRAPPER}} .geekfolio-contact-shortcode textarea' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'fields_box_shadow',
				'selector' => '{{WRAPPER}} .geekfolio-contact-shortcode input:not([type="submit"]), {{WRAPPER}} .geekfolio-contact-shortcode select, {{WRAPPER}} .geekfolio-contact-shortcode textarea',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_fields_focus',
			[
				'label' => esc_html__('Focus', 'geekfolio_plg'),
			]
		);

		$this->add_control(
			'fields_placeholder_color_focus',
			[
				'label' => __('Placeholder Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode input:focus::placeholder, {{WRAPPER}} .geekfolio-contact-shortcode textarea:focus::placeholder' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'fields_border_focus',
				'selector' => '{{WRAPPER}} .geekfolio-contact-shortcode input:focus:not([type="submit"], [type="checkbox"]), {{WRAPPER}} .geekfolio-contact-shortcode select:focus, {{WRAPPER}} .geekfolio-contact-shortcode textarea:focus',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'fields_border_radius_focus',
			[
				'label' => __('Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode input:focus:not([type="submit"], [type="checkbox"]), {{WRAPPER}} .geekfolio-contact-shortcode select:focus, {{WRAPPER}} .geekfolio-contact-shortcode textarea:focus' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'fields_box_shadow_focus',
				'selector' => '{{WRAPPER}} .geekfolio-contact-shortcode input:focus:not([type="submit"]), {{WRAPPER}} .geekfolio-contact-shortcode select:focus, {{WRAPPER}} .geekfolio-contact-shortcode textarea:focus',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'textarea_settings',
			[
				'label' => __( 'Textarea Setting','geekfolio_plg' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'textarea_background',
				'label' => esc_html__('Textarea Background', 'geekfolio_plg'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .geekfolio-contact-shortcode textarea',
			]
		);

		$this->add_responsive_control(
			'textarea_margin',
			[
				'label' => __('Textarea Margim', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode textarea' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'textarea_height',
			[
				'label' => esc_html__( 'Textarea Height', 'geekfolio_plg' ),
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
					'{{WRAPPER}} .geekfolio-contact-shortcode textarea' => 'height:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-contact-shortcode textarea' => 'max-height:{{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'form-group-style',
			[
				'label' => __('Form Group Style', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_responsive_control(
			'form_group_padding',
			[
				'label' => __('Padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode .form-group' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'form_group_border',
				'selector' => '{{WRAPPER}} .geekfolio-contact-shortcode .form-group',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'label_style',
			[
				'label' => __('Label Style', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'field_label_color',
			[
				'label' => __('Fields Label Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode label' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'field_label_typo',
				'label'     => __('Typography', 'geekfolio_plg'),
				'selector'  => '{{WRAPPER}} .geekfolio-contact-shortcode label',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'button_settings',
			[
				'label' => __( 'Button Setting','geekfolio_plg' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_responsive_control(
			'button_width',
			[
				'label' => esc_html__( 'Button Width', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-submit' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-contact-shortcode .form-group+p' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-contact-shortcode .geekfolio-button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_alignment',
			[
				'label' => __('Button Alignment', 'geekfolio_plg'),
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
				'default' => 'center',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'button_typography',
				'label'     => __('Typography', 'geekfolio_plg'),
				'selector'  => '{{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-submit, {{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-submit .button_text_container',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => __('Inner Padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-submit' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_margin',
			[
				'label' => __('Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode .geekfolio-button' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$this->add_control(
			'button_text_color',
			[
				'label' => __('Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-submit .button_text_container, {{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-submit' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_background',
				'label' => esc_html__('Background', 'geekfolio_plg'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-submit',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-submit',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label' => __('Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-submit' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-contact-shortcode .geekfolio-button' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-submit, {{WRAPPER}} .geekfolio-contact-shortcode .geekfolio-button',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__('Hover', 'geekfolio_plg'),
			]
		);

		$this->add_control(
			'button_text_color_hover',
			[
				'label' => __('Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-submit:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_background_hover',
				'label' => esc_html__('Background', 'geekfolio_plg'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-submit:hover',
				'condition' => [
					'animated_btn!' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'animated_button_background_hover',
				'label' => esc_html__('Background', 'geekfolio_plg'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .geekfolio-contact-shortcode .geekfolio-button-circle',
				'condition' => [
					'animated_btn' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border_hover',
				'selector' => '{{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-submit:hover',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'button_border_radius_hover',
			[
				'label' => __('Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-submit:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-submit:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		
		$this->end_controls_section();

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
					'{{WRAPPER}} .geekfolio-contact-shortcode .icon' => 'left: {{SIZE}}{{UNIT}}; right: auto !important;',
				],
				'condition' => [
					'x_positioning' => 'left'
				]
			]
		);

		$this->add_responsive_control(
			'icon_x_right',
			[
				'label' => __( 'Icon X (Right) Position', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 500,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode .icon' => 'right: {{SIZE}}{{UNIT}}; left: auto !important;',
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
					'{{WRAPPER}} .geekfolio-contact-shortcode .icon' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 150,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode .icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		
		$this->add_responsive_control(
			'width',
			[
				'label' => __( 'Width', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 500,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode .icon' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label' => __( 'Height', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 500,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode .icon' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'icon_background',
				'label' => esc_html__('Icon Background', 'geekfolio_plg'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .geekfolio-contact-shortcode .icon',
			]
		);


		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 150,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode .icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color','geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode .icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_drop_shadow',
			[
				'label' => esc_html__('Button Drop Shadow', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_drop_shadow_offset_x',
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
			'button_drop_shadow_offset_y',
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
			'button_drop_shadow_blur_radius',
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
			'button_drop_shadow_color',
			[
				'label' => __('Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-submit' => 'filter: drop-shadow({{button_drop_shadow_offset_x.SIZE}}px {{button_drop_shadow_offset_y.SIZE}}px {{button_drop_shadow_blur_radius.SIZE}}px {{VALUE}});',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'check_box_settings',
			[
				'label' => __( 'Check Box Setting','geekfolio_plg' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'check_box_typography',
				'label'     => __('Typography', 'geekfolio_plg'),
				'selector'  => '{{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-list-item span',
			]
		);

		$this->add_control(
			'check_box_color',
			[
				'label' => __('Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-list-item span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'checkbox_background',
				'label' => esc_html__('Checkbox Background', 'geekfolio_plg'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .geekfolio-contact-shortcode input[type=checkbox]',
			]
		);

		$this->add_responsive_control(
			'checkbox_width',
			[
				'label' => __( 'Width', 'geekfolio_plg' ),
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
					'{{WRAPPER}} .geekfolio-contact-shortcode input[type=checkbox]' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'checkbox_height',
			[
				'label' => __( 'Height', 'geekfolio_plg' ),
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
					'{{WRAPPER}} .geekfolio-contact-shortcode input[type=checkbox]' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'checked',
			[
				'label' => __('Checked Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.geekfolio-contact-shortcode input:checked[type=checkbox]' => 'border-color: {{VALUE}}; background-color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'checkbox_border',
				'selector' => '{{WRAPPER}} .geekfolio-contact-shortcode input[type=checkbox]',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'check_box_alignment',
			[
				'label' => __('Button Alignment', 'geekfolio_plg'),
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
					'{{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-list-item' => 'text-align-last: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'check_box_margin',
			[
				'label' => __('Check Box Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form-control-wrap .upload_img_content .file__input .file__input--label i' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'animated_button_section_style',
			[
				'label' => esc_html__('Animated Button', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'animated_btn' => 'yes'
				]
			]
		);

		$this->start_controls_tabs('tabs_animated_button_style');

		$this->start_controls_tab(
			'tab_animated_button_normal',
			[
				'label' => esc_html__('Normal', 'geekfolio_plg'),
			]
		);
		
		$this->add_control(
			'animated_button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .geekfolio-button .butn span' => 'color: {{VALUE}}; fill: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-button .butn span i' => 'color: {{VALUE}}; fill: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-button .butn span svg path' => ' fill: {{VALUE}};',
				],
				'condition' => [
					'btn_type' => 'normal'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'animated_button_typography',
				'selector' => '{{WRAPPER}} .geekfolio-button .butn span',
				'condition' => [
					'btn_type' => 'normal'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'animated_button_background',
				'label' => esc_html__('Background', 'geekfolio_plg'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .geekfolio-button',

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
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'animated_button_border',
				'selector' => '{{WRAPPER}} .geekfolio-button .butn',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'animated_button_border_radius',
			[
				'label' => esc_html__('Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-button .butn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'animated_button_padding',
			[
				'label' => esc_html__('Padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-button .butn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_animated_button_hover',
			[
				'label' => esc_html__('Hover', 'geekfolio_plg'),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'animated_button_background_hover',
				'label' => esc_html__('Hover Background', 'geekfolio_plg'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .geekfolio-button .geekfolio-button-circle',

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
			'animated_button_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .geekfolio-button:hover .butn span' => 'color: {{VALUE}}; fill: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-button:hover .butn span i' => 'color: {{VALUE}}; fill: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-button:hover .butn span svg path' => ' fill: {{VALUE}};',
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'attachment_style',
			[
				'label' => __('Attachment Style', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'attach_typography',
				'label'     => __('Typography', 'geekfolio_plg'),
				'selector'  => '{{WRAPPER}} .wpcf7-form-control-wrap .upload_img_content .file__input .file__input--label',
			]
		);
		$this->add_control(
			'span_color',
			[
				'label' => __('Span Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form-control-wrap .upload_img_content .file__input .file__input--label span' => 'color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'color',
			[
				'label' => __('Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form-control-wrap .upload_img_content .file__input .file__input--label' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'attach_icon_color',
			[
				'label' => __('Icon Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form-control-wrap .upload_img_content .file__input .file__input--label i' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_responsive_control(
			'attach_margin',
			[
				'label' => __('Textarea Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .wpcf7-form-control-wrap .upload_img_content .file__input .file__input--label i' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'radio_button',
			[
				'label' => __('Radio Button Styles', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'margin_group',
			[
				'label' => __('Group Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-radio' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important'
				]
			]
		);

		$this->start_controls_tabs('radio');
		$this->start_controls_tab(
			'normal',
			[
				'label' => __('Normal', 'geekfolio_plg')
			]
		);
		$this->add_control(
			'margins',
			[
				'label' => __('Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode input[type=radio]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important'
				]
			]
		);

		$this->add_control(
			'padding',
			[
				'label' => __('Padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode input[type=radio]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important'
				]
			]
		);

		$this->add_control(
			'border-radius',
			[
				'label' => __('Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode input[type=radio]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .geekfolio-contact-shortcode input[type=radio]',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'radio_width',
			[
				'label' => esc_html__('Width', 'geekfolio_plg'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode input[type=radio]' => 'width: {{SIZE}}{{UNIT}} !important; -webkit-appearance: none;',
				],
			]
		);
		
		$this->add_responsive_control(
			'radio_height',
			[
				'label' => esc_html__('Height', 'geekfolio_plg'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode input[type=radio]' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'label_color',
			[
				'label' => __('Label Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-radio .wpcf7-list-item-label' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'label_typography',
				'label'     => __('Label Typograpghy', 'geekfolio_plg'),
				'selector'  => '{{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-radio .wpcf7-list-item-label',
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'radio_checked',
			[
				'label' => __('Checked', 'geekfolio_plg')
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'radio_background',
				'label' => esc_html__('Background', 'geekfolio_plg'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-form-control-wrap .wpcf7-radio .wpcf7-list-item label input:checked',

				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
					'color' => [
						'selectors' => [
							'{{SELECTOR}}' => 'background: {{color.VALUE}};',
						],
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_checked',
				'selector' => '{{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-form-control-wrap .wpcf7-radio .wpcf7-list-item label input:checked',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-form-control-wrap .wpcf7-radio .wpcf7-list-item label input:checked',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'label_color_checked',
			[
				'label' => __('Label Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-form-control-wrap .wpcf7-radio .wpcf7-list-item label input:checked + .wpcf7-list-item-label' => 'color: {{VALUE}} !important'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'label_typography_checked',
				'label'     => __('Label Typograpghy', 'geekfolio_plg'),
				'selector'  => '{{WRAPPER}} .geekfolio-contact-shortcode .wpcf7-form-control-wrap .wpcf7-radio .wpcf7-list-item label input:checked + .wpcf7-list-item-label',
			]
		);
	
		$this->end_controls_tab();
		$this->end_controls_tabs();
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
		$animated_btn_icon = $settings['animated_btn_icon'] ? ' data-btnIcon="'.$settings['animated_btn_icon'].'"' : 'data-btnIcon="false"';
		$animated_btn_img = !empty($settings['animated_btn_img']['url']) ? 'data-btnImg="'.$settings['animated_btn_img']['url'].'"' : '';
		$shortcode=do_shortcode( '[contact-form-7 id="'. $id .'"]' ); ?>

		<div <?php echo $animated_btn_img . $animated_btn_icon; ?> data-attachmentIcon="<?php echo $settings['attach-icon']; ?>" data-attachmentText="<?php echo $settings['attach-text']; ?>" class="geekfolio-contact-shortcode <?php if($settings['styled_attach'] == 'yes'){echo 'file__attach '.$settings['styled_attach_style'];} ?> button-<?php echo esc_attr($settings['button_alignment']); if($settings['fields_in_row'] == 'yes') echo ' fields-in-row'; if($settings['animated_btn'] == 'yes') echo ' animated-button'; ?>"><?php echo $shortcode; ?></div>
	
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


