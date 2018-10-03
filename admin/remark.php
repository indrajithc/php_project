<?php include_once( '../header.php' ); ?>
<?php
$db=new Database();
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

  ct.date AS ctdate,
  ct.remarks AS vremremarks,
        rs.shop_no,
        rs.shop_id



  FROM `card_transaction` ct LEFT JOIN card c ON c.card_id = ct.card_id LEFT JOIN distribution d ON d.distribution_id = ct.distribution LEFT JOIN product p ON p.pr_id = d.product  LEFT JOIN ration_shop rs ON rs.shop_id = d.ration_shop  WHERE   ct.remarks IS NOT NULL ";

  
  

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

    <th>Shop No</th>    
              <th class="col-sm-1">Product</th> 
              <th class="col-sm-1">card type</th>   
              <th class="col-sm-2">Month</th>   
              <th class="col-sm-7">remark</th>  

            </tr>
          </thead>
          <tbody>
            <?php  
            foreach($result as $value) {

 


            ?>
            <tr>

            <td> <a href="edit_shop.php?shop_id=<?php echo $value['shop_id']; ?>" target="_blank" class="btn btn-warning btn-xs"><?php echo $value['shop_no']; ?></a> </td>
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






 

<?php include_once( '../footer.php' ); ?>