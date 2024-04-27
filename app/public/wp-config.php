<?php
define( 'WP_CACHE', false ); // Added by WP Rocket

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
define( 'AUTH_KEY',          '?CE^ZaDdu N1lsPEHFhUwVK3jYoTZ8EM$E73La`M%|av[2ru(p.tcg{jRd(my,L.' );
define( 'SECURE_AUTH_KEY',   '9q[33FVKQ-KsN$iVxVwOMZ#IFl^%WqP|p@_x-T?b`-4`]:CNmxN_Ho_@:&(%It(;' );
define( 'LOGGED_IN_KEY',     'kJzsd(f=r#pRP~Y,hH p1wls2s>wN1N}o~@4}g&Ib[c~RY?xLrXPNW14Sn>`Q 9a' );
define( 'NONCE_KEY',         'l&j?hJn4)E[P#VR5DZNYh>BE,$oZbW/K~c{hUM*niAo(KD_UOP(SbXA~!z!M,Ue<' );
define( 'AUTH_SALT',         'cB<5t/t-(=|2k:7kQy?3D)^c_)~-b$N!%q.^4WJT>q36R@(ZYU/+LNur2V``OIz#' );
define( 'SECURE_AUTH_SALT',  ' !7=.27Hb+d;O2`fq;WF,qg<1t*inAiEgX*by)6c_SJs K|4z5:Aj3`%1*[05M=]' );
define( 'LOGGED_IN_SALT',    'I=ba~_cZ0c>gA8-~Ijpv[XnC[#3OQSu}`Xw$+`D~*|&80_>#of#qa.vp=Ym4m8~j' );
define( 'NONCE_SALT',        'U6icE;3L:E+QSFBzg5zgGdd;uG1!%Fb>@K&SHi>Y,nFc#AbxP6c$W)d^e/kDIubB' );
define( 'WP_CACHE_KEY_SALT', 'sQ5t,89LzNu5x1J(xRf9nR`aEK6Vh!q>,IR%mp(kq9o?tUCG@IM#isN/Om0W_7Rr' );


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
	define( 'WP_DEBUG', true );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
