<?php

/**
 * GS Logo Slider - Logo Image Layout
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-logo/partials/gs-logo-layout-image.php
 * 
 * @package GS_Logo_Slider/Templates
 * @version 1.0.0
 */

$gsl_post_id = get_the_ID();

$client_url = get_post_meta( $gsl_post_id, 'client_url', true );
$gs_l_link_rels = empty($gs_l_link_rels) ? 'noopener' : $gs_l_link_rels;

$gs_logo_id = get_post_thumbnail_id( $gsl_post_id );
$gs_logo_url = wp_get_attachment_url( $gs_logo_id );
$filetype = wp_check_filetype( $gs_logo_url );

$_image_size = ($filetype['ext'] == 'gif') ? 'full' : $image_size;

$tooltip_class = $tooltip == 'on' ? 'gs_logo--tooltip' : '';
$logo_img_classes = [$logo_color, $tooltip_class, 'gs-logo--img'];

if ( !empty($gs_logo_url) ) {

    // Image Tag
    $html = get_the_post_thumbnail( $gsl_post_id, $_image_size, array(
        'title' => get_the_title(),
        'class' => trim( implode(' ', $logo_img_classes) )
    ));

    // Anchor tag including Image tag
    if ( !empty($client_url) ) {
        $html = sprintf( '<a href="%s" target="%s" rel="%s">%s</a>', $client_url, $gs_l_clkable, $gs_l_link_rels, $html );
    }

    echo $html;

}