<?php 
global $product, $woocommerce, $post; 
$product_image_tag = cbv_get_image_tag( get_post_thumbnail_id($product->get_id()), 'productgrid' );
$condition = get_field('condition', $product->get_id());

?>
<div class="ks-pro-btm-grd-item">
  <div class="ks-pro-btm-grd-item-img-ctlr">
    <a href="<?php echo get_permalink( $product->get_id() ) ?>" class="overlay-link"></a>
    <div class="ks-pro-btm-grd-item-img">
      <?php echo $product_image_tag; ?>
    </div>
  </div>
  <div class="ks-pro-btm-grd-item-des">
    <div class="ks-grd-item-des-top">
      <?php 
        if( !empty($condition) ) printf('<div class="ks-gidt-lft"><span>%s</span></div>', $condition); 
        wc_stock_manage();
      ?>
    </div>
    <div class="ks-grd-item-des-btm clearfix">
      <div class="ks-gidb-venus">
        <strong>Venus</strong>
        <span><?php echo get_the_title(); ?></span>
      </div>
      <div class="ks-gidb-price">
        <?php echo $product->get_price_html(); ?>
      </div>
    </div>
  </div>
</div>