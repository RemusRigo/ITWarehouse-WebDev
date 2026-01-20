<!-------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         v20260116
//   show devices
-------------------------------------------------------------------------------------------------->

<?php

if ($showDevice == "all")
{
   $sql = "
      SELECT
         devices.id, devices.name,
         devices.device, devices.manufacturer, devices.model, category.name AS category_name, devices.inventory,
         ip.IPv4 AS ip_id, devices.mac, devices.bt, devices.sn, devices.pn, devices.firmware,
         devices.custodian, devices.location1, devices.location2,
         status.name AS status_name, devices.purchased, devices.disposed,
         devices.notes
      FROM devices
      LEFT JOIN category ON devices.category_id = category.id
      LEFT JOIN ip ON devices.ip_id = ip.ID
      LEFT JOIN status ON devices.status_id = status.id
      ORDER BY devices.name ASC";
}
else
{
   // check if value is number and if it is in category range
   if (is_numeric($showDevice)) // && $showDevice >= 1 && $showDevice <= 9)
   {
      $sql = "
         SELECT
            devices.id, devices.name,
            devices.device, devices.manufacturer, devices.model, category.name AS category_name, devices.inventory,
            ip.IPv4 as ip_id, devices.mac, devices.bt, devices.sn, devices.pn, devices.firmware,
            devices.custodian, devices.location1, devices.location2,
            status.name AS status_name, devices.purchased, devices.disposed,
            devices.notes
         FROM devices
         LEFT JOIN category ON devices.category_id = category.id
         LEFT JOIN ip ON devices.ip_id = ip.ID
         LEFT JOIN status ON devices.status_id = status.id
         WHERE category_id = $showDevice
         ORDER BY devices.name ASC";
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
   echo "<table name=\"devices\" id=\"devices\" class=\"devices\">
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
   <th>MAC</th>
   <th>BT</th>
   <th>SN</th>
   <th>PN</th>
   <th>Firmware</th>
   <th>Custodian</th>
   <th>Production Line</th>
   <th>Workstation</th>
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
         echo "<td><a href=index.php?edit=" .htmlspecialchars($row['id']) . " class=\"nolink\">" . htmlspecialchars($row['id']) . "</td>";
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
      echo "<td>" . htmlspecialchars($row['ip_id']) . "</td>";
      echo "<td>" . htmlspecialchars($row['mac']) . "</td>";
      echo "<td>" . htmlspecialchars($row['bt']) . "</td>";
      echo "<td>" . htmlspecialchars($row['sn']) . "</td>";
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