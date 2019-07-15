<div class="col-sm-12">
    
    <!-- start: TEXT FIELDS PANEL -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-external-link-square"></i>Informasi Sekolah
            <div class="panel-tools">
                <a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a>
                <a class="btn btn-xs btn-link panel-expand" href="#"><i class="fa fa-expand"></i></a>
            </div>
        </div>
        <div class="panel-body">
			<table class="table">
            <?php
				echo form_open('sekolah/index', 'role="form" class="form-horizontal"');
				echo form_hidden('id_sekolah', $info['id_sekolah']);
            ?>
				<tr>
					<td align='right' width='20%'>
						<label class="col-sm-12 control-label" for="form-field-1">NAMA SEKOLAH :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<input type="text" value="<?php echo $info['nama_sekolah'];?>" name="nama_sekolah" placeholder="* Nama Sekolah" id="form-field-1" class="form-control" maxlength='50' required />
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-2">ALAMAT SEKOLAH :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<input type="text" name="alamat_sekolah" value="<?php echo $info['alamat_sekolah'];?>" placeholder="* Alamat Sekolah" id="form-field-2" class="form-control" required/>
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-3">EMAIL, TELEPHONE :</label>
					</td>
					<td>
						<div class="col-sm-4">
							<div class="input-group date">
								<input type="text" value="<?php echo $info['email'];?>" name="email" placeholder="Email Sekolah" id="form-field-3" class="form-control" maxlength='30' required/>
								<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="input-group date">
								<input type="text" value="<?php echo $info['telpon'];?>" name="telpon" placeholder="Telephone" class="form-control" maxlength='30' required/>
								<span class="input-group-addon"><i class="fa fa-phone"></i></span>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-4">JENJANG SEKOLAH :</label>
					</td>
					<td>
						<div class="col-sm-8">
							<?php echo cmb_dinamis('jenjang','tbl_jenjang_sekolah','nama_jenjang','id_jenjang',$info['id_jenjang_sekolah']);?>
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
						</div>
					</td>
				</tr>
            </form>
			</table>
        </div>
    </div>
    <!-- end: TEXT FIELDS PANEL -->
</div>