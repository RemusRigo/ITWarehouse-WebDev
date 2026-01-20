<!-------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         v20260114
//   update device
-------------------------------------------------------------------------------------------------->

<?php
$pdo = new PDO("mysql:host=localhost;dbname=it_db;charset=utf8", "root", "");

// Insert NULL is value is empty
function EmptyToNull($val)
{
   return ($val === '' ? null : $val);
}

// Read form data
$id = EmptyToNull($_POST['id']);
$name = EmptyToNull($_POST['name']);
$device = EmptyToNull($_POST['device']);
$manufacturer = EmptyToNull($_POST['manufacturer']);
$model = EmptyToNull($_POST['model']);
$category_id = EmptyToNull($_POST['category_id']);
$inventory = EmptyToNull($_POST['inventory']);
$ip_id = EmptyToNull($_POST['ip_id']);
$mac = EmptyToNull($_POST['mac']);
$bt = EmptyToNull($_POST['bt']);
$sn = EmptyToNull($_POST['sn']);
$pn = EmptyToNull($_POST['pn']);
$firmware = EmptyToNull($_POST['firmware']);
$custodian = EmptyToNull($_POST['custodian']);
$location1 = EmptyToNull($_POST['location1']);
$location2 = EmptyToNull($_POST['location2']);
$purchased = EmptyToNull($_POST['purchased']);
$status_id = EmptyToNull($_POST['status_id']);
$disposed = EmptyToNull($_POST['disposed']);
$notes = EmptyToNull($_POST['notes']);

$sql = "UPDATE devices SET
    name = ?, device = ?,
    manufacturer = ?, model = ?, category_id = ?, inventory = ?,
    ip_id = ?, mac = ?, bt = ?, sn = ?, pn = ?, firmware = ?,
    custodian = ?, location1 = ?, location2 = ?,
    status_id = ?, purchased = ?, disposed = ?, notes = ?
    WHERE id = ?";

$stmt = $pdo->prepare($sql);

$stmt->execute([$name, $device, $manufacturer, $model, $category_id, $inventory, $ip_id, $mac, $bt, $sn, $pn, $firmware,
   $custodian, $location1, $location2, $status_id, $purchased, $disposed, $notes, $id]);

   include 'go_back2.php';
   exit;

?>
