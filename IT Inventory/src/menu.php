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
            <li><a href="index.php?show=1">Access Point</a></li>
            <li><a href="index.php?show=2">Camera</a></li>
            <li><a href="index.php?show=3">Mobile Computer</a></li>
            <li><a href="index.php?show=4">Mobile Printer</a></li>
            <li><a href="index.php?show=5">Printer</a></li>
            <li><a href="index.php?show=6">Projector</a></li>
            <li><a href="index.php?show=7">Scanner</a></li>
            <li><a href="index.php?show=8">Thermal Printers</a></li>
            <li><a href="index.php?show=9">UPS</a></li>
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