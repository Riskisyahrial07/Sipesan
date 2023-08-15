$(document).ready(function () {
	var root = window.location.origin + '/sipesan/';

	setTimeout(function () {
	$('.hide-it').addClass('fadeOutUpBig')
	},5000);

});

function showTotalSpanduk() {
	var panjang = $('#panjang').val().replace(/,/g, '.');
	var lebar = $('#lebar').val().replace(/,/g, '.');
	var jumlah = $('#jumlah').val();
	var hargaBahan = $('#harga-bahan').val();
	var luas = parseFloat(panjang) * parseFloat(lebar);
	var total = 0;
	var html = '';

	$('#panjang').val(panjang)
	$('#lebar').val(lebar)

	total = Math.round((luas * jumlah) * hargaBahan);
	html = '' +
			'<h3> Rp. '+formatRupiah(total.toString())+'</h3>';
		$('#total').html(html);
}

function showTotalStiker() {
	var hargaBahan = $('#harga-bahan').val();
	var jumlah = $('#jumlah').val();
	var total = 0;
	var html = '';

	total = jumlah * hargaBahan;
	html = '' +
		'<h3> Rp. '+formatRupiah(parseInt(total).toString())+'</h3>';
	$('#total').html(html);
}

function showTotalKartu() {
	var hargaBahan = $('#harga-bahan').val();
	var jumlah = $('#jumlah').val();
	var total = 0;
	var html = '';

	total = jumlah * hargaBahan;
	html = '' +
		'<h3> Rp. '+formatRupiah(parseInt(total).toString())+'</h3>';
	$('#total').html(html);
}

function showTotalBrosur() {
	var hargaBahan = $('#harga-bahan').val();
	var jumlah = $('#jumlah').val();
	var total = 0;
	var html = '';

	total = jumlah * hargaBahan;
	html = '' +
		'<h3> Rp. '+formatRupiah(parseInt(total).toString())+'</h3>';
	$('#total').html(html);
}

function showTotalDesain() {
	var panjang = $('#panjang').val().replace(/,/g, '.');
	var lebar = $('#lebar').val().replace(/,/g, '.');
	var jumlah = $('#jumlah').val();
	var hargaBahan = $('#harga-bahan').val();
	var luas = parseFloat(panjang) * parseFloat(lebar);
	var total = 0;
	var html = '';

	$('#panjang').val(panjang)
	$('#lebar').val(lebar)

	total = Math.round((luas * jumlah) * hargaBahan);
	html = '' +
			'<h3> Rp. '+formatRupiah(total.toString())+'</h3>';
		$('#total').html(html);
}

function pilihPengambilan() {
	if($('input[name=pengambilan]:checked').val() == 'Delivery') {
		$('#alamat-pengiriman').removeClass('hidden')
		$('#form-alamat-text').prop('required',true);
	} else {
		$('#alamat-pengiriman').addClass('hidden')
		$('#form-alamat-text').prop('required',false);
	}
}

function getHargaBahan(form) {
	$('#harga-bahan').val($("#option-harga-bahan option:selected").attr("data-harga"))

	if(form == 'stiker') {
		showTotalStiker()
	} else if(form == 'brosur') {
		showTotalBrosur()
	} else if(form == 'kartu') {
		showTotalKartu()
	} else if(form == 'desain') {
		showTotalDesain()
	} else if(form == 'spanduk') {
		showTotalSpanduk()
	}
 }

// ------------------------------------------------------------------------------------------
// Fungsi-fungsi
// ------------------------------------------------------------------------------------------

function formatRupiah(angka, prefix){
	var number_string = angka.replace(/[^,\d]/g, '').toString(),
		split   		= number_string.split(','),
		sisa     		= split[0].length % 3,
		rupiah     		= split[0].substr(0, sisa),
		ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	if(ribuan){
		separator = sisa ? '.' : '';
		rupiah += separator + ribuan.join('.');
	}

	rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}
