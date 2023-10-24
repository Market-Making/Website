<?php

get_header();

 $geekfolio_blog_slider  = geekfolio_option( 'geekfolio_blog_slider', 'hide' );
 $geekfolio_blog_popular  = geekfolio_option( 'geekfolio_blog_popular', 'hide' );


    //custom header
    if ( class_exists('ReduxFrameworkPlugin') ) { 
        do_action('geekfolio-custom-header','geekfolio_header_start') ;        
    } else { ?>
        <!--Fall back if no reduxoptions instalgeekfolio-->
        <div class="default-header clearfix">
            <?php get_template_part( 'inc/menu','normal'); ?>
        </div><!--/home end-->        
    <?php }  ?>
    <div class="geekfolio-author">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>   <?php echo esc_html__( 'Author: ', 'geekfolio' ).'<span>'.esc_html(get_the_author_meta('display_name')).'</span>'; ?> </h1> 
                </div>
            </div>
        </div>
    </div>
            
 <?php
    //custom Blog
    if ( class_exists('ReduxFrameworkPlugin')) { 
        $style = geekfolio_option( 'geekfolio_blog_article_layout' );
        get_template_part('templates/blog/blog', $style);
    } else {
        //Fall back if no reduxoptions instalgeekfolio 
        get_template_part('templates/blog/blog','1'); 
    } 
    
    //custom footer
    if ( class_exists('ReduxFrameworkPlugin') ) { 
        do_action('geekfolio-custom-footer','geekfolio_footer_start');
    } else {
        //Fall back if no reduxoptions instalgeekfolio 
        get_template_part( 'inc/bottom','footer'); 
    }
        
get_footer(); ?>