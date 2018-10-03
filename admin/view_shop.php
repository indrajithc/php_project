
<?php
include_once('../header.php');
$db=new Database();
$sql='select r.* , t.name AS dist_id from ration_shop r LEFT JOIN taluk t ON t.taluk_id = r.taluk_id  ';
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
    
    <th>Shop No</th>
    <th>District id</th>
    <th>Shop address</th>
    <th>Mobile</th>
    <th>Pin</th>
    <th>Employee Name</th>
    <th>Employee address</th>
    <th>Gender</th>
    <th>Contact Number</th>
    <th>Edit</th>
    
</tr>
</thead>
<tbody>
    <?php  
     foreach($result as $value) {?>
<tr>
    
    <td><?php echo $value['shop_no']; ?></td>
    <td><?php echo $value['dist_id']; ?></td>
    <td><?php echo $value['shop_address']; ?></td>
    <td><?php echo $value['mobile']; ?></td>
    <td><?php echo $value['pin']; ?></td>
    <td><?php echo $value['emp_name']; ?></td>
    <td><?php echo $value['emp_address']; ?></td>
    <td><?php echo $value['emp_gender']; ?></td>
    <td><?php echo $value['contact_no']; ?></td>
    
    <?php

    echo "<td>";
    echo "<a class='btn btn-xs  " ;
        if ($value['delete_status'] == 1) {
            echo "btn-danger";
        } else {
            echo "btn-info";
        }

    echo "' href='edit_shop.php?shop_id=".$value['shop_id']."'>Edit</a>";
    echo "</td>"

    ?>
    
</tr>
<?php 
     }
    ?> 
</tbody>
</table>
</div>
</div>
</div>
<?php include_once('../footer.php');  ?>