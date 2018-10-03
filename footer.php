

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JS -->
	 

 <script type="text/javascript" src="<?php echo PATH; ?>/assets/js/jquery.form.js"></script>



    <script type="text/javascript" src="<?php echo PATH; ?>/assets/widgets/parsley/parsley.js"></script>

<script type="text/javascript" src="<?php echo PATH; ?>/assets/select2/js/select2.full.min.js"></script>

    <script type="text/javascript" src="<?php echo PATH; ?>/assets/admin-all-demo.js"></script>

 


    <script type="text/javascript" src="<?php echo PATH; ?>/assets/js/cropper.min.js"></script> 




        <script type="text/javascript" src="<?php echo PATH; ?>/assets/widgets/datatable/datatable.js"></script>


        <script type="text/javascript" src="<?php echo PATH; ?>/assets/datepicker/js/bootstrap-datepicker.min.js"></script>

     


 





<script> 


        $(document).ready(function() {
           // $('#datatable-example').dataTable();
            $('table.table').dataTable();

 
 

  $("#month").datepicker( {
    format: "mm-yyyy",
    viewMode: "months", 
    minViewMode: "months",
    startDate: '0m'
});




  $('#dob').datepicker({
      format: 'yyyy-mm-dd',
      endDate: '0d' 
  });





 // $('select.card').select2();

        });


        // $(document).ready( function(){

            

        //     var parentta = $('table').parent();
        //     var tablea = parentta.find('table');
        //     parentta.find('table').addClass("remoeMeonlyMe");
        //     var rspms = $('<div class="table  table-responsive"></div>');

        //     $('.remoeMeonlyMe').after(rspms);
        //     $('.remoeMeonlyMe').remove();


        //     parentta.find('.table-responsive').html(tablea);
        // });








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


