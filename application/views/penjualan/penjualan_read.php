<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Penjualan
                        </div>
                         <div class="panel-body">
       
        <table class="table">
	    <tr><td>Kode Jual</td><td><?php echo $kode_jual; ?></td></tr>
	    <tr><td>Tanggal Jual</td><td><?php echo $tanggal_jual; ?></td></tr>
	    <tr><td>Kode Admin</td><td><?php echo $kode_admin; ?></td></tr>
	    
        <table class="table table-bordered table-hover table-striped" >
                 <tr>
                <th>No</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Subtotal</th>
            </tr><?php $start=0;
            foreach ($listdetail as $penjualandetail)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $penjualandetail->nama_barang ?></td>
            <td><?php echo $penjualandetail->harga_jual ?></td>
            <td><?php echo $penjualandetail->jumlah ?></td>
            <td>Rp. <?php echo $this->CodeGenerator->rp($penjualandetail->subtotal) ?></td>
            
        </tr>
                <?php
            }
            ?>

        </table>
      
       
         <div class="panel panel-default">
          <div class="panel-heading">
                            <i class="fa fa-book fa-fw"></i> Ongkos Karyawan
                        </div>
                      
                        <div class="panel-body">
	    <div class="form-group col-md-4">
            <label for=>Kode Karyawan : <?php echo $kode_karyawan; ?></label>            
        </div>
	    <div class="form-group col-md-4">
            <label for="keterangan">Keterangan : <?= $keterangan; ?></label>
           
        </div>
	    <div class="form-group col-md-4">
            <label for=>Ongkos Karyawan <?php echo $ongkos_karyawan; ?></label>
        </div>
        
        </div>
</div>
<div class="row">
        <div class="col-md-4 pull-right"><b>Total = Rp. <?php echo $this->CodeGenerator->rp($total); ?></b></div></div>
        <!-- <div class="row">
        <div class="col-md-4 pull-right"><b>Bayar = Rp. <?php echo $this->CodeGenerator->rp($bayar); ?></b></div>
        </div> -->
	    <tr><td>Total</td><td></td></tr>
	    <tr><td>Bayar</td><td></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('penjualan') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table></div></div></div>
       