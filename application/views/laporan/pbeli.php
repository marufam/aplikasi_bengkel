
<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Laporan
                        </div>
                        <a href="<?=base_url()?>index.php/laporan/pbeliprint/<?=$this->uri->segment(3)?>" target='_blank' class="btn btn-primary" >
                      	<img src="<?=base_url()?>/assets/print.png" width="60px;" > Print</a>
                        <div class="panel-body">
<center><h4>Laporan Pembelian</h4></center>
<center><h4><?= $this->uri->segment(3)?></h4></center>
<table class="table table-bordered table-hover table-striped">
<?php $no=0;foreach ($listbeli as $row) {
	?>
	<tr>
		<th>No</th>
		<th>Kode Beli</th>
		<th>Tgl Transaksi</th>
		<th>Total</th>
	</tr>
	
	<tr>
		<td><?= ++$no ?></td>
		<td><?= $row->kode_beli ?></td>
		<td><?= $row->tanggal_beli ?></td>
		<td>Rp. <?= $this->CodeGenerator->rp($row->total) ?></td>
	</tr>
	<tr>
		<td colspan='4'>
			<table class="table table-bordered">
			<tr>
					<th>Nama Barang</th>
					<th>Harga Beli</th>
					<th>Jumlah</th>
					<th>Subtotal</th>
				</tr>
			<?php foreach ($listdetail as $detail) {
				if($row->kode_beli==$detail->kode_beli){
			?>
				
				<tr>
					<td><?= $detail->nama_barang ?></td>
					<td>Rp. <?= $this->CodeGenerator->rp($detail->harga_beli) ?></td>
					<td><?= $detail->jumlah ?></td>
					<td>Rp. <?= $this->CodeGenerator->rp($detail->subtotal) ?></td>
				</tr>
				<?php
			}} ?>
			</table>
		</td>
	</tr>
	
	<tr>
	<td colspan='4'></td>
	</tr>
	<tr>
		<td colspan='4'>Total : Rp.<?= $this->CodeGenerator->rp($hbeli); ?></td>
	</tr>
	<?php
	} ?>
</table></div></div></div>