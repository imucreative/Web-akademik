<div class="col-sm-12">
    <!-- start: TEXT FIELDS PANEL -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-external-link-square"></i>Form Input Guru
            <div class="panel-tools">
                <a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a>
                <a class="btn btn-xs btn-link panel-expand" href="#"><i class="fa fa-expand"></i></a>
            </div>
        </div>
        <div class="panel-body">
			<table class="table">
            <?php
				echo form_open('guru/add', 'role="form" class="form-horizontal form"');
            ?>
			
				<tr>
					<td align='right' width='20%'>
						<label class="col-sm-12 control-label" for="form-field-1">NUPTK :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<input type="text" name="nuptk" placeholder="* NUPTK" id="form-field-1" class="form-control nuptk" maxlength='20' required/>
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-2">NAMA GURU :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<input type="text" name="nama_guru" placeholder="* Nama Guru" id="form-field-2" class="form-control" maxlength='100' required/>
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-3">GENDER :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<?php echo form_dropdown('gender', array('L' => 'LAKI LAKI', 'P' => 'PEREMPUAN'), '', "class='form-control search-select' id='form-field-3' required") ?>
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-4">USERNAME :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<input type="text" name="username" placeholder="* Username" id="form-field-4" class="form-control" maxlength='20' required />
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-5">PASSWORD :</label>
					</td>
					<td>
						<div class="col-sm-10">
							<input type="password" name="password" placeholder="* Password" id="form-field-5" class="form-control password limited" maxlength='20' required />
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
							<?php echo anchor('guru', "<i class='fa fa-arrow-left' aria-hidden='true'></i> BACK", array('class' => 'btn btn-info btn-sm')); ?>
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
			alert("* Min Input Password 6 digit");
			return false;
		}else{
			return true;
		}
		return false;
	});
</script>