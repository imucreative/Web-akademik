<div class="col-md-5">
    <!-- start: DYNAMIC TABLE PANEL -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-external-link-square"></i> Filter Data
        </div>
        <div class="panel-body">
            <table class="table">
                <tr>
					<td align='right' width='25%'>JURUSAN :</td>
					<td>
						<?php echo cmb_dinamis('jurusan', 'tbl_jurusan', 'nama_jurusan', 'kd_jurusan', null, "id='jurusan' onChange='loadData()'") ?>
					</td>
				</tr>
                <tr>
					<td align='right'>KELAS :</td>
					<td>
                        <select id="kelas" class="form-control search-select" onchange="loadData()()">
                            <option value="semua_kelas">Semua Kelas</option>
                            <?php
								for ($i = 1; $i <= $info['jumlah_kelas']; $i++) {
									echo "<option value='$i'>Kelas $i</option>";
								}
                            ?>
                        </select>
                    </td>
				</tr>
                <tr>
					<td colspan="2" align='right'>
						<?php echo anchor('kurikulum','<i class="fa fa-arrow-left"></i> BACK',"class='btn btn-info btn-sm'");?>
                    </td>
				</tr>
            </table>
        </div>
    </div>
    <!-- end: DYNAMIC TABLE PANEL -->
</div>


<div class="col-md-7">
    <!-- start: DYNAMIC TABLE PANEL -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-external-link-square"></i> Daftar Pelajaran
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

    function loadData(){
        var kelas=$("#kelas").val();
        var jurusan=$("#jurusan").val();
        $.ajax({
            type:'GET',
            url :'<?php echo base_url() ?>index.php/kurikulum/dataKurikulumDetail',
            data:'jurusan='+jurusan+'&kelas='+kelas+'&id_kurikulum=<?php echo $this->uri->segment(3)?>',
            success:function(html){
                $("#tabel").html(html);
            }
        })
    }
    
    function filterData(){
		loadData();
    }

</script>