<?php

// Prevent direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	exit;
}

class DSLC_Html extends DSLC_Module {

	var $module_id;
	var $module_title;
	var $module_icon;
	var $module_category;

	function __construct() {

		$this->module_id = 'DSLC_Html';
		$this->module_title = __( 'HTML', 'live-composer-page-builder' );
		$this->module_icon = 'code';
		$this->module_category = 'General';
	}

	function options() {

		$dslc_options = array(

			array(
				'label' => __( 'Show On', 'live-composer-page-builder' ),
				'id' => 'css_show_on',
				'std' => 'desktop tablet phone',
				'type' => 'checkbox',
				'choices' => array(
					array(
						'label' => __( 'Desktop', 'live-composer-page-builder' ),
						'value' => 'desktop',
					),
					array(
						'label' => __( 'Tablet', 'live-composer-page-builder' ),
						'value' => 'tablet',
					),
					array(
						'label' => __( 'Phone', 'live-composer-page-builder' ),
						'value' => 'phone',
					),
				),
			),

			array(
				'label' => __( 'HTML/Shortcode', 'live-composer-page-builder' ),
				'id' => 'content',
				'std' => '<p>Just some placeholder content. Edit the module to change it.</p>',
				'type' => 'textarea',
				'section' => 'functionality',
			),

			array(
				'label' => __( 'Error-Proof Mode', 'live-composer-page-builder' ),
				'id' => 'error_proof_mode',
				'std' => '',
				'type' => 'checkbox',
				'choices' => array(
					array(
						'label' => __( 'Enabled', 'live-composer-page-builder' ),
						'value' => 'active'
					)
				),
				'help' => __( 'Some JavaScript code and shortcodes can break the page editing.<br> Use <b>Error-Proof Mode</b> to make it work.', 'live-composer-page-builder' ),
			),

			/**
			 * Styling Options
			 */

			array(
				'label' => __( 'Enable/Disable Custom CSS', 'live-composer-page-builder' ),
				'id' => 'css_custom',
				'std' => 'disabled',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => __( 'Enabled', 'live-composer-page-builder' ),
						'value' => 'enabled'
					),
					array(
						'label' => __( 'Disabled', 'live-composer-page-builder' ),
						'value' => 'disabled'
					),
				),
				'section' => 'styling',
			),
			array(
				'label' => __( 'BG Color', 'live-composer-page-builder' ),
				'id' => 'css_main_bg_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content',
				'affect_on_change_rule' => 'background-color',
				'section' => 'styling',
			),
			array(
				'label' => __( 'Content border', 'live-composer-page-builder' ),
				'id' => 'content_border',
				'type' => 'group_border',
				'tab' => __( 'general', 'live-composer-page-builder' ),
				'section' => 'styling',
				'affect_on_change_el' => '.dslc-html-module-content',
				'values' => array(
					'border_color' => 'css_main_border_color',
					'border_width' => 'css_main_border_width',
					'border_trbl' => 'css_main_border_trbl',
					'border_radius_top_left' => 'css_main_border_radius_top',
					'border_radius_top_right' => 'css_main_border_radius_top',
					'border_radius_bottom_left' => 'css_main_border_radius_bottom',
					'border_radius_bottom_right' => 'css_main_border_radius_bottom',
				),
			),
			array(
				'label' => __( 'Border Color', 'live-composer-page-builder' ),
				'id' => 'css_main_border_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content',
				'affect_on_change_rule' => 'border-color',
				'section' => 'styling',
			),
			array(
				'label' => __( 'Border Width', 'live-composer-page-builder' ),
				'id' => 'css_main_border_width',
				'min' => 0,
				'max' => 10,
				'increment' => 1,
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content',
				'affect_on_change_rule' => 'border-width',
				'section' => 'styling',
				'ext' => 'px',
			),
			array(
				'label' => __( 'Borders', 'live-composer-page-builder' ),
				'id' => 'css_main_border_trbl',
				'std' => 'top right bottom left',
				'type' => 'checkbox',
				'choices' => array(
					array(
						'label' => __( 'Top', 'live-composer-page-builder' ),
						'value' => 'top'
					),
					array(
						'label' => __( 'Right', 'live-composer-page-builder' ),
						'value' => 'right'
					),
					array(
						'label' => __( 'Bottom', 'live-composer-page-builder' ),
						'value' => 'bottom'
					),
					array(
						'label' => __( 'Left', 'live-composer-page-builder' ),
						'value' => 'left'
					),
				),
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content',
				'affect_on_change_rule' => 'border-style',
				'section' => 'styling',
			),
			array(
				'label' => __( 'Border Radius - Top', 'live-composer-page-builder' ),
				'id' => 'css_main_border_radius_top',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content',
				'affect_on_change_rule' => 'border-top-left-radius,border-top-right-radius',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'section' => 'styling',
				'ext' => 'px',
			),
			array(
				'label' => __( 'Border Radius - Bottom', 'live-composer-page-builder' ),
				'id' => 'css_main_border_radius_bottom',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content',
				'affect_on_change_rule' => 'border-bottom-left-radius,border-bottom-right-radius',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'section' => 'styling',
				'ext' => 'px',
			),
			array(
				'label' => __( 'Margin Bottom', 'live-composer-page-builder' ),
				'id' => 'css_margin_bottom',
				'min' => -1000,
				'max' => 1000,
				'increment' => 1,
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'styling',
				'ext' => 'px',
			),
			array(
				'label' => __( 'Minimum Height', 'live-composer-page-builder' ),
				'id' => 'css_min_height',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content',
				'affect_on_change_rule' => 'min-height',
				'section' => 'styling',
				'ext' => 'px',
				'min' => 0,
				'max' => 1000,
				'increment' => 5
			),
			array(
				'label' => __( 'Content padding', 'live-composer-page-builder' ),
				'id' => 'content_padding',
				'type' => 'group_padding',
				'tab' => __( 'general', 'live-composer-page-builder' ),
				'section' => 'styling',
				'affect_on_change_el' => '.dslc-html-module-content',
				'values' => array(
					'padding_top' => 'css_main_padding_vertical',
					'padding_bottom' => 'css_main_padding_vertical',
					'padding_right' => 'css_main_padding_horizontal',
					'padding_left' => 'css_main_padding_horizontal',
				),
			),
			array(
				'label' => __( 'Padding Vertical', 'live-composer-page-builder' ),
				'id' => 'css_main_padding_vertical',
				'min' => 0,
				'max' => 600,
				'increment' => 1,
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'styling',
				'ext' => 'px',
			),
			array(
				'label' => __( 'Padding Horizontal', 'live-composer-page-builder' ),
				'id' => 'css_main_padding_horizontal',
				'min' => 0,
				'max' => 1000,
				'increment' => 1,
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'styling',
				'ext' => 'px',
			),
			array(
				'label' => __( 'Box Shadow', 'live-composer-page-builder' ),
				'id' => 'css_main_box_shadow',
				'std' => '',
				'type' => 'box_shadow',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content',
				'affect_on_change_rule' => 'box-shadow',
				'section' => 'styling',
			),

			/**
			 * Content
			 */

			array(
				'label' => __( 'Content typo', 'live-composer-page-builder' ),
				'id' => 'content_typo',
				'type' => 'group_text',
				'tab' => __( 'Typography', 'live-composer-page-builder' ),
				'section' => 'styling',
				'affect_on_change_el' => '.dslc-html-module-content,.dslc-html-module-content p',
				'values' => array(
					'color' => 'css_main_color',
					'font_size' => 'css_main_font_size',
					'font_weight' => 'css_main_font_weight',
					'font_family' => 'css_main_font_family',
					'font_style' => 'css_main_font_style',
					'line_height' => 'css_main_line_height',
				),
			),

			array(
				'label' => __( 'Color', 'live-composer-page-builder' ),
				'id' => 'css_main_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content,.dslc-html-module-content p',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => __( 'Content', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Font Size', 'live-composer-page-builder' ),
				'id' => 'css_main_font_size',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content, .dslc-html-module-content p',
				'affect_on_change_rule' => 'font-size',
				'section' => 'styling',
				'tab' => __( 'Content', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Font Weight', 'live-composer-page-builder' ),
				'id' => 'css_main_font_weight',
				'std' => '400',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => '100 - Thin',
						'value' => '100',
					),
					array(
						'label' => '200 - Extra Light',
						'value' => '200',
					),
					array(
						'label' => '300 - Light',
						'value' => '300',
					),
					array(
						'label' => '400 - Normal',
						'value' => '400',
					),
					array(
						'label' => '500 - Medium',
						'value' => '500',
					),
					array(
						'label' => '600 - Semi Bold',
						'value' => '600',
					),
					array(
						'label' => '700 - Bold',
						'value' => '700',
					),
					array(
						'label' => '800 - Extra Bold',
						'value' => '800',
					),
					array(
						'label' => '900 - Black',
						'value' => '900',
					),
				),
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content,.dslc-html-module-content p',
				'affect_on_change_rule' => 'font-weight',
				'section' => 'styling',
				'tab' => __( 'Content', 'live-composer-page-builder' ),
				'ext' => '',
			),
			array(
				'label' => __( 'Font Family', 'live-composer-page-builder' ),
				'id' => 'css_main_font_family',
				'std' => 'Open Sans',
				'type' => 'font',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content,.dslc-html-module-content p',
				'affect_on_change_rule' => 'font-family',
				'section' => 'styling',
				'tab' => __( 'Content', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Font Style', 'live-composer-page-builder' ),
				'id' => 'css_main_font_style',
				'std' => 'normal',
				'type' => 'select',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content,.dslc-html-module-content p',
				'affect_on_change_rule' => 'font-style',
				'section' => 'styling',
				'tab' => __( 'Content', 'live-composer-page-builder' ),
				'choices' => array(
					array(
						'label' => __( 'Normal', 'live-composer-page-builder' ),
						'value' => 'normal',
					),
					array(
						'label' => __( 'Italic', 'live-composer-page-builder' ),
						'value' => 'italic',
					),
				)
			),
			array(
				'label' => __( 'Line Height', 'live-composer-page-builder' ),
				'id' => 'css_main_line_height',
				'min' => 0,
				'max' => 120,
				'increment' => 1,
				'std' => '22',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content,.dslc-html-module-content p',
				'affect_on_change_rule' => 'line-height',
				'section' => 'styling',
				'tab' => __( 'Content', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Margin Bottom ( paragraph )', 'live-composer-page-builder' ),
				'id' => 'css_main_margin_bottom',
				'min' => -1000,
				'max' => 1000,
				'increment' => 1,
				'std' => '25',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content p',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'styling',
				'tab' => __( 'Content', 'live-composer-page-builder' ),
				'ext' => 'px',
			),
			array(
				'label' => __( 'Text Align', 'live-composer-page-builder' ),
				'id' => 'css_main_text_align',
				'std' => 'left',
				'type' => 'text_align',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content,.dslc-html-module-content p',
				'affect_on_change_rule' => 'text-align',
				'section' => 'styling',
				'tab' => __( 'Content', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Text Shadow', 'live-composer-page-builder' ),
				'id' => 'css_main_text_shadow',
				'std' => '',
				'type' => 'text_shadow',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content p',
				'affect_on_change_rule' => 'text-shadow',
				'section' => 'styling',
				'tab' => __( 'Content', 'live-composer-page-builder' ),
			),

			/**
			 * Heading 1
			 */

			array(
				'label' => __( 'H1 typo', 'live-composer-page-builder' ),
				'id' => 'h1_typo',
				'type' => 'group_text',
				'tab' => __( 'H1', 'live-composer-page-builder' ),
				'section' => 'styling',
				'affect_on_change_el' => '.dslc-html-module-content h1',
				'values' => array(
					'color' => 'css_h1_color',
					'font_size' => 'css_h1_font_size',
					'font_style' => 'css_h1_font_style',
					'font_weight' => 'css_h1_font_weight',
					'font_family' => 'css_h1_font_family',
					'line-height' => 'css_h1_line_height',
				),
				'std' => array(
					'font_size' => 25
				),
			),

			array(
				'label' => __( 'Color', 'live-composer-page-builder' ),
				'id' => 'css_h1_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h1',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => __( 'H1', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Font Size', 'live-composer-page-builder' ),
				'id' => 'css_h1_font_size',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '25',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h1',
				'affect_on_change_rule' => 'font-size',
				'section' => 'styling',
				'tab' => __( 'H1', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Font Weight', 'live-composer-page-builder' ),
				'id' => 'css_h1_font_weight',
				'std' => '400',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => '100 - Thin',
						'value' => '100',
					),
					array(
						'label' => '200 - Extra Light',
						'value' => '200',
					),
					array(
						'label' => '300 - Light',
						'value' => '300',
					),
					array(
						'label' => '400 - Normal',
						'value' => '400',
					),
					array(
						'label' => '500 - Medium',
						'value' => '500',
					),
					array(
						'label' => '600 - Semi Bold',
						'value' => '600',
					),
					array(
						'label' => '700 - Bold',
						'value' => '700',
					),
					array(
						'label' => '800 - Extra Bold',
						'value' => '800',
					),
					array(
						'label' => '900 - Black',
						'value' => '900',
					),
				),
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h1',
				'affect_on_change_rule' => 'font-weight',
				'section' => 'styling',
				'tab' => __( 'H1', 'live-composer-page-builder' ),
				'ext' => '',
			),
			array(
				'label' => __( 'Font Family', 'live-composer-page-builder' ),
				'id' => 'css_h1_font_family',
				'std' => 'Open Sans',
				'type' => 'font',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h1',
				'affect_on_change_rule' => 'font-family',
				'section' => 'styling',
				'tab' => __( 'H1', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Font Style', 'live-composer-page-builder' ),
				'id' => 'css_h1_font_style',
				'std' => 'normal',
				'type' => 'select',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h1',
				'affect_on_change_rule' => 'font-style',
				'section' => 'styling',
				'tab' => __( 'H1', 'live-composer-page-builder' ),
				'choices' => array(
					array(
						'label' => __( 'Normal', 'live-composer-page-builder' ),
						'value' => 'normal',
					),
					array(
						'label' => __( 'Italic', 'live-composer-page-builder' ),
						'value' => 'italic',
					),
				)
			),
			array(
				'label' => __( 'Line Height', 'live-composer-page-builder' ),
				'id' => 'css_h1_line_height',
				'min' => 0,
				'max' => 120,
				'increment' => 1,
				'std' => '35',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h1',
				'affect_on_change_rule' => 'line-height',
				'section' => 'styling',
				'tab' => __( 'H1', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Margin Bottom', 'live-composer-page-builder' ),
				'id' => 'css_h1_margin_bottom',
				'min' => -1000,
				'max' => 1000,
				'increment' => 1,
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h1',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'styling',
				'tab' => __( 'H1', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Text Align', 'live-composer-page-builder' ),
				'id' => 'css_h1_text_align',
				'std' => 'left',
				'type' => 'text_align',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h1',
				'affect_on_change_rule' => 'text-align',
				'section' => 'styling',
				'tab' => __( 'H1', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Text Shadow', 'live-composer-page-builder' ),
				'id' => 'css_h1_text_shadow',
				'std' => '',
				'type' => 'text_shadow',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h1',
				'affect_on_change_rule' => 'text-shadow',
				'section' => 'styling',
				'tab' => __( 'H1', 'live-composer-page-builder' ),
			),

			/**
			 * Heading 2
			 */

			array(
				'label' => __( 'H2 typo', 'live-composer-page-builder' ),
				'id' => 'h2_typo',
				'type' => 'group_text',
				'tab' => __( 'H2', 'live-composer-page-builder' ),
				'section' => 'styling',
				'affect_on_change_el' => '.dslc-html-module-content h2',
				'values' => array(
					'color' => 'css_h2_color',
					'font_size' => 'css_h2_font_size',
					'font_style' => 'css_h2_font_style',
					'font_weight' => 'css_h2_font_weight',
					'font_family' => 'css_h2_font_family',
					'line-height' => 'css_h2_line_height',
				),
				'std' => array(
					'font_size' => 23
				),
			),

			array(
				'label' => __( 'Color', 'live-composer-page-builder' ),
				'id' => 'css_h2_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h2',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => __( 'H2', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Font Size', 'live-composer-page-builder' ),
				'id' => 'css_h2_font_size',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '23',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h2',
				'affect_on_change_rule' => 'font-size',
				'section' => 'styling',
				'tab' => __( 'H2', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Font Weight', 'live-composer-page-builder' ),
				'id' => 'css_h2_font_weight',
				'std' => '400',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => '100 - Thin',
						'value' => '100',
					),
					array(
						'label' => '200 - Extra Light',
						'value' => '200',
					),
					array(
						'label' => '300 - Light',
						'value' => '300',
					),
					array(
						'label' => '400 - Normal',
						'value' => '400',
					),
					array(
						'label' => '500 - Medium',
						'value' => '500',
					),
					array(
						'label' => '600 - Semi Bold',
						'value' => '600',
					),
					array(
						'label' => '700 - Bold',
						'value' => '700',
					),
					array(
						'label' => '800 - Extra Bold',
						'value' => '800',
					),
					array(
						'label' => '900 - Black',
						'value' => '900',
					),
				),
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h2',
				'affect_on_change_rule' => 'font-weight',
				'section' => 'styling',
				'tab' => __( 'H2', 'live-composer-page-builder' ),
				'ext' => '',
			),
			array(
				'label' => __( 'Font Family', 'live-composer-page-builder' ),
				'id' => 'css_h2_font_family',
				'std' => 'Open Sans',
				'type' => 'font',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h2',
				'affect_on_change_rule' => 'font-family',
				'section' => 'styling',
				'tab' => __( 'H2', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Font Style', 'live-composer-page-builder' ),
				'id' => 'css_h2_font_style',
				'std' => 'normal',
				'type' => 'select',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h2',
				'affect_on_change_rule' => 'font-style',
				'section' => 'styling',
				'tab' => __( 'H2', 'live-composer-page-builder' ),
				'choices' => array(
					array(
						'label' => __( 'Normal', 'live-composer-page-builder' ),
						'value' => 'normal',
					),
					array(
						'label' => __( 'Italic', 'live-composer-page-builder' ),
						'value' => 'italic',
					),
				)
			),
			array(
				'label' => __( 'Line Height', 'live-composer-page-builder' ),
				'id' => 'css_h2_line_height',
				'min' => 0,
				'max' => 120,
				'increment' => 1,
				'std' => '33',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h2',
				'affect_on_change_rule' => 'line-height',
				'section' => 'styling',
				'tab' => __( 'H2', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Margin Bottom', 'live-composer-page-builder' ),
				'id' => 'css_h2_margin_bottom',
				'min' => -1000,
				'max' => 1000,
				'increment' => 1,
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h2',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'styling',
				'tab' => __( 'H2', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Text Align', 'live-composer-page-builder' ),
				'id' => 'css_h2_text_align',
				'std' => 'left',
				'type' => 'text_align',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h2',
				'affect_on_change_rule' => 'text-align',
				'section' => 'styling',
				'tab' => __( 'H2', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Text Shadow', 'live-composer-page-builder' ),
				'id' => 'css_h2_text_shadow',
				'std' => '',
				'type' => 'text_shadow',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h2',
				'affect_on_change_rule' => 'text-shadow',
				'section' => 'styling',
				'tab' => __( 'H2', 'live-composer-page-builder' ),
			),

			/**
			 * Heading 3
			 */

			array(
				'label' => __( 'H3 typo', 'live-composer-page-builder' ),
				'id' => 'h3_typo',
				'type' => 'group_text',
				'tab' => __( 'H3', 'live-composer-page-builder' ),
				'section' => 'styling',
				'affect_on_change_el' => '.dslc-html-module-content h3',
				'values' => array(
					'color' => 'css_h3_color',
					'font_size' => 'css_h3_font_size',
					'font_style' => 'css_h3_font_style',
					'font_weight' => 'css_h3_font_weight',
					'font_family' => 'css_h3_font_family',
					'line-height' => 'css_h3_line_height',
				),
				'std' => array(
					'font_size' => 21
				),
			),

			array(
				'label' => __( 'Color', 'live-composer-page-builder' ),
				'id' => 'css_h3_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h3',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => __( 'H3', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Font Size', 'live-composer-page-builder' ),
				'id' => 'css_h3_font_size',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '21',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h3',
				'affect_on_change_rule' => 'font-size',
				'section' => 'styling',
				'tab' => __( 'H3', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Font Weight', 'live-composer-page-builder' ),
				'id' => 'css_h3_font_weight',
				'std' => '400',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => '100 - Thin',
						'value' => '100',
					),
					array(
						'label' => '200 - Extra Light',
						'value' => '200',
					),
					array(
						'label' => '300 - Light',
						'value' => '300',
					),
					array(
						'label' => '400 - Normal',
						'value' => '400',
					),
					array(
						'label' => '500 - Medium',
						'value' => '500',
					),
					array(
						'label' => '600 - Semi Bold',
						'value' => '600',
					),
					array(
						'label' => '700 - Bold',
						'value' => '700',
					),
					array(
						'label' => '800 - Extra Bold',
						'value' => '800',
					),
					array(
						'label' => '900 - Black',
						'value' => '900',
					),
				),
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h3',
				'affect_on_change_rule' => 'font-weight',
				'section' => 'styling',
				'tab' => __( 'H3', 'live-composer-page-builder' ),
				'ext' => '',
			),
			array(
				'label' => __( 'Font Family', 'live-composer-page-builder' ),
				'id' => 'css_h3_font_family',
				'std' => 'Open Sans',
				'type' => 'font',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h3',
				'affect_on_change_rule' => 'font-family',
				'section' => 'styling',
				'tab' => __( 'H3', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Font Style', 'live-composer-page-builder' ),
				'id' => 'css_h3_font_style',
				'std' => 'normal',
				'type' => 'select',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h3',
				'affect_on_change_rule' => 'font-style',
				'section' => 'styling',
				'tab' => __( 'H3', 'live-composer-page-builder' ),
				'choices' => array(
					array(
						'label' => __( 'Normal', 'live-composer-page-builder' ),
						'value' => 'normal',
					),
					array(
						'label' => __( 'Italic', 'live-composer-page-builder' ),
						'value' => 'italic',
					),
				)
			),
			array(
				'label' => __( 'Line Height', 'live-composer-page-builder' ),
				'id' => 'css_h3_line_height',
				'min' => 0,
				'max' => 120,
				'increment' => 1,
				'std' => '31',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h3',
				'affect_on_change_rule' => 'line-height',
				'section' => 'styling',
				'tab' => __( 'H3', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Margin Bottom', 'live-composer-page-builder' ),
				'id' => 'css_h3_margin_bottom',
				'min' => -1000,
				'max' => 1000,
				'increment' => 1,
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h3',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'styling',
				'tab' => __( 'H3', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Text Align', 'live-composer-page-builder' ),
				'id' => 'css_h3_text_align',
				'std' => 'left',
				'type' => 'text_align',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h3',
				'affect_on_change_rule' => 'text-align',
				'section' => 'styling',
				'tab' => __( 'H3', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Text Shadow', 'live-composer-page-builder' ),
				'id' => 'css_h3_text_shadow',
				'std' => '',
				'type' => 'text_shadow',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h3',
				'affect_on_change_rule' => 'text-shadow',
				'section' => 'styling',
				'tab' => __( 'H3', 'live-composer-page-builder' ),
			),

			/**
			 * Heading 4
			 */

			array(
				'label' => __( 'H4 typo', 'live-composer-page-builder' ),
				'id' => 'h4_typo',
				'type' => 'group_text',
				'tab' => __( 'H4', 'live-composer-page-builder' ),
				'section' => 'styling',
				'affect_on_change_el' => '.dslc-html-module-content h4',
				'values' => array(
					'color' => 'css_h4_color',
					'font_size' => 'css_h4_font_size',
					'font_style' => 'css_h4_font_style',
					'font_weight' => 'css_h4_font_weight',
					'font_family' => 'css_h4_font_family',
					'line-height' => 'css_h4_line_height',
				),
				'std' => array(
					'font_size' => 19
				),
			),

			array(
				'label' => __( 'Color', 'live-composer-page-builder' ),
				'id' => 'css_h4_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h4',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => __( 'H4', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Font Size', 'live-composer-page-builder' ),
				'id' => 'css_h4_font_size',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '19',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h4',
				'affect_on_change_rule' => 'font-size',
				'section' => 'styling',
				'tab' => __( 'H4', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Font Weight', 'live-composer-page-builder' ),
				'id' => 'css_h4_font_weight',
				'std' => '400',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => '100 - Thin',
						'value' => '100',
					),
					array(
						'label' => '200 - Extra Light',
						'value' => '200',
					),
					array(
						'label' => '300 - Light',
						'value' => '300',
					),
					array(
						'label' => '400 - Normal',
						'value' => '400',
					),
					array(
						'label' => '500 - Medium',
						'value' => '500',
					),
					array(
						'label' => '600 - Semi Bold',
						'value' => '600',
					),
					array(
						'label' => '700 - Bold',
						'value' => '700',
					),
					array(
						'label' => '800 - Extra Bold',
						'value' => '800',
					),
					array(
						'label' => '900 - Black',
						'value' => '900',
					),
				),
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h4',
				'affect_on_change_rule' => 'font-weight',
				'section' => 'styling',
				'tab' => __( 'H4', 'live-composer-page-builder' ),
				'ext' => '',
			),
			array(
				'label' => __( 'Font Family', 'live-composer-page-builder' ),
				'id' => 'css_h4_font_family',
				'std' => 'Open Sans',
				'type' => 'font',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h4',
				'affect_on_change_rule' => 'font-family',
				'section' => 'styling',
				'tab' => __( 'H4', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Font Style', 'live-composer-page-builder' ),
				'id' => 'css_h4_font_style',
				'std' => 'normal',
				'type' => 'select',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h4',
				'affect_on_change_rule' => 'font-style',
				'section' => 'styling',
				'tab' => __( 'H4', 'live-composer-page-builder' ),
				'choices' => array(
					array(
						'label' => __( 'Normal', 'live-composer-page-builder' ),
						'value' => 'normal',
					),
					array(
						'label' => __( 'Italic', 'live-composer-page-builder' ),
						'value' => 'italic',
					),
				)
			),
			array(
				'label' => __( 'Line Height', 'live-composer-page-builder' ),
				'id' => 'css_h4_line_height',
				'min' => 0,
				'max' => 120,
				'increment' => 1,
				'std' => '29',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h4',
				'affect_on_change_rule' => 'line-height',
				'section' => 'styling',
				'tab' => __( 'H4', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Margin Bottom', 'live-composer-page-builder' ),
				'id' => 'css_h4_margin_bottom',
				'min' => -1000,
				'max' => 1000,
				'increment' => 1,
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h4',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'styling',
				'tab' => __( 'H4', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Text Align', 'live-composer-page-builder' ),
				'id' => 'css_h4_text_align',
				'std' => 'left',
				'type' => 'text_align',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h4',
				'affect_on_change_rule' => 'text-align',
				'section' => 'styling',
				'tab' => __( 'H4', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Text Shadow', 'live-composer-page-builder' ),
				'id' => 'css_h4_text_shadow',
				'std' => '',
				'type' => 'text_shadow',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h4',
				'affect_on_change_rule' => 'text-shadow',
				'section' => 'styling',
				'tab' => __( 'H4', 'live-composer-page-builder' ),
			),

			/**
			 * Heading 5
			 */

			array(
				'label' => __( 'H5 typo', 'live-composer-page-builder' ),
				'id' => 'h5_typo',
				'type' => 'group_text',
				'tab' => __( 'H5', 'live-composer-page-builder' ),
				'section' => 'styling',
				'affect_on_change_el' => '.dslc-html-module-content h5',
				'values' => array(
					'color' => 'css_h5_color',
					'font_size' => 'css_h5_font_size',
					'font_style' => 'css_h5_font_style',
					'font_weight' => 'css_h5_font_weight',
					'font_family' => 'css_h5_font_family',
					'line-height' => 'css_h5_line_height',
				),
				'std' => array(
					'font_size' => 17
				),
			),

			array(
				'label' => __( 'Color', 'live-composer-page-builder' ),
				'id' => 'css_h5_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h5',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => __( 'H5', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Font Size', 'live-composer-page-builder' ),
				'id' => 'css_h5_font_size',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '17',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h5',
				'affect_on_change_rule' => 'font-size',
				'section' => 'styling',
				'tab' => __( 'H5', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Font Weight', 'live-composer-page-builder' ),
				'id' => 'css_h5_font_weight',
				'std' => '400',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => '100 - Thin',
						'value' => '100',
					),
					array(
						'label' => '200 - Extra Light',
						'value' => '200',
					),
					array(
						'label' => '300 - Light',
						'value' => '300',
					),
					array(
						'label' => '400 - Normal',
						'value' => '400',
					),
					array(
						'label' => '500 - Medium',
						'value' => '500',
					),
					array(
						'label' => '600 - Semi Bold',
						'value' => '600',
					),
					array(
						'label' => '700 - Bold',
						'value' => '700',
					),
					array(
						'label' => '800 - Extra Bold',
						'value' => '800',
					),
					array(
						'label' => '900 - Black',
						'value' => '900',
					),
				),
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h5',
				'affect_on_change_rule' => 'font-weight',
				'section' => 'styling',
				'tab' => __( 'H5', 'live-composer-page-builder' ),
				'ext' => '',
			),
			array(
				'label' => __( 'Font Family', 'live-composer-page-builder' ),
				'id' => 'css_h5_font_family',
				'std' => 'Open Sans',
				'type' => 'font',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h5',
				'affect_on_change_rule' => 'font-family',
				'section' => 'styling',
				'tab' => __( 'H5', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Font Style', 'live-composer-page-builder' ),
				'id' => 'css_h5_font_style',
				'std' => 'normal',
				'type' => 'select',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h5',
				'affect_on_change_rule' => 'font-style',
				'section' => 'styling',
				'tab' => __( 'H5', 'live-composer-page-builder' ),
				'choices' => array(
					array(
						'label' => __( 'Normal', 'live-composer-page-builder' ),
						'value' => 'normal',
					),
					array(
						'label' => __( 'Italic', 'live-composer-page-builder' ),
						'value' => 'italic',
					),
				)
			),
			array(
				'label' => __( 'Line Height', 'live-composer-page-builder' ),
				'id' => 'css_h5_line_height',
				'min' => 0,
				'max' => 120,
				'increment' => 1,
				'std' => '27',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h5',
				'affect_on_change_rule' => 'line-height',
				'section' => 'styling',
				'tab' => __( 'H5', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Margin Bottom', 'live-composer-page-builder' ),
				'id' => 'css_h5_margin_bottom',
				'min' => -1000,
				'max' => 1000,
				'increment' => 1,
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h5',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'styling',
				'tab' => __( 'H5', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Text Align', 'live-composer-page-builder' ),
				'id' => 'css_h5_text_align',
				'std' => 'left',
				'type' => 'text_align',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h5',
				'affect_on_change_rule' => 'text-align',
				'section' => 'styling',
				'tab' => __( 'H5', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Text Shadow', 'live-composer-page-builder' ),
				'id' => 'css_h5_text_shadow',
				'std' => '',
				'type' => 'text_shadow',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h5',
				'affect_on_change_rule' => 'text-shadow',
				'section' => 'styling',
				'tab' => __( 'H5', 'live-composer-page-builder' ),
			),

			/**
			 * Heading 6
			 */

			array(
				'label' => __( 'H6 typo', 'live-composer-page-builder' ),
				'id' => 'h6_typo',
				'type' => 'group_text',
				'tab' => __( 'H6', 'live-composer-page-builder' ),
				'section' => 'styling',
				'affect_on_change_el' => '.dslc-html-module-content h6',
				'values' => array(
					'color' => 'css_h6_color',
					'font_size' => 'css_h6_font_size',
					'font_style' => 'css_h6_font_style',
					'font_weight' => 'css_h6_font_weight',
					'font_family' => 'css_h6_font_family',
					'line-height' => 'css_h6_line_height',
				),
				'std' => array(
					'font_size' => 15
				),
			),

			array(
				'label' => __( 'Color', 'live-composer-page-builder' ),
				'id' => 'css_h6_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h6',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => __( 'H6', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Font Size', 'live-composer-page-builder' ),
				'id' => 'css_h6_font_size',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h6',
				'affect_on_change_rule' => 'font-size',
				'section' => 'styling',
				'tab' => __( 'H6', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Font Weight', 'live-composer-page-builder' ),
				'id' => 'css_h6_font_weight',
				'std' => '400',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => '100 - Thin',
						'value' => '100',
					),
					array(
						'label' => '200 - Extra Light',
						'value' => '200',
					),
					array(
						'label' => '300 - Light',
						'value' => '300',
					),
					array(
						'label' => '400 - Normal',
						'value' => '400',
					),
					array(
						'label' => '500 - Medium',
						'value' => '500',
					),
					array(
						'label' => '600 - Semi Bold',
						'value' => '600',
					),
					array(
						'label' => '700 - Bold',
						'value' => '700',
					),
					array(
						'label' => '800 - Extra Bold',
						'value' => '800',
					),
					array(
						'label' => '900 - Black',
						'value' => '900',
					),
				),
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h6',
				'affect_on_change_rule' => 'font-weight',
				'section' => 'styling',
				'tab' => __( 'H6', 'live-composer-page-builder' ),
				'ext' => '',
			),
			array(
				'label' => __( 'Font Family', 'live-composer-page-builder' ),
				'id' => 'css_h6_font_family',
				'std' => 'Open Sans',
				'type' => 'font',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h6',
				'affect_on_change_rule' => 'font-family',
				'section' => 'styling',
				'tab' => __( 'H6', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Font Style', 'live-composer-page-builder' ),
				'id' => 'css_h6_font_style',
				'std' => 'normal',
				'type' => 'select',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h6',
				'affect_on_change_rule' => 'font-style',
				'section' => 'styling',
				'tab' => __( 'H6', 'live-composer-page-builder' ),
				'choices' => array(
					array(
						'label' => __( 'Normal', 'live-composer-page-builder' ),
						'value' => 'normal',
					),
					array(
						'label' => __( 'Italic', 'live-composer-page-builder' ),
						'value' => 'italic',
					),
				)
			),
			array(
				'label' => __( 'Line Height', 'live-composer-page-builder' ),
				'id' => 'css_h6_line_height',
				'min' => 0,
				'max' => 120,
				'increment' => 1,
				'std' => '25',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h6',
				'affect_on_change_rule' => 'line-height',
				'section' => 'styling',
				'tab' => __( 'H6', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Margin Bottom', 'live-composer-page-builder' ),
				'id' => 'css_h6_margin_bottom',
				'min' => -1000,
				'max' => 1000,
				'increment' => 1,
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h6',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'styling',
				'tab' => __( 'H6', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Text Align', 'live-composer-page-builder' ),
				'id' => 'css_h6_text_align',
				'std' => 'left',
				'type' => 'text_align',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h6',
				'affect_on_change_rule' => 'text-align',
				'section' => 'styling',
				'tab' => __( 'H6', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Text Shadow', 'live-composer-page-builder' ),
				'id' => 'css_h6_text_shadow',
				'std' => '',
				'type' => 'text_shadow',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h6',
				'affect_on_change_rule' => 'text-shadow',
				'section' => 'styling',
				'tab' => __( 'H6', 'live-composer-page-builder' ),
			),

			/**
			 * Links
			 */

			array(
				'label' => __( 'Link Color', 'live-composer-page-builder' ),
				'id' => 'css_link_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content a',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => __( 'Links', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Link - Hover Color', 'live-composer-page-builder' ),
				'id' => 'css_link_color_hover',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content a:hover',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => __( 'Links', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Link - Text Shadow', 'live-composer-page-builder' ),
				'id' => 'css_link_text_shadow',
				'std' => '',
				'type' => 'text_shadow',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content a',
				'affect_on_change_rule' => 'text-shadow',
				'section' => 'styling',
				'tab' => __( 'Links', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Blockquote Link - Color', 'live-composer-page-builder' ),
				'id' => 'css_blockquote_link_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content blockquote a',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => __( 'Links', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Blockquote Link - Hover Color', 'live-composer-page-builder' ),
				'id' => 'css_blockquote_link_color_hover',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content blockquote a:hover',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => __( 'Links', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Blockquote Link - Text Shadow', 'live-composer-page-builder' ),
				'id' => 'css_blockquote_link_text_shadow',
				'std' => '',
				'type' => 'text_shadow',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content blockquote a',
				'affect_on_change_rule' => 'text-shadow',
				'section' => 'styling',
				'tab' => __( 'Links', 'live-composer-page-builder' ),
			),

			/**
			 * Lists
			 */

			array(
				'label' => __( 'List item typo', 'live-composer-page-builder' ),
				'id' => 'li_typo',
				'type' => 'group_text',
				'tab' => __( 'Lists', 'live-composer-page-builder' ),
				'section' => 'styling',
				'affect_on_change_el' => '.dslc-html-module-content li',
				'values' => array(
					'color' => 'css_li_color',
					'font_size' => 'css_li_font_size',
					'font_style' => 'css_button_font_style',
					'font_weight' => 'css_li_font_weight',
					'font_family' => 'css_li_font_family',
					'letter_spacing' => 'css_button_letter_spacing',
					'line_height' => 'css_li_line_height',
				),
				'std' => array(
					'font_size' => 13
				),
			),

			array(
				'label' => __( 'Color', 'live-composer-page-builder' ),
				'id' => 'css_li_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content li',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => __( 'Lists', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Font Size', 'live-composer-page-builder' ),
				'id' => 'css_li_font_size',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content li',
				'affect_on_change_rule' => 'font-size',
				'section' => 'styling',
				'tab' => __( 'Lists', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Font Weight', 'live-composer-page-builder' ),
				'id' => 'css_li_font_weight',
				'std' => '400',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => '100 - Thin',
						'value' => '100',
					),
					array(
						'label' => '200 - Extra Light',
						'value' => '200',
					),
					array(
						'label' => '300 - Light',
						'value' => '300',
					),
					array(
						'label' => '400 - Normal',
						'value' => '400',
					),
					array(
						'label' => '500 - Medium',
						'value' => '500',
					),
					array(
						'label' => '600 - Semi Bold',
						'value' => '600',
					),
					array(
						'label' => '700 - Bold',
						'value' => '700',
					),
					array(
						'label' => '800 - Extra Bold',
						'value' => '800',
					),
					array(
						'label' => '900 - Black',
						'value' => '900',
					),
				),
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content li',
				'affect_on_change_rule' => 'font-weight',
				'section' => 'styling',
				'tab' => __( 'Lists', 'live-composer-page-builder' ),
				'ext' => '',
			),
			array(
				'label' => __( 'Font Family', 'live-composer-page-builder' ),
				'id' => 'css_li_font_family',
				'std' => 'Open Sans',
				'type' => 'font',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content li',
				'affect_on_change_rule' => 'font-family',
				'section' => 'styling',
				'tab' => __( 'Lists', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Line Height', 'live-composer-page-builder' ),
				'id' => 'css_li_line_height',
				'min' => 0,
				'max' => 120,
				'increment' => 1,
				'std' => '22',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content li',
				'affect_on_change_rule' => 'line-height',
				'section' => 'styling',
				'tab' => __( 'Lists', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Margin Bottom', 'live-composer-page-builder' ),
				'id' => 'css_ul_margin_bottom',
				'min' => -1000,
				'max' => 1000,
				'increment' => 1,
				'std' => '25',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content ul,.dslc-html-module-content ol',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'styling',
				'tab' => __( 'Lists', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Margin Left', 'live-composer-page-builder' ),
				'id' => 'css_ul_margin_left',
				'std' => '25',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content ul,.dslc-html-module-content ol',
				'affect_on_change_rule' => 'margin-left',
				'section' => 'styling',
				'tab' => __( 'Lists', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Content lists', 'live-composer-page-builder' ),
				'id' => 'content_lists',
				'type' => 'group_lists',
				'tab' => __( 'Tablet', 'live-composer-page-builder' ),
				'section' => 'styling',
				'affect_on_change_el' => '.dslc-button a',
				'values' => array(
					'ul_style' => 'css_ul_style',
					'ol_style' => 'css_ol_style',
					'ul_li_margin_bottom' => 'css_ul_li_margin_bottom',
				),
			),
			array(
				'label' => __( 'Unordered Style', 'live-composer-page-builder' ),
				'id' => 'css_ul_style',
				'std' => 'disc',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => __( 'Armenian', 'live-composer-page-builder' ),
						'value' => 'armenian'
					),
					array(
						'label' => __( 'Circle', 'live-composer-page-builder' ),
						'value' => 'circle'
					),
					array(
						'label' => __( 'Cjk-ideographic', 'live-composer-page-builder' ),
						'value' => 'cjk-ideographic'
					),
					array(
						'label' => __( 'Decimal', 'live-composer-page-builder' ),
						'value' => 'decimal'
					),
					array(
						'label' => __( 'Decimal Leading Zero', 'live-composer-page-builder' ),
						'value' => 'decimal-leading-zero'
					),
					array(
						'label' => __( 'Hebrew', 'live-composer-page-builder' ),
						'value' => 'hebrew'
					),
					array(
						'label' => __( 'Hiragana', 'live-composer-page-builder' ),
						'value' => 'hiragana'
					),
					array(
						'label' => __( 'Hiragana Iroha', 'live-composer-page-builder' ),
						'value' => 'hiragana-iroha'
					),
					array(
						'label' => __( 'Katakana', 'live-composer-page-builder' ),
						'value' => 'katakana'
					),
					array(
						'label' => __( 'Katakana Iroha', 'live-composer-page-builder' ),
						'value' => 'katakana-iroha'
					),
					array(
						'label' => __( 'Lower Alpha', 'live-composer-page-builder' ),
						'value' => 'lower-alpha'
					),
					array(
						'label' => __( 'Lower Greek', 'live-composer-page-builder' ),
						'value' => 'lower-greek'
					),
					array(
						'label' => __( 'Lower Latin', 'live-composer-page-builder' ),
						'value' => 'lower-latin'
					),
					array(
						'label' => __( 'Lower Roman', 'live-composer-page-builder' ),
						'value' => 'lower-roman'
					),
					array(
						'label' => __( 'None', 'live-composer-page-builder' ),
						'value' => 'none'
					),
					array(
						'label' => __( 'Upper Alpha', 'live-composer-page-builder' ),
						'value' => 'upper-alpha'
					),
					array(
						'label' => __( 'Upper Latin', 'live-composer-page-builder' ),
						'value' => 'upper-latin'
					),
					array(
						'label' => __( 'Upper Roman', 'live-composer-page-builder' ),
						'value' => 'upper-roman'
					),
					array(
						'label' => __( 'Inherit', 'live-composer-page-builder' ),
						'value' => 'inherit'
					),
				),
				'section' => 'styling',
				'tab' => __( 'Lists', 'live-composer-page-builder' ),
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content ul',
				'affect_on_change_rule' => 'list-style-type',
			),
			array(
				'label' => __( 'Ordered Style', 'live-composer-page-builder' ),
				'id' => 'css_ol_style',
				'std' => 'decimal',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => __( 'Armenian', 'live-composer-page-builder' ),
						'value' => 'armenian'
					),
					array(
						'label' => __( 'Circle', 'live-composer-page-builder' ),
						'value' => 'circle'
					),
					array(
						'label' => __( 'Cjk-ideographic', 'live-composer-page-builder' ),
						'value' => 'cjk-ideographic'
					),
					array(
						'label' => __( 'Decimal', 'live-composer-page-builder' ),
						'value' => 'decimal'
					),
					array(
						'label' => __( 'Decimal Leading Zero', 'live-composer-page-builder' ),
						'value' => 'decimal-leading-zero'
					),
					array(
						'label' => __( 'Hebrew', 'live-composer-page-builder' ),
						'value' => 'hebrew'
					),
					array(
						'label' => __( 'Hiragana', 'live-composer-page-builder' ),
						'value' => 'hiragana'
					),
					array(
						'label' => __( 'Hiragana Iroha', 'live-composer-page-builder' ),
						'value' => 'hiragana-iroha'
					),
					array(
						'label' => __( 'Katakana', 'live-composer-page-builder' ),
						'value' => 'katakana'
					),
					array(
						'label' => __( 'Katakana Iroha', 'live-composer-page-builder' ),
						'value' => 'katakana-iroha'
					),
					array(
						'label' => __( 'Lower Alpha', 'live-composer-page-builder' ),
						'value' => 'lower-alpha'
					),
					array(
						'label' => __( 'Lower Greek', 'live-composer-page-builder' ),
						'value' => 'lower-greek'
					),
					array(
						'label' => __( 'Lower Latin', 'live-composer-page-builder' ),
						'value' => 'lower-latin'
					),
					array(
						'label' => __( 'Lower Roman', 'live-composer-page-builder' ),
						'value' => 'lower-roman'
					),
					array(
						'label' => __( 'None', 'live-composer-page-builder' ),
						'value' => 'none'
					),
					array(
						'label' => __( 'Upper Alpha', 'live-composer-page-builder' ),
						'value' => 'upper-alpha'
					),
					array(
						'label' => __( 'Upper Latin', 'live-composer-page-builder' ),
						'value' => 'upper-latin'
					),
					array(
						'label' => __( 'Upper Roman', 'live-composer-page-builder' ),
						'value' => 'upper-roman'
					),
					array(
						'label' => __( 'Inherit', 'live-composer-page-builder' ),
						'value' => 'inherit'
					),
				),
				'section' => 'styling',
				'tab' => __( 'Lists', 'live-composer-page-builder' ),
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content ol',
				'affect_on_change_rule' => 'list-style-type',
			),
			array(
				'label' => __( 'Spacing', 'live-composer-page-builder' ),
				'id' => 'css_ul_li_margin_bottom',
				'min' => -1000,
				'max' => 1000,
				'increment' => 1,
				'std' => '10',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content li',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'styling',
				'tab' => __( 'Lists', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Item - BG Color', 'live-composer-page-builder' ),
				'id' => 'css_li_bg_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content li',
				'affect_on_change_rule' => 'background-color',
				'section' => 'styling',
				'tab' => __( 'Lists', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Li border', 'live-composer-page-builder' ),
				'id' => 'li_group',
				'type' => 'group_border',
				'tab' => __( 'Lists', 'live-composer-page-builder' ),
				'section' => 'styling',
				'affect_on_change_el' => '.dslc-html-module-content li',
				'values' => array(
					'border_color' => 'css_li_border_color',
					'border_width' => 'css_li_border_width',
					'border_trbl' => 'css_li_border_trbl',
					'border_radius' => 'css_border_radius',
					'border_radius_top_left' => 'css_li_border_radius_top',
					'border_radius_top_right' => 'css_li_border_radius_top',
					'border_radius_bottom_left' => 'css_li_border_radius_bottom',
					'border_radius_bottom_right' => 'css_li_border_radius_bottom',
				),
			),
			array(
				'label' => __( 'Item - Border Color', 'live-composer-page-builder' ),
				'id' => 'css_li_border_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content li',
				'affect_on_change_rule' => 'border-color',
				'section' => 'styling',
				'tab' => __( 'Lists', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Item - Border Width', 'live-composer-page-builder' ),
				'id' => 'css_li_border_width',
				'min' => 0,
				'max' => 10,
				'increment' => 1,
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content li',
				'affect_on_change_rule' => 'border-width',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => __( 'Lists', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Item - Borders', 'live-composer-page-builder' ),
				'id' => 'css_li_border_trbl',
				'std' => 'top right bottom left',
				'type' => 'checkbox',
				'choices' => array(
					array(
						'label' => __( 'Top', 'live-composer-page-builder' ),
						'value' => 'top'
					),
					array(
						'label' => __( 'Right', 'live-composer-page-builder' ),
						'value' => 'right'
					),
					array(
						'label' => __( 'Bottom', 'live-composer-page-builder' ),
						'value' => 'bottom'
					),
					array(
						'label' => __( 'Left', 'live-composer-page-builder' ),
						'value' => 'left'
					),
				),
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content li',
				'affect_on_change_rule' => 'border-style',
				'section' => 'styling',
				'tab' => __( 'Lists', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Item - Border Radius - Top', 'live-composer-page-builder' ),
				'id' => 'css_li_border_radius_top',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content li',
				'affect_on_change_rule' => 'border-top-left-radius,border-top-right-radius',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'section' => 'styling',
				'ext' => 'px',
				'tab' => __( 'Lists', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Item - Border Radius - Bottom', 'live-composer-page-builder' ),
				'id' => 'css_li_border_radius_bottom',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content li',
				'affect_on_change_rule' => 'border-bottom-left-radius,border-bottom-right-radius',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'section' => 'styling',
				'ext' => 'px',
				'tab' => __( 'Lists', 'live-composer-page-builder' ),
			),

			array(
				'label' => __( 'Li padding', 'live-composer-page-builder' ),
				'id' => 'li_padding',
				'type' => 'group_padding',
				'tab' => __( 'general', 'live-composer-page-builder' ),
				'section' => 'styling',
				'affect_on_change_el' => '.dslc-html-module-content li',
				'values' => array(
					'padding_top' => 'css_li_padding_vertical',
					'padding_bottom' => 'css_li_padding_vertical',
					'padding_right' => 'css_li_padding_horizontal',
					'padding_left' => 'css_li_padding_horizontal',
				),
			),
			array(
				'label' => __( 'Item - Padding Vertical', 'live-composer-page-builder' ),
				'id' => 'css_li_padding_vertical',
				'min' => 0,
				'max' => 600,
				'increment' => 1,
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content li',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'styling',
				'tab' => __( 'Lists', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Item - Padding Horizontal', 'live-composer-page-builder' ),
				'id' => 'css_li_padding_horizontal',
				'min' => 0,
				'max' => 1000,
				'increment' => 1,
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content li',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => __( 'Lists', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Text Shadow', 'live-composer-page-builder' ),
				'id' => 'css_li_text_shadow',
				'std' => '',
				'type' => 'text_shadow',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content li',
				'affect_on_change_rule' => 'text-shadow',
				'section' => 'styling',
				'tab' => __( 'Lists', 'live-composer-page-builder' ),
			),

			/**
			 * Inputs
			 */

			array(
				'label' => __( 'BG Color', 'live-composer-page-builder' ),
				'id' => 'css_inputs_bg_color',
				'std' => '#fff',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=text],input[type=password],input[type=number],input[type=email],textarea,select',
				'affect_on_change_rule' => 'background-color',
				'section' => 'styling',
				'tab' => __( 'Inputs', 'live-composer-page-builder' ),
			),

			array(
				'label' => __( 'Inputs border', 'live-composer-page-builder' ),
				'id' => 'inputs_border',
				'type' => 'group_border',
				'tab' => __( 'Inputs', 'live-composer-page-builder' ),
				'section' => 'styling',
				'affect_on_change_el' => 'input[type=text],input[type=password],input[type=number],input[type=email],textarea,select',
				'values' => array(
					'border_color' => 'css_inputs_border_color',
					'border_width' => 'css_inputs_border_width',
					'border_trbl' => 'css_inputs_border_trbl',
					'border_radius_top_left' => 'css_inputs_border_radius',
					'border_radius_top_right' => 'css_inputs_border_radius',
					'border_radius_bottom_left' => 'css_inputs_border_radius',
					'border_radius_bottom_right' => 'css_inputs_border_radius',
				),
				'std' => array(
					'border_color' => '$ddd',
					'border_width' => 1,
				),
			),
			array(
				'label' => __( 'Border Color', 'live-composer-page-builder' ),
				'id' => 'css_inputs_border_color',
				'std' => '#ddd',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=text],input[type=password],input[type=number],input[type=email],textarea,select',
				'affect_on_change_rule' => 'border-color',
				'section' => 'styling',
				'tab' => __( 'Inputs', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Border Width', 'live-composer-page-builder' ),
				'id' => 'css_inputs_border_width',
				'min' => 0,
				'max' => 10,
				'increment' => 1,

				'std' => '1',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=text],input[type=password],input[type=number],input[type=email],textarea,select',
				'affect_on_change_rule' => 'border-width',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => __( 'Inputs', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Borders', 'live-composer-page-builder' ),
				'id' => 'css_inputs_border_trbl',
				'std' => 'top right bottom left',
				'type' => 'checkbox',
				'choices' => array(
					array(
						'label' => __( 'Top', 'live-composer-page-builder' ),
						'value' => 'top'
					),
					array(
						'label' => __( 'Right', 'live-composer-page-builder' ),
						'value' => 'right'
					),
					array(
						'label' => __( 'Bottom', 'live-composer-page-builder' ),
						'value' => 'bottom'
					),
					array(
						'label' => __( 'Left', 'live-composer-page-builder' ),
						'value' => 'left'
					),
				),
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=text],input[type=password],input[type=number],input[type=email],textarea,select',
				'affect_on_change_rule' => 'border-style',
				'section' => 'styling',
				'tab' => __( 'Inputs', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Border Radius', 'live-composer-page-builder' ),
				'id' => 'css_inputs_border_radius',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=text],input[type=password],input[type=number],input[type=email],textarea,select',
				'affect_on_change_rule' => 'border-radius',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'section' => 'styling',
				'ext' => 'px',
				'tab' => __( 'Inputs', 'live-composer-page-builder' ),
			),

			array(
				'label' => __( 'Inputs typo', 'live-composer-page-builder' ),
				'id' => 'inputs_typo',
				'type' => 'group_text',
				'tab' => __( 'Inputs', 'live-composer-page-builder' ),
				'section' => 'styling',
				'affect_on_change_el' => 'input[type=text],input[type=password],input[type=number],input[type=email],textarea,select',
				'values' => array(
					'color' => 'css_inputs_color',
					'font_size' => 'css_inputs_font_size',
					'font_weight' => 'css_inputs_font_weight',
					'font_family' => 'css_inputs_font_family',
					'line_height' => 'css_inputs_line_height',
				),
				'std' => array(
					'color' => '#4d4d4d',
					'font_size' => 13,
					'font_weight' => 500,
				),
			),
			array(
				'label' => __( 'Color', 'live-composer-page-builder' ),
				'id' => 'css_inputs_color',
				'std' => '#4d4d4d',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=text],input[type=password],input[type=number],input[type=email],textarea,select',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => __( 'Inputs', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Font Size', 'live-composer-page-builder' ),
				'id' => 'css_inputs_font_size',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=text],input[type=password],input[type=number],input[type=email],textarea,select',
				'affect_on_change_rule' => 'font-size',
				'section' => 'styling',
				'tab' => __( 'Inputs', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Font Weight', 'live-composer-page-builder' ),
				'id' => 'css_inputs_font_weight',
				'std' => '500',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => '100 - Thin',
						'value' => '100',
					),
					array(
						'label' => '200 - Extra Light',
						'value' => '200',
					),
					array(
						'label' => '300 - Light',
						'value' => '300',
					),
					array(
						'label' => '400 - Normal',
						'value' => '400',
					),
					array(
						'label' => '500 - Medium',
						'value' => '500',
					),
					array(
						'label' => '600 - Semi Bold',
						'value' => '600',
					),
					array(
						'label' => '700 - Bold',
						'value' => '700',
					),
					array(
						'label' => '800 - Extra Bold',
						'value' => '800',
					),
					array(
						'label' => '900 - Black',
						'value' => '900',
					),
				),
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=text],input[type=password],input[type=number],input[type=email],textarea,select',
				'affect_on_change_rule' => 'font-weight',
				'section' => 'styling',
				'tab' => __( 'Inputs', 'live-composer-page-builder' ),
				'ext' => '',
			),
			array(
				'label' => __( 'Font Family', 'live-composer-page-builder' ),
				'id' => 'css_inputs_font_family',
				'std' => 'Open Sans',
				'type' => 'font',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=text],input[type=password],input[type=number],input[type=email],textarea,select',
				'affect_on_change_rule' => 'font-family',
				'section' => 'styling',
				'tab' => __( 'Inputs', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Line Height', 'live-composer-page-builder' ),
				'id' => 'css_inputs_line_height',
				'min' => 0,
				'max' => 120,
				'increment' => 1,
				'std' => '23',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'textarea',
				'affect_on_change_rule' => 'line-height',
				'section' => 'styling',
				'tab' => __( 'Inputs', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Margin Bottom', 'live-composer-page-builder' ),
				'id' => 'css_inputs_margin_bottom',
				'min' => -1000,
				'max' => 1000,
				'increment' => 1,
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=text],input[type=password],input[type=number],input[type=email],textarea,select',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => __( 'Inputs', 'live-composer-page-builder' ),
			),

			array(
				'label' => __( 'Inputs padding', 'live-composer-page-builder' ),
				'id' => 'inputs_padding',
				'type' => 'group_padding',
				'tab' => __( 'Inputs', 'live-composer-page-builder' ),
				'section' => 'styling',
				'affect_on_change_el' => 'input[type=text],input[type=password],input[type=number],input[type=email],textarea,select',
				'values' => array(
					'padding_top' => 'css_inputs_padding_vertical',
					'padding_bottom' => 'css_inputs_padding_vertical',
					'padding_left' => 'css_inputs_padding_horizontal',
					'padding_right' => 'css_inputs_padding_horizontal',
				),
				'std' => array(
					'padding_right' => 15,
					'padding_left' => 15,
					'padding_top' => 15,
					'padding_bottom' => 15,
				),
			),
			array(
				'label' => __( 'Padding Vertical', 'live-composer-page-builder' ),
				'id' => 'css_inputs_padding_vertical',
				'min' => 0,
				'max' => 600,
				'increment' => 1,
				'std' => '10',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=text],input[type=password],input[type=number],input[type=email],textarea,select',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => __( 'Inputs', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Padding Horizontal', 'live-composer-page-builder' ),
				'id' => 'css_inputs_padding_horizontal',
				'min' => 0,
				'max' => 1000,
				'increment' => 1,
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=text],input[type=password],input[type=number],input[type=email],textarea,select',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => __( 'Inputs', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Text Shadow', 'live-composer-page-builder' ),
				'id' => 'css_inputs_text_shadow',
				'std' => '',
				'type' => 'text_shadow',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=text],input[type=password],input[type=number],input[type=email],textarea,select',
				'affect_on_change_rule' => 'text-shadow',
				'section' => 'styling',
				'tab' => __( 'Inputs', 'live-composer-page-builder' ),
			),

			/**
			 * Blockquote
			 */
			array(
				'label' => __( 'Blockquote BG', 'live-composer-page-builder' ),
				'id' => 'blockquote_background',
				'type' => 'group_background',
				'tab' => __( 'Blockquote', 'live-composer-page-builder' ),
				'section' => 'styling',
				'affect_on_change_el' => 'blockquote',
				'values' => array(
					'bg_color' => 'css_blockquote_bg_color',
					'bg_img' => 'css_blockquote_bg_img',
					'bg_img_repeat' => 'css_blockquote_bg_img_repeat',
					'bg_img_attch' => 'css_blockquote_bg_img_attch',
					'bg_img_pos' => 'css_blockquote_bg_img_pos',
				),
			),

			array(
				'label' => __( 'BG Color', 'live-composer-page-builder' ),
				'id' => 'css_blockquote_bg_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'blockquote',
				'affect_on_change_rule' => 'background-color',
				'section' => 'styling',
				'tab' => __( 'Blockquote', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'BG Image', 'live-composer-page-builder' ),
				'id' => 'css_blockquote_bg_img',
				'std' => '',
				'type' => 'image',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'blockquote',
				'affect_on_change_rule' => 'background-image',
				'section' => 'styling',
				'tab' => __( 'Blockquote', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'BG Image Repeat', 'live-composer-page-builder' ),
				'id' => 'css_blockquote_bg_img_repeat',
				'std' => 'repeat',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => __( 'Repeat', 'live-composer-page-builder' ),
						'value' => 'repeat',
					),
					array(
						'label' => __( 'Repeat Horizontal', 'live-composer-page-builder' ),
						'value' => 'repeat-x',
					),
					array(
						'label' => __( 'Repeat Vertical', 'live-composer-page-builder' ),
						'value' => 'repeat-y',
					),
					array(
						'label' => __( 'Do NOT Repeat', 'live-composer-page-builder' ),
						'value' => 'no-repeat',
					),
				),
				'refresh_on_change' => false,
				'affect_on_change_el' => 'blockquote',
				'affect_on_change_rule' => 'background-repeat',
				'section' => 'styling',
				'tab' => __( 'Blockquote', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'BG Image Attachment', 'live-composer-page-builder' ),
				'id' => 'css_blockquote_bg_img_attch',
				'std' => 'scroll',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => __( 'Scroll', 'live-composer-page-builder' ),
						'value' => 'scroll',
					),
					array(
						'label' => __( 'Fixed', 'live-composer-page-builder' ),
						'value' => 'fixed',
					),
				),
				'refresh_on_change' => false,
				'affect_on_change_el' => 'blockquote',
				'affect_on_change_rule' => 'background-attachment',
				'section' => 'styling',
				'tab' => __( 'Blockquote', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'BG Image Position', 'live-composer-page-builder' ),
				'id' => 'css_blockquote_bg_img_pos',
				'std' => 'top left',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => __( 'Top Left', 'live-composer-page-builder' ),
						'value' => 'left top',
					),
					array(
						'label' => __( 'Top Right', 'live-composer-page-builder' ),
						'value' => 'right top',
					),
					array(
						'label' => __( 'Top Center', 'live-composer-page-builder' ),
						'value' => 'Center Top',
					),
					array(
						'label' => __( 'Center Left', 'live-composer-page-builder' ),
						'value' => 'left center',
					),
					array(
						'label' => __( 'Center Right', 'live-composer-page-builder' ),
						'value' => 'right center',
					),
					array(
						'label' => __( 'Center', 'live-composer-page-builder' ),
						'value' => 'center center',
					),
					array(
						'label' => __( 'Bottom Left', 'live-composer-page-builder' ),
						'value' => 'left bottom',
					),
					array(
						'label' => __( 'Bottom Right', 'live-composer-page-builder' ),
						'value' => 'right bottom',
					),
					array(
						'label' => __( 'Bottom Center', 'live-composer-page-builder' ),
						'value' => 'center bottom',
					),
					array(
						'label' => __( '25px 25px', 'live-composer-page-builder' ),
						'value' => '25px 25px',
					),
					array(
						'label' => __( '50px 50px', 'live-composer-page-builder' ),
						'value' => '50px 50px',
					),
					array(
						'label' => __( '100px 100px', 'live-composer-page-builder' ),
						'value' => '100px 100px',
					),
					array(
						'label' => __( '200px 200px', 'live-composer-page-builder' ),
						'value' => '200px 200px',
					),
				),
				'refresh_on_change' => false,
				'affect_on_change_el' => 'blockquote',
				'affect_on_change_rule' => 'background-position',
				'section' => 'styling',
				'tab' => __( 'Blockquote', 'live-composer-page-builder' ),
			),

			array(
				'label' => __( 'Blockquote border', 'live-composer-page-builder' ),
				'id' => 'blockquote_border',
				'type' => 'group_border',
				'tab' => __( 'Blockquote', 'live-composer-page-builder' ),
				'section' => 'styling',
				'affect_on_change_el' => 'blockquote',
				'values' => array(
					'border_color' => 'css_blockquote_border_color',
					'border_width' => 'css_blockquote_border_width',
					'border_trbl' => 'css_blockquote_border_trbl',
					'border_radius_top_left' => 'css_blockquote_border_radius_top',
					'border_radius_top_right' => 'css_blockquote_border_radius_top',
					'border_radius_bottom_left' => 'css_blockquote_border_radius_bottom',
					'border_radius_bottom_right' => 'css_blockquote_border_radius_bottom',
				),
			),
			array(
				'label' => __( 'Border Color', 'live-composer-page-builder' ),
				'id' => 'css_blockquote_border_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'blockquote',
				'affect_on_change_rule' => 'border-color',
				'section' => 'styling',
				'tab' => __( 'Blockquote', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Border Width', 'live-composer-page-builder' ),
				'id' => 'css_blockquote_border_width',
				'min' => 0,
				'max' => 10,
				'increment' => 1,

				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'blockquote',
				'affect_on_change_rule' => 'border-width',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => __( 'Blockquote', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Borders', 'live-composer-page-builder' ),
				'id' => 'css_blockquote_border_trbl',
				'std' => 'top right bottom left',
				'type' => 'checkbox',
				'choices' => array(
					array(
						'label' => __( 'Top', 'live-composer-page-builder' ),
						'value' => 'top'
					),
					array(
						'label' => __( 'Right', 'live-composer-page-builder' ),
						'value' => 'right'
					),
					array(
						'label' => __( 'Bottom', 'live-composer-page-builder' ),
						'value' => 'bottom'
					),
					array(
						'label' => __( 'Left', 'live-composer-page-builder' ),
						'value' => 'left'
					),
				),
				'refresh_on_change' => false,
				'affect_on_change_el' => 'blockquote',
				'affect_on_change_rule' => 'border-style',
				'section' => 'styling',
				'tab' => __( 'Blockquote', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Border Radius - Top', 'live-composer-page-builder' ),
				'id' => 'css_blockquote_border_radius_top',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'blockquote',
				'affect_on_change_rule' => 'border-top-left-radius,border-top-right-radius',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'section' => 'styling',
				'ext' => 'px',
				'tab' => __( 'Blockquote', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Border Radius - Bottom', 'live-composer-page-builder' ),
				'id' => 'css_blockquote_border_radius_bottom',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'blockquote',
				'affect_on_change_rule' => 'border-bottom-left-radius,border-bottom-right-radius',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'section' => 'styling',
				'ext' => 'px',
				'tab' => __( 'Blockquote', 'live-composer-page-builder' ),
			),

			array(
				'label' => __( 'Blockquote typo', 'live-composer-page-builder' ),
				'id' => 'blockquote_typo',
				'type' => 'group_text',
				'tab' => __( 'Blockquote', 'live-composer-page-builder' ),
				'section' => 'styling',
				'affect_on_change_el' => '.dslc-html-module-content blockquote, .dslc-html-module-content blockquote p',
				'values' => array(
					'color' => 'css_blockquote_color',
					'font_size' => 'css_blockquote_font_size',
					'font_weight' => 'css_blockquote_font_weight',
					'font_family' => 'css_blockquote_font_family',
					'line_height' => 'css_blockquote_line_height',
				),
			),
			array(
				'label' => __( 'Color', 'live-composer-page-builder' ),
				'id' => 'css_blockquote_color',
				'std' => '',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content blockquote, .dslc-html-module-content blockquote p',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => __( 'Blockquote', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Font Size', 'live-composer-page-builder' ),
				'id' => 'css_blockquote_font_size',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content blockquote, .dslc-html-module-content blockquote p',
				'affect_on_change_rule' => 'font-size',
				'section' => 'styling',
				'tab' => __( 'Blockquote', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Font Weight', 'live-composer-page-builder' ),
				'id' => 'css_blockquote_font_weight',
				'std' => '400',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => '100 - Thin',
						'value' => '100',
					),
					array(
						'label' => '200 - Extra Light',
						'value' => '200',
					),
					array(
						'label' => '300 - Light',
						'value' => '300',
					),
					array(
						'label' => '400 - Normal',
						'value' => '400',
					),
					array(
						'label' => '500 - Medium',
						'value' => '500',
					),
					array(
						'label' => '600 - Semi Bold',
						'value' => '600',
					),
					array(
						'label' => '700 - Bold',
						'value' => '700',
					),
					array(
						'label' => '800 - Extra Bold',
						'value' => '800',
					),
					array(
						'label' => '900 - Black',
						'value' => '900',
					),
				),
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content blockquote, .dslc-html-module-content blockquote p',
				'affect_on_change_rule' => 'font-weight',
				'section' => 'styling',
				'tab' => __( 'Blockquote', 'live-composer-page-builder' ),
				'ext' => '',
			),
			array(
				'label' => __( 'Font Family', 'live-composer-page-builder' ),
				'id' => 'css_blockquote_font_family',
				'std' => 'Open Sans',
				'type' => 'font',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content blockquote, .dslc-html-module-content blockquote p',
				'affect_on_change_rule' => 'font-family',
				'section' => 'styling',
				'tab' => __( 'Blockquote', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Line Height', 'live-composer-page-builder' ),
				'id' => 'css_blockquote_line_height',
				'min' => 0,
				'max' => 120,
				'increment' => 1,
				'std' => '22',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content blockquote, .dslc-html-module-content blockquote p',
				'affect_on_change_rule' => 'line-height',
				'section' => 'styling',
				'tab' => __( 'Blockquote', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Margin Bottom', 'live-composer-page-builder' ),
				'id' => 'css_blockquote_margin_bottom',
				'min' => -1000,
				'max' => 1000,
				'increment' => 1,
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'blockquote',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => __( 'Blockquote', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Margin Left', 'live-composer-page-builder' ),
				'id' => 'css_blockquote_margin_left',
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'blockquote',
				'affect_on_change_rule' => 'margin-left',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => __( 'Blockquote', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Blockquote padding', 'live-composer-page-builder' ),
				'id' => 'blockquote_padding',
				'type' => 'group_padding',
				'tab' => __( 'Wrapper', 'live-composer-page-builder' ),
				'section' => 'styling',
				'affect_on_change_el' => 'blockquote, .dslc-html-module-content blockquote p',
				'values' => array(
					'padding_top' => 'css_blockquote_padding_vertical',
					'padding_bottom' => 'css_blockquote_padding_vertical',
					'padding_left' => 'css_blockquote_padding_horizontal',
					'padding_right' => 'css_blockquote_padding_horizontal',
				),
			),
			array(
				'label' => __( 'Padding Vertical', 'live-composer-page-builder' ),
				'id' => 'css_blockquote_padding_vertical',
				'min' => 0,
				'max' => 600,
				'increment' => 1,
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'blockquote',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => __( 'Blockquote', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Padding Horizontal', 'live-composer-page-builder' ),
				'id' => 'css_blockquote_padding_horizontal',
				'min' => 0,
				'max' => 1000,
				'increment' => 1,
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'blockquote',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => __( 'Blockquote', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Text Align', 'live-composer-page-builder' ),
				'id' => 'css_blockquote_text_align',
				'std' => 'left',
				'type' => 'text_align',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'blockquote, .dslc-html-module-content blockquote p',
				'affect_on_change_rule' => 'text-align',
				'section' => 'styling',
				'tab' => __( 'Blockquote', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Text Shadow', 'live-composer-page-builder' ),
				'id' => 'css_blockquote_text_shadow',
				'std' => '',
				'type' => 'text_shadow',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content blockquote',
				'affect_on_change_rule' => 'text-shadow',
				'section' => 'styling',
				'tab' => __( 'Blockquote', 'live-composer-page-builder' ),
			),

			/**
			 * Submit Button
			 */

			array(
				'label' => __( 'BG Color', 'live-composer-page-builder' ),
				'id' => 'css_button_bg_color',
				'std' => '#5890e5',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=submit], button',
				'affect_on_change_rule' => 'background-color',
				'section' => 'styling',
				'tab' => __( 'Buttons', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'BG Color - Hover', 'live-composer-page-builder' ),
				'id' => 'css_button_bg_color_hover',
				'std' => '#5890e5',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=submit]:hover, button:hover',
				'affect_on_change_rule' => 'background-color',
				'section' => 'styling',
				'tab' => __( 'Buttons', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Submit border', 'live-composer-page-builder' ),
				'id' => 'submit_borders',
				'type' => 'group_border',
				'tab' => __( 'Buttons', 'live-composer-page-builder' ),
				'section' => 'styling',
				'affect_on_change_el' => 'input[type=submit], button',
				'values' => array(
					'border_color' => 'css_button_border_color',
					'border_width' => 'css_button_border_width',
					'border_trbl' => 'css_button_border_trbl',
					'border_radius_top_left' => 'css_button_border_radius',
					'border_radius_top_right' => 'css_button_border_radius',
					'border_radius_bottom_left' => 'css_button_border_radius',
					'border_radius_bottom_right' => 'css_button_border_radius',
				),
				'std' => array(
					'border_color' => '#5890e5',
					'border_radius_top_left' => 3,
					'border_radius_top_right' => 3,
					'border_radius_bottom_right' => 3,
					'border_radius_bottom_left' => 3,
				),
			),
			array(
				'label' => __( 'Border Color', 'live-composer-page-builder' ),
				'id' => 'css_button_border_color',
				'std' => '#5890e5',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=submit], button',
				'affect_on_change_rule' => 'border-color',
				'section' => 'styling',
				'tab' => __( 'Buttons', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Border Color - Hover', 'live-composer-page-builder' ),
				'id' => 'css_button_border_color_hover',
				'std' => '#5890e5',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=submit]:hover, button:hover',
				'affect_on_change_rule' => 'border-color',
				'section' => 'styling',
				'tab' => __( 'Buttons', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Border Width', 'live-composer-page-builder' ),
				'id' => 'css_button_border_width',
				'min' => 0,
				'max' => 10,
				'increment' => 1,

				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=submit], button',
				'affect_on_change_rule' => 'border-width',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => __( 'Buttons', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Borders', 'live-composer-page-builder' ),
				'id' => 'css_button_border_trbl',
				'std' => 'top right bottom left',
				'type' => 'checkbox',
				'choices' => array(
					array(
						'label' => __( 'Top', 'live-composer-page-builder' ),
						'value' => 'top'
					),
					array(
						'label' => __( 'Right', 'live-composer-page-builder' ),
						'value' => 'right'
					),
					array(
						'label' => __( 'Bottom', 'live-composer-page-builder' ),
						'value' => 'bottom'
					),
					array(
						'label' => __( 'Left', 'live-composer-page-builder' ),
						'value' => 'left'
					),
				),
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=submit], button',
				'affect_on_change_rule' => 'border-style',
				'section' => 'styling',
				'tab' => __( 'Buttons', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Border Radius', 'live-composer-page-builder' ),
				'id' => 'css_button_border_radius',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '3',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=submit], button',
				'affect_on_change_rule' => 'border-radius',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'section' => 'styling',
				'ext' => 'px',
				'tab' => __( 'Buttons', 'live-composer-page-builder' ),
			),

			array(
				'label' => __( 'Submit typo', 'live-composer-page-builder' ),
				'id' => 'button_typo',
				'type' => 'group_text',
				'tab' => __( 'Buttons', 'live-composer-page-builder' ),
				'section' => 'styling',
				'affect_on_change_el' => 'input[type=submit], button',
				'values' => array(
					'color' => 'css_button_color',
					'font_size' => 'css_button_font_size',
					'font_style' => 'css_button_font_style',
					'font_weight' => 'css_button_font_weight',
					'font_family' => 'css_button_font_family',
					'line_height' => 'css_button_line_height',
				),
				'std' => array(
					'color' => '#fff',
					'font_size' => 13,
					'font_weight' => 500,
				),
			),
			array(
				'label' => __( 'Color', 'live-composer-page-builder' ),
				'id' => 'css_button_color',
				'std' => '#fff',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=submit], button',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => __( 'Buttons', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Color - Hover', 'live-composer-page-builder' ),
				'id' => 'css_button_color_hover',
				'std' => '#fff',
				'type' => 'color',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=submit]:hover, button:hover',
				'affect_on_change_rule' => 'color',
				'section' => 'styling',
				'tab' => __( 'Buttons', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Font Size', 'live-composer-page-builder' ),
				'id' => 'css_button_font_size',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=submit], button',
				'affect_on_change_rule' => 'font-size',
				'section' => 'styling',
				'tab' => __( 'Buttons', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Font Weight', 'live-composer-page-builder' ),
				'id' => 'css_button_font_weight',
				'std' => '500',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => '100 - Thin',
						'value' => '100',
					),
					array(
						'label' => '200 - Extra Light',
						'value' => '200',
					),
					array(
						'label' => '300 - Light',
						'value' => '300',
					),
					array(
						'label' => '400 - Normal',
						'value' => '400',
					),
					array(
						'label' => '500 - Medium',
						'value' => '500',
					),
					array(
						'label' => '600 - Semi Bold',
						'value' => '600',
					),
					array(
						'label' => '700 - Bold',
						'value' => '700',
					),
					array(
						'label' => '800 - Extra Bold',
						'value' => '800',
					),
					array(
						'label' => '900 - Black',
						'value' => '900',
					),
				),
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=submit], button',
				'affect_on_change_rule' => 'font-weight',
				'section' => 'styling',
				'tab' => __( 'Buttons', 'live-composer-page-builder' ),
				'ext' => '',
			),
			array(
				'label' => __( 'Font Family', 'live-composer-page-builder' ),
				'id' => 'css_button_font_family',
				'std' => 'Open Sans',
				'type' => 'font',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=submit], button',
				'affect_on_change_rule' => 'font-family',
				'section' => 'styling',
				'tab' => __( 'Buttons', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Line Height', 'live-composer-page-builder' ),
				'id' => 'css_button_line_height',
				'min' => 0,
				'max' => 120,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=submit], button',
				'affect_on_change_rule' => 'line-height',
				'section' => 'styling',
				'tab' => __( 'Buttons', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Submit padding', 'live-composer-page-builder' ),
				'id' => 'submit_padding',
				'type' => 'group_padding',
				'tab' => __( 'Buttons', 'live-composer-page-builder' ),
				'section' => 'styling',
				'affect_on_change_el' => 'input[type=submit], button',
				'values' => array(
					'padding_top' => 'css_button_padding_vertical',
					'padding_bottom' => 'css_button_padding_vertical',
					'padding_left' => 'css_button_padding_horizontal',
					'padding_right' => 'css_button_padding_horizontal',
				),
				'std' => array(
					'padding_right' => 15,
					'padding_left' => 15,
					'padding_top' => 10,
					'padding_bottom' => 10,
				),
			),
			array(
				'label' => __( 'Padding Vertical', 'live-composer-page-builder' ),
				'id' => 'css_button_padding_vertical',
				'min' => 0,
				'max' => 600,
				'increment' => 1,
				'std' => '10',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=submit], button',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => __( 'Buttons', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Padding Horizontal', 'live-composer-page-builder' ),
				'id' => 'css_button_padding_horizontal',
				'min' => 0,
				'max' => 1000,
				'increment' => 1,
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=submit], button',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'styling',
				'ext' => 'px',
				'tab' => __( 'Buttons', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Text Shadow', 'live-composer-page-builder' ),
				'id' => 'css_button_text_shadow',
				'std' => '',
				'type' => 'text_shadow',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=submit], button',
				'affect_on_change_rule' => 'text-shadow',
				'section' => 'styling',
				'tab' => __( 'Buttons', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Box Shadow', 'live-composer-page-builder' ),
				'id' => 'css_button_box_shadow',
				'std' => '',
				'type' => 'box_shadow',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=submit], button',
				'affect_on_change_rule' => 'box-shadow',
				'section' => 'styling',
				'tab' => __( 'Buttons', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Box Shadow - Hover', 'live-composer-page-builder' ),
				'id' => 'css_button_box_shadow_hover',
				'std' => '',
				'type' => 'box_shadow',
				'refresh_on_change' => false,
				'affect_on_change_el' => 'input[type=submit]:hover, button:hover',
				'affect_on_change_rule' => 'box-shadow',
				'section' => 'styling',
				'tab' => __( 'Buttons', 'live-composer-page-builder' ),
			),

			/**
			 * Responsive Tablet
			 */

			array(
				'label' => __( 'Responsive Styling', 'live-composer-page-builder' ),
				'id' => 'css_res_t',
				'std' => 'disabled',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => __( 'Disabled', 'live-composer-page-builder' ),
						'value' => 'disabled'
					),
					array(
						'label' => __( 'Enabled', 'live-composer-page-builder' ),
						'value' => 'enabled'
					),
				),
				'section' => 'responsive',
				'tab' => __( 'Tablet', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Margin Bottom', 'live-composer-page-builder' ),
				'id' => 'css_res_t_margin_bottom',
				'min' => -1000,
				'max' => 1000,
				'increment' => 1,
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => __( 'Tablet', 'live-composer-page-builder' ),
				'ext' => 'px',
			),

			array(
				'label' => __( 'Content padding', 'live-composer-page-builder' ),
				'id' => 'content_t_padding',
				'type' => 'group_padding',
				'tab' => __( 'Tablet', 'live-composer-page-builder' ),
				'section' => 'responsive',
				'affect_on_change_el' => '.dslc-html-module-content',
				'values' => array(
					'padding_top' => 'css_res_t_main_padding_vertical',
					'padding_bottom' => 'css_res_t_main_padding_vertical',
					'padding_left' => 'css_res_t_main_padding_horizontal',
					'padding_right' => 'css_res_t_main_padding_horizontal',
				),
			),
			array(
				'label' => __( 'Padding Vertical', 'live-composer-page-builder' ),
				'id' => 'css_res_t_main_padding_vertical',
				'min' => 0,
				'max' => 600,
				'increment' => 1,
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'responsive',
				'tab' => __( 'Tablet', 'live-composer-page-builder' ),
				'ext' => 'px',
			),
			array(
				'label' => __( 'Padding Horizontal', 'live-composer-page-builder' ),
				'id' => 'css_res_t_main_padding_horizontal',
				'min' => 0,
				'max' => 1000,
				'increment' => 1,
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'responsive',
				'tab' => __( 'Tablet', 'live-composer-page-builder' ),
				'ext' => 'px',
			),
			array(
				'label' => __( 'Font Size', 'live-composer-page-builder' ),
				'id' => 'css_res_t_main_font_size',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content, .dslc-html-module-content p',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => __( 'Tablet', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Line Height', 'live-composer-page-builder' ),
				'id' => 'css_res_t_main_line_height',
				'min' => 0,
				'max' => 120,
				'increment' => 1,
				'std' => '22',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content',
				'affect_on_change_rule' => 'line-height',
				'section' => 'responsive',
				'tab' => __( 'Tablet', 'live-composer-page-builder' ),
				'ext' => 'px'
			),

			array(
				'label' => __( 'H1 - Font Size', 'live-composer-page-builder' ),
				'id' => 'css_res_t_h1_font_size',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h1',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => __( 'Tablet', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H1 - Line Height', 'live-composer-page-builder' ),
				'id' => 'css_res_t_h1_line_height',
				'min' => 0,
				'max' => 120,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h1',
				'affect_on_change_rule' => 'line-height',
				'section' => 'responsive',
				'tab' => __( 'Tablet', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H1 - Margin Bottom', 'live-composer-page-builder' ),
				'id' => 'css_res_t_h1_margin_bottom',
				'min' => -1000,
				'max' => 1000,
				'increment' => 1,
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h1',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => __( 'Tablet', 'live-composer-page-builder' ),
				'ext' => 'px'
			),

			array(
				'label' => __( 'H2 - Font Size', 'live-composer-page-builder' ),
				'id' => 'css_res_t_h2_font_size',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h2',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => __( 'Tablet', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H2 - Line Height', 'live-composer-page-builder' ),
				'id' => 'css_res_t_h2_line_height',
				'min' => 0,
				'max' => 120,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h2',
				'affect_on_change_rule' => 'line-height',
				'section' => 'responsive',
				'tab' => __( 'Tablet', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H2 - Margin Bottom', 'live-composer-page-builder' ),
				'id' => 'css_res_t_h2_margin_bottom',
				'min' => -1000,
				'max' => 1000,
				'increment' => 1,
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h2',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => __( 'Tablet', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H3 - Font Size', 'live-composer-page-builder' ),
				'id' => 'css_res_t_h3_font_size',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h3',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => __( 'Tablet', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H3 - Line Height', 'live-composer-page-builder' ),
				'id' => 'css_res_t_h3_line_height',
				'min' => 0,
				'max' => 120,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h3',
				'affect_on_change_rule' => 'line-height',
				'section' => 'responsive',
				'tab' => __( 'Tablet', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H3 - Margin Bottom', 'live-composer-page-builder' ),
				'id' => 'css_res_t_h3_margin_bottom',
				'min' => -1000,
				'max' => 1000,
				'increment' => 1,
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h3',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => __( 'Tablet', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H4 - Font Size', 'live-composer-page-builder' ),
				'id' => 'css_res_t_h4_font_size',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h4',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => __( 'Tablet', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H4 - Line Height', 'live-composer-page-builder' ),
				'id' => 'css_res_t_h4_line_height',
				'min' => 0,
				'max' => 120,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h4',
				'affect_on_change_rule' => 'line-height',
				'section' => 'responsive',
				'tab' => __( 'Tablet', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H4 - Margin Bottom', 'live-composer-page-builder' ),
				'id' => 'css_res_t_h4_margin_bottom',
				'min' => -1000,
				'max' => 1000,
				'increment' => 1,
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h4',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => __( 'Tablet', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H5 - Font Size', 'live-composer-page-builder' ),
				'id' => 'css_res_t_h5_font_size',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h5',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => __( 'Tablet', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H5 - Line Height', 'live-composer-page-builder' ),
				'id' => 'css_res_t_h5_line_height',
				'min' => 0,
				'max' => 120,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h5',
				'affect_on_change_rule' => 'line-height',
				'section' => 'responsive',
				'tab' => __( 'Tablet', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H5 - Margin Bottom', 'live-composer-page-builder' ),
				'id' => 'css_res_t_h5_margin_bottom',
				'min' => -1000,
				'max' => 1000,
				'increment' => 1,
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h5',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => __( 'Tablet', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H6 - Font Size', 'live-composer-page-builder' ),
				'id' => 'css_res_t_h6_font_size',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h6',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => __( 'Tablet', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H6 - Line Height', 'live-composer-page-builder' ),
				'id' => 'css_res_t_h6_line_height',
				'min' => 0,
				'max' => 120,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h6',
				'affect_on_change_rule' => 'line-height',
				'section' => 'responsive',
				'tab' => __( 'Tablet', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H6 - Margin Bottom', 'live-composer-page-builder' ),
				'id' => 'css_res_t_h6_margin_bottom',
				'min' => -1000,
				'max' => 1000,
				'increment' => 1,
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h6',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => __( 'Tablet', 'live-composer-page-builder' ),
				'ext' => 'px'
			),



			/**
			 * Responsive Phone
			 */

			array(
				'label' => __( 'Responsive Styling', 'live-composer-page-builder' ),
				'id' => 'css_res_p',
				'std' => 'disabled',
				'type' => 'select',
				'choices' => array(
					array(
						'label' => __( 'Disabled', 'live-composer-page-builder' ),
						'value' => 'disabled'
					),
					array(
						'label' => __( 'Enabled', 'live-composer-page-builder' ),
						'value' => 'enabled'
					),
				),
				'section' => 'responsive',
				'tab' => __( 'Phone', 'live-composer-page-builder' ),
			),
			array(
				'label' => __( 'Margin Bottom', 'live-composer-page-builder' ),
				'id' => 'css_res_ph_margin_bottom',
				'min' => -1000,
				'max' => 1000,
				'increment' => 1,
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => __( 'Phone', 'live-composer-page-builder' ),
				'ext' => 'px',
			),
			array(
				'label' => __( 'Content padding', 'live-composer-page-builder' ),
				'id' => 'content_p_padding',
				'type' => 'group_padding',
				'tab' => __( 'Phone', 'live-composer-page-builder' ),
				'section' => 'responsive',
				'affect_on_change_el' => '.dslc-html-module-content',
				'values' => array(
					'padding_top' => 'css_res_ph_main_padding_vertical',
					'padding_bottom' => 'css_res_ph_main_padding_vertical',
					'padding_left' => 'css_res_ph_main_padding_horizontal',
					'padding_right' => 'css_res_ph_main_padding_horizontal',
				),
			),
			array(
				'label' => __( 'Padding Vertical', 'live-composer-page-builder' ),
				'id' => 'css_res_ph_main_padding_vertical',
				'min' => 0,
				'max' => 600,
				'increment' => 1,
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content',
				'affect_on_change_rule' => 'padding-top,padding-bottom',
				'section' => 'responsive',
				'tab' => __( 'Phone', 'live-composer-page-builder' ),
				'ext' => 'px',
			),
			array(
				'label' => __( 'Padding Horizontal', 'live-composer-page-builder' ),
				'id' => 'css_res_ph_main_padding_horizontal',
				'min' => 0,
				'max' => 1000,
				'increment' => 1,
				'std' => '0',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content',
				'affect_on_change_rule' => 'padding-left,padding-right',
				'section' => 'responsive',
				'tab' => __( 'Phone', 'live-composer-page-builder' ),
				'ext' => 'px',
			),
			array(
				'label' => __( 'Font Size', 'live-composer-page-builder' ),
				'id' => 'css_res_ph_main_font_size',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content, .dslc-html-module-content p',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => __( 'Phone', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'Line Height', 'live-composer-page-builder' ),
				'id' => 'css_res_ph_main_line_height',
				'min' => 0,
				'max' => 120,
				'increment' => 1,
				'std' => '22',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content',
				'affect_on_change_rule' => 'line-height',
				'section' => 'responsive',
				'tab' => __( 'Phone', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H1 - Font Size', 'live-composer-page-builder' ),
				'id' => 'css_res_ph_h1_font_size',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h1',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => __( 'Phone', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H1 - Line Height', 'live-composer-page-builder' ),
				'id' => 'css_res_ph_h1_line_height',
				'min' => 0,
				'max' => 120,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h1',
				'affect_on_change_rule' => 'line-height',
				'section' => 'responsive',
				'tab' => __( 'Phone', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H1 - Margin Bottom', 'live-composer-page-builder' ),
				'id' => 'css_res_p_h1_margin_bottom',
				'min' => -1000,
				'max' => 1000,
				'increment' => 1,
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h1',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => __( 'Phone', 'live-composer-page-builder' ),
				'ext' => 'px'
			),

			array(
				'label' => __( 'H2 - Font Size', 'live-composer-page-builder' ),
				'id' => 'css_res_ph_h2_font_size',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h2',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => __( 'Phone', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H2 - Line Height', 'live-composer-page-builder' ),
				'id' => 'css_res_ph_h2_line_height',
				'min' => 0,
				'max' => 120,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h2',
				'affect_on_change_rule' => 'line-height',
				'section' => 'responsive',
				'tab' => __( 'Phone', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H2 - Margin Bottom', 'live-composer-page-builder' ),
				'id' => 'css_res_p_h2_margin_bottom',
				'min' => -1000,
				'max' => 1000,
				'increment' => 1,
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h2',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => __( 'Phone', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H3 - Font Size', 'live-composer-page-builder' ),
				'id' => 'css_res_ph_h3_font_size',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h3',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => __( 'Phone', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H3 - Line Height', 'live-composer-page-builder' ),
				'id' => 'css_res_ph_h3_line_height',
				'min' => 0,
				'max' => 120,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h3',
				'affect_on_change_rule' => 'line-height',
				'section' => 'responsive',
				'tab' => __( 'Phone', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H3 - Margin Bottom', 'live-composer-page-builder' ),
				'id' => 'css_res_p_h3_margin_bottom',
				'min' => -1000,
				'max' => 1000,
				'increment' => 1,
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h3',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => __( 'Phone', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H4 - Font Size', 'live-composer-page-builder' ),
				'id' => 'css_res_ph_h4_font_size',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h4',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => __( 'Phone', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H4 - Line Height', 'live-composer-page-builder' ),
				'id' => 'css_res_ph_h4_line_height',
				'min' => 0,
				'max' => 120,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h4',
				'affect_on_change_rule' => 'line-height',
				'section' => 'responsive',
				'tab' => __( 'Phone', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H4 - Margin Bottom', 'live-composer-page-builder' ),
				'id' => 'css_res_p_h4_margin_bottom',
				'min' => -1000,
				'max' => 1000,
				'increment' => 1,
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h4',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => __( 'Phone', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H5 - Font Size', 'live-composer-page-builder' ),
				'id' => 'css_res_ph_h5_font_size',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h5',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => __( 'Phone', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H5 - Line Height', 'live-composer-page-builder' ),
				'id' => 'css_res_ph_h5_line_height',
				'min' => 0,
				'max' => 120,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h5',
				'affect_on_change_rule' => 'line-height',
				'section' => 'responsive',
				'tab' => __( 'Phone', 'live-composer-page-builder' ),
				'ext' => 'px'
			),
			array(
				'label' => __( 'H5 - Margin Bottom', 'live-composer-page-builder' ),
				'id' => 'css_res_p_h5_margin_bottom',
				'min' => -1000,
				'max' => 1000,
				'increment' => 1,
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h5',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => __( 'Phone', 'live-composer-page-builder' ),
				'ext' => 'px',
			),
			array(
				'label' => __( 'H6 - Font Size', 'live-composer-page-builder' ),
				'id' => 'css_res_ph_h6_font_size',
				'min' => 0,
				'max' => 100,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h6',
				'affect_on_change_rule' => 'font-size',
				'section' => 'responsive',
				'tab' => __( 'Phone', 'live-composer-page-builder' ),
				'ext' => 'px',
			),
			array(
				'label' => __( 'H6 - Line Height', 'live-composer-page-builder' ),
				'id' => 'css_res_ph_h6_line_height',
				'min' => 0,
				'max' => 120,
				'increment' => 1,
				'std' => '13',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h6',
				'affect_on_change_rule' => 'line-height',
				'section' => 'responsive',
				'tab' => __( 'Phone', 'live-composer-page-builder' ),
				'ext' => 'px',
			),
			array(
				'label' => __( 'H6 - Margin Bottom', 'live-composer-page-builder' ),
				'id' => 'css_res_p_h6_margin_bottom',
				'min' => -1000,
				'max' => 1000,
				'increment' => 1,
				'std' => '15',
				'type' => 'slider',
				'refresh_on_change' => false,
				'affect_on_change_el' => '.dslc-html-module-content h6',
				'affect_on_change_rule' => 'margin-bottom',
				'section' => 'responsive',
				'tab' => __( 'Phone', 'live-composer-page-builder' ),
				'ext' => 'px',
			),
		);

		$dslc_options = array_merge( $dslc_options, $this->shared_options( 'animation_options', array('hover_opts' => false) ) );
		$dslc_options = array_merge( $dslc_options, $this->presets_options() );

		return apply_filters( 'dslc_module_options', $dslc_options, $this->module_id );

	}

	function output( $options ) {

		global $dslc_active;

		if ( $dslc_active && is_user_logged_in() && current_user_can( DS_LIVE_COMPOSER_CAPABILITY ) )
			$dslc_is_admin = true;
		else
			$dslc_is_admin = false;

		// Check if Error-Proof mode activated in module options
		$error_proof_mode = false;
		if ( isset( $options['error_proof_mode'] ) && $options['error_proof_mode'] != ''  ) {
			$error_proof_mode = true;
		}

		// Check if module rendered via ajax call
		$ajax_module_render = true;
		if ( isset( $options['module_render_nonajax'] ) ) {
			$ajax_module_render = false;
		}

		// Decide if we should render the module or wait for the page refresh
		$render_code = true;
		if ( $dslc_is_admin && $error_proof_mode && $ajax_module_render ) {
			$render_code = false;
		}

		$this->module_start( $options );

		/* Module output starts here */

			?><div class="dslc-html-module-content"<?php if ( $dslc_is_admin ) echo ' data-exportable-content'; ?>><?php

				if ( $render_code ) {
					$output_content = stripslashes( $options['content'] );
					$output_content = do_shortcode( $output_content );
				} else {
					$output_content = '<div class="dslc-notification dslc-green">' . __('Save and refresh the page to display the module safely.', 'live-composer-page-builder') . '</div>';
				}

				echo $output_content;

			?></div><?php

			if ( empty( $output_content ) && $dslc_is_admin ) :

				?><div class="dslc-notification dslc-red">Looks like there is no content.</div><?php

			endif;

		/* Module output ends here */

		$this->module_end( $options );

	}

}
