<?php
/**
 * App main page
 */

// Test if file calls over inclusion, not standalone
defined('app_init') OR die();


// Connect to Database
$db = new DB($config['sqliteFile']);

// get Table name from config
$tableName  = $config['sqliteTableName'];


// If recent document saved completely
// If form just has submitted, process saving to database
if ( is_array($_POST) && array_key_exists('submission-id', $_POST) ) {
  // Connect to database and save it.
  $saveComplete = require('save.php');
}

// Get form input
$htmlForm = require('form.php');

// Get Product List
$productList = require('products.php');


// Display View
include 'view.php';
