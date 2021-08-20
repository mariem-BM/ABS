<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'abshoreweb' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'v[.kNBpJ3;>(,YKC%I(KE9qho%X4V&:tYQdD2lIXhUsQz7;(e=xmR4`CLa`aZ<uH' );
define( 'SECURE_AUTH_KEY',  '55l>U?];+^xpnr[HIP=F)M:-{!n|st[~!tQvd^ ]yV{CuV7CoT~i;9%9!!@R]I!o' );
define( 'LOGGED_IN_KEY',    'D1oupK vT3}~_uC%z3/=K^vr5w([ss-4=**O%!N$TB<TN|DmbJA2nwdnof#HcQV&' );
define( 'NONCE_KEY',        'm4bx^>W?~H[SPQ6LN.Eo71=GTfdjPJdA7;z`6$V@-Sa.vx6E*h/FhB<s1KdSW:|,' );
define( 'AUTH_SALT',        'i4{NIeyq2-VKSkY}G,Y3&y<5qg1 &0~([pc.>v&-_c)HRTv&so{Z]+:l)!?B?BIV' );
define( 'SECURE_AUTH_SALT', 'Gs-LNo8QHE6AW*qH*G#}VnAV]vcADibni0;Ct.:&dbiO?w27C)cla(Oe<,!|o2+*' );
define( 'LOGGED_IN_SALT',   '0P$Z`dq=r-ZUN3JED98zyBVT$^;eJ:g7gnQRmJ#c2R{f@uJ^{VG~#5d9z8Q[I nj' );
define( 'NONCE_SALT',       'z-/jlEk[M0vD|[uVxw;-..Qr:j%~cZ(N%R>?a0`zN;>g}Nz,zQ1N&c)O|bDlT`)`' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
