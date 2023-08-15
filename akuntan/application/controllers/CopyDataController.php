<!-- // application/controllers/CopyDataController.php -->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CopyDataController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Muat model yang dibutuhkan jika diperlukan
        $this->load->model('DataCopy_model');
    }

    public function copyData() {
        // Panggil method di model untuk menyalin data
        $result = $this->DataCopy_model->copyDataFromSourceToDestination();

        // Berikan respons ke view dalam bentuk JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }
}
?>
