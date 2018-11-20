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
<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Penjualan
                        </div>
                      
                        <div class="panel-body">
    
        <?php if($this->uri->segment(2)=="insert"){
            echo form_open('Penjualan/insert');
        }else{
            echo form_open('Penjualan/update/'.$this->uri->segment(3));
        } ?>
        
	  
        <div class="form-group">
            <label for="int">Kode Jual <?php echo form_error('kode_jual') ?></label>
            <input type="text" class="form-control" name="kode_jual" id="kode_jual" placeholder="Kode Jual" value="<?php echo $kode_jual; ?>" readonly/>
        </div>

        
	    <div class="form-group">
            <label for=>Tanggal Jual <?php echo form_error('tanggal_jual') ?></label>
            <input type="text" class="form-control" name="tanggal_jual" id="tanggal_jual" placeholder="Tanggal Jual" value="<?php echo $tanggal_jual; ?>" />
        </div>
	    <div class="form-group">
            <label for=>Kode Admin <?php echo "hahah".$kode_admin; ?> <?php echo form_error('kode_admin') ?></label>
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
                <option value="<?= $komp->kode_barang ?>"><?= $komp->nama_barang ?></option>
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
                echo anchor(site_url('penjualan_detail/delete/'.$penjualandetail->kode_jual.'/'.$penjualandetail->kode_barang),'Delete','class="btn btn-danger" onclick="javasciprt: return confirm(\'anda yakin ingin menghapus ?\')"'); 
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
	    <div class="form-group col-md-3 pull-right">
            <label for=>Total <?php echo form_error('total') ?></label>
            <input type="hidden" name="totalharga" id="totalharga" value="<?php if($total==""){echo 0;}else{echo $total;} ?>">
            <input type="number" class="form-control" name="total" id="total" placeholder="Total" value="<?php echo $total; ?>" readonly/>
            <!-- <h2 id="total">Total : Rp. <?php echo $this->CodeGenerator->rp($total); ?></h2> -->
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
    