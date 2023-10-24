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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


		
/**
 * @since 1.0.0
 */
class Geekfolio_Posts extends Widget_Base { 

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'geekfolio-posts';
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
	public function get_title() {
		return __( 'Geekfolio Posts', 'geekfolio_plg' );
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
	public function get_icon() {
		return 'eicon-posts';
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
	public function get_categories() {
		return [ 'geekfolio-elements' ];
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
				'label' => __( 'Posts Settings.', 'geekfolio_plg' ),
			]
		);

        $this->add_control(
			'blog_post',
			[
				'label' => __('Blog Post to show', 'geekfolio_plg'),
				'type' => Controls_Manager::NUMBER,
				'default' => '6',

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
			'img_under_content',
			[
				'label' => __('Image Under Content', 'geekfolio_plg'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __('Show', 'geekfolio_plg'),
				'label_off' => __('Hide', 'geekfolio_plg'),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'img_inside_box',
			[
				'label' => __('Image Inside Box', 'geekfolio_plg'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __('Show', 'geekfolio_plg'),
				'label_off' => __('Hide', 'geekfolio_plg'),
				'return_value' => 'yes',
                'condition' => [
                    'img_under_content!' => 'yes'
                ]
			]
		);

		$this->add_control(
			'sort_cat',
			[
				'label' => __('Sort post by Category', 'geekfolio_plg'),
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
				'label'   => __('Category', 'geekfolio_plg'),
				'type'    => Controls_Manager::SELECT2, 'options' => geekfolio_category_choice(),
				'condition' => [
					'sort_cat' => 'yes',
				],
				'multiple'   => 'true',
			]
		);

		$this->add_control(
			'show_excerpt',
			[
				'label' => __('Show Exerpt', 'geekfolio_plg'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __('Show', 'geekfolio_plg'),
				'label_off' => __('Hide', 'geekfolio_plg'),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'excerpt',
			[
				'label' => __('Blog Excerpt Length', 'geekfolio_plg'),
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
				'label' => __('After Excerpt text/symbol', 'geekfolio_plg'),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'show_excerpt' => 'yes',
				],
				'default' => '...',
			]
		);

		$this->add_control(
			'show_cat',
			[
				'label' => __('Show Category', 'geekfolio_plg'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __('Show', 'geekfolio_plg'),
				'label_off' => __('Hide', 'geekfolio_plg'),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'cat_separator',
			[
				'label' => __('Categories Separator', 'geekfolio_plg'),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'show_cat' => 'yes',
				],
				'default' => '-',
			]
		);

		$this->add_control(
			'date',
			[
				'label' => __('Show date', 'geekfolio_plg'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __('Show', 'geekfolio_plg'),
				'label_off' => __('Hide', 'geekfolio_plg'),
				'return_value' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'item_settings',
			[
				'label' => __( 'item Setting','geekfolio_plg' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'item_margin',
			[
				'label' => esc_html__('Item Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-posts .item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_padding',
			[
				'label' => esc_html__('Item Padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-posts .item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_content_padding',
			[
				'label' => esc_html__('Content Padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-posts .item .cont' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label' => esc_html__( 'Border Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-posts .item' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'title_settings',
			[
				'label' => __( 'Title Setting','geekfolio_plg' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->start_controls_tabs('tabs_title_style');

		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' => esc_html__('Normal', 'geekfolio_plg'),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-posts .title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .geekfolio-posts .title a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_title_hover',
			[
				'label' => esc_html__('Hover', 'geekfolio_plg'),
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label' => esc_html__( 'Title Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-posts .title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography_hover',
				'selector' => '{{WRAPPER}} .geekfolio-posts .title a:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__('Title Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-posts .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__('Title Padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-posts .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'category_settings',
			[
				'label' => __( 'Category Setting','geekfolio_plg' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'category_color',
			[
				'label' => esc_html__( 'Title Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-posts .categories a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'category_typography',
				'selector' => '{{WRAPPER}} .geekfolio-posts .categories a',
			]
		);

		$this->add_responsive_control(
			'category_border',
			[
				'label' => esc_html__('Category Border', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-posts .categories' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'category_border_color',
			[
				'label' => esc_html__( 'Border Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-posts .categories' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'category_color',
			[
				'label' => esc_html__( 'Category Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-posts .categories a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-posts .categories' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'category_bg',
			[
				'label' => esc_html__( 'Category Background', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-posts .categories a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'category_typography',
				'selector' => '{{WRAPPER}} .geekfolio-posts .categories a',
			]
		);

		$this->add_responsive_control(
			'category_margin',
			[
				'label' => esc_html__('Category Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-posts .categories' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'date_settings',
			[
				'label' => __( 'Date Setting','geekfolio_plg' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'date_color',
			[
				'label' => esc_html__( 'Date Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-posts .date' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'date_typography',
				'selector' => '{{WRAPPER}} .geekfolio-posts .date',
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
	protected function render() {

		$settings = $this->get_settings();

		
		if ($settings['sort_cat']  == 'yes') {
			$query = new \WP_Query(array(
				'posts_per_page'   => $settings['blog_post'],
				'post_type' => 'post',
				'cat' => $settings['blog_cat']

			));
		} else {
			$query = new \WP_Query(array(
				'posts_per_page'   => $settings['blog_post'],
				'post_type' => 'post'
			));
		}

		?>

		<div class="geekfolio-posts crev">
			<div class="row">
				<?php while ($query->have_posts()) : $query->the_post(); ?>
					<div class="col-lg-<?php echo $settings['columns_number'] ?>">
                        <?php if($settings['img_under_content'] != 'yes'): ?>
                            <div class="item img-row <?php if($settings['img_inside_box'] == 'yes') echo 'img-inside'; ?>">
                                <div class="row rest">
                                    <div class="<?php if($settings['img_inside_box'] == 'yes') echo 'col-lg-6 col-md-5 img-inside-col'; else echo 'col-md-6' ?>">
                                        <div class="img">
                                            <img src="<?php esc_url(the_post_thumbnail_url()); ?>" alt="">
                                        </div>
                                    </div>
                                    <div class="<?php if($settings['img_inside_box'] == 'yes') echo 'col-lg-6 col-md-7 img-inside-col'; else echo 'col-md-6' ?> valign">
                                        <div class="cont">
                                            <span class="date"><?php echo get_the_date(__('F j, Y')); ?></span>
                                            <h5 class="title">
                                                <a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a>
                                            </h5>
                                            <div class="categories">
                                                <?php the_category(' '. $settings['cat_separator'] .' '); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif;
                        if($settings['img_under_content'] == 'yes'): ?>
                            <div class="item img-under-cont">
                                <div class="cont">
                                    <h6 class="title">
                                        <a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a>
                                    </h6>
                                    <div class="info mt-20 mb-20 pt-20 bord-thin-top">
                                        <span class="by">
                                            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><i class="far fa-user fz-14 mr-10"></i> <?php esc_html_e('By ', 'newzin_plg'); echo get_the_author_meta( 'nickname' ); ?></a>
                                        </span>
                                        <span class="dot main-colorbg3"></span>
                                        <span class="date">
                                            <a href="<?php echo esc_url(get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j'))); ?>"><i class="far fa-calendar-alt fz-14 mr-10"></i><?php echo get_the_date(__('F j, Y')); ?></a>
                                        </span>
                                    </div>
                                </div>
                                <div class="img">
                                    <img src="<?php esc_url(the_post_thumbnail_url()); ?>" alt="">
                                    <a href="<?php esc_url(the_permalink()); ?>" class="btn-circle">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.922 4.5V11.8125C13.922 11.9244 13.8776 12.0317 13.7985 12.1108C13.7193 12.1899 13.612 12.2344 13.5002 12.2344C13.3883 12.2344 13.281 12.1899 13.2018 12.1108C13.1227 12.0317 13.0783 11.9244 13.0783 11.8125V5.51953L4.79547 13.7953C4.71715 13.8736 4.61092 13.9176 4.50015 13.9176C4.38939 13.9176 4.28316 13.8736 4.20484 13.7953C4.12652 13.717 4.08252 13.6108 4.08252 13.5C4.08252 13.3892 4.12652 13.283 4.20484 13.2047L12.4806 4.92188H6.18765C6.07577 4.92188 5.96846 4.87743 5.88934 4.79831C5.81023 4.71919 5.76578 4.61189 5.76578 4.5C5.76578 4.38811 5.81023 4.28081 5.88934 4.20169C5.96846 4.12257 6.07577 4.07813 6.18765 4.07812H13.5002C13.612 4.07813 13.7193 4.12257 13.7985 4.20169C13.8776 4.28081 13.922 4.38811 13.922 4.5Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
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
	protected function content_template() {

	}
}



