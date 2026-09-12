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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'DPJN~j`=xVAN-3&OHUl+yl[Ur>u,km9/6g{- GF9bxB`j1)1gfcUv)!fk4!g1 pF' );
define( 'SECURE_AUTH_KEY',   'o6PE=~l9uc>zE!.mIN*+UugRqz,{$saVg/0I#N(zOV{#6Lw[#4Nh)?yT4=z>Lrd[' );
define( 'LOGGED_IN_KEY',     'o|?R@WE~8}WK59B[mJMK#,(ZP]HiFdjiJU@PN+(}I&9/P=$apCQewK6m2WOH8&xJ' );
define( 'NONCE_KEY',         'gVk83fPL++d7dVl*JDF$&J3Z$.^tv j+ ddR)VOh0!OEyVBSSLA4S(@=&2A$_$m(' );
define( 'AUTH_SALT',         'oa:WG*QTq@u8-f;;j vGV3 .78TY20Ppon1f+%mLN?m.q}66>nHzMkrHtYD`5R);' );
define( 'SECURE_AUTH_SALT',  'H5ut) #f.77~$#Ej;O~I[`_:*Ee&v{q,**-y|PIpsZ56(_^HB+;d7K^_EXl48n^&' );
define( 'LOGGED_IN_SALT',    'c4WB^mcugJBhV6MR0KcajU3A^BkBwVrnMIJr/O4V2GF&ixwn4k.Oypt5{ga/ONej' );
define( 'NONCE_SALT',        'tvQT-Z Vd:OX$-au.cg~EHHo&(6f.Fibt-%t++C7$+[l*[{imL.aOZR|1vDIK4Qz' );
define( 'WP_CACHE_KEY_SALT', '|=H@ GwQ$*~q=`YyjuQYNoBB BcP4A_8=~%7s/{3/^Z>pV=*Xnn^=WQb!pP#87^s' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
