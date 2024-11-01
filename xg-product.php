<?php
/********************************
 *
 * Plugin Name: WP WooCommerce Product Slider
 * Plugin URI: https://profiles.wordpress.org/xgenious
 * Description:  WP WooCommerce Product Slider is a collection of WooCommerce Product Slider with 3 unique style. it help you to create beautifully slider layout in couple of minutes. In Slider you have Quick view options , Wishlist options and also compare options. It super easy to use.
 * Version: 1.0.4
 * Author: Xgenious
 * Author URI: https://codecanyon.net/user/xgenious/
 * Text Domain: wp-woocommerce-product-slider
 * Domain Path: /languages/
 *********************************/
/**
 * @package Product Carusel
 * @version 1.0.4
 *
 **/
if ( ! defined( 'ABSPATH' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	exit;
}
/*
 * Define the base path of plugins
 * */
define( 'XGP_PATH', plugin_dir_path( __FILE__ ) );
/*
 * Define the base url of plugins
 * */
define( 'XGP_URL', plugins_url( '', __FILE__ ) );
/*
 * Define plugin version
 * */
define( 'XGP_VERSION', '1.0.4' );
/*
 * Define version plugins
 * */
function activate_xgp_product() {
	require_once XGP_PATH . '/inc/xgp-init.php';
	xgp_init::get_instance();
}

register_activation_hook( __FILE__, 'activate_xgp_product' );

if (!class_exists('Xg_product')) {
	
	Class Xg_product {

		public function __construct() {

			if ( class_exists( 'WooCommerce' ) ) {
				$this->xgp_text_domain();
				$this->xgp_load_dependency();
				xgp_quick_view::get_instace();
				xgp_product_wishlist::get_instance();
				add_action( 'wp_enqueue_scripts', array( $this, 'xgp_assets' ) );
				add_image_size('xgp_slider_thumb','300',300,true);

			}else{
				add_action( 'admin_notices', array($this,'show_notice') );
			}


		}
		public function xgp_text_domain() {
			/*
			* Load plugin text domain
			* */
			load_plugin_textdomain( 'wp-woocommerce-product-slider', null, XGP_PATH . '/languages' );
		}

		public function xgp_load_dependency() {
			/*
			* require all the dependency
			* */

			require_once( XGP_PATH . '/inc/helpers/class-xgp-helpers.php' );
			require_once( XGP_PATH . '/inc/class-xgp-quick-view.php' );
			require_once( XGP_PATH . '/inc/class-xgp-product-wishlist.php' );
			require_once( XGP_PATH . '/inc/shortcode/class-xgp-shortcode.php' );
			require_once( XGP_PATH . '/admin-modules/class-xgp-metabox.php' );
			require_once( XGP_PATH . '/admin-modules/class-xgp-admin-modules.php' );
		}

		public function xgp_assets($hook) {
			$woocommerce_base = WC()->template_path();
			$located          = locate_template( array(
				$woocommerce_base . 'wishlist.js',
				'wishlist.js'
			) );


			/*
			* Enqueue all stylesheet.
			* */
			wp_enqueue_style( 'font-awesome', XGP_URL . '/assets/css/font-awesome.css', array(), '4.7' );
			wp_enqueue_style( 'owl-carousel', XGP_URL . '/assets/css/owl.carousel.css', array(), '2.1' );
			wp_enqueue_style( 'xg-product', XGP_URL . '/assets/css/xgp-style.css', array(), XGP_VERSION );
			wp_enqueue_style( 'xg-quick-view', XGP_URL . '/assets/css/xgp-quick-view.css', array(), XGP_VERSION );
			wp_enqueue_style( 'xg-wishlist-css', XGP_URL . '/assets/css/xgp-wishlist.css', array(), XGP_VERSION );

			/*
			 * Enqueue all scripts.
			 * */

			wp_enqueue_script( 'owl-carousel', XGP_URL . '/assets/js/owl.carousel.js', array( 'jquery' ), '2.1', true );
			wp_enqueue_script( 'xgp-quick-view', XGP_URL . '/assets/js/xgp-quick-view.js', array( 'jquery' ), XGP_VERSION, true );
			wp_enqueue_script( 'xgp-wishlist', XGP_URL . '/assets/js/xgp-wishlist.js', array( 'jquery' ), XGP_VERSION, true );

			wp_localize_script( 'xgp-quick-view', 'xgp', array(
					'ajaxurl' => admin_url( 'admin-ajax.php', 'relative' )
				)
			);
			$xgp_wish_list_localize = array(
				'ajax_url'                               => admin_url( 'admin-ajax.php', 'relative' ),
				'redirect_to_cart'                       => get_option( 'xgp_wishlist_redirect_cart' ),
				'multi_wishlist'                         => get_option( 'xgp_multi_wishlist_enable', 'yes' ),
				'hide_add_button'                        => apply_filters( 'xgp_wishlist_hide_add_button', true ),
				'is_user_logged_in'                      => is_user_logged_in(),
				'remove_from_wishlist_after_add_to_cart' => get_option( 'xgp_remove_from_wishlist_after_add_to_cart' ),
				'browse_wishlist_text' => get_option('xgpw_browse_wishlist_text'),
				'actions'                                => array(
					'add_to_wishlist_action'                    => 'add_to_wishlist_ajax',
					'remove_from_wishlist_action'               => 'remove_from_wishlist',
					'move_to_another_wishlist_action'           => 'move_to_another_wishlist',
					'reload_wishlist_and_adding_element_action' => 'reload_wishlist_and_adding_element'
				)
			);
			if ( ! $located ) {
				wp_localize_script( 'xgp-wishlist', 'xgpWishlist', $xgp_wish_list_localize );
			}

		}
		public function show_notice(){
			$class = 'notice notice-error';
			$message = __( 'Please Install or active WooCommerce plugin WP WooCommerc Product Slider plugin in depend on WooCommerce plugin.', 'xg-product' );
			$message2 = __( 'You can install it form here or your plugin menu.', 'xg-product' );

			printf( '<div class="%1$s"><p>%2$s</p> <a href="%3$s">%4$s </a>%5$s</div>', esc_attr( $class ), esc_html( $message ),esc_url('https://wordpress.org/plugins/woocommerce/'),esc_html__('Woocommence','xg-product'),$message2 );
		}

	} //end class

}//end if


if (class_exists('Xg_product')) {
	new Xg_product();
}