<?php
//-------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         v20260211
//   add IP range form
//-------------------------------------------------------------------------------------------------

if ($_SERVER['REQUEST_METHOD'] === 'GET') // Send form data ---------------------------------------
{
   echo "<form action='src/ip.php' method='post'>
      <table class='new_ip'>
         <tr>
            <td><input type='text' name='octet1' placeholder='192' required> -</td>
            <td><input type='text' name='octet2' placeholder='168' required> -</td>
            <td><input type='text' name='octet3' placeholder='0' required> -</td>
            <td><input type='text' name='octet4from' placeholder='1' required> :</td>
            <td><input type='text' name='octet4to' placeholder='255' required></td>
         </tr>
      </table>
      <p><button type='submit'>Insert IP Range</button>
      </form>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') // Receive form data -----------------------------------
{
   // Read form data
   $octet1 = $_POST['octet1'];
   $octet2 = $_POST['octet2'];
   $octet3 = $_POST['octet3'];
   $octet4from = $_POST['octet4from'];
   $octet4to = $_POST['octet4to'];

   $pdo = new PDO("mysql:host=localhost;dbname=it_db", "root", "");
   $stmt = $pdo->prepare("INSERT INTO ip (IPv4) VALUES (:ip)");

   for ($i = $octet4from; $i <= $octet4to; $i++)
   {
      $ip = "$octet1.$octet2.$octet3.$i";
      $stmt->execute(['ip' => $ip]);
   }

   include 'src/go_back.php';
}

?>