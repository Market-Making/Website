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
class Geekfolio_Testimonials extends Widget_Base
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
		return 'geekfolio-testimonials';
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
		return __('Geekfolio Testimonials', 'geekfolio_plg');
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
				'label' => __( 'Layout', 'geekfolio_plg' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'info-down' => __( 'Info Down', 'geekfolio_plg' ),
					'info-left' => __( 'Info Left', 'geekfolio_plg' ),
				],
				'default' => 'info-down',
			]
		);

		$this->add_control(
			'arrows_position',
			[
				'label' => __( 'Arrows Position', 'geekfolio_plg' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'down' => __( 'Down', 'geekfolio_plg' ),
					'side' => __( 'Side', 'geekfolio_plg' ),
					'up' => __( 'Up', 'geekfolio_plg' ),
				],
				'default' => 'down',
				'condition' => [
					'layout' => 'info-down'
				]
			]
		);

        $this->add_control(
            'icon_line',
            [
                'label' => __('Icon Line', 'geekfolio_plg'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __('Yes', 'geekfolio_plg'),
                'label_off' => __('No', 'geekfolio_plg'),
                'return_value' => 'yes',
				'condition' => [
					'layout' => 'info-down'
				]
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
        
        $repeater->add_control(
            'quote_img',
            [
                'label' => __('Quote Image', 'geekfolio_plg'),
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
					'{{WRAPPER}} .geekfolio-testimonials .item .quote' => 'color: {{VALUE}} !important;',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Quote Typography', 'geekfolio_plg'),
				'name' => 'quote_typography',
				'selector' => '{{WRAPPER}} .geekfolio-testimonials .item .quote',
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
					'{{WRAPPER}} .geekfolio-testimonials .item .quote' => 'text-align: {{VALUE}}'
				]
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
					'{{WRAPPER}} .geekfolio-testimonials .item.info-left .arrow' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'client_arrow_color_dark',
			[
				'label' => esc_html__('Arrow Color (Dark Mode)', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
                'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-testimonials .item.info-left .arrow' => 'background-color: {{VALUE}}; stroke: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-testimonials .item.info-left .arrow' => 'background-color: {{VALUE}}; stroke: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'client_name_color',
			[
				'label' => esc_html__('Client Name Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-testimonials .item .info .name' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'client_position_color',
			[
				'label' => esc_html__('Client Position Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-testimonials .item .info .position' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Client name Typography', 'geekfolio_plg'),
				'name' => 'client_name_typography',
				'selector' => '{{WRAPPER}} .geekfolio-testimonials .item .info .name',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Client Position Typography', 'geekfolio_plg'),
				'name' => 'client_position_typography',
				'selector' => '{{WRAPPER}} .geekfolio-testimonials .item .info .position',
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
					'{{WRAPPER}} .geekfolio-testimonials .item .rate' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Stars Typography', 'geekfolio_plg'),
				'name' => 'stars_typography',
				'selector' => '{{WRAPPER}} .geekfolio-testimonials .item .rate i',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'arrows_style',
            [
                'label' => __('Arrows Style', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

		$this->add_responsive_control(
			'top_arrow_position',
			[
				'label' => esc_html__('Top Arrow Position', 'geekfolio_plg'),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-testimonials .swiper-controls-container .swiper-controls' => 'top: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'arrows_position' => 'up'
                ]
			]
		);

        $this->end_controls_section();
    }

    protected function render(){
        $settings = $this->get_settings();
        ?>
        <div class="geekfolio-testimonials">
            <div class="testim-swiper" data-carousel="swiper" data-items="1" data-loop="true" data-space="30" data-speed="1000">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
						<?php foreach ($settings['sliders'] as $index => $item) : ?>
							<div class="swiper-slide">
								<div class="item <?php echo esc_attr($settings['layout']) ?> <?php if($settings['invert_dark'] == 'yes') echo ' invert-dark'; ?>">
									<?php if($settings['layout'] == 'info-left'): ?>
									<div class="row">
										<div class="col-md-4">
											<div class="author-info valign">
												<div class="full-width">
													<div class="author-img">
														<img src="<?php echo esc_url($item['author_photo']['url']); ?>" alt="">
													</div>
													<div class="info">
														<h6 class="name"><?php echo __($item['author_name'], 'geekfolio_plg'); ?></h6>
														<p class="position"><?php echo __($item['author_position'], 'geekfolio_plg'); ?></p>
													</div>
													<div class="arrow sub-bg"></div>
												</div>
											</div>
										</div>
										<div class="col-md-8">
											<div class="cont">
												<div class="icon-img">
													<img src="<?php echo esc_url($item['quote_img']['url']); ?>" alt="">
												</div>
												<h4 class="quote"><?php echo __($item['quote'], 'geekfolio_plg'); ?></h4>
											</div>
										</div>
									</div>
									<?php elseif($settings['layout'] == 'info-down'): ?>
										<div class="cont mb-30">
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
											<h5 class="quote">
												<?php echo __($item['quote'], 'geekfolio_plg'); ?>
											</h5>
										</div>
										<?php if($settings['icon_line'] == 'yes'): ?>
										<div class="line-icon">
											<div class="ml-auto">
												<div class="icon-img">
													<img src="<?php echo esc_url($item['quote_img']['url']); ?>" alt="">
												</div>
											</div>
										</div>
										<?php endif; ?>
										<div class="d-flex align-items-center">
											<div class="author-img">
												<img src="<?php echo esc_url($item['author_photo']['url']); ?>" alt="">
											</div>
											<div class="info">
												<h6 class="name"><?php echo __($item['author_name'], 'geekfolio_plg'); ?></h6>
												<span class="position"><?php echo __($item['author_position'], 'geekfolio_plg'); ?></span>
											</div>
										</div>
									<?php endif; ?>
								</div>
							</div>
						<?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php if($settings['arrows_position'] == 'up'): ?>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-lg-end d-flex align-items-center">
                            <div class="full-width">
                                <div class="swiper-controls-container">
            <?php endif; ?>
            <div class="swiper-controls <?php if($settings['arrows_position'] == 'up') echo 'up-arrows' ?> testim-controls <?php echo esc_attr($settings['layout']) ?> position-<?php echo $settings['arrows_position'] ?>">
				<?php if($settings['layout'] == 'info-down'): ?>
					<div class="swiper-button-prev">
						<span class="left">
                            <?php if($settings['arrows_position'] == 'up'): ?>
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 18 18" style="enable-background:new 0 0 18 18;" xml:space="preserve">
                                    <style type="text/css">
                                        .st0{fill-rule:evenodd;clip-rule:evenodd;fill:#191818;}
                                    </style>
                                    <path class="st0" d="M13.2,3.8H3V2.3h12.8V15h-1.5V4.8L3.5,15.5l-1.1-1.1L13.2,3.8z"/>
                                </svg>
                            <?php else: ?>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17.2031 10.3281L11.5781 15.9531C11.535 15.9961 11.4839 16.0303 11.4276 16.0536C11.3713 16.077 11.3109 16.089 11.25 16.089C11.1891 16.089 11.1287 16.077 11.0724 16.0536C11.0161 16.0303 10.965 15.9961 10.9219 15.9531C10.8788 15.91 10.8446 15.8588 10.8213 15.8025C10.798 15.7462 10.786 15.6859 10.786 15.6249C10.786 15.564 10.798 15.5036 10.8213 15.4473C10.8446 15.391 10.8788 15.3399 10.9219 15.2968L15.7422 10.4687H3.125C3.00068 10.4687 2.88145 10.4193 2.79354 10.3314C2.70564 10.2435 2.65625 10.1242 2.65625 9.99993C2.65625 9.87561 2.70564 9.75638 2.79354 9.66847C2.88145 9.58056 3.00068 9.53118 3.125 9.53118H15.7422L10.9219 4.70305C10.8349 4.61603 10.786 4.498 10.786 4.37493C10.786 4.25186 10.8349 4.13383 10.9219 4.0468C11.0089 3.95978 11.1269 3.91089 11.25 3.91089C11.3731 3.91089 11.4911 3.95978 11.5781 4.0468L17.2031 9.6718C17.2476 9.71412 17.2829 9.76503 17.3071 9.82143C17.3313 9.87784 17.3438 9.93856 17.3438 9.99993C17.3438 10.0613 17.3313 10.122 17.3071 10.1784C17.2829 10.2348 17.2476 10.2857 17.2031 10.3281Z"
                                        fill="currentColor"></path>
                                </svg>
                            <?php endif; ?>
						</span>
					</div>
					<div class="swiper-button-next ml-50">
						<span class="right">
                        <?php if($settings['arrows_position'] == 'up'): ?>
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 18 18" style="enable-background:new 0 0 18 18;" xml:space="preserve">
                                    <style type="text/css">
                                        .st0{fill-rule:evenodd;clip-rule:evenodd;fill:#191818;}
                                    </style>
                                    <path class="st0" d="M13.2,3.8H3V2.3h12.8V15h-1.5V4.8L3.5,15.5l-1.1-1.1L13.2,3.8z"/>
                                </svg>
                            <?php else: ?>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17.2031 10.3281L11.5781 15.9531C11.535 15.9961 11.4839 16.0303 11.4276 16.0536C11.3713 16.077 11.3109 16.089 11.25 16.089C11.1891 16.089 11.1287 16.077 11.0724 16.0536C11.0161 16.0303 10.965 15.9961 10.9219 15.9531C10.8788 15.91 10.8446 15.8588 10.8213 15.8025C10.798 15.7462 10.786 15.6859 10.786 15.6249C10.786 15.564 10.798 15.5036 10.8213 15.4473C10.8446 15.391 10.8788 15.3399 10.9219 15.2968L15.7422 10.4687H3.125C3.00068 10.4687 2.88145 10.4193 2.79354 10.3314C2.70564 10.2435 2.65625 10.1242 2.65625 9.99993C2.65625 9.87561 2.70564 9.75638 2.79354 9.66847C2.88145 9.58056 3.00068 9.53118 3.125 9.53118H15.7422L10.9219 4.70305C10.8349 4.61603 10.786 4.498 10.786 4.37493C10.786 4.25186 10.8349 4.13383 10.9219 4.0468C11.0089 3.95978 11.1269 3.91089 11.25 3.91089C11.3731 3.91089 11.4911 3.95978 11.5781 4.0468L17.2031 9.6718C17.2476 9.71412 17.2829 9.76503 17.3071 9.82143C17.3313 9.87784 17.3438 9.93856 17.3438 9.99993C17.3438 10.0613 17.3313 10.122 17.3071 10.1784C17.2829 10.2348 17.2476 10.2857 17.2031 10.3281Z"
                                        fill="currentColor"></path>
                                </svg>
                            <?php endif; ?>
						</span>
					</div>
				<?php elseif($settings['layout'] == 'info-left'): ?>
					<div class="row">
						<div class="col-md-8 offset-md-4">
							<div class="arrows-carsouel testim-controls">
								<div class="swiper-controls">
									<div class="swiper-button-prev">
										<span class="left">
											<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												viewBox="0 0 18 18" style="enable-background:new 0 0 18 18;" xml:space="preserve">
												<style type="text/css">
													.st0{fill-rule:evenodd;clip-rule:evenodd;fill:#191818;}
												</style>
												<path class="st0" d="M13.2,3.8H3V2.3h12.8V15h-1.5V4.8L3.5,15.5l-1.1-1.1L13.2,3.8z"/>
											</svg>
										</span>
									</div>
									<div class="swiper-pagination"></div>
									<div class="swiper-button-next">
										<span class="right">
											<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												viewBox="0 0 18 18" style="enable-background:new 0 0 18 18;" xml:space="preserve">
												<style type="text/css">
													.st0{fill-rule:evenodd;clip-rule:evenodd;fill:#191818;}
												</style>
												<path class="st0" d="M13.2,3.8H3V2.3h12.8V15h-1.5V4.8L3.5,15.5l-1.1-1.1L13.2,3.8z"/>
											</svg>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
            <?php if($settings['arrows_position'] == 'up'): ?>
                </div></div></div></div></div>
            <?php endif; ?>
        </div>
        <?php
    }
}