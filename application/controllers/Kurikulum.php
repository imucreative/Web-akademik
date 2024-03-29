<?php

Class Kurikulum extends CI_Controller {

    function __construct() {
        parent::__construct();
		chekAksesModule();
        $this->load->library('ssp');
        $this->load->model('Model_kurikulum');
		
		if(!$this->session->userdata('id_user')){
			redirect('auth/logout');
		}
    }

    function data() {
        // nama tabel
        $table = 'tbl_kurikulum';
        // nama PK
        $primaryKey = 'id_kurikulum';
        // list field
        $columns = array(
            array('db' => 'id_kurikulum', 'dt' => 'id_kurikulum'),
            array(
				'db' => 'nama_kurikulum', 
				'dt' => 'nama_kurikulum'
			),
            array('db' => 'is_aktif',
                'dt' => 'is_aktif',
                'formatter' => function( $d) {
                    return $d=='Y'?'Aktif':'Tidak Aktif';
                }
			),
            array(
                'db' => 'id_kurikulum',
                'dt' => 'aksi',
                'formatter' => function( $d) {
                    //return "<a href='edit.php?id=$d'>EDIT</a>";
                    return anchor('kurikulum/edit/' . $d, '<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"') . ' 
                        '. anchor('kurikulum/delete/' . $d, '<i class="fa fa-trash-o"></i>', 'class="btn btn-xs btn-danger tooltips" data-placement="top" data-original-title="Delete"').'
                        '. anchor('kurikulum/detail/' . $d, '<i class="fa fa-eye"></i>', 'class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"');
                }
            )
        );

        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db' => $this->db->database,
            'host' => $this->db->hostname
        );

        echo json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        );
    }

    function index(){		
		$data['kurikulum']	= $this->Model_kurikulum->daftar_kurikulum();
		$this->template->load('template', 'kurikulum/list', $data);
	}

    function add() {
        if (isset($_POST['submit'])) {
            $this->Model_kurikulum->save();
            redirect('kurikulum');
        } else {
            $this->template->load('template', 'kurikulum/add');
        }
    }

    function edit() {
        if (isset($_POST['submit'])) {
            $this->Model_kurikulum->update();
            redirect('kurikulum');
        } else {
            $id_kurikulum      = $this->uri->segment(3);
            $data['kurikulum'] = $this->db->get_where('tbl_kurikulum', array('id_kurikulum' => $id_kurikulum))->row_array();
            $this->template->load('template', 'kurikulum/edit', $data);
        }
    }

    function delete() {
        $id_kurikulum = $this->uri->segment(3);
		
        if (!empty($id_kurikulum)) {
			$this->Model_kurikulum->hapus($id_kurikulum);
        }
        redirect('kurikulum');
    }
    
    function detail(){
        $infoSekolah = "SELECT js.jumlah_kelas
                        FROM tbl_jenjang_sekolah as js,tbl_sekolah_info as si 
                        WHERE js.id_jenjang=si.id_jenjang_sekolah";
        $data['info']= $this->db->query($infoSekolah)->row_array();
        $this->template->load('template', 'kurikulum/detail',$data);
    }
    
    function dataKurikulumDetail(){
        $kd_jurusan     = $_GET['jurusan'];
        $kelas          = $_GET['kelas'];
        $id_kurikulum   = $_GET['id_kurikulum'];
        if($kelas=='semua_kelas'){
            $selected_kelas = '';
        }else{
            $selected_kelas="and kd.kelas='$kelas'";
        }
        echo "<table class='table table-striped table-bordered table-hover table-full-width dataTable'>
                <thead>
                    <tr>
                        <th><center>NO</center></th>
                        <th><center>KODE MAPEL</center></th>
                        <th><center>NAMA MATA PELAJARAN</center></th>
                        <th><center>KELAS</center></th>
                        <td align='center'>".
							anchor('kurikulum/adddetail/'.$id_kurikulum, '<i class="fa fa-plus" aria-hidden="true"></i> Input', "class='btn btn-primary btn-xs'")."
						</td>
                    </tr>
                </thead>";
        
        $sql = "SELECT tj.nama_jurusan,tm.kd_mapel,tm.nama_mapel,kd.kelas,kd.id_kurikulum_detail,kd.id_kurikulum
                FROM tbl_kurikulum_detail as kd, tbl_kurikulum as tk,tbl_mapel as tm,tbl_jurusan as tj
                WHERE kd.id_kurikulum=tk.id_kurikulum and kd.kd_mapel=tm.kd_mapel and kd.kd_jurusan=tj.kd_jurusan 
                $selected_kelas and kd.id_kurikulum='$id_kurikulum' and kd.kd_jurusan='$kd_jurusan' AND kd.status_delete='0'";
        $kurikulum = $this->db->query($sql)->result();
        $no=1;
        foreach ($kurikulum as $row){
            echo"
			<tr>
				<td align='center'>$no</td>
				<td align='center'>$row->kd_mapel</td>
				<td>$row->nama_mapel</td>
				<td align='center'>$row->kelas</td>
				<td align='center'>".anchor('kurikulum/deletedetail/'.$row->id_kurikulum_detail.'/'.$row->id_kurikulum,'<i class="fa fa-trash-o"></i>', ["class"=>"btn btn-xs btn-danger tooltips", "data-placement"=>'top', "data-original-title"=>'Delete',  "onclick"=>"return confirm('Are you sure?')"])."</td>
			</tr>";
            $no++;
        }
        
        echo"    </table>";
    }
    
    function adddetail(){
        if(isset($_POST['submit'])){
            $this->Model_kurikulum->addKurikulumDetail();
            redirect('kurikulum/detail/'.$this->input->post('id_kurikulum'));
        }else{
            $infoSekolah = "SELECT js.jumlah_kelas
                        FROM tbl_jenjang_sekolah as js,tbl_sekolah_info as si 
                        WHERE js.id_jenjang=si.id_jenjang_sekolah";
            $data['info']= $this->db->query($infoSekolah)->row_array();
            $this->template->load('template', 'kurikulum/addDetail',$data);
        }
    }
    
    function deletedetail() {
        $id_kurikulum_detail = $this->uri->segment(3);
        $id_kurikulum        = $this->uri->segment(4);
        if (!empty($id_kurikulum_detail)) {
            $this->Model_kurikulum->hapus_detail($id_kurikulum_detail);
        }
        redirect('kurikulum/detail/'.$id_kurikulum);
    }

}