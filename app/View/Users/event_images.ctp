  <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i style="padding-right: 9px;" class="glyphicon glyphicon-picture"></i>
					<?php echo $events['0.Event.title']; ?> images ( <?php echo $events['0.Event.listname']; ?> )</h2>

                
                </div>
                <div class="box-content">
                    <br>
					
                    <ul class="thumbnails gallery">
                                
								<?php  
								
								$images = $events['0.Event.event_images'];
								
								$event_images = explode(',' , $images);
								$i =1;
								foreach($event_images as $key=>$val)  {   ?>
								
								
								<li id="image-<?php echo $i; ?>" class="thumbnail">
                                <a style="background:url(<?php echo $this->webroot; ?>files/event_images/<?php echo $val; ?>); background-size: cover;"
                                   title="<?php echo $events['0.Event.title']; ?>" href="<?php echo $this->webroot; ?>files/event_images/<?php echo $val; ?>">
								   <img class="grayscale" src="<?php echo $this->webroot; ?>files/event_images/<?php echo $val; ?>"
                                   alt="Sample Image 1"></a>
                                </li>
							
								<?php $i++; }   ?>
                    </ul>
					
                </div>
            </div>
        </div>
		</div>
		
		<style>
		.gallery-controls { display:none !important; }
		</style>