<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-external-link-square"></i> Filter Data
        </div>
        <div class="panel-body">
            <?php echo form_open('jadwal/cetak_jadwal');?>
				<table class="table">
					<tr>
						<td align='right' width='15%'>JURUSAN :</td>
						<td><?php echo cmb_dinamis('jurusan', 'tbl_jurusan', 'nama_jurusan', 'kd_jurusan', null, "id='jurusan' onChange='loadRombel()'") ?></td>
					</tr>
					<tr>
						<td align='right'>KELAS :</td>
						<td>
							<select id="kelas" class="form-control search-select" onchange="loadRombel()()">
								<?php
									for ($i = 1; $i <= $info['jumlah_kelas']; $i++) {
										echo "<option value='$i'>Kelas $i</option>";
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td align='right'>ROMBEL :</td>
						<td>
							<div id="showRombel"></div>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<?php 
								if(get_tahun_akademik_aktif('generate_jadwal') == 1){
							?>
									<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#generate_jadwal">
										<i class="fa fa-cogs" aria-hidden="true"></i> GENERATE JADWAL
									</button>
							<?php
								}
							?>
							<button type="submit" name="export_jadwal" class="btn btn-danger btn-sm">
								<i class="fa fa-print" aria-hidden="true"></i> CETAK PDF
							</button>
							<?php //echo anchor('kurikulum/adddetail/'.$this->uri->segment(3), '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tambah Data', "title='Dambah Data' class='btn btn-danger btn-sm'"); ?>
							<?php //echo anchor('kurikulum', 'Kembali', "class='btn btn-success btn-sm'"); ?>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<!-- end: DYNAMIC TABLE PANEL -->
</div>


<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-external-link-square"></i> Daftar Pelajaran
            <div class="panel-tools">
                <a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a>
                <a class="btn btn-xs btn-link panel-expand" href="#"> <i class="fa fa-expand"></i></a>
            </div>
        </div>
        <div class="panel-body">
            <div id="tabel"></div>
        </div>
    </div>
    <!-- end: DYNAMIC TABLE PANEL -->
</div>

<script type="text/javascript">
    $(document ).ready(function() {
        loadRombel();
    });
</script>

<script type="text/javascript">
   
    function loadRombel(){
        var kelas  = $("#kelas").val();
        var jurusan= $("#jurusan").val();
        $.ajax({
            type:'GET',
            url :'<?php echo base_url() ?>index.php/jadwal/show_rombel',
            data:'kelas='+kelas+'&jurusan='+jurusan,
            success:function(html){
                $("#showRombel").html(html);
                loadPelajaran();
            }
        })
    }
    
    function loadPelajaran(){
        var kelas   =$("#kelas").val();
        var jurusan =$("#jurusan").val();
        var rombel  =$("#rombel").val();
        $.ajax({
            type:'GET',
            url :'<?php echo base_url() ?>index.php/jadwal/dataJadwal',
            data:'jurusan='+jurusan+'&kelas='+kelas+'&rombel='+rombel+'&id_kurikulum=<?php echo $this->uri->segment(3) ?>',
            success:function(html){
                $("#tabel").html(html);
                //loadRombel();
            }
        })
    }
    
    function updateGuru(id){
        var guru = $("#guru"+id).val();
        $.ajax({
            type:'GET',
            url :'<?php echo base_url() ?>index.php/jadwal/updateGuru',
            data:'id_guru='+guru+'&id_jadwal='+id,
            success:function(html){
				alert("Berhasil mengubah guru");
                loadData();
            }
        })
    }
    
    function updateRuangan(id){
        var kd_ruangan = $("#ruangan"+id).val();
        $.ajax({
            type:'GET',
            url :'<?php echo base_url() ?>index.php/jadwal/updateRuangan',
            data:'kd_ruangan='+kd_ruangan+'&id_jadwal='+id,
            success:function(html){
                alert("Berhasil mengubah ruangan");
				loadData();
            }
        })
    }
    
    function updateHari(id){
        var hari = $("#hari"+id).val();
        $.ajax({
            type:'GET',
            url :'<?php echo base_url() ?>index.php/jadwal/updateHari',
            data:'hari='+hari+'&id_jadwal='+id,
            success:function(html){
                alert("Berhasil mengubah hari");
				loadData();
            }
        })
    }
    
    function updateJam(id){
        var jam = $("#jam"+id).val();
        $.ajax({
            type:'GET',
            url :'<?php echo base_url() ?>index.php/jadwal/updateJam',
            data:'jam='+jam+'&id_jadwal='+id,
            success:function(html){
                alert("Berhasil mengubah jam");
				loadData();
            }
        })
    }
    
    
    function filterData(){
        loadData();
    }

</script>

<!-- Modal -->
<div class="modal fade" id="generate_jadwal" tabindex="-1" role="dialog">
    
	<div class="modal-content">
		<?php
			echo form_open('jadwal/generate_jadwal');
		?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Generate Jadwal Otomatis</h4>
			</div>
			<div class="modal-body">
				<table class="table">
					<tr>
						<td align='right' width='30%'>KURIKULUM :</td>
						<td><?php echo cmb_dinamis('kurikulum', 'tbl_kurikulum', 'nama_kurikulum', 'id_kurikulum') ?></td>
					</tr>
					<tr>
						<td align='right'>SEMESTER :</td>
						<td>
							<?php //echo form_dropdown('semester', array(1 => 'SEMESTER 1', 2 => 'SEMESTER 2'), null, "class='form-control search-select'"); ?>
							<?php echo form_dropdown('semester', array(get_tahun_akademik_aktif('semester_aktif') => "SEMESTER ".get_tahun_akademik_aktif('semester_aktif')), null, "class='form-control search-select'"); ?>
						</td>
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> CLOSE</button>
				<button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fa fa-cogs"></i> GENERATE JADWAL</button>
			</div>
		</form>
	</div>
    
</div>