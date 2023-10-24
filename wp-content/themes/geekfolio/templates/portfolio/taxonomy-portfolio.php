
<?php
get_header();
global $query;

//custom header
if ( class_exists('ReduxFrameworkPlugin') ) { 
    do_action('geekfolio-custom-header','geekfolio_header_start') ;        
} else { ?>
    <!--Fall back if no reduxoptions instalgeekfolio-->
    <div class="default-header clearfix">
        <?php get_template_part( 'inc/menu','normal'); ?>
    </div><!--/home end-->        
<?php }  ?>



<?php $geekfolio_blog_layout  = geekfolio_option( 'blog_sidebar_layout', 'right' );  ?>

<div class="content blog-wrapper portfolio-style-1">  
<div class="container clearfix">
    <div class="row clearfix">
        <?php if ($geekfolio_blog_layout =='left') { get_sidebar(); }?>

        <div class="<?php if ($geekfolio_blog_layout== 'none' || !is_active_sidebar( 'main-sidebar' ) ){ 
            echo 'col-md-12';
        }else{echo 'col-md-8';} ?> blog-content">

            <?php while ($query->have_posts()) : $query->the_post(); 
                get_template_part( 'templates/portfolio/loop', 'portfolio' ); 
                endwhile ?>
            <ul class="pagination clearfix">
                <li><?php  previous_posts_link( esc_html__( 'Previous Page', 'geekfolio' ) ); ?></li>
                <li><?php next_posts_link( esc_html__( 'Next Page', 'geekfolio' ) ); ?> </li>
            </ul>
            <div class="spc-40 clearfix"></div>
        </div><!--/.blog-content-->
        
        <!--SIDEBAR (RIGHT)-->
        <?php if ( $geekfolio_blog_layout =='right') {get_sidebar();} ?>
        
    </div><!--/.row-->
</div><!--/.container-->
</div><!--/.blog-wrapper-->

<?php
//custom footer
if ( class_exists('ReduxFrameworkPlugin') ) { 
    do_action('geekfolio-custom-footer','geekfolio_footer_start');
} else {
    //Fall back if no reduxoptions instalgeekfolio 
    get_template_part( 'inc/bottom','footer'); 
}
    
get_footer(); ?>