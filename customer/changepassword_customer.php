<?php 
include_once( '../header.php' );
$db=new Database();
$message='';

if(isset($_POST['login'])) {
  print_r($_POST);

  $current_password = md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $re_password = md5($_POST['re_password']);
     
    if($new_password==$re_password){
      $stmnt ='select * from card where password=:current_password and cust_id = :cust_id';
      $params = array(
        ':current_password' => $current_password,
        ':cust_id'  => $_SESSION['userid']
      );
      if ($db->display( $stmnt, $params)){ print_r('asdasdasdsa');
        $sql ='update card set password=:new_password where cust_id=:cust_id';
        $params = array(
          ':new_password' => $new_password,
           ':cust_id'    => $_SESSION['userid']   
          );
        if($db->display($sql, $params)){
        $message='Successfully updated'; 
        }
      } else {
        $message = 'Incorrect old password';
      }

    } else {
      $message=' ERROR!!! passwords are not matching';
    }
                              
  }
   
 ?>

<<!DOCTYPE html>
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

<form action="" method="post">
 <div class="content-box">
                  <h3 class="content-box-header content-box-header-alt bg-default">
                      <span class="icon-separator">
                          <i class="glyph-icon icon-cog"></i>
                      </span>
                      <span class="header-wrapper">
                      Change Password
                          <small>Use the form below to change your password.</small>
                       </span>
                  </h3>
                  <div class="content-box-wrapper">
                      <div class="form-group">
                          <div class="input-group">

Current Password
<input align="center" type="password"  name="current_password" placeholder="enter your password" data-parsley-required="true"><br>
</div>
</div>
<div class="form-group">
<div class="input-group">
New Password
<input  type="password"  name="new_password" placeholder="enter new password" data-parsley-required="true" size=30><br>
</div>
</div>
<div class="form-group">
<div class="input-group">
Retype New Password
<input  type="password"  name="re_password" placeholder="retype new password" data-parsley-required="true" size=30><br>
</div>
</div>
<div class="form-group">
                          <div class="input-group">
<input type="submit"  name="login"  value="submit" class="btn btn-lg btn-primary"s>
</div>
</div>
<?php  echo $message;?>
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

<?php include_once('../footer.php');  ?>
