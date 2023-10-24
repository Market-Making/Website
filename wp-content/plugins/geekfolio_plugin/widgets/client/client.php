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


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


		
/**
 * @since 1.0.0
 */
class Geekfolio_Client extends Widget_Base {

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
		return 'geekfolio-client';
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
		return __( 'Geekfolio Client', 'geekfolio_plg' );
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
	protected function _register_controls() {
	
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Client Settings', 'geekfolio_plg' ),
			]
		);

		$this->add_control(
			'clients_carousel',
			[
				'label' => esc_html__('Clients Carousel', 'geekfolio_plg'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);

		$this->add_control(
			'text',
			[
				'label' => __( 'Text','geekfolio_plg' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'label_block' => true,
				'default' => __( 'Insert text here..', 'geekfolio_plg' ),
				'condition' => [
					'clients_carousel!' => 'yes',
				],
			]
		);
		
		$this->add_control(
			'link',
			[
				'label' => __( 'Client Link','geekfolio_plg' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'Leave Link here',
				'condition' => [
					'clients_carousel!' => 'yes',
				],
			]
		);

		$this->add_control(
            'image',
            [
                'label' => __( 'Light image', 'geekfolio_plg' ),
                'type' => Controls_Manager::MEDIA,
				'default' => [
							'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'clients_carousel!' => 'yes',
				],
            ]
        );
		$this->add_control(
            'image2',
            [
                'label' => __( 'Dark Image', 'geekfolio_plg' ),
                'type' => Controls_Manager::MEDIA,
				'default' => [
							'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'clients_carousel!' => 'yes',
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

		$this->add_control(
			'item_text_color',
			[
				'label' => __('Text Color', 'geekfolio_plg'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .geekfolio-client .brands .item a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-client .brands .item a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'item_text_typography',
				'label'     => __('Typography', 'geekfolio_plg'),
				'selector'  => '{{WRAPPER}} .geekfolio-client .brands .item a',
			]
		);

		$this->add_responsive_control( 
			'item_height', 
			[
				'label' => __( 'Item Height', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'step' => 1,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-client .brands .item' => 'line-height: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control( 
			'item_size', 
			[
				'label' => __( 'Image Size', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'step' => 1,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-client .brands .item .img img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => __( 'Item Border', 'geekfolio_plg' ),
				'selector' => '{{WRAPPER}} .geekfolio-client .brands .item',
			]
		);

		$this->add_responsive_control(
			'Border_radius',
			[
				'label' => __('Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-client .brands .item' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .geekfolio-client .brands .item' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		
        <div class="geekfolio-client"> 
			<div class="brands">
				<div class="item wow fadeIn" data-wow-delay=".8s">
					<div class="img">
						<img class="img1" src="<?php echo esc_url ( $settings['image']['url']); ?>" alt="">
						<img class="img2" src="<?php echo esc_url ( $settings['image2']['url']); ?>" alt="">
						<a href="<?php echo esc_url( $settings['link']['url']); ?>" <?php if ( $settings['link']['is_external'] ) {echo'target="_blank"';} ?> class="link" data-splitting><?php echo wp_kses_post ( $settings['text']); ?></a>
					</div>
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


