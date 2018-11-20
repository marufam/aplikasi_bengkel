<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-bell fa-fw"></i> Barang
		</div>
		<div class="panel-body">

			<table class="table">
				<tr><td>Kode Barang</td><td><?php echo $kode_barang; ?></td></tr>
				<tr><td>Nama Barang</td><td><?php echo $nama_barang; ?></td></tr>
				<tr><td>Kode Merk</td><td><?php echo $kode_merk; ?></td></tr>
				<tr><td>Harga Beli</td><td><?php echo $harga_beli; ?></td></tr>
				<tr><td>Harga Jual</td><td><?php echo $harga_jual; ?></td></tr>
				<tr><td>Stok</td><td><?php echo $stok; ?></td></tr>
				<tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
			</table>


			<div class="portlet light tasks-widget">
				<div class="portlet-title">
					<div class="caption caption-md">
						<i class="icon-bar-chart theme-font-color hide"></i>
						<span class="caption-subject theme-font-color bold uppercase">Peramalan</span>

					</div>
				</div>
				<div class="portlet-body">
					<div class="task-content">

						<div class="portlet-body form">
							<span><h5></h5></span>
							<div class="form-body">
								<?=form_open('Ramal_harga/peramalan/'.$this->uri->segment(3));?>
									<div class="form-group">
										<label class="col-md-1 control-label">Bulan</label>
										<div class="col-md-3">
											<select name="data_bulan" class="form-control" placeholder="data_bulan">
												<option value="01">Januari</option>
												<option value="02">Februari</option>
												<option value="03">Maret</option>
												<option value="04">April</option>
												<option value="05">Mei</option>
												<option value="06">Juni</option>
												<option value="07">Juli</option>
												<option value="08">Agustus</option>
												<option value="09">September</option>
												<option value="10">Oktober</option>
												<option value="11">November</option>
												<option value="12">Desember</option>
											</select>
										</div>
										<label class="col-md-1 control-label">Data Tahun</label>
										<div class="col-md-3">
											<select name="data_tahun" class="form-control" placeholder="data_tahun">
												<?php for ($i=2009; $i < 2019; $i++) { 
													?>
														<option value="<?=$i?>"><?=$i?></option>
													<?php
												} ?>
											</select>
										</div>
										
										<!-- <label class="col-md-1 control-label">Alpha</label> -->
										<div class="col-md-2">
											<input type="hidden" class="form-control" name="alpha" value="0.2">
										</div>
										<div class="col-md-1">
											<input type="submit" name="lihat" class="btn btn-success" value="Lihat">
										</div>
										<br><br>
									</div>
								</form>

								<table class="table table-responsive table-bordered">
									<thead>
									<tr>
										<th>No</th>
										<th>Bulan</th>
										<th>Tahun</th>
										<th>Jumlah</th>
										<th>Ramal Jumlah</th>
										<th>Jumlah Ril data</th>
									</tr>
									</thead>
									<?php if(!isset($_POST['lihat'])){ ?>
									<tbody>
									<tr>
										<td colspan="7">Submit tahun</td>
									</tr>
									</tbody>
									<?php }else{ $no=1;
										// var_dump($data->data);
										if($listdata[0]['harga_beli']!=null){
										foreach ($listdata as $data) {
											$merk[] = substr($data['ril'], 0,4);
											$merk[] = substr($data['MAPE'], 0,4);
										?>	
									<tbody>
									<tr>
										<td><?=$no++;?></td>
										<td><?php
										if($data['bulan']=="1"){ echo "Januari"; }elseif($data['bulan']=="2"){ echo "Februari"; }elseif($data['bulan']=="3"){ echo "Maret"; }elseif($data['bulan']=="4"){ echo "April"; }elseif($data['bulan']=="5"){ echo "Mei"; }elseif($data['bulan']=="6"){ echo "Juni"; }elseif($data['bulan']=="7"){ echo "Juli"; }elseif($data['bulan']=="8"){ echo "Agustus"; }elseif($data['bulan']=="9"){ echo "September"; }elseif($data['bulan']=="10"){ echo "Oktober"; }elseif($data['bulan']=="11"){ echo "November"; }elseif($data['bulan']=="12"){ echo "Desember"; }
										$bulan[]=$data['bulan']; ?></td>
										<td><?=$data['tahun']?> <?php $tahun[]=$data['tahun']; ?></td>
										<td><?=$data['harga_beli']?> <?php $jumlah[]=$data['harga_beli']; ?></td>
										<td><?= round($data['ramal']) ?><?php $ramal[]=$data['ramal']; ?></td>
										<td><?=$data['tahun_yang_diramal']?> <?php $jumlah2[]=$data['tahun_yang_diramal']; ?> </td>
								
									</tr>
									</tbody>
									<?php }  }else{
										?>
										<tbody>
											<tr>
												<td colspan="8">Null</td>
											</tr>
										</tbody>
										<?php
									} } ?>							
								</table>
							</div>
							<br><br><br><br><br>
							<canvas id="canvas" width="1000" height="500"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div></div>

		
	</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js" type="text/javascript"></script>
<script>
var ctx = document.getElementById("canvas").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($bulan);?>,
        datasets: [{
            label: 'Data Peramalan',
            data: <?php echo json_encode($jumlah);?>,
            backgroundColor: ['rgba(0,255,0,254)'],
            fill : false,
            borderColor: [
                'rgba(0,255,0,254)'
            ],
            borderWidth: 1
        },
        {
            label: 'Hasil Peramalan',
            data: <?php echo json_encode($ramal);?>,
            backgroundColor: ['rgba(255,0,0,254)'],
            fill : false,
            borderColor: [
                'rgba(255,0,0,254)'
            ],
            borderWidth: 1
        },
        {
            label: 'Jumlah yang diramal',
            data: <?php echo json_encode($jumlah2);?>,
            backgroundColor: ['rgba(0,0,255,254)'],
            fill : false,
            borderColor: [
                'rgba(0,0,255,254)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>