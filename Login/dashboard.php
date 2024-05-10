<?php


// Concatenate the password with the static salt
$hashed_password =
base64_encode("admin");

$hhh=base64_encode($hashed_password);
echo $hashed_password;
echo "<br>";
echo $hhh;
$jjj=base64_decode($hhh);

$kkk= base64_decode($jjj);
echo "<br>";

echo $jjj;
echo "<br>";
echo $kkk;
?>
<?php
$password = "admin";

// Hash the password using MD5
$hashed_password = md5($password);

// Display the hashed password
echo "Hashed password: $hashed_password<br>";
?>
