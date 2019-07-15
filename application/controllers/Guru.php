<?php

Class Guru extends CI_Controller {

    function __construct() {
        parent::__construct();
		chekAksesModule();
        $this->load->library('ssp');
        $this->load->model('Model_guru');
		$this->load->model('Model_users');
		
		if(!$this->session->userdata('id_user')){
			redirect('auth/logout');
		}
    }

    function data() {
        // nama tabel
        $table = 'tbl_guru';
        // nama PK
        $primaryKey = 'id_guru';
        // list field
        $columns = array(
            array('db' => 'id_guru', 'dt' => 'id_guru'),
            array('db' => 'nuptk', 'dt' => 'nuptk'),
            array('db' => 'nama_guru', 'dt' => 'nama_guru'),
            array('db' => 'gender', 
                  'dt' => 'gender',
                  'formatter' => function( $d) {
                    //return "<a href='edit.php?id=$d'>EDIT</a>";
                    return $d=='l'?'LAKI LAKI':'WANITA';
                }),
            array(
                'db' => 'id_guru',
                'dt' => 'aksi',
                'formatter' => function( $d) {
                    //return "<a href='edit.php?id=$d'>EDIT</a>";
                    return anchor('guru/edit/'.$d,'<i class="fa fa-edit"></i>','class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"').' 
                        '.anchor('guru/delete/'.$d,'<i class="fa fa-trash-o"></i>','class="btn btn-xs btn-danger tooltips" data-placement="top" data-original-title="Delete"');
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
		$data['guru']	= $this->Model_guru->daftar_guru();
		$this->template->load('template', 'guru/list', $data);
	}

    function add() {
        if (isset($_POST['submit'])) {
            $this->Model_guru->save();
			
			$id_guru	= $this->db->insert_id();
			$this->Model_users->saveFormGuru($id_guru);
			
            redirect('guru');
        } else {
            $this->template->load('template', 'guru/add');
        }
    }
    
    function edit(){
        if(isset($_POST['submit'])){
            $this->Model_guru->update();
			
			$this->Model_users->editFormGuru();
            redirect('guru');
        }else{
            $id_guru      = $this->uri->segment(3);
            $data['guru'] = $this->db->get_where('tbl_guru',array('id_guru'=>$id_guru))->row_array();
            $this->template->load('template', 'guru/edit',$data);
        }
    }
    
    function delete(){
        $id_guru = $this->uri->segment(3);
        if(!empty($id_guru)){
            $this->Model_guru->hapus($id_guru);
        }
        redirect('guru');
    }

}