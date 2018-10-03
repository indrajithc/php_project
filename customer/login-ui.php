<?php

include_once('../includes/connection.php');
$db=new Database();
$error='';





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




if(isset($_POST['login'])){

	$username = $_POST['username'];
	$password = $_POST['password'];
	// print_r($_POST);
	 $stmnt='select * from admin where username = :username and password = :password';
  	   $params=array( 
             ':username'  =>  $username,
             ':password'  =>  $password
  	   	);
  	   if($db->display($stmnt,$params)){
        
  	   	    $_SESSION['userid']=$username;
  	   	    $_SESSION['type']='admin';
  	   	    header('Location: dashbord.php');
  	   	    exit();
  	   }else{
  	   	    $error= 'Incorrect username or password';
  	   }
  }



?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>

    
 



 

    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo PATH; ?>/favicon.png"> 
      <script type="text/javascript" src="../assets/js-core.js"></script>






<style class="cp-pen-styles"> 



@import url(https://fonts.googleapis.com/css?family=Roboto:400,500);

html{
  background-color: rgba(129, 119, 119, 0.19);
  font-family: "Roboto";
}

/* BOX LOGIN */
.box{
  position: relative;
  margin: auto;
  height: 365px;
  top: 40px;
  left: 0;
  z-index: 200;
  right: 0;
  width:400px;
  color:#666;
  padding:10px 0px;
  /*border-radius: 10px;*/
  background:rgba(255,255,255,1);
  border-top: 2px solid #C0C0C0;
  border-bottom: 2px solid #F00;
  margin-bottom: 100px;
}
.box h1{
  text-align:center;
  font-size:30px;
}

.show{
  display:none;
}

.box button{
  background:#FF4747;
  border:0;
  color:#fff;
  padding:10px;
  font-size:20px;
  width:330px;
  margin:20px auto;
  display:block;
  cursor:pointer;
    -webkit-transition: all 0.4s;
  transition: all 0.4s;
  /*border-radius: 10px;*/
}

.box button:active{
  background:#27ae60;
}

.box button:hover{
  background:#FF2020;
    -webkit-transition: all 0.4s;
  transition: all 0.4s;
}

.box p{
  font-size:14px;
  text-align:center;
}

#textchange{
  cursor:pointer;
  color:#666;
    font-size:15px;
  text-align:center;
}

.group        { 
  position:relative; 
  margin-bottom: 35px; 
  margin-left: 40px;
}

.inputMaterial        {
  font-size:18px;
  padding:10px 10px 10px 5px;
  display:block;
  width:300px;
  border:none;
  border-bottom:1px solid #757575;
}

.inputMaterial:focus    { outline:none;}

/* LABEL ======================================= */

label          {
  color:#999; 
  font-size:18px;
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
  color:#FF0000;
}

/* BOTTOM BARS ================================= */
.bar  { position:relative; display:block; width:315px; }
.bar:before, .bar:after   {
  content:'';
  height:2px; 
  width:0;
  bottom:1px; 
  position:absolute;
  background:#FF0000; 
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
    left: 20em;
    top: 0em;
    color: red;
}



</style></head><body>
 <div class="box">

 <form method="post" action="" id="reg" style="display: none;" data-parsley-validate  > 
   

   <h1 id="logintoregister">Registration</h1>
 <div class="group">      
   <input class="inputMaterial" type="text" required>
   <span class="highlight"></span>
   <span class="bar"></span>
   <label>Username</label>
   </div>
 <div class="group">      
   <input class="inputMaterial" type="password" required>
   <span class="highlight"></span>
   <span class="bar"></span>
   <label>Password</label>
   </div>
 <div class="group  ">      
   <input class="inputMaterial" type="password" required>
   <span class="highlight"></span>
   <span class="bar"></span>
   <label>Comferma Password</label>
   </div>
 <div class="group  ">      
   <input class="inputMaterial" type="text" required>
   <span class="highlight"></span>
   <span class="bar"></span>
   <label>Nome</label>
   </div>
 <div class="group  ">      
   <input class="inputMaterial" type="text" required>
   <span class="highlight"></span>
   <span class="bar"></span>
   <label>Cognome</label>
   </div>
 <div class="group  ">      
   <input class="inputMaterial" type="text" required>
   <span class="highlight"></span>
   <span class="bar"></span>
   <label>Email</label>
   </div>




  <button id="buttonlogintoregister">Registration</button>


    <p id="textchange" onclick="register()"> Login</p>



 </form>

 <form method="post" action="" id="login" data-parsley-validate > 
   
     <h1 id="logintoregister">Login</h1>
   <div class="group">      
     <input class="inputMaterial" type="text" required>
     <span class="highlight"></span>
     <span class="bar"></span>
     <label>Username</label>
     </div>
   <div class="group">      
     <input class="inputMaterial" type="password" required  data-parsley-gte="6">

     <span class="highlight"></span>
     <span class="bar"></span>
     <label>Password</label>
     </div>
    


  <button id="buttonlogintoregister">Login</button>

      <p id="plogintoregister">Non sei iscritto? </p><p id="textchange" onclick="register()"> Registration</p>


 </form>






    </div>




  <script type="text/javascript" src="../assets/widgets/parsley/parsley.js"></script>
    <script type="text/javascript" src="../assets/admin-all-demo.js"></script>

<script>
var cont = 0;

function register(){

     cont++;
    
    if(cont==1){
      $('.box').animate({height:'695px'}, 550);
      $('#reg').css('display','block');
      $('#login').css('display','none');


 
    }
    else
    {

      $('#reg').css('display','none');
      $('#login').css('display','block');

      $('.box').animate({height:'365px'}, 550);


 
      cont = 0;
    }
}

$(document).ready(function() {




});

</script>
</body></html>