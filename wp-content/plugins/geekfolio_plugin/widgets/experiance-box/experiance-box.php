<?php

namespace GeekfolioPlugin\Widgets;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Widget_Base;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Core\Schemes\Typography;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Utils;
use Elementor\Plugin;
use Elementor\Frontend;
use Elementor\Icons_Manager;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Image_Size;
use Elementor\Scheme_Base;
use Elementor\Group_Control_Background;


/**
 * Elementor icon widget.
 *
 * Elementor widget that displays an icon from over 600+ icons.
 *
 * @since 1.0.0
 */
class Geekfolio_Experiance_Box extends Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve icon widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'geekfolio-experiance-box';
    }

    /**
     * Get widget title.
     *
     * Retrieve icon widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('Geekfolio Experiance Box', 'geekfolio_plg');
    }


    /**
     * Get widget icon.
     *
     * Retrieve icon widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-skill-bar';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the icon widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * @since 2.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['geekfolio-menu-elements'];
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
        return ['progress', 'bar'];
    }


    /**
     * Register icon widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 3.1.0
     * @access protected
     */
    protected function register_controls()
    {
        $this->start_controls_section(
            'section_progress',
            [
                'label' => esc_html__('Progress Bar', 'geekfolio_plg'),
            ]
        );

        $this->add_control(
			'layout',
			[
				'label' => esc_html__( 'layout', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'layout-1',
				'options' => [
					'layout-1' => esc_html__( 'Layout 1', 'textdomain' ),
					'layout-2' => esc_html__( 'Layout 2', 'textdomain' ),
				],
			]
		);

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('Enter your title', 'geekfolio_plg'),
                'default' => esc_html__('EUROPE\'S LEADING ARCHITECTURAL', 'geekfolio_plg'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'years_text',
            [
                'label' => esc_html__('Years Text', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('Years Text', 'geekfolio_plg'),
                'default' => esc_html__('Experience', 'geekfolio_plg'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'years',
            [
                'label' => esc_html__('Years', 'geekfolio_plg'),
                'type' => Controls_Manager::NUMBER,
                'default' => 25,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'geekfolio_plg' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => __( 'Item Border', 'geekfolio_plg' ),
				'selector' => '{{WRAPPER}} .geekfolio-experiance-box',
			]
		);

		$this->add_responsive_control(
			'Border_radius',
			[
				'label' => __('Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-experiance-box' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label' => __('Padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-experiance-box' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title Style', 'geekfolio_plg' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Active Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-experiance-box .title' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .geekfolio-experiance-box .title',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_years_style',
			[
				'label' => esc_html__( 'Years Style', 'geekfolio_plg' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'years_color',
			[
				'label' => esc_html__( 'Years Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-experiance-box .years' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'years_typography',
				'selector' => '{{WRAPPER}} .geekfolio-experiance-box .years',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->add_control(
			'years_circle_color',
			[
				'label' => esc_html__( 'Circle Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-experiance-box .years::after' => 'background: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

		$this->add_control(
			'years_text_color',
			[
				'label' => esc_html__( 'Years Text Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-experiance-box .years-text' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'years_text_typography',
				'selector' => '{{WRAPPER}} .geekfolio-experiance-box .years-text',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->end_controls_section();

    }

    /**
     * Render progress widget output on the frontend.
     * Make sure value does no exceed 100%.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

?>

        <div class="geekfolio-experiance-box <?php echo esc_attr( $settings['layout'] ) ?>">
            <?php if($settings['layout'] == 'layout-1'): ?>
                <h6 class="title"><?php echo wp_kses_post( $settings['title'] ) ?></h6>
            <?php endif; ?>
            <div>
                <?php if(!empty($settings['years_text'])): ?> <p class="years-text"><?php echo wp_kses_post( $settings['years_text'] ) ?></p><?php endif; ?>
                <h2 class="years"><?php echo wp_kses_post( $settings['years'] ) ?></h2>
            </div>
            <?php if($settings['layout'] == 'layout-2'): ?>
            <div class="title-cont">
                <h6 class="title"><?php echo wp_kses_post( $settings['title'] ) ?></h6>
            </div>
            <?php endif; ?>
        </div>

<?php
    }
}
