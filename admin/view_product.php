
<?php
include_once('../header.php');
$db=new Database();
$sql='select *, date_format(date , "%d-%M-%Y  - %r") AS date from product';
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
    
    <th>Product id</th>
    <th>Product name</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Date</th>
    <th>Description</th>
    <th>Edit</th>   
    
</tr>
</thead>
<tbody>
    <?php  
     foreach($result as $value) {?>
<tr>
    
    <td><?php echo $value['pr_id']; ?></td>
    <td><?php echo $value['pr_name']; ?></td>
    <td><?php echo $value['price']; ?></td>
    <td><?php echo $value['quantity']; ?></td>
    <td><?php echo $value['date']; ?></td>
    <td><?php echo $value['description']; ?></td>
    
    <?php

    echo "<td>";
                                    echo "<a class='btn btn-xs  " ;
                                        if ($value['delete_status'] == 1) {
                                            echo "btn-danger";
                                        } else {
                                            echo "btn-info";
                                        }

                                    echo "' href='edit_product.php?pr_id=".$value['pr_id']."'>Edit</a>";
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