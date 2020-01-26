<div class="card">
	<div id="result"></div>
	<div class="card-header" data-background-color="orange">
		<h4 class="title">Userlogin Menu</h4>
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
										
										<div class='form-group'>Level <?php echo form_error('levelid') ?>
											<?php echo form_dropdown('levelid', $dd_level, $levelid, 'class="form-control" data-show-subtext="true" data-live-search="true" required/'); ?>
										</div>
										<div class="form-group">
											<label><strong>Outlet </strong></label>
											<?php echo form_dropdown('outletid', $dd_outlet, $outletid, 'multiple="multiple" id="outlets" required/'); ?>
										</div>
									
										<div class='form-group'>User <?php echo form_error('userid') ?>
											<?php echo form_dropdown('userid', $dd_username, $userid, 'class="form-control" data-show-subtext="true" data-live-search="true" required/'); ?>
										</div>
									</div>
									<div class="col-sm-6">
										<div class='form-group'>Username <?php echo form_error('username') ?>
											<input type="email" class="form-control" name="username" value="<?=$username;?>" maxlength="25" required/>
										</div>
										<div class='form-group'>Password <?php echo form_error('password') ?>
											<input type="text" class="form-control" name="password" value="<?=$password;?>" maxlength="20" required/>
										</div>
										<div class='form-group'>Foto <?php echo form_error('foto') ?>
											<input type='file' name="foto" onchange="loadFoto(event);" />
											<img id="output" src="<?=base_url()."assets/dist/img/".$foto;?>" style="width:50px"/>
											<script>
											  var loadFoto = function(event) {
												var output = document.getElementById('output');
												output.src = URL.createObjectURL(event.target.files[0]);
											  };
											</script>
										</div>
										<div class='form-group'>Status <?php echo form_error('status') ?>
											<?php echo form_dropdown('status', $dd_status, $status, 'class="form-control" data-show-subtext="true" data-live-search="true" required/'); ?>
										</div>
									</div>
								</div>
                            </div>
                            <div class='box-footer'>
                                <input type="hidden" name="loginid" value="<?php echo $loginid; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('Masters/userlogin') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div>
<script>
$(document).ready(function() {
     $('#outlets').multiselect({
         includeSelectAllOption: true,
         enableFiltering: true
      });
    });
</script>