<?php 
/* Template Name: Video */
get_header(); 
?>
<svg style="display: none;">
  <symbol id="ks-blg-video-play-hover-svg" data-name="play sign hover" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40">
    <path id="play" d="M7,0l7,12H0Z" transform="translate(28 13) rotate(90)" fill="#fff"/>
    <g id="Oval" fill="none" stroke="#fff" stroke-miterlimit="10" stroke-width="1">
      <circle cx="20" cy="20" r="20" stroke="none"/>
      <circle cx="20" cy="20" r="19.5" fill="none"/>
    </g>
  </symbol>
</svg>
<section class="ks-blog-video-grid-sec-wrp rtl">
  <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <?php echo do_shortcode('[ajax_videos]'); ?>
        </div>
      </div>
  </div>    
</section>
<?php get_footer(); ?>