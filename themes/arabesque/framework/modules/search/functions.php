<?php

if ( ! function_exists( 'arabesque_mikado_include_search_types_before_load' ) ) {
    /**
     * Load's all header types before load files by going through all folders that are placed directly in header types folder.
     * Functions from this files before-load are used to set all hooks and variables before global options map are init
     */
    function arabesque_mikado_include_search_types_before_load() {
        foreach ( glob( MIKADO_FRAMEWORK_SEARCH_ROOT_DIR . '/types/*/before-load.php' ) as $module_load ) {
            include_once $module_load;
        }
    }

    add_action( 'arabesque_mikado_action_options_map', 'arabesque_mikado_include_search_types_before_load', 1 ); // 1 is set to just be before header option map init
}

if ( ! function_exists( 'arabesque_mikado_load_search' ) ) {
	function arabesque_mikado_load_search() {
		$search_type_meta = arabesque_mikado_options()->getOptionValue( 'search_type' );
		$search_type      = ! empty( $search_type_meta ) ? $search_type_meta : 'fullscreen';
		
		if ( arabesque_mikado_active_widget( false, false, 'mkdf_search_opener' ) ) {
			include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/search/types/' . $search_type . '/' . $search_type . '.php';
		}
	}
	
	add_action( 'init', 'arabesque_mikado_load_search' );
}

if ( ! function_exists( 'arabesque_mikado_get_holder_params_search' ) ) {
	/**
	 * Function which return holder class and holder inner class for blog pages
	 */
	function arabesque_mikado_get_holder_params_search() {
		$params_list = array();
		
		$layout = arabesque_mikado_options()->getOptionValue( 'search_page_layout' );
		if ( $layout == 'in-grid' ) {
			$params_list['holder'] = 'mkdf-container';
			$params_list['inner']  = 'mkdf-container-inner clearfix';
		} else {
			$params_list['holder'] = 'mkdf-full-width';
			$params_list['inner']  = 'mkdf-full-width-inner';
		}
		
		/**
		 * Available parameters for holder params
		 * -holder
		 * -inner
		 */
		return apply_filters( 'arabesque_mikado_filter_search_holder_params', $params_list );
	}
}

if ( ! function_exists( 'arabesque_mikado_get_search_page' ) ) {
	function arabesque_mikado_get_search_page() {
		$sidebar_layout = arabesque_mikado_sidebar_layout();
		
		$params = array(
			'sidebar_layout' => $sidebar_layout
		);
		
		arabesque_mikado_get_module_template_part( 'templates/holder', 'search', '', $params );
	}
}

if ( ! function_exists( 'arabesque_mikado_get_search_page_layout' ) ) {
	/**
	 * Function which create query for blog lists
	 */
	function arabesque_mikado_get_search_page_layout() {
		global $wp_query;
		$path   = apply_filters( 'arabesque_mikado_filter_search_page_path', 'templates/page' );
		$type   = apply_filters( 'arabesque_mikado_filter_search_page_layout', 'default' );
		$module = apply_filters( 'arabesque_mikado_filter_search_page_module', 'search' );
		$plugin = apply_filters( 'arabesque_mikado_filter_search_page_plugin_override', false );
		
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
		
		$params = array(
			'type'          => $type,
			'query'         => $wp_query,
			'paged'         => $paged,
			'max_num_pages' => arabesque_mikado_get_max_number_of_pages(),
		);
		
		$params = apply_filters( 'arabesque_mikado_filter_search_page_params', $params );
		
		arabesque_mikado_get_module_template_part( $path . '/' . $type, $module, '', $params, $plugin );
	}
}

if ( ! function_exists( 'arabesque_mikado_get_search_submit_icon_class' ) ) {
	/**
	 * Loads search submit icon class
	 */
	function arabesque_mikado_get_search_submit_icon_class() {
		$classes = array(
			'mkdf-search-submit'
		);

		$classes[] = arabesque_mikado_get_icon_sources_class( 'search', 'mkdf-search-submit' );

		return $classes;
	}
}

if ( ! function_exists( 'arabesque_mikado_get_search_close_icon_class' ) ) {
	/**
	 * Loads search close icon class
	 */
	function arabesque_mikado_get_search_close_icon_class() {
		$classes = array(
			'mkdf-search-close'
		);

		$classes[] = arabesque_mikado_get_icon_sources_class( 'search', 'mkdf-search-close' );

		return $classes;
	}
}