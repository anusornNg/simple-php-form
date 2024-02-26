<?php
/**
 * Configuration File
 */

// Test if file calls over required not standalone
defined('app_init') OR die('Permission Denied.');


return [
  'sqliteFile'      => './data/database.db',
  'sqliteTableName' => 'product',
];
