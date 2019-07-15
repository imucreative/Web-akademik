<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <table class="table">
        <tr>
			<td align='right' width="20%">NIS :</td>
			<td width="30%"><?php echo $siswa['nis'];?></td>
			
			<td align='right' width="20%">KELAS :</td>
			<td width="30%"><?php echo $siswa['nama_rombel'];?></td>
		</tr>
        <tr>
			<td align='right'>NAMA :</td>
			<td><?php echo $siswa['nama_siswa'];?></td>
			
			<td align='right'>TAHUN AKADEMIK :</td>
			<td><?php echo get_tahun_akademik_aktif('tahun_akademik');?></td>
		</tr>
        <tr>
			<td align='right'>JURUSAN :</td>
			<td><?php echo $siswa['nama_jurusan'];?></td>
			
			<td align='right'>SEMESTER :</td>
			<td><?php echo get_tahun_akademik_aktif('semester_aktif');?></td>
		</tr>
		<?php
			if(get_tahun_akademik_aktif('semester_aktif') == 2){
		?>
		<tr>
			<td></td>
			<td>
				<?php
					if($siswa['kelas'] == get_data_sekolah('id_jenjang_sekolah')){
				?>
						<a href="#kelulusan" data-toggle="modal" class="btn btn-primary status_kelulusan" >
							<i class="clip-checkmark"></i> Status Kelulusan
						</a>
				<?php
					}else{
				?>
						<a href="#naik_kelas" data-toggle="modal" class="btn btn-primary status_kenaikan_kelas" >
							<i class="clip-checkmark"></i> Status Kenaikan Kelas
						</a>
				<?php
					}
				?>
			</td>
			
			<td align='right'>STATUS :</td>
			<td>
				<?php
					if($siswa['kelas'] == get_data_sekolah('id_jenjang_sekolah')){
						$id_status_kelulusan	= $siswa['status_kelulusan'];
						if(($id_status_kelulusan == "") || ($id_status_kelulusan == "LULUS")){
							echo "<div class='label label-success'>
								<i class='clip-checkmark'></i> <strong>LULUS</strong>
							</div>";
						}else{
							echo "<div class='label label-danger'>
								<i class='clip-checkmark'></i> <strong>TIDAK LULUS</strong>
							</div>";
						}
					}else{
						$id_status_naik_kelas	= $siswa['id_status_naik_kelas'];
						$status_naik_kelas		= get_data_status_naik_kelas('status_naik_kelas', $id_status_naik_kelas);
						if($id_status_naik_kelas == "1"){
							echo "<div class='label label-success'>
								<i class='clip-checkmark'></i> <strong>$status_naik_kelas</strong>
							</div>";
						}else if($id_status_naik_kelas == "2"){
							echo "<div class='label label-warning'>
								<i class='clip-checkmark'></i> <strong>$status_naik_kelas</strong>
							</div>";
						}else if($id_status_naik_kelas == "3"){
							echo "<div class='label label-danger'>
								<i class='clip-checkmark'></i> <strong>$status_naik_kelas</strong>
							</div>";
						}else{
							echo "<div class='label label-danger'>
								<i class='clip-checkmark'></i> <strong>$status_naik_kelas</strong>
							</div>";
						}
					}
				?>
			</td>
		</tr>
		<?php
			}
		?>
		
    </table>
    <!-- end: DYNAMIC TABLE PANEL -->
</div>

<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-external-link-square"></i> Daftar Raport Siswa
            <div class="panel-tools"></div>
        </div>
        <div class="panel-body">
			<table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th width='5%'><center>NO</center></th>
						<th width='30%'><center>MATA PELAJARAN</center></th>
						<th width='7%'><center>KKM</center></th>
						<th width='7%'><center>ANGKA</center></th>
						<th width='20%'><center>HURUF</center></th>
						<th width='12%'><center>KETERCAPAIAN</center></th>
						<th width='20%'><center>DESKRIPSI</center></th>
					</tr>
				</thead>
				<?php
					$no=1;
					foreach ($mapel as $m){
						$nilai				= chek_nilai($siswa['nis'], $m->id_jadwal, 'nilai');
						$deskripsi			= chek_nilai($siswa['nis'], $m->id_jadwal, 'deskripsi');
						if(empty($deskripsi)){
							$desk	= "";
						}else{
							$desk	= $deskripsi;
						}
				?>
				
					<tr>
						<td align="center"><?php echo $no;?></td>
						<td><?php echo $m->nama_mapel;?></td>
						<td align="center"><?php echo $m->kkm;?></td>
						<td align="center"><?php echo $nilai;?></td>
						<td align="center"><?php echo Terbilang($nilai);?></td>
						<td align="center"><?php echo ketercapaian_kopetensi($nilai);?></td>
						<td><?php echo $desk;?></td>
					</tr>
				<?php
						$no++;
					}
				?>
				
					
			</table>
		</div>
	</div>
	<!-- end: DYNAMIC TABLE PANEL -->
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.0/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.js"></script>

<div id="naik_kelas" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
	<?php echo form_open('raport/save_status_naik_kelas');?>
	<input type="hidden" value="<?php echo $siswa['nis'];?>" name="nis"/>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title">Status Naik Kelas</h4>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-6">
				<p><label class="radio-inline">
					<input type="radio" class="square-green" value="1" name="status_naik_kelas" required > Naik Kelas
				</label></p>
				<p><label class="radio-inline">
					<input type="radio" class="square-green" value="3" name="status_naik_kelas" required > Dikeluarkan
				</label></p>
			</div>
			<div class="col-md-6">
				<p><label class="radio-inline">
					<input type="radio" class="square-green" value="2" name="status_naik_kelas" required > Tinggal Kelas
				</label></p>
				<p><label class="radio-inline">
					<input type="radio" class="square-green" value="4" name="status_naik_kelas" required > Naik tapi dikeluarkan
				</label></p>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default"><i class="clip-close"></i> Close</button>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
	</div>
	<?php echo form_close();?>
</div>

<div id="kelulusan" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
	<?php echo form_open('raport/save_status_kelulusan');?>
	<input type="hidden" value="<?php echo $siswa['nis'];?>" name="nis"/>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title">Status Kelulusan</h4>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-6">
				<p><label class="radio-inline">
					<input type="radio" class="square-green" value="LULUS" name="status_kelulusan" required /> LULUS
				</label></p>
			</div>
			<div class="col-md-6">
				<p><label class="radio-inline">
					<input type="radio" class="square-green" value="TIDAK LULUS" name="status_kelulusan" required /> TIDAK LULUS
				</label></p>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default"><i class="clip-close"></i> Close</button>
		<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
	</div>
	<?php echo form_close();?>
</div>