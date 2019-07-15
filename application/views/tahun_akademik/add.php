<div class="col-sm-12">
    <!-- start: TEXT FIELDS PANEL -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-external-link-square"></i>Form Input Tahun Akademik
            <div class="panel-tools">
                <a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a>
                <a class="btn btn-xs btn-link panel-expand" href="#"><i class="fa fa-expand"></i></a>
            </div>
        </div>
        <div class="panel-body">
			<table class="table">
            <?php
				echo form_open('tahun_akademik/add', 'role="form" class="form-horizontal"');
            ?>

				<tr>
					<td align='right' width='20%'>
						<label class="col-sm-12 control-label" for="form-field-1">TAHUN AKADEMIK :</label>
					</td>
					<td>
						<div class="col-sm-10">
							<input type="text" name="tahun_akademik" placeholder="* Tahun Akademik" id="form-field-1" class="form-control limited" maxlength='9' required/>
						</div>
						<label class="col-sm-2 control-label">* Max 9 Digit</label>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-3">SEMESTER :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<?php echo form_dropdown('semester_aktif',array('1'=>'1','2'=>'2'),'',"class='form-control search-select' id='form-field-3' required")?>
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-2">STATUS AKTIF :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<?php echo form_dropdown('is_aktif',array('N'=>'TIDAK AKTIF','Y'=>'AKTIF'),'',"class='form-control search-select' id='form-field-2' required")?>
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
							<?php echo anchor('tahun_akademik', "<i class='fa fa-arrow-left' aria-hidden='true'></i> BACK", array('class' => 'btn btn-info btn-sm')); ?>
						</div>
					</td>
				</tr>
			
            </form>
			</table>
        </div>
    </div>
    <!-- end: TEXT FIELDS PANEL -->
</div>