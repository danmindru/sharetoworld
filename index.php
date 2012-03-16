<?php

//Check if config file exists
if (!file_exists('config.php')) {
	die('Configuration file not found');
}

// Include config file
require_once('config.php');

// Set error reporting
if (DEBUG_MODE || DEVELOPEMENT_MODE) {
	error_reporting(E_ALL);
} else {
	error_reporting(0);
}

// Include required files
require_once(FUNCTIONS_DIR . 'common.php');
require_once(COMMON_DIR . 'icontroller.php');
require_once(COMMON_DIR . 'front.php');
require_once(COMMON_DIR . 'view.php');
require_once(COMMON_DIR . 'user.php');
require_once(DB_DIR . 'db.php');

// Start session
$user = User::get_instance();

// Initialize the FrontController
$front = FrontController::get_instance();
$front->route();

// Close database connection
$db = db::get_instance();
$db->db_close();

// Display page
echo $front->getBody();

?>