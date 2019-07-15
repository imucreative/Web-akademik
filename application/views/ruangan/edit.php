<div class="col-sm-12">
    <!-- start: TEXT FIELDS PANEL -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-external-link-square"></i>Form Edit Ruangan
            <div class="panel-tools">
                <a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a>
                <a class="btn btn-xs btn-link panel-expand" href="#"><i class="fa fa-expand"></i></a>
            </div>
        </div>
        <div class="panel-body">
			<table class="table">
            <?php
				echo form_open('ruangan/edit', 'role="form" class="form-horizontal"');
				echo form_hidden('kd_ruangan', $ruangan['kd_ruangan']);
            ?>

				<tr>
					<td align='right' width='20%'>
						<label class="col-sm-12 control-label" for="form-field-1">KODE RUANGAN :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<input type="text" readonly="" value="<?php echo $ruangan['kd_ruangan']?>" name="kd_ruangan" placeholder="* Kode Ruangan" id="form-field-1" class="form-control" required />
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-2">NAMA RUANGAN :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<input type="text" value="<?php echo $ruangan['nama_ruangan']?>" name="nama_ruangan" placeholder="* Nama Ruangan" id="form-field-2" class="form-control" maxlength='100' required/>
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
							<?php echo anchor('ruangan', "<i class='fa fa-arrow-left' aria-hidden='true'></i> BACK", array('class' => 'btn btn-info btn-sm')); ?>
						</div>
					</td>
				</tr>
			
            </form>
			</table>
        </div>
    </div>
    <!-- end: TEXT FIELDS PANEL -->
</div>