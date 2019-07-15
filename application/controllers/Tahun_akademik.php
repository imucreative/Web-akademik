<?php

Class Tahun_akademik extends CI_Controller {

    function __construct() {
        parent::__construct();
		chekAksesModule();
        $this->load->library('ssp');
        $this->load->model('Model_tahun_akademik');
		$this->load->model('Model_walikelas');
		$this->load->model('Model_siswa');
		$this->load->model('Model_rombel');
		
		if(!$this->session->userdata('id_user')){
			redirect('auth/logout');
		}
    }

    function data() {
        // nama tabel
        $table = 'tbl_tahun_akademik';
        // nama PK
        $primaryKey = 'id_tahun_akademik';
        // list field
        $columns = array(
            array('db' => 'id_tahun_akademik', 'dt' => 'id_tahunakademik'),
            array('db' => 'tahun_akademik', 'dt' => 'tahun_akademik'),
            array('db' => 'is_aktif',
                'dt' => 'is_aktif',
                'formatter' => function( $d) {
                    return $d=='Y'?'Aktif':'Tidak Aktif';
                }),
            array(
                'db' => 'id_tahun_akademik',
                'dt' => 'aksi',
                'formatter' => function( $d) {
                    //return "<a href='edit.php?id=$d'>EDIT</a>";
                    return anchor('tahun_akademik/edit/' . $d, '<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"') . ' 
                        ' . anchor('tahun_akademik/delete/' . $d, '<i class="fa fa-trash-o"></i>', 'class="btn btn-xs btn-danger tooltips" data-placement="top" data-original-title="Delete"');
                }
            )
        );

        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db' => $this->db->database,
            'host' => $this->db->hostname
        );

        echo json_encode(
			SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        );
    }

	function index(){	
		$data['tahun_akademik']	= $this->Model_tahun_akademik->daftar_tahunakademik();
		$this->template->load('template', 'tahun_akademik/list', $data);
	}

    function add() {
        if (isset($_POST['submit'])) {
			
			$this->Model_tahun_akademik->save();
            $idTahunAkademik = $this->db->insert_id();
			
            $this->Model_walikelas->setup_walikelas($idTahunAkademik);
			
			$this->Model_siswa->input_history_siswa($idTahunAkademik);
			
			
			//proses pemindahan kelas dan rombel yang naik kelas/lulus
			if(get_tahun_akademik_aktif('semester_aktif') == 1){
				$siswa	= $this->Model_siswa->daftar_siswa_tbl_siswa();
				foreach ($siswa->result() as $row){
					$nis			= $row->nis;
					$id_rombel		= $row->id_rombel;
					$rombel			= $this->Model_rombel->disp_rombel_by_id($id_rombel)->row_array();
					$kelas			= $rombel['kelas'];
					$nama_rombel	= $rombel['nama_rombel'];
					
					$tahun_akademik_sebelumnya	= get_tahun_akademik_aktif('id_tahun_akademik') - 1;
					$cek_nis_history_siswa	= $this->Model_siswa->cek_nis_history_siswa($nis, $tahun_akademik_sebelumnya)->row_array();
						//$cek_nis_history_siswa	= $this->db->get_where('tbl_history_kelas', array('nis'=>$nis, 'id_tahun_akademik'=>get_tahun_akademik_aktif('id_tahun_akademik')))->row_array();
						//echo $cek_nis_history_siswa['status_kelulusan'];
						//die();
					
					if(($kelas == '1') || ($kelas == '2')){
						
						$ambil_kelas		= substr($nama_rombel, 0, 1);
						$naik_ke_kelas		= $ambil_kelas+1;
						$jurusan			= substr($nama_rombel, 1, 3);
						$ambil_sub_rombel	= substr($nama_rombel, 4, 4);
						$rombel_nama		= $naik_ke_kelas . $jurusan . $ambil_sub_rombel;
						
						$cek_rombel_by_nama	= $this->Model_rombel->disp_rombel_by_nama($rombel_nama)->row_array();
						$rombel_id			= $cek_rombel_by_nama['id_rombel'];
						
						
						if($cek_nis_history_siswa['id_status_naik_kelas'] == 1){
							$this->Model_siswa->update_rombel_untuk_naik_kelas($nis, $rombel_id);
							$this->Model_siswa->update_rombel_untuk_naik_kelas_history_siswa($nis, $rombel_id, get_tahun_akademik_aktif('id_tahun_akademik'));
						}
					}else{
						if($cek_nis_history_siswa['status_kelulusan'] != "TIDAK LULUS"){
							$this->Model_siswa->update_siswa_lulus($cek_nis_history_siswa['id_history']);
						}
					}
				}
			}
			
            redirect('tahun_akademik');
        } else {
            $this->template->load('template', 'tahun_akademik/add');
        }
    }

    function edit() {
        if (isset($_POST['submit'])) {
            $this->Model_tahun_akademik->update();
            redirect('tahun_akademik');
        } else {
            $Id_tahun_akademik = $this->uri->segment(3);
            $data['tahun_akademik'] = $this->db->get_where('tbl_tahun_akademik', array('Id_tahun_akademik' => $Id_tahun_akademik))->row_array();
            $this->template->load('template', 'tahun_akademik/edit', $data);
        }
    }

    function delete() {
        $id_tahun_akademik = $this->uri->segment(3);
        if (!empty($id_tahun_akademik)) {
            $this->Model_tahun_akademik->hapus($id_tahun_akademik);
        }
        redirect('tahun_akademik');
    }

}