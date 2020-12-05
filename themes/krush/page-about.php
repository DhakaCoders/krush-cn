<?php 
/*
  Template Name: About
*/
get_header(); 
$thisID = get_the_ID();
$abouts = get_field('content', $thisID);
$aboutlink = get_field('aboutlink', $thisID);
?>
<section class="about-grid-sec">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <?php if( $abouts ): ?>
          <?php 
          $i = 1;
          foreach( $abouts as $about ):
          $aboutImgTag = !empty($about['image'])? cbv_get_image_tag( $about['image'], 'aboutgrid' ): '';
          $addClass = ($i%2 == 0 )? ' about-grid-lft-img-rt-desc':''; 
        ?>
        <div class="about-grid-cntlr<?php echo $addClass; ?>">
          <div class="about-grid-img">
            <?php echo $aboutImgTag; ?>
          </div>
          <div class="about-grid-desc-cntlr">
            <div class="about-grid-desc">
              <?php 
                if( !empty($about['title']) ) printf('<h3 class="about-grid-desc-title">%s</h3>', $about['title']);
                if( !empty($about['description']) ) echo wpautop( $about['description'] );
              ?>
            </div>
          </div>
        </div>
        <?php $i++; endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php 
if( $aboutlink ): 
  $links = $aboutlink['links'];
?>
<section class="about-link-sec">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="about-link-inr">
          <?php if( !empty($aboutlink['title']) ) printf('<h2 class="about-link-title">%s</h2>', $aboutlink['title']); ?>
          <?php if( $links ): ?>
          <div class="about-link-cntlr">
            <ul class="reset-list">
              <?php 
                foreach( $links as $link ): 
                  $ablink = $link['link'];
                  if( is_array( $ablink ) &&  !empty( $ablink['url'] ) ){
                      $linktitle = (!empty($ablink['title']))? $ablink['title']:$ablink['url'];
                      printf('<li><a href="%s" target="%s">%s</a></li>', $ablink['url'], $ablink['target'], $linktitle); 
                  }
                endforeach;
              ?>
            </ul>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php get_footer(); ?>