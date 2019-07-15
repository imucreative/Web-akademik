<div class="col-md-12">
    <table class="table">
        <tr>
			<td align='right' width='20%'>TAHUN AKADEMIK :</td>
			<td><?php echo get_tahun_akademik_aktif('tahun_akademik') ?></td>
		</tr>
        <tr>
			<td align='right'>SEMESTER :</td>
			<td><?php echo get_tahun_akademik_aktif('semester_aktif') ?></td>
		</tr>
    </table>
</div>

<div class="col-md-5">
	<!-- start: DYNAMIC TABLE PANEL -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-external-link-square"></i> Biodata Siswa
		</div>
		<div class="panel-body">
			<?php echo form_open('keuangan/form'); ?>
				<table id="mytable" class="table" cellspacing="0" width="100%">
					<tr>
						<td width='25%' align='right'>NIS :</td>
						<td>
							<div class="input-group date">
								<!--<input name="nis" onkeyup="isi_otomatis()" type="text" id="nis" placeholder="* NIS" class="form-control" required>-->
								<input name="nis" onkeyup="isi_otomatis()" type="text" id="nis" placeholder="* NIS" class="form-control limited" maxlength='10' required>
								<span class="input-group-addon">
									<i class="fa fa-search"></i>
								</span>
							</div>
						</td>
					</tr>
					<tr>
						<td align='right'>NAMA :</td>
						<td><input type="text" id="nama" placeholder="* Nama Siswa" class="form-control" required readonly></td>
					</tr>
					<tr>
						<td align='right'>JURUSAN :</td>
						<td><input type="text" id="jurusan" placeholder="* Jurusan" class="form-control" required readonly></td>
					</tr>
					<tr>
						<td align='right'>KELAS :</td>
						<td><input type="text" id="kelas" placeholder="* Kelas" class="form-control" required readonly></td>
					</tr>
					<tr>
						<td align='right'>ROMBEL :</td>
						<td><input type="text" id="rombel" placeholder="* Rombel" class="form-control" required readonly></td>
					</tr>
				</table>
		</div>
	</div>
    <!-- end: DYNAMIC TABLE PANEL -->
</div>
<div class="col-md-7">
    <!-- start: DYNAMIC TABLE PANEL -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-external-link-square"></i> Form Transaksi
		</div>
		<div class="panel-default">
			<div class="panel-body">
					<table id="mytable" class="table" cellspacing="0" width="100%">
						<tr>
							<td align='right' width='30%'>TANGGAL :</td>
							<td>
								<div class="input-group date">
									<input type="date" data-date-format="yyyy-mm-dd" data-date-viewmode="years" class="form-control date-picker" name='tanggal' placeholder="* Tanggal" required readonly>
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								</div>
							</td>
						</tr>
						<tr>
							<td align='right'>JENIS PEMBAYARAN :</td>
							<td><?php echo cmb_dinamis('jenis_pembayaran', 'tbl_jenis_pembayaran', 'nama_jenis_pembayaran', 'id_jenis_pembayaran')?></td>
						</tr>
						<tr>
							<td align='right'>JUMLAH PEMBAYARAN :</td>
							<td>
								<div class="input-group">
									<span class="input-group-addon">Rp.</span>
									<input type="int" name="jumlah_pembayaran" placeholder="* Jumlah" class="form-control limited" id="form-field-mask-5" maxlength='10' required>
								</div>
							</td>
						</tr>
						<tr>
							<td align='right'>KETERANGAN :</td>
							<td><input type="text" name="keterangan" placeholder="* Keterangan Transaksi" class="form-control" required></td>
						</tr>
						<tr>
							<td colspan="2" align='right'>
								<button type="submit" name="submit" class="btn btn-success btn-sm">
									<i class="fa fa-save" aria-hidden="true"></i> SAVE TRANSAKSI
								</button>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
    <!-- end: DYNAMIC TABLE PANEL -->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
	function isi_otomatis(){
		//$(".search").click(function(){
			var nis = $("#nis").val();
			if(nis != ""){
				$.ajax({
					url: '<?php echo base_url()?>index.php/keuangan/form_siswa_autocomplate',
					data:"nis="+nis ,
				}).success(function (data){
					var json = data,
					obj = JSON.parse(json);
					$('#nama').val(obj.nama);
					$('#kelas').val(obj.kelas);
					$('#jurusan').val(obj.jurusan);
					$('#rombel').val(obj.rombel);
				});
			}else{
				alert("NIS harus diinput");
			}
		//});
	}
</script>