<div class="col-sm-12">
    <!-- start: TEXT FIELDS PANEL -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-external-link-square"></i> Form Edit Jenis Pembayaran
            <div class="panel-tools">
                <a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a>
                <a class="btn btn-xs btn-link panel-expand" href="#"><i class="fa fa-expand"></i></a>
            </div>
        </div>
        <div class="panel-body">
			<table class="table">
            <?php
				echo form_open('jenis_pembayaran/edit', 'role="form" class="form-horizontal"');
				echo form_hidden('id_jenis_pembayaran', $jenis_pembayaran['id_jenis_pembayaran']);
            ?>
				<tr>
					<td align='right' width='20%'>
						<label class="col-sm-12 control-label" for="form-field-1">JENIS PEMBAYARAN :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<input type="text" value="<?php echo $jenis_pembayaran['nama_jenis_pembayaran'];?>" name="nama_jenis_pembayaran" placeholder="* Jenis Pembayaran" id="form-field-1" class="form-control limited" maxlength='20' required>
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-2">KETERANGAN :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<input type="text" value="<?php echo $jenis_pembayaran['keterangan'];?>" name="keterangan" placeholder="* Keterangan" id="form-field-2" class="form-control" maxlength='30' required>
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-1"></label>
					</td>
					<td>
						<div class="col-sm-12">
							<button type="submit" name="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> SAVE</button>
							<?php echo anchor('jenis_pembayaran', '<i class="fa fa-arrow-left"></i> BACK', array('class' => 'btn btn-info btn-sm')); ?>
						</div>
					</td>
				</tr>
				
            </form>
			</table>
        </div>
    </div>
    <!-- end: TEXT FIELDS PANEL -->
</div>