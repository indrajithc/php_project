
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
                        <label class="col-sm-3 control-label">Ration Shop</label>
                        <div class="col-sm-6">
                            <select name="ration_shop"   onchange="this.form.submit();"  class="form-control" id="ration_shop" required>
                                <option disabled="disabled" selected="selected">Select</option>
                                <?php 


    $sql = ' SELECT rs.shop_id, rs.shop_no, t.name AS taluk , d.district_name AS district  FROM `ration_shop` rs LEFT JOIN taluk t ON t.taluk_id = rs.taluk_id LEFT JOIN district d ON t.dist = d.dist_id  ';
    $products = $db->display($sql); 
                                if ($products) { 

                                    foreach ($products as $product) { ?>

                                        <option value="<?php echo $product['shop_id'] ?>" 


<?php if( isset( $_POST['ration_shop'] ) ) if( $_POST['ration_shop']  ==$product['shop_id'] ) echo ' selected'; ?>

 
 > <?php  echo '<span class="float-left"> '.$product['shop_no'] . ' </span><span class="float-center" >    ' . $product['taluk'] . '  </span><span class="float-right" >   ' . $product['district']. '</span>'; ?></option>

                                    <?php } 
                                     } ?>
                            </select>
                        </div>
                    </div>




                    </div>  
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

if (isset($_POST['product']) && isset($_POST['ration_shop'])) {


    $ration_shop = $_POST['ration_shop'];



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


 $sql = 'select * from  distribution WHERE delete_status = 0 AND ration_shop ='.$ration_shop.' AND month="'.$motha.'" AND product = '. $_POST['product'].' ORDER BY date DESC LIMIT 1';
 $distribution = $db->display($sql); 
                             if ($distribution) {

$distribution = $distribution[0];




$sql = 'select * from  distribution WHERE delete_status = 0 AND ration_shop ='.$ration_shop.' AND month="'.$motha.'" AND product = '. $_POST['product'].' ORDER BY date DESC ';
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
    <td> <a href="edit_customer.php?id=<?php echo $value['card_id']; ?>" target="_blank" class="btn btn-info btn-xs"><?php echo $value['card_no']; ?></a> </td>
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