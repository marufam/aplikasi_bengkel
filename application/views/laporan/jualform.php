
<div class="row">
<div class="col-md-6">
					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-book"></i> Laporan Jual per Bulan
							</div>
							<div class="tools">
								<a href="" class="collapse" data-original-title="" title="">
								</a>
								<a href="" class="reload" data-original-title="" title="">
								</a>
								<a href="" class="remove" data-original-title="" title="">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<br>
							
							<?= form_open('laporan/jual','class="form-inline" role="form"');?>
								<div class="form-group">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<label> Tanggal : </label>
									<input type="date" class="form-control" id='mulai' name="mulai">
								</div>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								
								<button type="submit" class="btn btn-default">Submit</button>
							</form>
							<hr>
							
							
						</div>
					</div>
					<!-- END SAMPLE FORM PORTLET-->
				</div>
    <div class="col-md-6 col-sm-12">
        <!-- BEGIN PORTLET-->
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font-color hide"></i>
                    <span class="caption-subject theme-font-color bold uppercase">Gaji Karyawan</span>
                    <span class="caption-helper "><?= date('d-m-Y') ?></span>
                </div>
               
            </div>
            <div class="portlet-body">
                
                <div class="table-scrollable table-scrollable-borderless">
                    <table class="table table-hover table-light">
                        <thead>
                        <tr class="uppercase">
                            <th >
                                Nama
                            </th>
                            <th>No Telp</th>
                            <th>
                                Gaji
                            </th>
                            <!-- <th>
                                Act
                            </th> -->
                        </tr>
                        </thead>
                        <?php 
$total=0;
                        foreach ($listgaji as $gaji) {
                        ?>
                            <?php if($gaji->ongkos_karyawan<>0){ ?>
                        <tr>
                            <td>
                                <b><?=$gaji->nama_karyawan;?></b>
                            </td>
                            <td><?=$gaji->telp_karyawan;?></td>
                            <td>
                                Rp. <?php echo $this->CodeGenerator->rp($gaji->gaji); $total+=$gaji->gaji;  ?>
                            </td>
                            
                        </tr>
                        <?php
                        } }?>
                    </table>

                </div>
                <hr>
                <div class="row number-stats margin-bottom-30">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="stat-left pull-left">
                            <div class="stat-number">
                                <div class=" theme-font-color bold">
                                    Total gaji seluruh karyawan bulan ini : Rp. <?= $this->CodeGenerator->rp($total)?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PORTLET-->
    </div>
				
			</div>