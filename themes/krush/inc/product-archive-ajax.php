<?php
/*
 * initial products dispaly
 */
function script_load_more_archive($args = array()) {
$output = '';
	$output .='<div class="ks-pro-btm-grd" id="ajax-archive">';
    $output .='<ul class="reset-list clearfix" id="archive-products">';
		$output .= cbv_load_more_arvhice_product($args);
    $output .= '</ul>';
       
	$output .='<div class="ks-loadmore-btn" id="cbv-ajax-btn-3">
	<div class="ajaxloading" id="ajxaloader3" style="display:none"><img src="'.get_template_directory_uri().'/assets/images/loading.gif" alt="loader"></div>
	<span id="page_count" data-page3="1" data-url="'.admin_url("admin-ajax.php").'" ></span>';
	$output .='</div>';
	$output .='</div>';
return $output;
}
/*
 * create short code for product archvie.
 */
add_shortcode('products_archive', 'script_load_more_archive');

function cbv_load_more_arvhice_product($args, $catslug = '') {
	
	//number of products per page default
	$num = 4;
	//page number
	$query = new WP_Query(array( 
	    'post_type'=> 'product',
	    'post_status' => 'publish',
	    'posts_per_page' =>$num,
	    'order'=> 'DESC'
	  ) 
	);
	$output = '';

	if($query->have_posts()): 
	  while($query->have_posts()): $query->the_post(); 
		global $product, $woocommerce, $post; 
		$product_image_tag = cbv_get_image_tag( get_post_thumbnail_id($product->get_id()), 'productgrid' );
		$label_name = get_field('label_name', $product->get_id());
		$model = get_field('model', $product->get_id());
		$output .='<li>';
		$output .='<div class="ks-pro-btm-grd-item">';
		  $output .='<div class="ks-pro-btm-grd-item-img-ctlr">';
		    $output .='<a href="'.get_permalink( $product->get_id() ).'" class="overlay-link"></a>';
		    $output .='<div class="ks-pro-btm-grd-item-img">';
		      $output .=$product_image_tag;
		    $output .='</div>';
		  $output .='</div>';
		  $output .='<div class="ks-pro-btm-grd-item-des">';
		    $output .='<div class="ks-grd-item-des-top">';
		       
		        if( !empty($label_name) ) $output .='<div class="ks-gidt-lft"><span>'.$label_name.'</span></div>'; 
		        wc_stock_manage();
		    $output .='</div>';
		    $output .='<div class="ks-grd-item-des-btm clearfix">';
		      $output .='<div class="ks-gidb-venus">';
		        if( !empty($model) ) $output .='<strong>'.$model.'</strong>';
		        $output .='<span>'.get_the_title().'</span>';
		      $output .='</div>';
		     $output .='<div class="ks-gidb-price">';
		        $output .= $product->get_price_html();
		      $output .='</div>';
		    $output .='</div>';
		  $output .='</div>';
		$output .='</div>';
	    $output .='</li>';
	 endwhile; 
    else:
    endif;  
    wp_reset_postdata();
    return $output;
}

/*
 * load more script call back
 */
function ajax_load_more_archive_product($args, $catslug = '') {
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
	    'post_type'=> 'product',
	    'post_status' => 'publish',
	    'posts_per_page' =>$num,
	    'paged'=>$paged,
	    'order'=> 'DESC'
	  ) 
	);

      if($query->have_posts()): 

        while($query->have_posts()): $query->the_post(); 
        	echo '<li>';
          	get_template_part('templates/shop', 'loop');
          	echo '</li>';
        endwhile; 
        endif;  
    wp_reset_postdata();
    //check ajax call
    if($ajax) wp_die();
}

/*
 * load more script ajax hooks
 */
add_action('wp_ajax_nopriv_ajax_load_more_archive_product', 'ajax_load_more_archive_product');
add_action('wp_ajax_ajax_load_more_archive_product', 'ajax_load_more_archive_product');