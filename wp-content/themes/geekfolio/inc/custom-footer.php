<?php 
//function for custom footer 
function geekfolio_footer_start () {
	if (is_singular()) { 
		//if single page/post
		global $post;
		global $geekfolio_theme_settings;
		if (get_post_meta( $post->ID, 'geekfolio_footer_format', true ) =='custom_footer' && get_post_meta( $post->ID, 'geekfolio_footer_list', true ) ) { 
			$footer_id =  get_post_meta( $post->ID, 'geekfolio_footer_list', true );  
			$geekfolio_footer = new WP_Query( array(
				'posts_per_page'   => 1,
				'post_type' =>  'footer',
				 'p'         => $footer_id,
			) ); 
			
			if ( $geekfolio_footer->have_posts() ) : 
				while  ( $geekfolio_footer->have_posts() ) : $geekfolio_footer->the_post();
					global $post ; ?>
					<footer class="geekfolio-custom-footer clearfix <?php echo esc_attr($footer_id); ?>"> 
						<?php the_content(); ?>
					</footer>
				<?php endwhile; ?> 
			<?php endif; wp_reset_postdata();
		} 

		//if page setting choose footer global
		else if (get_post_meta( $post->ID, 'geekfolio_footer_format', true ) =='global'){ 
		
			//if custom footer & list are selected in theme options
			if (geekfolio_option( 'geekfolio_footer_set' ) =='custom' && geekfolio_option( 'geekfolio_footer_set_list' ) !='' ) {

				$footer_id =  geekfolio_option( 'geekfolio_footer_set_list' );   
				$geekfolio_footer = new WP_Query(array(
					'posts_per_page'   => 1,
					'post_type' =>  'footer',
					'p'         => $footer_id,
				)); 
			  
				if ( $geekfolio_footer->have_posts() ) : 
					while  ( $geekfolio_footer->have_posts() ) : $geekfolio_footer->the_post();
						global $post ; ?>
						<footer class="geekfolio-custom-footer clearfix">
						<?php the_content(); ?>
						</footer>
					<?php endwhile; 
				endif; 
				wp_reset_postdata();

			} else {
			  get_template_part( 'inc/bottom','footer');
			}
		
		//if no footer
		} else if (get_post_meta($post->ID, 'geekfolio_footer_format', true) =='no_footer'){ 

		//do nothing
		} else {  
			//if else (standard footer)
			get_template_part( 'inc/bottom','footer'); 
		}
	
	//if not single page/post
	} else {
		//if custom footer & list are selected in theme options
		if ( geekfolio_option( 'geekfolio_footer_set' ) =='custom' && geekfolio_option( 'geekfolio_footer_set_list' ) !='' ) {
			$footer_id = geekfolio_option( 'geekfolio_footer_set_list' );  
		
			$geekfolio_footer = new WP_Query( array(
				'posts_per_page'   => 1,
				'post_type' =>  'footer',
				'p'         => $footer_id,
			) ); 
			  
			if ( $geekfolio_footer->have_posts()) : 
				while  ( $geekfolio_footer->have_posts() ) : $geekfolio_footer->the_post();
					global $post ; ?>
					<nav class="geekfolio-custom-footer clearfix <?php echo esc_attr ( get_post_meta( $post->ID, 'head_position', true ) )?>">
						<?php the_content(); ?>
					</nav>
				<?php endwhile; 
			endif; 
			wp_reset_postdata();
		} else { 
			//standard footer
			get_template_part( 'inc/bottom','footer'); 
		}
	}
}