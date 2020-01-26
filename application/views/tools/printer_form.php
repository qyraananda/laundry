<div class="card">
	<div class="card-header" data-background-color="orange">
		<h4 class="title">Setting Printer</h4>
    </div>
    <section>
		<div class='container-fluid'>
                <div class='box-header'>
                    <div class='col-md-15'>
                        <form action="<?php echo $action; ?>" method="post">
							<div class='box-body'>
								<div class='form-group'>Outlet <?php echo form_error('outletid') ?>
											<?php 
											echo form_dropdown('outletid', $dd_outlet, $outletid, 'class="form-control input-sm"'); ?>
										</div>
										<div class='form-group'>Printer <?php echo form_error('printer') ?>
											<input type="text" class="form-control" name="printer" placeholder="printer" value="<?php echo $printer; ?>" required/>
										</div>
										<div class='form-group'>Port <?php echo form_error('port') ?>
											<input type="text" class="form-control" name="port" placeholder="port" value="<?php echo $port; ?>" required/>
										</div>
                            </div>
                            <div class='box-footer'>
                                <input type="hidden" name="printerid" value="<?php echo $printerid; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('Tools/printer') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
	</section>
</div>
