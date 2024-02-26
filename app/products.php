<?php
/**
 * Retrieve all products Database
 */

// Test if file calls over required not standalone
defined('app_init') OR die();

if ( !$db->isTableExists($tableName) ) {
  return;
}


// Fetch Products
$products = $db->selectAll($tableName, [
  'sort' => -1,
  'limit' => -1
]);

// Start output buffer to collect html and put later
ob_start();
?>
<hr />
<h3>
  Product List
</h3>
<table class="table table-hover table-bordered">
  <thead>
    <tr class="table-active">
      <th scope="col">#</th>
      <th scope="col">Product Name</th>
      <th scope="col">Description</th>
      <th scope="col">Price</th>
      <th scope="col">Timestamp</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $products->fetchArray(SQLITE3_ASSOC)) : ?>
    <tr id="row-<?= $row['id'] ?>"<?= isset($lastProductId) && $lastProductId == $row['id'] ? 'class="table-success"' : '' ?>>
      <th scope="row"><?= number_format($row['id']) ?></th>
      <td><?= $row['name'] ?></td>
      <td><?= $row['description'] ?></td>
      <td class="text-end"><?= number_format($row['price'], 2) ?></td>
      <td class="text-center"><?= $row['timestamp'] ?></td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>
<?php
// Store output content to receiving variable and clean up the buffer
return ob_get_clean();
