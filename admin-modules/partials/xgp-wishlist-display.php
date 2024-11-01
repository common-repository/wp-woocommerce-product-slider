
<div class="content-wrap">
	<div class="xgp-product-quick-view-settings">
		<div class="xgp-heading-area">
			<h1 class="page-title"><?php _e('XG WooCommerce Product Slider','xg-product')?></h1>
			<p><?php _e('Xg Product Slider is a collection of WooCommerce Product Slider with 15 unique style. it help you to create beautifully slider layout in  couple of minutes. In Slider you have Quick view options , Wishlist options and also compare options. It super easy to use.','xg-product')?></p>
		</div>
		<div class="settings-area-wrapper">
			<h2 class="title"><?php _e('Available Wishlist Settings For Slider','xg-product')?></h2>
			<span class="help-text"><?php _e('You can easily change all wishlist  setting according to your needs.','xg-product')?></span>
			<?php if ( isset( $_GET['settings-updated'] ) ) {
				echo "<div class='updated margin-top-20 margin-left-0'><p>".__('Wishlist Settings Updated Successfully.','xg-product')."</p></div>";
			} ?>

			<div id="tabs" class="margin-top-50">
				<ul class="xgp-tab-nav">
					<li><a href="#general"><?php _e('General Settings','xg-product')?></a></li>
					<li><a href="#typho"><?php _e('Typography Settings','xg-product')?></a></li>
					<li><a href="#styling"><?php _e('Styling Settings','xg-product')?></a></li>
				</ul>
				<div class="xgp-tab-container">
					<div id="general">
						<div class="general-content-wrapper">
							<form action="options.php" method="post">
								<?php settings_fields('xgp_wishlist_general');?>
								<div class="form-element-label">
									<label class="label" for="xgpw_title"><?php _e('Default Wishlist Title','xg-product')?></label>
									<small class="help-text"><?php _e('You can change wishlist page default title from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element margin-bottom-20 width-100">
									<input type="text"  id="xgpw_title" name="xgpw_title" class="xgp-input-field" value="<?php echo esc_attr( (!empty(get_option('xgpw_title'))) ? get_option('xgpw_title') : __(' My wishlist on ','xg-product').bloginfo('title') )?>">
								</div>
                                <div class="form-element-label">
									<label class="label" for="xgpw_title"><?php _e('Select Wishlist Page','xg-product')?></label>
									<small class="help-text"><?php _e('You can select wishlist page from here. for page content use this shortcode [xgp-wishlist-content]','xg-product')?></small>
								</div>
								<div class="xgp-form-element margin-bottom-20 width-100">
                                    <select name="xgpw_wishlist_page" id="xgpw_wishlist_page" class="select-field">
                                        <option value=""><?php _e('Select Page To Show Wishlist','xg-product')?></option>
                                        <?php
                                           $all_page_list = get_pages();
                                            foreach ($all_page_list as $page):
                                        ?>
                                        <option value="<?php echo esc_attr($page->ID)?>" <?php echo ( $page->ID == get_option('xgpw_wishlist_page') ) ? 'selected' : '' ?>><?php echo esc_html($page->post_name)?></option>
                                        <?php endforeach; ?>
                                    </select>
								</div>
                                <div class="form-element-label">
									<label class="label" for="xgpw_browse_wishlist_text"><?php _e('Browse Wishlist Text','xg-product')?></label>
									<small class="help-text"><?php _e('You can change browse wishlist text from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element margin-bottom-20 width-100">
									<input type="text"  id="xgpw_browse_wishlist_text" name="xgpw_browse_wishlist_text" class="xgp-input-field" value="<?php echo esc_attr( (!empty(get_option('xgpw_browse_wishlist_text'))) ? get_option('xgpw_browse_wishlist_text') : 'Browse Wishlist' )?>">
                                </div>
                                <div class="form-element-label">
									<label class="label" for="xgpw_already_in_wishlist_text"><?php _e('Already In Wishlist Text','xg-product')?></label>
									<small class="help-text"><?php _e('You can change already in  wishlist text from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element margin-bottom-20 width-100">
									<input type="text"  id="xgpw_already_in_wishlist_text" name="xgpw_already_in_wishlist_text" class="xgp-input-field" value="<?php echo esc_attr( (!empty(get_option('xgpw_already_in_wishlist_text'))) ? get_option('xgpw_already_in_wishlist_text') : __('Product Already In Wishlist','xg-product') )?>">
                                </div>
                                <div class="form-element-label">
									<label class="label" for="xgpw_added_in_wishlist_text"><?php _e('Added In Wishlist Text','xg-product')?></label>
									<small class="help-text"><?php _e('You can change added in wishlist text from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element margin-bottom-20 width-100">
									<input type="text"  id="xgpw_added_in_wishlist_text" name="xgpw_added_in_wishlist_text" class="xgp-input-field" value="<?php echo esc_attr( (!empty(get_option('xgpw_added_in_wishlist_text'))) ? get_option('xgpw_added_in_wishlist_text') : __('Added In Wishlist','xg-product') )?>">
                                </div>
								<button type="submit" class="xgp-submit-btn margin-bottom-30"><?php _e('Save Changes','xg-product')?></button>
							</form>
						</div>
					</div>
					<div id="typho">
						<div class="typography-content-wrapper xgp-overlay">
                            <div class="pro-area">
                               <div class="pro-inner">
                                   <a target="_blank" href="https://codecanyon.net/item/xg-woocommerce-product-slider-product-quick-view-product-wishlist-all-in-one-product-slider/22572845" class="pro-btn"> Go Pro</a>
                               </div>
                            </div>
							<form action="options.php" method="post" >
								<?php settings_fields( 'xgp_wishlist_typo' ); ?>
								<div class="form-element-label">
									<label class="label" for="xgpw_page_title_font_size"><?php _e('Page Title Font Size','xg-product')?></label>
									<small class="help-text"><?php _e('You can change wishlist page title font size from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element has-icon margin-bottom-20">
									<input type="text"  id="xgpw_page_title_font_size" name="xgpw_page_title_font_size" class="xgp-input-field" value="<?php echo esc_attr( (!empty(get_option('xgpw_page_title_font_size'))) ? get_option('xgpw_page_title_font_size') : 32 )?>">
									<div class="the-icon">
										<span class="ictext">px</span>
									</div>
								</div>
                                <div class="form-element-label">
									<label class="label" for="xgpw_page_table_header_font_size"><?php _e('Table Header Font Size','xg-product')?></label>
									<small class="help-text"><?php _e('You can change wishlist page table header font size from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element has-icon margin-bottom-20">
									<input type="text"  id="xgpw_page_table_header_font_size" name="xgpw_page_table_header_font_size" class="xgp-input-field" value="<?php echo esc_attr( (!empty(get_option('xgpw_page_table_header_font_size'))) ? get_option('xgpw_page_table_header_font_size') : 16 )?>">
									<div class="the-icon">
										<span class="ictext">px</span>
									</div>
								</div>
                                <div class="form-element-label">
                                    <label class="label" for="xgpw_page_product_title_font_size"><?php _e('Product Title Font Size','xg-product')?></label>
                                    <small class="help-text"><?php _e('You can change wishlist page product title font size from here','xg-product')?></small>
                                </div>
                                <div class="xgp-form-element has-icon margin-bottom-20">
                                    <input type="text"  id="xgpw_page_product_title_font_size" name="xgpw_page_product_title_font_size" class="xgp-input-field" value="<?php echo esc_attr( (!empty(get_option('xgpw_page_product_title_font_size'))) ? get_option('xgpw_page_product_title_font_size') : 16 )?>">
                                    <div class="the-icon">
                                        <span class="ictext">px</span>
                                    </div>
                                </div>
                                <div class="form-element-label">
                                    <label class="label" for="xgpw_page_product_img_width"><?php _e('Product Image Width','xg-product')?></label>
                                    <small class="help-text"><?php _e('You can change wishlist page product image width from here','xg-product')?></small>
                                </div>
                                <div class="xgp-form-element has-icon margin-bottom-20">
                                    <input type="text"  id="xgpw_page_product_img_width" name="xgpw_page_product_img_width" class="xgp-input-field" value="<?php echo esc_attr( (!empty(get_option('xgpw_page_product_img_width'))) ? get_option('xgpw_page_product_img_width') : 80 )?>">
                                    <div class="the-icon">
                                        <span class="ictext">px</span>
                                    </div>
                                </div>
                                <div class="form-element-label">
                                    <label class="label" for="xgpw_page_product_price_font_size"><?php _e('Product Price Font Size','xg-product')?></label>
                                    <small class="help-text"><?php _e('You can change wishlist page product price font size from here','xg-product')?></small>
                                </div>
                                <div class="xgp-form-element has-icon margin-bottom-20">
                                    <input type="text"  id="xgpw_page_product_price_font_size" name="xgpw_page_product_price_font_size" class="xgp-input-field" value="<?php echo esc_attr( (!empty(get_option('xgpw_page_product_price_font_size'))) ? get_option('xgpw_page_product_price_font_size') : 16 )?>">
                                    <div class="the-icon">
                                        <span class="ictext">px</span>
                                    </div>
                                </div>
                                <div class="form-element-label">
                                    <label class="label" for="xgpw_page_product_stock_font_size"><?php _e('Product Stock Font Size','xg-product')?></label>
                                    <small class="help-text"><?php _e('You can change wishlist page product stock font size from here','xg-product')?></small>
                                </div>
                                <div class="xgp-form-element has-icon margin-bottom-20">
                                    <input type="text"  id="xgpw_page_product_stock_font_size" name="xgpw_page_product_stock_font_size" class="xgp-input-field" value="<?php echo esc_attr( (!empty(get_option('xgpw_page_product_stock_font_size'))) ? get_option('xgpw_page_product_stock_font_size') : 16 )?>">
                                    <div class="the-icon">
                                        <span class="ictext">px</span>
                                    </div>
                                </div>
                                <div class="form-element-label">
                                    <label class="label" for="xgpw_page_addedate_font_size"><?php _e('Product Date Added Font Size','xg-product')?></label>
                                    <small class="help-text"><?php _e('You can change wishlist page product stock font size from here','xg-product')?></small>
                                </div>
                                <div class="xgp-form-element has-icon margin-bottom-20">
                                    <input type="text"  id="xgpw_page_addedate_font_size" name="xgpw_page_addedate_font_size" class="xgp-input-field" value="<?php echo esc_attr( (!empty(get_option('xgpw_page_addedate_font_size'))) ? get_option('xgpw_page_addedate_font_size') : 12 )?>">
                                    <div class="the-icon">
                                        <span class="ictext">px</span>
                                    </div>
                                </div>
                                <div class="form-element-label">
                                    <label class="label" for="xgpw_page_button_font_size"><?php _e('Product Button Font Size','xg-product')?></label>
                                    <small class="help-text"><?php _e('You can change wishlist page product button font size from here','xg-product')?></small>
                                </div>
                                <div class="xgp-form-element has-icon margin-bottom-20">
                                    <input type="text"  id="xgpw_page_button_font_size" name="xgpw_page_button_font_size" class="xgp-input-field" value="<?php echo esc_attr( (!empty(get_option('xgpw_page_button_font_size'))) ? get_option('xgpw_page_button_font_size') : 16 )?>">
                                    <div class="the-icon">
                                        <span class="ictext">px</span>
                                    </div>
                                </div>
                                <div class="form-element-label">
                                    <label class="label" for="xgpw_nofication_font_size"><?php _e('Success / Removed Notification Font Size','xg-product')?></label>
                                    <small class="help-text"><?php _e('You can change wishlist page product notification font size from here','xg-product')?></small>
                                </div>
                                <div class="xgp-form-element has-icon margin-bottom-20">
                                    <input type="text"  id="xgpw_nofication_font_size" name="xgpw_nofication_font_size" class="xgp-input-field" value="<?php echo esc_attr( (!empty(get_option('xgpw_nofication_font_size'))) ? get_option('xgpw_nofication_font_size') : 16 )?>">
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
								<?php settings_fields('xgp_wishlist_styling');?>
								<div class="form-element-label">
									<label class="label" for="xgpw_page_title_color"><?php _e('Page Title Color','xg-product')?></label>
									<small class="help-text"><?php _e('You can change wishlist page title color from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element margin-bottom-20">
									<input type="text" class="xgp-color-field xgp_color_picker width-200" name="xgpw_page_title_color" id="xgpw_page_title_color" value="<?php echo esc_attr(( !empty(get_option('xgpw_page_title_color'))) ? get_option('xgpw_page_title_color'): '#313131')?>">
								</div>
                                <div class="form-element-label">
									<label class="label" for="xgpw_page_table_header_color"><?php _e('Table Header Title Color','xg-product')?></label>
									<small class="help-text"><?php _e('You can change wishlist table header title color from here','xg-product')?></small>
								</div>
								<div class="xgp-form-element margin-bottom-20">
									<input type="text" class="xgp-color-field xgp_color_picker width-200" name="xgpw_page_table_header_color" id="xgpw_page_table_header_color" value="<?php echo esc_attr(( !empty(get_option('xgpw_page_table_header_color'))) ? get_option('xgpw_page_table_header_color'): '#6d6d6d')?>">
								</div>
                                <div class="form-element-label">
                                    <label class="label" for="xgpw_page_product_title_color"><?php _e('Product Title Color','xg-product')?></label>
                                    <small class="help-text"><?php _e('You can change wishlist product title color from here','xg-product')?></small>
                                </div>
                                <div class="xgp-form-element margin-bottom-20">
                                    <input type="text" class="xgp-color-field xgp_color_picker width-200" name="xgpw_page_product_title_color" id="xgpw_page_product_title_color" value="<?php echo esc_attr(( !empty(get_option('xgpw_page_product_title_color'))) ? get_option('xgpw_page_product_title_color'): '#313131')?>">
                                </div>
                                <div class="form-element-label">
                                    <label class="label" for="xgpw_page_product_price_color"><?php _e('Product Price Color','xg-product')?></label>
                                    <small class="help-text"><?php _e('You can change wishlist product price color from here','xg-product')?></small>
                                </div>
                                <div class="xgp-form-element margin-bottom-20">
                                    <input type="text" class="xgp-color-field xgp_color_picker width-200" name="xgpw_page_product_price_color" id="xgpw_page_product_price_color" value="<?php echo esc_attr(( !empty(get_option('xgpw_page_product_price_color'))) ? get_option('xgpw_page_product_price_color'): '#6d6d6d')?>">
                                </div>
                                <div class="form-element-label">
                                    <label class="label" for="xgpw_page_product_discount_price_color"><?php _e('Product Discount Price Color','xg-product')?></label>
                                    <small class="help-text"><?php _e('You can change wishlist product price discount color from here','xg-product')?></small>
                                </div>
                                <div class="xgp-form-element margin-bottom-20">
                                    <input type="text" class="xgp-color-field xgp_color_picker width-200" name="xgpw_page_product_discount_price_color" id="xgpw_page_product_discount_price_color" value="<?php echo esc_attr(( !empty(get_option('xgpw_page_product_discount_price_color'))) ? get_option('xgpw_page_product_discount_price_color'): '#6d6d6d')?>">
                                </div>
                                <div class="form-element-label">
                                    <label class="label" for="xgpw_page_product_in_stock_color"><?php _e('Product In Stock Color','xg-product')?></label>
                                    <small class="help-text"><?php _e('You can change wishlist product in stock color from here','xg-product')?></small>
                                </div>
                                <div class="xgp-form-element margin-bottom-20">
                                    <input type="text" class="xgp-color-field xgp_color_picker width-200" name="xgpw_page_product_in_stock_color" id="xgpw_page_product_in_stock_color" value="<?php echo esc_attr(( !empty(get_option('xgpw_page_product_in_stock_color'))) ? get_option('xgpw_page_product_in_stock_color'): '#008825')?>">
                                </div>
                                <div class="form-element-label">
                                    <label class="label" for="xgpw_page_product_out_stock_color"><?php _e('Product Out Of Stock Color','xg-product')?></label>
                                    <small class="help-text"><?php _e('You can change wishlist product out of stock color from here','xg-product')?></small>
                                </div>
                                <div class="xgp-form-element margin-bottom-20">
                                    <input type="text" class="xgp-color-field xgp_color_picker width-200" name="xgpw_page_product_out_stock_color" id="xgpw_page_product_out_stock_color" value="<?php echo esc_attr(( !empty(get_option('xgpw_page_product_out_stock_color'))) ? get_option('xgpw_page_product_out_stock_color'): '#ff001d')?>">
                                </div>
                                <div class="form-element-label">
                                    <label class="label" for="xgpw_page_addedate_color"><?php _e('Product Added Date In Wishlist Color','xg-product')?></label>
                                    <small class="help-text"><?php _e('You can change wishlist product added date in wishlist color from here','xg-product')?></small>
                                </div>
                                <div class="xgp-form-element margin-bottom-20">
                                    <input type="text" class="xgp-color-field xgp_color_picker width-200" name="xgpw_page_addedate_color" id="xgpw_page_addedate_color" value="<?php echo esc_attr(( !empty(get_option('xgpw_page_addedate_color'))) ? get_option('xgpw_page_addedate_color'): '#6d6d6d')?>">
                                </div>

                                <div class="form-element-label">
                                    <label class="label" for="xgpw_page_button_color"><?php _e('Add To Cart Button Color','xg-product')?></label>
                                    <small class="help-text"><?php _e('You can change wishlist add to cart  button color from here','xg-product')?></small>
                                </div>
                                <div class="xgp-form-element margin-bottom-20">
                                    <input type="text" class="xgp-color-field xgp_color_picker width-200" name="xgpw_page_button_color" id="xgpw_page_button_color" value="<?php echo esc_attr(( !empty(get_option('xgpw_page_button_color'))) ? get_option('xgpw_page_button_color'): '#fff')?>">
                                </div>
                                <div class="form-element-label">
                                    <label class="label" for="xgpw_page_button_bg_color"><?php _e('Add To Cart Button Background Color','xg-product')?></label>
                                    <small class="help-text"><?php _e('You can change wishlist add to cart  button background color from here','xg-product')?></small>
                                </div>
                                <div class="xgp-form-element margin-bottom-20">
                                    <input type="text" class="xgp-color-field xgp_color_picker width-200" name="xgpw_page_button_bg_color" id="xgpw_page_button_bg_color" value="<?php echo esc_attr(( !empty(get_option('xgpw_page_button_bg_color'))) ? get_option('xgpw_page_button_bg_color'): '#43454b')?>">
                                </div>
                                <div class="form-element-label">
                                    <label class="label" for="xgpw_page_button_hover_bg_color"><?php _e('Add To Cart Button  Hover Background Color','xg-product')?></label>
                                    <small class="help-text"><?php _e('You can change wishlist add to cart  button background hover color from here','xg-product')?></small>
                                </div>
                                <div class="xgp-form-element margin-bottom-20">
                                    <input type="text" class="xgp-color-field xgp_color_picker width-200" name="xgpw_page_button_hover_bg_color" id="xgpw_page_button_hover_bg_color" value="<?php echo esc_attr(( !empty(get_option('xgpw_page_button_hover_bg_color'))) ? get_option('xgpw_page_button_hover_bg_color'): '#1A1A1A')?>">
                                </div>
                                <div class="form-element-label">
                                    <label class="label" for="xgpw_page_button_hover_text_color"><?php _e('Add To Cart Button  Hover  Color','xg-product')?></label>
                                    <small class="help-text"><?php _e('You can change wishlist add to cart  button  hover color from here','xg-product')?></small>
                                </div>
                                <div class="xgp-form-element margin-bottom-20">
                                    <input type="text" class="xgp-color-field xgp_color_picker width-200" name="xgpw_page_button_hover_text_color" id="xgpw_page_button_hover_text_color" value="<?php echo esc_attr(( !empty(get_option('xgpw_page_button_hover_text_color'))) ? get_option('xgpw_page_button_hover_text_color'): '#fff')?>">
                                </div>
                                <div class="form-element-label">
                                    <label class="label" for="xgpw_nofication_success_color"><?php _e('Success Notification  Color','xg-product')?></label>
                                    <small class="help-text"><?php _e('You can change wishlist success notification color from here','xg-product')?></small>
                                </div>
                                <div class="xgp-form-element margin-bottom-20">
                                    <input type="text" class="xgp-color-field xgp_color_picker width-200" name="xgpw_nofication_success_color" id="xgpw_nofication_success_color" value="<?php echo esc_attr(( !empty(get_option('xgpw_nofication_success_color'))) ? get_option('xgpw_nofication_success_color'): '#fff')?>">
                                </div>
                                <div class="form-element-label">
                                    <label class="label" for="xgpw_nofication_success_bg_color"><?php _e('Success Notification Background  Color','xg-product')?></label>
                                    <small class="help-text"><?php _e('You can change wishlist success notification background color from here','xg-product')?></small>
                                </div>
                                <div class="xgp-form-element margin-bottom-20">
                                    <input type="text" class="xgp-color-field xgp_color_picker width-200" name="xgpw_nofication_success_bg_color" id="xgpw_nofication_success_bg_color" value="<?php echo esc_attr(( !empty(get_option('xgpw_nofication_success_bg_color'))) ? get_option('xgpw_nofication_success_bg_color'): '#50A750')?>">
                                </div>
                                <div class="form-element-label">
                                    <label class="label" for="xgpw_nofication_removed_bg_color"><?php _e('Remove Notification Background  Color','xg-product')?></label>
                                    <small class="help-text"><?php _e('You can change wishlist remove notification background color from here','xg-product')?></small>
                                </div>
                                <div class="xgp-form-element margin-bottom-20">
                                    <input type="text" class="xgp-color-field xgp_color_picker width-200" name="xgpw_nofication_removed_bg_color" id="xgpw_nofication_removed_bg_color" value="<?php echo esc_attr(( !empty(get_option('xgpw_nofication_removed_bg_color'))) ? get_option('xgpw_nofication_removed_bg_color'): '#DE4956')?>">
                                </div>
                                <div class="form-element-label">
                                    <label class="label" for="xgpw_nofication_removed_text_color"><?php _e('Remove Notification Color','xg-product')?></label>
                                    <small class="help-text"><?php _e('You can change wishlist remove notification color from here','xg-product')?></small>
                                </div>
                                <div class="xgp-form-element margin-bottom-20">
                                    <input type="text" class="xgp-color-field xgp_color_picker width-200" name="xgpw_nofication_removed_text_color" id="xgpw_nofication_removed_text_color" value="<?php echo esc_attr(( !empty(get_option('xgpw_nofication_removed_text_color'))) ? get_option('xgpw_nofication_removed_text_color'): '#fff')?>">
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