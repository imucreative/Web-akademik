<?php

Class Siswa_aktif extends CI_Controller {

    function __construct() {
        parent::__construct();
		//chekAksesModule();
        //$this->load->library('ssp');
        //$this->load->model('Model_siswa');
		$this->load->model('Model_rombel');
		$this->load->model('Model_agama');
		
		if(!$this->session->userdata('id_user')){
			redirect('auth/logout');
		}
    }
    
    function index(){
        $this->template->load('template', 'siswa/siswa_aktif');
    }
    
    function load_data_siswa_by_rombel(){
        $rombel = $_GET['rombel'];
        echo "<table id='mytable' class='table table-striped table-bordered table-hover table-full-width dataTable'>
			<thead><tr>
				<th width='10%'><center>NO</center></th>
				<th width='18%'><center>NIS</center></th>
				<th width='50%'><center>NAMA</center></th>
				<th width='22%'><center>GENDER</center></th>
				</tr></thead>";
        $this->db->where('id_rombel',$rombel);
        $siswa = $this->db->get('tbl_siswa');
		$nomor='1';
        foreach ($siswa->result() as $row){
			if($row->gender=='L'){
				$jk = "LAKI LAKI";
			}else{
				$jk = "PEREMPUAN";
			}
            echo "<tr>
				<td align='center'>$nomor</td>
				<td align='center'>$row->nis</td>
				<td>$row->nama</td>
				<td align='center'>$jk</td>
				</tr>";
			$nomor++;
        }
        echo"</table>";
		echo "<script type='text/javascript'>
			$(document ).ready(function() {
				$('#mytable').DataTable({
					'info': true,
					'ordering': true,
					'paging': true,
					'searching': true
				});
			});
		</script>";
    }
    
    function data_by_rombel_excel(){
        $this->load->library('CPHP_excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'NO');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'NIS');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'NAMA SISWA');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'GENDER');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'TEMPAT LAHIR');
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'TANGGAL LAHIR');
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'AGAMA');
		$objPHPExcel->getActiveSheet()->setCellValue('H1', 'ROMBEL');
		$objPHPExcel->getActiveSheet()->setCellValue('I1', 'FOTO');
        
        $rombel = $_POST['rombel'];
		$nama_rom	= $this->Model_rombel->disp_rombel_by_id($rombel)->row();
		
        $this->db->where('id_rombel',$rombel);
        $siswa = $this->db->get('tbl_siswa');
        $no=2;
		$nomor=1;
        foreach ($siswa->result() as $row){
			if($row->gender == 'L'){
				$jk = "LAKI LAKI";
			}else{
				$jk = "PEREMPUAN";
			}
			
			if($row->foto == ''){
				$foto = "NO";
			}else{
				$foto = "OK";
			}
			
			$nama_rombel_msng_siswa	= $this->Model_rombel->disp_rombel_by_id($row->id_rombel)->row();
			
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$no, $nomor);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$no, $row->nis);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$no, $row->nama);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$no, $jk);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$no, $row->tempat_lahir);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$no, $row->tanggal_lahir);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$no, $this->Model_agama->disp_agama_by_id($row->kd_agama));
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$no, $nama_rombel_msng_siswa->nama_rombel);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$no, $foto);
			
            $no++;
			$nomor++;
        }
        
		
		
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
        $objWriter->save("Data-Siswa-".$nama_rom->nama_rombel.".xlsx");
        $this->load->helper('download');
        force_download("Data-Siswa-".$nama_rom->nama_rombel.".xlsx", NULL);
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

}