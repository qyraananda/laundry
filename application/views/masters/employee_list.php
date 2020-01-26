<div class="card">
	<div class="card-header" data-background-color="orange">
		<h4 class="title">Employee Menu</h4>
    </div>
    <div class="card-content table-responsive">
		<div id="infoMessage"><b><?php echo $this->session->userdata('message');?></b></div>
		<div class='box-header with-border'>
		<?php
			$edit=0;$add=0;$del=0;
			foreach($access->result_array() as $acc){
				if($acc['submenu'] == 'Employee'){
					$edit = $acc['edit'];
					$add = $acc['add'];
					$del = $acc['delete'];
					$app = $acc['approve'];
					$print = $acc['print'];
				}
			};?>
            <h3 class='box-title'><?php 
				if($add == '1'){
					echo anchor('Masters/employee_create/', '<i class="glyphicon glyphicon-plus"></i> Tambah Data', array('class' => 'btn btn-primary btn-sm')); 
				}?></h3>
       </div><!-- /.box-header -->
	   <div class='box-body table-responsive'>
		<table class="table table-bordered table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th width="80px">No</th>
                                <th>ID</th>
                                <th>Leader</th>
								<th>Level</th>
								<th>Code</th>
								<th>Name</th>
								<th>Phone</th>
								<th>Handphone</th>
								<th>Foto</th>
								<th>Active Date</th>
								<th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $start = 0;
                            foreach ($employee->result_array() as $menu) {
                                ?>
                                <tr>
                                    <td><?php echo ++$start ?></td>
                                    <td><?php echo $menu['userid'] ;?></td>
									<td><?php echo $this->M_dasb->getuser($menu['leader']); ?></td>
                                    <td><?php echo $this->M_dasb->getlevel($menu['levelid']); ?></td>
									<td><?php echo $menu['rmcode']; ?></td>
									<td><?php echo $menu['name']; ?></td>
									<td><?php echo $menu['phone']; ?></td>
									<td><?php echo $menu['hp']; ?></td>
									<td>
									<a href="#" data-toggle="modal" data-target="#myModal<?=$menu['userid'];?>">
									<img src="<?php echo base_url()."assets/uploads/files/".$menu['foto'] ; ?>" class="img-circle"  style="width:30px" ></a>

  <!-- Modal -->
	<div class="modal fade" id="myModal<?=$menu['userid'];?>" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h4 class="modal-title">Employee</h4>
          </div>
          <div class="modal-body">
            <img src="<?php echo base_url()."assets/uploads/files/".$menu['foto'] ; ?>" style="width:90px">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div></td>
									<td><?php echo $menu['activedate']; ?></td>
									<td><?php echo ($menu['status']=='0'?'Not Active':'Active') ; ?></td>
                                    <td style="text-align:center" width="150px">
                                        <?php
											if($edit=='1'){
												echo anchor(site_url('Masters/employee_update/' . $menu['userid']), '<i class="fa fa-pencil-square-o"></i>', array('data-toggle' => 'tooltip', 'title' => 'edit', 'class' => 'btn btn-info btn-sm'));
											}
											if($del=='1'){
												echo "&nbsp;&nbsp;".anchor(site_url('Masters/employee_delete/' . $menu['userid']), '<i class="fa fa-remove"></i>', array('data-toggle' => 'tooltip', 'title' => 'delete', 'class' => 'btn btn-danger btn-sm'));
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