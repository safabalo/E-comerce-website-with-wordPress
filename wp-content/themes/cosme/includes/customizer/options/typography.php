<?php
/**
 * Typography Customizer options
 *
 * @package Cosme 
 */
$wp_customize->add_panel(
	'cosme_typography_panel',
	array(
		'title'         => esc_html__( 'Typography', 'cosme'),
		'priority'      => 10,
	)
); 

/*--------------------------------------------
	Heading
---------------------------------------------*/
$wp_customize->add_section(
	'cosme_heading_section',
	array(
		'title'      => esc_html__( 'Headings', 'cosme'),
		'panel'      => 'cosme_typography_panel',
	)
);

$wp_customize->add_setting( 'cosme_heading_font',
    array(
        'default'           => '{"font":"Libre Baskerville","regularweight":"regular","italicweight":"italic","boldweight":"bold","category":"serif"}',
        'sanitize_callback' => 'cosme_google_fonts_sanitize',
        'transport'	 		=> 'postMessage'
    )
);

$wp_customize->add_control( new Cosme_Control_Typography( $wp_customize, 'cosme_heading_font',
    array(
        'label' => esc_html__( 'Heading font', 'cosme' ),
        'section' => 'cosme_heading_section',
        'settings' => array (
			'family' => 'cosme_heading_font',
		),
        'input_attrs' => array(
			'font_count'    => 'all',
			'orderby'       => 'alpha',
			'disableRegular' => false,
		),
    )
));

$wp_customize->add_setting( 'cosme_heading_font_style', array(
	'sanitize_callback' => 'cosme_sanitize_select',
	'default' 			=> 'normal',
	'transport'	 		=> 'postMessage'
) );

$wp_customize->add_control( 'cosme_heading_font_style', array(
	'type' 		=> 'select',
	'section' 	=> 'cosme_heading_section',
	'label' 	=> esc_html__( 'Font style', 'cosme' ),
	'choices' => array(
		'normal' 	=> esc_html__( 'Normal', 'cosme' ),
		'italic' 	=> esc_html__( 'Italic', 'cosme' ),
		'oblique' 	=> esc_html__( 'Oblique', 'cosme' ),
	),
) );

$wp_customize->add_setting( 'cosme_heading_line_height', array(
	'default'   		=> 1.4,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'cosme_range',
) );			

$wp_customize->add_control( new Cosme_Control_Slider( $wp_customize, 'cosme_heading_line_height',
	array(
		'label' 		=> esc_html__( 'Line height', 'cosme' ),
		'section' 		=> 'cosme_heading_section',
		'responsive'	=> false,
		'settings' 		=> array (
			'size_desktop' 		=> 'cosme_heading_line_height',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 5,
			'step'  => 0.01,
			'unit'  => 'em'
		)
	)
) ); 

$wp_customize->add_setting( 'cosme_heading_letter_spacing', array(
	'default'   		=> 0,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'cosme_range',
) );			

$wp_customize->add_control( new Cosme_Control_Slider( $wp_customize, 'cosme_heading_letter_spacing',
	array(
		'label' 		=> esc_html__( 'Letter spacing', 'cosme' ),
		'section' 		=> 'cosme_heading_section',
		'responsive'	=> false,
		'settings' 		=> array (
			'size_desktop' 		=> 'cosme_heading_letter_spacing',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 5,
			'step'  => 0.1,
			'unit'  => 'px'
		)
	)
) );


$wp_customize->add_setting( 'cosme_heading_text_transform',
	array(
		'default' 			=> 'none',
		'sanitize_callback' => 'cosme_sanitize_text',
		'transport'			=> 'postMessage',
	)
);
$wp_customize->add_control( new Cosme_Control_RadioButtons( $wp_customize, 'cosme_heading_text_transform',
	array(
		'label'   => esc_html__( 'Text transform', 'cosme' ),
		'section' => 'cosme_heading_section',
		'choices' => array(
			'none' 			=> '-',
			'capitalize' 	=> 'Aa',
			'lowercase' 	=> 'aa',
			'uppercase' 	=> 'AA',
		)
	)
) );

$wp_customize->add_setting( 'cosme_heading_typography_divider',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Cosme_Control_Divider( $wp_customize, 'cosme_heading_typography_divider',
		array(
			'section' 		=> 'cosme_heading_section',
		)
	)
);


$wp_customize->add_setting( 'cosme_heading_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Cosme_Control_Heading( $wp_customize, 'cosme_heading_title',
		array(
			'label'			=> esc_html__( 'Heading', 'cosme' ),
			'description'	=> esc_html__( '(H1 - h6) heading font size.', 'cosme' ),
			'section' 		=> 'cosme_heading_section',
		)
	)
);

$wp_customize->add_setting( 'cosme_heading_h1_font_size_desktop', array(
	'default'   		=> 40,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'cosme_heading_h1_font_size_tablet', array(
	'default'   		=> 36,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'cosme_heading_h1_font_size_mobile', array(
	'default'   		=> 28,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Cosme_Control_Slider( $wp_customize, 'cosme_heading_h1_font_size',
	array(
		'label' 		=> esc_html__( 'H1 font size', 'cosme' ),
		'section' 		=> 'cosme_heading_section',
		'responsive'	=> true,
		'settings' 		=> array (
			'size_desktop' 		=> 'cosme_heading_h1_font_size_desktop',
			'size_tablet' 		=> 'cosme_heading_h1_font_size_tablet',
			'size_mobile' 		=> 'cosme_heading_h1_font_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 10,
			'max'	=> 72,
			'step'  => 1,
			'unit'  => 'px'
		)
	)
) );

$wp_customize->add_setting( 'cosme_heading_h2_font_size_desktop', array(
	'default'   		=> 32,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'cosme_heading_h2_font_size_tablet', array(
	'default'   		=> 28,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'cosme_heading_h2_font_size_mobile', array(
	'default'   		=> 22,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Cosme_Control_Slider( $wp_customize, 'cosme_heading_h2_font_size',
	array(
		'label' 		=> esc_html__( 'H2 font size', 'cosme' ),
		'section' 		=> 'cosme_heading_section',
		'responsive'	=> true,
		'settings' 		=> array (
			'size_desktop' 		=> 'cosme_heading_h2_font_size_desktop',
			'size_tablet' 		=> 'cosme_heading_h2_font_size_tablet',
			'size_mobile' 		=> 'cosme_heading_h2_font_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 10,
			'max'	=> 72,
			'step'  => 1,
			'unit'  => 'px'
		)
	)
) );

$wp_customize->add_setting( 'cosme_heading_h3_font_size_desktop', array(
	'default'   		=> 28,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'cosme_heading_h3_font_size_tablet', array(
	'default'   		=> 24,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'cosme_heading_h3_font_size_mobile', array(
	'default'   		=> 18,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Cosme_Control_Slider( $wp_customize, 'cosme_heading_h3_font_size',
	array(
		'label' 		=> esc_html__( 'H3 font size', 'cosme' ),
		'section' 		=> 'cosme_heading_section',
		'responsive'	=> true,
		'settings' 		=> array (
			'size_desktop' 		=> 'cosme_heading_h3_font_size_desktop',
			'size_tablet' 		=> 'cosme_heading_h3_font_size_tablet',
			'size_mobile' 		=> 'cosme_heading_h3_font_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 10,
			'max'	=> 72,
			'step'  => 1,
			'unit'  => 'px'
		)
	)
) );

$wp_customize->add_setting( 'cosme_heading_h4_font_size_desktop', array(
	'default'   		=> 24,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'cosme_heading_h4_font_size_tablet', array(
	'default'   		=> 20,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'cosme_heading_h4_font_size_mobile', array(
	'default'   		=> 16,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Cosme_Control_Slider( $wp_customize, 'cosme_heading_h4_font_size',
	array(
		'label' 		=> esc_html__( 'H4 font size', 'cosme' ),
		'section' 		=> 'cosme_heading_section',
		'responsive'	=> true,
		'settings' 		=> array (
			'size_desktop' 		=> 'cosme_heading_h4_font_size_desktop',
			'size_tablet' 		=> 'cosme_heading_h4_font_size_tablet',
			'size_mobile' 		=> 'cosme_heading_h4_font_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 10,
			'max'	=> 72,
			'step'  => 1,
			'unit'  => 'px'
		)
	)
) );

$wp_customize->add_setting( 'cosme_heading_h5_font_size_desktop', array(
	'default'   		=> 20,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'cosme_heading_h5_font_size_tablet', array(
	'default'   		=> 16,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'cosme_heading_h5_font_size_mobile', array(
	'default'   		=> 16,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Cosme_Control_Slider( $wp_customize, 'cosme_heading_h5_font_size',
	array(
		'label' 		=> esc_html__( 'H5 font size', 'cosme' ),
		'section' 		=> 'cosme_heading_section',
		'responsive'	=> true,
		'settings' 		=> array (
			'size_desktop' 		=> 'cosme_heading_h5_font_size_desktop',
			'size_tablet' 		=> 'cosme_heading_h5_font_size_tablet',
			'size_mobile' 		=> 'cosme_heading_h5_font_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 10,
			'max'	=> 72,
			'step'  => 1,
			'unit'  => 'px'
		)
	)
) );

$wp_customize->add_setting( 'cosme_heading_h6_font_size_desktop', array(
	'default'   		=> 16,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'cosme_heading_h6_font_size_tablet', array(
	'default'   		=> 16,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'cosme_heading_h6_font_size_mobile', array(
	'default'   		=> 16,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Cosme_Control_Slider( $wp_customize, 'cosme_heading_h6_font_size',
	array(
		'label' 		=> esc_html__( 'H6 font size', 'cosme' ),
		'section' 		=> 'cosme_heading_section',
		'responsive'	=> true,
		'settings' 		=> array (
			'size_desktop' 		=> 'cosme_heading_h6_font_size_desktop',
			'size_tablet' 		=> 'cosme_heading_h6_font_size_tablet',
			'size_mobile' 		=> 'cosme_heading_h6_font_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 10,
			'max'	=> 72,
			'step'  => 1,
			'unit'  => 'px'
		)
	)
) );


/*--------------------------------------------
	Base
---------------------------------------------*/
$wp_customize->add_section(
	'cosme_base_section',
	array(
		'title'         => esc_html__( 'Body', 'cosme'),
		'panel'         => 'cosme_typography_panel',
	)
);

$wp_customize->add_setting( 'cosme_base_font',
    array(
        'default'           => '{"font":"Poppins","regularweight":"regular","italicweight":"italic","boldweight":"bold","category":"sans-serif"}',
        'sanitize_callback' => 'cosme_google_fonts_sanitize',
        'transport'	 		=> 'postMessage'
    )
);

$wp_customize->add_control( new Cosme_Control_Typography( $wp_customize, 'cosme_base_font',
    array(
        'label' => esc_html__( 'Body font', 'cosme' ),
        'section' => 'cosme_base_section',
        'settings' => array (
			'family' => 'cosme_base_font',
		),
        'input_attrs' => array(
			'font_count'    => 'all',
			'orderby'       => 'alpha',
			'disableRegular' => false,
		),
    )
));

$wp_customize->add_setting( 'cosme_base_font_style', array(
	'sanitize_callback' => 'cosme_sanitize_select',
	'default' 			=> 'normal',
	'transport'	 		=> 'postMessage'
) );

$wp_customize->add_control( 'cosme_base_font_style', array(
	'type' 		=> 'select',
	'section' 	=> 'cosme_base_section',
	'label' 	=> esc_html__( 'Font style', 'cosme' ),
	'choices' => array(
		'normal' 	=> esc_html__( 'Normal', 'cosme' ),
		'italic' 	=> esc_html__( 'Italic', 'cosme' ),
		'oblique' 	=> esc_html__( 'Oblique', 'cosme' ),
	),
) );

$wp_customize->add_setting( 'cosme_base_line_height', array(
	'default'   		=> 1.68,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'cosme_sanitize_text',
) );			

$wp_customize->add_control( new Cosme_Control_Slider( $wp_customize, 'cosme_base_line_height',
	array(
		'label' 		=> esc_html__( 'Line height', 'cosme' ),
		'section' 		=> 'cosme_base_section',
		'responsive'	=> false,
		'settings' 		=> array (
			'size_desktop' 		=> 'cosme_base_line_height',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 5,
			'step'  => 0.01,
			'unit'  => 'em'
		)
	)
) ); 

$wp_customize->add_setting( 'cosme_base_letter_spacing', array(
	'default'   		=> 0,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'cosme_sanitize_text',
) );			

$wp_customize->add_control( new Cosme_Control_Slider( $wp_customize, 'cosme_base_letter_spacing',
	array(
		'label' 		=> esc_html__( 'Letter spacing', 'cosme' ),
		'section' 		=> 'cosme_base_section',
		'responsive'	=> false,
		'settings' 		=> array (
			'size_desktop' 		=> 'cosme_base_letter_spacing',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 5,
			'step'  => 0.1,
			'unit'  => 'px'
		)
	)
) );


$wp_customize->add_setting( 'cosme_base_text_transform',
	array(
		'default' 			=> 'none',
		'sanitize_callback' => 'cosme_sanitize_text',
		'transport'			=> 'postMessage',
	)
);
$wp_customize->add_control( new Cosme_Control_RadioButtons( $wp_customize, 'cosme_base_text_transform',
	array(
		'label'   => esc_html__( 'Text transform', 'cosme' ),
		'section' => 'cosme_base_section',
		'choices' => array(
			'none' 			=> '-',
			'capitalize' 	=> 'Aa',
			'lowercase' 	=> 'aa',
			'uppercase' 	=> 'AA',
		)
	)
) );

$wp_customize->add_setting( 'cosme_base_typography_divider',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Cosme_Control_Divider( $wp_customize, 'cosme_base_typography_divider',
		array(
			'section' 		=> 'cosme_base_section',
		)
	)
);


$wp_customize->add_setting( 'cosme_base_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Cosme_Control_Heading( $wp_customize, 'cosme_base_title',
		array(
			'label'			=> esc_html__( 'Body', 'cosme' ),
			'section' 		=> 'cosme_base_section',
		)
	)
);

$wp_customize->add_setting( 'cosme_base_font_size_desktop', array(
	'default'   		=> 16,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'cosme_base_font_size_tablet', array(
	'default'   		=> 14,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'cosme_base_font_size_mobile', array(
	'default'   		=> 14,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Cosme_Control_Slider( $wp_customize, 'cosme_base_font_size',
	array(
		'label' 		=> esc_html__( 'Font size', 'cosme' ),
		'section' 		=> 'cosme_base_section',
		'responsive'	=> true,
		'settings' 		=> array (
			'size_desktop' 		=> 'cosme_base_font_size_desktop',
			'size_tablet' 		=> 'cosme_base_font_size_tablet',
			'size_mobile' 		=> 'cosme_base_font_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 10,
			'max'	=> 72,
			'step'  => 1,
			'unit'  => 'px'
		)
	)
) );