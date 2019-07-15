<?php

class Model_jenis_pembayaran extends CI_Model {

    public $table ="tbl_jenis_pembayaran";
    
    function save() {
        $data = array(
            'nama_jenis_pembayaran'  => strtoupper($this->input->post('nama_jenis_pembayaran', TRUE)),
			'keterangan'  => strtoupper($this->input->post('keterangan', TRUE))
        );
        $this->db->insert($this->table,$data);
    }
    
    function update() {
        $data = array(
            'nama_jenis_pembayaran'  => strtoupper($this->input->post('nama_jenis_pembayaran', TRUE)),
			'keterangan'  => strtoupper($this->input->post('keterangan', TRUE))
        );
        $id_jenis_pembayaran   = $this->input->post('id_jenis_pembayaran');
        $this->db->where('id_jenis_pembayaran',$id_jenis_pembayaran);
        $this->db->update($this->table,$data);
    }

	function daftar_jenis_pembayaran(){
		$this->db->where('status_delete', 0);
		$query		= $this->db->get($this->table);
		return $query;
	}
	
	function hapus($id) {
        $data = array(
            'status_delete'    => "1"
        );
        $this->db->where('id_jenis_pembayaran', $id);
        $this->db->update($this->table, $data);
    }
	
	function disp_jenis_pembayaran_by_id($id){
		if(!empty($id)){
			$this->db->select('nama_jenis_pembayaran');
			$this->db->where('status_delete', 0);
			$this->db->where('id_jenis_pembayaran',$id);
			$nama = $this->db->get("tbl_jenis_pembayaran")->row();
			return isset($nama->nama_jenis_pembayaran)?$nama->nama_jenis_pembayaran:$id;
		}else return '';
	}	
}