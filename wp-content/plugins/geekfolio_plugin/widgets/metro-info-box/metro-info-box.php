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
class Geekfolio_Metro_Info_Box extends Widget_Base
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
        return 'geekfolio-metro-info-box';
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
        return __('Geekfolio Metro Info Box', 'geekfolio_plg');
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
        return ['geekfolio-metro-scroll'];
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
        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => __('Title', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'Type Title Here',
                'default' => __('Creative Vision', 'geekfolio_plg')
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => __('Link', 'geekfolio_plg'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#0',
                ]
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => __('Description', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => 'Type Description Here',
                'default' => __('Creating a higher spacing and how people move through a unique.', 'geekfolio_plg')
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
            'items',
            [
                'label' => __('Items', 'geekfolio_plg'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{name}}}',
                'default' => [
					[],
                ]
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'title_style',
            [
                'label' => __('Title Style', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
			'title_color',
			[
				'label' => esc_html__('Title Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-metro-info-box .items .item .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Title Typography', 'geekfolio_plg'),
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .geekfolio-metro-info-box .items .item .title',
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

        $this->add_control(
			'text_color',
			[
				'label' => esc_html__('Text Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-metro-info-box .items .item p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('TExt Typography', 'geekfolio_plg'),
				'name' => 'text_typography',
				'selector' => '{{WRAPPER}} .geekfolio-metro-info-box .items .item p',
			]
		);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
?>
        <div class="geekfolio-metro-info-box">
            <div class="metro">
                <div class="items">
                    <?php foreach ($settings['items'] as $index => $item) : ?>
                        <div class="item">
                            <span class="icon">
                                <img src="<?php echo esc_url($item['image']['url']); ?>" alt="">
                            </span>
                            <h5 class="title">
                                <a href="<?php echo esc_url( $item['link']['url'] ); ?>"><?php echo wp_kses_post( $item['title'] ) ?></a>
                            </h5>
                            <p><?php echo wp_kses_post( $item['description'] ) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

<?php
    }
}
