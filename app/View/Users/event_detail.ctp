
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
                <h2><i class="glyphicon glyphicon-calendar"></i> Event Details</h2>

            </div>
            <div class="box-content" style="margin-top: 24px;overflow: auto;">
			
			   <div style="margin-bottom: 70px;">
			   
			   <div class="loader"> <div style="margin-top: 100px;    text-align: center;"> getting event details.. </div></div>
			   
			    <table id="tablu" class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                        <thead>
                        <tr>
						  
                            <th><div style="width:130px;">Listing Name</div></th>
                            <th><div style="width:90px;">Event Name</div></th>
                            <th><div style="width:140px;">Description</div></th>
							<th><div style="width:90px;">Event Period</div></th>
							<th><div style="width:90px;">Event date</div></th>
							<th><div style="width:150px;">Event time</div></th>
							<th> Event images </th>
							<th>Status</th>
							<th>Action</th>
							
                        </tr>
                        </thead>
                        <tbody>
                       
                      <?php   
			        foreach($events as $key=>$value) { 
					
					$eventperiod = $value['Event']['eventperiod'];
					
					if($eventperiod == 'Fortnightly')
					{
						$eventdate = $value['Event']['fortnightly'];
					}
                    elseif($eventperiod == 'Monthly')
				    {
					   $eventdate = $value['Event']['monthly'];
				    }
                    elseif($eventperiod == 'Yearly')
				    {
					   $eventdate = $value['Event']['yearly'];
				    }
                    else
                    {
						$eventdate = $value['Event']['weekly'];
					}						
					
					
				
			        ?>

					   <tr>
                       
                            <td class="editme" id="listname<?php echo $value['Event']['id']; ?>" data-field="listname"  data-target="#exampleModal" 
							data-id="<?php echo $value['Event']['id']; ?>" listval="<?php echo $value['Event']['listname']; ?>">
							<?php echo $value['Event']['listname']; ?></td>
							
							<td style="font-weight: bold;color: #1591d8;" class="editme" id="title<?php echo $value['Event']['id']; ?>" data-field="title"  data-target="#exampleModal" 
							data-id="<?php echo $value['Event']['id']; ?>" listval="<?php echo $value['Event']['title']; ?>">
							<?php echo $value['Event']['title']; ?></td>
							
							<td class="editme" id="description<?php echo $value['Event']['id']; ?>" data-field="description"  data-target="#exampleModal" 
							data-id="<?php echo $value['Event']['id']; ?>" listval="<?php echo $value['Event']['description']; ?>">
							<?php echo $value['Event']['description']; ?></td>
							
							<td><?php echo $value['Event']['eventperiod']; ?></td>
							<td><?php echo $eventdate; ?></td>
							
							<td style="color: #fd6503;" class="editme" id="event_time<?php echo $value['Event']['id']; ?>" data-field="event_time"  data-target="#exampleModal" 
							data-id="<?php echo $value['Event']['id']; ?>" listval="<?php echo $value['Event']['event_time']; ?>">
							<?php echo $value['Event']['event_time']; ?></td>

							
							<td class="center">
                                 <a href="<?php echo $this->webroot ;?>event-images/<?php echo $value['Event']['id']; ?>" style="font-weight: bold;" class="btn btn-primary btn-xs">
			                     <i class="glyphicon glyphicon-calendar" style="padding-right: 2px;"></i> Event Images</a>
                            </td>
							
							<td class="center">
							<?php
							$status = $value['Event']['status'];
							if($status == 'Active')
							{	
							?>
                            <span sid="<?php echo $value['Event']['id']; ?>" status="Inactive" class="label-success label label-default status" style="cursor:pointer;">Active</span>
                            <?php } else { ?>
							 <span sid="<?php echo $value['Event']['id']; ?>" status="Active" class="label-danger label label-default status" style="cursor:pointer;">Inactive</span>
                            
							<?php } ?>
							</td>
							
							<td class="center">
                                 <a href="#" eventid="<?php echo $value['Event']['id']; ?>" style="font-weight: bold;" class="btn btn-danger btn-xs delevent">
			                     <i class="glyphicon glyphicon-trash" style="padding-right: 2px;"></i> Delete</a>
                            </td>
                        </tr>
						
					<?php  } ?>
                       
                        </tbody>
                    </table>

			
        </div>
    </div>
    <!--/span-->

</div><!--/row-->
</div><!--/row-->

<script>
$('body').on("click",".status", function(){
	var eventid = $(this).attr('sid');	
	var status = $(this).attr('status');
	$.ajax({
	  url: BaseURL+'Calls/event_status',
	  data: {
		status: status,
		eventid: eventid
		},
		type: 'POST',
		success: function( data ) {
		location.reload();	
		}
	});			
});
</script>




<script>

$(".delevent").click(function () {	
	
var r = confirm("Are you sure to remove this event?");
    if (r != true) 
	{
	  	return false;
    }	
	
var eventid = $(this).attr('eventid');
alert(eventid);	

$.ajax({
  url: BaseURL+'Calls/delete_event',
  data: {
    eventid: eventid,
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
        "paging":   true,
		"ordering": true,
		"bFilter": true,
        "info":     true
     
    } );
} );


</script>