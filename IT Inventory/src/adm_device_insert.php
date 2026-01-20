<!-------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         v20260116
//   add device - insert into DB
-------------------------------------------------------------------------------------------------->

<?php

$conn = new mysqli("localhost", "root", "", "it_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert NULL is value is empty
function EmptyToNull($val)
{
   return ($val === '' ? null : $val);
}

// Read form data
$name = EmptyToNull($_POST['name']);
$device = EmptyToNull($_POST['device']);
$manufacturer = EmptyToNull($_POST['manufacturer']);
$model = EmptyToNull($_POST['model']);
$category = EmptyToNull($_POST['category_id']);
$inventory = EmptyToNull($_POST['inventory']);
$ip = EmptyToNull($_POST['ip_id']);
$mac = EmptyToNull($_POST['mac']);
$bt = EmptyToNull($_POST['bt']);
$sn = EmptyToNull($_POST['sn']);
$pn = EmptyToNull($_POST['pn']);
$firmware = EmptyToNull($_POST['firmware']);
$custodian = EmptyToNull($_POST['custodian']);
$location1 = EmptyToNull($_POST['location1']);
$location2 = EmptyToNull($_POST['location2']);
$purchased = EmptyToNull($_POST['purchased']);
$status = EmptyToNull($_POST['status_id']);
$disposed = EmptyToNull($_POST['disposed']);
$notes = EmptyToNull($_POST['notes']);

// SQL statement
$stmt = $conn->prepare("INSERT INTO devices (
   name,
   device,
   manufacturer, model, category_id, inventory,
   ip_id, mac, bt, sn, pn, firmware,
   custodian, location1, location2,
   status_id, purchased, disposed,
   notes)
   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$stmt->bind_param("sssssssssssssssssss",
   $name,
   $device,
   $manufacturer, $model, $category, $inventory,
   $ip, $mac, $bt, $sn, $pn, $firmware,
   $custodian, $location1, $location2,
   $status, $purchased, $disposed,
   $notes);

if ($stmt->execute())
{
   echo "Device added successfully.";
}
else
{
   echo "Error: " . $stmt->error;
}

echo "<p>Returning to the previous page in <span id='countdown'>3</span> seconds…</p>";
echo "<script>
   let seconds = 3;
   const countdown = document.getElementById('countdown');
   const timer = setInterval(() =>
   {
      seconds--;
      countdown.textContent = seconds;
      if (seconds <= 0)
      {
         clearInterval(timer);
         history.back(); // Go back to the previous page
      }
   }, 1000);
</script>";


$stmt->close();
$conn->close();
?>
