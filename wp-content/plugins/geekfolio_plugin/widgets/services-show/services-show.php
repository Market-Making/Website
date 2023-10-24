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
class Geekfolio_Services_Show extends Widget_Base
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
		return 'geekfolio-services-show';
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
		return __('Geekfolio Services Show', 'geekfolio_plg');
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
		return 'eicon-carousel';
	}

    public function get_script_depends()
    {
        return ['geekfolio-hover-reveal'];
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
        $repeater = new Repeater();

        $repeater->add_control(
            'service_icon',
            [
                'label' => __('Service Icon', 'geekfolio_plg'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
            ]
        );

        $repeater->add_control(
            'service_title',
            [
                'label' => __('Service Title', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'service_image',
            [
                'label' => __('Service Image', 'geekfolio_plg'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
            ]
        );

        $repeater->add_control(
            'service_url',
            [
                'label' => __('Service URL', 'geekfolio_plg'),
                'type' => Controls_Manager::URL
            ]
        );

        $this->add_control(
            'services_repeater',
            [
                'label' => __('Services', 'geekfolio_plg'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{service_title}}}'
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'card_styles',
            [
                'label' => __('Card Styles', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'card_margin',
			[
				'label' => esc_html__('Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-services-show .block__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .geekfolio-services-show .block__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .geekfolio-services-show .block__title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .geekfolio-services-show .block__title' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .geekfolio-services-show .block__title',
            ]
		);
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'card_border',
				'selector' => '{{WRAPPER}} .geekfolio-services-show .block__title',
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
				'selector' => '{{WRAPPER}} .geekfolio-services-show .block__title:hover',
            ]
		);
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'card_border_hover',
				'selector' => '{{WRAPPER}} .geekfolio-services-show .block__title:hover',
			]
		);
        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->end_controls_section();

        // Title Styles -------------------------------

        $this->start_controls_section(
            'title_style',
            [
                'label' => __('Title Styles', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__('Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-services-show h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
                'label' => __('Title Typography', 'geekfolio_plg'),
				'selector' => '{{WRAPPER}} .geekfolio-services-show h5',
			]
        );
        $this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-services-show h5' => 'color: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-services-show .arrow svg' => 'color : {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'title_stroke',
				'selector' => '{{WRAPPER}} .geekfolio-services-show h5',
			]
		);
        $this->end_controls_section();

        // Service Icon Style -------------------------------

        $this->start_controls_section(
            'icon_styles',
            [
                'label' => __('Icon Styles', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_responsive_control(
			'width_icon',
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
					'{{WRAPPER}} .icon-img' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'height_icon',
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
					'{{WRAPPER}} .icon-img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();

        // Service Image Styles ----------------------------

        $this->start_controls_section(
            'service_image_Styles',
            [
                'label' => __('Image Styles', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

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
					'{{WRAPPER}}  .hover-reveal' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}}  .hover-reveal' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
    }

    protected function render(){
        $settings = $this->get_settings();
        ?>
            <div class="geekfolio-services-show">
                <ul class="rest">
                    <?php foreach($settings['services_repeater'] as $index => $item) : ?>
                    <li class="block" data-fx="1">
                        <a href="<?php echo esc_url($item['service_url']['url']); ?>" class="block__title" data-img="<?php echo esc_url($item['service_image']['url']); ?>">
                            <div class="d-flex align-items-center">
                                <div class="mr-80">
                                    <span class="icon-img <?php if($settings['invert_dark'] == 'yes') echo 'invert-dark' ?>">
                                        <img src="<?php echo esc_url($item['service_icon']['url']); ?>" class="w-100 h-100 object-fit-contain" alt="">
                                    </span>
                                </div>
                                <div>
                                    <h5><?php echo __($item['service_title']) ?></h5>
                                </div>
                                <div class="ml-auto">
                                    <div class="arrow">
                                        <span class="circle">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.922 4.5V11.8125C13.922 11.9244 13.8776 12.0317 13.7985 12.1108C13.7193 12.1899 13.612 12.2344 13.5002 12.2344C13.3883 12.2344 13.281 12.1899 13.2018 12.1108C13.1227 12.0317 13.0783 11.9244 13.0783 11.8125V5.51953L4.79547 13.7953C4.71715 13.8736 4.61092 13.9176 4.50015 13.9176C4.38939 13.9176 4.28316 13.8736 4.20484 13.7953C4.12652 13.717 4.08252 13.6108 4.08252 13.5C4.08252 13.3892 4.12652 13.283 4.20484 13.2047L12.4806 4.92188H6.18765C6.07577 4.92188 5.96846 4.87743 5.88934 4.79831C5.81023 4.71919 5.76578 4.61189 5.76578 4.5C5.76578 4.38811 5.81023 4.28081 5.88934 4.20169C5.96846 4.12257 6.07577 4.07813 6.18765 4.07812H13.5002C13.612 4.07813 13.7193 4.12257 13.7985 4.20169C13.8776 4.28081 13.922 4.38811 13.922 4.5Z"
                                                    fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php
    }
}