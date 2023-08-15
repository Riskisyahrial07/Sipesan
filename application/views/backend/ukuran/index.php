
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
				Data Ukuran
			</h4>
			<a href="<?=base_url('admin/ukuran/tambah-ukuran')?>" class="btn btn-primary text-white mb-3">Tambah Ukuran</a>
			<div class="table-responsive">
				<table id="order-listing" class="table table-bordered">
					<thead>
					<tr>
						<th style="width: 1%;">No</th>
						<th>Nama Ukuran</th>
                        <th>Jenis Pesanan</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					<?php
					$no = 1;
					foreach ($ukuran as $row):
					?>
					<tr>
						<td><?=$no?></td>
						<td><?=$row->ukuran_nama?></td>
                        <td><?=$row->nama_pesanan?></td>
						<td>
							<a href="<?=base_url('admin/ukuran/edit-ukuran/'.$row->ukuran_id)?>" class="btn btn-primary text-white">Edit</a>
							<a class="btn btn-danger text-white" href="<?= base_url('admin/ukuran/hapus-ukuran/'.$row->ukuran_id) ?>" onclick="return confirm('Hapus ukuran Ini? ')">Hapus</a>
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
