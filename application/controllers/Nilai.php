<?php

Class Nilai extends CI_Controller{
    
	function __construct() {
        parent::__construct();
		chekAksesModule();
		if(!$this->session->userdata('id_user')){
			redirect('auth/logout');
		}
    }
	
    function index(){
		// load daftar ngajar guru
        $sql = "SELECT tj.id_rombel,  tj.id_jadwal,  tjr.nama_jurusan,  tj.kelas,  tm.nama_mapel,  tj.jam,  tr.nama_ruangan,  tj.hari,  tj.semester,  rb.nama_rombel
			FROM tbl_jadwal AS tj,  tbl_jurusan AS tjr,  tbl_ruangan AS tr,  tbl_mapel AS tm,  tbl_rombel AS rb
			WHERE tj.kd_jurusan=tjr.kd_jurusan AND tj.kd_mapel=tm.kd_mapel AND tj.kd_ruangan=tr.kd_ruangan AND rb.id_rombel=tj.id_rombel AND tj.id_guru=".$this->session->userdata('id_guru')." AND tj.id_tahun_akademik=".get_tahun_akademik_aktif('id_tahun_akademik')." AND tj.semester=".get_tahun_akademik_aktif('semester_aktif');
        $data['jadwal'] = $this->db->query($sql); 
        $this->template->load('template','nilai/list_kelas',$data);
    }
    
    function rombel(){
        $id_jadwal      = $this->uri->segment(3);
        $jadwal         = $this->db->get_where('tbl_jadwal',array('id_jadwal'=>$id_jadwal))->row_array();
        $id_rombel      = $jadwal['id_rombel'];
        $rombel         =   "SELECT rb.nama_rombel,rb.kelas,jr.nama_jurusan, mp.nama_mapel, mp.kkm
                            FROM tbl_jadwal AS j, tbl_jurusan as jr, tbl_rombel as rb, tbl_mapel as mp
                            WHERE j.kd_jurusan=jr.kd_jurusan and rb.id_rombel=j.id_rombel and mp.kd_mapel=j.kd_mapel 
                            and j.id_jadwal='$id_jadwal' AND rb.id_rombel='$id_rombel'";
        $siswa          =   "SELECT s.nis, s.nama
                            FROM tbl_history_kelas as hk, tbl_siswa as s 
                            WHERE hk.nis=s.nis AND hk.id_tahun_akademik=".get_tahun_akademik_aktif('id_tahun_akademik')."
                            and hk.id_rombel='$id_rombel'";
        $data['rombel'] =   $this->db->query($rombel)->row_array();
        $data['siswa']  =   $this->db->query($siswa)->result();
        $this->template->load('template','nilai/form_nilai',$data);
    }
    
 
    
    function update_nilai(){
        $nis        = $_GET['nis'];
        $id_jadwal  = $_GET['id_jadwal'];
        $nilai      = $_GET['nilai'];
        
        // parameter nim
        $params = array('nis'=>$nis, 'id_jadwal'=>$id_jadwal, 'nilai'=>$nilai);
		
        $validasi = array('nis'=>$nis, 'id_jadwal'=>$id_jadwal);
        $chek = $this->db->get_where('tbl_nilai', $validasi);
        if($chek->num_rows()>0){
            // proses update
            $this->db->where('nis', $nis);
            $this->db->where('id_jadwal', $id_jadwal);
            $this->db->update('tbl_nilai', array('nilai'=>$nilai));
			echo "Nilai berhasil diedit";
        }else{
            // proses insert
            $this->db->insert('tbl_nilai',$params);
            echo "Nilai berhasil diinput";
        }
    }
	
	function update_deskripsi(){
        $nis        = $_GET['nis'];
        $id_jadwal  = $_GET['id_jadwal'];
        $deskripsi      = $_GET['deskripsi'];
        
        // parameter nim
        $params = array('nis'=>$nis, 'id_jadwal'=>$id_jadwal, 'deskripsi'=>$deskripsi);
		
        $validasi = array('nis'=>$nis, 'id_jadwal'=>$id_jadwal);
        $chek = $this->db->get_where('tbl_nilai', $validasi);
        if($chek->num_rows()>0){
            // proses update
            $this->db->where('nis', $nis);
            $this->db->where('id_jadwal', $id_jadwal);
            $this->db->update('tbl_nilai', array('deskripsi'=>$deskripsi));
			echo "Deskripsi berhasil diedit";
        }else{
            // proses insert
            $this->db->insert('tbl_nilai',$params);
            echo "Deskripsi berhasil diinput";
        }
    }
}