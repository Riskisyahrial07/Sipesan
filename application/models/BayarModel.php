<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BayarModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function lihat_keranjang(){
		$this->db->from('sipesan_keranjang');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function lihat_keranjang_by_id($id){
		$this->db->from('sipesan_keranjang');
		$this->db->where('keranjang_id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}
	public function lihat_keranjang_status($pengguna_id,$status){
		$this->db->from('sipesan_keranjang');
		$this->db->where('keranjang_pengguna_id', $pengguna_id);
		$this->db->where('keranjang_status', $status);
		return $this->db->get();
	}
	public function lihat_keranjang_status_selesai($pengguna_id,$status,$id){
		$this->db->from('sipesan_keranjang');
		$this->db->where('keranjang_pengguna_id', $pengguna_id);
		$this->db->where('keranjang_status', $status);
		$this->db->where('keranjang_id', $id);
		return $this->db->get();
	}
	public function lihat_keranjang_spanduk($pengguna_id,$status,$keranjang_id){
		$this->db->from('sipesan_order');
		$this->db->join('sipesan_keranjang', 'sipesan_keranjang.keranjang_id = sipesan_order.keranjang_id');
		$this->db->join('sipesan_bahan', 'sipesan_bahan.bahan_id = sipesan_order.bahan');
		$this->db->where('sipesan_order.jenis_pesanan', 'spanduk');
		$this->db->where('sipesan_keranjang.keranjang_pengguna_id', $pengguna_id);
		$this->db->where('sipesan_keranjang.keranjang_id', $keranjang_id);
		$this->db->where('sipesan_keranjang.keranjang_status', $status);
		return $this->db->get();
	}
	public function lihat_keranjang_stiker($pengguna_id,$status,$keranjang_id){
		$this->db->from('sipesan_order');
		$this->db->join('sipesan_keranjang', 'sipesan_keranjang.keranjang_id = sipesan_order.keranjang_id');
		$this->db->join('sipesan_ukuran', 'sipesan_ukuran.ukuran_id = sipesan_order.ukuran');
		$this->db->join('sipesan_bahan', 'sipesan_bahan.bahan_id = sipesan_order.bahan');
		$this->db->where('sipesan_order.jenis_pesanan', 'stiker');
		$this->db->where('sipesan_keranjang.keranjang_pengguna_id', $pengguna_id);
		$this->db->where('sipesan_keranjang.keranjang_id', $keranjang_id);
		$this->db->where('sipesan_keranjang.keranjang_status', $status);
		return $this->db->get();
	}
	public function lihat_keranjang_kartu($pengguna_id,$status,$keranjang_id){
		$this->db->from('sipesan_order');
		$this->db->join('sipesan_keranjang', 'sipesan_keranjang.keranjang_id = sipesan_order.keranjang_id');
		$this->db->join('sipesan_ukuran', 'sipesan_ukuran.ukuran_id = sipesan_order.ukuran');
		$this->db->join('sipesan_bahan', 'sipesan_bahan.bahan_id = sipesan_order.bahan');
		$this->db->where('sipesan_order.jenis_pesanan', 'kartu_nama');
		$this->db->where('sipesan_keranjang.keranjang_pengguna_id', $pengguna_id);
		$this->db->where('sipesan_keranjang.keranjang_id', $keranjang_id);
		$this->db->where('sipesan_keranjang.keranjang_status', $status);
		return $this->db->get();
	}
	public function lihat_keranjang_brosur($pengguna_id,$status,$keranjang_id){
		$this->db->from('sipesan_order');
		$this->db->join('sipesan_keranjang', 'sipesan_keranjang.keranjang_id = sipesan_order.keranjang_id');
		$this->db->join('sipesan_ukuran', 'sipesan_ukuran.ukuran_id = sipesan_order.ukuran');
		$this->db->join('sipesan_bahan', 'sipesan_bahan.bahan_id = sipesan_order.bahan');
		$this->db->where('sipesan_order.jenis_pesanan', 'brosur');
		$this->db->where('sipesan_keranjang.keranjang_pengguna_id', $pengguna_id);
		$this->db->where('sipesan_keranjang.keranjang_id', $keranjang_id);
		$this->db->where('sipesan_keranjang.keranjang_status', $status);
		return $this->db->get();
	}
	public function lihat_keranjang_desain($pengguna_id,$status,$keranjang_id){
		$this->db->from('sipesan_order');
		$this->db->join('sipesan_keranjang', 'sipesan_keranjang.keranjang_id = sipesan_order.keranjang_id');
		$this->db->join('sipesan_bahan', 'sipesan_bahan.bahan_id = sipesan_order.bahan');
		$this->db->where('sipesan_order.jenis_pesanan', 'desain');
		$this->db->where('sipesan_keranjang.keranjang_pengguna_id', $pengguna_id);
		$this->db->where('sipesan_keranjang.keranjang_id', $keranjang_id);
		$this->db->where('sipesan_keranjang.keranjang_status', $status);
		return $this->db->get();
	}
	public function lihat_keranjang_spanduk_admin($status,$tanggal){
		$this->db->from('sipesan_order');
		$this->db->join('sipesan_keranjang', 'sipesan_keranjang.keranjang_id = sipesan_order.keranjang_id');
		$this->db->join('sipesan_bahan', 'sipesan_bahan.bahan_id = sipesan_order.bahan');
		$this->db->join('sipesan_faktur', 'sipesan_faktur.faktur_keranjang_id = sipesan_keranjang.keranjang_id');
		$this->db->join('sipesan_pengguna', 'sipesan_pengguna.pengguna_id = sipesan_keranjang.keranjang_pengguna_id');
		$this->db->where('sipesan_order.jenis_pesanan', 'spanduk');
		$this->db->like('sipesan_faktur.faktur_date_created',$tanggal);
		$this->db->where('sipesan_keranjang.keranjang_status', $status);
		$this->db->where('sipesan_faktur.faktur_status', 'sudah');
		return $this->db->get();
	}
	public function lihat_keranjang_stiker_admin($status,$tanggal){
		$this->db->from('sipesan_order');
		$this->db->join('sipesan_keranjang', 'sipesan_keranjang.keranjang_id = sipesan_order.keranjang_id');
		$this->db->join('sipesan_bahan', 'sipesan_bahan.bahan_id = sipesan_order.bahan');
		$this->db->join('sipesan_ukuran', 'sipesan_ukuran.ukuran_id = sipesan_order.ukuran');
		$this->db->join('sipesan_faktur', 'sipesan_faktur.faktur_keranjang_id = sipesan_keranjang.keranjang_id');
		$this->db->join('sipesan_pengguna', 'sipesan_pengguna.pengguna_id = sipesan_keranjang.keranjang_pengguna_id');
		$this->db->where('sipesan_order.jenis_pesanan', 'stiker');
		$this->db->like('sipesan_faktur.faktur_date_created',$tanggal);
		$this->db->where('sipesan_keranjang.keranjang_status', $status);
		$this->db->where('sipesan_faktur.faktur_status', 'sudah');
		return $this->db->get();
	}
	public function lihat_keranjang_kartu_admin($status,$tanggal){
		$this->db->from('sipesan_order');
		$this->db->join('sipesan_keranjang', 'sipesan_keranjang.keranjang_id = sipesan_order.keranjang_id');
		$this->db->join('sipesan_bahan', 'sipesan_bahan.bahan_id = sipesan_order.bahan');
		$this->db->join('sipesan_ukuran', 'sipesan_ukuran.ukuran_id = sipesan_order.ukuran');
		$this->db->join('sipesan_faktur', 'sipesan_faktur.faktur_keranjang_id = sipesan_keranjang.keranjang_id');
		$this->db->join('sipesan_pengguna', 'sipesan_pengguna.pengguna_id = sipesan_keranjang.keranjang_pengguna_id');
		$this->db->where('sipesan_order.jenis_pesanan', 'kartu_nama');
		$this->db->like('sipesan_faktur.faktur_date_created',$tanggal);
		$this->db->where('sipesan_keranjang.keranjang_status', $status);
		$this->db->where('sipesan_faktur.faktur_status', 'sudah');
		return $this->db->get();
	}
	public function lihat_keranjang_brosur_admin($status,$tanggal){
		$this->db->from('sipesan_order');
		$this->db->join('sipesan_keranjang', 'sipesan_keranjang.keranjang_id = sipesan_order.keranjang_id');
		$this->db->join('sipesan_bahan', 'sipesan_bahan.bahan_id = sipesan_order.bahan');
		$this->db->join('sipesan_ukuran', 'sipesan_ukuran.ukuran_id = sipesan_order.ukuran');
		$this->db->join('sipesan_faktur', 'sipesan_faktur.faktur_keranjang_id = sipesan_keranjang.keranjang_id');
		$this->db->join('sipesan_pengguna', 'sipesan_pengguna.pengguna_id = sipesan_keranjang.keranjang_pengguna_id');
		$this->db->where('sipesan_order.jenis_pesanan', 'brosur');
		$this->db->like('sipesan_faktur.faktur_date_created',$tanggal);
		$this->db->where('sipesan_keranjang.keranjang_status', $status);
		$this->db->where('sipesan_faktur.faktur_status', 'sudah');
		return $this->db->get();
	}
	public function lihat_keranjang_desain_admin($status,$tanggal){
		$this->db->from('sipesan_order');
		$this->db->join('sipesan_keranjang', 'sipesan_keranjang.keranjang_id = sipesan_order.keranjang_id');
		$this->db->join('sipesan_bahan', 'sipesan_bahan.bahan_id = sipesan_order.bahan');
		$this->db->join('sipesan_faktur', 'sipesan_faktur.faktur_keranjang_id = sipesan_keranjang.keranjang_id');
		$this->db->join('sipesan_pengguna', 'sipesan_pengguna.pengguna_id = sipesan_keranjang.keranjang_pengguna_id');
		$this->db->where('sipesan_order.jenis_pesanan', 'desain');
		$this->db->like('sipesan_faktur.faktur_date_created',$tanggal);
		$this->db->where('sipesan_keranjang.keranjang_status', $status);
		$this->db->where('sipesan_faktur.faktur_status', 'sudah');
		return $this->db->get();
	}
	public function lihat_keranjang_faktur($pengguna_id){
		$this->db->from('sipesan_keranjang');
		$this->db->order_by('keranjang_date_created','DESC');
		$this->db->join('sipesan_faktur', 'sipesan_faktur.faktur_keranjang_id = sipesan_keranjang.keranjang_id');
		$this->db->where('keranjang_pengguna_id', $pengguna_id);
		return $this->db->get();
	}
	public function lihat_keranjang_faktur_admin(){
		$this->db->from('sipesan_keranjang');
		$this->db->order_by('keranjang_date_created','DESC');
		$this->db->join('sipesan_faktur', 'sipesan_faktur.faktur_keranjang_id = sipesan_keranjang.keranjang_id');
		$this->db->join('sipesan_pengguna', 'sipesan_pengguna.pengguna_id = sipesan_keranjang.keranjang_pengguna_id');
		return $this->db->get();
	}
	public function lihat_keranjang_faktur_admin_by_id($id){
		$this->db->from('sipesan_keranjang');
		$this->db->join('sipesan_faktur', 'sipesan_faktur.faktur_keranjang_id = sipesan_keranjang.keranjang_id');
		$this->db->join('sipesan_pengguna', 'sipesan_pengguna.pengguna_id = sipesan_keranjang.keranjang_pengguna_id');
		$this->db->where('faktur_id', $id);
		return $this->db->get();
	}
	public function lihat_keranjang_faktur_konfirmasi_admin_by_id($id){
		$this->db->from('sipesan_keranjang');
		$this->db->join('sipesan_faktur', 'sipesan_faktur.faktur_keranjang_id = sipesan_keranjang.keranjang_id');
		$this->db->join('sipesan_pengguna', 'sipesan_pengguna.pengguna_id = sipesan_keranjang.keranjang_pengguna_id');
		$this->db->join('sipesan_konfirmasi', 'sipesan_konfirmasi.konfirmasi_faktur_id = sipesan_faktur.faktur_id');$this->db->where('faktur_id', $id);
		return $this->db->get();
	}
	public function lihat_keranjang_faktur_by_id($id,$pengguna_id){
		$this->db->from('sipesan_keranjang');
		$this->db->join('sipesan_faktur', 'sipesan_faktur.faktur_keranjang_id = sipesan_keranjang.keranjang_id');
		$this->db->where('keranjang_pengguna_id', $pengguna_id);
		$this->db->where('faktur_id', $id);
		return $this->db->get();
	}
	public function simpan_keranjang($data){
		$this->db->insert('sipesan_keranjang',$data);
		return $this->db->affected_rows();
	}
	public function update_keranjang($id,$data){
		$this->db->where('keranjang_id', $id);
		$this->db->update('sipesan_keranjang',$data);
		return $this->db->affected_rows();
	}
	public function simpan_faktur($data){
		$this->db->insert('sipesan_faktur',$data);
		return $this->db->affected_rows();
	}
	public function update_faktur($id,$data){
		$this->db->where('faktur_id', $id);
		$this->db->update('sipesan_faktur',$data);
		return $this->db->affected_rows();
	}
	public function simpan_konfirmasi($data){
		$this->db->insert('sipesan_konfirmasi',$data);
		return $this->db->affected_rows();
	}

	// public function get_chart(){
	// 	$this->db->select(IFNULL(SUM('desain_total'), 0), false);
	// 	$this->db->select('DATE(faktur_date_created) AS date_created');
	// 	$this->db->from('sipesan_desain');
	// 	$this->db->join('sipesan_keranjang', 'sipesan_keranjang.keranjang_id = sipesan_desain.desain_keranjang_id', 'right');
	// 	$this->db->join('sipesan_faktur', 'sipesan_faktur.faktur_keranjang_id = sipesan_keranjang.keranjang_id', 'right');
	// 	$this->db->where('sipesan_faktur.faktur_status', 'sudah');
	// 	$this->db->where('DATE(sipesan_faktur.faktur_date_created) >=', '2023-06-26');
	// 	$this->db->where('DATE(sipesan_faktur.faktur_date_created) <=','2023-06-30');
	// 	$this->db->group_by('date_created');
	// 	return $this->db->get();
	// }

	public function get_chart($tanggal, $tipe){
		$this->db->select_sum('total');
		$this->db->from('sipesan_order');
		$this->db->join('sipesan_keranjang', 'sipesan_keranjang.keranjang_id = sipesan_order.keranjang_id');
		$this->db->join('sipesan_faktur', 'sipesan_faktur.faktur_keranjang_id = sipesan_keranjang.keranjang_id');
		$this->db->where('sipesan_order.jenis_pesanan', $tipe);
		$this->db->where('sipesan_faktur.faktur_status', 'sudah');
		$this->db->where('DATE(sipesan_faktur.faktur_date_created)', $tanggal);
		return $this->db->get()->row_array();
	}
}
