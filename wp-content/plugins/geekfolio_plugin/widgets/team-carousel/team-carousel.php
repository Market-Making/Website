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
use Elementor\Repeater;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;


if (!defined('ABSPATH')) exit; // Exit if accessed directly



/**
 * @since 1.0.0
 */
class Geekfolio_Team_Carousel extends Widget_Base
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
        return 'geekfolio-team-carousel';
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
        return __('Geekfolio Team Carousel', 'geekfolio_plg');
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
        return 'eicon-slides';
    }

    public function get_script_depends()
    {
        return ['wow', 'custom-scripts', 'geekfolio-fixed-heading'];
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

    protected function register_controls()
    {
        $this->start_controls_section(
            'content',
            [
                'label' => __('Content', 'geekfolio_plg'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Team', 'geekfolio_plg'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'label' => __('Name', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'Type Name Here',
                'default' => __('adrian parody', 'geekfolio_plg')
            ]
        );

        $repeater->add_control(
            'position',
            [
                'label' => __('Position', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'Type Position Here',
                'default' => __('Co-Founder', 'geekfolio_plg')
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => __('Image', 'geekfolio_plg'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            'team_members',
            [
                'label' => __('Slides', 'geekfolio_plg'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
					[
						'name' => esc_html__( 'adrian parody', 'textdomain' ),
						'position' => esc_html__( 'Co-Founder', 'textdomain' ),
					],
				],
                'title_field' => '{{{name}}}'
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'item_style',
            [
                'label' => __('Name Style', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
			'item_border_color',
			[
				'label' => esc_html__('Item Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-team-carousel .swiper-slide .img' => 'border-color: {{VALUE}};',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'name_style',
            [
                'label' => __('Name Style', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
			'name_color',
			[
				'label' => esc_html__('Name Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-team-carousel .swiper-slide .item .main-marq.team-name .item h4' => 'color: {{VALUE}};',
				],
			]
		);
        
        $this->add_control(
			'name_bg',
			[
				'label' => esc_html__('Name Background', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-team-carousel .swiper-slide .item .main-marq.team-name' => 'background: {{VALUE}};',
				],
			]
		);
        
        $this->add_control(
			'name_bg_dark',
			[
				'label' => esc_html__('Name Background (Dark Mode)', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                    '@media (prefers-color-scheme: dark){ body.geekfolio-auto-mode {{WRAPPER}} .geekfolio-team-carousel .swiper-slide .item .main-marq.team-name' => 'background: {{VALUE}};',
					'} body.geekfolio-dark-mode {{WRAPPER}} .geekfolio-team-carousel .swiper-slide .item .main-marq.team-name' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Name Typography', 'geekfolio_plg'),
				'name' => 'name_typography',
				'selector' => '{{WRAPPER}} .geekfolio-team-carousel .swiper-slide .item.team-name .main-marq .item h4',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'position_style',
            [
                'label' => __('Position Style', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
			'position_color',
			[
				'label' => esc_html__('Position Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-team-carousel .swiper-slide .item .main-marq.team-position .item h4' => 'color: {{VALUE}};',
				],
			]
		);
        
        $this->add_control(
			'position_bg',
			[
				'label' => esc_html__('Position Background', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-team-carousel .swiper-slide .item .main-marq.team-position' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Position Typography', 'geekfolio_plg'),
				'name' => 'position_typography',
				'selector' => '{{WRAPPER}} .geekfolio-team-carousel .swiper-slide .item.team-position .main-marq .item h4',
			]
		);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
?>
        <div class="geekfolio-team-carousel">
            <div class="sec-head geekfolio-sticky-item">
                <h2><?php echo wp_kses_post( $settings['title'] ) ?></h2>
            </div>
            <div class="swiper4">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php foreach ($settings['team_members'] as $index => $item) : ?>
                            <div class="swiper-slide">
                                <div class="item">
                                    <div class="img">
                                        <img src="<?php echo esc_url($item['image']['url']) ?>" alt="">
                                    </div>
                                    <div class="info">
                                        <div class="main-marq team-position">
                                            <div class="slide-har st1 non-strok">
                                                <div class="box">
                                                    <?php for ($i = 1; $i <= 5; $i++) {
                                                        echo '<div class="item"><h4>' . $item['position'] . '</h4></div>';
                                                    }; ?>
                                                </div>
                                                <div class="box">
                                                    <?php for ($i = 1; $i <= 5; $i++) {
                                                        echo '<div class="item"><h4>' . $item['position'] . '</h4></div>';
                                                    }; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="main-marq team-name">
                                            <div class="slide-har st1 non-strok">
                                                <div class="box">
                                                    <?php for ($i = 1; $i <= 5; $i++) {
                                                        echo '<div class="item"><h4>' . $item['name'] . '</h4></div>';
                                                    }; ?>
                                                </div>
                                                <div class="box">
                                                    <?php for ($i = 1; $i <= 5; $i++) {
                                                        echo '<div class="item"><h4>' . $item['name'] . '</h4></div>';
                                                    }; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

<?php
    }
}
