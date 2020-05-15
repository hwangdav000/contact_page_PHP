<?php
error_reporting(E_ALL);
ini_set( 'display_errors','1');
include_once 'database.php';
$con=new mysqli($db_servername, $db_username, $db_password, $db_name);
// Check connection
if (mysqli_connect_errno())
{
  echo 'Failed to connect to MySQL:' . mysqli_connect_error();
}

//You can replace the strings below with whatever passwords you would like
$name = "charlie";
$login = "charlie";
$password = 'tango';

//NOTE, you can have more account names and logins than 2, but you need at least 1
mysqli_query($con,"INSERT INTO tbl_accounts (acc_name, acc_login, acc_password) VALUES ('".$name."','".$login."','". base64_encode(hash("sha256",$password,True))."');");
mysqli_close($con);

echo '<h1> Successfully Inserted Values into the Table </h1>'
?>
