<?php 
	
	// connection
	include_once( 'includes/connection.php' );

	$db = new Database();
	$message = "";
	if( isset( $_POST['register'] ) ) {

		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		$sql = 'select * from users where username = :username';
		$result = $db->display( $sql, array(':username' => $username) );

		if( !$result ) {

			$sql = 'insert into users( username, fname, lname, password ) values( :username, :fname, :lname, :password )';
			$params = array(
					':username'	=>	$username,
					':fname'	=>	$fname,
					':lname'	=>	$lname,
					':password'	=>	$password,
				);
			$result = $db->execute_query( $sql, $params );

			if( $result ) {
				$message = "User registration successfull!";
			} else {
				$message = "Someting went wrong";
			}
		} else {
			$message = "Username not available";
		}

	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>User registration</title>
    <link rel="stylesheet" type="text/css" href="assets/admin-all-demo.css">
    <!-- JS Core -->
    <script type="text/javascript" src="assets/js-core.js"></script>
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
			                    Sign Up
			                    <small>Use the form below to login to your account.</small>
			                </span>
			            </h3>
			            <div class="content-box-wrapper">
			                <div class="form-group">
			                    <div class="input-group">
			                        <input type="text" class="form-control" name="fname" placeholder="First name" required>
			                    </div>
			                </div>
			                <div class="form-group">
			                    <div class="input-group">
			                        <input type="text" class="form-control" name="lname" placeholder="Last name" required>
			                    </div>
			                </div>
			                <div class="form-group">
			                    <div class="input-group">
			                        <input type="email" class="form-control" name="username" placeholder="Username" required>
			                    </div>
			                </div>
			                <div class="form-group">
			                    <div class="input-group">
			                        <input type="password"  id="password" class="form-control" name="password" placeholder="Password" required>
			                    </div>
			                </div>
			                <div class="form-group">
			                    <div class="input-group">
			                        <input type="password" class="form-control" name="rpassword" placeholder="Retype Password" required data-parsley-equalto="#password" data-parsley-minlength="6">
			                    </div>
			                </div>
			                <div class="form-group">
			                    <div class="input-group">
			                        <input type="submit" class="btn btn-success btn-block" name="register" value="Register">
			                    </div>
			                </div>
			                <?php echo $message; ?>
			            </div>
			        </div>
			    </form>
			</div>		
		</div>
			
	</div>
	

    <!-- JS Demo -->
	<script type="text/javascript" src="assets/widgets/parsley/parsley.js"></script>
    <script type="text/javascript" src="assets/admin-all-demo.js"></script>
</body>
</html>