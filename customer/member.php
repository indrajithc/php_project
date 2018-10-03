<?php include_once( '../header.php' ); ?>

<?php


$db=new Database();



$message=array(
  null,
  null
);

?>








<?php



if (isset($_POST['delete'])) {


  $sql='update member set delete_status=1 where member_id=:member_id AND delete_status = 0';
  $params=array( 
    ':member_id'      =>  $_POST['member_id']
  );







  if($db->execute_query($sql,$params) ){
    $message [0] = 1;
    $message [1] = ' successfully updated';  















    $stmnt= 'SELECT COUNT(*) AS number FROM `member` WHERE card_id= :card_id  AND delete_status = 0   ';
    $params=array( 
      ':card_id'  =>  $_SESSION['userid']
    );


    $numa = 0;
    $doTypeeea = $db->display($stmnt,$params);

    if($doTypeeea[0][0]) {
      $numa = $doTypeeea[0][0]; 





      $sql='update card set members='.$numa.' where card_id=:card_id AND delete_status = 0';
      $params=array( 
        ':card_id'      =>  $_SESSION['userid']
      );
      if($db->execute_query($sql,$params) ){
        $message [0] = 1;
        $message [1] = ' successfully updated';  

      }





      $stmnt= 'SELECT  *   FROM `member` WHERE member_id= :member_id  AND delete_status = 1 AND type = 1 ';
      $params=array( 
        ':member_id'  =>  $_POST['member_id']
      );


      $numa = 0;
      if($db->display($stmnt,$params)){

        $sql='update card set login=0 where card_id=:card_id AND delete_status = 0';
        $params=array( 
          ':card_id'      =>  $_SESSION['userid']
        );
        if($db->execute_query($sql,$params) ){
          $message [0] = 1;
          $message [1] = ' successfully updated';  

        }


      }





    }





    $sql='update card set login=0 where card_id=:card_id AND delete_status = 0';
    $params=array( 
      ':card_id'      =>  $_SESSION['userid']
    );

    if($db->execute_query($sql,$params) ){
      echo '


      <script type="text/javascript">
      location.href="index.php";
      </script>

      
      ';
      
    };




  } else  {
    $message [0] = 3;
    $message [1] = 'Something is wrong, ensure values are correct ! '; 

  }







}












$stmnt= 'SELECT * FROM `card` WHERE card_id= :card_id  AND delete_status = 0   ';


$params=array( 
 ':card_id'  =>  $_SESSION['userid']
);

$membersno = 0;
$detaCard = $db->display($stmnt,$params);
if($detaCard)
  $membersno = $detaCard[0]['members'];




$stmnt= 'SELECT * FROM `member` WHERE card_id= :card_id  AND delete_status = 0   ';


$params=array( 
 ':card_id'  =>  $_SESSION['userid']
);


$result = $db->display($stmnt,$params);

if($result){

  ?>


  <div class="panel">
    <div class="panel-body">
      <h3 class="title-hero">
        Datatables row highlight
      </h3>

      <?php echo show_error ($message); ?>
      <div class="example-box-wrapper">
        <div class="row" style="padding: 1em;">
          <div class="col-md-offset-1 col-md-2"><p>No. of Members <span style="padding: 12px;">:</span><?php echo $membersno;?></p></div>
          <div class="col-md-offset-8 col-md-1">
            <a href="newMemb.php" class="btn btn-warning">new </a>
          </div>
        </div>
        <table id="datatable-row-highlight" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>

              <th>name</th> 
              <th>dob</th>
              <th>gender</th>
              <th>occupation</th>
              <th>income</th>
              <th>NRK</th>
              <th>relation</th>
              <th>proof</th>
              <th>proof no</th>   
              <th>action</th>

            </tr>
          </thead>
          <tbody>
            <?php  




            foreach($result as $value) {?>
            <tr>

              <td><?php echo $value['name']; ?></td> 
              <td><?php echo $value['dob']; ?></td>
              <td><?php echo $value['gender']; ?></td>
              <td><?php echo $value['occupation']; ?></td>
              <td><?php echo $value['income']; ?></td>
              <td><?php if($value['NRK'] == "1") echo "true"; else echo "false"; ?></td>
              <td><?php echo $value['relation']; ?></td>
              <td><?php echo $value['proof']; ?></td>
              <td><?php echo $value['proof_no']; ?></td> 

            </td> 
            <td><form method="post">
              <input type="hidden"  name="member_id" value="<?php echo $value['member_id']; ?>">
              <input type="submit" name="delete" value="delete" class="btn btn-info btn-xs">
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


<?php
}

?>




<?php include_once( '../footer.php' ); ?>