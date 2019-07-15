<div class="col-sm-12">
    <!-- start: TEXT FIELDS PANEL -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-external-link-square"></i> Form Edit Mata Pelajaran
            <div class="panel-tools">
                <a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a>
                <a class="btn btn-xs btn-link panel-expand" href="#"><i class="fa fa-expand"></i></a>
            </div>
        </div>
        <div class="panel-body">
			<table class="table">
            <?php
				echo form_open('mapel/edit', 'role="form" class="form-horizontal"');
				echo form_hidden('kd_mapel', $mapel['kd_mapel']);
            ?>
				<tr>
					<td align='right' width='20%'>
						<label class="col-sm-12 control-label" for="form-field-1">KODE MAPEL :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<input type="text" readonly="" value="<?php echo $mapel['kd_mapel'];?>" name="kd_mapel" placeholder="* Kode Mata Pelajaran" id="form-field-1" class="form-control" required/>
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-2">MATA PELAJARAN :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<input type="text" value="<?php echo $mapel['nama_mapel'];?>" name="nama_mapel" placeholder="* Nama Mata Pelajaran" id="form-field-2" class="form-control" maxlength='100' required/>
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-3">KKM :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<input type="text" value="<?php echo $mapel['kkm'];?>" name="kkm" placeholder="* KKM Mata Pelajaran" id="form-field-3" class="form-control" maxlength='3' required/>
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
							<?php echo anchor('mapel', "<i class='fa fa-arrow-left' aria-hidden='true'></i> BACK", array('class' => 'btn btn-info btn-sm')); ?>
						</div>
					</td>
				</tr>
			
            </form>
			</table>
        </div>
    </div>
    <!-- end: TEXT FIELDS PANEL -->
</div>