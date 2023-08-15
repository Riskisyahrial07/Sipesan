<div class="container">
	<header class="page-header">
		<h1 class="page-title">Pesan Brosur</h1>
		<ol class="breadcrumb page-breadcrumb">
			<li><a href="#">Home</a>
			</li>
			<li><a href="#">Pesan</a>
			</li>
			<li class="active">Brosur</li>
		</ol>
	</header>
	<div class="row">
		<?= form_open('brosur' , array('enctype' => 'multipart/form-data')) ?>
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
							<label for="">Ukuran Kertas :</label>
							<div class="row">
								<div class="col-md-6">
									<input type="radio" name="ukuran" required value="A4">	A4 <br>
								</div>
								<div class="col-md-6">
									<input type="radio" name="ukuran" required value="A5">	A5 <br>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="">Tipe Bahan<span style="color: red">*</span> :</label><br>
							<select name="bahan" id="bahan" class="form-control" required>
								<option value="hvs">Biasa</option>
								<option value="konstruk">Bagus</option>
							</select>
						</div>
						<div class="form-group">
							<label for="">Jumlah :</label>
							<input type="number" name="jumlah" class="form-control" id="jumlah" onkeyup="showTotalBrosur()"
								   required autocomplete="off">
						</div>
						<div class="form-group">
							<label for="">Estimasi Waktu (hari) :</label>
							<input type="number" class="form-control" required autocomplete="off" name="estimasi">
						</div>
						<br>
						<div class="form-group">
							<label for=""><span style="color: red">*</span>Keterangan :</label>
							<ul>
								<li>Biasa : Rp. 25.000 per Lembar</li>
								<li>Bagus : Rp. 50.000 per Lembar</li>
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
							<h5 class="product-page-side-title">Share This Item</h5>
							<ul class="product-page-share-item">
								<li>
									<a class="fa fa-facebook" href="#"></a>
								</li>
								<li>
									<a class="fa fa-twitter" href="#"></a>
								</li>
								<li>
									<a class="fa fa-pinterest" href="#"></a>
								</li>
								<li>
									<a class="fa fa-instagram" href="#"></a>
								</li>
								<li>
									<a class="fa fa-google-plus" href="#"></a>
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
