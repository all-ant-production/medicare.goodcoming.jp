<?php

// BEGIN iThemes Security - 変更またはこの行を削除しないでください
// iThemes Security Config Details: 2
define('DISALLOW_FILE_EDIT', true); // ファイルエディタを無効 - セキュリティ > 設定 > WordPress の微調整 > ファイルエディタ
// END iThemes Security - 変更またはこの行を削除しないでください

define('ITSEC_ENCRYPTION_KEY', 'e2c9OXwvPS9LaXlzTEo+VEVmSTBncS4yIHh3ME17QFZKNDg5SzJreUszITs3NX5KSW5bYFVYNWU9X3B0eEx6Mg==');

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
define('DB_NAME', 'coronwan_gcmedicare');

/** Database username */
define('DB_USER', 'root');

/** Database password */
define('DB_PASSWORD', '');

/** Database hostname */
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

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
define('AUTH_KEY',         'JIUn-c2goW (9fX -m|/R%wfTCm/gxG^Y)6P/j=~Cw+-7--9+aGE& ]R@mqc;u j');
define('SECURE_AUTH_KEY',  'AH#p_eZt3?C*|^PPN._bJw<cK.$mq[7*Lvu|1:0StJEB ;HR>2*U-M~itQ2d2Ls:');
define('LOGGED_IN_KEY',    'mv[)n$O+%WY1[sd^l%GxK8Q|x%wweqb+W+!zL%a}%8{p3sadcpeR}=+J&KcxK+3L');
define('NONCE_KEY',        'm~Z0ac<#uiCPL5j6,e)-UB_5H2C~++=bsL[&v7+0y:r&R^KXjC1-Bitk]2?N*b(1');
define('AUTH_SALT',        'Cy}k+3{vF.%H Ygov^!X(T.au7ZaK|@)dG*]AGZuy5*X8~6([{npvbFgcNK`y.@-');
define('SECURE_AUTH_SALT', 'HdJt:Odd1`6sqdU+e CsqF`moXcszxXEo!wAr*H_If}a![Yv{])GRsn&Kui#0sU]');
define('LOGGED_IN_SALT',   '5gxZ9gLnpQ[P#G{O;/*?Z.CgOodwP{},i*oD*]FM#$|X3z7d^:OGShI4uk2)A]I,');
define('NONCE_SALT',       '!p1T2 A=x|+yeh^.{oU33V-|Ez,wO@-j+u=|$Ko]M#TI(6u$pk;[}?D7:vT( Eo&');
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
define('WP_DEBUG', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (! defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
