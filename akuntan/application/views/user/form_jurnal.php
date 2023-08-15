  <!-- Main content -->
  <div class="main-content">
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
                  <h3 class="mb-3"><?= $title ?> Jurnal Umum</h3>
                </div>
                <div class="col-12 my-3 form-1">
                  <form action="<?= base_url($action) ?>" method="post">
                  <?php 
                    if(!empty($id)):
                  ?>
                  <input type="hidden" name="id" value="<?= $id ?>">
                  <?php endif; ?>
                  <div class="row mb-4">
                    <div class="col-4">
                        <label for="datepicker">Tanggal</label>
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control" id="datepicker" name="tgl_transaksi" type="text" value="<?= $data->tgl_transaksi ?>">
                        </div>
                        <?= form_error('tgl_transaksi') ?>
                    </div>
                  </div>
                  <div class="row mb-4">
                    <div class="col">
                        <label for="no_reff">Nama Akun</label>
                        <?=form_dropdown('no_reff',getDropdownList('akun',['no_reff','nama_reff']),$data->no_reff,['class'=>'form-control','id'=>'no_reff']);?>
                        <?= form_error('no_reff') ?>
                    </div>
                    <div class="col">
                        <label for="reff">No. Reff</label>
                        <input type="text" name="reff" class="form-control" id="reff" value="<?= $data->no_reff ?>" readonly>
                    </div>
                    <div class="col">
                    <label for="jenis_saldo">Jenis Saldo</label>
                        <?=form_dropdown('jenis_saldo',['debit'=>'Debit','kredit'=>'Kredit'],$data->jenis_saldo,['class'=>'form-control jenis_saldo','id'=>'jenis_saldo']);?>
                        <?= form_error('jenis_saldo') ?>
                    </div>
                    <div class="col">
                        <label for="saldo">Saldo</label>
                        <input type="number" name="saldo" class="form-control saldo" id="saldo" value="<?= $data->saldo ?>">
                        <?= form_error('saldo') ?>
                    </div>
                  </div>
                  
                  <?php if(!isset($param)){ ?>
                    <div class="row mb-4">
                      <div class="col">
                          <label for="no_reff">Nama Akun</label>
                          <?=form_dropdown('no_reff_second',getDropdownList('akun',['no_reff','nama_reff']),$data->no_reff,['class'=>'form-control','id'=>'no_reff_second']);?>
                          <?= form_error('no_reff') ?>
                      </div>
                      <div class="col">
                          <label for="reff_second">No. Reff</label>
                          <input type="text" name="reff_second" class="form-control" id="reff_second" readonly>
                      </div>
                      <div class="col">
                      <label for="jenis_saldo">Jenis Saldo</label>
                          <input type="text" name="jenis_saldo_second" class="form-control" id="jenis_saldo_second" value="kredit" readonly>
                          <?= form_error('jenis_saldo_second') ?>
                      </div>
                      <div class="col">
                          <label for="saldo_second">Saldo</label>
                          <input type="text" name="saldo_second" class="form-control" id="saldo_second" value="<?= $data->saldo ?>" readonly>
                          <?= form_error('saldo_second') ?>
                      </div>
                    </div>
                  <?php } ?>
                  
                  <div class="col-12" id="form_jurnal_prepend">
                    <button class="btn btn-primary" type="submit" id="button_jurnal"><?= $title ?></button>
                  </div> 
                  </form> 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      