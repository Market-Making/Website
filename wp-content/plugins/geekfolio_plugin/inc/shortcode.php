<?php
namespace Elementor;

function geekfolio_insert_elementor($atts){
    if(!class_exists('Elementor\Plugin')){
        return '';
    }
    if(!isset($atts['id']) || empty($atts['id'])){
        return '';
    }

    $post_id = $atts['id'];
    $response = Plugin::instance()->frontend->get_builder_content_for_display($post_id);
    return $response;
}
add_shortcode('INSERT_ELEMENTOR','Elementor\geekfolio_insert_elementor');


function geekfolio_enable_elementor(){
    add_post_type_support( 'geekfolio_global_templates', 'elementor' );
}
add_action('elementor/init','Elementor\geekfolio_enable_elementor');


function print_geekfolio_data($sections){
    foreach ( $sections as $section_data ) {
        $section = new Element_Section( $section_data );

        $section->print_element();
    }
}
/**
 *  Enable the use of shortcodes in text widgets.
 */
add_filter( 'widget_text', 'do_shortcode' );

