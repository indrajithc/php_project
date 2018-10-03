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
	        		</div>
		            <?php } ?>
			</div>
        </form>
    </div>


</div>

<?php include_once('../footer.php'); ?>



onchange="this.form.submit();"






<option value="<?php echo $value['shop_id'] ?>"<?php if( isset( $_POST['shop'] ) ) if( $_POST['shop']  == $value['shop_id'] ) echo ' selected'; ?>> <?php echo $value['shop_no']; ?></option>";



echo "<option value=" . $value['shop_id'] .">" . $value['shop_no'] . "</option>";