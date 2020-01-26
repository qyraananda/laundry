<script type="text/javascript">
	var table;
    $(document).ready(function() {

      showKembali($('#bayar').val());

      table = $('#detail_transaksi').DataTable({ 
        paging: false,
        "info": false,
        "searching": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' 
        // server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?= site_url('Activities/ajax_list_transaksi')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ 0,1,2,3,4,5,6,7 ], //last column
          "orderable": false, //set not orderable
        },
        ],

      });
    });
	
function reload_table()
    {
      table.ajax.reload(null,false); //reload datatable ajax
    }
	
function addbarang()
    {
        var id_barang = $('#tariffs option[value="' + $('#tariffid').val() + '"]').data('id');
		var qty = $('#qty').val();
        if (id_barang == '') {
          $('#tariffid').focus();
		}else if(qty == ''){
          $('#qty').focus();
        }else{
       // ajax adding data to database
          $.ajax({
            url : "<?= site_url('Activities/addbarang')?>",
            type: "POST",
            data: $('#form_transaksi').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //reload ajax table
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding data');
            }
        });
		  $('#tariffid').val('');
          showTotal();
          showKembali($('#bayar').val());
          //mereset semua value setelah btn tambah ditekan
		  $('.reset').val('');
        };
    }
	
	function subTotal(qty)
	{

		var harga = $('#harga').val().replace(".", "").replace(".", "");
		var diskon = $('#diskon').val().replace(".", "").replace(".", "");
		if(diskon > 0){
			harga = ($('#harga').val() - ($('#harga').val() * $('#diskon').val() /100));
		}
		
		$('#sub_total').val(convertToRupiah(harga*qty));
		
		nomoresi();	
	}
	
	function showTotal()
    {

    	var total = $('#total').val().replace(".", "").replace(".", "");

    	var sub_total = $('#sub_total').val().replace(".", "").replace(".", "");

    	$('#total').val(convertToRupiah((Number(total)+Number(sub_total))));

  	}
	
	function showKembali(str)
  	{
	    var total = $('#total').val().replace(".", "").replace(".", "");
	    var bayar = str.replace(".", "").replace(".", "");
	    var kembali = bayar-total;
		var bagi = total / 2;

	    $('#kembali').val(convertToRupiah(kembali));
		//alert(bagi);
		
	    if (bayar >= bagi) {
	      $('#selesai').removeAttr("disabled");
	    }else{
	      $('#selesai').attr("disabled","disabled");
	    };

	    if (total == '0') {
	      $('#selesai').attr("disabled","disabled");
	    };
		
  	}
	
	function deletebarang(id,sub_total)
    {
        // ajax delete data to database
          $.ajax({
            url : "<?= site_url('Activities/deletebarang')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

          var ttl = $('#total').val().replace(".", "");

          $('#total').val(convertToRupiah(ttl-sub_total));

          showKembali($('#bayar').val());
    }
	
	function tabeltransaksi()
    {
		var answer = confirm("Anda akan menyelesaikan transaksi!!")
		if (answer){
			$.ajax({
            url : "<?=$action;?>/",
            type: "POST",
            data: $('#tabel_transaksi').serialize(),
            dataType: "JSON",
            success: function(data)
            {
				var struk = $('#noresi').val();
				cetakstruk(struk);
				window.open="<?= site_url('Activities/clear')?>";
            }
        });
		}else{
		  return false;
		}  
    }
	
	function nomoresi()
	{
		var currentDate = new Date()
		var day = currentDate.getDate()
		var month = currentDate.getMonth() + 1
		var year = currentDate.getFullYear()
		date_future = new Date(new Date().getFullYear() +1, 0, 1);
		date_now = new Date();

		seconds = Math.floor((date_future - (date_now))/1000);
		minutes = Math.floor(seconds/60);
		hours = Math.floor(minutes/60);

		var d = 'IN'+year+''+month+''+day+''+hours+''+seconds;
	
		$('#noresi').val()=d;	
	}
	
	function cetakstruk(str) 
	{
		  window.open("<?=base_url('Activities/cashier_print') ?>/"+str);
	}
	
	function convertToRupiah(angka)
	{

	    var rupiah = '';    
	    var angkarev = angka.toString().split('').reverse().join('');
	    
	    for(var i = 0; i < angkarev.length; i++) 
	      if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
	    
	    return rupiah.split('',rupiah.length-1).reverse().join('');
	
	}
</script>

<div class="card">
	<div class="card-header" data-background-color="orange">
		<h4 class="title">Cashier Menu</h4>
    </div>
    <div class="row">
	  <div class="col-sm-6">
		<div class="panel-body">
		 	<form class="form-inline" id="form_transaksi" role="form">
				<div class="form-group">
			      <label class="control-label col-md-3">Barang :</label>
			      <div class="col-md-5">
			        <input name="tariff" list="tariffs" class="form-control" id="tariffid" value="<?php echo $tariffid; ?>" required/>
					<datalist id="tariffs">
						<?php
							foreach($dd_tariff as $val){
								echo "<option data-id='".$val->tariffid."' value='".$val->tariff." [ ".$val->satuan." - ".$val->jenis." ]'>";
							}
						?>
					</datalist>
			      </div>
				  </div>
				  <div id="barang">
					
				    <div class="form-group">
				      <label class="control-label col-md-3" 
				      	for="harga_barang">Harga (Rp) :</label>
				      <div class="col-md-4">
						<input type="text" class="form-control reset" name="harga" id="harga" placeholder="Harga" readonly>
						<input type="hidden" class="form-control" name="idtariff" id="idtariff" readonly>
				      </div>
				    </div>
					<div class="form-group">
				      <label class="control-label col-md-3" 
				      	for="qty">Jumlah :</label>
				      <div class="col-md-4">
				        <input type="text" class="form-control reset" name="qty" id="qty" onchange="subTotal(this.value)" onkeyup="subTotal(this.value)" min="0" 
						placeholder="Isi Jumlah"/>
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-md-3" 
				      	for="qty">Diskon :</label>
				      <div class="col-md-4">
				        <input type="text" class="form-control reset" name="diskon" id="diskon" placeholder="Diskon">
				      </div>
				    </div>
					<div class="form-group">
					  <label class="control-label col-md-3" 
						for="sub_total">Sub-Total (Rp):</label>
					  <div class="col-md-8">
						<input type="text" class="form-control reset" name="sub_total" id="sub_total" readonly="readonly">
					  </div>
					</div>
			    </div><!-- end id barang -->
			    <div class="form-group">
			    	<div class="col-md-offset-3 col-md-3">
			      		<button type="button" class="btn btn-primary" id="tambah" onclick="addbarang()">
			      		  <i class="fa fa-cart-plus"></i> Tambah</button>
			    	</div>
			    </div>
		 </form>
		  
		  <table id="detail_transaksi" class="table table-striped table-bordered">
				<thead>
				 	<tr>
					   	<th>No</th>
					   	<th>Id Barang</th>
					   	<th>Nama Barang</th>
					   	<th>Harga</th>
						<th>Qty</th>
						<th>Diskon</th>
					   	<th>Sub-Total</th>
					   	<th>Aksi</th>
				 	</tr>
				</thead>
				<tbody>
				</tbody>
		 </table>
		 </div>
	  </div> <!-- end col-sm-6 -->
	  <form class="form-horizontal" id="tabel_transaksi" role="form">
		<div class="col-sm-3">
			<div class="panel-body">
				<div class="form-group">
					<label class="control-label"><b>Invoice No :</b></label>
					<input type="text" class="form-control" name="noresi" id="noresi" value="<?=$noresi;?>" readonly="readonly">
				</div>
				<div class='form-group'><b>Customer</b> <?php echo form_error('customer') ?>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="exampleRadios" id="newcust" value="option1">
						<label class="form-check-label" for="newcust">
							New Customer
						</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="exampleRadios" id="oldcust" value="option2" checked>
					<label class="form-check-label" for="oldcust">
						Old Customer
					</label>
				</div>
				<div id="lama">
					<input name="customero" list="customers" class="form-control" id="customer" value="<?=$customerid;?>" required>
					<datalist id="customers">
					<?php
						foreach($dd_customer as $val){
							echo "<option data-id='".$val->customerid."' value='".$val->customer."'>";
						}
						?>
					</datalist>
				</div>
				<div id="baru">
					<input name="customern" class="form-control" value="<?=$customerid; ?>" required/>
				</div>
			</div>
			<div class='form-group'>Alamat <?php echo form_error('alamat') ?>
				<input type="text" class="form-control" name="alamat" id="alamat" value="<?=$alamat;?>" placeholder="Alamat">
			</div>
			<div class='form-group'>Handphone <?php echo form_error('handphone') ?>
				<input type="text" class="form-control" name="handphone" id="handphone" value="<?=$handphone;?>" placeholder="Handphone" required/>
			</div>
			</div>
		</div> <!-- end col-sm-3 -->
	  <div class="col-sm-3">
			<div class="panel-body">
			<div class="form-group">
				<label class="control-label"><b>Pembayaran :</b></label>
				<?php echo form_dropdown('pembayaran', $dd_bayar, $pembayaran, 'class="form-control" id="pembayaran" required/'); ?>
			</div>
			<div id="kartu">
				<div class="form-group">
					<label class="control-label">Kartu :</label>
					<input type="text" class="form-control" name="kartu" placeholder="Nomor kartu" />
				</div>
			</div>
			<div class="form-group">
				<label for="total" class="besar">Total (Rp) :</label>
				<input type="text" class="form-control input-lg" name="total" id="total" placeholder="0"	readonly="readonly" style="font-size:28px;" 
				value="<?= number_format($this->cart->total(), 0 , '' , '.' ); ?>">
			</div>
			<div class="form-group">
			    <label for="bayar" class="besar">Bayar (Rp) :</label>
				<input type="text" class="form-control input-lg uang" name="bayar" placeholder="0" autocomplete="off" style="font-size:28px;" id="bayar" onkeyup="showKembali(this.value)">
			</div>
			<div class="form-group">
				<label for="kembali" class="besar">Kembali (Rp) :</label>
				<input type="text" class="form-control input-lg" style="font-size:28px;" name="kembali" id="kembali" placeholder="0" readonly="readonly">
			</div>
	  
		  <div class="col-sm-12">
				<button type="button" class="btn btn-primary btn-lg" id="selesai" disabled="disabled" onclick="tabeltransaksi()" style="width:100%;">
				<i class="fa fa-save"></i> Selesai</button>
		   </div>
		   
		   <div class="col-sm-12">
				<!-- <button type="submit" class="btn btn-success btn-lg" onclick="window.location='<?php echo site_url('Activities/clear');?>';" style="width:100%;"> !-->
				<a href="<?php echo site_url('Activities/cashier') ?>" class="btn btn-default"><i class="fa fa-undo"></i> Batal</a>
		   </div>
		   </div>
	   </div>
	  </form>
	</div>
</div>
<script>
$(function() {
    $('#kartu').hide(); 
    $('#pembayaran').change(function(){
        if($('#pembayaran').val() == 'Cash') {
            $('#kartu').hide(); 
        } else {
            $('#kartu').show(); 
        } 
    });
});
</script>

<script>
$(function() {
    $('input[name=exampleRadios]').on('click init-post-format', function() {
        $('#baru').toggle($('#newcust').prop('checked'));
    }).trigger('init-post-format');
});
</script>

<script>
$('#newcust').change(function(e){
var val = document.getElementById("newcust").value;
if($(this).val() == "option1"){
	$('#lama').prop('hidden', true);
	$('#baru').prop('hidden', false);
	document.getElementById('alamat').value='';
	document.getElementById('handphone').value='';
}});
</script>

<script>
$('#oldcust').change(function(e){
var val = document.getElementById("newcust").value;
if($(this).val() == "option2"){
	$('#lama').prop('hidden', false);
	$('#baru').prop('hidden', true);
}});
</script>


<script type="text/javascript">
$(function(){
$.ajaxSetup({
type:"POST",
url: "<?php echo base_url('/Welcome/showdata') ?>",
cache: false,
});

$("#customer").change(function(){
var value = $('#customers option[value="' + $('#customer').val() + '"]').data('id');

if(value != ""){
$.ajax({
data:{modul:'tampil_customer',id:value},
success: function(respond){
	var obj = JSON.parse(respond);
	document.getElementById('alamat').value = obj[0].alamat;
	document.getElementById('handphone').value = obj[0].hp;
}
})
}})
});

$(function(){
$.ajaxSetup({
type:"POST",
url: "<?php echo base_url('/Welcome/showdata') ?>",
cache: false,
});

$("#tariffid").change(function(){
var value = $('#tariffs option[value="' + $('#tariffid').val() + '"]').data('id');

if(value != ""){
$.ajax({
data:{modul:'tampil_tariff',id:value},
success: function(respond){
	var obj = JSON.parse(respond);
	document.getElementById('idtariff').value = value;
	document.getElementById('harga').value = obj[0].harga;
	document.getElementById('diskon').value = obj[0].diskon;
}
})
}})
});
</script>
