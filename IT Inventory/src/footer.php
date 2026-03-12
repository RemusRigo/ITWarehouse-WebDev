<?php
//-------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         v20260303
//   footer
//-------------------------------------------------------------------------------------------------

echo "\n<hr style='width: 80%'>";
echo "<div name='settings' class='settings'>";

// Add language
$configPath = __DIR__ . '/../json/config.json';
$config = json_decode(file_get_contents($configPath), true);
$langCode = $config['language'];
      
echo "\n<form method='get'><select name='lang' onchange='this.form.submit()'>";
echo "<option value='en'"; if ($langCode === 'en') echo 'selected'; echo ">EN English</option>";
echo "<option value='ro'"; if ($langCode === 'ro') echo 'selected'; echo ">RO Română</option>";
echo "</select>";
foreach ($_GET as $key => $value)
{
   if ($key === 'lang') continue;
   echo "<input type='hidden' name='".htmlspecialchars($key)."' value='".htmlspecialchars($value)."'>";
}
echo "</form>";
echo "</div>"; // settings
echo "\n<hr style='width: 50%'>";
echo "</body>";
echo "</html>";
?>
