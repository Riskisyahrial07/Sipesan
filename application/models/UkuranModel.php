<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UkuranModel extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get(){
		$this->db->select ( 'sipesan_ukuran.*,sipesan_pesanan.nama_pesanan' )
        ->from ( 'sipesan_ukuran' )
        ->join ( 'sipesan_pesanan', 'sipesan_pesanan.id = sipesan_ukuran.ukuran_id_pesanan');
        $query = $this->db->get();

		return $query->result();
	}
}
