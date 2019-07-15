<?php

class Model_kurikulum extends CI_Model {

    public $table ="tbl_kurikulum";
    
    function save() {
		$aktif	= $this->input->post('is_aktif', TRUE);
		
		if($aktif == 'Y'){
			$kurikulum	= $this->db->get_where($this->table, array('is_aktif'=>'Y'));
			foreach ($kurikulum->result() as $row){
				$data_aktif = array(
					'is_aktif'	=> 'N'
				);
				$this->db->update($this->table, $data_aktif);
			}
		}
		
        $data = array(
            'nama_kurikulum'    => strtoupper($this->input->post('nama_kurikulum', TRUE)),
            'is_aktif'          => $aktif
        );
        $this->db->insert($this->table,$data);
    }
    
    function update() {
		$aktif	= $this->input->post('is_aktif', TRUE);
		
		if($aktif == 'Y'){
			$kurikulum = $this->db->get_where($this->table, array('is_aktif'=>'Y'));
			foreach ($kurikulum->result() as $row){
				$data_aktif = array(
					'is_aktif'	=> 'N'
				);
				$this->db->update($this->table, $data_aktif);
			}
		}
		
        $data = array(
            'nama_kurikulum'    => strtoupper($this->input->post('nama_kurikulum', TRUE)),
            'is_aktif'          => $aktif
        );
        $id_kurikulum   = $this->input->post('id_kurikulum');
        $this->db->where('id_kurikulum',$id_kurikulum);
        $this->db->update($this->table,$data);
    }
	
	function hapus($id) {
        $data = array(
            'status_delete'    => "1"
        );
        $this->db->where('id_kurikulum', $id);
        $this->db->update($this->table, $data);
    }
	
	function hapus_detail($id) {
        $data = array(
            'status_delete'    => "1"
        );
        $this->db->where('id_kurikulum_detail', $id);
        $this->db->update("tbl_kurikulum_detail", $data);
    }
    
    function addKurikulumDetail(){
         $data = array(
            'kd_mapel'       => $this->input->post('kd_mapel', TRUE),
            'kelas'          => $this->input->post('kelas', TRUE),
            'kd_jurusan'     => $this->input->post('jurusan', TRUE),
            'id_kurikulum'   => $this->input->post('id_kurikulum', TRUE)
        );
        $this->db->insert('tbl_kurikulum_detail',$data);
    }
	
	function daftar_kurikulum(){
		$this->db->where('status_delete', '0');
		$query		= $this->db->get($this->table);
		return $query;
	}

}