<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: subheading
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'SPLC_FREE_Field_subheading' ) ) {
  class SPLC_FREE_Field_subheading extends SPLC_FREE_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      echo ( ! empty( $this->field['content'] ) ) ? $this->field['content'] : '';

    }

  }
}
