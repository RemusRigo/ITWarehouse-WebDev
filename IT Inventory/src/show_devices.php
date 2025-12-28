<?php
//-------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         2025-12-23
//   show devices
?>

<?php

if ($showDevice == "all")
{
   $sql = "
      SELECT
         d.id, d.name,
         d.device, d.manufacturer, d.model,
         c.name AS category_name,
         d.inventory,
         d.ip, d.mac, d.bt,
         d.sn, d.pn,
         d.firmware,
         d.location1, d.location2,
         s.name AS status_name,
         d.purchased, d.disposed,
         d.notes
      FROM devices d
      LEFT JOIN category c ON d.category_id = c.id
      LEFT JOIN status s ON d.status_id = s.id
      ORDER BY d.name ASC";
}
else
{
   // check if value is number and if it is in category range
   if (is_numeric($showDevice) && $showDevice >= 1 && $showDevice <= 9)
   {
      $sql = "
         SELECT
            d.id, d.name,
            d.device, d.manufacturer, d.model,
            c.name AS category_name,
            d.inventory,
            d.ip, d.mac, d.bt,
            d.sn, d.pn,
            d.firmware,
            d.location1, d.location2,
            s.name AS status_name,
            d.purchased, d.disposed,
            d.notes
         FROM devices d
         LEFT JOIN category c ON d.category_id = c.id
         LEFT JOIN status s ON d.status_id = s.id
         WHERE category_id = $showDevice
         ORDER BY d.name ASC";
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
   <th>Categoty</th>
   <th>Inventory</th>
   <th>IP</th>
   <th>MAC</th>
   <th>BT</th>
   <th>SN</th>
   <th>PN</th>
   <th>Firmware</th>
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
      echo "<td>" . htmlspecialchars($row['id']) . "</td>";
      echo "<td>" . htmlspecialchars($row['name']) . "</td>";
      echo "<td>" . htmlspecialchars($row['device']) . "</td>";
      echo "<td>" . htmlspecialchars($row['manufacturer']) . "</td>";
      echo "<td>" . htmlspecialchars($row['model']) . "</td>";
      echo "<td>" . htmlspecialchars($row['category_name']) . "</td>";
      echo "<td>" . htmlspecialchars($row['inventory']) . "</td>";
      echo "<td>" . htmlspecialchars($row['ip']) . "</td>";
      echo "<td>" . htmlspecialchars($row['mac']) . "</td>";
      echo "<td>" . htmlspecialchars($row['bt']) . "</td>";
      echo "<td>" . htmlspecialchars($row['sn']) . "</td>";
      echo "<td>" . htmlspecialchars($row['pn']) . "</td>";
      echo "<td>" . htmlspecialchars($row['firmware']) . "</td>";
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