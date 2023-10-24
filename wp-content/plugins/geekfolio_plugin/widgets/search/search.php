<?php
namespace GeekfolioPlugin\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
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
class Geekfolio_Search extends Widget_Base {

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
	public function get_name() {
		return 'geekfolio-search';
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
	public function get_title() {
		return esc_html__( 'geekfolio Search', 'geekfolio_plg' );
	}

    //script depend
    public function get_script_depends()
    {
        return ['geekfolio-search'];
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
	public function get_icon() {
		return 'eicon-search';
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
	public function get_categories() {
		return [ 'geekfolio-menu-elements' ];
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
	public function get_keywords() {
		return [ 'search', 'icon', 'link' ];
	}

	/**
	 * Register icon widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.1.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Icon', 'geekfolio_plg' ),
			]
		);

		$this->add_control(
			'search_style',
			[
				'label'   => __('Search Form Style', 'geekfolio_plg'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'icon' =>  __('Icon', 'geekfolio_plg'),
					'field' => __('Field', 'geekfolio_plg'),
				],
				'default' => 'icon',
			]
		);

		$this->add_control(
			'search_icon_style',
			[
				'label'   => __('Search Icon Style', 'geekfolio_plg'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'popup' =>  __('Pop Up', 'geekfolio_plg'),
					'box' => __('Box', 'geekfolio_plg'),
				],
				'default' => 'popup',
			]
		);

		$this->add_control(
			'image_icon',
			[
				'label' => __( 'Media Type', 'geekfolio_plg' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'icon' => [
						'title' => __( 'Icon', 'geekfolio_plg' ),
						'icon' => 'fa fa-smile-o',
					],
					'image' => [
						'title' => __( 'Image', 'geekfolio_plg' ),
						'icon' => 'fa fa-image',
					],

				],
				'default' => 'icon',
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label' => esc_html__( 'Icon', 'geekfolio_plg' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-search',
					'library' => 'fa-solid',
				],
				'condition'	=> [
					'image_icon'	=> 'icon'
				]
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'geekfolio_plg' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition'	=> [
					'image_icon' => 'image'
				]
			]
		);

		$this->add_control(
			'icon_position',
			[
				'label' => esc_html__( 'Icon Position', 'geekfolio_plg' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'geekfolio_plg' ),
						'icon' => 'eicon-text-align-left',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'geekfolio_plg' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'search_style' => [
					'search_style' => 'field'
				]
			]
		);

		$this->add_control(
			'place_holder_text',
			[
				'label' => __('Place Holder Text', 'geekfolio_plg'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Type search keyword...', 'geekfolio_plg'),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'icon_style',
			[
				'label' => __( 'Style Setting','geekfolio_plg' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-search-icon .search-icon-header a i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-search-icon .search-icon-header a svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-search-field .searchform .searchsubmit svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-search-field .searchform .searchsubmit i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_container_size',
			[
				'label' => esc_html__( 'Icon Container Size', 'geekfolio_plg' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-search-icon .search-icon-header a' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}; display: block;',
					'{{WRAPPER}} .geekfolio-search-field .searchform .searchsubmit' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->start_controls_tabs('icon_tabs');
        $this->start_controls_tab(
            'icon_normal_tab',
            [
                'label' => __('Normal', 'geekfolio_plg')
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'label' => esc_html__( 'Icon Border', 'geekfolio_plg' ),
				'selector' => '{{WRAPPER}} .geekfolio-search-icon .search-icon-header a, {{WRAPPER}} .geekfolio-search-field .searchform .searchsubmit',
			]
		);

		$this->add_responsive_control(
			'item_border_radius',
			[
				'label' => __('Icon Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-search-icon .search-icon-header a' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-search-field .searchform .searchsubmit' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_padding',
			[
				'label' => __('Icon Padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-search-icon .search-icon-header a' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-search-field .searchform .searchsubmit' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-search-icon .search-icon-header a.search i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-search-icon .search-icon-header a svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_bg',
			[
				'label' => esc_html__( 'Background', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-search-icon .search-icon-header a' => 'background: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-search-field .searchform .searchsubmit' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

        $this->start_controls_tab(
            'icon_hover_tab',
            [
                'label' => __('Hover', 'geekfolio_plg')
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border_hover',
				'label' => esc_html__( 'Icon Border', 'geekfolio_plg' ),
				'selector' => '{{WRAPPER}} .geekfolio-search-icon .search-icon-header a:hover, {{WRAPPER}} .geekfolio-search-field .searchform .searchsubmit:hover',
			]
		);

		$this->add_responsive_control(
			'item_border_radius_hover',
			[
				'label' => __('Icon Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-search-icon .search-icon-header a:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .geekfolio-search-field .searchform .searchsubmit:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label' => esc_html__( 'Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-search-icon .search-icon-header a:hover i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-search-icon .search-icon-header a:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_bg_hover',
			[
				'label' => esc_html__( 'Background', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-search-icon .search-icon-header a:hover' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'show_separator',
			[
				'label'         => __( 'Show separator', 'geekfolio_plg' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => __( 'Yes', 'geekfolio_plg' ),
				'label_off'     => __( 'No', 'geekfolio_plg' ),
				'return_value'  => 'yes',
				'default'  		=> 'yes',
			]
		);

		$this->add_control(
			'separator_color',
			[
				'label' => esc_html__( 'Separator Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-search-icon .search-icon-header a.search:after' => 'background: {{VALUE}};',
					'{{WRAPPER}} .custom-absolute-menu .search-icon-header a.search:after' => 'background: {{VALUE}};',
				],
				'condition' => [
					'show_separator' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'field_style',
			[
				'label' => __( 'Field Setting','geekfolio_plg' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'field_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-search-field .searchform .searchsubmit svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .geekfolio-search-field .searchform .searchsubmit' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'field_text',
			[
				'label' => esc_html__( 'Text Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-search-field .searchform input' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'field_text_placeholder',
			[
				'label' => esc_html__( 'Placeholder Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-search-field .searchform input::placeholder' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'field_text_typography',
                'selector' => '{{WRAPPER}} .geekfolio-search-field .searchform input',
            ]
        );

		$this->add_control(
			'field_bg',
			[
				'label' => esc_html__( 'Background Color', 'geekfolio_plg' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .geekfolio-search-field .searchform' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'field_padding',
			[
				'label' => __('padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-search-field .searchform' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'field_input_padding',
			[
				'label' => __(' Input padding', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-search-field .searchform input' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'field_border',
				'label' => esc_html__( 'Border', 'geekfolio_plg' ),
				'selector' => '{{WRAPPER}} .geekfolio-search-field .searchform',
			]
		);

		$this->add_responsive_control(
			'field_border_radius',
			[
				'label' => __('Border Radius', 'geekfolio_plg'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .geekfolio-search-field .searchform' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render icon widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();?>
		<?php if($settings['search_style'] == 'icon'): ?>
			<div class="geekfolio-search-icon">
				<div class="search-icon-header" > <!-- hidden-xs hidden-sm -->
					<a class="search <?php if($settings['show_separator'] != 'yes') echo 'hide'; ?>"  href="#">
						<?php if($settings['image_icon'] == 'icon'):
							\Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true', 'class' => 'features-icon' ] );
						else:
							echo '<img class="icon" src="'. esc_url($settings['image']['url']) .'" ></img>';
						endif; ?>
					</a>
					<?php if($settings['search_icon_style'] == 'box'): ?>
						<div class="nav-search-box">
							<?php $geekfolio_unique_id = geekfolio_unique_id( 'search-form-' ); ?>
							<form role="search" method="get" id="<?php echo esc_attr( $geekfolio_unique_id ); ?>" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<input type="search" class="focus-input" placeholder="<?php echo esc_attr__($settings['place_holder_text'],'geekfolio'); ?>" value="<?php get_search_query()?>" name="s">
								<button type="submit" class="searchsubmit" value=""><i class="la la-search"></i></button>
							</form>
						</div>
					<?php else: ?>
					<div class="black-search-block">
						<div class="black-search-table">
							<div class="black-search-table-cell">
								<div>
									<?php $geekfolio_unique_id = geekfolio_unique_id( 'search-form-' ); ?>
									<form role="search" method="get" id="<?php echo esc_attr( $geekfolio_unique_id ); ?>" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
										<input type="search" class="focus-input" placeholder="<?php echo esc_attr__($settings['place_holder_text'],'geekfolio'); ?>" value="<?php get_search_query()?>" name="s">
										<input type="submit" class="searchsubmit" value="">
									</form>
								</div>
							</div>
						</div>
						<div class="close-black-block"><a href="#"><i class="fa fa-times"></i></a></div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		<?php else: ?>
			<div class="geekfolio-search-field">
				<?php $geekfolio_unique_id = geekfolio_unique_id( 'search-form-' ); ?>
				<form role="search" method="get" id="<?php echo esc_attr( $geekfolio_unique_id ); ?>" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php if($settings['icon_position'] == 'left'): ?>	
						<button type="submit" class="searchsubmit">
							<?php if($settings['image_icon'] == 'icon'):
								\Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true', 'class' => 'features-icon' ] );
							else:
								echo '<img class="icon" src="'. esc_url($settings['image']['url']) .'" ></img>';
							endif; ?>
						</button>
					<?php endif; ?>
					<input type="search" placeholder="<?php echo esc_attr__($settings['place_holder_text'],'geekfolio'); ?>" value="<?php get_search_query()?>" name="s">
					<?php if($settings['icon_position'] == 'right'): ?>	
						<button type="submit" class="searchsubmit right">
							<?php if($settings['image_icon'] == 'icon'):
								\Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true', 'class' => 'features-icon' ] );
							else:
								echo '<img class="icon" src="'. esc_url($settings['image']['url']) .'" ></img>';
							endif; ?>
						</button>
					<?php endif; ?>
				</form>
			</div>
		<?php endif; ?>
	<?php
	}

	/**
	 * Render icon widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */
	protected function content_template() {}
}
