<div class="col-md-4">
    <!-- start: DYNAMIC TABLE PANEL -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-external-link-square"></i> Level User
        </div>
        <div class="panel-body">
            <table class="table" cellspacing="0" width="100%">
                <tr>
					<td align='right' width='35%'>PILIH LEVEL :</td>
					<td>
						<?php echo cmb_dinamis('level_user', 'tbl_level_user', 'nama_level', 'id_level_user', null, "id='level_user' onchange='loadData()'") ?>
					</td>
				</tr>
				<tr>
					<td colspan='2' align='right'>
						<?php echo anchor('users', "<i class='fa fa-arrow-left' aria-hidden='true'></i> BACK", array('class' => 'btn btn-info btn-sm')); ?>
					</td>
				</tr>
            </table>
        </div>

    </div>
    <!-- end: DYNAMIC TABLE PANEL -->

</div>


<div class="col-md-8">
    <!-- start: DYNAMIC TABLE PANEL -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-external-link-square"></i> Hak Akses Module
        </div>
        <div class="panel-body">
            <div id="tabel"></div>

        </div>
    </div>
    <!-- end: DYNAMIC TABLE PANEL -->
</div>


<script type="text/javascript">
    $(document ).ready(function() {
        loadData();
    });
</script>

<script type="text/javascript">
    function loadData(){
        var level_user = $("#level_user").val();
        $.ajax({
            type:'GET',
            url :'<?php echo base_url() ?>index.php/users/modul',
            data:'level_user='+level_user,
            success:function(html){
                $("#tabel").html(html);
            }
        })
    }
    
    function addRule(id_modul){
        var level_user = $("#level_user").val();
        $.ajax({
            type:'GET',
            url :'<?php echo base_url() ?>index.php/users/addrule',
            data:'level_user='+level_user+'&id_menu='+id_modul,
            success:function(html){
                //$("#tabel").html(html);
                //loadData();
                alert('Suksess memberikan akses');
            }
        })
    }
</script>
