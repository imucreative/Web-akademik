<div class="col-md-12">
    <table class="table">
        <tr>
			<td width='200' align='right'>TAHUN AKADEMIK :</td>
			<td><?php echo get_tahun_akademik_aktif('tahun_akademik') ?></td>
		</tr>
        <tr>
			<td align='right'>SEMESTER :</td>
			<td><?php echo get_tahun_akademik_aktif('semester_aktif') ?></td>
		</tr>
    </table>
</div>

<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-external-link-square"></i> Daftar Wali Kelas
            <div class="panel-tools">
                <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a>
                <a class="btn btn-xs btn-link panel-expand" href="#"> <i class="fa fa-expand"></i> </a>
            </div>
        </div>
        <div class="panel-body">
            <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th><center>NO</center></th>
                        <th><center>ROMBEL</center></th>
                        <th><center>NAMA JURUSAN</center></th>
                        <th><center>KELAS</center></th>
                        <th><center>NAMA WALIKELAS</center></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- end: DYNAMIC TABLE PANEL -->
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.0/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.js"></script>


<script type="text/javascript">
    function updateDataWalikelas(id_walikelas){
        var id_guru = $("#guru"+id_walikelas).val();
        $.ajax({
            type:'GET',
            url :'<?php echo base_url() ?>index.php/walikelas/updateWalikelas',
            data:'id_walikelas='+id_walikelas+'&id_guru='+id_guru,
            success:function(html){
                //$("#showRombel").html(html);
                //loadPelajaran();
				alert("Berhasil mengubah walikelas");
            }
        })
    }

</script>

<script>
    $(document).ready(function() {
        var t = $('#mytable').DataTable( {
            "ajax": '<?php echo site_url('walikelas/data'); ?>',
            "order": [[ 2, 'asc' ]],
            "columns": [
                {
                    "data": null,
                    "width": "5%",
                    "sClass": "text-center",
                    "orderable": false,
                },
                { "data": "nama_rombel", "sClass": "text-center" },
                { "data": "nama_jurusan" },
                { "data": "kelas", "sClass": "text-center" },
                { "data": "nama_guru", "sClass": "text-center" }
            ]
        } );
               
        t.on( 'order.dt search.dt', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
    } );
</script>