<?php
/*
 * initial products dispaly
 */
function script_load_more_all_product($args = array()) {
	$color_filter = isset( $_GET['filter_color'] ) ? $_GET['filter_color'] : '';
	$material_filter = isset( $_GET['filter_material'] ) ? $_GET['filter_material'] : '';
	$width_filter = isset( $_GET['filter_width'] ) ? $_GET['filter_width'] : '';
	$output = '';
	$output .='<div class="ks-pro-btm-grd" id="ajax-all_product" data-color="'.$color_filter.'" data-material="'.$material_filter.'" data-width="'.$width_filter.'">';
	$output .='<div class="product-all-gallery">';
	$output .= cbv_load_more_all_product($args, $color_filter, $material_filter, $width_filter);
	$output .='</div>';
    $output .='<ul class="reset-list clearfix" id="all_product">';
	
    $output .= '</ul>';
       
	$output .='<div class="ks-loadmore-btn" id="cbv-ajax-btn-5">
	<div class="ajaxloading" id="ajxaloader5" style="display:none"><img src="'.get_template_directory_uri().'/assets/images/loading.gif" alt="loader"></div>
	<span id="allproducts_page_count" data-page5="1" data-url="'.admin_url("admin-ajax.php").'" style="display:none;" ></span>';
	$output .='</div>';
	$output .='</div>';
return $output;
}
/*
 * create short code for product archvie.
 */
add_shortcode('all_product', 'script_load_more_all_product');

function cbv_load_more_all_product($args, $color = '', $material='', $width = '') {
	$tax = '';
	$color = (isset( $color ) && !empty( $color ) )? explode( ',', wc_clean( wp_unslash( $color ) ) ) : '';
	$material = (isset( $material ) && !empty( $material ) )? explode( ',', wc_clean( wp_unslash( $material ) ) ) : '';
	$width = (isset( $width ) && !empty( $width ) )? explode( ',', wc_clean( wp_unslash( $width ) ) ) : '';
	if( !empty($color) && !empty($material) && !empty($width) ){
		$tax = array('relation' => 'AND',
				array('taxonomy' => 'pa_color','field' => 'slug','terms' => $color),
				array('taxonomy' => 'pa_material','field' => 'slug','terms' => $material),
				array('taxonomy' => 'pa_width','field' => 'slug','terms' => $width)
			);
	}elseif( !empty($color) && !empty($material) ){
		$tax = array('relation' => 'AND',
				array('taxonomy' => 'pa_color','field' => 'slug','terms' => $color),
				array('taxonomy' => 'pa_material','field' => 'slug','terms' => $material)
			);
	}elseif( !empty($color) && !empty($width) ){
		$tax = array('relation' => 'AND',
				array('taxonomy' => 'pa_color','field' => 'slug','terms' => $color),
				array('taxonomy' => 'pa_width','field' => 'slug','terms' => $width)
			);
	}elseif( !empty($material) && !empty($width) ){
		$tax = array('relation' => 'AND',
			array('taxonomy' => 'pa_material','field' => 'slug','terms' => $material),
			array('taxonomy' => 'pa_width','field' => 'slug','terms' => $width)
		);
	}elseif( !empty($color) ){
		$tax = array(array('taxonomy' => 'pa_color','field' => 'slug','terms' => $color));
	}elseif( !empty($material) ){
		$tax = array(array('taxonomy' => 'pa_material','field' => 'slug','terms' => $material));
	}elseif( !empty($width) ){
		$tax = array(array('taxonomy' => 'pa_width','field' => 'slug','terms' => $width));
	}
	//number of products per page default
	$num = 9;
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
		$total = $query->found_posts;
	  $i = 1;
	  while($query->have_posts()): $query->the_post(); 
		global $product, $woocommerce, $post; 
		$product_tag_868 = cbv_get_image_tag( get_post_thumbnail_id($product->get_id()), 'proall_868_750' );
		$product_src_868 = cbv_get_image_src( get_post_thumbnail_id($product->get_id()), 'proall_868_750' );
		$product_tag_426 = cbv_get_image_tag( get_post_thumbnail_id($product->get_id()), 'proall_426_368' );
		$product_src_426 = cbv_get_image_src( get_post_thumbnail_id($product->get_id()), 'proall_426_368' );
		$product_tag_648 = cbv_get_image_tag( get_post_thumbnail_id($product->get_id()), 'termgrid' );
		$product_src_648 = cbv_get_image_src( get_post_thumbnail_id($product->get_id()), 'termgrid' );

		$product_image_tag = cbv_get_image_tag( get_post_thumbnail_id($product->get_id()), 'productgrid' );
		$product_image_src = cbv_get_image_src( get_post_thumbnail_id($product->get_id()), 'productgrid' );
		
		if( $i <= 3 ){
            if( $i == 1 ){
				$output .='<div class="row">';
			    $output .='<div class="col-md-12">';
			    $output .='<div class="thubnail-grd-img-mdul-cntlr">';


	          	$output .='<div class="thubnail-grd-big-img-col">';
	            $output .='<div class="thubnail-grd-big-img inline-bg" style="background-image: url('.$product_src_868.')">';
	            $output .= $product_tag_868;
	            $output .='</div>';
	          	$output .='</div>';
            }

          	if( $i == 2 ){
          		$output .='<div class="thubnail-grd-small-col">';

	            $output .='<div class="thubnail-grd-small-img-cntlr">';
	            $output .='<div class="thubnail-grd-small-img inline-bg" style="background-image: url('.$product_src_426.')">';
	             $output .= $product_tag_426;   
	            $output .='</div>';
	            $output .='</div>';
        	}
        	if( $i == 3 ){
	            $output .='<div class="thubnail-grd-small-img-cntlr">';
	            $output .='<div class="thubnail-grd-small-img inline-bg" style="background-image: url('.$product_src_426.')">';
	             $output .= $product_tag_426;   
	            $output .='</div>';
	            $output .='</div>';
        	}
	        if( ($total == 2 AND $i== 2) OR ($total >=3 AND $i== 3) ){
	          $output .='</div>';
	      	}
	        if( ($total == 1 AND $i== 1) OR ($total == 2 AND $i==2) OR ($total >=3 AND $i==3) ){
		        $output .='</div>';
		      	$output .='</div>';
		    	$output .='</div>';
			}
		}

		if( $i <= 5 && $i > 3){
			if( $i == 4 ){
			    $output .='<div class="row">';
			    $output .='<div class="col-md-12">';
			    $output .='<div class="two-grd-img-mdul">';

		        $output .='<div class="two-grd-img-col">';
		        $output .= $product_tag_648;
		        $output .='</div>';
		    }
		    if( $i == 5 ){
		        $output .='<div class="two-grd-img-col">';
		        $output .= $product_tag_648;
		        $output .='</div>';
		    }
		    if( ($total == 4 AND $i== 4) OR ($total >= 4 AND $i== 5) ){
		        $output .='</div>';
		      	$output .='</div>';
		    	$output .='</div>';
		    }
		}

		if( $i <= 7 && $i > 5){
			if( $i == 6 ){
			    $output .='<div class="row">';
			    $output .='<div class="col-md-12">';
			    $output .='<div class="two-grd-img-mdul">';

	            $output .='<div class="three-gdr-col three-gdr-col-desc-cntlr">';
	            $output .='<div class="three-gdr-col-desc">';
	              $output .='<h2 class="three-gdr-col-desc-title ltr"> Summer <span>  Almost Gone: </span> </h2>';
	              $output .='<h3 class="three-gdr-col-desc-sub-title"> Flash Sale  </h3>';
	              $output .='<div class="fea-pro-desc-btn three-gdr-col-desc-btn">';
	              $output .='<a href="#"> גלי עוד  </a>';
	              $output .='</div>';
	            $output .='</div>';
	            $output .='</div>';

		        $output .='<div class="three-gdr-col">';
		        $output .= $product_image_tag;
		        $output .='</div>';
		    }
		    if( $i == 7 ){
		        $output .='<div class="three-gdr-col">';
		        $output .= $product_image_tag;
		        $output .='</div>';
		    }
		    if( ($total == 6 AND $i== 6) OR ($total >= 6 AND $i== 7) ){
		        $output .='</div>';
		      	$output .='</div>';
		    	$output .='</div>';
		    }
		}

		if( $i <= 9 && $i > 7){
			if( $i == 8 ){
			    $output .='<div class="row">';
			    $output .='<div class="col-md-12">';
			    $output .='<div class="thubnail-grd-img-mdul-cntlr thubnail-grd-big-img-lft">';

		        $output .='<div class="thubnail-grd-big-img-col">';
		        $output .='<div class="thubnail-grd-big-img inline-bg" style="background-image: url('.$product_src_868.')">';
                $output .= $product_tag_868;
            	$output .='</div>';
		        $output .='</div>';
		    }
		    if( $i == 9 ){
	            $output .='<div class="thubnail-grd-small-col">';
	            $output .='<div class="thubnail-grd-small-img-cntlr">';
	            $output .='<div class="thubnail-grd-small-img inline-bg" style="background-image: url('.$product_src_426.')">';
	            $output .= $product_tag_426;
	            $output .='</div>';
	            $output .='</div>';
	            $output .='<div class="thubnail-grd-small-img-cntlr thubnail-grd-small-desc three-gdr-col-desc-cntlr">';
	            $output .='<div class="three-gdr-col-desc">';
	            $output .='<h2 class="three-gdr-col-desc-title ltr"> Not Sure What  <span>  to choose? </span> </h2>';
	            $output .='<h3 class="three-gdr-col-desc-sub-title"> GiftCard  </h3>';
	            $output .='<div class="fea-pro-desc-btn three-gdr-col-desc-btn">';
	            $output .='<a href="#"> גלי עוד  </a>';
	            $output .='</div>';
	            $output .='</div>';
	            $output .='</div>';
	            $output .='</div>';
		    }
		    if( ($total == 8 AND $i== 8) OR ($total >= 6 AND $i== 9) ){
		        $output .='</div>';
		      	$output .='</div>';
		    	$output .='</div>';
		    }
		}

		$i++;
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
function ajax_load_more_all_product($args) {
	//init ajax
	$ajax = false;
	//check ajax call or not
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	$ajax = true;
	}
	$tax = '';
	//number of posts per page default
	$num = 9;
	//page number
	if( isset($_POST['page']) ){
		$paged = $_POST['page'] + 1;
	}else{
		$paged = 1;
	}

	$color = (isset( $_POST['pa_color'] ) && !empty( $_POST['pa_color'] ) )?   explode( ',', wc_clean( wp_unslash( $_POST['pa_color'] ) ) ) : '';
	$material = (isset( $_POST['pa_material'] ) && !empty( $_POST['pa_material'] ) )?   explode( ',', wc_clean( wp_unslash( $_POST['pa_material'] ) ) ) : '';
	$width = (isset( $_POST['pa_width'] ) && !empty( $_POST['pa_width'] ) )?   explode( ',', wc_clean( wp_unslash( $_POST['pa_width'] ) ) ) : '';

	
	if( !empty($color) && !empty($material) && !empty($width) ){
		$tax = array('relation' => 'AND',
				array('taxonomy' => 'pa_color','field' => 'slug','terms' => $color),
				array('taxonomy' => 'pa_material','field' => 'slug','terms' => $material),
				array('taxonomy' => 'pa_width','field' => 'slug','terms' => $width)
			);
	}elseif( !empty($color) && !empty($material) ){
		$tax = array('relation' => 'AND',
				array('taxonomy' => 'pa_color','field' => 'slug','terms' => $color),
				array('taxonomy' => 'pa_material','field' => 'slug','terms' => $material)
			);
	}elseif( !empty($color) && !empty($width) ){
		$tax = array('relation' => 'AND',
				array('taxonomy' => 'pa_color','field' => 'slug','terms' => $color),
				array('taxonomy' => 'pa_width','field' => 'slug','terms' => $width)
			);
	}elseif( !empty($material) && !empty($width) ){
		$tax = array('relation' => 'AND',
			array('taxonomy' => 'pa_material','field' => 'slug','terms' => $material),
			array('taxonomy' => 'pa_width','field' => 'slug','terms' => $width)
		);
	}elseif( !empty($color) ){
		$tax = array(array('taxonomy' => 'pa_color','field' => 'slug','terms' => $color));
	}elseif( !empty($material) ){
		$tax = array(array('taxonomy' => 'pa_material','field' => 'slug','terms' => $material));
	}elseif( !empty($width) ){
		$tax = array(array('taxonomy' => 'pa_width','field' => 'slug','terms' => $width));
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
add_action('wp_ajax_nopriv_ajax_load_more_all_product', 'ajax_load_more_all_product');
add_action('wp_ajax_ajax_load_more_all_product', 'ajax_load_more_all_product');