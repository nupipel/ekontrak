<style>
	.instansi:hover {
		cursor: pointer;
	}
</style>

<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
	<div class="col">
		<div class="card radius-10 ">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<h5 class="mb-0 text-primary total_anggaran"></h5>
					<div class="ms-auto">
						<i class="bx bx-cart fs-3 text-primary"></i>
					</div>
				</div>
				<div class="progress my-2" style="height:4px;">
					<div class="progress-bar bg-primary" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<div class="d-flex align-items-center">
					<p class="mb-0">Total APBD</p>
					<p class="mb-0 ms-auto"><span><i class="bx bx-up-arrow-alt"></i></span></p>
				</div>
			</div>
		</div>
	</div>
	<div class="col">
		<div class="card radius-10">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<h5 class="mb-0 text-success total_pendapatan"></h5>
					<div class="ms-auto">
						<i class="bx bx-dollar fs-3 text-success"></i>
					</div>
				</div>
				<div class="progress my-2" style="height:4px;">
					<div class="progress-bar bg-success" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<div class="d-flex align-items-center">
					<p class="mb-0">Total Pendapatan</p>
					<p class="mb-0 ms-auto"><span><i class="bx bx-up-arrow-alt"></i></span></p>
				</div>
			</div>
		</div>
	</div>
	<div class="col" style="display:none">
		<div class="card radius-10">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<h5 class="mb-0 text-danger">6200</h5>
					<div class="ms-auto">
						<i class="bx bx-group fs-3 text-danger"></i>
					</div>
				</div>
				<div class="progress my-2" style="height:4px;">
					<div class="progress-bar bg-danger" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<div class="d-flex align-items-center">
					<p class="mb-0">Total Belanja Langsung</p>
					<p class="mb-0 ms-auto">+5.2%<span><i class="bx bx-up-arrow-alt"></i></span></p>
				</div>
			</div>
		</div>
	</div>
	<div class="col" style="display:none">
		<div class="card radius-10">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<h5 class="mb-0 text-warning">5630</h5>
					<div class="ms-auto">
						<i class="bx bx-envelope fs-3 text-warning"></i>
					</div>
				</div>
				<div class="progress my-2" style="height:4px;">
					<div class="progress-bar bg-warning" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<div class="d-flex align-items-center">
					<p class="mb-0">Total Belanjan Tidak Langsung</p>
					<p class="mb-0 ms-auto">+2.2%<span><i class="bx bx-up-arrow-alt"></i></span></p>
				</div>
			</div>
		</div>
	</div>
</div>
<!--end row-->

<div class="row">
	<div class="col-12 col-xl-6 d-flex">
		<div class="card radius-10 overflow-hidden w-100">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div>
						<h6 class="mb-0">APBD Tertinggi per OPD</h6>
					</div>
					<div class="font-22 ms-auto text-white"><i class="bx bx-dots-horizontal-rounded"></i>
					</div>
				</div>
				<div class="chart-container-2 my-3">
					<canvas id="chart2"></canvas>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table align-items-center mb-0">
					<tbody id="donut_table">

					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="col-12 col-xl-6 d-flex">
		<div class="card radius-10 overflow-hidden w-100">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div>
						<h6 class="mb-0">Pendapatan Tertinggi per OPD</h6>
					</div>
					<div class="font-22 ms-auto text-white"><i class="bx bx-dots-horizontal-rounded"></i>
					</div>
				</div>

				<div class="chart-container-2 my-3">
					<canvas id="chart3pendapatan"></canvas>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table align-items-center mb-0">
					<tbody id="donut_table3">

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!--End Row-->


<div class="card radius-10">
	<div class="card-body">
		<div class="d-flex align-items-center">
			<div>
				<h5 class="mb-0">APBD per OPD</h5>
			</div>
			<div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
			</div>
		</div>
		<hr>
		<div class="table-responsive">
			<table class="table table-striped align-middle mb-0" id="dataTables_apbd">
				<thead class="table-light">
					<tr>
						<th>NO</th>
						<th>Nama OPD</th>
						<th>Anggaran</th>
						<th>Anggaran Pergeseran</th>
						<th>Anggaran Perubahan</th>
					</tr>
				</thead>
				<tbody id="dataTables_apbd_opd">

				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card radius-10">
	<div class="card-body">
		<div class="d-flex align-items-center">
			<div>
				<h5 class="mb-0">Pendapatan per OPD</h5>
			</div>
			<div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
			</div>
		</div>
		<hr>
		<div class="table-responsive">
			<table class="table table-striped align-middle mb-0" id="dataTables_pendapatan">
				<thead class="table-light">
					<tr>
						<th>NO</th>
						<th>Nama OPD</th>
						<th>Anggaran</th>
						<th>Anggaran Pergeseran</th>
						<th>Anggaran Perubahan</th>
					</tr>
				</thead>
				<tbody id="dataTables_apbd_opd_pendapatan">

				</tbody>
			</table>

		</div>
	</div>
</div>



<!-- Modal -->
<div class="modal fade" id="opdDetailModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="titleDetailOPD"></h5>
				<button type="button" onclick="closeModal()">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-striped" id="datatabledetailapbd">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Instansi</th>
							<th scope="col">Kegiatan</th>
							<th scope="col">Anggaran</th>
							<th scope="col">Anggaran Pergeseran</th>
							<th scope="col">Anggaran Perubahan</th>
						</tr>
					</thead>
					<tbody id="tableDetailAPBD">

					</tbody>
				</table>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
			</div>
		</div>
	</div>
</div>

<script>
	let tot_angg = toRupiah(<?= $total_anggaran->total_anggaran; ?>, {
		useUnit: true
	});
	$(".total_anggaran").text(tot_angg);
	let tot_pend = toRupiah(<?= $total_pendapatan->total_pendapatan; ?>, {
		useUnit: true
	});
	$(".total_pendapatan").text(tot_pend);

	function closeModal() {
		$('#datatabledetailapbd').DataTable().destroy();
		$('#tableDetailAPBD').empty();
		$("#opdDetailModal").modal('hide');
	};

	function opdDetail(id) {
		var opd = id.split("_");
		var id_opd = opd[1];
		// console.log(id_opd);
		// CSRF TOKEN
		var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
			csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
		var dataJson = {
			[csrfName]: csrfHash,
			"id": id_opd,
			"year": 2022
		};

		$.ajax({
			url: "<?= base_url(); ?>web/getDetailAPBD",
			dataType: "JSON",
			type: "POST",
			data: dataJson,
			success: function(res) {
				var target = $('#tableDetailAPBD');
				var html;
				var no = 1;

				$.each(res, function(i, val) {
					html = "<tr>" +
						"<th>" + no + "</th>" +
						"<td>" + val.nama + "</td>" +
						"<td>" + val.uraian + "</td>" +
						"<td>" + toRupiah(val.anggaran, {
							floatingPoint: 0
						}) + "</td>" +
						"<td>" + toRupiah(val.anggaran_pergeseran, {
							floatingPoint: 0
						}) + "</td>" +
						"<td>" + toRupiah(val.anggaran_perubahan, {
							floatingPoint: 0
						}) + "</td>" +
						"</tr>";
					target.append(html);
					no++;
				});
				$('#datatabledetailapbd').DataTable();
				$("#titleDetailOPD").text("Detail APBD " + res[0].nama);
			}
		});

		$("#opdDetailModal").modal('show');
	}

	$(function() {
		"use strict";

		$.ajax({
			url: "web/donut_chart3",
			type: "get",
			dataType: "json",
			success: function(res) {
				// console.log(res.label);
				var ctx = document.getElementById("chart3pendapatan").getContext("2d");
				var myChart = new Chart(ctx, {
					type: "doughnut",
					data: {
						labels: res.label,
						datasets: [{
							backgroundColor: res.bgcolor,
							data: res.val,
							// borderWidth: [0, 0, 0, 0],
						}, ],
					},
					options: {
						maintainAspectRatio: false,
						cutoutPercentage: 60,
						legend: {
							position: "bottom",
							display: false,
							labels: {
								fontColor: "#ddd",
								boxWidth: 15,
							},
						},
						tooltips: {
							displayColors: false,
						},
					},
				});

				// DONUT TABLE
				let data = res.label.length;
				var html = $("#donut_table3");
				for (let i = 0; i < data; i++) {
					var text =
						'<tr><td><i class="bx bxs-circle me-2" style="color: ' +
						res.bgcolor[i] +
						'"></i>' +
						res.label[i] +
						"</td><td>" +
						toRupiah(res.val[i], {
							useUnit: true
						}) +
						"</td></tr>";
					html.append(text);
				}
			},
		});

		$.ajax({
			url: "web/donut_chart",
			type: "get",
			dataType: "json",
			success: function(res) {
				// console.log(res.label);
				var ctx = document.getElementById("chart2").getContext("2d");
				var myChart = new Chart(ctx, {
					type: "doughnut",
					data: {
						labels: res.label,
						datasets: [{
							backgroundColor: res.bgcolor,
							data: res.val,
							// borderWidth: [0, 0, 0, 0],
						}, ],
					},
					options: {
						maintainAspectRatio: false,
						cutoutPercentage: 60,
						legend: {
							position: "bottom",
							display: false,
							labels: {
								fontColor: "#ddd",
								boxWidth: 15,
							},
						},
						tooltips: {
							displayColors: false,
						},
					},
				});

				// DONUT TABLE
				let data = res.label.length;
				var html = $("#donut_table");
				for (let i = 0; i < data; i++) {
					var text =
						'<tr><td><i class="bx bxs-circle me-2" style="color: ' +
						res.bgcolor[i] +
						'"></i>' +
						res.label[i] +
						"</td><td>" +
						toRupiah(res.val[i], {
							useUnit: true
						}) +
						"</td></tr>";
					html.append(text);
				}
			},
		});
		//table apbd
		$.ajax({
			url: "<?= base_url('web/clistApbd_OPD') ?>",
			type: "GET",
			dataType: "JSON",
			success: function(res) {
				var target = $('#dataTables_apbd_opd');
				var html;
				var no = 1;

				$.each(res, function(i, val) {
					html = "<tr class='instansi' id='opd_" + val.id + "'>" +
						"<th>" + no + "</th>" +
						"<td>" + val.nama + "</td>" +
						"<td>" + toRupiah(val.anggaran, {
							floatingPoint: 0
						}) + "</td>" +
						"<td>" + toRupiah(val.anggaran_pergeseran, {
							floatingPoint: 0
						}) + "</td>" +
						"<td>" + toRupiah(val.anggaran_perubahan, {
							floatingPoint: 0
						}) + "</td>" +
						"</tr>";
					target.append(html);
					no++;

					// detailOpd 
					$("#opd_" + val.id).mouseenter(function() {
						$(this).addClass("bg-warning");
					}).mouseleave(function() {
						$(this).removeClass("bg-warning");
					});

					$("#opd_" + val.id).click(function() {
						opdDetail(this.id);
					});
					// end detailOPD
				});
				$('#dataTables_apbd').DataTable();

			}
		});

		$.ajax({
			url: "<?= base_url('web/pendapatan') ?>",
			type: "GET",
			dataType: "JSON",
			success: function(res) {
				var target = $('#dataTables_apbd_opd_pendapatan');
				var html;
				var no = 1;

				$.each(res, function(i, val) {
					html = "<tr>" +
						"<th>" + no + "</th>" +
						"<td>" + val.nama + "</td>" +
						"<td>" + toRupiah(val.anggaran, {
							floatingPoint: 0
						}) + "</td>" +
						"<td>" + toRupiah(val.anggaran_pergeseran, {
							floatingPoint: 0
						}) + "</td>" +
						"<td>" + toRupiah(val.anggaran_perubahan, {
							floatingPoint: 0
						}) + "</td>" +
						"</tr>";
					target.append(html);
					no++;
				});
				$('#dataTables_pendapatan').DataTable();
			}
		});

	});
</script>