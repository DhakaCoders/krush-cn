<?php 
global $product, $woocommerce, $post; 
$bottom_info = get_field('product_bottom_info', $product->get_id());
?>
<div class="fl-product-summery-hdr">
<h2 class="product_title entry-title">Venus</h2>
<strong><?php echo get_the_title(); ?></strong>
<?php echo $product->get_price_html(); ?>
</div>
<div class="fl-product-summery-con">
<?php woocommerce_template_single_add_to_cart(); ?>
</div>
<div class="woocommerce-tabs">
    <?php wc_get_template(  'single-product/tabs/tabs.php' ); ?>       
</div>
<?php 
if( $bottom_info ): 
$extraInfo = $bottom_info['additional_info'];
?>
<div class="fl-product-summery-tumbnails">
<?php if( $extraInfo ): ?>
<ul class="clearfix reset-list">
  <?php 
    foreach( $extraInfo as $extra ): 
      $thumb = ( !empty($extra['image']) )? cbv_get_image_tag( $extra['image'] ):'';
  ?>
  <li>
    <div class="fl-product-summery-tumbnail-item">
      <span><?php echo $thumb; ?></span>
      <div class="fl-pro-summery-tumbnail-item-des">
        <?php if( !empty($extra['text']) ) echo wpautop( $extra['text'] ); ?>
      </div>
    </div>
  </li>
  <?php endforeach; ?>
</ul>
<?php endif; ?>
</div>
<?php endif; ?>