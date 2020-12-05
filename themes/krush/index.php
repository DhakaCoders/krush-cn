<?php get_header(); ?>
<section class="ks-blog-grid-item-sec-wrp rtl">
  <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <?php echo do_shortcode('[ajax_posts]'); ?>
        </div>
      </div>
  </div>    
</section>
<?php get_footer(); ?>