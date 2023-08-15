
<div class="col-12">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title">
				Form Bahan
			</h4>
			<form class="forms-sample" method="post" action="<?= $page == 'add' ? base_url('admin/bahan/store-bahan') : base_url('admin/bahan/update-bahan/'.$bahan['bahan_id']) ?>">
				<div class="form-group">
					<label>Nama Bahan</label>
					<input name="nama_bahan" class="form-control" value="<?= isset($bahan['bahan_nama']) ? $bahan['bahan_nama'] : '' ?>" required>
				</div>
				<div class="form-group">
					<label>Harga Bahan</label>
					<input type="number" name="harga_bahan" class="form-control" value="<?= isset($bahan['bahan_harga']) ? $bahan['bahan_harga'] : '' ?>" required>
				</div>
				<div class="form-group">
					<label >Jenis Pesanan</label>
					<select class="form-control" name="jenis_pesanan" required>
						<option value="">Pilih Tipe Pesanan</option>
						<?php foreach($tipe_pesanan as $row): ?>
							<option value="<?= $row->id ?>" <?= isset($bahan['bahan_id_pesanan']) ? $bahan['bahan_id_pesanan'] == $row->id ? 'selected' : '' : '' ?>><?= $row->nama_pesanan ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				<button type="submit" class="btn btn-success mr-2">Submit</button>
				<button class="btn btn-light">Cancel</button>
			</form>
		</div>
	</div>
</div>
