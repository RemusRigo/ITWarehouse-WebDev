<?php
//-------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         v20260303
//   menu
//-------------------------------------------------------------------------------------------------

echo "\n<ul>";
echo "<li>Devices";
echo "<ul>";
echo "<li><a href='index.php?show=all'>All</a></li>";
echo "<li class='sep'> </li>";

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
   echo "<li>Admin";
   echo "<ul>";
   echo "<li><a href='index.php?addDevice'>Add device</a></li>";
   echo "<li class='sep'></li>";
   echo "<li><a href='index.php?IP'>IP</a></li>";
   echo "</ul>";
   echo "</li>";
}      
echo "<li><a href='index.php?search'>Search</a></li>";
echo "</ul>";

?>