<?php
namespace GeekfolioPlugin\Widgets;

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
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
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Scheme_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor image widget.
 *
 * Elementor widget that displays an image into the page.
 *
 * @since 1.0.0
 */
class Geekfolio_Image extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve image widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'geekfolio-image';
	}

    //script depend
	public function get_script_depends() { 
        return [ 'lity', 'geekfolio-parallax', 'geekfolio-image-parallax', 'splitting' ]; 
    }

	/**
	 * Get widget title.
	 *
	 * Retrieve image widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Geekfolio Image', 'geekfolio_plg' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve image widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-image';
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
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'image', 'photo', 'visual' ];
	}

	/**
	 * Register image widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.1.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_image',
			[
				'label' => esc_html__( 'Image', 'geekfolio_plg' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'geekfolio_plg' ),
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
			'label',
			[
				'label' => __('Label', 'geekfolio_plg'),
				'type' => Controls_Manager::TEXT
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'large',
				'separator' => 'none',
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
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'caption_source',
			[
				'label' => esc_html__( 'Caption', 'geekfolio_plg' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__( 'None', 'geekfolio_plg' ),
					'attachment' => esc_html__( 'Attachment Caption', 'geekfolio_plg' ),
					'custom' => esc_html__( 'Custom Caption', 'geekfolio_plg' ),
				],
				'default' => 'none',
			]
		);

		$this->add_control(
			'caption',
			[
				'label' => esc_html__( 'Custom Caption', 'geekfolio_plg' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => esc_html__( 'Enter your image caption', 'geekfolio_plg' ),
				'condition' => [
					'caption_source' => 'custom',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'link_to',
			[
				'label' => esc_html__( 'Link', 'geekfolio_plg' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__( 'None', 'geekfolio_plg' ),
					'file' => esc_html__( 'Media File', 'geekfolio_plg' ),
					'custom' => esc_html__( 'Custom URL', 'geekfolio_plg' ),
					'video-popup' => esc_html__( 'Video Pop-Up', 'geekfolio_plg' ),
				],
			]
		);

		$this->add_control(
			'show_link_on_hover',
			[
				'label' => __('Show Link On Hover', 'geekfolio_plg'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'label_on' => __('On', 'geekfolio_plg'),
				'label_off' => __('Off', 'geekfolio_plg'),
				'default' => ''
			]
		);

		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'geekfolio_plg' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'geekfolio_plg' ),
				'condition' => [
					'link_to' => ['custom', 'video-popup'],
				],
				'show_label' => false,
			]
		);

		$this->add_control(
			'link_text',
			[
				'label' => __('Link Text', 'geekfolio_plg'),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'link_to' => 'custom',
				],
			]
		);

		$this->add_control(
			'open_lightbox',
			[
				'label' => esc_html__( 'Lightbox', 'geekfolio_plg' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__( 'Default', 'geekfolio_plg' ),
					'yes' => esc_html__( 'Yes', 'geekfolio_plg' ),
					'no' => esc_html__( 'No', 'geekfolio_plg' ),
				],
				'condition' => [
					'link_to' => 'file',
				]
			]
		);

		$this->add_control(
			'view',
			[
				'label' => esc_html__( 'View', 'geekfolio_plg' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__( 'Image', 'geekfolio_plg' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'space',
			[
				'label' => esc_html__( 'Max Width', 'geekfolio_plg' ),
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
					'{{WRAPPER}} img' => 'max-width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} img' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-widget-container' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'object-fit',
			[
				'label' => esc_html__( 'Object Fit', 'geekfolio_plg' ),
				'type' => Controls_Manager::SELECT,
				'condition' => [
					'height[size]!' => '',
				],
				'options' => [
					'' => esc_html__( 'Default', 'geekfolio_plg' ),
					'fill' => esc_html__( 'Fill', 'geekfolio_plg' ),
					'cover' => esc_html__( 'Cover', 'geekfolio_plg' ),
					'contain' => esc_html__( 'Contain', 'geekfolio_plg' ),
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} img' => 'object-fit: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'separator_panel_style',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->start_controls_tabs( 'image_effects' );

		$this->start_controls_tab( 'normal',
			[
				'label' => esc_html__( 'Normal', 'geekfolio_plg' ),
			]
		);

		$this->add_control(
			'opacity',
			[
				'label' => esc_html__( 'Opacity', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} img',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} img',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'container_border',
				'label' => __('Container Border', 'geekfolio_plg'),
				'selector' => '{{WRAPPER}} .geekfolio-image',
				'fields_options' => [
					'border' => [
						'label' => __('Container Border', 'geekfolio_plg')
					]
				]
			]
		);

        $this->add_control(
            'container_border_color_dark',
            [
                'label' => __('Container Border Color ( Dark Mode )', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-image' => 'border-color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-image' => 'border-color: {{VALUE}};',
				],
            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => esc_html__( 'Hover', 'geekfolio_plg' ),
			]
		);

		$this->add_control(
			'opacity_hover',
			[
				'label' => esc_html__( 'Opacity', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}}:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters_hover',
				'selector' => '{{WRAPPER}}:hover img',
			]
		);

		$this->add_control(
			'background_hover_transition',
			[
				'label' => esc_html__( 'Transition Duration', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'transition-duration: {{SIZE}}s',
					'{{WRAPPER}} .geekfolio-image' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'geekfolio_plg' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border_hover',
				'selector' => '{{WRAPPER}}:hover img',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'container_border_hover',
				'label' => __('Container Border', 'geekfolio_plg'),
				'selector' => '{{WRAPPER}}:hover .geekfolio-image',
				'fields_options' => [
					'border' => [
						'label' => __('Container Border', 'geekfolio_plg')
					]
				]
			]
		);

        $this->add_control(
            'container_border_color_hover_dark',
            [
                'label' => __('Container Border Color ( Dark Mode )', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}}:hover .geekfolio-image' => 'border-color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}}:hover .geekfolio-image' => 'border-color: {{VALUE}};',
				],
            ]
        );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'invert_dark',
			[
				'label' => esc_html__( 'Invert ( Dark )', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'geekfolio_plg' ),
				'label_off' => esc_html__( 'No', 'geekfolio_plg' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'geekfolio_plg' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'image_container_border_radius',
			[
				'label' => esc_html__( 'Container Border Radius', 'geekfolio_plg' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_padding_container',
			[
				'label' => __('Padding Container', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-image' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_padding',
			[
				'label' => __('Padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} img' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} img',
			]
		);

		$this->add_control(
			'parallax',
			[
				'label' => esc_html__( 'Parallax', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'geekfolio_plg' ),
				'label_off' => esc_html__( 'Hide', 'geekfolio_plg' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'parallax_speed',
			[
				'label' => esc_html__( 'Parallax Speed', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => -100,
				'max' => 100,
				'step' => 0.01,
				'default' => 0.01,
				'condition' => [
					'parallax' => 'yes'
				]
			]
		);

		$this->add_control(
			'loading_animation',
			[
				'label' => esc_html__( 'Loading Animation', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'geekfolio_plg' ),
				'label_off' => esc_html__( 'Hide', 'geekfolio_plg' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'loading_animation_duration',
			[
				'label' => esc_html__( 'Parallax Speed', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => -100,
				'max' => 100,
				'step' => 0.01,
				'default' => 0.01,
				'condition' => [
					'loading_animation' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_caption',
			[
				'label' => esc_html__( 'Caption', 'geekfolio_plg' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'caption_source!' => 'none',
				],
			]
		);

		$this->add_control(
			'caption_align',
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
					'{{WRAPPER}} .widget-image-caption' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .widget-image-caption' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);

		$this->add_control(
			'caption_background_color',
			[
				'label' => esc_html__( 'Background Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-image-caption' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'caption_typography',
				'selector' => '{{WRAPPER}} .widget-image-caption',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'caption_text_shadow',
				'selector' => '{{WRAPPER}} .widget-image-caption',
			]
		);

		$this->add_responsive_control(
			'caption_space',
			[
				'label' => esc_html__( 'Spacing', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .widget-image-caption' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'label_styles',
			[
				'label' => __('Label Styles', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_responsive_control(
			'label_margin',
			[
				'label' => __('Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} h5' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'label_text_color',
			[
				'label' => esc_html__( 'Text Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} h5' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'selector' => '{{WRAPPER}} h5',

			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'link_styles',
			[
				'label' => __('Link Text Styles', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'link_text_color',
			[
				'label' => esc_html__( 'Link Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-img-split .split-link' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'link_typography',
				'selector' => '{{WRAPPER}} .geekfolio-img-split .split-link',

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
					'{{WRAPPER}} img' => 'filter: drop-shadow({{drop_shadow_offset_x.SIZE}}px {{drop_shadow_offset_y.SIZE}}px {{drop_shadow_blur_radius.SIZE}}px {{VALUE}});',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Check if the current widget has caption
	 *
	 * @access private
	 * @since 2.3.0
	 *
	 * @param array $settings
	 *
	 * @return boolean
	 */
	private function has_caption( $settings ) {
		return ( ! empty( $settings['caption_source'] ) && 'none' !== $settings['caption_source'] );
	}

	/**
	 * Get the caption for current widget.
	 *
	 * @access private
	 * @since 2.3.0
	 * @param $settings
	 *
	 * @return string
	 */
	private function get_caption( $settings ) {
		$caption = '';
		if ( ! empty( $settings['caption_source'] ) ) {
			switch ( $settings['caption_source'] ) {
				case 'attachment':
					$caption = wp_get_attachment_caption( $settings['image']['id'] );
					break;
				case 'custom':
					$caption = ! Utils::is_empty( $settings['caption'] ) ? $settings['caption'] : '';
			}
		}
		return $caption;
	}

	/**
	 * Render image widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['image']['url'] ) ) {
			return;
		}

		if ( ! Plugin::$instance->experiments->is_feature_active( 'e_dom_optimization' ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'elementor-image' );
		}

		$has_caption = $this->has_caption( $settings );

		$link = $this->get_link_url( $settings ); ?>

		<div class="geekfolio-image <?php if($settings['invert_dark'] == 'yes') echo 'geekfolio-invert-dark'; ?> <?php if($settings['show_link_on_hover'] == 'yes') echo 'geekfolio-img-split'; ?> <?php if($settings['parallax'] == 'yes') echo esc_attr("parallax"); if($settings['loading_animation'] == 'yes') echo 'imago wow'; ?>"  <?php if($settings['parallax'] == 'yes') echo 'data-speed="'.$settings['parallax_speed'].'"'; ?>>

		<?php

			if ( $link ) {
				$this->add_link_attributes( 'link', $link );

				if ( Plugin::$instance->editor->is_edit_mode() ) {
					$this->add_render_attribute( 'link', [
						'class' => 'elementor-clickable',
					] );
				}

				if ( 'custom' !== $settings['link_to'] && 'video-popup' !== $settings['link_to'] ) {
					$this->add_lightbox_data_attributes( 'link', $settings['image']['id'], $settings['open_lightbox'] );
				}
			} ?>
			<?php if ( ! Plugin::$instance->experiments->is_feature_active( 'e_dom_optimization' ) ) { ?>
				<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<?php } ?>
				<?php if ( $has_caption ) : ?>
					<figure class="wp-caption">
				<?php endif; ?>
				<?php if ( $link && $settings['link_to'] != 'video-popup' ) : ?>
						<a <?php $this->print_render_attribute_string( 'link' ); ?>>
				<?php endif; ?>
					<?php Group_Control_Image_Size::print_attachment_image_html( $settings ); 
					if($settings['link_to'] == 'video-popup'): ?>
						<a <?php $this->print_render_attribute_string( 'link' ); ?> data-lity="" class="vid_icon"><i class="fas fa-play"></i></a>
					<?php endif; ?>
				<?php if ( $link && $settings['link_to'] != 'video-popup' ) : ?>
						</a>
				<?php endif; ?>
				<?php if ( $has_caption ) : ?>
						<figcaption class="widget-image-caption wp-caption-text"><?php
							echo wp_kses_post( $this->get_caption( $settings ) );
						?></figcaption>
				<?php endif; ?>
				<?php if ( $has_caption ) : ?>
					</figure>
				<?php endif; ?>
				<?php if(!empty($settings['label'])) : ?>
				<h5><?php echo __($settings['label'], 'geekfolio_plg'); ?></h5>
				<?php endif; ?>
			<?php if ( ! Plugin::$instance->experiments->is_feature_active( 'e_dom_optimization' ) ) { ?>
				</div>
			<?php } ?>
			<?php if($settings['show_link_on_hover'] == 'yes') : ?>
				<a href="<?php echo esc_url($settings['link']['url']); ?>" class="split-link" data-splitting><?php echo __($settings['link_text']); ?></a>
			<?php endif; ?>

		</div>

		<?php
	}

	/**
	 * Render image widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */
	protected function content_template() {
	}

	/**
	 * Retrieve image widget link URL.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @param array $settings
	 *
	 * @return array|string|false An array/string containing the link URL, or false if no link.
	 */
	private function get_link_url( $settings ) {
		if ( 'none' === $settings['link_to'] ) {
			return false;
		}

		if ( 'custom' === $settings['link_to'] || 'video-popup' === $settings['link_to'] ) {
			if ( empty( $settings['link']['url'] ) ) {
				return false;
			}

			return $settings['link'];
		}

		return [
			'url' => $settings['image']['url'],
		];
	}
}
