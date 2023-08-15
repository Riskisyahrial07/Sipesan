<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UkuranController extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$model = array('UkuranModel');
		$this->load->model($model);
		if (!$this->session->has_userdata('session_id')) {
			$this->session->set_flashdata('alert', 'belum_login');
			redirect(base_url('admin/login'));
		}
	}
    
	public function index(){
		$data = array(
			'ukuran' => $this->UkuranModel->get()
		);

		$this->load->view('backend/templates/header');
		$this->load->view('backend/ukuran/index',$data);
		$this->load->view('backend/templates/footer');
	}

	public function add(){
		$data = array(
			'tipe_pesanan' => $this->db->get('sipesan_pesanan')->result(),
			'page' => 'add'
		);

		$this->load->view('backend/templates/header');
		$this->load->view('backend/ukuran/form',$data);
		$this->load->view('backend/templates/footer');
	}

	public function store(){

		$formData = array(
			'ukuran_id_pesanan' => $this->input->post('jenis_pesanan'),
			'ukuran_nama' => $this->input->post('nama_ukuran'),
		); 

		$this->db->insert('sipesan_ukuran',$formData);
		$this->session->set_flashdata('message', 'Ukuran berhasil ditambahkan');
        redirect('admin/ukuran/');
	}

	public function edit($id){

		$data = array(
			'ukuran' => $this->db->get_where('sipesan_ukuran', ['ukuran_id' => $id])->row_array(),
			'tipe_pesanan' => $this->db->get('sipesan_pesanan')->result(),
			'page' => 'edit'
		);

		$this->load->view('backend/templates/header');
		$this->load->view('backend/ukuran/form',$data);
		$this->load->view('backend/templates/footer');
	}

	public function update($id){

		$formData = array(
			'ukuran_id_pesanan' => $this->input->post('jenis_pesanan'),
			'ukuran_nama' => $this->input->post('nama_ukuran'),
		); 
	
		$this->db->where('ukuran_id', $id);
		$this->db->update('sipesan_ukuran', $formData);

		$this->session->set_flashdata('message', 'Ukuran berhasil diperbarui');
        redirect('admin/ukuran/');
	}

	public function delete($id){

		$this->db->delete('sipesan_ukuran', array('ukuran_id' => $id)); 

		$this->session->set_flashdata('message', 'ukuran berhasil dihapus');
        redirect('admin/ukuran/');
	}
}
