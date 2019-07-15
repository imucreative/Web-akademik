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

<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-external-link-square"></i> Komponen Biaya
        </div>
        <div class="panel-body">
            <?php
				echo form_open('keuangan/setup');
            ?>
				<table class="table">
					<?php
						foreach ($jenis_pembayaran->result() as $row) {
							echo "<tr>
								<td align='right' width='20%'>".strtoupper($row->keterangan)." (".strtoupper($row->nama_jenis_pembayaran).") :</td>
								<td>
								<div class='input-group'>
									<span class='input-group-addon'>Rp.</span>
									<input required maxlength='10' type='int' value='".chek_komponen_biaya($row->id_jenis_pembayaran)."' class='form-control limited' name='$row->id_jenis_pembayaran' placeholder='* Masukan Data $row->nama_jenis_pembayaran'>
								</div>
								</td></tr>";
						}
					?>
					<tr>
						<td></td>
						<td>
							<button type="submit" name="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure?')"><i class="fa fa-save"></i> SAVE</button>
						</td>
					</tr>
				</table>
            </form>
        </div>
    </div>
    <!-- end: DYNAMIC TABLE PANEL -->
</div>