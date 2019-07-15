<?php

class Model_ruangan extends CI_Model {

    public $table ="tbl_ruangan";
    
    function save() {
        $data = array(
            'kd_ruangan'    => strtoupper($this->input->post('kd_ruangan', TRUE)),
            'nama_ruangan'  => strtoupper($this->input->post('nama_ruangan', TRUE))
        );
        $this->db->insert($this->table,$data);
    }
    
    function update() {
        $data = array(
            //'kd_ruangan'    => $this->input->post('kd_ruangan', TRUE),
            'nama_ruangan'  => strtoupper($this->input->post('nama_ruangan', TRUE))
        );
        $kd_ruangan   = $this->input->post('kd_ruangan');
        $this->db->where('kd_ruangan',$kd_ruangan);
        $this->db->update($this->table,$data);
    }

	function daftar_ruangan(){
		$this->db->where('status_delete', '0');
		$ruangan		= $this->db->get($this->table);
		return $ruangan;
	}
	
	function hapus($id) {
        $data = array(
            'status_delete'    => "1"
        );
        $this->db->where('kd_ruangan', $id);
        $this->db->update($this->table, $data);
    }
	
	function jumlah_ruangan(){
		//$query = $this->db->query("SELECT * FROM tbl_siswa WHERE status_delete='0'");
		$this->db->where('status_delete', 0);
		$query	= $this->db->get($this->table);
		return $query->num_rows();
	}
	
}