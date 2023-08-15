<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BahanController extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$model = array('BahanModel');
		$this->load->model($model);
		if (!$this->session->has_userdata('session_id')) {
			$this->session->set_flashdata('alert', 'belum_login');
			redirect(base_url('admin/login'));
		}
	}
    
	public function index(){
		$data = array(
			'bahan' => $this->BahanModel->get()
		);

		$this->load->view('backend/templates/header');
		$this->load->view('backend/bahan/index',$data);
		$this->load->view('backend/templates/footer');
	}

	public function add(){
		$data = array(
			'tipe_pesanan' => $this->db->get('sipesan_pesanan')->result(),
			'page' => 'add'
		);

		$this->load->view('backend/templates/header');
		$this->load->view('backend/bahan/form',$data);
		$this->load->view('backend/templates/footer');
	}

	public function store(){

		$formData = array(
			'bahan_id_pesanan' => $this->input->post('jenis_pesanan'),
			'bahan_nama' => $this->input->post('nama_bahan'),
			'bahan_harga' => $this->input->post('harga_bahan'),
		); 

		$this->db->insert('sipesan_bahan',$formData);
		$this->session->set_flashdata('message', 'Bahan berhasil ditambahkan');
        redirect('admin/bahan/');
	}

	public function edit($id){

		$data = array(
			'bahan' => $this->db->get_where('sipesan_bahan', ['bahan_id' => $id])->row_array(),
			'tipe_pesanan' => $this->db->get('sipesan_pesanan')->result(),
			'page' => 'edit'
		);

		$this->load->view('backend/templates/header');
		$this->load->view('backend/bahan/form',$data);
		$this->load->view('backend/templates/footer');
	}

	public function update($id){

		$formData = array(
			'bahan_id_pesanan' => $this->input->post('jenis_pesanan'),
			'bahan_nama' => $this->input->post('nama_bahan'),
			'bahan_harga' => $this->input->post('harga_bahan'),
		); 
	
		$this->db->where('bahan_id', $id);
		$this->db->update('sipesan_bahan', $formData);

		$this->session->set_flashdata('message', 'Bahan berhasil diperbarui');
        redirect('admin/bahan/');
	}

	public function delete($id){

		$this->db->delete('sipesan_bahan', array('bahan_id' => $id)); 

		$this->session->set_flashdata('message', 'Bahan berhasil dihapus');
        redirect('admin/bahan/');
	}

	
}
