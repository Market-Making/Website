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
    <?php } 

    if ($geekfolio_blog_slider =='show') {
        get_template_part('templates/blog/slider', '1'); 
    }

    if ($geekfolio_blog_popular =='show') {
        get_template_part('templates/blog/popular', '1');
    }  



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