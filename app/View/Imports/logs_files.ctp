

<div class="row">
    <div class="box col-md-12">
        <div class="col-md-12 box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-plus-sign"></i> Logs files</h2>

            </div>
            <div class="box-content" style="margin-top: 24px;overflow: auto;">

			    <table  id="tablu" class="display table table-bordered table-striped  bootstrap-datatable datatable responsive">
                        <thead>
                        <tr>
                            <th>Sr.No.</th>
                            <th>File name</th>
                            <th>Created on</th>
							<th>View</th>
							<th>Download</th>
							
                        </tr>
                        </thead>
                        <tbody>
                       
                      <?php
                      $i = 1; 					  
			          foreach($logsfiles as $key=>$value)
					  {							
			         ?>

					   <tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $value['BulkLog']['file_name']; ?></td>
							<td><?php echo $value['BulkLog']['created']; ?></td>
							
							<td>
							 <a href="<?php echo $this->webroot; ?>logsdata/fl:<?php echo $value['BulkLog']['file_name']; ?>" id="view" class="btn btn-primary btn-xs">
			                 <i class="glyphicon glyphicon-eye-open" style="padding-right: 2px;"></i> view</a>
							</td>
							
							<td>
							<a href="<?php echo $this->webroot; ?>imports/sendFile/<?php echo $value['BulkLog']['file_name']; ?>" id="download" class="btn btn-primary btn-xs">
			                 <i class="glyphicon glyphicon-download" style="padding-right: 2px;"></i> Download</a>
							
							</td>
                        </tr>
						
					<?php $i++; } ?>
                       
                        </tbody>
                    </table>
			
        </div>
    </div>
    <!--/span-->

</div><!--/row-->
</div><!--/row-->

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