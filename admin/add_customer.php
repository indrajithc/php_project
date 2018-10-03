<?php 

	include_once('../header.php');
	$db=new Database();
	$message='';
	$taluk = null;
	$shop = null;


    $sql = 'select * from district';
    $districts = $db->display($sql);

    if( isset( $_POST['district'] ) ) {
    	$stmnt='SELECT * FROM `taluk` where dist_id = "'.$_POST['district'].'"';
  	   	$taluk = $db->display($stmnt);
    }
     if( isset( $_POST['taluk'] ) ) {
    	$stmn='SELECT * FROM `ration_shop` where taluk_id = "'.$_POST['taluk'].'"';
  	   	$shop = $db->display($stmn);
    }
    if(isset($_POST['submit'])){
         
         $shop_no         =  $_POST['shop_no'];
         $password        =  $_POST['password'];
         $card_type       =  $_POST['card_type'];
         $card_no         =  $_POST['card_no'];
         $name            =  $_POST['name'];
         $address         =  $_POST['address'];
         $ward_no         =  $_POST['ward_no'];
         $house_no        =  $_POST['house_no'];
         $taluk           =  $_POST['taluk'];
         $members         =  $_POST['members'];
         $monthly_income  =  $_POST['monthly_income'];
         $stmnt='select * from customer where card_no=:card_no';
         
         $params=array(

         ':card_no' => $card_no
         );
         if(!$db->display($stmnt,$params)){

	     $stmnt ='insert into customer(shop_no,password,card_type,card_no,name,address,ward_no,house_no,taluk,members,monthly_income) values(:shop_no,:password,:card_type,:card_no,:name,:address,:ward_no,:house_no,:taluk,:members,:monthly_income)';
	     	     $params=array(
                 
       
         ':password'        =>  $password,
         ':card_type'       =>  $card_type,
         ':card_no'         =>  $card_no,
         ':name'            =>  $name,
         ':shop_no'         =>  $shop_no,
         ':address'         =>  $address,
         ':ward_no'         =>  $ward_no,
         ':house_no'        =>  $house_no,
         ':taluk'           =>  $taluk,
         ':members'         =>  $members,
         ':monthly_income'  =>  $monthly_income
         
	     	);

	         $istrue=$db->execute_query($stmnt,$params);
	         if($istrue){
	         	$message=$card_no.'added!';
	         }
	         else{
	         	$message=$istrue;	
	         }
         }else{
         	$message=' value already exists';
         }
    }
    ?>

 

 <div id="page-title">
	<h2>Add Customer</h2>
	<p>View all customers by name</p>
</div>

<div class="panel">
	<div class="panel-body">
        <h3 class="title-hero">
            Add customer
        </h3>

        <form class="form-horizontal bordered-row" id="add-customer"  action="" method="post" data-parsley-validate>
			<div class="row">
				<div class="col-md-6">
	                <?php if ($districts) { ?>
					<div class="form-group">
			            <label class="col-sm-3 control-label">District</label>
			            <div class="col-sm-6">
			            	<select name="district" onchange="this.form.submit();" class="form-control" id="district">
	                    		<option>Select</option>
		                    		<?php foreach ($districts as $district) { ?>
		                    			<option value="<?php echo $district['dist_id'] ?>" <?php if( isset( $_POST['district'] ) ) if( $_POST['district']  ==$district['dist_id'] ) echo ' selected'; ?>><?php echo $district['district_name']; ?></option>
		                    		<?php } ?>
	                    	</select>
			           	</div>
			        </div>
	                <?php } ?>
		            <?php if ($taluk) { ?>
			        <div class="form-group">
		                <label class="col-sm-3 control-label">Taluk</label>
		                    <div class="col-sm-6">
		                       	<select name="taluk"  data-parsley-required="true" class="form-control" onchange="this.form.submit();">
		                    		<option>Select</option>	
								<?php foreach ($taluk as $value) { ?>
  	   	    						<option value="<?php echo $value['taluk_id'] ?>"<?php if( isset( $_POST['taluk'] ) ) if( $_POST['taluk']  == $value['taluk_id'] ) echo ' selected'; ?>> <?php echo $value['name']; ?></option>";
  	   	    					<?php } ?>
		                 		</select> 
		                    </div>
		                </div>
		                 <?php } if ($shop) { ?>
			        	<div class="form-group">
		                <label class="col-sm-3 control-label">Shop Number</label>
		                    <div class="col-sm-6">
		                       	<select name="shop_no" onchange="this.form.submit();" data-parsley-required="true" class="form-control">
		                    		<option>Select</option>	
								<?php foreach ($shop as $value) { ?>
  	   	    						<option value="<?php echo $value['shop_id'] ?>"<?php if( isset( $_POST['shop_no'] ) ) if( $_POST['shop_no']  == $value['shop_id'] ) echo ' selected'; ?>> <?php echo $value['shop_no']; ?></option>";

  	   	    					<?php } ?>
		                 		</select> 
		                    </div>
		                </div>
		                                        
			        	<div class="form-group">
		                    <label class="col-sm-3 control-label">Card Number</label>
		                    <div class="col-sm-6">
		                        <input type="text" class="form-control"  placeholder="Card Number..." name="card_no" data-parsley-required="true" data-parsley-type="number">
		                    </div>
		                </div>
	        		
			        	<div class="form-group">
		                    <label class="col-sm-3 control-label">Card Type</label>
		                    <div class="col-sm-6">
		                        <select name="card_type" data-parsley-required="true">
		                            
		                            <option>Select</option>
		                            <option>APL</option>
		                            <option>BPL</option>
		                            <option>AAY</option>
		                            <option>ANP</option>

		                        </select>
		                    </div>
		                </div>
	        		
			        	<div class="form-group">
		                    <label class="col-sm-3 control-label">Name</label>
		                    <div class="col-sm-6">
		                        <input type="text" class="form-control"  placeholder="Example placeholder..." name="name" data-parsley-required="true">
		                    </div>
		                </div>
	        		
			        	<div class="form-group">
		                    <label class="col-sm-3 control-label">password</label>
		                    <div class="col-sm-6">
		                        <input type="password" class="form-control"  placeholder="password" name="password">
		                    </div>
		                </div>
	        		
				        	<div class="form-group">
			                    <label class="col-sm-3 control-label">Address</label>
			                    <div class="col-sm-6">
			                        <textarea
		                         name="address" rows="7" cols="15" required class="form-control" id="" placeholder="address" data-parsley-required="true"> 
									</textarea>		
			                    </div>
			                </div>
		        		
			        	<div class="form-group">
		                    <label class="col-sm-3 control-label">Ward Number</label>
		                    <div class="col-sm-6">
		                        <input type="text" class="form-control"  placeholder="ward number" name="ward_no" data-parsley-required="true" data-parsley-type="number">
		                    </div>
		                </div>
	        		
			        	<div class="form-group">
		                    <label class="col-sm-3 control-label">House Number</label>
		                    <div class="col-sm-6">
		                        <input type="text" class="form-control"  placeholder="house number" name="house_no" data-parsley-required="true" data-parsley-type="number">
		                    </div>
		                </div>

			        	<div class="form-group">
		                    <label class="col-sm-3 control-label">Members</label>
		                    <div class="col-sm-6">
		                        <input type="text" class="form-control" id="" placeholder="Number Of Members." name="members" data-parsley-required="true" data-parsley-type="number">
		                    </div><br>
		            	</div>
			        	<div class="form-group">
		                    <label class="col-sm-3 control-label">Monthly Income</label>
		                    <div class="col-sm-6">
		                        <input type="text" class="form-control"  placeholder="monthly income" name="monthly_income" data-parsley-required="true" data-parsley-type="number">
		                    </div>
		                </div>
	        		<div class="content-box text-center">
	                <button type="submit" name="submit" value="" class="btn btn-lg btn-primary">Add</button>
	            </div>
	            <?php echo $message; ?>
	        		</div>


	        		</div>
		            <?php } ?>
			</div>
        </form>
    </div>


</div>

<?php include_once('../footer.php'); ?>