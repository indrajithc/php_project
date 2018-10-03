
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
 
$ration_shop = $_SESSION['userid'];









 
  $sql='select s.*, date_format(s.date , "%d-%M-%Y  - %r") AS adate , p.pr_name AS aproduct, p.price AS p_price, r.shop_no from distribution s LEFT JOIN  product p ON s.product = p.pr_id LEFT JOIN ration_shop r ON r.shop_id = s.ration_shop WHERE s.delete_status = 0  AND s.ration_shop ='.$ration_shop.' ORDER BY s.date DESC';
 


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
    <th>Month</th> 
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