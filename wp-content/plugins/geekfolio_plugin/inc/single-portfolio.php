<?php
// single portfolio script
function geekfolio_single_portfolio_script() {
	global $post;
	if ( is_singular( 'portfolio' ) ) {
		wp_enqueue_script('jquery-isotope',GEEKFOLIO_URL .'assets/js/isotope.pkgd.js', array('jquery'), null, true  );
        wp_enqueue_script('imgbg-script',GEEKFOLIO_URL . 'assets/js/imgbg.js' , array('jquery'), null, true );
		wp_enqueue_script('single-portfolio',GEEKFOLIO_URL . 'assets/js/single-portfolio.js' , array('jquery'), null, true );
		wp_enqueue_script('slider-script',GEEKFOLIO_URL . 'assets/js/slider.js' , array('jquery'), null, true );
		if (get_post_meta($post->ID, 'port_format', true) == 'port_two' && get_post_meta($post->ID, 'top_type', true) == 'top_content_slider' ){
			wp_enqueue_script('sliderbg-script',GEEKFOLIO_URL . 'assets/js/sliderbg.js' , array('jquery'), null, true );
		}
		if (get_post_meta($post->ID, 'port_format', true) == 'port_two' && get_post_meta($post->ID, 'top_type', true) == 'top_content_youtube' ){
			wp_enqueue_script( 'geekfolio_ytPlayer', GEEKFOLIO_URL . 'assets/js/jquery.mb.YTPlayer.js' ,array(),'', 'in_footer');
			wp_enqueue_script( 'geekfolio_homeyt', GEEKFOLIO_URL . 'assets/js/homeyt.js' ,array(),'', 'in_footer');
		}
		if (get_post_meta($post->ID, 'port_format', true) == 'port_two' && get_post_meta($post->ID, 'top_type', true) == 'top_content_video' ){
			wp_enqueue_script('jquery-videojs',GEEKFOLIO_URL . 'assets/js/video.js' , array('jquery'), null, true );
			wp_enqueue_script('jquery-big-video',GEEKFOLIO_URL . 'assets/js/bigvideo.js' , array('jquery'), null, true );
			wp_enqueue_script('geekfolio-single-portfolio-video',GEEKFOLIO_URL . 'assets/js/singleport-video.js' , array('jquery'), null, true );
		}
		
    }

}

add_action( 'wp_enqueue_scripts', 'geekfolio_single_portfolio_script',100 );



