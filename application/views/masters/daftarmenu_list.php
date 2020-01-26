<div class="card">
	<div class="card-header" data-background-color="orange">
		<h4 class="title">Menu List</h4>
    </div>
    <div class="card-content table-responsive">
		<div id="infoMessage"><b><?php echo $this->session->userdata('message');?></b></div>
		<div class='box-header with-border'>
		<?php
			$edit=0;$add=0;$del=0;
			foreach($access->result_array() as $acc){
				if($acc['submenu'] == 'List Menu'){
					$edit = $acc['edit'];
					$add = $acc['add'];
					$del = $acc['delete'];
					$app = $acc['approve'];
					$print = $acc['print'];
				}
			};?>
            <h3 class='box-title'><?php 
				if($add == '1'){
					echo anchor('Masters/daftarmenu_create/', '<i class="glyphicon glyphicon-plus"></i> Tambah Data', array('class' => 'btn btn-primary btn-sm')); 
				}?></h3>
       </div><!-- /.box-header -->
	   <div class='box-body table-responsive'>
		<table class="table table-bordered table-striped" id="mytable">
                        <thead class="text-primary">
                           <th width="80px">No</th>
                                <th>Menu ID</th>
                                <th>Parent</th>
								<th>Header</th>
								<th>Sub Menu</th>
								<th>Icon</th>
								<th>Status</th>
                                <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                            $start = 0;
                            foreach ($daftarmenu->result_array() as $menu) {
                                ?>
                                <tr>
                                    <td><?php echo ++$start ?></td>
                                    <td><?php echo $menu['menuid'] ?></td>
                                    <td><?php echo ($menu['parent']=='0'?'Parent':'Sub Parent'); ?></td>
									<td><?php echo $menu['header'] ?></td>
									<td><?php echo $menu['submenu'] ?></td>
									<td><?php echo $menu['class_icon'] ?></td>
									<td><?php echo ($menu['status']==1?'Active':'Inactive') ?></td>
                                    <td style="text-align:center" width="150px">
                                        <?php
											if($edit=='1'){
												echo anchor(site_url('Masters/daftarmenu_update/' . $menu['menuid']), '<i class="fa fa-pencil-square-o"></i>', array('data-toggle' => 'tooltip', 'title' => 'edit', 'class' => 'btn btn-info btn-sm'));
											}
											if($del=='1'){
												echo "&nbsp;&nbsp;".anchor(site_url('Masters/daftarmenu_delete/' . $menu['menuid']), '<i class="fa fa-remove"></i>', array('data-toggle' => 'tooltip', 'title' => 'delete', 'class' => 'btn btn-danger btn-sm'));
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
		responsive: true,
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
