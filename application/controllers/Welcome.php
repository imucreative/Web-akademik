<?php

Class Welcome extends CI_Controller {
	
	function __construct() {
        parent::__construct();
		$this->load->model('Model_users');
		$this->load->model('Model_siswa');
		$this->load->model('Model_guru');
		$this->load->model('Model_rombel');
		$this->load->model('Model_jurusan');
		$this->load->model('Model_ruangan');
		$this->load->model('Model_mapel');
		
		if(!$this->session->userdata('id_user')){
			redirect('auth/logout');
		}
    }
	
    public function index() {
        //$this->output->delete_cache();
		
		$data['jumlah_siswa']	= $this->Model_siswa->jumlah_siswa();
		$data['jumlah_siswa_l']	= $this->Model_siswa->jumlah_siswa_l();
		$data['jumlah_siswa_p']	= $this->Model_siswa->jumlah_siswa_p();
		
		$data['jumlah_guru']	= $this->Model_guru->jumlah_guru();
		$data['jumlah_guru_l']	= $this->Model_guru->jumlah_guru_l();
		$data['jumlah_guru_p']	= $this->Model_guru->jumlah_guru_p();
		
		$data['jumlah_rombel']	= $this->Model_rombel->jumlah_rombel();
		
		$data['jumlah_jurusan']	= $this->Model_jurusan->jumlah_jurusan();
		
		$data['jumlah_ruangan']	= $this->Model_ruangan->jumlah_ruangan();
		
		$data['jumlah_mapel']	= $this->Model_mapel->jumlah_mapel();
		
		//untuk charts
		$data['daftarRombel']	= $this->Model_rombel->daftar_rombel()->result();
		$data['daftarJurusan']	= $this->Model_jurusan->daftar_jurusan()->result();
		
        $this->template->load('template', 'dashboard', $data);
    }
	
	function profil(){
		$this->template->load('template', 'profil');
	}
	
	function saveProfil(){
		if (isset($_POST['submit'])) {
            $this->Model_users->updateProfil();
            redirect('auth/logout');
        }
	}
	
	

    function guzzle() {
        //step1
        $cSession = curl_init();
		
		//step2
        curl_setopt($cSession, CURLOPT_URL, "https://reguler.zenziva.net/apps/smsapi.php?userkey=wq8ed6&passkey=testing&nohp=089699935552&pesan=asasasasasasasasasas");
        curl_setopt($cSession, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cSession, CURLOPT_HEADER, false);
		
		//step3
        $result = curl_exec($cSession);
		
		//step4
        curl_close($cSession);
		
		//step5
        echo $result;
    }

    function sms() {
        // Script Kirim SMS Api Zenziva
        $userkey = "wq8ed6"; // userkey lihat di zenziva
        $passkey = "testing"; // set passkey di zenziva
        $message = "Terima Kasih, pendaftaran atas nama nuris telah berhasil di cpnsonline.com. Silahkan baca dan download petunjuk selanjutnya. Harap Maklum";
        $telepon = "089699935552";
        $url = "https://reguler.zenziva.net/apps/smsapi.php";
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey=' . $userkey . '&passkey=' . $passkey . '&nohp=' . $telepon . '&pesan=' . urlencode($message));
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        $results = curl_exec($curlHandle);
        curl_close($curlHandle);

        echo print_r($results);
    }

    function test() {

        $this->load->library('curl');

        $url = "https://reguler.zenziva.net/apps/smsapi.php?userkey=wq8ed6&passkey=testing&nohp=089699935552&pesan=testing by nuris";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
        print $result;

        die;

        $userkey = "wq8ed6"; // userkey lihat di zenziva
        $passkey = "testing"; // set passkey di zenziva
        $this->load->library('curl');

        $params = array('userkey' => $userkey, 'passkey' => $passkey, 'nohp' => 089699935552, 'pesan' => 'coba dari culr');

        //$result  = $this->curl->simple_call('get',"https://reguler.zenziva.net/apps/smsapi.php?",$params);
        //$result = $this->curl->simple_get('https://reguler.zenziva.net/apps/smsapi.php',$params);
        $result = $this->curl->simple_get('https://reguler.zenziva.net/apps/smsapi.php', array(CURLOPT_PORT => 8080));
        echo print_r($result);

        echo $this->curl->execute();

        die;
        $url = "https://reguler.zenziva.net/apps/smsapi.php?userkey=$userkey&passkey=$passkey&nohp=089699935552&pesan= test kirim sms dengan zenziva api";
        echo $this->curl->simple_get($url);
    }

}
