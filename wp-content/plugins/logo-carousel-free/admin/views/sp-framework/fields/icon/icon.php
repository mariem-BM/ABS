<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: icon
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'SPLC_FREE_Field_icon' ) ) {
  class SPLC_FREE_Field_icon extends SPLC_FREE_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args = wp_parse_args( $this->field, array(
        'button_title' => esc_html__( 'Add Icon', 'splogocarousel' ),
        'remove_title' => esc_html__( 'Remove Icon', 'splogocarousel' ),
      ) );

      echo $this->field_before();

      $nonce  = wp_create_nonce( 'splogocarousel_icon_nonce' );
      $hidden = ( empty( $this->value ) ) ? ' hidden' : '';

      echo '<div class="splogocarousel-icon-select">';
      echo '<span class="splogocarousel-icon-preview'. esc_attr( $hidden ) .'"><i class="'. esc_attr( $this->value ) .'"></i></span>';
      echo '<a href="#" class="button button-primary splogocarousel-icon-add" data-nonce="'. esc_attr( $nonce ) .'">'. $args['button_title'] .'</a>';
      echo '<a href="#" class="button splogocarousel-warning-primary splogocarousel-icon-remove'. esc_attr( $hidden ) .'">'. $args['remove_title'] .'</a>';
      echo '<input type="text" name="'. esc_attr( $this->field_name() ) .'" value="'. esc_attr( $this->value ) .'" class="splogocarousel-icon-value"'. $this->field_attributes() .' />';
      echo '</div>';

      echo $this->field_after();

    }

    public function enqueue() {
      add_action( 'admin_footer', array( &$this, 'add_footer_modal_icon' ) );
      add_action( 'customize_controls_print_footer_scripts', array( &$this, 'add_footer_modal_icon' ) );
    }

    public function add_footer_modal_icon() {
    ?>
      <div id="splogocarousel-modal-icon" class="splogocarousel-modal splogocarousel-modal-icon hidden">
        <div class="splogocarousel-modal-table">
          <div class="splogocarousel-modal-table-cell">
            <div class="splogocarousel-modal-overlay"></div>
            <div class="splogocarousel-modal-inner">
              <div class="splogocarousel-modal-title">
                <?php esc_html_e( 'Add Icon', 'splogocarousel' ); ?>
                <div class="splogocarousel-modal-close splogocarousel-icon-close"></div>
              </div>
              <div class="splogocarousel-modal-header">
                <input type="text" placeholder="<?php esc_html_e( 'Search...', 'splogocarousel' ); ?>" class="splogocarousel-icon-search" />
              </div>
              <div class="splogocarousel-modal-content">
                <div class="splogocarousel-modal-loading"><div class="splogocarousel-loading"></div></div>
                <div class="splogocarousel-modal-load"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
    }

  }
}
