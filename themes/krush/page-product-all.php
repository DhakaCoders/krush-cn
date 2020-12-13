<?php 
/* Template Name: Product All*/
get_header(); 
?>
<section class="order-content-sec">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="ks-pro-grd-entry-hdr ltr">
          <h2 class="ks-pgeh-title"> סדר לפי   </h2>
          <div class="shop-widgets">
          <?php 
            dynamic_sidebar('shop-widget');
          ?>
          </div>
        </div>
      </div>
    </div>
    <?php echo do_shortcode('[all_product]'); ?>
  </div>
</section>
<?php get_footer(); ?>