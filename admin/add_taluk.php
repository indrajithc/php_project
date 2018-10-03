<?php
    include_once( '../header.php' );
    $db=new Database();
    $message='';
    if(isset($_POST['submit'])){
    	
    	 
         $dist       =   $_POST['dist'];
         $name         =   $_POST['name'];
         
         $stmnt =  'insert into taluk(dist,name) values(:dist,:name)';
	

         $params=array(
         	
         	':dist'      =>  $dist,
         	':name'      =>  $name,
         	
         	);

	         $istrue=$db->execute_query($stmnt,$params);
	         if($istrue){
	         	$message=$name.' added!';
	         }else{
	         	$message=$istrue;
	         	}	
    }
    
 ?>

	<div id="page-title">
	    <h2>Add Taluk</h2>
	    
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
		                    <label class="col-sm-3 control-label">District</label>
		                    <div class="col-sm-6">
		                    	<select name="dist" >


<?php

$stmnt='SELECT * FROM `district` ';



  	   if($result = $db->display($stmnt)){
  	   	
  	   	    
  	   	    foreach ($result as $value) {
  	   	    	
            
  	   	    echo "<option value=" . $value['dist_id'] .">" . $value['district_name'] . "</option>";

  	   	    
  	   	    }
  	   
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
		                    <label class="col-sm-3 control-label">Taluk Name</label>
		                    <div class="col-sm-6">
		                        <input type="text" required name="name" class="form-control" placeholder="Taluk Name" data-parsley-required="true">
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