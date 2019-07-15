<?php

class Model_siswa extends CI_Model {

    public $table ="tbl_siswa";
    
    function save($foto) {
        $data = array(
            'nis'           => strtoupper($this->input->post('nis', TRUE)),
            'kd_agama'      => $this->input->post('agama', TRUE),
            'nama'          => strtoupper($this->input->post('nama', TRUE)),
            'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),
            'tempat_lahir'  => strtoupper($this->input->post('tempat_lahir', TRUE)),
            'gender'        => $this->input->post('gender', TRUE),
            'foto'          => $foto,
            'id_rombel'     => $this->input->post('rombel',TRUE)
        );
        $this->db->insert($this->table, $data);
        
        $tahun_akademik = $this->db->get_where('tbl_tahun_akademik',array('is_aktif'=>'Y'))->row_array();
        
        $history =  array(
            'nis'                 =>  $this->input->post('nis', TRUE),
            'id_tahun_akademik'   =>  $tahun_akademik['id_tahun_akademik'],
            'id_rombel'           =>  $this->input->post('rombel', TRUE)
		);
        $this->db->insert('tbl_history_kelas',$history);
    }
    
    function update($foto) {
        if(empty($foto)){
            // update without foto
            $data = array(
				'nama'          => strtoupper($this->input->post('nama', TRUE)),
				'kd_agama'      => $this->input->post('agama', TRUE),
				'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),
				'tempat_lahir'  => strtoupper($this->input->post('tempat_lahir', TRUE)),
				'gender'        => $this->input->post('gender', TRUE),
				'id_rombel'     => $this->input->post('rombel', TRUE)
			);
        }else{
            // update with foto
            $data = array(
				'nama'          => strtoupper($this->input->post('nama', TRUE)),
				'kd_agama'      => $this->input->post('agama', TRUE),
				'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),
				'tempat_lahir'  => strtoupper($this->input->post('tempat_lahir', TRUE)),
				'gender'        => $this->input->post('gender', TRUE),
				'foto'          => $foto,
				'id_rombel'     => $this->input->post('rombel',TRUE)
			);
        }
		
		$history =  array(
            'id_rombel'           =>  $this->input->post('rombel', TRUE)
		);
		
        $nis   = $this->input->post('nis');
        $this->db->where('nis',$nis);
        $this->db->update($this->table,$data);
		
		$this->db->where('nis',$nis);
        $this->db->update('tbl_history_kelas',$history);
    }
	
	function hapus($id) {
        $data = array(
            'status_delete'    => "1"
        );
        $this->db->where('nis', $id);
        $this->db->update($this->table, $data);
		
		$this->db->where('nis', $id);
        $this->db->update('tbl_history_kelas', $data);
    }
	
	function daftar_siswa(){
		//$this->db->where('status_delete', 0);
		//$this->db->order_by('id_rombel', 'asc');
		//$siswa		= $this->db->get('tbl_siswa');
		$query	= "SELECT s.*, hk.*
			FROM tbl_siswa AS s, tbl_history_kelas AS hk
			WHERE s.nis=hk.nis AND hk.id_tahun_akademik=".get_tahun_akademik_aktif('id_tahun_akademik')." AND s.status_delete='0' AND hk.status_kelulusan!='LULUS' ORDER BY s.id_rombel ASC";
		$siswa	= $this->db->query($query);
		return $siswa;
	}
	
	function daftar_siswa_tbl_siswa(){
		$this->db->where('status_delete', 0);
		$this->db->order_by('id_rombel', 'asc');
		$siswa		= $this->db->get('tbl_siswa');
		return $siswa;
	}
	
	function daftar_siswa_by_rombel($id_rombel){
		$this->db->where('id_rombel', $id_rombel);
		$this->db->where('status_delete', 0);
		$this->db->order_by('id_rombel', 'asc');
		$siswa		= $this->db->get($this->table);
		return $siswa;
	}
	
	function input_history_siswa($tahun_akademik){
		$siswa = $this->db->get_where('tbl_siswa', array('status_delete'=>'0'));
		
		//$this->db->where('status_delete', 0);
		//$siswa		= $this->db->get($this->table);
		
		//$query	= "SELECT s.*, hk.*
			//FROM tbl_siswa AS s, tbl_history_kelas AS hk
			//WHERE s.nis=hk.nis AND hk.id_tahun_akademik=".get_tahun_akademik_aktif('id_tahun_akademik')." AND s.status_delete='0' AND hk.status_kelulusan=''";
		//$siswa	= $this->db->query($query);
		
		foreach ($siswa->result() as $row){
			$rombel			= $this->Model_rombel->disp_rombel_by_id($row->id_rombel)->row_array();
			$kelas			= $rombel['kelas'];
			$tahun_akademik_sebelumnya	= $tahun_akademik - 1;
			$cek_nis_history_siswa		= $this->cek_nis_history_siswa($row->nis, $tahun_akademik_sebelumnya)->row_array();
			
			if($kelas != 3){
				if(($cek_nis_history_siswa['id_status_naik_kelas'] == 1)||$cek_nis_history_siswa['id_status_naik_kelas'] == 2){
					$data = array(
						'id_rombel'			=> $row->id_rombel,
						'nis'				=> $row->nis,
						'id_tahun_akademik'	=> $tahun_akademik
					);
					$this->db->insert('tbl_history_kelas', $data);
				}
			}else{
				if(get_tahun_akademik_aktif('semester_aktif') == 2){
					$data = array(
						'id_rombel'			=> $row->id_rombel,
						'nis'				=> $row->nis,
						'id_tahun_akademik'	=> $tahun_akademik
					);
					$this->db->insert('tbl_history_kelas', $data);
				}
			}
        }
	}
	
	function jumlah_siswa(){
		$this->db->where('status_delete', 0);
		$query	= $this->db->get($this->table);
		return $query->num_rows();
	}
	
	function jumlah_siswa_by_rombel($id_rombel, $id_tahun_akademik){
		$this->db->where('status_delete', 0);
		$this->db->where('id_rombel', $id_rombel);
		$this->db->where('id_tahun_akademik', $id_tahun_akademik);
		$query	= $this->db->get("tbl_history_kelas");
		return $query->num_rows();
	}
	
	function jumlah_siswa_l(){
		$this->db->where('status_delete', 0);
		$this->db->where('gender', 'L');
		$query	= $this->db->get($this->table);
		return $query->num_rows();
	}
	
	function jumlah_siswa_p(){
		$this->db->where('status_delete', 0);
		$this->db->where('gender', 'P');
		$query	= $this->db->get($this->table);
		return $query->num_rows();
	}
	
	function update_rombel_untuk_naik_kelas($nis, $id_rombel){
		$data = array(
			'id_rombel'			=> $id_rombel
		);
        $this->db->where('nis', $nis);
        $this->db->update($this->table, $data);
    }
	
	function update_rombel_untuk_naik_kelas_history_siswa($nis, $id_rombel, $id_tahun_akademik){
		$data = array(
			'id_rombel'			=> $id_rombel
		);
        $this->db->where('nis', $nis);
		$this->db->where('id_tahun_akademik', $id_tahun_akademik);
        $this->db->update("tbl_history_kelas", $data);
    }
	
	function cek_nis_history_siswa($nis, $id_tahun_akademik){
		$this->db->where('status_delete', 0);
		$this->db->where('nis', $nis);
		$this->db->where('id_tahun_akademik', $id_tahun_akademik);
		$this->db->where('id_status_naik_kelas', 1);
		$query	= $this->db->get("tbl_history_kelas");
		return $query;
	}
	
	function update_siswa_lulus($id_history){
		$data = array(
			'status_kelulusan'	=> "LULUS"
		);
        $this->db->where('id_history', $id_history);
        $this->db->update("tbl_history_kelas", $data);
	}
}