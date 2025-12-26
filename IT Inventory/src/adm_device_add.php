<?php
// connect to DB
$pdo = new PDO("mysql:host=localhost;dbname=it_db;charset=utf8", "root", "");

// Fetch categories
$stmt_cat = $pdo->query("SELECT id, name FROM category ORDER BY name ASC");
$categories = $stmt_cat->fetchAll(PDO::FETCH_ASSOC);

// Fetch categories
$stmt_status = $pdo->query("SELECT id, name FROM status ORDER BY id ASC");
$statuses = $stmt_status->fetchAll(PDO::FETCH_ASSOC);

?>

<form action="adm_device_insert.php" method="post">
<table class="new_device">
   <tr><td><label>Name</label></td><td><input type="text" name="name" required></td></tr>
   <tr><td><label>Device</label></td><td><input type="text" name="device"></td></tr>
   <tr><td><label>Manufacturer</label></td><td><input type="text" name="manufacturer"></td></tr>
   <tr><td><label>Model</label></td><td><input type="text" name="model"></td></tr>
   <tr><td><label>Type</label></td><td><input type="text" name="type"></td></tr>

   <tr><td><label>Category</label></td><td>
   <select name="category_id" id="category">
      <option value="">-- Select category --</option>
      <?php foreach ($categories as $cat): ?>
         <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
      <?php endforeach; ?>
   </select>
   </td></tr>

   <tr><td><label>Inventory</label></td><td><input type="text" name="inventory"></td></tr>
   <tr><td><label>IP Address</label></td><td><input type="text" name="ip" placeholder="192.168.001.010" pattern="^[0-9]{1,3}(\.[0-9]{1,3}){3}$"></td></tr>
   <tr><td><label>MAC Address</label></td><td><input type="text" name="mac" placeholder="AA:BB:CC:DD:EE:FF" pattern="^([A-Fa-f0-9]{2}:){5}[A-Fa-f0-9]{2}$"></td></tr>
   <tr><td><label>BT</label></td><td><input type="text" name="bt"></td></tr>
   <tr><td><label>Serial Number (SN)</label></td><td><input type="text" name="sn"></td></tr>
   <tr><td><label>Part Number (PN)</label></td><td><input type="text" name="pn"></td></tr>
   <tr><td><label>Firmware</label></td><td><input type="text" name="firmware"></td></tr>
   <tr><td><label>Production Line</label></td><td><input type="text" name="location1"></td></tr>
   <tr><td><label>Workstation</label></td><td><input type="text" name="location2"></td></tr>

   <tr><td><label>Status</label></td><td>
   <select name="status_id" id="status">
      <option value="">-- Select category --</option>
      <?php foreach ($statuses as $status): ?>
         <option value="<?= $status['id'] ?>"><?= htmlspecialchars($status['name']) ?></option>
      <?php endforeach; ?>
   </select>
   </td></tr>

   <tr><td><label>Purchased</label></td><td><input type="date" name="purchased"></td></tr>
   <tr><td><label>Disposed</label></td><td><input type="date" name="disposed"></td></tr>
   <tr><td><label>Notes</label></td><td><textarea name="notes" rows="4"></textarea></td></tr>
</table>
   <p><button type="submit">Save Device</button>
</form>

