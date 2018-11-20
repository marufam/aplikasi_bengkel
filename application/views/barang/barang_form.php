<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Barang
                        </div>
                      
                        <div class="panel-body">
    
        <?php if($this->uri->segment(2)=="insert"){
            echo form_open('Barang/insert');
        }else{
            echo form_open('Barang/update/'.$this->uri->segment(3));
        } ?>
        
	  
        <div class="form-group">
            <label for="text">Kode Barang <?php echo form_error('kode_barang') ?></label>
            <input type="text" class="form-control" name="kode_barang" id="kode_barang" placeholder="Kode Barang" value="<?php echo $kode_barang; ?>" />
        </div>

        
	    <div class="form-group">
            <label for=>Nama Barang <?php echo form_error('nama_barang') ?></label>
            <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang" value="<?php echo $nama_barang; ?>" />
        </div>
	    <div class="form-group">
            <label for=>Kode Merk <?php echo form_error('kode_merk') ?></label>
            <select name="kode_merk" class="form-control" placeholder="kode_merk">
            <?php foreach ($listmerk as $komp) {
              if($kode_merk==$komp->kode_merk){
            ?>
                <option value="<?= $komp->kode_merk ?>"><?= $komp->kode_merk." ".$komp->merk ?></option>
            <?php
             } }
             foreach ($listmerk as $komp) {
             if($kode_merk<>$komp->kode_merk){
                ?>
                <option value="<?= $komp->kode_merk ?>"><?= $komp->kode_merk." ".$komp->merk ?></option>
                <?php
             }
         }
            
             ?>
            </select>
        </div>
	    <div class="form-group">
            <label for=>Harga Beli <?php echo form_error('harga_beli') ?></label>
            <input type="number" class="form-control" name="harga_beli" id="harga_beli" placeholder="Harga Beli" value="<?php echo $harga_beli; ?>" />
        </div>
	    <div class="form-group">
            <label for=>Harga Jual <?php echo form_error('harga_jual') ?></label>
            <input type="number" class="form-control" name="harga_jual" id="harga_jual" placeholder="Harga Jual" value="<?php echo $harga_jual; ?>" />
        </div>
	    <div class="form-group">
            <label for=>Stok <?php echo form_error('stok') ?></label>
            <input type="number" class="form-control" name="stok" id="stok" placeholder="Stok" value="<?php echo $stok; ?>" />
        </div>
	    <div class="form-group">
            <label for="keterangan">Keterangan <?php echo form_error('keterangan') ?></label>
            <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
        </div>
	    <button type="submit" class="btn btn-primary">Simpan</button> 
	    <a href="<?php echo site_url('barang') ?>" class="btn btn-default">Cancel</a>
	</form> </div>
                      
                    </div>
                </div>
    