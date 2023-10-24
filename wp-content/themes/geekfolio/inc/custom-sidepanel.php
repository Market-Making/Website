<?php 
//function for custom sidepanel 
function geekfolio_sidepanel_start () {
	if (is_singular()) { 
		
		global $post;
		global $geekfolio_theme_settings;
		if (get_post_meta( $post->ID, 'geekfolio_sidepanel_format', true ) =='custom_sidepanel' && get_post_meta( $post->ID, 'geekfolio_sidepanel_list', true ) ) { 
			$sidepanel_id =  get_post_meta( $post->ID, 'geekfolio_sidepanel_list', true );  
			$geekfolio_sidepanel = new WP_Query( array(
				'posts_per_page'   => 1,
				'post_type' =>  'sidepanel',
				 'p'         => $sidepanel_id,
			) ); 
			
			if ( $geekfolio_sidepanel->have_posts() ) : 
				while  ( $geekfolio_sidepanel->have_posts() ) : $geekfolio_sidepanel->the_post();
					global $post ; ?>
					<div class="geekfolio-custom-sidepanel clearfix <?php echo esc_attr($sidepanel_id); ?>"> 
						<?php the_content(); ?>
					</div>
				<?php endwhile; ?> 
			<?php endif; wp_reset_postdata();
		} 

		//if page setting choose sidepanel global
		else if (get_post_meta( $post->ID, 'geekfolio_sidepanel_format', true ) =='global'){ 
		
			//if custom sidepanel & list are selected in theme options
			if (geekfolio_option( 'geekfolio_sidepanel_set' ) =='custom' && geekfolio_option( 'geekfolio_sidepanel_set_list' ) !='' ) {

				$sidepanel_id =  geekfolio_option( 'geekfolio_sidepanel_set_list' );   
				$geekfolio_sidepanel = new WP_Query(array(
					'posts_per_page'   => 1,
					'post_type' =>  'sidepanel',
					'p'         => $sidepanel_id,
				)); 
			  
				if ( $geekfolio_sidepanel->have_posts() ) : 
					while  ( $geekfolio_sidepanel->have_posts() ) : $geekfolio_sidepanel->the_post();
						global $post ; ?>
						<div class="geekfolio-custom-sidepanel clearfix">
						<?php the_content(); ?>
						</div>
					<?php endwhile; 
				endif; 
				wp_reset_postdata();

			}
		
		//if no sidepanel
		} else if (get_post_meta($post->ID, 'geekfolio_sidepanel_format', true) =='no_sidepanel'){ 

		//do nothing
		}
	}
}