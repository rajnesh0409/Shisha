

<div class="row">
    <div class="box col-md-12">
        <div class="col-md-12 box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-plus-sign"></i> Logs Detail</h2>

            </div>
            <div class="box-content" style="margin-top: 24px;overflow: auto;">

			    <table  id="tablu" class="display table table-bordered table-striped  bootstrap-datatable datatable responsive">
                        <thead>
                        <tr>
                            <th>Country</th>
                            <th>State</th>
                            <th>City</th>
							<th>Title</th>
							<th>Status</th>
							
                        </tr>
                        </thead>
                        <tbody>
                       
                      <?php 
			          foreach($logsdata as $key=>$value)
					  {
						$dtv = explode("-",$value);
						$country = $dtv['0'];
						$state = $dtv['1'];
						$city = $dtv['2'];
						$title = $dtv['3'];
						$status = $dtv['4'];
						$status = trim(str_replace(">","",$status));
						
						if($status == 'Already exist')
						{
							$color = 'red';
						}
                        else
                        {
							$color = 'green';
						}							
			        ?>

					   <tr>
							<td><?php echo str_replace("_"," ",$country); ?></td>
							<td><?php echo str_replace("_"," ",$state); ?></td>
							<td><?php echo str_replace("_"," ",$city); ?></td>
							<td><?php echo str_replace("_"," ",$title); ?></td>
							<td><div style="color: <?php echo $color;  ?>; font-weight: bold;"><?php echo $status; ?></div></td>
                        </tr>
						
					<?php  } ?>
                       
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