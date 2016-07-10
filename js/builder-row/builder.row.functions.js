
/*********************************
 *
 * = ROWS =
 *
 * - dslc_row_add ( Add New )
 * - dslc_row_delete ( Delete )
 * - dslc_row_edit ( Edit )
 * - dslc_row_edit_colorpicker_init ( Edit - Initiate Colorpicker )
 * - dslc_row_edit_slider_init ( Edit - Initiate Slider )
 * - dslc_row_edit_scrollbar_init ( Edit - Initiate Scrollbar )
 * - dslc_row_edit_cancel ( Edit - Cancel Changes )
 * - dslc_row_edit_confirm ( Edit - Confirm Changes )
 * - dslc_row_copy ( Copy )
 * - dslc_row_import ( Import )
 *
 ***********************************/

/**
 * Row - Add New
 */
function dslc_row_add( callback ) {

	if ( dslcDebug ) console.log( 'dslc_row_add' );

	callback = typeof callback !== 'undefined' ? callback : false;

	var defer = jQuery.Deferred();

	// AJAX Request
	jQuery.post(

		DSLCAjax.ajaxurl,
		{
			action : 'dslc-ajax-add-modules-section',
			dslc : 'active'
		},
		function( response ) {

			var newRow = jQuery(response.output);

			// Append new row
			newRow.appendTo(DSLC.Editor.frame.find("#dslc-main"));

			// Call other functions
			dslc_drag_and_drop();
			dslc_generate_code();
			dslc_show_publish_button();

			new DSLC_ModuleArea(newRow.find('.dslc-modules-area').eq(0)[0]);

			if ( callback ) { callback(); }

			newRow.find('.dslc-modules-area').addClass('dslc-modules-area-empty dslc-last-col');

			defer.resolve(newRow[0]);
		}
	);

	return defer;
}

/**
 * Row - Delete
 */
function dslc_row_delete( row ) {

	if ( dslcDebug ) console.log( 'dslc_row_delete' );

	// If the row is being edited
	if ( row.find('.dslca-module-being-edited') ) {

		// Hide the filter hooks
		jQuery('.dslca-header .dslca-options-filter-hook').hide();

		// Hide the save/cancel actions
		jQuery('.dslca-module-edit-actions').hide();

		// Show the section hooks
		jQuery('.dslca-header .dslca-go-to-section-hook').show();

		dslc_show_section('.dslca-modules');

	}

	// Remove row
	row.trigger('mouseleave').remove();

	// Call other functions
	dslc_generate_code();
	dslc_show_publish_button();
}

/**
 * Row - Edit
 */
function dslc_row_edit( row ) {

	if ( dslcDebug ) console.log( 'dslc_row_edit' );

	// Vars we will use
	var dslcModulesSectionOpts, dslcVal;

	// Set editing class
	jQuery('.dslca-module-being-edited', DSLC.Editor.frame).removeClass('dslca-module-being-edited');
	jQuery('.dslca-modules-section-being-edited', DSLC.Editor.frame).removeClass('dslca-modules-section-being-edited').removeClass('dslca-modules-section-change-made');
	row.addClass('dslca-modules-section-being-edited');

	// Hide the section hooks
	jQuery('.dslca-header .dslca-go-to-section-hook').hide();

	// Show the styling/responsive tabs
	jQuery('.dslca-row-options-filter-hook[data-section="styling"], .dslca-row-options-filter-hook[data-section="responsive"]').show();
	jQuery('.dslca-row-options-filter-hook[data-section="styling"]').trigger('click');

	// Hide the filter hooks
	jQuery('.dslca-header .dslca-options-filter-hook').hide();

	// Hide the save/cancel actions
	jQuery('.dslca-module-edit-actions').hide();

	// Show the save/cancel actions
	jQuery('.dslca-row-edit-actions').show();

	// Set current values
	jQuery('.dslca-modules-section-edit-field' , DSLC.Editor.frame).each(function(){


		/**
		 * Temporary migration from 'wrapped' value to 'wrapper' in ROW type selector
		 * TODO: delete this block in a few versions as problem do not exists on new installs
		 *
		 * @since ver 1.1
		 */
		if ( 'type' === jQuery(this).data('id') ) {

			if ( '' === jQuery('.dslca-modules-section-being-edited .dslca-modules-section-settings input[data-id="type"]').val() ||
				  'wrapped' === jQuery('.dslca-modules-section-being-edited .dslca-modules-section-settings input[data-id="type"]').val() ) {
				jQuery('select[data-id="type"]').val('wrapper').change();
			}
		}

		if ( jQuery(this).data('id') == 'border-top' ) {

			if ( jQuery('.dslca-modules-section-being-edited .dslca-modules-section-settings input[data-id="border"]').val().indexOf('top') >= 0 ) {
				jQuery(this).prop('checked', true);
				jQuery(this).siblings('.dslca-modules-section-edit-option-checkbox-hook').find('.dslca-icon').removeClass('dslc-icon-check-empty').addClass('dslc-icon-check');
			} else {
				jQuery(this).prop('checked', false);
				jQuery(this).siblings('.dslca-modules-section-edit-option-checkbox-hook').find('.dslca-icon').removeClass('dslc-icon-check').addClass('dslc-icon-check-empty');
			}

		} else if ( jQuery(this).data('id') == 'border-right' ) {

			if ( jQuery('.dslca-modules-section-being-edited .dslca-modules-section-settings input[data-id="border"]').val().indexOf('right') >= 0 ) {
				jQuery(this).prop('checked', true);
				jQuery(this).siblings('.dslca-modules-section-edit-option-checkbox-hook').find('.dslca-icon').removeClass('dslc-icon-check-empty').addClass('dslc-icon-check');
			} else {
				jQuery(this).prop('checked', false);
				jQuery(this).siblings('.dslca-modules-section-edit-option-checkbox-hook').find('.dslca-icon').removeClass('dslc-icon-check').addClass('dslc-icon-check-empty');
			}

		} else if ( jQuery(this).data('id') == 'border-bottom' ) {

			if ( jQuery('.dslca-modules-section-being-edited .dslca-modules-section-settings input[data-id="border"]').val().indexOf('bottom') >= 0 ) {
				jQuery(this).prop('checked', true);
				jQuery(this).siblings('.dslca-modules-section-edit-option-checkbox-hook').find('.dslca-icon').removeClass('dslc-icon-check-empty').addClass('dslc-icon-check');
			} else {
				jQuery(this).prop('checked', false);
				jQuery(this).siblings('.dslca-modules-section-edit-option-checkbox-hook').find('.dslca-icon').removeClass('dslc-icon-check').addClass('dslc-icon-check-empty');
			}

		} else if ( jQuery(this).data('id') == 'border-left' ) {

			if ( jQuery('.dslca-modules-section-being-edited .dslca-modules-section-settings input[data-id="border"]').val().indexOf('left') >= 0 ) {
				jQuery(this).prop('checked', true);
				jQuery(this).siblings('.dslca-modules-section-edit-option-checkbox-hook').find('.dslca-icon').removeClass('dslc-icon-check-empty').addClass('dslc-icon-check');
			} else {
				jQuery(this).prop('checked', false);
				jQuery(this).siblings('.dslca-modules-section-edit-option-checkbox-hook').find('.dslca-icon').removeClass('dslc-icon-check').addClass('dslc-icon-check-empty');
			}
		} else if ( jQuery(this).hasClass('dslca-modules-section-edit-field-checkbox') ) {

			if ( jQuery('.dslca-modules-section-being-edited .dslca-modules-section-settings input[data-id="' + jQuery(this).data('id') + '"]').val().indexOf( jQuery(this).data('val') ) >= 0 ) {
				jQuery( this ).prop('checked', true);
				jQuery( this ).siblings('.dslca-modules-section-edit-option-checkbox-hook').find('.dslca-icon').removeClass('dslc-icon-check-empty').addClass('dslc-icon-check');
			} else {
				jQuery( this ).prop('checked', false);
				jQuery( this ).siblings('.dslca-modules-section-edit-option-checkbox-hook').find('.dslca-icon').removeClass('dslc-icon-check').addClass('dslc-icon-check-empty');
			}
		} else {

			jQuery(this).val( jQuery('.dslca-modules-section-being-edited .dslca-modules-section-settings input[data-id="' + jQuery(this).data('id') + '"]').val() );

			if ( jQuery( this ).hasClass( 'dslca-modules-section-edit-field-colorpicker' ) ) {

				var _this = jQuery( this );
				jQuery( this ).closest( '.dslca-modules-section-edit-option' )
						.find( '.sp-preview-inner' )
						.removeClass('sp-clear-display')
						.css({ 'background-color' : _this.val() });

				jQuery( this ).css({ 'background-color' : _this.val() });
			}
		}
	});

	jQuery('.dslca-modules-section-edit-field-upload').each(function(){

		var dslcParent = jQuery(this).closest('.dslca-modules-section-edit-option');

		if ( jQuery(this).val() && jQuery(this).val() !== 'disabled' ) {

			jQuery('.dslca-modules-section-edit-field-image-add-hook', dslcParent ).hide();
			jQuery('.dslca-modules-section-edit-field-image-remove-hook', dslcParent ).show();
		} else {

			jQuery('.dslca-modules-section-edit-field-image-remove-hook', dslcParent ).hide();
			jQuery('.dslca-modules-section-edit-field-image-add-hook', dslcParent ).show();
		}
	});

	// Initiate numeric option sliders
	dslc_row_edit_slider_init();

	// Show options management
	dslc_show_section('.dslca-modules-section-edit');

	// Hide the publish butotn
	jQuery('.dslca-save-composer-hook').css({ 'visibility' : 'hidden' });
	jQuery('.dslca-save-draft-composer-hook').css({ 'visibility' : 'hidden' });
}

/**
 * Row - Edit - Initiate Colorpicker
 */
function dslc_row_edit_colorpicker_init( field ) {

	if ( dslcDebug ) console.log( 'dslc_row_edit_colorpicker_init' );

	var dslcField,
	dslcFieldID,
	dslcEl,
	dslcModulesSection,
	dslcVal,
	dslcRule,
	dslcSetting,
	dslcTargetEl,
	dslcCurrColor;

	/**
	 * Color Pallete
	 */

	var dslcColorPallete = [],
	currStorage,
	index;

	dslcColorPallete[0] = [];
	dslcColorPallete[1] = [];
	dslcColorPallete[2] = [];
	dslcColorPallete[3] = [];

	if ( localStorage['dslcColorpickerPalleteStorage'] == undefined ) {
	} else {

		currStorage = JSON.parse( localStorage['dslcColorpickerPalleteStorage'] );

		for	( index = 0; index < currStorage.length; index++ ) {

			var key = Math.floor( index / 3 );

			if ( key < 4 ) {

				dslcColorPallete[key].push( currStorage[index] );
			}
		}
	}

	var query = field || '.dslca-modules-section-edit-field-colorpicker';

	jQuery(query).each( function(){

		dslcCurrColor = jQuery(this).val();

		jQuery(this).spectrum({
			color: dslcCurrColor,
			showInput: true,
			allowEmpty: true,
			showAlpha: true,
			clickoutFiresChange: true,
			cancelText: '',
			chooseText: '',
			preferredFormat: 'rgb',
			showPalette: true,
			palette: dslcColorPallete,
			move: function( color ) {

				dslcField = jQuery(this);
				dslcFieldID = dslcField.data('id');

				if ( color == null ) {

					dslcVal = '';
					// dslcVal = 'transparent';
				} else {

					dslcVal = color.toRgbString();
				}

				dslcRule = dslcField.data('css-rule');
				dslcEl = jQuery('.dslca-modules-section-being-edited');
				dslcTargetEl = dslcEl;
				dslcSetting = jQuery('.dslca-modules-section-settings input[data-id="' + dslcFieldID + '"]', dslcEl );

				dslcEl.addClass('dslca-modules-section-change-made');

				if ( dslcField.data('css-element') ) {

					dslcTargetEl = jQuery( dslcField.data('css-element'), dslcEl );
				}

				dslcTargetEl.css(dslcRule, dslcVal);
				dslcSetting.val( dslcVal );
			},
			change: function( color ) {

				dslcField = jQuery(this);
				dslcFieldID = dslcField.data('id');

				if ( color == null ) {

					dslcVal = '';
					// dslcVal = 'transparent';
				} else {

					dslcVal = color.toRgbString();
				}

				// Update pallete local storage
				if ( localStorage['dslcColorpickerPalleteStorage'] == undefined ) {

					var newStorage = [ dslcVal ];
					localStorage['dslcColorpickerPalleteStorage'] = JSON.stringify(newStorage);
				} else {

					var newStorage = JSON.parse( localStorage['dslcColorpickerPalleteStorage'] );

					if ( newStorage.indexOf( dslcVal ) == -1 ) {

						newStorage.unshift( dslcVal );
					}

					localStorage['dslcColorpickerPalleteStorage'] = JSON.stringify(newStorage);
				}
			},
			show: function( color ) {

				jQuery('body').addClass('dslca-disable-selection');
				jQuery(this).spectrum( 'set', jQuery(this).val() );
			},
			hide: function() {

				jQuery('body').removeClass('dslca-disable-selection');
			}
		});

		DSLC.Editor.colorpickers.push( jQuery( this ) );
	});
}

/**
 * Row - Edit - Initiate Slider
 */
function dslc_row_edit_slider_init() {

	if ( dslcDebug ) console.log( 'dslc_row_edit_slider_init' );

	jQuery('.dslca-modules-section-edit-field-slider').each(function(){

		var dslcSlider, dslcSliderField, dslcSliderInput, dslcSliderVal, dslcAffectOnChangeRule, dslcAffectOnChangeEl,
		dslcSliderTooltip, dslcSliderTooltipOffset, dslcSliderHandle, dslcSliderTooltipPos, dslcSection, dslcOptionID, dslcSliderExt = '',
		dslcAffectOnChangeRules, dslcSliderMin = 0, dslcSliderMax = 300, dslcSliderIncr = 1;

		dslcSlider = jQuery(this);
		dslcSliderInput = dslcSlider.siblings('.dslca-modules-section-edit-field');
		dslcSliderTooltip = dslcSlider.siblings('.dslca-modules-section-edit-field-slider-tooltip');

		if ( dslcSlider.data('min') ) {

			dslcSliderMin = dslcSlider.data('min');
		}

		if ( dslcSlider.data('max') ) {

			dslcSliderMax = dslcSlider.data('max');
		}

		if ( dslcSlider.data('incr') ) {

			dslcSliderIncr = dslcSlider.data('incr');
		}

		if ( dslcSlider.data('ext') ) {

			dslcSliderExt = dslcSlider.data('ext');
		}

		dslcSlider.slider({
			min : dslcSliderMin,
			max : dslcSliderMax,
			step: dslcSliderIncr,
			value: dslcSliderInput.val(),
			slide: function(event, ui) {

				dslcSliderVal = ui.value + dslcSliderExt;
				dslcSliderInput.val( dslcSliderVal );

				// Live change
				dslcAffectOnChangeEl = jQuery('.dslca-modules-section-being-edited');

				if ( dslcSliderInput.data('css-element') ) {

					dslcAffectOnChangeEl = jQuery( dslcSliderInput.data('css-element'), dslcAffectOnChangeEl );
				}

				dslcAffectOnChangeRule = dslcSliderInput.data('css-rule').replace(/ /g,'');
				dslcAffectOnChangeRules = dslcAffectOnChangeRule.split( ',' );

				// Loop through rules (useful when there are multiple rules)
				for ( var i = 0; i < dslcAffectOnChangeRules.length; i++ ) {

					jQuery( dslcAffectOnChangeEl ).css( dslcAffectOnChangeRules[i] , dslcSliderVal );
				}

				// Update option
				dslcSection = jQuery('.dslca-modules-section-being-edited');
				dslcOptionID = dslcSliderInput.data('id');
				jQuery('.dslca-modules-section-settings input[data-id="' + dslcOptionID + '"]', dslcSection).val( ui.value );

				dslcSection.addClass('dslca-modules-section-change-made');

				// Tooltip
				dslcSliderTooltip.text( dslcSliderVal );
				dslcSliderHandle = dslcSlider.find('.ui-slider-handle');
				dslcSliderTooltipOffset = dslcSliderHandle[0].style.left;
				dslcSliderTooltip.css({ left : dslcSliderTooltipOffset });
			},
			stop: function( event, ui ) {

				dslcSliderTooltip.hide();

				var scrollOffset = jQuery( window ).scrollTop();
				dslc_masonry();
				jQuery( window ).scrollTop( scrollOffset );
			},
			start: function( event, ui ) {

				dslcSliderVal = ui.value;

				dslcSliderTooltip.show();

				// Tooltip
				dslcSliderTooltip.text( dslcSliderVal );
				dslcSliderHandle = dslcSlider.find('.ui-slider-handle');
				dslcSliderTooltipOffset = dslcSliderHandle[0].style.left;
				dslcSliderTooltip.css({ left : dslcSliderTooltipOffset });
			}
		});
	});
}

/**
 * Row - Edit - Initiate Scrollbar
 */
function dslc_row_edit_scrollbar_init() {

	if ( dslcDebug ) console.log( 'dslc_row_edit_scrollbar_init' );

	var dslcWidth = 0;

	jQuery('.dslca-modules-section-edit-option').each(function(){

		dslcWidth += jQuery(this).outerWidth(true) + 1;
	});

	if ( dslcWidth > jQuery( '.dslca-modules-section-edit-options' ).width() ) {

		jQuery('.dslca-modules-section-edit-options-wrapper').width( dslcWidth );
	} else {

		jQuery('.dslca-modules-section-edit-options-wrapper').width( 'auto' );
	}

	if ( ! jQuery('body').hasClass('rtl') ) {

		if ( jQuery('.dslca-modules-section-edit-options-inner').data('jsp') ) {
			jQuery('.dslca-modules-section-edit-options-inner').data('jsp').destroy();
		}
		// jQuery('.dslca-modules-section-edit-options-inner').jScrollPane();
	}
}

/**
 * Row - Edit - Cancel Changes
 */
function dslc_row_edit_cancel( callback ) {

	if ( dslcDebug ) console.log( 'dslc_row_cancel_changes' );

	callback = typeof callback !== 'undefined' ? callback : false;

	// Recover original data from data-def attribute for each control
	jQuery('.dslca-modules-section-being-edited .dslca-modules-section-settings input').each(function(){

		jQuery(this).val( jQuery(this).data('def') );

		// Fire change for every ROW control, so it redraw linked CSS properties
		jQuery('.dslca-modules-section-edit-field[data-id="' + jQuery(this).data('id') + '"]').val( jQuery(this).data('def') ).trigger('change');
	});

	dslc_show_section('.dslca-modules');

	// Hide the save/cancel actions
	jQuery('.dslca-row-edit-actions').hide();

	// Hide the styling/responsive tabs
	jQuery('.dslca-row-options-filter-hook').hide();

	// Show the section hooks
	jQuery('.dslca-header .dslca-go-to-section-hook').show();

	// Show the publish button
	jQuery('.dslca-save-composer-hook').css({ 'visibility' : 'visible' });
	jQuery('.dslca-save-draft-composer-hook').css({ 'visibility' : 'visible' });

	// Remove being edited class
	jQuery('.dslca-modules-section-being-edited').removeClass('dslca-modules-section-being-edited dslca-modules-section-change-made');

	if ( callback ) { callback(); }

	// Show the publish button
	jQuery('.dslca-save-composer-hook').css({ 'visibility' : 'visible' });
	jQuery('.dslca-save-draft-composer-hook').css({ 'visibility' : 'visible' });
}

/**
 * Row - Edit - Confirm Changes
 */
function dslc_row_edit_confirm( callback ) {

	if ( dslcDebug ) console.log( 'dslc_confirm_row_changes' );

	callback = typeof callback !== 'undefined' ? callback : false;

	jQuery('.dslca-modules-section-being-edited .dslca-modules-section-settings input').each(function(){

		jQuery(this).data( 'def', jQuery(this).val() );
	});

	dslc_show_section('.dslca-modules');

	// Hide the save/cancel actions
	jQuery('.dslca-row-edit-actions').hide();

	// Hide the styling/responsive tabs
	jQuery('.dslca-row-options-filter-hook').hide();

	// Show the section hooks
	jQuery('.dslca-header .dslca-go-to-section-hook').show();

	// Show the publish button
	jQuery('.dslca-save-composer-hook').css({ 'visibility' : 'visible' });
	jQuery('.dslca-save-draft-composer-hook').css({ 'visibility' : 'visible' });

	// Remove being edited class
	jQuery('.dslca-modules-section-being-edited').removeClass('dslca-modules-section-being-edited dslca-modules-section-change-made');

	dslc_generate_code();
	dslc_show_publish_button();

	if ( callback ) { callback(); }

	// Show the publish button
	jQuery('.dslca-save-composer-hook').css({ 'visibility' : 'visible' });
	jQuery('.dslca-save-draft-composer-hook').css({ 'visibility' : 'visible' });
}

/**
 * Row - Copy
 */
function dslc_row_copy( row ) {

	if ( dslcDebug ) console.log( 'dslc_row_copy' );

	// Vars that will be used
	var dslcModuleID,
	dslcModulesSectionCloned,
	dslcModule;

	// Clone the row
	dslcModulesSectionCloned = row.clone().appendTo('#dslc-main');

	// Go through each area of the new row and apply correct data-size
	dslcModulesSectionCloned.find('.dslc-modules-area').each(function(){
		var dslcIndex = jQuery(this).index();
		jQuery(this).data('size', row.find('.dslc-modules-area:eq( ' + dslcIndex + ' )').data('size') );
	});

	// Remove animations and temporary hide modules
	dslcModulesSectionCloned.find('.dslc-module-front').css({
		'-webkit-animation-name' : 'none',
		'-moz-animation-name' : 'none',
		'animation-name' : 'none',
		'animation-duration' : '0',
		'-webkit-animation-duration' : '0',
		opacity : 0

	// Go through each module
	}).each(function(){

		// Current module
		dslcModule = jQuery(this);

		// Reguest new ID
		jQuery.ajax({
			type: 'POST',
			method: 'POST',
			url: DSLCAjax.ajaxurl,
			data: { action : 'dslc-ajax-get-new-module-id' },
			async: false
		}).done(function( response ) {

			// Remove "being-edited" class
			jQuery('.dslca-module-being-edited').removeClass('dslca-module-being-edited');

			// Get new ID
			dslcModuleID = response.output;

			// Apply new ID and append "being-edited" class
			dslcModule.data( 'module-id', dslcModuleID ).attr( 'id', 'dslc-module-' + dslcModuleID ).addClass('dslca-module-being-edited');

			// Reload the module, remove "being-edited" class and show module
			dslc_module_output_altered( function(){
				jQuery('.dslca-module-being-edited').removeClass('dslca-module-being-edited').animate({
					opacity : 1
				}, 300);
			});

		});

	});

	// Call additional functions
	dslc_drag_and_drop();
	dslc_generate_code();
	dslc_show_publish_button();
}

/**
 * Row - Import
 */
function dslc_row_import( rowCode ) {

	if ( dslcDebug ) console.log( 'dslc_row_import' );

	// AJAX Call
	jQuery.post(

		DSLCAjax.ajaxurl,
		{
			action : 'dslc-ajax-import-modules-section',
			dslc : 'active',
			dslc_modules_section_code : rowCode
		},
		function( response ) {

			// Close the import popup/modal
			dslc_js_confirm_close();

			// Add the new section
			jQuery('#dslc-main').append( response.output );

			// Call other functions
			dslc_bg_video();
			dslc_carousel();
			dslc_masonry( jQuery('#dslc-main').find('.dslc-modules-section:last-child') );
			dslc_drag_and_drop();
			dslc_show_publish_button();
			dslc_generate_code();
		}
	);
}

/**
 * Deprecated Functions and Fallbacks
 */

function dslc_add_modules_section() { dslc_row_add(); }
function dslc_delete_modules_section( row  ) { dslc_row_delete( row ); }
function dslc_edit_modules_section( row ) { dslc_row_edit( row ); }
function dslc_edit_modules_section_colorpicker() { dslc_row_edit_colorpicker_init(); }
function dslc_edit_modules_section_slider() { dslc_row_edit_slider_init(); }
function dslc_edit_modules_section_scroller() { dslc_row_edit_scrollbar_init(); }
function dslc_copy_modules_section( row ) { dslc_row_copy( row ); }
function dslc_import_modules_section( rowCode ) { dslc_row_import( rowCode ); }

/**
 * Row - Document Ready Actions
 */

jQuery(document).ready(function($){

	/**
	 * Initialize
	 */

	/*dslc_row_edit_colorpicker_init();
	dslc_row_edit_slider_init();*/


	/**
	 * Hook - Confirm Row Changes
	 */
	$(document).on( 'click', '.dslca-row-edit-save', function(){

		dslc_row_edit_confirm();
		$('.dslca-row-options-filter-hook.dslca-active').removeClass('dslca-active');
		dslc_responsive_classes( true );
	});

	/**
	 * Hook - Cancel Row Changes
	 */
	$(document).on( 'click', '.dslca-row-edit-cancel', function(){

		dslc_row_edit_cancel();
		$('.dslca-row-options-filter-hook.dslca-active').removeClass('dslca-active');
		dslc_responsive_classes( true );
	});
});