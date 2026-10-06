<?php
/**
 * Header ve footer renkleri için açılır kutulu (select) Özelleştirici ayarları.
 * Seçenekler, beyaz/siyah metinle en az 4.5:1 kontrast sağlayan renklerdir.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Arka plan => [ etiket, uygun metin rengi ] */
function erisilebilir_color_choices() {
	return array(
		'#0d3b66' => array( __( 'Lacivert', 'erisilebilir' ), '#ffffff' ),
		'#212529' => array( __( 'Koyu Gri', 'erisilebilir' ), '#ffffff' ),
		'#000000' => array( __( 'Siyah', 'erisilebilir' ), '#ffffff' ),
		'#145a32' => array( __( 'Koyu Yeşil', 'erisilebilir' ), '#ffffff' ),
		'#7b1fa2' => array( __( 'Mor', 'erisilebilir' ), '#ffffff' ),
		'#a52a2a' => array( __( 'Bordo', 'erisilebilir' ), '#ffffff' ),
		'#ffffff' => array( __( 'Beyaz', 'erisilebilir' ), '#000000' ),
		'#f8f9fa' => array( __( 'Açık Gri', 'erisilebilir' ), '#000000' ),
		'#ffd54f' => array( __( 'Sarı', 'erisilebilir' ), '#000000' ),
	);
}

function erisilebilir_sanitize_color( $value, $setting ) {
	$choices = erisilebilir_color_choices();
	return isset( $choices[ $value ] ) ? $value : $setting->default;
}

function erisilebilir_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'erisilebilir_colors', array(
		'title'    => __( 'Tema Renkleri', 'erisilebilir' ),
		'priority' => 30,
	) );
	$choices = array();
	foreach ( erisilebilir_color_choices() as $hex => $data ) {
		$choices[ $hex ] = $data[0];
	}
	$defaults = array( 'header_bg' => '#0d3b66', 'footer_bg' => '#212529' );
	$labels   = array(
		'header_bg' => __( 'Header rengi', 'erisilebilir' ),
		'footer_bg' => __( 'Footer rengi', 'erisilebilir' ),
	);
	foreach ( $defaults as $key => $default ) {
		$wp_customize->add_setting( 'erisilebilir_' . $key, array(
			'default'           => $default,
			'sanitize_callback' => 'erisilebilir_sanitize_color',
			'transport'         => 'refresh',
		) );
		$wp_customize->add_control( 'erisilebilir_' . $key, array(
			'label'   => $labels[ $key ],
			'section' => 'erisilebilir_colors',
			'type'    => 'select',
			'choices' => $choices,
		) );
	}
}
add_action( 'customize_register', 'erisilebilir_customize_register' );

function erisilebilir_color_css() {
	$all    = erisilebilir_color_choices();
	$header = get_theme_mod( 'erisilebilir_header_bg', '#0d3b66' );
	$footer = get_theme_mod( 'erisilebilir_footer_bg', '#212529' );
	$header = isset( $all[ $header ] ) ? $header : '#0d3b66';
	$footer = isset( $all[ $footer ] ) ? $footer : '#212529';
	return sprintf(
		':root{--e-header-bg:%s;--e-header-text:%s;--e-footer-bg:%s;--e-footer-text:%s}',
		$header,
		$all[ $header ][1],
		$footer,
		$all[ $footer ][1]
	);
}
