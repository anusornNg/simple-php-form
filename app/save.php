<?php
/**
 * Save input values to Database
 * Use SQLite3 as a database
 */

// Test if file calls over required not standalone
defined('app_init') OR die();

try {
  // Throw Exception if no $_POST values
  if ( is_array($_POST) === false || array_key_exists('submission-id', $_POST) === false ) {
    throw new Exception('Input values not found');
  }

  // Prepare Data
  $productName        = $_POST['name'];
  $productDescription = $_POST['description'];
  $productPrice       = $_POST['price'];
  // Unique Submission is intended to be idempotency key, not implemented in this program.
  $uniqueSubmission   = $_POST['submission-id'];

  // Test if Table not exists then create table
  if ( !$db->isTableExists($tableName) ) {
    $schema = [
      'id'          => 'INTEGER PRIMARY KEY',
      'name'        => 'STRING',
      'description' => 'STRING',
      'price'       => 'REAL',
      'timestamp'   => 'DATETIME',
    ];
    $result = $db->createTable($tableName, $schema);
  }

  // Write new data to Database
  $result = $db->insertOne(
    $tableName,
    [
      'name'        => $productName,
      'description' => $productDescription,
      'price'       => $productPrice,
    ]
  );

  if ($result) {
    // Get Last Insert Row ID
    $lastProductId = $db->lastInsertRowID();

    // Display save completed notification
    return require('save-complete.php');
  }

} catch (Exception $e) {
  die($e->getMessage());
}
