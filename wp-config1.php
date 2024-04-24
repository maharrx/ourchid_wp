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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ourchido_site' );

/** Database username */
define( 'DB_USER', 'ourchido_admin' );

/** Database password */
define( 'DB_PASSWORD', 'OUrCH!DS0V@' );

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
define( 'AUTH_KEY',         ';[qQQQh>$gnN9I4<;RsYsp7>}Z?rtG-GyYAN_&3)eNozXla]],y[z<RIA$5k%q6F' );
define( 'SECURE_AUTH_KEY',  '6Vb1tQ3^@^Fp1t{/G2S&c)eA^Q&`F(2qg([#Y^7W9L:`FqwH.$t*3.Dbnw9qs`v1' );
define( 'LOGGED_IN_KEY',    '.3?RFbZnUB3P]p1-jR>gsC,}GB)>174d@ 8[55c5l-4jsBwsSub)tOC9$8>`|:cW' );
define( 'NONCE_KEY',        '<(#FX*n^Ktu-3`P6ba$(&^m 8J0=6~16Z-_h3qL|h/pEhEwS3D@j~a?A_zc^gdq1' );
define( 'AUTH_SALT',        'P(i-(Q${iqt~b>804p|~FZ~KcWtmHn]|)+gT_j-54b2F5jf!PAAhQq>)0xy_&Nvi' );
define( 'SECURE_AUTH_SALT', 'UFT;Z)/Bt;YN%fW6oj~vv8Ls53e 93`g_Y,Lk>3I]6+TIzIB@;V^s:{z*{<PH(b7' );
define( 'LOGGED_IN_SALT',   '`}HwqFb]Xh:]JE(IP>O,gm;-0qca-j(AeYw]t4z4nr6BE?=Us?:JVY-$3BF|>K6v' );
define( 'NONCE_SALT',       'EpD&a[&OeMEgGxE4`oJD[dn8{Uv]{y]g[)O+0TGk$L@r8GyY?4y~|tL3CN[mPd_>' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'ourchid_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
