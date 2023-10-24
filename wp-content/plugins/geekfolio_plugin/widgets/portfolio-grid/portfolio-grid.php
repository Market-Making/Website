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
class Geekfolio_Portfolio_Grid extends Widget_Base
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
        return 'geekfolio-portfolio-grid';
    }

    public function get_script_depends()
    {
        return ['jquery-isotope', 'geekfolio-masonry-gallery'];
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
        return __('Geekfolio Portfolio Grid', 'geekfolio_plg');
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

    protected function register_controls(){
        $this->start_controls_section(
            'settings',
            [
                'label' => __('Settings', 'geekfolio_plg'),

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
			'columns_number',
			[
				'label' => __( 'Columns number', 'geekfolio_plg' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'12' => __( '1 Column', 'geekfolio_plg' ),
					'6' => __( '2 Columns', 'geekfolio_plg' ),
					'4' => __( '3 Columns', 'geekfolio_plg' ),
					'3' => __( '4 Columns', 'geekfolio_plg' ),
				],
				'default' => '6',
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
			'sort_tag',
			[
				'label' => __('Sort post by Tags', 'geekfolio_plg'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __('Yes', 'geekfolio_plg'),
				'label_off' => __('No', 'geekfolio_plg'),
				'return_value' => 'yes',
			]
		);

        $this->add_control(
			'blog_tag',
			[
				'label'   => __('Tags', 'geekfolio_plg'),
				'type'    => Controls_Manager::SELECT, 'options' => geekfolio_portfolio_tag_choice(),
				'condition' => [
					'sort_tag' => 'yes',
				],
				'multiple'   => 'true',
			]
		);

        $this->add_control(
            'masonry_style',
            [
                'label' => __('Metro Style', 'geekfolio_plg'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'label_on' => __('On', 'geekfolio_plg'),
                'label_off' => __('Off', 'geekfolio_plg'),
                'default' => ''
            ]
        );

        $this->add_control(
            'masonry_col_style',
            [
                'label' => __('Masonry Style', 'geekfolio_plg'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'label_on' => __('On', 'geekfolio_plg'),
                'label_off' => __('Off', 'geekfolio_plg'),
                'default' => ''
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'card_styles',
            [
                'label' => __('Card Styles', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
			'card_margin',
			[
				'label' => esc_html__('Card Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-portfolio-grid .items' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'card_padding',
			[
				'label' => esc_html__('Card Padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-portfolio-grid .items' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'portfolio_title_styling',
            [
                'label' => __('Portfolio Title', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'item_title_color',
            [
                'label' => esc_html__('Title Color', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-portfolio-grid .title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'item_title_typography',
                'selector' => '{{WRAPPER}} .geekfolio-portfolio-grid .title a',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'portfolio_category_styling',
            [
                'label' => __('Portfolio Category', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'item_category_color',
            [
                'label' => esc_html__('Category Color', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-portfolio-grid .tag a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'item_category_typography',
                'selector' => '{{WRAPPER}} .geekfolio-portfolio-grid .tag a',
            ]
        );

        $this->end_controls_section();
    }

    protected function render(){
        $settings = $this->get_settings();
        $categories = geekfolio_tax_choice();
        $destudio_taxonomy = 'portfolio_category';
        $destudio_taxs = wp_get_post_terms($post->ID, $destudio_taxonomy);
        if ($settings['port_order'] != 'rand') {
            $order = 'order';
            $ord_val = $settings['port_order'];
        } else {
            $order = 'orderby';
            $ord_val = 'rand';
        }

        $sort_cat = array(
            'taxonomy' => 'portfolio_category',   // taxonomy name
            'field' => 'term_id',
            'terms' => $settings['blog_cat'],           // term_id, slug or name                // term id, term slug or term name
        );

        $sort_tag = array(
            'taxonomy' => 'porto_tag',   // taxonomy name
            'field' => 'term_id',
            'terms' => $settings['blog_tag'],           // term_id, slug or name                // term id, term slug or term name
        );
        
        if ($settings['sort_cat']  == 'yes' || $settings['sort_tag']  == 'yes') {
            $destudio_work = new \WP_Query(array(
                'posts_per_page'   => $settings['portfolio_item'],
                'post_type' =>  'portfolio', 'geekfolio_plg',
                $order       =>  $ord_val,
                'tax_query' => array(
                    $settings['sort_cat'] == 'yes' ? $sort_cat : '',
                    $settings['sort_tag'] == 'yes' ? $sort_tag : ''
                )
            ));
        } else {
            $destudio_work = new \WP_Query(array(
                'paged' => $geekfolio_paged,
                'posts_per_page'   => $settings['portfolio_item'],
                'post_type' =>  'portfolio', 'geekfolio_plg',
                $order       =>  $ord_val,
            ));
        }
        ?>
        <div class="geekfolio-portfolio-grid <?php if($settings['masonry_style'] == 'yes' || $settings['masonry_col_style'] == 'yes') echo 'geekfolio-masonry'; if($settings['masonry_style'] == 'yes') echo ' geekfolio-metro'; ?> section-padding pb-40">
            <div class="row">
                <!-- filter links -->
                <div class="filtering col-12 mb-80 text-center">
                    <div class="filter">
                        <span class="text"><?php esc_html_e( 'Filter By :', 'geekfolio_plg' ) ?></span>
                        <span data-filter='*' class='active' data-count="08"><?php esc_html_e( 'All', 'geekfolio_plg' ) ?></span>
                        <?php 
                        $woo_cats_array = [];
                        if ($destudio_work->have_posts()) : while ( $destudio_work->have_posts() ) : $destudio_work->the_post(); global $post;
                        $woo_cats = get_the_terms( $post->ID, 'portfolio_category' );
                        if($woo_cats) {
                            foreach($woo_cats as $woo_cat) { $woo_cats_array[str_replace(' ', '-', strtolower($woo_cat->name))] = esc_html($woo_cat->name); }   
                        } 
                        endwhile; endif;
                        array_unique($woo_cats_array);
                        foreach($woo_cats_array as $cat => $cat_value): ?>
                                <span data-filter='.<?php echo str_replace(' ', '-', strtolower($cat)) ?>' data-count="03"><?php echo esc_html($cat_value); ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="gallery justify-content-center <?php if($settings['masonry_style'] == 'yes') echo 'metro';  ?> " >
                <div class="row gridss max-margin">
                    <?php $i = 0; if ($destudio_work->have_posts()) : while  ($destudio_work->have_posts()) : $destudio_work->the_post();
                global $post ; $i++; ?>
                    <div class="items col-md-<?php echo esc_attr($settings['columns_number']) ?>  <?php if($settings['masonry_style'] == 'yes'){ if($i == 3 || $i == 5 || $i == 6) echo 'col-lg-6'; else echo 'col-lg-3'; } ?> <?php $destudio_taxs = wp_get_post_terms($post->ID, $destudio_taxonomy); $count = 1; foreach ($destudio_taxs as $destudio_tax) { if($count != 1) echo ' '; echo strtolower(str_replace(' ', '-',$destudio_tax->name)); $count++; } ?> info-overlay">
                        <div class="item-img o-hidden">
                            <a href="<?php the_permalink(); ?>" class="imago">
                                <div class="inner">
                                    <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="image">
                                </div>
                            </a>
                            <?php if($settings['masonry_style'] != 'yes') : ?>
                            <div class="info">
                                <span class="mb-15">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.922 4.5V11.8125C13.922 11.9244 13.8776 12.0317 13.7985 12.1108C13.7193 12.1899 13.612 12.2344 13.5002 12.2344C13.3883 12.2344 13.281 12.1899 13.2018 12.1108C13.1227 12.0317 13.0783 11.9244 13.0783 11.8125V5.51953L4.79547 13.7953C4.71715 13.8736 4.61092 13.9176 4.50015 13.9176C4.38939 13.9176 4.28316 13.8736 4.20484 13.7953C4.12652 13.717 4.08252 13.6108 4.08252 13.5C4.08252 13.3892 4.12652 13.283 4.20484 13.2047L12.4806 4.92188H6.18765C6.07577 4.92188 5.96846 4.87743 5.88934 4.79831C5.81023 4.71919 5.76578 4.61189 5.76578 4.5C5.76578 4.38811 5.81023 4.28081 5.88934 4.20169C5.96846 4.12257 6.07577 4.07813 6.18765 4.07812H13.5002C13.612 4.07813 13.7193 4.12257 13.7985 4.20169C13.8776 4.28081 13.922 4.38811 13.922 4.5Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                <h6 class="sub-title tag"><a href="#0">© <?php echo get_the_date(__('Y')); ?> <br> <?php $destudio_taxs = wp_get_post_terms($post->ID, $destudio_taxonomy); $count = 1; foreach ($destudio_taxs as $destudio_tax) { 
                                    if($count != 1) echo ', ';
                                    echo $destudio_tax->name;
                                    $count++;
                                }; ?></a></h6>
                                <h5 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            </div>
                            <?php else: ?>
                            <div class="info">
                                <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                                <span class="sub-title tag"><a href="<?php the_permalink(); ?>">
                                <?php $destudio_taxs = wp_get_post_terms($post->ID, $destudio_taxonomy); $count = 1; foreach ($destudio_taxs as $destudio_tax) { 
                                    if($count != 1) echo ', ';
                                    echo $destudio_tax->name;
                                    $count++;
                                }; ?></a></span>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endwhile; endif; wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
        <?php
    }
}