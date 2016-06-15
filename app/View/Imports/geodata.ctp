
<?php echo $this->element('header'); ?>

 <?php echo $this->element('sidemenu'); ?>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-plus-sign"></i> Upload Geolocation Data</h2>

            </div>
            <div class="box-content">

                <?php echo $this->Form->create('Users', array('type' => 'file','data-parsley-validate')); ?>
          
                    <div class="form-group" style="margin-top: 24px;">
                        <label for="exampleInputFile">Select File</label>
                        <input type="file" name="geodata" id="geodata">

                        <p class="help-block"> Please upload csv format file.</p>
                    </div>
                  
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->

