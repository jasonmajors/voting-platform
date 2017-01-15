<?php 
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
// Start sessions
if( !session_id() ) @session_start();
// Set some constants
define('ROOT_PATH', dirname(dirname(__FILE__)));
define('SITE_URL', 'http://www.jasonmajors.net/rwp');
// Autoloader
require_once ROOT_PATH . '/vendor/autoload.php'; 

// Load env vars
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

require_once ROOT_PATH . '/routes.php';
