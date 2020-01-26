<div class="card">
	<div id="result"></div>
	<div class="card-header" data-background-color="purple">
		<h4 class="title">Production Menu</h4>
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
										<div class='form-group'>Resi <?php echo form_error('noresi') ?>
											<input type="text" class="form-control" name="noresi" placeholder="noresi" value="<?php echo $noresi; ?>" required/> 
										</div>
										<div class='form-group'>Status <?php echo form_error('status') ?>
											<?php echo form_dropdown('status', $dd_status, $status, 'class="form-control" data-show-subtext="true" data-live-search="true"'); ?>
										</div>
									</div>
									<div class="col-sm-6">
										<div class='form-group'>Customer <?php echo form_error('customerid') ?>
											<input type="text" class="form-control" name="customerid" placeholder="customerid" value="<?php echo $customerid; ?>" required/> 
										</div>
										<div class='form-group'>Alamat <?php echo form_error('alamat') ?>
											<input type="text" class="form-control" name="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" required/> 
										</div>
									</div>
								</div>
								<div class="row">
									<table class="table table-bordered table-striped" id="mytable">
									<thead class="text-primary">
									   <th width="20px">No</th>
										   <th>ID</th>
											<th>Item</th>
											<th>Jumlah</th>
											<th>Keterangan</th>
											<th>Terima</th>
											<th>Produksi</th> 
									</thead>
									<tbody>
										<?php
										$start = 0; $i =0;
										foreach ($productions->result_array() as $menu) {
											
											?>
											<tr>
												<td><?php echo ++$start ?></td>
												<td><?php echo $menu['dtlcashid'] ;?><input type="hidden" name="dtlcashid<?=$i;?>" value="<?=$menu['dtlcashid'];?>"></td>
												<td><?php echo $this->M_dasb->gettarifname($menu['tariffid']) ;?></td>
												<td><?php echo $menu['jumlah'];?></td>
												<td><?php echo $menu['keterangan'];?></td>
												<td><?=$menu['tglterima'];?><input type="hidden" name="tanggal" value="<?=$menu['tglterima'];?>"></td>
												<td>
												<input type="date" class="form-control" name="tglproduksi<?=$i;?>" value="<?=$menu['tglproduksi'];?>" required>
									 			</td>										
											</tr>
											<?php
											$i++;
										}
										?>
									</tbody>
								</table>	
								</div>
                            </div>
                            <div class='box-footer'>
                                <input type="hidden" name="hdrcashid" value="<?php echo $hdrcashid; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('Activities/production') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url()?>assets/bootstrap/js/bootstrap-editable.min.js"></script>
<link href="<?php echo base_url()?>assets/bootstrap/css/bootstrap-editable.css" rel="stylesheet">