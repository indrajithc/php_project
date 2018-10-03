
<?php
include_once('../header.php');
$db=new Database();
?>
      


<?php

$message = array(null, null);

if ($_POST) { 
    
     $_SESSION['POST'] =  $_POST; 
 echo "<script type='text/javascript'>location.href='".$_SERVER['REQUEST_URI']."'</script>";
     exit();
}
if (isset($_SESSION ['POST'])) {
  $_POST = $_SESSION['POST'];
  unset($_SESSION['POST']);
}
 







$ration_shop = $_SESSION['userid'];




    if(isset($_POST['completet'])){

        $userKey = $_POST['userKey']; 


        $motha =  date('m-Y');

        $sql = 'select * from  distribution WHERE delete_status = 0 AND ration_shop ='.$_SESSION['userid'].' AND month="'.$motha.'" ORDER BY date DESC ';
        $totalFind = $db->display($sql);  
        $totQ = 0; 
        if ($totalFind) { 
                       foreach ($totalFind as   $totalFindvalue) { 
                           $totQ = $totQ + $totalFindvalue['quantity']; 
                       } 
                    }

         $reming = -1;
         $utotal = $_POST['utotal'];

         $reming =  ($totQ - $utotal);           





         $distributionaz = 0;
             $sql = 'select * from  distribution WHERE delete_status = 0 AND ration_shop ='.$_SESSION['userid'].' AND month="'.$motha.'" ORDER BY date DESC LIMIT 1';
          $distributiona = $db->display($sql); 
                                      if ($distributiona) {
                                 $distributionaz = $distributiona[0]['distribution_id'];
                             }

 
if( $reming > 0 &&  $distributionaz>0 ){







             $sql = 'select * from  card WHERE delete_status = 0 AND login = 1 AND userKey = "'.$userKey.'" AND card_id = '.$_POST['card'];
            $isAuser = $db->display($sql); 
            if ($isAuser[0]['userKey'] == $userKey && isset($isAuser[0])) { 

                

                $array = array( 
                         "card_id"    => $_POST['card'] ,
                         "total"    => $_POST['ttotal'] ,
                         "distribution"    =>  $distributionaz ,
                         "month"    =>  $motha ,
                         "userKey"      => $userKey 

                         );

                $result  = insertInToTable ('card_transaction', $array, $db );
                if( $result == 1) {

 
                    $array = array(  
                             "r_quantity"    => $reming
                             ); 
                    $result  = updateTable (' distribution ', $array, '  distribution_id = '. $distributionaz, $db );
                    if( $result == 1) {

                        $_POST['card'] = null;

                          $message [0] = 1;
                          $message [1] = ' successfully Added';  



                        }else  {
                          $message [0] = 3;
                          $message [1] = 'Something is wrong, ensure values are correct ! '; 

                        }

 
                }else  {
                  $message [0] = 3;
                  $message [1] = 'Something is wrong, ensure values are correct ! '; 

                }


                }else {

                    $message [0] = 4;
                    $message [1] = 'Authentication failed ! '; 
                }


} else {

    $message [0] = 2;
    $message [1] = 'out of stock! '; 


}










    }






?>





<div class="panel">
        <div class="panel-body">
            <h3 class="title-hero">
                Elements
            </h3>


<?php echo show_error ($message); ?>
            <form class="form-horizontal bordered-row"  action="" method="post" data-parsley-validate>
                <div class="row">

 

 

                 <div class="form-group">
                        <label class="col-sm-3 control-label">Product</label>
                        <div class="col-sm-6">
                            <select name="product"   onchange="this.form.submit();"  class="form-control" id="product" required>
                                <option disabled="disabled" selected="selected">Select</option>
                                <?php 


    $sql = 'select * from  product WHERE delete_status = 0';
    $products = $db->display($sql); 
                                if ($products) { 

                                    foreach ($products as $product) { ?>

                                        <option value="<?php echo $product['pr_id'] ?>" 


<?php if( isset( $_POST['product'] ) ) if( $_POST['product']  ==$product['pr_id'] ) echo ' selected'; ?>

 

                                        > <?php echo $product['pr_name'] . '-' . $product['price']; ?></option>

                                    <?php } 
                                     } ?>
                            </select>
                        </div>
                    </div>




                    </div>  


<?php

if (isset($_POST['product'])) {




    $sql = 'select * from product WHERE delete_status = 0 AND pr_id = '.$_POST['product'];
    $products = $db->display($sql); 
                                if ($products) { $products = $products[0];


?>





 
                
<?php
 if(isset($_POST['product'])   ){

?>


<?php

$motha =  date('m-Y');

?>


 


<div class="row">
     
    
                 <div class="form-group">
                        <label class="col-sm-3 control-label text-right">Moth</label>
                        <div class="col-sm-6">
                              <input type="text"  required  value="<?php


                               echo $motha;

                              ?>"      class="form-control" name="ototal"   placeholder="Quantity.."  >
                        </div> 

</div>




</div>



 <?php

if ($motha) {


   $sql = 'select * from  distribution WHERE delete_status = 0 AND ration_shop ='.$ration_shop.' AND month="'.$motha.'" ORDER BY date DESC LIMIT 1';
 $distribution = $db->display($sql); 
                             if ($distribution) {

$distribution = $distribution[0];




     $sql = 'select * from  distribution WHERE delete_status = 0 AND ration_shop ='.$ration_shop.' AND month="'.$motha.'" ORDER BY date DESC ';
 $totalFind = $db->display($sql); 

 $totQ = 0;
 $toP = 0;

                             if ($totalFind) {

                                foreach ($totalFind as   $totalFindvalue) {


                                    $totQ = $totQ + $totalFindvalue['quantity'];


                                }

                             }

$tottrsa = $distribution['r_quantity'];




 ?>




                        <div class="row">
                            


                        <div class=" col-md-3">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">  Quantity</label>
                                <div class="col-sm-6"> 

                                <p  required class="form-control"   ><?php echo $totQ; ?></p>


                                </div>
                            </div>
                            </div>



                        <div class=" col-md-3">
                            <div class="form-group">
                                <label class="col-sm-5 control-label"> Remaining Quantity </label>
                                <div class="col-sm-6"> 

                                <p  required class="form-control"   ><?php  echo $tottrsa; ?></p>


                                </div>
                            </div>
                            </div>


 
                        
                        </div>








                                                <div class="row well" style="margin-bottom: 1em;">
                                                    
                        <p> Price</p>


                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label">APL</label>
                                                        <div class="col-sm-6">
                                                          
                                                            <div class=" input-group">
                                                            <span class="input-group-addon"> <i class="fa fa-inr" aria-hidden="true"></i></span>
                                                              
                                                           <p  required class="form-control"   ><?php echo $distribution['APL']; ?></p>


                                                            </div>



                                                        </div>
                                                    </div>
                                                    </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label">BPL</label>
                                                        <div class="col-sm-6">
                                                           

                                                            <div class=" input-group">
                                                            <span class="input-group-addon"> <i class="fa fa-inr" aria-hidden="true"></i></span>
                                                            <p  required class="form-control"   ><?php echo $distribution['BPL']; ?></p>


                                                            </div>



                                                        </div>
                                                    </div>
                                                    </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label">AAY</label>
                                                        <div class="col-sm-6">
                                                        
                                                            <div class=" input-group">
                                                            <span class="input-group-addon"> <i class="fa fa-inr" aria-hidden="true"></i></span>
                                                              
                                                           <p  required class="form-control"   ><?php echo $distribution['AAY']; ?></p>



                                                            </div>



                                                        </div>
                                                    </div>
                                                    </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label">ANP</label>
                                                        <div class="col-sm-6">                                    
                                                       
                                                            <div class=" input-group">
                                                            <span class="input-group-addon"> <i class="fa fa-inr" aria-hidden="true"></i></span>
                                                           <p  required class="form-control"   ><?php echo $distribution['ANP']; ?></p>



                                                            </div>



                                                        </div>
                                                    </div>
                                                    </div>
                         


                                                </div>


                                                <div class="row well">
                                                    
                        <p> Quantity</p>


                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label">APL</label>
                                                        <div class="col-sm-6">
                                                              <div class=" input-group">

                                                            <p  required class="form-control"   ><?php echo $distribution['QAPL']; ?></p>

                                                               
                                                            <span class="input-group-addon"> U</span> 

                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label">BPL</label>
                                                        <div class="col-sm-6">
                                                        
                                                              <div class=" input-group">
                            <p  required class="form-control"   ><?php echo $distribution['QBPL']; ?></p>

                                                               
                                                            <span class="input-group-addon"> U</span> 

                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label">AAY</label>
                                                        <div class="col-sm-6">
                                                        
                                                           <div class=" input-group">
                         <p  required class="form-control"   ><?php echo $distribution['QAAY']; ?></p>
                            
                                                            <span class="input-group-addon"> U</span> 

                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label">ANP</label>
                                                        <div class="col-sm-6">                                    
                                                      
                                                          <div class=" input-group">
                          <p  required class="form-control"   ><?php echo $distribution['QANP']; ?></p>

                                                               
                                                            <span class="input-group-addon"> U</span> 

                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                         


                                                </div>








                 <div class="row ">

  

  

                  <div class="form-group">
                         <label class="col-sm-3 control-label">card</label>
                         <div class="col-sm-6">
                             <select name="card"   onchange="this.form.submit();"  class="form-control card" id="card" required>
                                 <option disabled="disabled" selected="selected">Select</option>
                                 <?php 




          
         $ration_shop = $_SESSION['userid'];

 

          
           $sql=' SELECT c.*, m.name AS member_name, date_format(c.date , "%d-%M-%Y  - %r") AS ddate FROM `card` c LEFT JOIN member m ON m.card_id = c.card_id WHERE m.type = 1  AND c.login = 1  AND  c.shop_id ='.$ration_shop.'  AND c.card_id NOT IN ( SELECT ct.card_id FROM  card_transaction ct LEFT JOIN distribution d ON d.distribution_id = ct.distribution LEFT JOIN ration_shop rs ON d.ration_shop = rs.shop_id WHERE rs.shop_id= '.$ration_shop.' AND ct.month = "'.date('m-Y').'"   )  ORDER BY c.card_no ASC';



 

     $pcradroducts = $db->display($sql); 
                                 if ($pcradroducts) { 

                                     foreach ($pcradroducts as $product) { ?>

                                         <option value="<?php echo $product['card_id'] ?>" 


 <?php if( isset( $_POST['card'] ) ) if( $_POST['card']  ==$product['card_id'] ) echo ' selected'; ?>

  

                                         > <?php echo $product['card_no'] . '-' . $product['member_name']; ?></option>

                                     <?php } 
                                      } ?>
                             </select>
                         </div>

<?php
if(isset($_POST['card'])){

?> 
                                <a href="card_customer.php?id=<?php echo $_POST['card']; ?>" target="_blank" class="col-sm-offset-1 col-sm-1 btn btn-warning bt-xs">more</a>
                           

 <?php
}
 ?>
                     </div>




                     </div>  


           




        <?php 









if (isset($_POST['product'])   && isset($_POST['card'])) {


          ?>
 

                                <?php 



 

         
          $sql=' SELECT c.*, m.name AS member_name, date_format(c.date , "%d-%M-%Y  - %r") AS ddate FROM `card` c LEFT JOIN member m ON m.card_id = c.card_id WHERE m.type = 1  AND c.login = 1  AND  c.card_id ='.$_POST['card'].'  ORDER BY c.card_no ASC ';





    $caessds = $db->display($sql); 
                                if ($caessds) { 

                                    $caessds = $caessds[0];


 ?>


<div class="row well">



                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Name</label>
                                <div class="col-sm-8"> 

                                    <p  required class="form-control"   ><?php echo $caessds['member_name']; ?></p>

                                    
                                </div>
                            </div>
                            </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Type</label>
                                <div class="col-sm-8">
                                 
    <p  required class="form-control"   ><?php echo $caessds['card_type']; ?></p>

                                    
                                </div>
                            </div>
                            </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Members</label>
                                <div class="col-sm-8"> 

                                    <p  required class="form-control"   ><?php echo $caessds['members']; ?></p>

                                    
                                </div>
                            </div>
                            </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">monthly income</label>
                                <div class="col-sm-8">
                                 

                                  <div class=" input-group">
                                  <span class="input-group-addon"> <i class="fa fa-inr" aria-hidden="true"></i></span>
                                    
                               
    <p  required class="form-control"   ><?php echo $caessds['monthly_income']; ?></p>


                                  </div>   

                                </div>
                            </div>
                            </div>



</div>


<div class="row ">


                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Quantity</label>
                                <div class="col-sm-8">
                                
                                   <div class=" input-group">
 <p  required class="form-control"   ><?php echo $distribution['Q'.$caessds['card_type'] ]; ?></p>
    
                                    <span class="input-group-addon"> U</span> 

                                    </div>
                                </div>
                            </div>
                            </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Price</label>
                                <div class="col-sm-8">                                    
                              
                                  <div class=" input-group">
                                    <span class="input-group-addon"> <i class="fa fa-inr" aria-hidden="true"></i></span>
                                  
  <p  required class="form-control"   ><?php echo $distribution[''.$caessds['card_type'] ]; ?></p>

                                        

                                    </div>
                                </div>
                            </div>
                            </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Total Price</label>
                                <div class="col-sm-8" style="background: #08c;">                                    
                              
                                  <div class=" input-group">
                                    <span class="input-group-addon"> <i class="fa fa-inr" aria-hidden="true"></i></span>
                                  
  <p  required class="form-control"   ><?php 

$ad1 = $distribution['Q'.$caessds['card_type'] ];

$ad2 = $distribution[''.$caessds['card_type'] ];


  echo ($ad1  * $ad2); ?></p>


<input type="hidden" name="utotal" value="<?php 

echo $ad1;

?>" >
 
<input type="hidden" name="ttotal" value="<?php 

 echo ($ad1  * $ad2); 

?>" >
 
 

                                        

                                    </div>
                                </div>
                            </div>
                            </div>
 





     </div>       




     <div class="row ">


     <?php




 




if( $tottrsa >= $ad1 ){

     ?>

     <div class="bg-info clearfix" style="padding: 2em;">


     <div class="col-sm-6 float-left">
         
     
         <input type="password" name="userKey" class="form-control  float-" placeholder="User Key" required>
     </div>
 


       <button class="col-sm-4 btn btn-primary float-right" name="completet" value="completet">completet</button>



     </div>




     <?php
} else {

?>
 
        <p class="bg-danger" style="padding: 3em;">not enough stock !</p>
   



<?php

}

     ?>


     </div>


 <?php
                                     }  
 ?>




           

  

     <?php  } ?>





<?php
}

}

?>

 
<?php
}

?>

<?php
}
}

?>

            </form>
        </div>
    </div>











<?php

if(isset($_POST['product'])){
 

 
  $sql="SELECT ct.* ,c.*, d.distribution_id  ,
        p.pr_name ,
         date_format(ct.date , '%d-%M-%Y  - %r') AS ddate





  FROM `card_transaction` ct LEFT JOIN card c ON c.card_id = ct.card_id LEFT JOIN distribution d ON d.distribution_id = ct.distribution LEFT JOIN product p ON p.pr_id = d.product WHERE d.ration_shop =".$ration_shop ."  AND  d.month='".date('m-Y')."' ";

  
  

  $sql = $sql . " ORDER BY ct.date DESC   ";
 


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
    
    <th>Product</th>  
    <th>Card</th>
    <th>Total</th>
    <th>card type</th> 
    <th>Date</th>  
    
</tr>
</thead>
<tbody>
    <?php  
     foreach($result as $value) {?>
<tr>
    
    <td><?php echo $value['pr_name']; ?></td>  
    <td> <a href="card_customer.php?id=<?php echo $value['card_id']; ?>" target="_blank" class="btn btn-info btn-xs"><?php echo $value['card_no']; ?></a> </td>
    <td><?php echo $value['total']; ?></td>
    <td><?php echo $value['card_type']; ?></td> 
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

}
?>









<script type="text/javascript">
    
$(document).ready(function() {





    $("#month").datepicker({
    format: "mm-yyyy",
    viewMode: "months", 
    minViewMode: "months",
    startDate: '0m'
    }).on('changeDate', function(e){  
       $(this).closest('form').submit();
     });


    $('input[name="quantity"], input[name="price"]').change( function(){ 

        var n1 = $('input[name="quantity"]').val();
        var n2 = $('input[name="price"]').val();

        if(n1>0 && n2>0){
            $('input[name="total_price"]').val( n1 * n2 );

            var t1 = (  parseInt($('input[name="oquantity"]').val())  -  parseInt(n1) );


            if(t1<0) {

                $('input[name="quantity"]').val(  $('input[name="oquantity"]').val() );

                 n1 = $('input[name="quantity"]').val();
            }



            
            $('input[name="nquantity"]').val(  (  parseInt($('input[name="oquantity"]').val())  -  parseInt(n1) ) );

            $('input[name="ntotal"]').val(  ( parseInt($('input[name="ototal"]').val() ) - (n1 * n2 )) );
        } else {

            $('input[name="total_price"]').val("" );
        }





    } );

  
});

</script>
<?php include_once('../footer.php');  ?>