<div class="card">
	<div class="card-header" data-background-color="orange">
		<h4 class="title">Cashier Menu</h4>
    </div>
    <div class="row container-fluid">
		<form class="form-horizontal" action="<?php echo $action; ?>" method="post">
		<div class="col-sm-6">
			<div class="panel-body">
				<div class='form-group'><b>Customer :</b> <?php echo form_error('customer') ?>
				<label class="form-check-inline"><input type="radio" name="exampleRadios" id="newcust" value="option1"> New Customer</label>
				<label class="form-check-inline"><input type="radio" name="exampleRadios" id="oldcust" value="option2" checked> Old Customer</label>
				</div>
					<div class='form-group'><b>Nama :</b> <?php echo form_error('customer') ?>			
						<div id="lama">
							<input name="customero" list="customers" class="form-control" id="customer" value="<?=$customers;?>">
							<datalist id="customers">
							<?php
								foreach($dd_customer as $val){
									echo "<option data-id='".$val->customerid."' value='".$val->customer."'>";
								}
								?>
							</datalist>
							<input type="hidden" id="pelanggan" name="pelanggan" value="<?=$customerid;?>">
						</div>
						<div id="baru">
							<input name="customern" class="form-control" value="<?=$customers; ?>">
						</div>
					</div>
					<div class='form-group'><b>Alamat :</b><?php echo form_error('alamat') ?>
						<input type="text" class="form-control" name="alamat" id="alamat" value="<?=$alamat;?>" placeholder="Alamat" required/>
					</div>
					<div class='form-group'><b>Handphone :</b><?php echo form_error('handphone') ?>
						<input type="text" class="form-control" name="handphone" id="handphone" value="<?=$handphone;?>" placeholder="Handphone" required/>
					</div>
			</div>
			
			
  <ul class="nav nav-tabs">
    <li <?=(!empty($aktifs)?'class="active"':"");?> ><a href="#satuan">Satuan</a></li>
    <li <?=(!empty($aktifk)?'class="active"':"");?>><a href="#kiloan">Kiloan</a></li>
    <li <?=(!empty($aktifp)?'class="active"':"");?>><a href="#paket">Paket</a></li>
  </ul>

  <div class="nav tab-content">
    <div id="satuan" class="tab-pane fade <?=(!empty($aktifs)?$aktifs:"");?>">
      <table id="mytablecash" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Id Barang</th>
							<th>Nama Barang</th>
							<th>Harga</th>
							<th width="10px;">Qty</th>
							<th>Diskon</th>
							<th>Sub-Total</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$i = 1;
						$jumlah = '';
						foreach($dd_tariff as $val){
							$dtlid = $this->M_dasb->getdtlid($noresi,$val->tariffid);
							$jumlah = $this->M_dasb->getjumlahcash($noresi,$val->tariffid);
							$subtotal = $this->M_dasb->getsubtotcash($noresi,$val->tariffid);
							$harga = $this->M_dasb->gethargacash($noresi,$val->tariffid);
							if($val->satuan == "Satuan"){
								echo "<tr><td>".$i."</td><td><input type='checkbox' name='ids[]' value='".$val->tariffid."' ".(!empty($jumlah)?"checked":"")."></td>
											<td><input type='hidden' value='".$val->tariffid."' name='dtlid[]'>".$val->tariff."</td>
											<td class='price'>".$val->harga."<input type='hidden' value='".(!empty($harga)?$harga:$val->harga)."' name='harga[]' id='price' readonly></td>
											<td><input type='text' name='qtys[]' id='qty' class='qty' value='".(!empty($jumlah)?$jumlah:"")."' style='width:20px;'></td>
											<td class='diskon'>".$val->diskon."</td>
											<td class='sum'>".(!empty($jumlah)?$subtotal:0)."</td></tr>";
								$i++;
							}
						}
						?>
					<tr>
						<td colspan='6'>Total</td>
						<td id='totalcol'></td>
					</tr>
					</tbody>
				 </table>
    </div>
    <div id="kiloan" class="tab-pane fade <?=(!empty($aktifk)?$aktifk:"");?>">
		<section class="container-fluid">
		  <div class='form-group'><b>Tipe :</b><?php echo form_error('tipe') ?>
				<?php echo form_dropdown('tipe', $dd_tipe, $tipe, 'class="form-control" data-show-subtext="true" data-live-search="true" id="kilo-tipe"'); ?>
		  
		  </div>
		  <div class='form-group'><b>Jenis :</b><?php echo form_error('jenis');?>
			<?php echo form_dropdown('jenis', $dd_jenis, $jenis, 'class="form-control" data-show-subtext="true" data-live-search="true" id="kilo-jenis"'); ?>
		  </div>
		  <input type="hidden" class="form-control" name="tariffidbrg" id="tariffidbrg" readonly>
		  <div class='form-group'><b>Harga :</b><?php echo form_error('hargabrg') ?>
				<input type="text" class="form-control" name="hargabrg" id="hargabrg" value="<?=$hargabrg;?>" readonly>
		  </div>
		  <div class='form-group'><b>Diskon :</b><?php echo form_error('diskonbrg') ?>
				<input type="text" class="form-control" name="diskonbrg" id="diskonbrg" value="<?=$diskonbrg;?>" readonly>
		  </div>
		  <div class='form-group'><b>Kg :</b><?php echo form_error('jumlahbrg') ?>
				<input type="number" class="form-control" name="jumlahbrg" id="jumlahbrg" value="<?=$jumlahbrg;?>" placeholder="jumlah barang">
		  </div>
		  <div class='form-group'><b>Min per Kg :</b>
				<input type="text" class="form-control" name="perkg" id="perkg" value="<?=$perkg;?>" readonly>
		  </div>
		</section>
    </div>
    <div id="paket" class="tab-pane fade <?=(!empty($aktifp)?$aktifp:"");?>">
		<section class="container-fluid">
			<div class='form-group'><b>Paket :</b><?php echo form_error('satuan') ?>
			<?php echo form_dropdown('satuan', $dd_paket, $satuan, 'class="form-control" data-show-subtext="true" data-live-search="true" id="paket-jenis"'); ?>
			</div>
			<input type="hidden" class="form-control" name="tariffidpaket" id="tariffidpaket" readonly>
			<div class='form-group'><b>Harga :</b><?php echo form_error('hargapaket') ?>
				<input type="text" class="form-control" name="hargapaket" id="hargapaket" value="<?=$hargapaket;?>" readonly>
		  </div>
		  <div class='form-group'><b>Diskon :</b><?php echo form_error('diskonpaket') ?>
				<input type="text" class="form-control" name="diskonpaket" id="diskonpaket" value="<?=$diskonpaket;?>" readonly>
		  </div>
		  <div class='form-group'><b>Kg :</b><?php echo form_error('jumlahpaket') ?>
				<input type="text" class="form-control" name="jumlahpaket" id="jumlahpaket" value="<?=$jumlahpaket;?>" placeholder="jumlah barang">
		  </div>
		  <div class='form-group'><b>Min per Kg :</b>
				<input type="text" class="form-control" name="paketkg" id="paketkg" value="<?=$paketkg;?>" readonly>
		  </div>
		</section>
    </div>
		
  </div>
				 
			<div class="container-fluid">
						<div class="col-md-10">
							<div class="form-group">
								<label><b>Keterangan</b></label>
                                    <div class="form-group label-floating">
                                        <textarea class="form-control" name="keterangan" rows="5"><?=$keterangan;?></textarea>
									</div>
                            </div>
						</div>
                </div>
		 
		</div> <!-- end col-sm-6 -->
		<section>
	  <input type="hidden" name="hasil" id="hasil" value="satuan">
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
				<input type="text" class="form-control input-lg" name="total" id="total" placeholder="0" readonly="readonly" style="font-size:28px;" 
				value="<?= number_format($total, 0 , '' , '.' ); ?>">
			</div>
			<div class="form-group">
			    <label for="bayar" class="besar">Bayar (Rp) :</label>
				<input type="text" class="form-control input-lg uang" name="bayar" placeholder="0" autocomplete="off" style="font-size:28px;" id="bayar" 
				onkeyup="showKembali(this.value)" value="<?= number_format($bayar, 0 , '' , '.' ); ?>">
			</div>
			<div class="form-group">
				<label for="kembali" class="besar">Kembali (Rp) :</label>
				<input type="text" class="form-control input-lg" style="font-size:28px;" name="kembali" id="kembali" placeholder="0" 
				value="<?= number_format($sisa, 0 , '' , '.' ); ?>" readonly="readonly">
			</div>
	  
		  <div class="col-sm-12">
				 <input type="hidden" name="hdrcashid" value="<?php echo $hdrcashid; ?>" /> 
				 <input type="hidden" name="noresi" value="<?php echo $noresi; ?>" /> 
				<button type="submit" class="btn btn-primary btn-lg" id="selesai" disabled="disabled" style="width:100%;">
				<i class="fa fa-save"></i> Selesai</button>
		   </div>
		   
		   <div class="col-sm-12">
				<!-- <button type="submit" class="btn btn-success btn-lg" onclick="window.location='<?php echo site_url('Activities/clear');?>';" style="width:100%;"> !-->
				<a href="<?php echo site_url('Activities/cashier') ?>" class="btn btn-default"><i class="fa fa-undo"></i> Batal</a>
		   </div>
		   </div>
	   </div>
	   </section>
	  </form>
	</div>
</div>
<!-- <script>
$(document).ready(function() {
	 
    var table = $('#mytablecash').DataTable( {
        dom: 'Bfrtip',
		responsive: true,
		lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ]			 
    } );
	new $.fn.dataTable.FixedHeader( table );
} );
</script> !-->
<script>
$(document).ready(function(){
    $(".nav-tabs a").click(function(){
		var reff = $(this).attr("href");
		if(reff == "#satuan"){
			document.getElementById("kilo-jenis").value='';
			document.getElementById("hargabrg").value=0;
			document.getElementById("jumlahbrg").value=0;
			document.getElementById("diskonbrg").value=0;
			document.getElementById("perkg").value=0;
			document.getElementById('tariffidbrg').value = "";
			
			document.getElementById("paket-jenis").value='';
			document.getElementById("hargapaket").value=0;
			document.getElementById("jumlahpaket").value=0;
			document.getElementById("diskonpaket").value=0;
			document.getElementById("paketkg").value=0;
			document.getElementById('tariffidpaket').value = "";
			
			document.getElementById("total").value=0;
			document.getElementById("hasil").value="satuan";
		}
		if(reff == "#kiloan"){
			document.getElementById("paket-jenis").value='';
			document.getElementById("hargapaket").value=0;
			document.getElementById("jumlahpaket").value=0;
			document.getElementById("diskonpaket").value=0;
			document.getElementById("paketkg").value=0;
			document.getElementById('tariffidpaket').value = "";
			
			document.getElementById("total").value=0;
			document.getElementById("hasil").value="kiloan";
		}
		if(reff == "#paket"){
			document.getElementById("kilo-jenis").value='';
			document.getElementById("hargabrg").value=0;
			document.getElementById("jumlahbrg").value=0;
			document.getElementById("diskonbrg").value=0;
			document.getElementById("perkg").value=0;
			document.getElementById('tariffidbrg').value="";
						
			document.getElementById("total").value=0;
			document.getElementById("hasil").value="paket";
		}
		$(this).tab('show');
    });
}); // --- tabs ---

$(function() {
    $('input[name=exampleRadios]').on('click init-post-format', function() {
        $('#baru').toggle($('#newcust').prop('checked'));
    }).trigger('init-post-format');
});

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
	document.getElementById('pelanggan').value = value;
}
})
}})

$("#kilo-tipe").change(function(){
var value = $(this).val();

if(value != ""){
$.ajax({
data:{modul:'tampil_jenis',id:value},
success: function(respond){
	var obj = JSON.parse(respond);
	var items = "<option value=''></option>";
	
	$.each(obj,function(name,value) {
	   items += "<option value='"+value.tariffid+"'>"+value.jenis+"</option>";
	});
	
	$("#kilo-jenis").html(items);
}
})
}})

$("#kilo-jenis").change(function(){
var value = $(this).val();

if(value != ""){
$.ajax({
data:{modul:'tampil_tariff',id:value},
success: function(respond){
	var obj = JSON.parse(respond);
	document.getElementById('hargabrg').value = obj[0].harga;
	document.getElementById('diskonbrg').value = obj[0].diskon;
	document.getElementById('perkg').value = obj[0].perkg;
	document.getElementById('tariffidbrg').value = obj[0].tariffid;
}
})
}})

$("#paket-jenis").change(function(){
var value = $(this).val();

if(value != ""){
$.ajax({
data:{modul:'tampil_tariff',id:value},
success: function(respond){
	var obj = JSON.parse(respond);
	document.getElementById('hargapaket').value = obj[0].harga;
	document.getElementById('diskonpaket').value = obj[0].diskon;
	document.getElementById('paketkg').value = obj[0].perkg;
	document.getElementById('tariffidpaket').value = obj[0].tariffid;
}
})
}})
}); //--- end customer ---//


function getTotal(){
    var totalcol = 0;
    $('.sum').each(function(){
        totalcol += parseFloat(this.innerHTML)
    });
    $('#totalcol').text(convertToRupiah(totalcol));
	$('#total').val(convertToRupiah(totalcol));
	showKembali($('#bayar').val());
}

//getTotal();

$('.qty').keyup(function(){
    var parent = $(this).parents('tr');
    var price = $('.price', parent);
	var diskon = $('.diskon',parent);
    var sum = $('.sum', parent);
    var value = parseInt(this.value) * (parseFloat(price.get(0).innerHTML||0) - (parseFloat(price.get(0).innerHTML||0) * parseFloat(diskon.get(0).innerHTML||0)/100));
    sum.text(value);
	getTotal();
	
})

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

$('#newcust').change(function(e){
var val = document.getElementById("newcust").value;
if($(this).val() == "option1"){
	$('#lama').prop('hidden', true);
	$('#baru').prop('hidden', false);
	document.getElementById('alamat').value='';
	document.getElementById('handphone').value='';
}});

$('#oldcust').change(function(e){
var val = document.getElementById("newcust").value;
if($(this).val() == "option2"){
	$('#lama').prop('hidden', false);
	$('#baru').prop('hidden', true);
}});

$(function(){
$("#jumlahbrg").keyup(function(){
	var harga = $('#hargabrg').val();
	var diskon = $('#diskonbrg').val();
	var qtyx = parseInt($('#jumlahbrg').val());
	var perkg = $('#perkg').val();
	
	if(qtyx < perkg){
		qtys = perkg;
	}else{
		qtys = qtyx;
	}
	//alert(qtys);
	if(diskon > 0){
		harga = ($('#hargabrg').val() - ($('#hargabrg').val() * $('#diskonbrg').val() /100));
	}
		
	$('#total').val(convertToRupiah(harga*qtys));
	qtyx=0;
	showKembali($('#bayar').val());
})
});

$(function(){
$("#jumlahpaket").keyup(function(){
	var hargas = $('#hargapaket').val();
	var diskons = $('#diskonpaket').val();
	var qtys = $('#jumlahpaket').val();
	var perkgs = $('#paketkg').val();
	
	if(parseInt(perkgs) > parseInt(qtys)){
		qtys = perkgs;
	}
	if(diskons > 0){
		hargas = ($('#hargapaket').val() - ($('#hargapaket').val() * $('#diskonpaket').val() /100));
	}
		
	$('#total').val(convertToRupiah(hargas));
	showKembali($('#bayar').val());
})
});

function showKembali(str)
  	{
	    var total = $('#total').val().replace(".", "").replace(".", "");
	    var bayar = str.replace(".", "").replace(".", "");
	    var kembali = bayar-total;
		var bagi = total / 2;

	    $('#kembali').val(convertToRupiah(kembali));
		//alert(bagi);
		
	    if (bayar >= 0) {
	      $('#selesai').removeAttr("disabled");
	    }else{
	      $('#selesai').attr("disabled","disabled");
	    };

	    if (total == '0') {
	      $('#selesai').attr("disabled","disabled");
	    };
		
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
