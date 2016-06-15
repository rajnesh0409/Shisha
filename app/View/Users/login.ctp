<div class="ch-container">
    <div class="row">
        
    <div class="row">
        <div class="col-md-12 center login-header">
		   <img src="<?php echo $this->webroot;?>img/logo.png" style="width: 139px;" />
         
        </div>
        <!--/span-->
    </div><!--/row-->

    <div class="row" style="margin-top:25px;margin-left: 0px;
    margin-right: 0px;">
       
         <div class="col-md-12 center"> </div>
		  
        
	   <div class="well col-md-4 center login-box">
            <div class="alert alert-info">
                Login to Admin Dashboard
            </div>
             <?php echo $this->Form->create('Users'); ?>
                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" name="username" class="form-control" placeholder="Username">
                    </div>
                    <div class="clearfix"></div><br>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" name= "password" class="form-control" placeholder="Password">
                    </div>
                    <div class="clearfix"></div>

                 
                    <div class="clearfix"></div>

                    <p class="center col-md-5">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </p>
                </fieldset>
            </form>
        </div>
        <!--/span-->
    </div><!--/row-->
</div><!--/fluid-row-->

</div><!--/.fluid-container-->