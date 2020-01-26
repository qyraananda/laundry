<div class="card">
	<div id="result"></div>
	<div class="card-header" data-background-color="purple">
		<h4 class="title">User Level Menu</h4>
    </div>
	
    <div class='row'>
        <!-- left column -->
        <div class='col-md-12'>
            <!-- general form elements -->
            <div class='container-fluid'>
                <div class='box-header'>
                    <div class='col-md-15'>
                        <form action="<?php echo $action; ?>" method="post">
							<div class='box-body'>
								<div class="row">
									<div class="col-sm-6"> 
										<div class='form-group'>Level <?php echo form_error('level') ?>
											<input type="text" class="form-control" name="level" placeholder="Level" value="<?php echo $level; ?>" required/> 
										</div>
									</div>
								</div>
                            </div>
                            <div class='box-footer'>
                                <input type="hidden" name="levelid" value="<?php echo $levelid; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('Masters/userlevel') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div>
