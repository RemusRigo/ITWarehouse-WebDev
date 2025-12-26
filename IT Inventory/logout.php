<?php
//-------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         2025-12-17
//   Logout

session_start();
session_destroy();
header("Location: index.php");
exit;

?>