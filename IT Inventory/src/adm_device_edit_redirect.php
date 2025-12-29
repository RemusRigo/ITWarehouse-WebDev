<?php
//-------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         2025-12-28
//   add device form

$id = $_POST['id'] ?? null;
echo $id;
header("Location: ../index.php?edit=$id");
?>