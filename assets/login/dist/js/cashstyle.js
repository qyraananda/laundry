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
alert(value);
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
	var qty = $('#jumlahbrg').val();
	var perkg = $('#perkg').val();
	
	if(qty < perkg){
		qty = perkg;
	}
	
	if(diskon > 0){
		harga = ($('#hargabrg').val() - ($('#hargabrg').val() * $('#diskonbrg').val() /100));
	}
		
	$('#total').val(convertToRupiah(harga*qty));
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
		
	$('#total').val(convertToRupiah(hargas*qtys));
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