
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
$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var fieldname = button.data('field') 
  var listid = button.data('id')
  var dataval = $('#tbl'+listid).attr('listval');
  
  var modal = $(this)
  modal.find('.modal-title').text('Edit ' + fieldname)
  modal.find('.modal-body input#dataval').val(dataval)
  modal.find('.modal-body input#fieldname').val(fieldname)
  modal.find('.modal-body input#listid').val(listid)
})

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
								$('#tbl'+listid).text(dataval);
								var sd = jQuery('#tbl'+listid).attr('listval',dataval);
								var sds = jQuery('#tbl'+listid).attr('listval');
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
				
			   </div>
			   
			   <div class="loader"> <div style="margin-top: 100px;    text-align: center;"> getting listings details.. </div></div>
			   
			    <table style="display: none;" id="tablu" class="display table table-bordered table-striped  bootstrap-datatable datatable responsive">
                        <thead>
                        <tr>
						    <th><input type="checkbox" id="checkAll" value=""/></th>
							<th>Sr.no.</th>
                            <th>Image</th>
                            <th>country</th>
                            <th>state</th>
                            <th>city</th>
							<th>title</th>
							
							<th>start_rating</th>
							<th>start_reviews</th>
							<th>address</th>
							<th>neighborhood</th>
							<th>website</th>
							<th>start_price</th>
							<th>hublyz_reviews</th>
							
							<th>hublyz_ratings</th>
							<th>hublyz_price</th>
							<th>Mon</th>
							<th>Tue</th>
							<th>Wed</th>
							<th>Thu</th>
							<th>Fri</th>
							<th>Sat</th>
							<th>Sun</th>
							<th>Status</th>
							
                        </tr>
                        </thead>
                        <tbody>
                       
                      <?php   $i = $this->Paginator->counter('{:start}');
			        foreach($listings as $key=>$value) { 
					//$driver_file = $this->webroot.'files/driver/'.$driver_file;
			        ?>

					   <tr>
                       
					        <td> <input type="checkbox" value="<?php echo $value['Listing']['id']; ?>"> </td>
							<td><?php echo $i; ?></td>
							<td><?php echo $value['Listing']['banner_image']; ?></td>
                            <td><div style='width: 150px;'>
							<?php echo $value['Listing']['country']; ?></div>
							</td>
                            <td  id="tbl<?php echo $value['Listing']['id']; ?>" data-toggle="modal" data-target="#exampleModal" data-id="<?php echo $value['Listing']['id']; ?>" data-field="state" listval="<?php echo $value['Listing']['state']; ?>"><?php echo $value['Listing']['state']; ?></td>
							<td><?php echo $value['Listing']['city']; ?></td>
							<td><div style='width: 130px;'><?php echo $value['Listing']['title']; ?></div></td>
							<td><?php echo $value['Listing']['start_rating']; ?></td>
							<td><?php echo $value['Listing']['start_reviews']; ?></td>
							<td><div style='width: 140px;'><?php echo $value['Listing']['address']; ?></div></td>
							<td><?php echo $value['Listing']['neighborhood']; ?></td>
							<td><?php echo $value['Listing']['website']; ?></td>
							<td><?php echo $value['Listing']['start_price']; ?></td>
							<td><?php echo $value['Listing']['hublyz_reviews']; ?></td>
							
							<td><?php echo $value['Listing']['hublyz_ratings']; ?></td>
							<td><?php echo $value['Listing']['hublyz_price']; ?></td>
							
							<td><div style='width: 135px;'><?php echo $value['Listing']['mon']; ?></div></td>
							<td><div style='width: 135px;'><?php echo $value['Listing']['tue']; ?></div></td>
							<td><div style='width: 135px;'><?php echo $value['Listing']['wed']; ?></div></td>
							<td><div style='width: 135px;'><?php echo $value['Listing']['thr']; ?></div></td>
							<td><div style='width: 135px;'><?php echo $value['Listing']['fri']; ?></div></td>
							<td><div style='width: 135px;'><?php echo $value['Listing']['sat']; ?></div></td>
							<td><div style='width: 135px;'><?php echo $value['Listing']['sun']; ?></div></td>

							<td class="center">
                                <span class="label-success label label-default">Active</span>
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


<?php
echo $this->Html->script('https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js');
?>

<script>

$(document).ready(function() {
    $('#tablu').DataTable( {
        "paging":   false,
        "ordering": false,
		"bFilter": false,
        "info":     false
    } );
} );


</script>