<?php
/*
 * initial products dispaly
 */
function script_load_more_cat($args = array()) {
	$term = get_queried_object();
    $color_filter = isset( $_GET['filter_color'] ) ? $_GET['filter_color'] : '';
	$material_filter = isset( $_GET['filter_material'] ) ? $_GET['filter_material'] : '';
	$width_filter = isset( $_GET['filter_width'] ) ? $_GET['filter_width'] : '';
$output = '';
	$output .='<div class="ks-pro-btm-grd" id="ajax-cat" data-cat_id="'.$term->term_id.'" data-color="'.$color_filter.'" data-material="'.$material_filter.'" data-width="'.$width_filter.'">';
    $output .='<ul class="reset-list clearfix" id="cat-products">';
		$output .= cbv_load_more_cat_product($args, $term->term_id, $color_filter, $material_filter, $width_filter);
    $output .= '</ul>';
       
	$output .='<div class="ks-loadmore-btn" id="cbv-ajax-btn-4">
	<div class="ajaxloading" id="ajxaloader4" style="display:none"><img src="'.get_template_directory_uri().'/assets/images/loading.gif" alt="loader"></div>
	<span id="cat_page_count" data-page4="1" data-url="'.admin_url("admin-ajax.php").'" ></span>';
	$output .='</div>';
	$output .='</div>';
return $output;
}
/*
 * create short code for product archvie.
 */
add_shortcode('products_cat', 'script_load_more_cat');

function cbv_load_more_cat_product($args, $term_id = '', $color = '', $material='', $width = '') {
	$tax = '';
	$color = (isset( $color ) && !empty( $color ) )? explode( ',', wc_clean( wp_unslash( $color ) ) ) : '';
	$material = (isset( $material ) && !empty( $material ) )? explode( ',', wc_clean( wp_unslash( $material ) ) ) : '';
	$width = (isset( $width ) && !empty( $width ) )? explode( ',', wc_clean( wp_unslash( $width ) ) ) : '';
	if( !empty($color) && !empty($material) && !empty($width) ){
		$tax = array('relation' => 'AND',
				array('taxonomy' => 'pa_color','field' => 'slug','terms' => $color),
				array('taxonomy' => 'pa_material','field' => 'slug','terms' => $material),
				array('taxonomy' => 'pa_width','field' => 'slug','terms' => $width),
				array('taxonomy' => 'product_cat','field' => 'term_id','terms' => $term_id)
			);
	}elseif( !empty($color) && !empty($material) ){
		$tax = array('relation' => 'AND',
				array('taxonomy' => 'pa_color','field' => 'slug','terms' => $color),
				array('taxonomy' => 'pa_material','field' => 'slug','terms' => $material),
				array('taxonomy' => 'product_cat','field' => 'term_id','terms' => $term_id)
			);
	}elseif( !empty($color) && !empty($width) ){
		$tax = array('relation' => 'AND',
				array('taxonomy' => 'pa_color','field' => 'slug','terms' => $color),
				array('taxonomy' => 'pa_width','field' => 'slug','terms' => $width),
				array('taxonomy' => 'product_cat','field' => 'term_id','terms' => $term_id)
			);
	}elseif( !empty($material) && !empty($width) ){
		$tax = array('relation' => 'AND',
			array('taxonomy' => 'pa_material','field' => 'slug','terms' => $material),
			array('taxonomy' => 'pa_width','field' => 'slug','terms' => $width),
			array('taxonomy' => 'product_cat','field' => 'term_id','terms' => $term_id)
		);
	}elseif( !empty($color) ){
		$tax = array('relation' => 'AND',
			array('taxonomy' => 'pa_color','field' => 'slug','terms' => $color),
			array('taxonomy' => 'product_cat','field' => 'term_id','terms' => $term_id)
		);
	}elseif( !empty($material) ){
		$tax = array('relation' => 'AND',
			array('taxonomy' => 'pa_material','field' => 'slug','terms' => $material),
			array('taxonomy' => 'product_cat','field' => 'term_id','terms' => $term_id)
		);
	}elseif( !empty($width) ){
		$tax = array('relation' => 'AND',
			array('taxonomy' => 'pa_width','field' => 'slug','terms' => $width),
			array('taxonomy' => 'product_cat','field' => 'term_id','terms' => $term_id)
		);
	}else{
		$tax = array(array('taxonomy' => 'product_cat','field' => 'term_id','terms' => $term_id));
	}
	//number of products per page default
	$num = 4;
	//page number
	$query = new WP_Query(array( 
	    'post_type'=> 'product',
	    'post_status' => 'publish',
	    'posts_per_page' => $num,
	    'order'=> 'DESC',
	    'tax_query' => $tax
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
		    $output .= wc_the_stock_manage();
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
    	echo '<div class="no-resuts"><p>No more products.</p></div>';
    endif;  
    wp_reset_postdata();
    return $output;
}

/*
 * load more script call back
 */
function ajax_load_more_cat_product($args, $term_id = '') {
	//init ajax
	$ajax = false;
	//check ajax call or not
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	$ajax = true;
	}
	
    $tax = '';
	//number of posts per page default
	$num = 4;
	//page number
	if( isset($_POST['page']) ){
		$paged = $_POST['page'] + 1;
	}else{
		$paged = 1;
	}
	if( isset($_POST['term_id']) && !empty($_POST['term_id']) ){
		$term_id = $_POST['term_id'];
	}
	
	$color = (isset( $_POST['pa_color'] ) && !empty( $_POST['pa_color'] ) )?   explode( ',', wc_clean( wp_unslash( $_POST['pa_color'] ) ) ) : '';
	$material = (isset( $_POST['pa_material'] ) && !empty( $_POST['pa_material'] ) )?   explode( ',', wc_clean( wp_unslash( $_POST['pa_material'] ) ) ) : '';
	$width = (isset( $_POST['pa_width'] ) && !empty( $_POST['pa_width'] ) )?   explode( ',', wc_clean( wp_unslash( $_POST['pa_width'] ) ) ) : '';
	
	if( !empty($color) && !empty($material) && !empty($width) ){
		$tax = array('relation' => 'AND',
				array('taxonomy' => 'pa_color','field' => 'slug','terms' => $color),
				array('taxonomy' => 'pa_material','field' => 'slug','terms' => $material),
				array('taxonomy' => 'pa_width','field' => 'slug','terms' => $width),
				array('taxonomy' => 'product_cat','field' => 'term_id','terms' => $term_id)
			);
	}elseif( !empty($color) && !empty($material) ){
		$tax = array('relation' => 'AND',
				array('taxonomy' => 'pa_color','field' => 'slug','terms' => $color),
				array('taxonomy' => 'pa_material','field' => 'slug','terms' => $material),
				array('taxonomy' => 'product_cat','field' => 'term_id','terms' => $term_id)
			);
	}elseif( !empty($color) && !empty($width) ){
		$tax = array('relation' => 'AND',
				array('taxonomy' => 'pa_color','field' => 'slug','terms' => $color),
				array('taxonomy' => 'pa_width','field' => 'slug','terms' => $width),
				array('taxonomy' => 'product_cat','field' => 'term_id','terms' => $term_id)
			);
	}elseif( !empty($material) && !empty($width) ){
		$tax = array('relation' => 'AND',
			array('taxonomy' => 'pa_material','field' => 'slug','terms' => $material),
			array('taxonomy' => 'pa_width','field' => 'slug','terms' => $width),
			array('taxonomy' => 'product_cat','field' => 'term_id','terms' => $term_id)
		);
	}elseif( !empty($color) ){
		$tax = array('relation' => 'AND',
			array('taxonomy' => 'pa_color','field' => 'slug','terms' => $color),
			array('taxonomy' => 'product_cat','field' => 'term_id','terms' => $term_id)
		);

	}elseif( !empty($material) ){
		$tax = array('relation' => 'AND',
			array('taxonomy' => 'pa_material','field' => 'slug','terms' => $material),
			array('taxonomy' => 'product_cat','field' => 'term_id','terms' => $term_id)
		);
	}elseif( !empty($width) ){
		$tax = array('relation' => 'AND',
			array('taxonomy' => 'pa_width','field' => 'slug','terms' => $width),
			array('taxonomy' => 'product_cat','field' => 'term_id','terms' => $term_id)
		);
	}else{
		$tax = array(array('taxonomy' => 'product_cat','field' => 'term_id','terms' => $term_id));
	}

	$query = new WP_Query(array( 
	    'post_type'=> 'product',
	    'post_status' => 'publish',
	    'posts_per_page' =>$num,
	    'paged'=>$paged,
	    'order'=> 'DESC',
	    'tax_query' => $tax
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
add_action('wp_ajax_nopriv_ajax_load_more_cat_product', 'ajax_load_more_cat_product');
add_action('wp_ajax_ajax_load_more_cat_product', 'ajax_load_more_cat_product');