<?php

namespace GeekfolioPlugin\Widgets;

use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Plugin;
use Elementor\Frontend;
use Elementor\Icons_Manager;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Image_Size;
use Elementor\Scheme_Base;

if (!defined('ABSPATH')) exit; // Exit if accessed directly



/**
 * @since 1.0.0
 */
class Geekfolio_Portfolio_Carousel extends Widget_Base
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
        return 'geekfolio-portfolio-carousel';
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
        return __('Geekfolio Portfolio Carousel', 'geekfolio_plg');
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
        return 'fa fa-clone';
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
    protected function _register_controls()
    {

        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Portfolio Settings.', 'geekfolio_plg'),
            ]
        );

        $this->add_control(
            'slider_type',
            [
                'label'         => __('Slider Type', 'geekfolio_plg'),
                'type'          => Controls_Manager::SELECT,
                'options' => [
                    'hscroll' => esc_html__('horizontal Scroll', 'geekfolio_plg'),
                    'slider' => esc_html__('Slider', 'geekfolio_plg'),
                ],
                'default' => 'hscroll',
            ]
        );

        $this->add_control(
            'portfolio_item',
            [
                'label' => __('Item to display', 'geekfolio_plg'),
                'type' => Controls_Manager::NUMBER,
                'default' => '8',
            ]
        );

        $this->add_control(
            'different_img_size',
            [
                'label' => __('Different Image Size', 'geekfolio_plg'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __('Yes', 'geekfolio_plg'),
                'label_off' => __('No', 'geekfolio_plg'),
                'return_value' => 'yes',
                'condition' => [
                    'slider_type' => 'slider'
                ]
            ]
        );

        $this->add_control(
            'sort_cat',
            [
                'label' => __('Sort Portfolio by Portfolio Category', 'geekfolio_plg'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __('Yes', 'geekfolio_plg'),
                'label_off' => __('No', 'geekfolio_plg'),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'blog_cat',
            [
                'label'   => __('Category to Show', 'geekfolio_plg'),
                'type'    => Controls_Manager::SELECT2, 'options' => geekfolio_tax_choice(),
                'condition' => [
                    'sort_cat' => 'yes',
                ],
                'multiple'   => 'true',
            ]
        );

        $this->add_control(
            'port_order',
            [
                'label' => __('Orders', 'geekfolio_plg'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'DESC' => __('Descending', 'geekfolio_plg'),
                    'ASC' => __('Ascending', 'geekfolio_plg'),
                    'rand' => __('Random', 'geekfolio_plg'),
                ],
                'default' => 'DESC',
            ]
        );

        $this->add_control(
            'show_tags',
            [
                'label' => __('Show Tags', 'geekfolio_plg'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __('Yes', 'geekfolio_plg'),
                'label_off' => __('No', 'geekfolio_plg'),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'show_excerpt',
            [
                'label' => __('Show Excerpt', 'geekfolio_plg'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __('Yes', 'geekfolio_plg'),
                'label_off' => __('No', 'geekfolio_plg'),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'show_filters',
            [
                'label' => __('Show Filters', 'geekfolio_plg'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __('Yes', 'geekfolio_plg'),
                'label_off' => __('No', 'geekfolio_plg'),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'columns_number',
            [
                'label' => __('Columns number', 'geekfolio_plg'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '12' => __('1 Column', 'geekfolio_plg'),
                    '6' => __('2 Columns', 'geekfolio_plg'),
                    '4' => __('3 Columns', 'geekfolio_plg'),
                    '3' => __('4 Columns', 'geekfolio_plg'),
                ],
                'default' => '6',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'portfolio_title_styling',
            [
                'label' => __('Portfolio Title', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'content_on_hover!' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'item_title_color',
            [
                'label' => esc_html__('Title Color', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-portfolio .portfolio-card .title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'item_title_color_hover',
            [
                'label' => esc_html__('Title Color Hover', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-portfolio .portfolio-card:hover .title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'item_title_typography',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .geekfolio-portfolio .portfolio-card:hover .title a',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'portfolio_category_styling',
            [
                'label' => __('Portfolio Category', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'content_on_hover!' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'item_category_color',
            [
                'label' => esc_html__('Category Color', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-portfolio .portfolio-card .info .category a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'item_category_color_hover',
            [
                'label' => esc_html__('Category Color Hover', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-portfolio .portfolio-card:hover .info .category a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'item_category_typography',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .geekfolio-portfolio .portfolio-card .info .category a',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'portfolio_excerpt_styling',
            [
                'label' => __('Portfolio Excerpt', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'content_on_hover!' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'item_excerpt_color',
            [
                'label' => esc_html__('Excerpt Color', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-portfolio .portfolio-card .info .text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'item_excerpt_typography',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .geekfolio-portfolio .portfolio-card .info .text',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_tags',
            [
                'label' => esc_html__('Tags', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'content_on_hover!' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'tags_typography',
                'label'     => __('Typography', 'geekfolio_plg'),
                'selector'  => '{{WRAPPER}} .geekfolio-portfolio .portfolio-card .info .tags a',
            ]
        );

        $this->add_control(
            'tags_color',
            [
                'label' => __('Tags Color', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-portfolio .portfolio-card .info .tags a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'tags_bg',
                'label' => __('Button Background', 'geekfolio_plg'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .geekfolio-portfolio .portfolio-card .info .tags a',
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
    protected function render()
    {

        $settings = $this->get_settings();

        $geekfolio_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        if ($settings['port_order'] != 'rand') {
            $order = 'order';
            $ord_val = $settings['port_order'];
        } else {
            $order = 'orderby';
            $ord_val = 'rand';
        }

        if ($settings['sort_cat']  == 'yes') {
            $destudio_work = new \WP_Query(array(
                'posts_per_page'   => $settings['portfolio_item'],
                'post_type' =>  'portfolio', 'geekfolio_plg',
                $order       =>  $ord_val,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'portfolio_category',   // taxonomy name
                        'field' => 'term_id',
                        'terms' => $settings['blog_cat'],           // term_id, slug or name                // term id, term slug or term name
                    )
                )
            ));
        } else {
            $destudio_work = new \WP_Query(array(
                'paged' => $geekfolio_paged,
                'posts_per_page'   => $settings['portfolio_item'],
                'post_type' =>  'portfolio', 'geekfolio_plg',
                $order       =>  $ord_val
            ));
        }

?>

        <div class="geekfolio-portfolio-carousel <?php if ($settings['slider_type'] == 'hscroll') echo 'geekfolio-thecontainer';
                                                    else echo 'geekfolio-port-slider' ?>">
            <?php if ($settings['slider_type'] == 'hscroll') :
                $item_count = 1;
                if ($destudio_work->have_posts()) : while ($destudio_work->have_posts()) : $destudio_work->the_post();
                        global $post; ?>
                        <div class="geekfolio-hscroll-panel mt-30">
                            <div class="item">
                                <div class="img">
                                    <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="">
                                </div>
                                <div class="cont d-flex align-items-end">
                                    <div>
                                        <p>
                                            <?php
                                            $destudio_taxonomy = 'portfolio_category';
                                            $destudio_taxs = wp_get_post_terms($post->ID, $destudio_taxonomy);
                                            $count = 1;
                                            foreach ($destudio_taxs as $destudio_tax) {
                                                if ($count != 1) echo ', '; ?>
                                                <span class="cat"><?php echo $destudio_tax->name; ?></span>
                                            <?php $count++;
                                            }; ?>
                                        </p>
                                        <h5><?php the_title(); ?></h5>
                                    </div>
                                    <div class="ml-auto">
                                        <h6><?php echo get_the_date(__('Y')); ?></h6>
                                    </div>
                                </div>
                                <a href="<?php echo esc_url(the_permalink()) ?>" class="link-overlay"></a>
                            </div>
                        </div>
                <?php endwhile;
                endif;
                wp_reset_postdata();
            endif;
            if ($settings['slider_type'] == 'slider') : ?>
                <div class="container">
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
                <div class="work-crus <?php if($settings['different_img_size'] == 'yes') echo ' random'; ?>">
                    <div class="out">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <?php $item_count = 1;
                                if ($destudio_work->have_posts()) : while ($destudio_work->have_posts()) : $destudio_work->the_post();
                                        global $post; ?>
                                        <div class="swiper-slide">
                                            <div class="item">
                                                <div class="img">
                                                    <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="">
                                                    <div class="cont">
                                                        <?php
                                                        $destudio_taxonomy = 'portfolio_category';
                                                        $destudio_taxs = wp_get_post_terms($post->ID, $destudio_taxonomy);
                                                        $count = 1;
                                                        foreach ($destudio_taxs as $destudio_tax) {
                                                            if ($count != 1) echo ', '; ?>
                                                            <span class="cat"><?php echo $destudio_tax->name; ?></span>
                                                        <?php $count++;
                                                        }; ?>
                                                        <h6 class="fz-18"><?php the_title(); ?></h6>
                                                    </div>
                                                    <a href="<?php echo esc_url(the_permalink()) ?>" class="plink"></a>
                                                </div>
                                            </div>
                                        </div>
                                <?php endwhile;
                                endif;
                                wp_reset_postdata(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

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
    protected function content_template()
    {
    }
}
