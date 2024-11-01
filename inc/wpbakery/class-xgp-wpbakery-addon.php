<?php
/**
 * @package Product Carusel
 * @version 1.0.0
 *
 **/
if ( ! defined( 'ABSPATH' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	exit;
}

// Element Class
class xgp_product extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'xgp_product_mapping' ) );
		add_shortcode( 'xgp_product', array( $this, 'xgp_product_shortcode' ) );
	}


	// Element Mapping
	public function xgp_product_mapping() {

		// Stop all if VC is not enabled
		if ( ! defined( 'WPB_VC_VERSION' ) ) {
			return;
		}

		// Map the block with vc_map()
		vc_map(
			array(
				'name'        => __( 'xg Product Carousel', 'wp-woocommerce-product-slider'),
				'base'        => 'xgp_product',
				'description' => __( 'Woocommerce product carousel collection by xgenious.', 'wp-woocommerce-product-slider'),
				'category'    => __( 'Xp Product Slider', 'wp-woocommerce-product-slider'),
				'icon'        => XGP_URL . '/assets/img/icon-01.png',
				'controls'    => 'full',
				'params'      => array(

					array(
						'type' => 'xg_product_slider',
						'heading'     => __( 'Select Xg Product Slider Shortcode', 'wp-woocommerce-product-slider'),
						'param_name'  => 'id',
						'description' => __( 'Enter how many item you want in Product slider . enter -1 for unlimited', 'wp-woocommerce-product-slider'),
						'group'       => __( 'General', 'wp-woocommerce-product-slider'),
					),

				),
			)
		);

	}


	// Element HTML
	public function xgp_product_shortcode( $atts, $content = null ) {

		// Params extraction
		extract(
			shortcode_atts(
				array(
					'id'           => '',
				),
				$atts
			)
		);

		$content   = wpb_js_remove_wpautop( $content, true ); // YOU CAN DELETE IF YOU DON'T USE TEXTAREA HTML
		// Design your element with data
		ob_start();
		?>

		<?php echo do_shortcode('[xgpp__slider  id="'.$atts['id'].'"]')?>

		<?php
		return ob_get_clean();
	}

} // End Element Class


// Element Class Init
new xgp_product();


