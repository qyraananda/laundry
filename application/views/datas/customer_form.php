<div class="card">
	<div id="result"></div>
	<div class="card-header" data-background-color="orange">
		<h4 class="title">Daftar Customer Menu</h4>
    </div>
	
    <div class='row'>
        <!-- left column -->
        <div class='col-md-12'>
            <!-- general form elements -->
            <div class='container-fluid'>
                <div class='box-header'>
                    <div class='col-md-15'>
                       <?php echo form_open_multipart($action);?>
							<div class='box-body'>
								<div class="row">
									<div class="col-dm-6">
										<div class='form-group'>Outlet <?php echo form_error('outletid') ?>
											<?php echo form_dropdown('outletid', $dd_outlet, $outletid, 'class="form-control" data-show-subtext="true" data-live-search="true" required/'); ?>
										</div>
										<div class='form-group'>Customer <?php echo form_error('customer') ?>
											<input type="text" class="form-control" name="customer" placeholder="Customer" value="<?=$customer;?>" required/>
										</div>
										<div class='form-group'>Alamat <?php echo form_error('alamat') ?>
											<input type="text" class="form-control" name="alamat" placeholder="Alamat" value="<?=$alamat;?>" required/>
										</div>
									
										<div class='form-group'>Handphone <?php echo form_error('handphone') ?>
											<input type="text" class="form-control" name="handphone" placeholder="Handphone" value="<?=$handphone;?>" required/>
										</div>
									</div>
								</div>
                            </div>
                            <div class='box-footer'>
                                <input type="hidden" name="customerid" value="<?php echo $customerid; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('Datas/customer') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div>
