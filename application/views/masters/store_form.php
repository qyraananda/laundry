<script src="<?php echo base_url();?>assets/locate/geoPosition.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo base_url();?>assets/locate/geoPositionSimulator.js" type="text/javascript" charset="utf-8"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6X6Gp7571r3Xu4feyQPGVrQ6z3VEuF4o&#038;ver=3.0.34#038;callback=initMap"></script>
<script type="text/javascript">
		if(geoPosition.init()){
			geoPosition.getCurrentPosition(success_callback,error_callback,{enableHighAccuracy:true});
		}
		else{
			document.getElementById('result').innerHTML = '<span class="error">Functionality not available</span>';
		}

		function success_callback(p)
		{
			var latitudes = parseFloat( p.coords.latitude ).toFixed(2);
			var longitudes = parseFloat( p.coords.longitude ).toFixed(2);
			
			document.getElementById('latitude').innerHTML = '<input type="text" class="form-control" name="lat" id="latitude" value="'+latitudes+'" readonly>';
			document.getElementById('longitude').innerHTML = '<input type="text" class="form-control" name="lng" id="longitude" value="' + longitudes+'" readonly>';		
			
		}
		
		function error_callback(p)
		{
			document.getElementById('result').innerHTML = '<span class="error">' + p.message + '</span>';			
		}		
	</script>
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
