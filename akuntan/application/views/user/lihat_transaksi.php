 <!-- Main content -->
 <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./index.html">LIHAT TRANSAKSI</a>
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
                  <h3 class="mb-0">Lihat Transaksi</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
    <table class="table align-items-center table-flush">
                      <thead class="thead-light">
                          <tr>
                              <th scope="col">No.</th>
                              <th scope="col">Keranjang ID</th>
                              <th scope="col">Jenis</th>
                              <th scope="col">saldo</th>
                              <th scope="col">Status</th>
                              <th scope="col">Tanggal Dibuat</th>
                              <th scope="col">Ambil</th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php
                       $i=1; 
                      foreach ($transaksi as $row) { ?>
                          <tr>
                              <th scope="row">
                                <?= $i++ ?>
                              </th>
                              <td><?php echo $row['keranjang_id']; ?></td>
                              <td><?php echo $row['keranjang_pengguna_id']; ?></td>
                              <td>Rp. <?php echo number_format($row['keranjang_total'], 0, ',', '.'); ?></td>
                              <td><?php echo $row['keranjang_status']; ?></td>
                              <td><?php echo date('Y-m-d H:i:s', strtotime($row['keranjang_date_created'])); ?></td>
                              <td scope="col">
                                  <?= form_open('jurnal_umum/detail') ?>
                                  <?= form_button(['type'=>'submit','content'=>'Ambil','class'=>'btn btn-success mr-3']) ?>
                                  <?= form_close() ?>
                              </td>
                          </tr>
                          <?php } ?>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>