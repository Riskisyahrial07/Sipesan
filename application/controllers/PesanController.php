<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PesanController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$model = array('PesanModel','BayarModel');
		$this->load->model($model);
		if (!$this->session->has_userdata('session_id')) {
			$this->session->set_flashdata('alert', 'belum_login');
			redirect(base_url('login'));
		}
	}

	public function pesanan()
	{
		$data = array(
			'title' => 'Pesan Spanduk | Visual Creative Agency',
			'pesanan' => $this->db->get('sipesan_pesanan')->result()
		);

		$this->load->view('frontend/templates/header',$data);
		$this->load->view('frontend/pesanan/index');
		$this->load->view('frontend/templates/footer');
	}

	public function renderForm()
	{
		$output = '';
		$action = '';

		$ukuran = $this->db->select('*')->from('sipesan_ukuran')->where('ukuran_id_pesanan', $this->input->post('pesanan'))->get()->result();
		$bahan = $this->db->select('*')->from('sipesan_bahan')->where('bahan_id_pesanan', $this->input->post('pesanan'))->get()->result();

		if($this->input->post('pesanan') == 1) {
			$action = 'stiker';
			$output .= '
				<div class="form-group">
					<label for="">Ukuran</label>
					<select class="form-control" name="ukuran">
						<option value="">Pilih Ukuran</option> ';
						foreach($ukuran as $row):
							$output .= '<option value="'.$row->ukuran_id.'">'.$row->ukuran_nama.'</option>';
						endforeach;
			$output .= '
					</select>
				</div>
				<div class="form-group">
					<label for="">Bahan</label>
					<select class="form-control" name="bahan" id="option-harga-bahan" onchange=getHargaBahan("stiker")>
						<option value="">Pilih Bahan</option>';
						foreach($bahan as $row):
							$output .= '<option value="'.$row->bahan_id.'" data-harga="'.$row->bahan_harga.'">'.$row->bahan_nama.'</option>';
						endforeach;
			$output .= '
					</select>
				</div>
				<div class="form-group">
					<label for="">Jumlah :</label>
					<input type="hidden" name="harga_bahan" id="harga-bahan" />
					<input type="number" name="jumlah" class="form-control" id="jumlah" onkeyup="showTotalStiker()"
						required autocomplete="off">
						<label for=""><span style="color: red">*</span> Informasi Produk :</label>
							<ul>
							<label for=""><span style="color: red">-</span> Lama Pengerjaan:</label>
							<ul>
								<li>Order 1-300 Lembar : 1 Hari</li>
								<li>Order 301-600 Lembar : 2 Hari</li>
							</ul>
							<label for=""><span style="color: red">-</span> Catatan:</label>
							<ul>
								<li>File Sudah Siap Diprint</li>
								<li>Tidak Berlaku Untuk Hari Libur/Tanggal Merah</li>
								<li>Untuk Hasil maksimal kirim File Format PDF Kirimkan melalui Wa 082252170059</li>
								<li>Order Urgent / Perubahan Jumlah Cetak Hub Melalui WA:082252170059</li>
							</ul>
							<label for=""><span style="color: red">-</span> Keterangan Dan Spesifikasi Produk :</label>
							<ul>
								<li>Stiker HVS Harga= 1.000/Pcs</li>
								<li>Stiker Vinyl Harga= 3.000/Pcs</li>
							</ul>
						</div>
				</div>
			';
		} elseif ($this->input->post('pesanan') == 2) {
			$action = 'spanduk';
			$output .= '
				<div class="form-group">
					<label for="">Ukuran :</label>
					<div class="row">
						<div class="col-md-6">
							Panjang (m)
						</div>
						<div class="col-md-6">
							Lebar (m)
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<input type="text" class="form-control" id="panjang" name="panjang"
								placeholder="Panjang" required autocomplete="off" onkeyup="showTotalSpanduk()">
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control" id="lebar" name="lebar"
								placeholder="Lebar" required autocomplete="off" onkeyup="showTotalSpanduk()">
						</div>
					</div>
				</div> 
				<div class="form-group">
					<label for="">Bahan</label>
					<select class="form-control" name="bahan" id="option-harga-bahan" onchange=getHargaBahan("spanduk")>
						<option value="">Pilih Bahan</option>';
						foreach($bahan as $row):
							$output .= '<option value="'.$row->bahan_id.'" data-harga="'.$row->bahan_harga.'">'.$row->bahan_nama.'</option>';
						endforeach;
			$output .='
					</select>
				</div>
				<div class="form-group">
					<label for="">Jumlah :</label>
					<input type="hidden" name="harga_bahan" id="harga-bahan" />
					<input type="number" name="jumlah" class="form-control" id="jumlah" onkeyup="showTotalSpanduk()"
						required autocomplete="off">
						<label for=""><span style="color: red">*</span> Informasi Produk :</label>
							<ul>
							<label for=""><span style="color: red">-</span> Lama Pengerjaan:</label>
							<ul>
								<li>Order 1-50 meter : 1 Hari</li>
								<li>Order >50 Meter : 2 Hari</li>
							</ul>
							<label for=""><span style="color: red">-</span> Catatan:</label>
							<ul>
								<li>File Sudah Siap Diprint</li>
								<li>Tidak Berlaku Untuk Hari Libur/Tanggal Merah</li>
								<li>Untuk Hasil maksimal kirim File Format PDF Kirimkan melalui Wa 082252170059</li>
								<li>Order Urgent / Perubahan Jumlah Cetak Hub Melalui WA:082252170059</li>
							</ul>
							<label for=""><span style="color: red">-</span> Keterangan Dan Spesifikasi Produk :</label>
							<ul>
								<li>Vinyl B Harga= 35.000/Permeter</li>
								<li>Korean Glossy Harga= 67.000/Permeter</li>
								<li>Lebar Bahan : dan 4 meter</li>
								<li>Backdrop atau baliho dengan ukuran lebar lebih dari 3 atau 4 meter lebih bagus jika di print langsung tanpa harus disambung selain lebih kuat juga lebih enak dipandang mata karena tidak ada potongan/sambungan yang terlihat Bahan yang digunakan adalah Korea dengan permukaan yang Doft dan serat yang lebih tebal.
								</li>
							</ul>
						</div>
				</div>
			';
		} elseif ($this->input->post('pesanan') == 3) {
			$action = 'kartu';

			$output .= '
				<div class="form-group">
					<label for="">Ukuran</label>
					<select class="form-control" name="ukuran">
						<option value="">Pilih Ukuran</option> ';
						foreach($ukuran as $row):
							$output .= '<option value="'.$row->ukuran_id.'">'.$row->ukuran_nama.'</option>';
						endforeach;
			$output .= '
					</select>
				</div>
				<div class="form-group">
					<label for="">Bahan</label>
					<select class="form-control" name="bahan" id="option-harga-bahan" onchange=getHargaBahan("kartu")>
						<option value="">Pilih Bahan</option>';
						foreach($bahan as $row):
							$output .= '<option value="'.$row->bahan_id.'" data-harga="'.$row->bahan_harga.'">'.$row->bahan_nama.'</option>';
						endforeach;
			$output .= '
					</select>
				</div>
				<div class="form-group">
					<label for="">Jumlah :</label>
					<input type="hidden" name="harga_bahan" id="harga-bahan" />
					<input type="number" name="jumlah" class="form-control" id="jumlah" onkeyup="showTotalKartu()"
						required autocomplete="off">
						<label for=""><span style="color: red">*</span> Informasi Produk :</label>
							<ul>
							<label for=""><span style="color: red">-</span> Lama Pengerjaan:</label>
							<ul>
								<li>Order 1-50 Box : 1 Hari</li>
								<li>Order >50 Box : 2 Hari</li>
							</ul>
							<label for=""><span style="color: red">-</span> Catatan:</label>
							<ul>
								<li>File Sudah Siap Diprint</li>
								<li>Tidak Berlaku Untuk Hari Libur/Tanggal Merah</li>
								<li>Untuk Hasil maksimal kirim File Format PDF Kirimkan melalui Wa 082252170059</li>
								<li>Order Urgent / Perubahan Jumlah Cetak Hub Melalui WA:082252170059</li>
							</ul>
							<label for=""><span style="color: red">-</span> Keterangan Dan Spesifikasi Produk :</label>
							<ul>
								<li>1 box Harga 70.000 Isi: 100 lembar</li>
								<li>Ukuran : 8,6 x 5,4 cm</li>
								<li>Kartu Nama di cetak dengan mesin berkualitas dan variasi kertas yang bisa menambah nilai pada kartu nama anda
								</li>
							</ul>
						</div>
				</div>
			';
		} elseif ($this->input->post('pesanan') == 4) {
			$action = 'brosur';
			$output .= '
				<div class="form-group">
					<label for="">Ukuran</label>
					<select class="form-control" name="ukuran">
						<option value="">Pilih Ukuran</option> ';
						foreach($ukuran as $row):
							$output .= '<option value="'.$row->ukuran_id.'">'.$row->ukuran_nama.'</option>';
						endforeach;
			$output .= '
					</select>
				</div>
				<div class="form-group">
					<label for="">Bahan</label>
					<select class="form-control" name="bahan" id="option-harga-bahan" onchange=getHargaBahan("brosur")>
						<option value="">Pilih Bahan</option>';
						foreach($bahan as $row):
							$output .= '<option value="'.$row->bahan_id.'" data-harga="'.$row->bahan_harga.'">'.$row->bahan_nama.'</option>';
						endforeach;
			$output .= '
					</select>
				</div>
				<div class="form-group">
					<label for="">Jumlah :</label>
					<input type="hidden" name="harga_bahan" id="harga-bahan" />
					<input type="number" name="jumlah" class="form-control" id="jumlah" onkeyup="showTotalBrosur()"
						required autocomplete="off">
						<label for=""><span style="color: red">*</span> Informasi Produk :</label>
							<ul>
							<label for=""><span style="color: red">-</span> Lama Pengerjaan:</label>
							<ul>
								<li>Order 100 Lembar : 1 Hari</li>
								<li>Order >100 Lembar : 2 Hari</li>
							</ul>
							<label for=""><span style="color: red">-</span> Catatan:</label>
							<ul>
								<li>File Sudah Siap Diprint</li>
								<li>Tidak Berlaku Untuk Hari Libur/Tanggal Merah</li>
								<li>Untuk Hasil maksimal kirim File Format PDF Kirimkan melalui Wa 082252170059</li>
								<li>Order Urgent / Perubahan Jumlah Cetak Hub Melalui WA:082252170059</li>
							</ul>
							<label for=""><span style="color: red">-</span> Keterangan Dan Spesifikasi Produk :</label>
							<ul>
								<li>Art Paper 260 GSM Harga= 3.000/Pcs</li>
								<li>Art Paper 260 GSM 2 Sisi Harga= 3.200/Pcs</li>
								<li>Brosur salah satu alat promosi yang masih efektif untuk beberapa bisnis, untuk menjelaskan promosi ataupun sebagai katalog product.</li>
							</ul>
						</div>
				</div>
			';
		} elseif ($this->input->post('pesanan') == 5) {
			$action = 'desain';
			$output .= '
				<div class="form-group">
					<label for="">Ukuran :</label>
					<div class="row">
						<div class="col-md-6">
							Panjang (m)
						</div>
						<div class="col-md-6">
							Lebar (m)
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<input type="text" class="form-control" id="panjang" name="panjang"
								placeholder="Panjang" required autocomplete="off" onkeyup="showTotalDesain()">
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control" id="lebar" name="lebar"
								placeholder="Lebar" required autocomplete="off" onkeyup="showTotalDesain()">
						</div>
					</div>
				</div> 
				<div class="form-group">
					<label for="">Bahan</label>
					<select class="form-control" name="bahan" id="option-harga-bahan" onchange=getHargaBahan("desain")>
						<option value="">Pilih Bahan</option>';
						foreach($bahan as $row):
							$output .= '<option value="'.$row->bahan_id.'" data-harga="'.$row->bahan_harga.'">'.$row->bahan_nama.'</option>';
						endforeach;
			$output .='
					</select>
				</div>
				<div class="form-group">
					<label for="">Jumlah :</label>
					<input type="number" name="jumlah" class="form-control" id="jumlah" onkeyup="showTotalDesain()"
						required autocomplete="off">
				</div>
				<div class="form-group">
					<label for="">Keterangan :</label>
					<input type="hidden" name="harga_bahan" id="harga-bahan" />
					<textarea class="form-control" name="keterangan" style="height : 150px; resize : none;" required></textarea>
					<label for=""><span style="color: red">*</span> Informasi Produk :</label>
							<ul>
							<label for=""><span style="color: red">-</span> Lama Pengerjaan:</label>
							<ul>
								<li>Order 100 Lembar : 1 Hari</li>
								<li>Order >100 Lembar : 2 Hari</li>
							</ul>
							<label for=""><span style="color: red">-</span> Catatan:</label>
							<ul>
								<li>File Sudah Siap Diprint</li>
								<li>Tidak Berlaku Untuk Hari Libur/Tanggal Merah</li>
								<li>Jika ada yang ingin ditanyakan Hub Melalui WA:082252170059</li>
							</ul>
							<label for=""><span style="color: red">-</span>Cara mengisi Ket</label>
							<ul>
							
								<li>Pada layanan Desain silahkan jelaskan dibagian keterangan desain apa yang ingin anda desain seperti Contoh: Desain Spanduk Event Kemerdekaan Judul Spanduk : perlombaan memeriahkan HUT RI Ke-78 / Tannggal event : 18 Agustus 2023 dan kata kata lainnya
								</li>
								<li>Hasil Desain kami kirimkan Melalui WA 082252170059</li>
							</ul>
						</div>
				</div>
				</div>
			';
		}

		echo json_encode(['html' => $output, 'action' => $action]);
	}

	public function pesanSpanduk()
	{
		if (isset($_POST['keranjang'])) {
			$spandukId = 'SDK-' . substr(time(), 5);
			$panjang = $this->input->post('panjang');
			$lebar = $this->input->post('lebar');
			$bahan = $this->input->post('bahan');
			$jumlah = $this->input->post('jumlah');
			$estimasi = $this->input->post('estimasi');
			$total = round((($panjang * $lebar) * $this->input->post('harga_bahan'))*$jumlah);

			$config['upload_path'] = './assets/images/spanduk/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('upload')) {
				$error = array('error' => $this->upload->display_errors());
				var_dump($error);
			} else {
				$foto = $this->upload->data('file_name');

				$dataSpanduk = array(
					'id' => $spandukId,
					'panjang' => $panjang,
					'lebar' => $lebar,
					'bahan' => $bahan,
					'jumlah' => $jumlah,
					'total' => $total,
					'foto' => $foto,
					'jenis_pesanan' => 'spanduk'
				);

				$allCart = $this->BayarModel->lihat_keranjang();
				$undoneCart = $this->BayarModel->lihat_keranjang_status($this->session->userdata('session_id'),'belum')->row_array();

				if ($allCart == null){
					$cartId = 'CRT-' . substr(time(), 5);
					$dataSpanduk['keranjang_id'] = $cartId;
					$dataCart = array(
						'keranjang_id' => $cartId,
						'keranjang_pengguna_id' => $this->session->userdata('session_id'),
						'keranjang_total' => $total,
					);

					$this->PesanModel->simpan('sipesan_order', $dataSpanduk);
					$this->BayarModel->simpan_keranjang($dataCart);
					$this->session->set_flashdata('alert', 'pesan_sukses');
					redirect('keranjang');
				} else {
					if ($undoneCart != null){
						$cartId = $undoneCart['keranjang_id'];
						$cartTotal = $undoneCart['keranjang_total'];
						$dataSpanduk['keranjang_id'] = $cartId;
						$dataCart['keranjang_total'] = $cartTotal + $total;

						$this->PesanModel->simpan('sipesan_order', $dataSpanduk);
						$this->BayarModel->update_keranjang($cartId,$dataCart);
						$this->session->set_flashdata('alert', 'pesan_sukses');
						redirect('keranjang');
					} else {
						$cartId = 'CRT-' . substr(time(), 5);
						$dataSpanduk['keranjang_id'] = $cartId;
						$dataCart = array(
							'keranjang_id' => $cartId,
							'keranjang_pengguna_id' => $this->session->userdata('session_id'),
							'keranjang_total' => $total,
						);

						$this->PesanModel->simpan('sipesan_order', $dataSpanduk);
						$this->BayarModel->simpan_keranjang($dataCart);
						$this->session->set_flashdata('alert', 'pesan_sukses');
						redirect('keranjang');
					}
				}
			}
		}

		$data = array(
			'title' => 'Pesan Spanduk | Visual Creative Agency'
		);
		$this->load->view('frontend/templates/header',$data);
		$this->load->view('frontend/pesanan/spanduk');
		$this->load->view('frontend/templates/footer');
	}
	public function pesanStiker(){

		if (isset($_POST['keranjang'])) {
			$stikerId = 'SKR-' . substr(time(), 5);
			$panjang = $this->input->post('panjang');
			$lebar = $this->input->post('lebar');
			$bahan = $this->input->post('bahan');
			$ukuran = $this->input->post('ukuran');
			$jumlah = $this->input->post('jumlah');
			$estimasi = $this->input->post('estimasi');
			$total = $this->input->post('harga_bahan') * $jumlah;

			$config['upload_path'] = './assets/images/stiker/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('upload')) {
				$error = array('error' => $this->upload->display_errors());
				var_dump($error);
			} else {
				$foto = $this->upload->data('file_name');

				$dataStiker = array(
					'id' => $stikerId,
					'ukuran' => $ukuran,
					'bahan' => $bahan,
					'jumlah' => $jumlah,
					'total' => $total,
					'foto' => $foto,
					'jenis_pesanan' => 'stiker'
				);

				$allCart = $this->BayarModel->lihat_keranjang();
				$undoneCart = $this->BayarModel->lihat_keranjang_status($this->session->userdata('session_id'),'belum')->row_array();

				if ($allCart == null){
					$cartId = 'CRT-' . substr(time(), 5);
					$dataStiker['keranjang_id'] = $cartId;
					$dataCart = array(
						'keranjang_id' => $cartId,
						'keranjang_pengguna_id' => $this->session->userdata('session_id'),
						'keranjang_total' => $total,
					);
					$this->PesanModel->simpan('sipesan_order', $dataStiker);
					$this->BayarModel->simpan_keranjang($dataCart);
					$this->session->set_flashdata('alert', 'pesan_sukses');
					redirect('keranjang');
				} else {
					if ($undoneCart != null){
						$cartId = $undoneCart['keranjang_id'];
						$cartTotal = $undoneCart['keranjang_total'];
						$dataStiker['keranjang_id'] = $cartId;
						$dataCart['keranjang_total'] = $cartTotal + $total;

						$this->PesanModel->simpan('sipesan_order', $dataStiker);
						$this->BayarModel->update_keranjang($cartId,$dataCart);
						$this->session->set_flashdata('alert', 'pesan_sukses');
						redirect('keranjang');
					} else {
						$cartId = 'CRT-' . substr(time(), 5);
						$dataStiker['keranjang_id'] = $cartId;
						$dataCart = array(
							'keranjang_id' => $cartId,
							'keranjang_pengguna_id' => $this->session->userdata('session_id'),
							'keranjang_total' => $total,
						);
						$this->PesanModel->simpan('sipesan_order', $dataStiker);
						$this->BayarModel->simpan_keranjang($dataCart);
						$this->session->set_flashdata('alert', 'pesan_sukses');
						redirect('keranjang');
					}
				}
			}
		}
		$data = array(
			'title' => 'Pesan Stiker | Visual Creative Agency'
		);
		$this->load->view('frontend/templates/header',$data);
		$this->load->view('frontend/pesanan/stiker');
		$this->load->view('frontend/templates/footer');
	}
	public function pesanKartu(){

		if (isset($_POST['keranjang'])) {
			$kartuId = 'CRD-' . substr(time(), 5);
			$bahan = $this->input->post('bahan');
			$ukuran = $this->input->post('ukuran');
			$jumlah = $this->input->post('jumlah');
			$estimasi = $this->input->post('estimasi');
			$total = $this->input->post('harga_bahan') * $jumlah;

			$config['upload_path'] = './assets/images/kartu/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('upload')) {
				$error = array('error' => $this->upload->display_errors());
				var_dump($error);
			} else {
				$foto = $this->upload->data('file_name');

				$dataKartu = array(
					'id' => $kartuId,
					'ukuran' => $ukuran,
					'bahan' => $bahan,
					'jumlah' => $jumlah,
					'total' => $total,
					'foto' => $foto,
					'jenis_pesanan' => 'kartu_nama'
				);

				$allCart = $this->BayarModel->lihat_keranjang();
				$undoneCart = $this->BayarModel->lihat_keranjang_status($this->session->userdata('session_id'),'belum')->row_array();

				if ($allCart == null){
					$cartId = 'CRT-' . substr(time(), 5);
					$dataKartu['keranjang_id'] = $cartId;
					$dataCart = array(
						'keranjang_id' => $cartId,
						'keranjang_pengguna_id' => $this->session->userdata('session_id'),
						'keranjang_total' => $total,
					);

					$this->PesanModel->simpan('sipesan_order', $dataKartu);
					$this->BayarModel->simpan_keranjang($dataCart);
					$this->session->set_flashdata('alert', 'pesan_sukses');
					redirect('keranjang');
				} else {
					if ($undoneCart != null){
						$cartId = $undoneCart['keranjang_id'];
						$cartTotal = $undoneCart['keranjang_total'];
						$dataKartu['keranjang_id'] = $cartId;
						$dataCart['keranjang_total'] = $cartTotal + $total;

						$this->PesanModel->simpan('sipesan_order', $dataKartu);
						$this->BayarModel->update_keranjang($cartId,$dataCart);
						$this->session->set_flashdata('alert', 'pesan_sukses');
						redirect('keranjang');
					} else {
						$cartId = 'CRT-' . substr(time(), 5);
						$dataKartu['keranjang_id'] = $cartId;
						$dataCart = array(
							'keranjang_id' => $cartId,
							'keranjang_pengguna_id' => $this->session->userdata('session_id'),
							'keranjang_total' => $total,
						);

						$this->PesanModel->simpan('sipesan_order', $dataKartu);
						$this->BayarModel->simpan_keranjang($dataCart);
						$this->session->set_flashdata('alert', 'pesan_sukses');
						redirect('keranjang');
					}
				}
			}
		}
		$data = array(
			'title' => 'Pesan Kartu Nama | Visual Creative Agency'
		);
		$this->load->view('frontend/templates/header',$data);
		$this->load->view('frontend/pesanan/kartu');
		$this->load->view('frontend/templates/footer');
	}

	public function pesanBrosur(){
		if (isset($_POST['keranjang'])) {
			$brosurId = 'BRC-' . substr(time(), 5);
			$ukuran = $this->input->post('ukuran');
			$bahan = $this->input->post('bahan');
			$jumlah = $this->input->post('jumlah');
			$estimasi = $this->input->post('estimasi');
			$total = $this->input->post('harga_bahan') * $jumlah;

			$config['upload_path'] = './assets/images/brosur/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('upload')) {
				$error = array('error' => $this->upload->display_errors());
				var_dump($error);
			} else {
				$foto = $this->upload->data('file_name');

				$dataBrosur = array(
					'id' => $brosurId,
					'ukuran' => $ukuran,
					'bahan' => $bahan,
					'jumlah' => $jumlah,
					'total' => $total,
					'foto' => $foto,
					'jenis_pesanan' => 'brosur'
				);

				$allCart = $this->BayarModel->lihat_keranjang();
				$undoneCart = $this->BayarModel->lihat_keranjang_status($this->session->userdata('session_id'),'belum')->row_array();

				if ($allCart == null){
					$cartId = 'CRT-' . substr(time(), 5);
					$dataBrosur['keranjang_id'] = $cartId;
					$dataCart = array(
						'keranjang_id' => $cartId,
						'keranjang_pengguna_id' => $this->session->userdata('session_id'),
						'keranjang_total' => $total,
					);
					$this->PesanModel->simpan('sipesan_order', $dataBrosur);
					$this->BayarModel->simpan_keranjang($dataCart);
					$this->session->set_flashdata('alert', 'pesan_sukses');
					redirect('keranjang');
				} else {
					if ($undoneCart != null){
						$cartId = $undoneCart['keranjang_id'];
						$cartTotal = $undoneCart['keranjang_total'];
						$dataBrosur['keranjang_id'] = $cartId;
						$dataCart['keranjang_total'] = $cartTotal + $total;

						$this->PesanModel->simpan('sipesan_order', $dataBrosur);
						$this->BayarModel->update_keranjang($cartId,$dataCart);
						$this->session->set_flashdata('alert', 'pesan_sukses');
						redirect('keranjang');
					} else {
						$cartId = 'CRT-' . substr(time(), 5);
						$dataBrosur['keranjang_id'] = $cartId;
						$dataCart = array(
							'keranjang_id' => $cartId,
							'keranjang_pengguna_id' => $this->session->userdata('session_id'),
							'keranjang_total' => $total,
						);
						$this->PesanModel->simpan('sipesan_order', $dataBrosur);
						$this->BayarModel->simpan_keranjang($dataCart);
						$this->session->set_flashdata('alert', 'pesan_sukses');
						redirect('keranjang');
					}
				}
			}
		}
		$data = array(
			'title' => 'Pesan Brosur | Visual Creative Agency'
		);
		$this->load->view('frontend/templates/header',$data);
		$this->load->view('frontend/pesanan/brosur');
		$this->load->view('frontend/templates/footer');
	}

	public function pesanDesain()
	{
		if (isset($_POST['keranjang'])) {
			$desainId = 'DSN-' . substr(time(), 5);
			$panjang = $this->input->post('panjang');
			$lebar = $this->input->post('lebar');
			$bahan = $this->input->post('bahan');
			$keterangan = $this->input->post('keterangan');
			$jumlah = $this->input->post('jumlah');
			$estimasi = $this->input->post('estimasi');
			$total = round((($panjang * $lebar) * $this->input->post('harga_bahan'))*$jumlah);

			$config['upload_path'] = './assets/images/desain/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('upload')) {
				$error = array('error' => $this->upload->display_errors());
				var_dump($error);
			} else {
				$foto = $this->upload->data('file_name');

				$dataDesain = array(
					'id' => $desainId,
					'panjang' => $panjang,
					'lebar' => $lebar,
					'bahan' => $bahan,
					'jumlah' => $jumlah,
					'keterangan' => $keterangan,
					'total' => $total,
					'foto' => $foto,
					'jenis_pesanan' => 'desain'
				);

				$allCart = $this->BayarModel->lihat_keranjang();
				$undoneCart = $this->BayarModel->lihat_keranjang_status($this->session->userdata('session_id'),'belum')->row_array();

				if ($allCart == null){
					$cartId = 'CRT-' . substr(time(), 5);
					$dataDesain['keranjang_id'] = $cartId;
					$dataCart = array(
						'keranjang_id' => $cartId,
						'keranjang_pengguna_id' => $this->session->userdata('session_id'),
						'keranjang_total' => $total,
					);

					$this->PesanModel->simpan('sipesan_order', $dataDesain);
					$this->BayarModel->simpan_keranjang($dataCart);
					$this->session->set_flashdata('alert', 'pesan_sukses');
					redirect('keranjang');
				} else {
					if ($undoneCart != null){
						$cartId = $undoneCart['keranjang_id'];
						$cartTotal = $undoneCart['keranjang_total'];
						$dataDesain['keranjang_id'] = $cartId;
						$dataCart['keranjang_total'] = $cartTotal + $total;

						$this->PesanModel->simpan('sipesan_order', $dataDesain);
						$this->BayarModel->update_keranjang($cartId,$dataCart);
						$this->session->set_flashdata('alert', 'pesan_sukses');
						redirect('keranjang');
					} else {
						$cartId = 'CRT-' . substr(time(), 5);
						$dataDesain['keranjang_id'] = $cartId;
						$dataCart = array(
							'keranjang_id' => $cartId,
							'keranjang_pengguna_id' => $this->session->userdata('session_id'),
							'keranjang_total' => $total,
						);
						$this->PesanModel->simpan('sipesan_order', $dataDesain);
						$this->BayarModel->simpan_keranjang($dataCart);
						$this->session->set_flashdata('alert', 'pesan_sukses');
						redirect('keranjang');
					}
				}
			}
		}
		$data = array(
			'title' => 'Pesan Desain | Visual Creative Agency'
		);
		$this->load->view('frontend/templates/header',$data);
		$this->load->view('frontend/pesanan/desain');
		$this->load->view('frontend/templates/footer');
	}

	public function hapusKartu($id){
		$kartu = $this->PesanModel->lihat_kartu_by_id($id);
		$keranjang_id = $kartu['keranjang_id'];
		$keranjang = $this->BayarModel->lihat_keranjang_by_id($keranjang_id);
		$total = $kartu['total'];
		$data = array(
			'keranjang_total' => $keranjang['keranjang_total'] - $total
		);
		$this->PesanModel->delete('id',$id,'sipesan_order');
		$this->BayarModel->update_keranjang($keranjang_id,$data);
		$this->session->set_flashdata('alert', 'pesan_hapus');
		redirect('keranjang');
	}

	public function hapusSpanduk($id){
		$spanduk = $this->PesanModel->lihat_spanduk_by_id($id);
		$keranjang_id = $spanduk['keranjang_id'];
		$keranjang = $this->BayarModel->lihat_keranjang_by_id($keranjang_id);
		$total = $spanduk['total'];
		$data = array(
			'keranjang_total' => $keranjang['keranjang_total'] - $total
		);
		$this->PesanModel->delete('id',$id,'sipesan_order');
		$this->BayarModel->update_keranjang($keranjang_id,$data);
		$this->session->set_flashdata('alert', 'pesan_hapus');
		redirect('keranjang');
	}

	public function hapusStiker($id){
		$stiker = $this->PesanModel->lihat_stiker_by_id($id);
		$keranjang_id = $stiker['keranjang_id'];
		$keranjang = $this->BayarModel->lihat_keranjang_by_id($keranjang_id);
		$total = $stiker['total'];
		$data = array(
			'keranjang_total' => $keranjang['keranjang_total'] - $total
		);

		$this->PesanModel->delete('id',$id,'sipesan_order');
		$this->BayarModel->update_keranjang($keranjang_id,$data);
		$this->session->set_flashdata('alert', 'pesan_hapus');
		redirect('keranjang');
	}

	public function hapusBrosur($id){
		$brosur = $this->PesanModel->lihat_brosur_by_id($id);
		$keranjang_id = $brosur['keranjang_id'];
		$keranjang = $this->BayarModel->lihat_keranjang_by_id($keranjang_id);
		$total = $brosur['total'];
		$data = array(
			'keranjang_total' => $keranjang['keranjang_total'] - $total
		);
		$this->PesanModel->delete('id',$id,'sipesan_order');
		$this->BayarModel->update_keranjang($keranjang_id,$data);
		$this->session->set_flashdata('alert', 'pesan_hapus');
		redirect('keranjang');
	}

	public function hapusDesain($id){
		$desain = $this->PesanModel->lihat_desain_by_id($id);
		$keranjang_id = $desain['keranjang_id'];
		$keranjang = $this->BayarModel->lihat_keranjang_by_id($keranjang_id);
		$total = $desain['total'];
		$data = array(
			'keranjang_total' => $keranjang['keranjang_total'] - $total
		);
		$this->PesanModel->delete('id',$id,'sipesan_order');
		$this->BayarModel->update_keranjang($keranjang_id,$data);
		$this->session->set_flashdata('alert', 'pesan_hapus');
		redirect('keranjang');
	}

	
}
