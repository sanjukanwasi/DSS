<?php

if ( ! function_exists( 'arabesque_mikado_set_search_covers_header_global_option' ) ) {
    /**
     * This function set search type value for search options map
     */
    function arabesque_mikado_set_search_covers_header_global_option( $search_type_options ) {
        $search_type_options['covers-header'] = esc_html__( 'Covers Header', 'arabesque' );

        return $search_type_options;
    }

    add_filter( 'arabesque_mikado_filter_search_type_global_option', 'arabesque_mikado_set_search_covers_header_global_option' );
}

if ( ! function_exists( 'arabesque_mikado_search_in_grid_dependency_covers_header' ) ) {
	/**
	 * Add dependency for 'search_in_grid' field type
	 * @param $dependency_array
	 * * @return array modified array of dependecies
	 */
	function arabesque_mikado_search_in_grid_dependency_covers_header($dependency_array) {

		$dependency_array[] = 'covers-header';

		return $dependency_array;
	}

	add_filter( 'search_in_grid_dependency', 'arabesque_mikado_search_in_grid_dependency_covers_header' );
}