=<?php 
include_once( '../header.php' );
$db=new Database();
$message='';

if(isset($_POST['login'])) {
	print_r($_POST);

	$current_password = md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $re_password = md5($_POST['re_password']);
     
    if($new_password==$re_password){
      $stmnt ='select * from ration_shop where password=:current_password and shop_id = :shop_id';
      $params = array(
        ':current_password' => $current_password,
        ':shop_id'  => $_SESSION['userid']
      );
      if ($db->display( $stmnt, $params)){ print_r('asdasdasdsa');
        $sql ='update ration_shop set password=:new_password where shop_id=:shop_id';
        $params = array(
          ':new_password' => $new_password,
           ':shop_id'    => $_SESSION['userid']   
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

<form action="" method="post">
current Password
<input  type="password"  name="current_password" placeholder="enter your password"><br>
new password
<input  type="password"  name="new_password" placeholder="enter new password"><br>
Retype password
<input  type="password"  name="re_password" placeholder="retype new password"><br>
<input type="submit"  name="login"  value="submit">
<?php if(isset($message)) echo $message;?>

</form>

<?php include_once('../footer.php');  ?>
