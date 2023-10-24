<?php
/**
 * Metabox Class Fill.
 *
 * @package Geekfolio
 */
?>
<?php
/**
 * Calls the class on the post edit screen.
 */
defined('GEEKFOLIO_ADDONS_ROOT') or define('GEEKFOLIO_ADDONS_ROOT', dirname(__FILE__));
defined('GEEKFOLIO_ADDONS_CUSTOM_POST_TYPE') or define('GEEKFOLIO_ADDONS_CUSTOM_POST_TYPE', dirname(__FILE__).'/custom-post-type');
defined('GEEKFOLIO_ADDONS_ROOT_DIR') or define('GEEKFOLIO_ADDONS_ROOT_DIR', plugins_url().'/geekfolio_plugin');


function Geekfolio_Meta_Boxes() 
{
    new geekfolioMetaboxes();
}

	if ( is_admin() ) {
	    add_action( 'load-post.php', 'Geekfolio_Meta_Boxes' );
	    add_action( 'load-post-new.php', 'Geekfolio_Meta_Boxes' );
	}


/** 
 * The geekfolioMetaboxes Class.
 */
class geekfolioMetaboxes {

	/**
	 * Hook into the appropriate actions when the class is constructed.
	 */
	public function __construct() {
		$this->geekfolio_metabox_addons();
		add_action( 'add_meta_boxes', array( $this, 'geekfolio_add_meta_boxs' ) );
		add_action( 'save_post', array( $this, 'geekfolio_save_meta_box' ) );
		add_action('admin_enqueue_scripts', array($this, 'admin_script_loader'));

		/* Portfolio */
		add_action( 'add_meta_boxes', array( $this, 'geekfolio_add_meta_boxs_portfolios' ) );
	}

	/**
	 * Adds the meta box functions container.
	 */
	public function geekfolio_metabox_addons(){
		include('meta-box-maps.php'); 
	}

	/**
	 * Adds the meta box container.
	 */
	public function geekfolio_add_meta_boxs( $geekfolio_post_type ) {
		$geekfolio_post_types = array('post', 'page', 'portfolio','product');    //limit meta box to certain post types
		$flag = false;
        if ( in_array( $geekfolio_post_type, $geekfolio_post_types )){
           	$flag = true;
        }
        if($flag == true){
	        $this->geekfolio_add_meta_box('geekfolio_admin_options', 'Geekfolio '.ucfirst($geekfolio_post_type).' Settings', $geekfolio_post_type);
	    }

	}

	public function geekfolio_add_meta_box($geekfolio_id, $geekfolio_label_name, $geekfolio_post_type)
	{
		add_meta_box(
			$geekfolio_id
			,$geekfolio_label_name
			,array( $this, $geekfolio_id )
			,$geekfolio_post_type
			
		);
	}

	public function geekfolio_admin_options()
	{
		global $post;
		if($post->post_type == 'page' || $post->post_type == 'portfolio' || $post->post_type == 'product'){
			$geekfolio_tabs_title = array('General Settings', 'Header Settings', 'Footer','Sidepanel');
			$geekfolio_tabs_sub_title = array('General configuration settings', 'Header section configuration settings', 'Enable/Disable comments in '.$post->post_type, 'Footer section configuration settings', 'Sidepanel section configuration settings');
			$geekfolio_page_tabs = array('General Settings', 'Header Settings', 'Footer','Sidepanel');
			$geekfolio_page_tab_content = array('general','header', 'footer','sidepanel');
		}elseif($post->post_type == 'post'){
			$geekfolio_tabs_title = array('General Settings', 'Header Settings', 'Footer','Sidepanel','Post');
			$geekfolio_tabs_sub_title = array('General configuration settings', 'Header section configuration settings', 'Enable/Disable comments in '.$post->post_type, 'Footer section configuration settings', 'Sidepanel section configuration settings', 'Post section configuration settings');
			$geekfolio_page_tabs = array('General Settings', 'Header Settings', 'Footer','Sidepanel','Post');
			$geekfolio_page_tab_content = array('general','header', 'footer','sidepanel','post');
		}else{
			$geekfolio_tabs_title = array('General Settings','Header Settings', 'Footer Settings','Sidepanel Settings');
			$geekfolio_tabs_sub_title = array( 'General configuration settings','Header section configuration settings', 'Enable/Disable comments in page', 'Footer section configuration settings', 'Sidepanel section configuration settings');
			$geekfolio_page_tabs = array( 'General Settings','Header Settings', 'Footer Settings','Sidepanel Settings');
			$geekfolio_page_tab_content = array('general','header','footer','sidepanel');
		}

		$geekfolio_icon_class = array('icon-gears','fa fa-header', 'el-icon-website', 'fa fa-align-left', 'fa fa-server', 'el-icon-website icon-rotate', 'fa fa-list-alt');
		echo '<ul class="geekfolio_meta_box_tabs">';
		$geekfolio_icon = 0;
		$geekfolio_showicon = '';
			foreach( $geekfolio_page_tabs as $tab_key => $tab_name ) {
				if($geekfolio_icon_class){
					$geekfolio_showicon = '<i class="'.esc_attr($geekfolio_icon_class[$geekfolio_icon]).'"></i>';
				}
				echo '<li class="geekfolio_tab_'.$geekfolio_page_tab_content[$tab_key].'"><a href="'.esc_url($tab_name).'">'.$geekfolio_showicon.'<span class="group_title">'.esc_attr($tab_name).'</span></a></li>';
				$geekfolio_icon++;
			}
		echo '</ul>';

		echo '<div class="geekfolio_meta_box_tab_content">';
		foreach( $geekfolio_page_tab_content as $tab_content_key => $tab_content_name ) {
			echo '<div class="geekfolio_meta_box_tab" id="geekfolio_tab_'.esc_attr($tab_content_name).'">';
				echo "<div class='main_tab_title'>";
					echo "<h3>".$geekfolio_tabs_title[$tab_content_key]."</h3>";
					echo "<span class='description'>".$geekfolio_tabs_sub_title[$tab_content_key]."</span>";
				echo "</div>";
				include('metabox-tabs/metabox_'.$tab_content_name.'.php'); 
			echo '</div>';
		}
		echo '</div>';
		echo '<div class="clear"></div>';
	}


	/**
	 * Adds the meta box for Portfolio. 
	 */
	public function geekfolio_add_meta_boxs_portfolios( $geekfolio_post_type ) 
	{
		$geekfolio_post_types = array('portfolio','post');     //limit meta box to certain post types
		$flag = false;
        if ( in_array( $geekfolio_post_type, $geekfolio_post_types )){
           	$flag = true;
        }
        if($flag == true){
	        $this->geekfolio_add_meta_box('geekfolio_admin_options_single', 'Geekfolio '.ucfirst($geekfolio_post_type).' Format Settings', $geekfolio_post_type);
	    }

	}

	public function geekfolio_add_meta_boxs_portfolio($geekfolio_id, $geekfolio_label_name, $geekfolio_post_type)
	{
		add_meta_box(
			$geekfolio_id
			,$geekfolio_label_name
			,array( $this, $geekfolio_id )
			,$geekfolio_post_type
			,'advanced'
			,'high'
		);
	}

	public function geekfolio_admin_options_single()
	{
        global $post;
		echo '<div class="geekfolio_meta_box_tab_content_single">';
			echo '<div class="geekfolio_meta_box_tab" id="geekfolio_tab_single">';
		
		echo '</div>';
		if($post->post_type == 'portfolio'):
                include('metabox-tabs/metabox_portfolio_setting.php' );
                endif;
		echo '</div>';
		echo '<div class="clear"></div>';
	}

	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function geekfolio_save_meta_box( $geekfolio_post_id ) {
	
		// If this is an autosave, our form has not been submitted,
        // so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $geekfolio_post_id;

		/* OK, its safe for us to save the data now. */
		$geekfolio_data = array();
		foreach ( $_POST as $key => $value ) {
			if ( strstr( $key, 'geekfolio_') ) {
				// Sanitize the user input.
				$geekfolio_data = sanitize_text_field( $_POST[$key] );
				// Update the meta field.
				update_post_meta( $geekfolio_post_id, $key, $geekfolio_data );
			}
		}
	}

	function admin_script_loader() {
		
		global $pagenow;
		if( is_admin() && ( $pagenow=='post-new.php' || $pagenow=='post.php' ) ) {
			wp_enqueue_script('media-upload'); 
			wp_enqueue_script('thickbox');
	   		wp_enqueue_style('thickbox');
	   		wp_enqueue_style( 'wp-color-picker' );
    		wp_enqueue_script( 'wp-color-picker');
    		wp_register_script('alpha-color-picker', GEEKFOLIO_ADDONS_ROOT_DIR.'/meta-box/js/alpha-color-picker.js', array('jquery', 'wp-color-picker'), '1.0' );
		   	wp_enqueue_script('alpha-color-picker');
		   	wp_register_style('alpha-color-picker', GEEKFOLIO_ADDONS_ROOT_DIR.'/meta-box/css/alpha-color-picker.css', array('wp-color-picker'), '1.0' );
		   	wp_enqueue_style('alpha-color-picker');
	   		wp_register_script('geekfolio-admin-metabox-cookie-js', GEEKFOLIO_ADDONS_ROOT_DIR.'/meta-box/js/metabox-cookie.js', array('jquery'), '1.0' );
	   		wp_enqueue_script('geekfolio-admin-metabox-cookie-js');
	   		wp_register_script('geekfolio-admin-metabox-js', GEEKFOLIO_ADDONS_ROOT_DIR.'/meta-box/js/meta-box.js', array('jquery'), '1.0' );
			wp_enqueue_script('geekfolio-admin-metabox-js');
	   		wp_register_style('geekfolio-admin-metabox-css', GEEKFOLIO_ADDONS_ROOT_DIR.'/meta-box/css/meta-box.css',null, '1.0' );
	   		wp_enqueue_style('geekfolio-admin-metabox-css');
		}
	}
}