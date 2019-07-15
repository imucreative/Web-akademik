<?php

class Model_tahun_akademik extends CI_Model {

    public $table ="tbl_tahun_akademik";
    
    function save() {
		$aktif	= $this->input->post('is_aktif', TRUE);
		
		if($aktif == 'Y'){
			$tahun_akademik = $this->db->get_where($this->table, array('is_aktif'=>'Y'));
			foreach ($tahun_akademik->result() as $row){
				$data_aktif = array(
					'is_aktif'	=> 'N'
				);
				$this->db->update($this->table, $data_aktif);
			}
		}
		
		$data = array(
            'tahun_akademik'	=> strtoupper($this->input->post('tahun_akademik', TRUE)),
            'is_aktif'			=> $aktif,
			'semester_aktif'	=> $this->input->post('semester_aktif', TRUE),
			'generate_jadwal'	=> '1'
        );
        $this->db->insert($this->table, $data);
    }
    
    function update() {
		$aktif	= $this->input->post('is_aktif', TRUE);
		
		if($aktif == 'Y'){
			$tahun_akademik = $this->db->get_where($this->table, array('is_aktif'=>'Y'));
			foreach ($tahun_akademik->result() as $row){
				$data_aktif = array(
					'is_aktif'	=> 'N'
				);
				$this->db->update($this->table, $data_aktif);
			}
		}
		
        $data = array(
            'tahun_akademik'    => strtoupper($this->input->post('tahun_akademik', TRUE)),
            'is_aktif'          => $aktif
        );
        $id_tahun_akademik   = $this->input->post('id_tahun_akademik');
        $this->db->where('id_tahun_akademik', $id_tahun_akademik);
        $this->db->update($this->table,$data);
    }

	function daftar_tahunakademik(){
		$this->db->order_by('tahun_akademik', 'desc');
		$this->db->order_by('semester_aktif', 'asc');
		$this->db->where('status_delete', 0);
		$query		= $this->db->get($this->table);
		return $query;
	}
	
	function hapus($id) {
        $data = array(
            'status_delete'    => "1"
        );
        $this->db->where('id_tahun_akademik', $id);
        $this->db->update($this->table, $data);
    }
}