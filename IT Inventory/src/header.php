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

// Load language
$config = json_decode(file_get_contents('src/config.json'), true);
$langCode = $config['language'];
$langFile = "src/lng/{$langCode}.json";
if (file_exists($langFile))
{
   $cfgData = json_decode(file_get_contents($langFile), true);
}
else
{
   $cfgData = []; // fallback if file missing
}
   
?>