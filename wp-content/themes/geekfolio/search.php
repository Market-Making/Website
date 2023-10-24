<?php

get_header(); 
		
	//custom header
	if ( class_exists('ReduxFrameworkPlugin') ) { 
		do_action('geekfolio-custom-header','geekfolio_header_start') ;        
	} else { ?>
	
		<!--Fall back if no reduxoptions install-->
		<div class="default-header clearfix">
			<?php get_template_part( 'inc/menu','normal'); ?>
		</div><!--/home end-->		
	<?php } ?>
	<?php $geekfolio_search_layout  = geekfolio_option( 'search_sidebar_layout', 'right' );  ?>
	
	<div class="content blog-wrapper">  
		<div class="container clearfix">
			 <div class="row clearfix">
				<?php if ($geekfolio_search_layout =='left') { get_sidebar(); }?>
				<div class="<?php if ($geekfolio_search_layout== 'none' || !is_active_sidebar( 'main-sidebar' ) ){ 
					echo 'col-md-12';
				}else{echo 'col-md-8';} ?> blog-content">

					<h3 class="search-title">
						<?php 
						$archive_title=sprintf(
							'%1$s %2$s',
							'<span class="color-accent">' . esc_html_e( 'Search result for:', 'geekfolio' ) . '</span>',
							'&ldquo;' . get_search_query() . '&rdquo;'
						);
						echo wp_kses_post( $archive_title ); 
						?>
					</h3>
					<!--BLOG POST START-->
					<?php if ( have_posts() ) : ?>
					
					<?php while (have_posts()) : the_post(); get_template_part( 'inc/loop', 'post' ); endwhile  ?>
					
					<?php  else: ?>
					<p><?php esc_html_e('We could not find any results for your search. You can give it another try through the search form below.','geekfolio'); ?></p> 
					<div class="no-search-results-form">
						<?php $geekfolio_unique_id = geekfolio_unique_id( 'search-form-' ); ?>
						<form role="search" method="get" id="<?php echo esc_attr( $geekfolio_unique_id ); ?>" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<input type="search" class="focus-input" placeholder="<?php echo esc_attr__('Type search keyword...','geekfolio'); ?>" value="<?php get_search_query()?>" name="s">
							<input type="submit" class="searchsubmit" value=""> 
						</form>
					</div>
					<?php endif; ?>
					<!--BLOG POST END-->
					
					<ul class="pagination clearfix">
						<li><?php  previous_posts_link();  ?></li>
						<li><?php next_posts_link(); ?> </li>
					</ul>
					<div class="spc-40 clearfix"></div>
				</div><!--/.col-md-8-->
				
            <!--SIDEBAR (RIGHT)-->
			<?php if ( $geekfolio_search_layout =='right') {get_sidebar();} ?>

			 </div><!--/.row-->
		</div><!--/.container-->
	</div><!--/.blog-wrapper-->
	
	<?php //custom footer
		if ( class_exists('ReduxFrameworkPlugin') ) { 
			do_action('geekfolio-custom-footer','geekfolio_footer_start');
		} else {
			//Fall back if no reduxoptions instalgeekfolio
			get_template_part( 'inc/bottom','footer'); 
		}
		
get_footer(); ?>