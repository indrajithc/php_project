<?php if (isset($_GET['id'])) { ?>








  <?php include_once( '../header.php' ); ?>

  <?php


  $db=new Database();

  $message = array(null, null);




  ?>




  <?php





  $card =  null;

  $stmnt='select * from card where card_id = :username AND delete_status = 0 ';
  $params=array( 
   ':username'  =>  $_GET['id']
 );
  $card = $db->display($stmnt,$params);
  if($card ){ 
    $card  = $card[0];
  }else{

    echo "<script type='text/javascript'>location.href='view_customer.php'</script>"; 
  }




  $orgNo = $card['members'];
  $countArt = 0;


  $stmnt= 'SELECT COUNT(*) AS number FROM `member` WHERE card_id= :card_id  AND delete_status = 0  ';


  $params=array( 
   ':card_id'  =>  $card['shop_id']
 );


  $member = $db->display($stmnt,$params);
  if($member ){ 
    $countArt = $member[0]['number'];
  }


  $reming = ( $orgNo - $countArt);











  if (isset($_POST['cardUpdate'])) {
   
    
   

    $array = array(  
     "card_type"    => $_POST['card_type'] , 
     "ward_no"      => $_POST['ward_no'] ,
     "monthly_income"      => $_POST['monthly_income'] ,
     "house_no" => $_POST['house_no'],
     "name"  => $_POST['name'] ,
     "area"    => $_POST['area'] ,
     "location"    => $_POST['location'] ,
     "pin"    => $_POST['pin'] , 
     "image"    => $_POST['image']  


   );

    




    $result  = updateTable ('card', $array, ' card_id = '. $_GET['id'], $db );
    if( $result == 1) {


      if(isset($_POST['household'])){


       


       $sql='update member set type=0 where  card_id = :card_id AND delete_status = 0';
       $params=array(  
         ':card_id'      =>  $_GET['id']
       );
       if($db->execute_query($sql,$params) ){
         $message [0] = 1;
         $message [1] = ' successfully updated';   

       }
       


       $sql='update member set type=1 where member_id=:member_id AND card_id = :card_id AND delete_status = 0';
       $params=array( 
         ':member_id'      =>  $_POST['household'],
         ':card_id'      =>  $_GET['id']
       );
       if($db->execute_query($sql,$params) ){
         $message [0] = 1;
         $message [1] = ' successfully updated';  

         


       }

       


     }





     if(isset($_POST['completed'])){


       


       $sql='update card set login=1 where card_id=:card_id AND delete_status = 0';
       $params=array( 
         ':card_id'      =>  $_GET['id']
       );
       if($db->execute_query($sql,$params) ){
         $message [0] = 1;
         $message [1] = ' successfully updated';  


         echo "<script type='text/javascript'>verification.href='view_customer.php'</script>";



       }

       


     }






     $message [0] = 1;
     $message [1] = ' successfully Added'; 
     






     

     
     
   }else  {
    $message [0] = 3;
    $message [1] = 'Something is wrong, ensure values are correct ! '; 

  }








}



$card =  null;

$stmnt='select * from card where card_id = :username AND delete_status = 0 ';
$params=array( 
 ':username'  =>  $_GET['id']
);
$card = $db->display($stmnt,$params);
if($card ){ 
  $card  = $card[0];
}else{

  echo "<script type='text/javascript'>location.href='view_customer.php'</script>"; 
}




$orgNo = $card['members'];
$countArt = 0;


$stmnt= 'SELECT COUNT(*) AS number FROM `member` WHERE card_id= :card_id  AND delete_status = 0  ';


$params=array( 
 ':card_id'  =>  $card['shop_id']
);


$member = $db->display($stmnt,$params);
if($member ){ 
  $countArt = $member[0]['number'];
}


$reming = ( $orgNo - $countArt);












?>




<?php

$stmnt= ' SELECT rs.shop_no, t.name AS taluk , d.district_name AS district  FROM `ration_shop` rs LEFT JOIN taluk t ON t.taluk_id = rs.taluk_id LEFT JOIN district d ON t.dist = d.dist_id WHERE rs.shop_id  = :shop_id  ';


$params=array( 
  ':shop_id'  =>  $card['shop_id']
);


$memshop_idber = $db->display($stmnt,$params);
if($memshop_idber ){ 
 $memshop_idber = $memshop_idber[0];
}



?>

<div class="panel-body">
  
  <a style="" href="view_customer.php" class="col-sm-offset-11 col-sm-1 btn btn-info btn-xs  ">back</a>
</div>
<div class="panel">
 <div class="panel-body">
   <h3 class="title-hero">
     Ration Shop
   </h3>
   <div class="example-box-wrapper">

     <form class="form-horizontal bordered-row"  action="" method="post" data-parsley-validate>


      
      <div class="form-group">
        <label class="col-sm-4 control-label"> district</label>
        <div class="col-sm-6">
          <p  required class="form-control"   ><?php echo $memshop_idber['district'];   ?></p>
        </div>
      </div>
      
      <div class="form-group">
        <label class="col-sm-4 control-label"> taluk</label>
        <div class="col-sm-6">
          <p  required class="form-control"   ><?php echo $memshop_idber['taluk'];   ?></p>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-4 control-label"> shop no</label>
        <div class="col-sm-6">
          <p  required class="form-control"   ><?php echo $memshop_idber['shop_no'];   ?></p>
        </div>
      </div>

      
    </form>


  </div>
</div>
</div>







<div class="panel">
  
  <div class="panel-body">
    <?php echo show_error ($message); ?>

    <div class="row">

      <form class="form-horizontal bordered-row"  action="" method="post" data-parsley-validate>



       
        <div class="form-group well">
          <label class="col-sm-4 control-label text-capitalize">remarks</label>
          <div class="col-sm-6">   
            <p  required class="form-control"   ><?php echo $card['remarks'];   ?></p>
          </div>
        </div>
        


        
        <div class="form-group">
         <label class="col-sm-4 control-label">Number Of Members</label>
         <div class="col-sm-6">
           <p  required class="form-control"   ><?php echo $card['members'];   ?></p>
         </div>
       </div>


       
       <div class="form-group">
         <label class="col-sm-4 control-label text-capitalize">card no</label>
         <div class="col-sm-6">
           <p  required class="form-control"   ><?php echo $card['card_no'];   ?></p>
         </div>
       </div>



       




       <div class="form-group well">
         <label class="col-sm-4 control-label text-capitalize">  card type</label>
         <div class="col-sm-6"> 
           <select name="card_type"   id="card_type" required class="form-control" >
             <option selected="selected" disabled="disabled">select</option>
             <option value="APL"   <?php if($card['card_type'] == "APL") echo "selected='selected'"; ?>  >APL</option>
             <option value="BPL"   <?php if($card['card_type'] == "BPL") echo "selected='selected'"; ?>  >BPL</option>
             <option value="AAY"   <?php if($card['card_type'] == "AAY") echo "selected='selected'"; ?>  >AAY</option>
             <option value="ANP"   <?php if($card['card_type'] == "ANP") echo "selected='selected'"; ?>  >ANP</option>
           </select>
           
         </div>
       </div>





       <div class="form-group">
         <label class="col-sm-4 control-label text-capitalize">  monthly income</label>
         <div class="col-sm-6">

          <?php
//

          $stmnt= 'SELECT SUM(income) AS income FROM `member`WHERE card_id = :card_id  AND delete_status = 0  ';
          

          $params=array( 
           ':card_id'  =>  $_GET['id']
         );

          $cincome = 0;
          $income = $db->display($stmnt,$params);
          if($income ){ 
            $cincome = $income[0]['income'];
          }



          ?>


          <input min="1" name="monthly_income"  type="number"  id="monthly_income" required class="form-control"  value="<?php echo $cincome;   ?>"  > 
          
        </div>
      </div>




      <div class="form-group">
       <label class="col-sm-4 control-label text-capitalize">ward no</label>
       <div class="col-sm-6">
         <input min="1" name="ward_no"  type="number"  id="ward_no" required class="form-control"  value="<?php echo $card['ward_no'];   ?>"  > 
         
       </div>
     </div>


     
     <div class="form-group">
       <label class="col-sm-4 control-label text-capitalize">house no</label>
       <div class="col-sm-6"> 

         <input value="<?php echo $card['house_no'];   ?>" min="1" name="house_no" id="house_no" class="form-control" type="number" required>
       </div>
     </div>


     
     <div class="form-group">
       <label class="col-sm-4 control-label text-capitalize">name</label>
       <div class="col-sm-6"> 
         <input value="<?php echo $card['name'];   ?>" name="name" id="name" class="form-control" type="text" required>
       </div>
     </div>


     
     <div class="form-group">
       <label class="col-sm-4 control-label text-capitalize">  area</label>
       <div class="col-sm-6"> 
         <input value="<?php echo $card['area'];   ?>" name="area" id="area" class="form-control" type="text" required>
       </div>
     </div>


     
     <div class="form-group">
       <label class="col-sm-4 control-label text-capitalize">  location</label>
       <div class="col-sm-6"> 
         <input name="location" value="<?php echo $card['location'];   ?>" id="location" class="form-control" type="text" required>
       </div>
     </div>
     
     <div class="form-group">
       <label class="col-sm-4 control-label text-capitalize">  pin  </label>
       <div class="col-sm-6"> 
        <input minlength="6" value="<?php echo $card['pin'];   ?>" maxlength="6" name="pin" id="pin" class="form-control" type="number" required>
      </div>
    </div>


    















    <?php
    $image_to = 'customer/images/';
    ?> 
    



    
    <div class="form-group required" id="aimage_base">
      <label class="col-sm-4 control-label">  Image</label>
      <div class="col-md-6"> 
        <div class="input-group">
          <span class="input-group-btn">
            <button type="button" class="btn btn-sm   btn-info hidden" id="upload_image"> select image</button>
          </span>
          <input type="text" class="fileinput-new form-control" name="image" value="<?php echo $card['image'];  ?>" required disabled="disabled"  >
        </div>
        <input type="text" class="fileinput-new form-control hidden" name="image" value="<?php echo $card['image'];  ?>" required >
        

        <div class="photome">              
         <img  style="padding: 1em; max-width: 300px; width: 300px; height: auto;"  src="<?php echo  '../'.$image_to.$card['image']; ?>" class="img-responsive my_image_here" alt="update image"   onerror="javascript:this.src='../assets/images/default-1.jpg'" > 
       </div>

     </div>
   </div> 
   
   










   <div class="form-group well">
    <label class="col-sm-4 control-label text-capitalize"> household</label>
    <div class="col-sm-6"> 
      <select name="household"   id="household" required class="form-control" >
        <option selected="selected" disabled="disabled">select</option>



        <?php

        $stmnt= 'SELECT * FROM `member` WHERE card_id= :card_id  AND delete_status = 0   ';
        

        $params=array( 
         ':card_id'  =>  $_GET['id']
       );


        $result = $db->display($stmnt,$params);

        if($result){

          foreach ($result as   $value) {
            
            echo ' <option value="'.$value['member_id'].'" ';

            if($value['type'] == 1)
              echo "selected='selected'";

            echo '>'.$value['name'].'</option>';              
          }


        }

        ?>


        
      </select>
      
    </div>
  </div>




  
  <div class="form-group">
    <label class="col-sm-4 control-label text-capitalize">status</label>
    <div class="col-sm-6"> 
      <input  <?php if( $card['login'] == 1) echo 'checked="checked"'; ?> type="checkbox" name="completed" id="completed" value="completed" > completed 
    </div>
  </div>

  
  
  <div class="form-group">
    <label class="col-sm-4 control-label text-capitalize">  </label>
    <div class="col-sm-6"> 
      <input type="checkbox" name="agree" id="" required> agree the terms and conditions
    </div>
  </div>  



  
  

  <div class="content-box text-center">
    <input type="submit" name="cardUpdate" value="UPDATE" class="btn btn-lg btn-primary">
  </div>




  
</form>       





</div>




</div>


</div>
































<?php

$stmnt= 'SELECT * FROM `member` WHERE card_id= :card_id  AND delete_status = 0   ';


$params=array( 
 ':card_id'  =>  $_GET['id']
);


$result = $db->display($stmnt,$params);

if($result){

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
              
              <th>name</th> 
              <th>dob</th>
              <th>gender</th>
              <th>occupation</th>
              <th>income</th>
              <th>NRK</th>
              <th>relation</th>
              <th>proof</th>
              <th>proof no</th>   
              <th>edit</th>
              
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
                <td><a href="edit_customer_memb.php?update=1&id=<?php echo $value['member_id']; ?>" class="btn btn-xs btn-warning"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                
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






<?php



$sql="SELECT ct.* ,c.*, d.distribution_id  ,
p.pr_name ,
date_format(ct.date , '%d-%M-%Y  - %r') AS ddate,
ct.month AS mmt


FROM `card_transaction` ct LEFT JOIN card c ON c.card_id = ct.card_id LEFT JOIN distribution d ON d.distribution_id = ct.distribution LEFT JOIN product p ON p.pr_id = d.product WHERE c.card_id =".$_GET['id'] ."   ";




$sql = $sql . " ORDER BY ct.date DESC   ";



$resulta=$db->display($sql);

?>





<div class="panel">
  <div class="panel-body">
    <h3 class="title-hero">
      Datatables row highlight
    </h3>
    <div class="example-box-wrapper">

      <div class="row">
        <div class="col-md-2"> <strong> Product</strong></div>
        <div class="col-md-2"> <strong> Total</strong></div>
        <div class="col-md-2"> <strong> card type</strong></div>
        <div class="col-md-2"> <strong> Month</strong></div>
        <div class="col-md-4"> <strong> Date</strong></div>
      </div>





      <?php  
      foreach($resulta as $value) {?>


        <div class="row">
          <div class="col-md-2"> <p> <?php echo $value['pr_name']; ?></p></div>
          <div class="col-md-2"> <p> <?php echo $value['total']; ?></p></div>
          <div class="col-md-2"> <p> <?php echo $value['card_type']; ?></p></div>
          <div class="col-md-2"> <p> <?php echo $value['mmt']; ?></p></div>
          <div class="col-md-4"> <p> <?php echo $value['ddate']; ?></p></div>
        </div>


        <?php 
      }
      ?> 


      
    </div>
  </div>
</div>





























<!-- image upload js -->

<form name="photo" action="" method="post" enctype="multipart/form-data" id="uploadFileForm"  > 
  <input type="file" name="image" size="30" class="hidden"  id="uploadFile" accept="image/x-png, image/gif, image/jpeg" /> 
  <input type="submit" name="upload" value="Upload" class="hidden" id="upladimagepfinalsub"/>
</form>

<div>
 <!-- Button trigger modal -->
 <button type="button" id="setImg" class="btn btn-primary hidden" data-target="#modal" data-toggle="modal"> </button>

 <!-- Modal -->
 <div class="modal fade dmodel" id="modal" role="dialog" aria-labelledby="modalLabel" tabindex="-1" to_this=""   >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Crop image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="img-container">
          <img id="image" src="<?php echo PATH; ?>/assets/images/loding.gif" alt="Picture">
        </div>
      </div>
      <div class="modal-footer"> 

        <input type="hidden" id="x" name="x" />
        <input type="hidden" id="y" name="y" />
        <input type="hidden" id="w" name="w" />
        <input type="hidden" id="h" name="h" />

        <input type="hidden" id="r" name="r" />
        <input type="hidden" id="sx" name="sx" />
        <input type="hidden" id="sy" name="sy" />
        <button type="button" id="crop_btn" class="btn btn-default" data-dismiss="modal">save</button>
      </div>
    </div>
  </div>
</div>
</div>




<?php include_once( '../footer.php' ); ?>






































<?php } else {


  echo "<script type='text/javascript'>location.href='view_customer.php'</script>";

}?>