<div class="gap"></div>
<div class="container">
	<div class="row row-col-gap" data-gutter="60">
		<div class="col-md-3">
			<h3 class="widget-title"><?= $this->session->userdata('session_username');?></h3>
			<div class="box">
				<a href="<?=base_url('profil')?>" class="btn btn-default btn-block" style="text-align: left"><i class="fa fa-user-circle"></i> Profil</a>
				<a href="<?=base_url('pesanan')?>" class="btn btn-primary btn-block" style="text-align: left"><i class="fa fa-list"></i> Data Pemesanan</a>
				<a href="<?=base_url('logout')?>" onclick="return confirm('Logout? ')"  class="btn btn-default btn-block" style="text-align: left"><i class="fa fa-sign-out"></i> Logout</a>
			</div>
		</div>
		<div class="col-md-9">
			<h3 class="widget-title"><i class="fa fa-list"></i> Data Desain</h3>
			<div class="box">
				<?php
				if ($spanduk == !null):
					?>
					<h5>Spanduk</h5>
					<table class="table table-bordered">
						<thead>
						<tr>
							<th>No</th>
							<th>Ukuran (m)</th>
							<th>Jenis Bahan</th>
							<th>Jumlah</th>
							<th width="150px">Foto</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$no = 1;
						foreach ($spanduk as $key => $value):
							?>
							<tr>
								<td><?= $no ?></td>
								<td><?= $value['panjang'] ?> x <?= $value['lebar'] ?> </td>
								<td><?= $value['bahan_nama'] ?></td>
								<td><?= $value['jumlah'] ?></td>
								<td>
									<!-- <a href="<?= base_url('detail-desain/' . $value['id']) ?>"
									   class="label label-primary"><i class="fa fa-eye"></i> Lihat</a> -->
									   <img src="<?= base_url('assets/images/spanduk/') . $value['foto'] ?>"
										 alt="foto"
										 style="width: 60%">
								</td>
							</tr>
							<?php
							$no++;
						endforeach;
						?>
						</tbody>
					</table>
				<?php
				endif;
				?>
				<hr>
				<?php
				if ($stiker == !null):
					?>
					<h5>Stiker</h5>
					<table class="table table-bordered">
						<thead>
						<tr>
							<th>No</th>
							<th>Ukuran</th>
							<th>Jenis Bahan</th>
							<th>Jumlah</th>
							<th width="150px">Foto</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$no = 1;
						foreach ($stiker as $key => $value):
							?>
							<tr>
								<td><?= $no ?></td>
								<td><?= $value['ukuran_nama'] ?> </td>
								<td><?= $value['bahan_nama'] ?></td>
								<td><?= $value['jumlah'] ?></td>
								<td>
									<!-- <a href="<?= base_url('detail-desain/' . $value['id']) ?>"
									   class="label label-primary"><i class="fa fa-eye"></i> Lihat</a> -->
									   <img src="<?= base_url('assets/images/stiker/') . $value['foto'] ?>"
										 alt="foto"
										 style="width: 60%">
								</td>
							</tr>
							<?php
							$no++;
						endforeach;
						?>
						</tbody>
					</table>
				<?php
				endif;
				?>
				<hr>
				<?php
				if ($kartu == !null):
					?>
					<h5>Kartu Nama</h5>
					<table class="table table-bordered">
						<thead>
						<tr>
							<th>No</th>
							<th>Ukuran</th>
							<th>Jenis Bahan</th>
							<th>Jumlah</th>
							<th width="150px">Foto</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$no = 1;
						foreach ($kartu as $key => $value):
							?>
							<tr>
								<td><?= $no ?></td>
								<td><?= $value['ukuran_nama'] ?> </td>
								<td><?= $value['bahan_nama'] ?></td>
								<td><?= $value['jumlah'] ?></td>
								<td>
									<!-- <a href="<?= base_url('detail-desain/' . $value['id']) ?>"
									   class="label label-primary"><i class="fa fa-eye"></i> Lihat</a> -->
									   <img src="<?= base_url('assets/images/kartu/') . $value['foto'] ?>"
										 alt="foto"
										 style="width: 60%">
								</td>
							</tr>
							<?php
							$no++;
						endforeach;
						?>
						</tbody>
					</table>
				<?php
				endif;
				?>
				<hr>
				<?php
				if ($brosur == !null):
					?>
					<h5>Brosur</h5>
					<table class="table table-bordered">
						<thead>
						<tr>
							<th>No</th>
							<th>Ukuran</th>
							<th>Jenis Bahan</th>
							<th>Jumlah</th>
							<th width="150px">Foto</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$no = 1;
						foreach ($brosur as $key => $value):
							?>
							<tr>
								<td><?= $no ?></td>
								<td><?= $value['ukuran_nama'] ?></td>
								<td><?= $value['bahan_nama'] ?></td>
								<td><?= $value['jumlah'] ?></td>
								<td>
									<!-- <a href="<?= base_url('detail-desain/' . $value['id']) ?>"
									   class="label label-primary"><i class="fa fa-eye"></i> Lihat</a> -->
									   <img src="<?= base_url('assets/images/brosur/') . $value['foto'] ?>"
										 alt="foto"
										 style="width: 60%">
								</td>
							</tr>
							<?php
							$no++;
						endforeach;
						?>
						</tbody>
					</table>
				<?php
				endif;
				?>
				<hr>
				<?php
				if ($desain == !null):
					?>
					<h5>Desain</h5>
					<table class="table table-bordered">
						<thead>
						<tr>
							<th>No</th>
							<th>Ukuran (m)</th>
							<th>Jenis Bahan</th>
							<th>Jumlah</th>
							<th width="150px">Foto</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$no = 1;
						foreach ($desain as $key => $value):
							?>
							<tr>
								<td><?= $no ?></td>
								<td><?= $value['panjang'] ?> x <?= $value['lebar'] ?> </td>
								<td><?= $value['bahan_nama'] ?></td>
								<td><?= $value['jumlah'] ?></td>
								<td>
									<!-- <a href="<?= base_url('detail-desain/' . $value['id']) ?>"
									   class="label label-primary"><i class="fa fa-eye"></i> Lihat</a> -->
									   <img src="<?= base_url('assets/images/desain/') . $value['foto'] ?>"
										 alt="foto"
										 style="width: 60%">
								</td>
							</tr>
							<?php
							$no++;
						endforeach;
						?>
						</tbody>
					</table>
				<?php
				endif;
				?>
				<hr>
			</div>
		</div>
	</div>
</div>
