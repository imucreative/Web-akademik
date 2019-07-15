	<div class="col-md-12">
		<!-- start: DYNAMIC TABLE PANEL -->
	   
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-external-link-square"></i> Daftar Guru
				<div class="panel-tools">
					<a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a>
					<a class="btn btn-xs btn-link panel-expand" href="#"> <i class="fa fa-expand"></i></a>
				</div>
			</div>
			<div class="panel-body">
				<table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th width='5%'><center>NO</center></th>
							<th width='20%'><center>NUPTK</center></th>
							<th width='50%'><center>NAMA GURU</center></th>
							<th width='15%'><center>GENDER</center></th>
							<th width='10%'><center>
								<?php echo anchor('guru/add','<i class="fa fa-plus" aria-hidden="true"></i> Input',"class='btn btn-primary btn-xs tooltips' data-placement='top' data-original-title='Input'");?>
							</center></th>
						</tr>
					</thead>
					
					<tbody>
						<?php
						$nomor='1';
							foreach($guru->result() as $data){
								if($data->gender=='L'){
									$jk = "LAKI LAKI";
								}else{
									$jk = "PEREMPUAN";
								}
						?>
								<tr>
									<td align='center'><?php echo $nomor;?></td>
									<td align='center'><?php echo $data->nuptk;?></td>
									<td><?php echo $data->nama_guru;?></td>
									<td align='center'><?php echo $jk;?></td>
									<td align='center'>
										<?php echo anchor('guru/edit/'.$data->id_guru,'<i class="fa fa-edit"></i>','class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"');?> | 
										<?php echo anchor("guru/delete/".$data->id_guru, '<i class="fa fa-trash-o"></i>', ["class"=>"btn btn-xs btn-danger tooltips", "data-placement"=>'top', "data-original-title"=>'Delete',  "onclick"=>"return confirm('Are you sure?')"]);?>
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