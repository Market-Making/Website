<?php

namespace geekfolioPlugin\Widgets;

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
class Geekfolio_Brands_Slider extends Widget_Base
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
		return 'geekfolio-brands-slider';
	}

	//script depend
	public function get_script_depends() { return [ 'jquery-swiper', 'geekfolio-addons-custom-scripts','wow']; }
	
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
		return __('Geekfolio Brands Slider', 'geekfolio_plg');
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
		return 'eicon-slider-push';
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

     protected function _register_controls(){
        $this->start_controls_section(
            'brands-slider',
            [
                'label' => esc_html__('Brands Slider', 'geekfolio_plg')
            ]
        );

		$this->add_control(
			'circled_border',
			[
				'label' => __( 'Circled Border', 'geekfolio_plg' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'geekfolio_plg' ),
				'label_off' => __( 'Off', 'geekfolio_plg' ),
				'default' => 'yes',
			]
		);
		
		$repeater = new Repeater();

		$repeater->add_control(
			'image',
			[
				'label' => __( 'Image', 'geekfolio_plg' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			],
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

        $this->add_control(
            'images',
            [
                'name' => 'images',
                'label' => __( 'Images', 'geekfolio_plg' ),
                'type' => Controls_Manager::REPEATER,
                'default' => [
					[
						'title' => 'Image-box Title',
						'text' => 'Image-box Text',
					],
					[
						'title' => 'Image-box Title',
						'text' => 'Image-box Text',
					],
					[
						'title' => 'Image-box Title',
						'text' => 'Image-box Text',
					],
				],
				'fields' => $repeater->get_controls(),
            ]
        );
        $this->end_controls_section();

		$this->start_controls_section(
			'img_styles',
			[
				'label' => __('Images', 'geekfolio_plg'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'img_width',
			[
				'label' => esc_html__('Width', 'geekfolio_plg'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-brands-slider .swiper-slide .img-logo img' => 'width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
		$this->end_controls_section();
     }

     protected function render(){
        $settings = $this->get_settings();
        ?>
            <div class="geekfolio-brands-slider">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                    <?php foreach ( $settings['images'] as $index => $item ) : ?>
                        <div class="swiper-slide">
                            <a href="<?php echo esc_url($item['link']['url']); ?>" class="img-logo <?php if($settings['circled_border'] == 'yes') { echo 'circled_border'; } else { echo ''; } ?>">
                                <img src="<?php echo $item['image']['url'] ?>" alt="brand">
                            </a>
                        </div>
                    <?php endforeach; ?>
                    </div>
                </div>
            </div>
     <?php }
}