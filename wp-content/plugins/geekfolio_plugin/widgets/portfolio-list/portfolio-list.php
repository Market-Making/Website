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
class Geekfolio_Portfolio_List extends Widget_Base
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
        return 'geekfolio-portfolio-list';
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
        return __('Geekfolio Portfolio List', 'geekfolio_plg');
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
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */

    protected function register_controls(){
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Portfolio Settings.', 'geekfolio_plg'),
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
			'excerpt',
			[
				'label' => __('Blog Excerpt Length', 'zumar_plg'),
				'type' => Controls_Manager::NUMBER,
				'default' => '150',
				'min' => 10,
				'condition' => [
					'show_excerpt' => 'yes',
				],
			]
		);

		$this->add_control(
			'excerpt_after',
			[
				'label' => __('After Excerpt text/symbol', 'zumar_plg'),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'show_excerpt' => 'yes',
				],
				'default' => '...',
			]
		);


        $this->end_controls_section();

        $this->start_controls_section(
            'item_Style',
            [
                'label' => __('Item Style', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_responsive_control(
			'item_margin',
			[
				'label' => __('Margin', 'zumar_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-portfolio-list .work-row .item' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);
        $this->add_responsive_control(
			'item_padding',
			[
				'label' => __('Padding', 'zumar_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-portfolio-list .work-row .item' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);
        
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'item_border',
				'selector' => '{{WRAPPER}} .geekfolio-portfolio-list .work-row .item',
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'numb_style',
            [
                'label' => __('Number Style', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'numb_color',
            [
                'label' => esc_html__('Number Color', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-portfolio-list .item .title .numb' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'numb_typography',
                'selector' => '{{WRAPPER}} .geekfolio-portfolio-list .item .title .numb',
            ]
        );
        $this->add_responsive_control(
			'numb_margin',
			[
				'label' => __('Margin', 'zumar_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-portfolio-list .item .title .numb' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

        $this->add_responsive_control(
			'numb_padding',
			[
				'label' => __('Padding', 'zumar_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-portfolio-list .item .title .numb' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'title_style',
            [
                'label' => __('Title Style', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-portfolio-list .item .title h5' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .geekfolio-portfolio-list .item .title h5',
            ]
        );
        $this->add_responsive_control(
			'title_margin',
			[
				'label' => __('Margin', 'zumar_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-portfolio-list .item .title h5' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'excerpt_style',
            [
                'label' => __('Excerpt Style', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_excerpt' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'excerpt_color',
            [
                'label' => esc_html__('Excerpt Color', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-portfolio-list .item .text' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typography',
                'selector' => '{{WRAPPER}} .geekfolio-portfolio-list .item .text',
            ]
        );
        $this->add_responsive_control(
			'excerpt_margin',
			[
				'label' => __('Margin', 'zumar_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-portfolio-list .item .text' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'button_style',
            [
                'label' => __('Button Style', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'btn_color',
            [
                'label' => esc_html__('Button Color', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-portfolio-list .item .butn' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography',
                'selector' => '{{WRAPPER}} .geekfolio-portfolio-list .item .butn',
            ]
        );
        $this->add_responsive_control(
			'btn_margin',
			[
				'label' => __('Margin', 'zumar_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-portfolio-list .item .butn' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);
        $this->end_controls_section();


    }

    protected function render(){
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
        <div class="geekfolio-portfolio-list">
                <div class="work-row">
                <?php $item_count = 1; if ($destudio_work->have_posts()) : while  ($destudio_work->have_posts()) : $destudio_work->the_post();
				    global $post ; ?>
                    <div class="item">
                        <div class="row">
                            <div class="col-lg-3 d-flex align-items-end">
                                <div class="title">
                                    <span class="numb"><?php if($item_count < 10) echo '0' . $item_count; else echo $item_count; ?><?php echo __('.', 'geekfolio_plg'); ?></span>
                                    <h5><?php the_title(); ?></h5>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="img md-mb30">
                                    <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="">
                                </div>
                            </div>
                            <div class="col-lg-5 d-flex align-items-end">
                                <div class="cont">
                                    <?php if($settings['show_excerpt'] == 'yes') : ?>
                                        <p class="text">
                                        <?php $excerpt = get_the_excerpt();
										$excerpt = substr($excerpt, 0, $settings['excerpt']);
										echo $excerpt;
										echo esc_attr($settings['excerpt_after']); ?>
                                        </p>
                                    <?php endif; ?>
                                    <a href="<?php echo esc_url( the_permalink()); ?>" class="butn"><?php echo __('View Project ', 'geekfolio_plg'); ?><i
                                            class="ml-5"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.922 4.5V11.8125C13.922 11.9244 13.8776 12.0317 13.7985 12.1108C13.7193 12.1899 13.612 12.2344 13.5002 12.2344C13.3883 12.2344 13.281 12.1899 13.2018 12.1108C13.1227 12.0317 13.0783 11.9244 13.0783 11.8125V5.51953L4.79547 13.7953C4.71715 13.8736 4.61092 13.9176 4.50015 13.9176C4.38939 13.9176 4.28316 13.8736 4.20484 13.7953C4.12652 13.717 4.08252 13.6108 4.08252 13.5C4.08252 13.3892 4.12652 13.283 4.20484 13.2047L12.4806 4.92188H6.18765C6.07577 4.92188 5.96846 4.87743 5.88934 4.79831C5.81023 4.71919 5.76578 4.61189 5.76578 4.5C5.76578 4.38811 5.81023 4.28081 5.88934 4.20169C5.96846 4.12257 6.07577 4.07813 6.18765 4.07812H13.5002C13.612 4.07813 13.7193 4.12257 13.7985 4.20169C13.8776 4.28081 13.922 4.38811 13.922 4.5Z"
                                                    fill="currentColor"></path>
                                            </svg></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="main-marq xlrg">
                            <div class="slide-har st1 strok">
                                <div class="box">
                                    <?php $i = 0; while($i != 5) : ?>
                                    <div class="item">
                                        <h4><?php the_title(); ?></h4>
                                    </div>
                                    <?php $i++; endwhile; ?>
                                </div>
                                <div class="box">
                                    <?php $i = 0; while($i != 5) : ?>
                                    <div class="item">
                                        <h4><?php the_title(); ?></h4>
                                    </div>
                                    <?php $i++; endwhile; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php $item_count++; endwhile; endif; wp_reset_postdata(); ?>
                </div>
        </div>
        <?php
    }
}