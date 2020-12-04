<?php 
  $terms = get_the_terms( get_the_ID(), 'product_cat' );
  if( !empty($terms) ){
    $term_ids = array();
    foreach( $terms as $term ){
      $term_ids[] = $term->term_id;
    }
    $query = new WP_Query(array( 
        'post_type'=> 'product',
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'orderby' => 'rand',
        'tax_query' => array(
             array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $term_ids
            )
        ) 
      ) 
    );
  }else{
    $query = new WP_Query(array( 
        'post_type'=> 'product',
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'orderby' => 'rand',  
      ) 
    );
  }
  if($query->have_posts()){
?>
<section class="ks-grd-sec">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="ks-grd-sec-inr">
          <ul class="reset-list clearfix">
          <?php 
          while ( $query->have_posts() ) { $query->the_post(); 
            global $product, $woocommerce, $post; 
            $product_image_tag = cbv_get_image_tag( get_post_thumbnail_id(get_the_ID()), 'productgrid' );
            $label_name = get_field('label_name', get_the_ID());
            $model = get_field('model', get_the_ID());

          ?>
            <li>
              <div class="ks-grd-item">
                <div class="ks-grd-item-img-ctlr">
                  <a href="<?php echo get_permalink(); ?>" class="overlay-link"></a>
                  <div class="ks-grd-item-img">
                    <?php echo $product_image_tag; ?>
                  </div>
                </div>
                <div class="ks-grd-item-des">
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
            </li>
          <?php } ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<?php } wp_reset_postdata();?>