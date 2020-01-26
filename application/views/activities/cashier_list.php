<div class="card">
	<div class="card-header" data-background-color="orange">
		<h4 class="title">Menu Cashier</h4>
    </div>
    <div class="card-content table-responsive">
		<div id="infoMessage"><b><?php echo $this->session->userdata('message');?></b></div>
		<div class='box-header with-border'>
		<?php
			$edit=0;$add=0;$del=0;$print=0;$app=0;
			foreach($access->result_array() as $acc){
				if($acc['submenu'] == 'Cashier'){
					$edit = $acc['edit'];
					$add = $acc['add'];
					$del = $acc['delete'];
					$app = $acc['approve'];
					$print = $acc['print'];
				}
			};?>
            <h3 class='box-title'><?php 
				if($add == '1'){
					echo anchor('Activities/cashier_create/', '<i class="glyphicon glyphicon-plus"></i> Tambah Data', array('class' => 'btn btn-primary btn-sm')); 
				}?></h3>
       </div><!-- /.box-header -->
	   <div class='box-body table-responsive'>
		<table class="table table-striped table-bordered nowrap" id="mycash">
                        <thead class="text-primary">
                           <th>No</th>
                                <th>Store</th>
								<th>Resi</th>
								<th>Nama</th>
								<th>Telephone</th>
								<th>Jenis</th>
								<th>Terima</th>
								<th>Kirim ke Produksi</th>
								<th>Kirim dari Produksi</th>
								<th>Terima dari Produksi</th>
								<th>Status</th>
								<th>Sisa</th>								
								<th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                            $start = 0;
                            foreach ($cashiers->result_array() as $menu) {
                                ?>
                                <tr>
                                    <td><?php echo ++$start ?></td>
									<td><?php echo $this->M_dasb->getoutlet($menu['outletid']) ;?></td>
									<td><?php 
									if($print=='1'){
												echo "&nbsp;&nbsp;".anchor(site_url('Activities/cashier_print/' . $menu['noresi']), $menu['noresi'], null);
											}else{
											echo $menu['noresi'];}?></td>
                                  	<td><?php echo $this->M_dasb->getcust($menu['noresi']);?></td>
									<td><?php echo $this->M_dasb->gethandphone($menu['noresi']);?></td>
									<td><?php echo $this->M_dasb->getjenis($menu['noresi']);?></td>
									<td><?php echo $this->M_dasb->getterima($menu['noresi']) ; ?></td>
                                    <td>
									<?php 
									if($menu['status'] != 'Finish'){
										?>
									<a href="#" id="kirimcash<?=$menu['noresi'];?>" data-type="date" data-pk="1" data-url="tglkirimcash/<?=$menu['noresi'];?>" data-title="Select date" data-placement="bottom"><?=$menu['tglkirimcash'];?></a>
									<script>
									$(function(){
										$('#kirimcash<?=$menu['noresi'];?>').editable({
											format: 'yyyy-mm-dd',    
											viewformat: 'dd/mm/yyyy',    
											datepicker: {
													weekStart: 1
											   }
											});
									});
									</script>
									<?php
									}else{
										echo $menu['tglkirimcash'];
									}?>
									</td>
									<td><?php echo $menu['tglkirimprod'] ; ?></td>
									<td>
									<?php 
									if($menu['status'] != 'Finish'){
										?>
									<a href="#" id="terimacash<?=$menu['noresi'];?>" data-type="date" data-pk="1" data-url="tglterimacash/<?=$menu['noresi'];?>" data-title="Select date" data-placement="bottom"><?=$menu['tglterimacash'];?></a>
									<script>
									$(function(){
										$('#terimacash<?=$menu['noresi'];?>').editable({
											format: 'yyyy-mm-dd',    
											viewformat: 'dd/mm/yyyy',    
											datepicker: {
													weekStart: 1
											   }
											});
									});
									</script>
									<?php
									}else{
										echo $menu['tglterimacash'];
									}
									?>
									</td>
									<td >
									<?php 
										$tglprod = $menu['tglkirimprod'] ; 
										if($app == '1' && ((!empty($tglprod)) && $menu['status'] != 'Finish')){
										?>
											<div>
											
							<a data-url='cashstatus/<?=$menu['noresi'];?>' data-type='text' data-original-title="" data-pk="1" id='cash<?=$menu['noresi'];?>' data-name='cash'>
							<?=number_format($menu['sisa']);?>
							</a>
							<script>
								$(function() {
									$.fn.editable.defaults.mode ="inline";
									$('#cash<?=$menu['noresi'];?>').editable();
								});
							</script>
						</div>
									<?php	} else {
										echo $menu['status'];
									}
									?>
									</td>
									<td><?=number_format($menu['sisa']);?></td>
                                    <td style="text-align:center" width="150px">
                                        <?php
											if($edit=='1' && $menu['status'] != 'Finish'){
												echo anchor(site_url('activities/cashier_update/' . $menu['hdrcashid']), '<i class="fa fa-pencil-square-o"></i>', array('data-toggle' => 'tooltip', 'title' => 'edit', 'class' => 'btn btn-info btn-sm'));
											}
											if($del=='1' && $menu['status'] != 'Finish'){
												echo "&nbsp;&nbsp;".anchor(site_url('activities/cashier_delete/' . $menu['hdrcashid']), '<i class="fa fa-remove"></i>', array('data-toggle' => 'tooltip', 'title' => 'delete', 'class' => 'btn btn-danger btn-sm'));
											}
											if($print=='1'){
												echo "&nbsp;&nbsp;".anchor(site_url('activities/cashier_print/' . $menu['noresi']), '<i class="fa fa-print"></i>', array('data-toggle' => 'tooltip', 'title' => 'print', 'class' => 'btn btn-success btn-sm'));
											}
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
						<tfoot>
							<tr>
								<th colspan="11" style="text-align:right">Total:</th>
								<th></th>
								<th></th>
							</tr>
						</tfoot>
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
	
	  
    var table = $('#mycash').DataTable( {
        dom: 'Bfrtip',
		//responsive: true,
		lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'CA'+d
            },
            'print','pageLength'
        ]
		,"footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
             
          
						
			sisa = api
                .column( 11, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
				
            // Update footer
            $( api.column( 11 ).footer() ).html(
                convertToRupiah(sisa)
            );
			
        }
		 
    } );
	new $.fn.dataTable.FixedHeader( table );
} );

function convertToRupiah(angka)
	{

	    var rupiah = '';    
	    var angkarev = angka.toString().split('').reverse().join('');
	    
	    for(var i = 0; i < angkarev.length; i++) 
	      if(i%3 == 0) rupiah += angkarev.substr(i,3)+',';
	    
	    return rupiah.split('',rupiah.length-1).reverse().join('');
	
	}
</script>