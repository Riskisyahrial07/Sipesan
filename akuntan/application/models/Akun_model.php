<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun_model extends CI_Model{
    private $table = 'akun';

    public function getAkun(){
        return $this->db->get($this->table)->result();
    }

    public function getAkunByMonthYear($bulan,$tahun){
        return $this->db->select('akun.no_reff,akun.nama_reff,akun.keterangan,transaksi.tgl_transaksi')
                        ->from($this->table)
                        ->where('month(transaksi.tgl_transaksi)',$bulan)
                        ->where('year(transaksi.tgl_transaksi)',$tahun)
                        ->join('transaksi','transaksi.no_reff = akun.no_reff')
                        ->group_by('akun.nama_reff')
                        ->order_by('akun.no_reff')
                        ->get()
                        ->result();
    }

    // revisi
    public function getLabaRugi($bulan, $tahun) {
        $data = $this->db->query("select 
            a.nama_reff,
            a.no_reff,
            left(a.no_reff, 1) as header,
            case when b.saldo is not null then sum(b.saldo) 
            else 0 end
            as saldo,
            b.tgl_transaksi,
            b.tgl_input, b.jenis_saldo
        from akun a 
        left join transaksi b on a.no_reff = b.no_reff
        where a.is_laba_rugi = '1'
        and month(b.tgl_transaksi) = '$bulan'
        and year(b.tgl_transaksi) = '$tahun'
        group by a.no_reff;")->result();
        return $data;
    }
    public function getPerubahanModal($bulan, $tahun) {
        $data = $this->db->query("select 
            a.nama_reff,
            a.no_reff,
            left(a.no_reff, 1) as header,
            case when b.saldo is not null then sum(b.saldo) 
            else 0 end
            as saldo,
            b.tgl_transaksi,
            b.tgl_input, b.jenis_saldo
        from akun a 
        left join transaksi b on a.no_reff = b.no_reff
        where a.is_laba_rugi = '2'
        and month(b.tgl_transaksi) = '$bulan'
        and year(b.tgl_transaksi) = '$tahun'
        group by a.no_reff;")->result();
        return $data;
    }

    public function getModal($bulan, $tahun)
    {
        $data = $this->db->query("select 
        a.nama_reff,
        a.no_reff,
        case when b.saldo is not null then sum(b.saldo) 
        else 0 end
        as saldo,  
        b.tgl_transaksi,
        b.tgl_input, b.jenis_saldo
    from akun a 
    left join transaksi b on a.no_reff = b.no_reff
    where a.no_reff = '3000'
    and month(b.tgl_transaksi) = '$bulan'
    and year(b.tgl_transaksi) = '$tahun'
    and left(a.no_reff, 1) = '3'
    group by a.no_reff;")->result();
        return $data;
    }
    public function getPendapatan($bulan, $tahun)
    {
        $data = $this->db->query("select 
            a.nama_reff,
            a.no_reff,
            left(a.no_reff, 1) as header,
            case when b.saldo is not null then sum(b.saldo) 
            else 0 end
            as saldo,
            b.tgl_transaksi,
            b.tgl_input, b.jenis_saldo
        from akun a 
        left join transaksi b on a.no_reff = b.no_reff
        where a.is_laba_rugi = '1'
        and month(b.tgl_transaksi) = '$bulan'
        and year(b.tgl_transaksi) = '$tahun'
        and left(a.no_reff, 1) = '4'
        group by a.no_reff;")->result();
        return $data;
    }

    public function getBeban($bulan, $tahun)
    {
        $data = $this->db->query("select 
            a.nama_reff,
            a.no_reff,
            left(a.no_reff, 1) as header,
            case when b.saldo is not null then sum(b.saldo) 
            else 0 end
            as saldo,
            b.tgl_transaksi,
            b.tgl_input, b.jenis_saldo
        from akun a 
        left join transaksi b on a.no_reff = b.no_reff
        where a.is_laba_rugi = '1'
        and month(b.tgl_transaksi) = '$bulan'
        and year(b.tgl_transaksi) = '$tahun'
        and left(a.no_reff, 1) = '5'
        group by a.no_reff;")->result();
        return $data;
    }

    public function countAkunByNama($str){
        return $this->db->where('nama_reff',$str)->get($this->table)->num_rows();
    }

    public function countAkunByNoReff($str){
        return $this->db->where('no_reff',$str)->get($this->table)->num_rows();
    }

    public function getAkunByNo($noReff){
        return $this->db->where('no_reff',$noReff)->get($this->table)->row();
    }

    public function insertAkun($data){
        return $this->db->insert($this->table,$data);
    }

    public function updateAkun($noReff,$data){
        return $this->db->where('no_reff',$noReff)->update($this->table,$data);
    }

    public function deleteAkun($noReff){
        return $this->db->where('no_reff',$noReff)->delete($this->table);
    }

    public function getDefaultValues(){
        return [
            'no_reff'=>'',
            'nama_reff'=>'',
            'keterangan'=>''
        ];
    }

    public function getValidationRules(){
        return [
            [
                'field'=>'no_reff',
                'label'=>'No.Reff',
                'rules'=>'trim|required|numeric|callback_isNoAkunThere'
            ],
            [
                'field'=>'nama_reff',
                'label'=>'Nama Reff',
                'rules'=>'trim|required|callback_isNamaAkunThere'
            ],
            [
                'field'=>'keterangan',
                'label'=>'Keterangan',
                'rules'=>'trim|required'
            ],
        ];
    }

    public function validate(){
        $rules = $this->getValidationRules();
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_error_delimiters('<span class="text-danger" style="font-size:14px">','</span>');
        return $this->form_validation->run();
    }
}