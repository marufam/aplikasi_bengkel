<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Suplier
                        </div>
                         <div class="panel-body">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('suplier/insert'),'Tambah', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('suplier/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="cari" value="<?php echo $cari; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($cari <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('suplier'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Cari</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-striped table-bordered table-hover" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Suplier</th>
		<th>Alamat Suplier</th>
		<th>No Telp</th>
		<th>Keterangan</th>
		<th>Action</th>
            </tr><?php
            foreach ($suplier_data as $suplier)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $suplier->nama_suplier ?></td>
			<td><?php echo $suplier->alamat_suplier ?></td>
			<td><?php echo $suplier->no_telp ?></td>
			<td><?php echo $suplier->keterangan ?></td>
			<td style="text-align:center" width="250px">
				<?php 
				echo anchor(site_url('suplier/view/'.$suplier->kode_suplier),'Lihat','class="btn btn-info"'); 
				echo anchor(site_url('suplier/update/'.$suplier->kode_suplier),'Edit','class="btn btn-success"'); 
				echo anchor(site_url('suplier/delete/'.$suplier->kode_suplier),'Delete','class="btn btn-danger" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Data : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div></div></div></div>
   