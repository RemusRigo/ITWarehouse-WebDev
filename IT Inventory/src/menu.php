<?php
//-------------------------------------------------------------------------------------------------
//   IT Inventory
//      (c) 2025 Remus Rigo
//         2025-12-16
//   menu
?>

<div class="menu">
   <ul>
      <li>Devices
         <ul>
            <li><a href="index.php?show=all">All</a></li>
            <li class="sep"> </li>
            <li><a href="index.php?show=ap">Access Point</a></li>
            <li><a href="index.php?show=camera">Camera</a></li>
            <li><a href="index.php?show=pc_mob">Mobile Computer</a></li>
            <li><a href="index.php?show=prn_mob">Mobile Printer</a></li>
            <li><a href="index.php?show=prn">Printer</a></li>
            <li><a href="index.php?show=projector">Projector</a></li>
            <li><a href="index.php?show=scanner">Scanner</a></li>
            <li><a href="index.php?show=prn_th">Thermal Printers</a></li>
            <li><a href="index.php?show=ups">UPS</a></li>
         </ul>
      </li>
<?php if( $loggedUser=="admin" ): ?>
      <li>Admin
         <ul>
            <li><a href="index.php?adm=add_device">Add device</a></li>
            <li class="sep"></li>
         </ul>
      </li>
<?php endif; ?>
   </ul>
</div>