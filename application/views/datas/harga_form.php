<div class="card">
	<div id="result"></div>
	<div class="card-header" data-background-color="orange">
		<h4 class="title">Daftar Harga Menu</h4>
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
									<div class="col-sm-6">
										<div class='form-group'>Store <?php echo form_error('store') ?>
											<?php echo form_dropdown('outletid', $dd_outlet, $outletid, 'class="form-control" data-show-subtext="true" data-live-search="true"'); ?>
										</div>
										<div class='form-group'>Title <?php echo form_error('tariff') ?>
											<input type="text" class="form-control" name="tariff" value="<?=$tariff;?>" maxlength="50" required/>
										</div>
										<div class='form-group'>Satuan <?php echo form_error('satuan') ?>
											<?php echo form_dropdown('satuan', $dd_satuan, $satuan, 'class="form-control" data-show-subtext="true" data-live-search="true" id="satuan" required/'); ?>
										</div>
										<div class='form-group'>Type <?php echo form_error('tipe') ?>
											<?php echo form_dropdown('tipe', $dd_tipe, $tipe, 'class="form-control" data-show-subtext="true" data-live-search="true" id="tipe1" /'); ?>
										</div>
										<div class='form-group'>Jenis <?php echo form_error('jenis') ?>
											<?php echo form_dropdown('jenis', $dd_jenis, $jenis, 'class="form-control" data-show-subtext="true" data-live-search="true" id="tipe2" /'); ?>
										</div>
										
									</div>
									<div class="col-sm-6">
										<div class='form-group'>Foto <?php echo form_error('foto') ?>
											<input type='file' name="foto" onchange="loadFoto(event);" />
											<img id="output" src="<?=base_url()."assets/uploads/files/".$foto;?>" style="width:50px"/>
											<script>
											  var loadFoto = function(event) {
												var output = document.getElementById('output');
												output.src = URL.createObjectURL(event.target.files[0]);
											  };
											</script>
										</div>
										<div class='form-group'>Harga <?php echo form_error('harga') ?>
											<input type="text" class="form-control" name="harga" placeholder="Harga" value="<?=$harga;?>" required/>
										</div>
										<div class='form-group'>Per Kg <?php echo form_error('perkg') ?>
											<input type="text" class="form-control" name="perkg" placeholder="Minimal per Kg" value="<?=$perkg;?>"/>
										</div>
										<div class='form-group'>Diskon <?php echo form_error('diskon') ?>
											<input type="text" class="form-control" name="diskon" placeholder="Diskon" value="<?=$diskon;?>"/>
										</div>
										<div class='form-group'>Masa berlaku diskon <?php echo form_error('diskondate') ?>
											<input type="text" class="form-control" name="diskondate" id="datepicker" value="<?=(empty($diskondate)?"":date("d/m/Y",strtotime($diskondate)));?>"/>
										</div>
									</div>
								</div>
                            </div>
                            <div class='box-footer'>
								<ul style="visibility: hidden;">
									<li id="tipe3"></li>
									<li id="satuan1"></li>
								</ul>
                                <input type="hidden" name="tariffid" value="<?php echo $tariffid; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('Datas/harga') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div>
<script>
$('#satuan').change(function(e){
var tipe = document.getElementById("tipe");
if($(this).val() == "Satuan"){
	document.getElementById("tipe1").value="-";
	document.getElementById("tipe2").value="-";
	$('#tipe1, #tipe2').prop('disabled', true);
	document.getElementById('tipe3').innerHTML = '<input type="text" name="tipe" value="-">';
	document.getElementById('satuan1').innerHTML = '<input type="text" name="jenis" value="-">';
}
else
	$('#tipe1, #tipe2').prop('disabled', false);
});
</script>