<?php
namespace GeekfolioPlugin\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


		
/**
 * @since 1.0.0
 */
class Geekfolio_Images_Carousel extends Widget_Base {

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
		return 'geekfolio-images-carousel';
	}
		//script depend
	public function get_script_depends() { return [ 'jquery-swiper', 'custom-scripts' ]; }

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
		return __( 'Geekfolio Images Carousel', 'geekfolio_plg' );
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
		return 'eicon-blockquote';
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
	protected function _register_controls() {
	
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Gallery Images', 'geekfolio_plg' ),
			]
		);

		$this->add_control(
			'items_per_slide',
			[
				'label' => __('Items Per Slide', 'geekfolio_plg'),
				'type' => Controls_Manager::NUMBER,
				'default' => '5',
				'min' => '0',
				'step' => '1',
			]
		);

		$this->add_control(
			'space',
			[
				'label' => __('Space', 'geekfolio_plg'),
				'type' => Controls_Manager::NUMBER,
				'default' => '40',
				'min' => '0',
				'max' => '100',
				'step' => '1'
			]
		);

		$this->add_control(
			'center_slides',
			[
				'label' => __('Centeralized Slides', 'geekfolio_plg'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'geekfolio_plg'),
				'label_off' => __('No', 'geekfolio_plg'),
				'return_value' => 'yes',
				'default' => ''
			]
		);


        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => __('Image', 'geekfolio_plg'),
                'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
            ]
        );

        $repeater->add_control(
            'image_dark_mode',
            [
                'label' => __('Image (dark mode)', 'geekfolio_plg'),
                'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
            ]
        );

		$repeater->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'elementor' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => '',
				],
				'separator' => 'before',
			]
		);

        $this->add_control(
            'gallery',
            [
                'label' => __('Images', 'geekfolio_plg'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => __( 'Image style', 'geekfolio_plg' ),
				'tab' => Controls_Manager::TAB_STYLE,

			]
		);

		$this->add_responsive_control(
			'img_width',
			[
				'label' => __( 'Image Width', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-images-carousel .image-card img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'img_height',
			[
				'label' => __( 'Image height', 'geekfolio_plg' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-images-carousel .image-card img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_margin',
			[
				'label' => esc_html__( 'Margin', 'geekfolio_plg' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-images-carousel .image-card img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

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
	protected function render() {
		$settings = $this->get_settings();
	?>
		<div class="geekfolio-images-carousel">
			<div class="swiper-container" data-items="<?php echo $settings['items_per_slide']; ?>" data-space="<?php echo $settings['space']; ?>" data-center="<?php echo $settings['center_slides']; ?>">
				<div class="swiper-wrapper">
					<?php foreach($settings['gallery'] as $index => $item): ?>
					<div class="swiper-slide">
						<a href="<?php echo esc_url( $item['link']['url'] ); ?>" class="image-card" data-fancybox="gallery">
							<img src="<?php echo esc_url( $item['image']['url'] ); ?>" alt="">
						</a>
						<a href="<?php echo esc_url( $item['link']['url'] ); ?>" class="image-card dark-mode" data-fancybox="gallery">
							<img src="<?php if(!empty($item['image_dark_mode']['url'])) echo esc_url( $item['image_dark_mode']['url'] ); else echo esc_url( $item['image']['url'] );  ?>" alt="">
						</a>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
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
	protected function content_template() {
		
		
	}
}


