<?php

include_once('../includes/connection.php');
$db=new Database();
$message='';




  session_start();


    if( isset( $_SESSION['userid'] ) ) {
      if( $_SESSION['type'] == 'admin' ) {
        header('Location: ' . PATH . '/admin');
      }         
      if( $_SESSION['type'] == 'shop' ) {
        header('Location: ' . PATH . '/shop' );
      }          
      if( $_SESSION['type'] == 'customer' ) {
        header('Location: ' . PATH . '/customer' );
      }         
          exit();
      }





    $taluk = null;


    $sql = 'select * from district';
    $districts = $db->display($sql);

      if( isset( $_POST['district'] ) ) {
        $stmnt='SELECT * FROM `taluk` where dist= "'.$_POST['district'].'"';
          $taluk = $db->display($stmnt);
      }





if(isset($_POST['login'])){

	$shop_id = $_POST['shop'];
	$password = $_POST['password'];
	print_r($_POST);
	 $stmnt='select * from ration_shop where shop_id = :shop_id and password = :password';
  	   $params=array( 
             ':shop_id'  =>  $shop_id,
             ':password'  =>  $password
  	   	);
  	   if($db->display($stmnt,$params)){
        
  	   	    $_SESSION['userid']=$shop_id;
  	   	    $_SESSION['type']='shop';
  	   	    header('Location: index.php');
  	   	    exit();
  	   }else{
  	   	    $message= 'Incorrect username or password';
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


<div class="panel panel-default">
  <div class="panel-body">


<form class="form-horizontal bordered-row"  action="" method="post" data-parsley-validate>
<div class="row">

    <div class="col-md-12"> 
          <div class="form-group">
                  <label class="col-sm-3 control-label">District</label>
                  <div class="col-sm-6">
                    <select name="district" onchange="this.form.submit();" class="form-control" id="district" required>
                          <option selected="selected" disabled="disabled">Select</option>
                          <?php if ($districts) { ?>
                            <?php foreach ($districts as $district) { ?>
                              <option value="<?php echo $district['dist_id'] ?>" <?php if( isset( $_POST['district'] ) ) if( $_POST['district']  ==$district['dist_id'] ) echo ' selected'; ?>><?php echo $district['district_name']; ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                  </div>
              </div>
              </div>

<?php


if(isset($_POST['district'])){
?>


    <div class="col-md-12">

                 <?php if ($taluk) { ?>
              <div class="form-group">
                    <label class="col-sm-3 control-label">Taluk</label>
                        <div class="col-sm-6">
                            <select name="taluk" onchange="this.form.submit();" data-parsley-required="true" class="form-control">
                            <option selected="selected" disabled="disabled">Select</option> 
                <?php foreach ($taluk as $value) { ?> 
                        <option value="<?php echo $value['taluk_id'] ?>"<?php if( isset( $_POST['taluk'] ) ) if( $_POST['taluk']  == $value['taluk_id'] ) echo ' selected'; ?>> <?php echo $value['name']; ?></option> 
                      <?php } ?>
                        </select> 
                        </div>
                    
              </div>
                <?php } ?>

</div>


                <?php


                if(isset($_POST['taluk'])){ 

                ?>


    <div class="col-md-12">
                   <?php 


                   $stmnt='SELECT * FROM `ration_shop` where taluk_id= "'.$_POST['taluk'].'"';
                     $shops = $db->display($stmnt);

 
                   if ($shops) { ?>
                <div class="form-group">
                      <label class="col-sm-3 control-label">Shop No</label>
                          <div class="col-sm-6">
                              <select name="shop"   onchange="this.form.submit();"  data-parsley-required="true" class="form-control">
                              <option selected="selected" disabled="disabled">Select</option> 
                  <?php foreach ($shops as $value) { ?> 
                          <option value="<?php echo $value['shop_id'] ?>"<?php if( isset( $_POST['shop'] ) ) if( $_POST['shop']  == $value['shop_id'] ) echo ' selected'; ?> > <?php echo $value['shop_no']; ?></option>  
                        <?php } ?>
                          </select> 
                          </div>
                      
                </div>
                  <?php } ?>

 </div>


                  <?php


                  if(isset($_POST['shop']) && isset($_POST['taluk']) && isset($_POST['district'])){


                  ?>


    <div class="col-md-12">
 
                              <div class="form-group">
                                      <label class="col-sm-3 control-label">Password</label>
                                      <div class="col-sm-6">
                                          <input type="password" required name="password" class="form-control" placeholder="password.." name="shop_no" data-parsley-type="password" data-parsley-required="true"  " minlength="3">
                                      </div>
                                  </div>



</div>

       </div>                         

                                  <div class="content-box text-center">
                                      <input type="submit" name="login" value="Login" class="btn btn-lg btn-primary">
                                  </div>




                  <?php

                  }

                  ?>










                <?php

                }

                ?>












<?php

}

?>


 


 
   <?php echo $message; ?>
 
</form>
  
</div>
</div>

      
  </div>
  

    <!-- JS Demo -->
  <script type="text/javascript" src="../assets/widgets/parsley/parsley.js"></script>
    <script type="text/javascript" src="../assets/admin-all-demo.js"></script>
</body>
</html>












 