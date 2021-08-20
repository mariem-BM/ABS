<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: Custom_import
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'SPLC_FREE_Field_custom_import' ) ) {
	class SPLC_FREE_Field_custom_import extends SPLC_FREE_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}
		public function render() {
			echo $this->field_before();
			$lcp_logolink      = admin_url( 'edit.php?post_type=sp_logo_carousel' );
			$lcp_shortcodelink = admin_url( 'edit.php?post_type=sp_lc_shortcodes' );
				echo '<p><input type="file" id="import" accept=".json"></p>';
				echo '<p><button type="button" class="import">Import</button></p>';
				echo '<a id="lcp_shortcode_link_redirect" href="' . $lcp_shortcodelink . '"></a>';
				echo '<a id="lcp_logo_link_redirect" href="' . $lcp_logolink . '"></a>';
			echo $this->field_after();
		}
	}
}
