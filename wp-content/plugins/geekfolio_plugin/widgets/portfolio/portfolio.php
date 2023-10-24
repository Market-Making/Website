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
class Geekfolio_Portfolio extends Widget_Base
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
        return 'geekfolio-portfolio';
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
        return __('Geekfolio Portfolio', 'geekfolio_plg');
    }

    public function get_script_depends()
    {
        return ['geekfolio-portfolio-fixed'];
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
            'fixed_scroll',
            [
                'label' => __('Fixed Scroll', 'geekfolio_plg'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __('Yes', 'geekfolio_plg'),
                'label_off' => __('No', 'geekfolio_plg'),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'regular_style',
            [
                'label' => __('Regular style', 'geekfolio_plg'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __('Yes', 'geekfolio_plg'),
                'label_off' => __('No', 'geekfolio_plg'),
                'return_value' => 'yes',
                'condition' => [
                    'fixed_scroll!' => 'yes'
                ]
            ]
        );
        
        $this->add_control(
			'excerpt',
			[
				'label' => __('Blog Excerpt Length', 'newzin_plg'),
				'type' => Controls_Manager::NUMBER,
				'default' => '150',
				'min' => 10,
				'condition' => [
					'fixed_scroll' => 'yes',
				],
			]
		);

		$this->add_control(
			'excerpt_after',
			[
				'label' => __('After Excerpt text/symbol', 'newzin_plg'),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'fixed_scroll' => 'yes',
				],
				'default' => '...',
			]
		);

		$this->add_control(
            'btn_type',
            [
				'label'         => __( 'Button Type', 'geekfolio_plg' ),
				'type'          => Controls_Manager::SELECT,
				'options' => [
					'normal' => esc_html__('Normal', 'geekfolio_plg'),
					'circle' => esc_html__('Circle Button', 'geekfolio_plg'),
				],
				'default' => 'normal',
			]
        );

		$this->add_control(
			'btn_text',
			[
				'label' => __('Button Text', 'newzin_plg'),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'fixed_scroll' => 'yes',
				],
				'default' => 'Explore More',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'circle_button_styles',
            [
                'label' => __('Circle Button Styles', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'custom_border',
            [
                'label' => __('Border', 'geekfolio_plg'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'custom_border_dark',
            [
                'label' => __('Border (Dark Mode)', 'geekfolio_plg'),
                'type' => Controls_Manager::MEDIA,
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
                $order       =>  $ord_val
            ));
        }

    ?>

        <div class="geekfolio-portfolio <?php if($settings['fixed_scroll'] == 'yes') echo 'portfolio-fixed'; if($settings['regular_style'] == 'yes') echo 'portfolio-regular'; ?>">
            <?php if($settings['fixed_scroll'] != 'yes'): ?>
                <div class="row justify-content-center">
                    <?php $item_count = 1; if ($destudio_work->have_posts()) : while  ($destudio_work->have_posts()) : $destudio_work->the_post();
                        global $post ; ?>
                        <div class="col-lg-<?php if($item_count == 1 && $settings['regular_style'] != 'yes') echo '5'; elseif(($item_count != 1 && $settings['regular_style'] != 'yes') || (($item_count == 1 || $item_count == 2)  && $settings['regular_style'] == 'yes')) echo '6'; if($item_count >= 3  && $settings['regular_style'] == 'yes') echo '4'; if(($item_count == 2 || $item_count == 3)  && $settings['regular_style'] != 'yes') echo ' valign'; ?>">
                            <div class="item md-mb50 <?php if($item_count == 2 || $item_count == 3) echo 'full-width'; ?>">
                                <?php $col_num = $item_count == 2 ? 8 : 9; if($item_count != 1 && $settings['regular_style'] != 'yes') echo '<div class="row justify-content-center"><div class="col-lg-'.$col_num.'">'; ?>
                                <div class="img imago wow">
                                    <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="">
                                    <?php if($settings['regular_style'] == 'yes'): 
                                        $destudio_taxonomy = 'portfolio_category';
                                        $destudio_taxs = wp_get_post_terms($post->ID, $destudio_taxonomy);
                                        $count = 1;
                                        foreach ($destudio_taxs as $destudio_tax) { 
                                            if($count != 1) echo ', '; ?>
                                            <small class="cat"><?php echo $destudio_tax->name; ?></small>
                                            <?php $count++;
                                        };
                                    endif; ?> 
                                </div>
                                <div class="cont mt-30 d-flex">
                                    <div>
                                        <h6><a class="title" href="<?php echo esc_url( the_permalink() ) ?>"><?php the_title(); ?></a></h6>
                                        <?php if($settings['regular_style'] != 'yes'): ?>
                                        <p>
                                            <?php
                                            $destudio_taxonomy = 'portfolio_category';
                                            $destudio_taxs = wp_get_post_terms($post->ID, $destudio_taxonomy);
                                            $count = 1;
                                            foreach ($destudio_taxs as $destudio_tax) { 
                                                if($count != 1) echo ', '; ?>
                                                <small class="cat"><?php echo $destudio_tax->name; ?></small>
                                                <?php $count++;
                                            }; ?>    
                                        </p>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="date-cont">
                                        <p class="date">© <?php echo get_the_date(__('Y')); ?></p>
                                    </div>
                                </div>
                                <?php if($item_count != 1 && $settings['regular_style'] != 'yes') echo '</div></div>'; if($item_count == 4 && $settings['regular_style'] != 'yes') $item_count = 1; else $item_count++; ?>
                            </div>
                        </div>
                    <?php endwhile; endif; wp_reset_postdata(); ?>
                </div>
            <?php else: ?>
                <div class="row">
                    <div class="col-lg-6 rest">
                        <div class="left" id="sticky_item">
                            <?php $counter = 1; if ($destudio_work->have_posts()) : while  ($destudio_work->have_posts()) : $destudio_work->the_post();
                            global $post ; ?>
                                <div id="tab-<?php echo $counter; ?>" class="img bg-img" data-background="<?php echo esc_url(get_the_post_thumbnail_url()); ?>">
                                </div>
                            <?php $counter++; endwhile; endif; wp_reset_postdata(); ?>
                        </div>
                    </div>
                    <div class="col-lg-6 sub-bg right">
                        <?php $counter = 1; if ($destudio_work->have_posts()) : while  ($destudio_work->have_posts()) : $destudio_work->the_post();
                            global $post ; ?>
                            <div class="cont" data-tab="tab-<?php echo $counter; ?>">
                                <div class="img-hiden">
                                    <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="">
                                </div>
                                <span class="categories">
                                    <?php
                                    $destudio_taxonomy = 'portfolio_category';
                                    $destudio_taxs = wp_get_post_terms($post->ID, $destudio_taxonomy);
                                    $count = 1;
                                    foreach ($destudio_taxs as $destudio_tax) { 
                                        if($count != 1) echo ', '; ?>
                                        <small class="cat"><?php if($counter < 10): echo '0'; endif; echo $counter. '. ' .$destudio_tax->name; ?></small>
                                        <?php $count++;
                                    }; ?>
                                </span>
                                <h2 class="title"><?php the_title(); ?></h2>
                                <div class="row">
                                    <div class="col-md-9">
                                        <p>
                                            <?php $excerpt = get_the_excerpt();
                                            $excerpt = substr($excerpt, 0, $settings['excerpt']);
                                            echo $excerpt;
                                            echo esc_attr($settings['excerpt_after']) ?>
                                        </p>
                                        <div class="tags">
                                            <?php
                                            $destudio_taxonomy = 'porto_tag';
                                            $destudio_taxs = wp_get_post_terms($post->ID, $destudio_taxonomy);
                                            foreach ($destudio_taxs as $destudio_tax) { ?>
                                                <li class="tag">
                                                    <span class="icon">
                                                        <svg width="100%" height="100%" viewBox="0 0 9 8" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M7.71108 3.78684L8.22361 4.29813L7.71263 4.80992L4.64672 7.87832L4.13433 7.36688L6.87531 4.62335H1.11181H0.750039H0.388177L0.382812 0.718232H1.10645L1.11082 3.90005H6.80113L4.12591 1.22972L4.63689 0.718262L7.71108 3.78684Z"
                                                                fill="#fff"></path>
                                                        </svg>
                                                    </span>
                                                    <h6 class="inline fz-16 fw-400"><?php echo $destudio_tax->name; ?></h6>
                                                </li>
                                                <?php $count++;
                                            }; ?>
                                        </div>
                                        <?php if($settings['btn_type'] == 'normal'): ?>
                                            <div class="view-all">
                                                <a href="<?php echo esc_url( the_permalink() ) ?>" class="view-all-btn">
                                                    <?php echo wp_kses_post( $settings['btn_text'] ); ?>
                                                    <span>
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M13.922 4.5V11.8125C13.922 11.9244 13.8776 12.0317 13.7985 12.1108C13.7193 12.1899 13.612 12.2344 13.5002 12.2344C13.3883 12.2344 13.281 12.1899 13.2018 12.1108C13.1227 12.0317 13.0783 11.9244 13.0783 11.8125V5.51953L4.79547 13.7953C4.71715 13.8736 4.61092 13.9176 4.50015 13.9176C4.38939 13.9176 4.28316 13.8736 4.20484 13.7953C4.12652 13.717 4.08252 13.6108 4.08252 13.5C4.08252 13.3892 4.12652 13.283 4.20484 13.2047L12.4806 4.92188H6.18765C6.07577 4.92188 5.96846 4.87743 5.88934 4.79831C5.81023 4.71919 5.76578 4.61189 5.76578 4.5C5.76578 4.38811 5.81023 4.28081 5.88934 4.20169C5.96846 4.12257 6.07577 4.07813 6.18765 4.07812H13.5002C13.612 4.07813 13.7193 4.12257 13.7985 4.20169C13.8776 4.28081 13.922 4.38811 13.922 4.5Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                </a>
                                            </div>
                                        <?php else: ?>
                                            <div class="geekfolio-circle-button">
                                                <a href="<?php echo esc_url(the_permalink()) ?>" class="butn-circle">
                                                    <div class="full-width d-flex flex-column align-items-center">
                                                        <span>
                                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M13.922 4.5V11.8125C13.922 11.9244 13.8776 12.0317 13.7985 12.1108C13.7193 12.1899 13.612 12.2344 13.5002 12.2344C13.3883 12.2344 13.281 12.1899 13.2018 12.1108C13.1227 12.0317 13.0783 11.9244 13.0783 11.8125V5.51953L4.79547 13.7953C4.71715 13.8736 4.61092 13.9176 4.50015 13.9176C4.38939 13.9176 4.28316 13.8736 4.20484 13.7953C4.12652 13.717 4.08252 13.6108 4.08252 13.5C4.08252 13.3892 4.12652 13.283 4.20484 13.2047L12.4806 4.92188H6.18765C6.07577 4.92188 5.96846 4.87743 5.88934 4.79831C5.81023 4.71919 5.76578 4.61189 5.76578 4.5C5.76578 4.38811 5.81023 4.28081 5.88934 4.20169C5.96846 4.12257 6.07577 4.07813 6.18765 4.07812H13.5002C13.612 4.07813 13.7193 4.12257 13.7985 4.20169C13.8776 4.28081 13.922 4.38811 13.922 4.5Z" fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                        <span class="btn-text"><?php echo wp_kses_post( $settings['btn_text'] ); ?></span>
                                                    </div>
                                                    <?php if(!empty($settings['custom_border']['url'])): ?>
                                                        <img src="<?php echo esc_url($settings['custom_border']['url']) ?>" alt="border" class="circle-star">
                                                    <?php endif; ?>
                                                    <?php if(!empty($settings['custom_border_dark']['url'])): ?>
                                                        <img src="<?php echo esc_url($settings['custom_border_dark']['url']) ?>" alt="border" class="circle-star dark">
                                                    <?php endif; ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php $counter++; endwhile; endif; wp_reset_postdata(); ?>
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
