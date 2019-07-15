<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
   
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-external-link-square"></i> Daftar Ruangan
            <div class="panel-tools">
                <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a>
                <a class="btn btn-xs btn-link panel-expand" href="#"> <i class="fa fa-expand"></i> </a>
            </div>
        </div>
        <div class="panel-body">
            <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width='5%'><center>NO</center></th>
                        <th width='15%'><center>KODE RUANGAN</center></th>
                        <th width='70%'><center>NAMA RUANGAN</center></th>
                        <th width='10%'><center>
							<?php echo anchor('ruangan/add','<i class="fa fa-plus" aria-hidden="true"></i> Input',"class='btn btn-primary btn-xs tooltips' data-placement='top' data-original-title='Input'");?>
						</center></th>
                    </tr>
                </thead>
				
				<tbody>
					<?php
						$nomor='1';
						foreach($ruangan->result() as $data){
					?>
							<tr>
								<td align='center'><?php echo $nomor;?></td>
								<td align='center'><?php echo $data->kd_ruangan;?></td>
								<td><?php echo $data->nama_ruangan;?></td>
								<td align='center'>
									<?php echo anchor('ruangan/edit/'.$data->kd_ruangan,'<i class="fa fa-edit"></i>','class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"');?> | 
									<?php echo anchor("ruangan/delete/".$data->kd_ruangan, '<i class="fa fa-trash-o"></i>', ["class"=>"btn btn-xs btn-danger tooltips", "data-placement"=>'top', "data-original-title"=>'Delete',  "onclick"=>"return confirm('Are you sure?')"]);?>
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
			/*
            var t = $('#mytable').DataTable( {
                "ajax": '<?php echo site_url('ruangan/data'); ?>',
                "order": [[ 2, 'asc' ]],
                "columns": [
                    {
                        "data": null,
                        "sClass": "text-center",
                        "orderable": false
                    },
                    {
                        "data": "kd_ruangan",
                        "sClass": "text-center"
                    },
                    { "data": "nama_ruangan" },
                    { 
						"data": "aksi",
						"sClass": "text-center"
					},
                ]
            } );
               
            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
			*/
        } );
    </script>