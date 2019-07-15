<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
   
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-external-link-square"></i> Daftar Kurikulum
            <div class="panel-tools">
                <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a>
                <a class="btn btn-xs btn-link panel-expand" href="#"> <i class="fa fa-expand"></i> </a>
            </div>
        </div>
        <div class="panel-body">
            <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width='10%'><center>NO</center></th>
                        <th width='60%'><center>NAMA KURIKULUM</center></th>
                        <th width='15%'><center>STATUS AKTIF</center></th>
                        <th width='15%'><center>
							<?php echo anchor('kurikulum/add','<i class="fa fa-plus" aria-hidden="true"></i> Input',"class='btn btn-primary btn-xs tooltips' data-placement='top' data-original-title='Input'");?>
						</center></th>
                    </tr>
                </thead>
				
				<tbody>
					<?php
						$nomor='1';
						foreach($kurikulum->result() as $data){
							if($data->is_aktif=='Y'){
								$status_aktif = "AKTIF";
							}else{
								$status_aktif = "TIDAK AKTIF";
							}
					?>
							<tr>
								<td align='center'><?php echo $nomor;?></td>
								<td><?php echo $data->nama_kurikulum;?></td>
								<td align='center'><?php echo $status_aktif;?></td>
								<td align='center'>
									<?php echo anchor('kurikulum/edit/'.$data->id_kurikulum,'<i class="fa fa-edit"></i>','class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"');?> | 
									<?php echo anchor("kurikulum/delete/".$data->id_kurikulum, '<i class="fa fa-trash-o"></i>', ["class"=>"btn btn-xs btn-danger tooltips", "data-placement"=>'top', "data-original-title"=>'Delete',  "onclick"=>"return confirm('Are you sure?')"]);?>
									<?php 
										if($data->is_aktif=='Y'){
											echo " | ".anchor('kurikulum/detail/'.$data->id_kurikulum,'<i class="fa fa-eye"></i>','class="btn btn-xs btn-blue tooltips" data-placement="top" data-original-title="Detail"');
										}
									?>
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