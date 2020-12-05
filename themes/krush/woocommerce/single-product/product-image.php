<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $product->get_image_id() ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	)
);

$attachment_ids = $product->get_gallery_image_ids();
?>
<div class="product-page-grd-rgt left">
	<div class="slideshow">
	<?php 
		if ( $attachment_ids && $product->get_image_id() ) {
		$i = 1;
		foreach ( $attachment_ids as $attachment_id ) {
		$product_image_tag = cbv_get_image_tag( $attachment_id, 'productgallery' );
		$product_image_url = cbv_get_image_src( $attachment_id, 'productgallery' );
		$cls = ($i == 1)? 'main-image' : 'new-image';
	?>

        <img src="<?php echo $product_image_url; ?>" class="<?php echo $cls; ?>">

	<?php	
		$i++; }
	}else{
		$product_image_tag = cbv_get_image_tag( $post_thumbnail_id, 'productgallery' );
		$product_image_url = cbv_get_image_src( $post_thumbnail_id, 'productgallery' );
	?>
		<img src="<?php echo $product_image_url; ?>" class="main-image">
	<?php
	}
	?>		
	</div>
	<ul class="clearfix reset-list" style="display: none;">
	<?php 
		if ( $attachment_ids && $product->get_image_id() ) {
		foreach ( $attachment_ids as $attachment_id ) {
		$product_image_tag = cbv_get_image_tag( $attachment_id, 'productgallery' );
	?>
		<li>
            <div>
              <?php echo $product_image_tag; ?>
            </div>
      	</li>
	<?php	
		}
	}else{
		$product_image_tag = cbv_get_image_tag( $post_thumbnail_id, 'productgallery' );
	?>
		<li>
            <div>
              <?php echo $product_image_tag; ?>
            </div>
      	</li>
	<?php
	}
	?>
	</ul>
</div>
