<?php

// BEGIN iThemes Security - Do not modify or remove this line
// iThemes Security Config Details: 2
define( 'DISALLOW_FILE_EDIT', true ); // Disable File Editor - Security > Settings > WordPress Tweaks > File Editor
// END iThemes Security - Do not modify or remove this line

define( 'ITSEC_ENCRYPTION_KEY', 'P1JkdVpSaHJtbWxeRDghVXxDOVM9MXUtKitYeDN1KVBlZERzOTNEe3Z7YD9+cUVbVkd2RjAvNjArNSY5UjtIJg==' );


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

define('DB_NAME', 'ptikfkip_db');



/** MySQL database username */

define('DB_USER', 'root');



/** MySQL database password */

define('DB_PASSWORD', '');



/** MySQL hostname */

define('DB_HOST', 'localhost');



/** Database Charset to use in creating database tables. */

define('DB_CHARSET', 'utf8');



/** The Database Collate type. Don't change this if in doubt. */

define('DB_COLLATE', '');

define('WP_HOME', 'http://localhost/prodi');
define('WP_SITEURL', 'http://localhost/prodi');

/**#@+

 * Authentication Unique Keys and Salts.

 *

 * Change these to different unique phrases!

 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}

 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.

 *

 * @since 2.6.0

 */

// 

// 

// 

// 

// 

// 

// 

// 





















/**#@-*/



/**

 * WordPress Database Table prefix.

 *

 * You can have multiple installations in one database if you give each a unique

 * prefix. Only numbers, letters, and underscores please!

 */

$table_prefix  = 'wp_';



/**

 * WordPress Localized Language, defaults to English.

 *

 * Change this to localize WordPress. A corresponding MO file for the chosen

 * language must be installed to wp-content/languages. For example, install

 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German

 * language support.

 */

define('WPLANG', '');



/**

 * For developers: WordPress debugging mode.

 *

 * Change this to true to enable the display of notices during development.

 * It is strongly recommended that plugin and theme developers use WP_DEBUG

 * in their development environments.

 */

define('WP_DEBUG', false);
define('WP_DEBUG_LOG', '/tmp/wp-errors.log' );



define('DISALLOW_FILE_MODS', true);

define('AUTH_KEY',         'l11zZ};b ~1ylkbA>83wa^loI)IJqdYWw_jSp?^T kq.}])APmtp,g5>o-v;2}}:');
define('SECURE_AUTH_KEY',  'm{*T`xR5LXh=m&}i$f4RyHwdN[=4btxPF{0O0*K8davn&S[{X7*e$4$Amx~Y8mxQ');
define('LOGGED_IN_KEY',    '&JQ^qDQ<bm1ejn,p$I<]]f1E(E^{q+ve6Q/H>8y+vIB+=?gTra@/`ZLfpKgtyplQ');
define('NONCE_KEY',        'JoAJ79t0O[ZOHf`|$ +!+B^{qyH_yc0VXwl:dmG;Rf ?#eu{~_QukarhEggF[yr^');
define('AUTH_SALT',        '4FH_CMr{[8,i9@eX|l-QDJt, bw-3> 6*gg)PAR]}DM2nH-b*S|a|6w]EM!q-|8h');
define('SECURE_AUTH_SALT', ';@^r5du7CdTU/88;,k4)+hDdg^89tpC[6k6q{>nN20z-oQ_f|X2(u$]4#wo|R.%C');
define('LOGGED_IN_SALT',   '8=:$M~qh8uc#bv/*_KCJn5V/*<.{:(~0mO63i/*%R$~p68a@+K3@$tZ GoH-=&sf');
define('NONCE_SALT',       'Rfqdk SHW{s!+6YjB[-/=i|svlTd?pZSsPH!^C&hF{P+-;.a7h[rPKWO+O6xN^pA');

/* That's all, stop editing! Happy blogging. */



/** Absolute path to the WordPress directory. */

if ( !defined('ABSPATH') )

	define('ABSPATH', dirname(__FILE__) . '/');



/** Sets up WordPress vars and included files. */

require_once(ABSPATH . 'wp-settings.php');
