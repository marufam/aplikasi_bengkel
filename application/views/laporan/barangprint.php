
<script>window.print();</script>
<link href="<?=base_url();?>/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
</style>
<style>
    *{
        font-size: 12px;
    }
</style>
<center><h2>Laporan Barang</h2></center>
<table class="table table-bordered table-hover table-striped">
<tr>
		<th>No</th>
		<th>Kode Barang</th>
		<th>Merk</th>
		<th>Harga Beli</th>
		<th>Harga Jual</th>
		<th>Stok</th>
	</tr>
<?php $no=0; $totalbeli=0; $totaljual=0;
foreach ($listbarang as $row) {
	$totalbeli+=$row->harga_beli*$row->stok;
	$totaljual+=$row->harga_jual*$row->stok;?>
	
	
	<tr>
		<td><?= ++$no ?></td>
		<td><?= $row->kode_barang ?></td>
		<td><?= $row->merk ?></td>
		<td>Rp. <?=$this->CodeGenerator->rp($row->harga_beli) ?></td>
		<td>Rp. <?=$this->CodeGenerator->rp($row->harga_jual) ?></td>
		<td><?= $row->stok ?></td>
		
	</tr>
	
	
	
	<?php
	} ?>
	<tr><td colspan="6">Total Asset = Rp. <?=$this->CodeGenerator->rp($totalbeli)?></td></tr>
	<tr><td colspan="6">Total Jika Terjual= Rp. <?=$this->CodeGenerator->rp($totaljual)?></td></tr>
	<tr><td colspan="6">Total Keuntungan Jika Terjual= Rp. <?=$this->CodeGenerator->rp($totaljual-$totalbeli)?></td></tr>
</table>