<div class="container">
	<header class="page-header">
		<h1 class="page-title">Checkout Pesanan</h1>
	</header>
	<div class="row row-col-gap" data-gutter="60">
		<div class="col-md-4">
			<h3 class="widget-title">Info Pesanan</h3>
			<div class="box">
				<table class="table">
					<thead>
					<tr>
						<th>Jenis</th>
						<th>Jumlah</th>
						<th>Harga</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<?php
						if ($spanduk == !null):
							?>
							<td>Spanduk</td>
							<td><?=count($spanduk)?></td>
							<td style="text-align: right">
								<?php
								$harga = 0;
								foreach ($spanduk as $key=>$value) {
									$harga = $harga + $value['total'];
								}
								echo 'Rp. '.nominal($harga)
								?>
							</td>
						<?php
						endif;
						?>
					</tr>
					<tr>
						<?php
						if ($stiker == !null):
							?>
							<td>Stiker</td>
							<td><?=count($stiker)?></td>
							<td style="text-align: right">
								<?php
								$harga = 0;
								foreach ($stiker as $key=>$value) {
									$harga = $harga + $value['total'];
								}
								echo 'Rp. '.nominal($harga)
								?>
							</td>
						<?php
						endif;
						?>
					</tr>
					<tr>
						<?php
						if ($kartu == !null):
							?>
							<td>Kartu Nama</td>
							<td><?=count($kartu)?></td>
							<td style="text-align: right">
								<?php
								$harga = 0;
								foreach ($kartu as $key=>$value) {
									$harga = $harga + $value['total'];
								}
								echo 'Rp. '.nominal($harga)
								?>
							</td>
						<?php
						endif;
						?>
					</tr>
					<tr>
						<?php
						if ($brosur == !null):
							?>
							<td>Brosur</td>
							<td><?=count($brosur)?></td>
							<td style="text-align: right">
								<?php
								$harga = 0;
								foreach ($brosur as $key=>$value) {
									$harga = $harga + $value['total'];
								}
								echo 'Rp. '.nominal($harga)
								?>
							</td>
						<?php
						endif;
						?>
					</tr>
					<tr>
						<?php
						if ($desain == !null):
							?>
							<td>Desain</td>
							<td><?=count($desain)?></td>
							<td style="text-align: right">
								<?php
								$harga = 0;
								foreach ($desain as $key=>$value) {
									$harga = $harga + $value['total'];
								}
								echo 'Rp. '.nominal($harga)
								?>
							</td>
						<?php
						endif;
						?>
					</tr>
					</tbody>
					<tfoot>
					<tr>
						<td colspan="2"><b>Total</b></td>
						<td style="text-align: right"><b>Rp. <?= nominal($pesanan['keranjang_total']) ?></b></td>
					</tr>
					</tfoot>
				</table>
			</div>
		</div>
		<div class="col-md-4">
			<h3 class="widget-title">Pembayaran</h3>
			<div class="box form-bayar">
				<?=form_open('bayar/'.$pesanan['keranjang_id'])?>
					<p>Pilih Jenis Pembayaran</p>
					<input type="radio" name="tipebayar" value="bri" required> Transfer Bank BRI <br>
					<input type="radio" name="tipebayar" value="bri" required> Transfer Bank BCA <br>
					<input type="radio" name="tipebayar" value="bni" required> Transfer Bank BNI <br>
					<br>

					<p>Pilih Jenis Pengambilan</p>
					<input type="radio" name="pengambilan" value="Self Pick Up" onchange="pilihPengambilan()" required> Self Pick Up <br>
					<input type="radio" name="pengambilan" value="Delivery" onchange="pilihPengambilan()" required> Delivery <br>
					<br>
					
					<div id="alamat-pengiriman" class="hidden">
						<p>Alamat</p>
						<textarea class="form-control" id="form-alamat-text" name="alamat" placeholder="Alamat Anda"></textarea>
						<br>
					</div>

					<button type="submit" class="btn btn-primary" name="selesai">Selesai</button>
					<div class="gap gap-small"></div>
				<?=form_close()?>
			</div>
		</div>
	</div>
</div>
