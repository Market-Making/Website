<?php
namespace GeekfolioPlugin\Widgets;

use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Plugin;
use Elementor\Frontend;
use Elementor\Icons_Manager;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Image_Size;
use Elementor\Scheme_Base;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


		
/**
 * @since 1.0.0
 */
class Geekfolio_Card extends Widget_Base {

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
		return 'geekfolio-card';
	}

	//script depend
	public function get_script_depends()
	{
		return ['jquery-swiper', 'geekfolio-addons-custom-scripts'];
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
		return __( 'Geekfolio Card', 'geekfolio_plg' );
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
		return 'eicon-button';
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

    protected function register_controls(){
        $this->start_controls_section(
            'card_content',
            [
                'label' => __('Content', 'geekfolio_plg'),
            ]
        );
		$this->add_control(
			'swiper',
			[
				'label' => __('Swiper', 'geekfolio_plg'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'label_on' => __('Yes', 'geekfolio_plg'),
				'label_off' => __('No', 'geekfolio_plg'),
				'default' => ''
			]
		);
        $this->add_control(
            'card_img_switcher',
            [
                'label' => __('Card Image', 'geekfolio_plg'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'label_on' => __('Show', 'geekfolio_plg'),
                'label_off' => __('Hide', 'geekfolio_plg'),
                'default' => 'yes',
				'condition' => [
					'swiper!' => 'yes'
				]
            ]
        );
        $this->add_control(
            'card_img',
            [
                'label' => __('Image', 'geekfolio_plg'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
                'condition' => [
                    'card_img_switcher' => 'yes',
					'swiper!' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => __('Title', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT,
				'condition' => [
					'swiper!' => 'yes'
				]
            ]
        );
        $this->add_control(
            'sub_title',
            [
                'label' => __('Sub Title', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT,
				'condition' => [
					'swiper!' => 'yes'
				]
            ]
        );
        $this->add_control(
            'description',
            [
                'label' => __('Description', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXTAREA,
				'condition' => [
					'swiper!' => 'yes'
				]
            ]
        );
        $this->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Read More',
				'condition' => [
					'swiper!' => 'yes'
				]
            ]
        );
        $this->add_control(
            'button_icon',
            [
                'label' => __('Icon', 'geekfolio_plg'),
                'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin' => 'inline',
				'label_block' => false,
				'condition' => [
					'swiper!' => 'yes'
				] 
            ]
        );
        $this->add_control(
            'button_link',
            [
                'label' => __('Button Link', 'geekfolio_plg'),
                'type' => Controls_Manager::URL,
                'default' => [
					'url' => '#0',
                ],
				'condition' => [
					'swiper!' => 'yes'
				]
            ]
        );
		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__( 'Alignment', 'geekfolio_plg' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'geekfolio_plg' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'geekfolio_plg' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'geekfolio_plg' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'geekfolio_plg' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}  .geekfolio-card' => 'text-align: {{VALUE}};',
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
            'card_img_switcher',
            [
                'label' => __('Card Image', 'geekfolio_plg'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'label_on' => __('Show', 'geekfolio_plg'),
                'label_off' => __('Hide', 'geekfolio_plg'),
                'default' => 'yes',
            ]
        );
        $repeater->add_control(
            'card_img',
            [
                'label' => __('Image', 'geekfolio_plg'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
                'condition' => [
                    'card_img_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'title',
            [
                'label' => __('Title', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'sub_title',
            [
                'label' => __('Sub Title', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'description',
            [
                'label' => __('Description', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );
        $repeater->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Read More',
            ]
        );
        $repeater->add_control(
            'button_icon',
            [
                'label' => __('Icon', 'geekfolio_plg'),
                'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin' => 'inline',
				'label_block' => false,
            ]
        );
        $repeater->add_control(
            'button_link',
            [
                'label' => __('Button Link', 'geekfolio_plg'),
                'type' => Controls_Manager::URL,
                'default' => [
					'url' => '#0',
                ],
            ]
        );

		$this->add_control(
			'cards_repeater',
			[
				'label' => __('Cards Repeater', 'geekfolio_plg'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{title}}}',
				'condition' => [
					'swiper' => 'yes'
				]
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
					'{{WRAPPER}} .geekfolio-card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .geekfolio-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .geekfolio-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'card_width',
			[
				'label' => esc_html__( 'Width', 'geekfolio_plg' ),
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
				'size_units' => [ '%', 'px', 'vw' ],
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
					'{{WRAPPER}} .geekfolio-card' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .geekfolio-card',
            ]
		);
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'card_border',
				'selector' => '{{WRAPPER}} .geekfolio-card',
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
				'selector' => '{{WRAPPER}} .geekfolio-card:hover',
            ]
		);
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'card_border_hover',
				'selector' => '{{WRAPPER}} .geekfolio-card:hover',
			]
		);
        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->end_controls_section();

        $this->start_controls_section(
            'image_styles',
            [
                'label' => __('Image Styles', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_responsive_control(
			'width',
			[
				'label' => esc_html__( 'Width', 'geekfolio_plg' ),
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
				'size_units' => [ '%', 'px', 'vw' ],
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
				'label' => esc_html__( 'Height', 'geekfolio_plg' ),
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
				'size_units' => [ 'px', 'vh', '%' ],
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
            'title_styles',
            [
                'label' => __('Title Styles', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__('Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-card .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
                'label' => __('Title Typography', 'geekfolio_plg'),
				'selector' => '{{WRAPPER}} .geekfolio-card .title',
			]
        );
        $this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-card .title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'title_stroke',
				'selector' => '{{WRAPPER}} .geekfolio-card .title',
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'sub_title_styles',
            [
                'label' => __('Sub Title Styles', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_responsive_control(
			'sub_title_margin',
			[
				'label' => esc_html__('Margin', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-card .sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sub_title_typography',
                'label' => __('Sub Title Typography', 'geekfolio_plg'),
				'selector' => '{{WRAPPER}} .geekfolio-card .sub-title',
			]
        );
        $this->add_control(
			'sub_title_color',
			[
				'label' => esc_html__( 'Sub Title Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-card .sub-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'sub_title_stroke',
				'selector' => '{{WRAPPER}} .geekfolio-card .sub-title',
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'desc_styles',
            [
                'label' => __('Description', 'geekfolio_plg'),
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
					'{{WRAPPER}} .geekfolio-card .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
                'label' => __('Description Typography', 'geekfolio_plg'),
				'selector' => '{{WRAPPER}} .geekfolio-card .description',
			]
        );
        $this->add_control(
			'desc_color',
			[
				'label' => esc_html__( 'Description Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-card .description' => 'color: {{VALUE}};',
				],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'button_styles',
            [
                'label' => __('Button Styles', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs('button_tabs');

        $this->start_controls_tab(
            'normal_button',
            [
                'label' => __('Normal', 'geekfolio_plg')
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'selector' => '{{WRAPPER}} .geekfolio-card .button',
			]
		);
        $this->add_control(
			'btn_text_color',
			[
				'label' => esc_html__( 'Text Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-card .button' => 'color: {{VALUE}}; fill: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .geekfolio-card .button',
            ]
		);
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_btn',
				'selector' => '{{WRAPPER}} .geekfolio-card .button',
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'hover_button',
            [
                'label' => __('Hover', 'geekfolio_plg')
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography_hover',
				'selector' => '{{WRAPPER}} .geekfolio-card .button:hover',
			]
		);
        $this->add_control(
			'btn_text_color_hover',
			[
				'label' => esc_html__( 'Text Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-card .button:hover' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_hover',
				'label' => esc_html__('Background', 'geekfolio_plg'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .geekfolio-card .button:hover',
            ]
		);
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_btn_hover',
				'selector' => '{{WRAPPER}} .geekfolio-card .button:hover',
			]
		);
        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->end_controls_section();

        $this->start_controls_section(
            'icon_styles',
            [
                'label' => __('Icon', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
			'text_indent',
			[
				'label' => esc_html__( 'Text Indent', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-card .button span' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before'
			]
		);
        $this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'zumor_plg' ),
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
					'{{WRAPPER}} .geekfolio-card .button i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-card .button svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
    }

    protected function render(){
        $settings = $this->get_settings();
        ?>
		<?php if($settings['swiper'] == 'yes') : ?>
			<div class="geekfolio-cards-slider">
				<div class="swiper-container">
					<div class="swiper-wrapper">
					<?php foreach($settings['cards_repeater'] as $index => $item) : ?>
						<div class="swiper-slide">
							<div class="geekfolio-card">
								<?php if($item['card_img_switcher'] == 'yes') : ?>
								<div class="icon-img">
									<img src="<?php echo esc_url($item['card_img']['url']); ?>" class="object-fit-cover w-100 h-100" alt="card_img">
								</div>
								<?php endif; ?>

								<?php if(!empty($item['title'])) : ?>
								<h3 class="title"><?php echo __($item['title'], 'geekfolio_plg'); ?></h3>
								<?php endif; ?>

								<?php if(!empty($item['sub_title'])) : ?>
								<h5 class="sub-title"><?php echo __($item['sub_title'], 'geekfolio_plg'); ?></h5>
								<?php endif; ?>

								<div class="description">
									<p><?php echo __($item['description'], 'geekfolio_plg'); ?></p>
								</div>

								<a href="<?php echo esc_url($item['button_link']['url']); ?>" class="button">
									<span><?php echo __($item['button_text'], 'geekfolio_plg'); ?></span>
									<?php Icons_Manager::render_icon($item['button_icon'], ['aria-hidden' => 'true']); ?>
								</a>
							</div>
						</div>
					<?php endforeach; ?>
					</div>
				</div>
			</div>
		<?php else : ?>
			<div class="geekfolio-card">
				<?php if($settings['card_img_switcher'] == 'yes') : ?>
				<div class="icon-img">
					<img src="<?php echo esc_url($settings['card_img']['url']); ?>" class="object-fit-cover w-100 h-100" alt="card_img">
				</div>
				<?php endif; ?>

				<?php if(!empty($settings['title'])) : ?>
				<h3 class="title"><?php echo __($settings['title'], 'geekfolio_plg'); ?></h3>
				<?php endif; ?>

				<?php if(!empty($settings['sub_title'])) : ?>
				<h5 class="sub-title"><?php echo __($settings['sub_title'], 'geekfolio_plg'); ?></h5>
				<?php endif; ?>

				<div class="description">
					<p><?php echo __($settings['description'], 'geekfolio_plg'); ?></p>
				</div>

				<a href="<?php echo esc_url($settings['button_link']['url']); ?>" class="button">
					<span><?php echo __($settings['button_text'], 'geekfolio_plg'); ?></span>
					<?php Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?>
				</a>
			</div>
        <?php endif;
    }
}