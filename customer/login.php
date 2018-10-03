<?php

include_once('../includes/connection.php');
include_once('../includes/functions.php');
$db=new Database();
$error='';
$showCard = null;

$message = array(null, null);
session_start();


if( isset( $_SESSION['userid'] ) ) {
  if( $_SESSION['type'] == 'admin' ) {
    header('Location: ' . PATH . '/admin');
  }         
  if( $_SESSION['type'] == 'customer' ) {
    header('Location: ' . PATH . '/customer' );
  }         
  exit();
}





if ($_POST) { 
  
 $_SESSION['POST'] =  $_POST; 
 echo "<script type='text/javascript'>location.href='".$_SERVER['REQUEST_URI']."'</script>";
 exit();
}
if (isset($_SESSION ['POST'])) {
  $_POST = $_SESSION['POST'];
  unset($_SESSION['POST']);
}













$taluk = null;


$sql = 'select * from district WHERE delete_status = 0';
$districts = $db->display($sql);

if( isset( $_POST['district'] ) ) {
  $stmnt='SELECT * FROM `taluk` where dist= "'.$_POST['district'].'"';
  $taluk = $db->display($stmnt);
}


if( isset( $_POST['rdistrict'] ) ) {
  $stmnt='SELECT * FROM `taluk` where dist= "'.$_POST['rdistrict'].'"';
  $taluk = $db->display($stmnt);
}


















if(isset($_POST['login'])){

	$username = $_POST['username'];
	$password = $_POST['password'];
	print_r($_POST);
  $stmnt='select * from card where card_no = :username and password = :password AND  delete_status = 0';
  $params=array( 
   ':username'  =>  $username,
   ':password'  =>  $password
 );
  if($db->display($stmnt,$params)){
    $user =  $db->display($stmnt,$params);
    $_SESSION['userid']=$user[0]['card_id'];
    $_SESSION['type']='customer';
    header('Location: index.php');
    exit();
  }else{


    $message [0] = 4;
    $message [1] = 'Incorrect username or password ';  
  }
}























if (isset($_POST['registration'])) {

  $card_no = $_POST['shop_id'] ;

  $temp9 = 'select card_id from card  ORDER BY card_id DESC LIMIT 1';
  $findXountNo = $db->display($temp9);
  if($findXountNo) 
    $card_no = $card_no .'-F'.(($findXountNo[0]['card_id'])+1);
  else
    $card_no = $card_no .'-F0001';






  $stmnt="SELECT  * FROM card WHERE shop_id =" . $_POST['shop_id'] . " AND house_no =" . $_POST['house_no'] . " AND  ward_no = " . $_POST['ward_no'] . "  AND delete_status = 0 ";
  $product = $db->display( $stmnt);
  if( $product ){

   $message [0] = 3;
   $message [1] = 'already exists'; 

 } else {
  


  $digits = 4;
  $maRand =  rand(pow(10, $digits-1), pow(10, $digits)-1);


  $array = array( 
   "shop_id"    => $_POST['shop_id'] ,
   "card_no"    => $card_no ,
   "ward_no"      => $_POST['ward_no'] ,
   "house_no" => $_POST['house_no'],
   "name"  => $_POST['name'] ,
   "area"    => $_POST['area'] ,
   "location"    => $_POST['location'] ,
   "pin"    => $_POST['pin'] ,
   "members"    => $_POST['members'] ,
   "image"    => $_POST['image']  ,
   "userKey"    => $maRand   ,
   "password"    => $_POST['password']  


 );

  $result  = insertInToTable ('card', $array, $db );
  if( $result == 1) {

    $showCard = $card_no;
    $message [0] = 1;
    $message [1] = ' successfully Added';  
  }else  {
    $message [0] = 3;
    $message [1] = 'Something is wrong, ensure values are correct ! '; 

  }





}




}



$recovrId = -1;


if (isset($_POST['recover'])) {



  $stmnt="SELECT  * FROM card WHERE shop_id =" . $_POST['rshop_id'] . " AND house_no =" . $_POST['house_no'] . " AND  ward_no = " . $_POST['ward_no'] . "  AND delete_status = 0 ";
  $product = $db->display( $stmnt);
  if( $product ){
    $recovrId = $product[0]['card_no'];
  } else {
    $recovrId = 0;
  }

}













?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>

  
 



 

  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo PATH; ?>/favicon.png"> 




  <link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>/assets/css/cropper.min.css">




  <link rel="stylesheet" type="text/css" href="../assets/styles.css">
  <script type="text/javascript" src="../assets/js-core.js"></script>






  <style class="cp-pen-styles"> 



  @import url(https://fonts.googleapis.com/css?family=Roboto:400,500);

  html{
    background-color: rgba(129, 119, 119, 0.19);
    font-family: "Roboto";
  }
  
  
  .panel-default {
    border: none;
    text-align: center; 
    background: rgba(129, 119, 119, 0.19);
  }


  .box button{

    background:#14AA00;
    border:0;
    color:#fff;
    padding:10px;
    font-size:20px;
    width:100%; 
    display:block;
    cursor:pointer;
    -webkit-transition: all 0.4s;
    transition: all 0.4s;
  }

  .box button:active{
    background:#27ae60;
  }

  .box button:hover{
    background:#177D00;
    -webkit-transition: all 0.4s;
    transition: all 0.4s;
  }
  
  .form-group{ 
    position:relative; 
    margin-bottom: 25px; 
    margin-left: 15px;
  }

  .inputMaterial        {
    font-size:14px;
    padding:10px 10px 10px 5px;
    display:block;
    width:100%;
    border:none;
    border-bottom:1px solid #757575;
  }

  .inputMaterial:focus    { outline:none;}

  /* LABEL ======================================= */

  label          {
    color:#999; 
    font-size:14px;
    font-weight:normal;
    position:absolute;
    pointer-events:none;
    left:5px;
    top:10px;
    transition:0.2s ease all; 
    -moz-transition:0.2s ease all; 
    -webkit-transition:0.2s ease all;
  }

  /* active state */
  .inputMaterial:focus ~ label, .inputMaterial:valid ~ label    {
    top:-20px;
    font-size:14px;
    color:#16680D;
  }

  /* BOTTOM BARS ================================= */
  .bar  { position:relative; display:block; width:100%; }
  .bar:before, .bar:after   {
    content:'';
    height:2px; 
    width:0;
    bottom:1px; 
    position:absolute;
    background:#3CE000; 
    transition:0.2s ease all; 
    -moz-transition:0.2s ease all; 
    -webkit-transition:0.2s ease all;
  }
  .bar:before {
    left:50%;
  }
  .bar:after {
    right:50%; 
  }

  /* active state */
  .inputMaterial:focus ~ .bar:before, .inputMaterial:focus ~ .bar:after {
    width:50%;
  }


  /* active state */
  .inputMaterial:focus ~ .highlight {
    -webkit-animation:inputHighlighter 0.3s ease;
    -moz-animation:inputHighlighter 0.3s ease;
    animation:inputHighlighter 0.3s ease;
  }

  /* ANIMATIONS ================ */
  @-webkit-keyframes inputHighlighter {
    from { background:#5264AE; }
    to  { width:0; background:transparent; }
  }
  @-moz-keyframes inputHighlighter {
    from { background:#5264AE; }
    to  { width:0; background:transparent; }
  }
  @keyframes inputHighlighter {
    from { background:#5264AE; }
    to  { width:0; background:transparent; }
  }







  .parsley-errors-list {
    position: absolute;   
    width: 100%; 
    color: #714e4e;
    float: right;
    text-align: right;
  }






  .innerarr {
    padding: 15% 10%;

    border-left: 6px solid red;
    background: white;
  }

  .innerarr h2{
    padding: 10% ;
  }
  .bg-white {
    background: white;
  }


  
  input[type=number]::-webkit-inner-spin-button, 
  input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
  }

  
</style>



</head>
<body>


  <div class=" ">
    
    <div class="panel panel-default">


      <div class="panel-body">






        <div class="box">
          
          <?php echo show_error ($message); ?>
          <div class="col-md-offset-0 col-md-12 "> 
            <div class="col-md-offset-1 col-md-4">
             


             <div class="innerarr">


               <?php 
               
               if( $showCard ){
                ?>

                
                <form  class="form-horizontal  "  method="post" action=""    data-parsley-validate  > 



                  <div class="form-group">  
                    <label>Card No</label>    
                    <p style="font-size: 3em;"><?php 

                    echo $showCard ;

                    ?></p>
                  </div> 

                  
                  <a href="login.php"> new Registration</a>


                </form>



                <?php

              } else{

               ?>

               
               <form  class="form-horizontal  "  method="post" action=""    data-parsley-validate  > 
                 
                 
                 <h2>Registration</h2>
                 

                 <div class="form-group">      
                  
                   
                   <select name="district" onchange="this.form.submit();" class="inputMaterial bg-white" id="district" required >
                     <option selected="selected" disabled="disabled">Select</option>
                     <?php if ($districts) { ?>
                       <?php foreach ($districts as $district) { ?>
                         <option value="<?php echo $district['dist_id'] ?>" <?php if( isset( $_POST['district'] ) ) if( $_POST['district']  ==$district['dist_id'] ) echo ' selected'; ?>><?php echo $district['district_name']; ?></option>
                       <?php } ?>
                     <?php } ?>
                   </select>
                   

                   <span class="highlight"></span>
                   <span class="bar"></span>
                   <label>District</label>
                 </div>



                 <?php
                 if(isset($_POST['district'])){
                  ?>



                  <?php if ($taluk) { ?>
                   

                   <div class="form-group">      
                     
                    <select name="taluk" onchange="this.form.submit();" data-parsley-required="true" class="inputMaterial bg-white">
                      <option selected="selected" disabled="disabled">Select</option> 
                      <?php foreach ($taluk as $value) { ?> 
                        <option value="<?php echo $value['taluk_id'] ?>"<?php if( isset( $_POST['taluk'] ) ) if( $_POST['taluk']  == $value['taluk_id'] ) echo ' selected'; ?>> <?php echo $value['name']; ?></option> 
                      <?php } ?>
                    </select> 

                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Taluk</label>
                  </div> 
                <?php } ?>






                <?php
                if(isset($_POST['taluk']) && isset($_POST['district'])){
                  ?>

                  

                  <?php 


                  $stmnt='SELECT * FROM `ration_shop` where taluk_id= "'.$_POST['taluk'].'" AND delete_status = 0';
                  $shops = $db->display($stmnt);
                  
                  if ($shops) { ?>


                    <div class="form-group">      
                      
                     <select name="shop_id"   onchange="this.form.submit();"  data-parsley-required="true" class="inputMaterial bg-white">
                       <option selected="selected" disabled="disabled">Select</option> 
                       <?php foreach ($shops as $value) { ?> 
                         <option value="<?php echo $value['shop_id'] ?>"<?php if( isset( $_POST['shop_id'] ) ) if( $_POST['shop_id']  == $value['shop_id'] ) echo ' selected'; ?> > <?php echo $value['shop_no']; ?></option>  
                       <?php } ?>
                     </select> 

                     <span class="highlight"></span>
                     <span class="bar"></span>
                     <label>Ration Shop</label>
                   </div> 



                 <?php } ?>





                 <?php
                 if(isset($_POST['shop_id']) && isset($_POST['taluk']) && isset($_POST['district'])){
                  ?>

                  


                  








                  <div class="form-group">      
                   <input min="1" name="ward_no" id="ward_no" class="inputMaterial" type="number" required data-parsley-type="digits">
                   <span class="highlight"></span>
                   <span class="bar"></span>
                   <label class="text-capitalizse">ward no</label>
                 </div> 



                 <div class="form-group">      
                   <input min="1" name="house_no" id="house_no" class="inputMaterial" type="number" required data-parsley-type="digits">
                   <span class="highlight"></span>
                   <span class="bar"></span>
                   <label class="text-capitalizse"> house no</label>
                 </div> 

                 <div class="form-group">      
                   <input name="name" id="name" class="inputMaterial" type="text" required>
                   <span class="highlight"></span>
                   <span class="bar"></span>
                   <label class="text-capitalizse"> house name</label>
                 </div> 



                 <div class="form-group">      
                   <input name="area" id="area" class="inputMaterial" type="text" required>
                   <span class="highlight"></span>
                   <span class="bar"></span>
                   <label class="text-capitalizse"> area</label>
                 </div> 

                 <div class="form-group">      
                   <input name="location" id="location" class="inputMaterial" type="text" required>
                   <span class="highlight"></span>
                   <span class="bar"></span>
                   <label class="text-capitalizse"> location</label>
                 </div> 



                 <div class="form-group">      
                   <input minlength="6" maxlength="6" name="pin" id="pin" class="inputMaterial" type="number" required data-parsley-type="digits">
                   <span class="highlight"></span>
                   <span class="bar"></span>
                   <label class="text-capitalizse"> pin</label>
                 </div> 

                 <div class="form-group">      
                   <input min="1" name="members" id="members" class="inputMaterial" type="number" required data-parsley-type="digits">
                   <span class="highlight"></span>
                   <span class="bar"></span>
                   <label class="text-capitalizse"> members</label>
                 </div> 

                 

                 <div class="form-group">      
                   <input name="password" id="password" class="inputMaterial" type="password" required data-parsley-gt="6">
                   <span class="highlight"></span>
                   <span class="bar"></span>
                   <label class="text-capitalizse"> password</label>
                 </div> 


                 <div class="form-group">      
                   <input data-parsley-equalto="#password" name="re-password" id="re-password" class="inputMaterial" type="password" required>
                   <span class="highlight"></span>
                   <span class="bar"></span>
                   <label class="text-capitalizse"> Confirm password</label>
                 </div> 









                 <div class="form-group required" id="aimage_base">
                  <div class=""> 
                    <div class="input-group"> 
                      <?php
                      $image_to = 'customer/images/';
                      ?> 
                      
                      <input id="upload_image" name="image"  class="inputMaterial fileinput-new" type="text" required   >
                      <span class="highlight"></span>
                      <span class="bar"></span>
                      <label class="text-capitalizse">  select image</label>

                    </div>

                    <input type="text" class="fileinput-new  hidden" name="image" value="" required >
                    


                    <p style="font-size: 11px;"> rules image desc image desc  image desc image desc  image desc image desc  image desc image desc </p>
                    

                    <div class="photome">              
                     <img  style="padding: 1em;"  src="<?php  ?>" class="img-responsive" alt="update image"   onerror="javascript:this.src='../assets/images/default-1.jpg'" > 
                   </div>

                 </div>
               </div> 





               

               <button name="registration" id="registration" type="submit" class=" o" id="">Registration</button>



               <?php
             }
             ?>

             






             <?php
           }
           ?>



           
           <?php
         }
         ?>

       </form>

       
       <?php
     }
     ?>




   </div>

 </div>

 <div class="col-md-offset-2 col-md-4">
   
  <div class="innerarr">
    
    <form method="post" action=""   data-parsley-validate > 
      
      <h2  >Login</h2>
      <div class="form-group">      
        <input name="username" class="inputMaterial" type="text" required>
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>card no</label>
      </div>
      <div class="form-group">      
        <input name="password" class="inputMaterial" type="password" required>
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Password</label>
      </div>
      


      <button  name="login" value="login" id=" ">Login</button>
      


    </form>

  </div>         
  <div class="innerarr" style="margin-top: 5em;">
    
    <?php

    if($recovrId >0){
      ?>

      
      <form  class="form-horizontal  "  method="post" action=""    data-parsley-validate  > 



        <div class="form-group">  
          <label>Card No</label>    
          <p style="font-size: 3em;"><?php 

          echo $recovrId ;

          ?></p>
        </div> 

        
        <a href="login.php"> new Registration</a>


      </form>




      <?php

    } else if ($recovrId <=0 ) {
     
      ?>

      <form  class="form-horizontal  "  method="post" action=""    data-parsley-validate  > 
       
       
       <h2>Recover Login</h2>
       
       <?php

       if($recovrId == 0){

        $message [0] = 4;
        $message [1] = 'Incorrect values ';  


        echo show_error ($message);

      }

      ?>



      <div class="form-group">      
        
       
       <select name="rdistrict" onchange="this.form.submit();" class="inputMaterial bg-white" id="rdistrict" required >
         <option selected="selected" disabled="disabled">Select</option>
         <?php if ($districts) { ?>
           <?php foreach ($districts as $district) { ?>
             <option value="<?php echo $district['dist_id'] ?>" <?php if( isset( $_POST['rdistrict'] ) ) if( $_POST['rdistrict']  ==$district['dist_id'] ) echo ' selected'; ?>><?php echo $district['district_name']; ?></option>
           <?php } ?>
         <?php } ?>
       </select>
       

       <span class="highlight"></span>
       <span class="bar"></span>
       <label>District</label>
     </div>



     <?php
     if(isset($_POST['rdistrict'])){
      ?>



      <?php if ($taluk) { ?>
       

       <div class="form-group">      
         
        <select name="rtaluk" onchange="this.form.submit();" data-parsley-required="true" class="inputMaterial bg-white">
          <option selected="selected" disabled="disabled">Select</option> 
          <?php foreach ($taluk as $value) { ?> 
            <option value="<?php echo $value['taluk_id'] ?>"<?php if( isset( $_POST['rtaluk'] ) ) if( $_POST['rtaluk']  == $value['taluk_id'] ) echo ' selected'; ?>> <?php echo $value['name']; ?></option> 
          <?php } ?>
        </select> 

        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Taluk</label>
      </div> 
    <?php } ?>






    <?php
    if(isset($_POST['rtaluk']) && isset($_POST['rdistrict'])){
      ?>

      

      <?php 


      $stmnt='SELECT * FROM `ration_shop` where taluk_id= "'.$_POST['rtaluk'].'" AND delete_status = 0';
      $shops = $db->display($stmnt);
      
      if ($shops) { ?>


        <div class="form-group">      
          
         <select name="rshop_id"   onchange="this.form.submit();"  data-parsley-required="true" class="inputMaterial bg-white">
           <option selected="selected" disabled="disabled">Select</option> 
           <?php foreach ($shops as $value) { ?> 
             <option value="<?php echo $value['shop_id'] ?>"<?php if( isset( $_POST['rshop_id'] ) ) if( $_POST['rshop_id']  == $value['shop_id'] ) echo ' selected'; ?> > <?php echo $value['shop_no']; ?></option>  
           <?php } ?>
         </select> 

         <span class="highlight"></span>
         <span class="bar"></span>
         <label>Ration Shop</label>
       </div> 



     <?php } ?>





     <?php
     if(isset($_POST['rshop_id']) && isset($_POST['rtaluk']) && isset($_POST['rdistrict'])){
      ?>

      



      <div class="form-group">      
       <input min="1" name="ward_no" id="ward_no" class="inputMaterial" type="number" required>
       <span class="highlight"></span>
       <span class="bar"></span>
       <label class="text-capitalizse">ward no</label>
     </div> 



     <div class="form-group">      
       <input min="1" name="house_no" id="house_no" class="inputMaterial" type="number" required>
       <span class="highlight"></span>
       <span class="bar"></span>
       <label class="text-capitalizse"> house no</label>
     </div>  

     

     <button name="recover" id="recover" type="submit" class=" o" id="">Recover</button>



     <?php
   }
   ?>

   






   <?php
 }
 ?>



 
 <?php
}
?>



</form>

<?php

}

?>



</div>









</div>





</div>



</div>






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

















<!-- JS --> 
<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/jquery.form.js"></script>



<script type="text/javascript" src="<?php echo PATH; ?>/assets/widgets/parsley/parsley.js"></script>


<script type="text/javascript" src="<?php echo PATH; ?>/assets/admin-all-demo.js"></script>



<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/cropper.min.js"></script> 











<script> 
  $(document).ready(function() {

    
   /***********************************uplad image only **************************************/


   $(document).on("click", "#upload_image", function(e) {
    e.preventDefault();
    $('#uploadFile').val('');
    $('#uploadFile').click();
    $('#modal.dmodel').attr("to_this", "aimage_base");

  });



   $('#uploadFile').change(function() {


    $("#uploadFileForm").ajaxForm({
      url :"<?php echo PATH;  ?>/upladimage.php",
      cache : false,
      success: function(responseText,statusText, xhr, $form) { 
        $imageHrCro = ''+responseText.trim();
        if ($imageHrCro.trim().length >1) {
          $imageHrCro = '<?php echo PATH;  ?>'+'/'+responseText.trim();
          $('.img-container > img').attr('src', $imageHrCro);
          $('#setImg').click();
          $('body').removeClass("modal-x");
          $('body').removeClass("loading");
        }    
      }
    }).submit();
    $('body').addClass("modal-x");
    $('body').addClass("loading"); 
    $('#upladimagepfinalsub').click();                
  });    

   var cropBoxData;
   var cropBoxData;
   var canvasData;
   var cropper;

   $('#modal.dmodel').on('shown.bs.modal', function () {            
    cropper = new Cropper(document.getElementById('image'), { 
      autoCropArea: 0.5,
      aspectRatio: 16 / 16,
      guides: true,
      minContainerWidth :350,
      minContainerHeight : 350,
      ready: function () { 
        cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);           
      }, crop: function(e) {
        updateCoords(e);
      }
    });
  }).on('hidden.bs.modal', function () {

    cropBoxData = cropper.getCropBoxData();
    canvasData = cropper.getCanvasData();
    cropper.destroy();
    var x_ = $('#x').val();
    var y_ = $('#y').val();
    var w_ = $('#w').val();
    var h_ = $('#h').val();
    var TARGET_W = 300;
    var TARGET_H = 300;
    var photo_url_ = $('#image').attr('src');
    photo_url_ = photo_url_.substr(3);
    photo_url_ = photo_url_.replace(/^.*[\\\/]/, '');
    $sest_utl_p_ = '<?php  echo $image_to; ?>';
    $.post('<?php echo PATH;  ?>/crop_photo.php', {
     x:x_, 
     y:y_, 
     w:w_, 
     h:h_, 
     photo_url:photo_url_, 
     targ_w:TARGET_W, 
     targ_h:TARGET_H, 
     sest_utl_p_:$sest_utl_p_ },
     function(response){ 
              //  console.log(response);
              if (response.trim().length > 1) { 

                response =$.parseJSON(response); 
                if(response.success == 1) {   
                  $to_image = $('#modal').attr("to_this");
                  $('#'+$to_image).find('.fileinput-new').attr('value', response.name);
                  $('#'+$to_image).find('.fileinput-new').attr("path",response.path+response.name);
                  $('#'+$to_image).find('img').attr('src',"http://"+response.full);
                  // no nd
                  chek_imag();
                }
              }
            }); 
  });


  function updateCoords(e) {
    $('#x').val(e.detail.x);
    $('#y').val(e.detail.y);
    $('#w').val(e.detail.width);
    $('#h').val(e.detail.height);

    $('#r').val(e.detail.rotate);
    $('#sx').val(e.detail.scaleX);
    $('#sy').val(e.detail.scaleY);
  }


  function chek_imag () {
    $dimage = $('span.fileinput-new').text();

    //console.log($dimage );
    if($dimage.trim().length > 2){ 
    } else { 
    }

    //console.log($dimage);

  }



  /**************************************end image edit *************************************************/




});

</script>
</body></html>










