<?php

if ( ! function_exists( 'arabesque_mikado_error_404_options_map' ) ) {
	function arabesque_mikado_error_404_options_map() {

		arabesque_mikado_add_admin_page(
			array(
				'slug'  => '__404_error_page',
				'title' => esc_html__( '404 Error Page', 'arabesque' ),
				'icon'  => 'fa fa-exclamation-triangle'
			)
		);

		$panel_404_header = arabesque_mikado_add_admin_panel(
			array(
				'page'  => '__404_error_page',
				'name'  => 'panel_404_header',
				'title' => esc_html__( 'Header', 'arabesque' )
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'      => $panel_404_header,
				'type'        => 'color',
				'name'        => '404_menu_area_background_color_header',
				'label'       => esc_html__( 'Background Color', 'arabesque' ),
				'description' => esc_html__( 'Choose a background color for header area', 'arabesque' )
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $panel_404_header,
				'type'          => 'text',
				'name'          => '404_menu_area_background_transparency_header',
				'default_value' => '',
				'label'         => esc_html__( 'Background Transparency', 'arabesque' ),
				'description'   => esc_html__( 'Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)', 'arabesque' ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'      => $panel_404_header,
				'type'        => 'color',
				'name'        => '404_menu_area_border_color_header',
				'label'       => esc_html__( 'Border Color', 'arabesque' ),
				'description' => esc_html__( 'Choose a border bottom color for header area', 'arabesque' )
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $panel_404_header,
				'type'          => 'select',
				'name'          => '404_header_style',
				'default_value' => '',
				'label'         => esc_html__( 'Header Skin', 'arabesque' ),
				'description'   => esc_html__( 'Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style', 'arabesque' ),
				'options'       => array(
					''             => esc_html__( 'Default', 'arabesque' ),
					'light-header' => esc_html__( 'Light', 'arabesque' ),
					'dark-header'  => esc_html__( 'Dark', 'arabesque' )
				)
			)
		);

		$panel_404_options = arabesque_mikado_add_admin_panel(
			array(
				'page'  => '__404_error_page',
				'name'  => 'panel_404_options',
				'title' => esc_html__( '404 Page Options', 'arabesque' )
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent' => $panel_404_options,
				'type'   => 'color',
				'name'   => '404_page_background_color',
				'label'  => esc_html__( 'Background Color', 'arabesque' )
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'      => $panel_404_options,
				'type'        => 'image',
				'name'        => '404_page_background_image',
				'label'       => esc_html__( 'Background Image', 'arabesque' ),
				'description' => esc_html__( 'Choose a background image for 404 page', 'arabesque' )
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'      => $panel_404_options,
				'type'        => 'image',
				'name'        => '404_page_background_pattern_image',
				'label'       => esc_html__( 'Pattern Background Image', 'arabesque' ),
				'description' => esc_html__( 'Choose a pattern image for 404 page', 'arabesque' )
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'      => $panel_404_options,
				'type'        => 'image',
				'name'        => '404_page_title_image',
				'label'       => esc_html__( 'Title Image', 'arabesque' ),
				'description' => esc_html__( 'Choose a background image for displaying above 404 page Title', 'arabesque' )
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $panel_404_options,
				'type'          => 'text',
				'name'          => '404_title',
				'default_value' => '',
				'label'         => esc_html__( 'Title', 'arabesque' ),
				'description'   => esc_html__( 'Enter title for 404 page. Default label is "404".', 'arabesque' )
			)
		);

		$first_level_group = arabesque_mikado_add_admin_group(
			array(
				'parent'      => $panel_404_options,
				'name'        => 'first_level_group',
				'title'       => esc_html__( 'Title Style', 'arabesque' ),
				'description' => esc_html__( 'Define styles for 404 page title', 'arabesque' )
			)
		);

		$first_level_row1 = arabesque_mikado_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row1'
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent' => $first_level_row1,
				'type'   => 'colorsimple',
				'name'   => '404_title_color',
				'label'  => esc_html__( 'Text Color', 'arabesque' ),
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row1,
				'type'          => 'fontsimple',
				'name'          => '404_title_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'arabesque' ),
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_title_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'arabesque' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_title_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'arabesque' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$first_level_row2 = arabesque_mikado_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row2',
				'next'   => true
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_title_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'arabesque' ),
				'options'       => arabesque_mikado_get_font_style_array()
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_title_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'arabesque' ),
				'options'       => arabesque_mikado_get_font_weight_array()
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row2,
				'type'          => 'textsimple',
				'name'          => '404_title_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'arabesque' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_title_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'arabesque' ),
				'options'       => arabesque_mikado_get_text_transform_array()
			)
		);

		$first_level_group_responsive = arabesque_mikado_add_admin_group(
			array(
				'parent'      => $panel_404_options,
				'name'        => 'first_level_group_responsive',
				'title'       => esc_html__( 'Title Style Responsive', 'arabesque' ),
				'description' => esc_html__( 'Define responsive styles for 404 page title (under 680px)', 'arabesque' )
			)
		);

		$first_level_row3 = arabesque_mikado_add_admin_row(
			array(
				'parent' => $first_level_group_responsive,
				'name'   => 'first_level_row3'
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row3,
				'type'          => 'textsimple',
				'name'          => '404_title_responsive_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'arabesque' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row3,
				'type'          => 'textsimple',
				'name'          => '404_title_responsive_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'arabesque' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row3,
				'type'          => 'textsimple',
				'name'          => '404_title_responsive_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'arabesque' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $panel_404_options,
				'type'          => 'text',
				'name'          => '404_subtitle',
				'default_value' => '',
				'label'         => esc_html__( 'Subtitle', 'arabesque' ),
				'description'   => esc_html__( 'Enter subtitle for 404 page. Default label is "PAGE NOT FOUND".', 'arabesque' )
			)
		);

		$second_level_group = arabesque_mikado_add_admin_group(
			array(
				'parent'      => $panel_404_options,
				'name'        => 'second_level_group',
				'title'       => esc_html__( 'Subtitle Style', 'arabesque' ),
				'description' => esc_html__( 'Define styles for 404 page subtitle', 'arabesque' )
			)
		);

		$second_level_row1 = arabesque_mikado_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row1'
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent' => $second_level_row1,
				'type'   => 'colorsimple',
				'name'   => '404_subtitle_color',
				'label'  => esc_html__( 'Text Color', 'arabesque' ),
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row1,
				'type'          => 'fontsimple',
				'name'          => '404_subtitle_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'arabesque' ),
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_subtitle_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'arabesque' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_subtitle_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'arabesque' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$second_level_row2 = arabesque_mikado_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row2',
				'next'   => true
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_subtitle_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'arabesque' ),
				'options'       => arabesque_mikado_get_font_style_array()
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_subtitle_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'arabesque' ),
				'options'       => arabesque_mikado_get_font_weight_array()
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row2,
				'type'          => 'textsimple',
				'name'          => '404_subtitle_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'arabesque' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_subtitle_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'arabesque' ),
				'options'       => arabesque_mikado_get_text_transform_array()
			)
		);

		$second_level_group_responsive = arabesque_mikado_add_admin_group(
			array(
				'parent'      => $panel_404_options,
				'name'        => 'second_level_group_responsive',
				'title'       => esc_html__( 'Subtitle Style Responsive', 'arabesque' ),
				'description' => esc_html__( 'Define responsive styles for 404 page subtitle (under 680px)', 'arabesque' )
			)
		);

		$second_level_row3 = arabesque_mikado_add_admin_row(
			array(
				'parent' => $second_level_group_responsive,
				'name'   => 'second_level_row3'
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row3,
				'type'          => 'textsimple',
				'name'          => '404_subtitle_responsive_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'arabesque' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row3,
				'type'          => 'textsimple',
				'name'          => '404_subtitle_responsive_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'arabesque' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row3,
				'type'          => 'textsimple',
				'name'          => '404_subtitle_responsive_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'arabesque' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $panel_404_options,
				'type'          => 'text',
				'name'          => '404_text',
				'default_value' => '',
				'label'         => esc_html__( 'Text', 'arabesque' ),
				'description'   => esc_html__( 'Enter text for 404 page.', 'arabesque' )
			)
		);

		$third_level_group = arabesque_mikado_add_admin_group(
			array(
				'parent'      => $panel_404_options,
				'name'        => '$third_level_group',
				'title'       => esc_html__( 'Text Style', 'arabesque' ),
				'description' => esc_html__( 'Define styles for 404 page text', 'arabesque' )
			)
		);

		$third_level_row1 = arabesque_mikado_add_admin_row(
			array(
				'parent' => $third_level_group,
				'name'   => '$third_level_row1'
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent' => $third_level_row1,
				'type'   => 'colorsimple',
				'name'   => '404_text_color',
				'label'  => esc_html__( 'Text Color', 'arabesque' ),
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row1,
				'type'          => 'fontsimple',
				'name'          => '404_text_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'arabesque' ),
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_text_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'arabesque' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_text_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'arabesque' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$third_level_row2 = arabesque_mikado_add_admin_row(
			array(
				'parent' => $third_level_group,
				'name'   => '$third_level_row2',
				'next'   => true
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_text_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'arabesque' ),
				'options'       => arabesque_mikado_get_font_style_array()
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_text_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'arabesque' ),
				'options'       => arabesque_mikado_get_font_weight_array()
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'textsimple',
				'name'          => '404_text_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'arabesque' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_text_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'arabesque' ),
				'options'       => arabesque_mikado_get_text_transform_array()
			)
		);

		$third_level_group_responsive = arabesque_mikado_add_admin_group(
			array(
				'parent'      => $panel_404_options,
				'name'        => 'third_level_group_responsive',
				'title'       => esc_html__( 'Text Style Responsive', 'arabesque' ),
				'description' => esc_html__( 'Define responsive styles for 404 page text (under 680px)', 'arabesque' )
			)
		);

		$third_level_row3 = arabesque_mikado_add_admin_row(
			array(
				'parent' => $third_level_group_responsive,
				'name'   => 'third_level_row3'
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row3,
				'type'          => 'textsimple',
				'name'          => '404_text_responsive_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'arabesque' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row3,
				'type'          => 'textsimple',
				'name'          => '404_text_responsive_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'arabesque' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row3,
				'type'          => 'textsimple',
				'name'          => '404_text_responsive_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'arabesque' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'      => $panel_404_options,
				'type'        => 'text',
				'name'        => '404_back_to_home',
				'label'       => esc_html__( 'Back to Home Button Label', 'arabesque' ),
				'description' => esc_html__( 'Enter label for "Back to home" button', 'arabesque' )
			)
		);

		arabesque_mikado_add_admin_field(
			array(
				'parent'        => $panel_404_options,
				'type'          => 'select',
				'name'          => '404_button_style',
				'default_value' => '',
				'label'         => esc_html__( 'Button Skin', 'arabesque' ),
				'description'   => esc_html__( 'Choose a style to make Back to Home button in that predefined style', 'arabesque' ),
				'options'       => array(
					''            => esc_html__( 'Default', 'arabesque' ),
					'light-style' => esc_html__( 'Light', 'arabesque' )
				)
			)
		);
	}

	add_action( 'arabesque_mikado_action_options_map', 'arabesque_mikado_error_404_options_map', 17 );
}