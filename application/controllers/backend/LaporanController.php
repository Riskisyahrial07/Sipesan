<?php


class LaporanController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$model = array('PenggunaModel','BayarModel');
		$helper = array('nominal','tgl_indo');
		$this->load->model($model);
		$this->load->helper($helper);
		if (!$this->session->has_userdata('session_id')) {
			$this->session->set_flashdata('alert', 'belum_login');
			redirect(base_url('admin/login'));
		}
	}
	public function index($tipe){

		$arrayDate = [];
		$arrayData = [];
		

		// var_dump($array);
	   	// die();

		if (isset($_POST['lihat'])){
			$tanggal = $this->input->post('tanggal');
			$tipenya = array(
				'spanduk' => $this->BayarModel->lihat_keranjang_spanduk_admin('bayar_menunggu',$tanggal)->result_array(),
				'stiker' => $this->BayarModel->lihat_keranjang_stiker_admin('bayar_menunggu',$tanggal)->result_array(),
				'kartu_nama' => $this->BayarModel->lihat_keranjang_kartu_admin('bayar_menunggu',$tanggal)->result_array(),
				'brosur' => $this->BayarModel->lihat_keranjang_brosur_admin('bayar_menunggu',$tanggal)->result_array(),
				'desain' => $this->BayarModel->lihat_keranjang_desain_admin('bayar_menunggu',$tanggal)->result_array()
			);

			$data = array(
				'spanduk' => $tipenya[$tipe],
				'stiker' => $tipenya[$tipe],
				'kartu' => $tipenya[$tipe],
				'brosur' => $tipenya[$tipe],
				'desain' => $tipenya[$tipe],
				'tanggal' => $tanggal,
				'tipe' => $tipe
			);
			$this->load->view('backend/templates/header');
			$this->load->view('backend/laporan/lihat',$data);
			$this->load->view('backend/templates/footer');
		} elseif(isset($_POST['lihatBulan'])){
			$tahun = date('Y');
			$bulan = $this->input->post('bulan');
			$tanggal = $tahun.'-'.$bulan;
			$tipenya = array(
				'spanduk' => $this->BayarModel->lihat_keranjang_spanduk_admin('bayar_menunggu',$tanggal)->result_array(),
				'stiker' => $this->BayarModel->lihat_keranjang_stiker_admin('bayar_menunggu',$tanggal)->result_array(),
				'kartu_nama' => $this->BayarModel->lihat_keranjang_kartu_admin('bayar_menunggu',$tanggal)->result_array(),
				'brosur' => $this->BayarModel->lihat_keranjang_brosur_admin('bayar_menunggu',$tanggal)->result_array(),
				'desain' => $this->BayarModel->lihat_keranjang_desain_admin('bayar_menunggu',$tanggal)->result_array()
			);

			$data = array(
				'spanduk' => $tipenya[$tipe],
				'stiker' => $tipenya[$tipe],
				'kartu' => $tipenya[$tipe],
				'brosur' => $tipenya[$tipe],
				'desain' => $tipenya[$tipe],
				'tanggal' => null,
				'bulan' => $bulan,
				'tipe' => $tipe
			);
			$this->load->view('backend/templates/header');
			$this->load->view('backend/laporan/lihat',$data);
			$this->load->view('backend/templates/footer');
		}
		else {
			$sum = $this->BayarModel->get_chart(date('Y-m-d'), $tipe);
			$arrayDate[] = date('Y-m-d');
			$arrayData[] = $sum['total'] == NULL ? 0 : $sum['total'];

			$data = array(
				'tipe' => $tipe,
				'tanggal' => $arrayDate,
				'data' => $arrayData
			);

			$this->load->view('backend/templates/header');
			$this->load->view('backend/laporan/index',$data);
			$this->load->view('backend/templates/footer');
		}
	}

	public function filterChart()
    {
		$arrayDate = [];
		$arrayData = [];

		if($this->input->post('akhir') == '') {
			$sum = $this->BayarModel->get_chart($this->input->post('awal'), $this->input->post('tipe'));
			$arrayDate[] = $this->input->post('awal');
			$arrayData[] = $sum['total'] == NULL ? 0 : $sum['total'];
		} else {
			$begin = new DateTime( $this->input->post('awal') );
			$end = new DateTime( $this->input->post('akhir') );
			$end = $end->modify( '+1 day' ); 

			$interval = new DateInterval('P1D');
			$daterange = new DatePeriod($begin, $interval ,$end);

			foreach($daterange as $date){
				$data = $this->BayarModel->get_chart($date->format("Y-m-d"), $this->input->post('tipe'));

				$arrayDate[] = $date->format("Y-m-d");
				$arrayData[] = $data['total'] == NULL ? 0 : $data['total'];
			}
		}

        echo json_encode(['date' => $arrayDate, 'total' => $arrayData]);
    }
}
