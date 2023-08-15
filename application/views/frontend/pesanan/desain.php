<div class="container">
	<header class="page-header">
		<h1 class="page-title">Pesan Desain</h1>
		<ol class="breadcrumb page-breadcrumb">
			<li><a href="#">Home</a>
			</li>
			<li><a href="#">Pesan</a>
			</li>
			<li class="active">Desain</li>
		</ol>
	</header>
	<div class="row">
		<?= form_open('desain' , array('enctype' => 'multipart/form-data')) ?>
		<div class="col-md-5">
			<h4>Upload Gambar</h4>
			<div class="product-page-product-wrap">
				<div class="clearfix">
					<input type="file" class="dropify" name="upload" required>
				</div>
			</div><br>
			<div class="form-group">
							<label for=""><span style="color: red">*</span>Keterangan :</label>
							<ul>
								<li>Silakan Upload File Photo berupa jpg|png|jpeg</li>
							</ul>
						</div>
		</div>
		<div class="col-md-7">
			<h4>Detail Pesanan</h4>
			<div class="row" data-gutter="10">
				<div class="col-md-8">
					<div class="box">
						<div class="form-group">
							<label for="">Ukuran :</label>
							<div class="row">
								<div class="col-md-6">
									Panjang (m)
								</div>
								<div class="col-md-6">
									Lebar (m)
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="text" class="form-control" id="panjang" name="panjang"
										   placeholder="Panjang" required autocomplete="off">
								</div>
								<div class="col-md-6">
									<input type="text" class="form-control" id="lebar" name="lebar"
										   placeholder="Lebar" required autocomplete="off">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="">Jumlah :</label>
							<input type="number" name="jumlah" class="form-control" id="jumlah" onkeyup="showTotalDesain()"
								   required autocomplete="off">
						</div>
						<div class="form-group">
							<label for="">Estimasi Waktu (hari) :</label>
							<input type="number" class="form-control" required autocomplete="off" name="estimasi">
						</div>
						<div class="form-group">
							<label for="">Keterangan :</label>
							<textarea class="form-control" name="keterangan" style="height : 150px; resize : none;" required></textarea>
						</div>
						<br>
						<div class="form-group">
							<label for=""><span style="color: red">*</span>Harga :</label>
							<ul>
								<li>Rp 25.000 1 Desain</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="box-highlight">
						<h4>Total</h4>
						<div id="total"><h3>0</h3></div>
						<button type="submit" class="btn btn-block btn-primary" name="keranjang"><i
								class="fa fa-shopping-cart"></i>Add to cart
						</button>
						<?= form_close() ?>
						<div class="product-page-side-section">
							<h5 class="product-page-side-title">Bagikan ke Sosial Media</h5>
							<ul class="product-page-share-item">
								<li>
									<a class="fa fa-facebook" href="#"></a>
								</li>
								<li>
									<a class="fa fa-instagram" href="#"></a>
								</li>
								<li>
									<a class="fa fa-WhatsApp" href="#"></a>
								</li>
							</ul>
						</div>
						<div class="product-page-side-section">
							<h5 class="product-page-side-title">Visual Creative Agency Printing</h5>
							<p class="product-page-side-text">Terima kasih sudah Melakukan Orderan di VCA Printing | Happy Shopping</p>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="gap"></div>
</div>
