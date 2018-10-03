
<?php
    include_once( '../header.php' );
    $db=new Database();
    $message='';
    if(isset($_POST['submit'])){
         $name  =  $_POST['district_name'];

         $stmnt='select * from district where district_name = :name';	
         $params=array(
         	':name'  =>  $name
         	);
         if(!$db->display($stmnt,$params)){
	         $stmnt =  'insert into district(district_name) values(:name)';
	         $istrue=$db->execute_query($stmnt,$params);
	         if($istrue)
	         	$message=$name.' added!';
	         else
	         	$message=$istrue;	
         }else{
         	$message=' value already exists';
         }
    }
    ?>
	<div id="page-title">
	    <h2>Add District</h2>
	    <p>View all customers by username</p>
	</div>

	<div class="panel">
    	<div class="panel-body">
	        <h3 class="title-hero">
	            Elements
	        </h3>

   			<form class="form-horizontal bordered-row" data-parsley-validate action="" method="post">
	        	<div class="row">
	        		<div class="col-md-6">
			        	<div class="form-group">
		                    <label class="col-sm-3 control-label">District Name</label>
		                    <div class="col-sm-6">
		                        <input type="text" required name="district_name" class="form-control" placeholder="District Name" data-parsley-required="true">
		                    </div>
		                </div>
	        		</div>
	        	</div>
	            <div class="content-box text-center">
	                <input type="submit" name="submit" value="Add District" class="btn btn-lg btn-primary" >
	            </div>
	            <?php echo $message; ?>
	        </form>
	    </div>
    </div>

<?php include_once('../footer.php');  ?>