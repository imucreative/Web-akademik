<?php

class Model_mapel extends CI_Model {

    public $table ="tbl_mapel";
    
    function save() {
        $data = array(
            'kd_mapel'		=> strtoupper($this->input->post('kd_mapel', TRUE)),
            'nama_mapel'	=> strtoupper($this->input->post('nama_mapel', TRUE)),
			'kkm'			=> strtoupper($this->input->post('kkm', TRUE))
        );
        $this->db->insert($this->table,$data);
    }
    
    function update() {
        $data = array(
            'nama_mapel'	=> strtoupper($this->input->post('nama_mapel', TRUE)),
			'kkm'			=> strtoupper($this->input->post('kkm', TRUE))
        );
        $kd_mapel   = $this->input->post('kd_mapel');
        $this->db->where('kd_mapel',$kd_mapel);
        $this->db->update($this->table,$data);
    }
	
	function daftar_mapel(){
		$this->db->where('status_delete', '0');
		$mapel		= $this->db->get('tbl_mapel');
		return $mapel;
	}

	function hapus($id){
        $data = array(
            'status_delete'    => "1"
        );
        $this->db->where('kd_mapel', $id);
        $this->db->update($this->table, $data);
    }
	
	function jumlah_mapel(){
		$this->db->where('status_delete', 0);
		$query	= $this->db->get($this->table);
		return $query->num_rows();
	}
	
}