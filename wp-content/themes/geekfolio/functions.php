<?php 
/**
 * Geekfolio theme functions and definitions
 */

add_action( 'after_setup_theme', 'geekfolio_theme_setup' );
function geekfolio_theme_setup() {

	/* 
	* Add filters, actions, and theme-supported features.
	*/
	// Custom Post Type Supports
	add_theme_support( 'portfolio' );

	//add thumbnail
	add_theme_support( 'post-thumbnails' );

	//custom background
	add_theme_support( 'custom-background' );

	//Support Html5  
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );

	//Let WordPress manage the document title
	add_theme_support( 'title-tag' );

	//automatic feed
	add_theme_support( 'automatic-feed-links' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Wide Alignment.
	add_theme_support( 'align-wide' );

	// Enqueue editor styles.
	add_editor_style( 'css/style-editor.css' ); 

	// Enqueue editor font sizes.
	add_theme_support('disable-custom-font-sizes');

	// Responsive embeds.
	add_theme_support('responsive-embeds');

	//add menu homepage,portfolio and blog
	add_action( 'init', 'geekfolio_register_menu' );
  
	// Set the theme's text domain using the unique identifier from above
	load_theme_textdomain('geekfolio', get_template_directory() . '/lang');
  
	//width content
	if ( ! isset( $content_width ) )$content_width = 1170;
  
	//theme default script.
	add_action('wp_enqueue_scripts', 'geekfolio_theme_scripts');

	//theme default styles.
	add_action('wp_enqueue_scripts', 'geekfolio_theme_styles');
  
	//register sidebar
	add_action( 'widgets_init', 'geekfolio_sidebar' );
  
	/*
	* custom filters
	*/
	//custom search setting
	add_filter( 'get_search_form', 'geekfolio_search_form' );

	//custom excerpt
	add_filter( 'excerpt_length', 'geekfolio_excerpt_length', 10 );

	//remove [..] in excerpt
	add_filter('get_the_excerpt', 'geekfolio_trim_excerpt');

	//custom comment styles
	add_filter('comment_form_default_fields','geekfolio_modify_comment_form_fields');

	//tag cloud filter
	add_filter('wp_generate_tag_cloud', 'geekfolio_tag_cloud',10,1);

	//preloader styles.
	add_action( 'wp_enqueue_scripts', 'geekfolio_preloader_set' );

	//preloader script.
	add_action( 'wp_enqueue_scripts', 'geekfolio_preloader' );

	//next post link.
	add_filter('next_post_link', function($link) {
		$next_post = get_next_post();
		$title = esc_attr( $next_post->post_title);
		$link = str_replace('href=', 'title="'.esc_attr($title).'" href=', $link);
		return $link;
	});
  
	//previous post link.
	add_filter('previous_post_link', function($link) {
		$previous_post = get_previous_post();
		$title = esc_attr($previous_post->post_title);
		$link = str_replace('href=', 'title="'.esc_attr($title).'" href=', $link);
		return $link;
	});
  
	//color_schecmes script
	add_action( 'wp_enqueue_scripts', 'geekfolio_color_scheme',99 );

	//geekfolio custom css
	add_action( 'wp_enqueue_scripts', 'geekfolio_custom_css',99 );

	//custom header
	add_action('geekfolio-custom-header','geekfolio_header_start') ;

	//create custom header
	add_action('geekfolio-header-page','geekfolio_custom_header_page') ;

	//custom header option
	add_action('geekfolio-header-global','geekfolio_custom_header_global') ;
  
	//custom footer
	add_action('geekfolio-custom-footer','geekfolio_footer_start') ;

	//custom side panel
	add_action('geekfolio-custom-sidepanel','geekfolio_sidepanel_start') ;
  
	//add image size
	add_image_size( 'geekfolio-related-post', 500, 300, array( 'center', 'center' ) );
	//add image gallery size
	add_image_size( 'geekfolio-gallery', 63, 63, array( 'center', 'center' ) );
  
	//comment reply
	add_action(  'wp_enqueue_scripts', 'geekfolio_enqueue_comments_reply' );
  
	//color_schecmes script
	add_action( 'wp_enqueue_scripts', 'geekfolio_color_scheme' );


		//Woocommerce
		add_theme_support( 'woocommerce', array(
			'thumbnail_image_width' => 300,
			'gallery_thumbnail_image_width' => 250,
			'single_image_width'    => 800,
	
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 2,
				'max_rows'        => 8,
				'default_columns' => 4,
				'min_columns'     => 2,
				'max_columns'     => 5,
			),
		) );
	
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function geekfolio_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'geekfolio_pingback_header' );

/**
 * Ensure cart contents update when products are added to the cart via AJAX
 */
function geekfolio_add_to_cart_fragment( $fragments ) {
 
    ob_start();
    $count = WC()->cart->cart_contents_count;
    ?><a class="cart-contents 3" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php esc_attr__( 'View your shopping cart','geekfolio' ); ?>"><?php

        ?>
        <span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
        <?php            

        ?></a><?php
 
    $fragments['a.cart-contents'] = ob_get_clean();
     
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'geekfolio_add_to_cart_fragment' );


//tag cloud filter
function geekfolio_tag_cloud($input){
 	return preg_replace('/ style=("|\')(.*?)("|\')/','',$input);
}

//add menu for all page 

function geekfolio_register_menu() {
	register_nav_menus( [
				'primary_menu' => esc_html__('All pages menu', 'geekfolio')
			] ); 
}

//add meta options
if ( ! function_exists( 'geekfolio_option' ) ) :
	function geekfolio_option( $geekfolio_option, $def_value='' ) {
		global $geekfolio_theme_settings, $post;
		$defval = '' != $def_value ? $def_value : false;
		$geekfolio_single = false;
		if(is_singular()){
			$geekfolio_value = get_post_meta( $post->ID, $geekfolio_option, true); 
			$geekfolio_single = true;
		}

		if($geekfolio_single == true){
			if (is_string($geekfolio_value) && (strlen($geekfolio_value) > 0 || is_array($geekfolio_value)) && $geekfolio_value != 'default') {
				return $geekfolio_value;
			}
		}

		if(class_exists('Redux') && isset($geekfolio_theme_settings[$geekfolio_option]) && $geekfolio_theme_settings[$geekfolio_option] != ''){
			$geekfolio_option_value = $geekfolio_theme_settings[$geekfolio_option];
			return $geekfolio_option_value;
		}else{
			return $defval;
		}

		return false;
	}
endif;

// Add specific CSS class to body by filter. 
 
add_filter( 'body_class', function( $classes ) {
	$geekfolio_mode='';
	if (geekfolio_option( 'geekfolio_theme_mode')=='dark_mode'){$geekfolio_mode='geekfolio-dark-mode';
	}elseif(geekfolio_option( 'geekfolio_theme_mode')=='auto_mode'){$geekfolio_mode='geekfolio-auto-mode';}
    return array_merge( $classes, array( $geekfolio_mode ) );
} );

//custom excerpt function
function geekfolio_excerpt_length( $length ) {
	return 60;
}

// Remove [...]
function geekfolio_trim_excerpt($text) {
	$text = str_replace('[', '', $text);
	$text = str_replace(']', '', $text);
	return $text;
}

//adding sidebar widget
function geekfolio_sidebar() {
	register_sidebar(
		array(
			'name' => esc_html__('Main Sidebar', 'geekfolio' ),
			'id' => 'main-sidebar',
			'description' => esc_html__('Appears as the sidebar on blog and pages', 'geekfolio' ),
			'before_widget' => '<div  id="%1$s" class="widget %2$s clearfix">','after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3> <div class="widget-border"></div>',
		)
	);
}

//add span to category
add_filter('wp_list_categories', 'geekfolio_cat_count');
function geekfolio_cat_count($links) {
	$links = str_replace('</a> (', '</a> <span>', $links);
	$links = str_replace(')', '</span>', $links);
	return $links;
}

add_filter('get_archives_link', 'geekfolio_arch_count');
function geekfolio_arch_count($links) {
	$links = str_replace('</a>&nbsp;(', '</a> <span>', $links);
	$links = str_replace(')</li>', '</span></li>', $links);
	return $links;
}

/* Replacing the default WordPress search form with an HTML5 version */   

function geekfolio_search_form( $form ) {
	$geekfolio_unique_id = geekfolio_unique_id( 'search-form-' );
	$form = '<form role="search" method="get" id="'.esc_attr( $geekfolio_unique_id ).'" class="searchform" action="' . esc_url( home_url( '/' ) ) . '" > 
	<input type="search" placeholder="'.esc_attr__('Type keyword here','geekfolio').'" value="' . get_search_query() . '" name="s" />
	<input type="submit" class="searchsubmit" />
	</form>';
	return $form;
}

//related post
function geekfolio_related_post( $post_id, $related_count, $args = array() ) {
	$args = wp_parse_args( (array) $args, array(
		'orderby' => 'rand',
		'return'  => 'query',
	) );

	$related_args = array(
	'post_type'      => get_post_type( $post_id ),
	'posts_per_page' => $related_count,
	'post_status'    => 'publish',
	'post__not_in'   => array( $post_id ),
	'orderby'        => $args['orderby'],
	'tax_query'      => array()
	);

	$post = get_post( $post_id );
	$taxonomies = get_object_taxonomies( $post, 'names' );

	foreach( $taxonomies as $taxonomy ) {
		$terms = get_the_terms( $post_id, $taxonomy );
		if ( empty( $terms ) ) continue;
		$term_list = wp_list_pluck( $terms, 'slug' );
		$related_args['tax_query'][] = array(
			'taxonomy' => $taxonomy,
			'field'    => 'slug',
			'terms'    => $term_list
		);
	}

	if( count( $related_args['tax_query'] ) > 1 ) {
		$related_args['tax_query']['relation'] = 'OR';
	}

	if( $args['return'] == 'query' ) {
		return new WP_Query( $related_args );
	} else {
		return $related_args;
	}
}

//custom comment form
function geekfolio_modify_comment_form_fields($fields){
	$req = get_option('require_name_email');
	$commenter = wp_get_current_commenter();
	$aria_req = ( $req ? " aria-required='true'" : '' ); 
	$fields['author'] = '<p class="comment-form-author">' . ( $req ? '' : '' ) . '<input id="author" name="author" type="text" placeholder="'. esc_attr__('Your Name ...','geekfolio').'" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
	$fields['email'] = '<p class="comment-form-email">' . ( $req ? '' : '' ) . '<input id="email" name="email" type="text" placeholder="'. esc_attr__('Your Email ...','geekfolio') .'"  value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';
	$fields['url'] = '<p class="comment-form-url">'. '<input id="url" name="url" type="text" placeholder="'. esc_attr__('Your Website ...','geekfolio').'" value="' . esc_url( $commenter['comment_author_url'] ) . '" size="30" /></p>';
	return $fields;
}

//comment reply script
function geekfolio_enqueue_comments_reply() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

//Get unique ID. 
function geekfolio_unique_id( $prefix = '' ) {
	static $id_counter = 0;
	if ( function_exists( 'wp_unique_id' ) ) {
		return wp_unique_id( $prefix );
	}
	return $prefix . (string) ++$id_counter;
}


/* Function which displays your post date in time ago format */
function geekfolio_time_ago() {
	return human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ).' '.__( 'ago', 'geekfolio');
}

/* Function to display menu description */
function geekfolio_nav_description( $item_output, $item, $depth, $args ) {
    if ( !empty( $item->description ) ) {
        $item_output = str_replace( $args->link_after . '</a>', '<p class="menu-item-desc">' . $item->description . '</p>' . $args->link_after . '</a>', $item_output );
    }
    return $item_output;
}


add_filter( 'walker_nav_menu_start_el', 'geekfolio_nav_description', 10, 4 );


// Itack single product page body class
function geekfolio_single_product_woocommerce_body_class( $classes ) {

	if(in_array('woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) )  )):
		// NOT single product page, so return
		if ( ! is_product() ) return $classes;
		
		// Add new class
		$classes[] = 'geekfolio-single-product';

	endif;

	return $classes;
}
add_filter( 'body_class', 'geekfolio_single_product_woocommerce_body_class', 10, 2 );



/** Custom Font upload for global & Elementor **/


//Add new font group (Custom) to the top of the Elementor font list

add_filter('elementor/fonts/groups', function($font_groups) {
    $new_font_group = array('custom' => __('Custom', 'geekfolio'));
    return array_merge($new_font_group, $font_groups);
});


 // Add fonts to the new font group
 add_filter('elementor/fonts/additional_fonts', function($additional_fonts) {

    global $geekfolio_theme_settings;

    if (isset($geekfolio_theme_settings['custom_fonts_typography']) && is_array($geekfolio_theme_settings['custom_fonts_typography'])) {

        $custom_fonts = $geekfolio_theme_settings['custom_fonts_typography'];

        foreach ($custom_fonts as $font) {
            if (isset($font['font-family']) && is_string($font['font-family'])) {
                $additional_fonts[$font['font-family']] = 'custom';
            }
        }
    }

    return $additional_fonts;
});



/*
* Theme scripts & Styles
*/
//include theme style
include( get_template_directory().'/inc/theme-style.php' );

//include theme script
include( get_template_directory().'/inc/theme-script.php');

//include color schemes 
include( get_template_directory().'/inc/class/theme-helper.php');

//included preloader setting
include( get_template_directory().'/inc/preloader.php');

//include color schemes 
include( get_template_directory().'/inc/color-schemes.php');

//include custom style 
include( get_template_directory().'/inc/custom-style.php');

//include comment template
include( get_template_directory().'/inc/comment-template.php');

//include custom header
include( get_template_directory().'/inc/custom-header.php');

//include custom footer
include( get_template_directory().'/inc/custom-footer.php');

//include custom side panel
include( get_template_directory().'/inc/custom-sidepanel.php');

//Count view
include( get_template_directory().'/inc/count-view.php');

//pagination
include( get_template_directory().'/inc/pagination.php');

//include TGM activation
include( get_template_directory().'/inc/plugin-install.php');

//include options admin
include_once( get_template_directory().'/inc/option-init.php');



