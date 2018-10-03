<?php
    include_once( '../header.php' );
    $db=new Database(); 
  $message = array( NULL, NULL);


    if(isset($_GET['shop_id'])){
      $shop_id = $_GET['shop_id'];





    if(isset($_POST['delete-me']) || isset($_POST['active-me'])) {
      $Sdelete = 0;
      if(isset($_POST['delete-me'])) 
         $Sdelete = 1;

         $sql='update ration_shop set delete_status=:delete_status where shop_id=:shop_id';
         $params=array(
              ':delete_status'      =>  $Sdelete,
              ':shop_id'      =>  $shop_id
           );
          if($db->execute_query($sql,$params) ){
              $message [0] = 1;
              $message [1] = ' successfully updated';  

       }



    }




      
      $stmnt='select * from ration_shop where shop_id=:shop_id';
      $params = array(':shop_id' =>  $shop_id);
      $shop = $db->display($stmnt, $params);
      if( $shop ) { $shop = $shop[0];


        if(isset($_POST['submitme'])) { //print_r($_POST);
    $sql='update ration_shop set shop_no=:shop_no,taluk_id=:taluk_id,shop_address=:shop_address,mobile=:mobile,pin=:pin,emp_name=:emp_name,emp_address=:emp_address,emp_gender=:emp_gender,contact_no=:contact_no where shop_id=:shop_id';
    $params=array(
         ':shop_no'      =>  $_POST['shop_no'],
         ':taluk_id'      =>  $_POST['taluk'],
         ':shop_address' =>  $_POST['address'],
         ':mobile'       =>  $_POST['mobile'],
         ':pin'          =>  $_POST['pin'],
         ':emp_name'     =>  $_POST['emp_name'],
         ':emp_address'  =>  $_POST['emp_address'],
         ':emp_gender'   =>  $_POST['emp_gender'],
         ':contact_no'   =>  $_POST['contact_no'],
         ':shop_id'      =>  $shop_id
      );
     if($db->execute_query($sql,$params))
     

         $message [0] = 1;
         $message [1] = ' successfully updated'; 
  }
    
  $stmnt='SELECT * FROM taluk WHERE taluk_id ='. $shop['taluk_id'].' ';
    $dist = $db->display($stmnt);
    if($dist){

      $shop['dist_id']  = $dist[0]['dist'];
    }

 

  $stmnt='SELECT * FROM `taluk` WHERE dist IN ( SELECT dist FROM taluk WHERE taluk_id ='. $shop['taluk_id'].' );';
    $taluk = $db->display($stmnt);





    if( isset( $_POST['district'] ) ) {
      $stmnt='SELECT * FROM `taluk` where dist= "'.$_POST['district'].'"';
        $taluk = $db->display($stmnt);
    }










 ?>

  
<div id="page-title">
      <h2>Edit Shop</h2>
      <p></p>
  </div>

  <div class="panel">
      <div class="panel-body">
          <h3 class="title-hero">
              Elements
          </h3>


<?php echo show_error ($message); ?>

        <form class="form-horizontal bordered-row"  action="" method="post" data-parsley-validate>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                        <label class="col-sm-3 control-label">Shop_no</label>
                        <div class="col-sm-6">
                            <input type="text" required name="shop_no" value="<?php echo $shop['shop_no']; ?>" class="form-control" placeholder="Shop Number.." name="shop_no">
                        </div>
                    </div>
              </div>




              <div class="col-md-6">
                <div class="form-group">
                        <label class="col-sm-3 control-label">District</label>
                        <div class="col-sm-6" >
                          <select name="district"  onchange="this.form.submit();" class="form-control">


<?php

$stmnt='SELECT * FROM `district` ';


       if($district = $db->display($stmnt)){
            
            foreach ($district as $value) { ?>
              
              <option value="<?php echo $value['dist_id']; ?>" <?php if( $value['dist_id'] == $shop['dist_id'] ) echo ' selected'; ?>><?php echo $value['district_name'];?></option>
            
            <?php }
       
       }

       else {
            
            $error= '';
        
       }


?>

                      </select>
                        </div>
                    </div>
              </div>












              <div class="col-md-6">
                            <div class="form-group">
                    <label class="col-sm-3 control-label">Taluk</label>
                        <div class="col-sm-6">
                            <select name="taluk"   data-parsley-required="true" class="form-control">
                            <option>Select</option> 
                <?php foreach ($taluk as $value) { ?> 
                        <option value="<?php echo $value['taluk_id'] ?>"<?php if( isset( $shop['taluk_id'] ) ) if( $shop['taluk_id']  == $value['taluk_id'] ) echo ' selected'; ?>> <?php echo $value['name']; ?></option>";
                      <?php } ?>
                        </select> 
                        </div>
                    
              </div>
              </div>







              <div class="col-md-6">
                  <div class="form-group">
                          <label class="col-sm-3 control-label">Shop address</label>
                          <div class="col-sm-6">
                              <textarea
                             name="address" rows="7" cols="15" required class="form-control"  id="address" placeholder="address">
                             
                              <?php echo $shop['shop_address']; ?>
                  </textarea>   
                          </div>
                      </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                          <label class="col-sm-3 control-label">mobile</label>
                          <div class="col-sm-6">
                              <input type="number"  min="10" class="form-control" id="mobile" placeholder="phone number.." name="mobile" value="<?php echo $shop['mobile']; ?>" >
                          </div>
                      </div>
                      </div>
                <div class="col-md-6">
                  <div class="form-group">
                          <label class="col-sm-3 control-label">pin</label>
                          <div class="col-sm-6">
                              <input type="number"  min="10" class="form-control" id="pin" placeholder="Pincode..." name="pin" value="<?php echo $shop['pin']; ?>">
                          </div>
                      </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                          <label class="col-sm-3 control-label">Employee Name</label>
                          <div class="col-sm-6">
                              <input type="text"  class="form-control" id="emp_name" placeholder="Employee Name.." name="emp_name" value="<?php echo $shop['emp_name']; ?>">
                          </div>
                      </div>
                      </div>
                     <div class="col-md-6">
                  <div class="form-group">
                          <label class="col-sm-3 control-label">Employee Address</label>
                          <div class="col-sm-6">
                               <textarea name="emp_address" rows="7" cols="15" required class="form-control"  id="emp_address">
                                    <?php echo $shop['emp_address']; ?>
                                  
                                    </textarea>   
                          </div>
                      </div>
                      </div>
                      <div class="col-md-6">
                  <div class="form-group">
                          <label class="col-sm-3 control-label">Gender</label>
                          <div class="col-sm-6">
                             <input type="radio" name="emp_gender" <?php if( $shop['emp_gender'] == 'male' ) echo 'checked'; ?> value="male">Male
                              <input type="radio" name="emp_gender" <?php if( $shop['emp_gender']  == 'female' ) echo 'checked';  ?> value="female"> Female
                          </div>
                      </div>
                      </div>
                      <div class="col-md-6">
                  <div class="form-group">
                          <label class="col-sm-3 control-label">Contact Number</label>
                          <div class="col-sm-6">
                              <input type="text"   class="form-control" id="contact_no" placeholder="Contact Number..." name="contact_no" value="<?php echo $shop['contact_no']; ?>" data-parsley-type="number">
                          </div>
                      </div>
                      </div>
              </div>  
              <div class="content-box text-center">
                  <input type="submit" name="submitme" value="UPDATE" class="btn btn-lg btn-primary">

                  <?php
                  if($shop['delete_status'] == 0 )
                  echo '  <input type="submit" name="delete-me" value="DELETE" class="btn btn-lg btn-danger">';
                  if($shop['delete_status'] == 1 )
                  echo '  <input type="submit" name="active-me" value="ACTIVE" class="btn btn-lg btn-success">';

                  ?>



              </div> 

          </form>
      </div>
    </div>
    <?php 
    }


    } else {echo "No shopes to edit";}?>

<?php include_once('../footer.php');  ?>