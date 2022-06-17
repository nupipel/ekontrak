<style>
	.instansi:hover {
		cursor: pointer;
	}
</style>


<div class="card shadow-none bg-transparent border-bottom border-2">
	<div class="card-body">
		<div class="row align-items-center">
			<div class="col-lg-2">
				<h4 class="mb-3 mb-md-0">Filter Data</h4>
			</div>
			<div class="col-lg-10">
				<div class="row row-cols-lg-auto">
					<label for="fileterInstansi" class="col-form-label">Instansi</label>
					<div class="col-lg-4">
						<!--<input type="text" class="form-control" id="inputToDate">-->
						<select class="form-select" id="fileterInstansi">
							<option value="">== Pilih Instansi ==</option>
							<?php foreach ($list_instansi as $instansi) : ?>
								<option value="<?= $instansi->kd_satker_str; ?>"><?= $instansi->nama_satker; ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<label for="filterTahun" class="col-form-label">Tahun</label>
					<div class="col-lg-3">
						<select class="form-select" id="filterTahun">
							<option value="2022" selected>2022</option>
							<option value="2021">2021</option>
							<option value="2020">2020</option>
							<option value="2019">2019</option>
						</select>
					</div>
					<div class="col-lg-3">
						<a class="btn btn-info rounded btn-refresh text-white" onclick="refresh()"><i class='bx bx-refresh'></i>Refresh
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
	<div class="col">
		<div class="card radius-10 angkaTotal">
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
		<div class="card radius-10 angkaTotal">
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

<div class="row chartscontainer">
	<div class="col-12 col-xl-6 d-flex">
		<div class="card radius-10 overflow-hidden w-100 chart1">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div>
						<h6 class="mb-0">APBD Tertinggi per OPD</h6>
					</div>
					<div class="font-22 ms-auto text-white"><i class="bx bx-dots-horizontal-rounded"></i>
					</div>
				</div>
				<div class="chart-container-2 my-3 chartcontainer1">
					<canvas id="chart1"></canvas>
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
		<div class="card radius-10 overflow-hidden w-100 chart2">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div>
						<h6 class="mb-0">Pendapatan Tertinggi per OPD</h6>
					</div>
					<div class="font-22 ms-auto text-white"><i class="bx bx-dots-horizontal-rounded"></i>
					</div>
				</div>

				<div class="chart-container-2 my-3 chartcontainer2">
					<canvas id="chart2"></canvas>
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
				<h5 class="mb-0 table1-title"></h5>
			</div>
			<div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
			</div>
		</div>
		<hr>
		<div class="table-responsive datatableSirup">
			<table class="table table-striped table-bordered" id="table1">
				<thead class="table-light">
					<tr>
						<th>NO</th>
						<th>OPD</th>
						<th>TENDER</th>
						<th>PAGU TENDER</th>
						<th>SELEKSI</th>
						<th>PAGU SELEKSI</th>
						<th>EPUR</th>
						<th>PAGU EPUR</th>
						<th>PL</th>
						<th>PAGU PL</th>
						<th>JUKSUNG</th>
						<th>PAGU JUKSUNG</th>
						<th>DIKECUALIKAN</th>
						<th>PAGU DIKECUALIKAN</th>
						<th>SWAKELOLA</th>
						<th>PAGU SWAKELOLA</th>
						<!-- <th>DARURAT</th>
						<th>PAGU DARURAT</th> -->
						<th>TOTAL</th>
						<th>TOTAL PAGU ANGGARAN</th>
						<th>PERSENTASE INPUT SIRUP</th>
					</tr>
				</thead>
				<tbody id="tbody1">

				</tbody>
				<tfoot id="tfoot1" class="table-light">
					<tr>
						<th>NO</th>
						<th>OPD</th>
						<th>TENDER</th>
						<th>PAGU TENDER</th>
						<th>SELEKSI</th>
						<th>PAGU SELEKSI</th>
						<th>EPUR</th>
						<th>PAGU EPUR</th>
						<th>PL</th>
						<th>PAGU PL</th>
						<th>JUKSUNG</th>
						<th>PAGU JUKSUNG</th>
						<th>DIKECUALIKAN</th>
						<th>PAGU DIKECUALIKAN</th>
						<th>SWAKELOLA</th>
						<th>PAGU SWAKELOLA</th>
						<!-- <th>DARURAT</th>
						<th>PAGU DARURAT</th> -->
						<th>TOTAL</th>
						<th>TOTAL PAGU ANGGARAN</th>
						<th>PERSENTASE INPUT SIRUP</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>


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
				<tbody id="tbodyPendapatan">

				</tbody>
			</table>

		</div>
	</div>
</div>

<!-- Modal Detail APBD -->
<div class="modal fade" id="opdDetailModal" tabindex="-1" aria-labelledby="titleDetailOPD" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="titleDetailOPD"></h5>
				<button type="button" class="btn-close" onclick="closeModal()">
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-striped table-bordered" id="datatabledetailapbd">
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
				<div class="spinner-grow text-primary spinningDetail" role="status"> <span class="visually-hidden">Loading...</span>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
			</div>
		</div>
	</div>
</div>

<script>
	// CSRF TOKEN {GLOBAL VARIABLES}
	const csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
		csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

	function refresh() {
		const opd = $("#fileterInstansi").val();
		const year = $("#filterTahun").val();

		getTotal(opd, year);

		if (opd) {
			$(".chartscontainer").hide();
		} else {
			getChart(year);
			$(".chartscontainer").show();
		}
		getDataTable1(opd, year);
		getDataTable2(opd, year);
	}

	function closeModal() {
		$('#datatabledetailapbd').DataTable().destroy();
		$('#tableDetailAPBD').empty();
		$("#opdDetailModal").modal('hide');
	};

	function ifNull(val, rupiah) {
		if (rupiah) {
			if (val) {
				return toRupiah(val, {
					symbol: null,
					floatingPoint: 0
				});
			}
		}
		return val ? val : " ";

	}

	function getTotal(opd, year) {
		$.ajax({
			url: "web/getAngkaDashboard",
			type: "POST",
			dataType: "JSON",
			data: {
				[csrfName]: csrfHash,
				opd: opd,
				year: year
			},
			beforeSend: function() {
				$(".angkaTotal").LoadingOverlay('show');
			},
			success: function(res) {
				$(".angkaTotal").LoadingOverlay('hide');
				const total_anggaran = toRupiah(res.anggaran, {
					useUnit: true
				});
				$(".total_anggaran").text(total_anggaran);
				const total_pendapatan = toRupiah(res.pendapatan, {
					useUnit: true
				});
				$(".total_pendapatan").text(total_pendapatan);
			},
		})
	}

	function getChart(year) {
		$.ajax({
			url: "web/donut_chart",
			type: "POST",
			dataType: "json",
			data: {
				[csrfName]: csrfHash,
				"year": year,
			},
			beforeSend: function() {
				$(".chartcontainer1").show();
				$(".chartcontainer1").LoadingOverlay("hide", true);
				$(".chart1").LoadingOverlay("show");
				$("#donut_table").empty();
			},
			success: function(res) {
				// menangani jika data kosong 
				if (res.label == 0) {
					$(".chartcontainer1").LoadingOverlay("show", {
						image: "",
						text: "data kosong"
					});
					return;
				}
				const ctx = document.getElementById("chart1").getContext("2d");
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
				const html = $("#donut_table");
				for (let i = 0; i < data; i++) {
					let text =
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
		}).always(function() {
			$(".chart1").LoadingOverlay("hide", true);
		});

		$.ajax({
			url: "web/donut_chart3",
			type: "POST",
			dataType: "json",
			data: {
				[csrfName]: csrfHash,
				"year": year,
			},
			beforeSend: function() {
				$(".chartcontainer2").show();
				$(".chartcontainer2").LoadingOverlay("hide", true);
				$(".chart2").LoadingOverlay("show");
				$("#donut_table3").empty();
			},
			success: function(res) {
				// menangani jika data kosong 
				if (!res.label) {
					$(".chartcontainer2").LoadingOverlay("show", {
						image: "",
						text: "data kosong"
					});
					return;
				}
				const ctx = document.getElementById("chart2").getContext("2d");
				let myChart = new Chart(ctx, {
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
				const html = $("#donut_table3");
				for (let i = 0; i < data; i++) {
					let text =
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
		}).always(function() {
			$(".chart2").LoadingOverlay("hide", true);
		});
	}

	function getDataTable1(opd, year) {
		$.ajax({
			url: "<?= base_url('web/get_paket_penyedia_opt1618s') ?>",
			type: "POST",
			dataType: "JSON",
			data: {
				[csrfName]: csrfHash,
				year: year,
				opd: opd
			},
			beforeSend: function() {
				$('.datatableSirup').LoadingOverlay("show");
				$('#table1').DataTable().destroy();
				$('#tbody1').empty();
				$("#table1total").remove();
				$(".table1-title").text("DATA SIRUP TAHUN " + year);
			},
			success: function(res) {
				let target = $('#tbody1');
				let html;
				let no = 1;
				$.each(res.data, function(i, val) {
					html = "<tr>" +
						"<td class='text-end'>" + no + "</td>" +
						"<td>" + val.nama + "</td>" +
						"<td class='text-end'>" + ifNull(val.tender) + "</td>" +
						"<td class='text-end'>" + ifNull(val.pagutender, true) + "</td>" +
						"<td class='text-end'>" + ifNull(val.seleksi) + "</td>" +
						"<td class='text-end'>" + ifNull(val.paguseleksi, true) + "</td>" +
						"<td class='text-end'>" + ifNull(val.epur) + "</td>" +
						"<td class='text-end'>" + ifNull(val.paguepur, true) + "</td>" +
						"<td class='text-end'>" + ifNull(val.pl) + "</td>" +
						"<td class='text-end'>" + ifNull(val.pagupl, true) + "</td>" +
						"<td class='text-end'>" + ifNull(val.juksung) + "</td>" +
						"<td class='text-end'>" + ifNull(val.pagujuksung, true) + "</td>" +
						"<td class='text-end'>" + ifNull(val.dk) + "</td>" +
						"<td class='text-end'>" + ifNull(val.pagudk, true) + "</td>" +
						"<td class='text-end'>" + ifNull(val.sw) + "</td>" +
						"<td class='text-end'>" + ifNull(val.pagusw, true) + "</td>" +
						"<td class='text-end'>" + ifNull(val.total) + "</td>" +
						"<td class='text-end'>" + ifNull(val.totalpagu, true) + "</td>" +
						"<td class='text-end'>" + val.prosentase + "%</td>" +
						"</tr>";
					target.append(html);
					no++;
				});
				if (!opd) {
					let rowTotal;
					rowTotal = "<tr id='table1total'>" +
						"<th></th>" +
						"<td class='fw-bold text-center'>Total</td>" +
						"<td class='fw-bold text-end'>" + ifNull(res.sum.tender) + "</td>" +
						"<td class='fw-bold text-end'>" + ifNull(res.sum._tender, true) + "</td>" +
						"<td class='fw-bold text-end'>" + ifNull(res.sum.seleksi) + "</td>" +
						"<td class='fw-bold text-end'>" + ifNull(res.sum._seleksi, true) + "</td>" +
						"<td class='fw-bold text-end'>" + ifNull(res.sum.epur) + "</td>" +
						"<td class='fw-bold text-end'>" + ifNull(res.sum._epur, true) + "</td>" +
						"<td class='fw-bold text-end'>" + ifNull(res.sum.pl) + "</td>" +
						"<td class='fw-bold text-end'>" + ifNull(res.sum._pl, true) + "</td>" +
						"<td class='fw-bold text-end'>" + ifNull(res.sum.juksung) + "</td>" +
						"<td class='fw-bold text-end'>" + ifNull(res.sum._juksung, true) + "</td>" +
						"<td class='fw-bold text-end'>" + ifNull(res.sum.dk) + "</td>" +
						"<td class='fw-bold text-end'>" + ifNull(res.sum._dk, true) + "</td>" +
						"<td class='fw-bold text-end'>" + ifNull(res.sum.sw) + "</td>" +
						"<td class='fw-bold text-end'>" + ifNull(res.sum._sw, true) + "</td>" +
						"<td class='fw-bold text-end'>" + ifNull(res.sum.total) + "</td>" +
						"<td class='fw-bold text-end'>" + ifNull(res.sum._total, true) + "</td>" +
						"<td class='fw-bold text-end'></td>" +
						"</tr>";
					$("#tfoot1").prepend(rowTotal);
				}

				$('#table1').DataTable({
					"pageLength": 100
				});
			},
		}).always(function() {
			$(".datatableSirup").LoadingOverlay("hide", true);
		});
	}


	function getDataTable2(opd, year) {
		//table apbd
		$.ajax({
			url: "<?= base_url('web/clistApbd_OPD') ?>",
			type: "POST",
			dataType: "JSON",
			data: {
				[csrfName]: csrfHash,
				year: year,
				opd: opd
			},
			beforeSend: function() {
				$('#dataTables_apbd').DataTable().destroy();
				$('#dataTables_apbd').LoadingOverlay("show");
				$('#dataTables_apbd_opd').empty();
			},
			success: function(res) {
				let target = $('#dataTables_apbd_opd');
				let html;
				let no = 1;

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
		}).always(function() {
			$("#dataTables_apbd").LoadingOverlay("hide", true);
		});

		$.ajax({
			url: "<?= base_url('web/pendapatan') ?>",
			type: "POST",
			dataType: "JSON",
			data: {
				[csrfName]: csrfHash,
				year: year,
				opd: opd
			},
			beforeSend: function() {
				$('#dataTables_pendapatan').DataTable().destroy();
				$('#dataTables_pendapatan').LoadingOverlay("show");
				$('#tbodyPendapatan').empty();
			},
			success: function(res) {
				let target = $('#tbodyPendapatan');
				let html;
				let no = 1;

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
		}).always(function() {
			$("#dataTables_pendapatan").LoadingOverlay("hide", true);
		});

	}

	function opdDetail(id) {
		const opd = id.split("_");
		const id_opd = opd[1];
		const dataJson = {
			[csrfName]: csrfHash,
			"id": id_opd,
			"year": 2022
		};

		$.ajax({
			url: "<?= base_url(); ?>web/getDetailAPBD",
			dataType: "JSON",
			type: "POST",
			data: dataJson,
			beforeSend: function() {
				$('.spinningDetail').show();
			},
			success: function(res) {
				$('.spinningDetail').hide();
				let target = $('#tableDetailAPBD');
				let html;
				let no = 1;
				$.each(res, function(i, val) {
					let list = "<ol class='list-group list-group-numbered'>";
					$.each(val.kegiatan, function(i, val) {
						list += "<li class='list-group-item'>" + val.uraian + "</li>"
					});
					list += "</ol>";

					html = "<tr>" +
						"<th>" + no + "</th>" +
						"<td>" + val.nama + "</td>" +
						"<td>" + list + "</td>" +
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


	// READY FUNCTION HERE !!!
	$(function() {
		const csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
			csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';



		refresh();

	});
	// END READY FUNCTION 
</script>