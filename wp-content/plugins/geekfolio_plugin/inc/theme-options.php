<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'geekfolio_plg_custom_theme_options' );

/**
 * Build the custom settings & update reduxoptions.
 */
function geekfolio_plg_custom_theme_options() {
  
  /* reduxoptions is not loaded yet */
  if ( ! function_exists( 'ot_settings_id' ) )
    return false;
    
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( ot_settings_id(), array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the reduxoptions Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'general',
        'title'       => esc_html__('General Setting', 'geekfolio_plg' )
      ),
	  array(
        'id'          => 'social_icon_section',
        'title'       => esc_html__('Social Icon Setting', 'geekfolio_plg' )
      ),
   

	  array(
        'id'          => 'page_sections_setting',
        'title'       => esc_html__('Page Setting', 'geekfolio_plg' )
      ),
	  array(
        'id'          => 'header_section',
        'title'       => esc_html__('Header Setting', 'geekfolio_plg' )
      ),
	  array(
        'id'          => 'footer_section',
        'title'       => esc_html__('Footer Setting', 'geekfolio_plg' )
      ),

	  
    ),
    'settings'        => array( 

	  array(
        'id'          => 'style_tab',
        'label'       => esc_html__('Style Setting', 'geekfolio_plg' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  
	  array(
        'id'          => 'style_text_mention',
        'label'       => esc_html__('Please Note:', 'geekfolio_plg' ),
        'desc'        => esc_html__('Most of the color scheme/settings below only affect on the element/page that not using the elementor page builder.', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'textblock-titgeekfolio',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'color_general',
        'label'       => esc_html__('Color Scheme', 'gehou_plg' ),
        'desc'        => esc_html__('Pick your color scheme. Default color is #eb2f5b ', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'color_scheme',
        'label'       => esc_html__('Hyperlink Color', 'geekfolio_plg' ),
        'desc'        => esc_html__('Pick your color for hyperlink. Default color is black #999999', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  
	  array(
        'id'          => 'custom_hovers',
        'label'       => esc_html__('Hyperlink color on hover state', 'geekfolio_plg' ),
        'desc'        => esc_html__('Pick your color for hover state in hyperlink. Default color is #eb2f5b', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'heading_color',
        'label'       => esc_html__('Color on Heading', 'geekfolio_plg' ),
        'desc'        => esc_html__('Pick your color for heading text. Default color is black #000000', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'general_color',
        'label'       => esc_html__('Color on General Paragraph', 'geekfolio_plg' ),
        'desc'        => esc_html__('Pick your color for general paragraph text. Default color is black #939393', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

	  
	  
      array(
        'id'          => 'logo_tab',
        'label'       => esc_html__('Logo', 'geekfolio_plg' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'logo_img',
        'label'       => esc_html__('Logo White Text Upload', 'geekfolio_plg' ),
        'desc'        => esc_html__('Upload your logo for white text (standard) header.<br> Recommended size 240x80px', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'logo_black',
        'label'       => esc_html__('Logo Black Text Upload', 'geekfolio_plg' ),
        'desc'        => esc_html__('Upload your logo only for black text (standard) header here.<br> Recommended size 240x80px', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  
      array(
        'id'          => 'preload_tab',
        'label'       => esc_html__('Preloader', 'geekfolio_plg' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'preloader_set',
        'label'       => esc_html__('Preloader Setting', 'geekfolio_plg' ),
        'desc'        => esc_html__('Choose Loader setting', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'show_home',
            'label'       => esc_html__('Show in Homepage only', 'geekfolio_plg' ),
            'src'         => ''
          ),
          array(
            'value'       => 'show_all',
            'label'       => esc_html__('Show in All pages', 'geekfolio_plg' ),
            'src'         => ''
          ),
          array(
            'value'       => 'hide_in_all',
            'label'       => esc_html__('Hide in All Pages', 'geekfolio_plg' ),
            'src'         => ''
          )
        )
      ),

      array(
        'id'          => 'loader_color',
        'label'       => esc_html__('Preloader Background Color', 'geekfolio_plg' ),
        'desc'        => esc_html__('Choose your background color for preloader', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'soc_head',
        'label'       => esc_html__('Social icon on Header', 'geekfolio_plg' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'soc_tabhead_text',
        'label'       => esc_html__('Set your social icon here.', 'geekfolio_plg' ),
        'desc'        => esc_html__('This social icon list will appear on the (standard)header. <br/>Recommended only use max 4 social icon on header to prevent any error layout in menu.', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'textblock-titgeekfolio',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'fb_head',
        'label'       => esc_html__('Facebook Link', 'geekfolio_plg' ),
        'desc'        => esc_html__('Input facebook link here', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'gp_head',
        'label'       => esc_html__('Google Plus Link', 'geekfolio_plg' ),
        'desc'        => esc_html__('Input google plus link here', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'twit_head',
        'label'       => esc_html__('Twitter Link', 'geekfolio_plg' ),
        'desc'        => esc_html__('Input twitter link here', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'pint_head',
        'label'       => esc_html__('Pinterest Link', 'geekfolio_plg' ),
        'desc'        => esc_html__('Input pinterest link here', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'insta_head',
        'label'       => esc_html__('Instagram Link', 'geekfolio_plg' ),
        'desc'        => esc_html__('Input instagram link here', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'xing_head',
        'label'       => esc_html__('Xing Link', 'geekfolio_plg' ),
        'desc'        => esc_html__('Input xing link here', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'head_as_icon',
        'label'       => esc_html__('Another Social Icon', 'geekfolio_plg' ),
        'desc'        => esc_html__('Create list for another social icon.', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array( 
          array(
            'id'          => 'head_soc_icon',
            'label'       => esc_html__('Social Icon', 'geekfolio_plg' ),
            'desc'        => esc_html__('Input your social icon here. <br /> You can check <a target="_blank" href="https://fontawesome.com/v4.7.0/icons/">Here</a> for icon list. eg. fa-github', 'geekfolio_plg' ),
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'head_as_link',
            'label'       => esc_html__('Social Icon Link', 'geekfolio_plg' ),
            'desc'        => esc_html__('Input social icon link here', 'geekfolio_plg' ),
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
	  array(
        'id'          => 'soc_foot',
        'label'       => esc_html__('Social Icon on Footer', 'geekfolio_plg' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'soc_tab_text',
        'label'       => esc_html__('Set your social icon here.', 'geekfolio_plg' ),
        'desc'        => esc_html__('This social icon list will appear on the (standard)footer.', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'textblock-titgeekfolio',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'fb_foot',
        'label'       => esc_html__('Facebook Link', 'geekfolio_plg' ),
        'desc'        => esc_html__('Input facebook link here', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'gp_foot',
        'label'       => esc_html__('Google Plus Link', 'geekfolio_plg' ),
        'desc'        => esc_html__('Input google plus link here', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'twit_foot',
        'label'       => esc_html__('Twitter Link', 'geekfolio_plg' ),
        'desc'        => esc_html__('Input twitter link here', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'pint_foot',
        'label'       => esc_html__('Pinterest Link', 'geekfolio_plg' ),
        'desc'        => esc_html__('Input pinterest link here', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'insta_link',
        'label'       => esc_html__('Instagram Link', 'geekfolio_plg' ),
        'desc'        => esc_html__('Input instagram link here', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'xing_foot',
        'label'       => esc_html__('Xing Link', 'geekfolio_plg' ),
        'desc'        => esc_html__('Input xing link here', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'foot_as_icon',
        'label'       => esc_html__('Another Social Icon', 'geekfolio_plg' ),
        'desc'        => esc_html__('Create list for another social icon.', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'social_icon_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array( 
          array(
            'id'          => 'foot_soc_icon',
            'label'       => esc_html__('Social Icon', 'geekfolio_plg' ),
            'desc'        => esc_html__('Input your social icon here. <br /> You can check <a target="_blank" href="https://fontawesome.com/v4.7.0/icons/">Here</a> for icon list. eg. fa-github', 'geekfolio_plg' ),
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'foot_as_link',
            'label'       => esc_html__('Social Icon Link', 'geekfolio_plg' ),
            'desc'        => esc_html__('Input social icon link here', 'geekfolio_plg' ),
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
	  
	  
	   array(
        'id'          => 'header_set',
        'label'       => esc_html__('Header Setting(global)', 'geekfolio_plg' ),
        'desc'        => esc_html__('Choose Header type for all pages but you still can set different/overwrite header type for specific page in page settings.<br/><strong>Standard Header</strong> is Black text with white background header in relative position.', 'geekfolio_plg' ),
        'std'         => 'default',
        'type'        => 'select',
        'section'     => 'header_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'default',
            'label'       => esc_html__('Standard Header', 'geekfolio_plg' ),
            'src'         => ''
          ),
          array(
            'value'       => 'custom',
            'label'       => esc_html__('Custom Header', 'geekfolio_plg' ),
            'src'         => ''
          ),
        )
      ),
	  array(
        'id'          => 'header_set_list',
        'label'       => esc_html__( 'Choose Custom Header', 'geekfolio_plg' ),
        'desc'        => '',
        'std'         => '',
		'section'     => 'header_section',
		'condition'   => 'header_set:is(custom)',
        'type' => 'custom-post-type-select',
        'rows'        => '',
        'post_type'   => 'header',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
	  
	  array(
        'id'          => 'stick_menu',
        'label'       => esc_html__('Sticky Menu Background color (for menu with black background & All Sticky Custom Menu)', 'geekfolio_plg' ),
        'desc'        => esc_html__('Pick your background color for sticky menu in white text header. Default color is #1f1f1f', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'header_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  
	  array(
        'id'          => 'stick_menu2',
        'label'       => esc_html__('Sticky Menu Background color (for menu with white background)', 'geekfolio_plg' ),
        'desc'        => esc_html__('Pick your background color for sticky menu in white text header. Default color is #ffffff', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'header_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  
	  array(
        'id'          => 'footer_set',
        'label'       => esc_html__('Footer Setting(global)', 'geekfolio_plg' ),
        'desc'        => esc_html__('Choose Footer type for all pages but you still can set different/overwrite footer type for specific page in page settings.', 'geekfolio_plg' ),
        'std'         => 'default',
        'type'        => 'select',
        'section'     => 'footer_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'default',
            'label'       => esc_html__('Standard Footer', 'geekfolio_plg' ),
            'src'         => ''
          ),
          array(
            'value'       => 'custom',
            'label'       => esc_html__('Custom Footer', 'geekfolio_plg' ),
            'src'         => ''
          ),
        )
      ),
	  array(
        'id'          => 'footer_set_list',
        'label'       => esc_html__( 'Choose Custom Footer', 'geekfolio_plg' ),
        'desc'        => '',
        'std'         => '',
		'section'     => 'footer_section',
		'condition'   => 'footer_set:is(custom)',
        'type' => 'custom-post-type-select',
        'rows'        => '',
        'post_type'   => 'footer',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
	  
	  array(
        'id'          => 'footer_color',
        'label'       => esc_html__('Standard Footer Background color', 'geekfolio_plg' ),
        'desc'        => esc_html__('Pick your background color for standard footer. Default color is black #000000', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'footer_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'operator'    => 'and'
      ),
	 
	  array(
        'id'          => 'foot_img',
        'label'       => esc_html__('Standard Footer Image', 'geekfolio_plg' ),
        'desc'        => esc_html__('Upload your footer image for standard footer here. Recommended size 240x120px', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'footer_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'fot_text',
        'label'       => esc_html__('Standard Footer Text', 'geekfolio_plg' ),
        'desc'        => esc_html__('Input standard footer text here.', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'textarea',
		'rows'        => '2',
        'section'     => 'footer_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'footer_set:is(default)',
        'operator'    => 'and'
      ),
	  
	  
	  
	  
	
	
	  


	 array(
        'id'          => 'port_tab',
        'label'       => esc_html__('Portfolio Page', 'geekfolio_plg' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'page_sections_setting',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'portfolios_all',
        'label'       => esc_html__('Portfolio Text Filter for all categories', 'geekfolio_plg' ),
        'desc'        => esc_html__('Insert your text for portfolio filter for all categories. The default text is "All"', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'page_sections_setting',
        'rows'        => '3',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	 
	   array(
        'id'          => 'other_port_title',
        'label'       => esc_html__( 'Other Portfolio Section Title', 'geekfolio_plg' ),
        'desc'        => esc_html__( 'Insert your text for title of other portfolio section on single portfolio page.<br/>Leave it blank if you want to use the default text.', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'page_sections_setting',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'other_port_sub',
        'label'       => esc_html__( 'Other Portfolio Section Subtitle', 'geekfolio_plg' ),
        'desc'        => esc_html__( 'Insert your text for subt title of other portfolio section on single portfolio page.<br/>Leave it blank if you want to use the default text.', 'geekfolio_plg' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'page_sections_setting',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'blog_tab',
        'label'       => esc_html__('Blog Page', 'geekfolio_plg' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'page_sections_setting',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

	  
	  array(
        'id'          => 'blog_slide_delay',
        'label'       => esc_html__( 'Blog Slider Delay', 'geekfolio_plg' ),
        'desc'        => esc_html__( 'Insert the slider delay for slider in blog sidebar,blog wide and single blog post here. The default value 8000', 'geekfolio_plg' ),
        'std'         => '8000',
        'type'        => 'numeric-slider',
        'section'     => 'page_sections_setting',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '1,10000,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'related_image',
        'label'       => esc_html__('Featured Image in Related Posts', 'geekfolio_plg' ),
        'desc'        => esc_html__('Hide/show featured image in related posts', 'geekfolio_plg' ),
        'std'         => 'hide',
        'type'        => 'select',
        'section'     => 'page_sections_setting',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'hide',
            'label'       => esc_html__('Hide', 'geekfolio_plg' ),
            'src'         => ''
          ),
          array(
            'value'       => 'show',
            'label'       => esc_html__('Show', 'geekfolio_plg' ),
            'src'         => ''
          )
        )
      ),
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings ); 
  }
  
  /* Lets reduxoptions know the UI Builder is being overridden */
  global $ot_has_custom_theme_options;
  $ot_has_custom_theme_options = true;
  
}