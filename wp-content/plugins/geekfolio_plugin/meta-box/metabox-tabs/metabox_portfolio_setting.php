<?php
/**
 * Metabox For Portfolio Setting.
 *
 * @package geekfolio
 */
?>
<?php 
geekfolio_meta_box_dropdown('geekfolio_port_format',
				esc_html__('Choose Portfolio Format Here', 'geekfolio_plg'),
				array('port_standard' => esc_html__('Portfolio Gallery at Top', 'geekfolio_plg'),
					  'port_two' => esc_html__('Portfolio Gallery at Right', 'geekfolio_plg'),
					 )
			);
geekfolio_meta_box_dropdown('geekfolio_top_type',
				esc_html__('Choose Portfolio Format Here', 'geekfolio_plg'),
				array('top_content_slider' => esc_html__('Images Background', 'geekfolio_plg'),
					  'top_content_video' => esc_html__('Video Background', 'geekfolio_plg'),
					  'top_content_youtube' => esc_html__('Youtube Background', 'geekfolio_plg'),
					 )
			);
geekfolio_meta_box_upload('geekfolio_port_slider_setting', 
				esc_html__('Portfolio Top Image', 'geekfolio_plg'),
				esc_html__('Upload Your Top Image here. <br/>You still need to fill this if you choose the video/youtube background. <br/>
		So the image will replace the video/youtube background in touch devices. ', 'geekfolio_plg')
			);

geekfolio_meta_box_text('geekfolio_port_youtube_link',
				esc_html__('Youtube ID', 'geekfolio_plg'),
				esc_html__('Insert Youtube ID here. e.g EMy5krGcoOU', 'geekfolio_plg')
			);
geekfolio_meta_box_text('geekfolio_port_youtube_quality',
				esc_html__('Youtube Quality', 'geekfolio_plg'),
				esc_html__('Insert Youtube video quality here. You can input <b>small, medium, large, hd720, hd1080, highres</b>. Default value is <b>large</b>', 'geekfolio_plg')
			);
geekfolio_meta_box_text('geekfolio_port_video_link',
				esc_html__('Video Link', 'geekfolio_plg'),
				esc_html__('Insert the video directlink here. eg. https://www.quirksmode.org/html5/videos/big_buck_bunny.mp4', 'geekfolio_plg')
			);
geekfolio_meta_box_upload('geekfolio_gallery_port_img', 
				esc_html__('Portfolio Side Image', 'geekfolio_plg'),
				esc_html__('Upload Your Side Image here.', 'geekfolio_plg')
			);


