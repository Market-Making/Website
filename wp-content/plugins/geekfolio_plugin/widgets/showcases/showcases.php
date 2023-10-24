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
class Geekfolio_Showcases extends Widget_Base
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
        return 'geekfolio-showcases';
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
        return __('Geekfolio Showcases', 'geekfolio_plg');
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
        return ['wow', 'custom-scripts', 'geekfolio-anime', 'geekfolio-showcase', 'demo-reveal'];
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

    protected function register_controls()
    {
        $this->start_controls_section(
            'content',
            [
                'label' => __('Content', 'geekfolio_plg'),
            ]
        );

        $this->add_control(
            'presets',
            [
                'label' => __('Presets', 'geekfolio_plg'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'columns-carousel' => __('Columns Carousel', 'geekfolio_plg'),
                    'full-width-parallax' => __('Full Width Parallax', 'geekfolio_plg'),
                    'full-width-frame' => __('Full Width Frame', 'geekfolio_plg'),
                    'circle-carousel' => __('Circle Carousel', 'geekfolio_plg'),
                    'interactive-links' => __('Interactive Links', 'geekfolio_plg'),
                ],
                'default' => 'columns-carousel',
            ]
        );

        $this->add_control(
            'arrow_next_text',
            [
                'label' => __('Arrow Next Text', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Next Slide', 'geekfolio_plg'),
                'condition' => [
                    'presets' => ['full-width-parallax', 'full-width-frame']
                ]
            ]
        );

        $this->add_control(
            'arrow_prev_text',
            [
                'label' => __('Arrow Prev Text', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Prev Slide', 'geekfolio_plg'),
                'condition' => [
                    'presets' => ['full-width-parallax', 'full-width-frame']
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
            'link',
            [
                'label' => __('Link', 'geekfolio_plg'),
                'type' => Controls_Manager::URL,
                'default' => [
					'url' => '#0',
                ]
            ]
        );

        $repeater->add_control(
            'img',
            [
                'label' => __('Background Image', 'geekfolio_plg'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            'items',
            [
                'label' => __('Slides', 'geekfolio_plg'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => esc_html__('Minimalest Architectures', 'textdomain'),
                        'sub_title' => esc_html__('We developed strong relationships with contractors and specialist companies', 'textdomain'),
                    ],
                    [
                        'title' => esc_html__('Minimalest Architectures', 'textdomain'),
                        'sub_title' => esc_html__('We developed strong relationships with contractors and specialist companies', 'textdomain'),
                    ],
                ],
                'title_field' => '{{{title}}}'
            ]
        );
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();

        $swiper_classes_start = $settings['presets'] == 'columns-carousel' || $settings['presets'] == 'full-width-parallax' ? '<div class="swiper-container"><div class="swiper-wrapper">' : '';
        $swiper_classes_end = $settings['presets'] == 'columns-carousel' || $settings['presets'] == 'full-width-parallax' ? '</div></div>' : '';
?>

        <div class="geekfolio-showcases">
            <div class="<?php echo esc_attr($settings['presets']); ?>">
                <?php echo $swiper_classes_start; ?>
                <?php if ($settings['presets'] == 'circle-carousel') : ?>
                    <nav class="slides-nav">
                        <div class="slide-nav-butn">
                            <button class="slides-nav__button slides-nav__button--prev" aria-label="Previous slide">
                                <svg>
                                    <path d="M1.176 11.532a.5.5 0 00-.352.936c5.228 1.96 9.475 5.555 12.752 10.797a.5.5 0 00.848-.53c-3.39-5.424-7.81-9.163-13.248-11.203z">
                                    </path>
                                    <path d="M1.176 12.468a.5.5 0 01-.352-.936C6.052 9.572 10.3 5.978 13.576.735a.5.5 0 01.848.53c-3.39 5.424-7.81 9.163-13.248 11.203z">
                                    </path>
                                    <path d="M1 12.5a.5.5 0 110-1h53a.5.5 0 110 1H1z"></path>
                                </svg>
                            </button>
                            <button class="slides-nav__button slides-nav__button--next" aria-label="Next slide">
                                <svg>
                                    <path d="M53.824 11.532a.5.5 0 01.352.936c-5.228 1.96-9.475 5.555-12.752 10.797a.5.5 0 01-.848-.53c3.39-5.424 7.81-9.163 13.248-11.203z">
                                    </path>
                                    <path d="M53.824 12.468a.5.5 0 00.352-.936C48.948 9.572 44.7 5.978 41.424.735a.5.5 0 00-.848.53c3.39 5.424 7.81 9.163 13.248 11.203z">
                                    </path>
                                    <path d="M54 12.5a.5.5 0 100-1H1a.5.5 0 100 1h53z"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="slides-nav__index">
                            <span class="slides-nav__index-current">
                                <span><?php echo __('1', 'geekfolio_plg'); ?></span>
                            </span>
                            &mdash;
                            <span class="slides-nav__index-total"><?php echo count($settings['items']); ?></span>
                        </div>
                    </nav>
                <?php endif; ?>
                <?php if ($settings['presets'] == 'columns-carousel') :
                    foreach ($settings['items'] as $index => $item) : ?>
                        <div class="swiper-slide">
                            <div class="item">
                                <div class="img">
                                    <img src="<?php echo esc_url($item['img']['url']); ?>" alt="">
                                    <div class="cont">
                                        <span class="title"><?php echo $item['title']; ?></span>
                                        <h6 class="sub-title"><?php echo $item['sub_title']; ?></h6>
                                    </div>
                                    <a href="<?php echo esc_url($item['link']['url']); ?>" class="plink"></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;
                elseif ($settings['presets'] == 'full-width-parallax') :
                    foreach ($settings['items'] as $index => $item) : ?>
                        <div class="swiper-slide">
                            <div class="bg-img valign" data-background="<?php echo esc_url($item['img']['url']); ?>" data-overlay-dark="3">
                                <div class="col-lg-11 offset-lg-1">
                                    <div class="caption">
                                        <h6 class="sub-title mb-30" data-swiper-parallax="-1000"><?php echo $item['sub_title']; ?></h6>
                                        <h1>
                                            <a href="<?php echo esc_url($item['link']['url']); ?>">
                                                <?php echo $item['title']; ?>
                                            </a>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;
                elseif ($settings['presets'] == 'full-width-frame') : ?>
                    <div class="slides slides--images">
                        <?php $first_item = true;
                        foreach ($settings['items'] as $index => $item) : ?>
                            <div class="slide <?php if ($first_item) echo 'slide--current'; ?>">
                                <div class="slide__img bg-img" data-background="<?php echo esc_url($item['img']['url']); ?>"></div>
                            </div>
                        <?php $first_item = false;
                        endforeach; ?>
                    </div>
                    <div class="slides slides--titles">
                        <?php $first_item = true;
                        foreach ($settings['items'] as $index => $item) : ?>
                            <div class="slide <?php if ($first_item) echo 'slide--current'; ?>">
                                <h1 class="slide__title text-center">
                                    <span class="sub-title mb-15"><?php echo $item['sub_title']; ?></span> <br>
                                    <span>
                                        <a href="<?php echo esc_url($item['link']['url']); ?>"><?php echo $item['title']; ?></a>
                                    </span>
                                </h1>
                            </div>
                        <?php $first_item = false;
                        endforeach; ?>
                    </div>
                    <?php elseif ($settings['presets'] == 'circle-carousel') :
                    $first_item = true;
                    foreach ($settings['items'] as $index => $item) : ?>
                        <figure class="slide <?php if ($first_item) echo 'slide--current'; ?>">
                            <div class="slide__img-wrap">
                                <div class="slide__img bg-img" data-background="<?php echo esc_url($item['img']['url']); ?>"></div>
                            </div>
                            <figcaption class="slide__caption">
                                <h1 class="slides__caption-headline">
                                    <span class="text-row sub-title"><span><?php echo $item['sub_title']; ?></span></span>
                                    <span class="text-row title"><span><?php echo $item['title']; ?></span></span>
                                </h1>
                                <a class="slides__caption-link explore-btn" href="<?php echo esc_url($item['link']['url']); ?>"><span>Explore</span></a>
                            </figcaption>
                        </figure>
                    <?php $first_item = false;
                    endforeach;
                elseif ($settings['presets'] == 'interactive-links') : ?>
                    <div class="links-text d-flex justify-content-center">
                        <ul class="rest">
                            <?php $counter = 1; foreach ($settings['items'] as $index => $item) : ?>
                                <li data-tab="tab-<?php echo $counter ?>">
                                    <h2>
                                        <span class="num"><?php if($counter < 10) echo '0'.$counter; else echo $counter; ?>.</span>
                                        <a href="<?php echo esc_url($item['link']['url']); ?>"><span class="tag sub-title"><?php echo $item['sub_title']; ?></span> <span class="text"><?php echo $item['title']; ?></span></a>
                                    </h2>
                                </li>
                            <?php $counter++; endforeach; ?>
                        </ul>
                    </div>
                    <div class="links-img">
                        <?php $counter = 1; foreach ($settings['items'] as $index => $item) : ?>
                            <div class="img" id="tab-<?php echo $counter ?>">
                                <img src="<?php echo esc_url($item['img']['url']); ?>" alt="">
                            </div>
                        <?php $counter++; endforeach; ?>
                    </div>
                <?php endif;
                echo $swiper_classes_end; ?>

                <?php if ($settings['presets'] == 'columns-carousel') : ?>
                    <div class="swiper-controls columns-carousel-controls arrow-out">
                        <div class="container">
                            <div class="d-flex">
                                <div class="swiper-button-prev">
                                    <span class="left">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M17.2031 10.3281L11.5781 15.9531C11.535 15.9961 11.4839 16.0303 11.4276 16.0536C11.3713 16.077 11.3109 16.089 11.25 16.089C11.1891 16.089 11.1287 16.077 11.0724 16.0536C11.0161 16.0303 10.965 15.9961 10.9219 15.9531C10.8788 15.91 10.8446 15.8588 10.8213 15.8025C10.798 15.7462 10.786 15.6859 10.786 15.6249C10.786 15.564 10.798 15.5036 10.8213 15.4473C10.8446 15.391 10.8788 15.3399 10.9219 15.2968L15.7422 10.4687H3.125C3.00068 10.4687 2.88145 10.4193 2.79354 10.3314C2.70564 10.2435 2.65625 10.1242 2.65625 9.99993C2.65625 9.87561 2.70564 9.75638 2.79354 9.66847C2.88145 9.58056 3.00068 9.53118 3.125 9.53118H15.7422L10.9219 4.70305C10.8349 4.61603 10.786 4.498 10.786 4.37493C10.786 4.25186 10.8349 4.13383 10.9219 4.0468C11.0089 3.95978 11.1269 3.91089 11.25 3.91089C11.3731 3.91089 11.4911 3.95978 11.5781 4.0468L17.2031 9.6718C17.2476 9.71412 17.2829 9.76503 17.3071 9.82143C17.3313 9.87784 17.3438 9.93856 17.3438 9.99993C17.3438 10.0613 17.3313 10.122 17.3071 10.1784C17.2829 10.2348 17.2476 10.2857 17.2031 10.3281Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="swiper-button-next ml-auto">
                                    <span class="right">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M17.2031 10.3281L11.5781 15.9531C11.535 15.9961 11.4839 16.0303 11.4276 16.0536C11.3713 16.077 11.3109 16.089 11.25 16.089C11.1891 16.089 11.1287 16.077 11.0724 16.0536C11.0161 16.0303 10.965 15.9961 10.9219 15.9531C10.8788 15.91 10.8446 15.8588 10.8213 15.8025C10.798 15.7462 10.786 15.6859 10.786 15.6249C10.786 15.564 10.798 15.5036 10.8213 15.4473C10.8446 15.391 10.8788 15.3399 10.9219 15.2968L15.7422 10.4687H3.125C3.00068 10.4687 2.88145 10.4193 2.79354 10.3314C2.70564 10.2435 2.65625 10.1242 2.65625 9.99993C2.65625 9.87561 2.70564 9.75638 2.79354 9.66847C2.88145 9.58056 3.00068 9.53118 3.125 9.53118H15.7422L10.9219 4.70305C10.8349 4.61603 10.786 4.498 10.786 4.37493C10.786 4.25186 10.8349 4.13383 10.9219 4.0468C11.0089 3.95978 11.1269 3.91089 11.25 3.91089C11.3731 3.91089 11.4911 3.95978 11.5781 4.0468L17.2031 9.6718C17.2476 9.71412 17.2829 9.76503 17.3071 9.82143C17.3313 9.87784 17.3438 9.93856 17.3438 9.99993C17.3438 10.0613 17.3313 10.122 17.3071 10.1784C17.2829 10.2348 17.2476 10.2857 17.2031 10.3281Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                <?php elseif ($settings['presets'] == 'full-width-parallax') : ?>
                    <div class="slider-contro">
                        <div class="swiper-button-next swiper-nav-ctrl cursor-pointer">
                            <div>
                                <span><?php echo wp_kses_post( $settings['arrow_next_text'] ); ?></span>
                            </div>
                            <div><i class="fas fa-chevron-right"></i></div>
                        </div>
                        <div class="swiper-button-prev swiper-nav-ctrl cursor-pointer">
                            <div><i class="fas fa-chevron-left"></i></div>
                            <div>
                                <span><?php echo wp_kses_post( $settings['arrow_prev_text'] ); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination dots"></div>
                <?php elseif ($settings['presets'] == 'full-width-frame') : ?>
                    <nav class="slidenav">
                        <div class="container">
                            <button class="slidenav__item slidenav__item--prev cursor-pointer">
                                <span><i class="fas fa-chevron-left"></i></span>
                                <span><span><?php echo wp_kses_post( $settings['arrow_prev_text'] ); ?></span></span>
                            </button>
                            <button class="slidenav__item slidenav__item--next cursor-pointer">
                                <span><span><?php echo wp_kses_post( $settings['arrow_next_text'] ); ?></span></span>
                                <span><i class="fas fa-chevron-right"></i></span>
                            </button>
                        </div>
                    </nav>
                <?php endif; ?>
            </div>
        </div>

<?php
    }
}
