   <!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo $this->webroot;?>"> <img alt="Hublyz" src="<?php echo $this->webroot;?>img/logosmall.png" />
             </a>

            
			<!-- user dropdown starts -->
            <div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> admin</span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo $this->webroot;  ?>logout">Logout</a></li>
                </ul>
            </div>
            <!-- user dropdown ends -->
			
			      <ul class="collapse navbar-collapse nav navbar-nav top-menu">
                <li style="color: white;font-size: 17px;margin-top: 14px;    margin-left: 50px; font-weight: bold;">Admin Dashboard</li>
               
             
            </ul>

        </div>
    </div>
    <!-- topbar ends -->