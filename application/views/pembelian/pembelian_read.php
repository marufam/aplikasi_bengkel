<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Pembelian
                        </div>
                         <div class="panel-body">
       
        <table class="table">
	    <tr><td>Kode Beli</td><td><?php echo $kode_beli; ?></td></tr>
	    <tr><td>Tanggal Beli</td><td><?php echo $tanggal_beli; ?></td></tr>
	    <tr><td>Kode Admin</td><td><?php echo $kode_admin; ?></td></tr>
        <tr><td>Kode Suplier</td><td><?php echo $kode_suplier; ?></td></tr>
	    <table class="table table-bordered table-hover table-striped" >
                 <tr>
                <th>No</th>
        <th>Nama Barang</th>
        <th>Harga Beli</th>
        <th>Jumlah</th>
        <th>Subtotal</th>
            </tr><?php $start=0;
            foreach ($listdetail as $pembelian_detail)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $pembelian_detail->nama_barang ?></td>
            <td><?php echo $pembelian_detail->harga_beli ?></td>
            <td><?php echo $pembelian_detail->jumlah ?></td>
            <td>Rp. <?php echo $this->CodeGenerator->rp($pembelian_detail->subtotal) ?></td>
        </tr>
                <?php
            }
            ?>

        </table>
        <div class="form-group pull-right">
        <?php if($this->uri->segment(2)=="insert"){ ?>
            <label for=""><h1>Total : Rp. <?= $this->CodeGenerator->rp($this->Pembelian_detail_model->totalall($this->CodeGenerator->buatkode('pembelian','kode_beli',10,'TRB')));?></h1></label>
            <?php }else{ ?>
        <label for=""><h1>Total : Rp. <?= $this->CodeGenerator->rp($this->Pembelian_detail_model->totalall($this->uri->segment(3)));?></h1></label>
        <?php } ?>
        </div>
	    
	    <tr><td></td><td><a href="<?php echo site_url('pembelian') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table></div></div></div>
       