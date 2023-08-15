</div>
</div>
<!-- partial:partials/_footer.html -->
<footer class="footer  d-print-none">
	<div class="container-fluid clearfix">
		<span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2023 <a href="#">VCAUI</a>. All rights reserved.</span>
	</div>
</footer>
<!-- partial -->
</div>
<!-- row-offcanvas ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- plugins:js -->
<script src="<?= base_url() ?>assets/backend/node_modules/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/backend/node_modules/popper.js/dist/umd/popper.min.js"></script>
<script src="<?= base_url() ?>assets/backend/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/backend/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<script src="<?= base_url() ?>assets/backend/node_modules/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
<script src="<?= base_url() ?>assets/backend/node_modules/chart.js/dist/Chart.min.js"></script>
<script src="<?= base_url() ?>assets/backend/node_modules/raphael/raphael.min.js"></script>
<script src="<?= base_url() ?>assets/backend/node_modules/morris.js/morris.min.js"></script>
<script src="<?= base_url() ?>assets/backend/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="<?= base_url() ?>assets/backend/js/off-canvas.js"></script>
<script src="<?= base_url() ?>assets/backend/js/hoverable-collapse.js"></script>
<script src="<?= base_url() ?>assets/backend/js/misc.js"></script>
<script src="<?= base_url() ?>assets/backend/js/settings.js"></script>
<script src="<?= base_url() ?>assets/backend/js/todolist.js"></script>
<!-- endinject -->

<script src="<?= base_url('assets/backend/node_modules/datatables.net/js/jquery.dataTables.js') ?>"></script>
<script src="<?= base_url('assets/backend/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js') ?>"></script>
<script src="<?= base_url('assets/backend/js/data-table.js') ?>"></script>
<script src="<?= base_url() ?>assets/backend/node_modules/dropify/dist/js/dropify.min.js"></script>

<!-- Chart JS -->
<script src="<?= base_url() ?>assets/vendor/chart.js/chart.min.js"></script>

<script src="<?= base_url() ?>assets/backend/js/dropify.js"></script>
<!-- Custom js for this page-->
<script src="<?= base_url() ?>assets/backend/js/dashboard.js"></script>

<script>
    $(document).ready(function() {

		var baseUrl = "<?= base_url() ?>";
		var myBarChart;
		
		renderChart()

		function renderChart(label, total, title) {

			var labelTanggal = label === undefined ? <?= json_encode($tanggal);?> : label;
            var total = total === undefined ? <?= json_encode($data);?> : total;
			var titleText = title === undefined ? "<?= $tipe;?>" : title;

			var barChart = document.getElementById('myChart').getContext('2d');

			myBarChart = new Chart(barChart, {
				type: 'bar',
				data: {
					labels: labelTanggal,
					datasets: [{
						label: titleText,
						backgroundColor: '#13b4ca',
						data: total,
					}],
				},
				options: {
					responsive: true,
					maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    },
				},
			});
		}

		$('#tanggalMulai').change(function(){
			$('#filter-chart').prop('disabled', false)
		})

		$('#filter-chart').click(function(){
			myBarChart.destroy();
            $.ajax({
                url: `${baseUrl}admin/filter-chart`,
                type: "POST",
                cache: false,
                data: {
                    "awal": $('#tanggalMulai').val(),
                    "akhir": $('#tanggalAkhir').val(),
					"tipe" : $(this).attr('data-jenis')
                },
                success:function(response){
                    var result = JSON.parse(response)
					renderChart(result.date, result.total)
                }
            })
        })
	})
</script>
</body>


</html>
