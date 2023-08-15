<!-- Main content -->
<div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./index.html">Perubahan Modal</a>
        <!-- Form -->
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
          <div class="form-group mb-0">
            
          </div>
        </form>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="<?= base_url('assets/img/theme/team-4-800x800.jpg') ?>">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?= ucwords($this->session->userdata('username')) ?></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <a href="<?= base_url('logout') ?>" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-danger pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">    
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-8 mb-5 mb-xl-0">
               
        </div>
      </div>
      <div class="row mt-5">
        <div class="col mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Laba Rugi</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
            <?php 
                $a=0;
                $debit = 0;
                $kredit = 0;
            ?>
              <!-- Projects table -->
              <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-8 mb-5 mb-xl-0">
               
        </div>
      </div>
      <div class="row mt-5">
        <div class="col mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Laba Rugi</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
            <?php 
                $total_modal = 0;
                $total_pendapatan = 0;
                $total_beban = 0;
                $laba_kotor = 0;
                $laba_bersih = 0;
            ?>
              <!-- Projects table -->
                <table class="table align-items-center table-flush">
                    <tr class="thead-light">
                        <th><strong>MODAL</strong></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php foreach ($modal as $item) { ?>
                    <?php $total_modal += $item->saldo ?>
                    <tr>
                        <td><?= "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $item->nama_reff ?></td>
                        <td></td>
                        <td class="text-right"><?= number_format($item->saldo) ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <th><strong>TOTAL MODAL</strong></th>
                        <th></th>
                        <th class="text-right"><?= number_format($total_modal) ?></th>
                    </tr>
                    <!-- <tr class="thead-light">
                        <th><strong>PENDAPATAN</strong></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php foreach ($pendapatan as $item) { ?>
                    <?php $total_pendapatan += $item->saldo ?>
                    <tr>
                        <td><?= "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $item->nama_reff ?></td>
                        <td></td>
                        <td class="text-right"><?= number_format($item->saldo) ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <th><strong>TOTAL PENDAPATAN</strong></th>
                        <th></th>
                        <th class="text-right"><?= number_format($total_pendapatan) ?></th>
                    </tr>
                    <tr class="thead-light">
                        <th><strong>BEBAN</strong></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php foreach ($beban as $item) { ?>
                    <?php $total_beban += $item->saldo ?>
                    <tr>
                        <td><?= "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $item->nama_reff ?></td>
                        <td class="text-right"><?= number_format($item->saldo) ?></td>
                        <td></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <th><strong>TOTAL BEBAN</strong></th>
                        <th></th>
                        <th class="text-right"><?= number_format($total_beban) ?></th>
                    </tr>
                    <tr>
                        <th><strong>LABA KOTOR</strong></th>
                        <th></th>
                        <th class="text-right"><?= number_format($laba_kotor) ?></th>
                    </tr> -->
                    <tr>
                        <th><strong>LABA BERSIH</strong></th>
                        <th></th>
                        <th class="text-right"><?= number_format($total_pendapatan - $total_beban) ?></th>
                    </tr>
                    <tr>
                        <th><strong>PERUBAHAN MODAL</strong></th>
                        <th></th>
                        <th class="text-right"><?= number_format($total_pendapatan - $total_beban + $total_modal) ?></th>
                    </tr>
                </table>
            </div>
          </div>
        </div>
      </div>