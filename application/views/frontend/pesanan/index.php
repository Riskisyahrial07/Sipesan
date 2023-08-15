<div class="container">
	<header class="page-header">
		<h1 class="page-title">Pesan</h1>
		<ol class="breadcrumb page-breadcrumb">
			<li><a href="#">Home</a>
			</li>
			<li class="active">Pesan</li>
		</ol>
	</header>
	<div class="row">
		<?= form_open('' , array('enctype' => 'multipart/form-data', 'id' => 'form-pesanan')) ?>
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
                        <input type="hidden" id="pesanan" val="" />
                        <div class="form-group">
							<label for="">Pesanan</label>
							<select class="form-control" id="select-pesanan">
                                <option value="">Pilih Pesanan</option>
                                <?php foreach($pesanan as $row): ?>
                                    <option value="<?= $row->id ?>"><?= $row->nama_pesanan ?></option>
                                <?php endforeach; ?>
                            </select>
						</div>

                        <section id="form-pesanan-rendered">
                        </section>
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
									<a class="fa fa-instagram" href="https://instagram.com/visualcreative_agency"></a>
								</li>
								<li>
								  <a class="fa fa-whatsapp" href="https://wa.me/6282252170059"></a>
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
