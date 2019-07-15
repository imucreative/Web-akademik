<?php

Class Siswa extends CI_Controller {

    function __construct() {
        parent::__construct();
		chekAksesModule();
        $this->load->library('ssp');
        $this->load->model('Model_siswa');
		$this->load->model('Model_rombel');
		$this->load->model('Model_agama');
		
		if(!$this->session->userdata('id_user')){
			redirect('auth/logout');
		}
    }

    function data() {
        // nama tabel
        $table = 'tbl_siswa';
        // nama PK
        $primaryKey = 'nis';
        // list field
        $columns = array(
            array('db' => 'foto',
                'dt' => 'foto',
                'formatter' => function( $d){
                   if(empty($d)){
                       return "<img width='30px' src='".  base_url()."/uploads/user-siluet.jpg'>";
                   }else{
                       return "<img width='20px' src='".  base_url()."/uploads/".$d."'>";
                   }
                }
            ),
            array('db' => 'nis', 'dt' => 'nis'),
            array('db' => 'nama', 'dt' => 'nama'),
            array('db' => 'tempat_lahir', 'dt' => 'tempat_lahir'),
            array('db' => 'tanggal_lahir', 'dt' => 'tanggal_lahir'),
            array(
                'db' => 'nis',
                'dt' => 'aksi',
                'formatter' => function( $d) {
                    //return "<a href='edit.php?id=$d'>EDIT</a>";
                    return anchor('siswa/edit/'.$d,'<i class="fa fa-edit"></i>','class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"').' 
                        '.anchor('siswa/delete/'.$d,'<i class="fa fa-trash-o"></i>','class="btn btn-xs btn-danger tooltips" data-placement="top" data-original-title="Delete"');
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
		$data['siswa']			= $this->Model_siswa->daftar_siswa();
		$this->template->load('template', 'siswa/list', $data);
	}

    function add() {
        if (isset($_POST['submit'])) {
            $uploadFoto = $this->upload_foto_siswa();
            $this->Model_siswa->save($uploadFoto);
            redirect('siswa');
        } else {
            $this->template->load('template', 'siswa/add');
        }
    }
    
    function edit(){
        if(isset($_POST['submit'])){
            $uploadFoto = $this->upload_foto_siswa();
			
            $this->Model_siswa->update($uploadFoto);
            redirect('siswa');
        }else{
            $nis           = $this->uri->segment(3);
            $data['siswa'] = $this->db->get_where('tbl_siswa',array('nis'=>$nis))->row_array();
            $this->template->load('template', 'siswa/edit',$data);
        }
    }
    
    function delete(){
        $nis = $this->uri->segment(3);
        if(!empty($nis)){
			$this->Model_siswa->hapus($nis);
        }
        redirect('siswa');
    }
    
    function upload_foto_siswa(){
        $config['upload_path']          = './uploads/foto_siswa/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 1024; // imb
        $this->load->library('upload', $config);
            // proses upload
        $this->upload->do_upload('userfile');
        $upload = $this->upload->data();
        return $upload['file_name'];
    }

}