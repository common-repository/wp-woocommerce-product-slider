<?php
if ( ! defined( 'ABSPATH' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	exit;
}

Class xgp_admin_modules{

	public $instance;

	public function instance(){

	}
	public function __construct() {

		add_action('admin_menu',array($this,'xgp_admin_menu'));
		add_action( 'init', array($this,'xgp_register_post_type'), 0 );
		add_filter('manage_xg-product-slider_posts_columns',array($this,'xgp_add_custom_column'));
		add_action('manage_xg-product-slider_posts_custom_column',array($this,'xgp_add_custom_column_content'));
		add_action('admin_enqueue_scripts',array($this,'xgp_admin_assets'));
		add_action('admin_init',array($this,'xgp_register_settings'));
	}
	public function xgp_admin_assets($page){
		global $post_type;
		if ('xg-product-slider' == $post_type){
			wp_enqueue_style('xgp-product-admin-css',XGP_URL .'/admin-modules/assets/css/xgp-product-admin.css',null,XGP_VERSION);
			wp_enqueue_script('xgp-product-admin-js',XGP_URL.'/admin-modules/assets/js/xgp-product-admin.js',array('jquery'),XGP_VERSION,true);
		}
		if ($page == 'post-new.php' || $page == 'post.php'){
			if ( 'xg-product-slider' == $post_type ){
				wp_enqueue_style( 'xgp-metabox-css', XGP_URL . '/admin-modules/assets/css/xgp-metabox.css', array(), XGP_VERSION );
				wp_enqueue_style('wp-color-picker');
				wp_enqueue_script('xgp-metabox-js',XGP_URL.'/admin-modules/assets/js/xgp_metabox.js',array('jquery','jquery-ui-core','jquery-ui-tabs','wp-color-picker'),XGP_VERSION,true);
			}
		}

	}
	/*
	 * all admin menu and submenu register
	 * */
	public function xgp_admin_menu(){
		$menu = add_menu_page('XG Woocommerce Product Carousel','XG Product','manage_options','xgp-product-page',array($this,'xgp_admin_menu_display'),XGP_URL.'/assets/icons/menu-icon.png',67);
		//sub menu
		$submenu = add_submenu_page('xgp-product-page',__('Quick View Settings','xg-product'),__('Quick View','xg-product'),'manage_options','xgp-quick-view-setup',array($this,'xgp_quick_view_display'));
		$wishlist = add_submenu_page('xgp-product-page',__('Wishlist Settings','xg-product'),__('Wishlist','xg-product'),'manage_options','xgp-wishlist-setup',array($this,'xgp_wishlist_display'));
		$help = add_submenu_page('xgp-product-page',__('Features & Help','xg-product'),__('Features & Help','xg-product'),'manage_options','xgp-help',array($this,'xgp_help_display'));

		add_action( 'admin_print_styles-' . $submenu, array($this,'admin_page_style') );
		add_action( 'admin_print_styles-' . $wishlist, array($this,'admin_page_style') );
		add_action( 'admin_print_styles-' . $help, array($this,'admin_page_style') );

		add_action( 'admin_print_scripts-' . $submenu, array($this,'admin_page_script') );
		add_action( 'admin_print_scripts-' . $wishlist, array($this,'admin_page_script') );
		add_action( 'admin_print_scripts-' . $help, array($this,'admin_page_script') );
	}
	public function xgp_register_post_type(){
		$labels = array(
			'name'                => _x( 'Product Slider', 'Post Type General Name', 'xg-product' ),
			'singular_name'       => _x( 'Slider', 'Post Type Singular Name', 'xg-product' ),
			'menu_name'           => __( 'Sliders', 'xg-product' ),
			'all_items'           => __( 'All Sliders', 'xg-product' ),
			'view_item'           => __( 'View Slider', 'xg-product' ),
			'add_new_item'        => __( 'Add New Slider', 'xg-product' ),
			'add_new'             => __( 'Add New', 'xg-product' ),
			'edit_item'           => __( 'Edit Slider', 'xg-product'),
			'update_item'         => __( 'Update Slider', 'xg-product' ),
			'search_items'        => __( 'Search Slider', 'xg-product' ),
			'not_found'           => __( 'Not Found', 'xg-product' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'xg-product' ),
		);
		$args = array(
			'label' => __('Sliders','xg-product'),
			'description' => __('WooCommerce Product Slider','xp-product'),
			'labels' => $labels,
			'supports' => array('title'),
			'hierarchical'        => false,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => 'xgp-product-page',
			'can_export'          => true,
			'capability_type'     => 'page',
			'query_var' => false

		);
		register_post_type('xg-product-slider',$args);
	}

	public function  xgp_admin_menu_display(){}
	public function  xgp_quick_view_display(){
		require_once XGP_PATH .'/admin-modules/partials/xgp-quick-view-display.php';
	}
	public function  xgp_wishlist_display(){
		require_once XGP_PATH .'/admin-modules/partials/xgp-wishlist-display.php';
	}
	public function  xgp_help_display(){
		require_once XGP_PATH .'/admin-modules/partials/xgp-help-display.php';
	}
	/*
	 * register settings for product quick view page
	 * */
	public function xgp_register_settings(){
		//register setting for quick view modal typography
		register_setting('xgp_quick_view_options','qvt_title_font_size',array('sanitize_callback','esc_attr'));
		register_setting('xgp_quick_view_options','qvt_price_font_size',array('sanitize_callback','esc_attr'));
		register_setting('xgp_quick_view_options','qvt_descr_font_size',array('sanitize_callback','esc_attr'));
		register_setting('xgp_quick_view_options','qvt_btn_font_size',array('sanitize_callback','esc_attr'));
		register_setting('xgp_quick_view_options','qvt_meta_font_size',array('sanitize_callback','esc_attr'));
		register_setting('xgp_quick_view_options','qvt_tag_font_size',array('sanitize_callback','esc_attr'));

		//register settings for wishlist page
		register_setting('xgp_wishlist_general','xgpw_title',array('sanitize_callback'=>'sanitize_text_field'));
		register_setting('xgp_wishlist_general','xgpw_wishlist_page',array('sanitize_callback'=>array($this,'sanitize_page_options')));
		register_setting('xgp_wishlist_general','xgpw_browse_wishlist_text',array('sanitize_callback'=> 'sanitize_text_field'));
		register_setting('xgp_wishlist_general','xgpw_already_in_wishlist_text',array('sanitize_callback'=> 'sanitize_text_field'));
		register_setting('xgp_wishlist_general','xgpw_added_in_wishlist_text',array('sanitize_callback'=>'sanitize_text_field'));




	}
	public function sanitize_page_options($input){
		if (isset($_POST['xgpw_wishlist_page']) && !empty($_POST['xgpw_wishlist_page'])){
			return $_POST['xgpw_wishlist_page'];
		}else{
			return '';
		}
	}
	/*
	 * add custom column for xg product post type
	 * @param $column (array)
	 * @return array of filter column
	 * */
	public function xgp_add_custom_column($column){
		$new_columns['cb']        = '<input type="checkbox" />';
		$new_columns['title']     = __( 'Slider Title', 'xg-product' );
		$new_columns['shortcode'] = __( 'Shortcode', 'xg-product' );
		$new_columns['']          = '';
		$new_columns['date']      = __( 'Date', 'xg-product' );

		return $new_columns;
	}
	/*
	 * add custom column content
	 * */
	public function xgp_add_custom_column_content($column){
		global $post;
		$post_id = $post->ID;
		switch ( $column ){
			case 'shortcode':
				$column_field = '<div class="xgp-shortcode-element-field"><input class="xgp_shotcode_wrapper" type="text" id="xgp_shotcode_wrapper" readonly="readonly" value="[xgpp__slider  ' . 'id=&quot;' . $post_id . '&quot;' . ']"/><span class="icon">Copy</span></div>';
				echo $column_field;
			break;

		}
	}
	public function admin_page_style(){
		wp_enqueue_style('xgp-product-admin-css',XGP_URL .'/admin-modules/assets/css/xgp_admin.css',null,XGP_VERSION);
		wp_enqueue_style('xgp-flaticon-css',XGP_URL .'/admin-modules/assets/css/flaticon.css',null,XGP_VERSION);
		wp_enqueue_style('wp-color-picker');
	}
	public function admin_page_script(){
		wp_enqueue_script('jquery-ui-tabs', null, array('jquery-ui-core', 'jquery'), null, false);
		wp_enqueue_script('xgp-admin-js',XGP_URL.'/admin-modules/assets/js/xgp_admin.js',array('jquery','wp-color-picker'),XGP_VERSION,true);
	}

}
new xgp_admin_modules();
