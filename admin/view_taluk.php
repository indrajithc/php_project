
<?php
include_once('../header.php');
$db=new Database();
$sql='select * from taluk';
$result=$db->display($sql);
?>


    <div class="panel">
<div class="panel-body">
<h3 class="title-hero">
    Taluk
</h3>
<div class="example-box-wrapper">

<table id="datatable-row-highlight" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
<tr>
    <th>Taluk Id</th>
    <th>District Id</th>
    <th>Name</th>
</tr>
</thead>

<tbody>
    <?php  
     foreach($result as $value) {?>
<tr>
    <td><?php echo $value['taluk_id']; ?></td>
    <td><?php echo $value['dist']; ?></td>
    <td><?php echo $value['name']; ?></td>
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