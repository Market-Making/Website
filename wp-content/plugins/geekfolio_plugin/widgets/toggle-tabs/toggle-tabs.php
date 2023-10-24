<?php

namespace GeekfolioPlugin\Widgets;


use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Utils;


if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Elementor toggle widget.
 *
 * Elementor widget that displays a collapsible display of content in an toggle
 * style, allowing the user to open multiple items.
 *
 * @since 1.0.0
 */
class Geekfolio_Toggle_Tabs extends Widget_Base
{

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
	public function get_name()
	{
		return 'geekfolio-toggle-tabs';
	}

	//script depend
	public function get_script_depends()
	{
		return ['geekfolio-tabs'];
	}


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
	public function get_title()
	{
		return esc_html__('Geekfolio Toggle Tabs', 'geekfolio_plg');
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
	public function get_icon()
	{
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
	public function get_categories()
	{
		return ['geekfolio-elements'];
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
	public function get_keywords()
	{
		return ['tabs', 'accordion', 'toggle'];
	}

	/**
	 * Register toggle widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.1.0
	 * @access protected
	 */

	protected function register_controls()
	{
		$this->start_controls_section(
			'content',
			[
				'label' => __('Content', 'geekfolio_plg')
			]
		);

		$this->add_control(
			'heading',
			[
				'label' => __('Heading', 'geekfolio_plg'),
				'type' => Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'description',
			[
				'label' => __('Description', 'gekkfolio_plg'),
				'type' => Controls_Manager::TEXT
			]
		);

        $this->add_control(
            'revers',
            [
                'label' => __('Revers', 'geekfolio_plg'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __('Yes', 'geekfolio_plg'),
                'label_off' => __('No', 'geekfolio_plg'),
                'return_value' => 'yes',
            ]
        );

		$repeater = new Repeater();

		$repeater->add_control(
			'tab_title',
			[
				'label' => __('Tab Title', 'geekfolio_plg'),
				'type' => Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'back_img',
			[
				'label' => __('Background Image', 'geekfolio_plg'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'icon',
			[
				'label' => __('Icon Image', 'geekfolio_plg'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'text',
			[
				'label' => __('Text', 'geekfolio_plg'),
				'type' => Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'button_text',
			[
				'label' => __('Button Text', 'geekfolio_plg'),
				'type' => Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'button_url',
			[
				'label' => __('Button Link', 'geekfolio_plg'),
				'type' => Controls_Manager::URL,
				'default' => [
					'url' => '#0',
                ]
			]
		);

		$repeater->add_control(
			'button_icon',
			[
				'label' => __('Button Icon', 'geekfolio_plg'),
				'type' => Controls_Manager::ICONS,
			]
		);


		$this->add_control(
			'tabs_repeater',
			[
				'label' => __('Tabs Repeater', 'geekfolio_plg'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{tab_title}}}'
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'heading_style',
			[
				'label' => __('Heading Styles', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_responsive_control(
			'heading_margin',
			[
				'label' => esc_html__('Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle-tabs .heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'heading_padding',
			[
				'label' => esc_html__('Padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle-tabs .heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'heading_border_radius',
			[
				'label' => esc_html__('Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle-tabs .heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'label' => __('Title Typography', 'geekfolio_plg'),
				'selector' => '{{WRAPPER}} .geekfolio-toggle-tabs .heading',
			]
		);
		$this->add_control(
			'heading_color',
			[
				'label' => esc_html__('Heading Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle-tabs .heading' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'heading_stroke',
				'selector' => '{{WRAPPER}} .geekfolio-toggle-tabs .heading',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'heading_border',
				'selector' => '{{WRAPPER}} .geekfolio-toggle-tabs .heading',
			]
		);

		$this->add_control(
			'display',
			[
				'label' => __('Display', 'geekfolio_plg'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'block' => __('Block', 'geekfolio_plg'),
					'inline-block' => __('Inline Block', 'geekfolio_plg')
				],
				'default' => 'inline',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle-tabs .heading' => 'display: {{VALUE}}'
				]
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'desc_style',
			[
				'label' => __('Description Styles', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_responsive_control(
			'desc_margin',
			[
				'label' => esc_html__('Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle-tabs .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'desc_padding',
			[
				'label' => esc_html__('Padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle-tabs .desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'label' => __('Title Typography', 'geekfolio_plg'),
				'selector' => '{{WRAPPER}} .geekfolio-toggle-tabs .desc',
			]
		);
		$this->add_control(
			'desc_color',
			[
				'label' => esc_html__('Description Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle-tabs .desc' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'desc_stroke',
				'selector' => '{{WRAPPER}} .geekfolio-toggle-tabs .desc',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'desc_border',
				'selector' => '{{WRAPPER}} .geekfolio-toggle-tabs .desc',
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
				'label' => esc_html__('Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle-tabs .serv-tab-cont .item .cont' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'card_padding',
			[
				'label' => esc_html__('Padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle-tabs .serv-tab-cont .item .cont' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'card_border_radius',
			[
				'label' => esc_html__('Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle-tabs .serv-tab-cont .item .cont' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_width',
			[
				'label' => esc_html__('Width', 'geekfolio_plg'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => ['%', 'px', 'vw'],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 150,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle-tabs .serv-tab-cont .item .cont' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->start_controls_tabs('card_tabs');
		$this->start_controls_tab(
			'normal_card',
			[
				'label' => __('Normal', 'geekfolio_plg'),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'card_background',
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .geekfolio-toggle-tabs .serv-tab-cont .item .cont',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'card_border',
				'selector' => '{{WRAPPER}} .geekfolio-toggle-tabs .serv-tab-cont .item .cont',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'hover_card',
			[
				'label' => __('Hover', 'geekfolio_plg')
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'card_background_hover',
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .geekfolio-toggle-tabs .serv-tab-cont .item .cont:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'card_border_hover',
				'selector' => '{{WRAPPER}} .geekfolio-toggle-tabs .serv-tab-cont .item .cont:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();


		$this->end_controls_section();

		$this->start_controls_section(
			'card_img',
			[
				'label' => __('Card Image', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

        $this->add_control(
            'card_image',
            [
                'label' => __('Image', 'geekfolio_plg'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'card_image_dark',
            [
                'label' => __('Image (Dark Mode)', 'geekfolio_plg'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'title_style',
			[
				'label' => __('Title Styles', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

        $this->add_control(
            'title_separator',
            [
                'label' => __('Title Separator', 'geekfolio_plg'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __('Yes', 'geekfolio_plg'),
                'label_off' => __('No', 'geekfolio_plg'),
                'return_value' => 'yes',
            ]
        );

		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__('Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle-tabs .item-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __('Title Typography', 'geekfolio_plg'),
				'selector' => '{{WRAPPER}} .geekfolio-toggle-tabs .item-link',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Title Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle-tabs .item-link' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'title_stroke',
				'selector' => '{{WRAPPER}} .geekfolio-toggle-tabs .item-link',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'text_style',
			[
				'label' => __('Text Style', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'label' => __('Text Typography', 'geekfolio_plg'),
				'selector' => '{{WRAPPER}} .geekfolio-toggle-tabs .text p',
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => esc_html__('Text Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle-tabs .text p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'text_margin',
			[
				'label' => esc_html__('Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle-tabs .text p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'icon_styles',
			[
				'label' => __('Image Styles', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_responsive_control(
			'width',
			[
				'label' => esc_html__('Width', 'geekfolio_plg'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => ['%', 'px', 'vw'],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 150,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-img' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label' => esc_html__('Height', 'geekfolio_plg'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units' => ['px', 'vh', '%'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
					'%' => [
						'min' => 1,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'button_style',
			[
				'label' => __('Button Style', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => __('Button Typography', 'geekfolio_plg'),
				'selector' => '{{WRAPPER}} .geekfolio-toggle-tabs .button',
			]
		);
		$this->add_control(
			'button_color',
			[
				'label' => esc_html__('Button Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle-tabs .button' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'button_margin',
			[
				'label' => esc_html__('Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle-tabs .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'btn_icon_styles',
			[
				'label' => __('Button Icon', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'text_indent',
			[
				'label' => esc_html__('Text Indent', 'geekfolio_plg'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle-tabs .button span' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before'
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__('Size', 'zumor_plg'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 14,
				],
				'range' => [
					'px' => [
						'min' => 6,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-toggle-tabs .button i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-toggle-tabs .button svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings();
?>
		<div class="geekfolio-toggle-tabs<?php if($settings['revers'] == 'yes') echo ' reversed'; ?>">
			<div class="row" id="geekfolio-tabs">
				<?php if($settings['revers'] == 'yes'): ?>
				<div class="col-lg-6 valign">
					<div class="serv-tab-link tab-links full-width">
						<div class="sec-lg-head mb-80">
							<h6 class="heading"><?php echo __($settings['heading'], 'geekfolio_plg'); ?></h6>
							<p class="desc"><?php echo __($settings['description'], 'geekfolio_plg'); ?></p>
						</div>
						<ul class="rest <?php if($settings['title_separator'] == 'yes') echo 'title-separator'; ?>">
							<?php $first = true;
							$counter = 0;
							foreach ($settings['tabs_repeater'] as $index => $item) : $counter++; ?>
								<li class="item-link <?php if ($first) echo 'current'; ?>" data-tab="tabs-<?php echo $item['_id']; ?>"><span>0<?php echo __($counter, 'geekfolio_plg'); ?></span> <?php echo __($item['tab_title'], 'geekfolio_plg'); ?></li>
							<?php $first = false;
							endforeach; ?>
						</ul>
					</div>
				</div>
				<?php endif; ?>
				<div class="col-lg-6 order2">
					<div class="serv-tab-cont">
						<?php $counter = 1;
						$first = true;
						foreach ($settings['tabs_repeater'] as $index => $item) : ?>
							<div class="tab-content <?php if ($first) echo 'current'; ?>" id="tabs-<?php echo $item['_id']; ?>" data-tab="tabs-<?php echo $item['_id']; ?>">
								<div class="item">
									<div class="img">
										<img src="<?php echo esc_url($item['back_img']['url']); ?>" alt="">
									</div>
									<div class="cont sub-bg">
										<div class="icon-img">
											<img src="<?php echo esc_url($item['icon']['url']) ?>" alt="">
										</div>
										<div class="text">
											<p><?php echo __($item['text'], 'geekfolio_plg'); ?></p>
										</div>
										<a href="<?php echo esc_url($item['button_url']['url']); ?>" class="button">
											<span class="mr-15"><?php echo __($item['button_text'], 'geekfolio_plg'); ?></span>
											<?php Icons_Manager::render_icon($item['button_icon'], ['aria-hidden' => 'true']); ?>
										</a>
                                        <?php if(!empty($settings['card_image']['url'])): ?>
                                            <div class="bg-pattern bg-img" data-background="<?php echo esc_url($settings['card_image']['url']) ?>"></div>
                                        <?php endif; ?>
                                        <?php if(!empty($settings['card_image_dark']['url'])): ?>
                                            <div class="bg-pattern bg-img dark-mode" data-background="<?php echo esc_url($settings['card_image_dark']['url']) ?>"></div>
                                        <?php endif; ?>
									</div>
								</div>
							</div>
						<?php $first = false;
						endforeach; ?>
					</div>
				</div>
				<?php if($settings['revers'] != 'yes'): ?>
				<div class="col-lg-5 offset-lg-1 valign order1">
					<div class="serv-tab-link tab-links full-width">
						<div class="sec-lg-head mb-80">
							<h6 class="heading"><?php echo __($settings['heading'], 'geekfolio_plg'); ?></h6>
							<p class="desc"><?php echo __($settings['description'], 'geekfolio_plg'); ?></p>
						</div>
						<ul class="rest <?php if($settings['title_separator'] == 'yes') echo 'title-separator'; ?>">
							<?php $first = true;
							$counter = 0;
							foreach ($settings['tabs_repeater'] as $index => $item) : $counter++; ?>
								<li class="item-link <?php if ($first) echo 'current'; ?>" data-tab="tabs-<?php echo $item['_id']; ?>"><span>0<?php echo __($counter, 'geekfolio_plg'); ?></span> <?php echo __($item['tab_title'], 'geekfolio_plg'); ?></li>
							<?php $first = false;
							endforeach; ?>
						</ul>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
<?php
	}
}
