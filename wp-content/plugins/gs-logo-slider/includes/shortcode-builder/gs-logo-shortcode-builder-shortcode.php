<?php

/**
 * Protect direct access
 */
if ( ! defined( 'ABSPATH' ) ) die( GSL_HACK_MSG );

add_shortcode( 'gslogo', 'register_gslogo_shortcode_builder' );

function gslogo_get_temp_settings( $id, $is_preview = false ) {

    if ( $is_preview ) return get_transient( $id );

    $gslogo_sb = GS_Logo_Slider_Shortcode_Builder::get_instance();

    $shortcode = $gslogo_sb->_get_shortcode( $id, false );

    if ( $shortcode ) return $shortcode['shortcode_settings'];

    return [];
    
}

function gslogo_get_shortcode_params( $settings ) {

    $params = [];

    foreach( $settings as $key => $val ) {
        $params[] = $key.'="'.$val.'"';
    }

    return implode( ' ', $params );

}

function gslogo_change_key( $settings, $old_key, $new_key ) {

    if( ! array_key_exists( $old_key, $settings ) ) return $settings;

    $settings[$new_key] = $settings[$old_key];
    unset($settings[$old_key]);

    return $settings;

}

function register_gslogo_shortcode_builder( $atts ) {

    if ( empty($atts['id']) ) {
        return __( 'No shortcode ID found', 'gslogo' );
    }

    $is_preview = ! empty($atts['preview']);

    $settings = gslogo_get_temp_settings( $atts['id'], $is_preview );

    if ( empty($settings) ) $settings = [];

    $settings = gslogo_change_key( $settings, 'gs_l_title', 'title' );
    $settings = gslogo_change_key( $settings, 'gs_l_mode', 'mode' );
    $settings = gslogo_change_key( $settings, 'gs_l_slide_speed', 'speed' );
    $settings = gslogo_change_key( $settings, 'gs_l_inf_loop', 'inf_loop' );
    $settings = gslogo_change_key( $settings, 'gs_l_gray', 'logo_color' );
    $settings = gslogo_change_key( $settings, 'gs_l_theme', 'theme' );
    $settings = gslogo_change_key( $settings, 'gs_l_tooltip', 'tooltip' );

    $settings['id'] = $atts['id'];
    $settings['is_preview'] = $is_preview;

    $shortcode_params = gslogo_get_shortcode_params( $settings );

    ob_start();
    
    echo do_shortcode("[gs_logo $shortcode_params]");

    return ob_get_clean();

}