
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
 


    if (isset($_POST['submite'])) {


        $product = $_POST['product'];
        $quantity = $_POST['quantity'];



        $sql = 'select * from product WHERE delete_status = 0 AND pr_id = '.$_POST['product'];
        $products = $db->display($sql); 
         if ($products) { $products = $products[0];

            $price = $products['price'];


            $total_price  = $price* $quantity;




            $message [0] = 2;
            $message [1] = 'Something is wrong '; 



              $stmnt="SELECT  * FROM distribution WHERE product = '" . $_POST['product'] . "' AND  ration_shop = " .$_POST['ration_shop'] . "  AND  quantity = " .$_POST['quantity'] . "  AND  month = '" .$_POST['month'] . "'  AND delete_status = 0 ";
            $product = $db->display( $stmnt);
            if( $product ){

             $message [0] = 3;
             $message [1] = 'already exists'; 

        } else {




                $sql = 'select * from  distribution WHERE delete_status = 0 AND ration_shop ='.$_POST['ration_shop'].' AND month="'.trim($_POST['month'], " " ) .'" ORDER BY date DESC ';
            $totalFind = $db->display($sql);  
            $totQ = $_POST['quantity'];  
            if ($totalFind) {
               foreach ($totalFind as   $totalFindvalue) {
                   $totQ = $totQ + $totalFindvalue['quantity'];
               }
            }

            




                $array = array(  "product"      => $_POST['product'] ,
                     "ration_shop"      => $_POST['ration_shop'] ,
                     "quantity"      => $_POST['quantity'] ,
                     "r_quantity"      =>  $totQ,
                     "price"      => $price ,
                     "QAPL"      => $_POST['QAPL'] ,
                     "QBPL"      => $_POST['QBPL'] ,
                     "QAAY"      => $_POST['QAAY'] ,
                     "QANP"      => $_POST['QANP'] ,

                     "APL"      => $_POST['APL'] ,
                     "BPL"      => $_POST['BPL'] ,
                     "AAY"      => $_POST['AAY'] ,
                     "ANP"      => $_POST['ANP'] ,
                     "month"      => trim($_POST['month'], " " ) );


                $result  = insertInToTable ('distribution', $array, $db );



                if( $result == 1) {



            $ttotq =( $products['quantity'] - $quantity ) ;    
            $total_price =   ( $products['price'] * $ttotq  );

                    $array = array(  "quantity"      =>  $ttotq, 
                         "total_price"          => $total_price );


                    $result  = updateTable ('product', $array, ' pr_id = '.$_POST['product'], $db );
                    if( $result == 1) {


                    $message [0] = 1;
                    $message [1] = 'stock successfully Added'; 

                    }
 

            
 



                }else  {
                    $message [0] = 3;
                    $message [1] = 'Something is wrong, ensure values are correct ! '; 

                }



}













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
                        <div class="row">




                    <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Price</label>
                                <div class="col-sm-6">

                                 <div class=" input-group">
                                    <span class="input-group-addon"> <i class="fa fa-inr" aria-hidden="true"></i></span>
                                      
                                    <input type="number" disabled="disabled" value="<?php echo $products['price'];  ?>"    name="price" class="form-control" placeholder="Price.." name="price">     

                                    </div>


                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">  Quantity</label>
                                <div class="col-sm-6">


                 <div class=" input-group"> 

                                               
                                    <input type="number"   disabled="disabled" value="<?php echo $products['quantity'];  ?>"      class="form-control" id="oQuantity" placeholder="Quantity.." name="oquantity">                          <span class="input-group-addon"> U</span>
                                                

                                                </div>
                                                

                                </div>
                            </div>
                            </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">  Total</label>
                                <div class="col-sm-6">
                                 

                                        <div class=" input-group">
                                    <span class="input-group-addon"> <i class="fa fa-inr" aria-hidden="true"></i></span>
                                      
                                       <input type="number"   disabled="disabled" value="<?php  echo  $products['price'] *  $products['quantity'];  ?>"      class="form-control" name="ototal"   placeholder="Quantity.."  >

                                    </div>


                                    
                                </div>
                            </div>
                            </div>

                        </div>




 


<div class="row">
     
    
                 <div class="form-group">
                        <label class="col-sm-3 control-label text-right">Shop</label>
                        <div class="col-sm-6">
                            <select name="ration_shop"   onchange="this.form.submit();"  class="form-control" id="ration_shop" required>
                                <option disabled="disabled" selected="selected">Select</option>
                                <?php 


    $sql = 'select * from  ration_shop WHERE delete_status = 0';
    $products = $db->display($sql); 
                                if ($products) { 

                                    foreach ($products as $product) { ?>

                                        <option value="<?php echo $product['shop_id'] ?>" 


<?php if( isset( $_POST['ration_shop'] ) ) if( $_POST['ration_shop']  ==$product['shop_id'] ) echo ' selected'; ?>

 

                                        > <?php echo $product['shop_no'] . '-' . $product['emp_name']; ?></option>

                                    <?php } 
                                     } ?>
                            </select>
                        </div> 

</div>



</div>
                       
<?php
 if(isset($_POST['product']) && isset($_POST['ration_shop']) ){

?>





 


<div class="row">
     
    
                 <div class="form-group">
                        <label class="col-sm-3 control-label text-right">Moth</label>
                        <div class="col-sm-6">
                              <input type="text"  required name="month" id="month" value=" "      class="form-control" name="ototal"   placeholder="Quantity.."  >
                        </div> 

</div>




</div>



 




                        <div class="row">
                            
<p>Distributing quentityin U </p>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">APL</label>
                                <div class="col-sm-6">
                                    
                                    <div class=" input-group">

                                    <input type="number"   min="1" required class="form-control" id="QAPL" placeholder="APL.." name="QAPL">


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
                                    <input type="number"   min="1" required class="form-control" id="QBPL" placeholder="BPL.." name="QBPL">

                                    
                                    <span class="input-group-addon"> U</span>
                                  

                                    </div>


                                </div>
                            </div>
                            </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">AAY</label>
                                <div class="col-sm-6">
                                    

                                    <div class=" input-group"><input type="number"   min="1" required class="form-control" id="QAAY" placeholder="AAY.." name="QAAY">

                                    <span class="input-group-addon"> U</span>
                                  
                                    </div>


                                </div>
                            </div>
                            </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">ANP</label>
                                <div class="col-sm-6">
                                   

                                    <div class=" input-group"> <input type="number"   min="1" required class="form-control" id="QANP" placeholder="ANP.." name="QANP">

                                    <span class="input-group-addon"> U</span>
                                  

                                    </div>




                                </div>
                            </div>
                            </div>
 


                        </div>




                        <div class="row">
                            
<p>Distributing Price in INR</p>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">APL</label>
                                <div class="col-sm-6">
                                   

                                    <div class=" input-group">
                                    <span class="input-group-addon"> <i class="fa fa-inr" aria-hidden="true"></i></span>
                                      
                                   <input type="number"   min="1" required class="form-control" id="APL" placeholder="APL.." name="APL">



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
                                      
                                    <input type="number"   min="1" required class="form-control" id="BPL" placeholder="BPL.." name="BPL">


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
                                    <input type="number"   min="1" required class="form-control" id="AAY" placeholder="AAY.." name="AAY">


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
                                      
                                   <input type="number"   min="1" required class="form-control" id="ANP" placeholder="ANP.." name="ANP">



                                    </div>
                                </div>
                            </div>
                            </div>
 


                        </div>





                        <div class="row">
                            

 

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Quantity</label>
                                <div class="col-sm-6">
                                 
                                    <div class=" input-group"> 

      <input type="number"   min="1" required class="form-control" id="Quantity" placeholder="Quantity.." name="quantity"> 
                                    <span class="input-group-addon"> U</span>
                                    

                                    </div>

                                </div>
                            </div>
                            </div>


                    <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">total Price</label>
                                <div class="col-sm-6">

                                        <div class=" input-group">
                                    <span class="input-group-addon"> <i class="fa fa-inr" aria-hidden="true"></i></span>
                                      
                                   
                                    <input type="number" disabled="disabled" required name="total_price" class="form-control" placeholder="Total Price.." name="total_price">    
                                    </div>


   
                                </div>
                            </div>
                        </div>


                        </div>


            


<div class="row">


 

                        <div class="col-md-offset-4 col-md-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">remaining Quantity</label>
                                <div class="col-sm-6">

     <div class=" input-group"> 

      <input type="number"   disabled="disabled" value="<?php if(isset( $products['quantity']))echo $products['quantity'];  ?>"      class="form-control"   placeholder="Quantity.." name="nquantity">
                                    <span class="input-group-addon"> U</span>
                                    

                                    </div>



                                  
                                </div>
                            </div>
                            </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">remaining price</label>
                                <div class="col-sm-6">
                                 

                                        <div class=" input-group">
                                    <span class="input-group-addon"> <i class="fa fa-inr" aria-hidden="true"></i></span>
                                      
                                      <input type="number"   disabled="disabled" value="<?php  if(isset( $products['quantity']))  echo  $products['price'] *  $products['quantity'];  ?>"      class="form-control"   placeholder="Quantity.."  name="ntotal" >

                                    </div>



                                </div>
                            </div>
                            </div>

                        </div>

 
                <div class="content-box text-center">
                    <input type="submit" name="submite" value="Add Stock" class="btn btn-lg btn-primary">
                </div>



 
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


  $sql='select s.*, date_format(s.date , "%d-%M-%Y  - %r") AS adate , p.pr_name AS aproduct, p.price AS p_price, r.shop_no from distribution s LEFT JOIN  product p ON s.product = p.pr_id LEFT JOIN ration_shop r ON r.shop_id = s.ration_shop WHERE s.delete_status = 0 AND s.product ='.$_POST['product'] ." ORDER BY s.date DESC";


if(isset($_POST['product']) && isset($_POST['ration_shop']) ){
  $sql='select s.*, date_format(s.date , "%d-%M-%Y  - %r") AS adate , p.pr_name AS aproduct, p.price AS p_price, r.shop_no from distribution s LEFT JOIN  product p ON s.product = p.pr_id LEFT JOIN ration_shop r ON r.shop_id = s.ration_shop WHERE s.delete_status = 0 AND s.product ='.$_POST['product'] ." AND s.ration_shop =".$_POST['ration_shop']." ORDER BY s.date DESC";

}


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
    <th>Shop</th>
    <th>Quantity</th>
    <th>RQ</th>  
    <th>Price</th>
    <th>APL</th>
    <th>Q</th>
    <th>BPL</th>
    <th>Q</th>
    <th>AAY</th>
    <th>Q</th>
    <th>ANP</th>
    <th>Q</th>
    <th>Month</th>  
    <th>Date</th>  
    
</tr>
</thead>
<tbody>
    <?php  
     foreach($result as $value) {?>
<tr>
    
    <td><?php echo $value['aproduct']; ?></td> 
    <td><?php echo $value['shop_no']; ?></td>
    <td><?php echo $value['quantity']; ?></td>
    <td><?php echo $value['r_quantity']; ?></td>
    <td><?php echo $value['price']; ?></td>
    <td><?php echo $value['APL']; ?></td>
    <td><?php echo $value['QAPL']; ?></td>
    <td><?php echo $value['BPL']; ?></td>
    <td><?php echo $value['QBPL']; ?></td>
    <td><?php echo $value['AAY']; ?></td>
    <td><?php echo $value['QAAY']; ?></td>
    <td><?php echo $value['ANP']; ?></td>
    <td><?php echo $value['QANP']; ?></td>
    <td><?php echo $value['month']; ?></td>
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