<?php
/**
 * @package Product Carusel
 * @version 1.0.0
 *
 **/

require_once XGP_PATH .'/inc/helpers/dynamic-stylesheet.php';
function vc_before_init_actions() {
	if ( class_exists( 'Vc_Manager' ) ) {
		require_once( XGP_PATH . '/inc/wpbakery/class-xgp-wpbakery-param-register.php' );
		require_once( XGP_PATH . '/inc/wpbakery/class-xgp-wpbakery-addon.php' );
	}
}

add_action( 'vc_before_init', 'vc_before_init_actions' );
/*
 * check elementor page builder installed or not
 * */
if ( defined( 'ELEMENTOR_VERSION' ) ) {
	add_action(
		'elementor/init', function() {
		\Elementor\Plugin::$instance->elements_manager->add_category(
			'xgenious-product-slider-addons',
			[
				'title' => __('Product Slider','xg-product'),
				'icon' => '',
			],
			1
		);
	}
	);
}
add_action( 'elementor/widgets/widgets_registered', 'xgp_product_slider_elementor_addon' );
function xgp_product_slider_elementor_addon() {
	require_once XGP_PATH . '/inc/elementor/class-xgp-product-elementor-addon.php';

}
/*
 * get user wishlist object as array
 *
 * return array of user object
 *
 * */
function xgp_user_wishlist_array($user_id = null,$token = null){
	global $wpdb;
	$table = $wpdb->prefix .'xgp_wishlist_lists';

	$token = !empty($token) ? '"'.$token.'"' : null;

	if ( !empty($user_id) && empty($token) ){

		$sql = "SELECT * FROM `{$table}` WHERE user_id = {$user_id} LIMIT 1";

	}elseif ( empty( $user_id ) && !empty($token)){

		$sql = "SELECT * FROM `{$table}` WHERE wishlist_token = {$token} LIMIT 1";

	}elseif ( !empty($user_id) && !empty($token) ){

		$sql = "SELECT * FROM `{$table}` WHERE user_id = {$user_id} AND wishlist_token = {$token}  LIMIT 1";
	}


	$results = $wpdb->get_results($sql,ARRAY_A);
	$return = array();

	foreach ($results as $res){
		$return['ID'] = $res['ID'];
		$return['wishlist_token'] = $res['wishlist_token'];
		$return['user_id'] = $res['user_id'];
	}

	return $return ;
}
/*
 * get user wishlist list
 *
 * return array of user wishtlish object
 *
 * */
function xgp_user_wishlist($wishlist_id,$user_id){
	global $wpdb;
		$table = $wpdb->prefix .'xgp_wishlist';

		if ( !empty( $user_id ) && empty($wishlist_id)){

			$sql = "SELECT * FROM `{$table}` WHERE user_id = {$user_id} ";

		}elseif( !empty($wishlist_id) && empty($user_id)){

			$sql = "SELECT * FROM `{$table}` WHERE  wishlist_id = {$wishlist_id} ";

		}elseif ( !empty( $user_id ) && !empty($wishlist_id) ){

			$sql = "SELECT * FROM `{$table}` WHERE user_id = {$user_id} AND wishlist_id = {$wishlist_id} ";
		}


	return $wpdb->get_results($sql,ARRAY_A);
}
/*
 * get public template
 * @return required_once give named template
 * */
function xgp_get_template($name){
	return require_once XGP_PATH .'/templates/'.$name.'.php';
}
/*
 * disable default upsells show
 * */
add_action('init','xgp_upsell_slider_setting_check');
function xgp_upsell_slider_setting_check(){
	$get_shotcode = (get_option('disable_default_upsells') == 'true') ? 'true' : '';
	if ($get_shotcode == 'true'){
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	}

}
add_action('woocommerce_after_single_product_summary','xgp_show_upsall_slider',10);

function xgp_show_upsall_slider(){
	$disable_default_upsells = get_option('disable_default_upsells') ? get_option('disable_default_upsells') : '';
	$get_shotcode_id = get_option('xgp_upsells_shortcode') ? get_option('xgp_upsells_shortcode') : '';

	if ($disable_default_upsells == 'true'){
		echo do_shortcode('[xgpp__slider  id="'.$get_shotcode_id.'"]');
	}
}


function xgp_get_slider_el(){
	$args = array(
		'post_type' => 'xg-product-slider',
		'post_status' => 'publish',
		'posts_per_page' => -1
	);
	$allshortcode = new WP_Query($args);

	$options = array(''=>'Select Shortcode');

	while ( $allshortcode->have_posts() ){
		$allshortcode->the_post();

		$options[get_the_ID()] = get_the_title();

	}
	return $options;

}