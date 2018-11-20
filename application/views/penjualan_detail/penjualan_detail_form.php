<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Penjualan_detail
                        </div>
                      
                        <div class="panel-body">
    
        <?php if($this->uri->segment(2)=="insert"){
            echo form_open('Penjualan_detail/insert');
        }else{
            echo form_open('Penjualan_detail/update/'.$this->uri->segment(3));
        } ?>
        
	  
        <div class="form-group">
            <label for="double"> <?php echo form_error('') ?></label>
            <input type="text" class="form-control" name="" id="" placeholder="" value="<?php echo $; ?>" />
        </div>

        
	    <div class="form-group">
            <label for=>Kode Jual <?php echo form_error('kode_jual') ?></label>
            <input type="text" class="form-control" name="kode_jual" id="kode_jual" placeholder="Kode Jual" value="<?php echo $kode_jual; ?>" />
        </div>
	    <div class="form-group">
            <label for=>Kode Barang <?php echo form_error('kode_barang') ?></label>
            <input type="text" class="form-control" name="kode_barang" id="kode_barang" placeholder="Kode Barang" value="<?php echo $kode_barang; ?>" />
        </div>
	    <div class="form-group">
            <label for=>Harga Jual <?php echo form_error('harga jual') ?></label>
            <input type="number" class="form-control" name="harga jual" id="harga jual" placeholder="Harga Jual" value="<?php echo $harga jual; ?>" />
        </div>
	    <div class="form-group">
            <label for=>Harga Beli <?php echo form_error('harga_beli') ?></label>
            <input type="number" class="form-control" name="harga_beli" id="harga_beli" placeholder="Harga Beli" value="<?php echo $harga_beli; ?>" />
        </div>
	    <div class="form-group">
            <label for=>Jumlah <?php echo form_error('jumlah') ?></label>
            <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah" value="<?php echo $jumlah; ?>" />
        </div>
	    <button type="submit" class="btn btn-primary">Simpan</button> 
	    <a href="<?php echo site_url('penjualan_detail') ?>" class="btn btn-default">Cancel</a>
	</form> </div>
                      
                    </div>
                </div>
    