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
class Geekfolio_Slides extends Widget_Base
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
		return 'geekfolio-slides';
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
		return __('Geekfolio Slides', 'geekfolio_plg');
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
		return 'eicon-slides';
	}

    public function get_script_depends()
    {
        return ['wow', 'custom-scripts', 'geekfolio-parallax-slider'];
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
                'label' => __('Content', 'geekfolio_plg'),
            ]
        );

		$this->add_control(
			'presets',
			[
				'label' => __( 'Presets', 'geekfolio_plg' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'preset-1' => __( 'Preset 1', 'geekfolio_plg' ),
					'preset-2' => __( 'Preset 2', 'geekfolio_plg' ),
				],
				'default' => 'preset-1',
			]
		);

        $this->add_control(
            'overlay_opacitiy',
            [
                'label' => __('Overlay Opacity', 'geekfolio_plg'),
                'type' => Controls_Manager::NUMBER,
                'min' => '0',
                'max' => '1',
                'step' => '0.1',
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-slides [data-overlay-dark]:before' => 'opacity: {{VALUE}}'
                ]
            ]
        );


        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => __('Title', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Minimalest Architectures', 'geekfolio_plg'),
            ]
        );

        $repeater->add_control(
            'sub_title',
            [
                'label' => __('Sub Title', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT,
                'default' => __('We developed strong relationships with contractors and specialist companies', 'geekfolio_plg'),
            ]
        );

        $repeater->add_control(
            'button',
            [
                'label' => __('Button', 'geekfolio_plg'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'geekfolio_plg'),
                'label_off' => __('Hide', 'geekfolio_plg'),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $repeater->add_control(
            'btn_text',
            [
                'label' => __('Button Text', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'Type Here Button Text',
                'default' => __('Get Solutions', 'geekfolio_plg')
            ]
        );

        $repeater->add_control(
            'btn_link',
            [
                'label' => __('Button Link', 'geekfolio_plg'),
                'type' => Controls_Manager::URL,
                'default' => [
					'url' => '#0',
                ]
            ]
        );

        $repeater->add_control(
            'back_img',
            [
                'label' => __('Background Image', 'geekfolio_plg'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );


        $this->add_control(
            'slides',
            [
                'label' => __('Slides', 'geekfolio_plg'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
					[
						'title' => esc_html__( 'Minimalest Architectures', 'textdomain' ),
						'sub_title' => esc_html__( 'We developed strong relationships with contractors and specialist companies', 'textdomain' ),
					],
					[
						'title' => esc_html__( 'Minimalest Architectures', 'textdomain' ),
						'sub_title' => esc_html__( 'We developed strong relationships with contractors and specialist companies', 'textdomain' ),
					],
				],
                'title_field' => '{{{title}}}'
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'styles',
            [
                'label' => __('Text Styles', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
                'label' => __('Sub-Title', 'geekfolio_plg'),
				'selector' => '{{WRAPPER}} .geekfolio-slides .sub-title',
			]
		);

        $this->add_control(
			'sub_title_color',
			[
				'label' => esc_html__( 'Sub Title Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-slides .sub-title' => 'color: {{VALUE}}'
                ],
                'separator' => 'after'
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
                'label' => __('Title', 'geekfolio_plg'),
				'selector' => '{{WRAPPER}} .geekfolio-slides h1',
			]
		);

        $this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-slides h1' => 'color: {{VALUE}}'
                ],
                'separator' => 'after'
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
                'label' => __('Text', 'geekfolio_plg'),
				'selector' => '{{WRAPPER}} .geekfolio-slides p',
			]
		);

        $this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-slides p' => 'color: {{VALUE}}'
                ],
                'separator' => 'after'
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'button_styles',
            [
                'label' => __('Button Styles', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->start_controls_tabs('btn_tabs');
        $this->start_controls_tab(
            'normal_btn',
            [
                'label' => __('Normal', 'geekfolio_plg'),
            ]
        );
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'btn_background',
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .geekfolio-slides .geekfolio-button',
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
                'label' => __('Button Typography', 'geekfolio_plg'),
				'selector' => '{{WRAPPER}} .geekfolio-slides .geekfolio-button',
			]
		);

        $this->add_control(
			'btn_text_color',
			[
				'label' => esc_html__( 'Button Text Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-slides .geekfolio-button' => 'color: {{VALUE}} !important'
                ],
                'separator' => 'after'
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_btn',
				'selector' => '{{WRAPPER}} .geekfolio-slides .geekfolio-button',
			]
		);
        $this->end_controls_tab();
        $this->start_controls_tab(
            'btn_hover',
            [
                'label' => __('Hover', 'geekfolio_plg')
            ]
        );
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'btn_background_hover',
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .geekfolio-slides .geekfolio-button:hover',
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography_hover',
                'label' => __('Button Typography', 'geekfolio_plg'),
				'selector' => '{{WRAPPER}} .geekfolio-slides .geekfolio-button:hover',
			]
		);

        $this->add_control(
			'btn_text_color_hover',
			[
				'label' => esc_html__( 'Title Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-slides .geekfolio-button:hover' => 'color: {{VALUE}}'
                ],
                'separator' => 'after'
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_btn_hover',
				'selector' => '{{WRAPPER}} .geekfolio-slides .geekfolio-button:hover',
			]
		);
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    protected function render(){
        $settings = $this->get_settings();
        ?>
        <div class="geekfolio-slides slider-prlx <?php echo $settings['presets'] ?>">
            <?php if($settings['presets'] == 'preset-1'): ?>
            <div class="lines two"></div>
            <?php endif; ?>
            <div class="swiper-container parallax-slider">
                <div class="swiper-wrapper">
                    <?php $i=0; foreach($settings['slides'] as $index => $item) : $i++; 
                    $id = uniqid(); ?>
                    <div class="swiper-slide">
                        <div class="bg-img valign" data-background="<?php echo esc_url($item['back_img']['url']); ?>" data-overlay-dark="7">
                            <div class="container <?php if($settings['presets'] == 'preset-1') echo 'justify-content-center'; ?>">
                                <div class="row <?php if($settings['presets'] == 'preset-1') echo 'justify-content-center'; ?>">
                                    <?php if($settings['presets'] == 'preset-1'): ?>
                                    <div class="col-lg-10">
                                        <div class="caption text-center">
                                            <h6 class="sub-title mb-15">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M13.922 4.5V11.8125C13.922 11.9244 13.8776 12.0317 13.7985 12.1108C13.7193 12.1899 13.612 12.2344 13.5002 12.2344C13.3883 12.2344 13.281 12.1899 13.2018 12.1108C13.1227 12.0317 13.0783 11.9244 13.0783 11.8125V5.51953L4.79547 13.7953C4.71715 13.8736 4.61092 13.9176 4.50015 13.9176C4.38939 13.9176 4.28316 13.8736 4.20484 13.7953C4.12652 13.717 4.08252 13.6108 4.08252 13.5C4.08252 13.3892 4.12652 13.283 4.20484 13.2047L12.4806 4.92188H6.18765C6.07577 4.92188 5.96846 4.87743 5.88934 4.79831C5.81023 4.71919 5.76578 4.61189 5.76578 4.5C5.76578 4.38811 5.81023 4.28081 5.88934 4.20169C5.96846 4.12257 6.07577 4.07813 6.18765 4.07812H13.5002C13.612 4.07813 13.7193 4.12257 13.7985 4.20169C13.8776 4.28081 13.922 4.38811 13.922 4.5Z"
                                                        fill="currentColor"></path>
                                                </svg>
                                                <span class="ml-10"><?php echo $item['sub_title']; ?></span>
                                            </h6>
                                            <h1 class="fz-60"><?php echo $item['title']; ?></h1>
                                        <?php elseif($settings['presets'] == 'preset-2'): ?>
                                            <div class="col-lg-7">
                                                <div class="caption mt-30">
                                                    <h5 class="main-colorbg inline">
                                                        <span><?php if($i < 10) echo '0' . $i; else echo $i; ?></span>
                                                    </h5>
                                                    <h1><?php echo $item['title']; ?></h1>
                                                    <p><?php echo $item['sub_title']; ?></p>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <?php if($item['button'] == 'yes') : 
                                                if($settings['presets'] == 'preset-1'): ?>
                                                <a href="<?php echo esc_url($item['btn_link']['url']); ?>" class="geekfolio-button mt-30">
                                                    <?php echo __($item['btn_text']); ?>
                                                    <i class="ml-5"><svg width="18" height="18" viewBox="0 0 18 18"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M13.922 4.5V11.8125C13.922 11.9244 13.8776 12.0317 13.7985 12.1108C13.7193 12.1899 13.612 12.2344 13.5002 12.2344C13.3883 12.2344 13.281 12.1899 13.2018 12.1108C13.1227 12.0317 13.0783 11.9244 13.0783 11.8125V5.51953L4.79547 13.7953C4.71715 13.8736 4.61092 13.9176 4.50015 13.9176C4.38939 13.9176 4.28316 13.8736 4.20484 13.7953C4.12652 13.717 4.08252 13.6108 4.08252 13.5C4.08252 13.3892 4.12652 13.283 4.20484 13.2047L12.4806 4.92188H6.18765C6.07577 4.92188 5.96846 4.87743 5.88934 4.79831C5.81023 4.71919 5.76578 4.61189 5.76578 4.5C5.76578 4.38811 5.81023 4.28081 5.88934 4.20169C5.96846 4.12257 6.07577 4.07813 6.18765 4.07812H13.5002C13.612 4.07813 13.7193 4.12257 13.7985 4.20169C13.8776 4.28081 13.922 4.38811 13.922 4.5Z"
                                                                fill="currentColor"></path>
                                                        </svg></i>
                                                </a>
                                                <?php elseif($settings['presets'] == 'preset-2'): ?>
                                                <div class="col-lg-3 offset-lg-1 valign">
                                                    <div class="ml-auto explore">
                                                        <a href="<?php echo esc_url($item['btn_link']['url']); ?>">
                                                            <div class="circle-button">
                                                                <div class="rotate-circle fz-30 text-u">
                                                                    <svg class="textcircle" viewBox="0 0 500 500">
                                                                        <defs>
                                                                            <path id="textcircle2-<?php echo $id; ?>"
                                                                                d="M250,400 a150,150 0 0,1 0,-300a150,150 0 0,1 0,300Z">
                                                                            </path>
                                                                        </defs>
                                                                        <text>
                                                                            <textPath xlink:href="#textcircle2-<?php echo $id; ?>" textLength="900"><?php echo __($item['btn_text']).'-'.__($item['btn_text']).'-'; ?></textPath>
                                                                        </text>
                                                                    </svg>
                                                                </div>
                                                                <div class="arrow">
                                                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M13.922 4.5V11.8125C13.922 11.9244 13.8776 12.0317 13.7985 12.1108C13.7193 12.1899 13.612 12.2344 13.5002 12.2344C13.3883 12.2344 13.281 12.1899 13.2018 12.1108C13.1227 12.0317 13.0783 11.9244 13.0783 11.8125V5.51953L4.79547 13.7953C4.71715 13.8736 4.61092 13.9176 4.50015 13.9176C4.38939 13.9176 4.28316 13.8736 4.20484 13.7953C4.12652 13.717 4.08252 13.6108 4.08252 13.5C4.08252 13.3892 4.12652 13.283 4.20484 13.2047L12.4806 4.92188H6.18765C6.07577 4.92188 5.96846 4.87743 5.88934 4.79831C5.81023 4.71919 5.76578 4.61189 5.76578 4.5C5.76578 4.38811 5.81023 4.28081 5.88934 4.20169C5.96846 4.12257 6.07577 4.07813 6.18765 4.07812H13.5002C13.612 4.07813 13.7193 4.12257 13.7985 4.20169C13.8776 4.28081 13.922 4.38811 13.922 4.5Z"
                                                                            fill="currentColor"></path>
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php if($settings['presets'] == 'preset-1'): ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <?php if($settings['presets'] != 'preset-1'): ?>
                    <div class="setting">
                        <!-- slider setting -->
                        <div class="controls">
                            <div class="swiper-button-next swiper-nav-ctrl next-ctrl cursor-pointer">
                                <i class="ion-chevron-right"></i>
                            </div>
                            <div class="swiper-button-prev swiper-nav-ctrl prev-ctrl cursor-pointer">
                                <i class="ion-chevron-left"></i>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                
            </div>
        </div>

        <?php
    }
}