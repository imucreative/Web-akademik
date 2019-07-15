<?php

class Model_agama extends CI_Model {

    public $table ="tbl_agama";
	
	function disp_agama_by_id($id){
		if(!empty($id)){
			$this->db->select('nama_agama');
			$this->db->where('status_delete', 0);
			$this->db->where('kd_agama',$id);
			$nama = $this->db->get($this->table)->row();
			return isset($nama->nama_agama)?$nama->nama_agama:$id;
		}else return '';
	}
	
}