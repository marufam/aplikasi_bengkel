<script>window.print()</script>
<link href="<?= base_url(); ?>/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<style>
    * {
        font-size: 12px;
    }
</style>
<table class="table" style="width:500px;" >
    <tr>
        <td rowspan="4" width="100"><img alt="" class="img-circle" src="<?=base_url();?>/assets/logo1.png" height='7%'/ ></td>
    </tr>
    <tr>
        <td>No Transaksi</td>
        <td><?php echo $kode_jual; ?></td>
    </tr>
    <tr>
        <td>Tanggal Jual</td>
        <td><?php echo $tanggal_jual; ?></td>
    </tr>
    <tr>
        <td>Pelanggan</td>
        <td><?php echo $pelanggan; ?></td>
    </tr>
    <tr>
        <td colspan="3">
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr><?php $start = 0;
                foreach ($listdetail as $penjualandetail) {
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
        </td>
    </tr>
    <tr>
        <td colspan="3">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-book fa-fw"></i> Ongkos Karyawan
                </div>

                <div class="panel-body">

                    <div class="form-group col-md-12">
                        <label for=>Ongkos Rp <?php echo $this->CodeGenerator->rp($ongkos_karyawan); ?></label><br>
                         <label for=>Keterangan <?php echo $keterangan; ?></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 pull-right" align="right"><b>Total =
                        Rp. <?php echo $this->CodeGenerator->rp($total); ?></b></div>
            </div>
            <div class="row">
                <div class="col-md-10 pull-right" align="right"><b>Bayar =
                        Rp. <?php echo $this->CodeGenerator->rp($bayar); ?></b></div>
            </div>
            <div class="row">
                <div class="col-md-10 pull-right" align="right"><b>Kembali =
                        Rp. <?php echo $this->CodeGenerator->rp($bayar - $total); ?></b></div>
            </div>
        </td>
    </tr>
</table>