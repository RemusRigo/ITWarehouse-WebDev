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
   if (is_numeric($showDevice))
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
   
   echo "\n<table name='devices' id='devices' class='devices'>";
   echo "<thead>";
   echo "\n<tr>";
   echo "<th>ID</th>";
   echo "<th>{$cfgData['Name']}</th>";
   echo "<th>{$cfgData['Device']}</th>";
   echo "<th>{$cfgData['Manufacturer']}</th>";
   echo "<th>{$cfgData['Model']}</th>";
   echo "<th>{$cfgData['Category']}</th>";
   echo "<th>{$cfgData['Inventory']}</th>";
   echo "<th>{$cfgData['IP1']}</th>";
   echo "<th>{$cfgData['IP2']}</th>";
   echo "<th>{$cfgData['MAC']}</th>";
   echo "<th>{$cfgData['BT']}</th>";
   echo "<th>{$cfgData['SN']}</th>";
   echo "<th>{$cfgData['IMEI1']}</th>";
   echo "<th>{$cfgData['IMEI2']}</th>";
   echo "<th>{$cfgData['PN']}</th>";
   echo "<th>{$cfgData['Firmware']}</th>";
   echo "<th>{$cfgData['Custodian']}</th>";
   echo "<th>{$cfgData['Location1']}</th>";
   echo "<th>{$cfgData['Location2']}</th>";
   echo "<th>{$cfgData['Status']}</th>";
   echo "<th>{$cfgData['Purchased']}</th>";
   echo "<th>{$cfgData['Disposed']}</th>";
   echo "<th>{$cfgData['Notes']}</th>";
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
