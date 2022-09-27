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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'e-commerce' );

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
define( 'AUTH_KEY',         '/tqOsW@G6~}n$/iJEif87,&j7lD/Iro1>YVD~&1hm? w3*76(9Jl:Dlek@BC&?Qn' );
define( 'SECURE_AUTH_KEY',  'pE{Q-&ItTZ=m+.Pe~`^ X>$5%3z3cgADpx5<P+8.IsRgc.+qbc<J=)z).+&d.!T/' );
define( 'LOGGED_IN_KEY',    'H UAX.K[dQR=n(g$rf2U9Q^s1+@:HX6e-Et4$ |L+_<C(m1f@E8 @jEGQ/ZpK38#' );
define( 'NONCE_KEY',        '#i0xH+G1(B?3:qDy%Hp&*f/a.#D^]^,xfRe2;qaF%T9b$e_p4:!L/Hs1gyAW!n4l' );
define( 'AUTH_SALT',        '{q8NfYR#4!9osD?}>!.+++sqs8LnP@OjK(& w5k4!dPkf1Xq28WN%+1`|/w-:3U7' );
define( 'SECURE_AUTH_SALT', 'x5+Ll>r>0pxF^a!/>Kk, u? G>8J5_wH%IK6KF/Y]he#wV$4+a@yU&$@AY~ZMBu{' );
define( 'LOGGED_IN_SALT',   ',-H gxU){6`Vcsh?;[4j!@cyDm.@j&yh|_EE?9~/Lnib>>q86G1epb3)]gE!l)iO' );
define( 'NONCE_SALT',       'y{HvhhyfzHi01; {Ao=-Xqb{MAQ&B&S1}F1JKr!frl>6I;NbHH:M)ljYs|b XzRw' );

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
