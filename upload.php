 <?php 
 $url   = $_SERVER['REQUEST_URI'];//returns the current URL
 $parts = explode('/', $url);
 $dir   = $_SERVER['SERVER_NAME'];
 for ($i = 0; $i < count($parts)-1; $i++) {
 	$dir .= $parts[$i]."/";
 }


$dir = 'http://'.$dir;





if(!empty($_FILES)) {

 


    for($i=0;$i<count( $_FILES['upad_any_item_1']['tmp_name'] );$i++) {
        

        if(is_uploaded_file($_FILES['upad_any_item_1']['tmp_name'][$i]) ) {
    






              $sourcePath = $_FILES['upad_any_item_1']['tmp_name'][$i];
              $targetPath = "user/uploads/".$_FILES['upad_any_item_1']['name'][$i];

              if(move_uploaded_file($sourcePath,$targetPath)) {
              	
              $targetPath_new = basename($targetPath);
              $file_exte_fir_fu = pathinfo($targetPath_new, PATHINFO_EXTENSION);
      $targetPath_new =  'user/uploads/'.strtotime(date('Y-m-d H:i:s')).'-'.basename($targetPath_new) ;
               if(rename($targetPath , $targetPath_new)) {
               

              		switch(strtolower($file_exte_fir_fu))  {
              			case 'jpg':
              			 		?>

                <div class="" style="display: inline-block;">

                <img class='div_les_edu454445' src="<?php echo $dir.'user/uploads/'.basename($targetPath_new); ?>" style=" max-width: 100px; max-height: 100px; width: 100px; height: auto;"/>

	                <div>

		                <span class="glyphicon glyphicon-camera icon_me_54985" aria-hidden="true"  >
		                </span>

		                <span class="glyphicon glyphicon-remove remove_me_54985" aria-hidden="true"  ">
		                	
		                </span>
	                </div>
                </div>
              			<?php 
              			break;
              			case 'png':
              					?>

                <div class="" style="display: inline-block;">
                <img class='div_les_edu454445'  src="<?php echo $dir.'user/uploads/'.basename($targetPath_new); ?>" style=" max-width: 100px; max-height: 100px; width: 100px; height: auto;" />
                <div>
                <span class="glyphicon glyphicon-camera icon_me_54985" aria-hidden="true"  >
                	
                </span>
                <span class="glyphicon glyphicon-remove remove_me_54985" aria-hidden="true">
                	
                </span>
                </div>
                </div>
              			<?php 
              			break;
              			case 'jpeg':
              					?>

                <div class="" style="display: inline-block;">
                <img  class='div_les_edu454445' src="<?php echo $dir.'user/uploads/'.basename($targetPath_new); ?>" style=" max-width: 100px; max-height: 100px; width: auto; height: auto;"/>
                <div>
                <span class="glyphicon glyphicon-camera icon_me_54985" aria-hidden="true" 
                ></span>
                <span class="glyphicon glyphicon-remove remove_me_54985" aria-hidden="true"
                >
                	
                </span>
                </div>
                </div>
              			<?php 
              			break;
              			case 'gif':
              			
              			break;		?>

                <div class="" style="display: inline-block;">
                <img  class='div_les_edu454445' src="<?php echo $dir.'user/uploads/'.basename($targetPath_new); ?>" style=" max-width: 100px; max-height: 100px; width: auto; height: auto;"/>
                <div>
                <span class="glyphicon glyphicon-camera icon_me_54985" aria-hidden="true"  >
                	
                </span>
                <span class="glyphicon glyphicon-remove remove_me_54985" aria-hidden="true" >
                	
                </span>
                </div>
                </div>
              			<?php 
              			case 'mp4':
              				?>

                <div class="" style="display: inline-block;"><video class='div_les_edu454445'  src="<?php echo $dir.'user/uploads/'.basename($targetPath_new); ?>" width="100px" height="100px"></video>

                <div><span class="glyphicon glyphicon-facetime-video icon_me_54985" aria-hidden="true"  ></span><span class="glyphicon glyphicon-remove remove_me_54985" aria-hidden="true"  ></span></div></div>

              	<?php
              			break;
              			case '3gp':
              			?>
                <div class="" style="display: inline-block;"><video class='div_les_edu454445'  src="<?php echo $dir.'user/uploads/'.basename($targetPath_new); ?>" width="100px" height="100px"></video><div><span class="glyphicon glyphicon-facetime-video icon_me_54985" aria-hidden="true"  ><span class="glyphicon glyphicon-remove remove_me_54985" aria-hidden="true"  ></span></span></div></div>

              	<?php
              			break;
              			case 'mkv':
              			?>
                <div class="" style="display: inline-block;"><video class='div_les_edu454445'  src="<?php echo $dir.'user/uploads/'.basename($targetPath_new); ?>" width="100px" height="100px"></video><div><span class="glyphicon glyphicon-facetime-video icon_me_54985" aria-hidden="true"  ><span class="glyphicon glyphicon-remove remove_me_54985" aria-hidden="true"  ></span></span></div></div>

              	<?php
              			break;
              			case 'avi':
              			?>
                <div class="" style="display: inline-block;"><video class='div_les_edu454445'  src="<?php echo $dir.'user/uploads/'.basename($targetPath_new); ?>" width="100px" height="100px"></video><div><span class="glyphicon glyphicon-facetime-video icon_me_54985" aria-hidden="true"  ><span class="glyphicon glyphicon-remove remove_me_54985" aria-hidden="true"  ></span></span></div></div>

              	<?php
              			break;
              			case 'mov':
              			?>
                <div class="" style="display: inline-block;"><video class='div_les_edu454445'  src="<?php echo $dir.'user/uploads/'.basename($targetPath_new); ?>" width="100px" height="100px"></video><div><span class="glyphicon glyphicon-facetime-video icon_me_54985" aria-hidden="true"  ><span class="glyphicon glyphicon-remove remove_me_54985" aria-hidden="true"  ></span></span></div></div>

              	<?php
              			break;
              			case 'docx':
              				?>
                              

                <div class="" style="display: inline-block;"><object  class='div_les_edu454445' src="<?php echo $dir.'user/uploads/'.basename($targetPath_new); ?>" style=" max-width: 100px; max-height: 100px; width: auto; height: auto;"/><div><span class="glyphicon glyphicon-book icon_me_54985" aria-hidden="true"  ></span><span class="glyphicon glyphicon-remove remove_me_54985" aria-hidden="true"  ></span></div></div>

              	<?php
              			break;
              			case 'pdf':
              				?>

                <div class="" style="display: inline-block;"><embed  class='div_les_edu454445' src="<?php echo $dir.'user/uploads/'.basename($targetPath_new); ?>" style=" max-width: 100px; max-height: 100px; width: auto; height: auto;"/><div><span class="glyphicon glyphicon-book icon_me_54985" aria-hidden="true"  ></span><span class="glyphicon glyphicon-remove remove_me_54985" aria-hidden="true"  ></span></div></div>
              	<?php
              			
              			break;
              			case 'ppt':
              				?>
                              


                <div class="" style="display: inline-block;"><object  class='div_les_edu454445' src="<?php echo $dir.'user/uploads/'.basename($targetPath_new); ?>" style=" max-width: 100px; max-height: 100px; width: auto; height: auto;"/><div><span class="glyphicon glyphicon-book icon_me_54985" aria-hidden="true"  ></span><span class="glyphicon glyphicon-remove remove_me_54985" aria-hidden="true"  ></span></div></div>
              	<?php
              			break;
              			default :
              				?>
                              


                <div class="" style="display: inline-block;" ><img  class='div_les_edu454445' src="../assets/images/files.png" style=" max-width: 100px; max-height: 100px; width: auto; height: auto;  " src-1="<?php echo $dir.'user/uploads/'.basename($targetPath_new); ?>"/>

                <div><span class="glyphicon glyphicon-file icon_me_54985" aria-hidden="true"  ></span><span class="glyphicon glyphicon-remove remove_me_54985" aria-hidden="true"  ></span></div></div>
              	<?php
              	
              		}
              		
              		
              	
              	
              	?>



              <?php 
               } else {
              	 echo "";
               }



              }



        }

    }



}
?>






