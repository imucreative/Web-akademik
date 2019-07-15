<div class="col-sm-12">
    
    <!-- start: TEXT FIELDS PANEL -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-external-link-square"></i>My Profil
            <div class="panel-tools">
                <a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a>
                <a class="btn btn-xs btn-link panel-expand" href="#"><i class="fa fa-expand"></i></a>
            </div>
        </div>
        <div class="panel-body">
			<table class="table">
            <?php
				echo form_open('welcome/saveProfil', 'role="form" class="form-horizontal form"');
				echo form_hidden('id_user', $this->session->userdata('id_user'));
            ?>
				<tr>
					<td align='right' width='20%'>
						<label class="col-sm-12 control-label" for="form-field-1">NAMA LENGKAP :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<input type="text" name="nama_lengkap" value="<?php echo $this->session->userdata('nama_lengkap');?>"  placeholder="* Nama Lengkap" id="form-field-1" class="form-control" required readonly />
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-2">LEVEL :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<input type="text" value="<?php echo $this->Model_users->disp_nama_level($this->session->userdata('id_level_user'));?>" name="id_level_user" placeholder="* Level User" id='form-field-2' class="form-control" required readonly />
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-3">USERNAME :</label>
					</td>
					<td>
						<div class="col-sm-5">
							<div class="input-group">
								<input type="text" name="username" value="<?php echo $this->session->userdata('username');?>" placeholder="* Username" id="form-field-3" class="form-control" required readonly />
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
							</div>
						</div>
						<div class="col-sm-5">
							<div class="input-group date">
								<input type="password" value="" name="password" placeholder="* Password" class="form-control limited password" maxlength='20' required/>
								<span class="input-group-addon"><i class="fa fa-lock"></i></span>
							</div>
						</div>
						<label class="col-sm-2 control-label">* Min 6 Digit</label>
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

<script>
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
</script>