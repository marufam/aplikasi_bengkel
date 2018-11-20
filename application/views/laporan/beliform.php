<div class="row ">
				<div class="col-md-12">
					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-book"></i> Laporan Beli per Bulan
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
							
							<?= form_open('laporan/beli','class="form-inline" role="form"');?>
								<div class="form-group">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<label> Tanggal : </label>
									<input type="date" class="form-control" id='mulai' name="mulai">
								</div>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								
								<input type="submit" name="submit" class='btn btn-default' value="submit">
							</form>
							<hr>
							
							
						</div>
					</div>
					<!-- END SAMPLE FORM PORTLET-->
				</div>
			</div>