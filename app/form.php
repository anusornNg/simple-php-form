<?php
// Test if file calls over required not standalone
defined('app_init') OR die('Permission Denied.');


// Start output buffer to collect html and put later
ob_start()
?>
<h3>
  Add Product
</h3>
<form action="index.php" method="POST">
  <div class="mb-3">
    <label for="name" class="form-label">Product Name</label>
    <input type="text" class="form-control" name="name" id="name" maxlength="255" required />
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <input type="text" class="form-control" name="description" id="description" maxlength="255" />
  </div>
  <div class="mb-3">
    <label for="price" class="form-label">Price</label>
    <input type="number" class="form-control" name="price" id="price" step="0.01" placeholder="Thai Baht" required />
  </div>
  <input type="hidden" name="submission-id" value="<?= uniqid() ?>">
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
// Store output content to receiving variable and clean up the buffer
return ob_get_clean();
