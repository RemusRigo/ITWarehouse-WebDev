<!-------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         v20260114
//   menu
-------------------------------------------------------------------------------------------------->

   <ul>
      <li>Devices
         <ul>
            <li><a href="index.php?show=all">All</a></li>
            <li class="sep"> </li>

<?php
$conn = new mysqli("localhost", "root", "", "it_db");
if ($conn->connect_error)
{
   die("Database connection failed: " . $conn->connect_error);
}

$result = $conn->query('SELECT * FROM category;');
if ($result->num_rows > 0)
{
  while ($row = $result->fetch_assoc())
   {
      echo "<li><a href=\"index.php?show=". $row['id'] ."\">" .$row['name']. "</a></li>";
   }
}

?>
         </ul>
      </li>
<?php if( $loggedUser=="admin" ): ?>
      <li>Admin
         <ul>
            <li><a href="index.php?adm=add_device">Add device</a></li>
            <li><a href="index.php?edit=x">Edit device</a></li>
            <li class="sep"></li>
            <li><a href="index.php?adm=ip">IP</a></li>
         </ul>
      </li>
<?php endif; ?>
      <li>Search</li>
   </ul>
