<?php

Class Raport extends CI_Controller{

	function __construct() {
        parent::__construct();
		chekAksesModule();
		if(!$this->session->userdata('id_user')){
			redirect('auth/logout');
		}
    }
	
	// menampilkan list siswa
	function index(){
		$walikelas	= $this->db->get_where('tbl_walikelas', array('id_guru'=>$this->session->userdata('id_guru'), 'id_tahun_akademik'=>get_tahun_akademik_aktif('id_tahun_akademik')))->row_array();
		$rombel		=   "SELECT rb.nama_rombel,  rb.kelas,  jr.nama_jurusan,  mp.nama_mapel
					FROM tbl_jadwal AS j,  tbl_jurusan AS jr,  tbl_rombel AS rb,  tbl_mapel AS mp
					WHERE j.kd_jurusan=jr.kd_jurusan AND rb.id_rombel=j.id_rombel AND mp.kd_mapel=j.kd_mapel 
					AND j.id_rombel='".$walikelas['id_rombel']."'";
		$siswa	=   "SELECT s.nis,  s.nama, hk.id_status_naik_kelas, hk.status_kelulusan
					FROM tbl_history_kelas AS hk,  tbl_siswa AS s 
					WHERE hk.nis=s.nis AND hk.id_rombel=".$walikelas['id_rombel']." 
					AND hk.id_tahun_akademik=".get_tahun_akademik_aktif('id_tahun_akademik');
        
		$data['rombel'] =   $this->db->query($rombel)->row_array();
		$data['siswa']  =   $this->db->query($siswa);
		$this->template->load('template','raport/list_siswa',$data);
	}
	
	function nilai_semester_view(){
		$nis			= $this->uri->segment(3);
		$sqlSiswa		= "SELECT ts.nama as nama_siswa,  ts.nis,  tj.nama_jurusan,  tr.nama_rombel,  tr.kelas, ts.id_rombel, hk.id_status_naik_kelas, hk.status_kelulusan, tr.kelas
			FROM tbl_history_kelas as hk,  tbl_siswa as ts,  tbl_rombel as tr,  tbl_jurusan as tj
			WHERE ts.nis=hk.nis and tr.id_rombel=ts.id_rombel and tr.kd_jurusan=tj.kd_jurusan 
			and hk.nis='$nis' and hk.id_tahun_akademik=".get_tahun_akademik_aktif('id_tahun_akademik');
		$data['siswa']	= $this->db->query($sqlSiswa)->row_array();
		
		$sqlMapel		= "SELECT tj.id_jadwal, tm.nama_mapel, tm.kkm
			FROM tbl_jadwal AS tj,  tbl_mapel AS tm
			WHERE tj.kd_mapel=tm.kd_mapel AND tj.id_rombel=".$data['siswa']['id_rombel']." AND tj.id_tahun_akademik=".get_tahun_akademik_aktif('id_tahun_akademik');
		$data['mapel']	= $this->db->query($sqlMapel)->result();
		
		$this->template->load('template', 'raport/nilai_semester_view', $data);
	}
	
	function nilai_semester(){
		// blok query info siswa
		$nis = $this->uri->segment(3);
		$sqlSiswa = "SELECT ts.nama as nama_siswa,  ts.nis,  tj.nama_jurusan,  tr.nama_rombel,  tr.kelas, ts.id_rombel
				FROM tbl_history_kelas as hk,  tbl_siswa as ts,  tbl_rombel as tr,  tbl_jurusan as tj
				WHERE ts.nis=hk.nis and tr.id_rombel=ts.id_rombel and tr.kd_jurusan=tj.kd_jurusan 
				and hk.nis='$nis' and hk.id_tahun_akademik=".get_tahun_akademik_aktif('id_tahun_akademik');
		$siswa = $this->db->query($sqlSiswa)->row_array();
       
		$this->load->library('CFPDF');
		$pdf = new FPDF('P','mm','A4');
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(190,5,'NAMA SEKOLAH',1,1,'C');
		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(190,7,get_data_sekolah('nama_sekolah'),1,1,'C');
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(190,5,get_data_sekolah('alamat_sekolah').', Telpon : '.get_data_sekolah('telpon'),1,1,'C');
         
        $pdf->Cell(190,5,'',0,1);
        
        $pdf->SetFont('Arial','B',9);
        // BLOCK INFO SISWA
        $pdf->Cell(30,5,'NIS',0,0,'L');
        $pdf->Cell(88,5,': '.$siswa['nis'],0,0,'L');
        $pdf->Cell(30,5,'KELAS',0,0,'L');
        $pdf->Cell(40,5,': '.$siswa['nama_rombel'],0,1,'L');
        
        $pdf->Cell(30,5,'NAMA',0,0,'L');
        $pdf->Cell(88,5,': '.$siswa['nama_siswa'],0,0,'L');
        $pdf->Cell(30,5,'TAHUN AJARAN',0,0,'L');
        $pdf->Cell(40,5,': '.  get_tahun_akademik_aktif('tahun_akademik'),0,1,'L');
        
        $pdf->Cell(30,5,'JURUSAN',0,0,'L');
        $pdf->Cell(88,5,': '.$siswa['nama_jurusan'],0,0,'L');
        $pdf->Cell(30,5,'SEMESTER',0,0,'L');
        $pdf->Cell(40,5,': '.  get_tahun_akademik_aktif('semester_aktif'),0,1,'L');
        
        // END BLOCK INFO SISWA
        
        
        // BLOCK NILAI SISWA ------------------------
        $pdf->Cell(1,10,'',0,1);
        $pdf->Cell(8,5,'NO',1,0,'L');
        $pdf->Cell(50,5,'Mata Pelajaran',1,0,'L');
        $pdf->Cell(10,5,'KKM',1,0,'L');
        $pdf->Cell(12,5,'Angka',1,0,'L');
        $pdf->Cell(30,5,'Huruf',1,0,'L');
        $pdf->Cell(23,5,'Ketercapaian',1,0,'L');
        //$pdf->Cell(20,5,'Rata Kelas',1,0,'L');
        $pdf->Cell(37,5,'Deskripsi Kemampuan',1,1,'L');
        $pdf->SetFont('Arial','',9);
        $sqlMapel = "SELECT tj.id_jadwal, tm.nama_mapel, tm.kkm
			FROM tbl_jadwal AS tj,  tbl_mapel AS tm
			WHERE tj.kd_mapel=tm.kd_mapel AND tj.id_rombel=".$siswa['id_rombel']." AND tj.id_tahun_akademik=".get_tahun_akademik_aktif('id_tahun_akademik');
        $mapel = $this->db->query($sqlMapel)->result();
        $no=1;
        foreach ($mapel as $m){
			$nilai		= chek_nilai($siswa['nis'], $m->id_jadwal, 'nilai');
			$deskripsi	= chek_nilai($siswa['nis'], $m->id_jadwal, 'deskripsi');
			if(empty($deskripsi)){
				$desk	= "";
			}else{
				$desk	= $deskripsi;
			}
			
            $pdf->Cell(8,5,$no,1,0,'L');
            $pdf->Cell(50,5,$m->nama_mapel,1,0,'L');
            $pdf->Cell(10,5,$m->kkm,1,0,'L');
            $pdf->Cell(12,5,$nilai,1,0,'L');
            $pdf->Cell(30,5,Terbilang($nilai),1,0,'L');
            $pdf->Cell(23,5,ketercapaian_kopetensi($nilai),1,0,'L');
            //$pdf->Cell(20,5,ceil(rata_rata_nilai($m->id_jadwal)),1,0,'L');
            $pdf->Cell(37,5,$desk,1,1,'L');
            $no++;
        }
        // END BLOCK NILAI SISWA --------------------------------
        
        $pdf->Cell(190, 5, '',0,1);
        $pdf->Cell(8, 5, 'No', 1,0);
        $pdf->Cell(50, 5, 'Pengembangan Diri', 1,0);
        $pdf->Cell(10, 5, 'Nilai', 1,0);
        $pdf->Cell(66, 5, 'Kepribadian', 1,0);
        $pdf->Cell(20, 5, 'Niilai', 1,0);
        $pdf->Cell(36, 5, 'Catatan Khusus', 1,1);
        
		$pdf->Cell(190, 5, '',0,1);
		$pdf->Cell(45, 15, 'Mengetahui,', 0,0,'C');
		$pdf->Cell(87, 5, '', 0,0,'c');
		$pdf->Cell(25, 5, 'Diberikan Di', 0,0,'c');
		$pdf->Cell(33, 5, ': ', 0,1,'L');
		$pdf->Cell(45, 15, 'Orang Tua Wali', 0,0,'C');
		$pdf->Cell(87, 5, '', 0,0,'c');
		$pdf->Cell(25, 5, 'Pada', 0,0,'c');
		$pdf->Cell(33, 5, ': ', 0,1,'L');
		$pdf->Cell(132, 5, '', 0,0,'c');
		$pdf->Cell(25, 5, 'Wali Kelas', 0,0,'c');
		$pdf->Cell(33, 5, ': ', 0,1,'L');
		$pdf->Output($siswa['nis'].'.pdf', 'D');
	}
	
	function save_status_naik_kelas(){
		$status_naik_kelas	= $_POST['status_naik_kelas'];
		$nis				= $_POST['nis'];
		
		$data = array(
			'id_status_naik_kelas'     => $status_naik_kelas
		);
		$this->db->where('id_tahun_akademik', get_tahun_akademik_aktif('id_tahun_akademik'));
		$this->db->where('nis', $nis);
		$this->db->update('tbl_history_kelas', $data);
		
		//$sqlNaikKelas		= "UPDATE tbl_history_kelas
			//SET id_status_naik_kelas = ".$status_naik_kelas."
			//WHERE nis = '$nis' AND id_tahun_akademik = ".get_tahun_akademik_aktif('id_tahun_akademik');
		//$this->db->query($sqlNaikKelas);
		redirect('/raport/nilai_semester_view/'.$nis);
	}
	
	function save_status_kelulusan(){
		$status_kelulusan	= $_POST['status_kelulusan'];
		$nis				= $_POST['nis'];
		
		$data = array(
			'status_kelulusan'     => $status_kelulusan
		);
		$this->db->where('id_tahun_akademik', get_tahun_akademik_aktif('id_tahun_akademik'));
		$this->db->where('nis', $nis);
		$this->db->update('tbl_history_kelas', $data);
		
		//$sqlKelulusan		= "UPDATE tbl_history_kelas
			//SET status_kelulusan = '$status_kelulusan'
			//WHERE nis = '$nis' AND id_tahun_akademik = ".get_tahun_akademik_aktif('id_tahun_akademik');
		//$this->db->query($sqlKelulusan);
		redirect('/raport/nilai_semester_view/'.$nis);
	}
}