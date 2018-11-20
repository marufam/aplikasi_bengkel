<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Suplier
                        </div>
                      
                        <div class="panel-body">
    
        <?php if($this->uri->segment(2)=="insert"){
            echo form_open('Suplier/insert');
        }else{
            echo form_open('Suplier/update/'.$this->uri->segment(3));
        } ?>
        
	  
        <div class="form-group">
            <label for="text">Kode Suplier <?php echo form_error('kode_suplier') ?></label>
            <input type="text" class="form-control" name="kode_suplier" id="kode_suplier" placeholder="Kode Suplier" value="<?php echo $kode_suplier; ?>" />
        </div>

        
	    <div class="form-group">
            <label for=>Nama Suplier <?php echo form_error('nama_suplier') ?></label>
            <input type="text" class="form-control" name="nama_suplier" id="nama_suplier" placeholder="Nama Suplier" value="<?php echo $nama_suplier; ?>" />
        </div>
	    <div class="form-group">
            <label for="alamat_suplier">Alamat Suplier <?php echo form_error('alamat_suplier') ?></label>
            <textarea class="form-control" rows="3" name="alamat_suplier" id="alamat_suplier" placeholder="Alamat Suplier"><?php echo $alamat_suplier; ?></textarea>
        </div>
	    <div class="form-group">
            <label for=>No Telp <?php echo form_error('no_telp') ?></label>
            <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="No Telp" value="<?php echo $no_telp; ?>" />
        </div>
	    <div class="form-group">
            <label for="keterangan">Keterangan <?php echo form_error('keterangan') ?></label>
            <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
        </div>
	    <button type="submit" class="btn btn-primary">Simpan</button> 
	    <a href="<?php echo site_url('suplier') ?>" class="btn btn-default">Cancel</a>
	</form> </div>
                      
                    </div>
                </div>
    