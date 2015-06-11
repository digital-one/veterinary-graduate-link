<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'grad_portal');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'Mc8~)C%XOE+Qw!z0J;v<[NgJO:~;-bhRb=-]s^U#7U*&-h6kva;4p(G>vcDb-JE6');
define('SECURE_AUTH_KEY',  ';^NyN&S]C,lr Q)XF%|Ls#N%,N.@hoLaEs7R-|wn3[M:hC!l$Sg!i0E}L#mLRd$O');
define('LOGGED_IN_KEY',    'HV||0J8@UV-%FXQdMwv*a!aL!+yS~Tm6jV@2}0Y31)lnLuX8i^#v8X)o(G/1)l1Y');
define('NONCE_KEY',        '*]+vn]-Eq-H[~huH |Tbq-RbW<+.FR(?x?!;,zK{_^H}&| 55n+EYl/t8i-|RiX=');
define('AUTH_SALT',        '7F?#@*nK>JQs}Zu/$86EN*(E{.Lu!GNul/FQSF^yy0f.4E`1Yh*&/pY`[-h=LcH=');
define('SECURE_AUTH_SALT', 'bqr]Yi5fg-E<G4& 0^ximuZc97(~:@oZ?UkM}-C0Fh^2@`JoE@.-2S$n?t{iQ+m;');
define('LOGGED_IN_SALT',   ';iKWb-o!Y@NYtR@ |F-7F/HFX/LK_hM[JVgN@w^.8$uSO<Y^%$O(q|MB_}_7%+kP');
define('NONCE_SALT',       '0q3+# C6f5CVnVWk2>Jv]Z|DF[.-XIP6|=mIKeCr, $=jTsAfcZ+l|fl/M;C-;~!');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
