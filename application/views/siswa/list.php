<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
   
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-external-link-square"></i> Daftar Siswa
			
            <div class="panel-tools">
                <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a>
				<!--
                <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal"> <i class="fa fa-wrench"></i> </a>
                <a class="btn btn-xs btn-link panel-refresh" href="#"> <i class="fa fa-refresh"></i> </a>
				<a class="btn btn-xs btn-link panel-close" href="#"> <i class="fa fa-times"></i> </a>
				-->
                <a class="btn btn-xs btn-link panel-expand" href="#"> <i class="fa fa-expand"></i> </a>
                
            </div>
        </div>
        <div class="panel-body">
            <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width='5%'><center>NO</center></th>
                        <th width="10%"><center>FOTO</center></th>
                        <th width="12%"><center>NIS</center></th>
                        <th width="35%"><center>NAMA</center></th>
						<th width="15%"><center>GENDER</center></th>
						<th width="13%"><center>ROMBEL</center></th>
                        <th width="10%"><center>
							<a href='siswa/add' class='btn btn-primary btn-xs tooltips' data-placement='top' data-original-title='Input'><i class='fa fa-plus' aria-hidden='true'></i> Input</a>
						</center></th>
                    </tr>
                </thead>
				<tbody>
					<?php
					$nomor='1';
						foreach($siswa->result() as $data){
							if(empty($data->foto)){
								$foto = "<img width='30px' src='".base_url()."/uploads/user_siluet.png'>";
							}else{
								$foto = "<img width='30px' src='".base_url()."/uploads/foto_siswa/$data->foto'>";
							}
							
							if($data->gender == "L"){
								$jk = "LAKI LAKI";
							}else{
								$jk = "PEREMPUAN";
							}
							
							$rombel	= $this->Model_rombel->disp_rombel_by_id($data->id_rombel)->row_array();
					?>
							<tr>
								<td align='center'><?php echo $nomor;?></td>
								<td align='center'><?php echo $foto;?></td>
								<td align='center'><?php echo $data->nis;?></td>
								<td><?php echo $data->nama;?></td>
								<td align='center'><?php echo $jk;?></td>
								<td align='center'><?php echo $rombel['nama_rombel']?></td>
								<td align='center'>
									<?php echo anchor('siswa/edit/'.$data->nis,'<i class="fa fa-edit"></i>','class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"');?> | 
									<?php echo anchor("siswa/delete/".$data->nis, '<i class="fa fa-trash-o"></i>', ["class"=>"btn btn-xs btn-danger tooltips", "data-placement"=>'top', "data-original-title"=>'Delete',  "onclick"=>"return confirm('Are you sure?')"]);?>
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
                "ajax": '<?php echo site_url('siswa/data'); ?>',
                "order": [[ 2, 'asc' ]],
                "columns": [
                    {
                        "data": null,
                        "sClass": "text-center",
                        "orderable": false,
                    },
                    { "data": "foto", "sClass": "text-center" },
                    {
                        "data": "nim",
                        "sClass": "text-center"
                    },
                    { "data": "nama" },
                    { "data": "tempat_lahir" },
                    { "data": "tanggal_lahir", "sClass": "text-center" },
                    { "data": "aksi", "sClass": "text-center" },
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