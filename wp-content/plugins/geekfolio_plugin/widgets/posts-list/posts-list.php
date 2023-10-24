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
class Geekfolio_Posts_List extends Widget_Base { 

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
		return 'geekfolio-posts-list';
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
		return __( 'Geekfolio Posts List', 'geekfolio_plg' );
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
			'thumbnail_bg',
			[
				'label' => __('Thumbnail as Background', 'geekfolio_plg'),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
				'label_on' => __('Yes', 'geekfolio_plg'),
				'label_off' => __('No', 'geekfolio_plg'),
				'return_value' => 'yes',
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
			'image',
			[
				'label' => __('Show Featured Image', 'geekfolio_plg'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __('Show', 'geekfolio_plg'),
				'label_off' => __('Hide', 'geekfolio_plg'),
				'return_value' => 'yes',
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

		$this->add_control(
			'author',
			[
				'label' => __('Show Author', 'iteck_plg'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __('Show', 'iteck_plg'),
				'label_off' => __('Hide', 'iteck_plg'),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'before_author_text',
			[
				'label' => __('Before Author Text', 'iteck_plg'),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'author' => 'yes',
				],
				'default' => 'By ',
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

		<div class="geekfolio-posts-list <?php if($settings['thumbnail_bg'] == 'yes') echo "thumbnail-bg"; else echo "thumbnail-circle"; ?>">
			<div class="row">
				<div class="col-12">
					<div class="items">
						<?php while ($query->have_posts()) : $query->the_post(); ?>
                            <?php if($settings['thumbnail_bg'] != 'yes'): ?>
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-2 d-flex align-items-center">
                                            <div class="categories">
                                                <?php the_category(' '. $settings['cat_separator'] .' '); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="title-cont">
                                                <h5 class="title">
                                                    <a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 position-re">
                                            <?php if(has_post_thumbnail()): ?>
                                                <div class="img">
                                                    <img src="<?php esc_url(the_post_thumbnail_url()); ?>" alt="post image">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-lg-3 d-flex align-items-center justify-content-end">
                                            <div class="info">
                                                <?php if($settings['date'] == 'yes'): ?>
                                                    <span class="date"><?php echo get_the_date(__('F j, Y')); ?></span>
                                                <?php endif;
                                                if($settings['date'] == 'yes' && $settings['author'] == 'yes'): ?>
                                                    <span class="separator">/</span>
                                                <?php endif;
                                                if($settings['author'] == 'yes'): ?>
                                                    <span class="author"><?php esc_html_e($settings['before_author_text']); echo get_the_author_meta( 'nickname' ); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="item bord-thin-top wow fadeInUp" data-wow-delay=".1s">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="info md-mb30">
                                                <div class="d-flex align-items-center">
                                                    <div class="author">
                                                        <div class="img">
                                                            <img src="<?php echo esc_url(get_avatar_url($post->post_author)) ?>" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="author-info">
                                                        <span class="fz-13 opacity-8 mb-5"><?php esc_html_e($settings['before_author_text']); ?></span>
                                                        <h6 class="fz-18"><?php echo get_the_author_meta( 'nickname' ); ?></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="cont">
                                                <h5 class="title">
                                                    <a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a>
                                                </h5>
                                                <div class="categories">
                                                    <?php the_category(' '. $settings['cat_separator'] .' '); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 d-flex align-items-center justify-content-end">
                                            <div class="ml-auto">
                                                <span class="date sub-title fz-13 opacity-8 mb-30"><?php echo get_the_date(__('j F Y')); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="background bg-img valign text-center" data-background="<?php esc_url(the_post_thumbnail_url()); ?>" data-overlay-dark="4">
                                        <div class="more ontop full-width">
                                            <a href="<?php esc_url(the_permalink()); ?>">
                                                <span>Read More <i class="fas fa-arrow-right ml-10"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif;
						endwhile; wp_reset_postdata(); ?>
					</div>
				</div>
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



