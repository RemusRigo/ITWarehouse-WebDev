<?php
//-------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         v20260303
//   main page 
//-------------------------------------------------------------------------------------------------


session_start();


// check if user is logged
if (isset($_SESSION['user_id'])) {
   $loggedUser=htmlspecialchars($_SESSION['username']);
}

// HTML header
include 'src/header.php';

// build header section/menu

echo "<div class='header'>";
   // is user is logged, build menu
   if (!empty($_SESSION['user_id']))
   {
      echo "<div class='menu'>";
      include 'src/menu.php';
      echo "</div>";
      echo "<div>IT Inventory</div>";
      echo "<div>Welcome ";
      echo $loggedUser;
      echo "<a href='logout.php' style='font-size:8px;'>Logout</a></div>";
   }
   else
   {
      echo "<div></div><div>IT Inventory</div><div></div>";
   }
echo "</div>";

echo "<div class='content'>";

// Receive form data -----------------------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
   echo "POST";
}
// Receive form data -----------------------------------------------------------------------------------
else if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
   if (empty($_SESSION['user_id']))
   {
      echo"
      <div class='div-login'>   
        <form action='login.php' method='POST'>
          <table align='center' border='0'>
            <tr>
              <td><label for='username'>Username:</label></td>
              <td><input id='username' type='text' name='username' required></td>
            </tr>
            <tr>
              <td><label for='password'>Password:</label></td>
              <td><input id='password' type='password' name='password' required></td>
            </tr>
            <tr>
              <td colspan='2' class='actions'>
                <button type='submit'>Login</button>
              </td>
            </tr>
          </table>
        </form>
      </div>";
   }
   else
   {
      // check language
      if (isset($_GET['lang']))
      {
         $config = json_decode(file_get_contents('json/config.json'), true);
         $config['language'] = $_GET['lang'];
         file_put_contents('json/config.json', json_encode($config, JSON_PRETTY_PRINT));
         $back = $_SERVER['HTTP_REFERER'] ?? 'index.php';
         header("Location: $back");
      }
      
      // process other params individually
      $action=null;
      foreach (['addDevice','updateDevice','edit','IP','search'] as $key)
      {
         if (isset($_GET[$key]))
         {
            $action=$key;
            break;
         }
      }

      switch ($action)
      {
         case 'addDevice':
         case 'updateDevice':
            include 'src/dev.php';
            break;

         case 'IP':
            include 'src/ip.php';
            break;
      }
      
      if (isset($_GET['cat']))
      {
         $showCat=htmlspecialchars($_GET['cat']);
         include 'src/show.php';
      }
   }
}
else
{
   echo "unknown";
}
   include 'src/footer.php';
?>