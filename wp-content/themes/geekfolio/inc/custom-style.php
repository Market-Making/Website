<?php


function geekfolio_custom_css() {

    /* CSS to output */
    $custom_css = '';
    if ( class_exists( 'ReduxFrameworkPlugin' ) && geekfolio_option( 'geekfolio_cursor_set' ) == '1') {
    	$custom_css = "body {cursor: none!important;}"; 
    }
    wp_add_inline_style('geekfolio-style', $custom_css);
}
