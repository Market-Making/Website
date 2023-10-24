<?php
namespace GeekfolioPlugin\Widgets;


use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Utils;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor toggle widget.
 *
 * Elementor widget that displays a collapsible display of content in an toggle
 * style, allowing the user to open multiple items.
 *
 * @since 1.0.0
 */
class Geekfolio_Toggle extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve toggle widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'geekfolio-toggle';
	}
	
	//script depend
	public function get_script_depends() { return [ 'geekfolio-bootstrap-bundle' ]; }


	/**
	 * Get widget title.
	 *
	 * Retrieve toggle widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Geekfolio Toggle', 'geekfolio_plg' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve toggle widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-toggle';
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
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'tabs', 'accordion', 'toggle' ];
	}

	/**
	 * Register toggle widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.1.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_toggle',
			[
				'label' => esc_html__( 'Toggle', 'geekfolio_plg' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title & Description', 'geekfolio_plg' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Toggle Title', 'geekfolio_plg' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'content',
			[
				'label' => esc_html__( 'Content', 'geekfolio_plg' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Toggle Content', 'geekfolio_plg' ),
				'show_label' => false,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'tabs_repeater',
			[
				'label' => esc_html__( 'Toggle Items', 'geekfolio_plg' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => esc_html__( 'Toggle #1', 'geekfolio_plg' ),
						'content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'geekfolio_plg' ),
					],
					[
						'title' => esc_html__( 'Toggle #2', 'geekfolio_plg' ),
						'content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'geekfolio_plg' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label' => esc_html__( 'Title HTML Tag', 'geekfolio_plg' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
				],
				'default' => 'div',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'counter',
			[
				'label' => __( 'Show Counter', 'geekfolio_plg' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'geekfolio_plg' ),
				'label_off' => __( 'No', 'geekfolio_plg' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'fade_animation',
			[
				'label' => __( 'Fade Animation', 'geekfolio_plg' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'geekfolio_plg' ),
				'label_off' => __( 'No', 'geekfolio_plg' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'first_item_not_collapsed',
			[
				'label' => __( 'First Item not Collapsed', 'geekfolio_plg' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'geekfolio_plg' ),
				'label_off' => __( 'No', 'geekfolio_plg' ),
				'return_value' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_toggle_style',
			[
				'label' => esc_html__( 'Toggle', 'geekfolio_plg' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => esc_html__( 'Border', 'geekfolio_plg' ),
				'selector' => '{{WRAPPER}} .geekfolio-toggle .accordion-item',
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label' => __('Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle .accordion-item' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'space_between',
			[
				'label' => esc_html__( 'Space Between', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle .accordion-item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .geekfolio-toggle .accordion-item',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_toggle_style_title',
			[
				'label' => esc_html__( 'Title', 'geekfolio_plg' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_background',
			[
				'label' => esc_html__( 'Background', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle .accordion-item .accordion-button.collapsed' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_background_active',
			[
				'label' => esc_html__( 'Background Active', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle .accordion-item .accordion-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		// The title selector specificity is to override Theme Style
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle .accordion-item .accordion-button.collapsed .title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-toggle .accordion-item .accordion-button.collapsed:after .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_color_dark',
			[
				'label' => esc_html__( 'Color (Dark)', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-toggle .accordion-item .accordion-button.collapsed .title' => 'color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-toggle .accordion-item .accordion-button.collapsed .title' => 'color: {{VALUE}};',
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-toggle .accordion-item .accordion-button.collapsed:after .title' => 'color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-toggle .accordion-item .accordion-button.collapsed:after .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tab_active_color',
			[
				'label' => esc_html__( 'Active Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle .accordion-item .accordion-button .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tab_active_color_dark',
			[
				'label' => esc_html__( 'Active Color (Dark)', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-toggle .accordion-item .accordion-button .title' => 'color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-toggle .accordion-item .accordion-button .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .geekfolio-toggle .accordion-item .accordion-button .title',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .geekfolio-toggle .accordion-item .accordion-button',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'label' => esc_html__( 'Border', 'geekfolio_plg' ),
				'selector' => '{{WRAPPER}} .geekfolio-toggle .accordion-item .accordion-button',
			]
		);

		$this->add_responsive_control(
			'title_border_radius',
			[
				'label' => __('Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle .accordion-item .accordion-button' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Padding', 'geekfolio_plg' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle .accordion-item .accordion-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_toggle_style_icon',
			[
				'label' => esc_html__( 'Icon', 'geekfolio_plg' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle .accordion-item .accordion-button.collapsed:after' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_active_color',
			[
				'label' => esc_html__( 'Active Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle .accordion-item .accordion-button:after' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_toggle_style_content',
			[
				'label' => esc_html__( 'Content', 'geekfolio_plg' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_background_color',
			[
				'label' => esc_html__( 'Background', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle .accordion-item .accordion-collapse' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle .accordion-body' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .geekfolio-toggle .accordion-body',
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Padding', 'geekfolio_plg' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle .accordion-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_margin',
			[
				'label' => esc_html__( 'Margin', 'geekfolio_plg' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle .accordion-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'label' => esc_html__( 'Border', 'geekfolio_plg' ),
				'selector' => '{{WRAPPER}} .geekfolio-toggle .accordion-body',
			]
		);

		$this->add_responsive_control(
			'content_border_radius',
			[
				'label' => __('Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle .accordion-body' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render toggle widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$myuid = uniqid();

		?>
		<div class="geekfolio-toggle" id="geekfolio-toggle-<?php echo $myuid; ?>">

            <?php $active = $settings['first_item_not_collapsed'] == 'yes' ? true : false; $ani_counter = 1;
            foreach ( $settings['tabs_repeater'] as $index => $item ) :  ?>
                <div class="accordion-item <?php if($settings['fade_animation'] == 'yes') echo 'wow fadeInUp'; ?>" data-wow-delay=".<?php echo $ani_counter; ?>s">
					<<?php echo esc_attr($settings['title_html_tag']); ?> class="accordion-header" id="heading-<?php echo $item['_id']; ?>">
						<button class="accordion-button <?php if(!$active) echo 'collapsed'; ?>" type="button" data-bs-toggle="collapse"
							data-bs-target="#collapse-<?php echo $item['_id']; ?>" aria-expanded="<?php if($active) echo 'true'; else echo 'false'; ?>"
							aria-controls="collapse-<?php echo $item['_id']; ?>">
							<span class="title"><?php echo wp_kses_post($item['title']); ?></span>
                            <span class="ico"></span>
						</button>
					</<?php echo esc_attr($settings['title_html_tag']); ?>>
					<div id="collapse-<?php echo $item['_id']; ?>" class="accordion-collapse collapse <?php if($active) echo 'show'; ?>"
						aria-labelledby="heading-<?php echo $item['_id']; ?>" data-bs-parent="#geekfolio-toggle-<?php echo $myuid; ?>">
						<div class="accordion-body">
							<?php echo wp_kses_post($item['content']); ?>
						</div>
					</div>
				</div>
                <?php $ani_counter += 2; $active = false;
            endforeach; ?>
			

        </div>


		<?php
	}

	/**
	 * Render toggle widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */
	protected function content_template() {
	}
}
