
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-external-link-square"></i> Dashboard
			<div class="panel-tools">
				<a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a>
			</div>
		</div>
		<div class="panel-body">
		
			<table class="table">
				<tr>
					<td colspan='4'>
						<div class="col-sm-12">
							<!--<i class="clip-study circle-icon circle-teal"></i>-->
							<div class="logo">
								<img width='10%' src='<?php echo base_url()."uploads/".get_data_sekolah('logo');?>'/>
								SYSTEM INFORMASI AKADEMIK <?php echo get_data_sekolah('nama_sekolah');?>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td align='right' width='25%'>
						<label class="col-sm-12 control-label">NAMA SEKOLAH :</label>
					</td>
					<td width='40%'>
						<div class="col-sm-12">
							<?php echo get_data_sekolah('nama_sekolah');?>
						</div>
					</td>
					
					<td align='right' width='20%'>
						<label class="col-sm-12 control-label">JUMLAH SISWA (L - P) :</label>
					</td>
					<td width='15%'>
						<div class="col-sm-12">
							<?php echo $jumlah_siswa;?> (<?php echo $jumlah_siswa_l;?> - <?php echo $jumlah_siswa_p;?>)
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label">ALAMAT :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<?php echo get_data_sekolah('alamat_sekolah');?>
						</div>
					</td>
					
					<td align='right'>
						<label class="col-sm-12 control-label">JUMLAH GURU (L - P) :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<?php echo $jumlah_guru;?> (<?php echo $jumlah_guru_l;?> - <?php echo $jumlah_guru_p;?>)
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label">EMAIL :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<?php echo get_data_sekolah('email');?>
						</div>
					</td>
					
					<td align='right'>
						<label class="col-sm-12 control-label">JUMLAH ROMBEL :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<?php echo $jumlah_rombel;?>
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label">TELEPHONE :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<?php echo get_data_sekolah('telpon');?>
						</div>
					</td>
					
					<td align='right'>
						<label class="col-sm-12 control-label">JUMLAH JURUSAN :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<?php echo $jumlah_jurusan;?>
						</div>
					</td>
				</tr>
				
				
				
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label">TAHUN AKADEMIK (SEMESTER) :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<?php echo get_tahun_akademik_aktif('tahun_akademik');?> (Semester <?php echo get_tahun_akademik_aktif('semester_aktif');?>)
						</div>
					</td>
					
					<td align='right'>
						<label class="col-sm-12 control-label">JUMLAH RUANGAN :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<?php echo $jumlah_ruangan;?>
						</div>
					</td>
				</tr>
				
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label">KURIKULUM :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<?php echo get_kurikulum_aktif('nama_kurikulum');?>
						</div>
					</td>
					
					<td align='right'>
						<label class="col-sm-12 control-label">JUMLAH MAPEL :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<?php echo $jumlah_mapel;?>
						</div>
					</td>
				</tr>
			</table>
			
		</div>
	</div>
</div>

<div class="col-md-6">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-bar-chart-o"></i> Data Jurusan
			<div class="panel-tools">
				<a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a>
			</div>
		</div>
		<div class="panel-body">
			<div id="jurusan"></div>
		</div>
	</div>
</div>

<div class="col-md-6">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-bar-chart-o"></i> Data Rombel
			<div class="panel-tools">
				<a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a>
			</div>
		</div>
		<div class="panel-body">
			<div id="rombel"></div>
		</div>
	</div>
</div>

<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>

<script type="text/javascript">
 
$(function(){
	$('#rombel').highcharts({
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false
		},
		title: {
			text: 'DATA ROMBEL'
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.y}</b>'
			//pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b>: {point.y} ',
					//format: '<b>{point.name}</b>: {point.percentage:.1f} %',
					style: {
						color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
					}
				}
			}
		},
		series: [{
			type: 'pie',
			name: 'Jumlah Siswa',
			data: [
				<?php
					// data yang diambil dari database
					if(count($daftarRombel) > 0){
						foreach ($daftarRombel as $data) {
							$daftarSiswa	= $this->Model_siswa->jumlah_siswa_by_rombel($data->id_rombel, get_tahun_akademik_aktif('id_tahun_akademik'));
							echo "['" .$data->nama_rombel . "'," . $daftarSiswa ."],\n";
						}
					}
				?>
			]
		}]
	});
	
	
	
	$('#jurusan').highcharts({
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false
		},
		title: {
			text: 'DATA JURUSAN'
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.y}</b>'
			//pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b>: {point.y} ',
					//format: '<b>{point.name}</b>: {point.percentage:.1f} %',
					style: {
						color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
					}
				}
			}
		},
		series: [{
			type: 'pie',
			name: 'Jumlah Rombel',
			data: [
				<?php
					// data yang diambil dari database
					if(count($daftarJurusan) > 0){
						foreach ($daftarJurusan as $data) {
							$daftarRombel	= $this->Model_rombel->daftar_rombel_by_kd_jurusan($data->kd_jurusan)->num_rows();
							echo "['" .$data->kd_jurusan . "'," . $daftarRombel ."],\n";
						}
					}
				?>
			]
		}]
	});
});
 
</script>