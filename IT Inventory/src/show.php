<?php
//-------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         v20260303
//   show devices
//-------------------------------------------------------------------------------------------------

if ($showCat == "all")
{
   $sql = "SELECT
         devices.id, devices.name,
         devices.device, devices.manufacturer, devices.model, category.name AS category_name,
         devices.inventory,
         ip.IPv4 as ip_id, ip2.IPv4 as ip2_id, devices.ip_isactive,
         devices.mac, devices.bt, devices.sn, devices.IMEI1, devices.IMEI2, devices.pn, devices.firmware,
         devices.custodian,
         locations.name as location1, devices.location2,
         status.name AS status_name, devices.purchased, devices.disposed,
         devices.notes
      FROM devices
      LEFT JOIN category ON devices.category_id = category.id
      LEFT JOIN ip AS ip ON devices.ip_id = ip.ID
      LEFT JOIN ip AS ip2 ON devices.ip2_id = ip2.ID
      LEFT JOIN locations AS locations ON devices.location1 = locations.ID
      LEFT JOIN status ON devices.status_id = status.id
      ORDER BY devices.id DESC";
      
      $sqlModels = "SELECT DISTINCT model
         FROM devices
         WHERE model IS NOT NULL AND model <> ''
         ORDER BY model";
}
else
{
   // check if value is number and if it is in category range
   if (is_numeric($showCat))
   {
      $sql = "SELECT
            devices.id, devices.name,
            devices.device, devices.manufacturer, devices.model, category.name AS category_name,
            devices.inventory,
            ip.IPv4 as ip_id, ip2.IPv4 as ip2_id, devices.ip_isactive,
            devices.mac, devices.bt, devices.sn, devices.IMEI1, devices.IMEI2, devices.pn, devices.firmware,
            devices.custodian,
            locations.name as location1, devices.location2,
            status.name AS status_name, devices.purchased, devices.disposed,
            devices.notes
         FROM devices
         LEFT JOIN category ON devices.category_id = category.id
         LEFT JOIN ip AS ip ON devices.ip_id = ip.ID
         LEFT JOIN ip AS ip2 ON devices.ip2_id = ip2.ID
         LEFT JOIN locations AS locations ON devices.location1 = locations.ID
         LEFT JOIN status ON devices.status_id = status.id
         WHERE category_id = $showCat
         ORDER BY devices.id DESC";
         
      $sqlModels = "SELECT DISTINCT model, category_id
         FROM devices
         WHERE model IS NOT NULL AND model <> '' AND category_id = $showCat
         ORDER BY model";
   }
}

$conn = new mysqli("localhost", "root", "", "it_db");
if ($conn->connect_error)
{
   die("Database connection failed: " . $conn->connect_error);
}
$result = $conn->query($sql);

$resultModels = $conn->query($sqlModels);
$models = [];


if ($result->num_rows > 0)
{
   // Header row
   echo "\n<table name='devices' id='devices' class='devices'>";
   echo "<thead>";
   echo "\n<tr>";
   echo "<th>ID</th>";
   echo "<th>{$cfgLang['Name']}</th>";
   echo "<th>{$cfgLang['Device']}</th>";
   echo "<th>{$cfgLang['Manufacturer']}</th>";
   echo "<th>{$cfgLang['Model']}</th>";
   echo "<th>{$cfgLang['Category']}</th>";
   echo "<th>{$cfgLang['Inventory']}</th>";
   echo "<th>{$cfgLang['IP1']}</th>";
   echo "<th>{$cfgLang['IP2']}</th>";
   echo "<th>{$cfgLang['MAC']}</th>";
   echo "<th>{$cfgLang['BT']}</th>";
   echo "<th>{$cfgLang['SN']}</th>";
   echo "<th>{$cfgLang['IMEI1']}</th>";
   echo "<th>{$cfgLang['IMEI2']}</th>";
   echo "<th>{$cfgLang['PN']}</th>";
   echo "<th>{$cfgLang['Firmware']}</th>";
   echo "<th>{$cfgLang['Custodian']}</th>";
   echo "<th>{$cfgLang['Location1']}</th>";
   echo "<th>{$cfgLang['Location2']}</th>";
   echo "<th>{$cfgLang['Status']}</th>";
   echo "<th>{$cfgLang['Purchased']}</th>";
   echo "<th>{$cfgLang['Disposed']}</th>";
   echo "<th>{$cfgLang['Notes']}</th>";
   echo "</tr>";
   
   // Filter row
   echo "\n<tr>";
   echo "<th></th>"; // ID
   echo "<th></th>"; // Name
   echo "<th></th>"; // Device
   echo "<th></th>"; // Manufacturer
   
   // Model
   echo "<th><select id='filterModel' onchange=\"updateFilter('model')\">";
   echo "<option value=''>All</option>";
   while ($row = $resultModels->fetch_assoc())
   {
      $model = htmlspecialchars($row['model'], ENT_QUOTES);
      echo "<option value='$model'>$model</option>";
   }
   echo "</select></th>";
   
   echo "<th></th>"; // Category
   echo "<th></th>"; // Inventory
   echo "<th></th>"; // IP1
   echo "<th></th>"; // IP2
   echo "<th></th>"; // MAC
   echo "<th></th>"; // BT
   echo "<th></th>"; // SN
   echo "<th></th>"; // IMEI1
   echo "<th></th>"; // IMEI2
   echo "<th></th>"; // PN
   echo "<th></th>"; // Firmware
   echo "<th></th>"; // Custodian
   echo "<th></th>"; // Location1
   echo "<th></th>"; // Location2
   echo "<th></th>"; // Status
   echo "<th></th>"; // Purchased
   echo "<th></th>"; // Disposed
   echo "<th></th>"; // Notes
   echo "</tr>";
   
   echo "</thead><tbody>";

   while ($row = $result->fetch_assoc())
   {
      echo "\n<tr>";

      if( $loggedUser=="admin" )
      {
         echo "<td><a href=index.php?updateDevice=" .htmlspecialchars($row['id']) . " class='nolink'>" . htmlspecialchars($row['id']) . "</td>";
      }
      else
      {
         echo "<td>" . htmlspecialchars($row['id']) . "</td>";
      }    

      echo "<td>" . htmlspecialchars($row['name']) . "</td>";
      echo "<td>" . htmlspecialchars($row['device']) . "</td>";
      echo "<td>" . htmlspecialchars($row['manufacturer']) . "</td>";
      echo "<td>" . htmlspecialchars($row['model']) . "</td>";
      echo "<td>" . htmlspecialchars($row['category_name']) . "</td>";
      echo "<td>" . htmlspecialchars($row['inventory']) . "</td>";    
      echo "<td>" . htmlspecialchars($row['ip_id']) . ($row['ip_isactive'] ? " <b style='color: green;'>&checkmark;</b>" : "") . "</td>";
      echo "<td>" . htmlspecialchars($row['ip2_id']) . "</td>";
      echo "<td>" . htmlspecialchars($row['mac']) . "</td>";
      echo "<td>" . htmlspecialchars($row['bt']) . "</td>";
      echo "<td>" . htmlspecialchars($row['sn']) . "</td>";
      echo "<td>" . htmlspecialchars($row['IMEI1']) . "</td>";
      echo "<td>" . htmlspecialchars($row['IMEI2']) . "</td>";
      echo "<td>" . htmlspecialchars($row['pn']) . "</td>";
      echo "<td>" . htmlspecialchars($row['firmware']) . "</td>";
      echo "<td>" . htmlspecialchars($row['custodian']) . "</td>";
      echo "<td>" . htmlspecialchars($row['location1']) . "</td>";
      echo "<td>" . htmlspecialchars($row['location2']) . "</td>";
      echo "<td>" . htmlspecialchars($row['status_name']) . "</td>";
      echo "<td>" . ($row['purchased'] === null ? '' : htmlspecialchars($row['purchased'])) . "</td>";
      echo "<td>" . ($row['disposed'] === null ? '' : htmlspecialchars($row['disposed'])) . "</td>";
      echo "<td>" . htmlspecialchars($row['notes']) . "</td>";
      echo "</tr>";
   }
   echo "</tbody></table>";
}
else
{
   echo "\n<p>No devices found.";
}
