<?php
$password = "E3d3c3r4f4v4";
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
echo $hashedPassword;
?>
