<?php
if ($keranjang['keranjang_total'] == '0'):
	?>
	<div class="container">
		<div class="text-center"><i class="fa fa-cart-arrow-down empty-cart-icon"></i>
			<p class="lead">Keranjang Kamu Kosong</p><a class="btn btn-primary btn-lg" href="<?= base_url() ?>">Pesan
				Sekarang <i class="fa fa-long-arrow-right"></i></a>
		</div>
	</div>
<?php
elseif ($keranjang == !null):
	?>
	<div class="container">
		<header class="page-header">
			<h1 class="page-title">Keranjang</h1>
		</header>
		<div class="row">
			<div class="col-md-10">
				<?php
				if ($stiker != null):
					?>
					<h4>Stiker</h4>
					<table class="table table-bordered table-shopping-cart">
						<thead>
						<tr>
							<th>Foto</th>
							<th>Ukuran</th>
							<th>Bahan</th>
							<th>Jumlah</th>
							<th>Harga Bahan</th>
							<th>Total</th>
							<th>Hapus</th>
						</tr>
						</thead>
						<tbody>
						<?php
						foreach ($stiker as $key => $value):
							?>
							<tr>
								<td><img src="<?= base_url('assets/images/stiker/') . $value['foto'] ?>"
										 alt="foto"
										 style="width: 100%"></td>
								<td><?= $value['ukuran_nama'] ?></td>
								<td><?= $value['bahan_nama'] ?></td>
								<td><?= $value['jumlah'] ?> </td>
								<td>Rp.<?= nominal($value['bahan_harga']) ?></td>
								<td style="text-align: right"> Rp.<?= nominal($value['total']) ?></td>
								<td><a class="fa fa-close table-shopping-remove"
									   href="<?= base_url('hapus/stiker/' . $value['id']) ?>"
									   onclick="return confirm('Hapus Pesanan? ')"></a></td>
							</tr>
						<?php
						endforeach;
						?>
						</tbody>
					</table>
					<div class="gap gap-small"></div>
				<?php
				endif;
				?>
				<?php
				if ($spanduk != null):
					?>
					<h4>Spanduk</h4>
					<table class="table table-bordered table-shopping-cart">
						<thead>
						<tr>
							<th>Foto</th>
							<th>Panjang x Lebar</th>
							<th>Jumlah</th>
							<th>Harga Bahan</th>
							<th>Total</th>
							<th>Hapus</th>
						</tr>
						</thead>
						<tbody>
						<?php
						foreach ($spanduk as $key => $value):
							?>
							<tr>
								<td><img src="<?= base_url('assets/images/spanduk/') . $value['foto'] ?>"
										 alt="foto"
										 style="width: 100%"></td>
								<td><?= $value['panjang'] ?> m X <?= $value['lebar'] ?> m</td>
								<td><?= $value['jumlah'] ?></td>
								<td>Rp.<?= nominal($value['bahan_harga']) ?></td>
								<td style="text-align: right"> Rp.<?= nominal($value['total']) ?></td>
								<td><a class="fa fa-close table-shopping-remove"
									   href="<?= base_url('hapus/spanduk/' . $value['id']) ?>"
									   onclick="return confirm('Hapus Pesanan? ')"></a></td>
							</tr>
						<?php
						endforeach;
						?>
						</tbody>
					</table>
					<div class="gap gap-small"></div>
				<?php
				endif;
				?>
				<?php
				if ($kartu != null):
					?>
					<h4>Kartu Nama</h4>
					<table class="table table-bordered table-shopping-cart">
						<thead>
						<tr>
							<th>Foto</th>
							<th>Ukuran</th>
							<th>Bahan</th>
							<th>Jumlah</th>
							<th>Harga Bahan</th>
							<th>Total</th>
							<th>Hapus</th>
						</tr>
						</thead>
						<tbody>
						<?php
						foreach ($kartu as $key => $value):
							?>
							<tr>
								<td><img src="<?= base_url('assets/images/kartu/') . $value['foto'] ?>"
										 alt="foto"
										 style="width: 100%"></td>
								<td><?= $value['ukuran_nama'] ?></td>
								<td><?= $value['bahan_nama'] ?> </td>
								<td><?= $value['jumlah'] ?></td>
								<td>Rp.<?= nominal($value['bahan_harga']) ?></td>
								<td style="text-align: right"> Rp.<?= nominal($value['total']) ?></td>
								<td><a class="fa fa-close table-shopping-remove"
									   href="<?= base_url('hapus/kartu/' . $value['id']) ?>"
									   onclick="return confirm('Hapus Pesanan? ')"></a></td>
							</tr>
						<?php
						endforeach;
						?>
						</tbody>
					</table>
					<div class="gap gap-small"></div>
				<?php
				endif;
				?>

				<?php
				if ($brosur != null):
					?>
					<h4>Brosur</h4>
					<table class="table table-bordered table-shopping-cart">
						<thead>
						<tr>
							<th>Foto</th>
							<th>Ukuran</th>
							<th>Bahan</th>
							<th>Jumlah</th>
							<th>Harga Bahan</th>
							<th>Total</th>
							<th>Hapus</th>
						</tr>
						</thead>
						<tbody>
						<?php
						foreach ($brosur as $key => $value):
							?>
							<tr>
								<td><img src="<?= base_url('assets/images/brosur/') . $value['foto'] ?>"
										 alt="foto"
										 style="width: 100%"></td>
								<td><?= $value['ukuran_nama'] ?></td>
								<td><?= $value['bahan_nama'] ?> </td>
								<td><?= $value['jumlah'] ?></td>
								<td>Rp.<?= nominal($value['bahan_harga']) ?></td>
								<td style="text-align: right"> Rp.<?= nominal($value['total']) ?></td>
								<td><a class="fa fa-close table-shopping-remove"
									   href="<?= base_url('hapus/brosur/' . $value['id']) ?>"
									   onclick="return confirm('Hapus Pesanan? ')"></a></td>
							</tr>
						<?php
						endforeach;
						?>
						</tbody>
					</table>
					<div class="gap gap-small"></div>
				<?php
				endif;
				?>

				<?php
				if ($desain != null):
					?>
					<h4>Desain</h4>
					<table class="table table-bordered table-shopping-cart">
						<thead>
						<tr>
							<th>Foto</th>
							<th>Panjang x Lebar</th>
							<th>Keterangan</th>
							<th>Jumlah</th>
							<th>Harga Bahan</th>
							<th>Total</th>
							<th>Hapus</th>
						</tr>
						</thead>
						<tbody>
						<?php
						foreach ($desain as $key => $value):
							?>
							<tr>
								<td><img src="<?= base_url('assets/images/desain/') . $value['foto'] ?>"
										 alt="foto"
										 style="width: 100%"></td>
								<td><?= $value['panjang'] ?> m X <?= $value['lebar'] ?> m</td>
								<td><?= $value['keterangan'] ?></td>
								<td><?= $value['jumlah'] ?></td>
								<td>Rp.<?= nominal($value['bahan_harga']) ?></td>
								<td style="text-align: right"> Rp.<?= nominal($value['total']) ?></td>
								<td><a class="fa fa-close table-shopping-remove"
									   href="<?= base_url('hapus/desain/' . $value['id']) ?>"
									   onclick="return confirm('Hapus Pesanan? ')"></a></td>
							</tr>
						<?php
						endforeach;
						?>
						</tbody>
					</table>
					<div class="gap gap-small"></div>
				<?php
				endif;
				?>

			</div>
			<div class="col-md-2">
				<h4>Total</h4>
				<h3>Rp. <?= nominal($keranjang['keranjang_total']) ?></h3>
				<a class="btn btn-primary" href="<?= base_url('bayar/' . $keranjang['keranjang_id']) ?>">Bayar</a>
			</div>
		</div>
	</div>
<?php
else:
	?>
	<div class="container">
		<div class="text-center"><i class="fa fa-cart-arrow-down empty-cart-icon"></i>
			<p class="lead">Keranjang Kamu Kosong</p><a class="btn btn-primary btn-lg" href="<?= base_url() ?>">Pesan
				Sekarang <i class="fa fa-long-arrow-right"></i></a>
		</div>
	</div>
<?php
endif;
?>
