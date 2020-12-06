<?php 
get_header(); 
while( have_posts() ): the_post();
$thisID = get_the_ID();
$banner = get_field('banner_image', $thisID);
$description = get_field('description', $thisID); 
$gallery = get_field('gallery', $thisID); 
$bannerTag = !empty($banner)? cbv_get_image_tag( $banner): '';

$posttitle = get_the_title();
$permalink = get_the_permalink();
?>
<?php if( !empty($bannerTag) ): ?>
<section class="page-banner">
  <?php echo $bannerTag; ?>
</section>
<?php endif; ?>

<section class="ks-blog-pst-cont">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="ks-blog-pst-cont-inr">
          <div class="ks-blog-pst-cont-entry-hdr">
            <h1 class="ks-bpceh-title"><?php the_title(); ?></h1>
          </div>
          <div class="ks-bpc-des clearfix">
            <div class="ks-bpc-des-rgt mHc">
              <?php 
              if( $gallery ):
              $totalGallery = count($gallery); 
              ?>
              <?php 
              $i = 1;
              foreach( $gallery as $gall ): 
                $gallImgTag = !empty($gall['id'])? cbv_get_image_tag( $gall['id']): '';
                $addClass = ( $totalGallery ==  $i)? 'ks-bpc-des-rgt-mdl':'ks-bpc-des-rgt-top';
              ?>
              <div class="<?php echo $addClass; ?>">
                <?php echo $gallImgTag; ?>
              </div>
              <?php $i++; endforeach; ?>
              <?php endif; ?>
              <div class="ks-bpc-des-rgt-btm hide-md">
                <h5 class="ks-bpc-des-rgt-btm-title"> אהבת את הכתבה  ? <br> לחי לחברה </h5>
                <ul class="reset-list">
                  <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $permalink; ?>">Facebook</a></li>
                  <li><a href="#">Whatsapp</a></li>
                </ul>
              </div>
            </div>
            <disv class="ks-bpc-des-lft mHc">
              <span><?php echo get_the_date('d.m.Y'); ?></span>
              <?php if( !empty($description) ) echo wpautop( $description ); ?>
              <div class="ks-bpc-des-rgt-btm show-md">
                <h5 class="ks-bpc-des-rgt-btm-title"> אהבת את הכתבה  ? <br> לחי לחברה </h5>
                <ul class="reset-list">
                  <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $permalink; ?>">Facebook</a></li>
                  <li><a href="#">Whatsapp</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="ks-blog-post-lftdes-rgtimg-sec">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="ks-blog-post-lftdes-rgtimg-sec-inr clearfix">
          <div class="ks-blog-post-rgtimg">
            <img src="<?php echo THEME_URI; ?>/assets/images/ks-blog-post-rgtimg-01.jpg">
          </div>
          <div class="ks-blog-post-lfrdes">
            <p> לפני שמתחילים לחטט רגליים ולבזבז את  <br>הזמן היקר לפני הארוע אני מאוד ממליצה  <br>לעשות  חיפוש מקיף ומעניין באינטרנט.  </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="ks-blog-post-lftimg-rgtdes-sec">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="ks-blog-post-lftimg-rgtdes-sec-inr">
          <div class="ks-blog-post-lftimg">
            <img src="<?php echo THEME_URI; ?>/assets/images/ks-blog-post-lftimg-01.jpg">
          </div>
          <div class="ks-blog-post-rgt-des">
            <p>מה עם סרט מונע החלקה? לא!!! פליז <br> לא, סרט מונע החלקנה עשוי מבדים  <br>סנטטים ופלסטיק הוא מונע מהשיער  <br>לנ שום ולקרני השמש להגיע לקרקפת (זה  <br>עושה נזקים לשיער). עדיף מעט פריטים  <br>איכותיים וטובים שלא דורשים תוספות  <br>מעל או מתחת. </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endwhile; ?>
<?php get_footer(); ?>