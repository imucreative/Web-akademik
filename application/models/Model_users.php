<?php

class Model_users extends CI_Model {

    public $table ="tbl_user";
    
    function save($foto) {
		$level	= $this->input->post('id_level_user', TRUE);
		if(($level == '3')||($level == '4')){
			if(empty($foto)){
				$data = array(
					'nama_lengkap'		=> strtoupper($this->input->post('nama_lengkap', TRUE)),
					'username'			=> $this->input->post('username', TRUE),
					'password'			=> md5($this->input->post('password', TRUE)),
					'id_level_user'		=> $level,
					'id_guru'			=> $this->input->post('id_guru', TRUE)
				);
			}else{
				$data = array(
					'nama_lengkap'		=> strtoupper($this->input->post('nama_lengkap', TRUE)),
					'username'			=> $this->input->post('username', TRUE),
					'password'			=> md5($this->input->post('password', TRUE)),
					'id_level_user'		=> $level,
					'id_guru'			=> $this->input->post('id_guru', TRUE),
					'foto'				=> $foto
				);
			}
		}else{
			if(empty($foto)){
				$data = array(
					'nama_lengkap'		=> strtoupper($this->input->post('nama_lengkap', TRUE)),
					'username'			=> $this->input->post('username', TRUE),
					'password'			=> md5($this->input->post('password', TRUE)),
					'id_level_user'		=> $level
				);
			}else{
				$data = array(
					'nama_lengkap'		=> strtoupper($this->input->post('nama_lengkap', TRUE)),
					'username'			=> $this->input->post('username', TRUE),
					'password'			=> md5($this->input->post('password', TRUE)),
					'id_level_user'		=> $level,
					'foto'				=> $foto
				);
			}
		}
        $this->db->insert($this->table, $data);
    }
	
	function saveFormGuru($id_guru){
		$data_user = array(
			'nama_lengkap'		=> strtoupper($this->input->post('nama_guru', TRUE)),
			'username'			=> $this->input->post('username', TRUE),
			'password'			=> md5($this->input->post('password', TRUE)),
			'id_level_user'		=> '3',
			'id_guru'			=> $id_guru
		);
		
		$this->db->insert($this->table, $data_user);
	}
	
	function editFormGuru(){
		$data_user = array(
			'nama_lengkap'  => strtoupper($this->input->post('nama_guru', TRUE))
		);
		
		$id_guru   = $this->input->post('id_guru');
        $this->db->where('id_guru', $id_guru);
        $this->db->update($this->table, $data_user);
	}
    
    function update($foto) {
		$level	= $this->input->post('id_level_user', TRUE);
		if(($level == '3')||($level == '4')){
			if(empty($foto)){
				// jangan update field foto
				$data = array(
					'nama_lengkap'		=> strtoupper($this->input->post('nama_lengkap', TRUE)),
					'username'			=> $this->input->post('username', TRUE),
					'password'			=> md5($this->input->post('password', TRUE)),
					'id_level_user'		=> $level,
					'id_guru'			=> $this->input->post('id_guru', TRUE)
				);
			}else{
				// update field foto
				$data = array(
					'nama_lengkap'		=> strtoupper($this->input->post('nama_lengkap', TRUE)),
					'username'			=> $this->input->post('username', TRUE),
					'password'			=> md5($this->input->post('password', TRUE)),
					'id_level_user'		=> $level,
					'id_guru'			=> $this->input->post('id_guru', TRUE),
					'foto'				=> $foto
				);
			}
			
			$data_guru = array(
				'nama_guru'  => strtoupper($this->input->post('nama_lengkap', TRUE))
			);
			$id_guru   = $this->input->post('id_guru', TRUE);
			$this->db->where('id_guru',$id_guru);
			$this->db->update('tbl_guru',$data_guru);
		}else{
			if(empty($foto)){
				// jangan update field foto
				$data = array(
					'nama_lengkap'		=> strtoupper($this->input->post('nama_lengkap', TRUE)),
					'username'			=> $this->input->post('username', TRUE),
					'password'			=> md5($this->input->post('password', TRUE)),
					'id_level_user'		=> $level
				);
			}else{
				// update field foto
				$data = array(
					'nama_lengkap'		=> strtoupper($this->input->post('nama_lengkap', TRUE)),
					'username'			=> $this->input->post('username', TRUE),
					'password'			=> md5($this->input->post('password', TRUE)),
					'id_level_user'		=> $level,
					'foto'				=> $foto
				);
			}
		}
		
        $id_user   = $this->input->post('id_user');
        $this->db->where('id_user',$id_user);
        $this->db->update($this->table,$data);
    }
	
	function daftar_users(){
		$this->db->where('id_level_user!=', 1);
		$this->db->where('status_delete', 0);
		$this->db->order_by('id_level_user', 'ASC');
		$query		= $this->db->get($this->table);
		return $query;
	}
	
	function hapus($id) {
        $data = array(
            'status_delete'    => "1"
        );
        $this->db->where('id_user', $id);
        $this->db->update($this->table, $data);
    }
	
	function disp_nama_level($id){
		if(!empty($id)){
			$this->db->select('nama_level');
			$this->db->where('status_delete', 0);
			$this->db->where('id_level_user',$id);
			$nama = $this->db->get("tbl_level_user")->row();
			return isset($nama->nama_level)?$nama->nama_level:$id;
		}else return '';
	}
	
	function updateProfil() {
		$data = array(
			'password'	=> md5($this->input->post('password', TRUE))
		);
		$id_user = $this->input->post('id_user');
		$this->db->where('id_user', $id_user);
		$this->db->update($this->table, $data);
	}

}