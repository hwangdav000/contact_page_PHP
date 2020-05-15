<?php
  session_start();
  //  check if session has been logged in
  if(!isset($_SESSION["login"])) {
    // need to login
    header("location: http://www-users.cselabs.umn.edu/~hwan0259/login.php");
  }

  include_once 'database.php';
  $con=new mysqli($db_servername, $db_username, $db_password, $db_name);

  // Check connection
  if (mysqli_connect_errno()) {
    echo 'Failed to connect to MySQL:' . mysqli_connect_error();
  }
  $query_def = "SELECT * FROM tbl_contacts";
  // need to check if session var

  $result;

  //  check if post was done
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    global $result;
    $column=  $_POST['column'];
    //  get rid of all spacing for columns
    $column= str_replace(' ','',$column);
    //  just trim left and right sides
    $keyword= $_POST['keyword'];
    $keyword= trim($keyword);

    if (empty($column) || empty($keyword)) {

      // reset session vars
      unset($_SESSION['column']);
      unset($_SESSION['keyword']);
      $result = $con -> query($query_def);
    } else {

      //  have to make sure column is pointing to tbl_contacts
      //  get column, make sure it is lower case, remove zeros (getting weird case where it adds 0)
      $t_column = "contact_" . $column . +"";
      $t_column = strtolower($t_column);
      $t_column = preg_replace('/\d+/','', $t_column);

      $_SESSION['column'] = $t_column;
      $_SESSION['keyword'] = $keyword;
      // build SELECT query
      $query = "SELECT * FROM tbl_contacts WHERE " . $t_column . " like '%". $keyword . "%'";
      // check query
      //echo $query;
      //exit();

      $result = $con -> query($query);
    }

  //  no post was done go to default
  } else {

    //  check if sess var was saved
    if(isset($_SESSION['column']) and isset($_SESSION['keyword'])){
      $query_o = "SELECT * FROM tbl_contacts WHERE " . $_SESSION['column'] . " LIKE '%". $_SESSION['keyword'] . "%'";
      $result = $con -> query($query_o);
    } else {
      $result = $con -> query($query_def);
    }

  }

?>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
      .navbar {
        background-color: #563d7c;
      }
      .navbar-default .navbar-nav li a{
        color: #eee;
      }
      .navbar-default .navbar-nav li a:hover{
        color: white;
      }
      th, td{
        text-align: center;
      }
      thead {
        background-color: #e57373;
    color: white;
      }

       .p_nav {
          display: block;
          color: white;
          text-align: center;
          padding: 10px;
          text-decoration: underline;
          float: right;
          font-weight: bold;
      }
      .drop {
        all:none;

      }
    </style>

  </head>
  <body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
          <ul class="nav navbar-nav">
              <li><a class="p_nav" href = 'http://www-users.cselabs.umn.edu/~hwan0259/contacts.php'><b>Contacts Page</b></a></li>
              <li><a class="p_nav" href = 'http://www-users.cselabs.umn.edu/~hwan0259/logout.php'>
                  <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                  </a>
              </li>

          </ul>



        </div>
    </nav>
      <br><br>
      <div class="container">
          <table class="table" id="contactTable">
              <thead>
                  <tr>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Address</th>
                      <th scope="col">Phone Number</th>
                      <th scope="col">Favorite Place</th>
                  </tr>
              </thead>
              <tbody id = "mytbody" >

                <?php
                  // fetch each record in result set
                  while ( $row = mysqli_fetch_row( $result ) )
                  {
                     // build table to display results
                     print( "<tr>" );
                        // name
                        print( "<td>$row[1]</td>" );
                        // email
                        print( "<td>$row[2]</td>" );
                        // address
                        print( "<td>$row[3]</td>" );
                        // phone number
                        print( "<td>$row[4]</td>" );
                        // favorite place
                        print( "<td><a href = '$row[6]'>$row[5]</a></td>" );
                     print( "</tr>" );
                  } // end while

                ?>
              </tbody>
          </table>
          <br>
          <form method = "post" action = "">
             <p><b>Column Name:</b>
                <!-- add a select box containing options -->
                <!-- for SELECT query -->
                <select name = "column">
                   <option selected>Name</option>
                   <option>Email</option>
                   <option>Address</option>
                   <option>Phone</option>
                   <option>Favorite Place</option>
                </select></p>
              <br>
              <p><b>Contains: </b></p>
              <input type="text" class="form-control" placeholder ="Enter Keyword" name="keyword" maxlength="100">
              <br>
             <p><input type = "submit" value = "Filter"></p>
          </form>

  </body>
</html>
