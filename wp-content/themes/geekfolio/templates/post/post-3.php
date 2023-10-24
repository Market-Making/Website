

<!--Post style 3-->      
<?php $geekfolio_single_layout  = geekfolio_option( 'geekfolio_single_sidebar_layout', 'right' );  ?>

<div class="content blog-wrapper post-style-3">  
	<div class="container clearfix">
		<div class="row clearfix">
		<?php if ($geekfolio_single_layout =='left') { get_sidebar(); }?>

		<div class="<?php if ($geekfolio_single_layout== 'none' || !is_active_sidebar( 'main-sidebar' ) ){ 
			echo 'col-md-12';
		}else{echo 'col-md-8';} ?> blog-content">

				<!--BLOG POST START-->
				<?php while (have_posts()) : the_post(); ?>

					<article id="post-<?php  the_ID(); ?>" <?php  post_class('clearfix blog-post'); ?>>
						<div class="entry-header" >
							<!--if post is standard-->
						<?php 
						$media=get_the_post_thumbnail_url();
						if ( get_post_meta($post->ID, 'post_format', true) == ''){ echo '<div class="blog-post_bg_media" style="background-image:url('.esc_url($media).')"'.'></div>';}
						?>

							<div class="entery-header-data">
								<span class="post-date geekfolio-gradient-border-drk "> <?php the_time('<\s\p\a\n>d</\s\p\a\n> F'); ?> </span>
								<?php if(has_category()) { ?>
								<span class="post-category"> <?php the_category(' / '); ?></span>
								<?php }?>
		 						<h3 class="entry-title"><?php the_title(); ?></h3> 

								<ul class="post-detail">
									<li><i class="lnr lnr-user fw-600"></i> <?php the_author_posts_link(); ?> </li>
					  				<?php if(get_the_tag_list()) { ?>
		  							<li><i class="lnr lnr-tag"></i><?php the_tags('', ', '); ?></li> 
		  							<?php }?>
					  				<li>
					  					<i class="lnr lnr-bubble"></i> 
					  					<?php 
					  					if(get_comments_number()==1){
					  					echo esc_attr($post->comment_count).esc_attr__(' Comment','geekfolio'); 
					  					}else{
				  						echo esc_attr($post->comment_count).esc_attr__(' Comments','geekfolio'); 
				  						}

					  					?>
					  				</li>   
					  					
				  				</ul>
			  				</div>
						</div>

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

						<!--RELATED POST-->
						<?php get_template_part( 'inc/related', 'posts' ); ?>
						<!--RELATED POST END--> 

							<?php   if ( !post_password_required() ) { //only show comment if post not password protected

							// If comments are open or we have at least one comment, load up the comment template.
							   if (  comments_open() || get_comments_number()) :
								   comments_template();

						   endif; }?>

					</article><!--/.blog-post-->
					<!--BLOG POST END-->    
				<?php endwhile; ?>
					<div class="img-pagination">
						<?php $geekfolio_prevPost = get_previous_post();
						if($geekfolio_prevPost) {?>
							<div class="pagi-nav-box previous">
								<?php $geekfolio_prevthumbnail = get_the_post_thumbnail($geekfolio_prevPost->ID, array(150,150) ); $geekfolio_prev = esc_html__('Previous post', 'geekfolio'); ?>
								<?php previous_post_link('%link',"<div class='img-pagi'><i class='lnr lnr-arrow-left'></i> 
								$geekfolio_prevthumbnail</div>  <div class='imgpagi-box'><p>$geekfolio_prev</p> <h4 class='pagi-title'>%title</h4> </div>"); ?> 
							</div>

						<?php } $geekfolio_nextPost = get_next_post();  
						if($geekfolio_nextPost) { ?>
							<div class="pagi-nav-box next">
								<?php $geekfolio_nextthumbnail = get_the_post_thumbnail($geekfolio_nextPost->ID, array(150,150) ); $geekfolio_next = esc_html__('Next post', 'geekfolio'); ?>
								<?php next_post_link('%link',"<div class='imgpagi-box'><p>$geekfolio_next</p><h4 class='pagi-title'>%title</h4> </div> <div class='img-pagi'><i class='lnr lnr-arrow-right'></i>
								$geekfolio_nextthumbnail</div> "); ?>
							</div>
						<?php } ?>
					</div><!--/.img-pagination-->

			</div><!--/.blog-content-->

			<!--SIDEBAR (RIGHT)-->
			<?php if ( $geekfolio_single_layout =='right') {get_sidebar();} ?>

		</div><!--/.row-->   
	</div><!--/.container-->
</div><!--/.blog-wrapper-->
