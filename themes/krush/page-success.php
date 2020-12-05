<?php 
/*
  Template Name: success
*/
get_header();
$thisID = get_the_ID();
$banner = get_field('banner_image', $thisID);
$title = get_field('title', $thisID); 
$description = get_field('description', $thisID); 
$gift_image = get_field('gift_image', $thisID); 
$giftImgTag = !empty($gift_image)? cbv_get_image_tag( $gift_image): '';
$bannerTag = !empty($banner)? cbv_get_image_tag( $banner): '<img src="'.THEME_URI.'/assets/images/ks-success-banner-img.png" alt="'.get_the_title().'">';
?>
<section class="ks-success-banner-sec-wrp">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="ks-success-banner">
          <?php echo $bannerTag; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="ks-success-gift-dsc-sec-wrp rtl">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="ks-success-gift-dsc">
          <?php 
            if( !empty($title) ) printf('<h4 class="ks-success-gift-dsc-title">%s</h4>', $title);
            if( !empty($description) ) echo wpautop( $description );
          ?>
          <?php echo $giftImgTag; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>