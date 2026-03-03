<?php
//-------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         v20260211
//   menu
//-------------------------------------------------------------------------------------------------

echo "<ul>
      <li>Devices
         <ul>
            <li><a href='index.php?show=all'>All</a></li>
            <li class='sep'> </li>";


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
      echo "<li><a href='index.php?show=". $row['id'] ."'>" .$row['name']. "</a></li>";
   }
}

echo "</ul></li>";

if( $loggedUser=="admin" )
{   
   echo "<li>Admin
         <ul>
            <li><a href='index.php?addDevice'>Add device</a></li>
            <li class='sep'></li>
            <li><a href='index.php?IP'>IP</a></li>
         </ul>
      </li>";
}      
echo "<li><a href='index.php?search'>Search</a></li>
     </ul>";

?>