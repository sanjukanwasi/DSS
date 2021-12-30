<?php
/**
 * WooCommerce helper functions
 */

if ( ! function_exists( 'arabesque_mikado_woocommerce_meta_box_functions' ) ) {
	function arabesque_mikado_woocommerce_meta_box_functions( $post_types ) {
		$post_types[] = 'product';

		return $post_types;
	}

	add_filter( 'arabesque_mikado_filter_meta_box_post_types_save', 'arabesque_mikado_woocommerce_meta_box_functions' );
}

if ( ! function_exists( 'arabesque_mikado_woocommerce_add_social_share_option' ) ) {
	function arabesque_mikado_woocommerce_add_social_share_option( $container ) {
		if ( arabesque_mikado_is_woocommerce_installed() ) {
			arabesque_mikado_add_admin_field(
				array(
					'type'          => 'yesno',
					'name'          => 'enable_social_share_on_product',
					'default_value' => 'no',
					'label'         => esc_html__( 'Product', 'arabesque' ),
					'description'   => esc_html__( 'Show Social Share for Product Items', 'arabesque' ),
					'parent'        => $container
				)
			);
		}
	}

	add_action( 'arabesque_mikado_action_post_types_social_share', 'arabesque_mikado_woocommerce_add_social_share_option', 10, 1 );
}

if ( ! function_exists( 'arabesque_mikado_woocommerce_style_dynamics_deps' ) ) {
	function arabesque_mikado_woocommerce_style_dynamics_deps( $deps ) {
		$style_dynamic_deps_array = array();
		if ( arabesque_mikado_is_woocommerce_installed() && arabesque_mikado_load_woo_assets() ) {
			$style_dynamic_deps_array[] = 'arabesque-mikado-woo';
			if ( arabesque_mikado_is_responsive_on() ) {
				$style_dynamic_deps_array[] = 'arabesque-mikado-woo-responsive';
			}
		}

		return array_merge( $deps, $style_dynamic_deps_array );
	}

	add_filter( 'arabesque_mikado_filter_style_dynamic_deps', 'arabesque_mikado_woocommerce_style_dynamics_deps' );
}

if ( ! function_exists( 'arabesque_mikado_get_woo_shortcode_module_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $template name of the template to load
	 * @param string $module name of the module folder
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 * @param array $additional_params array of additional parameters to pass to template
	 *
	 * @return html
	 * @see arabesque_mikado_get_template_part()
	 */
	function arabesque_mikado_get_woo_shortcode_module_template_part( $template, $module, $slug = '', $params = array(), $additional_params = array() ) {

		//HTML Content from template
		$html          = '';
		$template_path = 'framework/modules/woocommerce/shortcodes/' . $module;

		$temp = $template_path . '/' . $template;

		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}

		if ( is_array( $additional_params ) && count( $additional_params ) ) {
			extract( $additional_params );
		}

		$templates = array();

		if ( $temp !== '' ) {
			if ( $slug !== '' ) {
				$templates[] = "{$temp}-{$slug}.php";
			}

			$templates[] = $temp . '.php';
		}
		$located = arabesque_mikado_find_template_path( $templates );
		if ( $located ) {
			ob_start();
			include( $located );
			$html = ob_get_clean();
		}

		return $html;
	}
}

if ( ! function_exists( 'arabesque_mikado_is_woocommerce_page' ) ) {
	/**
	 * Function that checks if current page is woocommerce shop, product or product taxonomy
	 * @return bool
	 *
	 * @see is_woocommerce()
	 */
	function arabesque_mikado_is_woocommerce_page() {
		if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
			return is_woocommerce();
		} elseif ( function_exists( 'is_cart' ) && is_cart() ) {
			return is_cart();
		} elseif ( function_exists( 'is_checkout' ) && is_checkout() ) {
			return is_checkout();
		} elseif ( function_exists( 'is_account_page' ) && is_account_page() ) {
			return is_account_page();
		}
	}
}

if ( ! function_exists( 'arabesque_mikado_is_woocommerce_shop' ) ) {
	/**
	 * Function that checks if current page is shop or product page
	 * @return bool
	 *
	 * @see is_shop()
	 */
	function arabesque_mikado_is_woocommerce_shop() {
		return function_exists( 'is_shop' ) && ( is_shop() || is_product() );
	}
}

if ( ! function_exists( 'arabesque_mikado_get_woo_shop_page_id' ) ) {
	/**
	 * Function that returns shop page id that is set in WooCommerce settings page
	 * @return int id of shop page
	 */
	function arabesque_mikado_get_woo_shop_page_id() {
		if ( arabesque_mikado_is_woocommerce_installed() ) {
			//get shop page id from options table
			$shop_id = get_option( 'woocommerce_shop_page_id' );
			$page_id = ! empty( $shop_id ) ? $shop_id : '-1';

			return $page_id;
		}
	}
}

if ( ! function_exists( 'arabesque_mikado_is_product_category' ) ) {
	function arabesque_mikado_is_product_category() {
		return function_exists( 'is_product_category' ) && is_product_category();
	}
}

if ( ! function_exists( 'arabesque_mikado_is_product_tag' ) ) {
	function arabesque_mikado_is_product_tag() {
		return function_exists( 'is_product_tag' ) && is_product_tag();
	}
}

if ( ! function_exists( 'arabesque_mikado_load_woo_assets' ) ) {
	/**
	 * Function that checks whether WooCommerce assets needs to be loaded.
	 *
	 * @return bool
	 * @see arabesque_mikado_has_woocommerce_shortcode()
	 * @see arabesque_mikado_has_woocommerce_widgets()
	 * @see arabesque_mikado_is_woocommerce_page()
	 */
	function arabesque_mikado_load_woo_assets() {
		return arabesque_mikado_is_woocommerce_installed() && ( arabesque_mikado_is_woocommerce_page() || arabesque_mikado_has_woocommerce_shortcode() || arabesque_mikado_has_woocommerce_widgets() );
	}
}

if ( ! function_exists( 'arabesque_mikado_return_woocommerce_global_variable' ) ) {
	function arabesque_mikado_return_woocommerce_global_variable() {
		if ( arabesque_mikado_is_woocommerce_installed() ) {
			global $product;

			return $product;
		}
	}
}

if ( ! function_exists( 'arabesque_mikado_has_woocommerce_shortcode' ) ) {
	/**
	 * Function that checks if current page has at least one of WooCommerce shortcodes added
	 * @return bool
	 */
	function arabesque_mikado_has_woocommerce_shortcode() {
		$woocommerce_shortcodes = array(
			'add_to_cart',
			'add_to_cart_url',
			'product_page',
			'product',
			'products',
			'product_categories',
			'product_category',
			'recent_products',
			'featured_products',
			'sale_products',
			'best_selling_products',
			'top_rated_products',
			'product_attribute',
			'related_products',
			'woocommerce_messages',
			'woocommerce_cart',
			'woocommerce_checkout',
			'woocommerce_order_tracking',
			'woocommerce_my_account',
			'woocommerce_edit_address',
			'woocommerce_change_password',
			'woocommerce_view_order',
			'woocommerce_pay',
			'woocommerce_thankyou'
		);

		$woocommerce_shortcodes = apply_filters( 'arabesque_mikado_filter_woocommerce_shortcodes_list', $woocommerce_shortcodes );

		foreach ( $woocommerce_shortcodes as $woocommerce_shortcode ) {
			$has_shortcode = arabesque_mikado_has_shortcode( $woocommerce_shortcode );

			if ( $has_shortcode ) {
				return true;
			}
		}

		return false;
	}
}

if ( ! function_exists( 'arabesque_mikado_has_woocommerce_widgets' ) ) {
	/**
	 * Function that checks if current page has at least one of WooCommerce shortcodes added
	 * @return bool
	 */
	function arabesque_mikado_has_woocommerce_widgets() {
		$widgets_array = array(
			'mkdf_woocommerce_dropdown_cart',
			'woocommerce_widget_cart',
			'woocommerce_layered_nav',
			'woocommerce_layered_nav_filters',
			'woocommerce_price_filter',
			'woocommerce_product_categories',
			'woocommerce_product_search',
			'woocommerce_product_tag_cloud',
			'woocommerce_products',
			'woocommerce_recent_reviews',
			'woocommerce_recently_viewed_products',
			'woocommerce_top_rated_products'
		);

		$widgets_array = apply_filters( 'arabesque_mikado_filter_woocommerce_widgets_list', $widgets_array );

		foreach ( $widgets_array as $widget ) {
			$active_widget = is_active_widget( false, false, $widget );

			if ( $active_widget ) {
				return true;
			}
		}

		return false;
	}
}

if ( ! function_exists( 'arabesque_mikado_add_product_to_search_types' ) ) {
	function arabesque_mikado_add_product_to_search_types( $post_types ) {
		$post_types['product'] = esc_html__( 'Product', 'arabesque' );

		return $post_types;
	}

	add_filter( 'arabesque_mikado_filter_search_post_type_widget_params_post_type', 'arabesque_mikado_add_product_to_search_types' );
}

if ( ! function_exists( 'arabesque_mikado_get_woocommerce_sale' ) ) {
	function arabesque_mikado_get_woocommerce_sale( $product ) {
		$enable_percent_mark = arabesque_mikado_options()->getOptionValue( 'woo_enable_percent_sign_value' );
		$price               = intval( $product->get_regular_price() );
		$sale_price          = intval( $product->get_sale_price() );

		if ( $price > 0 && $enable_percent_mark === 'yes' ) {
			return '-' . ( 100 - round( ( $sale_price * 100 ) / $price ) ) . '%';
		} else {
			return esc_html__( 'Sale', 'arabesque' );
		}
	}
}

/**
 * Loads more function for portfolio.
 */
if ( ! function_exists( 'arabesque_mikado_product_ajax_load_category' ) ) {
	function arabesque_mikado_product_ajax_load_category() {
		$shortcode_params = array();

		if ( ! empty( $_POST ) ) {
			foreach ( $_POST as $key => $value ) {
				if ( $key !== '' ) {
					$addUnderscoreBeforeCapitalLetter = preg_replace( '/([A-Z])/', '_$1', $key );
					$setAllLettersToLowercase         = strtolower( $addUnderscoreBeforeCapitalLetter );

					$shortcode_params[ $setAllLettersToLowercase ] = $value;
				}
			}
		}

		$html = '';

		$product_list = new \ArabesqueCore\CPT\Shortcodes\ProductList\ProductList();

		$query_array                     = $product_list->generateProductQueryArray( $shortcode_params );
		$query_results                   = new \WP_Query( $query_array );
		$shortcode_params['this_object'] = $product_list;

		if ( $query_results->have_posts() ): while ( $query_results->have_posts() ) : $query_results->the_post();
			$html .= arabesque_mikado_get_woo_shortcode_module_template_part( 'templates/parts/' . $shortcode_params['info_position'], 'product-list', '', $shortcode_params );
		endwhile;
		else:
			$html .= '<p class="mkdf-no-posts">' . esc_html__( 'No products were found!', 'arabesque' ) . '</p>';
		endif;
		wp_reset_postdata();

		$return_obj = array(
			'html' => $html,
		);

		echo json_encode( $return_obj );
		exit;
	}

	add_action( 'wp_ajax_nopriv_arabesque_mikado_product_ajax_load_category', 'arabesque_mikado_product_ajax_load_category' );
	add_action( 'wp_ajax_arabesque_mikado_product_ajax_load_category', 'arabesque_mikado_product_ajax_load_category' );
}