
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



                $array = array(  "product"      => $_POST['product'] ,
                     "quantity"      => $_POST['quantity'] ,
                     "total_price"          => $total_price );


                $result  = insertInToTable ('stock', $array, $db );

                if( $result == 1) {



            $ttotq =( $products['quantity'] + $quantity ) ;    
            $total_price =   ( $products['price'] * $ttotq  );

                    $array = array(  "quantity"      =>  $ttotq, 
                         "total_price"          => $total_price );


                    $result  = updateTable ('product', $array, ' pr_id = '. $product , $db );
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
                                    <input type="number" disabled="disabled" value="<?php echo $products['price'];  ?>"    name="price" class="form-control" placeholder="Price.." name="price">      
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Old Quantity</label>
                                <div class="col-sm-6">
                                    <input type="number"   disabled="disabled" value="<?php echo $products['quantity'];  ?>"      class="form-control" id="oQuantity" placeholder="Quantity.." name="oquantity">
                                </div>
                            </div>
                            </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Old Total</label>
                                <div class="col-sm-6">
                                    <input type="number"   disabled="disabled" value="<?php  echo  $products['price'] *  $products['quantity'];  ?>"      class="form-control" name="ototal"   placeholder="Quantity.."  >
                                </div>
                            </div>
                            </div>

                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Quantity</label>
                                <div class="col-sm-6">
                                    <input type="number"   min="1" required class="form-control" id="Quantity" placeholder="Quantity.." name="quantity">
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


 

                        <div class="col-md-offset-4 col-md-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Total Quantity</label>
                                <div class="col-sm-6">
                                    <input type="number"   disabled="disabled" value="<?php echo $products['quantity'];  ?>"      class="form-control"   placeholder="Quantity.." name="nquantity">
                                </div>
                            </div>
                            </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Total</label>
                                <div class="col-sm-6">
                                    <input type="number"   disabled="disabled" value="<?php  echo  $products['price'] *  $products['quantity'];  ?>"      class="form-control"   placeholder="Quantity.."  name="ntotal" >
                                </div>
                            </div>
                            </div>

                        </div>

 
                <div class="content-box text-center">
                    <input type="submit" name="submite" value="Add Stock" class="btn btn-lg btn-primary">
                </div>


<?php
}
}

?>

            </form>
        </div>
    </div>











<?php

if(isset($_POST['product'])){


  $sql='select s.*, date_format(s.date , "%d-%M-%Y  - %r") AS adate , p.pr_name AS aproduct, p.price AS p_price from stock s LEFT JOIN  product p ON s.product = p.pr_id WHERE s.delete_status = 0 AND s.product ='.$_POST['product'] ." ORDER BY s.date DESC";
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
    <th>Price</th>
    <th>Quantity</th>
    <th>Total</th>
    <th>Date</th>  
    
</tr>
</thead>
<tbody>
    <?php  
     foreach($result as $value) {?>
<tr>
    
    <td><?php echo $value['aproduct']; ?></td> 
    <td><?php echo $value['p_price']; ?></td>
    <td><?php echo $value['quantity']; ?></td>
    <td><?php echo $value['total_price']; ?></td>
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


            $('input[name="nquantity"]').val(  (  parseInt($('input[name="oquantity"]').val())  +  parseInt(n1) ) );

            $('input[name="ntotal"]').val(  ( parseInt($('input[name="ototal"]').val() ) + (n1 * n2 )) );
        } else {

            $('input[name="total_price"]').val("" );
        }





    } );

  
});

</script>
<?php include_once('../footer.php');  ?>