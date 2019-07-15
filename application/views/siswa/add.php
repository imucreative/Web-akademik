<div class="col-sm-12">
    <!-- start: TEXT FIELDS PANEL -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-external-link-square"></i>Form Input Siswa
            <div class="panel-tools">
                <a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a>
                <a class="btn btn-xs btn-link panel-expand" href="#"><i class="fa fa-expand"></i></a>
            </div>
        </div>
        <div class="panel-body">
			<table class="table">
            <?php
				echo form_open_multipart('siswa/add', 'role="form" class="form-horizontal form"');
            ?>
				<tr>
					<td align='right' width='20%'>
						<label class="col-sm-12 control-label" for="form-field-1">NIS :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<input type="text" name="nis" placeholder="* Nomor Induk Siswa" id="form-field-1" class="form-control nis" maxlength='10' required/>
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-2">NAMA LENGKAP :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<input type="text" name="nama" placeholder="* Nama Lengkap" id="form-field-2" class="form-control" maxlength='100' required/>
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-3">TEMPAT, TGL LAHIR :</label>
					</td>
					<td>
						<div class="col-sm-8">
							<input type="text" name="tempat_lahir" placeholder="* Tempat Lahir" id="form-field-3" class="form-control" maxlength='100' required/>
						</div>
						<div class="col-sm-4">
							<div class="input-group date">
								<input type="date" data-date-format="yyyy-mm-dd" data-date-viewmode="years" class="form-control date-picker" name='tanggal_lahir' placeholder="* Tanggal Lahir" required readonly>
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-4">GENDER :</label>
					</td>
					<td>
						<div class="col-sm-8">
							<?php
								echo form_dropdown('gender', array('L' => 'LAKI LAKI', 'P' => 'PEREMPUAN'), null, "class='form-control search-select' id='form-field-4' required");
							?>
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-5">AGAMA :</label>
					</td>
					<td>
						<div class="col-sm-8">
							<?php
								echo cmb_dinamis('agama', 'tbl_agama', 'nama_agama', 'kd_agama');
							?>
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-7">PILIH ROMBEL :</label>
					</td>
					<td>
						<div class="col-sm-8">
						   <?php echo cmb_dinamis('rombel', 'tbl_rombel', 'nama_rombel', 'id_rombel')?>
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-6">FOTO :</label>
					</td>
					<td>
						<div class="col-sm-8">
							<div class="fileupload fileupload-new" data-provides="fileupload">
								<div class="input-group">
									<div class="form-control uneditable-input">
										<i class="fa fa-file fileupload-exists"></i>
										<span class="fileupload-preview"></span>
									</div>
									<div class="input-group-btn">
										<div class="btn btn-light-grey btn-file">
											<span class="fileupload-new"><i class="fa fa-folder-open-o"></i> Select file</span>
											<span class="fileupload-exists"><i class="fa fa-folder-open-o"></i> Change</span>
											<input type="file" name="userfile" class="file-input" id='form-field-6'/>
										</div>
										<a href="#" class="btn btn-light-grey fileupload-exists" data-dismiss="fileupload">
											<i class="fa fa-times"></i> Remove
										</a>
									</div>
								</div>
							</div>
						</div>
					</td>
				</tr>

				<tr>
					<td>
						<label class="col-sm-12 control-label"></label>
					</td>
					<td>
						<div class="col-sm-8">
							<button type="submit" name="submit" class="btn btn-success btn-sm"><i class='fa fa-save' aria-hidden='true'></i> SAVE</button>
							<?php echo anchor('siswa', "<i class='fa fa-arrow-left' aria-hidden='true'></i> BACK", array('class' => 'btn btn-info btn-sm')); ?>
						</div>
					</td>
				</tr>
            </form>
			</table>
        </div>
    </div>
    <!-- end: TEXT FIELDS PANEL -->
</div>