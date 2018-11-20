<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Karyawan
                        </div>
                      
                        <div class="panel-body">
    
        <?php if($this->uri->segment(2)=="insert"){
            echo form_open('Karyawan/insert');
        }else{
            echo form_open('Karyawan/update/'.$this->uri->segment(3));
        } ?>
        
	  
        <div class="form-group">
            <label for="varchar">Kode Karyawan <?php echo form_error('kode_karyawan') ?></label>
            <input type="text" class="form-control" name="kode_karyawan" id="kode_karyawan" placeholder="Kode Karyawan" value="<?php echo $kode_karyawan; ?>" />
        </div>

        
	    <div class="form-group">
            <label for=>Nama Karyawan <?php echo form_error('nama_karyawan') ?></label>
            <input type="text" class="form-control" name="nama_karyawan" id="nama_karyawan" placeholder="Nama Karyawan" value="<?php echo $nama_karyawan; ?>" />
        </div>
	    <div class="form-group">
            <label for="alamat_karyawan">Alamat Karyawan <?php echo form_error('alamat_karyawan') ?></label>
            <textarea class="form-control" rows="3" name="alamat_karyawan" id="alamat_karyawan" placeholder="Alamat Karyawan"><?php echo $alamat_karyawan; ?></textarea>
        </div>
	    <div class="form-group">
            <label for=>Telp Karyawan <?php echo form_error('telp_karyawan') ?></label>
            <input type="text" class="form-control" name="telp_karyawan" id="telp_karyawan" placeholder="Telp Karyawan" value="<?php echo $telp_karyawan; ?>" />
        </div>
        <div class="form-group">
            <label for=>Username <?php echo form_error('username') ?></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
        </div>
        <div class="form-group">
            <label for=>Password <?php echo form_error('password') ?></label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
        </div>
	    <button type="submit" class="btn btn-primary">Simpan</button> 
	    <a href="<?php echo site_url('karyawan') ?>" class="btn btn-default">Cancel</a>
	</form> </div>
                      
                    </div>
                </div>
    