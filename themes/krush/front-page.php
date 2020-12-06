<?php 
get_header(); 
$banner = get_field('banner_image', HOMEID);
$bannerTag = !empty($banner)? cbv_get_image_tag( $banner): '';
?>
<?php if( !empty($bannerTag) ): ?>
<section class="home-page-banner">
  <?php echo $bannerTag; ?>
</section>
<?php endif; ?>

<?php 
$intro = get_field('introsec', HOMEID);
if( $intro ):
?>
<section class="krushbox-fea-quick-sec">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="krushbox-fea-quick-sec-inr clearfix">
          <div class="krushbox-fea-quick-des">
          <?php 
            if( !empty($intro['title']) ) printf('<h3 class="kfqd-title">%s</h3>', $intro['title']);
            if( !empty($intro['description']) ) echo wpautop( $intro['description'] );
            $hlink = $intro['link'];
            if( is_array( $hlink ) &&  !empty( $hlink['url'] ) ){
                printf('<a href="%s" target="%s">%s</a>', $hlink['url'], $hlink['target'], $hlink['title']); 
            }
            $introImgTag = !empty($intro['image'])? cbv_get_image_tag( $intro['image'], 'hintrogrid' ):'';
          ?>
          </div>
          <div class="krushbox-fea-quick-img">
            <?php echo $introImgTag; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php 
$productIDs = get_field('select_products', HOMEID);
if($productIDs){
  $query = new WP_Query(array( 
      'post_type'=> 'product',
      'post_status' => 'publish',
      'posts_per_page' => count($productIDs),
      'post__in' => $productIDs,
      'orderby' => 'rand',  
    ) 
  );
}else{
  $query = new WP_Query(array( 
      'post_type'=> 'product',
      'post_status' => 'publish',
      'posts_per_page' => 3,
      'orderby' => 'date',
      'order'=> 'DESC',
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

<section class="ks-about-sec">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="ks-about-sec-inr">
          <p>אני טקסט שמספר על קראש, קראש הוא מותג אביזריראש <br>תמחה בעיצוב פרטים יחודיים המתאימים לאירועים  <br>וליו יום,כאן נרחיב עוד על קראש</p>
          <a href="#">עוד עלינו</a>
        </div>
      </div>
    </div>
  </div>
</section>



<section class="featured-product rtl">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="featured-product-inr">
          <div class="fea-pro-cntlr">
            <div class="fea-pro-img">
              <img src="<?php echo THEME_URI; ?>/assets/images/new/hgrid2.jpg" alt="">
            </div>
            <div class="fea-pro-desc-cntlr">
              <div class="fea-pro-desc-hdr">
                <h2 class="fea-pro-desc-cntlr-title">קראשיות כותבות</h2>
              </div>
              <div class="fea-pro-desc fea-pro-desc-italic">
                <p>״מרגישה שסופסוף אני שמה כיסוי שאני מרגישה איתו בנח, לא מחופשת, ושבמקום להרוס את הלוק - הוא מקפיץ אותו ועושה אותו אפילו עוד יותר שיק״ </p>
              </div>
              <div class="fea-pro-desc-date">
                <span>תמר, 29, מודיעין </span>
              </div>
            </div>
          </div>
          <div class="fea-pro-cntlr fea-pro-lft-img-rt-desc">
            <div class="fea-pro-img">
              <img src="<?php echo THEME_URI; ?>/assets/images/new/hgrid3.jpg" alt="">
            </div>
            <div class="fea-pro-desc-cntlr">
              <div class="fea-pro-desc-hdr">
                <h2 class="fea-pro-desc-cntlr-title"> Costume Made </h2>
              </div>
              <div class="fea-pro-desc">
                <h3 class="fea-pro-desc-title ltr"> special day? </h3>
                <p> אנחנו מקיימות פגישות והתאמה אישית של אביזרי ראש במיוחד בשבילך  </p>
                <div class="fea-pro-desc-btn">
                  <a href="#">הזמיני תור עכשיו</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<section class="gallery rtl">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="gallery-col-cntlr">
          <div class="gallery-col">
            <div class="gallery-col-wrap">
              <div class="gallery gallery-columns-2">
                <figure class="gallery-item">
                  <div class="gallery-icon portrait">
                    <a data-fancybox="gallery" href="<?php echo THEME_URI; ?>/assets/images/gallery-img-002.jpg">
                      <img src="<?php echo THEME_URI; ?>/assets/images/new/ins2.jpg"></a>
                  </div>
                </figure>

                <figure class="gallery-item">
                  <div class="gallery-icon portrait">
                    <a data-fancybox="gallery" href="<?php echo THEME_URI; ?>/assets/images/gallery-img-001.jpg">
                      <img src="<?php echo THEME_URI; ?>/assets/images/new/ins1.jpg"></a>
                  </div>
                </figure>

                <figure class="gallery-item">
                  <div class="gallery-icon portrait">
                    <a data-fancybox="gallery" href="<?php echo THEME_URI; ?>/assets/images/gallery-img-003.jpg">
                      <img src="<?php echo THEME_URI; ?>/assets/images/new/ins3.jpg"></a>
                  </div>
                </figure>

                <figure class="gallery-item">
                  <div class="gallery-icon portrait">
                    <a data-fancybox="gallery" href="<?php echo THEME_URI; ?>/assets/images/gallery-img-004.jpg">
                      <img src="<?php echo THEME_URI; ?>/assets/images/new/ins5.jpg"></a>
                  </div>
                </figure>
              </div>
            </div>
          </div>
          <div class="gallery-col gallery-desc-col">
            <div class="gallery-desc">
              <h3 class="gallery-desc-title">find us on<span>Instagram</span></h3>
              <div class="gallery-desc-btn fea-pro-desc-btn">
                <a href="#">עקבי אחרינו</a>
              </div>
            </div>
          </div>
          <div class="gallery-col">
            <div class="gallery-col-wrap">
              <div class="gallery gallery-columns-2">
                <figure class="gallery-item">
                  <div class="gallery-icon portrait">
                    <a data-fancybox="gallery" href="<?php echo THEME_URI; ?>/assets/images/gallery-img-006.jpg">
                      <img src="<?php echo THEME_URI; ?>/assets/images/new/ins5.jpg"></a>
                  </div>
                </figure>

                <figure class="gallery-item">
                  <div class="gallery-icon portrait">
                    <a data-fancybox="gallery" href="<?php echo THEME_URI; ?>/assets/images/gallery-img-005.jpg">
                      <img src="<?php echo THEME_URI; ?>/assets/images/new/ins6.jpg"></a>
                  </div>
                </figure>

                <figure class="gallery-item">
                  <div class="gallery-icon portrait">
                    <a data-fancybox="gallery" href="<?php echo THEME_URI; ?>/assets/images/gallery-img-008.jpg">
                      <img src="<?php echo THEME_URI; ?>/assets/images/new/ins3.jpg"></a>
                  </div>
                </figure>

                <figure class="gallery-item">
                  <div class="gallery-icon portrait">
                    <a data-fancybox="gallery" href="<?php echo THEME_URI; ?>/assets/images/gallery-img-007.jpg">
                      <img src="<?php echo THEME_URI; ?>/assets/images/new/ins2.jpg"></a>
                  </div>
                </figure>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>