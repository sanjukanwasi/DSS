<?php

if ( ! function_exists( 'arabesque_mikado_get_hide_dep_for_header_centered_meta_boxes' ) ) {
	function arabesque_mikado_get_hide_dep_for_header_centered_meta_boxes() {
		$hide_dep_options = apply_filters( 'arabesque_mikado_filter_header_centered_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'arabesque_mikado_header_centered_logo_meta_map' ) ) {
	function arabesque_mikado_header_centered_logo_meta_map( $parent ) {
		$hide_dep_options = arabesque_mikado_get_hide_dep_for_header_centered_meta_boxes();
		
		arabesque_mikado_create_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'text',
				'name'            => 'mkdf_logo_wrapper_padding_header_centered_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Logo Padding', 'arabesque' ),
				'description'     => esc_html__( 'Insert padding in format: 0px 0px 1px 0px', 'arabesque' ),
				'args'            => array(
					'col_width' => 3
				),
				'dependency' => array(
					'hide' => array(
						'mkdf_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);

	}
	
	add_action( 'arabesque_mikado_action_header_logo_area_additional_meta_boxes_map', 'arabesque_mikado_header_centered_logo_meta_map', 10, 1 );
}

if ( ! function_exists( 'arabesque_mikado_header_centered_meta_map' ) ) {
	function arabesque_mikado_header_centered_meta_map( $parent ) {
		$hide_dep_options = arabesque_mikado_get_hide_dep_for_header_centered_meta_boxes();
		
		$header_centered_container = arabesque_mikado_add_admin_container_no_style(
			array(
				'type'            => 'container',
				'name'            => 'header_centered_container',
				'parent'          => $parent,
				'dependency' => array(
					'hide' => array(
						'mkdf_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
		
		arabesque_mikado_add_admin_section_title(
			array(
				'parent' => $header_centered_container,
				'name'   => 'header_centered_style',
				'title'  => esc_html__( 'Header Centered', 'arabesque' )
			)
		);

		arabesque_mikado_create_meta_box_field(
			array(
				'parent'          => $header_centered_container,
				'type'            => 'select',
				'name'            => 'mkdf_widgets_position_header_centered_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Widgets Position for Header Centered', 'arabesque' ),
				'description'     => esc_html__( 'Choose position for widgets for header centered', 'arabesque' ),
				'options' => array(
					'' => esc_html__('Default','arabesque'),
					'apart' => esc_html__('Apart from Menu','arabesque'),
					'beside' => esc_html__('Beside Menu','arabesque'),
				),
				'dependency' => array(
					'hide' => array(
						'mkdf_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);

		$arabesque_custom_sidebars = arabesque_mikado_get_custom_sidebars();
		if ( count( $arabesque_custom_sidebars ) > 0 ) {
			arabesque_mikado_create_meta_box_field(
				array(
					'name'        => 'mkdf_custom_header_centered_left_widget_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Custom Widget Area for Header Centered Left Widget Area', 'arabesque' ),
					'description' => esc_html__( 'Choose custom widget area to display in header centered on the left side of the menu"', 'arabesque' ),
					'parent'      => $header_centered_container,
					'options'     => $arabesque_custom_sidebars
				)
			);

			arabesque_mikado_create_meta_box_field(
				array(
					'name'        => 'mkdf_custom_header_centered_right_widget_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Custom Widget Area for Header Centered Right Widget Area', 'arabesque' ),
					'description' => esc_html__( 'Choose custom widget area to display in header centered on the right side of the menu"', 'arabesque' ),
					'parent'      => $header_centered_container,
					'options'     => $arabesque_custom_sidebars
				)
			);
		}
	}
	
	add_action( 'arabesque_mikado_action_additional_header_area_meta_boxes_map', 'arabesque_mikado_header_centered_meta_map', 10, 1 );
}