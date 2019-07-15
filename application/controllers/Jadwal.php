<?php

Class jadwal extends CI_Controller{
    
    function __construct() {
        parent::__construct();
		chekAksesModule();
        $this->load->model(array('Model_jadwal'));
		$this->load->model(array('Model_rombel'));
		
		if(!$this->session->userdata('id_user')){
			redirect('auth/logout');
		}
    }
    
    function index(){
        if(($this->session->userdata('id_level_user')==3)||($this->session->userdata('id_level_user')==4)){
            // load daftar ngajar guru
            $sql = "SELECT tj.id_jadwal,  tjr.nama_jurusan,  tj.kelas,  tm.nama_mapel,  tj.jam,  tr.nama_ruangan,  tj.hari,  tj.semester,  rb.nama_rombel
                    FROM tbl_jadwal AS tj,  tbl_jurusan AS tjr,  tbl_ruangan AS tr,  tbl_mapel AS tm,  tbl_rombel AS rb
                    WHERE tj.kd_jurusan=tjr.kd_jurusan AND tj.kd_mapel=tm.kd_mapel AND tj.kd_ruangan=tr.kd_ruangan AND rb.id_rombel=tj.id_rombel AND tj.id_guru=".$this->session->userdata('id_guru')." AND tj.id_tahun_akademik=".get_tahun_akademik_aktif('id_tahun_akademik')." AND tj.semester=".get_tahun_akademik_aktif('semester_aktif');
            $data['jadwal'] = $this->db->query($sql);
            $this->template->load('template','jadwal/jadwal_ajar_guru',$data);
        }else{
			$infoSekolah = "SELECT js.jumlah_kelas
							FROM tbl_jenjang_sekolah AS js, tbl_sekolah_info AS si 
							WHERE js.id_jenjang=si.id_jenjang_sekolah";
			$data['info']= $this->db->query($infoSekolah)->row_array();
			$this->template->load('template','jadwal/list', $data);
        }
    }
    
    function generate_jadwal(){
        if(isset($_POST['submit'])){
            $this->Model_jadwal->generateJadwal();
        }
        redirect('jadwal');
    }
    
    function dataJadwal(){
        $kd_jurusan     = $_GET['jurusan'];
        $kelas          = $_GET['kelas'];
        $id_kurikulum   = $_GET['id_kurikulum'];
        $rombel         = $_GET['rombel'];
        if($kelas=='semua_kelas'){
            $selected_kelas = '';
        }else{
            $selected_kelas="and kd.kelas='$kelas'";
        }
        echo "<table class='table table-striped table-bordered table-hover table-full-width dataTable'>
                <thead>
                    <tr>
                        <th width='5%'><center>NO</center></th>
                        <th width='25%'><center>MATA PELAJARAN</center></th>
                        <th width='20%'><center>GURU</center></th>
                        <th width='20%'><center>RUANGAN</center></th>
                        <th width='15%'><center>HARI</center></th>
                        <th width='15%'><center>JAM</center></th>
                    </tr>
                </thead>";
        
        $sql = "SELECT tj.hari,  tj.id_jadwal,  tm.nama_mapel,  tg.id_guru,  tg.nama_guru,  tr.kd_ruangan,  tj.hari,  tj.jam
                FROM tbl_jadwal AS tj, tbl_mapel AS tm, tbl_ruangan AS tr, tbl_guru AS tg
                WHERE tj.kd_mapel=tm.kd_mapel AND tj.kd_ruangan=tr.kd_ruangan AND tg.id_guru=tj.id_guru 
                AND tj.kelas='".$kelas."' AND tj.kd_jurusan='".$kd_jurusan."' AND tj.id_rombel='".$rombel."' AND tj.id_tahun_akademik='".get_tahun_akademik_aktif('id_tahun_akademik')."' AND tj.semester='".get_tahun_akademik_aktif('semester_aktif')."'";
        $jadwal = $this->db->query($sql)->result();
        $no=1;
        $jam_pelajaran = $this->Model_jadwal->getJamPelajaran();
        $hari          = array (
                        'SENIN'=>'SENIN',
                        'SELASA'=>'SELASA',
                        'RABU'=>'RABU',
                        'KAMIS'=>'KAMIS',
                        'JUMAT'=>'JUMAT',
                        'SABTU'=>'SABTU');
        foreach ($jadwal as $row){
			echo"<tr>
				<td align='center'>$no</td>
                <td>$row->nama_mapel</td>
                <td align='center'>".cmb_dinamis('guru', 'tbl_guru', 'nama_guru', 'id_guru',$row->id_guru,"id='guru".$row->id_jadwal."' onchange='updateGuru(".$row->id_jadwal.")'")."</td>
                <td align='center'>".cmb_dinamis('ruangan', 'tbl_ruangan', 'nama_ruangan', 'kd_ruangan',$row->kd_ruangan,"id='ruangan".$row->id_jadwal."' onchange='updateRuangan(".$row->id_jadwal.")'")."</td>
                <td align='center'>".form_dropdown('hari',$hari,$row->hari,"class='form-control search-select' id='hari".$row->id_jadwal."' onchange='updateHari(".$row->id_jadwal.")'")."</td>
                <td align='center'>".form_dropdown('jam',$jam_pelajaran,$row->jam,"class='form-control search-select' id='jam".$row->id_jadwal."' onchange='updateJam(".$row->id_jadwal.")'")."</td>
			</tr>";
			
            $no++;
        }
        echo"</table>";
        
    }
    
    function updateGuru(){
        $id_guru = $_GET['id_guru'];
        $id_jadwal = $_GET['id_jadwal'];
        $this->db->where('id_jadwal',$id_jadwal);
        $this->db->update('tbl_jadwal',array('id_guru'=>$id_guru));
    }
    
   function updateRuangan(){
        $kd_ruangan = $_GET['kd_ruangan'];
        $id_jadwal  = $_GET['id_jadwal'];
        $this->db->where('id_jadwal',$id_jadwal);
        $this->db->update('tbl_jadwal',array('kd_ruangan'=>$kd_ruangan));
    }
    
    function updateHari(){
        $hari       = $_GET['hari'];
        $id_jadwal  = $_GET['id_jadwal'];
        $this->db->where('id_jadwal',$id_jadwal);
        $this->db->update('tbl_jadwal',array('hari'=>$hari));
    }
    
    function updateJam(){
        $jam        = $_GET['jam'];
        $id_jadwal  = $_GET['id_jadwal'];
        $this->db->where('id_jadwal',$id_jadwal);
        $this->db->update('tbl_jadwal',array('jam'=>$jam));
    }
    
    function show_rombel(){
        echo "<select id='rombel' name='rombel' class='form-control' onchange='loadPelajaran()'>";
        $where  = array ('kd_jurusan'=>$_GET['jurusan'], 'kelas'=>$_GET['kelas']);
        $rombel = $this->db->get_where('tbl_rombel',$where);
        foreach ($rombel->result() as $row){
            echo "<option value='$row->id_rombel'>$row->nama_rombel</option>";
        }
        echo "</select>";
    }
    
	function cetak_jadwal(){
        $rombel	= $_POST['rombel'];
        $this->load->library('CFPDF');
		$days	= array(
			'SENIN'		=> 'SENIN',
			'SELASA'	=> 'SELASA',
			'RABU'		=> 'RABU',
			'KAMIS'		=> 'KAMIS',
			'JUMAT'		=> 'JUMAT',
			'SABTU'		=> 'SABTU'
		);
        
        $pdf = new FPDF('L','mm','A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(10,10,'NO',1,0,'C');
        $pdf->Cell(30,10,'WAKTU',1,0,'C');
        // foreach di kolom judul
        foreach ($days as $day){
            $pdf->Cell(40,10,$day,1,0,'C');
        }
        $pdf->Cell(30,10,'',0,1,'C');
        
		$jam_ajar	= $this->Model_jadwal->getJamPelajaran();
		$no			= 1;
		foreach ($jam_ajar  as $jam){
			$pdf->Cell(10,10,$no,1,0,'C');
			$pdf->Cell(30,10,$jam,1,0,'C');
			// foreach hari di kolom jadwal
			foreach ($days as $day){
				$pdf->Cell(40,10,$this->getPelajaran($jam, $day, $rombel),1,0,'C');
			}
			$pdf->Cell(30,10,'',0,1,'C');
			$no++;
		}
		$nama_rombel	= $this->Model_rombel->disp_rombel_by_id($rombel)->row_array();
		$pdf->Output($nama_rombel['nama_rombel'].'.pdf', 'D');
    }
    
    
    function getPelajaran($jam, $day, $rombel){
        $sql = "SELECT tj.*, tm.nama_mapel, tm.kd_mapel
			FROM tbl_jadwal AS tj,  tbl_mapel AS tm 
			WHERE tj.kd_mapel=tm.kd_mapel AND tj.id_rombel='$rombel' AND tj.hari='$day' AND tj.jam='$jam' AND tj.id_tahun_akademik=".get_tahun_akademik_aktif('id_tahun_akademik')." AND tj.semester=".get_tahun_akademik_aktif('semester_aktif');
        $pelajaran = $this->db->query($sql);
        if($pelajaran->num_rows()>0){
            $row = $pelajaran->row_array();
            return $row['nama_mapel'];
        }else{
            return '-';
        }
    }
    
}