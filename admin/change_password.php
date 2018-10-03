<?php 
include_once( '../header.php' );
$db=new Database();
$message='';

if(isset($_POST['login'])) {
	

	$current_password = $_POST['current_password'];
    $new_password=$_POST['new_password'];
    $re_password = $_POST['re_password'];
     
    if($new_password==$re_password){
      $stmnt ='select * from admin where password=:current_password and username = :username';
      $params = array(
        ':current_password' => $current_password,
        ':username'  => $_SESSION['userid']
      );
//var_dump($params);
      if ($db->display( $stmnt, $params)){
        $sql ='update admin set password=:new_password where username=:username';
        $params = array(
          ':new_password' => $new_password,
           ':username'    => $_SESSION['userid']   
          );
//var_dump($params);
        if($db->execute_query($sql, $params)){
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
 <div id="page-title">
      <h2>Reset Password</h2>
  </div>

  <div class="panel">
      <div class="panel-body">
          <h3 class="title-hero">
              
          </h3>

          <form class="form-horizontal bordered-row" data-parsley-validate action="" method="post">
            <div class="row">
              <div class="col-md-10">
                <div class="form-group">
                        <label class="col-sm-3 control-label">Current password</label>
                        <div class="col-sm-6">
                <input type="password" name="current_password" class="form-control" placeholder="current password" required>
                        </div>
                    </div>
              </div>
              <div class="col-md-10">
                <div class="form-group">
                        <label class="col-sm-3 control-label">New Password</label>
                        <div class="col-sm-6">
                            <input type="password" name="new_password" class="form-control" id="" placeholder="new password" required>
                        </div>
                    </div>
              </div>
              <div class="col-md-10">
                <div class="form-group">
                        <label class="col-sm-3 control-label">Re-enter Password</label>
                        <div class="col-sm-6">
                                <input type="password" name="re_password" class="form-control" id="" placeholder="re enter password" required>
                        </div>
                    </div>
              </div>
                </div>
                <div class="content-box text-center">
                    <button class="btn btn-lg btn-info" name="login">change</button>
                </div>
          </form>
      </div>
    </div>
<?php if ( $message ) {
    echo $message;
  }
  ?>
<?php include_once( '../footer.php'); ?>