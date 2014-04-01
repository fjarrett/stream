<?php

/**
 * Handle deprecated filters
 */

global $wp_stream_deprecated_filters;

$wp_stream_deprecated_filters = array(
	'wp_stream_query_args' => array(
		'old'     => 'stream_query_args',
		'version' => '3.0.1',
	),
);

foreach ( $wp_stream_deprecated_filters as $new => $old ) {
	add_filter( $new, 'wp_stream_deprecated_filter_mapping' );
}

function wp_stream_deprecated_filter_mapping( $data ) {
	global $wp_stream_deprecated_filters;

	$filter = current_filter();

	if ( ! isset( $wp_stream_deprecated_filters[ $filter ][ 'old' ] ) ) {
		return $data;
	}

	if ( ! has_filter( $wp_stream_deprecated_filters[ $filter ][ 'old' ] ) ) {
		return $data;
	}

	$filter_args = array_merge(
		array(
			$wp_stream_deprecated_filters[ $filter ][ 'old' ],
		),
		func_get_args()
	);

	$data = call_user_func_array( 'apply_filters', $filter_args );

	_deprecated_function(
		sprintf( __( 'The %s filter', 'stream' ), $wp_stream_deprecated_filters[ $filter ][ 'old' ] ),
		$wp_stream_deprecated_filters[ $filter ][ 'version' ],
		$filter
	);

	return $data;
}

/**
 * stream_query()
 *
 * @deprecated 1.3.1
 * @deprecated Use wp_stream_query()
 * @see wp_stream_query()
 */
function stream_query( $args = array() ) {
	_deprecated_function( __FUNCTION__, '1.3.1', 'wp_stream_query()' );

	return wp_stream_query( $args );
}

/**
 * get_stream_meta()
 *
 * @deprecated 1.3.1
 * @deprecated Use wp_stream_get_meta
 * @see wp_stream_get_meta()
 */
function get_stream_meta( $record_id, $key = '', $single = false ) {
	_deprecated_function( __FUNCTION__, '1.3.1', 'wp_stream_get_meta()' );

	return wp_stream_get_meta( $record_id, $key, $single );
}

/**
 * update_stream_meta()
 *
 * @deprecated 1.3.1
 * @deprecated Use wp_stream_update_meta
 * @see wp_stream_update_meta()
 */
function update_stream_meta( $record_id, $meta_key, $meta_value, $prev_value = '' ) {
	_deprecated_function( __FUNCTION__, '1.3.1', 'wp_stream_update_meta()' );

	return wp_stream_update_meta( $record_id, $meta_key, $meta_value, $prev_value );
}

/**
 * existing_records()
 *
 * @deprecated 1.3.1
 * @deprecated Use wp_stream_existing_records
 * @see wp_stream_existing_records()
 */
function existing_records( $column, $table = '' ) {
	_deprecated_function( __FUNCTION__, '1.3.1', 'wp_stream_existing_records()' );

	return wp_stream_existing_records( $column, $table );
}
