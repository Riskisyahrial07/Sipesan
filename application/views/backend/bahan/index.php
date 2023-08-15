
<div class="col-12">
	<?php if ($this->session->flashdata('message')): ?>
		<div class="alert alert-primary" role="alert">
			<?= $this->session->flashdata('message') ?>
		</div>
		
		<?php $this->session->unset_userdata('message'); ?>
	<?php endif ?>
	<div class="card">
		<div class="card-body">
			<h4 class="card-title">
				Data Bahan
			</h4>
			<a href="<?=base_url('admin/bahan/tambah-bahan')?>" class="btn btn-primary text-white mb-3">Tambah Bahan</a>
			<div class="table-responsive">
				<table id="order-listing" class="table table-bordered">
					<thead>
					<tr>
						<th style="width: 1%;">No</th>
						<th>Nama Bahan</th>
						<th>Harga Bahan</th>
                        <th>Jenis Pesanan</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					<?php
					$no = 1;
					foreach ($bahan as $row):
					?>
					<tr>
						<td><?=$no?></td>
						<td><?=$row->bahan_nama?></td>
						<td><?=$row->bahan_harga?></td>
                        <td><?=$row->nama_pesanan?></td>
						<td>
							<a href="<?=base_url('admin/bahan/edit-bahan/'.$row->bahan_id)?>" class="btn btn-primary text-white">Edit</a>
							<a class="btn btn-danger text-white" href="<?= base_url('admin/bahan/hapus-bahan/'.$row->bahan_id) ?>" onclick="return confirm('Hapus Bahan Ini? ')">Hapus</a>
						</td>
					</tr>
					<?php
					$no++;
					endforeach;
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
