<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
?>
<section class="ks-pro-grd-sec">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="ks-pro-grd-sec-inr">
					<?php get_template_part('templates/shop', 'header-top'); ?>
					<?php echo do_shortcode('[products_cat]'); ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer( 'shop' );
