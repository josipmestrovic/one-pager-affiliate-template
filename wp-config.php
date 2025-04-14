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
define( 'AUTH_KEY',          '7,*iDV!uaMg7%cy^Q=YhdvY@tWx8Gpb^Jx;a&#^c_S<rgC3]]Q:J]8;MpgGf>%,<' );
define( 'SECURE_AUTH_KEY',   'CT|G${gU;8*Kjci*7^PTv&bqJP&#QkLY:q$k8]W?,nCA}G.ujI/Jubw+c44u]Y6d' );
define( 'LOGGED_IN_KEY',     'nb6RDuqOo~.z FCH:%3nP}<]Rg ~/CaZ-tS_XYS2|Y{@tBtK;xhX;Jv?RKDSD0FJ' );
define( 'NONCE_KEY',         '};bX,c5e>Jml6cm_}I0a,>!eS4z0P-C(RmYR`?|^3E8U:G_g44e}0*r_VcWpE$Ly' );
define( 'AUTH_SALT',         '0dJn4y5aMkBc?bxfh]1=YPe}l*M2H?yN29f ;xq+tOD4YU27.xpUwVosW9kGeP M' );
define( 'SECURE_AUTH_SALT',  'q*i^UU(qr$n4rgvmqGVG] HzalwLn{jwhFigU@0v=C&,DV-GouqZY7W:X^np/8G1' );
define( 'LOGGED_IN_SALT',    'h=y/zw8Mu8crviJWE-Gz3%M%)MBTr)5^3o,SEak]/l/Lxf::u4L=p?Mz+V=[&CuD' );
define( 'NONCE_SALT',        '}H)HA,]@4$+dmA-iQL!kertO}>@m3d Y=|M#YO&M#.z.qW*)}2*M`Q./k4B`~__O' );
define( 'WP_CACHE_KEY_SALT', 'n>o@=eKGvw/9]%>M~Gip(JQm1KfbOH@R;8h|tgsFZh{#3}99,n<l=4xKBaQ,ktg`' );


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
