<div class="card">
	<div class="card-header" data-background-color="orange">
		<h4 class="title">Menu Production</h4>
    </div>
    <div class="card-content table-responsive">
		<div id="infoMessage"><b><?php echo $this->session->userdata('message');?></b></div>
		<div class='box-header with-border'>
		<?php
			$edit=0;$add=0;$del=0;
			foreach($access->result_array() as $acc){
				if($acc['submenu'] == 'Production'){
					$edit = $acc['edit'];
					$add = $acc['add'];
					$del = $acc['delete'];
					$app = $acc['approve'];
					$print = $acc['print'];
				}
			};?>
            <h3 class='box-title'><?php 
				if($add == '1'){
					#echo anchor('Activities/production_create/', '<i class="glyphicon glyphicon-plus"></i> Tambah Data', array('class' => 'btn btn-primary btn-sm')); 
				}?></h3>
       </div><!-- /.box-header -->
	   <div class='box-body table-responsive'>
		<table class="table table-bordered table-striped" id="mytable">
                        <thead class="text-primary">
                           <th width="20px">No</th>
                               <th>ID</th>
                                <th>Store</th>
								<th>Resi</th>
								<th>Jumlah</th>
								<th>Jenis</th>
								<th>Kirim dari Outlet</th>
								<th>Terima di Produksi</th> 
								<th>Kirim ke Outlet</th>
								<th>Status</th>								
								<th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                            $start = 0;
                            foreach ($productions->result_array() as $menu) {
                                ?>
                                <tr>
                                    <td><?php echo ++$start ?></td>
									<td><?php echo $menu['hdrcashid'] ;?></td>
									<td><?php echo $this->M_dasb->getoutlet($menu['outletid']) ;?></td>
									<td><?php echo $menu['noresi'] ;?></td>
                                   <td><?php echo $this->M_dasb->getjumlah($menu['noresi']);?></td>
									<td><?php echo $this->M_dasb->getjenis($menu['noresi']);?></td>
									<td><?php echo $menu['tglkirimcash'] ; ?></td>
                                    <td><a href="#" id="tglterimaprod<?=$menu['noresi'];?>" data-type="date" data-pk="1" data-placement="bottom" data-url="tglterimaprod/<?=$menu['noresi'];?>" data-title="Select date"><?=$menu['tglterimaprod'];?></a>
									<script>
									$(function(){
										$('#tglterimaprod<?=$menu['noresi'];?>').editable({
											format: 'yyyy-mm-dd',    
											viewformat: 'dd/mm/yyyy',    
											datepicker: {
													weekStart: 1
											   }
											});
									});
									</script></td>
									<td><a href="#" id="tglkirimprod<?=$menu['noresi'];?>" data-type="date" data-pk="1" data-placement="bottom" data-url="tglkirimprod/<?=$menu['noresi'];?>" data-title="Select date"><?=$menu['tglkirimprod'];?></a>
									<script>
									$(function(){
										$('#tglkirimprod<?=$menu['noresi'];?>').editable({
											format: 'yyyy-mm-dd',    
											viewformat: 'dd/mm/yyyy',    
											datepicker: {
													weekStart: 1
											   }
											});
									});
									</script></td>
									<td><b><?php echo $menu['status'] .'</b><br>'.$menu['createdate'];?></td>
                                    <td style="text-align:center" width="150px">
                                        <?php
											if($edit=='1' && $menu['status'] != 'Finish'){
												echo anchor(site_url('activities/production_update/' . $menu['hdrcashid']), '<i class="fa fa-pencil-square-o"></i>', array('data-toggle' => 'tooltip', 'title' => 'edit', 'class' => 'btn btn-info btn-sm'));
											}
											if($del=='1' && $menu['status'] != 'Finish'){
												echo "&nbsp;&nbsp;".anchor(site_url('activities/production_delete/' . $menu['hdrcashid']), '<i class="fa fa-remove"></i>', array('data-toggle' => 'tooltip', 'title' => 'delete', 'class' => 'btn btn-danger btn-sm'));
											}
											if($print=='1'){
												echo "&nbsp;&nbsp;".anchor(site_url('activities/production_print/' . $menu['noresi']), '<i class="fa fa-print"></i>', array('data-toggle' => 'tooltip', 'title' => 'print', 'class' => 'btn btn-success btn-sm'));
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
<script>
$(document).ready(function() {
	var currentDate = new Date()
	var day = currentDate.getDate()
	var month = currentDate.getMonth() + 1
	var year = currentDate.getFullYear()
	date_future = new Date(new Date().getFullYear() +1, 0, 1);
    date_now = new Date();

    seconds = Math.floor((date_future - (date_now))/1000);
    minutes = Math.floor(seconds/60);
    hours = Math.floor(minutes/60);

	var d = day +''+month+''+year;
	
	  
    var table = $('#mytable').DataTable( {
        dom: 'Bfrtip',
		//responsive: true,
		lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'PR'+d
            },
            'print','pageLength'
        ]
			 
    } );
	new $.fn.dataTable.FixedHeader( table );
} );


</script>