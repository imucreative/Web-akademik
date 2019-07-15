<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-external-link-square"></i> Daftar Users
            <div class="panel-tools">
                <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a>
                <a class="btn btn-xs btn-link panel-expand" href="#"> <i class="fa fa-expand"></i> </a>
            </div>
        </div>
        <div class="panel-body">
            <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
                <thead>
					<tr>
						<td colspan='4' align='right'>
							<?php echo anchor('users/rule','<i class="fa fa-sitemap" aria-hidden="true"></i> Rule User',"class='btn btn-warning btn-xs tooltips' data-placement='top' data-original-title='Rule User'");?>
						</td>
					</tr>
                    <tr>
                        <th width='10%'><center>NO</center></th>
                        <th width='60%'><center>NAMA LENGKAP</center></th>
                        <th width='20%'><center>LEVEL</center></th>
                        <th width='10%'><center>
							<?php echo anchor('users/add','<i class="fa fa-plus" aria-hidden="true"></i> Input',"class='btn btn-primary btn-xs tooltips' data-placement='top' data-original-title='Input'");?>
						</center></th>
                    </tr>
                </thead>
				
				<tbody>
					<?php
						$nomor='1';
						foreach($users->result() as $data){
					?>
							<tr>
								<td align='center'><?php echo $nomor;?></td>
								<td><?php echo $data->nama_lengkap;?></td>
								<td align='center'><?php echo $this->Model_users->disp_nama_level($data->id_level_user);?></td>
								<td align='center'>
									<?php echo anchor('users/edit/'.$data->id_user,'<i class="fa fa-edit"></i>','class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"');?> | 
									<?php echo anchor("users/delete/".$data->id_user, '<i class="fa fa-trash-o"></i>', ["class"=>"btn btn-xs btn-danger tooltips", "data-placement"=>'top', "data-original-title"=>'Delete',  "onclick"=>"return confirm('Are you sure?')"]);?>
								</td>
							
							</tr>
					<?php
						$nomor++;
						}
					?>
				</tbody>
				
            </table>
        </div>
    </div>
    <!-- end: DYNAMIC TABLE PANEL -->
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.0/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.js"></script>

  <script>
        $(document).ready(function() {
            $('#mytable').DataTable();
        } );
    </script>