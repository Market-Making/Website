<?php

namespace GeekfolioPlugin\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
use Elementor\Icons_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly



/**
 * @since 1.1.0
 */
class Geekfolio_Menu extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'geekfolio-menu';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return __('geekfolio Menu', 'geekfolio_plg');
	}

	//script depend
	public function get_script_depends()
	{
		return ['geekfolio-menu'];
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'fa fa-th-large';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return ['geekfolio-menu-elements'];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.1.0
	 *
	 * @access protected
	 */
	protected function _register_controls()
	{

		$this->start_controls_section(
			'section_title',
			[
				'label' => __('Menu to Display', 'geekfolio_plg'),
			]
		);

		$menus = geekfolio_navmenu_navbar_menu_choices();
		if (!empty($menus)) {
			$this->add_control(
				'geekfolio_menu',
				[
					'label'   => __('Select Menu', 'geekfolio_plg'),
					'type'    => Controls_Manager::SELECT,
					'options' => $menus,
					'default' => array_keys($menus)[0],
				]
			);
		} else {
			$this->add_control(
				'menu',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => '<strong>' . __('There are no menus in your site.', 'geekfolio_plg') . '</strong><br>' . sprintf(__('Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'geekfolio_plg'), admin_url('nav-menus.php?action=edit&menu=0')),
					'separator' => 'after',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		}

		$this->add_control(
			'menu_style',
			[
				'label' => __('Style', 'geekfolio_plg'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => __('Default', 'geekfolio_plg'),
					'animated-text' => __('Animated Text', 'geekfolio_plg'),
					'menu-list' => __('List', 'geekfolio_plg'),
				],
				'default' => 'default',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_main-menu',
			[
				'label' => __('Main Menu', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE,

			]
		);

		$this->start_controls_tabs('tabs_menu_item_style');

		$this->start_controls_tab(
			'tab_menu_item_normal',
			[
				'label' => __('Normal', 'geekfolio_plg'),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'menu_typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .geekfolio-nav .navigation li a',
			]
		);

		$this->add_control(
			'menu_color',
			[
				'label' => __('Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-nav .navigation > li a, {{WRAPPER}} .geekfolio-nav.default li.menu-item-has-children > a:after' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'menu_color_dark_mode',
			[
				'label' => esc_html__('Color (Dark Mode)', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-nav .navigation > li a' => 'color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-nav .navigation > li a' => 'color: {{VALUE}};',
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-nav.default li.menu-item-has-children > a:after' => 'color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-nav.default li.menu-item-has-children > a:after' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'menu_border',
				'selector' => '{{WRAPPER}} .geekfolio-nav .navigation > li',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'menu_border_radius',
			[
				'label' => esc_html__('Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-nav .navigation > li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'menu_margin',
			[
				'label' => esc_html__('Item Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-nav .navigation > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'menu_padding',
			[
				'label' => esc_html__('Item Padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-nav .navigation > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'menu_item_shadow',
				'selector' => '{{WRAPPER}} .geekfolio-nav .navigation > li',
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_menu_item_hover',
			[
				'label' => __('Hover', 'geekfolio_plg'),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'menu_typography_hover',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .geekfolio-nav .navigation li a:hover',
			]
		);

		$this->add_responsive_control(
			'padding_underline_menu_item',
			[
				'label' => __('Underline position (px)', 'geekfolio_plg'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
						'min' => -50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-nav .underline.top > .menu-item a:before' => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-nav .underline.bottom > .menu-item a:before' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'underline_color_hover',
			[
				'label' => __('Underline Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-nav .underline > .menu-item a:before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'menu_color_hover',
			[
				'label' => __('Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-nav .navigation > li a:hover, {{WRAPPER}} .geekfolio-nav.default li.menu-item-has-children > a:hover:after' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'menu_color_hover_dark_mode',
			[
				'label' => esc_html__('Color (Dark Mode)', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-nav .navigation > li a:hover' => 'color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-nav .navigation > li a:hover' => 'color: {{VALUE}};',
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-nav.default li.menu-item-has-children > a:hover:after' => 'color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-nav.default li.menu-item-has-children > a:hover:after' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'menu_background_hover',
			[
				'label' => __('Background', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-nav .navigation > li:hover' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'menu_border_hover',
				'selector' => '{{WRAPPER}} .geekfolio-nav .navigation > li:hover a',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'menu_border_radius_hover',
			[
				'label' => esc_html__('Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-nav .navigation > li:hover a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'menu_item_shadow_hover',
				'selector' => '{{WRAPPER}} .geekfolio-nav .navigation > li:hover',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_menu_item_active',
			[
				'label' => __('Active', 'geekfolio_plg'),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'menu_typography_active',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .geekfolio-nav .navigation > li.current_page_item a',
			]
		);

		$this->add_control(
			'menu_color_active',
			[
				'label' => __('Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-nav .navigation > li.current_page_item a, {{WRAPPER}} .geekfolio-nav.default li.menu-item-has-children.current_page_item > a:after' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'menu_color_active_dark_mode',
			[
				'label' => esc_html__('Color (Dark Mode)', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-nav .navigation > li.current_page_item a' => 'color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-nav .navigation > li.current_page_item a' => 'color: {{VALUE}};',
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-nav.default li.menu-item-has-children.current_page_item > a:after' => 'color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-nav.default li.menu-item-has-children.current_page_item > a:after' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'menu_background',
			[
				'label' => __('Background', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-nav .navigation > li.current_page_item' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'menu_border_active',
				'selector' => '{{WRAPPER}} .geekfolio-nav .navigation > li.current_page_item a',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'menu_border_radius_active',
			[
				'label' => esc_html__('Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-nav .navigation > li.current_page_item a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'menu_item_shadow_active',
				'selector' => '{{WRAPPER}} .geekfolio-nav .navigation > li.current_page_item',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();




		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_submain-menu',
			[
				'label' => __('Main Sub-Menu', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE,

			]
		);

		$this->add_control(
			'submenu_arrow_color',
			[
				'label' => __('Arrow Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-nav.default li.menu-item-has-children > a:after' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->start_controls_tabs(
			'style_submain-menu_tabs'
		);

		$this->start_controls_tab(
			'style_submain-menu_normal_tab',
			[
				'label' => esc_html__('Normal', 'textdomain'),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'submenu_typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .geekfolio-nav .menu-wrapper ul li ul li a',
			]
		);

		$this->add_control(
			'submenu_color',
			[
				'label' => __('Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-nav .menu-wrapper ul li ul li a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'submenu_color_dark_mode',
			[
				'label' => esc_html__('Color (Dark Mode)', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-nav .menu-wrapper ul li ul li a' => 'color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-nav .menu-wrapper ul li ul li a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_submain-menu_hover_tab',
			[
				'label' => esc_html__('Hover', 'textdomain'),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'submenu_typography_hover',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .geekfolio-nav .menu-wrapper ul li ul li a:hover',
			]
		);

		$this->add_control(
			'submenu_color_hover',
			[
				'label' => __('Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-nav .menu-wrapper ul li ul li a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'submenu_color_hover_dark_mode',
			[
				'label' => esc_html__('Color (Dark Mode)', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-nav .menu-wrapper ul li ul li a:hover' => 'color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-nav .menu-wrapper ul li ul li a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'padding_vertical_submenu_item',
			[
				'label' => __('Top Position (px)', 'geekfolio_plg'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-nav .menu-wrapper ul li ul' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'boxes_border_radius',
			[
				'label' => __('Border Radius', 'geekfolio_plg'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .menu-wrapper ul li ul' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_mobile-menu',
			[
				'label' => __('Mobile Menu', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE,

			]
		);

		$this->add_control(
			'hamburger_menu_color',
			[
				'label' => __('Hamburger Icon Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .hamburger__icon' => 'background: {{VALUE}};',
					'{{WRAPPER}} .hamburger__icon::before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .hamburger__icon::after' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'close_x_color',
			[
				'label' => __('Close X Icon Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .hamburger.active .hamburger__icon::before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .hamburger.active .hamburger__icon::after' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'padding_top_mobile_menu',
			[
				'label' => __('Top position', 'geekfolio_plg'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .fat-nav' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'mobile_menu_wrapper',
			[
				'label' => esc_html__('Wrapper Padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .fat-nav__wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.1.0
	 *
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings();

		$nav_menu = array('menu' => $settings['geekfolio_menu'], 'echo' => true, 'menu_id' => '', 'items_wrap' => '<ul id="%1$s" class="home-nav navigation %2$s">%3$s</ul>');
?>

		<div class="geekfolio-nav <?php echo esc_attr($settings['menu_style']); ?>">
			<div class="main-menu menu-wrapper d-none d-md-block">
				<?php
				if (!empty($settings['geekfolio_menu'])) {
					wp_nav_menu($nav_menu);
				}; ?>
			</div><!--/.menu-box -- hidden-xs hidden-sm-->
			<div class="mobile-wrapper d-block d-md-none"> <!-- hidden-lg hidden-md -->
				<a href="#" class="hamburger">
					<div class="hamburger__icon"></div>
				</a>
				<div class="fat-nav">
					<div class="fat-nav__wrapper">
						<?php
						$menuParameters = array(
							'menu' => $settings['geekfolio_menu'],
							'container'       => true,
							'items_wrap'      => '<ul id="%1$s" class="mob-nav  %2$s">%3$s</ul>',
							'depth'           => 0,
						);
						?>
						<div class="fat-list"> <?php echo strip_tags(wp_nav_menu($menuParameters), '<a>'); ?></div>
					</div>
				</div>
			</div><!--/.box-mobile-->
		</div>

<?php }

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.1.0
	 *
	 * @access protected
	 */
	protected function content_template()
	{
	}
}
