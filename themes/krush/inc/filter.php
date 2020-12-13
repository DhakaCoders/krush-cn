<?php
$base_link = get_permalink('product-all');
foreach ( $terms as $term ) {
	$found = true;

	$filter_name = 'filter_' . wc_attribute_taxonomy_slug( $taxonomy );
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$current_filter = isset( $_GET[ $filter_name ] ) ? explode( ',', wc_clean( wp_unslash( $_GET[ $filter_name ] ) ) ) : array();
	$current_filter = array_map( 'sanitize_title', $current_filter );

	if ( ! in_array( $term->slug, $current_filter, true ) ) {
		$current_filter[] = $term->slug;
	}
	$link = remove_query_arg( $filter_name, $base_link );
	if ( ! empty( $current_filter ) ) {
		asort( $current_filter );
		$link = add_query_arg( $filter_name, implode( ',', $current_filter ), $link );

		// Add Query type Arg to URL.
		if ( 'or' === $query_type && ! ( 1 === count( $current_filter ) ) ) {
			$link = add_query_arg( 'query_type_' . wc_attribute_taxonomy_slug( $taxonomy ), 'or', $link );
		}
		$link = str_replace( '%2C', ',', $link );
	}
	$link      = apply_filters( 'woocommerce_layered_nav_link', $link, $term, $taxonomy );
	$attribute_color = get_term_meta( $term->term_id, 'product_attribute_color', true);
	$attribute_shape = ( isset($attribute_color) && !empty($attribute_color))? $attribute_color:'';
	$attribute_shape_class = ( isset($attribute_color) && !empty($attribute_color))? ' attribute-type':'';
	$term_html = '<a rel="nofollow" href="' . esc_url( $link ) . '"><span class="term-controll'.$attribute_shape_class.'" style="background:'.$attribute_shape.'">' . esc_html( $term->name ) . '</span></a>';

	echo '<li class="woocommerce-widget-layered-nav-list__item wc-layered-nav-term">';
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended, WordPress.Security.EscapeOutput.OutputNotEscaped
	echo $term_html;
	echo '</li>';
}	