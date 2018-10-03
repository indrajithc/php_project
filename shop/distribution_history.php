
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
        ct.month AS mmnt





  FROM `card_transaction` ct LEFT JOIN card c ON c.card_id = ct.card_id LEFT JOIN distribution d ON d.distribution_id = ct.distribution LEFT JOIN product p ON p.pr_id = d.product WHERE d.ration_shop =".$ration_shop ."   ";

  
  

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
    <th>Month</th>  
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
    <td><?php echo $value['mmnt']; ?></td> 
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
 
?>








 
<?php include_once('../footer.php');  ?>