<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <table class="table">
        <tr>
			<td align='right' width="20%">TAHUN AKADEMIK :</td>
			<td><?php echo get_tahun_akademik_aktif('tahun_akademik')?></td>
		</tr>
        <tr>
			<td align='right'>SEMESTER :</td>
			<td><?php echo get_tahun_akademik_aktif('semester_aktif')?></td>
		</tr>
        <tr>
			<td align='right'>JURUSAN :</td>
			<td>KELAS <?php echo $rombel['kelas'].' - '.$rombel['nama_jurusan']?> ( <?php echo $rombel['nama_rombel']?> )</td>
		</tr>
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
						<th width='5%'><center>#</center></th>
						<th width='5%'><center>NO</center></th>
						<th width='20%'><center>NIS</center></th>
						<th width='50%'><center>NAMA</center></th>
						<th width='20%'><center>RAPORT</center></th>
					</tr>
				</thead>
					<?php
						$nomor=1;
						foreach ($siswa->result() as $row){
							if(get_tahun_akademik_aktif('semester_aktif') == 2){
								if($rombel['kelas'] == get_data_sekolah('id_jenjang_sekolah')){
									if($row->status_kelulusan == 'TIDAK LULUS'){
										$status	= "<span class='label label-danger tooltips' data-placement='top' data-original-title='$row->status_kelulusan'>&nbsp;&nbsp;&nbsp;</span>";
									}else{
										$status	= "<span class='label label-success tooltips' data-placement='top' data-original-title='$row->status_kelulusan'>&nbsp;&nbsp;&nbsp;</span>";
									}
								}else{
									$status_naik_kelas		= get_data_status_naik_kelas('status_naik_kelas', $row->id_status_naik_kelas);
									if($row->id_status_naik_kelas == '1'){
										$status	= "<span class='label label-success tooltips' data-placement='top' data-original-title='$status_naik_kelas'>&nbsp;&nbsp;&nbsp;</span>";
									}else{
										$status	= "<span class='label label-danger tooltips' data-placement='top' data-original-title='$status_naik_kelas'>&nbsp;&nbsp;&nbsp;</span>";
									}
								}
							}else{
								$status	= "<span class='label label-inverse'>&nbsp;&nbsp;&nbsp;</span>";
							}
							echo "<tr>
								<td align='center'>$status</td>
								<td align='center'>$nomor</td>
								<td align='center'>$row->nis</td>
								<td>$row->nama</td>
								<td align='center'>".
									anchor('raport/nilai_semester_view/'.$row->nis,'<i class="clip-search"></i> VIEW',["class"=>"btn btn-xs btn-success tooltips", "data-placement"=>'top', "data-original-title"=>'Lihat Raport'])." | ".
									anchor('raport/nilai_semester/'.$row->nis,'<i class="clip-file-pdf"></i> PDF',["class"=>"btn btn-xs btn-primary tooltips", "data-placement"=>'top', "data-original-title"=>'Print Raport (PDF)'])
									."</td></tr>";
							$nomor++;
						}
					?>
			</table>
		</div>
	</div>
	<!-- end: DYNAMIC TABLE PANEL -->
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.0/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.js"></script>


	<script>
		$(document).ready(function() {
			$('#mytable').DataTable();
		} );
	</script>