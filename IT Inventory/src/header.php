<?php
//-------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         v20260303
//   header
//-------------------------------------------------------------------------------------------------

echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "<head>";
echo "<title>IT Inventory</title>";
echo "   <meta charset='UTF-8'>";

if (empty($_SESSION['user_id']))
{
   echo "<link rel='stylesheet' href='css/login.css'>";
}

echo "<link rel='stylesheet' href='css/main.css'>";
echo "<link rel='stylesheet' href='css/edit.css'>";
echo "<link rel='stylesheet' href='css/menu_xp.css'>";

if (isset($_GET['show']))
{
   echo "<script src='js/show_devices.js' defer></script>";
}

echo "</head><body>";

?>