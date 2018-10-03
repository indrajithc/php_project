
<?php
include_once('../header.php');
$db=new Database();


  $message = array( NULL, NULL);






    if(isset($_POST['delete-me']) || isset($_POST['active-me'])) {
      $Sdelete = 0;
      if(isset($_POST['delete-me'])) 
         $Sdelete = 1;

     var_dump($Sdelete);

         $sql='update district set delete_status=:delete_status where dist_id=:dist_id';
         $params=array(
              ':delete_status'      =>  $Sdelete,
              ':dist_id'      =>  $_POST['dist_id']
           );
          if($db->execute_query($sql,$params) ){
              $message [0] = 1;
              $message [1] = ' successfully updated';  

       }



    }








$sql='select * from district';
$result=$db->display($sql);
?>


    <div class="panel">
<div class="panel-body">
<h3 class="title-hero">
    Districts

</h3>

<?php echo show_error ($message); ?>

<div class="example-box-wrapper">




<table id="datatable-row-highlight" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
<tr>
    <th>Id</th>
    <th>Name</th>
    <th>Edit</th>
</tr>
</thead>

<tbody>
    <?php  
     foreach($result as $value) {?>
<tr>
    <td><?php echo $value['dist_id']; ?></td>
    <td><?php echo $value['district_name']; ?></td>

    <td>

 <form method="post" action="" >
    <input type="hidden" name="dist_id" value="<?php echo $value['dist_id']; ?>">
                  <?php

                  if($value['delete_status'] == 0 )
                  echo '  <input type="submit" name="delete-me" value="DELETE" class="btn btn-lg btn btn-xs btn-danger">';
                  if($value['delete_status'] == 1 )
                  echo '  <input type="submit" name="active-me" value="ACTIVE" class="btn btn-lg btn btn-xs btn-success">';

                  ?>

</form>



</td>
                  


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