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
class Geekfolio_Text_Circle extends Widget_Base{

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
		return 'geekfolio-text-circle';
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
		return __('Geekfolio Text Circle', 'geekfolio_plg');
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
		return ' eicon-spinner';
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
			'text',
			[
				'label' => esc_html__( 'Text', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'geekfolio_plg' ),
			]
		);
		
		$this->add_control(
			'inner_icon',
			[
				'label' => esc_html__( 'Inner Icon', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'toggle' => false,
				'default' => 'icon',
				'options' => [
					'none' => [
						'title' => __('None', 'geekfolio_plg'),
						'icon' => 'eicon-ban',
					],
					'icon' => [
						'title' => __('Icon', 'geekfolio_plg'),
						'icon' => 'eicon-dot-circle-o',
					],
					'img' => [
						'title' => __('Image', 'geekfolio_plg'),
						'icon' => 'eicon-image-bold',
					],
					'text' => [
						'title' => __('Text', 'geekfolio_plg'),
						'icon' => 'eicon-t-letter-bold',
					],
				],
			]
		);

		$this->add_control(
			'inside_text',
			[
				'label' => esc_html__( 'Text', 'geekfolio_plg' ),
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
			'selected_icon',
			[
				'label' => esc_html__('Icon', 'geekfolio_plg'),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin' => 'inline',
				'label_block' => false,
				'condition' => [
					'inner_icon' => 'icon'
				]
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
				'condition' => [
					'inner_icon' => 'img'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'circle_style',
			[
				'label' => __('Circle', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'alignment',
			[
				'label' => __(' Alignment', 'geekfolio_plg'),
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
				'default' => 'center',

			]
		);
		$this->add_control(
            'width',
            [
				'label' => esc_html__('Width', 'zumar_plg'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-rotate-box .geekfolio-rotate-circle svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-rotate-box' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
        );

		$this->add_control(
            'duration',
            [
				'label' => esc_html__('Animation Duration (ms)', 'zumar_plg'),
				'type' => Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-text-circle .geekfolio-rotate-box .geekfolio-rotate-text' => 'animation-duration: {{VALUE}}ms;',
				],
			]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .geekfolio-rotate-box .geekfolio-rotate-text',
			]
		);

		$this->add_control(
			'blur',
			[
				'label' => __('Blur (px)', 'geekfolio_plg'),
				'type' => Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-rotate-box .geekfolio-rotate-text' => 'backdrop-filter: blur({{VALUE}}px);'
				],
				'default' => '0'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'width' => [
						'default' => [
							'top' => '1',
							'right' => '1',
							'bottom' => '1',
							'left' => '1',
						],
					],
					'color' => [
						'default' => '#9999',
					],
				],
				'selector' => '{{WRAPPER}} .geekfolio-rotate-box .geekfolio-rotate-text',
			]
		);
		$this->add_responsive_control(
			'border_radius',
			[
				'label' => esc_html__( 'Border Redius', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'unit' => '%',
					'top' => 50,
					'bottom' => 50,
					'left' => 50,
					'right' => 50,
				] ,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-rotate-box .geekfolio-rotate-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'text_style',
			[
				'label' => __('Text', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE,

			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .geekfolio-rotate-box .geekfolio-rotate-text',
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Color', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-text-circle .geekfolio-rotate-box .geekfolio-rotate-circle svg' => 'fill: {{VALUE}}; color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'icon_style',
			[
				'label' => __('Icon', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE,

			]
		);
		$this->add_responsive_control(
			'size',
			[
				'label' => esc_html__( 'Size', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 45,
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-rotate-box .geekfolio-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-rotate-box .geekfolio-icon svg' => 'width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-rotate-box .geekfolio-icon img' => 'width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Color', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-rotate-box .geekfolio-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .geekfolio-rotate-box .geekfolio-icon svg ' =>'fill: {{VALUE}}',

				],
			]
		);
		$this->add_control(
			'icon_bg',
			[
				'label' => esc_html__( 'Icon Background', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-rotate-box .geekfolio-icon' => 'background: {{VALUE}}',

				],
			]
		);
		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__( 'Padding', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'unit' => 'px',
					'top' => 5,
					'bottom' => 5,
					'left' => 5,
					'right' => 5,
				] ,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-rotate-box .geekfolio-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'selector' => '{{WRAPPER}} .geekfolio-rotate-box .geekfolio-icon',
			]
		);

		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label' => esc_html__( 'Border Redius', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-rotate-box .geekfolio-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
        $id = uniqid();
	 ?>
	 <div class="geekfolio-text-circle">
		
		<div class="geekfolio-rotate-box">
			<span class="geekfolio-rotate-circle geekfolio-rotate-text">
				<svg class="geekfolio-textcircle" viewBox="0 0 500 500">
					<defs>
						<path id="geekfolio-textcircle-<?php echo $id; ?>" d="M250,400 a150,150 0 0,1 0,-300a150,150 0 0,1 0,300Z">
						</path>
					</defs>
					<text>
						<textPath xlink:href="#geekfolio-textcircle-<?php echo $id; ?>" textLength="900"><?php echo $settings['text'] ;?></textPath>
					</text>
				</svg>
			</span>
			<div class="geekfolio-icon">
			<?php
		
				if($settings['inner_icon'] == 'icon' && $settings['selected_icon']['value'] != ''){
					Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true']);
				} elseif($settings['inner_icon'] == 'img' && $settings['image']['url'] != ''){
					echo '<img src="' . $settings['image']['url'] . '" />';
				} elseif($settings['inner_icon'] == 'text' && $settings['inside_text'] != ''){
					echo '<h3>'. $settings['inside_text'] .'</h3>';
				}
			?>
			</div>
			
		</div>

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
