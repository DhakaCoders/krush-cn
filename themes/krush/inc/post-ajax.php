<?php
/*
 * initial posts dispaly
 */
function script_load_more($args = array()) {
$output = '';
	$output .='<div id="ajax-post">';
    $output .='<div class="ks-blog-grid-item-wrp clearfix" id="ajax-content">';
		$output .= cbv_load_more_a($args);
    $output .= '</div>';
       
	$output .='<div class="ks-loadmore-btn" id="cbv-ajax-btn-1">
	<div class="ajaxloading" id="ajxaloader1" style="display:none"><img src="'.get_template_directory_uri().'/assets/images/loading.gif" alt="loader"></div>
	<a href="#" id="loadMore"  data-page="1" data-url="'.admin_url("admin-ajax.php").'" >וד פוסטים</a>';
	$output .='</div>';
	$output .='</div>';
return $output;
}
/*
 * create short code.
 */
add_shortcode('ajax_posts', 'script_load_more');

function cbv_load_more_a($args, $catslug = '') {
	
	//number of posts per page default
	$num = 4;
	//page number
	$query = new WP_Query(array( 
	    'post_type'=> 'post',
	    'post_status' => 'publish',
	    'posts_per_page' =>$num,
	    'order'=> 'DESC'
	  ) 
	);
	$output = '';

      if($query->have_posts()): 
          
	  
          while($query->have_posts()): $query->the_post(); 
          	$postexcerpt = get_field('postexcerpt', get_the_ID());
          	$thumbnailID = get_field('post_thumbnail', get_the_ID());
            $image_src = wp_get_attachment_image_src( $thumbnailID, 'postgrid');
            if( !empty( $image_src[0] ) ){
              $spnewsimg = $image_src[0];
            }else{
              $spnewsimg = '';
            }
			$output .='<div class="ks-blog-grid-item">';
                $output .='<div class="ks-blog-grid-item-img-ctlr">';
                  $output .='<a href="'.get_the_permalink().'" class="overlay-link"></a>';
                  $output .='<div class="ks-blog-grid-item-img">';
                    $output .='<img loading="lazy" src="'. $spnewsimg.'" alt="'.get_the_title().'">';
                  $output .='</div>';
                $output .='</div>';
                $output .='<div class="ks-blog-grid-item-dsc">';
                  $output .='<span>'.get_the_date('d.m.Y').'</span>';
                  $output .='<h5 class="ks-blog-grid-item-title mHc"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h5>';
                  if( !empty($postexcerpt) ) $output .= '<div class="blog-excerpt">'.wpautop( $postexcerpt).'</div>';
                $output .='</div>';
            $output .='</div>';
         endwhile; 
        endif;  
    wp_reset_postdata();
    return $output;
}

/*
 * load more script call back
 */
function ajax_script_load_more($args, $catslug = '') {
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
	    'post_type'=> 'post',
	    'post_status' => 'publish',
	    'posts_per_page' =>$num,
	    'paged'=>$paged,
	    'order'=> 'DESC'
	  ) 
	);

      if($query->have_posts()): 

          while($query->have_posts()): $query->the_post(); 
          	$postexcerpt = get_field('postexcerpt', get_the_ID());
          	$thumbnailID = get_field('post_thumbnail', get_the_ID());
            $image_src = wp_get_attachment_image_src( $thumbnailID, 'postgrid');
            if( !empty( $image_src[0] ) ){
              $spnewsimg = $image_src[0];
            }else{
              $spnewsimg = '';
            }
            ?>
			<div class="ks-blog-grid-item">
                <div class="ks-blog-grid-item-img-ctlr">
                  <a href="<?php the_permalink(); ?>" class="overlay-link"></a>
                  <div class="ks-blog-grid-item-img">
                    <img src="<?php echo $spnewsimg; ?>" alt="<?php the_title(); ?>">
                  </div>
                </div>
                <div class="ks-blog-grid-item-dsc">
                  <span><?php echo get_the_date('d.m.Y'); ?></span>
                  <h5 class="ks-blog-grid-item-title mHc"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                  <?php if( !empty($postexcerpt) ) echo wpautop( $postexcerpt); ?>
                </div>
            </div>
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
add_action('wp_ajax_nopriv_ajax_script_load_more', 'ajax_script_load_more');
add_action('wp_ajax_ajax_script_load_more', 'ajax_script_load_more');

/*
 * enqueue js script
 */
add_action( 'wp_enqueue_scripts', 'ajax_enqueue_script' );
/*
 * enqueue js script call back
 */
function ajax_enqueue_script() {
    wp_enqueue_script( 'script_ajax', get_theme_file_uri( '/assets/js/ajax-scripts.js' ), array( 'jquery' ), '1.0', true );
}