<div class="col-sm-12">
    <!-- start: TEXT FIELDS PANEL -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-external-link-square"></i>Form Input User
            <div class="panel-tools">
                <a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a>
                <a class="btn btn-xs btn-link panel-expand" href="#"><i class="fa fa-expand"></i></a>
            </div>
        </div>
        <div class="panel-body">
			<table class="table">
            <?php
				echo form_open_multipart('users/add', 'role="form" class="form-horizontal form"');
            ?>
				<tr>
					<td align='right' width='20%'>
						<label class="col-sm-12 control-label" for="form-field-1">NAMA LENGKAP :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<input type="text" name="nama_lengkap" placeholder="* Nama Lengkap" id="form-field-1" class="form-control" maxlength='100' required />
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-2">USERNAME :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<input type="text" name="username" placeholder="* Username" id="form-field-2" class="form-control" maxlength='20' required />
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-3">PASSWORD :</label>
					</td>
					<td>
						<div class="col-sm-10">
							<input type="password" name="password" placeholder="* Password" id="form-field-3" class="form-control password limited" maxlength='20' required />
						</div>
						<label class="col-sm-2 control-label">* Min 6 Digit</label>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-4">LEVEL USER :</label>
					</td>
					<td>
						<div class="col-sm-10">
							<?php echo cmb_dinamis('id_level_user', 'tbl_level_user', 'nama_level', 'id_level_user');?>
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-5">CONNECT TBL GURU :</label>
					</td>
					<td>
						<div class="col-sm-10">
							<?php
								echo cmb_dinamis('id_guru', 'tbl_guru', 'nama_guru', 'id_guru');
							?>
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-6">FOTO :</label>
					</td>
					<td>
						<div class="col-sm-10">					
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
					<td align='right'>
						<label class="col-sm-12 control-label"></label>
					</td>
					<td>
						<div class="col-sm-12">
							<button type="submit" name="submit" class="btn btn-success btn-sm"><i class='fa fa-save' aria-hidden='true'></i> SAVE</button>
							<?php echo anchor('users', "<i class='fa fa-arrow-left' aria-hidden='true'></i> BACK", array('class' => 'btn btn-info btn-sm')); ?>
						</div>
					</td>
				</tr>
            </form>
			</table>
        </div>
    </div>
    <!-- end: TEXT FIELDS PANEL -->
</div>

<script type="text/javascript">
	$(document).ready(function(){
		
		$(".form").submit(function(){
			var pass = $(".password").val();
			if(pass.length < 6){
				alert("* Min Input 6 digit");
				return false;
			}else{
				return true;
			}
			return false;
		});
	});
</script>