<?php
	include_once( '../header.php' ); 
	include_once('../includes/connection.php');
 	$db=new Database();
 	$message='';
  $userid = null;

 	 $sql='select * from complaint where r_date is null';
    $id = $db->display( $sql );

                if( isset($_POST['complaint_id']) ) {

                   $stmnt2='select * from complaint where complaint_id='.$_POST['complaint_id'];
                   $feedback = $db->display($stmnt2);  
                   $feedback = $feedback[0];       
                } else if( $id[0]['complaint_id'] ) {

                   $stmnt2='select * from complaint where complaint_id='.$id[0]['complaint_id'];
                   $feedback = $db->display($stmnt2);  
                   $feedback = $feedback[0];    

                   $complaint_type =  $feedback['shop_id'] == null ? 'c' : 'r';
                   if(  $complaint_type == 'c' ) {
                    $complaint_user_query = 'select * from customer where cust_id = '.$feedback['cust_id'];
                   }  else{
                   $complaint_user_query='select * from ration_shop where shop_id ='.$feedback['shop_id'];
                   }

                   $complaint_user = $db->display($complaint_user_query);
                   $complaint_user = $complaint_user[0];
                   echo ucfirst($complaint_user['name']);



                }

              if(isset ( $_POST['send'])){
	                 $date=new DateTime();
                     $date = date_format($date, 'Y-m-d');
                     
	 
                     $stmnt='update  complaint set reply=:reply,r_date=:r_date where complaint_id=:complaint_id';
	               $params=array( 
	                    ':reply'    =>$_POST['reply'],          
                         ':r_date'      => $date,
                         ':complaint_id'		=>	$_POST['complaint_id']
		                 );
	                 $istrue=$db->execute_query($stmnt,$params);
						    if($istrue){
							      $message="Send feedback";
						      } else{
							    $message="failed!";
						       }
        	}
					                    echo $message;


 ?>	<div id="page-title">
	    <h2>Feedback</h2>
	    
	</div>

	<div class="panel">
    	<div class="panel-body">
	        <h3 class="title-hero">
	           
	        </h3>


<form method="post" action="" class="form-horizontal bordered-row" data-parsley-validate>
         <div class="col-md-6">
         	<div class="form-group">
               <label class="col-sm-3 control-label">Complaint ID</label>
               	<div class="col-sm-6">	
              
				
					<select name="id" required="" class="form-control" onchange="this.form.submit()">
			   			<?php 
                        	foreach ($id as $value){ ?>
                            	<option value="<?php echo $value['complaint_id']; ?>" <?php if( isset($_POST['complaint_id']) ){if( $_POST['complaint_id'] == $value['complaint_id'] ) echo ' selected';} ?> > <?php echo $value['complaint_id'] ?>
                            		
                            	</option>
                        	<?php }
                       	?>
			    </select>
			       </div>
		  	</div>
<!-- 		                <?php if($feedback) {echo $feedback['feedback'];} ?>
 --> 	                  <div class="form-group">
               <label class="col-sm-3 control-label">complaint</label>
                <div class="col-sm-6">
                    <p><?php   echo $feedback['complaint'];?></p>
                </div>
            
		    </div> 
        <div class="form-group">
          <label class="col-sm-3 control-label">Reply</label>
          <div class="col-sm-6">	
            <textarea id="" class="form-control" name="reply" > </textarea>
          </div>
		    </div>  
        <div class="form-group">
          <label class="col-sm-3 control-label">Name</label>
          <div class="col-sm-6">  
            <textarea id="" class="form-control" name="reply" > </textarea>
          </div>
        </div>
		    <div class="form-group">
               	<div class="col-sm-6">	
		    		<button  name="send" class="btn btn-lg btn-primary">Send</button>
                 </div>
		    </div>      

		 </div>
		                   

 </form>

 </div>
 </div>




<?php include_once( '../footer.php' ); ?>
