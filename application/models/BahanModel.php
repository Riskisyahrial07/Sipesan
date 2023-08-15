<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BahanModel extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get(){
		$this->db->select ( 'sipesan_bahan.*,sipesan_pesanan.nama_pesanan' )
        ->from ( 'sipesan_bahan' )
        ->join ( 'sipesan_pesanan', 'sipesan_pesanan.id = sipesan_bahan.bahan_id_pesanan');
        $query = $this->db->get();

		return $query->result();
	}
}
