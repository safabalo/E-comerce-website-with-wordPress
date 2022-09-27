/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					clip: 'auto',
					position: 'relative',
				} );
				$( '.site-title a, .site-description' ).css( {
					color: to,
				} );
			}
		} );
	} );
	// Typography

	wp.customize('cosme_heading_font', function (value) {
		value.bind(function (to) {
		  $('head').find('#cosme-preview-google-fonts-heading-css').remove();
		  $('head').append('<link id="cosme-preview-google-fonts-heading-css" href="" rel="stylesheet">');
		  $('#cosme-preview-google-fonts-heading-css').attr('href', 'https://fonts.googleapis.com/css?family=' + jQuery.parseJSON(to)['font'].replace(/ /g, '+') + ':' + jQuery.parseJSON(to)['regularweight'] + '&display=swap');
		  $('h1,h2,h3,h4,h5,h6,.site-title').css('font-family', jQuery.parseJSON(to)['font']);
		  $('h1,h2,h3,h4,h5,h6,.site-title').css('font-weight', jQuery.parseJSON(to)['regularweight']);
		});
	});

	wp.customize('cosme_base_font', function (value) {
		value.bind(function (to) {
		  $('head').find('#cosme-preview-google-fonts-base-css').remove();
		  $('head').append('<link id="cosme-preview-google-fonts-base-css" href="" rel="stylesheet">');
		  $('#cosme-preview-google-fonts-base-css').attr('href', 'https://fonts.googleapis.com/css?family=' + jQuery.parseJSON(to)['font'].replace(/ /g, '+') + ':' + jQuery.parseJSON(to)['regularweight'] + '&display=swap');
		  $('body').css('font-family', jQuery.parseJSON(to)['font']);
		  $('body').css('font-weight', jQuery.parseJSON(to)['regularweight']);
		});
	});

	wp.customize('cosme_heading_font_style', function (value) {
		value.bind(function (to) {
		  $('h1,h2,h3,h4,h5,h6,.site-title').css('font-style', to);
		});
	});

	wp.customize('cosme_heading_line_height', function (value) {
		value.bind(function (to) {
		  $('h1,h2,h3,h4,h5,h6,.site-title').css('line-height', to);
		});
	});
	wp.customize('cosme_heading_letter_spacing', function (value) {
		value.bind(function (to) {
			$('h1,h2,h3,h4,h5,h6,.site-title').css('letter-spacing', to + 'px');
		});
	});
	wp.customize('cosme_heading_text_transform', function (value) {
		value.bind(function (to) {
			$('h1,h2,h3,h4,h5,h6,.site-title').css('text-transform', to);
		});
	});

	wp.customize('cosme_base_font_style', function (value) {
        value.bind(function (to) {
          $('body').css('font-style', to);
        });
    });

    wp.customize('cosme_base_line_height', function (value) {
        value.bind(function (to) {
          $('body').css('line-height', to);
        });
    });
    wp.customize('cosme_base_letter_spacing', function (value) {
        value.bind(function (to) {
            $('body').css('letter-spacing', to + 'px');
        });
    });
    wp.customize('cosme_base_text_transform', function (value) {
        value.bind(function (to) {
            $('body').css('text-transform', to);
        });
    });
	
	wp.customize('cosme_archive_meta_size', function (value) {
		value.bind(function (to) {
			$('head').find('#cosme-customizer-styles-archive-meta-size').remove();
			$('head').append('<style id="cosme-customizer-styles-archive-meta-size">' + '.entry-meta { font-size:' + to + 'px; }' + '</style>');
		});
	}); // Responsive

	var $devices = {
		"desktop": "(min-width: 992px)",
		"tablet": "(min-width: 576px) and (max-width: 991px)",
		"mobile": "(max-width: 575px)"
	};

	var $fontSizes = {
		"cosme_base_font_size": "body",
		"cosme_heading_h1_font_size": "h1:not(.site-title)",
		"cosme_heading_h2_font_size": "h2",
		"cosme_heading_h3_font_size": "h3",
		"cosme_heading_h4_font_size": "h4",
		"cosme_heading_h5_font_size": "h5",
		"cosme_heading_h6_font_size": "h6",
		"cosme_archive_title_size":	".entry-title",
	};

	$.each($fontSizes, function (option, selector) {
		$.each($devices, function (device, mediaSize) {
		  wp.customize(option + '_' + device, function (value) {
			value.bind(function (to) {
			  $('head').find('#cosme-customizer-styles-' + option + '_' + device).remove();
			  var output = '@media ' + mediaSize + ' {' + selector + ' { font-size:' + to + 'px; } }';
			  $('head').append('<style id="cosme-customizer-styles-' + option + '_' + device + '">' + output + '</style>');
			});
		  });
		});
	});











}( jQuery ) );