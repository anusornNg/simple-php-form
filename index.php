<?php
/**
 * Simple PHP Form
 *
 * A program contains two parts:
 * - Form with input fields, to fill values and submit.
 * - Data Saving, to save input values to database.
 *
 * @author Anusorn Wisetsupakarn <anusorn.wisetsupakarn@outlook.com>
 */

// Setup app initialization to use in other files
define('app_init', 1);

// Set System Folders
define('APP_ROOT', dirname(__FILE__));
define('APP_PATH', APP_ROOT . '/app');
define('DB_PATH' , APP_ROOT . '/data');
define('LIB_PATH', APP_ROOT . '/lib');
define('ASSET_PATH', APP_ROOT . '/asset');

// Load configuration
$config = require( APP_PATH . '/config.php');
// extract($config);

// Load Database Library
include LIB_PATH . '/db.php';

// Start App
include APP_PATH . '/index.php';

