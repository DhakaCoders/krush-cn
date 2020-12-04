<?php 
/*
  Template Name: Policies
*/
get_header(); 
while( have_posts() ): the_post();
?>
<section class="article-wrap">
  <div class="article-wrap-inner">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="clearfix article-inner" id="main-content">
            <div class="article-content">
                  <?php the_content(); ?>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
<?php endwhile; ?>
<?php get_footer(); ?>