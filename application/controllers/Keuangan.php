<?php

Class Keuangan extends CI_Controller{
    
    function __construct() {
        parent::__construct();
		chekAksesModule();
        $this->load->model('Model_keuangan');
		$this->load->model('Model_rombel');
		$this->load->model('Model_agama');
		$this->load->model('Model_jenis_pembayaran');
		
		if(!$this->session->userdata('id_user')){
			redirect('auth/logout');
		}
    }
    
    function index(){
        $this->template->load('template','keuangan/laporan');
    }
    
    function setup(){
        if(isset($_POST['submit'])){
            // proses simpan
            $this->Model_keuangan->setup();
            redirect('keuangan/setup');
        }else{
            $data['jenis_pembayaran'] = $this->db->get('tbl_jenis_pembayaran');
            $this->template->load('template','keuangan/setup', $data);
        }
    }
    
    function form(){
        if(isset($_POST['submit'])){
            $this->Model_keuangan->pembayaran();
			echo "<script>alert('Berhasil input pembayaran')</script>";
            redirect('keuangan/form');
        }else{
            $this->template->load('template','keuangan/form');
        }
    }
    
    function form_siswa_autocomplate(){
		$nis = $_GET['nis'];
		$sqlSiswa = "SELECT ts.nama as nama_siswa,ts.nis,tj.nama_jurusan,tr.nama_rombel,tr.kelas
                    FROM tbl_history_kelas as hk,tbl_siswa as ts,tbl_rombel as tr,tbl_jurusan as tj
                    WHERE ts.nis=hk.nis and tr.id_rombel=ts.id_rombel and tr.kd_jurusan=tj.kd_jurusan 
                    and hk.nis='$nis' and hk.id_tahun_akademik=".get_tahun_akademik_aktif('id_tahun_akademik')." and hk.status_delete='0'";
		$siswa = $this->db->query($sqlSiswa)->row_array();
		
		$data = array(
			'nama'      =>  $siswa['nama_siswa'],
			'jurusan'   =>  $siswa['nama_jurusan'],
			'rombel'    =>  $siswa['nama_rombel'],
			'kelas'     =>  $siswa['kelas']);
		echo json_encode($data);
    }
    
    function load_data_siswa_by_rombel(){
        $rombel = $_GET['rombel'];
        $id_jenis_pembayaran = $_GET['jenis_pembayaran'];
		echo "<table id='mytable' class='table table-striped table-bordered table-hover table-full-width dataTable'>
			<thead><tr>
				<th width='5%'><center>NO</center></th>
				<th width='10%'><center>NIS</center></th>
				<th width='50%'><center>NAMA</center></th>
				<th width='35%'><center>SUDAH DIBAYARKAN</center></th>
			</tr></thead>";
        $this->db->where('id_rombel',$rombel);
		//$this->db->join("tbl_history_kelas", "tbl_siswa.nis=tbl_history_kelas.nis");
		//$this->db->where('tbl_history_kelas.id_tahun_akademik', get_tahun_akademik_aktif('id_tahun_akademik'));
        $siswa	= $this->db->get('tbl_siswa');
		$no		= 1;
        foreach ($siswa->result() as $row){
            echo "<tr>
                <td align='center'>$no</td>
				<td align='center'>$row->nis</td>
                <td>$row->nama</td>
                <td align='right'>Rp. ".nominal($this->chek_jumlah_yang_sudah_dibayar($row->nis, $id_jenis_pembayaran))."</td></tr>";
			$no++;
        }
        echo"</table>";
		echo "<script type='text/javascript'>
			$(document).ready(function(){
				$('#mytable').DataTable({
					'info': true,
					'ordering': true,
					'paging': true,
					'searching': true
				});
			});
		</script>";
    }
    
	function chek_jumlah_yang_sudah_dibayar($nis, $id_jenis_pembayaran){
        $pembayaran = $this->db->get_where('tbl_pembayaran',array('nis'=>$nis, 'id_jenis_pembayaran'=>$id_jenis_pembayaran, 'id_tahun_akademik'=>get_tahun_akademik_aktif('id_tahun_akademik')));
        if($pembayaran->num_rows()>0){
			$row	= $pembayaran->result();
			$jumlah	= 0;
			foreach($row as $r){
				$jumlah += $r->jumlah;
			}
			return $jumlah;
        }else{
            return 0;
        }
    }
	
	
	
	function show_combobox_rombel_by_jurusan(){
		$jurusan = $_GET['jurusan'];
		echo "<select name='rombel' id='rombel2' class='form-control' onchange='loadSiswa()'>";
		$rombel	= $this->Model_rombel->daftar_rombel_by_kd_jurusan($jurusan);
		foreach ($rombel->result() as $row){
			echo "<option value='$row->id_rombel'>$row->nama_rombel</option>";
		}
		echo"</select>";
	}
	
	function data_by_rombel_excel(){
        $this->load->library('CPHP_excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'NO');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'NIS');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'NAMA SISWA');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'ROMBEL');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'TANGGAL DIBAYAR');
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'SUDAH DIBAYAR');
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'JENIS PEMBAYARAN');
		$objPHPExcel->getActiveSheet()->setCellValue('H1', 'TAHUN AKADEMIK');
		$objPHPExcel->getActiveSheet()->setCellValue('I1', 'KETERANGAN');
        
		$id_jenis_pembayaran	= $_POST['jenis_pembayaran'];
        $id_rombel				= $_POST['rombel'];
        //$this->db->where('id_rombel',$id_rombel);
		//$this->db->where('status_delete',0);
        //$siswa = $this->db->get('tbl_siswa');
		//$siswa	= $this->Model_siswa->daftar_siswa_by_rombel($id_rombel);
		$querySiswa = "SELECT ts.nama AS nama_siswa, ts.nis, ts.id_rombel, tp.tanggal, tp.jumlah, tp.id_jenis_pembayaran, tp.id_tahun_akademik, tp.keterangan
				FROM tbl_pembayaran AS tp, tbl_siswa AS ts
				WHERE ts.nis=tp.nis
				AND tp.id_tahun_akademik=".get_tahun_akademik_aktif('id_tahun_akademik')." AND tp.status_delete='0' AND ts.id_rombel='$id_rombel' AND tp.id_jenis_pembayaran='$id_jenis_pembayaran'";
		$siswa	= $this->db->query($querySiswa);
        $no		= 2;
		$nomor	= 1;
        foreach ($siswa->result() as $row){
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$no, $nomor);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$no, $row->nis);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$no, $row->nama_siswa);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$no, $this->disp_rombel_by_id($row->id_rombel));
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$no, $row->tanggal);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$no, $row->jumlah);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$no, $this->Model_jenis_pembayaran->disp_jenis_pembayaran_by_id($row->id_jenis_pembayaran));
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$no, $this->disp_tahun_akademik_by_id($row->id_tahun_akademik));
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$no, $row->keterangan);
			
            $no++;
			$nomor++;
        }
        
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
        $objWriter->save("Data-Keuangan-".$this->disp_rombel_by_id($id_rombel).".xlsx");
        $this->load->helper('download');
        force_download("Data-Keuangan-".$this->disp_rombel_by_id($id_rombel).".xlsx", NULL);
    }
	
	function disp_rombel_by_id($id){
		if(!empty($id)){
			$this->db->select('nama_rombel');
			$this->db->where('status_delete', 0);
			$this->db->where('id_rombel',$id);
			$nama = $this->db->get("tbl_rombel")->row();
			return isset($nama->nama_rombel)?$nama->nama_rombel:$id;
		}else return '';
	}
	
	function disp_tahun_akademik_by_id($id){
		if(!empty($id)){
			$this->db->select('tahun_akademik');
			$this->db->where('status_delete', 0);
			$this->db->where('id_tahun_akademik',$id);
			$nama = $this->db->get("tbl_tahun_akademik")->row();
			return isset($nama->tahun_akademik)?$nama->tahun_akademik:$id;
		}else return '';
	}
	
	
}