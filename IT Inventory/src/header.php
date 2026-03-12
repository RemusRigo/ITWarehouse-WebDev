<?php
//-------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         v20260303
//   header
//-------------------------------------------------------------------------------------------------

$configPath = __DIR__ . '/../json/config.json';

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

if (isset($_GET['cat']))
{
   echo "<script src='js/show_devices.js' defer></script>";
   echo "<script src='js/update_filter.js' defer></script>";
}

echo "</head><body>";

$configPath = __DIR__ . '/../json/config.json';
$config = json_decode(file_get_contents($configPath), true);
// Check if refresh needed
//if (!empty($config['refresh']))
//{
//   $config['refresh'] = false;
//   file_put_contents($configPath, json_encode($config, JSON_PRETTY_PRINT));
//   echo "refresh";
//   echo "<script>location.reload();</script>";
//   exit;
//}

// Load language
$langCode = $config['language'] ?? 'en'; // default if missing
$langFile = "json/lng/{$langCode}.json";
if (file_exists($langFile))
{
   $cfgLang = json_decode(file_get_contents($langFile), true);
}
else
{
   $cfgLang = []; // fallback if file missing
}
   
?>