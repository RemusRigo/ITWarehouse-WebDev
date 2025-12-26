<?php
//-------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         2025-12-17
//   main page

session_start();

//-- check if user is logged --------------------------------------------------------------------->
if (isset($_SESSION['user_id'])):
   $loggedUser=htmlspecialchars($_SESSION['username']);

include 'src/header.php';
?>

<!-- Title --------------------------------------------------------------------------------------->
<div class="title-box">IT Inventory</div>

 
   <div class="user-box">Welcome <?php echo $loggedUser; ?> <a href="logout.php" style="font-size:8px;">Logout</a></div>

<!-- Main Menu ----------------------------------------------------------------------------------->
<?php include 'src/menu.php'; ?>

<!-- Show devices -------------------------------------------------------------------------------->
<?php
   if (isset($_GET['show']))
   {
      $showDevice=htmlspecialchars($_GET['show']);
      include 'src/show_devices.php';
   }
   else
   {
      if ($loggedUser=="admin")
      {
         if (isset($_GET['adm']))
         {
            switch (htmlspecialchars($_GET['adm']))
            {
               case "add_device":
                  include 'src/adm_device_add.php';
                  break;

                  default:
                     echo "Value not recognized";
            }
         }
      }
   }
?>

<?php else: ?>

   <!-- Show Login / user not logged in ---------------------------------------------------------->

   <div class="div-login">   
   <form action="login.php" method="POST">
   <table align=center border=0>
   <tr>
      <td><label>Username:</label></td>
      <td><input type="text" name="username" required></td>
   </tr>
   <tr>
      <td><label>Password:</label></td>
      <td><input type="password" name="password" required></td>
   </tr>
   <tr>
      <td colspan=2><button type="submit">Login</button></td>
   </tr>
   </table>
   </form>
   </div>
<?php endif; ?>

<?php include 'src/footer.php'; ?>