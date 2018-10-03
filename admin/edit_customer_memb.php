<?php if (isset($_GET['id'])) { ?>








<?php include_once( '../header.php' ); ?>

<?php


$db=new Database();

$message = array(null, null);



?>




<?php





 









  if (isset($_POST['membUpdat'])) {
 
  
 
      $array = array(  
               "name"      => $_POST['name'] ,
               "dob" => $_POST['dob'],
               "gender"  => $_POST['gender'] ,
               "occupation"    => $_POST['occupation'] ,
               "income"    => $_POST['income'] ,
               "NRK"    => $_POST['NRK'] , 
               "relation"    => $_POST['relation']  ,
               "proof"    => $_POST['proof']  ,
               "proof_no"    => $_POST['proof_no']  


               );
 

  $result  = updateTable ('member', $array, ' member_id = '. $_GET['id'], $db );
  if( $result == 1) {


    if(isset($_POST['completed'])){


     


           $sql='update card set login=1 where card_id=:card_id AND delete_status = 0';
           $params=array( 
               ':card_id'      =>  $_GET['id']
            );
           if($db->execute_query($sql,$params) ){
               $message [0] = 1;
               $message [1] = ' successfully updated';  


               echo "<script type='text/javascript'>verification.href='edit_customer.php?id=". $_GET['id']."'</script>";



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

  $stmnt='select * from member where member_id = :username AND delete_status = 0 ';
      $params=array( 
            ':username'  =>  $_GET['id']
       );
      $card = $db->display($stmnt,$params);
     if($card ){ 
     $card  = $card[0];
       }else{

         echo "<script type='text/javascript'>location.href='edit_customer.php?id=";  if(isset($_GET['id'])) echo $_GET['id'];  echo "'</script>"; 
      }

      

 


?>


  

<div class="panel">
  
  <a style="" href="edit_customer.php?id=<?php echo $card['card_id'];  ?>" class="col-sm-offset-11 col-sm-1 btn btn-info btn-xs  ">back</a>
 
</div>
 <div class="panel">
  
  <div class="panel-body">
  <?php echo show_error ($message); ?>

  <div class="row">
 

    <form class="form-horizontal bordered-row"  action="" method="post" data-parsley-validate>

     

               <div class="form-group">
                          <label class="col-sm-4 control-label text-capitalize">name</label>
                          <div class="col-sm-6"> 
                          <input type="text" required name="name" class="form-control" placeholder="name"  value="<?php echo $card['name'];   ?>" >
                          </div> 
                      </div>


               <div class="form-group">
                          <label class="col-sm-4 control-label text-capitalize">dob</label>
                          <div class="col-sm-6"> 
                          <input type="text" id="dob" required name="dob" class="form-control" placeholder="dob"  value="<?php echo $card['dob'];   ?>"  >
                          </div> 
                      </div>

                      <div class="form-group">
                          <label class="col-sm-4 control-label text-capitalize">sex</label>
                          <div class="col-sm-6">  
                          <input type="radio" name="gender" value="male" class="form- " <?php if($card['gender'] == "male")    echo 'checked="checked"'; ?> > male
                          <input type="radio" name="gender" value="female" class="form- " <?php if($card['gender'] == "female")    echo 'checked="checked"'; ?> > female  
                          </div> 
                      </div>


               <div class="form-group">
                          <label class="col-sm-4 control-label text-capitalize">occupation</label>
                          <div class="col-sm-6"> 
                          <input type="text" required name="occupation" class="form-control" placeholder="occupation"   value="<?php echo $card['occupation'];   ?>" >
                          </div> 
                      </div>

               <div class="form-group">
                          <label class="col-sm-4 control-label text-capitalize">income</label>
                          <div class="col-sm-6"> 
                          <input type="number" required name="income" class="form-control" placeholder="income"   value="<?php echo $card['income'];   ?>" >
                          </div> 
                      </div>

               <div class="form-group">
                          <label class="col-sm-4 control-label text-capitalize">NRK</label>
                          <div class="col-sm-6">  
                          <input type="radio" name="NRK" value="0" class="form- " <?php if($card['NRK'] == "0")    echo 'checked="checked"'; ?> > false
                          <input type="radio" name="NRK" value="1" class="form- " <?php if($card['NRK'] == "1")    echo 'checked="checked"'; ?>  >   true
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

 <script type="text/javascript">
   $(document).ready(function() { 
      $('select[name="relation"]').val('<?php echo $card['relation'];   ?>'); 
   });
 </script> 
 




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
 

 <script type="text/javascript">
   $(document).ready(function() {
    
      $('select[name="proof"]').val( '<?php echo $card['proof'];   ?>');


   });
 </script>




               <div class="form-group">
                          <label class="col-sm-4 control-label text-capitalize">proof no</label>
                          <div class="col-sm-6"> 
                          <input type="text" required name="proof_no" class="form-control" placeholder="proof_no"  value="<?php echo $card['proof_no'];   ?>"  >
                          </div> 
                      </div>

           



                      <div class="content-box text-center">
                          <input type="submit" name="membUpdat" value="Update member" class="btn btn-lg btn-primary"  >
                      </div>

       </form>       


  

  
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


  echo "<script type='text/javascript'>location.href='edit_customer.php'</script>";

  }?>