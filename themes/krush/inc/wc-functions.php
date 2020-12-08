<?php
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);


//add_action('woocommerce_before_main_content', 'get_custom_wc_output_content_wrapper', 11);
//add_action('woocommerce_after_main_content', 'get_custom_wc_output_content_wrapper_end', 9);
//add_filter( 'woocommerce_show_page_title', '__return_false' );
function get_custom_wc_output_content_wrapper(){

    if(is_shop() OR is_product_category()){ 
        echo '<section class="ks-pro-grd-sec"><div class="container-fluid"><div class="row"><div class="col-md-12"><div class="ks-pro-grd-sec-inr">';
        get_template_part('templates/shop', 'header-top');
        echo '<div class="ks-pro-btm-grd">';
    }


}

function get_custom_wc_output_content_wrapper_end(){
  if(is_shop() OR is_product_category()){
    echo '</div>';
    echo '</div></div></div></div></section>';
  }

}

function get_array( $string ){
    if( !empty( $string ) ){ 
        $str_arr = preg_split ("/\,/", $string);   
        return $str_arr;
    }
    return false;
}

/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
  function loop_columns() {
    return 3; // 3 products per row
  }
}

/*Loop Hooks*/


/**
 * Add loop inner details are below
 */

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

add_action('woocommerce_shop_loop_item_title', 'add_shorttext_below_title_loop', 5);
if (!function_exists('add_shorttext_below_title_loop')) {
    function add_shorttext_below_title_loop() {
        get_template_part('templates/shop', 'loop');
    }
}

function wc_stock_manage(){
    global $product;
    $StockQ = $product->get_stock_quantity();
    if ( ! $product->managing_stock() && ! $product->is_in_stock() ){
        echo '<div class="ks-gidt-rgt"><span class="out-of-stock">Out of Stock</span></div>';
        
    } elseif( $StockQ < 1 ) {
        if ($product->backorders_allowed()){
            echo '<div class="ks-gidt-rgt"><span class="backorders">Available on Backorder</span></div>';
        } elseif ( !$product->backorders_allowed() && $StockQ == 0 && ! $product->is_in_stock()){
            echo '<div class="ks-gidt-rgt"><span class="out-of-stock">Out of Stock</span></div>';
        } elseif ( $product->is_on_backorder() ){
            echo '<div class="ks-gidt-rgt"><span class="backorders">Available on Backorder</span></div>';
        }
    } 
}

function wc_the_stock_manage(){
    global $product;
    $StockQ = $product->get_stock_quantity();
    $output = '';
    if ( ! $product->managing_stock() && ! $product->is_in_stock() ){
        $output .= '<div class="ks-gidt-rgt"><span class="out-of-stock">Out of Stock</span></div>';
        
    } elseif( $StockQ < 1 ) {
        if ($product->backorders_allowed()){
            $output .= '<div class="ks-gidt-rgt"><span class="backorders">Available on Backorder</span></div>';
        } elseif ( !$product->backorders_allowed() && $StockQ == 0 && ! $product->is_in_stock()){
            $output .= '<div class="ks-gidt-rgt"><span class="out-of-stock">Out of Stock</span></div>';
        } elseif ( $product->is_on_backorder() ){
            $output .= '<div class="ks-gidt-rgt"><span class="backorders">Available on Backorder</span></div>';
        }
    } 
    return $output;
}

add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options –> Reading
  // Return the number of products you wanna show per page.
  $cols = 3;
  return $cols;
}


//add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
function jk_related_products_args( $args ) {
$args['posts_per_page'] = 8; // 4 related products
return $args;
}



// change a number of the breadcrumb defaults.
add_filter( 'woocommerce_breadcrumb_defaults', 'cbv_woocommerce_breadcrumbs' );
if( !function_exists('cbv_woocommerce_breadcrumbs')):
function cbv_woocommerce_breadcrumbs() {
    return array(
            'delimiter'   => '',
            'wrap_before' => '<ul class="reset-list">',
            'wrap_after'  => '</ul>',
            'before'      => '<li>',
            'after'       => '</li>',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );
}
endif;

/*Remove Single page Woocommerce Hooks & Filters are below*/
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


add_action('woocommerce_single_product_summary', 'add_custom_box_product_summary', 5);
if (!function_exists('add_custom_box_product_summary')) {
    function add_custom_box_product_summary() {
        get_template_part('templates/product-single', 'summary');
    }
}

add_action('woocommerce_cbv_releted_product', 'cbv_related_products', 5);
if (!function_exists('cbv_related_products')) {
    function cbv_related_products() {
        get_template_part('templates/product-single', 'related');
    }
}

add_filter( 'woocommerce_product_tabs', 'woo_custom_product_tabs' );
function woo_custom_product_tabs( $tabs ) {

    // 1) Removing tabs
    unset( $tabs['description'] );              // Remove the description tab
    unset( $tabs['reviews'] );               // Remove the reviews tab
    unset( $tabs['additional_information'] );   // Remove the additional information tab

    //ACF Description tab
    $tabs['opinion_tab'] = array(
        'title'     => __( 'Opinion', 'woocommerce' ),
        'priority'  => 2,
        'callback'  => 'woo_opinion_tab_content'
    );

    $tabs['instructions_tab'] = array(
        'title'     => __( 'Instructions', 'woocommerce' ),
        'priority'  => 1,
        'callback'  => 'woo_instructions_tab_content'
    );
    $tabs['deliveries_tab'] = array(
        'title'     => __( 'Deliveries', 'woocommerce' ),
        'priority'  => 4,
        'callback'  => 'woo_deliveries_tab_content'
    );

    $tabs['waves_tab'] = array(
        'title'     => __( 'More waves', 'woocommerce' ),
        'priority'  => 3,
        'callback'  => 'woo_waves_tab_content'
    );
    return $tabs;

}

// New Tab contents

function woo_opinion_tab_content() {
    global $product;
    $opinion = get_field('opinion', $product->get_id() );
    if( !empty($opinion) ){
        echo '<div class="opinion-content">';
        echo wpautop( $opinion );
        echo '</div>';
    }
}
function woo_instructions_tab_content() {
    global $product;
    $instructions = get_field('instructions', $product->get_id() );
    if( !empty($instructions) ){
        echo '<div class="instructions-content">';
        echo wpautop( $instructions );
        echo '</div>';
    }
}

function woo_deliveries_tab_content() {
    global $product;
    $deliveries = get_field('deliveries', $product->get_id() );
    if( !empty($deliveries) ){
        echo '<div class="deliveries-content">';
        echo wpautop( $deliveries );
        echo '</div>';
    }
}
function woo_waves_tab_content() {
    global $product;
    $more_waves = get_field('more_waves', $product->get_id() );
    if( !empty($more_waves) ){
        echo '<div class="more_waves-content">';
        echo wpautop( $more_waves );
        echo '</div>';
    }
}

function my_woocommerce_product_single_add_to_cart_text() {
    return 'הוסף לעגלה';
}
add_filter( 'woocommerce_product_single_add_to_cart_text', 'my_woocommerce_product_single_add_to_cart_text', 20 );


add_action('woocommerce_after_add_to_cart_quantity', 'cbv_add_wishlist_btn');
function cbv_add_wishlist_btn(){
    global $product;
    $pid = $product->get_id();
    echo '<span class="controll-wishlist">';
    $shortcode = "[ti_wishlists_addtowishlist product_id='{$pid}' variation_id='0']";
    echo do_shortcode($shortcode);
    echo '</span>';
}

function sm_pre_get_posts( $query ) {
    // check if the user is requesting an admin page 
    // or current query is not the main query
    if ( is_admin() || ! $query->is_main_query() ){
        return;
    }

    // edit the query only when post type is 'accommodation'
    // if it isn't, return
    if ( !is_post_type_archive( 'product' ) ){
        return;
    }
    $post_type = 'product';
    $meta_query = array();
    $keyword = '';

    if( isset($_GET['keyword']) && !empty($_GET['keyword']) ){
        $keyword = $_GET['keyword'];
    }

    if( !empty( $keyword ) ){
        $query->set('post_type', $post_type);
        $query->set( 's', $keyword );
        //$query->set( 'category_name', $keyword );
    }
    return $query;
    
}
add_action( 'pre_get_posts', 'sm_pre_get_posts', 1 );