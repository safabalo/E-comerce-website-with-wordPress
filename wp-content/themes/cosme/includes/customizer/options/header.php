<?php
/**
 * Header Customizer options
 *
 * @package Cosme
 */

$wp_customize->add_panel( 'cosme_header_panel',
	array(
		'title'         => esc_html__( 'Header', 'cosme'),
		'priority'      => 10,
	)
);

/**
 * Site identity
 */
$wp_customize->add_setting( 'cosme_logo_size_desktop', array(
	'default'   		=> 250,
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_setting( 'cosme_logo_size_tablet', array(
	'default'   		=> 175,
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'cosme_logo_size_mobile', array(
	'default'   		=> 125,
	'sanitize_callback' => 'absint',
) );			


$wp_customize->add_control( new Cosme_Control_Slider( $wp_customize, 'cosme_logo_size',
	array(
		'label' 		=> esc_html__( 'Logo width', 'cosme' ),
		'section' 		=> 'title_tagline',
		'responsive'	=> true,
		'settings' 		=> array (
			'size_desktop' 		=> 'cosme_logo_size_desktop',
			'size_tablet' 		=> 'cosme_logo_size_tablet',
			'size_mobile' 		=> 'cosme_logo_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 10,
			'max'	=> 500,
            'step'  => 1,
            'unit'  => 'px'
		)		
	)
) );