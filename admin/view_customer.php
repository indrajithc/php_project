
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









 
    $sql=' SELECT rs.shop_no AS ration_shopa, c.*, m.name AS member_name, date_format(c.date , "%d-%M-%Y  - %r") AS ddate FROM `card` c LEFT JOIN member m ON m.card_id = c.card_id  LEFT JOIN ration_shop rs ON rs.shop_id = c.shop_id WHERE m.type = 1 AND c.login = 1  ORDER BY m.date DESC ';
 


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
    
    <th>ration shop</th>  
    <th>card no</th>  
    <th>W no</th>
    <th>H no</th>
    <th>H name</th>
    <th>member name</th>
    <th>area</th>
    <th>location</th>
    <th>pin</th>  
    <th>mem bers</th>  
    <th>M income</th>  
    <th>date</th>  
    <th>view</th>
    
</tr>
</thead>
<tbody>
    <?php  
     foreach($result as $value) {?>
<tr>
    
    <td><?php echo $value['ration_shopa']; ?></td>
    <td><?php echo $value['card_no']; ?></td>  
    <td><?php echo $value['ward_no']; ?></td>
    <td><?php echo $value['house_no']; ?></td>
    <td><?php echo $value['name']; ?></td>
    <td><?php echo $value['member_name']; ?></td>
    <td><?php echo $value['area']; ?></td>
    <td><?php echo $value['location']; ?></td>
    <td><?php echo $value['pin']; ?></td>
    <td><?php echo $value['members']; ?></td> 
    <td><?php echo $value['monthly_income']; ?></td> 
    <td><?php echo $value['ddate']; ?></td> 
    <td><a href="edit_customer.php?id=<?php echo $value['card_id']; ?>" class="btn btn-xs btn-warning"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
     
    
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