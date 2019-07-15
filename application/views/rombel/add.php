<div class="col-sm-12">
    <!-- start: TEXT FIELDS PANEL -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-external-link-square"></i> Form Input Rombongan Belajar
            <div class="panel-tools">
                <a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a>
                <a class="btn btn-xs btn-link panel-expand" href="#"><i class="fa fa-expand"></i></a>
            </div>
        </div>
        <div class="panel-body">
			<table class="table">
            <?php
				echo form_open('rombel/add', 'role="form" class="form-horizontal"');
            ?>

				<tr>
					<td align='right' width='20%'>
						<label class="col-sm-12 control-label" for="form-field-1">NAMA ROMBEL :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<input type="text" name="nama_rombel" placeholder="* Nama Rombongan Belajar" id="form-field-1" class="form-control limited" maxlength='10' required />
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-2">JURUSAN :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<?php echo cmb_dinamis('jurusan', 'tbl_jurusan', 'nama_jurusan', 'kd_jurusan') ?>
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-3">KELAS :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<select name="kelas" class="form-control search-select" id='form-field-3'>
								<?php
									for ($i = 1; $i <= $info['jumlah_kelas']; $i++) {
										echo "<option value='$i'>Kelas $i</option>";
									}
								?>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label"></label>
					</td>
					<td>
						<div class="col-sm-12">
							<button type="submit" name="submit" class="btn btn-success btn-sm"><i class='fa fa-save' aria-hidden='true'></i> SAVE</button>
							<?php echo anchor('rombel', "<i class='fa fa-arrow-left' aria-hidden='true'></i> BACK", array('class' => 'btn btn-info btn-sm')); ?>
						</div>
					</td>
				</tr>
            </form>
			</table>
        </div>
    </div>
    <!-- end: TEXT FIELDS PANEL -->
</div>