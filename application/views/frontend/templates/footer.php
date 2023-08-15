<div class="gap"></div>

<footer class="main-footer">
	<div class="container">
		<div class="row row-col-gap" data-gutter="60">
			<div class="col-md-3">
				<h4 class="widget-title-sm">Tentang Kami</h4>
				<p>Visual Creative Agency melayani : cetak spanduk, sticker, brosur, dan kartu nama.</p>
				<ul class="main-footer-social-list">
					<li>
						<a class="fa fa-whatsapp " href="https://wa.me/6282252170059"></a>
					</li>
					<li>
						<a class="fa fa-facebook" href="#"></a>
					</li>
					<li>
						<a class="fa fa-instagram" href="https://instagram.com/visualcreative_agency"></a>
					</li>
				</ul>
			</div>
			<div class="col-md-3">
				<h4 class="widget-title-sm">Alamat</h4>
				<p>Jalan Batu Berlian No.10, Sampit - Kalimantan Tengah</p>
			</div>
			<div class="col-md-3">
				<h4 class="widget-title-sm">Kontak</h4>
				<p>Riski Perdana</p>
				<p>0822-5217-0059</p>
			</div>
			<div class="col-md-3">
				<h4 class="widget-title-sm">Jam Buka</h4>
				<table>
					<tr>
						<td style="padding: 3px;">Senin</td>
						<td style="padding: 3px;"> : </td>
						<td style="padding: 3px;">09.00 – 18.00</td>
					</tr>
					<tr>
						<td style="padding: 3px;">Selasa</td>
						<td style="padding: 3px;"> : </td>
						<td style="padding: 3px;">09.00 – 18.00</td>
					</tr>
					<tr>
						<td style="padding: 3px;">Rabu</td>
						<td style="padding: 3px;"> : </td>
						<td style="padding: 3px;">09.00 – 18.00</td>
					</tr>
					<tr>
						<td style="padding: 3px;">Kamis</td>
						<td style="padding: 3px;"> : </td>
						<td style="padding: 3px;">09.00 – 18.00</td>
					</tr>
					<tr>
						<td style="padding: 3px;">Jum'at</td>
						<td style="padding: 3px;"> : </td>
						<td style="padding: 3px;">09.00 – 18.00</td>
					</tr>
					<tr>
						<td style="padding: 3px;">Sabtu</td>
						<td style="padding: 3px;"> : </td>
						<td style="padding: 3px;">09.00 – 18.00</td>
					</tr>
				</table>
			</div>
		</div>

	</div>
</footer>
<div class="copyright-area">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<p class="copyright-text">Copyright &copy; <a href="http://wikidevia.digtive.id/">Visual Creative Agency Developer</a> 2023. All rights reseved</p>
			</div>
			<div class="col-md-6">
			</div>
		</div>
	</div>
</div>
</div>
<script src="<?= base_url() ?>assets/frontend/js/jquery.js"></script>
<script src="<?= base_url() ?>assets/frontend/js/bootstrap.js"></script>
<script src="<?= base_url() ?>assets/frontend/js/icheck.js"></script>
<script src="<?= base_url() ?>assets/frontend/js/ionrangeslider.js"></script>
<script src="<?= base_url() ?>assets/frontend/js/jqzoom.js"></script>
<script src="<?= base_url() ?>assets/frontend/js/card-payment.js"></script>
<script src="<?= base_url() ?>assets/frontend/js/owl-carousel.js"></script>
<script src="<?= base_url() ?>assets/frontend/js/magnific.js"></script>
<script src="<?= base_url() ?>assets/frontend/js/custom.js"></script>


<script src="<?= base_url() ?>assets/frontend/js/switcher.js"></script>


<script src="<?= base_url() ?>assets/backend/node_modules/dropify/dist/js/dropify.min.js"></script>
<script src="<?= base_url() ?>assets/backend/js/dropify.js"></script>

<script src="<?= base_url() ?>assets/frontend/js/sipesan.js"></script>

<script>
	$(document).ready(function(){

		var base_url = '<?= base_url() ?>';

		$('#select-pesanan').change(function(){
			var pesanan = $('#pesanan').val()
			$('#total').html('<h3> 0</h3>');

			$.ajax({
                url: `${base_url}get-form-pesanan`,
                type: "POST",
                cache: false,
                data: {
                    "pesanan": $(this).val()
                },
                success:function(response){
					var result = JSON.parse(response);

					$('#form-pesanan-rendered').html(result.html)
					$('#form-pesanan').attr('action', `${base_url}${result.action}`);
                }
            })

			// if($(this).val() == 1) {
			// 	$(`#${pesanan}`).addClass('d-none');
			// 	$('#form-stiker').removeClass('d-none');

			// 	$('#pesanan').val('form-stiker')
			// 	$('#form-pesanan').attr('action', `${base_url}stiker`);
			// } else if($(this).val() == 2) {
			// 	$(`#${pesanan}`).addClass('d-none');
			// 	$('#form-spanduk').removeClass('d-none');

			// 	$('#pesanan').val('form-spanduk')
			// 	$('#form-pesanan').attr('action', `${base_url}spanduk`);
			// } else if($(this).val() == 3) {
			// 	$(`#${pesanan}`).addClass('d-none');
			// 	$('#form-kartu').removeClass('d-none');

			// 	$('#pesanan').val('form-kartu')
			// 	$('#form-pesanan').attr('action', `${base_url}kartu`);
			// } else if($(this).val() == 4) {
			// 	$(`#${pesanan}`).addClass('d-none');
			// 	$('#form-brosur').removeClass('d-none');

			// 	$('#pesanan').val('form-brosur')
			// 	$('#form-pesanan').attr('action', `${base_url}brosur`);
			// } else if($(this).val() == 5) {
			// 	$(`#${pesanan}`).addClass('d-none');
			// 	$('#form-desain').removeClass('d-none');

			// 	$('#pesanan').val('form-desain')
			// 	$('#form-pesanan').attr('action', `${base_url}desain`);
			// }

		})

	})

	function showPassword(id) {
		var x = document.getElementById(id);
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}
	}
</script>
</body>
</html>
