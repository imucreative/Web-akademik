<?php

	function cmb_dinamis($name, $table, $field, $pk, $selected = null, $extra = null) {
		$ci = & get_instance();
		$cmb = "<select name='$name' class='form-control search-select $name' $extra>";
		if(($table == 'tbl_kurikulum')OR($table == 'tbl_tahun_akademik')){
			$ci->db->where('is_aktif', "Y");
		}elseif($table == 'tbl_level_user'){
			$ci->db->where('id_level_user!=', 1);
		}elseif($table == 'tbl_user'){
			$ci->db->where('id_level_user', 4);
		}
		$ci->db->where('status_delete', 0);
		$data = $ci->db->get($table)->result();
		foreach ($data as $row) {
			$cmb .="<option value='" . $row->$pk . "'";
			$cmb .= $selected == $row->$pk ? 'selected' : '';
			$cmb .=">" . $row->$field . "</option>";
		}
		$cmb .= "</select>";
		return $cmb;
	}

	function get_tahun_akademik_aktif($field) {
		$ci = & get_instance();
		$ci->db->where('status_delete', '0');
		$ci->db->where('is_aktif', 'Y');
		$tahun = $ci->db->get('tbl_tahun_akademik')->row_array();
		return $tahun[$field];
	}

	function get_kurikulum_aktif($field) {
		$ci = & get_instance();
		$ci->db->where('status_delete', '0');
		$ci->db->where('is_aktif', 'Y');
		$tahun = $ci->db->get('tbl_kurikulum')->row_array();
		return $tahun[$field];
	}

	function get_data_sekolah($field) {
		$ci = & get_instance();
		$tahun = $ci->db->get('tbl_sekolah_info')->row_array();
		return $tahun[$field];
	}

	function get_data_status_naik_kelas($field, $where) {
		$ci = & get_instance();
		$ci->db->where('status_delete', '0');
		$ci->db->where('id_status_naik_kelas', $where);
		$tahun = $ci->db->get('tbl_status_naik_kelas')->row_array();
		return $tahun[$field];
	}

	function chek_nilai($nis, $id_jadwal, $field){
		$ci		= & get_instance();
		$nilai	= $ci->db->get_where('tbl_nilai', array('nis' => $nis, 'id_jadwal' => $id_jadwal));
		if ($nilai->num_rows() > 0) {
			$row = $nilai->row_array();
			return $row[$field];
		} else {
			return 0;
		}
	}

	function chek_komponen_biaya($id_jenis_pembayaran){
		$ci = & get_instance();
		$where = array(
			'id_jenis_pembayaran' => $id_jenis_pembayaran,
			'id_tahun_akademik' => get_tahun_akademik_aktif('id_tahun_akademik'));
		$biaya = $ci->db->get_where('tbl_biaya_sekolah', $where);
		if ($biaya->num_rows() > 0) {
			$row = $biaya->row_array();
			return $row['jumlah_biaya'];
		} else {
			return 0;
		}
	}

	function chekAksesModule(){
		$ci			= & get_instance();
		// ambil parameter uri segment untuk controller dan method
		$controller	= $ci->uri->segment(1);
		//$method		= $ci->uri->segment(2);
		
		// chek url
		/*
		if (empty($method)){
			$url	= $controller;
		} else {
			$url	= $controller . '/' . $method;
		}
		*/
		
		$url	= $controller;
		// chek id menu nya
		$menu		= $ci->db->get_where('tabel_menu', array('link' => $url))->row_array();
		$level_user	= $ci->session->userdata('id_level_user');
		
		if (!empty($level_user)){
			// chek apakah level ini diberikan hak akses atau tidak
			$chek = $ci->db->get_where('tbl_user_rule', array('id_level_user' => $level_user, 'id_menu' => $menu['id']));
			//if ($chek->num_rows() < 1 and $method != 'data' and $method != 'add' and $method != 'edit' and $method != 'delete') {
			if ($chek->num_rows() < 1) {
				redirect("auth/gagal_akses_modul");
			}
		} else {
			redirect('auth');
		}
	}

	function Terbilang($x) {
		$abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
		if ($x < 12)
			return " " . $abil[$x];
		elseif ($x < 20)
			return Terbilang($x - 10) . "Belas";
		elseif ($x < 100)
			return Terbilang($x / 10) . " Puluh" . Terbilang($x % 10);
		elseif ($x < 200)
			return " seratus" . Terbilang($x - 100);
		elseif ($x < 1000)
			return Terbilang($x / 100) . " Ratus" . Terbilang($x % 100);
		elseif ($x < 2000)
			return " seribu" . Terbilang($x - 1000);
		elseif ($x < 1000000)
			return Terbilang($x / 1000) . " Ribu" . Terbilang($x % 1000);
		elseif ($x < 1000000000)
			return Terbilang($x / 1000000) . " Juta" . Terbilang($x % 1000000);
	}
	
	function ketercapaian_kopetensi($nilai){
		if($nilai>90){
			return 'Sangat baik';
		}elseif($nilai>80 and $nilai<=90){
			return 'Baik';
		}elseif($nilai>75 and $nilai<=80){
			return 'Cukup';
		}else{
			return "Kurang";
		}
	}
	
	function rata_rata_nilai($id_jadwal){
		$ci			= & get_instance();
		$ci->db->select('SUM(nilai)/COUNT(nis) AS nilai_rata_rata');
		$ci->db->where('id_jadwal', $id_jadwal);
		$nilai		= $ci->db->get('tbl_nilai')->row_array();
		$nilai_rata	= $nilai['nilai_rata_rata'];
		return $nilai_rata;
	}
	
	function nominal($angka){
		$nominal = number_format($angka ,0, ',' , '.' );
		return $nominal;
	}
	
	