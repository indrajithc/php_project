
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






 
   $sql="SELECT ct.* ,c.*, d.distribution_id  ,
        p.pr_name ,
         date_format(ct.date , '%d-%M-%Y  - %r') AS ddate,
        ct.month AS mmnt,
        d.month AS dmonth,
        d.product AS dproduct,
        d.ration_shop AS dration_shop,

        ct.date AS ctdate



  FROM `card_transaction` ct LEFT JOIN card c ON c.card_id = ct.card_id LEFT JOIN distribution d ON d.distribution_id = ct.distribution LEFT JOIN product p ON p.pr_id = d.product WHERE c.card_id =".$ration_shop ."   ";

  
  

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
    <th>card type</th> 
    <th>Quantity</th>  
    <th>Price</th>  
    <th>Total</th>
    <th>Month</th>  
    <th>Date</th>  
    <th>remark</th>  
    
</tr>
</thead>
<tbody>
    <?php  
     foreach($result as $value) {


           $sql="SELECT  * FROM  distribution WHERE product =".$value['dproduct'] ."  AND ration_shop ='" . $value['dration_shop']. "' AND month='".$value['dmonth']."'  AND date <= '".$value['ctdate']."' ORDER BY date DESC  LIMIT 1  ";
         


        $resultIn=$db->display($sql);

        $a1 = 0;
        $a2 = 0;

        if($resultIn) {
            $resultIn = $resultIn[0];


            $a1 = $resultIn['Q'.$value['card_type']];
            $a2 = $resultIn[''.$value['card_type']];

        }

 



        ?>
<tr>
    
    <td><?php echo $value['pr_name']; ?></td> 
    <td><?php echo $value['card_type']; ?></td> 
    <td><?php echo $a1; ?></td> 
    <td><?php echo $a2; ?></td> 
    <td><?php echo $value['total']; ?></td>
    <td><?php echo $value['mmnt']; ?></td> 
    <td><?php echo $value['ddate']; ?></td> 


    <td><a href="remark.php?id=<?php echo $value['transaction_id']; ?>" class="btn btn-success btn-xs"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td> 
     
    
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








 
<?php include_once('../footer.php');  ?>