<?php

// BEGIN iThemes Security - Do not modify or remove this line
// iThemes Security Config Details: 2
define( 'DISALLOW_FILE_EDIT', true ); // Disable File Editor - Security > Settings > WordPress Tweaks > File Editor
// END iThemes Security - Do not modify or remove this line

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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'enc_siteVA' );

/** MySQL database username */
define( 'DB_USER', 'sitevauser' );

/** MySQL database password */
define( 'DB_PASSWORD', '5WLY?,2fkjoaPQDajc192ka$' );

/** MySQL hostname */
define( 'DB_HOST', '66.42.93.112' );


/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'lG(-IP!P=Us##YjGykU-?+B<~R%ovTpyfc-LuiFq<6E:X![0IwzoPSg9=GrT!@SB' );
define( 'SECURE_AUTH_KEY',  'ROwC>V5CyBG|#=u !DV>lnV);9KM?@n8YQQi/&(;k*v7 jFNkZLHk^~Cm?zUd2)`' );
define( 'LOGGED_IN_KEY',    'Bo`L3:L@/A9JA&g>Io_]*%zM?hxx::xUTo)>}nNbuz!jTq{K/M1a(cfKKSGw1Hn+' );
define( 'NONCE_KEY',        '2Jv8]N8:U$o_Fh`aYCS47brb`FkyZ.ma$phnC?H3?:Uob~D+wsS FhH:Kd:r0L,y' );
define( 'AUTH_SALT',        'z@X.oxGvFQlX1wcOp(S+?+/A)V={`Yy{# y=N+^n~v=1 {A7FbU#epR1c~bn=YF*' );
define( 'SECURE_AUTH_SALT', ':yucG^1!T9D<gG?ION$>hgPNFErRh*hQ!N6I2I-Tz%1v$pVo[MZ}=.R!n,ZdmqO!' );
define( 'LOGGED_IN_SALT',   '~nyge5-)IXT/3|I~e;L$JD^2yLaXEp6sS;!?x*H#P4.Es;6^}c8#,]FG/z[7EBRw' );
define( 'NONCE_SALT',       '%?JY!475 0jwtI0NQwych2CeT-1^yXOQ9)si/ZV~uAsN-zgG5]wS(MJ`CyX.lx$E' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
// Enable WP_DEBUG mode
define( 'WP_DEBUG', true );

// Enable Debug logging to the /wp-content/debug.log file
define( 'WP_DEBUG_LOG', true );

// Disable display of errors and warnings 
define( 'WP_DEBUG_DISPLAY', false );
@ini_set( 'display_errors', 0 );

@ini_set('max_execution_time', 200);
// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
define( 'SCRIPT_DEBUG', true );

 //Increase wordpress memory limit
define( 'WP_MEMORY_LIMIT', '128M' );

//To define cURL timeout
@ini_set( 'default_socket_timeout', 300 );

//To disable auto updates
define( 'AUTOMATIC_UPDATER_DISABLED', true );

//to disable plugin update and remove option
//define('DISALLOW_FILE_MODS',true);

//upload files directly without ftp
define('FS_METHOD','direct');
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

