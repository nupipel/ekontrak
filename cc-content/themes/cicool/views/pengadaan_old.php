<style>
	hr {
		margin: 0;
		padding: 0;
		width: 80%;
	}

	.cursor-pointer:hover {
		background-color: #fff;
		margin-top: -.25rem;
		/* margin-bottom: .25rem; */
		-webkit-box-shadow: 0 .5rem 1rem 0 rgba(0, 0, 0, .2);
		box-shadow: 0 .25rem .5rem 0 rgba(0, 0, 0, .2)
	}
</style>

<div class="card shadow-none bg-transparent border-bottom border-2">
	<div class="card-body">
		<div class="row align-items-center">
			<div class="col-lg-2">
				<h4 class="mb-3 mb-md-0">Filter Data</h4>
			</div>
			<div class="col-lg-10">
				<form>
					<div class="row row-cols-sm-auto">
						<label for="fileterInstansi" class="col-form-label">Instansi</label>
						<div class="col-sm-4">
							<!--<input type="text" class="form-control" id="inputToDate">-->
							<select class="form-control" id="fileterInstansi">
								<option value="">== Pilih Instansi ==</option>
								<?php foreach ($list_instansi as $instansi) : ?>
									<option value="<?= $instansi->kd_satker_str; ?>"><?= $instansi->nama_satker; ?></option>
								<?php endforeach; ?>
							</select>
						</div>

						<label for="filterTahun" class="col-form-label">Tahun</label>
						<div class="col-sm-3">
							<!--<input type="text" class="form-control" id="inputToDate">-->
							<select class="form-control" id="filterTahun">
								<option value="">== Pilih Tahun ==</option>
								<option value="2022" selected>2022</option>
								<option value="2021">2021</option>
								<option value="2020">2020</option>
								<option value="2019">2019</option>
							</select>
						</div>
						<div class="col-sm-3">
							<a class="btn btn-info rounded btn-refresh text-white mx-3" onclick="refresh()"><i class='bx bx-refresh'></i>Refresh
							</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="row row-cols-1 row-cols-xl-3">
	<div class="col">
		<div id="tender" class="card cursor-pointer bg-info angkaTotal" onclick="gotoTable(this.id)">
			<div class="card-body text-center">
				<h3 class="mb-0 text-capitalize" style="color:white;">kontrak tender</h3>
			</div>
			<hr class="mx-auto">
			<div class="card-footer border-0 bg-white">
				<div class="row align-items-center text-center">
					<div class="col border-end">
						<h3 class="mb-0 text-danger nilai_tender"></h3>
						<p class="extra-small-font">Nilai</p>
					</div>
					<div class="col">
						<h3 class="mb-0 text-primary paket_tender"></h3>
						<p class="extra-small-font">Paket</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col">
		<div id="nontender" class="card cursor-pointer bg-success angkaTotal" onclick="gotoTable(this.id)">
			<div class="card-body text-center">
				<h3 class="mb-0 text-capitalize" style="color:white;">kontrak non tender</h3>
			</div>
			<hr class="mx-auto">
			<div class="card-footer border-0 bg-white">
				<div class="row align-items-center text-center">
					<div class="col border-end">
						<h3 class="mb-0 text-danger nilai_nontender"></h3>
						<p class="extra-small-font">Nilai</p>
					</div>
					<div class="col">
						<h3 class="mb-0 text-primary paket_nontender"></h3>
						<p class="extra-small-font">Paket</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col">
		<div id="epurchasing" class="card cursor-pointer bg-warning angkaTotal" onclick="gotoTable(this.id)">
			<div class="card-body text-center">
				<h3 class="mb-0 text-capitalize" style="color:white;">E-purchasing</h3>
			</div>
			<hr class="mx-auto">
			<div class="card-footer border-0 bg-white">
				<div class="row align-items-center text-center">
					<div class="col border-end">
						<h3 class="mb-0 text-danger nilai_epur"></h3>
						<p class="extra-small-font">Nilai</p>
					</div>
					<div class="col">
						<h3 class="mb-0 text-primary paket_epur"></h3>
						<p class="extra-small-font">Paket</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--end row-->

<div class="row row-cols-1 row-cols-xl-3">
	<div class="col">
		<div class="card radius-10 overflow-hidden w-100 cardtender">
			<div class="card-body tenderChart">
				<div class="d-flex align-items-center">
					<div>
						<h6 class="mb-0">Status Tender</h6>
					</div>
					<div class="font-22 ms-auto text-white"><i class="bx bx-dots-horizontal-rounded"></i>
					</div>
				</div>
				<div class="chart-container-2 my-3">
					<canvas id="tenderChart"></canvas>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table align-items-center mb-0">
					<tbody id="tenderTable">
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="col">
		<div class="card radius-10 overflow-hidden w-100 cardnontender">
			<div class="card-body nontenderChart">
				<div class="d-flex align-items-center">
					<div>
						<h6 class="mb-0">Status Non Tender</h6>
					</div>
					<div class="font-22 ms-auto text-white"><i class="bx bx-dots-horizontal-rounded"></i>
					</div>
				</div>
				<div class="chart-container-2 my-3">
					<canvas id="nontenderChart"></canvas>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table align-items-center mb-0">
					<tbody id="nontenderTable">
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="col">
		<div class="card radius-10 overflow-hidden w-100 cardepurc">
			<div class="card-body chartStatusEpur">
				<div class="d-flex align-items-center">
					<div>
						<h6 class="mb-0">Status E-Purchasing</h6>
					</div>
					<div class="font-22 ms-auto text-white"><i class="bx bx-dots-horizontal-rounded"></i>
					</div>
				</div>
				<div class="chart-container-2 my-3">
					<canvas id="chartStatusEpur"></canvas>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table align-items-center mb-0">
					<tbody id="tableStatusEpur">

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!--end row-->



<div class="card radius-10 bg-info">
	<div class="card-body">
		<div class="d-flex align-items-center">
			<div>
				<h5 style="color:white;">Table Kontrak Tender</h5>
			</div>
		</div>
	</div>
	<div class="card-footer bg-white">
		<div class="spinner-grow text-primary spinnerDataTableTender" role="status"> <span class="visually-hidden">Loading...</span>
		</div>
		<div class="table-responsive">
			<table class="table table-striped align-middle mb-0" id="dataTableTender">
				<thead class="table-light">
					<tr>
						<th>No</th>
						<th>nama_satker</th>
						<th>nama_paket</th>
						<th>kd_rup_paket</th>
						<th>kd_tender</th>
						<th>no_kontrak</th>
						<th>tgl_kontrak</th>
						<th>pagu</th>
						<th>nilai_kontrak</th>
						<th>nama_penyedia</th>
						<th>tgl_mulai_kerja_spmk</th>
						<th>tgl_selesai_kerja_spmk</th>
						<th>no_bast</th>
						<th>tgl_bast</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<div class="card radius-10 bg-success">
	<div class="card-body">
		<div class="d-flex align-items-center">
			<div>
				<h5 style="color:white;">Table Kontrak Non Tender</h5>
			</div>
		</div>
	</div>
	<div class="card-footer bg-white">
		<div class="spinner-grow text-primary spinnerDataTableNonTender" role="status"> <span class="visually-hidden">Loading...</span>
		</div>
		<div class="table-responsive">
			<table class="table table-striped align-middle mb-0" id="dataTableNonTender">
				<thead class="table-light">
					<tr>
						<th>No</th>
						<th>nama_satker</th>
						<th>nama_paket</th>
						<th>kd_rup_paket</th>
						<th>kd_nontender</th>
						<th>no_kontrak</th>
						<th>tgl_kontrak</th>
						<th>pagu</th>
						<th>nilai_kontrak</th>
						<th>nama_penyedia</th>
						<th>tgl_mulai_kerja_spmk</th>
						<th>tgl_selesai_kerja_spmk</th>
						<th>no_bast</th>
						<th>tgl_bast</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>



<div class="card radius-10 bg-warning">
	<div class="card-body">
		<div class="d-flex align-items-center">
			<div>
				<h5 style="color:white;">Table E-Purchasing</h5>
			</div>
		</div>
	</div>
	<div class="card-footer bg-white">
		<div class="spinner-grow text-primary spinnerEpurchasing" role="status"> <span class="visually-hidden">Loading...</span>
		</div>
		<div class="table-responsive">
			<table class="table table-striped align-middle mb-0" id="dataTableEpur">
				<thead class="table-light">
					<tr>
						<th>No</th>
						<th>tahun_anggaran</th>
						<th>nama_satker</th>
						<th>kd_rup</th>
						<th>nama_paket</th>
						<th>kd_paket</th>
						<th>no_paket</th>
						<th>tanggal_buat_paket</th>
						<th>total</th>
						<th>kuantitas</th>
						<th>harga_satuan</th>
						<th>paket_status_str</th>
						<th>kd_penyedia</th>
						<th>kd_penyedia_distributor</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>


<!-- Modal Detail STATUS -->
<div class="modal fade" id="modalDetailStatus" tabindex="-1" aria-labelledby="titleDetailStatus" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="titleDetailStatus"></h5>
				<button type="button" class="btn-close" onclick="closeModal()">
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">

					<table class="table table-striped" id="dataTableDetailStatus">
						<thead>
							<tr>
								<th>No</th>
								<th>nama_satker</th>
								<th>nama_paket</th>
								<th>kd_rup_paket</th>
								<th>kd_tender</th>
								<!-- <th>no_kontrak</th>
								<th>tgl_kontrak</th> -->
								<th>pagu</th>
								<th>nilai_kontrak</th>
								<th>nama_penyedia</th>
								<!-- <th>tgl_mulai_kerja_spmk</th>
								<th>tgl_selesai_kerja_spmk</th>
								<th>no_bast</th>
								<th>tgl_bast</th> -->
							</tr>
						</thead>
						<tbody id="tableDetailStatus">

						</tbody>
					</table>

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

	function gotoTable(id) {
		let goto;
		if (id == 'tender') {
			goto = $("#dataTableTender");
		} else if (id == 'nontender') {
			goto = $("#dataTableNonTender");
		} else if (id == 'epurchasing') {
			goto = $("#dataTableEpur");
		}
		$([document.documentElement, document.body]).animate({
			scrollTop: goto.offset().top - 220
		}, 1200);
	}

	function closeModal() {
		$('#dataTableDetailStatus').DataTable().destroy();
		$('#tableDetailStatus').empty();
		$("#modalDetailStatus").modal('hide');
	};

	function redraw(id) {

	}

	function refresh() {
		const opd = $("#fileterInstansi").val();
		const year = $("#filterTahun").val();
		getAngkaDepan(opd, year);
		getDataTable(opd, year);

		// Load Chart 
		chartTender(opd, year);
		chartNonTender(opd, year);
		chartEpurc(opd, year);

	}

	function getAngkaDepan(opd, year) {
		$.ajax({
			url: "web/getAngkaPelelangan",
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
				console.log(res);
				$.each(res.nilai, function(i, val) {
					$("." + i).text(toRupiah(val, {
						useUnit: true,
						symbol: null,
						floatingPoint: 0,
					}));
				});
				$.each(res.paket, function(i, val) {
					$("." + i).text(val);
				});
			}
		}).always(function() {
			$(".angkaTotal").LoadingOverlay('hide', true);
		});
	}

	function getDataTable(opd, year) {
		$('#dataTableTender').DataTable().destroy();
		$('#dataTableNonTender').DataTable().destroy();
		$('#dataTableEpur').DataTable().destroy();


		$('#dataTableTender').DataTable({
			processing: true,
			serverSide: true,
			// searchable: true,
			ajax: {
				url: 'web/dataTableTender',
				type: 'POST',
				data: {
					[csrfName]: csrfHash,
					opd: opd,
					year: year
				},
				"dataSrc": function(json) {
					$('.spinnerDataTableTender').hide();
					return json.data;
				},
				beforeSend: function() {
					$('.spinnerDataTableTender').show();
				},

			},
		});

		$('#dataTableNonTender').DataTable({
			processing: true,
			serverSide: true,
			// searchable: true,
			ajax: {
				url: 'web/dataTableNonTender',
				type: 'POST',
				data: {
					[csrfName]: csrfHash,
					opd: opd,
					year: year
				},
				"dataSrc": function(json) {
					$('.spinnerDataTableNonTender').hide();
					return json.data;
				},
				beforeSend: function() {
					$('.spinnerDataTableNonTender').show();
				},
			},
		});

		$('#dataTableEpur').DataTable({
			processing: true,
			serverSide: true,
			// searchable: true,
			ajax: {
				url: 'web/dataTableEpur',
				type: 'POST',
				data: {
					[csrfName]: csrfHash,
					opd: opd,
					year: year
				},
				"dataSrc": function(json) {
					$('.spinnerEpurchasing').hide();
					return json.data;
				},
				beforeSend: function() {
					$('.spinnerEpurchasing').show();
				},
			},
		});
	}

	function chartTender(opd, year) {
		// STATUS TENDER 
		$.ajax({
			url: "<?= base_url(); ?>web/tenderChart",
			type: "POST",
			dataType: "JSON",
			data: {
				[csrfName]: csrfHash,
				opd: opd,
				year: year
			},
			beforeSend: function() {
				$(".tenderChart").LoadingOverlay("show");
				$(".cardtender").LoadingOverlay("hide", true);
				$("#tenderTable").empty();
				if (window.tenderChartDraw) {
					window.tenderChartDraw.destroy();
				}

			},
			success: function(res) {
				if (!res.total) {
					$(".cardtender").LoadingOverlay("show", {
						image: "",
						text: "data kosong"
					});
					return;
				}

				let temp;
				let labels = [];
				let values = [];
				let persent = [];
				$.each(res, function(key, val) {
					if (key == "persen_selesai") {
						temp = "Paket Selesai";
						labels.push(temp);
						persent.push(parseFloat(val.toFixed(2)));
					} else if (key == "persen_proses") {
						temp = "Paket Proses";
						labels.push(temp);
						persent.push(parseFloat(val.toFixed(2)));
					}

					if (key == "selesai") {
						values.push(parseInt(val));
					} else if (key == "proses") {
						values.push(parseInt(val));
					}
				});

				const ctx = document.getElementById("tenderChart").getContext("2d");
				window.tenderChartDraw = new Chart(ctx, {
					type: "pie",
					data: {
						labels: labels,
						datasets: [{
							backgroundColor: ["#ffcd56", "#4bc0c0"],
							data: values,
							// borderWidth: [0, 0, 0, 0],
						}, ],
					},
					options: {
						onClick: tenderClick,
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
							events: ['click'],
							displayColors: false,
						},
					},
				});

				function tenderClick(e) {
					const activePoints = myChart.getElementsAtEvent(e);
					// console.log(this.data.labels[0]);
					const selectedIndex = activePoints[0]._index;
					const status = this.data.labels[selectedIndex];
					$.ajax({
						url: "<?= base_url(); ?>web/detailStatus",
						type: "POST",
						dataType: "JSON",
						data: {
							[csrfName]: csrfHash,
							status: status
						},
						success: function(res) {
							const target = $('#tableDetailStatus');
							let html;
							let no = 1;

							$.each(res, function(i, val) {
								html = "<tr>" +
									"<th>" + no + "</th>" +
									"<td>" + val.nama_satker + "</td>" +
									"<td>" + val.nama_paket + "</td>" +
									"<td>" + val.kd_rup_paket + "</td>" +
									"<td>" + val.kd_tender + "</td>" +
									// "<td>" + val.no_kontrak + "</td>" +
									// "<td>" + val.tgl_kontrak + "</td>" +
									"<td>" + val.pagu + "</td>" +
									"<td>" + val.nilai_kontrak + "</td>" +
									"<td>" + val.nama_penyedia + "</td>" +
									// "<td>" + val.tgl_mulai_kerja_spmk + "</td>" +
									// "<td>" + val.tgl_selesai_kerja_spmk + "</td>" +
									// "<td>" + val.no_bast + "</td>" +
									// "<td>" + val.tgl_bast + "</td>" +
									"</tr>";
								target.append(html);
								no++;
							});
							$('#dataTableDetailStatus').DataTable();
						}
					})
					$("#titleDetailStatus").text("Detail Status " + status);
					$("#modalDetailStatus").modal('show');
				}

				// DONUT TABLE
				const html = $("#tenderTable");
				const colors = ["#ffcd56", "#4bc0c0"];
				for (let i = 0; i < labels.length; i++) {
					const text =
						'<tr><td><i class="bx bxs-circle me-2" style="color: ' +
						colors[i] +
						'"></i>' +
						labels[i] +
						"</td><td><strong>" + values[i] + " (" +
						persent[i] +
						"%)</strong></td></tr>";
					html.append(text);
				}
			},
		}).always(function() {
			$(".tenderChart").LoadingOverlay("hide", true);
		});
	}

	function chartNonTender(opd, year) {
		// STATUS NONTENDER 
		$.ajax({
			url: "<?= base_url(); ?>web/nontenderChart",
			type: "POST",
			dataType: "JSON",
			data: {
				[csrfName]: csrfHash,
				opd: opd,
				year: year
			},
			beforeSend: function() {
				$(".nontenderChart").LoadingOverlay("show");
				$(".cardnontender").LoadingOverlay("hide", true);
				$("#nontenderTable").empty();
				if (window.nontenderChartDraw) {
					window.nontenderChartDraw.destroy();
				}
			},
			success: function(res) {
				if (!res.total) {
					$(".cardnontender").LoadingOverlay("show", {
						image: "",
						text: "data kosong"
					});
					return;
				}
				let temp;
				let labels = [];
				let values = [];
				let persent = [];
				$.each(res, function(key, val) {
					if (key == "persen_selesai") {
						temp = "Paket Selesai";
						labels.push(temp);
						persent.push(parseFloat(val.toFixed(2)));
					} else if (key == "persen_proses") {
						temp = "Paket Proses";
						labels.push(temp);
						persent.push(parseFloat(val.toFixed(2)));
					}

					if (key == "selesai") {
						values.push(parseInt(val));
					} else if (key == "proses") {
						values.push(parseInt(val));
					}
				});

				const ctx = document.getElementById("nontenderChart").getContext("2d");
				window.nontenderChartDraw = new Chart(ctx, {
					type: "pie",
					data: {
						labels: labels,
						datasets: [{
							backgroundColor: ["#ffcd56", "#4bc0c0"],
							data: values,
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
				const html = $("#nontenderTable");
				const colors = ["#ffcd56", "#4bc0c0"];
				for (let i = 0; i < labels.length; i++) {
					const text =
						'<tr><td><i class="bx bxs-circle me-2" style="color: ' +
						colors[i] +
						'"></i>' +
						labels[i] +
						"</td><td><strong>" + values[i] + " (" +
						persent[i] +
						"%)</strong></td></tr>";
					html.append(text);
				}
			},
		}).always(function() {
			$(".nontenderChart").LoadingOverlay("hide", true);
		});
	}

	function chartEpurc(opd, year) {
		// STATUS EPURCHASINGS 
		$.ajax({
			url: "web/chartStatusEpur",
			type: "POST",
			dataType: "JSON",
			data: {
				[csrfName]: csrfHash,
				opd: opd,
				year: year
			},
			beforeSend: function() {
				$(".chartStatusEpur").LoadingOverlay("show");
				$(".cardepurc").LoadingOverlay("hide", true);
				$("#tableStatusEpur").empty();
				if (window.chartStatusEpurDraw) {
					window.chartStatusEpurDraw.destroy();
				}
			},
			success: function(res) {
				if (!res.total) {
					$(".cardepurc").LoadingOverlay("show", {
						image: "",
						text: "data kosong"
					});
					return;
				}
				let temp;
				let labels = [];
				let values = [];
				let persent = [];
				$.each(res, function(key, val) {
					if (key == "persen_selesai") {
						temp = "Paket Selesai";
						labels.push(temp);
						persent.push(parseFloat(val.toFixed(2)));
					} else if (key == "persen_proses") {
						temp = "Paket Proses";
						labels.push(temp);
						persent.push(parseFloat(val.toFixed(2)));
					}

					if (key == "selesai") {
						values.push(parseInt(val));
					} else if (key == "proses") {
						values.push(parseInt(val));
					}
				});

				// console.log(labels, values);

				const ctx = document.getElementById("chartStatusEpur").getContext("2d");
				window.chartStatusEpurDraw = new Chart(ctx, {
					type: "pie",
					data: {
						labels: labels,
						datasets: [{
							backgroundColor: ["#ffcd56", "#4bc0c0"],
							data: values,
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
				const html = $("#tableStatusEpur");
				const colors = ["#ffcd56", "#4bc0c0"];
				for (let i = 0; i < labels.length; i++) {
					const text =
						'<tr><td><i class="bx bxs-circle me-2" style="color: ' +
						colors[i] +
						'"></i>' +
						labels[i] +
						"</td><td><strong>" + values[i] + " (" +
						persent[i] +
						"%)</strong></td></tr>";
					html.append(text);
				}
			},
		}).always(function() {
			$(".chartStatusEpur").LoadingOverlay("hide", true);
		});
	}

	// ready function 
	$(function() {
		refresh();

	})
</script>