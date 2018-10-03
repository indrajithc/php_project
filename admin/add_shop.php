<?php
include_once( '../header.php' );
$db=new Database();

$message = array( NULL, NULL);
$taluk = null;


$sql = 'select * from district';
$districts = $db->display($sql);

if( isset( $_POST['district'] ) ) {
	$stmnt='SELECT * FROM `taluk` where dist="'.$_POST['district'].'"';
	$taluk = $db->display($stmnt);
}
if(isset($_POST['submitbt'])){


	$district          =   $_POST['district'];
	$taluk         =   $_POST['taluk'];
	$shop_no          =   $_POST['shop_no'];
	$password         =   $_POST['password'];
	$shop_address     =   $_POST['address'];
	$mobile           =   $_POST['mobile'];
	$pin              =   $_POST['pin'];


	$emp_name              =   $_POST['emp_name'];
	$emp_address              =   $_POST['emp_address'];
	$emp_gender              =   $_POST['emp_gender'];
	$contact_no              =   $_POST['contact_no'];





	$stmnt="SELECT  * FROM ration_shop WHERE shop_no = " . $shop_no . " AND taluk_id =" . $taluk . "  AND delete_status = 0 ";
	$ration_shop = $db->display( $stmnt);
	if( $ration_shop ){

		$message [0] = 2;
		$message [1] = 'already exists'; 

	} else {







		$stmnt =  'insert into ration_shop(shop_no,taluk_id,password,shop_address,mobile,pin, emp_name, emp_address, emp_gender, contact_no) values(:shop_no,:taluk,:password,:shop_address,:mobile,:pin, :emp_name, :emp_address, :emp_gender, :contact_no)';


		$params=array(

			':shop_no'      =>  $shop_no, 
			':taluk'         => $taluk,
			':password'     =>  $password,
			':shop_address' =>  $shop_address,
			':mobile'       =>  $mobile,
			':pin'          =>  $pin ,
			':emp_name'          =>  $emp_name,
			':emp_address'          =>  $emp_address,
			':emp_gender'          =>  $emp_gender,
			':contact_no'          =>  $contact_no
		);

		$istrue=$db->execute_query($stmnt,$params);
		if($istrue){


			$message [0] = 1;
			$message [1] = 'Ration Shop successfully Added'; 

		}else{


			$message [0] = 3;
			$message [1] = 'Something is wrong'; 

		}	



	}
}

?>


<div id="page-title">
	<h2>Add Shop</h2>
	<p>View all customers </p>
</div>

<div class="panel">
	<div class="panel-body">
		<h3 class="title-hero">
			Elements
		</h3>



		<?php echo show_error ($message); ?>

		<form class="form-horizontal bordered-row"  action="" method="post" data-parsley-validate>
			<div class="row">

				<div class="form-group">
					<label class="col-sm-3 control-label">District</label>
					<div class="col-sm-6">
						<select name="district" onchange="this.form.submit();" class="form-control" id="district" required>
							<option>Select</option>
							<?php if ($districts) { ?>
							<?php foreach ($districts as $district) { ?>
							<option value="<?php echo $district['dist_id'] ?>" <?php if( isset( $_POST['district'] ) ) if( $_POST['district']  ==$district['dist_id'] ) echo ' selected'; ?>><?php echo $district['district_name']; ?></option>
							<?php } ?>
							<?php } ?>
						</select>
					</div>
				</div>
				<?php if ($taluk) { ?>
				<div class="form-group">
					<label class="col-sm-3 control-label">Taluk</label>
					<div class="col-sm-6">
						<select name="taluk" onchange="this.form.submit();" data-parsley-required="true" class="form-control">
							<option>Select</option>	
							<?php foreach ($taluk as $value) { ?>	
							<option value="<?php echo $value['taluk_id'] ?>"<?php if( isset( $_POST['taluk'] ) ) if( $_POST['taluk']  == $value['taluk_id'] ) echo ' selected'; ?>> <?php echo $value['name']; ?></option>";
							<?php } ?>
						</select> 
					</div>

				</div>
				<?php } ?>



				<?php
				if(isset($_POST['taluk'])){

					?>



					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-3 control-label">Shop No</label>
							<div class="col-sm-6">
								<input type="text" required name="shop_no" class="form-control" placeholder="Shop Number.." name="shop_no" data-parsley-type="number" data-parsley-required="true" value="<?php
								$a = 0;
								for ($i = 0; $i<9; $i++)  {
									$a .= mt_rand(0,9);
								}
								echo $a;

								?>"  maxlength="9" minlength="2" style="color: red; font-weight: 700;">
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-3 control-label">password</label>
							<div class="col-sm-6" data-parsley-validate>
								<input type="password" class="form-control"  placeholder="password" name="password" data-parsley-required="true">
							</div>
						</div>
					</div>


					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-3 control-label">Shop address</label>
							<div class="col-sm-6">
								<textarea
								name="address" rows="7" cols="15" required class="form-control" id="" placeholder="address" data-parsley-required="true"></textarea>		
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-3 control-label">mobile</label>
							<div class="col-sm-6">
								<input type="number"  min="10" class="form-control" id="mobile" placeholder="phone number.." name="mobile" data-parsley-required="true" data-parsley-type="number" maxlength="111" minlength="10"> 
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-3 control-label">pin</label>
							<div class="col-sm-6">
								<input type="number"  min="10" class="form-control" id="pin" placeholder="Pincode..." name="pin" \data-parsley-type="number"/  data-parsley-required="true" data-parsley-type="number"  maxlength="6" minlength="6" data-parsley-type="digits"> 
							</div>
						</div>
					</div>
				</div>	

				<h4> employee</h4>
				<div  class=" row">


					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-3 control-label">  name</label>
							<div class="col-sm-6">
								<input type="text" required class="form-control" placeholder="employee nam.." name="emp_name"  data-parsley-required="true"  maxlength="50" minlength="6">
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-3 control-label">gender</label>
							<div class="col-sm-6" data-parsley-validate>
								<input type="radio" class="f " value="male"  placeholder="gender" name="emp_gender"  checked="checked">male
								<input type="radio" class="f " value="female"  placeholder="gender" name="emp_gender"  > female
							</div>
						</div>
					</div>
				</div>

				<div  class=" row">

					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-3 control-label">contact no</label>
							<div class="col-sm-6">
								<input type="number"  min="10" class="form-control" id="contact_no" placeholder="contact no." name="contact_no" data-parsley-required="true" data-parsley-type="number" maxlength="11" minlength="10"> 
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-3 control-label">  address</label>
							<div class="col-sm-6">
								<textarea name="emp_address"  rows="7" cols="15" required class="form-control" id="" placeholder="emp_address" data-parsley-required="true"></textarea>		
							</div>
						</div>
					</div>





				</div>
				<div class="content-box text-center">
					<input type="submit" name="submitbt" value="Add Shop" class="btn btn-lg btn-primary">
				</div>



				<?php

			}

			?>






		</form>
	</div>
</div>

<?php include_once('../footer.php');  ?>