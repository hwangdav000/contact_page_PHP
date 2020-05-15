<?php
// $con= mysqli_connect('localhost','root','','phpDB','3306');
include_once 'database.php';
$con=new mysqli($db_servername, $db_username, $db_password, $db_name);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Create table
$sql="CREATE TABLE tbl_contacts(contact_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                       contact_name VARCHAR(30),
                                       contact_email VARCHAR(30),
                                       contact_address VARCHAR(80),
				                               contact_phone VARCHAR(30),
                                       contact_favoriteplace VARCHAR(30),
                                       contact_favoriteplaceurl VARCHAR(1024))";

// Execute query
if (mysqli_query($con,$sql))
  {
  echo "<h1> Table tbl_contacts created successfully </h1>";
  }
else
  {
  echo "<h1> Error creating table: <h1>" . mysqli_error($con);
  }

mysqli_close($con);

?>
