<?php
/**
 * all dynamic stylesheet for frontend
 *
 */


Class xgp_dynamic_styling{
	/*
	 * run constructor
	 * */
	public function __construct() {
		add_action('wp_enqueue_scripts',array($this,'xgp_add_inline_style'));
//		$this->xgp_add_inline_style();
	}
	/*
	 * add inline style via
	 * wp_add_inline_style
	 * */
	public function xgp_add_inline_style(){
		wp_enqueue_style( 'xg-dynamic-style', XGP_URL . '/assets/css/xgp-inline-style.css', array(), XGP_VERSION );


		$custom_css = '
			
			#xgp-quick-view-content .onsale{
				font-size:'.esc_attr(get_option('qvt_tag_font_size')).'px !important;
			}
			#xgp-quick-view-content .woocommerce-Price-amount{
				font-size:'.esc_attr(get_option('qvt_price_font_size')).'px !important;;
			}
			#xgp-quick-view-content .product_title.entry-title {
				font-size:'.esc_attr(get_option('qvt_title_font_size')).'px !important;
			}
			#xgp-quick-view-content .woocommerce-product-details__short-description {
				font-size:'.esc_attr(get_option('qvt_descr_font_size')).'px !important;
			}
			#xgp-quick-view-content .product .summary.entry-summary .summary-content .single_add_to_cart_button {
				font-size:'.esc_attr(get_option('qvt_btn_font_size')).'px !important;
			}
			#xgp-quick-view-content .product_meta span {
				font-size:'.esc_attr(get_option('qvt_meta_font_size')).'px !important;
			}
			
		';

		wp_add_inline_style('xg-dynamic-style' ,$custom_css);
	}
}
new xgp_dynamic_styling();