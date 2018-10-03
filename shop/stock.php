
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





 


<div class="row">
     
    
                 <div class="form-group">
                        <label class="col-sm-3 control-label text-right">Moth</label>
                        <div class="col-sm-6">
                              <input type="text"  required name="month" id="month" value="<?php

                              if (isset($_POST['month'])) 
                               echo $_POST['month'];

                              ?>"      class="form-control" name="ototal"   placeholder="Quantity.."  >
                        </div> 

</div>




</div>



 <?php

if (isset($_POST['month'])) {


   $sql = 'select * from  distribution WHERE delete_status = 0 AND ration_shop ='.$ration_shop.' AND month="'.$_POST['month'].'" ORDER BY date DESC LIMIT 1';
 $distribution = $db->display($sql); 
                             if ($distribution) {

$distribution = $distribution[0];




     $sql = 'select * from  distribution WHERE delete_status = 0 AND ration_shop ='.$ration_shop.' AND month="'.$_POST['month'].'" ORDER BY date DESC ';
 $totalFind = $db->display($sql); 

 $totQ = 0;
 $toP = 0;

                             if ($totalFind) {

                                foreach ($totalFind as   $totalFindvalue) {


                                    $totQ = $totQ + $totalFindvalue['quantity'];


                                }

                             }






 ?>




                        <div class="row">
                            
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


                        <div class="row">
                            
<p> Quantity</p>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">APL</label>
                                <div class="col-sm-6">
                                      <div class=" input-group">

                                    <p  required class="form-control"   ><?php echo $distribution['QAPL']; ?></p>

                                       
                                    <span class="input-group-addon"> Kg</span> 

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

                                       
                                    <span class="input-group-addon"> Kg</span> 

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
    
                                    <span class="input-group-addon"> Kg</span> 

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

                                       
                                    <span class="input-group-addon"> Kg</span> 

                                    </div>
                                </div>
                            </div>
                            </div>
 


                        </div>




 

            


<div class="row">


 

                        <div class="col-md-offset-4 col-md-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">  Quantity</label>
                                <div class="col-sm-6"> 

                                                           
                                                                  <div class=" input-group">
                                <p  required class="form-control"   ><?php echo $totQ; ?></p>
                                    
                                                                   <span class="input-group-addon"> Kg</span> 

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

if(isset($_POST['product']) && isset($_POST['month'])){
 

 
  $sql='select s.*, date_format(s.date , "%d-%M-%Y  - %r") AS adate , p.pr_name AS aproduct, p.price AS p_price, r.shop_no from distribution s LEFT JOIN  product p ON s.product = p.pr_id LEFT JOIN ration_shop r ON r.shop_id = s.ration_shop WHERE s.delete_status = 0 AND s.product ='.$_POST['product'] ." AND s.ration_shop =".$ration_shop ." AND s.month='".$_POST['month']."' ORDER BY s.date DESC";
 


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
    <th>Quantity</th>
    <th>Price</th>
    <th>APL</th>
    <th>Q</th>
    <th>BPL</th>
    <th>Q</th>
    <th>AAY</th>
    <th>Q</th>
    <th>ANP</th>
    <th>Q</th>
    <th>Date</th>  
    
</tr>
</thead>
<tbody>
    <?php  
     foreach($result as $value) {?>
<tr>
    
    <td><?php echo $value['aproduct']; ?></td>  
    <td><?php echo $value['quantity']; ?></td>
    <td><?php echo $value['price']; ?></td>
    <td><?php echo $value['APL']; ?></td>
    <td><?php echo $value['QAPL']; ?></td>
    <td><?php echo $value['BPL']; ?></td>
    <td><?php echo $value['QBPL']; ?></td>
    <td><?php echo $value['AAY']; ?></td>
    <td><?php echo $value['QAAY']; ?></td>
    <td><?php echo $value['ANP']; ?></td>
    <td><?php echo $value['QANP']; ?></td>
    <td><?php echo $value['adate']; ?></td> 
     
    
 

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