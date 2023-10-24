<?php

namespace GeekfolioPlugin\Widgets;

use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Utils;
use Elementor\Plugin;
use Elementor\Repeater;
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
class Geekfolio_Awards_List extends Widget_Base
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
        return 'geekfolio-awards-list';
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
        return __('Geekfolio Awards List', 'geekfolio_plg');
    }

    public function get_script_depends()
    {
        return ['geekfolio-charming', 'geekfolio-tweenmax', 'geekfolio-demo',  'geekfolio-bootstrap-bundle'];
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
        return 'eicon-call-to-action';
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
            'awards_settings',
            [
                'label' => __('Awards', 'geekfolio_plg')
            ]
        );
        $repeater = new Repeater();

        $repeater->add_control(
            'award_title',
            [
                'label' => __('Award Title', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Independent of the year nomination', 'geekfolio_plg')
            ]
        );

        $repeater->add_control(
            'award_year',
            [
                'label' => __('Award Year', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT,
                'default' => __('2020', 'geekfolio_plg')
            ]
        );

        $repeater->add_control(
            'award',
            [
                'label' => __('Award', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Awwwards', 'geekfolio_plg')
            ]
        );

        $repeater->add_control(
            'award_url',
            [
                'label' => __('Award URL', 'geekfolio_plg'),
                'type' => Controls_Manager::URL,
            ]
        );

        $this->add_control(
            'awards_repeater',
            [
                'label' => __('Awards Repeater', 'geekfolio_plg'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
					[
						'award_title' => esc_html__( 'Independent of the year nomination', 'textdomain' ),
					],
					[
						'award_title' => esc_html__( 'Awwwards Site of the Day', 'textdomain' ),
					],
				],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'awards_style',
            [
                'label' => __('Styles', 'geekfolio_plg'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Title Typography', 'geekfolio_plg'),
                'selector' => '{{WRAPPER}} .geekfolio-awards .award-card .item h5',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => __('Title Color', 'geekfolio_plg'),
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-awards .award-card .item h5' => 'color: {{VALUE}}'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => __('Description Typography', 'geekfolio_plg'),
                'selector' => '{{WRAPPER}} .geekfolio-awards .award-card .item p',
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => __('Description Color', 'geekfolio_plg'),
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-awards .award-card .item p' => 'color: {{VALUE}}'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'end_text_typography',
                'label' => __('End Text Typography', 'geekfolio_plg'),
                'selector' => '{{WRAPPER}} .geekfolio-awards .award-card .end-text',
            ]
        );

        $this->add_control(
            'end_text_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => __('End Text Color', 'geekfolio_plg'),
                'selectors' => [
                    '{{WRAPPER}} .geekfolio-awards .award-card .end-text' => 'color: {{VALUE}}'
                ],
                'separator' => 'after'
            ]
        );
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
?>
        <div class="geekfolio-awards-list">
            <?php foreach ($settings['awards_repeater'] as $index => $item) :
            ?>
                <div class="item">
                    <div>
                        <h6 class="title"><?php echo $item['award_title']; ?></h6>
                        <span class="info"><span class="date"><?php echo $item['award_year']; ?></span> <?php echo $item['award']; ?></span>
                    </div>
                    <div class="ml-auto">
                        <a href="<?php echo esc_url($item['award_url']['url']); ?>" class="arrow-icon">
                            <svg width="100%" height="100%" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.71108 3.78684L8.22361 4.29813L7.71263 4.80992L4.64672 7.87832L4.13433 7.36688L6.87531 4.62335H1.11181H0.750039H0.388177L0.382812 0.718232H1.10645L1.11082 3.90005H6.80113L4.12591 1.22972L4.63689 0.718262L7.71108 3.78684Z" fill="#000"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
<?php
    }
}
