<?php
/**
 * Initialize the Post Post Meta Boxes. 
 */
add_action( 'admin_init', 'geekfolio_page_mb' ); 
function geekfolio_page_mb() {
  
  /**
   * Create a custom meta boxes array that we pass to 
   * the reduxoptions Meta Box API Class.
   */
  $geekfolio_page_mb = array(
    'id'          => 'page_meta_box',
    'title'       => esc_html__( 'Page Settings', 'geekfolio_plg' ),
    'desc'        => '',
    'pages'       => array( 'page','portfolio','post'),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
	
	  array(
        'id'          => 'custom_footer_header_note',
        'label'       => esc_html__('Please Note', 'geekfolio_plg' ),
        'desc'        => esc_html__('The Custom Header & Custom Footer only appear on the actual page, not in elementor editor.', 'geekfolio_plg' ),
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
        'label'       => esc_html__( 'Header Settings', 'geekfolio_plg' ),
        'id'          => 'header_setting_section',
        'type'        => 'tab',
      ),
	  
	  array(
        'label'       => esc_html__( 'Header Options', 'geekfolio_plg' ),
		'desc'          =>  '',
        'id'          => 'custom_header_choice',
        'type'        => 'select',
		'std'		 => 'global',
		'choices'     => array( 
			 array(
                'value'       => 'global',
                'label'       => esc_html__( 'Use Global Settings (in Theme Options)', 'geekfolio_plg' )
              ),
			  array(
                'value'       => 'standard',
                'label'       => esc_html__( 'Use Default Header', 'geekfolio_plg' )
              ),
			  array(
                'value'       => 'custom_header',
                'label'       => esc_html__( 'Use Custom Header', 'geekfolio_plg' )
              ),
			  array(
                'value'       => 'no_header',
                'label'       => esc_html__( 'No Header', 'geekfolio_plg' )
              ),
			  
		)
      ),
	  
      array(
        'id'          => 'header_list',
        'label'       => esc_html__( 'Choose Custom Header', 'geekfolio_plg' ),
        'desc'        => '',
        'std'         => '',
		'condition'   => 'custom_header_choice:is(custom_header)',
        'type' => 'custom-post-type-select',
        'rows'        => '',
        'post_type'   => 'header',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
	  
	  array(
        'label'       => esc_html__( 'Header Format', 'geekfolio_plg' ),
		'desc'          => '',
        'id'          => 'menu_format',
        'type'        => 'select',
		'condition'   => 'custom_header_choice:is(standard)',
		'std'		 => 'head_clean',
		'choices'     => array( 
			  array(
                'value'       => 'head_clean',
                'label'       => esc_html__( 'Black Text with White Background Header in Relative Position', 'geekfolio_plg' )
              ),
			  array(
                'value'       => 'head_standard',
                'label'       => esc_html__( 'White Text with Transparent Background Header in Absolute Position', 'geekfolio_plg' )
              ),
			  
		)
      ),


	  
	  array(
        'label'       => esc_html__( 'Footer Settings', 'geekfolio_plg' ),
        'id'          => 'footer_setting_section',
        'type'        => 'tab',
      ),
 
	  array(
        'label'       => esc_html__( 'Use Custom Footer', 'geekfolio_plg' ),
		    'desc'          =>  '',
        'id'          => 'custom_footer_choice',
        'type'        => 'select',
    		'std'		 => 'global',
    		'choices'     => array( 
    			  array(
                    'value'       => 'global',
                    'label'       => esc_html__( 'Use Global Settings (in Theme Options) Footer', 'geekfolio_plg' )
                  ),
    			  array(
                    'value'       => 'standard',
                    'label'       => esc_html__( 'Use Default Footer', 'geekfolio_plg' )
                  ),
    			  array(
                    'value'       => 'custom_footer',
                    'label'       => esc_html__( 'Use Custom Footer', 'geekfolio_plg' )
                  ),
    			  array(
                    'value'       => 'no_footer',
                    'label'       => esc_html__( 'No Footer', 'geekfolio_plg' )
                  ),
    			  
    		)
      ),
	  
	
	  
	  array(
        'id'          => 'footer_list',
        'label'       => esc_html__( 'Choose Custom Footer', 'geekfolio_plg' ),
        'desc'        => '',
        'std'         => '',
    		'condition'   => 'custom_footer_choice:is(custom_footer)',
            'type' => 'custom-post-type-select',
            'rows'        => '',
            'post_type'   => 'footer',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => ''
          ),
	  
     ),

    array(
        'label'       => esc_html__( 'side panel Settings', 'geekfolio_plg' ),
        'id'          => 'sidepanel_setting_section',
        'type'        => 'tab',
      ),
    array(
        'label'       => esc_html__( 'Use Custom sidepanel', 'geekfolio_plg' ),
        'desc'          =>  '',
        'id'          => 'custom_sidepanel_choice',
        'type'        => 'select',
        'std'    => 'global',
        'choices'     => array( 
            array(
                    'value'       => 'global',
                    'label'       => esc_html__( 'Use Global Settings (in Theme Options) sidepanel', 'geekfolio_plg' )
                  ),
            array(
                    'value'       => 'standard',
                    'label'       => esc_html__( 'Use Default Footer', 'geekfolio_plg' )
                  ),
            array(
                    'value'       => 'custom_sidepanel',
                    'label'       => esc_html__( 'Use Custom Footer', 'geekfolio_plg' )
                  ),
            array(
                    'value'       => 'no_sidepanel',
                    'label'       => esc_html__( 'No sidepanel', 'geekfolio_plg' )
                  ),
            
        )
      ),
    array(
        'id'          => 'sidepanel_list',
        'label'       => esc_html__( 'Choose Custom sidepanel', 'geekfolio_plg' ),
        'desc'        => '',
        'std'         => '',
        'condition'   => 'custom_sidepanel_choice:is(custom_sidepanel)',
            'type' => 'custom-post-type-select',
            'rows'        => '',
            'post_type'   => 'sidepanel',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => ''
          ),

  );

}

