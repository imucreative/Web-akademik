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
		<tr>
			<td align='right'>MATA PELAJARAN :</td>
			<td><?php echo $rombel['nama_mapel']?></td>
		</tr>
	</table>
	<!-- end: DYNAMIC TABLE PANEL -->
</div>


<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-external-link-square"></i> Daftar Nilai Siswa
            <div class="panel-tools"></div>
        </div>
        <div class="panel-body">
			<table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th width='5%'><center>NO</center></th>
						<th width='10%'><center>NIS</center></th>
						<th width='35%'><center>NAMA</center></th>
						<th width='10%'><center>KKM</center></th>
						<th width='20%'><center>NILAI</center></th>
						<th width='20%'><center>DESKRIPSI</center></th>
					</tr>
				</thead>
				<?php
					$nomor=1;
					foreach ($siswa as $row){
						$nilai		= chek_nilai($row->nis, $this->uri->segment(3), 'nilai');
						$deskripsi	= chek_nilai($row->nis, $this->uri->segment(3), 'deskripsi');
						if(empty($deskripsi)){
							$desk	= "";
						}else{
							$desk	= $deskripsi;
						}
						echo "<tr>
							<td align='center'>$nomor</td>
							<td align='center'>$row->nis</td>
							<td>".strtoupper($row->nama)."</td>
							<td align='center'>$rombel[kkm]</td>
							<td align='center'>
								<div class='input-group'>
									<input type='text' onKeyup='updateNilai(\"$row->nis\")' id='nilai".$row->nis."' value='".$nilai."' class='form-control'>
									<span class='input-group-btn'>
										<button type='button' class='btn btn-success inputNilai' id='$row->nis'>
											<i class='fa fa-pencil'></i>
										</button> </span>
									</span>
								</div>
							</td>
							<td align='center'>
								<div class='input-group'>
									<input type='text' id='deskripsi".$row->nis."' value='".$desk."' class='form-control'>
									<span class='input-group-btn'>
										<button type='button' class='btn btn-success inputDeskripsi' id='$row->nis'>
											<i class='fa fa-pencil'></i>
										</button></span>
									</span>
								</div>
							</td>
						</tr>";
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

<script type="text/javascript">
	$(document).ready(function(){
		$('#mytable').DataTable();
	});        
</script>

<script type="text/javascript">
	//function updateNilai(nis){
	$('.inputNilai').click(function(){
		var nis = $(this).attr('id');
		var nilai = $("#nilai" + nis).val();
		$.ajax({
			type:'GET',
			url :'<?php echo base_url(); ?>index.php/nilai/update_nilai',
			data:'nis=' + nis + '&id_jadwal=' + <?php echo $this->uri->segment(3)?> + '&nilai=' + nilai,
			success:function(html){
				//$("#dataSiswa").html(html);
				alert(html);
			}
		});
	});
	
	$('.inputDeskripsi').click(function(){
		var nis = $(this).attr('id');
		var deskripsi = $("#deskripsi" + nis).val();
		$.ajax({
			type:'GET',
			url :'<?php echo base_url(); ?>index.php/nilai/update_deskripsi',
			data:'nis=' + nis + '&id_jadwal=' + <?php echo $this->uri->segment(3)?> + '&deskripsi=' + deskripsi,
			success:function(html){
				//$("#dataSiswa").html(html);
				alert(html);
			}
		});
	});
</script>