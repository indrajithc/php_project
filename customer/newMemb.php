<?php include_once( '../header.php' ); ?>

<?php


$db=new Database();


$message=array(
  null,
  null
);


?>




<?php





$card =  null;

$stmnt='select * from card where card_id = :username AND delete_status = 0  ';
$params=array( 
 ':username'  =>  $_SESSION['userid']
);
$card = $db->display($stmnt,$params);
if($card ){ 
  $card  = $card[0];
}else{

  echo "<script type='text/javascript'>location.href='index.php'</script>"; 
}




$orgNo = $card['members'];
$countArt = 0;


$stmnt= 'SELECT COUNT(*) AS number FROM `member` WHERE card_id= :card_id  AND delete_status = 0  ';


$params=array( 
 ':card_id'  =>  $_SESSION['userid']
);


$member = $db->display($stmnt,$params);
if($member ){ 
  $countArt = $member[0]['number'];
}


$reming = ( $orgNo - $countArt);











if (isset($_POST['member'])) {


 $stmnt="SELECT  * FROM member WHERE card_id =" . $card['card_id'] . " AND name ='" . $_POST['name'] . "' AND  dob = '" . $_POST['dob'] . "' AND  occupation = '" . $_POST['occupation'] . "'  AND delete_status = 0 ";
 $product = $db->display( $stmnt);
 if( $product ){

   $message [0] = 3;
   $message [1] = 'already exists'; 

 } else {

  if(isset( $_POST['type']))
    $ttype = $_POST['type'];
  else
    $ttype =  0;

  if(isset( $_POST['relation']))
    $ddfdf = $_POST['relation'];
  else
    $ddfdf =  0;



  $stmnt= 'SELECT COUNT(*) AS number FROM `member` WHERE card_id= :card_id  AND delete_status = 0 AND type = 1 ';
  $params=array( 
    ':card_id'  =>  $_SESSION['userid']
  );


  $numa = 0;
  $doTypeeea = $db->display($stmnt,$params);

  if($doTypeeea[0][0]) {
    $numa = $doTypeeea[0][0];
    $numa = $numa + 1;
  }
  if( $doTypeeea[0][0] ){
    $ttype = 0;
    $ddfdf = $_POST['relation'] ;
  } else {
    $ttype = 1;
    $ddfdf = 'owner' ;

  }


  $array = array( 
   "card_id"    => $card['card_id'], 
   "name"      => $_POST['name'] ,
   "dob" => $_POST['dob'],
   "gender"  => $_POST['gender'] ,
   "occupation"    => $_POST['occupation'] ,
   "income"    => $_POST['income'] ,
   "NRK"    => $_POST['NRK'] ,
   "type"    =>   $ttype ,
   "relation"    => $ddfdf  ,
   "proof"    => $_POST['proof']  ,
   "proof_no"    => $_POST['proof_no']  


 );

  $result  = insertInToTable ('member', $array, $db );
  if( $result == 1) {


    $message [0] = 1;
    $message [1] = ' successfully Added'; 



    $sql='update card set delete_status=1 where card_id=:member_id AND delete_status = 0';
    $params=array( 
      ':member_id'      =>  $_SESSION['userid']
    );








    $sql='update card set members='.$numa.' where card_id=:card_id AND delete_status = 0';
    $params=array( 
      ':card_id'      =>  $card['card_id']
    );
    if($db->execute_query($sql,$params) ){
      $message [0] = 1;
      $message [1] = ' successfully updated';




      echo "<script type='text/javascript'>location.href='member.php'</script>";   

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





  }else  {
    $message [0] = 3;
    $message [1] = 'Something is wrong, ensure values are correct ! '; 

  }





}










}







$card =  null;

$stmnt='select * from card where card_id = :username AND delete_status = 0  ';
$params=array( 
 ':username'  =>  $_SESSION['userid']
);
$card = $db->display($stmnt,$params);
if($card ){ 
  $card  = $card[0];
}else{

  echo "<script type='text/javascript'>location.href='index.php'</script>"; 
}




$orgNo = $card['members'];
$countArt = 0;


$stmnt= 'SELECT COUNT(*) AS number FROM `member` WHERE card_id= :card_id  AND delete_status = 0  ';


$params=array( 
 ':card_id'  =>  $_SESSION['userid']
);


$member = $db->display($stmnt,$params);
if($member ){ 
  $countArt = $member[0]['number'];
}


echo $reming = ( $orgNo - $countArt);


echo $reming = max(( $orgNo - $countArt), 1);








?>


<div class="panel">

  <div class="panel-body">
    <?php echo show_error ($message); ?>

    <div class="row">

      <form class="form-horizontal bordered-row"  action="" method="post" data-parsley-validate>



        <div class="form-group">
          <label class="col-sm-4 control-label">Number Of Members</label>
          <div class="col-sm-6">
            <p  required class="form-control"   ><?php echo $card['members'];   ?></p>
          </div>
        </div>


        <?php
        if ( !($countArt < $orgNo)) {

          ?>
          <div class="form-group">
            <label class="col-sm-4 control-label text-capitalize">card no</label>
            <div class="col-sm-6">
              <p  required class="form-control"   ><?php echo $card['card_no'];  ?></p>
            </div>
          </div>

          <?php
        }
        ?>
      </form>       



      <?php




      if ($countArt = $orgNo) {


        ?>



        <div  class="col-md-12">

          <form class="form-horizontal bordered-row"  action="" method="post" data-parsley-validate>

            <div class="form-group">
              <label class="col-sm-4 control-label text-capitalize">card no</label>
              <div class="col-sm-6">
                <p  required class="form-control"   ><?php echo $card['card_no'];  ?></p>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-4 control-label text-capitalize">name</label>
              <div class="col-sm-6"> 
                <input type="text" required name="name" class="form-control" placeholder="name"  >
              </div> 
            </div>


            <div class="form-group">
              <label class="col-sm-4 control-label text-capitalize">dob</label>
              <div class="col-sm-6"> 
                <input type="text" id="dob" required name="dob" class="form-control" placeholder="dob"  >
              </div> 
            </div>

            <div class="form-group">
              <label class="col-sm-4 control-label text-capitalize">sex</label>
              <div class="col-sm-6">  
                <input type="radio" name="gender" value="male" class="form- " checked="checked"> male
                <input type="radio" name="gender" value="female" class="form- " > female
              </div> 
            </div>


            <div class="form-group">
              <label class="col-sm-4 control-label text-capitalize">occupation</label>
              <div class="col-sm-6"> 
                <input type="text" required name="occupation" class="form-control" placeholder="occupation"  >
              </div> 
            </div>

            <div class="form-group">
              <label class="col-sm-4 control-label text-capitalize">income</label>
              <div class="col-sm-6"> 
                <input type="number" required name="income" class="form-control" placeholder="income"  >
              </div> 
            </div>

            <div class="form-group">
              <label class="col-sm-4 control-label text-capitalize">NRK</label>
              <div class="col-sm-6">  
                <input type="radio" name="NRK" value="0" class="form- " checked="checked"> false
                <input type="radio" name="NRK" value="1" class="form- " > true
              </div> 
            </div>




            <div class="form-group">
              <label class="col-sm-4 control-label text-capitalize">relation</label>
              <div class="col-sm-6">  
                <select required name="relation" class="form-control" placeholder="relation"  >
                  <option selected="selected" disabled="disabled">select</option>
                  <option value="owner">owner</option>
                  <option value="mother">mother</option>
                  <option value="father">father</option>
                  <option value="husband">husband</option>
                  <option value="wife">wife</option>
                  <option value="son">son</option>
                  <option value="daughter">daughter</option>
                  <option value="grandmother">grandmother</option>
                  <option value="grandfather">grandfather</option>
                  <option value="great grandmother">great grandmother</option>
                  <option value="great grandfather">great grandfather</option>
                  <option value="elder sister">elder sister</option>
                  <option value="younger sister">younger sister</option>
                  <option value="elder brother">elder brother</option>
                  <option value="younger brother">younger brother</option>
                  <option value="uncle">uncle</option>
                  <option value="aunt">aunt</option>
                  <option value="uncle">uncle</option>
                  <option value="aunt">aunt</option> 
                </select>
              </div> 
            </div>








            <div class="form-group">
              <label class="col-sm-4 control-label text-capitalize">proof</label>
              <div class="col-sm-6">  
                <select required name="proof" class="form-control" placeholder="proof"  >
                  <option selected="selected" disabled="disabled">select</option>
                  <option value="Adhaar">Adhaar</option>
                  <option value="Passport">Passport</option>
                  <option value="Arms Licence">Arms Licence</option>
                  <option value="Driving License">Driving License</option>
                  <option value="Election Commission ID Card">Election Commission ID Card</option>
                  <option value="Income Tax PAN Card">Income Tax PAN Card</option>
                  <option value="Photo Credit Card">Photo Credit Card</option>
                  <option value="Kisan Passbook having photo">Kisan Passbook having photo</option>
                  <option value="Freedom Fighter  Card having photo">Freedom Fighter  Card having photo</option>

                </select>
              </div> 
            </div>



            <div class="form-group">
              <label class="col-sm-4 control-label text-capitalize">proof no</label>
              <div class="col-sm-6"> 
                <input type="text" required name="proof_no" class="form-control" placeholder="proof_no"  >
              </div> 
            </div>





            <div class="content-box text-center">
              <input type="submit" name="member" value="Add member" class="btn btn-lg btn-primary">
            </div>

          </form>   


        </div>





        <?php
      } else {

        ?>


        <div class="panel" style="margin: 3em;">
          <div class="panel-body">
            <div class="col-md-offset-1 col-md-10">
              <p style="padding: 1em;" class="bg-warning">

                <i style="padding-right: 1em; font-size: 15px;" class="fa fa-info-circle" aria-hidden="true"></i>preliminary submission successful, awaiting preliminary screening


              </p>
            </div>

          </div>
        </div>






        <?php

      }


      ?>   


    </div>



    
  </div>


</div>




<?php include_once( '../footer.php' ); ?>