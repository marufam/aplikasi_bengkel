<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Admin
                        </div>
                      
                        <div class="panel-body">
    
        <?php if($this->uri->segment(2)=="insert"){
            echo form_open('Admin/insert');
        }else{
            echo form_open('Admin/update/'.$this->uri->segment(3));
        } ?>
        
	  
        <div class="form-group">
            <label for="varchar">Kode Admin <?php echo form_error('kode_admin') ?></label>
            <input type="text" class="form-control" name="kode_admin" id="kode_admin" placeholder="Kode Admin" value="<?php echo $kode_admin; ?>" />
        </div>

        
	    <div class="form-group">
            <label for=>Nama Admin <?php echo form_error('nama_admin') ?></label>
            <input type="text" class="form-control" name="nama_admin" id="nama_admin" placeholder="Nama Admin" value="<?php echo $nama_admin; ?>" />
        </div>
	    <div class="form-group">
            <label for=>Username <?php echo form_error('username') ?></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
        </div>
	    <div class="form-group">
            <label for=>Psswd <?php echo form_error('psswd') ?></label>
            <input type="text" class="form-control" name="psswd" id="psswd" placeholder="Psswd" value="<?php echo $psswd; ?>" />
        </div>
	    <button type="submit" class="btn btn-primary">Simpan</button> 
	    <a href="<?php echo site_url('admin') ?>" class="btn btn-default">Cancel</a>
	</form> </div>
                      
                    </div>
                </div>
    