<?php

class Model_rombel extends CI_Model {

    public $table ="tbl_rombel";
    
    function save() {
        $data = array(
            'kd_jurusan'	=> $this->input->post('jurusan', TRUE),
            'kelas'			=> $this->input->post('kelas', TRUE),
            'nama_rombel'	=> strtoupper($this->input->post('nama_rombel', TRUE))
        );
        $this->db->insert($this->table,$data);
    }
    
    function update() {
        $data = array(
            'kd_jurusan'    => $this->input->post('jurusan', TRUE),
            'kelas'    => $this->input->post('kelas', TRUE),
            'nama_rombel'  => strtoupper($this->input->post('nama_rombel', TRUE))
        );
        $id_rombel   = $this->input->post('id_rombel');
        $this->db->where('id_rombel',$id_rombel);
        $this->db->update($this->table,$data);
    }
	
	function disp_rombel_by_id($id){
		$this->db->where('status_delete', 0);
		$this->db->where('id_rombel', $id);
		$query = $this->db->get($this->table);
		return $query;
	}
	
	function disp_rombel_by_nama($nama){
		$this->db->where('status_delete', 0);
		$this->db->where('nama_rombel',$nama);
		$query = $this->db->get($this->table);
		return $query;
	}
	
	function hapus($id) {
        $data = array(
            'status_delete'    => "1"
        );
        $this->db->where('id_rombel', $id);
        $this->db->update($this->table, $data);
    }
    
	function daftar_rombel(){
		$this->db->where('status_delete', 0);
		$this->db->order_by('nama_rombel', 'asc');
		$query	= $this->db->get($this->table);
		return $query;
	}
	
	function daftar_rombel_by_kd_jurusan($kd_jurusan){
		$this->db->where('kd_jurusan', $kd_jurusan);
		$this->db->where('status_delete', 0);
		$this->db->order_by('nama_rombel', 'asc');
		$query	= $this->db->get($this->table);
		return $query;
	}
	
	function cek_max_id(){
		$this->db->select_max("id_rombel");
		$this->db->where('status_delete', 0);
		$query	= $this->db->get($this->table)->row();
		return isset($query->id_rombel)?$query->id_rombel:"";
	}
	
	function jumlah_rombel(){
		$this->db->where('status_delete', 0);
		$query	= $this->db->get($this->table);
		return $query->num_rows();
	}
	/*
	function select_rombel_by_kelas_jurusan($kelas, $kd_jurusan){
		$this->db->where('status_delete', 0);
		$this->db->where('kelas',$kelas);
		$this->db->where('kd_jurusan',$kd_jurusan);
		$nama = $this->db->get($this->table)->row();
		return $nama;
	}
	*/

}