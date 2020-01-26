<div class="card">
	<div class="card-header" data-background-color="orange">
		<h4 class="title">Menu List</h4>
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
										<div class='form-group'>Parent <?php echo form_error('parent') ?>
											<?php 
												$dd_parent = array('0' => 'Parent','1' => 'Sub Parent');
											echo form_dropdown('parent', $dd_parent, $parent, 'class="form-control input-sm"'); ?>
										</div>
										<div class='form-group'>Header <?php echo form_error('header') ?>
											<input type="text" class="form-control" name="header" id="header" placeholder="Header" value="<?php echo $header; ?>" required/>
										</div>
										<div class='form-group'>Submenu <?php echo form_error('submenu') ?>
											<input type="text" class="form-control" name="submenu" id="submenu" placeholder="Submenu" value="<?php echo $submenu; ?>" required/>
										</div>
									</div>
									<div class="col-sm-6">
										<div class='form-group'>Icon <?php echo form_error('class_icon') ?>
											<input type="text" class="form-control" name="class_icon" id="class_icon" placeholder="Class Icon" value="<?php echo $class_icon; ?>" required/>
										</div>
										<div class='form-group'>Status <?php echo form_error('status') ?>
											<?php 
												$dd_status = array('0' => 'Inactive','1' => 'Active');
											echo form_dropdown('status', $dd_status, $status, 'class="form-control input-sm"'); ?>
										</div>
									</div>
									
								</div>
                            </div>
                            <div class='box-footer'>
                                <input type="hidden" name="menuid" value="<?php echo $menuid; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('Masters/daftarmenu') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div>