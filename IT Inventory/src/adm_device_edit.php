<!-------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         v20260114
//   edit device form
-------------------------------------------------------------------------------------------------->

<?php

$id = $_GET['edit'] ?? null;
if ($id === null)
{
   echo "Missing edit parameter";
   exit;
}
else
{
   if ($id == "x")
   {
      echo "<form action=\"./src/adm_device_edit_redirect.php\" method=\"post\">
      <input type=\"text\" name=\"id\" placeholder=\"Enter device ID\">
      <button type=\"submit\">Send</button>
      </form>";
   }
}

$pdo = new PDO("mysql:host=localhost;dbname=it_db;charset=utf8", "root", "");

$stmt = $pdo->prepare("SELECT * FROM devices WHERE id = ?");
$stmt->execute([$id]);
$device = $stmt->fetch();

if (!$device)
{
   die("Device not found");
}

$categories = $pdo->query("SELECT * FROM category ORDER BY name")->fetchAll();
$statuses = $pdo->query("SELECT * FROM status ORDER BY name")->fetchAll();
$ip_list = $pdo->query("SELECT * FROM ip ORDER BY ID")->fetchAll();

?>

<form action="src/adm_device_update.php" method="post">
<table class="new_device">
   <tr><td><label>ID</label></td><td><input type="text" name="id" value="<?= htmlspecialchars($device['id']) ?>" readonly></td></tr>
   <tr><td><label>Name</label></td><td><input type="text" name="name" value="<?= htmlspecialchars($device['name']) ?>" required></td></tr>
   <tr><td><label>Device</label></td><td><input type="text" name="device" value="<?= htmlspecialchars($device['device']) ?>"></td></tr>
   <tr><td><label>Manufacturer</label></td><td><input type="text" name="manufacturer" value="<?= htmlspecialchars($device['manufacturer']) ?>"></td></tr>
   <tr><td><label>Model</label></td><td><input type="text" name="model" value="<?= htmlspecialchars($device['model']) ?>"></td></tr>

   <tr><td><label>Category</label></td><td>
   <select name="category_id" id="category">
      <option value="">-- Select category --</option>
      <?php foreach ($categories as $cat): ?>
         <option value="<?= $cat['id'] ?>"
            <?= $cat['id'] == $device['category_id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($cat['name']) ?>
         </option>
      <?php endforeach; ?>
   </select>
   </td></tr>

   <tr><td><label>Inventory</label></td><td><input type="text" name="inventory" value="<?= htmlspecialchars($device['inventory']) ?>"></td></tr>

   <tr><td><label>IP Address</label></td><td>
   <select name="ip_id" id="ip">
      <option value="">-- Select IP --</option>
      <?php foreach ($ip_list as $ip): ?>
         <option value="<?= $ip['ID'] ?>"
            <?= $ip['ID'] == $device['ip_id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($ip['IPv4']) ?>
         </option>
      <?php endforeach; ?>
   </select>
   </td></tr>

   <tr><td><label>MAC Address</label></td><td><input type="text" name="mac" value="<?= htmlspecialchars($device['mac']) ?>"></td></tr>
   <tr><td><label>BT</label></td><td><input type="text" name="bt" value="<?= htmlspecialchars($device['bt']) ?>"></td></tr>
   <tr><td><label>Serial Number (SN)</label></td><td><input type="text" name="sn" value="<?= htmlspecialchars($device['sn']) ?>"></td></tr>
   <tr><td><label>Part Number (PN)</label></td><td><input type="text" name="pn" value="<?= htmlspecialchars($device['pn']) ?>"></td></tr>
   <tr><td><label>Firmware</label></td><td><input type="text" name="firmware" value="<?= htmlspecialchars($device['firmware']) ?>"></td></tr>
   <tr><td><label>Custodian</label></td><td><input type="text" name="custodian" value="<?= htmlspecialchars($device['custodian']) ?>"></td></tr>
   <tr><td><label>Production Line</label></td><td><input type="text" name="location1" value="<?= htmlspecialchars($device['location1']) ?>"></td></tr>
   <tr><td><label>Workstation</label></td><td><input type="text" name="location2" value="<?= htmlspecialchars($device['location2']) ?>"></td></tr>

   <tr><td><label>Status</label></td><td>
   <select name="status_id" id="status">
      <option value="">-- Select category --</option>
      <?php foreach ($statuses as $status): ?>
         <option value="<?= $status['id'] ?>"
            <?= $status['id'] == $device['status_id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($status['name']) ?>
         </option>
      <?php endforeach; ?>
   </select>
   </td></tr>

   <tr><td><label>Purchased</label></td><td><input type="date" name="purchased" value="<?= htmlspecialchars($device['purchased']) ?>"></td></tr>
   <tr><td><label>Disposed</label></td><td><input type="date" name="disposed" value="<?= htmlspecialchars($device['disposed']) ?>"></td></tr>
   <tr><td><label>Notes</label></td><td><textarea name="notes" rows="4" value="<?= htmlspecialchars($device['notes']) ?>"></textarea></td></tr>
</table>
   <p><button type="submit">Update Device</button>
</form>

