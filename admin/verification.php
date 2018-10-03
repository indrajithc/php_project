
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









 
  $sql=' SELECT *  FROM `card`  WHERE shop_id ='.$ration_shop.'  ORDER BY date DESC ';
 


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
    
    <th>card no</th>  
    <th>ward no</th>
    <th>house no</th>
    <th>House name</th>
    <th>member name</th>
    <th>area</th>
    <th>location</th>
    <th>pin</th>  
    <th>members</th>  
    <th>monthly income</th>  
    <th>date</th>  
    <th>view</th>
    
</tr>
</thead>
<tbody>
    <?php  
     foreach($result as $value) {


  $sql=' SELECT c.*, m.name AS member_name, date_format(c.date , "%d-%M-%Y  - %r") AS ddate FROM `card` c LEFT JOIN member m ON m.card_id = c.card_id WHERE m.type = 1  AND c.login = 0  AND  c.shop_id ='.$ration_shop.' AND c.card_id = '.$value['card_id'].'   ORDER BY m.date DESC LIMIT 1';
 



$result=$db->display($sql);

     foreach($result as $value) {

        ?>
<tr>
    
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
    <td><a href="card_verification.php?id=<?php echo $value['card_id']; ?>" class="btn btn-xs btn-warning"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
     
    
</tr>
<?php 
}
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