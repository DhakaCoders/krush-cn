<?php 
global $product, $woocommerce, $post; 
$product_image_tag = cbv_get_image_tag( get_post_thumbnail_id($product->get_id()), 'productgrid' );
$label_name = get_field('label_name', $product->get_id());
$model = get_field('model', $product->get_id());
?>
<div class="ks-pro-btm-grd-item">
  <div class="ks-pro-btm-grd-item-img-ctlr">
    <a href="<?php echo get_permalink( $product->get_id() ); ?>" class="overlay-link"></a>
    <div class="ks-pro-btm-grd-item-img">
      <?php echo $product_image_tag; ?>
    </div>
  </div>
  <div class="ks-pro-btm-grd-item-des">
    <div class="ks-grd-item-des-top">
      <?php 
        if( !empty($label_name) ) printf('<div class="ks-gidt-lft"><span>%s</span></div>', $label_name); 
        wc_stock_manage();
      ?>
    </div>
    <div class="ks-grd-item-des-btm clearfix">
      <div class="ks-gidb-venus">
        <?php if( !empty($model) ) printf('<strong>%s</strong>', $model); ?>
        <span><?php echo get_the_title(); ?></span>
      </div>
      <div class="ks-gidb-price">
        <?php echo $product->get_price_html(); ?>
      </div>
    </div>
  </div>
</div>