<?php
/**
 * Blog Post Loop 
 */
?>

<!--BLOG POST START-->      
<article id="post-<?php  the_ID(); ?>" <?php  post_class('clearfix blog-post border-bottom brd-gray pb-30 mb-30'); ?>> 
<div class="row">
 
	<!--if post is standard-->
	<div class="col-lg-5">
		<?php  if ( get_post_meta($post->ID, 'post_format', true) == '' && has_post_thumbnail()){
			echo' <div class="post-img">';
				echo'<div class="img-post">';
					the_post_thumbnail(); 
				echo'</div>';
			echo'</div>';
		}
		
		if ( get_post_meta($post->ID, 'post_format', true) == 'post_standard'){
			the_post_thumbnail( 'full', array( 'class' => 'full-size-img' ) );
			//post is gallery
		} else if ( get_post_meta($post->ID, 'post_format', true) == 'post_gallery'){ 
			echo '<div class="blog-gallery clearboth clearfix">';
				$geekfolio_image_ids = get_post_meta(get_the_ID(), 'post_gallery_setting', true);
				$geekfolio_image_ids = explode( ',', $geekfolio_image_ids );
				foreach( $geekfolio_image_ids as $geekfolio_image_id ) {
					$geekfolio_image_title  = get_the_title( $geekfolio_image_id );
					$geekfolio_image_port = wp_get_attachment_image( $geekfolio_image_id, 'full' );
					$geekfolio_imageurl     =   wp_get_attachment_url( $geekfolio_image_id ); 
					echo '<div>
						<a class="blog-popup-img" href="' . esc_url( $geekfolio_imageurl ) . '">
							<span>
							<i class="fa fa-search"></i>
							</span>
							' . $geekfolio_image_port . '
						</a>
					</div>';
				} 
			echo'</div>';

		
		//if post is slider
		} else if ( get_post_meta($post->ID, 'post_format', true) == 'post_slider'){ ?>
		
			<div class="blog-slider ani-slider slider" data-slick='{"autoplaySpeed":<?php if ( class_exists('ReduxFrameworkPlugin') && geekfolio_option( 'geekfolio_blog_slide_delay' ) !='' ){echo esc_attr ( geekfolio_option( 'geekfolio_blog_slide_delay' ));} else {echo '8000'; } ?> }'>
				<?php $geekfolio_simage_ids = get_post_meta(get_the_ID(), 'post_slider_setting', true);
				$geekfolio_simage_ids = explode( ',', $geekfolio_simage_ids );
				foreach( $geekfolio_simage_ids as $geekfolio_simage_id ) {
					$geekfolio_simage_port = wp_get_attachment_image( $geekfolio_simage_id, 'full' );
					$geekfolio_simageurl =  esc_url( wp_get_attachment_url( $geekfolio_simage_id )); ?>
					<div class="slide">
						<div class="slider-mask" data-animation="slideLeftReturn" data-delay="0.1s">
						</div>
						<div class="slider-img-bg blog-img-bg" data-animation="fadeIn" data-delay="0.2s" data-animation-duration="0.7s"data-background="<?php echo esc_url($geekfolio_simageurl); ?>">
						</div>
						<div class="blog-slider-box">
							<div class="slider-content"></div>
						</div><!--/.blog-slider-box-->
					</div><!--/.slide-->
				<?php }
			echo'</div>'; 

		//if post video 
		} else if ( get_post_meta($post->ID, 'post_format', true) == 'post_video'){

			echo'<div class="video"><iframe width="560" height="315" src="'.esc_attr( get_post_meta($post->ID, 'post_video_setting', true)).'?wmode=opaque;rel=0;showinfo=0;controls=0;iv_load_policy=3"></iframe></div>';
					
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
	</div>

	<div class="col-lg-7">
		<div class="post-details">

			<ul class="post-detail">

					<?php
						$destudio_taxonomy = 'portfolio_category';
						$destudio_taxs = wp_get_post_terms($post->ID, $destudio_taxonomy);
						$destudio_cats = array();
						$count = 1;
						foreach ($destudio_taxs as $destudio_tax) { 
							if($count != 1) echo ', '; ?>
							<a class="cat" href="<?php echo esc_url( get_term_link( $destudio_tax->slug, $destudio_taxonomy ) ); ?>"><?php echo esc_html($destudio_tax->name); ?></a>
							<?php $count++;
						}; 
					?>

					<?php 
					if ( geekfolio_option( 'geekfolio_blog_tags' ) =="on") {
						if(get_the_tag_list()) { ?>  
							<li>
								<i class="lnr lnr-tag"></i><?php the_tags('', ', '); ?>
							</li>
						<?php
						} 
					}
					?> 
			</ul>
			<a href="<?php the_permalink(); ?>">
				<h3 class="entry-title"><?php the_title(); ?></h3>
			</a>

			<p class="excerpt">
				<?php 
					$excerpt = get_the_excerpt();
					$excerpt_size = geekfolio_option( 'excerpt_size');
					$excerpt = substr($excerpt, 0, $excerpt_size);
					echo esc_attr($excerpt.' [...]');
				?>
			</p> 
			<ul class="post-detail post-bot">
				<?php
					$geekfolio_taxonomy_tag = 'porto_tag';
					$geekfolio_taxs_tag = wp_get_post_terms($post->ID, $geekfolio_taxonomy_tag);
					$geekfolio_tags = array();
					$count = 1;
					foreach ($geekfolio_taxs_tag as $geekfolio_tax_tag) { 
						if($count != 1) ?>
						<span>
							<a class="cat" href="<?php echo esc_url( get_term_link( $geekfolio_tax_tag->slug, $geekfolio_taxonomy_tag ) ); ?>"><?php echo esc_html( $geekfolio_tax_tag->name); ?></a>
						</span>
						<?php $count++;
					}; ?>  
			</ul>


			<div class="spc-10 clearfix"></div>
			<?php if ( geekfolio_option( 'geekfolio_blog_button' ) =="on") { ?>
				<a class="content-btn geekfolio-gradient-border" href="<?php the_permalink(); ?>">
					<?php echo esc_html_e('Continue Reading','geekfolio') ?>
					<span class="content-btn-align-icon-right content-btn-button-icon">
						<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
					</span>
				</a>
			<?php } ?>
		</div>
	</div>
</div>
</article><!--/.blog-post-->
<!--BLOG POST END-->