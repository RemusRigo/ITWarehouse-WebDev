<!-------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         v20260114
//   header
-------------------------------------------------------------------------------------------------->

<!DOCTYPE html>
<html lang="en">
<head>
   <title>IT Inventory</title>
   <meta charset="UTF-8">

<?php
   if (empty($_SESSION['user_id']))
   {
      echo "<link rel=\"stylesheet\" href=\"css/login.css\">";
   }
   else
   {
      echo "<link rel=\"stylesheet\" href=\"css/main.css\">";
      echo "<link rel=\"stylesheet\" href=\"css/edit.css\">";
      echo "<link rel=\"stylesheet\" href=\"css/menu_xp.css\">";
   }
   if (isset($_GET['show']))
   {
      echo "<script src=\"js/show_devices.js\" defer></script>";
   }

?>

</head>
<body>
