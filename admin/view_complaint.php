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
 



?>



<?php




if (isset($_POST['doThiz55'])) {


      $array = array(  
               "reply"    => $_POST['reply']   

               ); 

      $result  = updateTable ('complaint', $array, ' complaint_id = '. $_POST['complaint_id'], $db );


      if($result == 1) { 
 
 $message [0] = 1;
 $message [1] = ' successfully Added';  
      }






}




      $sql='select * from complaint';
      $result=$db->display($sql);





?>

    <div class="panel">
<div class="panel-body">
<h3 class="title-hero">
    Complaint
</h3>


    <?php echo show_error ($message); ?>
<div class="example-box-wrapper">

<table id="datatable-row-highlight" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
<tr>
    <th>Customer Id</th>
    <th>Complaint</th>
    <th>Reply</th>
</tr>
</thead>

<tbody>
    <?php  
     foreach($result as $value) {?>
<tr>
    <td><?php echo $value['cust_id']; ?></td>
    <td><?php echo $value['complaint']; ?></td>
    <td> <form class="form-horizontal bordered-row"  action="" method="post" data-parsley-validate>

            <input type="hidden" name="complaint_id" value="<?php echo $value['complaint_id']; ?>">
                        
            <div class="form-group"> 
                <div class="col-sm-10"> 
                    <textarea name="reply" required class="form-control" ><?php echo $value['reply']; ?></textarea>
                </div>
                <div class="col-sm-1"> 
                     <input type="submit" name="doThiz55" class="btn btn-info btn-xs" value="update">
                </div>
            </div>



           </form></td>
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