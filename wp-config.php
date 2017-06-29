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
define('DB_NAME', 'chance');

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
define('AUTH_KEY',         'WO(;&q%NY4tZJ#k>`-PME->75W[[{G|=GL:3yf<vk6XSP~U&U8SlJHePw$kaqP1+');
define('SECURE_AUTH_KEY',  '6z<H](YIDYl~g)17?fvDp5!>09QXRMLk@7yD6y3k9wduPPaE _}de<)xa,)V@i*e');
define('LOGGED_IN_KEY',    '`x}rk>so;x;D$ 6/-H<3]sOIMgO05DhQ5*.V]CR_[ML0oy/$a90b};ey`X@Lhy=4');
define('NONCE_KEY',        '4/cUFc+em1Ld:JvS6YLm4|~,`y*:,; tt:`!f8=l)q?4so!O9gBkn2jREaGu;fa]');
define('AUTH_SALT',        '%7[O^@KaQ4TfMS7}bv%h/XjlZrgG{g~:y~3/RIm9-GWu.lR;g`[v@k>OL4;b;lc[');
define('SECURE_AUTH_SALT', 'No|/Hu8Q]:+n_h1.Be- d[$e6qt x~:y_Q5l##lrG3>A2j^ANg,=E8h;jA@e5Fei');
define('LOGGED_IN_SALT',   'M{?mb~~O<FMhJ ymjo![#mXs[QUJ84Mh-_m}.DeLk..-mv*;:,+&[~;rrLVUqW,C');
define('NONCE_SALT',       'k|B|x0:EyFdGmjLmEgH1eB/gAqXwsUE# y[jPVF2{gMC3*V$}lrB#,n vqc]kAo>');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_ch';

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
