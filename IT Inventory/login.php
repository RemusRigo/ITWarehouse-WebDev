<?php
//-------------------------------------------------------------------------------------------------
//   IT Inventory
//      © 2025 Remus Rigo
//         2025-12-17
//   Login

session_start();
$pdo = new PDO("mysql:host=localhost;dbname=it_db;charset=utf8", "root", "");
$username = $_POST['username'];
$password = $_POST['password'];
$stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password']))
{
   $_SESSION['user_id'] = $user['id'];
   $_SESSION['username'] = $user['username'];

   header("Location: index.php");
   exit;
}
else
{
   echo "Invalid username or password";
}

?>
