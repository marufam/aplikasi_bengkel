
<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Laporan
                        </div>
                        <a href="<?=base_url()?>index.php/laporan/laporan_barangprint" target='_blank' class="btn btn-primary" >
                      	<img src="<?=base_url()?>/assets/print.png" width="60px;" > Print</a>
                        <div class="panel-body">
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
</table></div></div></div>