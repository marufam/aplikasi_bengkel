
<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Laporan
                        </div>
                        <a href="<?=base_url()?>index.php/laporan/pjualprint/<?=$this->uri->segment(3)?>" target='_blank' class="btn btn-primary" >
                      	<img src="<?=base_url()?>/assets/print.png" width="60px;" > Print</a>
                        <div class="panel-body">
<center><h4>Laporan Penjualan</h4></center>
<center><h4><?= $this->uri->segment(3)?></h4></center>
<table class="table table-bordered table-hover table-striped">
<?php 
$totalbeli=0;
$totaljual=0;
$no=0;foreach ($listjual as $row) {
	?>
	<tr>
		<th>No</th>
		<th>Kode Jual</th>
		<th>Tgl Transaksi</th>
		<th>Ongkos</th>
		<th>Total</th>
	</tr>
	
	<tr>
		<td><?= ++$no ?></td>
		<td><?= $row->kode_jual ?></td>
		<td><?= $row->tanggal_jual ?></td>
		<td><?= $row->ongkos_karyawan ?></td>
		<td>Rp. <?= $this->CodeGenerator->rp($row->total); ?></td>
	</tr>
	<tr>
		<td colspan='5'>
			<table class="table table-bordered">
			<tr>
					<th>Nama Barang</th>
					<th>Harga Beli</th>
					<th>Harga Jual</th>
					<th>Jumlah</th>
					<th>Subtotal</th>
				</tr>
			<?php foreach ($listdetail as $detail) {
				if($row->kode_jual==$detail->kode_jual){
			?>
				
				<tr>
					<td><?= $detail->nama_barang ?></td>
					<td>Rp. <?= $this->CodeGenerator->rp($detail->harga_beli); $totalbeli+=(int)$detail->harga_beli;  ?></td>
					<td>Rp. <?= $this->CodeGenerator->rp($detail->harga_jual); $totaljual+=(int)$detail->harga_jual; ?></td>
					<td><?= $detail->jumlah ?></td>
					<td>Rp. <?= $this->CodeGenerator->rp($detail->subtotal) ?></td>
				</tr>
				<?php
			}} ?>
			</table>
		</td>
	</tr>
	<?php
	} ?>
</table>
<table class="table table-bordered table-hover table-striped">
<tr>
	<td>Total Transaksi : Rp. <?= $this->CodeGenerator->rp($htotal); ?></td>
</tr>
<!-- <tr>
	<td>Pembelian : Rp. <?= $this->CodeGenerator->rp($hbeli); ?></td>
</tr> -->
<tr>
	<td>Penjualan : Rp. <?= $this->CodeGenerator->rp($hjual); ?></td>
</tr>
<tr>
	<td>Total Gaji Karyawan : Rp. <?= $this->CodeGenerator->rp($hgaji); ?></td>
</tr>
<tr>
	<td>Omset Penjualan : Rp. <?= $this->CodeGenerator->rp($byTgl); ?></td>
</tr>
</table></div></div></div>