<?php
namespace GeekfolioPlugin\Widgets;

use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\repeater;
use Elementor\Frontend;
use Elementor\Icons_Manager;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Image_Size;
use Elementor\Scheme_Base;
use Elementor\Group_Control_Text_Shadow;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


		
/**
 * @since 1.1.0 
 */
class Geekfolio_Marquee extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve icon list widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'geekfolio-marquee';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve icon list widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Geekfolio Marquee', 'zumor_plg' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve icon list widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-slider-push';
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
		return [ 'list' ];
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
	 * Register icon list widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.1.0
	 * @access protected
	 */

    protected function register_controls(){
        $this->start_controls_section(
            'content',
            [
                'label' => __('Content', 'geekfolio_plg')
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control(
            'text',
            [
                'label' => __('Text', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT
            ]
        );
        $repeater->add_control(
            'separator',
            [
                'label' => __('Separator', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => __('Icon', 'geekfolio_plg'),
                'type' => Controls_Manager::ICONS,
            ]
        );

		$repeater->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'item_typography',
				'selector' => '{{WRAPPER}} .geekfolio-marquee .main-marq {{CURRENT_ITEM}}.item h4 .text',
			]
		);

        $repeater->add_control(
            'item_color',
            [
                'label' => __('Item Color', 'geekfolio_plg'),
                'separator' => 'before',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-marquee .main-marq {{CURRENT_ITEM}}.item h4 .text' => 'color: {{VALUE}}'
                ]
            ]
        );

        $repeater->add_control(
            'item_color_dark',
            [
                'label' => __('Item Color ( Dark )', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-marquee .main-marq {{CURRENT_ITEM}}.item h4 .text' => 'color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-marquee .main-marq {{CURRENT_ITEM}}.item h4 .text' => 'color: {{VALUE}};',
				],
            ]
        );
        
        $repeater->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'item_text_stroke',
				'selector' => '{{WRAPPER}} .geekfolio-marquee .main-marq {{CURRENT_ITEM}}.item h4 .text',
			]
		);

        $repeater->add_control(
            'item_text_stroke_color_dark',
            [
                'label' => __('Item Stroke Color ( Dark )', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-marquee .main-marq {{CURRENT_ITEM}}.item h4 .text' => '-webkit-text-stroke-color: {{VALUE}}; stroke: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-marquee .main-marq {{CURRENT_ITEM}}.item h4 .text' => '-webkit-text-stroke-color: {{VALUE}}; stroke: {{VALUE}};',
				],
            ]
        );

        $this->add_control(
            'marquee_rep',
            [
                'label' => __('Margquee Repeater', 'geekfolio_plg'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'field_title' => '{{{text}}}'
            ]
        );

		$this->add_control(
			'fade_sides',
			[
				'label' => esc_html__('Fade Sides', 'zumor_plg'),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__('Off', 'zumor_plg'),
				'label_on' => esc_html__('On', 'zumor_plg'),
				'default' => 'no',
				'return_value' => 'yes'
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'styles',
            [
                'label' => __('Styles', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
			'duration',
			[
				'label' => esc_html__( 'Duration', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -360,
						'max' => 360,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-marquee .slide-har.st1 .box' => 'animation-duration: {{SIZE}}s',
				],
			]
		);

        $this->add_control(
			'rotate',
			[
				'label' => esc_html__( 'Rotate', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -360,
						'max' => 360,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-marquee .main-marq' => 'transform: rotate({{SIZE}}deg);',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__('Background', 'geekfolio_plg'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .geekfolio-marquee .main-marq',
			]
		);
        
        $this->add_control(
            'background_dark_mode',
            [
                'label' => __('Background (Dark Mode)', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-marquee .main-marq' => 'background-color: {{VALUE}};',
                    '} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-marquee .main-marq' => 'background-color: {{VALUE}};',
                ],
            ]
        );

		$this->add_responsive_control(
			'item_padding',
			[
				'label' => esc_html__( 'Padding', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-marquee .main-marq' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'item_border',
				'label' => __( 'Item Border', 'geekfolio_plg' ),
				'selector' => '{{WRAPPER}} .geekfolio-marquee .main-marq',
			]
		);

		$this->add_responsive_control(
			'item_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'geekfolio_plg' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-marquee .main-marq' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'item_border_color_dark',
            [
                'label' => __('Item Border Color ( Dark Mode )', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-marquee .main-marq' => 'border-color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-marquee .main-marq' => 'border-color: {{VALUE}};',
				],
            ]
        );

		$this->add_control(
			'opacity',
			[
				'label' => __('Opacity', 'geekfolio_plg'),
				'type' => Controls_Manager::NUMBER,
				'min' => '0',
				'max' => '1',
				'step' => '0.1',
				'selectors' => [
					'{{WRAPPER}}' => 'opacity: {{VALUE}};',
				]
			]
		);

        $this->start_controls_tabs('text_tabs');
        $this->start_controls_tab(
            'normal_text',
            [
                'label' => __('Normal', 'geekfolio_plg'),
            ]
        );
        $this->add_control(
            'text_color',
            [
                'label' => __('Text Color', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-marquee .main-marq .item h4 .text' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'text_color_dark',
            [
                'label' => __('Text Color ( Dark )', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-marquee .main-marq .item h4 .text' => 'color: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-marquee .main-marq .item h4 .text' => 'color: {{VALUE}};',
				],
            ]
        );
    
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .geekfolio-marquee .main-marq .item h4 .text',
                'separator' => 'after'
            ]
        );
        
        $this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'text_stroke',
				'selector' => '{{WRAPPER}} .geekfolio-marquee .main-marq .item h4 .text',
			]
		);

        $this->add_control(
            'text_stroke_color_dark',
            [
                'label' => __('Text Stroke Color ( Dark )', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-marquee .main-marq .item h4 .text' => '-webkit-text-stroke-color: {{VALUE}}; stroke: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-marquee .main-marq .item h4 .text' => '-webkit-text-stroke-color: {{VALUE}}; stroke: {{VALUE}};',
				],
            ]
        );

        $this->add_control(
            'text_color_span',
            [
                'label' => __('Span Text Color', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-marquee .main-marq .item h4 .text span' => 'color: {{VALUE}}'
                ]
            ]
        );
    
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography_span',
                'selector' => '{{WRAPPER}} .geekfolio-marquee .main-marq .item h4 .text span',
                'label' => __('Span Typograpghy', 'geekfolio_plg'),
                'separator' => 'after'
            ]
        );
        
        $this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
                'label' => __('Span Stroke', 'geekfolio_plg'),
				'name' => 'text_stroke_span',
				'selector' => '{{WRAPPER}} .geekfolio-marquee .main-marq .item h4 .text span',
			]
		);

        $this->add_control(
            'text_stroke_span_color_dark',
            [
                'label' => __('Span Stroke Color ( Dark )', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-marquee .main-marq .item h4 .text span' => '-webkit-text-stroke-color: {{VALUE}}; stroke: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-marquee .main-marq .item h4 .text span' => '-webkit-text-stroke-color: {{VALUE}}; stroke: {{VALUE}};',
				],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'hover_text',
            [
                'label' => __('Hover', 'geekfolio_plg'),
            ]
        );
        $this->add_control(
            'text_color_hover',
            [
                'label' => __('Span Text Color', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-marquee .main-marq .item h4:hover .text' => 'color: {{VALUE}}'
                ]
            ]
        );
    
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography_hover',
                'label' => __('Span Typograpghy', 'geekfolio_plg'),
                'selector' => '{{WRAPPER}} .geekfolio-marquee .main-marq .item h4:hover .text',
                'separator' => 'after'
            ]
        );
        
        $this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'text_stroke_hover',
                'label' => __('Span Text Stroke', 'geekfolio_plg'),
				'selector' => '{{WRAPPER}} .geekfolio-marquee .main-marq .item h4:hover .text',
			]
		);

        $this->add_control(
            'text_color_span_hover',
            [
                'label' => __('Text Color', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-marquee .main-marq .item h4:hover .text span' => 'color: {{VALUE}}'
                ]
            ]
        );
    
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography_span_hover',
                'selector' => '{{WRAPPER}} .geekfolio-marquee .main-marq .item h4:hover .text span',
                'separator' => 'after'
            ]
        );
        
        $this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'text_stroke_span_hover',
				'selector' => '{{WRAPPER}} .geekfolio-marquee .main-marq .item h4:hover .text span',
			]
		);
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'sep_color',
            [
                'label' => __('Separator Color', 'geekfolio_plg'),
                'separator' => 'before',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-marquee .main-marq .item h4 .separator' => 'color: {{VALUE}}'
                ]
            ]
        );
    
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sep_typography',
                'label' => __('Separator Typography', 'geekfolio_plg'),
                'selector' => '{{WRAPPER}} .geekfolio-marquee .main-marq .item h4 .separator',
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'sep_text_stroke',
                'label' => __('Separator Stroke', 'geekfolio_plg'),
				'selector' => '{{WRAPPER}} .geekfolio-marquee .main-marq .item h4 .separator',
			]
		);

        $this->add_control(
            'sep_text_stroke_color_dark',
            [
                'label' => __('Item Stroke Color ( Dark )', 'geekfolio_plg'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-marquee .main-marq .item h4 .separator' => '-webkit-text-stroke-color: {{VALUE}}; stroke: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-marquee .main-marq .item h4 .separator' => '-webkit-text-stroke-color: {{VALUE}}; stroke: {{VALUE}};',
				],
            ]
        );

        
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__('Icon Size', 'geekfolio_plg'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-marquee i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-marquee svg ' => 'width: {{SIZE}}{{UNIT}};',
				],
                'separator' => 'before'
			]
		);

        $this->add_control(
			'icon_color',
			[
				'label' => esc_html__('Icon Color', 'zumar_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-marquee i' => 'color: {{VALUE}}; fill: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-marquee svg path' => ' fill: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'invert_dark',
			[
				'label' => esc_html__( 'Invert Image ( Dark )', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'geekfolio_plg' ),
				'label_off' => esc_html__( 'No', 'geekfolio_plg' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
        $this->end_controls_section();
    }

    protected function render(){
        $settings = $this->get_settings();
        ?>
        <div class="geekfolio-marquee">
            <div class="row">
                <div class="col-12">
                    <div class="main-marq dark-text <?php if($settings['fade_sides'] == 'yes') echo 'fade-sides'; ?>">
                        <div class="slide-har st1">
                            <div class="box align-items-center non-strok">
                                <?php foreach($settings['marquee_rep'] as $index => $item) : ?>
                                <div class="item <?php echo 'elementor-repeater-item-' . esc_attr( $item['_id'] ) . ''; ?>">
                                    <h4 class="d-flex align-items-center"><span class="text"><?php echo __($item['text'], 'geelfolio_plg'); ?></span> 
                                        <?php Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']); ?>
                                        <?php if(!empty($item['separator'])): ?>
                                            <span class="separator"><?php echo __($item['separator'], 'geekfolio_plg'); ?></span>
                                        <?php endif; ?>
                                    </h4>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="box align-items-center non-strok">
                                <?php foreach($settings['marquee_rep'] as $index => $item) : ?>
                                <div class="item <?php echo 'elementor-repeater-item-' . esc_attr( $item['_id'] ) . ''; ?>">
                                    <h4 class="d-flex align-items-center"><span class="text"><?php echo __($item['text'], 'geelfolio_plg'); ?></span> 
                                        <?php Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']); ?>
                                        <?php if(!empty($item['separator'])): ?>
                                            <span class="separator"><?php echo __($item['separator'], 'geekfolio_plg'); ?></span>
                                        <?php endif; ?>
                                    </h4>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}