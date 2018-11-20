<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Merk
                        </div>
                      
                        <div class="panel-body">
    
        <?php if($this->uri->segment(2)=="insert"){
            echo form_open('Merk/insert');
        }else{
            echo form_open('Merk/update/'.$this->uri->segment(3));
        } ?>
        
	  
        <div class="form-group">
            <label for="text">Kode Merk <?php echo form_error('kode_merk') ?></label>
            <input type="text" class="form-control" name="kode_merk" id="kode_merk" placeholder="Kode Merk" value="<?php echo $kode_merk; ?>" />
        </div>

        
	    <div class="form-group">
            <label for=>Merk <?php echo form_error('merk') ?></label>
            <input type="text" class="form-control" name="merk" id="merk" placeholder="Merk" value="<?php echo $merk; ?>" />
        </div>
	    <div class="form-group">
            <label for="keterangan">Keterangan <?php echo form_error('keterangan') ?></label>
            <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
        </div>
	    <button type="submit" class="btn btn-primary">Simpan</button> 
	    <a href="<?php echo site_url('merk') ?>" class="btn btn-default">Cancel</a>
	</form> </div>
                      
                    </div>
                </div>
    