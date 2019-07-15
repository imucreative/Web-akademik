<?php

class Model_sms_group extends CI_Model {

    public $table ="tbl_sms_group";
    
    function save() {
        $data = array(
            'nama_group'  => strtoupper($this->input->post('nama_group', TRUE))
        );
        $this->db->insert($this->table,$data);
        return  $this->db->insert_id();
    }
    
    function update() {
        $data = array(
             'nama_group'  => strtoupper($this->input->post('nama_group', TRUE))
        );
        $id   = $this->input->post('id');
        $this->db->where('id',$id);
        $this->db->update($this->table,$data);
    }

	function hapus($id) {
        $data = array(
            'status_delete'    => "1"
        );
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }
	
	function daftar_sms_group(){
		$this->db->where('status_delete', 0);
		$query		= $this->db->get($this->table);
		return $query;
	}
}