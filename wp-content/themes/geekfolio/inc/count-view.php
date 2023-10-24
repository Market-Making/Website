<?php
function geekfolio_get_post_view($slug="") {
    $count = get_post_meta( get_the_ID(), 'post_views_count', true );
    if(empty($slug)){
        if($count==""){return esc_html("0");}
        else{ return esc_html("$count");}
    }else{
        if($count==""){return esc_html__("0 Views", 'geekfolio');}
        elseif($count==1){return esc_html("$count View");}
        else{ return esc_html("$count Views");}
    }

}
function geekfolio_set_post_view() {
    $key = 'post_views_count';
    $post_id = get_the_ID();
    $count = (int) get_post_meta( $post_id, $key, true );
    $count++;
    update_post_meta( $post_id, $key, $count );
}

function geekfolio_posts_column_views( $columns ) {
    $columns['post_views'] = 'Views';
    return $columns;
}
function geekfolio_posts_custom_column_views( $column ) {
    if ( $column === 'post_views') {
        echo geekfolio_get_post_view();
    }
}
add_filter( 'manage_posts_columns', 'geekfolio_posts_column_views' );
add_action( 'manage_posts_custom_column', 'geekfolio_posts_custom_column_views' );

add_action( 'wp_head', 'geekfolio_set_post_view');
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);