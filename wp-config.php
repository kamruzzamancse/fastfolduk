<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'fastfolduk' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
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
define( 'AUTH_KEY',         'B{MPUjoVARw;:`l)~{lcsUL_IE^RR{U-[S*&n)Xtt=_6*BT%CDR^yJxyDc07RBU<' );
define( 'SECURE_AUTH_KEY',  '!E5?->S#4W:]elHLYsV}cp6H|; sGrXLFWHe9:Eawx(gdxyy@ykGl*3cj-Lo[_6;' );
define( 'LOGGED_IN_KEY',    '{,pm<p3p$V#kn0xZxP{-,$[-$.+LXx.]v`C4S#|nj~jo6D._,[??jI&AeAJB@8gX' );
define( 'NONCE_KEY',        '53$0hR$XG9D}6Ch_.1:gkt6P@v=FrAUYt][V|qe25x4C<+HiyldR-uh+wg5Tv>g7' );
define( 'AUTH_SALT',        'Z#?)/(gO%q(0GV25 1#RFW_4mrA#Zk7$6%]D=E+23jSn=,VINCFcIA.m&DVWbz+s' );
define( 'SECURE_AUTH_SALT', 'w_0Hs-UXU0B^Sary5S{[x9N%G<@eLynx?f+8gW%<qT%Ju[bL2kRYG<N2KCb?2VC`' );
define( 'LOGGED_IN_SALT',   'd.[,+R<@cy?]Os+E891d~g3]yx|T/GuLf/}r|>#5o*_(gM%E_FeIu%rJ=VXb5OV8' );
define( 'NONCE_SALT',       ' t # Y*og`9I;& ~H!Fq1I_2/Brtb-_aRdQ~EM3*%U.(S[KA]1ssMayQ^~&Kv:8Q' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
//define( 'WP_DEBUG', false );
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
