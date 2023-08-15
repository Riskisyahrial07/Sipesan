
<div class="col-12">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title">
				Form Ukuran
			</h4>
			<form class="forms-sample" method="post" action="<?= $page == 'add' ? base_url('admin/ukuran/store-ukuran') : base_url('admin/ukuran/update-ukuran/'.$ukuran['ukuran_id']) ?>">
				<div class="form-group">
					<label>Nama Ukuran</label>
					<input name="nama_ukuran" class="form-control" value="<?= isset($ukuran['ukuran_nama']) ? $ukuran['ukuran_nama'] : '' ?>" required>
				</div>
				<div class="form-group">
					<label >Jenis Pesanan</label>
					<select class="form-control" name="jenis_pesanan" required>
						<option value="">Pilih Tipe Pesanan</option>
						<?php foreach($tipe_pesanan as $row): ?>
							<option value="<?= $row->id ?>" <?= isset($ukuran['ukuran_id_pesanan']) ? $ukuran['ukuran_id_pesanan'] == $row->id ? 'selected' : '' : '' ?>><?= $row->nama_pesanan ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				<button type="submit" class="btn btn-success mr-2">Submit</button>
				<button class="btn btn-light">Cancel</button>
			</form>
		</div>
	</div>
</div>
