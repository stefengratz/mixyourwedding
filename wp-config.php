<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'mixyourwedding');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'mb(b`PZysSz(E>7=`h)`RBn<jxJ?$bW}4o]iN?zf/5]_fuJ@p-_25P|#q Xfg|OG');
define('SECURE_AUTH_KEY',  'da+ TBJ_lO?UgZEkxed0{#621p~`>J%h`{U3;sMs=bhBhAdQ0gZ/hbbk}>|Vw|ov');
define('LOGGED_IN_KEY',    'i8>[!XCr*#&LKk/!0:Re*A<3E:UUjA{=RQ}29ucU>RO[Xt<X..uWLHI!uh(b%_a5');
define('NONCE_KEY',        'J}A&3Cr,y(i T2v}TD;7>JjUT||53GAMO.IbzI(3zi?i}n4I~Kyp7.>;8jW&0SXO');
define('AUTH_SALT',        'rOYW%g)XxI2$Jqaq!I9~rJ_WT&kb(,=k4;:U@NYbhVAD2-2_RGKmztBbIiF.KKk`');
define('SECURE_AUTH_SALT', 'nx:?V$Ub_$=KB[CIANXt>NmC*aGah*XVF_~cC#E.:-<KPI O>$76|u*OQ~gy<b6|');
define('LOGGED_IN_SALT',   'Hf*!edsEGd04ngC4ZMX^waz^ TzJiDcsy+xXFk[uTN[^Uw2z9jd2t.]AL3W&G,~-');
define('NONCE_SALT',       '/)iG3OJV!)W! !Q`}j9|?*D&a;WbZ:]IZb@H8GrGvKdnH> 9r$zJ6($mlUQ!</!%');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
