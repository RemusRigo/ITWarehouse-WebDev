<!-------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         v20260114
//   main page 
-------------------------------------------------------------------------------------------------->
<?php

   session_start();

   // check if user is logged
   if (isset($_SESSION['user_id'])) {
      $loggedUser=htmlspecialchars($_SESSION['username']);
   }

   // HTML header
   include 'src/header.php';

// Login page -------------------------------------------------------------------------------------

   if (empty($_SESSION['user_id']))
   {
?>

<div class="div-login">   
  <form action="login.php" method="POST">
    <table align="center" border="0">
      <tr>
        <td><label for="username">Username:</label></td>
        <td><input id="username" type="text" name="username" required></td>
      </tr>
      <tr>
        <td><label for="password">Password:</label></td>
        <td><input id="password" type="password" name="password" required></td>
      </tr>
      <tr>
        <td colspan="2" class="actions">
          <button type="submit">Login</button>
        </td>
      </tr>
    </table>
  </form>
</div>

<?php
   }
   else
   {
?>

      <!--- build header section/menu --->
      <div class="header">
         <div class="menu"><?php include 'src/menu.php'; ?></div>
         <div class="title-box">IT Inventory</div>
         <div class="user-box">Welcome <?php echo $loggedUser; ?> <a href="logout.php" style="font-size:8px;">Logout</a></div>
      </div>

      <div class="content">

      <!-- Show devices -------------------------------------------------------------------------------->
<?php
   
      if (isset($_GET['show']))
      {
         $showDevice=htmlspecialchars($_GET['show']);
         include 'src/show_devices.php';
      }

      if ($loggedUser=="admin")
      {
         if (isset($_GET['adm']))
         {
            switch (htmlspecialchars($_GET['adm']))
            {
               case "add_device":
                  include 'src/adm_device_add.php';
                  break;

               case "ip":
                  include 'src/adm_ip_add.php';
                  break;

               default:
                  echo "Value not recognized";
            }
         }

         if (isset($_GET['edit']))
         {
           include 'src/adm_device_edit.php';
         }

      }
   }

   include 'src/footer.php';
?>