<?php
class Model_jadwal extends CI_Model{
    
    function getJamPelajaran(){
        $jam_pelajaran = array(
            '07.15 - 08.00' =>'07.15 - 08.00',
            '08.00 - 08.45' =>'08.00 - 08.45',
            '08.45 - 09.30' =>'08.45 - 09.30',
            '09.30 - 10.00' =>'09.30 - 10.00',
            '10.00 - 10.45' =>'10.00 - 10.45',
            '10.45 - 11.30' =>'10.45 - 11.30',
            '11.30 - 12.15' =>'11.30 - 12.15',
            '12.15 - 13.00' =>'12.15 - 13.00',
            '13.00 - 13.30' =>'13.00 - 13.30',
            '13.30 - 14.15' =>'13.30 - 14.15',
            '14.15 - 15.00' =>'14.15 - 15.00');
        return $jam_pelajaran;
    }
    
    function generateJadwal(){
        $id_kurikulum = $this->input->post('kurikulum');
        $semester     = $this->input->post('semester');
        // ambil data berdasarkan kurikulum yang dipilih
        
		$kurikulum_detail = $this->db->get_where('tbl_kurikulum_detail',array('id_kurikulum'=>$id_kurikulum));
        
        // ambil tahun akademik aktif
        //$tahun_akademik = $this->db->get_where('tbl_tahun_akademik',array('is_aktif'=>'Y'))->row_array();
        
        foreach ($kurikulum_detail->result() as $row){
            // dapatkan rombel base on jurusan dan kelas
            $rombel = $this->db->get_where('tbl_rombel',array('kd_jurusan'=>$row->kd_jurusan,'kelas'=>$row->kelas));
            foreach ($rombel->result() as $row_rombel){
                $data = array(
                    //'id_tahun_akademik' => $tahun_akademik['id_tahun_akademik'],
					'id_tahun_akademik' => get_tahun_akademik_aktif('id_tahun_akademik'),
                    'kd_jurusan'        => $row->kd_jurusan,
                    'kelas'             => $row->kelas,
					'kd_mapel'          => $row->kd_mapel,
                    'id_guru'           => '1',
                    'jam'               => '07.15 - 08.00',
					'kd_ruangan'        => '11',
					'semester'          => $semester,
                    'hari'              => 'SENIN',
                    'id_rombel'         => $row_rombel->id_rombel
				);
				$this->db->insert('tbl_jadwal',$data);
            }
        }
		
		$data = array(
            'generate_jadwal'	=> '0'
        );
        $this->db->where('id_tahun_akademik', get_tahun_akademik_aktif('id_tahun_akademik'));
        $this->db->update('tbl_tahun_akademik', $data);
    }
    
}