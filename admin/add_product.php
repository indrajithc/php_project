<?php
    include_once( '../header.php' );
    $db=new Database();


  $message = array( NULL, NULL);





    if(isset($_POST['submit'])){
    	
    	  
         $pr_name       =   $_POST['pr_name'];
         $price         =   $_POST['price'];
         $quantity      =   $_POST['quantity'];
         $total_price          =   $_POST['price'] *  $_POST['quantity'] ;
         $description   =   $_POST['description'];







    		$stmnt="SELECT  * FROM product WHERE pr_name = '" . $pr_name . "' AND  price = " . $price . "  AND delete_status = 0 ";
    		$product = $db->display( $stmnt);
    		if( $product ){

			 $message [0] = 3;
			 $message [1] = 'already exists'; 

    	} else {
    		

    	



         $stmnt  =  'insert into product( pr_name,price,quantity,total_price,description) values( :pr_name,:price,:quantity,:total_price,:description)';
	

         $params=array(
         	 
         	':pr_name'     =>   $pr_name,
         	':price'       =>   $price,
         	':quantity'    =>   $quantity,
         	':total_price'        =>   $total_price,
         	':description' =>   $description
         	);

	         $istrue=$db->execute_query($stmnt,$params);
	         if($istrue){

              $message [0] = 1;
              $message [1] = ' successfully updated';  

	         }else{

			 $message [0] = 4;
			 $message [1] = 'Something is wrong'; 

	         	}	
    }
    

    }
 ?>

	
<div id="page-title">
	    <h2>ADD PRODUCTS</h2>
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
		                    <label class="col-sm-3 control-label">Product Name</label>
		                    <div class="col-sm-6">
		                    <input type="text" required name="pr_name" class="form-control" placeholder="Product Name" name="pr_name">
		                    </div>
		                </div>
	        		</div>
		        	<div class="col-md-6">
				        	<div class="form-group">
			                    <label class="col-sm-3 control-label">Price</label>
			                    <div class="col-sm-6">
			                        <input type="number"    required name="price" class="form-control" placeholder="Price.." name="price">		
			                    </div>
			                </div>
		        		</div>

		        	</div>	
		        		<div class="row">

		        		<div class="col-md-6">
				        	<div class="form-group">
			                    <label class="col-sm-3 control-label">Quantity</label>
			                    <div class="col-sm-6">
			                        <input type="number"    required class="form-control" id="Quantity" placeholder="Quantity.." name="quantity">
			                    </div>
			                </div>
			                </div>


		        
		        	<div class="col-md-6">
				        	<div class="form-group">
			                    <label class="col-sm-3 control-label">total Price</label>
			                    <div class="col-sm-6">
			                        <input type="number" disabled="disabled" required name="total_price" class="form-control" placeholder="Total Price.." name="total_price">		
			                    </div>
			                </div>
		        		</div>


		        		</div>
                                                

		        		<div class="row">
		        	<div class="col-md-12">
				        	<div class="form-group">
			                    <label class="col-sm-3 control-label">description</label>
			                    <div class="col-sm-6">
			                        <textarea type="text" class="form-control" id="description" placeholder="Description..." name="description"></textarea>
			                    </div>
			                </div>
		        		</div>


		        		</div>
	            <div class="content-box text-center">
	                <input type="submit" name="submit" value="Add Product" class="btn btn-lg btn-primary">
	            </div>


	        </form>
	    </div>
    </div>


<script type="text/javascript">
	
$(document).ready(function() {


	$('input[name="quantity"], input[name="price"]').change( function(){ 

		var n1 = $('input[name="quantity"]').val();
		var n2 = $('input[name="price"]').val();

		if(n1>0 && n2>0){
			$('input[name="total_price"]').val( n1 * n2 );
		} else {

			$('input[name="total_price"]').val("" );
		}





	} );

  
});

</script>
<?php include_once('../footer.php');  ?>