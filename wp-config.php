<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */

/** MySQL database username */

/** MySQL database password */

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
define('FS_METHOD', 'direct');
define('AUTH_KEY',         '-xJ?)4rGJBFrJ$g@]i-=t_b~kg.,A`S@|<Z/Q%:%D7pCS{=&PHLd SyFB-(m03gB');
define('SECURE_AUTH_KEY',  '78$/UrT3t|h(2]*RZ7)prMZ$ 8El3YGzK`*ALIE(;LIF;|h)n>pK;ytv#U){caF%');
define('LOGGED_IN_KEY',    '1e=:7ePW#Ktw<=a`#yku1r(-A|K?&SHv,_Ih5p|OPZ=uZABnz4]oBD!ccS[R#~l<');
define('NONCE_KEY',        'gD] n:+K%D][+N1%]+q2lU095Ezb10jc+yfUK-1-01d2tjEf./5;&`Ewz8&m)KN/');
define('AUTH_SALT',        'IKZfoA*,3DRDYnI%P@Wz,Z`#t%U|#:C3C+R0wu|.OU=SD?Y%JaB6|594KaFU/WP@');
define('SECURE_AUTH_SALT', 'gJqlq(Qid3I~tPPO#G1ApC!<[c2(`bVVAVb3:x{DKPA.{0(0NfJ*$Mg<G9?dyb:j');
define('LOGGED_IN_SALT',   '!)n@[)L(}?.G7_{rR0&2s#k=+}9*9y*pOO++nTzNkUn]cDWmu1%1;S|XA)+]-T-&');
define('NONCE_SALT',       'b=+AN=oH*1jCmW!mvStJ]{imt!1xUa^>P_PzIUis5=uG6jrCq:C-TfI@eJ`h)(;%');
define('DB_NAME', 'wordpress');
define('DB_USER', 'wordpress');
define('DB_PASSWORD', '6tVtAV6UFX');
require_once(ABSPATH . 'wp-settings.php');
