<div class="card">
	<div class="card-header" data-background-color="orange">
		<h4 class="title">Daftar Harga Menu</h4>
    </div>
    <div class="card-content table-responsive">
		<div id="infoMessage"><b><?php echo $this->session->userdata('message');?></b></div>
		<div class='box-header with-border'>
		<?php
			$edit=0;$add=0;$del=0;
			foreach($access->result_array() as $acc){
				if($acc['submenu'] == 'Daftar Harga'){
					$edit = $acc['edit'];
					$add = $acc['add'];
					$del = $acc['delete'];
					$app = $acc['approve'];
					$print = $acc['print'];
				}
			};?>
            <h3 class='box-title'><?php 
				if($add == '1'){
					echo anchor('Datas/harga_create/', '<i class="glyphicon glyphicon-plus"></i> Tambah Data', array('class' => 'btn btn-primary btn-sm')); 
				}?></h3>
       </div><!-- /.box-header -->
	   <div class='box-body table-responsive'>
		<table class="table table-bordered table-striped" id="mytable">
                        <thead>
                                <th width="80px">No</th>
                                <th>Store</th>
								<th>ID</th>
                                <th>Desc</th>
								<th>Foto</th>
								<th>Satuan</th>
								<th>Type</th>
								<th>Jenis</th>
								<th>Harga</th>
								<th>Min./Kg</th>
								<th>Diskon</th>
								<th>Diskon Date</th>                                
								<th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                            $start = 0;
                            foreach ($harga->result_array() as $menu) {
                                ?>
                                <tr>
                                    <td><?php echo ++$start ?></td>
                                    <td><?php echo $this->M_dasb->getoutlet($menu['outletid']) ;?></td>
									<td><?php echo $menu['tariffid'] ;?></td>
                                    <td><?php echo $menu['tariff']; ?></td>
									<td>
									 <a href="#" data-toggle="modal" data-target="#myModal<?=$menu['tariffid'];?>">
									 <img src="<?php echo base_url()."assets/uploads/files/".$menu['foto'] ; ?>" class="img-circle"  style="width:30px" ></a>

  <!-- Modal -->
	<div class="modal fade" id="myModal<?=$menu['tariffid'];?>" role="dialog">
      <div class="modal-dialog" style="width:150px;height:100px;">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h4 class="modal-title">Harga</h4>
          </div>
          <div class="modal-body">
            <img src="<?php echo base_url()."assets/uploads/files/".$menu['foto'] ; ?>">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
				</td>
									<td><?php echo $menu['satuan'] ;?></td>
									<td><?php echo $menu['tipe'] ;?></td>
									<td><?php echo $menu['jenis'] ;?></td>
									<td><?php echo number_format($menu['harga']) ;?></td>
									<td><?=$menu['perkg'];?></td>
									<td><?php echo $menu['diskon'] ;?></td>
									<td><?php echo $menu['diskondate'] ; ?></td>
                                    <td style="text-align:center" width="150px">
                                        <?php
											if($edit=='1'){
												echo anchor(site_url('Datas/harga_update/' . $menu['tariffid']), '<i class="fa fa-pencil-square-o"></i>', array('data-toggle' => 'tooltip', 'title' => 'edit', 'class' => 'btn btn-info btn-sm'));
											}
											if($del=='1'){
												echo "&nbsp;&nbsp;".anchor(site_url('Datas/harga_delete/' . $menu['tariffid']), '<i class="fa fa-remove"></i>', array('data-toggle' => 'tooltip', 'title' => 'delete', 'class' => 'btn btn-danger btn-sm'));
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
<script type="text/javascript">
    $(document).ready(function () {
		var currentDate = new Date()
		var day = currentDate.getDate()
		var month = currentDate.getMonth() + 1
		var year = currentDate.getFullYear()
		date_future = new Date(new Date().getFullYear() +1, 0, 1);
		date_now = new Date();

		seconds = Math.floor((date_future - (date_now))/1000);
		minutes = Math.floor(seconds/60);
		hours = Math.floor(minutes/60);

		var d = month+''+year+hours+seconds;
        var table = $("#mytable").dataTable({
			dom: 'Bfrtip',
			responsive: true,
			lengthMenu: [
			   [ 10, 25, 50, -1 ],
				[ '10 rows', '25 rows', '50 rows', 'Show all' ]
			],
			buttons: [
				'pageLength'
			]
		});
		
		// new $.fn.dataTable.FixedHeader( table );
    });
</script>