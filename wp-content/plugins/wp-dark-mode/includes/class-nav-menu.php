<?php

defined( 'ABSPATH' ) || exit();


if ( ! class_exists( 'WP_Dark_Mode_Nav_Menu' ) ) {
	class WP_Dark_Mode_Nav_Menu {
		/** @var null */
		private static $instance = null;

		/**
		 * WP_Dark_Mode_Nav_Menu constructor.
		 */
		public function __construct() {
			add_action( 'admin_head-nav-menus.php', array( $this, 'add_nav_menu_meta_boxes' ) );
		}

		public function add_nav_menu_meta_boxes() {
			add_meta_box( 'wp_dark_mode_nav_link', __( 'Darkmode Switcher', 'wp-dark-mode' ), array( $this, 'nav_menu_links' ), 'nav-menus',
				'side', 'low' );
		}

		public function nav_menu_links() {
			global $_nav_menu_placeholder, $nav_menu_selected_id; ?>
            <div id="posttype-wp-dark-mode-switcher" class="posttypediv">
                <div id="tabs-panel-darkmode-switcher-endpoints" class="tabs-panel tabs-panel-active">
                    <ul id="darkmode-switcher-endpoints-checklist" class="categorychecklist form-no-clear">
                        <li>
                            <label class="menu-item-title">
                                <input type="checkbox" <?php echo wp_dark_mode_is_hello_elementora() ? ''
		                            : 'disabled'; ?> class="menu-item-checkbox" name="menu-item[<?php echo esc_attr( $_nav_menu_placeholder ); ?>][menu-item-object-id]" value="<?php echo esc_attr( $_nav_menu_placeholder ); ?>"/>
	                            <?php esc_html_e( 'Darkmode Switcher', 'wp-dark-mode' ); ?>

	                            <?php
	                            if ( ! wp_dark_mode_is_hello_elementora() ) {
		                            printf( '<br><a href="https://wppool.dev/wp-dark-mode" style="margin: 10px 0 0 50px" class="button-primary" target="_blank">Upgrade to PRO</a>' );
	                            }
	                            ?>
                            </label>
                            <input type="hidden" class="menu-item-type" name="menu-item[<?php echo esc_attr( $_nav_menu_placeholder ); ?>][menu-item-type]" value="custom"/>
                            <input type="hidden" class="menu-item-title" name="menu-item[<?php echo esc_attr( $_nav_menu_placeholder ); ?>][menu-item-title]" value="Darkmode Switcher"/> <!-- // No translate this! -->
                            <input type="hidden" class="menu-item-url" name="menu-item[<?php echo esc_attr( $_nav_menu_placeholder ); ?>][menu-item-url]" value="#darkmode_switcher"/>
                            <input type="hidden" class="menu-item-classes" name="menu-item[<?php echo esc_attr( $_nav_menu_placeholder ); ?>][menu-item-classes]"/>
                        </li>
                    </ul>
                </div>

                <p class="button-controls">

				<span class="add-to-menu">
					<button <?php echo wp_dark_mode_is_hello_elementora() ? ''
						: 'disabled'; ?> type="submit" class="button-secondary submit-add-to-menu right" value="<?php esc_attr_e( 'Add to menu',
						'wp-dark-mode' ); ?>" name="add-post-type-menu-item" id="submit-posttype-wp-dark-mode-switcher"><?php esc_attr_e( 'Add to Menu' ); ?></button>
					<span class="spinner"></span>
				</span>
                </p>
            </div>
			<?php
		}

		/**
		 * @return WP_Dark_Mode_Nav_Menu|null
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}
	}

}

WP_Dark_Mode_Nav_Menu::instance();