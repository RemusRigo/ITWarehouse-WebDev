<?php
//-------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         2025-12-17
//   header 
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <title>IT Inventory</title>
   <meta charset="UTF-8">
   <link rel="stylesheet" href="css/main.css">

   <?php if (isset($_GET['show'])) : ?>
      <script src="js/show_devices.js" defer></script>
      <link rel="stylesheet" href="css/devices.css">
   <?php endif; ?>

   <?php if ($loggedUser=="admin"): ?>
      <link rel="stylesheet" href="css/admin.css">
   <?php endif; ?>

   <link rel="stylesheet" href="css/menu_xp.css">
</head>
<body>
