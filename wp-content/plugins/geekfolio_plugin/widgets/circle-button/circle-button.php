<?php

namespace GeekfolioPlugin\Widgets;

use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Utils;
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


if (!defined('ABSPATH')) exit; // Exit if accessed directly



/**
 * @since 1.0.0
 */
class Geekfolio_Circle_Button extends Widget_Base
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
        return 'geekfolio-circle-button';
    }

    public function get_script_depends()
    {
        return ['lity'];
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
        return __('Geekfolio Circle Button', 'geekfolio_plg');
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
                'label' => __('Button Settings', 'geekfolio_plg'),
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label' => __('Button Text', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => 'Click now',
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __('Button Link', 'geekfolio_plg'),
                'type' => Controls_Manager::URL,
                'placeholder' => 'Leave Link here',
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

        $this->add_control(
            'selected_icon',
            [
                'label' => esc_html__('Icon', 'geekfolio_plg'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'skin' => 'inline',
                'label_block' => false,
            ]
        );

		$this->add_control(
			'button_alignment',
			[
				'label' => __('Button Text Alignment', 'geekfolio_plg'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'geekfolio_plg'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __('Center', 'geekfolio_plg'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __('Right', 'geekfolio_plg'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
                    '{{WRAPPER}} .geekfolio-circle-button' => 'text-align: {{VALUE}};'
                ],
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
        $this->start_controls_tabs('btn_tabs');
        $this->start_controls_tab(
            'normal',
            [
                'label' => __('Normal', 'geekfolio_plg'),
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => [ 'gradient', 'classic' ],
				'selector' => '{{WRAPPER}} .geekfolio-circle-button .butn-circle:before',
				'exclude' => ['image'],
			]
		);
        $this->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-circle-button .title' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .geekfolio-circle-button .title',

			]
		);

        $this->add_control(
			'button_icon_size',
			[
				'label' => esc_html__( 'Icon size', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-circle-button i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-circle-button svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'button_icon_color',
			[
				'label' => __('Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-circle-button i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .geekfolio-circle-button svg path' => 'fill: {{VALUE}}',
				],
			]
		);
        $this->end_controls_tab();

        $this->start_controls_tab(
            'hover',
            [
                'label' => __('Hover', 'geekfolio_plg'),
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background_hover',
				'types' => [ 'gradient', 'classic' ],
				'selector' => '{{WRAPPER}} .geekfolio-circle-button .butn-circle:after',
				'exclude' => ['image'],
			]
		);

        $this->add_control(
			'button_text_color_hover',
			[
				'label' => esc_html__( 'Text Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-circle-button:hover .title' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography_hover',
				'selector' => '{{WRAPPER}} .geekfolio-circle-button:hover .title',

			]
		);
        $this->add_control(
			'button_icon_size_hover',
			[
				'label' => esc_html__( 'Icon size', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-circle-button:hover i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-circle-button:hover svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'button_icon_color_hover',
			[
				'label' => __('Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-circle-button:hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .geekfolio-circle-button:hover svg path' => 'fill: {{VALUE}}',
				],
			]
		);
        $this->end_controls_tab();
        $this->end_controls_tabs();
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

?>

        <div class="geekfolio-circle-button">
            <a href="<?php echo esc_url($settings['link']['url']) ?>" class="butn-circle">
                <div class="full-width d-flex flex-column align-items-center">
                    <?php Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true']); ?>
                    <span class="title"><?php echo wp_kses_post($settings['btn_text']) ?></span>
                </div>
                <?php if(!empty($settings['custom_border']['url'])): ?>
                    <img src="<?php echo esc_url($settings['custom_border']['url']) ?>" alt="border" class="circle-star">
                <?php endif; ?>
                <?php if(!empty($settings['custom_border_dark']['url'])): ?>
                    <img src="<?php echo esc_url($settings['custom_border_dark']['url']) ?>" alt="border" class="circle-star dark">
                <?php endif; ?>
            </a>
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
