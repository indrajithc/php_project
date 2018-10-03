<?php
    include_once( '../header.php' );


    $db=new Database();
    $message='';







    if ($_POST) { 
        
         $_SESSION['POST'] =  $_POST; 
     echo "<script type='text/javascript'>location.href='".$_SERVER['REQUEST_URI']."'</script>";
         exit();
    }
    if (isset($_SESSION ['POST'])) {
      $_POST = $_SESSION['POST'];
      unset($_SESSION['POST']);
    }
     











    
     if(isset($_POST['complaint'])){
	            

   				$type=$_POST['type'];
				$complaint=$_POST['complaint'];
	   			 $cust_id=$_SESSION['userid'];
	    	 	 $date = new DateTime();
     			 $date = date_format($date, 'Y-m-d');


     			  $stmnt ='insert into complaint(cust_id,type,complaint,c_date) values (:cust_id, :type,:complaint,:c_date)';	
     			  $params = array(
     			  		':type'	=>	$type,
     			  		':cust_id'	=>	$cust_id,
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
		                        <select name="type" class="form-control" >
		                        
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
		                        <textarea class="form-control" required name="complaint" placeholder="Complaint"></textarea>
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














	          <?php 


	          $userid = $_SESSION['userid'];







	          $sql="SELECT  * , date_format(date , '%d-%M-%Y  - %r') AS ddate FROM complaint WHERE cust_id =".$userid ."   ORDER BY date DESC  ";

	          
	          
 


	          $result=$db->display($sql);


	          ?>


	          <div class="panel">
	            <div class="panel-body">
	              <h3 class="title-hero">
	                Datatables row highlight
	              </h3>
	              <div class="example-box-wrapper">

	                <table id="datatable-row-highlight" class="table table-striped table-bordered" cellspacing="0" width="100%">
	                  <thead>
	                    <tr>

	                      <th class="col-sm-2">Type</th>   
	                      <th class="col-sm-4">  complaint</th>   
	                      <th class="col-sm-4">reply</th>   
	                      <th class="col-sm-2">date</th>  

	                    </tr>
	                  </thead>
	                  <tbody>
	                    <?php  
	                    foreach($result as $value) {

	         


	                    ?>
	                    <tr>

	                      <td><?php echo $value['type']; ?></td> 
	                      <td><?php echo $value['complaint']; ?></td>   
	                      <td><?php echo $value['reply']; ?></td>   



	                      <td><?php echo $value['ddate']; ?></td>   
 



	                    </tr>
	                    <?php 
	                  }
	                  ?> 
	                </tbody>
	              </table>
	            </div>
	          </div>
	        </div>




	        <?php

	        ?>





<?php include_once('../footer.php');  ?>