<?php


$db=new Database();

  

	 $stmnt='select * from card where card_id = :username AND delete_status = 0 AND login = 0 ';
  	   $params=array( 
             ':username'  =>  $_SESSION['userid']
  	   	);
  	   if($db->display($stmnt,$params)){
	 
	  	   	$myurl = strlen($_SERVER['QUERY_STRING']) ? basename($_SERVER['PHP_SELF'])."?".$_SERVER['QUERY_STRING'] : basename($_SERVER['PHP_SELF']);
	  	   	if($myurl != "complete.php")
	  	   		echo "<script type='text/javascript'>location.href='complete.php'</script>";


  	   }else{

 
  	   }






?>