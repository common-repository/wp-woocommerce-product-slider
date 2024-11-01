<?php
/**
 * @package Xgenious portfolio Elementor addon
 * @version 1.0
 *
 **/
/******************************************
Register Elementor hover effects Addon
 *******************************************/

namespace Elementor;

if(!defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

/**
 * Define portfolio elementor addon
 */
class xg_product_elementor_addon extends Widget_Base
{
	/**
	 * Define our get_name settings.
	 */
	public function get_name(){
		return 'xg-product-slider';
	}
	/**
	 * Define our get_title settings
	 */
	public function get_title(){
		return __('Xg Product Slider', 'wp-woocommerce-product-slider');
	}
	/**
	 * Define our get_icon settings
	 */
	public function get_icon(){
		return 'eicon-gallery-grid';
	}
	/**
	 * Define Our get_categories settings
	 */
	public function get_categories(){
		return ['xgenious-product-slider-addons'];
	}
	/**
	 * Define our _register_controls settings
	 */
	protected function _register_controls(){
		/**
		 * Price Plan Title and Price Section
		 */
		$this->start_controls_section(
			'section_my_custom',
			[
				'label' => esc_html__( 'XGP Slider', 'wp-woocommerce-product-slider' ),
			]
		);
		$this->add_control(
			'select_shotcode',
			[
				'label' => __('Select Product Slider','wp-woocommerce-product-slider'),
				'type' => Controls_manager::SELECT,
				'default' => '',
				'options' => xgp_get_slider_el(),
				'placeholder' => __('select which xg product slider you want to show.','wp-woocommerce-product-slider')
			]
		);

		/**
		 * End Title Section
		 */
		$this->end_controls_section();

	}

	/**
	 * Define our Content Display Settings
	 */
	protected function render(){
		$settings = $this->get_settings();
		/**
		 * main part
		 */
		$id = $settings['select_shotcode'];
		$shortcode = '[xgpp__slider  id="'.$id.'"]';
		$render_shortcode = do_shortcode( shortcode_unautop( $shortcode ) );
		 ?>
		<div class="elementor-shortcode"><?php echo $render_shortcode; ?></div>
<?php
	}

}
/*=============Call this every widget ====================*/
Plugin::instance()->widgets_manager->register_widget_type( new xg_product_elementor_addon() );
