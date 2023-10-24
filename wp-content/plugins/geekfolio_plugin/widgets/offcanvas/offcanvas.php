<?php
namespace GeekfolioPlugin\Widgets;

use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


		
/**
 * @since 1.0.0
 */
class Geekfolio_Offcanvas extends Widget_Base {

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
		return 'geekfolio-offcanvas';
	}
		//script depend
	public function get_script_depends() { return [ 'geekfolio-header-offcanvas' ]; }

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
		return __( 'Geekfolio Offcanvas', 'geekfolio_plg' );
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
		return 'eicon-apps';
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
				'label' => __( 'Settings','geekfolio_plg' ),
			]
		);
        
        $this->add_control(
            'open_text',
            [
                'label' => __('Pop Up Open Text', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Menu',
            ]
        );
        
        $this->add_control(
            'close_text',
            [
                'label' => __('Close Text', 'geekfolio_plg'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Close',
            ]
        );
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'open_style_settings',
			[
				'label' => __( 'Open Style Setting','geekfolio_plg' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'open_text_typography',
				'selector' => '{{WRAPPER}} .geekfolio-offcanvas .text',
			]
		);

		$this->add_control(
			'open_text_color',
			[
				'label' => esc_html__( 'Open Text Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-offcanvas .text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-offcanvas .icon i' => 'background: {{VALUE}};',
				],
			]
		);

        $this->end_controls_section();
		
		$this->start_controls_section(
			'close_style_settings',
			[
				'label' => __( 'Close Style Setting','geekfolio_plg' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'close_text_typography',
				'selector' => '{{WRAPPER}} .geekfolio-offcanvas.open .text',
			]
		);

		$this->add_control(
			'close_text_color',
			[
				'label' => esc_html__( 'Close Text Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-offcanvas.open .text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-offcanvas.open .icon i' => 'background: {{VALUE}};',
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
		$this->add_inline_editing_attributes( 'title' );
		$this->add_inline_editing_attributes( 'text' );
		?>

		<div class="geekfolio-offcanvas">
			<div class="menu-icon bars offcanvas-btn">
				<span class="icon">
                    <i></i>
                    <i></i>
                </span>
                <span data-close-text="<?php echo esc_html($settings['close_text']) ?>" class="text"><span class="word"><?php echo esc_html($settings['open_text']) ?></span></span>
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


