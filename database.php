<?php
$xml=simplexml_load_file("dbconfig.xml");
if ($xml ===FALSE) {
  echo 'File not found';

} else {
  //echo 'processing';
}
// $con= mysqli_connect('localhost','root','','phpDB','3306');
$db_servername = $xml -> host;
$db_username = $xml-> user;
$db_password =$xml-> password;
$db_name = $xml -> database;
?>
