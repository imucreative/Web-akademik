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
	</table>
    <!-- end: DYNAMIC TABLE PANEL -->
</div>


<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-external-link-square"></i> Daftar Kelas
            <div class="panel-tools"></div>
        </div>
        <div class="panel-body">
			<table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
                <thead>
					<tr>
						<th width='5%'><center>NO</center></th>
						<th width='33%'><center>JURUSAN</center></th>
						<th width='18%'><center>MATAPELAJARAN</center></th>
						<th width='11%'><center>HARI</center></th>
						<th width='11%'><center>JAM</center></th>
						<th width='17%'><center>RUANG</center></th>
						<th width='5%'></th>
					</tr>
				</thead>
                <?php
					$no=1;;
					foreach ($jadwal->result() as $row){
						echo "<tr>
							<td align='center'>$no</td>
							<td>KELAS $row->kelas - $row->nama_jurusan ( $row->nama_rombel )</td>
							<td align='center'>$row->nama_mapel</td>
							<td align='center'>$row->hari</td>
							<td align='center'>$row->jam</td>
							<td align='center'>$row->nama_ruangan</td>
							<td align='center'>".
								anchor('nilai/rombel/'.$row->id_jadwal,'<i class="fa fa-eye"></i>',"class='btn btn-primary btn-xs tooltips' data-placement='left' data-original-title='Lihat Kelas'")
								."</td>
							</tr>";
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


	<script>
		$(document).ready(function() {
			$('#mytable').DataTable();
		} );
	</script>