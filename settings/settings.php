<?php
/**
 * Path definitions
 *
 * Yeah, I still use define(), so what?
 */
define('MC_PATH_APP', MC_PATH . DS . 'app');
define('MC_PATH_APP_CONTROLLER', MC_PATH_APP . DS . 'controller');
define('MC_PATH_APP_MODEL', MC_PATH_APP . DS . 'model');
define('MC_PATH_APP_MODEL_LEAF', MC_PATH_APP_MODEL . DS . 'leaf');
define('MC_PATH_APP_MODEL_NODE', MC_PATH_APP_MODEL . DS . 'node');
define('MC_PATH_APP_MODEL_ROOT', MC_PATH_APP_MODEL . DS . 'root');
define('MC_PATH_APP_MODEL_USER', MC_PATH_APP_MODEL . DS . 'user');
define('MC_PATH_APP_VIEW', MC_PATH_APP . DS . 'view');
define('MC_PATH_APP_VIEW_LEAF', MC_PATH_APP_VIEW . DS . 'leaf');
define('MC_PATH_APP_VIEW_NODE', MC_PATH_APP_VIEW . DS . 'node');
define('MC_PATH_APP_VIEW_ROOT', MC_PATH_APP_VIEW . DS . 'root');
define('MC_PATH_APP_VIEW_TEMPLATES', MC_PATH_APP_VIEW . DS . 'templates');
define('MC_PATH_APP_VIEW_USER', MC_PATH_APP_VIEW . DS . 'user');
define('MC_PATH_HTDOCS', MC_PATH . DS . 'htdocs');
define('MC_PATH_LOGS', MC_PATH . DS . 'logs');

/**
 * Server variables.
 */
define('MC_SERVER_NAME', $_SERVER['SERVER_NAME']);
define('MC_SERVER_PORT', $_SERVER['SERVER_PORT']);
define('MC_URL', $_SERVER['PHP_SELF']);
define('MC_URL_ARGS', ($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : null);
define('MC_URL_FULL', ($_SERVER['QUERY_STRING']) ? $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'] : $_SERVER['PHP_SELF']);

/**
 * Global variables.
 */
$mc         = null;
$mcSettings = array();
 
/**
 * Include some shtuff.
 * What, no super fancy dynamic auto-bootstrapper-loader-thingy?
 * Nope.
 */
include_once(MC_PATH_APP_CONTROLLER . DS . 'crud.class.php');
include_once(MC_PATH_APP_CONTROLLER . DS . 'filesystem.class.php');
include_once(MC_PATH_APP_CONTROLLER . DS . 'html.class.php');
include_once(MC_PATH_APP_CONTROLLER . DS . 'main.class.php');
include_once(MC_PATH_APP_CONTROLLER . DS . 'memcache.class.php');
include_once(MC_PATH_APP_CONTROLLER . DS . 'model.class.php');
include_once(MC_PATH_APP_CONTROLLER . DS . 'page.class.php');
include_once(MC_PATH_APP_CONTROLLER . DS . 'request.class.php');
include_once(MC_PATH_APP_CONTROLLER . DS . 'response.class.php');
include_once(MC_PATH_APP_CONTROLLER . DS . 'status.class.php');
include_once(MC_PATH_APP_CONTROLLER . DS . 'tree.class.php');
include_once(MC_PATH_APP_CONTROLLER . DS . 'user.class.php');
include_once(MC_PATH_APP_CONTROLLER . DS . 'utils.class.php');
// We can't do models alphabetically because leaf extends node extends root.
include_once(MC_PATH_APP_MODEL_ROOT . DS . 'root.class.php');
include_once(MC_PATH_APP_MODEL_NODE . DS . 'node.class.php');
include_once(MC_PATH_APP_MODEL_LEAF . DS . 'leaf.class.php');

/**
 * Memcache settings.
 */
define('MC_MEMCACHE_DEFAULT_COMPRESS', MEMCACHE_COMPRESSED);
define('MC_MEMCACHE_DEFAULT_EXPIRE', 3600);
define('MC_MEMCACHE_DEFAULT_TIMEOUT', 0);
$i = 0;
$mcSettings['memcache'] = array();
$mcSettings['memcache'][$i]['host'] = 'localhost';
$mcSettings['memcache'][$i]['port'] = 11211;
++$i;

/**
 * Page settings.
 */
define('MC_MIN_PAGE_NAME_LENGTH', 3);

/**
 * User settings.
 */
define('MC_USER_COOKIE_EXPIRE', 3600);
define('MC_USER_HTTP_USER_AGENT', $_SERVER['HTTP_USER_AGENT']);
define('MC_USER_KEY_COOKIE_NAME', 'byogb4bpo983h3ounf');
define('MC_USER_REMOTE_ADDR', $_SERVER['REMOTE_ADDR']);
define('MC_USER_SESSION_COOKIE_NAME', 'v7892v5t2vo9unpa09h0');

/**
 * Get the web service API settings.
 */
include_once(MC_PATH_SETTINGS . DS . 'wsapi.php');
?>