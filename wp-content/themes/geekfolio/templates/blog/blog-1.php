<?php $geekfolio_blog_layout  = geekfolio_option( 'blog_sidebar_layout', 'right' );  ?>

<div class="content blog-wrapper blog-style-1">  
    <div class="container clearfix">
        <div class="row clearfix">
            <?php if ($geekfolio_blog_layout =='left') { get_sidebar(); }?>

            <div class="<?php if ($geekfolio_blog_layout== 'none' || !is_active_sidebar( 'main-sidebar' ) ){ 
                echo 'col-md-12';
            }else{echo 'col-md-8';} ?> blog-content">

                <?php while (have_posts()) : the_post(); 
                    get_template_part( 'inc/loop', 'post' ); 
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
