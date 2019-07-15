<?php

Class sekolah extends CI_Controller {

    function __construct() {
        parent::__construct();
		chekAksesModule();
        $this->load->model('Model_sekolah');
		
		if(!$this->session->userdata('id_user')){
			redirect('auth/logout');
		}
    }
    
    function index() {
        if (isset($_POST['submit'])) {
            $this->Model_sekolah->update();
            redirect('sekolah');
        } else {
            //$data['info']	= $this->db->get_where('tbl_sekolah_info', array('id_sekolah' => 1))->row_array();
			$data['info']	= $this->Model_sekolah->select_info_sekolah()->row_array();
            $this->template->load('template', 'info_sekolah', $data);
        }
    }

}