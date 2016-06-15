

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-plus-sign"></i> Upload Listings Data</h2>

            </div>
            <div class="box-content" id="hideji">

                <?php echo $this->Form->create('Users', array('type' => 'file','data-parsley-validate')); ?>
          
                    <div class="form-group" style="margin-top: 24px;">
                        <label for="exampleInputFile">Select File</label>
                        <input type="file" name="listingdata" id="geodata">

                        <p class="help-block"> Please upload csv format file.</p>
                    </div>
                  
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
					        
                               
       
                </form>

            </div>
			 
			 <div class="box-content" id="loads" style="display:none; padding-top: 32px;text-align: center;padding-bottom: 50px;">
			
			 <img id="progimg" src="<?php echo $this->webroot; ?>img/ajax-loaders/ajax-loader-7.gif" title="loader">
             <p id="lcontent" class="help-block" style="color: green;font-weight: bold;"> connecting to server...</p>
			 <p class="help-block"> Please do not refresh the page until uploading is done!!</p>
			 
			  </div>
			  
        </div>
    </div>
    <!--/span-->

</div><!--/row-->

<script>


$("form").submit(function(){
   
	
var val = $('input[type=file]').val().toLowerCase();
var regex = new RegExp("(.*?)\.(csv)$");
if(!(regex.test(val))) {
$(this).val('');
alert('Please upload csv file !!');
return false;
}  
    
 $("#hideji").hide();
 $("#loads").show();
 
 setTimeout(function(){ 
 $("#lcontent").html('server connected..'); 
 }, 1000);
 
  setTimeout(function(){ 
 $("#lcontent").html('start reading file...'); 
 }, 1500);
 
  setTimeout(function(){ 
$("#progimg").attr('src','<?php echo $this->webroot; ?>img/ajax-loaders/ajax-loader-6.gif');
$("#lcontent").html('uploading data to server...'); 
 }, 2000);

});



</script>