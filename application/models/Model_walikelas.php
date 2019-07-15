<?php
	class Model_walikelas extends CI_Model{
		
		public $table ="tbl_walikelas";
		
		function setup_walikelas($idTahunAkademik){
			$id_guru	= "1";
			$this->db->where('status_delete', '0');
			$rombel		= $this->db->get('tbl_rombel');
			foreach ($rombel->result() as $row){
				$walikelas = array(
					'id_guru'           =>  $id_guru,
					'id_tahun_akademik' =>  $idTahunAkademik,
					'id_rombel'         =>  $row->id_rombel
				);
				$this->db->insert($this->table,$walikelas);
			}
		}
		
	}