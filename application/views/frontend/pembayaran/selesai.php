<div class="gap"></div>
<div class="container">
	<div class="payment-success-icon fa fa-check-circle-o"></div>
	<div class="payment-success-title-area">
		<h1 class="payment-success-title"><?= $this->session->userdata('session_username');?>, Terima Kasih Telah Order di Visual Creative Agency</h1> 
		<p class="lead">Silahkan transfer ke rekening <b><?=$bank?></b> sebesar <b>Rp. <?=nominal($pesanan['keranjang_total'])?></b> sebelum 1x24 jam.
		</p>
		<label for=""><span style="color: red">*</span> <strong>Catatan/Informasi :</label>
				
				<li><b>Untuk melakukan Konfirmasi Pembayaran silahkan lakukan dibagian profile-Data Pesanan lalu konfirmasi pembayaran </li><b>
			</ul>
	</div>
	<div class="gap gap-small"></div>
	<div class="gap gap-small"></div>
	<div class="gap gap-small"></div>
	<div class="gap gap-small"></div>
</div>
