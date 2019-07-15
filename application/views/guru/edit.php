<div class="col-sm-12">
    <!-- start: TEXT FIELDS PANEL -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-external-link-square"></i>Form Edit Guru
            <div class="panel-tools">
                <a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a>
                <a class="btn btn-xs btn-link panel-expand" href="#"><i class="fa fa-expand"></i></a>
            </div>
        </div>
        <div class="panel-body">
			<table class="table">
            <?php
				echo form_open('guru/edit', 'role="form" class="form-horizontal form"');
				echo form_hidden('id_guru', $guru['id_guru']);
            ?>

				<tr>
					<td align='right' width='20%'>
						<label class="col-sm-12 control-label" for="form-field-1">NUPTK :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<input type="text" name="nuptk" value="<?php echo $guru['nuptk']?>" placeholder="* NUPTK" id="form-field-1" class="form-control" maxlength='20' required/>
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-2">NAMA GURU :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<input type="text" value="<?php echo $guru['nama_guru']?>" name="nama_guru" placeholder="* Nama Guru" id="form-field-2" class="form-control" maxlength='100' required/>
						</div>
					</td>
				</tr>
				<tr>
					<td align='right' width='20%'>
						<label class="col-sm-12 control-label" for="form-field-3">GENDER :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<?php echo form_dropdown('gender', array('L' => 'LAKI LAKI', 'P' => 'PEREMPUAN'), $guru['gender'], "class='form-control search-select' id='form-field-3' required") ?>
						</div>
					</td>
				</tr>
				
				<tr>
					<td>
						<label class="col-sm-12 control-label"></label>
					</td>
					<td>
						<div class="col-sm-12">
							<button type="submit" name="submit" class="btn btn-success btn-sm submit"><i class='fa fa-save' aria-hidden='true'></i> SAVE</button>
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