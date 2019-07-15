<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-external-link-square"></i> Form SMS
            <div class="panel-tools">
            </div>
        </div>
        <div class="panel-body">
			<table class="table">
            <?php
				echo form_open_multipart('sms/send', 'role="form" class="form-horizontal form"');
            ?>
				<tr>
					<td align='right' width='20%'>
						<label class="col-sm-12 control-label" for="form-field-1">GROUP SMS :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<?php echo cmb_dinamis('group', 'tbl_sms_group', 'nama_group', 'id') ?>
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-1">TEXT :</label>
					</td>
					<td>
						<div class="col-sm-12">
							<textarea name="pesan" class="form-control"></textarea>
						</div>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<label class="col-sm-12 control-label" for="form-field-1"></label>
					</td>
					<td>
						<div class="col-sm-12">
							<button type="submit" name="submit" class="btn btn-success btn-sm"><i class='fa fa-send'></i> KIRIM PESAN</button>
						</div>
					</td>
				</tr>
				
            </form>
			</table>
        </div>
    </div>
    <!-- end: DYNAMIC TABLE PANEL -->
</div>
