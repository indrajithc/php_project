<?php 

	// Authenticate user login
function auth_login() {
	if( ! isset( $_SESSION['userid'] ) ) {

		$dest = 'http://' . $_SERVER['SERVER_NAME'] . ':80' . $_SERVER['REQUEST_URI'];

		if( dirname($_SERVER['SCRIPT_NAME']) == DIRECTORY . '/admin' ) {
			header('Location: ' . PATH . '/admin/login.php?dest=' . $dest );
		}
		
		if( dirname($_SERVER['SCRIPT_NAME']) == DIRECTORY . '/shop' ) {
			header('Location: ' . PATH . '/shop/login.php?dest=' . $dest );
		}
		

		
		if( dirname($_SERVER['SCRIPT_NAME']) == DIRECTORY . '/customer' ) {
			header('Location: ' . PATH . '/customer/login.php?dest=' . $dest );
		}
		



		if( dirname($_SERVER['SCRIPT_NAME']) == DIRECTORY . '' ) {
			header('Location: ' . PATH . '/index.php?dest=' . $dest );
		}

		
		exit();

	}

	





	$flag = true;
	if( $_SESSION['type'] == 'admin' && dirname($_SERVER['SCRIPT_NAME']) != DIRECTORY . '/admin' ) {
		$flag = false;
	}
	if( $_SESSION['type'] == 'customer' && dirname($_SERVER['SCRIPT_NAME']) != DIRECTORY . '/customer') {
		$flag = false;
	}
	if( $_SESSION['type'] == 'shop' && dirname($_SERVER['SCRIPT_NAME']) != DIRECTORY . '/shop') {
		$flag = false;
	}
	if( !$flag ) {

		
		echo 'You have no permission to view this page';
		exit();
	}
}

	// get logged user type
function user_type() {
	if(isset($_SESSION['type']))
		return $_SESSION['type'];
	else
		return null;
}




if( user_type() == 'customer' ) 
	include_once( 'check.php' );  






























/*==================================================== func by nr-jith ================================================*/



function show_theme_error ($message) {
	$message_return = "";
	if (!empty($message)) {
		$message_return = $message_return . "<div class = 'alert ";
		switch ($message[0]) {
			case 1: $message_return = $message_return .  "alert-success"; break;
			case 2: $message_return = $message_return .  "alert-info"; break;
			case 3: $message_return = $message_return .  "alert-warning"; break; 
			case 4: $message_return = $message_return .  "alert-danger"; break;
			default: $message_return = $message_return .  "hidden"; break;
		}
		$message_return = $message_return .  "' role='alert'>";
		switch ($message[0]) {
			case 1: $message_return = $message_return .  
			'<i style="margin-right: 2em;" class="fa fa-check-circle" aria-hidden="true"></i>'; break;
			case 2: $message_return = $message_return .  
			'<i style="margin-right: 2em;" class="fa fa-info-circle" aria-hidden="true"></i>'; break;
			case 3: $message_return = $message_return .  
			'<i style="margin-right: 2em;" class="fa fa-exclamation-triangle" aria-hidden="true"></i>'; break; 
			case 4: $message_return = $message_return . 
			'<i style="margin-right: 2em;" class="fa fa-exclamation-circle" aria-hidden="true"></i>'; break;				
			default: $message_return = $message_return .  ""; break;
		}
		$message_return = $message_return . "" . $message[1] . "" ;
		$message_return = $message_return .  '<a class="close" data-dismiss="alert" href="page-elements.html#" aria-hidden="true"></a></div>';
	}
	return $message_return;

}











	// error message 
function show_error ($message) {
	$message_return = "";
	if (!empty($message)) {
		$message_return = $message_return . "<div class = 'alert ";
		switch ($message[0]) {
			case 1: $message_return = $message_return .  "alert-success"; break;
			case 2: $message_return = $message_return .  "alert-info"; break;
			case 3: $message_return = $message_return .  "alert-warning"; break; 
			case 4: $message_return = $message_return .  "alert-danger"; break;
			default: $message_return = $message_return .  "hidden"; break;
		}
		$message_return = $message_return .  "' role='alert'>";
		switch ($message[0]) {
			case 1: $message_return = $message_return .  
			'<i class="fa fa-check-circle" aria-hidden="true"></i>'; break;
			case 2: $message_return = $message_return .  
			'<i class="fa fa-info-circle" aria-hidden="true"></i>'; break;
			case 3: $message_return = $message_return .  
			'<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>'; break; 
			case 4: $message_return = $message_return . 
			'<i class="fa fa-exclamation-circle" aria-hidden="true"></i>'; break;				
			default: $message_return = $message_return .  ""; break;
		}
		$message_return = $message_return . "<span style='padding-left: 10px;'>" . $message[1] . "</span>" ;
		$message_return = $message_return .  "</div>";
	}
	return $message_return;

}
	// insert in to 
function insertInToTable ($table, $xarray, $a ) {

	$query = "INSERT INTO ".$table." ( ";
	$bzo = 0;
	foreach($xarray as $k=>$value) { 
		if ( $bzo != 0 ) {
			$query = $query.", ";
		}
		$query = $query." `".$k."`";
		$bzo++;
	}
	$query = $query." ) VALUES ( ";
	$bzo = 0;
	foreach($xarray as $k=>$value) { 
		if ( $bzo != 0 ) {
			$query = $query.", ";
		}
		$query = $query." :update_item_".$bzo ;
		$xarray[':update_item_'.$bzo] = $xarray[$k];
		unset($xarray[$k]); 
		$bzo++;
	}
	$query = $query." ) "; 
	if ($a->execute_query($query, $xarray)){	
		return 1;
	} else {
		return 0;	
	}
}

	// select from
function selectFromTable ($columns, $table, $where, $a ) {
	$query = "SELECT ".$columns."  FROM ".$table." WHERE " . $where ; 
	$result = $a->display($query); 
	if ($result ){	
		$ouch = 0;
		$reto = null;
		foreach ($result[0] as $key => $value) {
			if(trim($key) == trim($columns)){
				$reto = $value;
				$ouch++;
			}
		}
		if($ouch == 1 && $reto != null)
			return $reto;
		else
			return $result ;
	} else {
		return null;	
	}
}


	// update table 
function updateTable ($table, $xarray, $where, $a ) {

	$query = "UPDATE ".$table." SET ";
	$bzo = 0;
	foreach($xarray as $k=>$value) { 
		if ( $bzo != 0 ) {
			$query = $query.", ";
		}
		$query = $query . " `".$k."` = :update_item_".$bzo ;
		$xarray[':update_item_'.$bzo] = $xarray[$k];
		unset($xarray[$k]); 
		$bzo++;
	}
	$query = $query." WHERE " . $where; 
		//echo "$query";
	if ($a->execute_query($query, $xarray)){	
		return 1;
	} else {
		return 0;	
	}
}




?>