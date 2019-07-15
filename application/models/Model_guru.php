<?php

class Model_guru extends CI_Model {

    public $table ="tbl_guru";
    
    function save() {
        $data = array(
            'nuptk'      => strtoupper($this->input->post('nuptk', TRUE)),
            'nama_guru'  => strtoupper($this->input->post('nama_guru', TRUE)),
            'gender'     => $this->input->post('gender', TRUE)
        );
        $this->db->insert($this->table, $data);
    }
    
    function update() {
        $data = array(
            'nuptk'      => strtoupper($this->input->post('nuptk', TRUE)),
            'nama_guru'  => strtoupper($this->input->post('nama_guru', TRUE)),
            'gender'     => $this->input->post('gender', TRUE)
        );
        $id_guru   = $this->input->post('id_guru');
        $this->db->where('id_guru',$id_guru);
        $this->db->update($this->table,$data);
		
		
    }
    
    function chekLogin($username,$password){
		$this->db->where('status_delete', 0);
        $this->db->where('username',$username);
        $this->db->where('password',  md5($password));
        $user = $this->db->get($this->table)->row_array();
        return $user;
    }
	
	function daftar_guru(){
		$this->db->where('status_delete', 0);
		$query		= $this->db->get($this->table);
		return $query;
	}
	
	function hapus($id) {
        $data = array(
            'status_delete'    => "1"
        );
        $this->db->where('id_guru', $id);
        $this->db->update($this->table, $data);
    }
	
	function cek_max_id(){
		$this->db->select_max("id_guru");
		$this->db->where('status_delete', 0);
		$query	= $this->db->get($this->table)->row();
		return isset($query->id_guru)?$query->id_guru:"";
	}
	
	function cek_min_id(){
		$this->db->select_min("id_guru");
		$this->db->where('status_delete', 0);
		$query	= $this->db->get($this->table)->row();
		return isset($query->id_guru)?$query->id_guru:"";
	}
	
	function jumlah_guru(){
		//$query = $this->db->query("SELECT * FROM tbl_siswa WHERE status_delete='0'");
		$this->db->where('status_delete', 0);
		$query	= $this->db->get($this->table);
		return $query->num_rows();
	}
	
	function jumlah_guru_l(){
		$this->db->where('status_delete', 0);
		$this->db->where('gender', 'L');
		$query	= $this->db->get($this->table);
		return $query->num_rows();
	}
	
	function jumlah_guru_p(){
		$this->db->where('status_delete', 0);
		$this->db->where('gender', 'P');
		$query	= $this->db->get($this->table);
		return $query->num_rows();
	}

}