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
										<div class='form-group'>Level <?php echo form_error('levelid') ?>
											<?php echo form_dropdown('levelid', $dd_level, $levelid, 'class="form-control selectpicker" data-show-subtext="true" data-live-search="true"'); ?>
										</div>
										<div class='form-group'>Menu <?php echo form_error('menuid') ?>
											<?php echo form_dropdown('menuid', $dd_menu, $menuid, 'class="form-control selectpicker" data-show-subtext="true" data-live-search="true"'); ?>
										</div>
										<div class='form-group'>URL menu <?php echo form_error('urlmenu') ?>
											 <input type="text" class="form-control" name="urlmenu" id="urlmenu" placeholder="URL Menu" value="<?php echo $urlmenu; ?>" required/> 
											<datalist>
											<?php
												foreach($dd_menulogin as $val){
													echo "<option value='".$val."'>'.$val.'</option>";
												}
												?>
											</datalist>
										</div>
										</div>
									<div class="col-sm-6">
										<div class='form-group'>Add <?php echo form_error('add') ?>
											<?php 
												$dd_add = array('0' => 'Inactive','1' => 'Active');
											echo form_dropdown('add', $dd_add, $add, 'class="form-control selectpicker" data-show-subtext="true" data-live-search="true"'); ?>
										</div>
										<div class='form-group'>Edit <?php echo form_error('edit') ?>
											<?php 
												$dd_edit = array('0' => 'Inactive','1' => 'Active');
											echo form_dropdown('edit', $dd_edit, $edit, 'class="form-control selectpicker" data-show-subtext="true" data-live-search="true"'); ?>
										</div>
										<div class='form-group'>Delete <?php echo form_error('delete') ?>
											<?php 
												$dd_delete = array('0' => 'Inactive','1' => 'Active');
											echo form_dropdown('delete', $dd_delete, $delete, 'class="form-control selectpicker" data-show-subtext="true" data-live-search="true"'); ?>
										</div>
										<div class='form-group'>Approve <?php echo form_error('approve') ?>
											<?php 
												$dd_approve = array('0' => 'Inactive','1' => 'Active');
											echo form_dropdown('approve', $dd_approve, $approve, 'class="form-control selectpicker" data-show-subtext="true" data-live-search="true"'); ?>
										</div>
										<div class='form-group'>Print <?php echo form_error('print') ?>
											<?php 
												$dd_print = array('0' => 'Inactive','1' => 'Active');
											echo form_dropdown('print', $dd_print, $print, 'class="form-control selectpicker" data-show-subtext="true" data-live-search="true"'); ?>
										</div>
									</div>
									
								</div>
                            </div>
                            <div class='box-footer'>
                                <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('Masters/menulogin') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div>