<?php
/**
 * App view page
 */

// Test if file calls over inclusion, not standalone
defined('app_init') OR die();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple PHP Form</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="asset/css/style.css" type="text/css">
</head>
<body>
  <div id="app">
    <h1 class="text-center">
      <a href="/">Simple Products</a>
    </h1>
    <hr />
    <?= $saveComplete ?? '' ?>
    <?= $htmlForm ?>
    <?= $productList ?>
  </div>
</body>
</html>