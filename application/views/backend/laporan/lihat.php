<style>
	.laporan-header {
		text-align: center;
	}
</style>
<div class="col-12">
	<div class="card">
		<div class="card-body">
			<div class="row d-print-none">
				<div class="col-6">
					<button type="button" onclick="return window.history.back();" class="btn btn-sm btn-outline-primary"><i
							class="fa fa-arrow-left"></i></button>
				</div>
				<div class="col-6">
					<button style="float: right" type="button" onclick="window.print()"
							class="btn btn-primary btn-sm"><i class="fa fa-print"></i></button>
				</div>
			</div>
			<br>
			<div>
				<div class="laporan-header"><h3>Visual Creative Agency</h3></div>
				<div class="laporan-header"><h4>Laporan Penjualan <?php
						if ($tipe != 'kartu_nama') {
							echo ucfirst($tipe);
						} else {
							echo 'Kartu Nama';
						}
						?>  <?php
						if ($tanggal != null){
							echo 'Tanggal '.date_indo($tanggal);
						} else {
							echo 'Bulan '.bulan($bulan) .' '. date('Y');
						}
						?></h4></div>
				<table class="table table-bordered">
					<?php
					if ($tipe == 'spanduk'):
						?>
						<thead>
						<tr>
							<th>No</th>
							<th>Nama Pemesan</th>
							<th>Ukuran</th>
							<th>Jenis Bahan</th>
							<th>Jumlah</th>
							<th>Total</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$total = 0;
						$no = 1;
						foreach ($spanduk as $key => $value):
							?>
							<tr>
								<td><?= $no ?></td>
								<td><?= $value['pengguna_nama'] ?></td>
								<td><?= $value['panjang'] ?> m x <?= $value['lebar'] ?> m</td>
								<td><?= $value['bahan_nama'] ?></td>
								<td><?= $value['jumlah'] ?></td>
								<td>Rp. <?= nominal($value['total']) ?></td>
							</tr>
							<?php
							$total = $total + $value['total'];
							$no++;
						endforeach; ?>
						</tbody>
						<tfoot>
						<tr>
							<td colspan="5">TOTAL</td>
							<td>Rp. <?= nominal($total) ?></td>
						</tr>
						</tfoot>
					<?php
					endif;
					?>

					<?php
					if ($tipe == 'stiker'):
						?>
						<thead>
						<tr>
							<th>No</th>
							<th>Nama Pemesan</th>
							<th>Ukuran</th>
							<th>Jenis Bahan</th>
							<th>Jumlah</th>
							<th>Total</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$total = 0;
						$no = 1;
						foreach ($stiker as $key => $value):
							?>
							<tr>
								<td><?= $no ?></td>
								<td><?= $value['pengguna_nama'] ?></td>
								<td><?= $value['ukuran_nama'] ?></td>
								<td><?= $value['bahan_nama'] ?></td>
								<td><?= $value['jumlah'] ?> </td>
								<td>Rp. <?= nominal($value['total']) ?></td>
							</tr>
							<?php
							$total = $total + $value['total'];
							$no++;
						endforeach; ?>
						</tbody>
						<tfoot>
						<tr>
							<td colspan="5">TOTAL</td>
							<td>Rp. <?= nominal($total) ?></td>
						</tr>
						</tfoot>
					<?php
					endif;
					?>

					<?php
					if ($tipe == 'kartu'):
						?>
						<thead>
						<tr>
							<th>No</th>
							<th>Nama Pemesan</th>
							<th>Ukuran</th>
							<th>Jenis Bahan</th>
							<th>Jumlah</th>
							<th>Total</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$total = 0;
						$no = 1;
						foreach ($kartu as $key => $value):
							?>
							<tr>
								<td><?= $no ?></td>
								<td><?= $value['pengguna_nama'] ?></td>
								<td><?= $value['ukuran_nama'] ?></td>
								<td><?= $value['bahan_nama'] ?></td>
								<td><?= $value['jumlah'] ?> </td>
								<td>Rp. <?= nominal($value['total']) ?></td>
							</tr>
							<?php
							$total = $total + $value['total'];
							$no++;
						endforeach; ?>
						</tbody>
						<tfoot>
						<tr>
							<td colspan="4">TOTAL</td>
							<td>Rp. <?= nominal($total) ?></td>
						</tr>
						</tfoot>
					<?php
					endif;
					?>
					<?php
					if ($tipe == 'brosur'):
						?>
						<thead>
						<tr>
							<th>No</th>
							<th>Ukuran Kertas</th>
							<th>Nama Pemesan</th>
							<th>Jenis Bahan</th>
							<th>Jumlah</th>
							<th>Total</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$total = 0;
						$no = 1;
						foreach ($brosur as $key => $value):
							?>
							<tr>
								<td><?= $no ?></td>
								<td><?= $value['ukuran_nama'] ?></td>
								<td><?= $value['pengguna_nama'] ?></td>
								<td><?= $value['bahan_nama'] ?></td>
								<td><?= $value['jumlah'] ?> </td>
								<td>Rp. <?= nominal($value['total']) ?></td>
							</tr>
							<?php
							$total = $total + $value['total'];
							$no++;
						endforeach; ?>
						</tbody>
						<tfoot>
						<tr>
							<td colspan="5">TOTAL</td>
							<td>Rp. <?= nominal($total) ?></td>
						</tr>
						</tfoot>
					<?php
					endif;
					?>

					<?php
					if ($tipe == 'desain'):
						?>
						<thead>
						<tr>
							<th>No</th>
							<th>Ukuran Desain</th>
							<th>Nama Pemesan</th>
							<th>Keterangan</th>
							<th>Bahan</th>
							<th>Jumlah</th>
							<th>Total</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$total = 0;
						$no = 1;
						foreach ($brosur as $key => $value):
							?>
							<tr>
								<td><?= $no ?></td>
								<td><?= $value['panjang'] ?> m x <?= $value['lebar'] ?> m</td>
								<td><?= $value['pengguna_nama'] ?></td>
								<td><?= $value['keterangan'] ?></td>
								<td><?= $value['bahan_nama'] ?></td>
								<td><?= $value['jumlah'] ?> Desain</td>
								<td>Rp. <?= nominal($value['total']) ?></td>
							</tr>
							<?php
							$total = $total + $value['total'];
							$no++;
						endforeach; ?>
						</tbody>
						<tfoot>
						<tr>
							<td colspan="5">TOTAL</td>
							<td>Rp. <?= nominal($total) ?></td>
						</tr>
						</tfoot>
					<?php
					endif;
					?>

				</table>
				<br>
				<div class="row">
					<div class="col-6 text-center" >
					</div>
					<div class="col-6 text-center">
						<p>Sampit, <?= date_indo(date('Y-m-d')) ?></p>
						<p>Owner</p>
						<br>
						<br>
						<br>
						<p><b><u>Risky Perdana</u></b></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
