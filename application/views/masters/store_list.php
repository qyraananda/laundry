<div class="card">
	<div class="card-header" data-background-color="orange">
		<h4 class="title">Store Menu</h4>
    </div>
    <div class="card-content table-responsive">
		<div id="infoMessage"><b><?php echo $this->session->userdata('message');?></b></div>
		<div class='box-header with-border'>
		<?php
			$edit=0;$add=0;$del=0;
			foreach($access->result_array() as $acc){
				if($acc['submenu'] == 'Store Menu'){
					$edit = $acc['edit'];
					$add = $acc['add'];
					$del = $acc['delete'];
					$app = $acc['approve'];
					$print = $acc['print'];
				}
			};?>
            <h3 class='box-title'><?php 
				if($add == '1'){
					echo anchor('Masters/store_create/', '<i class="glyphicon glyphicon-plus"></i> Tambah Data', array('class' => 'btn btn-primary btn-sm')); 
				}?></h3>
       </div><!-- /.box-header -->
	   <div class='box-body table-responsive'>
		<table class="table table-bordered table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th width="80px">No</th>
                                <th>Store ID</th>
                                <th>Store</th>
								<th>Alamat</th>
								<th>Kota</th>
								<th>Phone</th>
								<th>PIC</th>
								<th>End of Contract</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $start = 0;
                            foreach ($store->result_array() as $menu) {
                                ?>
                                <tr>
                                    <td><?php echo ++$start ?></td>
                                    <td><?php echo $menu['outletid'] ;?></td>
                                    <td><?php echo $menu['outlet']; ?></td>
									<td><?php echo $menu['alamat'] ;?></td>
									<td><?php echo $menu['kota'] ;?></td>
									<td><?php echo $menu['telephone'] ;?></td>
									<td><?php echo $menu['picname'] ;?></td>
									<td><?php echo $menu['kontrakdate'] ; ?></td>
                                    <td style="text-align:center" width="150px">
                                        <?php
											if($edit=='1'){
												echo anchor(site_url('Masters/store_update/' . $menu['outletid']), '<i class="fa fa-pencil-square-o"></i>', array('data-toggle' => 'tooltip', 'title' => 'edit', 'class' => 'btn btn-info btn-sm'));
											}
											if($del=='1'){
												echo "&nbsp;&nbsp;".anchor(site_url('Masters/store_delete/' . $menu['outletid']), '<i class="fa fa-remove"></i>', array('data-toggle' => 'tooltip', 'title' => 'delete', 'class' => 'btn btn-danger btn-sm'));
											}
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>	
       </div><!-- /.box-body -->			
    </div>
</div>