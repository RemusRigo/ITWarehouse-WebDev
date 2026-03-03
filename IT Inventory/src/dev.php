<?php
//-------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         v20260217
//   Add/Update device
//-------------------------------------------------------------------------------------------------

 
if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
   $pdo = new PDO("mysql:host=localhost;dbname=it_db;charset=utf8", "root", "");
   $newDevice = null;
   if (isset($_GET['addDevice']))
   {
      $newDevice = true;
   }
   if (isset($_GET['updateDevice']))
   {
      $newDevice = false;
   }

   if ($newDevice === false)
   {
      $id = $_GET['updateDevice'] ?? null;
      $stmt = $pdo->prepare("SELECT * FROM devices WHERE id = ?");
      $stmt->execute([$id]);
      $device = $stmt->fetch();
      if (!$device)
      {
         die("Device not found");
      }
   }

   $categories = $pdo->query("SELECT * FROM category ORDER BY name")->fetchAll();
   $statuses = $pdo->query("SELECT * FROM status ORDER BY name")->fetchAll();
   $ip_list = $pdo->query("SELECT * FROM ip ORDER BY ID")->fetchAll();
   $locations = $pdo->query("SELECT * FROM locations ORDER BY ID")->fetchAll();
   
   if (isset($_GET['addDevice']))
   {
      echo "<form action='src/dev.php?mode=add' method='post'>";
   }
   else if (isset($_GET['updateDevice']))
   {
      echo "<form action='src/dev.php?mode=update' method='post'>";
   }
   echo "<table class='new_device'>";
   if ($newDevice === false)
   {
      echo "<tr><td><label>ID</label></td><td><input type='text' name='id' value='". htmlspecialchars($device['id'])."' readonly></td></tr>";
   }
   echo "<tr><td><label>{$cfgData['Name']}</label></td><td><input type='text' name='name' value='". ($newDevice ? "'" : htmlspecialchars($device['name'])."' required")."></td></tr>";
   echo "<tr><td><label>{$cfgData['Device']}</label></td><td><input type='text' name='device' value='". ($newDevice ? "'" : htmlspecialchars($device['device']))."'></td></tr>";
   echo "<tr><td><label>{$cfgData['Manufacturer']}</label></td><td><input type='text' name='manufacturer' value='". ($newDevice ? "'" : htmlspecialchars($device['manufacturer']))."'></td></tr>";
   echo "<tr><td><label>{$cfgData['Model']}</label></td><td><input type='text' name='model' value='". ($newDevice ? "'" : htmlspecialchars($device['model']))."'></td></tr>";
   
   // Category
   echo "<tr><td><label>{$cfgData['Category']}</label></td><td>";
   echo "<select name='category_id' id='category'>";
   echo "<option value=''>-- Select category --</option>";
   foreach ($categories as $cat)
   {
      $selected = $cat['id'] == $device['category_id'] ? 'selected' : '';
      echo "<option value='". htmlspecialchars($cat['id']) . "' $selected>". htmlspecialchars($cat['name'])."</option>";
   }
   echo "</select>";
   echo "</td></tr>";
   
   echo "<tr><td><label>{$cfgData['Inventory']}</label></td><td><input type='text' name='inventory' value='". ($newDevice ? "'" : htmlspecialchars($device['inventory']))."'></td></tr>";
   
   // IP Address 1
   echo "<tr><td><label>{$cfgData['IP1']}</label></td><td>";
   echo "<select name='ip_id' id='ip'>";
   echo "<option value=''>-- Select IP --</option>";
   foreach ($ip_list as $ip)
   {
      $selected = $ip['ID'] == $device['ip_id'] ? 'selected' : '';
      echo "<option value='". htmlspecialchars($ip['ID']) . "' $selected>". htmlspecialchars($ip['IPv4'])."</option>";
   }
   echo "</select>";
   echo "</td></tr>";
   
   // IP is active
   echo "<tr><td><label>{$cfgData['IPActive']}</label></td><td><input type='hidden' name='ip_isactive' value='0'>";
   if ($newDevice === true)
   {
      echo "<input type='checkbox' name='ip_isactive' value='1'>";
   }
   if ($newDevice === false)
   {
	     echo "<input type='checkbox' name='ip_isactive' value='1'";
         if ($device['ip_isactive']) echo " checked";
         echo ">";
   }
   echo "</td></tr>";

   // IP Address 2
   echo "<tr><td><label>{$cfgData['IP2']}</label></td><td>";
   echo "<select name='ip2_id' id='ip'>";
   echo "<option value=''>-- Select IP --</option>";
   foreach ($ip_list as $ip)
   {
      $selected = $ip['ID'] == $device['ip2_id'] ? 'selected' : '';
      echo "<option value='". htmlspecialchars($ip['ID']) . "' $selected>". htmlspecialchars($ip['IPv4'])."</option>";
   }
   echo "</select>";
   echo "</td></tr>";

   echo "<tr><td><label>{$cfgData['MAC']}</label></td><td><input type='text' name='mac' value='". ($newDevice ? "'" : htmlspecialchars($device['mac']))."'></td></tr>";
   echo "<tr><td><label>{$cfgData['BT']}</label></td><td><input type='text' name='bt' value='". ($newDevice ? "'" : htmlspecialchars($device['bt']))."'></td></tr>";
   echo "<tr><td><label>{$cfgData['SN']}</label></td><td><input type='text' name='sn' value='". ($newDevice ? "'" : htmlspecialchars($device['sn']))."'></td></tr>";
   echo "<tr><td><label>{$cfgData['IMEI1']}</label></td><td><input type='text' name='IMEI1' value='". ($newDevice ? "'" : htmlspecialchars($device['IMEI1']))."'></td></tr>";
   echo "<tr><td><label>{$cfgData['IMEI2']}</label></td><td><input type='text' name='IMEI2' value='". ($newDevice ? "'" : htmlspecialchars($device['IMEI2']))."'></td></tr>";
   echo "<tr><td><label>{$cfgData['PN']}</label></td><td><input type='text' name='pn' value='". ($newDevice ? "'" : htmlspecialchars($device['pn']))."'></td></tr>";
   echo "<tr><td><label>{$cfgData['Firmware']}</label></td><td><input type='text' name='firmware' value='". ($newDevice ? "'" : htmlspecialchars($device['firmware']))."'></td></tr>";
   echo "<tr><td><label>{$cfgData['Custodian']}</label></td><td><input type='text' name='custodian' value='". ($newDevice ? "'" : htmlspecialchars($device['custodian']))."'></td></tr>";
   
   // Location 1
      echo "<tr><td><label>{$cfgData['Location1']}</label></td><td>";
   echo "<select name='location1' id='location1'>";
   echo "<option value=''>-- Select location1 --</option>";
   foreach ($locations as $location)
   {
      $selected = $location['id'] == $device['location1'] ? 'selected' : '';
      echo "<option value='". htmlspecialchars($location['id']) . "' $selected>". htmlspecialchars($location['name'])."</option>";
   }
   echo "</select>";
   echo "</td></tr>";
   
   
   echo "<tr><td><label>{$cfgData['Location2']}</label></td><td><input type='text' name='location2' value='". ($newDevice ? "'" : htmlspecialchars($device['location2']))."'></td></tr>";

   // Status
   echo "<tr><td><label>{$cfgData['Status']}</label></td><td>";
   echo "<select name='status_id' id='status'>";
   echo "<option value=''>-- Select category --</option>";
   foreach ($statuses as $status)
   {
      $selected = $status['id'] == $device['status_id'] ? 'selected' : '';
      echo "<option value='". htmlspecialchars($status['id']) . "' $selected>". htmlspecialchars($status['name'])."</option>";
   }
   echo "</select>";
   echo "</td></tr>";
   echo "<tr><td><label>{$cfgData['Purchased']}</label></td><td><input type='date' name='purchased' value='". ($newDevice ? "'" : htmlspecialchars($device['purchased']))."'></td></tr>";
   echo "<tr><td><label>{$cfgData['Disposed']}</label></td><td><input type='date' name='disposed' value='". ($newDevice ? "'" : htmlspecialchars($device['disposed']))."'></td></tr>";
   echo "<tr><td><label>{$cfgData['Notes']}</label></td><td><textarea name='notes' rows='4' value='". ($newDevice ? "'" : htmlspecialchars($device['notes']))."'></textarea></td></tr>";
   echo "</table>";

   if (isset($_GET['addDevice']))
   {
      echo "<p><button type='submit'>Add Device</button>";
   }
   else if (isset($_GET['updateDevice']))
   {
      echo "<p><button type='submit'>Update Device</button>";
   }

   echo "</form>";
}

//-------------------------------------------------------------------------------------------------
function AddDevice()
{
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
   $ip2 = EmptyToNull($_POST['ip2_id']);
   $ip_isactive = $_POST['ip_isactive'];
   $mac = EmptyToNull($_POST['mac']);
   $bt = EmptyToNull($_POST['bt']);
   $sn = EmptyToNull($_POST['sn']);
   $IMEI1 = EmptyToNull($_POST['IMEI1']);
   $IMEI2 = EmptyToNull($_POST['IMEI2']);
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
      ip_id, ip2_id, ip_isactive, mac, bt, sn, IMEI1, IMEI2, pn, firmware,
      custodian, location1, location2,
      status_id, purchased, disposed,
      notes)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
   ");

   $stmt->bind_param("sssssssssssssssssssssss",
      $name,
      $device,
      $manufacturer, $model, $category, $inventory,
      $ip, $ip2, $ip_isactive, $mac, $bt, $sn, $IMEI1, $IMEI2, $pn, $firmware,
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

   $stmt = null;
   $conn->close();
   include 'go_back.php';
}

//-------------------------------------------------------------------------------------------------
function UpdateDevice()
{
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
   $ip2_id = EmptyToNull($_POST['ip2_id']);
   $ip_isactive = $_POST['ip_isactive'];
   $mac = EmptyToNull($_POST['mac']);
   $bt = EmptyToNull($_POST['bt']);
   $sn = EmptyToNull($_POST['sn']);
   $IMEI1 = EmptyToNull($_POST['IMEI1']);
   $IMEI2 = EmptyToNull($_POST['IMEI2']);
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
      ip_id = ?, ip2_id = ?, ip_isactive = ?, mac = ?, bt = ?, sn = ?, IMEI1 = ?, IMEI2 = ?, pn = ?, firmware = ?,
      custodian = ?, location1 = ?, location2 = ?,
      status_id = ?, purchased = ?, disposed = ?, notes = ?
      WHERE id = ?";

   $stmt = $pdo->prepare($sql);
   
   $stmt->execute([$name, $device, $manufacturer, $model, $category_id, $inventory, $ip_id, $ip2_id, $ip_isactive, $mac, $bt, $sn, $IMEI1, $IMEI2, $pn, $firmware,
      $custodian, $location1, $location2, $status_id, $purchased, $disposed, $notes, $id]);

   $stmt = null;
   
   include 'go_back.php';
}

//-------------------------------------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
   if (isset($_GET['mode']))
   {
      if ($_GET['mode'] === 'add')
      {
         AddDevice();
      }

      if ($_GET['mode'] === 'update')
      {
         UpdateDevice();
      }
   }
}

?>