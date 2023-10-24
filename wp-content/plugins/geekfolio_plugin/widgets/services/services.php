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
class Geekfolio_Services extends Widget_Base
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
		return 'geekfolio-services';
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
		return __('Geekfolio Services', 'geekfolio_plg');
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
            'services_content',
            [
                'label' => __('Services Content', 'geekfolio_plg')
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
            'service_description',
            [
                'label' => __('Service Description', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $repeater->add_control(
            'btn_switcher',
            [
                'label' => __('Read More Button', 'geekfolio_plg'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'geekfolio_plg'),
                'label_off' => __('Hide', 'geekfolio_plg'),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => __('Link', 'geekfolio_plg'),
                'type' => Controls_Manager::URL,
                'condition' => [
                    'btn_switcher' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'services',
            [
                'label' => __('Services Repeater', 'geekfolio_plg'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'field_title' => '{{{services_title}}}'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style',
            [
                'label' => __('Style', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'title_style',
            [
                'label' => __('Title Color', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-services .item h6' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'title_color_dark',
            [
                'label' => __('Title Color ( Dark )', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-services .item h6' => 'color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-services .item h6' => 'color: {{VALUE}};',
				],
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .geekfolio-services .item h6',
                'separator' => 'after'
			]
		);

        $this->add_control(
            'desc_style',
            [
                'label' => __('Description Color', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-services .item p' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'desc_color_dark',
            [
                'label' => __('Description Color ( Dark )', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-services .item p' => 'color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-services .item p' => 'color: {{VALUE}};',
				],
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'selector' => '{{WRAPPER}} .geekfolio-services .item p',
                'separator' => 'after'
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
    }

    protected function render(){
        $settings = $this->get_settings();
        ?>
        <div class="geekfolio-services <?php if($settings['invert_dark'] == 'yes') echo 'geekfolio-invert-dark'; ?>">
            <div class="container">
                <div class="sec-head mb-80">
                    <div class="row">
                        <div class="col-lg-12 text-lg-end d-flex align-items-center wow fadeIn">
                            <div class="full-width">
                                <div class="swiper-controls-container">
                                    <div class="swiper-controls arrow-out d-flex">
                                        <div class="swiper-button-prev">
                                            <span class="left">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M17.2031 10.3281L11.5781 15.9531C11.535 15.9961 11.4839 16.0303 11.4276 16.0536C11.3713 16.077 11.3109 16.089 11.25 16.089C11.1891 16.089 11.1287 16.077 11.0724 16.0536C11.0161 16.0303 10.965 15.9961 10.9219 15.9531C10.8788 15.91 10.8446 15.8588 10.8213 15.8025C10.798 15.7462 10.786 15.6859 10.786 15.6249C10.786 15.564 10.798 15.5036 10.8213 15.4473C10.8446 15.391 10.8788 15.3399 10.9219 15.2968L15.7422 10.4687H3.125C3.00068 10.4687 2.88145 10.4193 2.79354 10.3314C2.70564 10.2435 2.65625 10.1242 2.65625 9.99993C2.65625 9.87561 2.70564 9.75638 2.79354 9.66847C2.88145 9.58056 3.00068 9.53118 3.125 9.53118H15.7422L10.9219 4.70305C10.8349 4.61603 10.786 4.498 10.786 4.37493C10.786 4.25186 10.8349 4.13383 10.9219 4.0468C11.0089 3.95978 11.1269 3.91089 11.25 3.91089C11.3731 3.91089 11.4911 3.95978 11.5781 4.0468L17.2031 9.6718C17.2476 9.71412 17.2829 9.76503 17.3071 9.82143C17.3313 9.87784 17.3438 9.93856 17.3438 9.99993C17.3438 10.0613 17.3313 10.122 17.3071 10.1784C17.2829 10.2348 17.2476 10.2857 17.2031 10.3281Z"
                                                        fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="swiper-button-next ml-50">
                                            <span class="right">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M17.2031 10.3281L11.5781 15.9531C11.535 15.9961 11.4839 16.0303 11.4276 16.0536C11.3713 16.077 11.3109 16.089 11.25 16.089C11.1891 16.089 11.1287 16.077 11.0724 16.0536C11.0161 16.0303 10.965 15.9961 10.9219 15.9531C10.8788 15.91 10.8446 15.8588 10.8213 15.8025C10.798 15.7462 10.786 15.6859 10.786 15.6249C10.786 15.564 10.798 15.5036 10.8213 15.4473C10.8446 15.391 10.8788 15.3399 10.9219 15.2968L15.7422 10.4687H3.125C3.00068 10.4687 2.88145 10.4193 2.79354 10.3314C2.70564 10.2435 2.65625 10.1242 2.65625 9.99993C2.65625 9.87561 2.70564 9.75638 2.79354 9.66847C2.88145 9.58056 3.00068 9.53118 3.125 9.53118H15.7422L10.9219 4.70305C10.8349 4.61603 10.786 4.498 10.786 4.37493C10.786 4.25186 10.8349 4.13383 10.9219 4.0468C11.0089 3.95978 11.1269 3.91089 11.25 3.91089C11.3731 3.91089 11.4911 3.95978 11.5781 4.0468L17.2031 9.6718C17.2476 9.71412 17.2829 9.76503 17.3071 9.82143C17.3313 9.87784 17.3438 9.93856 17.3438 9.99993C17.3438 10.0613 17.3313 10.122 17.3071 10.1784C17.2829 10.2348 17.2476 10.2857 17.2031 10.3281Z"
                                                        fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="serv-items-crev">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php foreach($settings['services'] as $index => $item) : ?>
                        <div class="swiper-slide wow fadeIn" data-wow-delay=".9s">
                            <div class="item">
                                <div class="icon-img mb-40">
                                    <img src="<?php echo esc_url($item['service_icon']['url']); ?>" alt="">
                                </div>
                                <h6 class="mb-15"><?php echo __($item['service_title'], 'geekfolio_plg'); ?></h6>
                                <p><?php echo __($item['service_description'], 'geekfolio_plg'); ?></p>
                                <?php if($item['btn_switcher'] == 'yes') : ?>
                                <a href="<?php echo esc_url($item['link']['url']); ?>" class="arrow mt-40">
                                    <span class="circle">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.922 4.5V11.8125C13.922 11.9244 13.8776 12.0317 13.7985 12.1108C13.7193 12.1899 13.612 12.2344 13.5002 12.2344C13.3883 12.2344 13.281 12.1899 13.2018 12.1108C13.1227 12.0317 13.0783 11.9244 13.0783 11.8125V5.51953L4.79547 13.7953C4.71715 13.8736 4.61092 13.9176 4.50015 13.9176C4.38939 13.9176 4.28316 13.8736 4.20484 13.7953C4.12652 13.717 4.08252 13.6108 4.08252 13.5C4.08252 13.3892 4.12652 13.283 4.20484 13.2047L12.4806 4.92188H6.18765C6.07577 4.92188 5.96846 4.87743 5.88934 4.79831C5.81023 4.71919 5.76578 4.61189 5.76578 4.5C5.76578 4.38811 5.81023 4.28081 5.88934 4.20169C5.96846 4.12257 6.07577 4.07813 6.18765 4.07812H13.5002C13.612 4.07813 13.7193 4.12257 13.7985 4.20169C13.8776 4.28081 13.922 4.38811 13.922 4.5Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    <span class="ml-10"><?php echo __('Read More', 'geekfolio_plg'); ?></span>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}