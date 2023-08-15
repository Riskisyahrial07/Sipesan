<div class="col-12">
	<div class="card">
		<div class="card-body">
			<h3 class="card-title">
				Detail Pesanan
			</h3>
			<div>
				<table>
					<tr>
						<td>Nama Pemesan</td>
						<td> :</td>
						<td>&nbsp;
							<?= $transaksi['pengguna_nama'] ?>
						</td>
					</tr>
					<tr>
						<td>Nomor HP</td>
						<td> :</td>
						<td>&nbsp;
							<?= $transaksi['pengguna_nomor_hp'] ?>
						</td>
					</tr>
					<tr>
						<td>Waktu Pemesanan</td>
						<td> :</td>
						<td>&nbsp;
							<?php
							$tanggal = explode(" ", $transaksi['faktur_date_created']);
							echo $tanggal[1] . ', ' . date_indo($tanggal[0]);
							?>
						</td>
					</tr>
				</table>
				<hr>
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
			</div>
		</div>
	</div>
</div>
