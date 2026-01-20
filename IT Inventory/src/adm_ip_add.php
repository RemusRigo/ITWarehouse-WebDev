<!-------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         v20260116
//   add IP range form
-------------------------------------------------------------------------------------------------->

<form action="src/adm_ip_insert.php" method="post">
<table class="new_ip">
   <tr>
      <td><input type="text" name="octet1" placeholder="192" required> -</td>
      <td><input type="text" name="octet2" placeholder="168" required> -</td>
      <td><input type="text" name="octet3" placeholder="0" required> -</td>
      <td><input type="text" name="octet4from" placeholder="1" required> :</td>
      <td><input type="text" name="octet4to" placeholder="255" required></td>
   </tr>
</table>
   <p><button type="submit">Insert IP Range</button>
</form>

