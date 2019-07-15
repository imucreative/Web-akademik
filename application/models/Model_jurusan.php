<?php

class Model_jurusan extends CI_Model {

    public $table ="tbl_jurusan";
    
    function save() {
        $data = array(
            'kd_jurusan'    => strtoupper($this->input->post('kd_jurusan', TRUE)),
            'nama_jurusan'  => strtoupper($this->input->post('nama_jurusan', TRUE))
        );
        $this->db->insert($this->table,$data);
    }
    
    function update() {
        $data = array(
            'nama_jurusan'  => strtoupper($this->input->post('nama_jurusan', TRUE))
        );
        $kd_jurusan   = $this->input->post('kd_jurusan');
        $this->db->where('kd_jurusan',$kd_jurusan);
        $this->db->update($this->table,$data);
    }
    
    function daftar_jurusan(){
		$this->db->where('status_delete', 0);
		$query		= $this->db->get($this->table);
		return $query;
	}
	
	function disp_jurusan_by_id($id){
		if(!empty($id)){
			$this->db->select('nama_jurusan');
			$this->db->where('status_delete', 0);
			$this->db->where('kd_jurusan',$id);
			$nama = $this->db->get($this->table)->row();
			return isset($nama->nama_jurusan)?$nama->nama_jurusan:$id;
		}else return '';
	}
	
	function hapus($id) {
        $data = array(
            'status_delete'    => "1"
        );
        $this->db->where('kd_jurusan', $id);
        $this->db->update($this->table, $data);
    }
	
	function jumlah_jurusan(){
		//$query = $this->db->query("SELECT * FROM tbl_siswa WHERE status_delete='0'");
		$this->db->where('status_delete', 0);
		$query	= $this->db->get($this->table);
		return $query->num_rows();
	}

}