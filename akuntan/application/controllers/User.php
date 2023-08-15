<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper(['url','form','sia','tgl_indo']);
        $this->load->library(['session','form_validation']);
        $this->load->model('Akun_model','akun',true);
        $this->load->model('Jurnal_model','jurnal',true);
        $this->load->model('User_model','user',true);
        $this->load->model('DataCopy_model','transaksi',true);
        $login = $this->session->userdata('login');
        if(!$login){
            redirect('login');
        }
    }

    public function index(){
        $titleTag = 'Dashboard';
        $content = 'user/dashboard';
        $data = null;
        $saldo = null;
        $dataAkun = $this->akun->getAkun();
        $dataAkunTransaksi = $this->jurnal->getAkunInJurnal();
        
        foreach($dataAkunTransaksi as $row){
            $data[] = (array) $this->jurnal->getJurnalByNoReff($row->no_reff);
            $saldo[] = (array) $this->jurnal->getJurnalByNoReffSaldo($row->no_reff);
        }
        

        // if($data == null || $saldo == null){
        //     $data = 0;
        //     $saldo = 0;
        // }
        
        $jumlah = $data == NULL ? 0 : count($data);

        $jurnals = $this->jurnal->getJurnalJoinAkun();
        $totalDebit = $this->jurnal->getTotalSaldo('debit');
        $totalKredit = $this->jurnal->getTotalSaldo('kredit');
        $this->load->view('template',compact('content','dataAkun','titleTag','jurnals','totalDebit','totalKredit','jumlah','data','saldo','dataAkunTransaksi'));
    }

    public function dataAkun(){
        $content = 'user/data_akun';
        $titleTag = 'Data Akun';
        $dataAkun = $this->akun->getAkun();
        $this->load->view('template',compact('content','dataAkun','titleTag'));
    }

    public function isNamaAkunThere($str){
        $namaAkun = $this->akun->countAkunByNama($str);
        if($namaAkun >= 1){
            $this->form_validation->set_message('isNamaAkunThere', 'Nama Akun Sudah Ada');
            return false;
        }
        return true;
    }

    public function isNoAkunThere($str){
        $noAkun = $this->akun->countAkunByNoReff($str);
        if($noAkun >= 1){
            $this->form_validation->set_message('isNoAkunThere', 'No.Reff Sudah Ada');
            return false;
        }
        return true;
    }

    public function createAkun(){
        $title = 'Tambah';
        $titleTag = 'Tambah Data Akun';
        $action = 'data_akun/tambah';
        $content = 'user/form_akun';

        if(!$_POST){
            $data = (object) $this->akun->getDefaultValues();
        }else{
            $data = (object) $this->input->post(null,true);
            $data->id_user = $this->session->userdata('id');
        }

        if(!$this->akun->validate()){
            $this->load->view('template',compact('content','title','action','data','titleTag'));
            return;
        }
        
        $this->akun->insertAkun($data);
        $this->session->set_flashdata('berhasil','Data Akun Berhasil Di Tambahkan');
        redirect('data_akun');
    }

    public function editAkun($no_reff = null){
        $title = 'Edit';
        $titleTag = 'Edit Data Akun';
        $action = 'data_akun/edit/'.$no_reff;
        $content = 'user/form_akun';

        if(!$_POST){
            $data = (object) $this->akun->getAkunByNo($no_reff);
        }else{
            $data = (object) $this->input->post(null,true);
            $data->id_user = $this->session->userdata('id');
        }

        if(!$this->akun->validate()){
            $this->load->view('template',compact('content','title','action','data','titleTag'));
            return;
        }
        
        $this->akun->updateAkun($no_reff,$data);
        $this->session->set_flashdata('berhasil','Data Akun Berhasil Di Ubah');
        redirect('data_akun');
    }

    public function deleteAkun(){
        $id = $this->input->post('id',true);
        $noReffTransaksi = $this->jurnal->countJurnalNoReff($id);
        if($noReffTransaksi > 0 ){
            $this->session->set_flashdata('dataNull','No.Reff '.$id.' Tidak Bisa Di Hapus Karena Data Akun Ada Di Jurnal Umum');
            redirect('data_akun');
        }
        $this->akun->deleteAkun($id);
        $this->session->set_flashdata('berhasilHapus','Data akun dengan No.Reff '.$id.' berhasil di hapus');
        redirect('data_akun');
    }

    public function jurnalUmum(){
        $titleTag = 'Jurnal Umum';
        $content = 'user/jurnal_umum_main';
        $listJurnal = $this->jurnal->getJurnalByYearAndMonth();
        $tahun = $this->jurnal->getJurnalByYear();
        $this->load->view('template',compact('content','listJurnal','titleTag','tahun'));
    }

    public function jurnalUmumDetail(){
        $content = 'user/jurnal_umum';
        $titleTag = 'Jurnal Umum';

        $bulan = $this->input->post('bulan',true);
        $tahun = $this->input->post('tahun',true);
        $jurnals = null;

        if(empty($bulan) || empty($tahun)){
            redirect('jurnal_umum');
        }

        $jurnals = $this->jurnal->getJurnalJoinAkunDetail($bulan,$tahun);
        $totalDebit = $this->jurnal->getTotalSaldoDetail('debit',$bulan,$tahun);
        $totalKredit = $this->jurnal->getTotalSaldoDetail('kredit',$bulan,$tahun);

        if($jurnals==null){
            $this->session->set_flashdata('dataNull','Data Jurnal Dengan Bulan '.bulan($bulan).' Pada Tahun '.date('Y',strtotime($tahun)).' Tidak Di Temukan');
            redirect('jurnal_umum');
        }

        $this->load->view('template',compact('content','jurnals','totalDebit','totalKredit','titleTag'));
    }

    public function createJurnal(){
        $title = 'Tambah'; 
        $content = 'user/form_jurnal'; 
        $action = 'jurnal_umum/tambah'; 
        $tgl_input = date('Y-m-d H:i:s'); 
        $id_user = $this->session->userdata('id'); 
        $titleTag = 'Tambah Jurnal Umum';

        if(!$_POST){
            $data = (object) $this->jurnal->getDefaultValues();
        }else{

            $data = [
				[
					'id_user'=>$id_user,
                    'no_reff'=>$this->input->post('no_reff',true),
                    'tgl_input'=>$tgl_input,
                    'tgl_transaksi'=>$this->input->post('tgl_transaksi',true),
                    'jenis_saldo'=>$this->input->post('jenis_saldo',true),
                    'saldo'=>$this->input->post('saldo',true)
				],
				[
					'id_user'=>$id_user,
                    'no_reff'=>$this->input->post('no_reff_second',true),
                    'tgl_input'=>$tgl_input,
                    'tgl_transaksi'=>$this->input->post('tgl_transaksi',true),
                    'jenis_saldo'=>$this->input->post('jenis_saldo_second',true),
                    'saldo'=>$this->input->post('saldo_second',true)
				]
			]; 
        }

        if(!$this->jurnal->validate()){
            $this->load->view('template',compact('content','title','action','data','titleTag'));
            return;
        }
        
        $this->jurnal->insertJurnal($data);
        $this->session->set_flashdata('berhasil','Data Jurnal Berhasil Di Tambahkan');
        redirect('jurnal_umum');    
    }
    public function createJurnal2(){
        $title = 'Tambah'; 
        $content = 'user/form_jurnal'; 
        $action = 'jurnal_umum/tambah'; 
        $tgl_input = date('Y-m-d H:i:s'); 
        $id_user = $this->session->userdata('id'); 
        $titleTag = 'Tambah Jurnal Umum';

        if(!$_POST){
            $data = (object) $this->jurnal->getDefaultValues();
        }else{
            $data = (object) [
                'id_user'=>$id_user,
                'no_reff2'=>$this->input->post('no_reff2',true),
                'tgl_input'=>$tgl_input,
                'tgl_transaksi'=>$this->input->post('tgl_transaksi',true),
                'jenis_saldo2'=>$this->input->post('jenis_saldo2',true),
                'saldo2'=>$this->input->post('saldo2',true)
            ];
        }

        if(!$this->jurnal->validate()){
            $this->load->view('template',compact('content','title','action','data','titleTag'));
            return;
        }
        
        $this->jurnal->insertJurnal($data);
        $this->session->set_flashdata('berhasil','Data Jurnal Berhasil Di Tambahkan');
        redirect('jurnal_umum');    
    }

    public function editForm(){
        if($_POST){
            $id = $this->input->post('id',true);
            $title = 'Edit'; $content = 'user/form_jurnal'; $param = 'edit'; $action = 'jurnal_umum/edit'; $titleTag = 'Edit Jurnal Umum';

            $data = (object) $this->jurnal->getJurnalById($id);

            $this->load->view('template',compact('content','title','action','data','id','titleTag','param'));
        }else{
            redirect('jurnal_umum');
        }
    }

    public function editJurnal(){
        $title = 'Edit'; $content = 'user/form_jurnal'; $action = 'jurnal_umum/edit'; $param = 'edit'; $tgl_input = date('Y-m-d H:i:s'); $id_user = $this->session->userdata('id'); $titleTag = 'Edit Jurnal Umum';

        if($_POST){
            $data = (object) [
                'id_user'=>$id_user,
                'no_reff'=>$this->input->post('no_reff',true),
                'tgl_input'=>$tgl_input,
                'tgl_transaksi'=>$this->input->post('tgl_transaksi',true),
                'jenis_saldo'=>$this->input->post('jenis_saldo',true),
                'saldo'=>$this->input->post('saldo',true)
            ];
            $id = $this->input->post('id',true);
        }

        if(!$this->jurnal->validateUpdate()){
            $this->load->view('template',compact('content','title','action','data','id','titleTag', 'param'));
            return;
        }
        
        $this->jurnal->updateJurnal($id,$data);
        $this->session->set_flashdata('berhasil','Data Jurnal Berhasil Di Ubah');
        redirect('jurnal_umum');    
    }

    public function deleteJurnal(){
        $id = $this->input->post('id',true);
        $this->jurnal->deleteJurnal($id);
        $this->session->set_flashdata('berhasilHapus','Data Jurnal berhasil di hapus');
        redirect('jurnal_umum');
    }

    public function bukuBesar(){
        $titleTag = 'Buku Besar';
        $content = 'user/buku_besar_main';
        $listJurnal = $this->jurnal->getJurnalByYearAndMonth();
        $tahun = $this->jurnal->getJurnalByYear();
        $this->load->view('template',compact('content','listJurnal','titleTag','tahun'));
    }

    public function bukuBesarDetail(){
        $content = 'user/buku_besar';
        $titleTag = 'Buku Besar';
        
        $bulan = $this->input->post('bulan',true);
        $tahun = $this->input->post('tahun',true);

        if(empty($bulan) ||empty($tahun)){
            redirect('buku_besar');
        }
        
        $dataAkun = $this->akun->getAkunByMonthYear($bulan,$tahun);
        $data = null;
        $saldo = null;

        foreach($dataAkun as $row){
            $data[] = (array) $this->jurnal->getJurnalByNoReffMonthYear($row->no_reff,$bulan,$tahun);
            $saldo[] = (array) $this->jurnal->getJurnalByNoReffSaldoMonthYear($row->no_reff,$bulan,$tahun);
        }

        if($data == null || $saldo == null){
            $this->session->set_flashdata('dataNull','Data Buku Besar Dengan Bulan '.bulan($bulan).' Pada Tahun '.date('Y',strtotime($tahun)).' Tidak Di Temukan');
            redirect('buku_besar');
        }

        $jumlah = count($data);

        $this->load->view('template',compact('content','titleTag','dataAkun','data','jumlah','saldo'));
    }

    public function neracaSaldo(){
        $titleTag = 'Neraca Saldo';
        $content = 'user/neraca_saldo_main';
        $listJurnal = $this->jurnal->getJurnalByYearAndMonth();
        $tahun = $this->jurnal->getJurnalByYear();
        $this->load->view('template',compact('content','listJurnal','titleTag','tahun'));
    }

    public function neracaSaldoDetail(){
        $content = 'user/neraca_saldo';
        $titleTag = 'Neraca Saldo';

        $bulan = $this->input->post('bulan',true);
        $tahun = $this->input->post('tahun',true);

        if(empty($bulan) || empty($tahun)){
            redirect('neraca_saldo');
        }

        $dataAkun = $this->akun->getAkunByMonthYear($bulan,$tahun);
        $data = null;
        $saldo = null;
        
        foreach($dataAkun as $row){
            $data[] = (array) $this->jurnal->getJurnalByNoReffMonthYear($row->no_reff,$bulan,$tahun);
            $saldo[] = (array) $this->jurnal->getJurnalByNoReffSaldoMonthYear($row->no_reff,$bulan,$tahun);
        }

        if($data == null || $saldo == null){
            $this->session->set_flashdata('dataNull','Neraca Saldo Dengan Bulan '.bulan($bulan).' Pada Tahun '.date('Y',strtotime($tahun)).' Tidak Di Temukan');
            redirect('neraca_saldo');
        }

        $jumlah = count($data);

        $this->load->view('template',compact('content','titleTag','dataAkun','data','jumlah','saldo'));
    }

    public function PerubahanModal(){
        $titleTag = 'Perubahan Modal';
        $content = 'user/perubahan_modal_main';
        $listJurnal = $this->jurnal->getJurnalByYearAndMonth();
        $tahun = $this->jurnal->getJurnalByYear();
        $this->load->view('template',compact('content','listJurnal','titleTag','tahun'));
    }

    public function PerubahanModalDetail(){
        $content = 'user/perubahan_modal';
    $titleTag = 'Perubahan Modal';

        $bulan = $this->input->post('bulan',true);
        $tahun = $this->input->post('tahun',true);
        // print_r($tahun);exit;

        if(empty($bulan) || empty($tahun)){
            redirect('perubahan_modal');
        }


        // // $dataAkun = $this->akun->getAkunByMonthYear($bulan,$tahun);
        // $data = null;
        // $saldo = null;
        
        // foreach($dataAkun as $row){
        //     $data[] = (array) $this->jurnal->getJurnalByNoReffMonthYear($row->no_reff,$bulan,$tahun);
        //     $saldo[] = (array) $this->jurnal->getJurnalByNoReffSaldoMonthYear($row->no_reff,$bulan,$tahun);
        // }

        // if($data == null || $saldo == null){
        //     $this->session->set_flashdata('dataNull','Laba Rugi Dengan Bulan '.bulan($bulan).' Pada Tahun '.date('Y',strtotime($tahun)).' Tidak Di Temukan');
        //     redirect('laba_rugi');
        // }

        // $jumlah = count($data);
        $dataAkun = $this->akun->getPerubahanModal($bulan,$tahun);
        $modal = $this->akun->getModal($bulan, $tahun);
        $pendapatan = $this->akun->getPendapatan($bulan, $tahun);
        $beban = $this->akun->getBeban($bulan, $tahun);

        // $this->load->view('template',compact('content','titleTag','dataAkun','data','jumlah','saldo'));
        $this->load->view('template',compact('content','titleTag','dataAkun', 'modal' , 'pendapatan', 'beban'));
    }

    public function labaRugi(){
        $titleTag = 'Laba Rugi';
        $content = 'user/laba_rugi_main';
        $listJurnal = $this->jurnal->getJurnalByYearAndMonth();
        $tahun = $this->jurnal->getJurnalByYear();
        $this->load->view('template',compact('content','listJurnal','titleTag','tahun'));
    }

    public function labaRugiDetail(){
        $content = 'user/laba_rugi_new';
        $titleTag = 'Laba Rugi';

        $bulan = $this->input->post('bulan',true);
        $tahun = $this->input->post('tahun',true);
        // print_r($tahun);exit;

        if(empty($bulan) || empty($tahun)){
            redirect('laba_rugi');
        }


        // // $dataAkun = $this->akun->getAkunByMonthYear($bulan,$tahun);
        // $data = null;
        // $saldo = null;
        
        // foreach($dataAkun as $row){
        //     $data[] = (array) $this->jurnal->getJurnalByNoReffMonthYear($row->no_reff,$bulan,$tahun);
        //     $saldo[] = (array) $this->jurnal->getJurnalByNoReffSaldoMonthYear($row->no_reff,$bulan,$tahun);
        // }

        // if($data == null || $saldo == null){
        //     $this->session->set_flashdata('dataNull','Laba Rugi Dengan Bulan '.bulan($bulan).' Pada Tahun '.date('Y',strtotime($tahun)).' Tidak Di Temukan');
        //     redirect('laba_rugi');
        // }

        // $jumlah = count($data);
        $dataAkun = $this->akun->getLabaRugi($bulan,$tahun);
        $pendapatan = $this->akun->getPendapatan($bulan, $tahun);
        $beban = $this->akun->getBeban($bulan, $tahun);

        // $this->load->view('template',compact('content','titleTag','dataAkun','data','jumlah','saldo'));
        $this->load->view('template',compact('content','titleTag','dataAkun', 'pendapatan', 'beban'));
    }

    public function laporan(){
        $titleTag = 'Laporan';
        $content = 'user/laporan_main';
        $listJurnal = $this->jurnal->getJurnalByYearAndMonth();
        $tahun = $this->jurnal->getJurnalByYear();
        $this->load->view('template',compact('content','listJurnal','titleTag','tahun'));
    }

    public function laporanCetak(){
        $bulan = $this->input->post('bulan',true);
        $tahun = $this->input->post('tahun',true);
        $titleTag = 'Laporan '.bulan($bulan).' '.$tahun;

        $dataAkun = $this->akun->getAkunByMonthYear($bulan,$tahun);

        $jurnals = $this->jurnal->getJurnalJoinAkunDetail($bulan,$tahun);
        $totalDebit = $this->jurnal->getTotalSaldoDetail('debit',$bulan,$tahun);
        $totalKredit = $this->jurnal->getTotalSaldoDetail('kredit',$bulan,$tahun);

        $data = null;
        $saldo = null;
        foreach($dataAkun as $row){
            $data[] = (array) $this->jurnal->getJurnalByNoReffMonthYear($row->no_reff,$bulan,$tahun);
            $saldo[] = (array) $this->jurnal->getJurnalByNoReffSaldoMonthYear($row->no_reff,$bulan,$tahun);
        }

        if($data == null || $saldo == null){
            $this->session->set_flashdata('dataNull','Laporan Dengan Bulan '.bulan($bulan).' Pada Tahun '.date('Y',strtotime($tahun)).' Tidak Di Temukan');
            redirect('laporan');
        }

        $jumlah = count($data);

        $data = $this->load->view('user/laporan',compact('titleTag','dataAkun','bulan','tahun','jurnals','totalDebit','totalKredit','data','saldo','jumlah'),true);
        // echo $data;
        // die();
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "laporan_".bulan($bulan).'_'.$tahun;
        $this->pdf->load_view('user/laporan', $data);
    }

    public function logout(){
        $this->user->logout();
        redirect('');
    }

    public function dataKeranjang(){
    // {$data = array(
        $titleTag = 'lihat_transaksi';
        $content = 'user/lihat_transaksi';
         // Mengambil data dari model
        //  'transaksi' => $this->Jurnal_model->getdataKeranjang(),
         $transaksi = $this->transaksi->getdataKeranjang();
        // $data['transaksi'] = $this->tranasaksi->getdataKeranjang();

        $this->load->view('template', compact('content', 'transaksi', 'titleTag'));
    }

    public function copyData() {
        // Panggil method di model untuk menyalin data
        $result = $this->user->copyDataFromSourceToDestination();

        // Berikan respons ke view dalam bentuk JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }


    public function ambiltransaksi(){
        $title = 'Tambah'; 
        $content = 'user/form_jurnal'; 
        $action = 'jurnal_umum/tambah'; 
        $tgl_input = date('Y-m-d H:i:s'); 
        $id_user = $this->session->userdata('id'); 
        $titleTag = 'Tambah Jurnal Umum';

        if(!$_POST){
            $data = (object) $this->jurnal->getDefaultValues();
        }else{
            $data = (object) [
                'id_user'=>$id_user,
                'no_reff'=>$this->input->post('no_reff',true),
                'tgl_input'=>$tgl_input,
                'tgl_transaksi'=>$this->input->post('tgl_transaksi',true),
                'jenis_saldo'=>$this->input->post('jenis_saldo',true),
                'saldo'=>$this->input->post('saldo',true)
            ];
        }

        if(!$this->jurnal->validate()){
            $this->load->view('template',compact('content','title','action','data','titleTag'));
            return;
        }
        
        $this->jurnal->insertJurnal($data);
        $this->session->set_flashdata('berhasil','Data Jurnal Berhasil Di Tambahkan');
        redirect('jurnal_umum');    
    }

    public function migrateData()
    {
        // Ambil data dari tabel A dan B
        $dataFromTableA = $this->DataMigrationModel->getDataFromTableA();
        $dataFromTableB = $this->DataMigrationModel->getDataFromTableB();

        // Pindahkan data dari tabel A ke tabel C (3 atribut)
        foreach ($dataFromTableA as $dataA) {
            $dataToInsert = array(
                'column_c1' => $dataA->column1,
                'column_c2' => $dataA->column2,
                'column_c3' => $dataA->column3
            );
            $this->DataMigrationModel->insertDataToTableC($dataToInsert);
        }

        // Pindahkan data dari tabel B ke tabel C (2 atribut)
        foreach ($dataFromTableB as $dataB) {
            $dataToInsert = array(
                'column_c4' => $dataB->column4,
                'column_c5' => $dataB->column5
            );
            $this->DataMigrationModel->insertDataToTableC($dataToInsert);
        }

        // Redirect ke halaman tertentu setelah selesai melakukan pemindahan data
        redirect('data_migration_success');
    }

}
