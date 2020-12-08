<?php
/*
 * initial posts dispaly
 */
function script_load_more_video($args = array()) {
$output = '';
	$output .='<div id="video-post">';
    $output .='<div class="ks-blog-video-grid-wrp" id="video-post-wrapp"><ul class="clearfix reset-list" id="ajax-content2">';
		$output .= cbv_load_more_video($args);
    $output .= '</ul></div>';
       
	$output .='<div class="ks-loadmore-btn" id="cbv-ajax-btn-2">
	<div class="ajaxloading" id="ajxaloader2" style="display:none"><img src="'.get_template_directory_uri().'/assets/images/loading.gif" alt="loader"></div>
	<a href="#" id="videoLoadMore"  data-page2="1" data-url="'.admin_url("admin-ajax.php").'" >ווד וידיאו </a>';
	$output .='</div>';
	$output .='</div>';
  return $output;
}
/*
 * create short code.
 */
add_shortcode('ajax_videos', 'script_load_more_video');

function cbv_load_more_video($args, $catslug = '') {
	
	//number of posts per page default
	$num = 4;
	//page number
	$query = new WP_Query(array( 
	    'post_type'=> 'video',
	    'post_status' => 'publish',
	    'posts_per_page' =>$num,
	    'order'=> 'DESC'
	  ) 
	);
	$output = '';

  if($query->have_posts()): 
      

    while($query->have_posts()): $query->the_post(); 
        $posterID = get_field('poster', get_the_ID());
      	$video_url = get_field('video_url', get_the_ID());
        $image_src = wp_get_attachment_image_src( $posterID, 'postgrid');
        if( !empty( $image_src[0] ) ){
          $gridImgSrc = $image_src[0];
        }else{
          $gridImgSrc = '';
        }

        $output .='<li>';
          $output .='<div class="ks-blog-video-grid">';
            $output .='<div class="ks-blog-video-grid-img-ctlr">';
              if( !empty($video_url) ):
              $output .='<a class="overlay-link" data-fancybox href="'.$video_url.'"></a>';
              endif;
              $output .='<div class="ks-blog-video-grid-img">';
                $output .='<img src="'. $gridImgSrc.'" alt="'.get_the_title().'">';
              $output .='</div>';
              if( !empty($video_url) ):
                $output .='<span class="ks-blog-video-play-cntlr">';
                  $output .='<i>
                    <svg class="ks-blg-video-play-hover-svg" width="40" height="40" viewBox="0 0 40 40" fill="#fff">
                    <use xlink:href="#ks-blg-video-play-hover-svg"></use>
                   </svg>
                  </i>';
                $output .='</span>';
              endif;
            $output .='</div>';
            $output .='<div class="ks-blog-video-grid-dsc">';
              $output .='<h5 class="ks-blog-vd-grid-title mHc"><a href="#">'.get_the_title().'</a></h5>';
            $output .='</div>';
          $output .='</div>';
        $output .='</li>';
    endwhile; 
    else:
      echo '<div class="no-resuts">No Results.</div>';
    endif;  
    wp_reset_postdata();
    return $output;
}

/*
 * load more script call back
 */
function ajax_script_load_more_video($args, $catslug = '') {
	//init ajax
	$ajax = false;
	//check ajax call or not
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	$ajax = true;
	}
	
	//number of posts per page default
	$num = 4;
	//page number
	if( isset($_POST['page']) ){
		$paged = $_POST['page'] + 1;
	}else{
		$paged = 1;
	}
	$query = new WP_Query(array( 
	    'post_type'=> 'video',
	    'post_status' => 'publish',
	    'posts_per_page' =>$num,
	    'paged'=>$paged,
	    'order'=> 'DESC'
	  ) 
	);

      if($query->have_posts()): 

          while($query->have_posts()): $query->the_post(); 
            $posterID = get_field('poster', get_the_ID());
            $video_url = get_field('video_url', get_the_ID());
            $image_src = wp_get_attachment_image_src( $posterID, 'postgrid');
            if( !empty( $image_src[0] ) ){
              $gridImgSrc = $image_src[0];
            }else{
              $gridImgSrc = '';
            }
            ?>
            <li>
              <div class="ks-blog-video-grid">
                <div class="ks-blog-video-grid-img-ctlr">
                  <?php if( !empty($video_url) ): ?>
                  <a class="overlay-link" data-fancybox href="https://www.youtube.com/watch?v=ScMzIvxBSi4&t=3s"></a>
                <?php endif; ?>
                  <div class="ks-blog-video-grid-img">
                    <img src="<?php echo $gridImgSrc; ?>" alt="<?php the_title(); ?>">
                  </div>
                  <?php if( !empty($video_url) ): ?>
                  <span class="ks-blog-video-play-cntlr">
                    <i>
                      <svg class="ks-blg-video-play-hover-svg" width="40" height="40" viewBox="0 0 40 40" fill="#fff">
                      <use xlink:href="#ks-blg-video-play-hover-svg"></use>
                     </svg>
                    </i>
                  </span>
                <?php endif; ?>
                </div>
                <div class="ks-blog-video-grid-dsc">
                  <h5 class="ks-blog-vd-grid-title mHc"><a href="#"><?php the_title(); ?></a></h5>
                </div>
              </div>
            </li>
	  <?php
        endwhile; 
        endif;  
    wp_reset_postdata();
    //check ajax call
    if($ajax) wp_die();
}

/*
 * load more script ajax hooks
 */
add_action('wp_ajax_nopriv_ajax_script_load_more_video', 'ajax_script_load_more_video');
add_action('wp_ajax_ajax_script_load_more_video', 'ajax_script_load_more_video');