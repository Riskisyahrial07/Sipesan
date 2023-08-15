<!-- // application/models/DataCopy_model.php -->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataCopy_model extends CI_Model {

    public function copyDataFromSourceToDestination() {
        // Kode untuk menyalin data dari tabel_sumber ke tabel_tujuan
        $query = $this->db->query("INSERT INTO transaksi (tgl_input, tgl_transaksi, saldo)
                                  SELECT keranjang_date_created, keranjang_date_created, keranjang_total FROM sipesan_keranjang");

        if ($this->db->affected_rows() > 0) {
            $result = array('message' => 'Data berhasil disalin.');
        } else {
            $result = array('message' => 'Gagal menyalin data.');
        }

        return $result;
    }

    public function getdataKeranjang() {
        $this->db->from('sipesan_keranjang');
        $query = $this->db->get();
        return $query->result_array();
            // // Mengambil data dari tabel di database
            // $query = $this->db->get('sipesan_keranjang');
            
            // // Mengembalikan hasil query dalam bentuk array
            // return $query->result_array();
            // return $this->db->get($this->table)->result();
        }

        public function getDataFromTableA()
    {
        // Query untuk mengambil 3 atribut dari tabel A
        $this->db->select('column1, column2, column3');
        $query = $this->db->get('sipesan_keranjang');
        return $query->result();
    }

    public function getDataFromTableB()
    {
        // Query untuk mengambil 2 atribut dari tabel B
        $this->db->select('column4, column5');
        $query = $this->db->get('transaksi');
        return $query->result();
    }

}
?>
