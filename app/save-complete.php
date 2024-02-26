<?php
// Test if file calls over required not standalone
defined('app_init') OR die('Permission Denied.');

if ( !isset($lastProductId) ) {
  die('No Product ID.');
}

// Start output buffer to collect html and put later
ob_start()
?>
<div class="alert alert-success" role="alert">
  Product #<?= $lastProductId ?> Saved.
</div>
<?php
// Store output content to receiving variable and clean up the buffer
return ob_get_clean();
