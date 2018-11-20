
<div class="row margin-top-10">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2">
            <div class="display">
                <div class="number">
                    <h4 class="font-green-sharp">Rp. <?= $this->CodeGenerator->rp($semua); ?>
                    </h4>
                    <small>TOTAL OMSET</small>
                </div>
                <div class="icon">
                    <i class="icon-pie-chart"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
                                <span style="width: 100%;" class="progress-bar progress-bar-success green-sharp">
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2">
            <div class="display">
                <div class="number">
                    <h4 class="font-red-haze">Rp. <?= $this->CodeGenerator->rp($byTgl); ?></h4>
                    <small>Omset Bulan ini</small>
                </div>
                <div class="icon">
                    <i class="icon-like"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
                                <span style="width: 100%;" class="progress-bar progress-bar-success red-haze">
                                
                </div>
                <div class="status">
                    <div class="status-title">
                        Tanggal
                    </div>
                    <div class="status-number">
                       <?=date('d-m-Y');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2">
            <div class="display">
                <div class="number">
                    <h3 class="font-blue-sharp"><?=$totaltr?></h3>
                    <small>Barang terjual</small>
                </div>
                <div class="icon">
                    <i class="icon-basket"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
                                <span style="width: 100%;" class="progress-bar progress-bar-success blue-sharp">
                                
                </div>
                
            </div>
        </div>
    </div>
    <?php $total1=0; foreach ($listgaji as $gaji) {
                        ?>
                            <?php if($gaji->ongkos_karyawan<>0){ ?>
                               <?php $total1+=$gaji->gaji;  ?>
                        <?php
                        } }?>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2">
            <div class="display">
                <div class="number">
                    <h4 class="font-purple-soft">Rp. <?= $this->CodeGenerator->rp($total1)?></h4>
                    <small>Total Service</small>
                </div>
                <div class="icon">
                    <i class="icon-user"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
                                <span style="width: 100%;" class="progress-bar progress-bar-success purple-soft">
                                
                </div>
               <div class="status">
                    <div class="status-title">
                        Tanggal
                    </div>
                    <div class="status-number">
                       <?=date('d-m-Y');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-8 col-sm-12">
        <script>
function sum() {
      var txtFirstNumberValue = document.getElementById('ongkos_karyawan').value;
      var txtSecondNumberValue = document.getElementById('totalharga').value;
      var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue);
      if (!isNaN(result)) {
         document.getElementById('total').value = result;
      }
}
</script>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Penjualan
                        </div>
                      
                        <div class="panel-body">
    
        <?php 
            echo form_open('Penjualan/insert/1');
        ?>
        
      
        <div class="form-group">
            <label for="int">Kode Jual <?php echo form_error('kode_jual') ?></label>
            <input type="text" class="form-control" name="kode_jual" id="kode_jual" placeholder="Kode Jual" value="<?php echo $kode_jual; ?>" readonly/>
        </div>

        
        <div class="form-group">
            <label for=>Tanggal Jual <?php echo form_error('tanggal_jual') ?></label>
            <input type="text" class="form-control" name="tanggal_jual" id="tanggal_jual" placeholder="Tanggal Jual" value="<?php echo $tanggal_jual; ?>" />
        </div>
        <div class="form-group">
            <label for=>Kode Admin <?php echo form_error('kode_admin') ?></label>
            <input type="text" class="form-control" name="kode_admin" id="kode_admin" placeholder="Kode Admin" value="<?php echo $kode_admin; ?>" readonly />
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
                            <i class="fa fa-book fa-fw"></i> List Barang
                        </div>
                      
                        <div class="panel-body">
        <div class="form-group col-md-5 col-lg-5">
            <label for="">Barang</label>
           <select name="kode_barang" class="form-control" placeholder="kode_barang">
            <?php foreach ($listbarang as $komp) {
              if($kode_barang==$komp->kode_barang){
            ?>
                <option value="<?= $komp->kode_barang ?>"><?= $komp->nama_barang ?></option>
            <?php
             } }
             foreach ($listbarang as $komp) {
             if($kode_barang<>$komp->kode_barang){
                ?>
                <option value="<?= $komp->kode_barang ?>"><?= $komp->nama_barang ?> [<?= $komp->merk ?>]</option>
                <?php
             }
         }
            
             ?>
            </select>
        </div>
        <div class="form-group col-md-2 col-lg-2">
            <label for=>Jumlah<?php echo form_error('jumlah') ?></label>
            <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Kode Admin" value="1"/>
        </div>
         <div class="form-group col-md-5 col-lg-5">
           <br>
            <input type="submit" class="btn btn-info" name="submitlist" value="Tambah"/>
        </div>

        <table class="table table-bordered table-hover table-striped" >
                 <tr>
                <th>No</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Subtotal</th>
        <th></th>
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
            <td style="text-align:center" width="50px">
                <?php 
                echo anchor(site_url('penjualan_detail/delete/'.$penjualandetail->kode_jual.'/'.$penjualandetail->kode_barang.'/1'),'Delete','class="btn btn-danger" onclick="javasciprt: return confirm(\'anda yakin ingin menghapus ?\')"'); 
                ?>
            </td>
        </tr>
                <?php
            }
            ?>

        </table>
        </div><!----pane body-->
        </div>
       
         <div class="panel panel-default">
          <div class="panel-heading">
                            <i class="fa fa-book fa-fw"></i> Ongkos Karyawan
                        </div>
                      
                        <div class="panel-body">
        <div class="form-group col-md-4">
            <label for=>Kode Karyawan <?php echo form_error('kode_karyawan') ?></label>
            <!-- <input type="text" class="form-control" name="kode_karyawan" id="kode_karyawan" placeholder="Kode Karyawan" value="<?php echo $kode_karyawan; ?>" /> -->
            <select name="kode_karyawan" class="form-control" placeholder="kode_karyawan">
            <option value="">-Pilih-</option>
            <?php foreach ($listkaryawan as $komp) {
              if($kode_karyawan==$komp->kode_karyawan){
            ?>
                <option value="<?= $komp->kode_karyawan ?>"><?= $komp->nama_karyawan ?></option>
            <?php
             } }
             foreach ($listkaryawan as $komp) {
             if($kode_karyawan<>$komp->kode_karyawan){
                ?>
                <option value="<?= $komp->kode_karyawan ?>"><?= $komp->nama_karyawan ?></option>
                <?php
             }
         }
            
             ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="keterangan">Keterangan <?php echo form_error('keterangan') ?></label>
            <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
        </div>
        <div class="form-group col-md-4">
            <label for=>Ongkos Karyawan <?php echo form_error('ongkos_karyawan') ?></label>
            <input type="number" class="form-control" name="ongkos_karyawan" id="ongkos_karyawan" placeholder="Ongkos Karyawan" value="<?php echo $ongkos_karyawan; ?>" onkeyup="sum();" />
        </div>
        <div class="form-group col-md-4">
            <label for=>Pelanggan <?php echo form_error('pelanggan') ?></label>
            <input type="text" class="form-control" name="pelanggan" id="pelanggan" placeholder="Nama Pelanggan" value="<?php echo $pelanggan; ?>" />
        </div>
        </div>
</div>
        <div class="col-md-12">
        <div class="form-group col-md-6 pull-right">
            <label for=>Total <?php echo form_error('total') ?></label>
            <input type="hidden" name="totalharga" id="totalharga" value="<?php if($total==""){echo 0;}else{echo $total;} ?>">
            <input type="number" class="form-control col-md-6" name="total" style="font-size:25px; height:50px; background:none;" id="total" placeholder="Total" value="<?php echo $total; ?>" readonly/>
            <!-- <h2 id="total">Total : Rp. <?php echo $this->CodeGenerator->rp($total); ?></h2> -->
        </div>
        </div>
        <div class="col-md-12">
        <div class="form-group col-md-6 pull-right">
            <label for=><input type="checkbox" class="form-control col-md-6" name="cetak"/> Cetak Struk </label>
        </div>
        </div>
        <div class="col-md-12">
        <div class="form-group col-md-3 pull-right">
            <!-- <label for=>Bayar <?php echo form_error('bayar') ?></label> -->
            <input type="hidden" class="form-control" name="bayar" id="bayar" placeholder="Bayar" value="<?php echo $bayar; ?>" />
        </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button> 
        <a href="<?php echo site_url('penjualan') ?>" class="btn btn-default">Cancel</a>
    </form> </div>
                      
                    </div>
                
    
    </div>
    <?= form_open('home/transaksi', 'class="form-horizontal" role="form"');?>
    <div class="col-md-4 col-sm-4">
        <!-- BEGIN PORTLET-->
        <div class="portlet light tasks-widget">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font-color hide"></i>
                    <span class="caption-subject theme-font-color bold uppercase">Service</span>

                </div>
            </div>
            <div class="portlet-body">
                <div class="task-content">
                   
                    <div class="portlet-body form">
                       <span><h5><?=$pesan?></h5></span>
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Karyawan</label>
                                    <div class="col-md-9">
                                        <select name="kode_karyawan" class="form-control" placeholder="kode_karyawan">
                                            <option value="">-Pilih-</option>
                                            <?php foreach ($listkaryawan as $komp) {
                                                if ($kode_karyawan == $komp->kode_karyawan) {
                                                    ?>
                                                    <option
                                                        value="<?= $komp->kode_karyawan ?>"><?= $komp->nama_karyawan ?></option>
                                                    <?php
                                                }
                                            }
                                            foreach ($listkaryawan as $komp) {
                                                if ($kode_karyawan <> $komp->kode_karyawan) {
                                                    ?>
                                                    <option
                                                        value="<?= $komp->kode_karyawan ?>"><?= $komp->nama_karyawan ?></option>
                                                    <?php
                                                }
                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Keterangan</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" rows="3" placeholder="Keterangan " name="keterangan"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Ongkos</label>
                                    <div class="col-md-9">
                                        <input type="number" name="ongkos" class="form-control" placeholder="Ongkos ">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Pelanggan</label>
                                    <div class="col-md-9">
                                        <input type="text" name="pelanggan" class="form-control" placeholder="Pelanggan ">
                                    </div>
                                </div>

                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">Submit</button>
                                        <button type="reset" class="btn default">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- END PORTLET-->
    </div>
    <?= form_close(); ?>
</div>
<!-- END PAGE CONTENT INNER