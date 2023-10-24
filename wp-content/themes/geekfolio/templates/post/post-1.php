

<!--Post style 1-->      
<?php $geekfolio_single_layout  = geekfolio_option( 'geekfolio_single_sidebar_layout', 'right' );  ?>
<?php $geekfolio_related_layout  = geekfolio_option( 'geekfolio_related_layout', '2' );  ?>


<div class="content blog-wrapper  post-style-1">  
	<div class="container clearfix">
		<div class="row clearfix">
			<div class="col blog-content text-center">
				<?php while (have_posts()) : the_post(); ?>

				<h3 class="entry-title"><?php the_title(); ?></h3> 			
				<ul class="post-detail">
					<?php if(has_category()) { ?> 
			  				<li class="post-cat"> <?php the_category(', '); ?></li>
					<?php } ?>
					<li class="post-date"><i class="bi bi-clock me-1"></i> <?php echo esc_html__('Posted on '.geekfolio_time_ago(),'geekfolio'); ?> </li>  	
				</ul>
						<?php  if ( get_post_meta($post->ID, 'post_format', true) == ''){ the_post_thumbnail(); }?>
						<?php  if ( get_post_meta($post->ID, 'post_format', true) == 'post_standard'){ ?>
							<?php the_post_thumbnail( 'full', array( 'class' => 'full-size-img' ) );?>
							<!--if post is gallery-->
						<?php } else if ( get_post_meta($post->ID, 'post_format', true) == 'post_gallery'){ 
							echo '<div class="blog-gallery clearboth clearfix">';
								$geekfolio_image_ids = get_post_meta(get_the_ID(), 'post_gallery_setting', true);
								$geekfolio_image_ids = explode( ',', $geekfolio_image_ids );
								foreach( $geekfolio_image_ids as $geekfolio_image_id ) {
									$geekfolio_image_title  = get_the_title( $geekfolio_image_id );
									$geekfolio_image_port = wp_get_attachment_image( $geekfolio_image_id, 'full' );
									$geekfolio_imageurl     =  wp_get_attachment_url( $geekfolio_image_id ); 
									echo '<div>
										<a class="blog-popup-img" href="' . esc_url( $geekfolio_imageurl) . '">
											<span>
												<i class="fa fa-search"></i>
											</span>
											' . $geekfolio_image_port . '
										</a>
									</div>';
								} 
							echo'</div>';

							//if post is slider 
						}else if ( get_post_meta($post->ID, 'post_format', true) == 'post_slider'){ ?>

							<div class="blog-slider ani-slider slider" data-slick='{"autoplaySpeed":<?php if ( class_exists('ReduxFrameworkPlugin')&& geekfolio_option( 'geekfolio_blog_slide_delay' ) !='' ){
								echo esc_attr ( geekfolio_option( 'geekfolio_blog_slide_delay' ));} else {echo '8000'; } ?> }'>

								<?php $geekfolio_simage_ids = get_post_meta(get_the_ID(), 'post_slider_setting', true);
								$geekfolio_simage_ids = explode( ',', $geekfolio_simage_ids );
								foreach( $geekfolio_simage_ids as $geekfolio_simage_id ) {
									$geekfolio_simage_port = wp_get_attachment_image( $geekfolio_simage_id, 'full' );
									$geekfolio_simageurl     =  esc_url( wp_get_attachment_url( $geekfolio_simage_id )); ?>
									<div class="slide">
										<div class="slider-mask" data-animation="slideLeftReturn" data-delay="0.1s"></div>
										<div class="slider-img-bg blog-img-bg" data-animation="fadeIn" data-delay="0.2s" data-animation-duration="0.7s" data-background="<?php echo esc_url($geekfolio_simageurl); ?>"></div>
										<div class="blog-slider-box">
											<div class="slider-content"></div>
										</div><!--/.blog-slider-box-->
									</div><!--/.slide-->
								<?php }
							echo'</div>'; 


							//if post video 
						} else if ( get_post_meta($post->ID, 'post_format', true) == 'post_video'){ 
							echo'<div class="video"><iframe width="560" height="315" 
							src="'.esc_attr( get_post_meta($post->ID, 'post_video_setting', true)).'?wmode=opaque;rel=0;showinfo=0;controls=0;iv_load_policy=3"></iframe></div>';

								//if post audio
						} else if ( get_post_meta($post->ID, 'post_format', true) == 'post_audio'){ ?>
							<div class="audio">
								<?php $geekfolio_audio =get_post_meta($post->ID, 'post_audio_setting', true);
								echo wp_kses( $geekfolio_audio, array( 
									'iframe' => array(
										'src' => array(),
										'width' => array(),
										'height' => array(),
										'scrolling' => array(),
										'frameborder' => array(),
									),
								) ); ?>
							</div>
						<?php }?>

						<?php  if ( get_post_meta($post->ID, 'post_format', true) == '' && has_post_thumbnail()){
						echo'<div class="spc-30 clearfix"></div>';
						}?> 



				<?php endwhile; ?>
			</div>
		</div>

		<div class="row clearfix">
			<?php if ($geekfolio_single_layout =='left') { get_sidebar(); }?>

			<div class="<?php if ($geekfolio_single_layout== 'none' || !is_active_sidebar( 'main-sidebar' ) ){ 
				echo 'col-md-12';
			}else{echo 'col-md-8';} ?> blog-content">

				<!--BLOG POST START-->
				<?php while (have_posts()) : the_post(); ?>
				<?php geekfolio_set_post_view(); ?>

					<article id="post-<?php  the_ID(); ?>" <?php  post_class('clearfix blog-post'); ?>>
						<!--if post is standard-->
						<ul class="post-detail">
							<li class="post-auth"><i class="lnr lnr-user fw-600"></i> <?php the_author_posts_link(); ?> </li>
			 				 
			  				<?php if(get_the_tag_list()) { ?>
  							<li><i class="lnr lnr-tag"></i><?php the_tags('', ', '); ?></li> 
  							<?php }?>
			  				<li>
			  					<i class="bi bi-chat-left-text me-1"></i> 
			  					<?php 
			  					if(get_comments_number()==1){
			  					echo esc_attr($post->comment_count).esc_attr__(' Comment','geekfolio'); 
			  					}else{
		  						echo esc_attr($post->comment_count).esc_attr__(' Comments','geekfolio'); 
		  						}

			  					?>
			  				</li>  
							  <li> <i class="bi bi-eye me-1"></i> <?php echo esc_html(geekfolio_get_post_view('show')); ?> </li>
			  				
			  					
		  				</ul>

		  				<div class="spc-20 clearfix"></div>

		  				<?php the_content(); ?>
		  				<div class="spc-20 clearfix"></div>
		  				<div class="post-pager clearfix">
							<?php wp_link_pages(); ?>
						</div>

						<?php if(function_exists('sharebox') || get_the_tag_list()) { ?>

							<div class="post-bottom">
							
								<?php if(get_the_tag_list()) { ?>
								<div class="tags-bottom"><?php the_tags('Tags:  ', '  '); ?></div><!--/.sharebox-->
								<?php }?>
								<div class="sharebox"></div><!--/.sharebox-->
								<div class="border-post clearfix"></div>
							</div>
						<?php }?>

						<!--AUTHOR INFO--> 
						<?php get_template_part('templates/post/author','info');?>

						<!--COMMENTS--> 
						<?php get_template_part('templates/post/comment');?>

						




					</article><!--/.blog-post-->
					<!--BLOG POST END-->    
				<?php endwhile; ?>

				<!--PAGINATION--> 
				<?php get_template_part('templates/post/pagination');?>


			</div><!--/.blog-content-->

			<!--SIDEBAR (RIGHT)-->
			<?php if ( $geekfolio_single_layout =='right') {get_sidebar();} ?>

		</div><!--/.row-->   
	</div><!--/.container-->
	<?php 
	if($geekfolio_related_layout!="0"){
		get_template_part('templates/post/related', $geekfolio_related_layout);
		}
	?>
</div><!--/.blog-wrapper-->
