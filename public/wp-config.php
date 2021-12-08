<?php
/**
 * The base configurations of the WordPress.
 *
 * @package WordPress
 */

 /**
 * +++++++++++++++++++++++++++++++++++++++++++++++++++
 * All defined constants are set in index.php
 * @see index.php
 * +++++++++++++++++++++++++++++++++++++++++++++++++++
 */


/**
* The defined constants are set here, to not be late with it
*/

// define('DISALLOW_FILE_MODS', true);
// define('DISALLOW_FILE_EDIT', true);
// define('WP_MEMORY_LIMIT', 26);

header('X-Frame-Options: SAMEORIGIN'); // Set X-Frame-Options header to prevent clickjacking attacks

define('WPCACHEHOME', getenv('WPCACHEHOME') ?: $_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/wp-super-cache/');
define('WP_CACHE', getenv('WP_CACHE'));
define('HTTPS_MODE', strtolower(getenv('HTTPS_MODE')) === 'on');
define('DB_NAME', getenv('DB_NAME') ?: 'database1');
define('DB_USER', getenv('DB_USER') ?: 'user');
define('DB_PASSWORD', getenv('DB_PASSWORD') ?: 'moep');
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_PREFIX', getenv('DB_PREFIX') ?: 'wp_');
define('WP_DEBUG', (bool)getenv('WP_DEBUG'));
define('FORCE_SSL_ADMIN', (bool)getenv('FORCE_SSL_ADMIN'));
define('FORCE_SSL_LOGIN', FORCE_SSL_ADMIN);
define('SMTP_HOST', getenv('SMTP_HOST') ?: 'localhost');
define('SMTP_AUTH', getenv('SMTP_AUTH'));
define('SMTP_PORT', getenv('SMTP_PORT') ?: 1025);
define('SMTP_USER', getenv('SMTP_USER'));
define('SMTP_PASS', getenv('SMTP_PASS'));
define('SMTP_AUTO_TLS', getenv('SMTP_AUTO_TLS'));
define('SMTP_FROM', getenv('SMTP_FROM'));
define('SMTP_FROM_NAME', getenv('SMTP_FROM_NAME'));
define('SMTP_SECURE', getenv('SMTP_SECURE'));
define('WP_ENV', getenv('WP_ENV') ?: 'development');
define('AUTH_KEY', getenv('AUTH_KEY'));
define('SECURE_AUTH_KEY', getenv('SECURE_AUTH_KEY'));
define('LOGGED_IN_KEY', getenv('LOGGED_IN_KEY'));
define('NONCE_KEY', getenv('NONCE_KEY'));
define('AUTH_SALT', getenv('AUTH_SALT'));
define('SECURE_AUTH_SALT', getenv('SECURE_AUTH_SALT'));
define('LOGGED_IN_SALT', getenv('LOGGED_IN_SALT'));
define('NONCE_SALT', getenv('NONCE_SALT'));


define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', 'utf8mb4_general_ci');
define('AUTOMATIC_UPDATER_DISABLED', true);
define('WP_AUTO_UPDATE_CORE', false);
define('WP_EXPORTER_ADMIN_BAR', true);
define('WPCF7_AUTOP', false);
define('WPCF7_LOAD_CSS', false);
define('WPCF7_LOAD_JS', false);
define('DEBUG_MAIL', 'devcon@brainson.net');
define('PLACEHOLDER_IMG', 'data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==');

if (!defined('ABSPATH'))
{
    define('ABSPATH', __DIR__ . '/wp/');
}

define('WP_HOME', sprintf('http%s://%s', HTTPS_MODE ? 's' : '', $_SERVER['HTTP_HOST']));
define('WP_SITEURL', WP_HOME . '/wp');

define('WP_CONTENT_DIR', __DIR__ . '/wp-content');
define('WP_CONTENT_URL', WP_HOME . '/wp-content');

$autoloader = include(dirname(__DIR__) . '/vendor/autoload.php');
$_SERVER['HTTPS'] = HTTPS_MODE;
$table_prefix = DB_PREFIX;


/**
 * Wir nehmen kein Multisite mehr in den Boilerplate Projekten
 * Wenn doch, muss das für das jeweilige Projekt angepasst werden
 * und das composer Package nachinstalliert werden.
 *
 composer require gwa/multisite-directory-resolver
 * 
 
define('WP_ALLOW_MULTISITE', 1);
define('SUBDOMAIN_INSTALL', 1); // oder 0 - je nach Wert kann das if unten auch ganz weggelassen werden!

// Wenn SUBDOMAIN_INSTALL === 1
# $resolver = \Gwa\Wordpress\MultisiteResolverManager::TYPE_SUBDOMAIN;
// Wenn SUBDOMAIN_INSTALL === 0
# $resolver = \Gwa\Wordpress\MultisiteResolverManager::TYPE_FOLDER;

$mdr = new Gwa\Wordpress\MultisiteResolverManager(__DIR__ . '/wp', $resolver);
$mdr->init();
!defined('COOKIE_DOMAIN') and define('COOKIE_DOMAIN', $_SERVER['HTTP_HOST']);
!defined('ADMIN_COOKIE_PATH') and define('ADMIN_COOKIE_PATH', '/');


 *
 */

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

