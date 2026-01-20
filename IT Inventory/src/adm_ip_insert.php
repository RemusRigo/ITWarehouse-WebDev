<!-------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         v20260116
//   insert IP into DB
-------------------------------------------------------------------------------------------------->

<?php

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

   sleep(3);
   header("Location: ../");

?>