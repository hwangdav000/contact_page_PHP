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


$sql1 = "INSERT INTO tbl_contacts (contact_name, contact_email, contact_address, contact_phone,
          contact_favoriteplace, contact_favoriteplaceurl) VALUES ('Ruofeng Liu','liux4189@umn.edu', 'Keller Hall, Room 2-209','(612)625-4002', 'Coffman',
         'https://campusmaps.umn.edu/coffman-memorial-union');";

mysqli_query($con,$sql1);
echo "Row 1 inserted<br>";

$sql2 = "INSERT INTO tbl_contacts (contact_name, contact_email, contact_address, contact_phone,
          contact_favoriteplace, contact_favoriteplaceurl) VALUES ('Harshit Jain','jain0149@umn.edu', 'Digital Technology Center, Room 410','(612)624-9510', 'Blue Door Pub (Como Ave)',
         'https://www.google.com/maps/place/Blue+Door+Pub+University/@44.987642,-93.2319058,17z/data=!4m13!1m7!3m6!1s0x52b32d067b5b1d95:0xee88dc4ea05b2361!2s1514+Como+Ave+SE,+Minneapolis,+MN+55414!3b1!8m2!3d44.987608!4d-93.2297234!3m4!1s0x52b32d067c9e1729:0x37b768c113d903e3!8m2!3d44.987642!4d-93.2297118');";

mysqli_query($con,$sql2);
echo "Row 2 inserted<br>";


$sql3 = "INSERT INTO tbl_contacts (contact_name, contact_email, contact_address, contact_phone,
          contact_favoriteplace, contact_favoriteplaceurl) VALUES ('Yang He','he000242@umn.edu', 'Keller Hall, Room 2-209','(612)625-4123', 'Shepherd Labs',
         'http://campusmaps.umn.edu/shepherd-laboratories');";

mysqli_query($con,$sql3);
echo "Row 3 inserted<br>";



echo '<h1> Successfully Inserted Values into the Table </h1>'
?>
