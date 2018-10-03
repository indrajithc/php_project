<?php     include_once( '../header.php' );     
$db=new Database();

  $message = array( NULL, NULL);






       if(isset($_GET['pr_id'])){  

     $pr_id = $_GET['pr_id'];







     if(isset($_POST['delete-me']) || isset($_POST['active-me'])) {
       $Sdelete = 0;
       if(isset($_POST['delete-me'])) 
          $Sdelete = 1;
 
          $sql='update product set delete_status=:delete_status where pr_id=:pr_id';
          $params=array(
               ':delete_status'      =>  $Sdelete,
               ':pr_id'      =>  $pr_id
            );
           if($db->execute_query($sql,$params) ){
               $message [0] = 1;
               $message [1] = ' successfully updated';  

        }



     }















$stmnt='select * from product where pr_id=:pr_id';     

 $params = array(':pr_id'=>$pr_id);      

 $pdt = $db->display($stmnt, $params);      


  if( $pdt ) { $pdt = $pdt[0];

 
$pdt['total_price'] =  $pdt['price'] * $pdt['quantity'] ;


         


        if(isset($_POST['submit'])) { //print_r($_POST);
    $sql='update product set pr_name=:pr_name,price=:price,quantity=:quantity,total_price=:total_price,description=:description where pr_id=:pr_id';
    $params=array(
         ':pr_name'      =>  $_POST['pr_name'],
         ':price'        =>  $_POST['price'],
         ':quantity'     =>  $_POST['quantity'],
         ':total_price'         =>  $_POST['price'] *  $_POST['quantity'] ,
         ':description'  =>  $_POST['description'],
         ':pr_id'      =>  $pr_id
      );
     if($db->execute_query($sql,$params))

              $message [0] = 1;
              $message [1] = ' successfully updated';  


    $stmnt='select * from product where pr_id=:pr_id';     

     $params = array(':pr_id'=>$pr_id);      

     $pdt = $db->display($stmnt, $params);      


      if( $pdt ) { $pdt = $pdt[0];}

  }
    
 ?>

  
<div id="page-title">
      <h2>Edit Product</h2>
      <p></p>
  </div>

  <div class="panel">
      <div class="panel-body">
          <h3 class="title-hero">
              Elements
          </h3>
<?php echo show_error ($message); ?>
        <form class="form-horizontal bordered-row"  action="" method="post" data-parsley-validate>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                        <label class="col-sm-3 control-label">Product Name</label>
                        <div class="col-sm-6">
                            <input type="text" required name="pr_name" value="<?php echo $pdt['pr_name']; ?>" class="form-control" placeholder="_Product Name.." name="pr_no">
                        </div>
                    </div>
              </div>
              
              <div class="col-md-6">
                  <div class="form-group">
                          <label class="col-sm-3 control-label">Price</label>
                          <div class="col-sm-6">
                           <input type="number"  min="10" class="form-control" id="price" placeholder="price.." name="price" value="<?php echo $pdt['price']; ?>">      
                          </div>
                      </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                          <label class="col-sm-3 control-label">Quantity</label>
                          <div class="col-sm-6">
                              <input type="number"  min="10" class="form-control" id="quantity" placeholder="quantity.." name="quantity" value="<?php echo $pdt['quantity']; ?>">
                          </div>
                      </div>
                      </div>
             
  <div class="col-md-6">
                  <div class="form-group">
                          <label class="col-sm-3 control-label">total Price</label>
                          <div class="col-sm-6">
                              <input type="number" disabled="disabled" required name="total_price" class="form-control" placeholder="Total Price.." name="total_price" value="<?php echo $pdt['total_price']; ?>">   
                          </div>
                      </div>
                </div>



                <div class="col-md-6">
                  <div class="form-group">
                          <label class="col-sm-3 control-label">Description</label>
                          <div class="col-sm-6">
                              <textarea type="text"  class="form-control" id="description" placeholder="Description.." name="description" ><?php echo $pdt['description']; ?></textarea>
                          </div>
                      </div>
                      </div>
                    
              </div>  
              <div class="content-box text-center">
                  <input type="submit" name="submit" value="UPDATE" class="btn btn-lg btn-primary">




                  <?php
                  if($pdt['delete_status'] == 0 )
                  echo  '  <input type="submit" name="delete-me" value="DELETE" class="btn btn-lg btn-danger">';
                  if($pdt['delete_status'] == 1 )
                  echo '  <input type="submit" name="active-me" value="ACTIVE" class="btn btn-lg btn-success">';

                  ?>




              </div> 

          </form>
      </div>
    </div>



<script type="text/javascript">
  
$(document).ready(function() {


  $('input[name="quantity"], input[name="price"]').change( function(){ 

    var n1 = $('input[name="quantity"]').val();
    var n2 = $('input[name="price"]').val();

    if(n1>0 && n2>0){
      $('input[name="total_price"]').val( n1 * n2 );
    } else {

      $('input[name="total_price"]').val("" );
    }





  } );

  
});

</script>


    <?php 
    }} else {echo "No shopes to edit";}?>

<?php include_once('../footer.php');  ?>