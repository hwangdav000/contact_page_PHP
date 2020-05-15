<?php
  //  check if session has started
  session_start();
  if(isset($_SESSION["login"])) {
    // session already logged in
    header("location: http://www-users.cselabs.umn.edu/~hwan0259/contacts.php");
  }

  include_once 'database.php';
  $con=new mysqli($db_servername, $db_username, $db_password, $db_name);

  // Check connection
  if (mysqli_connect_errno())
    {
    echo 'Failed to connect to MySQL:' . mysqli_connect_error();
    }

  //  get back username and password from post data
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username=  $_POST['username'];
    $username= trim($username);
    $password= $_POST['password'];
    $password= trim($password);
    //  check if password or username is empty

    if (empty($username) || empty($password)) {
      $error = "username or password empty";
      $_SESSION['error'] = $error;
      //  redirect back to login form need to end session
      header("location: http://www-users.cselabs.umn.edu/~hwan0259/login.php");
      $conn->close();
    }
    $pass_hash= base64_encode(hash("sha256",$password,True));
    $mysql = "SELECT * FROM tbl_accounts WHERE acc_login = '$username' and acc_password = '$pass_hash'";

    $res = mysqli_query($con, $mysql);
    $count = $res -> num_rows;

    if($count > 0) {

      $_SESSION['login'] = $username;

      header("location: http://www-users.cselabs.umn.edu/~hwan0259/contacts.php");
      $conn->close();
    } else {
      //  go back
      $error = "username or password incorrect";
      $_SESSION['error'] = $error;
      header("location: http://www-users.cselabs.umn.edu/~hwan0259/login.php");
      $conn->close();
    }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	    <title>Welcome to Node.js</title>
  </head>

  <body>
   	<div class="jumbotron" style="background: DarkSeaGreen !important">
        <h1>Login Page</h1>
        <p>Please enter your name and password. Both are case sensitive</p>
        <br/>

      </div>

      <div class="row">
        <div class="col-md-1"></div>
        <form name="sendLoginDetails" id="form1" method="post" action="">
          <div class="col-md-10" id= 'validate_fail' style="color:red">

          </div>
          <div class="col-md-10">
            <p>User:</p>
            <input type="text" class="form-control" name="username" placeholder = "Username" required maxlength="100">
          </div>
          <div class="col-md-10">
            <p>Password:</p>
            <input type="password" class="form-control" name="password" placeholder = "Password" required maxlength="100">
          </br>
          </div>
          <div class="col-md-10">
            <input type="submit" form="form1" class="btn btn-primary btn-block" value="Log In">
          </div>
          <div class="col-md-1"></div>
        </form>
      </div>
  </body>
</html>
