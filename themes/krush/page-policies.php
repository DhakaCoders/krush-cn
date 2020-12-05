<?php 
/*
  Template Name: Policies
*/
get_header(); 
$thisID = get_the_ID();
$policies = get_field('content', $thisID);
?>
<section class="article-wrap">
  <div class="article-wrap-inner">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="clearfix article-inner" id="main-content">
            <?php if( $policies ): ?>
            <div id="sidebar" class="sidebar">
              <div class="sidebar__inner">
                <strong><?php echo get_the_title(); ?></strong>
                <ul class="reset-list">
                  <?php 
                    $i = 1;
                    foreach( $policies as $policie ):
                  ?>
                  <li><a href="#item-<?php echo $i; ?>"><?php if( !empty($policie['title']) ) printf('%s', $policie['title']); ?></a></li>
                  <?php $i++; endforeach; ?>
                </ul>
              </div>
            </div>
            <div id="content" class="single-article-wrap clearfix">
              <div class="article-content">
                <div class="article-txt">
                  <h4><?php echo get_the_title(); ?></h4>
                  <?php 
                    $i = 1;
                    foreach( $policies as $policie ):
                  ?>
                  <div class="article-item" id="item-<?php echo $i; ?>">
                    <?php if( !empty($policie['description']) ) echo wpautop( $policie['description'] ); ?>
                  </div>
                  <?php $i++; endforeach; ?>
                </div>
              </div>
            </div>
            <?php endif; ?>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>