<?php

/**
 * Social Customizer options
 *
 * @package Cosme
 */
/*--------------------------------------------
	#Social 
---------------------------------------------*/
$wp_customize->add_panel(
    'cosme_social_panel',
    array(
        'title' => esc_html__('Social Profiles', 'cosme'),
        'description' => esc_html__('Social settings', 'cosme'),
        'priority' => 15,
    )
);

$wp_customize->add_section('cosme_social_section', array(
    'title'          => esc_html__('Social Links', 'cosme'),
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'panel'             => 'cosme_social_panel',
    'priority'       => 10,
));

$social_icons = array('facebook', 'twitter', 'linkedin', 'instagram', 'youtube');
foreach ($social_icons as $icon) {
    $label = ucfirst($icon);
    $wp_customize->add_setting('cosme_' . $icon . '_url', array(
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control('cosme_' . $icon . '_url', array(
        'label'         => esc_html($label),
        'type'          => 'url',
        'section'       => 'cosme_social_section',
    ));
}
