<div class="ks-pro-grd-entry-hdr ltr">
  <h2 class="ks-pgeh-title">סדר לפי </h2>
  <div class="shop-widgets">
    <?php dynamic_sidebar('shop-widget'); ?>
  </div>
</div>
<?php 
if( is_product_category() ){  
  $current_term = get_queried_object();
  $thumbnail_id = get_woocommerce_term_meta( $current_term->term_id, 'thumbnail_id', true );
  $term_image_tag = '';
  if( !empty($thumbnail_id) ){
      $term_image_tag = cbv_get_image_tag( $thumbnail_id, 'termgrid' );
  }
?>
<div class="ks-pro-top-grd">
  <ul class="reset-list clearfix">
    <li>
      <div class="ks-pro-top-grd-item">
        <div class="ks-pro-top-grd-item-des mHc">
          <h2 class="ks-ptgid-title"><?php echo $current_term->name; ?> </h2>
        </div>
      </div>
    </li>
    <li>
      <div class="ks-pro-top-grd-item">
        <div class="ks-pro-top-grd-item-img mHc">
          <?php echo $term_image_tag; ?>
        </div>
      </div>
    </li>
  </ul>
</div>
<?php } ?>