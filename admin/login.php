<?php

include_once('../includes/connection.php');
$db=new Database();
$error='';





session_start();


if( isset( $_SESSION['userid'] ) ) {
  if( $_SESSION['type'] == 'admin' ) {
    header('Location: ' . PATH . '/admin');
  }         
  if( $_SESSION['type'] == 'customer' ) {
    header('Location: ' . PATH . '/customer' );
  }         
  exit();
}




if(isset($_POST['login'])){

	$username = $_POST['username'];
	$password = $_POST['password'];
	print_r($_POST);
  $stmnt='select * from admin where username = :username and password = :password';
  $params=array( 
   ':username'  =>  $username,
   ':password'  =>  $password
 );
  if($db->display($stmnt,$params)){
    
   $_SESSION['userid']=$username;
   $_SESSION['type']='admin';
   header('Location: dashbord.php');
   exit();
 }else{
   $error= 'Incorrect username or password';
 }
}



?>




<!DOCTYPE html>
<html>
<head>
  <title>User Login</title>
  
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo PATH; ?>/favicon.png">
  <link rel="stylesheet" type="text/css" href="../assets/styles.css">
  <script type="text/javascript" src="../assets/js-core.js"></script>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <form method="post" action="" data-parsley-validate="">
          <div class="content-box">
            <h3 class="content-box-header content-box-header-alt bg-default">
              <span class="icon-separator">
                <i class="glyph-icon icon-cog"></i>
              </span>
              <span class="header-wrapper">
                Login
                <small>Use the form below to login to your account.</small>
              </span>
            </h3>
            <div class="content-box-wrapper">
              <div class="form-group">
                <div class="input-group">
                  <input type="email" class="form-control" name="username" placeholder="Username" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <input type="submit" class="btn btn-success btn-block" name="login" value="Login">
                </div>
              </div>
              
              <?php 
              if ($error !=null) {
                echo '<div class="alert alert-danger">'.$error . '</div>';
              }


              ?>

              
            </div>
          </div>
        </form>
      </div>    
    </div>
    
  </div>
  

  <!-- JS Demo -->
  <script type="text/javascript" src="../assets/widgets/parsley/parsley.js"></script>
  <script type="text/javascript" src="../assets/admin-all-demo.js"></script>
</body>
</html>