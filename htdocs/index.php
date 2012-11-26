<?php
/**
 * Runtime settings
 *
 * The default settings are set for debugging.
 * All errors will be displayed on the screen.
 */
error_reporting(-1);
ini_set('display_errors', true);

/**
 * Memory limit
 *
 * MemcacheCMS requires a crap ton of RAM.
 */
ini_set('memory_limit', '16M');
 
 
/**
 * This seems to be the minimum code needed
 * to include the bloody settings file.
 */
define('DS', DIRECTORY_SEPARATOR);
define('MC_PATH', dirname(__DIR__));
define('MC_PATH_SETTINGS', MC_PATH . DS . 'settings');
include_once(MC_PATH_SETTINGS . DS . 'settings.php');

/**
 * Instantiate the main object and run that thang.
 */
$mc = new mcMainController();
$mc->run();
$mc->close();

// Aaaaaaaand, we're done.
?>