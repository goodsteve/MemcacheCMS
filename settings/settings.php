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
 * Global variables.
 */
$mc         = null;
$mcSettings = array();
 
/**
 * Include some shtuff.
 * What, no super fancy dynamic auto-bootstrapper-loader-thingy?
 */
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
// The user model doesn't extend anything.
include_once(MC_PATH_APP_MODEL_USER . DS . 'user.class.php');
// Done. Your stupid autoloader can go fuck itself.

/**
 * Memcache settings.
 */
$i = 0;
$mcSettings['memcache'] = array();
$mcSettings['memcache'][$i]['host'] = 'localhost';
$mcSettings['memcache'][$i]['port'] = 11211;
++$i;

/**
 * Get the web service API settings.
 */
include_once(MC_PATH_SETTINGS . DS . 'wsapi.php');
?>