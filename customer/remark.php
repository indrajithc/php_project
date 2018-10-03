<?php include_once( '../header.php' ); ?>
<?php
$db=new Database();
?>


<?php 
$div = true;
if (isset($_GET['id'])) { 



 


  if (isset($_POST['remarksz'])) {

  
        $array = array(  
                 "remarks"    => $_POST['remarks']   

                 ); 

        $result  = updateTable ('card_transaction', $array, ' transaction_id = '. $_GET['id'], $db );


        if($result == 1) { 

          echo "<script type='text/javascript'>location.href='remark.php'</script>";
        }








  }








  ?>






  <form class="form-horizontal bordered-row"  action="" method="post" data-parsley-validate>


    <div class="row">



      <div class=" col-md-10">
        <div class="form-group">
          <label class="col-sm-3 control-label">  Id</label>
          <div class="col-sm-6"> 

            <p  required class="form-control"   >RMK-<?php echo $_GET['id']; ?></p>


          </div>
        </div>
      </div>

 

    </div>


    <div class="row">



      <div class=" col-md-10">
        <div class="form-group">
          <label class="col-sm-3 control-label">  remarks</label>
          <div class="col-sm-6"> 

            <textarea class="form-control" name="remarks"></textarea>


          </div>
        </div>
      </div>

 

    </div>


    <div class="content-box text-center">
        <input type="submit" name="remarksz" value="UPDATE" class="btn btn-lg btn-primary">
    </div>




  </form>












  <?php } 



  if($div){?>




  <?php 


  $ration_shop = $_SESSION['userid'];







  $sql="SELECT ct.* ,c.*, d.distribution_id  ,
  p.pr_name ,
  date_format(ct.date , '%d-%M-%Y  - %r') AS ddate,
  ct.month AS mmnt,
  d.month AS dmonth,
  d.product AS dproduct,
  d.ration_shop AS dration_shop,

  ct.date AS ctdate,
  ct.remarks AS vremremarks



  FROM `card_transaction` ct LEFT JOIN card c ON c.card_id = ct.card_id LEFT JOIN distribution d ON d.distribution_id = ct.distribution LEFT JOIN product p ON p.pr_id = d.product WHERE c.card_id =".$ration_shop ."  AND ct.remarks IS NOT NULL ";

  
  

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

              <th class="col-sm-1">Product</th>   
              <th class="col-sm-1">card type</th>   
              <th class="col-sm-2">Month</th>   
              <th class="col-sm-8">remark</th>  

            </tr>
          </thead>
          <tbody>
            <?php  
            foreach($result as $value) {

 


            ?>
            <tr>

              <td><?php echo $value['pr_name']; ?></td> 
              <td><?php echo $value['card_type']; ?></td>   
              <td><?php echo $value['mmnt']; ?></td>  
              <td><p class="well" style="color: black;"><?php echo $value['vremremarks']; ?></p></td> 





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












<?php } ?>

<?php include_once( '../footer.php' ); ?>