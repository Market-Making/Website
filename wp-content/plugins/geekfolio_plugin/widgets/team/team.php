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
class Geekfolio_Team extends Widget_Base
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
        return 'geekfolio-team';
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
        return __('Geekfolio Team', 'geekfolio_plg');
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
        return 'eicon-user-circle-o';
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
			'layout',
			[
				'label' => __('Layout', 'geekfolio_plg'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'marquee' => __('Marquee', 'geekfolio_plg'),
					'box' => __('Box', 'geekfolio_plg'),
				],
				'default' => 'marquee'
			]
		);

        $this->add_control(
            'name',
            [
                'label' => __('Name', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'Type Name Here',
                'default' => __('adrian parody', 'geekfolio_plg')
            ]
        );

        $this->add_control(
            'position',
            [
                'label' => __('Position', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'Type Position Here',
                'default' => __('Co-Founder', 'geekfolio_plg')
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __('Image', 'geekfolio_plg'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
?>
        <div class="geekfolio-team <?php echo esc_attr($settings['layout']); ?>">
            <?php if($settings['layout'] == 'marquee'): ?>
                <div class="item">
                    <div class="img">
                        <img src="<?php echo esc_url($settings['image']['url']) ?>" alt="">
                    </div>
                    <div class="info">
                        <div class="main-marq team-position">
                            <div class="slide-har st1 non-strok">
                                <div class="box">
                                    <?php for ($i = 1; $i <= 5; $i++) {
                                        echo '<div class="item"><h4>' . $settings['position'] . '</h4></div>';
                                    }; ?>
                                </div>
                                <div class="box">
                                    <?php for ($i = 1; $i <= 5; $i++) {
                                        echo '<div class="item"><h4>' . $settings['position'] . '</h4></div>';
                                    }; ?>
                                </div>
                            </div>
                        </div>
                        <div class="main-marq team-name">
                            <div class="slide-har st1 non-strok">
                                <div class="box">
                                    <?php for ($i = 1; $i <= 5; $i++) {
                                        echo '<div class="item"><h4>' . $settings['name'] . '</h4></div>';
                                    }; ?>
                                </div>
                                <div class="box">
                                    <?php for ($i = 1; $i <= 5; $i++) {
                                        echo '<div class="item"><h4>' . $settings['name'] . '</h4></div>';
                                    }; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php elseif($settings['layout'] == 'box'): ?>
                <div class="item">
                    <div class="img">
                        <img src="<?php echo esc_url($settings['image']['url']) ?>" alt="">
                    </div>
                    <div class="info d-flex align-items-center">
                        <div>
                            <div class="circle-50">
                                <img src="<?php echo esc_url($settings['image']['url']) ?>" alt="" class="circle-img">
                            </div>
                        </div>
                        <div class="cont ml-20">
                            <span class="fz-12 opacity-8"><?php echo wp_kses_post( $settings['position'] ) ?></span>
                            <h6 class="fz-16"><?php echo wp_kses_post( $settings['name'] ) ?></h6>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

<?php
    }
}
