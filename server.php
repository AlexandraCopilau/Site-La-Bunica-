<?php
ob_start();

session_start();

// initializing variables
$username = "";
$password = "";
$email    = "";

  $add_nume="";
  $add_cod="";
  $add_pret="";
  $add_imagine="";
  
  
//errors variable
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'login');
if(!$db) {
    die("Connection failed: ".mysqli_connect_error());
}
 
//Admin add items
if(isset($_POST['add_item'])) {

  //receive all input from the form
  $add_nume = mysqli_real_escape_string($db, $_POST['m_nume']);
  $add_cod = mysqli_real_escape_string($db, $_POST['m_cod']);
  $add_pret = mysqli_real_escape_string($db, $_POST['m_pret']);
  $add_imagine = mysqli_real_escape_string($db, $_POST['m_imagine']);
          

  if (empty($m_nume)) { array_push($errors, "Name is required"); }
  if (empty($m_cod)) { array_push($errors, "Code is required"); }
  if (empty($m_pret)) { array_push($errors, "Price is required"); }
  if (empty($m_imagine)) { array_push($errors, "Image is required"); }
  

  $user_check_query1 = "SELECT * FROM martisoare WHERE nume='$add_nume' LIMIT 1";
  $con = mysqli_query($db, $user_check_query1);
  $titlu = mysqli_fetch_assoc($con);

  if ($titlu) { // if titlu exists
    if ($titlu['m_nume'] == $add_nume) {
      array_push($errors, "Name already exists");
    }
  }

    $sql2 = "INSERT INTO martisoare (nume, cod, pret,imagine) 
  			  VALUES('$add_nume', '$add_cod', '$add_pret' , '$add_imagine')";
    mysqli_query($db, $sql2);
  	header('location: admin.php');
}


// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: sapt9.php');
  }
}

if(isset($_POST['reg_exit']))
    {
        //exit for main page
	    header('location: sapt9.php');
    }

// ... 
// ... 

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
      array_push($errors, "Username is required");
  }
  if (empty($password)) {
      array_push($errors, "Password is required");
  }


if(isset($_SESSION['username']))
array_push($errors, "A user is already logged in!");

  if (count($errors) == 0) {
      $password = md5($password);
      $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
      $results = mysqli_query($db, $query);
      if (mysqli_num_rows($results) == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: sapt9.php');
      }else {
          array_push($errors, "Wrong username/password combination");
      }
  }
}

//LOGOUT

if(isset($_POST['logout_user']))
{
if(isset($_SESSION['username']))
	array_push($errors, "No user logged in");
unset($_SESSION['username']);
unset($_SESSION['succes']);

header('location: sapt9.php');
	
}



if(isset($_POST['exit_user']))
{
	header('location: sapt9.php');
}



function saveItems($db,$itName, $itQuant, $itPrice) {
  if(isset($_POST['save_item']))
    { 
      $shopping_cart = array();
      //foreach($shopping_cart as $keys => $values) {
       for($x=0; $x<count($itName); $x++) {

      $things1=$_SESSION['username'];
      $things2=$itName[$x];//$values["item_name"];
      $things3=$itQuant[$x];//$values["item_quantity"];
      $things4=$itPrice[$x];//$values["item_price"];

      $sql1 = "INSERT INTO comenzi ( c_client, c_produs, c_cant,c_pret) VALUES ('$things1', '$things2', '$things3', '$things4')";
      if ($db->query($sql1) == FALSE) {
               // array_push($errors, "Something went wrong with adding things !");
      }
          else {  unset($_SESSION['shopping_cart']);
                  header('location: cos.php');
          }
	    
    }
  }
}
  
  


function getTotal()
{
  echo $_SESSION['total'];
}
  
  
  
  
  // initialize variables
$name = "";
$address = "";
$var1 = "";
$var2 = "";
$var3 = "";

$id = 0;
$update = false;

if (isset($_POST['save'])) {
  $name = $_POST['nume'];
  $address = $_POST['cod'];
  $var2 = $_POST['pret'];
  $var3 = $_POST['imagine'];
  

  mysqli_query($db, "INSERT INTO martisoare (nume, cod,pret, imagine) VALUES ('$name', '$address', '$var2', '$var3')"); 
  $_SESSION['message'] = "Martisor salvat!"; 
  header('location: admin.php');
}

if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $name = $_POST['nume'];
  $address = $_POST['cod'];
  $var2 = $_POST['pret'];
  $var3 = $_POST['imagine'];

  mysqli_query($db, "UPDATE martisoare SET nume='$name', cod='$address', pret='$var2', imagine='$var3' WHERE id=$id");
  $_SESSION['message'] = "Martisor adaugat!"; 
  header('location: admin.php');
}

if (isset($_GET['del'])) {
  $id = $_GET['del'];
  mysqli_query($db, "DELETE FROM martisoare WHERE id=$id");
  $_SESSION['message'] = "Martisor sters!"; 
  header('location: admin.php');
}
  

  
  
   
  