<?php
/**
 * Class: DB
 * Implements over SQLite3 interface
 */
class DB extends SQLite3
{
  /**
   * Open Database on File
   *
   * @param string $file
   */
  function __construct(string $file)
  {
    $this->open($file);
  }

  /**
   * Test if Table with given name exists
   *
   * @param [type] $tableName
   * @return boolean
   */
  public function isTableExists(string $tableName)
  {
    $query = "SELECT EXISTS (
      SELECT name
      FROM sqlite_schema
      WHERE type='table'
      AND name='$tableName'
    ) as 'isExisted';";

    $result = $this->query($query);
    $result = $result->fetchArray(SQLITE3_ASSOC);
    return boolval($result['isExisted']);
  }

  /**
   * Create new table to database
   *
   * @param string $tableName
   * @param array $columns
   * @return void
   */
  public function createTable(string $tableName, array $schema)
  {
    $tableName    = $this->escapeString($tableName);
    $columnNames  = array_keys($schema);

    $columns      = array_map( function($columnName, $dataType) {
      $columnName = $this->escapeString($columnName);
      return "$columnName $dataType";
    }, $columnNames, $schema);

    $columnString = implode(",\n   ", $columns);

    $query  = "CREATE TABLE IF NOT EXISTS $tableName ( $columnString );";
    $this->exec($query);
  }

  /**
   * Insert document values to table
   *
   * @param string $tableName
   * @param array $document
   * @return void
   */
  public function insertOne(string $tableName, array $document)
  {
    // Escape tableName
    $tableName = $this->escapeString($tableName);

    // Prepare Keys and Values
    // Extract each column and escape string one by one
    $keys   = array_keys($document);
    $values = array_map(function ($value) {
      return sprintf('"%s"', $this->escapeString($value));
    }, $document);

    // Add timestamp
    array_push($keys, "timestamp");
    array_push($values, "datetime('now','localtime')");

    $keyString    = implode(', ', $keys);
    $valueString  = implode(', ', $values);

    $query = "INSERT INTO $tableName ($keyString) VALUES ($valueString);";
    $result = $this->query($query);

    return $result;
  }

  /**
   * Select All from Database
   * Options available:
   * - Sorting Direction
   * - Pagination
   * - Limit per page
   *
   * @param string $tableName
   * @param array $options
   * @return void
   */
  public function selectAll(string $tableName, array $options = [])
  {
    $tableName  = $this->escapeString($tableName);
    $query      = "SELECT * FROM $tableName";

    if (array_key_exists('sort', $options)) {
      $sort = ($options['sort'] === -1) ? 'DESC' : 'ASC';
      $query .= " ORDER BY id $sort";
    }

    if (array_key_exists('limit', $options)) {
      $limit  = intval($options['limit']);
      if ($limit > 0) {
        $page   = array_key_exists('page', $options) ? intval($options['page']) : 1;
        $offset = ($page - 1) * $limit;
        $query .= " LIMIT $offset, $limit";
      }
    }

    $result = $this->query($query);
    return $result;
  }
}