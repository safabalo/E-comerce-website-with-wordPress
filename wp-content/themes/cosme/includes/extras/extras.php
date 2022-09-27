<?php
/**
 * Enqueue admin scripts and styles.
 *
 * @author      CodeGearThemes
 * @category    WordPress
 * @package     Cosme
 * @version     1.0.0
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function cosme_public_scripts(){

	$defaults_body = json_encode(
		array(
			'font' 			=> 'Poppins',
			'regularweight' => 'regular',
			'category' 		=> 'sans-serif'
		)
	);
	
	$defaults_heading = json_encode(
		array(
			'font' 			=> 'Libre Baskerville',
			'regularweight' => 'regular',
			'category' 		=> 'serif'
		)
	);	


    $cosme_site_width 				= '1440px'; 

	$cosme_primary_color			= get_theme_mod( 'cosme_website_primary_color', '#000000' );
	$cosme_secondary_color			= get_theme_mod( 'cosme_website_secondary_color', '#4E7661' );


	$font_body 						= json_decode( get_theme_mod( 'cosme_base_font', $defaults_body ), true );
	if ( 'Poppins' === $font_body['font'] ) {
		$cosme_base_fonts			= ' Poppins , sans-serif';
	}else{
		$cosme_base_fonts			= $font_body['font'];
	}

	$cosme_desktop_logo_size = get_theme_mod( 'cosme_logo_size_desktop' , '250'). 'px';
	$cosme_tablet_logo_size = get_theme_mod( 'cosme_logo_size_desktop' , '175'). 'px';
	$cosme_mobile_logo_size = get_theme_mod( 'cosme_logo_size_desktop' , '125'). 'px';


	$cosme_base_font_size			= get_theme_mod('cosme_base_font_size_desktop', '16' ).'px';
	$cosme_base_tablet_font_size	= get_theme_mod('cosme_base_font_size_tablet', '14' ).'px';
	$cosme_base_mobile_font_size	= get_theme_mod('cosme_base_font_size_mobile', '14' ).'px';

	$cosme_base_font_weight		= $font_body['regularweight'];
	if( $cosme_base_font_weight == 'regular' ){
		$cosme_base_font_weight = 'normal';
	}

	$cosme_base_font_style		= get_theme_mod('cosme_base_font_style', 'normal');
	$cosme_base_line_height 		= get_theme_mod( 'cosme_base_line_height', '1.4' );
	$cosme_base_letter_spacing 	= get_theme_mod( 'cosme_base_letter_spacing', '0' ).'px';
	$cosme_base_text_transform 	= get_theme_mod( 'scosme_base_text_transform', 'none' );


	$font_heading = json_decode( get_theme_mod( 'cosme_heading_font', $defaults_heading ), true  ); 
	if ( 'Libre Baskerville' === $font_heading['font'] ) {
		$cosme_heading_fonts			= 'Libre Baskerville, serif';
	}else{
		$cosme_heading_fonts			= $font_heading['font'];
	}

	$cosme_heading_font_weight		= $font_heading['regularweight'];
	if( $cosme_heading_font_weight == 'regular' ){
		$cosme_heading_font_weight = 'normal';
	}

	$cosme_heading_font_style		= get_theme_mod( 'cosme_heading_font_style', 'normal');
	$cosme_heading_line_height 		= get_theme_mod( 'cosme_heading_line_height', '1.4' );
	$cosme_heading_letter_spacing 	= get_theme_mod( 'cosme_heading_letter_spacing', '0' ).'px';
	$cosme_heading_text_transform 	= get_theme_mod( 'cosme_heading_text_transform', 'none' );

	$cosme_heading_fontsizeh1 			= get_theme_mod( 'cosme_heading_h1_font_size_desktop' , '40' ).'px';
	$cosme_heading_fontsizeh2			= get_theme_mod( 'cosme_heading_h2_font_size_desktop' , '32' ).'px';
	$cosme_heading_fontsizeh3			= get_theme_mod( 'cosme_heading_h3_font_size_desktop' , '28' ).'px';
	$cosme_heading_fontsizeh4			= get_theme_mod( 'cosme_heading_h4_font_size_desktop' , '24' ).'px';
	$cosme_heading_fontsizeh5			= get_theme_mod( 'cosme_heading_h5_font_size_desktop' , '20' ).'px';
	$cosme_heading_fontsizeh6			= get_theme_mod( 'cosme_heading_h6_font_size_desktop' , '16' ).'px';

	$cosme_heading_tablet_fontsizeh1 		= get_theme_mod( 'cosme_heading_h1_font_size_tablet' , '36' ).'px';
	$cosme_heading_tablet_fontsizeh2		= get_theme_mod( 'cosme_heading_h2_font_size_tablet' , '28' ).'px';
	$cosme_heading_tablet_fontsizeh3		= get_theme_mod( 'cosme_heading_h3_font_size_tablet' , '24' ).'px';
	$cosme_heading_tablet_fontsizeh4		= get_theme_mod( 'cosme_heading_h4_font_size_tablet' , '20' ).'px';
	$cosme_heading_tablet_fontsizeh5		= get_theme_mod( 'cosme_heading_h5_font_size_tablet' , '16' ).'px';
	$cosme_heading_tablet_fontsizeh6		= get_theme_mod( 'cosme_heading_h6_font_size_tablet' , '16' ).'px';
	

	$cosme_heading_mobile_fontsizeh1 		= get_theme_mod( 'cosme_heading_h1_font_size_mobile' , '28' ).'px';
	$cosme_heading_mobile_fontsizeh2		= get_theme_mod( 'cosme_heading_h2_font_size_mobile' , '22' ).'px';
	$cosme_heading_mobile_fontsizeh3		= get_theme_mod( 'cosme_heading_h3_font_size_mobile' , '18' ).'px';
	$cosme_heading_mobile_fontsizeh4		= get_theme_mod( 'cosme_heading_h4_font_size_mobile' , '16' ).'px';
	$cosme_heading_mobile_fontsizeh5		= get_theme_mod( 'cosme_heading_h5_font_size_mobile' , '16' ).'px';
	$cosme_heading_mobile_fontsizeh6		= get_theme_mod( 'cosme_heading_h6_font_size_mobile' , '16' ).'px';
	

	$cosme_footer_text_color				=  get_theme_mod( 'cosme_footer_section_text_color', '#333333' );
	$cosme_footer_heading_color				=  get_theme_mod( 'cosme_footer_section_heading_color', '#222222' );
	$cosme_footer_background				=  get_theme_mod( 'cosme_footer_section_background', '#f8f8f8' );

	$cosme_footer_credit_color 				= get_theme_mod( 'cosme_footer_credits_color', '#333333' );
	$cosme_footer_credit_background 		= get_theme_mod( 'cosme_footer_credits_background', '#f8f8f8' );
	$cosme_footer_credit_link_color 		= get_theme_mod( 'cosme_footer_credits_link_color', '#7e7e7e' );
	$cosme_footer_credit_link_hover_color 	= get_theme_mod( 'cosme_footer_credits_link_hover_color', '#222222' );


    $cosme_custom_styles = "
		:root{
			--theme--site-width: $cosme_site_width;

			--theme--primary-color: $cosme_primary_color;
			--theme--secondary-color: $cosme_secondary_color;

			--theme--website-base-font-size: $cosme_base_font_size;
			--theme--website-base-tablet-font-size: $cosme_base_tablet_font_size;
			--theme--website-base-mobile-font-size: $cosme_base_mobile_font_size;
			--theme--website-base-font-family: $cosme_base_fonts;
			--theme--website-base-font-weight: $cosme_base_font_weight;
			--theme--website-base-font-style: $cosme_base_font_style;
			--theme--website-base-line-height: $cosme_base_line_height;
			--theme--website-base-letter-spacing: $cosme_base_letter_spacing;
			--theme--website-base-text-transform: $cosme_base_text_transform;

			--theme--desktop-logo-size:	$cosme_desktop_logo_size;
			--theme--tablet-logo-size:  $cosme_tablet_logo_size;
			--theme--mobile-logo-size:	$cosme_mobile_logo_size;

			--theme--heading-size1: $cosme_heading_fontsizeh1;
			--theme--heading-size2: $cosme_heading_fontsizeh2;
			--theme--heading-size3: $cosme_heading_fontsizeh3;
			--theme--heading-size4: $cosme_heading_fontsizeh4;
			--theme--heading-size5: $cosme_heading_fontsizeh5;
			--theme--heading-size6: $cosme_heading_fontsizeh6;	

			--theme--heading-tablet-size1: $cosme_heading_tablet_fontsizeh1;
			--theme--heading-tablet-size2: $cosme_heading_tablet_fontsizeh2;
			--theme--heading-tablet-size3: $cosme_heading_tablet_fontsizeh3;
			--theme--heading-tablet-size4: $cosme_heading_tablet_fontsizeh4;
			--theme--heading-tablet-size5: $cosme_heading_tablet_fontsizeh5;
			--theme--heading-tablet-size6: $cosme_heading_tablet_fontsizeh6;

			--theme--heading-mobile-size1: $cosme_heading_mobile_fontsizeh1;
			--theme--heading-mobile-size2: $cosme_heading_mobile_fontsizeh2;
			--theme--heading-mobile-size3: $cosme_heading_mobile_fontsizeh3;
			--theme--heading-mobile-size4: $cosme_heading_mobile_fontsizeh4;
			--theme--heading-mobile-size5: $cosme_heading_mobile_fontsizeh5;
			--theme--heading-mobile-size6: $cosme_heading_mobile_fontsizeh6;

			--theme--website-heading-font-weight: $cosme_heading_font_weight;
			--theme--website-heading-font-style: $cosme_heading_font_style;
			--theme--website-heading-font-family: $cosme_heading_fonts;
			--theme--website-heading-line-height: $cosme_heading_line_height;
			--theme--website-heading-letter-spacing: $cosme_heading_letter_spacing;
			--theme--website-heading-text-transform: $cosme_heading_text_transform;

			--theme--footer-color: $cosme_footer_text_color;
			--theme--footer-heading-color: $cosme_footer_heading_color;
			--theme--footer-background: $cosme_footer_background;

			--theme--credit-color: $cosme_footer_credit_color;
			--theme--credit-link-color: $cosme_footer_credit_link_color;
			--theme--credit-link-hover-color: $cosme_footer_credit_link_hover_color;;
			--theme--credit-background: $cosme_footer_credit_background;
		}"; 

	
	wp_enqueue_style( 'cosme-google-fonts', cosme_google_fonts_url(), array(), COSME_THEME_VERSION );
    wp_enqueue_style( 'cosme-theme-style', COSME_THEME_URI . '/assets/public/css/theme.css', array(), COSME_THEME_VERSION );
	wp_enqueue_style( 'cosme-media-style', COSME_THEME_URI . '/assets/public/css/media.css', array(), COSME_THEME_VERSION );
    wp_add_inline_style( 'cosme-theme-style', $cosme_custom_styles );


	wp_enqueue_script( 'navigation', COSME_THEME_URI . '/assets/lib/navigation/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'skip-link-focus-fix', COSME_THEME_URI . '/assets/lib/automattic/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'cosme-theme-scripts', COSME_THEME_URI.'assets/public/js/theme.js', array(), COSME_THEME_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cosme_public_scripts' );