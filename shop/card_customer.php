<?php if (isset($_GET['id'])) { ?>








<?php include_once( '../header.php' ); ?>

<?php


$db=new Database();

$message = array(null, null);





?>




<?php





	  		$card =  null;

		 $stmnt='select * from card where card_id = :username AND delete_status = 0 ';
	  	   $params=array( 
	             ':username'  =>  $_GET['id']
	  	   	);
	  	   $card = $db->display($stmnt,$params);
		  	if($card ){ 
				$card  = $card[0];
	  	    } 


			$orgNo = $card['members'];
			$countArt = 0;


			 $stmnt= 'SELECT COUNT(*) AS number FROM `member` WHERE card_id= :card_id  AND delete_status = 0  ';
		  	   

		  	   $params=array( 
		             ':card_id'  =>  $_SESSION['userid']
		  	   	);


		  	   $member = $db->display($stmnt,$params);
			  	if($member ){ 
			  		$countArt = $member[0]['number'];
			  	}


			  	$reming = ( $orgNo - $countArt);



 


?>






 

 <?php
 	 

 if ($reming < $orgNo) {

 ?>

  
  
<div class="panel" style="margin: 3em;">
  <div class="panel-body">
  <div class="col-md-offset-1 col-md-10">
  	<p style="padding: 1em;" class="bg-danger">
  		
  <i style="padding-right: 1em; font-size: 15px;" class="fa fa-info-circle" aria-hidden="true"></i> family entering not yet completed
  	</p>
  </div>

  </div>
  </div>


    <?php
 } else {

 ?>




<div class="panel-body">
	
	<a style="" href="customer.php" class="col-sm-offset-11 col-sm-1 btn btn-info btn-xs  ">back</a>
</div>
 <div class="panel">
 	
 	<div class="panel-body">
 	<?php echo show_error ($message); ?>

 	<div class="row">

 	<form class="form-horizontal bordered-row"  action="" method="post" data-parsley-validate>


 	                       
             <div class="form-group">
                 <label class="col-sm-4 control-label">Number Of Members</label>
                 <div class="col-sm-6">
                     <p  required class="form-control"   ><?php echo $card['members'];   ?></p>
                 </div>
             </div>


 	                       
             <div class="form-group">
                 <label class="col-sm-4 control-label text-capitalize">card no</label>
                 <div class="col-sm-6">
                     <p  required class="form-control"   ><?php echo $card['card_no'];   ?></p>
                 </div>
             </div>



 	                 




             <div class="form-group">
                 <label class="col-sm-4 control-label text-capitalize">  card type</label>
                 <div class="col-sm-6"> 
                     <p  required class="form-control"   ><?php echo $card['card_type'];   ?></p>


 
                 </div>
             </div>





             <div class="form-group">
                 <label class="col-sm-4 control-label text-capitalize">  monthly income</label>
                 <div class="col-sm-6">

<?php
//

	 $stmnt= 'SELECT SUM(income) AS income FROM `member`WHERE card_id = :card_id  AND delete_status = 0  ';
  	   

  	   $params=array( 
             ':card_id'  =>  $_GET['id']
  	   	);

$cincome = 0;
  	   $income = $db->display($stmnt,$params);
	  	if($income ){ 
	  		$cincome = $income[0]['income'];
	  	}



?>
 
                        <p  required class="form-control"   ><?php echo $cincome;   ?></p>

                      
 
                 </div>
             </div>




             <div class="form-group">
                 <label class="col-sm-4 control-label text-capitalize">ward no</label>
                 <div class="col-sm-6"> 
 
                        <p  required class="form-control"   ><?php echo $card['ward_no'];   ?></p>

                 </div>
             </div>


 	                       
             <div class="form-group">
                 <label class="col-sm-4 control-label text-capitalize">house no</label>
                 <div class="col-sm-6"> 

                        <p  required class="form-control"   ><?php echo $card['house_no'];   ?></p>
                 </div>
             </div>


 	                       
             <div class="form-group">
                 <label class="col-sm-4 control-label text-capitalize">name</label>
                 <div class="col-sm-6">  
                        <p  required class="form-control"   ><?php echo $card['name'];   ?></p>


                 </div>
             </div>


 	                       
             <div class="form-group">
                 <label class="col-sm-4 control-label text-capitalize">  area</label>
                 <div class="col-sm-6">  
                        <p  required class="form-control"   ><?php echo $card['area'];   ?></p>


                 </div>
             </div>


 	                       
             <div class="form-group">
                 <label class="col-sm-4 control-label text-capitalize">  location</label>
                 <div class="col-sm-6">  
                        <p  required class="form-control"   ><?php echo $card['location'];   ?></p>


                 </div>
             </div>
 	                       
             <div class="form-group">
                 <label class="col-sm-4 control-label text-capitalize">  pin	</label>
                 <div class="col-sm-6">  
                        <p  required class="form-control"   ><?php echo $card['pin'];   ?></p>



                 </div>
             </div>


 















             <?php
             $image_to = 'customer/images/';
             ?> 
             



  
   	<div class="form-group required" id="aimage_base">
   		<label class="col-sm-4 control-label">	Image</label>
   		<div class="col-md-6">  

   			<div class="photome">              
   			   <img  style="padding: 1em; max-width: 300px; width: 300px; height: auto;"  src="<?php echo  '../'.$image_to.$card['image']; ?>" class="img-responsive my_image_here" alt="update image"   onerror="javascript:this.src='../assets/images/default-1.jpg'" > 
   			</div>

   		</div>
   	</div> 
   
  


  
      </form>       


  

  
 	</div>



 		
 	</div>


 </div>

















 <?php

 }


    ?>  	




















<?php

	 $stmnt= 'SELECT * FROM `member` WHERE card_id= :card_id  AND delete_status = 0   ';
  	   

  	   $params=array( 
             ':card_id'  =>  $_GET['id']
  	   	);


  	   $result = $db->display($stmnt,$params);

if($result){

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
    
    <th>name</th> 
    <th>dob</th>
    <th>gender</th>
    <th>occupation</th>
    <th>income</th>
    <th>NRK</th>
    <th>relation</th>
    <th>proof</th>
    <th>proof no</th>   
    
</tr>
</thead>
<tbody>
    <?php  




     foreach($result as $value) {?>
<tr>
    
    <td><?php echo $value['name']; ?></td> 
    <td><?php echo $value['dob']; ?></td>
    <td><?php echo $value['gender']; ?></td>
    <td><?php echo $value['occupation']; ?></td>
    <td><?php echo $value['income']; ?></td>
    <td><?php if($value['NRK'] == "1") echo "true"; else echo "false"; ?></td>
    <td><?php echo $value['relation']; ?></td>
    <td><?php echo $value['proof']; ?></td>
    <td><?php echo $value['proof_no']; ?></td> 
     
    
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
}

?>












<?php
 

 
  $sql="SELECT ct.* ,c.*, d.distribution_id  ,
        p.pr_name ,
         date_format(ct.date , '%d-%M-%Y  - %r') AS ddate,
         ct.month AS mmt





  FROM `card_transaction` ct LEFT JOIN card c ON c.card_id = ct.card_id LEFT JOIN distribution d ON d.distribution_id = ct.distribution LEFT JOIN product p ON p.pr_id = d.product WHERE c.card_id =".$_GET['id'] ."   ";

  
  

  $sql = $sql . " ORDER BY ct.date DESC   ";
 


$resulta=$db->display($sql);
 
?>





    <div class="panel">
<div class="panel-body">
<h3 class="title-hero">
    Datatables row highlight
</h3>
<div class="example-box-wrapper">

<div class="row">
  <div class="col-md-2"> <strong> Product</strong></div>
  <div class="col-md-2"> <strong> Total</strong></div>
  <div class="col-md-2"> <strong> card type</strong></div>
  <div class="col-md-2"> <strong> Month</strong></div>
  <div class="col-md-4"> <strong> Date</strong></div>
</div>





    <?php  
     foreach($resulta as $value) {?>


<div class="row">
  <div class="col-md-2"> <p> <?php echo $value['pr_name']; ?></p></div>
  <div class="col-md-2"> <p> <?php echo $value['total']; ?></p></div>
  <div class="col-md-2"> <p> <?php echo $value['card_type']; ?></p></div>
  <div class="col-md-2"> <p> <?php echo $value['mmt']; ?></p></div>
  <div class="col-md-4"> <p> <?php echo $value['ddate']; ?></p></div>
</div>


<?php 
     }
    ?> 


 
</div>
</div>
</div>






























<!-- image upload js -->

<form name="photo" action="" method="post" enctype="multipart/form-data" id="uploadFileForm"  > 
  <input type="file" name="image" size="30" class="hidden"  id="uploadFile" accept="image/x-png, image/gif, image/jpeg" /> 
  <input type="submit" name="upload" value="Upload" class="hidden" id="upladimagepfinalsub"/>
</form>

<div>
 <!-- Button trigger modal -->
 <button type="button" id="setImg" class="btn btn-primary hidden" data-target="#modal" data-toggle="modal"> </button>

 <!-- Modal -->
 <div class="modal fade dmodel" id="modal" role="dialog" aria-labelledby="modalLabel" tabindex="-1" to_this=""   >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Crop image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="img-container">
          <img id="image" src="<?php echo PATH; ?>/assets/images/loding.gif" alt="Picture">
        </div>
      </div>
      <div class="modal-footer"> 

        <input type="hidden" id="x" name="x" />
        <input type="hidden" id="y" name="y" />
        <input type="hidden" id="w" name="w" />
        <input type="hidden" id="h" name="h" />

        <input type="hidden" id="r" name="r" />
        <input type="hidden" id="sx" name="sx" />
        <input type="hidden" id="sy" name="sy" />
        <button type="button" id="crop_btn" class="btn btn-default" data-dismiss="modal">save</button>
      </div>
    </div>
  </div>
</div>
</div>




<?php include_once( '../footer.php' ); ?>






































<?php } else {


	echo "<script type='text/javascript'>location.href='verification.php'</script>";

	}?>