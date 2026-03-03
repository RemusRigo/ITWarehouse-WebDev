<?php
//-------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         v20260303
//   show devices
//-------------------------------------------------------------------------------------------------


if ($showDevice == "all")
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
}
else
{
   // check if value is number and if it is in category range
   if (is_numeric($showDevice)) // && $showDevice >= 1 && $showDevice <= 9)
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
         WHERE category_id = $showDevice
         ORDER BY devices.id DESC";
   }
}

$conn = new mysqli("localhost", "root", "", "it_db");
if ($conn->connect_error)
{
   die("Database connection failed: " . $conn->connect_error);
}

$result = $conn->query($sql);
if ($result->num_rows > 0)
{
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
   
   echo "<table name='devices' id='devices' class='devices'>
   <thead>
   <tr>
   <th>ID</th>
   <th>Name</th>
   <th>Device</th>
   <th>Manufacturer</th>
   <th>Model</th>
   <th>Category</th>
   <th>Inventory</th>
   <th>IP</th>
   <th>IP</th>
   <th>MAC</th>
   <th>BT</th>
   <th>SN</th>
   <th>IMEI1</th>
   <th>IMEI2</th>
   <th>PN</th>
   <th>Firmware</th>
   <th>Custodian</th>
   <th>{$cfgData['Location1']}</th>
   <th>{$cfgData['Location2']}</th>
   <th>Status</th>
   <th>Purchased</th>
   <th>Disposed</th>
   <th>Notes</th>
   </tr>
   </thead><tbody>";

   while ($row = $result->fetch_assoc())
   {
      echo "<tr>";

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
   echo "<p>No devices found.";
}
?>

</table>