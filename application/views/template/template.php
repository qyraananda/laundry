<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/images/big.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Laundry</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/material-dashboard.css?v=1.2.0" rel="stylesheet" /> 
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
	
	<!-- mobile-style !-->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/mobile-style.css">
   
   
<!--   Core JS Files   -->
<script src="https://code.jquery.com/jquery-1.12.4.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/bootstrap/js/material.min.js" type="text/javascript"></script>  

	
<!-- Include the plugin's CSS and JS: -->	
  <script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap/css/bootstrap-multiselect.css" type="text/css"/>
  
  <script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap-select.min.js"></script>
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/select2/dist/css/select2.min.css">  
  <!-- Select2 -->
  <script src="<?php echo base_url();?>assets/select2/dist/js/select2.full.min.js"></script>

  
<!-- datatable !-->
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/datatables/dataTables.bootstrap.min.js"></script>
<link href="<?php echo base_url()?>assets/datatables/dataTables.bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.2.2/css/fixedColumns.dataTables.min.css">
<link href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.3/css/fixedHeader.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">

<script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url()?>assets/datatables/buttons.flash.min.js"></script>
<script src="<?php echo base_url()?>assets/datatables/jszip.min.js"></script>
<script src="<?php echo base_url()?>assets/datatables/pdfmake.min.js"></script>
<script src="<?php echo base_url()?>assets/datatables/vfs_fonts.js"></script>
<script src="<?php echo base_url()?>assets/datatables/buttons.html5.min.js"></script>
<script src="<?php echo base_url()?>assets/datatables/buttons.print.min.js"></script>

<!--  Charts Plugin -->
<script src="<?php echo base_url();?>assets/bootstrap/js/chartist.min.js"></script>
</head>

<body>
    <div class="wrapper">
		
        <div class="sidebar" data-color="blue" data-image="<?php echo base_url();?>assets/bootstrap/img/sidebar-2.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
          
			<div class="logo">
                <a href="#" class="simple-text">
                    Laundry
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
					<li class="active">
                        <a href="<?php echo site_url('Dash');?>">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
					
                    <?php
						$i=0;
						foreach($daftarmenu->result_array() as $row){
							if($row['parent']=="0"){
								echo '<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="'.$row['class_icon'].'"></i> <span>'.$row['header'].' </span>
										<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
										</span>
										</a>';
								}
								echo ' <ul class="dropdown-menu">';
									foreach($access->result_array() as $mnu){
										if($row['header'] == $mnu['header']){
											echo '<li><a href="'.site_url($mnu['urlmenu']).'">
											<i class="'.$mnu['class_icon'].'"></i> '.str_replace("Plan","",$mnu['submenu']).'</a></li>';
											
										}
										$i++;
									}
							echo '</ul>';
							echo '</li>';
						}
						
					 ?> 
					 <li>
                                <a href="<?php echo site_url('Login/signout'); ?>">
                                    <i class="material-icons">person</i>
									<span class="notification"><?=$this->M_dasb->getuser($uid);?></span>
                                    <p class="hidden-lg hidden-md">Profile</p>
                                </a>
                            </li>
                    <li class="active-pro">
                        <a href="<?php echo base_url()?>assets/uploads/bintang-laundry.apk">
                            <i class="fa fa-android"> Android</i>
                            <p>Android</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-absolute" data-color="orange">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"> Laundry </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="<?php echo site_url('Dash');?>">
                                    <i class="material-icons">dashboard</i>
                                    <p class="hidden-lg hidden-md">Dashboard</p>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">notifications</i>
                                    <span class="notification"><?=(!empty($notif)?$notif:0);?></span>
                                    <p class="hidden-lg hidden-md">Notifications</p>
                                </a>
                                <ul class="dropdown-menu">
								<?php
								if($levelid=='3' ||  $levelid == '4'){
									foreach($dtlnotif->result_array() as $row){
										echo '<li>
                                        <a href="'.site_url('Activities/production').'">Resi :'.$row['noresi'].' Total :'.number_format($row['total']).'</a>
                                    </li>';
									}
								}else{
									foreach($dtlnotif->result_array() as $row){
										echo '<li>
                                        <a href="'.site_url('Activities/cashier').'">Resi :'.$row['noresi'].' Total :'.number_format($row['total']).'</a>
                                    </li>';
									}
								}
								?>
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo site_url('Login/signout'); ?>">
                                    Logout
                                </a>
                            </li>
                        </ul>
                        
                    </div>
                </div>
            </nav>
            <div class="content">
                <?php echo $_content;?>
            </div>
            <footer class="footer" >
                 <div class="pull-right hidden-xs">
				  <b>Version</b> <?=$versi;?>
				</div>
				<strong>Copyright &copy; <?=$lisensi;?> <a href="arywinar@yahaoo.com">RizTech</a>.</strong> All rights reserved.
            </footer>
        </div>
	</div>	
</body>

   <!-- bootstrap datepicker -->
  <script src="<?=base_url();?>assets/dist/js/bootstrap-datepicker.min.js"></script>
   <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?=base_url();?>assets/dist/css/bootstrap-datepicker.min.css">
  
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap/css/bootstrap-select.min.css">

<!--  Dynamic Elements plugin -->
<script src="<?php echo base_url();?>assets/bootstrap/js/arrive.min.js"></script>
<!--  PerfectScrollbar Library -->
<script src="<?php echo base_url();?>assets/bootstrap/js/perfect-scrollbar.jquery.min.js"></script>
<!--  Notifications Plugin    -->
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-notify.js"></script>

<!-- Material Dashboard javascript methods -->
<script src="<?php echo base_url();?>assets/bootstrap/js/material-dashboard.js?v=1.2.0"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->

<script src="https://cdn.datatables.net/fixedheader/3.1.3/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js"></script>
<!-- <script src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></script> !-->

<script type="text/javascript" src="https://cdn.jsdelivr.net/bootstrap.editable/1.5.1/js/bootstrap-editable.js"></script>

<link href="https://cdn.jsdelivr.net/bootstrap.editable/1.5.1/css/bootstrap-editable.min.css" rel="stylesheet">
<!--
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
</script> !-->
<script>
    $('#datepicker').datepicker({
      autoclose: true
    })
	
	 $('#datepicker1').datepicker({
      autoclose: true
    })
	
	 $('#datepicker2').datepicker({
      autoclose: true
    })
</script>

<!-- <script src="<?php echo base_url();?>assets/dist/js/cashstyle.js"></script> !-->
</html>