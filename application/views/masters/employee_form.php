<div class="card">
	<div id="result"></div>
	<div class="card-header" data-background-color="orange">
		<h4 class="title">Employee Menu</h4>
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
									<div class="col-sm-4">
										<div class='form-group'>Level <?php echo form_error('levelid') ?>
											<?php echo form_dropdown('levelid', $dd_level, $levelid, 'class="form-control selectpicker" data-show-subtext="true" data-live-search="true"'); ?>
										</div>
										<div class='form-group'>Leader <?php echo form_error('leader') ?>
											<?php echo form_dropdown('leader', $dd_leader, $leader, 'class="form-control selectpicker" data-show-subtext="true" data-live-search="true"'); ?>
										</div>
										<div class='form-group'>Name <?php echo form_error('name') ?>
											<input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" required/>
										</div>
									
										<div class='form-group'>Address <?php echo form_error('address') ?>
											<input type="text" class="form-control" name="address" id="address" placeholder="address" value="<?php echo $address; ?>" required/>
										</div>
										<div class='form-group'>Telephone <?php echo form_error('phone') ?>
											<div class="input-group">
											  <div class="input-group-addon">
												<i class="fa fa-phone"></i>
											  </div>
											  <input type="text" class="form-control" name="phone" id="phone" value="<?=$phone;?>" data-inputmask='"mask": "(999) 999-9999"' data-mask>
											</div>
										</div>
										<div class='form-group'>Handphone <?php echo form_error('hp') ?>
											<div class="input-group">
											  <div class="input-group-addon">
												<i class="fa fa-phone"></i>
											  </div>
											  <?php echo form_error('hp') ?>
											  <input type="text" class="form-control" name="hp" id="hp" value="<?=$hp;?>" data-inputmask='"mask": "(999) 99999999"' data-mask required/>
											</div>
										</div>
										<div class='form-group'>KTP <?php echo form_error('ktp') ?>
											<input type="text" class="form-control" name="ktp" id="ktp" placeholder="ktp" value="<?php echo $ktp; ?>" required/>
										</div>
									</div>
								
									<div class="col-sm-4">
										<div class="form-group">
											Foto <?php echo form_error('foto') ?>
											<input type='file' name="foto" onchange="loadFoto(event);" <?php if(empty($foto)?"required":"");?>/>
											<img id="output" src="<?=base_url()."assets/uploads/files/".$foto;?>" style="width:50px"/>
											<script>
											  var loadFoto = function(event) {
												var output = document.getElementById('output');
												output.src = URL.createObjectURL(event.target.files[0]);
											  };
											</script>
										</div>
										<div class="form-group">
											KTP <?php echo form_error('ktpjpeg') ?>
											<input type='file' name="ktpjpeg" onchange="loadktpjpeg(event);" <?php if(empty($ktpjpeg)?"required":"");?>/>
											<img id="outputktp" src="<?=base_url()."assets/uploads/files/".$ktpjpeg;?>" style="width:50px"/>
											<script>
											  var loadktpjpeg = function(event) {
												var output = document.getElementById('outputktp');
												output.src = URL.createObjectURL(event.target.files[0]);
											  };
											</script>
										</div>
										<div class="form-group">
											NPWP <?php echo form_error('npwpjpeg') ?>
											<input type='file' name="npwpjpeg" onchange="loadnpwpjpeg(event);" <?php if(empty($npwpjpeg)?"required":"");?>/>
											<img id="outputnpwp" src="<?=base_url()."assets/uploads/files/".$npwpjpeg;?>" style="width:50px"/>
											<script>
											  var loadnpwpjpeg = function(event) {
												var output = document.getElementById('outputnpwp');
												output.src = URL.createObjectURL(event.target.files[0]);
											  };
											</script>
										</div>
										<div class="form-group">
											KK Scan<?php echo form_error('kkjpeg') ?>
											<input type='file' name="kkjpeg" onchange="loadkkjpeg(event);" <?php if(empty($kkjpeg)?"required":"");?>/>
											<img id="outputkk" src="<?=base_url()."assets/uploads/files/".$kkjpeg;?>" style="width:50px"/>
											<script>
											  var loadkkjpeg = function(event) {
												var output = document.getElementById('outputkk');
												output.src = URL.createObjectURL(event.target.files[0]);
											  };
											</script>
										</div>
										 <div class='form-group'>Code <?php echo form_error('rmcode') ?>
											<input type="text" class="form-control" name="rmcode" id="rmcode" placeholder="Code" value="<?php echo $rmcode; ?>" required/>
										</div>
										<div class='form-group'>Email <?php echo form_error('email') ?>
											<input type="email" class="form-control" name="email" id="email" placeholder="email" value="<?php echo $email; ?>" required/>
										</div>
									</div>	
									<div class="col-sm-4">
										
										<div class='form-group'>Gender <?php echo form_error('jkelamin') ?>
											<?php 
											$dd_gen = array(""=>"","L" => "Pria", "P" => "Wanita");
											echo form_dropdown('jkelamin', $dd_gen, $jkelamin, 'class="form-control selectpicker" data-show-subtext="true" data-live-search="true" required'); ?>
										</div>
										<div class="form-group">
											Birthdate: <?php echo form_error('birthdate') ?>
											<div class="input-group date">
										  <div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										  </div>
										  <input type="text" name="birthdate" value="<?=(empty($birthdate)?date("d/m/Y"):date('d/m/Y', strtotime($birthdate)));?>" class="form-control pull-right" id="datepicker">
										</div>
										</div>
										<div class="form-group">
                Emergency Call:<?php echo form_error('emergency') ?>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
				  
                  <input type="text" class="form-control" name="emergency" id="emergency" value="<?=$emergency;?>" data-inputmask='"mask": "(999) 99999999"' data-mask required>
                </div>
                <!-- /.input group -->
              </div>
										<div class="form-group">
											Activedate: <?php echo form_error('activedate') ?>
											<div class="input-group date">
										  <div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										  </div>
										  <input type="text" name="activedate" value="<?=(empty($activedate)?date("d/m/Y"):date('d/m/Y', strtotime($activedate)));?>" class="form-control pull-right" id="datepicker1" required>
										</div>
										</div>
										<div class="form-group">
											Resigndate: <?php echo form_error('resigndate') ?>
											<div class="input-group date">
										  <div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										  </div>
										  <input type="text" name="resigndate" value="<?=(empty($resigndate)?"":date('d/m/Y', strtotime($resigndate)));?>" class="form-control pull-right" id="datepicker2">
										</div>
										</div>
										<div class='form-group'>Status <?php echo form_error('status') ?>
											<?php 
											$dd_stat = array(""=>"","0" => "Not Active", "1" => "Active");
											echo form_dropdown('status', $dd_stat, $status, 'class="form-control selectpicker" data-show-subtext="true" data-live-search="true"'); ?>
										</div>
									</div>
								</div>
                            </div>
                            <div class='box-footer'>
                                <input type="hidden" name="userid" value="<?php echo $userid; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('Masters/employee') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div>
