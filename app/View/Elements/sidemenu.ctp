
<div class="ch-container">
    <div class="row">
	

<!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">Main</li>
                        <li><a class="ajax-link" href="<?php echo $this->webroot;  ?>dashboard"><i class="glyphicon glyphicon-home"></i><span> Dashboard</span></a></li>
						<li><a class="ajax-link" href="#"><i class="glyphicon glyphicon-home"></i><span> Customers</span></a></li>
						
						 <li class="accordion">
                            <a href="#"> <img id="loadimg" src="<?php echo $this->webroot; ?>img/hookah.png" style="width: 17px;" title="loader"><span> Listings</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                
								<li>
								<a href="<?php echo $this->webroot;  ?>listing">
								 <img id="loadimg" src="<?php echo $this->webroot; ?>img/hookah.png" style="width: 17px;" title="loader">
								Add listing</a></li>
								 <li>
								<a href="<?php echo $this->webroot;  ?>listing-detail">
								 <img id="loadimg" src="<?php echo $this->webroot; ?>img/hookah.png" style="width: 17px;" title="loader">
								Listings Detail</a></li>
								
								<li><a href="<?php echo $this->webroot;  ?>listing-bulk-upload"> <img id="loadimg" src="<?php echo $this->webroot; ?>img/hookah.png" style="width: 17px;" title="loader"> Bulk upload</a></li>

								<li>
								<a href="<?php echo $this->webroot;  ?>logs-files">
								 <img id="loadimg" src="<?php echo $this->webroot; ?>img/hookah.png" style="width: 17px;" title="loader">
								Logs files</a></li>
								
								
                            </ul>
                        </li>
						<li><a class="ajax-link" href="<?php echo $this->webroot;  ?>event-detail">
						<img id="loadimg" src="<?php echo $this->webroot; ?>img/calendar.png" style="width: 17px;" title="loader"><span>  Events</span></a></li>
						
						<li><a class="ajax-link" href="#"><i class="glyphicon glyphicon-home"></i><span> Leader Board</span></a></li>
						<li><a class="ajax-link" href="#"><i class="glyphicon glyphicon-home"></i><span> Reviews</span></a></li>
						
                        
                       
                    </ul>
                   
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->
		
		        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
        </noscript>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo $this->webroot;  ?>dashboard">Home</a>
        </li>
        <li>
            <a href="<?php echo $this->webroot;  ?><?php echo $title; ?>"><?php echo $title; ?></a>
        </li>
    </ul>
</div>