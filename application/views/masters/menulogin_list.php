<div class="card">
	<div class="card-header" data-background-color="orange">
		<h4 class="title">Access Menu</h4>
    </div>
    <div class="card-content table-responsive">
		<div id="infoMessage"><b><?php echo $this->session->userdata('message');?></b></div>
		<div class='box-header with-border'>
		<?php
			$edit=0;$add=0;$del=0;
			foreach($access->result_array() as $acc){
				if($acc['submenu'] == 'Access Menu'){
					$edit = $acc['edit'];
					$add = $acc['add'];
					$del = $acc['delete'];
					$app = $acc['approve'];
					$print = $acc['print'];
				}
			};?>
            <h3 class='box-title'><?php 
				if($add == '1'){
					echo anchor('Masters/menulogin_create/', '<i class="glyphicon glyphicon-plus"></i> Tambah Data', array('class' => 'btn btn-primary btn-sm')); 
				}?></h3>
       </div><!-- /.box-header -->
	   <div class='box-body table-responsive'>
		<table class="table table-bordered table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th width="80px">No</th>
                                <th>Menu ID</th>
                                <th>Level</th>
								<th>Menu</th>
								<th>URL Menu</th>
								<th>Add</th>
								<th>Edit</th>
								<th>Delete</th>
								<th>Approve</th>
								<th>Print</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $start = 0;
                            foreach ($menulogin->result_array() as $menu) {
                                ?>
                                <tr>
                                    <td><?php echo ++$start ?></td>
                                    <td><?php echo $menu['id'] ?></td>
                                    <td><?php echo $menu['level']; ?></td>
									<td><?php echo $menu['submenu'] ?></td>
									<td><?php echo $menu['urlmenu'] ?></td>
									<td><?php echo ($menu['add']=='0'?'Inactive':'Active') ;?></td>
									<td><?php echo ($menu['edit']=='0'?'Inactive':'Active') ; ?></td>
									<td><?php echo ($menu['delete']=='0'?'Inactive':'Active') ; ?></td>
									<td><?php echo ($menu['approve']=='0'?'Inactive':'Active') ; ?></td>
									<td><?php echo ($menu['print']=='0'?'Inactive':'Active') ; ?></td>
                                    <td style="text-align:center" width="150px">
                                        <?php
											if($edit=='1'){
												echo anchor(site_url('Masters/menulogin_update/' . $menu['id']), '<i class="fa fa-pencil-square-o"></i>', array('data-toggle' => 'tooltip', 'title' => 'edit', 'class' => 'btn btn-info btn-sm'));
											}
											if($del=='1'){
												echo "&nbsp;&nbsp;".anchor(site_url('Masters/menulogin_delete/' . $menu['id']), '<i class="fa fa-remove"></i>', array('data-toggle' => 'tooltip', 'title' => 'delete', 'class' => 'btn btn-danger btn-sm'));
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