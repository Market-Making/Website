<?php
/**
 * Header Tab For Theme Option.
 *
 * @package geekfolio
 */

// Font options for family. size and fully typography.

if ( ! function_exists( 'geekfolio_enqueue_fonts_url' ) ) :

function geekfolio_enqueue_fonts_url() {
    $geekfolio_fonts_url = '';
    $geekfolio_fonts     = array();
    $geekfolio_main_font_weight = array();
    $geekfolio_alt_font_weight = array();
    $geekfolio_font_subsets = array();
    global $geekfolio_theme_settings;
    
    /* For Main Font Weight */
    $geekfolio_main_font_weight_array = ( isset( $geekfolio_theme_settings['main_font_weight'] ) ) ? $geekfolio_theme_settings['main_font_weight'] : '';
    if( !empty( $geekfolio_main_font_weight_array ) ) {
        foreach ($geekfolio_main_font_weight_array as $key => $value) {
            if( $value == 1 ){
                $geekfolio_main_font_weight[] = $key;
            }
        }
    }

    if( !empty( $geekfolio_main_font_weight ) ) {
        $geekfolio_main_font_weight = implode( ',', $geekfolio_main_font_weight );
    } else {
        $geekfolio_main_font_weight = '100,300,400,500,700,900';
    }

    if( geekfolio_option('main_font')){ 
        $geekfolio_fonts[] = $geekfolio_theme_settings['main_font']['font-family'].':'.$geekfolio_main_font_weight;
    }

    /* For Alt Font Weight */
    $geekfolio_alt_font_weight_array = ( isset( $geekfolio_theme_settings['alt_font_weight'] ) ) ? $geekfolio_theme_settings['alt_font_weight'] : '';
    if( !empty( $geekfolio_alt_font_weight_array ) ) {
        foreach ($geekfolio_alt_font_weight_array as $key => $value) {
            if( $value == 1 ){
                $geekfolio_alt_font_weight[] = $key;
            }
        }
    }

    if( !empty( $geekfolio_alt_font_weight ) ) {
        $geekfolio_alt_font_weight = implode( ',', $geekfolio_alt_font_weight );
    } else {
        $geekfolio_alt_font_weight = '100,200,300,400,500,600,700,800,900';
    }
    if( geekfolio_option('alt_font')){
        $geekfolio_fonts[] = $geekfolio_theme_settings['alt_font']['font-family'].':'.$geekfolio_alt_font_weight;
    }else{
        $geekfolio_fonts[] = 'Asap:100,200,300,400,500,600,700,800,900';
    }

    /* For Font Subsets */
    $geekfolio_main_font_subsets = ( isset( $geekfolio_theme_settings['main_font_languages'] ) ) ? $geekfolio_theme_settings['main_font_languages'] : '' ;
    if( !empty( $geekfolio_main_font_subsets ) ) {
        foreach ($geekfolio_main_font_subsets as $key => $value) {
            if( $value == 1 ){
                $geekfolio_font_subsets[] = $key;
            }
        }
    }
    if( !empty( $geekfolio_font_subsets ) ) {
        $geekfolio_main_font_subsets = implode( ',',  $geekfolio_font_subsets );
    } else {
        $geekfolio_main_font_subsets = '';
    }

    if ( $geekfolio_fonts ) {
        $geekfolio_fonts_url = add_query_arg( array(
            'family' => urlencode( implode( '|', $geekfolio_fonts ) ),
            'subset' => urlencode( $geekfolio_main_font_subsets ),
        ), '//fonts.googleapis.com/css' );
    }
    return $geekfolio_fonts_url;
}
endif;

if ( ! function_exists( 'geekfolio_font_scripts' ) ) :
    function geekfolio_font_scripts() {
        $disable_google_fonts = geekfolio_option( 'disable_google_fonts' );
        if( $disable_google_fonts != 1 ) {
            wp_enqueue_style( 'geekfolio-fonts', geekfolio_enqueue_fonts_url(), array(), null );
        }
    }
endif;
add_action( 'wp_enqueue_scripts', 'geekfolio_font_scripts' );

?>