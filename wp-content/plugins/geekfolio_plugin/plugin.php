<?php
namespace GeekfolioPlugin;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main Plugin Class
 *
 * Register new elementor widget. 
 *
 * @since 1.0.0
 */
class GeekfolioPlugin {

	/**
	 * Constructor 
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		$this->init();
		$this->add_actions();
		add_filter( 'elementor/icons_manager/additional_tabs',  [$this, 'additional_tabs'] );
		add_filter( 'elementor/icons_manager/additional_tabs',  [$this, 'peicon_tab']);
	}
	const VERSION = '1.0.0';




	// public $geekfolio_elements = array(
	// 	'heading',
	// 	'info-box'
	// );
	
     public function additional_tabs($tabs)
      {
        $json_url =GEEKFOLIO_URL.'assets/fonts/flaticon/flaticon.json';

        $flaticon = [
          'name'          => 'flaticon',
          'label'         => esc_html__( 'Geekfolio Icons', 'geekfolio_plg' ),
          'url'           => false,
          'enqueue'       => false,
          'prefix'        => '',
          'displayPrefix' => '',
          'labelIcon'     => 'fab fa-font-awesome-alt',
          'ver'           => '1.0.0',
          'fetchJson'     => $json_url,
        ];
        array_push( $tabs, $flaticon);


        return $tabs;
      }
     
     public function peicon_tab($petab)
      {
        $pe_json_url =GEEKFOLIO_URL.'assets/fonts/peicon/peicon.json';

        $peicon = [
          'name'          => 'peicon',
          'label'         => esc_html__( 'Pe Icons', 'geekfolio_plg' ),
          'url'           => false,
          'enqueue'       => false,
          'prefix'        => '',
          'displayPrefix' => '',
          'labelIcon'     => 'fab fa-font-awesome-alt',
          'ver'           => '1.0.0',
          'fetchJson'     => $pe_json_url,
        ];
        array_push( $petab, $peicon);


        return $petab;
      }

	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	public function add_actions() {

		//register all script 
		//add_action( 'elementor/widgets/widgets_registered',[ $this, 'on_widgets_registered' ] );
		add_action( 'elementor/widgets/register', [ $this, 'on_widgets_registered' ] );

		//blog masonry script 
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-blog-masonry',GEEKFOLIO_URL .'assets/js/blog-mason.js', array('jquery'), null, true  );} ); 

		//Swiper slider script
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('jquery-swiper',GEEKFOLIO_URL .'assets/js/swiper.min.js', array('jquery'), null, true  );} );
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-slider-script',GEEKFOLIO_URL .'assets/js/slider.js', array('jquery'), null, true  );} );

		//Animated headline
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('animated-headline',GEEKFOLIO_URL .'assets/js/animated.headline.js', array('jquery'), null, true  );} );
		
		//Splitting
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('splitting',GEEKFOLIO_URL .'assets/js/splitting.js', array('jquery'), null, true  );} );

		//WOW Animate
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('wow',GEEKFOLIO_URL .'assets/js/wow.min.js', array('jquery'), null, true  );} );

		//simpleParallax
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('simpleParallax',GEEKFOLIO_URL .'assets/js/simpleParallax.min.js', array('jquery'), null, true  );} );

		//demo-reveal
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-anime',GEEKFOLIO_URL .'assets/js/anime.min.js', array('jquery'), null, true  );} );
		
		//demo-reveal
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-showcase',GEEKFOLIO_URL .'assets/js/showcase.js', array('jquery'), null, true  );} );

		//demo-reveal
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('demo-reveal',GEEKFOLIO_URL .'assets/js/demo.js', array('jquery'), null, true  );} );

		//VideoButton 
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('fancy-box',GEEKFOLIO_URL .'assets/js/jquery.fancybox.js', array('jquery'), null, true  );} );

		//Video Popup 
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('lity',GEEKFOLIO_URL .'assets/js/lity.js', array('jquery'), null, true  );} );

		//Counter up
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('counterup',GEEKFOLIO_URL .'assets/js/jquery.counterup.js', array('jquery'), null, true  );} );

		//Countdown
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-countdown',GEEKFOLIO_URL .'assets/js/jquery.countdown.min.js', array('jquery'), null, true  );} );

		//isotope
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('jquery-isotope',GEEKFOLIO_URL .'assets/js/isotope.min.js', array('jquery'), null, true  );} );

		//jQuery UI
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-jquery-ui',GEEKFOLIO_URL .'assets/js/jquery-ui.min.js', array('jquery'), null, true  );} );

		//geekfolio price filter silder
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-products-filters',GEEKFOLIO_URL .'assets/js/products-filters.js', array('jquery'), null, true  );} );

		//geekfolio toggle tabs
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-toggle-tabs',GEEKFOLIO_URL .'assets/js/toggle-tabs.js', array('jquery'), null, true  );} );

		//geekfolio toggle tabs
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-search',GEEKFOLIO_URL .'assets/js/search.js', array('jquery'), null, true  );} );

		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('jquery-waypoints',GEEKFOLIO_URL .'assets/js/jquery.waypoints.min.js', array('jquery'), null, true  );} );
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-skills',GEEKFOLIO_URL .'assets/js/skills.js', array('jquery'), null, true  );} );
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-bootstrap-bundle',GEEKFOLIO_URL .'assets/js/bootstrap.bundle.min.js', array('jquery'), null, true  );} );
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-imgbox-slider',GEEKFOLIO_URL .'assets/js/imgbox-slider.js', array('jquery'), null, true  );} );
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-image-comparison-slider',GEEKFOLIO_URL .'assets/js/image-comparison-slider.js', array('jquery'), null, true  );} );
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-blog-slider-script',GEEKFOLIO_URL .'assets/js/blog-slider.js', array('jquery'), null, true  );} );
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('prefixfree',GEEKFOLIO_URL .'assets/js/prefixfree.min.js', array('jquery'), null, true  );} );
		//gallery popup 
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-gallery-popup',GEEKFOLIO_URL .'assets/js/popup-gallery.js', array('jquery'), null, true  );} );
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-blog-script',GEEKFOLIO_URL .'assets/js/blog-carousel.js', array('jquery'), null, true  );} ); 
		
		//Fixed Heading 
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-fixed-heading',GEEKFOLIO_URL .'assets/js/fixed-heading.js', array('jquery'), null, true  );} );

		//gallery  masonry
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-masonry-gallery',GEEKFOLIO_URL .'assets/js/mason-gallery.js', array('jquery'), null, true  );} );
		
		//hover Reveal
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-hover-reveal',GEEKFOLIO_URL .'assets/js/hover-reveal.js', array('jquery'), null, true  );} );

		//share script
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-share',GEEKFOLIO_URL .'assets/js/share.js', array('jquery'), null, true  );} );

		//Portfolio filter mixitup
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('portfolio-mixitup',GEEKFOLIO_URL .'assets/js/mixitup.min.js', array('jquery'), null, true  );} );

		//Info Box 
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-infobox',GEEKFOLIO_URL .'assets/js/info-box.js', array('jquery'), null, true  );} );

		//Image 
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-image',GEEKFOLIO_URL .'assets/js/image.js', array('jquery'), null, true  );} );
		
		//testmonial
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-testimonial',GEEKFOLIO_URL .'assets/js/testimonial.js', array('jquery'), null, true  );} );
		//Header search
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-header-search',GEEKFOLIO_URL .'assets/js/header-search.js', array('jquery'), null, true  );} );
		//Header Offcanvas
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-header-offcanvas',GEEKFOLIO_URL .'assets/js/header-offcanvas.js', array('jquery'), null, true  );} );

		//Header Offcanvas
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-tabs',GEEKFOLIO_URL .'assets/js/tabs.js', array('jquery'), null, true  );} );
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-portfolio-fixed',GEEKFOLIO_URL .'assets/js/portfolio-fixed.js', array('jquery'), null, true  );} );

		//Metro Scroll 
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-metro-scroll',GEEKFOLIO_URL .'assets/js/metro-scroll.js', array('jquery'), null, true  );} );

		//image parallax
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-image-parallax',GEEKFOLIO_URL .'assets/js/image-parallax.js', array('jquery'), null, true  );} );
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-parallax',GEEKFOLIO_URL .'assets/js/parallax.js', array('jquery'), null, true  );} );
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-icon-list',GEEKFOLIO_URL .'assets/js/icon-list.js', array('jquery'), null, true  );} );
		add_action( 'elementor/frontend/after_register_scripts', function() {  wp_register_script('geekfolio-menu',GEEKFOLIO_URL .'assets/js/menu.js', array('jquery'), null, true  );} );

		//Video Popup
		add_action( 'elementor/frontend/after_enqueue_styles', function() {  wp_enqueue_style('geekfolio-fancy-box-style',GEEKFOLIO_URL .'assets/css/jquery.fancybox.css', array(), null, 'all'  );} );
		add_action( 'elementor/frontend/after_enqueue_styles', function() {  wp_enqueue_style('lity',GEEKFOLIO_URL .'assets/css/lity.css', array(), null, 'all'  );} );
		
		// Styles
		add_action( 'elementor/frontend/after_enqueue_styles', function() {  wp_enqueue_style('geekfolio-style-addons',GEEKFOLIO_URL .'assets/fonts/flaticon/flaticon.css', array(), null, 'all'  );} );
		add_action( 'elementor/frontend/after_enqueue_styles', function() {  wp_enqueue_style('fontawesome-style-addons',GEEKFOLIO_URL .'assets/fonts/fa/css/fontawesome.min.css', array(), null, 'all'  );} );
		add_action( 'elementor/frontend/after_enqueue_styles', function() {  wp_enqueue_style('peicon-style-addons',GEEKFOLIO_URL .'assets/fonts/peicon/pe-icon-7-stroke.css', array(), null, 'all'  );} );
		add_action( 'elementor/frontend/after_enqueue_styles', function() {  wp_enqueue_style('bootstrap-icons',GEEKFOLIO_URL .'assets/fonts/bootstrap-icons/bootstrap-icons.css', array(), null, 'all'  );} );
		add_action( 'elementor/frontend/after_enqueue_styles', function() {  wp_enqueue_style('swiper-slider-style',GEEKFOLIO_URL .'assets/css/swiper.min.css', array(), null, 'all'  );} );
		
		// Icon fonts
		add_action( 'wp_enqueue_scripts', function() {wp_enqueue_style('linea_arrows', GEEKFOLIO_URL . '/assets/fonts/linea/arrows/css/style.css', array(), '', 'all');} );
		add_action( 'wp_enqueue_scripts', function() {wp_enqueue_style('linea_basic', GEEKFOLIO_URL . '/assets/fonts/linea/basic/css/style.css', array(), '', 'all');} );
		add_action( 'wp_enqueue_scripts', function() {wp_enqueue_style('linea_basic_2', GEEKFOLIO_URL . '/assets/fonts/linea/basic_ela/css/style.css', array(), '', 'all');} );
		add_action( 'wp_enqueue_scripts', function() {wp_enqueue_style('linea_ecommerce', GEEKFOLIO_URL . '/assets/fonts/linea/basic/css/style.css', array(), '', 'all');} );
		add_action( 'wp_enqueue_scripts', function() {wp_enqueue_style('linea_music', GEEKFOLIO_URL . '/assets/fonts/linea/basic/css/style.css', array(), '', 'all');} );
		add_action( 'wp_enqueue_scripts', function() {wp_enqueue_style('linea_software', GEEKFOLIO_URL . '/assets/fonts/linea/software/css/style.css', array(), '', 'all');} );
		add_action( 'wp_enqueue_scripts', function() {wp_enqueue_style('linea_weather', GEEKFOLIO_URL . '/assets/fonts/linea/weather/css/style.css', array(), '', 'all');} );


		// //Styles
		// add_action( 'elementor/frontend/after_enqueue_styles', function() {  wp_enqueue_style('geekfolio-frontend',GEEKFOLIO_URL .'assets/css/frontend.css', array(), null, 'all'  );} ); 
		
	}

	public function widget_scripts(){
		// custom-scripts
		wp_enqueue_script( 'geekfolio-parallax', GEEKFOLIO_URL.'assets/js/geekfolio-parallax.js', [ 'jquery' ], self::VERSION, true );
		wp_enqueue_script( 'geekfolio-parallax-slider', GEEKFOLIO_URL.'assets/js/slider-parallax.js', [ 'jquery' ], self::VERSION, true );
		wp_enqueue_script( 'geekfolio-scroll-trigger', GEEKFOLIO_URL.'assets/js/ScrollTrigger.min.js', [ 'jquery' ], self::VERSION, true );
		wp_enqueue_script( 'geekfolio-gsap', GEEKFOLIO_URL.'assets/js/gsap.min.js', [ 'jquery' ], self::VERSION, true );
		wp_enqueue_script( 'geekfolio-hscroll', GEEKFOLIO_URL.'assets/js/hscroll.js', [ 'jquery' ], self::VERSION, true );
		wp_enqueue_script( 'geekfolio-fixed-footer', GEEKFOLIO_URL.'assets/js/fixed-footer.js', [ 'jquery' ], self::VERSION, true );
        wp_enqueue_script( 'geekfolio-addons-custom-scripts', GEEKFOLIO_URL.'assets/front/js/custom-scripts.js', [ 'jquery' ], self::VERSION, true );
	}
	public function init(){
		// Register Widget Scripts
        add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'widget_scripts' ] );

	}

	/**
	 * On Widgets Registered
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function on_widgets_registered() {
		$this->includes();
		$this->register_widget();
	}

	/**
	 * List of elements
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function widgets() {
		$widgets_path    = dirname( __FILE__ ) . '/widgets/';
		$geekfolio_widgets = array_diff(scandir($widgets_path), array('.', '..'));
		return $geekfolio_widgets;
	}

	/**
	 * Includes
	 *
	 * @since 1.0.0 
	 *
	 * @access private
	 */
	private function includes() {
		foreach ( $this->widgets() as $widget_name ) {
			require_once( __DIR__ . '/widgets/'.$widget_name.'/'.$widget_name.'.php' );
		}
	}
	

	/**
	 * Register Widget
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function register_widget() {
		// Register Widgets
		foreach ( $this->widgets() as $widget_name ) {
			$widget_name__ = str_replace( '-', '_', $widget_name );
				$class_name= str_replace( '_', ' ', $widget_name__ );
				$class_name	 =ucwords(strtolower($class_name));
				$class_name= str_replace( ' ', '_', $class_name );
				$class_name='GeekfolioPlugin\Widgets\Geekfolio_'.$class_name;
				//\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $class_name());
				\Elementor\Plugin::instance()->widgets_manager->register( new $class_name() );
		}
	}
}

new GeekfolioPlugin();



