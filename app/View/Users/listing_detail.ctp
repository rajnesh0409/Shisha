
<?php
$this->Paginator->options(array(
    'update' => '#content',
    'evalScripts' => true
));

?>

<script type="text/javascript">
$(window).load(function() {
	$(".loader").fadeOut("slow");
	$("#tablu").fadeIn("slow");
})
</script>

<style>
.loader  {
    left: 0px;
    top: 0px;
    width: 100%;
    height: 222px;
    z-index: 9999;
    background: url('http://hublyz.brillmindz.org/img/ajax-loaders/ajax-loader-4.gif') 50% 21% no-repeat;
}
.editme { cursor:pointer; }
</style>


<div class="modal fade bs-example-modal-sm" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <input type="text" class="form-control" id="dataval">
			 <input type="hidden" class="form-control" id="fieldname">
			  <input type="hidden" class="form-control" id="listid">
          </div>
         
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="subdata">Update</button>
      </div>
    </div>
  </div>
</div>

<script>
$('body').on("dblclick","td.editme", function(e){  
    $('#exampleModal').modal('show');
	  var fieldname = $(this).data('field'); 
	  var listid = $(this).data('id');
	  var dataval = $('#'+fieldname+listid).attr('listval');

	  $('.modal-title').text('Edit ' + fieldname);
	  $('.modal-body input#dataval').val(dataval);
	  $('.modal-body input#fieldname').val(fieldname);
	  $('.modal-body input#listid').val(listid);
});
</script>

<script>
/* $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var fieldname = button.data('field') 
  var listid = button.data('id')
  var dataval = $('#'+fieldname+listid).attr('listval');
  
  var modal = $(this)
  modal.find('.modal-title').text('Edit ' + fieldname)
  modal.find('.modal-body input#dataval').val(dataval)
  modal.find('.modal-body input#fieldname').val(fieldname)
  modal.find('.modal-body input#listid').val(listid)
})
 */
</script>

<script>
$('body').on("click","#subdata", function(e){            
      
	  var dataval = $('#dataval').val();
	  var fieldname = $('#fieldname').val();
	  var listid = $('#listid').val();

	  
	   $.ajax({
					  url: BaseURL+'Calls/edit_listing',
					  data: {
						dataval: dataval,
						fieldname: fieldname,
						listid: listid
						},
						type: 'POST',
						success: function( data ) {
							data = data.trim();	
							if(data == 'success')
							{
								$('#'+fieldname+listid).text(dataval);
								var sd = $('#'+fieldname+listid).attr('listval',dataval);
								var sds = $('#'+fieldname+listid).attr('listval');
								$('#exampleModal').modal('hide');
								
								 new jBox('Notice', {
                                 content: fieldname+' updated successfully!!',
								 animation: {open: 'tada', close: 'flip'},
								 color: 'green',
								 position: { x: 'right',y: 'top' },
								 offset: { x: -50, y: 80 }
								 }) ;
							}	
						
						}
					});
        });
</script>

<div> 
<p style="margin: 10px; font-weight: bold; color: green;">For more ease double click on any block to update it's value</p>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="col-md-12 box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-plus-sign"></i> Listing Details</h2>

            </div>
            <div class="box-content" style="margin-top: 24px;overflow: auto;">
			
			   <div style="margin-bottom: 70px;">
               
			   <div class="col-md-1">
			   <a href="#" id="dellist" style="width: 76px;font-weight: bold;" class="btn btn-danger btn-sm">
			   <i class="glyphicon glyphicon-trash" style="padding-right: 2px;"></i> Delete</a>
			   </div>
			   
			   <div class="form-group col-md-4" style="margin-left: 35px;">
                    <label class="control-label" for="inputSuccess1" style="width: 86px;">Filter By</label>
					
                    <input type="text" class="form-control" id="searchre" name="searchre" required style="height: 31px;" placeholder="Title / Country / City">
           
				</div>
				
				 <a href="#" id="search" style="width: 76px;font-weight: bold;" class="btn btn-primary btn-sm col-md-1" onclick=" window.location='<?php echo $this->webroot; ?>listing-detail/srch:'+document.getElementById('searchre').value; ">
			   <i class="glyphicon glyphicon-search" style="padding-right: 2px;"></i> Search</a>
		
			   
			   <div class="loader"> <div style="margin-top: 100px;    text-align: center;"> getting listings details.. </div></div>
			   
			    <table style="display: none;" id="tablu" class="display table table-bordered table-striped  bootstrap-datatable datatable responsive">
                        <thead>
                        <tr>
						    <th><input type="checkbox" id="checkAll" value=""/></th>
							<th>Sr.no.</th>
							<th colspan="2" style="text-align:center;">Events</th>
                            <th>Image</th>
							<th><div style="width: 190px;">Title</div></th>
                            <th><div style="width: 115px;">Country</div></th>
                            <th><div style="width: 110px;">State</div></th>
                            <th><div style="width: 115px;">City</div></th>
							
							
							<th><div style="width: 105px;">Start rating</div></th>
							<th><div style="width: 105px;">Start reviews</div></th>
							<th><div style="width: 145px;">Address</div></th>
							<th><div style="width: 125px;">Neighborhood</div></th>
							<th>website</th>
							<th><div style="width: 115px;">Start price</div></th>
							<th><div style="width: 115px;">Hublyz reviews</div></th>
							
							<th><div style="width: 115px;">Hublyz ratings</div></th>
							<th><div style="width: 115px;">Hublyz price</div></th>
							<th><div style="width: 133px;">Monday</div></th>
							<th><div style="width: 133px;">Tuesday</div></th>
							<th><div style="width: 133px;">Wednesday</div></th>
							<th><div style="width: 133px;">Thrusday</div></th>
							<th><div style="width: 133px;">Friday</div></th>
							<th><div style="width: 133px;">Saturday</div></th>
							<th><div style="width: 133px;">Sunday</div></th>
							<th>Listing images</th>
							<th><div style="width: 85px;">Status</div></th>
							
                        </tr>
                        </thead>
                        <tbody>
                       
                    <?php   
					    $i = $this->Paginator->counter('{:start}');
						foreach($listings as $key=>$value) { 
						$bimage = $value['Listing']['banner_image'];
						if($bimage == 'default')
						{
							$bannerimage = 'default';
						}
					    else
						{
						   $bannerimage = '<img style="width: 42px;height: 30px;"class="grayscale" src="'.$this->webroot.'files/banner_images/'.$bimage.'"';  
						}					   
			        ?>

					   <tr>
                       
					        <td> <input type="checkbox" value="<?php echo $value['Listing']['id']; ?>"> </td>
							<td><?php echo $i; ?></td>
								 
								 <td>
								 
								 <a href="<?php echo $this->webroot; ?>events/<?php echo $value['Listing']['id']; ?>" id="search" style="font-weight: bold;" class="btn btn-primary btn-sm" onclick=" window.location='<?php echo $this->webroot; ?>listing-detail/srch:'+document.getElementById('searchre').value; ">
			                      <i class="glyphicon glyphicon-calendar" style="padding-right: 2px;"></i> Create Event</a>
								  </td>
								  
								   <td>
								  <a href="<?php echo $this->webroot; ?>list-event-detail/<?php echo $value['Listing']['id']; ?>" id="search" style="font-weight: bold;" class="btn btn-primary btn-sm" onclick=" window.location='<?php echo $this->webroot; ?>listing-detail/srch:'+document.getElementById('searchre').value; ">
			                      <i class="glyphicon glyphicon-calendar" style="padding-right: 2px;"></i> View Events</a>
								  </td>
								  
							<td><?php echo $bannerimage; ?></td>
							
							<td style="font-weight: bold;color: #1591d8;" class="editme" id="title<?php echo $value['Listing']['id']; ?>" data-field="title"  data-target="#exampleModal" data-id="<?php echo $value['Listing']['id']; ?>" listval="<?php echo $value['Listing']['title']; ?>"><?php echo $value['Listing']['title']; ?></td>
			
                            <td class="editme" id="country<?php echo $value['Listing']['id']; ?>" data-field="country"  data-target="#exampleModal" data-id="<?php echo $value['Listing']['id']; ?>" listval="<?php echo $value['Listing']['country']; ?>">
							<?php echo $value['Listing']['country']; ?>
							</td>
							
                            <td class="editme" id="state<?php echo $value['Listing']['id']; ?>" data-field="state"  data-target="#exampleModal" data-id="<?php echo $value['Listing']['id']; ?>" listval="<?php echo $value['Listing']['state']; ?>"><?php echo $value['Listing']['state']; ?></td>
							
							<td class="editme" id="city<?php echo $value['Listing']['id']; ?>" data-field="city"  data-target="#exampleModal" data-id="<?php echo $value['Listing']['id']; ?>" listval="<?php echo $value['Listing']['city']; ?>"><?php echo $value['Listing']['city']; ?></td>
			
							<td class="editme" id="start_rating<?php echo $value['Listing']['id']; ?>" data-field="start_rating"  data-target="#exampleModal" data-id="<?php echo $value['Listing']['id']; ?>" listval="<?php echo $value['Listing']['start_rating']; ?>"><?php echo $value['Listing']['start_rating']; ?></td>
							<td class="editme" id="start_reviews<?php echo $value['Listing']['id']; ?>" data-field="start_reviews"  data-target="#exampleModal" data-id="<?php echo $value['Listing']['id']; ?>" listval="<?php echo $value['Listing']['start_reviews']; ?>"><?php echo $value['Listing']['start_reviews']; ?></td>
							
							<td class="editme" id="address<?php echo $value['Listing']['id']; ?>" data-field="address"  data-target="#exampleModal" data-id="<?php echo $value['Listing']['id']; ?>" listval="<?php echo $value['Listing']['address']; ?>"><?php echo $value['Listing']['address']; ?></td>
							<td class="editme" id="neighborhood<?php echo $value['Listing']['id']; ?>" data-field="neighborhood"  data-target="#exampleModal" data-id="<?php echo $value['Listing']['id']; ?>" listval="<?php echo $value['Listing']['neighborhood']; ?>"><?php echo $value['Listing']['neighborhood']; ?></td>
							<td class="editme" id="website<?php echo $value['Listing']['id']; ?>" data-field="website"  data-target="#exampleModal" data-id="<?php echo $value['Listing']['id']; ?>" listval="<?php echo $value['Listing']['website']; ?>"><?php echo $value['Listing']['website']; ?></td>
							<td class="editme" id="start_price<?php echo $value['Listing']['id']; ?>" data-field="start_price"  data-target="#exampleModal" data-id="<?php echo $value['Listing']['id']; ?>" listval="<?php echo $value['Listing']['start_price']; ?>"><?php echo $value['Listing']['start_price']; ?></td>
							<td class="editme" id="hublyz_reviews<?php echo $value['Listing']['id']; ?>" data-field="hublyz_reviews"  data-target="#exampleModal" data-id="<?php echo $value['Listing']['id']; ?>" listval="<?php echo $value['Listing']['hublyz_reviews']; ?>"><?php echo $value['Listing']['hublyz_reviews']; ?></td>
							
							<td class="editme" id="hublyz_ratings<?php echo $value['Listing']['id']; ?>" data-field="hublyz_ratings"  data-target="#exampleModal" data-id="<?php echo $value['Listing']['id']; ?>" listval="<?php echo $value['Listing']['hublyz_ratings']; ?>"><?php echo $value['Listing']['hublyz_ratings']; ?></td>
							<td class="editme" id="hublyz_price<?php echo $value['Listing']['id']; ?>" data-field="hublyz_price"  data-target="#exampleModal" data-id="<?php echo $value['Listing']['id']; ?>" listval="<?php echo $value['Listing']['hublyz_price']; ?>"><?php echo $value['Listing']['hublyz_price']; ?></td>
							
							<td style="color: #fd6503;" class="editme" id="mon<?php echo $value['Listing']['id']; ?>" data-field="mon"  data-target="#exampleModal" data-id="<?php echo $value['Listing']['id']; ?>" listval="<?php echo $value['Listing']['mon']; ?>"><?php echo $value['Listing']['mon']; ?></td>
							<td style="color: #fd6503;" class="editme" id="tue<?php echo $value['Listing']['id']; ?>" data-field="tue"  data-target="#exampleModal" data-id="<?php echo $value['Listing']['id']; ?>" listval="<?php echo $value['Listing']['tue']; ?>"><?php echo $value['Listing']['tue']; ?></td>
							<td style="color: #fd6503;" class="editme" id="wed<?php echo $value['Listing']['id']; ?>" data-field="wed"  data-target="#exampleModal" data-id="<?php echo $value['Listing']['id']; ?>" listval="<?php echo $value['Listing']['wed']; ?>"><?php echo $value['Listing']['wed']; ?></td>
							<td style="color: #fd6503;" class="editme" id="thr<?php echo $value['Listing']['id']; ?>" data-field="thr"  data-target="#exampleModal" data-id="<?php echo $value['Listing']['id']; ?>" listval="<?php echo $value['Listing']['thr']; ?>"><?php echo $value['Listing']['thr']; ?></td>
							<td style="color: #fd6503;" class="editme" id="fri<?php echo $value['Listing']['id']; ?>" data-field="fri"  data-target="#exampleModal" data-id="<?php echo $value['Listing']['id']; ?>" listval="<?php echo $value['Listing']['fri']; ?>"><?php echo $value['Listing']['fri']; ?></td>
							<td style="color: #fd6503;" class="editme" id="sat<?php echo $value['Listing']['id']; ?>" data-field="sat"  data-target="#exampleModal" data-id="<?php echo $value['Listing']['id']; ?>" listval="<?php echo $value['Listing']['sat']; ?>"><?php echo $value['Listing']['sat']; ?></td>
							<td style="color: #fd6503;" class="editme" id="sun<?php echo $value['Listing']['id']; ?>" data-field="sun"  data-target="#exampleModal" data-id="<?php echo $value['Listing']['id']; ?>" listval="<?php echo $value['Listing']['sun']; ?>"><?php echo $value['Listing']['sun']; ?></td>
                             <td>
								  <a href="<?php echo $this->webroot; ?>listing-images/<?php echo $value['Listing']['id']; ?>"" id="search" style="font-weight: bold;" class="btn btn-primary btn-sm">
			                      <i class="glyphicon glyphicon-picture" style="padding-right: 2px;"></i>Listing images</a>
							</td>
								  
							<td class="center">
							<?php
							$status = $value['Listing']['status'];
							if($status == 'Active')
							{	
							?>
                            <span sid="<?php echo $value['Listing']['id']; ?>" status="Inactive" class="label-success label label-default status" style="cursor:pointer;">Active</span>
                            <?php } else { ?>
							 <span sid="<?php echo $value['Listing']['id']; ?>" status="Active" class="label-danger label label-default status" style="cursor:pointer;">Inactive</span>
                            
							<?php } ?>
							</td>
                        </tr>
						
					<?php $i++; } ?>
                       
                        </tbody>
                    </table>
		<div style="text-align: center;">			
		<?php
		echo $this->Paginator->counter(
        'Page {:page} of {:pages}, showing {:current} listings out of
       {:count} listings, starting on record {:start}, ending on {:end}'
       );
	   ?>
	   </div>
					
		<div class="pagination" style="margin-left: 300px;">
	    <?php
		echo $this->Paginator->prev('← Prev', array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('class' => 'numberspage','separator' => ' '));
		echo $this->Paginator->next('Next → ', array('class' => 'NextPg'), null, array('class' => 'NextPg DisabledPgLk'));
		
		?>
        </div>
			
        </div>
    </div>
    <!--/span-->

</div><!--/row-->
</div><!--/row-->


<script>
$('body').on("click",".status", function(){
	var listid = $(this).attr('sid');	
	var status = $(this).attr('status');
	$.ajax({
	  url: BaseURL+'Calls/listing_status',
	  data: {
		status: status,
		listid: listid
		},
		type: 'POST',
		success: function( data ) {
		location.reload();	
		}
	});			
});
</script>

<script>
$('#searchre').keypress(function (e) {
    if (e.which == 13) {
		window.location='<?php echo $this->webroot; ?>listing-detail/srch:'+document.getElementById('searchre').value;
    }
});
</script>


<script>
$("#checkAll").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
});
</script>

<script>

$("#dellist").click(function () {	
	var list_ids = $('input:checkbox:checked').map(function() {
    return this.value;
}).get();

if(list_ids == '')
{
	alert('please choose listing!!');
	return false;
}	

$.ajax({
  url: BaseURL+'Calls/delete_listings',
  data: {
    list_ids: list_ids,
	},
    type: 'POST',
    success: function( data ) {
     location.reload();	
    }
});
});


</script>

