<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

while ( have_posts() ) : the_post(); ?>

    <div class="product">

        <div id="product-<?php the_ID(); ?>" <?php post_class( 'product' ); ?>>

			<?php

			global $product;

			$attachment_ids = $product->get_gallery_attachment_ids();
			if ( empty( $attachment_ids ) ):
				do_action( 'xgp_product_image' );
			else:?>
                <div class="xgp-product-slider" id="xgp-product-slider">

					<?php
					foreach ( $attachment_ids as $att_id ):
						?>
                        <div class="single-xgp-slider-item">
                            <img src="<?php echo esc_url( wp_get_attachment_image_src( $att_id, 'shop_catalog' )[0] ) ?>"
                                 alt="">
                        </div>
					<?php endforeach; ?>
                </div>
			<?php endif; ?>

            <div class="summary entry-summary">
                <div class="summary-content">
					<?php do_action( 'xgp_product_summery' ); ?>
                </div>
            </div>

        </div>

    </div>

<?php endwhile; // end of the loop.