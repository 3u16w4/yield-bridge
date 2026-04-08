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
define( 'DB_NAME', 'dbwtyjs0ovusel' );

/** Database username */
define( 'DB_USER', 'ua6etq4zghthe' );

/** Database password */
define( 'DB_PASSWORD', 'feiaeuf4gzww' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',          '8[OVxVb#UO-@oQzOR~:ST4gIG>0jAvHC|#21C^UCqmX1Lo{.v!g+!%5ko{nPM62%' );
define( 'SECURE_AUTH_KEY',   'wZom3x4&D}@7uijAj:!WYbLc~]}dUL<N]s&Y<+orooO~i{si0XsN}t72hQ}-l{(y' );
define( 'LOGGED_IN_KEY',     ' /%W~f%m1.-b5y;n)@fZun=v`m20[e3@_WZNdcw} w!HA*3>tEw|%%p4!o!!x^/:' );
define( 'NONCE_KEY',         'a@Z0;8E}Up!!v-(9QY8))#&a#rdd-VfY~XT%ya-m#T|7q%+mjO&M-0!=_S(nin|7' );
define( 'AUTH_SALT',         '1Ft^g%~1o:,QW[Cy%;#jHP!x:RX8!3mZNh]2*,i{I$n.=,hMek!ROxu<*>^%|H#x' );
define( 'SECURE_AUTH_SALT',  '9v(dZQ5Jfl?h?>3`H!amN?ZOCrmXmAXk?EdbISiM!jfK]VYwmBG$6R&d 5_5wG3@' );
define( 'LOGGED_IN_SALT',    'ZO<7GdX`Pt_P6$>kv9{YL+EGN(Ktm:ROW_[_,-$V_{Y0Cu.0l3K:()cIcH20}z42' );
define( 'NONCE_SALT',        'S9@zy@g<b|OzJJiZ_(8&}.6zu4H.y^o:S.rc #i24R|J}QPB|ef7X@}by.we41rC' );
define( 'WP_CACHE_KEY_SALT', 'JH#qG~CZjazd/=U:NYC|]pHbN+.;>v/04Z!WIfu}tO58~|&(T;MDR{ezRF^mIg:%' );
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', true);

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'ces_';


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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
@include_once('/var/lib/sec/wp-settings-pre.php'); // Added by SiteGround WordPress management system
require_once ABSPATH . 'wp-settings.php';
@include_once('/var/lib/sec/wp-settings.php'); // Added by SiteGround WordPress management system
