<script>
	function cetak() {
    	window.print();
	}
</script>
<style>
	@media print {
		body.receipt { width: 58mm } 
		 
		#print{
			display: none;
		}
				
		@page {
			size:58mm 100mm;
		}
		
		body.receipt .sheet { width: 58mm; height: 100mm } 
		
		table {
			font-size: 6px;
			position: fixed; top: 0; bottom: 0; left: 0; right: 0;
			  z-index: -1;
		}
		
		
		.footer {
			display:none;	   }
	}
	
</style>

<section class="b">
<div id="print">
	<button type="button" class="btn btn-default" onclick="cetak()">Print</button>
    <a href="<?= base_url() ?>Activities/cashier/" id="back" class="btn btn-default">Kembali</a>
</div>
</section>

<div class="a">
		<table>
			<thead>
				<tr>
                	<td colspan="6" align="left" style="font-weight: bold; text-align: center;">
						<b>BINTANG LAUNDRY</b>
                    </td>
                </tr>
            	<tr>
                	<td colspan="6" align="left" style="font-weight: bold; text-align: center;">
						<?= $config['outlet'] ?><br />Alamat: <?= $config['alamat'] ?>, No Telp: <?= $config['telephone'] ?>
                    </td>
                </tr>
            <tr>
               	<th colspan="2" style="text-align:left;">No Nota : <?= $sale['noresi'];?></th>
                <th colspan="5" style="text-align:right;">Tanggal : <?=$sale['createdate'];?></th>
            </tr>
<?php 
if(count($list))
{
?>
			<tr style="border-top: 1px solid #000000; border-bottom: 1px solid #000000;">
				<th width="7%" style="text-align: center;">No</th>
				<th width="55%" style="text-align: center;">Nama Barang</th>
				<th width="12%" style="text-align: right;">Harga</th>
				<th width="7%" style="text-align: center;">QTY</th>
				<th width="7%" style="text-align: center;">Disk</th>
				<th width="12%" style="text-align: right;">SUB TOTAL</th>
			</tr>
			</thead>
			<tbody>
<?php
	$total = array();
	foreach ($list as $row)
	{
		if(empty($segment))
		{
			$segment = 1;
		}else{
			$segment++;
		}
?>
			<tr align="center" style="border-bottom: 1px solid #000000;">
                <td><?= $segment ?></td>
                <td><?= $this->M_dasb->gettarifname($row['tariffid']) ?></td>
                <td align="right"><?= number_format( $row['harga'], 0 , '' , '.' ) ?></td>
                <td><?= $row['jumlah'] ?></td>
				<td><?= $row['diskon'] ?>%</td>
                <td align="right">Rp. <?= number_format( $row['subtotal'], 0 , '' , '.' ) ?></td>
            </tr>
<?php
	}
?>
				<tr style="font-weight: bold;">
                	<td colspan="5" align="right">Total = Rp. </td>
                	<td align="right"><?php echo number_format($sale['total'], 0 , '' , '.' ); ?></td>
                </tr>
				
				<tr style="font-weight: bold;">
                	<td colspan="5" align="right">Pembayaran = Rp. </td>
                	<td align="right" style="border-bottom: 1px solid #000000;"><?php echo number_format( $sale['bayar'], 0 , '' , '.' ); ?></td>
                </tr>
				<tr style="font-weight: bold;">
                	<td colspan="5" align="right"><?=($sale['sisa']<0?'Sisa':'Kembali');?> = Rp. </td>
                	<td align="right"><?php echo number_format( $sale['sisa'], 0 , '' , '.' ); ?></td>
                </tr>
<?php
}
?>
		</tbody>
		</tfoot>
		<tr style="font-weight: bold;">
           <td colspan="5" align="left">Jenis Pembayaran : <?php echo $sale['pembayaran'].' '.($sale['pembayaran']!='Cash'?$sale['kartu']:''); ?></td>
        </tr>
		<tr>
        	<td colspan="5" style="text-align: left;"><b>Keterangan :</b></td>
        </tr>
		<tr>
        	<td colspan="5" style="text-align: left;"><?=(isset($row['keterangan'])?$row['keterangan']:'');?></td>
        </tr>
		<tr>
        	<td colspan="5" style="text-align: center;">- Terima Kasih -</td>
        </tr>
		
		</tfoot>
		</table>
	</div>
</div>

<script>
	window.onload = function() {
    	window.print();
		document.getElementById("back").focus();
	};
</script>