
<?php
include_once('../header.php');
$db=new Database();
?>
      
<?php


if ($_POST) { 
    
     $_SESSION['POST'] =  $_POST; 
 echo "<script type='text/javascript'>location.href='".$_SERVER['REQUEST_URI']."'</script>";
     exit();
}
if (isset($_SESSION ['POST'])) {
  $_POST = $_SESSION['POST'];
  unset($_SESSION['POST']);
}
 

?>







<?php

if(isset($_POST['newKey'])){


	$digits = 4;
	$maRand =  rand(pow(10, $digits-1), pow(10, $digits)-1);

	$array = array(  
	         "userKey"    => $maRand   

	         );

	




	$result  = updateTable ('card', $array, ' card_id = '. $_SESSION['userid'], $db );



}





 
  $sql=' SELECT * fROM card WHERE delete_status = 0 AND card_id = '.$_SESSION['userid'];
 


$result=$db->display($sql);


 

?>






 


    <div class="panel">
<div class="panel-body"> 
<div class="example-box-wrapper">


            <form class="form-horizontal  "  action="" method="post" data-parsley-validate>
                <div class="row">

 

 

                 <div class="form-group">
                        <label style="margin-top: 5em;" class="col-sm-3 control-label">User Key</label>
                        <div class="col-sm-6">
                             <p style="
    font-size: 9em;
    font-weight: inherit;
    text-align: center;
"><?php

                             if($result) 
                             	echo $result[0]['userKey'];


                             ?></p>
                        </div>
                        <div class="col-sm-3">
                       <input style="margin-top: 3em;" type="submit" name="newKey" value="New Key" class="btn btn-lg btn-primary">
                        </div>
                    </div>




                    </div>  



 




                    </form>



 









 
</div>
</div>
</div>





<?php




     
    $card_id = $_SESSION['userid'];


    $vt056 = array();

    $sql=' SELECT * fROM card WHERE card_id =  '.$card_id;


    $cardidoldd = $db->display($sql); 
	if ($cardidoldd) { 
		$cardidoldd = $cardidoldd[0];




	     $sql=' SELECT DISTINCT(product) AS product fROM distribution WHERE ration_shop =  '.$cardidoldd['shop_id'].' AND month ="'.date('m-Y').'"  '.
	   ' AND  '.$cardidoldd['card_type'].' >0 AND Q'.$cardidoldd['card_type'].' > 0 ';


	    $distributionft = $db->display($sql); 
        if ($distributionft) { 

        	$vt0 = array();
        	$into = 0;
        	foreach ($distributionft as $distdutdtvalue) { 
				$vt0 [$into] = $distdutdtvalue['product'];
				$into++;
        	} 




        	  $sql=' SELECT * FROM `card_transaction` ct LEFT JOIN distribution d ON d.distribution_id = ct.distribution WHERE ct.card_id ='. $_SESSION['userid'].' AND ct.month ="'.date('m-Y').'" AND   d.delete_status = 0 ';
 
        	 $nte234 = $db->display($sql);  
        	         	foreach ($nte234 as $distdutdtvalue) {  
        	         		if ( in_array( $distdutdtvalue['product'] , $vt0) ){  
        	         			$retS333 = array_search( $distdutdtvalue['product'] , $vt0); 
        	         			unset($vt0[$retS333]);  

        	         		}   
        	         	} 

 
        	 $into = 0;


        	 foreach ($vt0 as   $val67ue) {

 
      
        $sql='SELECT d.*   ,
            p.pr_name   FROM `distribution` d LEFT JOIN product p ON p.pr_id = d.product  WHERE   d.ration_shop =  '.$cardidoldd['shop_id'].' AND d.month ="'.date('m-Y').'"    AND  d.'.$cardidoldd['card_type'].' >0 AND d.Q'.$cardidoldd['card_type'].' > 0  AND d.product = '.$val67ue.' ORDER BY d.date DESC LIMIT 1  ';
 

	 		    $div3ss4 = $db->display($sql); 
	 	        if ($div3ss4) {
	 	        	$vt056[$into] = $div3ss4[0];
	 	        	$into++;
	 	         }


        	 }

 


        } 



	}
 
 

if($vt056) {
?>
 

<div class="panel">
<div class="panel-body"> 
<div class="example-box-wrapper">
<h3 class="text-capitalize" style="padding: 1em 3em;">you have new products <small> go to your ration shop</small></h3>

            <form class="form-horizontal  "  action="" method="post" data-parsley-validate>

     <?php
     foreach ($vt056 as  $value) { 
?>

	<div class="row"> 


 		<div class="col-sm-3">
 			<div class="form-group">
 			       <label   class="col-sm-3 control-label">product</label>
 			       <div class="col-sm-6">
 			            <p  class="form-control"><?php echo $value['pr_name']; ?> </p>
 			       </div>
 			       
 			   </div>

 		</div>


 		<div class="col-sm-3">
 			<div class="form-group">
 			       <label   class="col-sm-3 control-label">quentity</label>
 			       <div class="col-sm-6">
 			            <p  class="form-control"><?php echo $value[''.$cardidoldd['card_type']]; ?> </p>
 			       </div>
 			       
 			   </div>

 		</div>


 		<div class="col-sm-3">
 			<div class="form-group">
 			       <label   class="col-sm-3 control-label">unit price</label>
 			       <div class="col-sm-6">
 			            <p  class="form-control"><?php echo $value['Q'.$cardidoldd['card_type']]; ?> </p>
 			       </div>
 			       
 			   </div>

 		</div>



 		<div class="col-sm-3">
 			<div class="form-group">
 			       <label   class="col-sm-3 control-label">total price</label>
 			       <div class="col-sm-6">
 			            <p  class="form-control"><?php 

$n1 = $value[''.$cardidoldd['card_type']];
$n2 = $value['Q'.$cardidoldd['card_type']];


echo ($n1 * $n2);


 			            ?> </p>
 			       </div>
 			       
 			   </div>

 		</div>



    </div>   





<?php
     }

     ?>       

     </form>


 
</div>
</div>
</div>
<?php
}
?>


 




<?php



	include_once( '../footer.php' );
?>