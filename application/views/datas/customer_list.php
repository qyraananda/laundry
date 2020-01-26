<div class="card">
	<div class="card-header" data-background-color="orange">
		<h4 class="title">Daftar Customer Menu</h4>
    </div>
    <div class="card-content table-responsive">
		<div id="infoMessage"><b><?php echo $this->session->userdata('message');?></b></div>
		<div class='box-header with-border'>
		<?php
			$edit=0;$add=0;$del=0;
			foreach($access->result_array() as $acc){
				if($acc['submenu'] == 'Data Customer'){
					$edit = $acc['edit'];
					$add = $acc['add'];
					$del = $acc['delete'];
					$app = $acc['approve'];
					$print = $acc['print'];
				}
			};?>
            <h3 class='box-title'><?php 
				if($add == '1'){
					echo anchor('Datas/customer_create/', '<i class="glyphicon glyphicon-plus"></i> Tambah Data', array('class' => 'btn btn-primary btn-sm')); 
				}?></h3>
       </div><!-- /.box-header -->
	   <div class='box-body table-responsive'>
		<table class="table table-bordered table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th width="80px">No</th>
                                <th>ID</th>
                                <th>Store</th>
								<th>Customer</th>
								<th>Alamat</th>
								<th>Handphone</th>                                
								<th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $start = 0;
                            foreach ($customer->result_array() as $menu) {
                                ?>
                                <tr>
                                    <td><?php echo ++$start ?></td>
                                    <td><?php echo $menu['customerid'] ;?></td>
									<td><?php echo $this->M_dasb->getoutlet($menu['outletid']) ;?></td>
                                    <td><?php echo $menu['customer']; ?></td>
									<td><?php echo $menu['alamat'] ;?></td>
									<td><?php echo $menu['handphone'] ; ?></td>
                                    <td style="text-align:center" width="150px">
                                        <?php
											if($edit=='1'){
												echo anchor(site_url('Datas/customer_update/' . $menu['customerid']), '<i class="fa fa-pencil-square-o"></i>', array('data-toggle' => 'tooltip', 'title' => 'edit', 'class' => 'btn btn-info btn-sm'));
											}
											if($del=='1'){
												echo "&nbsp;&nbsp;".anchor(site_url('Datas/customer_delete/' . $menu['customerid']), '<i class="fa fa-remove"></i>', array('data-toggle' => 'tooltip', 'title' => 'delete', 'class' => 'btn btn-danger btn-sm'));
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