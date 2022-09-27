(function($) {
	"use strict";
	$(function() {

		$('.google-fonts-list').each(function (i, obj) {
			if (!$(this).hasClass('select2-hidden-accessible')) {
				$(this).select2();
			}
		});

		$('.google-fonts-list').on('change', function() {
			var selectedFont = $(this).val();
			var elementRegularWeight = $(this).parent().parent().find('.google-fonts-regularweight-style');
			var elementItalicWeight = $(this).parent().parent().find('.google-fonts-italicweight-style');
			var elementBoldWeight = $(this).parent().parent().find('.google-fonts-boldweight-style');
			var customizerControlName = $(this).attr('control-name');
			var elementItalicWeightCount = 0;
			var elementBoldWeightCount = 0;
	
			// Clear Weight/Style dropdowns
			elementRegularWeight.empty();
			elementItalicWeight.empty();
			elementBoldWeight.empty();
			// Make sure Italic & Bold dropdowns are enabled
			elementItalicWeight.prop('disabled', false);
			elementBoldWeight.prop('disabled', false);
	
			// Get the Google Fonts control object
			var bodyfontcontrol = _wpCustomizeSettings.controls[customizerControlName];
	
			// Find the index of the selected font
			var indexes = $.map(bodyfontcontrol.fontslist, function(obj, index) {
				if(obj.family === selectedFont) {
					return index;
				}
			});
			var index = indexes[0];
	
			// For the selected Google font show the available weight/style variants
			$.each(bodyfontcontrol.fontslist[index].variants, function(val, text) {
	
				elementRegularWeight.append(
					$('<option></option>').val(text).html(text)
				);
	
				//Set default value
				if ( $(elementRegularWeight).find( 'option[value="regular"]').length > 0 ) {
					$( elementRegularWeight ).val( 'regular' );
				} else if ( $(elementRegularWeight).find( 'option[value="400"]').length > 0 ) {
					$( elementRegularWeight ).val( '400' );
				} else if ( $(elementRegularWeight).find( 'option[value="300"]').length > 0 ) {
					$( elementRegularWeight ).val( '300' );
				}
	
				if (text.indexOf("italic") >= 0) {
					elementItalicWeight.append(
						$('<option></option>').val(text).html(text)
					);
					elementItalicWeightCount++;
	
					if ( $(elementItalicWeight).find( 'option[value="italic"]').length > 0 ) {
						$( elementItalicWeight ).val( 'italic' );
					} else if ( $(elementItalicWeight).find( 'option[value="400italic"]').length > 0 ) {
						$( elementItalicWeight ).val( '400italic' );
					} else if ( $(elementItalicWeight).find( 'option[value="300italic"]').length > 0 ) {
						$( elementItalicWeight ).val( '300italic' );
					}				
				} else {
					elementBoldWeight.append(
						$('<option></option>').val(text).html(text)
					);
					elementBoldWeightCount++;
	
					if ( $(elementBoldWeight).find( 'option[value="600"]').length > 0 ) {
						$( elementBoldWeight ).val( '600' );
					} else if ( $(elementBoldWeight).find( 'option[value="500"]').length > 0 ) {
						$( elementBoldWeight ).val( '500' );
					} else if ( $(elementBoldWeight).find( 'option[value="700"]').length > 0 ) {
						$( elementBoldWeight ).val( '700' );
					}				
				}
			});
	
			if(elementItalicWeightCount == 0) {
				elementItalicWeight.append(
					$('<option></option>').val('').html('Not Available')
				);
				elementItalicWeight.prop('disabled', 'disabled');
			}
			if(elementBoldWeightCount == 0) {
				elementBoldWeight.append(
					$('<option></option>').val('').html('Not Available')
				);
				elementBoldWeight.prop('disabled', 'disabled');
			}
	
			// Update the font category based on the selected font
			$(this).parent().parent().find('.google-fonts-category').val(bodyfontcontrol.fontslist[index].category);
	
			fontsGetAllSelects( $(this).parent().parent().parent().parent() );
		});
  
		$('.google_fonts_select_control select').on('change', function() {
			fontsGetAllSelects( $(this).parent().parent().parent().parent() );
		});
  
		function fontsGetAllSelects($element) {
			var selectedFont = {
				font: $element.find('.google-fonts-list').val(),
				regularweight: $element.find('.google-fonts-regularweight-style').val(),
				italicweight: $element.find('.google-fonts-italicweight-style').val(),
				boldweight: $element.find('.google-fonts-boldweight-style').val(),
				category: $element.find('.google-fonts-category').val()
			};
	
			// Important! Make sure to trigger change event so Customizer knows it has to save the field
			$element.find('.customize-control-google-font-selection').val(JSON.stringify(selectedFont)).trigger('change');
		} 


		$('.customize-control-tabs-control').each(function () {
			$(this).parent().find('li').not('.section-meta').not('.customize-control-tabs-control').addClass('hide-control');
			var generals = $(this).find('.control-tab-general').data('connected');
			$.each(generals, function (i, v) {
				$(this).removeClass('hide-control');
			});
			$(this).find('.control-tab').on('click', function () {
				var visibles = $(this).data('connected');
				$(this).addClass('active');
				$(this).siblings().removeClass('active');
				$(this).parent().parent().parent().find('li').not('.section-meta').not('.customize-control-tabs-control').addClass('hide-control');
				$.each(visibles, function (i, v) {
					$(this).removeClass('hide-control');
				});
			});
		});



		$('.alpha-color-control').each(function () {
			// Scope the vars.
			var $control, startingColor, paletteInput, showOpacity, defaultColor, palette, colorPickerOptions, $container, $alphaSlider, alphaVal, sliderOptions;
		
			$control = $(this); // Get a clean starting value for the option.
		
			startingColor = $control.val().replace(/\s+/g, ''); // Get some data off the control.
		
			paletteInput = $control.attr('data-palette');
			showOpacity = $control.attr('data-show-opacity');
			defaultColor = $control.attr('data-default-color'); // Process the palette.
		
			if (paletteInput.indexOf('|') !== -1) {
				palette = paletteInput.split('|');
			} else if ('false' == paletteInput) {
				palette = false;
			} else {
				palette = true;
			} // Set up the options that we'll pass to wpColorPicker().
	
	
			colorPickerOptions = {
				change: function change(event, ui) {
				var key, value, alpha, $transparency;
				key = $control.attr('data-customize-setting-link');
				value = $control.wpColorPicker('color'); // Set the opacity value on the slider handle when the default color button is clicked.
		
				if (defaultColor == value) {
					alpha = colorpicker_get_alpha_value_from_color(value);
					$alphaSlider.find('.ui-slider-handle').text(alpha);
				} // Send ajax request to wp.customize to trigger the Save action.
		
		
				wp.customize(key, function (obj) {
					obj.set(value);
				});
				$transparency = $container.find('.transparency'); // Always show the background color of the opacity slider at 100% opacity.
		
				$transparency.css('background-color', ui.color.toString('no-alpha'));
				},
				palettes: palette // Use the passed in palette.
		
			}; // Create the colorpicker.
	
			$control.wpColorPicker(colorPickerOptions);
			$container = $control.parents('.wp-picker-container:first'); // Insert our opacity slider.
	
			$('<div class="alpha-color-picker-container">' + '<div class="min-click-zone click-zone"></div>' + '<div class="max-click-zone click-zone"></div>' + '<div class="alpha-slider"></div>' + '<div class="transparency"></div>' + '</div>').appendTo($container.find('.wp-picker-holder'));
			$alphaSlider = $container.find('.alpha-slider'); // If starting value is in format RGBa, grab the alpha channel.
	
			alphaVal = colorpicker_get_alpha_value_from_color(startingColor); // Set up jQuery UI slider() options.
	
			sliderOptions = {
				create: function create(event, ui) {
				var value = $(this).slider('value'); // Set up initial values.
		
				$(this).find('.ui-slider-handle').text(value);
				$(this).siblings('.transparency ').css('background-color', startingColor);
				},
				value: alphaVal,
				range: 'max',
				step: 1,
				min: 0,
				max: 100,
				animate: 300
			}; // Initialize jQuery UI slider with our options.
	
			$alphaSlider.slider(sliderOptions); // Maybe show the opacity on the handle.
		
			if ('true' == showOpacity) {
				$alphaSlider.find('.ui-slider-handle').addClass('show-opacity');
			} // Bind event handlers for the click zones.
	
	
			$container.find('.min-click-zone').on('click', function () {
				colorpicker_update_alpha_value_on_color_control(0, $control, $alphaSlider, true);
			});
			$container.find('.max-click-zone').on('click', function () {
				colorpicker_update_alpha_value_on_color_control(100, $control, $alphaSlider, true);
			}); // Bind event handler for clicking on a palette color.
	
			$container.find('.iris-palette').on('click', function () {
				var color, alpha;
				color = $(this).css('background-color');
				alpha = colorpicker_get_alpha_value_from_color(color);
				colorpicker_update_alpha_value_on_alpha_slider(alpha, $alphaSlider); // Sometimes Iris doesn't set a perfect background-color on the palette,
				// for example rgba(20, 80, 100, 0.3) becomes rgba(20, 80, 100, 0.298039).
				// To compensante for this we round the opacity value on RGBa colors here
				// and save it a second time to the color picker object.
		
				if (alpha != 100) {
				color = color.replace(/[^,]+(?=\))/, (alpha / 100).toFixed(2));
				}
		
				$control.wpColorPicker('color', color);
			}); // Bind event handler for clicking on the 'Clear' button.
	
			$container.find('.button.wp-picker-clear').on('click', function () {
				var key = $control.attr('data-customize-setting-link'); // The #fff color is delibrate here. This sets the color picker to white instead of the
				// defult black, which puts the color picker in a better place to visually represent empty.
		
				$control.wpColorPicker('color', '#ffffff'); // Set the actual option value to empty string.
		
				wp.customize(key, function (obj) {
				obj.set('');
				});
				colorpicker_update_alpha_value_on_alpha_slider(100, $alphaSlider);
			}); // Bind event handler for clicking on the 'Default' button.
		
			$container.find('.button.wp-picker-default').on('click', function () {
				var alpha = colorpicker_get_alpha_value_from_color(defaultColor);
				colorpicker_update_alpha_value_on_alpha_slider(alpha, $alphaSlider);
			}); // Bind event handler for typing or pasting into the input.
	
			$control.on('input', function () {
				var value = $(this).val();
				var alpha = colorpicker_get_alpha_value_from_color(value);
				colorpicker_update_alpha_value_on_alpha_slider(alpha, $alphaSlider);
			}); // Update all the things when the slider is interacted with.
	
			$alphaSlider.slider().on('slide', function (event, ui) {
				var alpha = parseFloat(ui.value) / 100.0;
				colorpicker_update_alpha_value_on_color_control(alpha, $control, $alphaSlider, false); // Change value shown on slider handle.
		
				$(this).find('.ui-slider-handle').text(ui.value);
			});
		});
		/**
		 * Override the stock color.js toString() method to add support for outputting RGBa or Hex.
		 */
	
		Color.prototype.toString = function (flag) {
			// If our no-alpha flag has been passed in, output RGBa value with 100% opacity.
			// This is used to set the background color on the opacity slider during color changes.
			if ('no-alpha' == flag) {
				return this.toCSS('rgba', '1').replace(/\s+/g, '');
			} // If we have a proper opacity value, output RGBa.
		
		
			if (1 > this._alpha) {
				return this.toCSS('rgba', this._alpha).replace(/\s+/g, '');
			} // Proceed with stock color.js hex output.
		
		
			var hex = parseInt(this._color, 10).toString(16);
		
			if (this.error) {
				return '';
			}
		
			if (hex.length < 6) {
				for (var i = 6 - hex.length - 1; i >= 0; i--) {
				hex = '0' + hex;
				}
			}
		
			return '#' + hex;
		};
		/**
		 * Given an RGBa, RGB, or hex color value, return the alpha channel value.
		 */
	
	
		function colorpicker_get_alpha_value_from_color(value) {
			var alphaVal; // Remove all spaces from the passed in value to help our RGBa regex.
		
			value = value.replace(/ /g, '');
		
			if (value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)) {
				alphaVal = parseFloat(value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)[1]).toFixed(2) * 100;
				alphaVal = parseInt(alphaVal);
			} else {
				alphaVal = 100;
			}
		
			return alphaVal;
		}
		/**
		 * Force update the alpha value of the color picker object and maybe the alpha slider.
		 */
	
	
		function colorpicker_update_alpha_value_on_color_control(alpha, $control, $alphaSlider, update_slider) {
			var iris, colorPicker, color;
			iris = $control.data('a8cIris');
			colorPicker = $control.data('wpWpColorPicker'); // Set the alpha value on the Iris object.
		
			iris._color._alpha = alpha; // Store the new color value.
		
			color = iris._color.toString(); // Set the value of the input.
		
			$control.val(color); // Update the background color of the color picker.
	
			colorPicker.toggler.css({
				'background-color': color
			}); // Maybe update the alpha slider itself.
	
			if (update_slider) {
				colorpicker_update_alpha_value_on_alpha_slider(alpha, $alphaSlider);
			} // Update the color value of the color picker object.
	
	
			$control.wpColorPicker('color', color);
		}
		/**
		 * Update the slider handle position and label.
		 */
	
	
		function colorpicker_update_alpha_value_on_alpha_slider(alpha, $alphaSlider) {
			$alphaSlider.slider('value', alpha);
			$alphaSlider.find('.ui-slider-handle').text(alpha.toString());
		}

		$('.wp-picker-input-wrap').each(function () {
			$(this).prependTo($(this).next('.wp-picker-holder'));
		});


		$('.devices-preview').find('button').on('click', function (event) {
			if ($(this).hasClass('preview-desktop')) {
			  $('.devices-preview').find('.preview-desktop').addClass('active');
			  $('.devices-preview').find('.preview-tablet').removeClass('active');
			  $('.devices-preview').find('.preview-mobile').removeClass('active');
			  $('.range--slider-desktop').addClass('active');
			  $('.range--slider-tablet').removeClass('active');
			  $('.range--slider-mobile').removeClass('active');
			  $('.wp-full-overlay-footer .devices button[data-device="desktop"]').trigger('click');
			} else if ($(this).hasClass('preview-tablet')) {
			  $('.devices-preview').find('.preview-tablet').addClass('active');
			  $('.devices-preview').find('.preview-desktop').removeClass('active');
			  $('.devices-preview').find('.preview-mobile').removeClass('active');
			  $('.range--slider-desktop').removeClass('active');
			  $('.range--slider-tablet').addClass('active');
			  $('.range--slider-mobile').removeClass('active');
			  $('.wp-full-overlay-footer .devices button[data-device="tablet"]').trigger('click');
			} else {
			  $('.devices-preview').find('.preview-mobile').addClass('active');
			  $('.devices-preview').find('.preview-desktop').removeClass('active');
			  $('.devices-preview').find('.preview-tablet').removeClass('active');
			  $('.range--slider-desktop').removeClass('active');
			  $('.range--slider-tablet').removeClass('active');
			  $('.range--slider-mobile').addClass('active');
			  $('.wp-full-overlay-footer .devices button[data-device="mobile"]').trigger('click');
			}
		  });
		  $(' .wp-full-overlay-footer .devices button ').on('click', function () {
			var device = $(this).attr('data-device');
			$('.devices-preview').find('.preview-' + device).trigger('click');
		  });

	});
})(jQuery);