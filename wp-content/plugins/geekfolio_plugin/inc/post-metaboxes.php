<?php
/**
 * Initialize the Post Post Meta Boxes. 
 */
add_action( 'admin_init', 'geekfolio_post_mb' );
function geekfolio_post_mb() {
  
  /**
   * Create a custom meta boxes array that we pass to 
   * the reduxoptions Meta Box API Class.
   */
  $geekfolio_post_mb = array(
    'id'          => 'post_meta_box',
    'title'       => esc_html__( 'Post Setting', 'geekfolio_plg' ), 
    'desc'        => '',
    'pages'       => array( 'post' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
	 array(
        'id'          => 'post_setting_block',
        'label'       => esc_html__('Note for Image', 'geekfolio_plg' ),
        'desc'        => esc_html__('Always use the same ratio/size for images in slider/gallery below.  ', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'textblock-titgeekfolio',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'label'       => esc_html__( 'Choose Post Format Here', 'geekfolio_plg' ),
        'id'          => 'post_format',
        'type'        => 'select',
		'std'		 => 'post_standard',
		'choices'     => array( 
			  array(
                'value'       => 'post_standard',
                'label'       => esc_html__( 'Post Standard', 'geekfolio_plg' )
              ),
			  array(
                'value'       => 'post_gallery',
                'label'       => esc_html__( 'Post Gallery', 'geekfolio_plg' )
              ),
			  array(
                'value'       => 'post_slider',
                'label'       => esc_html__( 'Post Slider', 'geekfolio_plg' )
              ),
			  array(
                'value'       => 'post_video',
                'label'       => esc_html__( 'Post Video', 'geekfolio_plg' )
              ),
			  array(
                'value'       => 'post_audio',
                'label'       => esc_html__( 'Post Audio', 'geekfolio_plg' )
              ),
		)
      ),
	  
	  array(
        'label'       => esc_html__( 'Gallery Setting', 'geekfolio_plg' ),
        'id'          => 'post_gallery_setting',
        'type'        => 'gallery',
        'desc'        => esc_html__( 'Create your Post gallery here. <br/>Try to use same ratio for each image.', 'geekfolio_plg' ),
        'condition'   => 'post_format:is(post_gallery)'
      ),
	  array(
        'label'       => esc_html__( 'Slider Setting', 'geekfolio_plg' ),
        'id'          => 'post_slider_setting',
        'type'        => 'gallery',
        'desc'        => esc_html__( 'Create your Post Slider here.', 'geekfolio_plg' ),
        'condition'   => 'post_format:is(post_slider)'
      ),
	  array(
        'label'       => esc_html__( 'Video Setting', 'geekfolio_plg' ),
        'id'          => 'post_video_setting',
        'type'        => 'text',
        'desc'        => esc_html__( 'Insert the link for video embed here.<br/> For video from youtube/vimeo just put the link without any attribute like ?wmode=opaque.<br/>eg: http://www.youtube.com/embed/IzgAYZTuBA8 or http://player.vimeo.com/video/64078587', 'geekfolio_plg' ),
        'condition'   => 'post_format:is(post_video)'
      ),
	   array(
        'label'       => esc_html__( 'Audio Setting', 'geekfolio_plg' ),
        'id'          => 'post_audio_setting',
        'type'        => 'textarea',
		'rows'        => '3',
        'desc'        => esc_html__( 'Insert your iframe/embedded code for audio here.<br/>
		You can input iframe/embed code from youtube/vimeo here too, if you don\'t like the default style of Post video.', 'geekfolio_plg' ),
        'condition'   => 'post_format:is(post_audio)'
      ),
	  array(
        'label'       => esc_html__( 'Sidebar', 'geekfolio_plg' ),
        'id'          => 'post_sidebar',
        'type'        => 'on-off',
		'desc'        => esc_html__( 'You can hide the sidebar by turning it off.', 'geekfolio_plg' ),
		'std'		 => 'on',
      )
    )
  );


}

