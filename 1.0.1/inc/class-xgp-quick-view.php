<?php
/*
 * this class is responsible for displaying quick view of product item
 * */

Class xgp_quick_view{
	/*
	 * single instance of this class
	 * */
	protected static $instance;

	public static function get_instace(){
		if (is_null(self::$instance)){
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function __construct() {
		self::all_action();
	}

	public function all_action(){
		//add action for ajax request
		add_action( 'wp_ajax_xgp_load_product_quick_view', array( $this, 'xgp_load_product_quick_view_ajax' ) );
		add_action( 'wp_ajax_nopriv_xgp_load_product_quick_view', array( $this, 'xgp_load_product_quick_view_ajax' ) );

		//add action for adding product modal
		add_action('wp_footer',array($this,'xgp_quick_view_modal'));

		//image
		add_action( 'xgp_product_image', 'woocommerce_show_product_sale_flash', 10 );
		add_action( 'xgp_product_image', 'woocommerce_show_product_images', 20 );

		// Summary
		add_action( 'xgp_product_summery', 'woocommerce_template_single_title', 5 );
		add_action( 'xgp_product_summery', 'woocommerce_template_single_rating', 10 );
		add_action( 'xgp_product_summery', 'woocommerce_template_single_price', 15 );
		add_action( 'xgp_product_summery', 'woocommerce_template_single_excerpt', 20 );
		add_action( 'xgp_product_summery', 'woocommerce_template_single_add_to_cart', 25 );
		add_action( 'xgp_product_summery', 'woocommerce_template_single_meta', 30 );
	}
	public  function  xgp_load_product_quick_view_ajax(){
		if ( ! isset( $_REQUEST['product_id'] ) ) {
			wp_die();
		}
		global $sitepress;
		$product_id = intval($_REQUEST['product_id']);
		/**
		 * WPML Suppot:  Localize Ajax Call
		 */
		$lang = isset( $_REQUEST['lang'] ) ? $_REQUEST['lang'] : '';
		if( defined( 'ICL_LANGUAGE_CODE' ) && $lang && isset( $sitepress ) ) {
			$sitepress->switch_lang( $lang, true );
		}
		// set the main wp query for the product
		wp( 'p=' . $product_id . '&post_type=product' );
		// remove product thumbnails gallery
		remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
		ob_start();
		// load content template
		wc_get_template( 'xgp-quick-view-content.php', array(), '', XGP_PATH . 'templates/' );
		echo ob_get_clean();
		wp_die();
	}
	public function xgp_quick_view_modal(){
		wc_get_template('xgp-quick-view.php',array(),'',XGP_PATH.'templates/');
	}
}


