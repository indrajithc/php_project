<?php
    include_once( '../header.php' );
    $db=new Database();
    $message='';
     if(isset($_POST['complaint'])){
	            

   				$type=$_POST['type'];
				$complaint=$_POST['complaint'];
	   			 $shop_id=$_SESSION['userid'];
	    	 	 $date = new DateTime();
     			 $date = date_format($date, 'Y-m-d');


     			  $stmnt ='insert into complaint(shop_id,type,complaint,c_date) values (:shop_id, :type,:complaint,:c_date)';	
     			  $params = array(
     			  		':type'	=>	$type,
     			  		':shop_id'	=>	$shop_id,
     			  		':complaint'	=>	$complaint,
     			  		':c_date'	=>	$date
     			  	);
		   		if( $db->execute_query( $stmnt,$params ) ) {
		   			$message = 'Successfully complaint registered!';
		   		} else {
		   			$message = 'Some error occured!';
		   		}

			}	
    ?>
	<div id="page-title">
	    <h2>Complaint</h2>
	</div>
		        <form class="form-horizontal bordered-row" data-parsley-validate method="post">
	        	<div class="row">
	        		
	        				<div class="col-md-10">
			        	<div class="form-group">
		                    <label class="col-sm-3 control-label">Type</label>
		                    <div class="col-sm-6">
		                        <select name="type">
		                        <option>Service</option>
		                        <option>Product</option>
		                        </select>
		                    </div>
		                </div>
	        		</div>	     

				<div class="col-md-10">
			        	<div class="form-group">
		                    <label class="col-sm-3 control-label">Complaint</label>
		                    <div class="col-sm-6">
		                        <textarea class="form-control" name="complaint" placeholder="Complaint"></textarea>
		                    </div>
		                </div>
	        		</div>



	        	



                </div>
                <div class="content-box text-center">
                    <button class="btn btn-success" name="SUBMIT">SUBMIT</button>
                </div>
                <?php if( $message)
                 	{
                 		echo $message;
                 	}
                 ?>
	        </form>

<?php include_once('../footer.php');  ?>