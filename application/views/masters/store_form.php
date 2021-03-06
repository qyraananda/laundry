<div class="card">
	<div id="result"></div>
	<div class="card-header" data-background-color="purple">
		<h4 class="title">Store Menu</h4>
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
										<div class='form-group'>Store <?php echo form_error('outlet') ?>
											<input type="text" class="form-control" name="outlet" placeholder="Store Name" value="<?php echo $outlet; ?>" required/> 
										</div>
										<div class='form-group'>Address <?php echo form_error('alamat') ?>
											<input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" onFocus="getLocation()" required/> 
										</div>
										<div class='form-group'>City <?php echo form_error('kota') ?>
											<input type="text" class="form-control" name="kota" id="kota" placeholder="Kota" value="<?php echo $kota; ?>" required/> 
										</div>
										<div class='form-group'>Telephone <?php echo form_error('telephone') ?>
											<input type="text" class="form-control" name="telephone" placeholder="Telephone" value="<?php echo $telephone; ?>" required/> 
										</div>
									</div>
									<div class="col-sm-6">
										
										<div class='form-group'>PIC Name <?php echo form_error('picname') ?>
											<input type="text" class="form-control" name="picname" placeholder="PIC Name" value="<?php echo $picname; ?>" required/> 
										</div>
										<div class='form-group'>End of Contract <?php echo form_error('kontrakdate') ?>
											<input type="text" class="form-control" name="kontrakdate" id="datepicker" value="<?= (empty($kontrakdate)?date('d/m/Y'):date('d/m/Y', strtotime($kontrakdate)));?>" placeholder="End of Contract" required/> 
										</div>
										<div class='form-group'>Latitude <?php echo form_error('lat') ?>
											<div id="latitude"></div> 
										</div>
										<div class='form-group'>Longitude <?php echo form_error('lng') ?>
											<div id="longitude"></div> 
										</div>
									</div>
								</div>
                            </div>
                            <div class='box-footer'>
                                <input type="hidden" name="outletid" value="<?php echo $outletid; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('Masters/store') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div>
