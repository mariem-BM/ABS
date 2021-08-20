<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: backup
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'SPLC_FREE_Field_backup' ) ) {
  class SPLC_FREE_Field_backup extends SPLC_FREE_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $unique = $this->unique;
      $nonce  = wp_create_nonce( 'splogocarousel_backup_nonce' );
      $export = add_query_arg( array( 'action' => 'splogocarousel-export', 'unique' => $unique, 'nonce' => $nonce ), admin_url( 'admin-ajax.php' ) );

      echo $this->field_before();

      echo '<textarea name="splogocarousel_import_data" class="splogocarousel-import-data"></textarea>';
      echo '<button type="submit" class="button button-primary splogocarousel-confirm splogocarousel-import" data-unique="'. esc_attr( $unique ) .'" data-nonce="'. esc_attr( $nonce ) .'">'. esc_html__( 'Import', 'splogocarousel' ) .'</button>';
      echo '<hr />';
      echo '<textarea readonly="readonly" class="splogocarousel-export-data">'. esc_attr( json_encode( get_option( $unique ) ) ) .'</textarea>';
      echo '<a href="'. esc_url( $export ) .'" class="button button-primary splogocarousel-export" target="_blank">'. esc_html__( 'Export & Download', 'splogocarousel' ) .'</a>';
      echo '<hr />';
      echo '<button type="submit" name="splogocarousel_transient[reset]" value="reset" class="button splogocarousel-warning-primary splogocarousel-confirm splogocarousel-reset" data-unique="'. esc_attr( $unique ) .'" data-nonce="'. esc_attr( $nonce ) .'">'. esc_html__( 'Reset', 'splogocarousel' ) .'</button>';

      echo $this->field_after();

    }

  }
}
