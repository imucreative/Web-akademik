<?php

Class Users extends CI_Controller {

    function __construct() {
        parent::__construct();
		chekAksesModule();
        $this->load->library('ssp');
        $this->load->model('Model_users');
		
		if(!$this->session->userdata('id_user')){
			redirect('auth/logout');
		}
    }

    function data() {
        // nama tabel
        $table = 'v_tbl_user';
        // nama PK
        $primaryKey = 'id_user';
        // list field
        $columns = array(
            array('db' => 'foto', 'dt' => 'foto'),
            array('db' => 'nama_lengkap', 'dt' => 'nama_lengkap'),
            array('db' => 'nama_level', 'dt' => 'nama_level'),
            array(
                'db' => 'id_user',
                'dt' => 'aksi',
                'formatter' => function( $d) {
                    //return "<a href='edit.php?id=$d'>EDIT</a>";
                    return anchor('users/edit/'.$d,'<i class="fa fa-edit"></i>','class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"').' 
                        '.anchor('users/delete/'.$d,'<i class="fa fa-trash-o"></i>','class="btn btn-xs btn-danger tooltips" data-placement="top" data-original-title="Delete"');
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

    function index() {
		$data['users']	= $this->Model_users->daftar_users();
		$this->template->load('template', 'users/list', $data);
    }

    function add() {
        if (isset($_POST['submit'])) {
            $uplodFoto = $this->upload_foto_user();
            $this->Model_users->save($uplodFoto);
            redirect('users');
        } else {
            $this->template->load('template', 'users/add');
        }
    }
    
    function edit(){
        if(isset($_POST['submit'])){
            $uplodFoto = $this->upload_foto_user();
            $this->Model_users->update($uplodFoto);
            redirect('users');
        }else{
            $id_user       = $this->uri->segment(3);
            $data['user']  = $this->db->get_where('tbl_user',array('id_user'=>$id_user))->row_array();
            $this->template->load('template', 'users/edit',$data);
        }
    }
    
    function delete(){
        $id_user = $this->uri->segment(3);
        if(!empty($id_user)){
            $this->Model_users->hapus($id_user);
        }
        redirect('users');
    }
    
	function upload_foto_user(){
        $config['upload_path']		= './uploads/foto_user/';
        $config['allowed_types']	= 'jpg|png';
        $config['max_size']			= 1024; // imb
        $this->load->library('upload', $config);
            // proses upload
        $this->upload->do_upload('userfile');
        $upload = $this->upload->data();
        return $upload['file_name'];
    }
    
    function rule(){
        $this->template->load('template','users/rule');
    }
    
    function modul(){
        $level_user = $_GET['level_user'];
		
        echo "<table id='mytable' class='table table-striped table-bordered table-hover table-full-width dataTable'>
			<thead>
				<tr>
					<th width='10%'><center>NO</center></th>
					<th width='40%'><center>NAMA MODULE</center></th>
					<th width='35%'><center>LINK</center></th>
					<th width='15%'><center>AKSES</center></th>
				</tr>
			</thead>";
        
		$this->db->where('status_delete', 0);
        $menu = $this->db->get('tabel_menu');
        $no=1;
        foreach ($menu->result() as $row){
            echo "<tr>
                <td align='center'>$no</td>
                <td>".  strtoupper($row->nama_menu)."</td>
                <td>$row->link</td>
                <td align='center'><input type='checkbox' ";
            $this->chek_akses($level_user, $row->id);
             echo " onclick='addRule($row->id)'></td>
                </tr>";
            $no++;
        }
        
        echo"</table>";
    }
    
    function chek_akses($level_user,$id_menu){
        $data = array('id_level_user'=>$level_user,'id_menu'=>$id_menu);
        $chek = $this->db->get_where('tbl_user_rule',$data);
        if($chek->num_rows()>0){
            echo "checked";
        }
    }

    function addrule(){
        $level_user = $_GET['level_user'];
        $id_menu    = $_GET['id_menu'];
        $data       = array('id_level_user'=>$level_user,'id_menu'=>$id_menu);
        $chek       = $this->db->get_where('tbl_user_rule',$data);
        if($chek->num_rows()<1){
            $this->db->insert('tbl_user_rule',$data);
            echo "Berhasil memberikan akses modul";
        }else{
            $this->db->where('id_menu',$id_menu);
            $this->db->where('id_level_user',$level_user);
            $this->db->delete('tbl_user_rule');
            echo "Berhasil delete akses modul";
        }
    }
	
	

}