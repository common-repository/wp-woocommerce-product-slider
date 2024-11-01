

<div class="content-wrap">
	<div class="xgp-product-quick-view-settings">
		<div class="xgp-heading-area">
			<h1 class="page-title"><?php _e('XG WooCommerce Product Slider','xg-product')?></h1>
			<p><?php _e('Xg Product Slider is a collection of WooCommerce Product Slider with 15 unique style. it help you to create beautifully slider layout in  couple of minutes. In Slider you have Quick view options , Wishlist options and also compare options. It super easy to use.','xg-product')?></p>
		</div>
		<div class="settings-area-wrapper">
			<h2 class="title"><?php _e('Available Quick View Settings For Slider','xg-product')?></h2>
			<span class="help-text"><?php _e('You can easily change all quick view setting according to your needs.','xg-product')?></span>
			<?php if ( isset( $_GET['settings-updated'] ) ) {
				echo "<div class='updated margin-top-20 margin-left-0'><p>".__('Quick View Settings Updated Successfully.','xg-product')."</p></div>";
			} ?>

			<div id="tabs" class="margin-top-50">
				<ul class="xgp-tab-nav">

					<li><a href="#typho"><?php _e('Typography Settings','xg-product')?></a></li>
					<li><a href="#styling"><?php _e('Styling Settings','xg-product')?></a></li>
				</ul>
				<div class="xgp-tab-container">
					<div id="typho">
						<div class="typography-content-wrapper">
							<form action="options.php" method="post" >
								<?php settings_fields( 'xgp_quick_view_options' ); ?>
								<div class="form-element-label">
									<label class="label" for="qvt_title_font_size"><?php _e('Title Font Size','xg-product')?></label>
									<small class="help-text"><?php _e('You can change quick view modal product title font size from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element has-icon margin-bottom-20">
									<input type="text"  id="qvt_title_font_size" name="qvt_title_font_size" class="xgp-input-field" value="<?php echo esc_attr( (!empty(get_option('qvt_title_font_size'))) ? get_option('qvt_title_font_size') : 30 )?>">
									<div class="the-icon">
										<span class="ictext">px</span>
									</div>
								</div>
								<div class="form-element-label">
									<label class="label" for="qvt_price_font_size"><?php _e('Price Font Size','xg-product')?></label>
									<small class="help-text"><?php _e('You can change quick view modal product Price font size from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element has-icon margin-bottom-20">

									<input type="text" class="xgp-input-field" name="qvt_price_font_size" id="qvt_price_font_size" value="<?php echo esc_attr((!empty(get_option('qvt_price_font_size'))) ? get_option('qvt_price_font_size') : 20)?>">
									<div class="the-icon">
										<span class="ictext">px</span>
									</div>
								</div>
								<div class="form-element-label">
									<label class="label" for="qvt_descr_font_size"><?php _e('Description Font Size','xg-product')?></label>
									<small class="help-text"><?php _e('You can change quick view modal product Description font size from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element has-icon margin-bottom-20">

									<input type="text" class="xgp-input-field" name="qvt_descr_font_size" id="qvt_descr_font_size" value="<?php echo esc_attr((!empty(get_option('qvt_descr_font_size'))) ? get_option('qvt_descr_font_size') : 16)?>">
									<div class="the-icon">
										<span class="ictext">px</span>
									</div>
								</div>
								<div class="form-element-label">
									<label class="label" for="qvt_btn_font_size"><?php _e('Button Font Size','xg-product')?></label>
									<small class="help-text"><?php _e('You can change quick view modal product add to cart button font size from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element has-icon margin-bottom-20">

									<input type="text" class="xgp-input-field" name="qvt_btn_font_size" id="qvt_btn_font_size" value="<?php echo esc_attr( (!empty(get_option('qvt_btn_font_size'))) ? get_option('qvt_btn_font_size') : 14)?>">
									<div class="the-icon">
										<span class="ictext">px</span>
									</div>
								</div>
								<div class="form-element-label">
									<label class="label" for="qvt_meta_font_size"><?php _e('Meta Font Size','xg-product')?></label>
									<small class="help-text"><?php _e('You can change quick view modal product meta font size from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element has-icon margin-bottom-20">

									<input type="text" class="xgp-input-field" name="qvt_meta_font_size" id="qvt_meta_font_size" value="<?php echo esc_attr((!empty(get_option('qvt_meta_font_size'))) ? get_option('qvt_meta_font_size') : 12)?>">
									<div class="the-icon">
										<span class="ictext">px</span>
									</div>
								</div>
								<div class="form-element-label">
									<label class="label" for="qvt_tag_font_size"><?php _e('Tag Font Size','xg-product')?></label>
									<small class="help-text"><?php _e('You can change quick view modal product tag font size from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element has-icon margin-bottom-20">

									<input type="text" class="xgp-input-field width-200" name="qvt_tag_font_size" id="qvt_tag_font_size" value="<?php echo esc_attr(( !empty(get_option('qvt_tag_font_size'))) ? get_option('qvt_tag_font_size'): 12)?>">
									<div class="the-icon">
										<span class="ictext">px</span>
									</div>
								</div>
								<button type="submit" class="xgp-submit-btn margin-bottom-30"><?php _e('Save Changes','xg-product')?></button>
							</form>
						</div>
					</div>
					<div id="styling">
						<div class="styling-content-wrapper  xgp-overlay">
                            <div class="pro-area">
                                <div class="pro-inner">
                                    <a target="_blank" href="https://codecanyon.net/item/xg-woocommerce-product-slider-product-quick-view-product-wishlist-all-in-one-product-slider/22572845" class="pro-btn"> Go Pro</a>
                                </div>
                            </div>
							<form action="options.php" method="post">
								<?php settings_fields('xgp_quick_view_styling');?>
								<div class="form-element-label">
									<label class="label" for="qvt_title_color"><?php _e('Title Color','xg-product')?></label>
									<small class="help-text"><?php _e('You can change quick view modal product title color from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element margin-bottom-20">
									<input type="text" class="xgp-color-field xgp_color_picker width-200" name="qvt_title_color" id="qvt_title_color" value="<?php echo esc_attr(( !empty(get_option('qvt_title_color'))) ? get_option('qvt_title_color'): '#313131')?>">
								</div>

								<div class="form-element-label">
									<label class="label" for="qvt_price_color"><?php _e('Price Color','xg-product')?></label>
									<small class="help-text"><?php _e('You can change quick view modal product price color from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element margin-bottom-20">
									<input type="text" class="xgp-color-field xgp_color_picker width-200" name="qvt_price_color" id="qvt_price_color" value="<?php echo esc_attr(( !empty(get_option('qvt_price_color'))) ? get_option('qvt_price_color'): '#313131')?>">
								</div>

								<div class="form-element-label">
									<label class="label" for="qvt_discount_price_color"><?php _e('Discount Price Color','xg-product')?></label>
									<small class="help-text"><?php _e('You can change quick view modal product discount price color from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element margin-bottom-20">
									<input type="text" class="xgp-color-field xgp_color_picker width-200" name="qvt_discount_price_color" id="qvt_discount_price_color" value="<?php echo esc_attr(( !empty(get_option('qvt_discount_price_color'))) ? get_option('qvt_discount_price_color'): '#B6B6B6')?>">
								</div>
								<div class="form-element-label">
									<label class="label" for="qvt_description_color"><?php _e('Description Color','xg-product')?></label>
									<small class="help-text"><?php _e('You can change quick view modal product description color from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element margin-bottom-20">
									<input type="text" class="xgp-color-field xgp_color_picker width-200" name="qvt_description_color" id="qvt_description_color" value="<?php echo esc_attr(( !empty(get_option('qvt_description_color'))) ? get_option('qvt_description_color'): '#6d6d6d')?>">
								</div>
								<div class="form-element-label">
									<label class="label" for="qvt_btn_color"><?php _e('Button Color','xg-product')?></label>
									<small class="help-text"><?php _e('You can change quick view modal product button color from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element margin-bottom-20">
									<input type="text" class="xgp-color-field xgp_color_picker width-200" name="qvt_btn_color" id="qvt_btn_color" value="<?php echo esc_attr(( !empty(get_option('qvt_btn_color'))) ? get_option('qvt_btn_color'): '#fff')?>">
								</div>
								<div class="form-element-label">
									<label class="label" for="qvt_btn_background_color"><?php _e('Button Background Color','xg-product')?></label>
									<small class="help-text"><?php _e('You can change quick view modal product button background color from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element margin-bottom-20">
									<input type="text" class="xgp-color-field xgp_color_picker width-200" name="qvt_btn_background_color" id="qvt_btn_background_color" value="<?php echo esc_attr(( !empty(get_option('qvt_btn_background_color'))) ? get_option('qvt_btn_background_color'): '#4092F7')?>">
								</div>
								<div class="form-element-label">
									<label class="label" for="qvt_btn_hover_color"><?php _e('Button Hover Color','xg-product')?></label>
									<small class="help-text"><?php _e('You can change quick view modal product button hover color from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element margin-bottom-20">
									<input type="text" class="xgp-color-field xgp_color_picker width-200" name="qvt_btn_hover_color" id="qvt_btn_hover_color" value="<?php echo esc_attr(( !empty(get_option('qvt_btn_hover_color'))) ? get_option('qvt_btn_hover_color'): '#fff')?>">
								</div>

								<div class="form-element-label">
									<label class="label" for="qvt_btn_hover_background_color"><?php _e('Button Hover Background Color','xg-product')?></label>
									<small class="help-text"><?php _e('You can change quick view modal product button hover background color from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element margin-bottom-20">
									<input type="text" class="xgp-color-field xgp_color_picker width-200" name="qvt_btn_hover_background_color" id="qvt_btn_hover_background_color" value="<?php echo esc_attr(( !empty(get_option('qvt_btn_hover_background_color'))) ? get_option('qvt_btn_hover_background_color'): '#4092F7')?>">
								</div>

								<div class="form-element-label">
									<label class="label" for="qvt_meta_color"><?php _e('Meta Color','xg-product')?></label>
									<small class="help-text"><?php _e('You can change quick view modal product meta color from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element margin-bottom-20">
									<input type="text" class="xgp-color-field xgp_color_picker width-200" name="qvt_meta_color" id="qvt_meta_color" value="<?php echo esc_attr(( !empty(get_option('qvt_meta_color'))) ? get_option('qvt_meta_color'): '#757575')?>">
								</div>
								<div class="form-element-label">
									<label class="label" for="qvt_meta_hover_color"><?php _e('Meta Hover Color','xg-product')?></label>
									<small class="help-text"><?php _e('You can change quick view modal product meta hover color from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element margin-bottom-20">
									<input type="text" class="xgp-color-field xgp_color_picker width-200" name="qvt_meta_hover_color" id="qvt_meta_hover_color" value="<?php echo esc_attr(( !empty(get_option('qvt_meta_hover_color'))) ? get_option('qvt_meta_hover_color'): '#4092F7')?>">
								</div>
								<div class="form-element-label">
									<label class="label" for="qvt_close_btn_bg_color"><?php _e('Close Button Background Color','xg-product')?></label>
									<small class="help-text"><?php _e('You can change quick view modal product close button background color from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element margin-bottom-20">
									<input type="text" class="xgp-color-field xgp_color_picker width-200" name="qvt_close_btn_bg_color" id="qvt_close_btn_bg_color" value="<?php echo esc_attr(( !empty(get_option('qvt_close_btn_bg_color'))) ? get_option('qvt_close_btn_bg_color'): '#4092F7')?>">
								</div>
								<div class="form-element-label">
									<label class="label" for="qvt_close_btn_color"><?php _e('Close Button Color','xg-product')?></label>
									<small class="help-text"><?php _e('You can change quick view modal product close button color from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element margin-bottom-20">
									<input type="text" class="xgp-color-field xgp_color_picker width-200" name="qvt_close_btn_color" id="qvt_close_btn_color" value="<?php echo esc_attr(( !empty(get_option('qvt_close_btn_color'))) ? get_option('qvt_close_btn_color'): '#fff')?>">
								</div>
								<div class="form-element-label">
									<label class="label" for="qvt_close_btn_hover_bg_color"><?php _e('Close Button Hover Background Color','xg-product')?></label>
									<small class="help-text"><?php _e('You can change quick view modal product close button hove background color from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element margin-bottom-20">
									<input type="text" class="xgp-color-field xgp_color_picker width-200" name="qvt_close_btn_hover_bg_color" id="qvt_close_btn_hover_bg_color" value="<?php echo esc_attr(( !empty(get_option('qvt_close_btn_hover_bg_color'))) ? get_option('qvt_close_btn_hover_bg_color'): '#4092F7')?>">
								</div>
								<div class="form-element-label">
									<label class="label" for="qvt_close_btn_hover_color"><?php _e('Close Button Hover Color','xg-product')?></label>
									<small class="help-text"><?php _e('You can change quick view modal product close button hove color from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element margin-bottom-20">
									<input type="text" class="xgp-color-field xgp_color_picker width-200" name="qvt_close_btn_hover_color" id="qvt_close_btn_hover_color" value="<?php echo esc_attr(( !empty(get_option('qvt_close_btn_hover_color'))) ? get_option('qvt_close_btn_hover_color'): '#fff')?>">
								</div>
								<div class="form-element-label">
									<label class="label" for="qvt_tag_color"><?php _e('Tag Color','xg-product')?></label>
									<small class="help-text"><?php _e('You can change quick view modal product tag color from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element margin-bottom-20">
									<input type="text" class="xgp-color-field xgp_color_picker width-200" name="qvt_tag_color" id="qvt_tag_color" value="<?php echo esc_attr(( !empty(get_option('qvt_tag_color'))) ? get_option('qvt_tag_color'): '#333')?>">
								</div>
								<div class="form-element-label">
									<label class="label" for="qvt_tag_bg_color"><?php _e('Tag Background Color','xg-product')?></label>
									<small class="help-text"><?php _e('You can change quick view modal product tag background color from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element margin-bottom-20">
									<input type="text" class="xgp-color-field xgp_color_picker width-200" name="qvt_tag_bg_color" id="qvt_tag_bg_color" value="<?php echo esc_attr(( !empty(get_option('qvt_tag_bg_color'))) ? get_option('qvt_tag_bg_color'): '#ddd')?>">
								</div>
								<div class="form-element-label">
									<label class="label" for="qvt_tag_border_color"><?php _e('Tag Border Color','xg-product')?></label>
									<small class="help-text"><?php _e('You can change quick view modal product tag border color from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element margin-bottom-20">
									<input type="text" class="xgp-color-field xgp_color_picker width-200" name="qvt_tag_border_color" id="qvt_tag_border_color" value="<?php echo esc_attr(( !empty(get_option('qvt_tag_border_color'))) ? get_option('qvt_tag_border_color'): '#777')?>">
								</div>
								<button type="submit" class="xgp-submit-btn margin-bottom-30"><?php _e('Save Changes','xg-product')?></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>