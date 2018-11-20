<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Pembelian_detail
                        </div>
                         <div class="panel-body">
       
        <table class="table">
	    <tr><td>Kode Beli</td><td><?php echo $kode_beli; ?></td></tr>
	    <tr><td>Kode Barang</td><td><?php echo $kode_barang; ?></td></tr>
	    <tr><td>Harga Beli</td><td><?php echo $harga_beli; ?></td></tr>
	    <tr><td>Jumlah</td><td><?php echo $jumlah; ?></td></tr>
	    <tr><td>Subtotal</td><td><?php echo $subtotal; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('pembelian_detail') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table></div></div></div>
       