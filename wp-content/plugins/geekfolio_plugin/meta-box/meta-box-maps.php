<?php
/**
 * Metabox Map
 *
 * @package Geekfolio
 */
?>
<?php
function geekfolio_meta_box_text($geekfolio_id, $geekfolio_label, $geekfolio_desc = '', $geekfolio_short_desc = '')
{
	global $post;

	$html = '';
		$html .= '<div class="'.esc_attr($geekfolio_id).'_box description_box">';
		$html .= '<div class="left-part">';
			$html .= $geekfolio_label;
			if($geekfolio_desc) {
				$html .= '<span class="description">' . esc_attr($geekfolio_desc) . '</span>';
			}
		$html .='</div>';
		$html .= '<div class="right-part">';
			$html .= '<input type="text" id="' . esc_attr($geekfolio_id) . '" name="' . esc_attr($geekfolio_id) . '" value="' . get_post_meta($post->ID, $geekfolio_id, true) . '" />';
			if($geekfolio_short_desc) {
				$html .= '<span class="short-description">' . esc_attr($geekfolio_short_desc) . '</span>';
			}
		$html .= '</div>';
		$html .= '</div>';
	echo sprintf("%s",$html);
}

function geekfolio_meta_box_dropdown($geekfolio_id, $geekfolio_label, $geekfolio_options, $geekfolio_desc = '')
{
	global $post;
	

	$html = $geekfolio_select_class = '';

			$html .= '<div class="'.esc_attr($geekfolio_id).'_box description_box">';
					$html .= '<div class="left-part">';
							$html .= $geekfolio_label;
							if($geekfolio_desc) {
									$html .= '<span class="description">' . esc_attr($geekfolio_desc) . '</span>';
							}
					$html .='</div>';
					$html .= '<div class="right-part">';
							$html .= '<select id="' . esc_attr($geekfolio_id) . '" class="'.$geekfolio_select_class.'" name="' . esc_attr($geekfolio_id) . '">';
							foreach($geekfolio_options as $key => $option) {
									if(get_post_meta($post->ID, $geekfolio_id, true) == (string)$key && get_post_meta($post->ID, $geekfolio_id, true) != '') {
											$geekfolio_selected = 'selected="selected"';
									}else {
													$geekfolio_selected = '';
									}

									$html .= '<option ' . $geekfolio_selected . ' value="' . esc_attr($key) . '">' . esc_attr($option) . '</option>';

							}
							$html .= '</select>';
					$html .='</div>';	
		$html .= '</div>';
	echo sprintf("%s",$html);
}

function geekfolio_meta_box_dropdown_sidebar($geekfolio_id, $geekfolio_label, $geekfolio_options, $geekfolio_desc = '', $geekfolio_child_hidden = '')
{
	global $post;

	$html = $geekfolio_select_class = '';
	$flag = false;
		$geekfolio_child_hidden = ( $geekfolio_child_hidden ) ? ' hide-child '.$geekfolio_child_hidden : '';
		$html .= '<div class="'.esc_attr($geekfolio_id).'_box description_box'.$geekfolio_child_hidden.'">';
			$html .= '<div class="left-part">';
				$html .= $geekfolio_label;
				if($geekfolio_desc) {
					$html .= '<span class="description">' . esc_attr($geekfolio_desc) . '</span>';
				}
			$html .='</div>';
			$html .= '<div class="right-part">';
				$html .= '<select id="' . esc_attr($geekfolio_id) . '" class="'.esc_attr($geekfolio_select_class).'" name="' . esc_attr($geekfolio_id) . '">';
				foreach($geekfolio_options as $key => $option) {
					if(get_post_meta($post->ID, $geekfolio_id, true) == $key && get_post_meta($post->ID, $geekfolio_id, true) != '') {
						$geekfolio_selected = 'selected="selected"';
					}else {
							$geekfolio_selected = '';
					}

					$html .= '<option ' . $geekfolio_selected . ' value="' . esc_attr($key) . '">' . esc_attr($option) . '</option>';

				}
				$html .= '</select>';
			$html .='</div>';	
		$html .= '</div>';
	echo sprintf("%s",$html);
}

/* menu dropdown */

function geekfolio_meta_box_dropdown_menu($geekfolio_id, $geekfolio_label, $geekfolio_options, $geekfolio_desc = '')
{
	global $post;

	$html = $geekfolio_select_class = '';
	$flag = false;

	
		$html .= '<div class="'.esc_attr($geekfolio_id).'_box description_box">';
			$html .= '<div class="left-part">';
				$html .= $geekfolio_label;
				if($geekfolio_desc) {
					$html .= '<span class="description">' . esc_attr($geekfolio_desc) . '</span>';
				}
			$html .='</div>';
			$html .= '<div class="right-part">';
				$html .= '<select id="' . esc_attr($geekfolio_id) . '" class="'.esc_attr($geekfolio_select_class).'" name="' . esc_attr($geekfolio_id) . '">';
				$html .= '<option value="">Default</option>';
				$geekfolio_menus = wp_get_nav_menus();
				$geekfolio_menu_array = array();
				foreach ($geekfolio_menus as $key => $value) {
					if(get_post_meta($post->ID, $geekfolio_id, true) == $value->slug && get_post_meta($post->ID, $geekfolio_id, true) != '') {
						$geekfolio_selected = 'selected="selected"';
					}else {
							$geekfolio_selected = ''; 
					}

					$html .= '<option ' . $geekfolio_selected . ' value="' . esc_attr($value->slug) . '">' . esc_attr($value->name) . '</option>';
				}
				$html .= '</select>';
			$html .='</div>';	
		$html .= '</div>';
	echo sprintf("%s",$html);
}

function geekfolio_meta_box_dropdown_custom_headers($geekfolio_id, $geekfolio_label, $geekfolio_options, $geekfolio_desc = '')
{
	global $post;

	$html = $geekfolio_select_class = '';
	$flag = false;

	
		$html .= '<div class="'.esc_attr($geekfolio_id).'_box description_box">';
			$html .= '<div class="left-part">';
				$html .= $geekfolio_label;
				if($geekfolio_desc) {
					$html .= '<span class="description">' . esc_attr($geekfolio_desc) . '</span>';
				}
			$html .='</div>';
			$html .= '<div class="right-part">';
				$html .= '<select id="' . esc_attr($geekfolio_id) . '" class="'.esc_attr($geekfolio_select_class).'" name="' . esc_attr($geekfolio_id) . '">';
				$html .= '<option value="">Default</option>';
				$geekfolio_custom_headers = new WP_Query( array( 'post_type' => 'header' ) );
				$posts = $geekfolio_custom_headers->posts; 
				foreach ($posts as $key => $value) {
					if(get_post_meta($post->ID, $geekfolio_id, true) == $value->ID && get_post_meta($post->ID, $geekfolio_id, true) != '') {
						$geekfolio_selected = 'selected="selected"';
					}else {
							$geekfolio_selected = '';
					}

					$html .= '<option ' . $geekfolio_selected . ' value="' . esc_attr($value->ID) . '">' . esc_attr($value->post_name) . '</option>';
				}
				$html .= '</select>';
			$html .='</div>';	
		$html .= '</div>';
	echo sprintf("%s",$html);
}

function geekfolio_meta_box_dropdown_custom_footers($geekfolio_id, $geekfolio_label, $geekfolio_options, $geekfolio_desc = '')
{
	global $post;

	$html = $geekfolio_select_class = '';
	$flag = false;

	
		$html .= '<div class="'.esc_attr($geekfolio_id).'_box description_box">';
			$html .= '<div class="left-part">';
				$html .= $geekfolio_label;
				if($geekfolio_desc) {
					$html .= '<span class="description">' . esc_attr($geekfolio_desc) . '</span>';
				}
			$html .='</div>';
			$html .= '<div class="right-part">';
				$html .= '<select id="' . esc_attr($geekfolio_id) . '" class="'.esc_attr($geekfolio_select_class).'" name="' . esc_attr($geekfolio_id) . '">';
				$html .= '<option value="">Default</option>';
				$geekfolio_custom_footers = new WP_Query( array( 'post_type' => 'footer' ) );
				$posts = $geekfolio_custom_footers->posts; 
				foreach ($posts as $key => $value) {
					if(get_post_meta($post->ID, $geekfolio_id, true) == $value->ID && get_post_meta($post->ID, $geekfolio_id, true) != '') {
						$geekfolio_selected = 'selected="selected"'; 
					}else {
							$geekfolio_selected = '';
					}

					$html .= '<option ' . $geekfolio_selected . ' value="' . esc_attr($value->ID) . '">' . esc_attr($value->post_name) . '</option>';
				}
				$html .= '</select>';
			$html .='</div>';	
		$html .= '</div>';
	echo sprintf("%s",$html);
}
function geekfolio_meta_box_dropdown_custom_sidepanels($geekfolio_id, $geekfolio_label, $geekfolio_options, $geekfolio_desc = '')
{
	global $post;

	$html = $geekfolio_select_class = '';
	$flag = false;

	
		$html .= '<div class="'.esc_attr($geekfolio_id).'_box description_box">';
			$html .= '<div class="left-part">';
				$html .= $geekfolio_label;
				if($geekfolio_desc) {
					$html .= '<span class="description">' . esc_attr($geekfolio_desc) . '</span>';
				}
			$html .='</div>';
			$html .= '<div class="right-part">';
				$html .= '<select id="' . esc_attr($geekfolio_id) . '" class="'.esc_attr($geekfolio_select_class).'" name="' . esc_attr($geekfolio_id) . '">';
				$html .= '<option value="">Default</option>';
				$geekfolio_custom_sidepanels = new WP_Query( array( 'post_type' => 'sidepanel' ) );
				$posts = $geekfolio_custom_sidepanels->posts; 
				foreach ($posts as $key => $value) {
					if(get_post_meta($post->ID, $geekfolio_id, true) == $value->ID && get_post_meta($post->ID, $geekfolio_id, true) != '') {
						$geekfolio_selected_sidepanel = 'selected="selected"'; 
					}else {
							$geekfolio_selected_sidepanel = '';
					}

					$html .= '<option ' . $geekfolio_selected_sidepanel . ' value="' . esc_attr($value->ID) . '">' . esc_attr($value->post_name) . '</option>';
				}
				$html .= '</select>';
			$html .='</div>';	
		$html .= '</div>';
	echo sprintf("%s",$html);
}

function geekfolio_meta_box_textarea($geekfolio_id, $geekfolio_label, $geekfolio_desc = '', $geekfolio_default = '' )
{
	global $post;
	$html = '';
	$html .= '<div class="'.esc_attr($geekfolio_id).'_box description_box">';
	$html .= '<div class="left-part">';
		$html .= $geekfolio_label;
		if($geekfolio_desc) {
			$html .= '<span class="description">' . esc_attr($geekfolio_desc) . '</span>';
		}
	$html .='</div>';
	
	if( get_post_meta($post->ID, $geekfolio_id, true)) {
		$geekfolio_value = get_post_meta($post->ID, $geekfolio_id, true);
	} else {
		$geekfolio_value = '';
	}
	$html .= '<div class="right-part">';
		$html .= '<textarea cols="120" id="' . esc_attr($geekfolio_id) . '" name="' . esc_attr($geekfolio_id) . '">' . esc_attr($geekfolio_value) . '</textarea>';
	$html .='</div>';
	$html .= '</div>';

	echo sprintf("%s",$html);
}

function geekfolio_meta_box_upload($geekfolio_id, $geekfolio_label, $geekfolio_desc = '')
{
	global $post;

	$html = '';
	$html .= '<div class="'.esc_attr($geekfolio_id).'_box description_box">';
	$html .= '<div class="left-part">';
		$html .= $geekfolio_label;
		if($geekfolio_desc) {
			$html .= '<span class="description">' . esc_attr($geekfolio_desc) . '</span>';
		}
	$html .='</div>';
	$html .= '<div class="right-part">';
		$html .= '<input name="' . esc_attr($geekfolio_id) . '" class="upload_field" id="geekfolio_upload" type="text" value="' . get_post_meta($post->ID,  $geekfolio_id, true) . '" />';
		$html .= '<input name="'. $geekfolio_id.'_thumb" class="'. $geekfolio_id.'_thumb" id="'. $geekfolio_id.'_thumb" type="hidden" value="'.get_post_meta($post->ID,  $geekfolio_id, true).'" />';
				$html .= '<img class="upload_image_screenshort" src="'.get_post_meta($post->ID,  $geekfolio_id, true).'" />';
		$html .= '<input class="geekfolio_upload_button" id="geekfolio_upload_button" type="button" value="'.__( 'Browse', 'geekfolio_plg' ).'" />';
		$html .= '<span class="geekfolio_remove_button button">'.__( 'Remove', 'geekfolio_plg' ).'</span>';
				
	$html .='</div>';
	$html .= '</div>';
	echo sprintf("%s",$html);
}

function geekfolio_meta_box_upload_multiple($geekfolio_id, $geekfolio_label, $geekfolio_desc = '')
{
	global $post;

	$html = '';
	$html .= '<div class="'.esc_attr($geekfolio_id).'_box description_box">';
		$html .= '<div class="left-part">';
			$html .= $geekfolio_label;
			if($geekfolio_desc) {
				$html .= '<span class="description">' . esc_attr($geekfolio_desc) . '</span>';
			}
		$html .='</div>';
		$html .= '<div class="right-part">';
		
			$html .= '<input name="' . esc_attr($geekfolio_id) . '" class="upload_field" id="geekfolio_upload" type="hidden" value="'.get_post_meta($post->ID,  $geekfolio_id, true).'" />';
			$html .= '<div class="multiple_images">';
			$geekfolio_val = explode(",",get_post_meta($post->ID,  $geekfolio_id, true));
			
			foreach ($geekfolio_val as $key => $value) {
				if(!empty($value)):
					$geekfolio_image_url = wp_get_attachment_url( $value );
					$html .='<div id='.esc_attr($value).'>';
						$html .= '<img class="upload_image_screenshort_multiple" src="'.$geekfolio_image_url.'" style="width:100px;" />';
						$html .= '<a href="javascript:void(0)" class="remove">'.__( 'Remove', 'geekfolio_plg' ).'</a>';
					$html .= '</div>';
				endif;
			}
			$html .= '</div>';
			$html .= '<input class="geekfolio_upload_button_multiple" id="geekfolio_upload_button_multiple" type="button" value="Browse" />'.__( ' Select Files', 'geekfolio_plg' );
					
		$html .='</div>';
	$html .= '</div>';
	echo sprintf( "%s", $html );
}

	if ( ! function_exists( 'geekfolio_meta_box_colorpicker' ) ) {
		function geekfolio_meta_box_colorpicker( $id, $label, $desc = '', $geekfolio_dependency = '' ) {
			global $post;
	        
			$dependency_attr = '';
			$dependency_arr = array();

			if( !empty($geekfolio_dependency) ){
				$val = array();
				$dependency_arr[] = 'data-element="'.$geekfolio_dependency['element'].'"';
				foreach ($geekfolio_dependency['value'] as $key => $value) {
					$val[] = $value; 
				}
				$dep_list = implode(",", $val);
				$dependency_arr[] = 'data-value="'.$dep_list.'"';
				$dependency_attr = implode(" ", $dependency_arr);
			}

			$html = '';
			$html .= '<div class="'.$id.'_box description_box"'.$dependency_attr.'>';
				$html .= '<div class="left-part">';
					$html .= $label;
					if($desc) {
						$html .= '<span class="description">' . $desc . '</span>';
					}
				$html .='</div>';
				$html .= '<div class="right-part">';
					$html .= '<input type="text" class="geekfolio-color-picker" id="' . $id . '" name="' . $id . '" value="' . get_post_meta($post->ID, $id, true) . '" />';
				$html .='</div>';
			$html .='</div>';
			echo $html;
		}
	}