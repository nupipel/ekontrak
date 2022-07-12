<div id="app">
	<div class="card shadow-none bg-transparent border-bottom border-2">
		<div class="card-body">
			<div class="row align-items-center">
				<div class="col-lg-2">
					<h4 class="mb-3 mb-md-0">Filter Data</h4>
				</div>
				<div class="col-lg-10">
					<div class="row row-cols-sm-auto">
						<label for="fileterInstansi" class="col-form-label">Instansi</label>
						<div class="col-sm-4">
							<select class="form-control" id="fileterInstansi" v-model="opd">
								<option value="">== Pilih Instansi ==</option>
								<option :value="agency.kd_satker_str" v-for="(agency, index) in agencies" :key="index">{{agency.nama_satker}}</option>
							</select>
						</div>

						<label for="filterTahun" class="col-form-label">Tahun</label>
						<div class="col-sm-3">
							<input type="number" placeholder="Masukkan Tahun" class="form-control" id="filterTahun" v-model="year">
						</div>
						<div class="col-sm-3">
							<div @click="getEkontrak" class="btn btn-info rounded btn-refresh text-white mx-3">
								<i class='bx bx-refresh'></i>
								Refresh
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- tender -->
	<div class="row">
		<div class="col-12 col-lg-4 col-xl-4">
			<div class="card radius-10 w-100">
				<div class="card-header bg-primary py-3">
					<div class="d-flex align-items-center">
						<h5 class="mb-0 text-white">TENDER</h5>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive mt-3">
						<table class="table align-middle">
							<tbody>
								<tr>
									<th></th>
									<th>Jenis</th>
									<th>Paket</th>
									<th>Pagu</th>
								</tr>
								<tr v-for="(tender, index) in ekontraks.tender" :key="index">
									<td></td>
									<td>{{tender.jenis}}</td>
									<td>{{tender.paket}}</td>
									<td>{{format_angka(tender.pagu)}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="col-12 col-lg-8 col-xl-8">
			<div class="card radius-10 w-100">
				<div class="card-header radius-10 bg-primary py-3">
					<div class="d-flex align-items-center">
						<div>
							<h5 class="mb-0 text-white">TENDER</h5>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">
						<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" :style="{ color: clr_sirup}"></i>SIRUP</span>
						<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" :style="{ color: clr_proses}"></i>PROSES</span>
						<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" :style="{ color: clr_kontrak}"></i>KONTRAK</span>
						<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" :style="{ color: clr_selesai}"></i>SELESAI</span>
					</div>
					<div style="height: 300px">
						<canvas id="myChart"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--End Row-->
	<!-- end of tender -->

	<!-- non tender -->
	<div class="row">
		<div class="col-12 col-lg-4 col-xl-4">
			<div class="card radius-10 w-100">
				<div class="card-header bg-success py-3">
					<div class="d-flex align-items-center">
						<h5 class="mb-0 text-white">NON-TENDER</h5>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive mt-3">
						<table class="table align-middle">
							<tbody>
								<tr>
									<th></th>
									<th>Jenis</th>
									<th>Paket</th>
									<th>Pagu</th>
								</tr>
								<tr v-for="(nontender, index) in ekontraks.nontender" :key="index">
									<td></td>
									<td>{{nontender.jenis}}</td>
									<td>{{nontender.paket}}</td>
									<td>{{format_angka(nontender.pagu)}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="col-12 col-lg-8 col-xl-8">
			<div class="card radius-10 w-100">
				<div class="card-header radius-10 bg-success py-3">
					<div class="d-flex align-items-center">
						<div>
							<h5 class="mb-0 text-white">NON-TENDER</h5>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">
						<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" :style="{ color: clr_sirup}"></i>SIRUP</span>
						<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" :style="{ color: clr_proses}"></i>PROSES</span>
						<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" :style="{ color: clr_kontrak}"></i>KONTRAK</span>
						<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" :style="{ color: clr_selesai}"></i>SELESAI</span>
					</div>
					<div style="height: 300px">
						<canvas id="myChart2"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end of non tender -->

	<!-- E-Purchasing -->
	<div class="row">
		<div class="col-12 col-lg-4 col-xl-4">
			<div class="card radius-10 w-100">
				<div class="card-header bg-danger py-3">
					<div class="d-flex align-items-center">
						<h5 class="mb-0 text-white">E-PURCHASING</h5>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive mt-3">
						<table class="table align-middle">
							<tbody>
								<tr>
									<th></th>
									<th>Jenis</th>
									<th>Paket</th>
									<th>Pagu</th>
								</tr>
								<tr v-for="(epurchasing, index) in ekontraks.epurchasing" :key="index">
									<td></td>
									<td>{{epurchasing.jenis}}</td>
									<td>{{epurchasing.paket}}</td>
									<td>{{format_angka(epurchasing.pagu)}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="col-12 col-lg-8 col-xl-8">
			<div class="card radius-10 w-100">
				<div class="card-header radius-10 bg-danger py-3">
					<div class="d-flex align-items-center">
						<div>
							<h5 class="mb-0 text-white">E-PURCHASING</h5>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">
						<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" :style="{ color: clr_sirup}"></i>SIRUP</span>
						<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" :style="{ color: clr_proses}"></i>PROSES</span>
						<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" :style="{ color: clr_kontrak}"></i>KONTRAK</span>
						<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" :style="{ color: clr_selesai}"></i>SELESAI</span>
					</div>
					<div style="height: 300px">
						<canvas id="myChart3"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end of E-Purchasing -->
</div>
<!-- end of APP  -->


<div class="card radius-10 bg-primary">
	<div class="card-body">
		<div class="d-flex align-items-center">
			<div>
				<h5 style="color:white;">KONTRAK TENDER</h5>
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
				<h5 style="color:white;">KONTRAK NON-TENDER</h5>
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



<div class="card radius-10 bg-danger">
	<div class="card-body">
		<div class="d-flex align-items-center">
			<div>
				<h5 style="color:white;">E-PURCHASINGS</h5>
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

<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/@develoka/angka-rupiah-js/index.min.js"></script>

<script>
	var app = new Vue({
		el: '#app',
		data: {
			apikey: 'FD59804809A3DFD300C1E49F6E6FD23D',
			url: '<?= base_url(); ?>',

			opd: "",
			year: new Date().getFullYear(),

			agencies: [],
			ekontraks: [],

			//LINE CHARTS : 
			labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
			tender_chart: [],
			nontender_chart: [],
			epurc_chart: [],

			// legends 
			clr_sirup: 'rgb(52, 152, 219)',
			clr_proses: 'rgb(231, 76, 60)',
			clr_kontrak: 'rgb(241, 196, 15)',
			clr_selesai: 'rgb(46, 204, 113)',

		},
		mounted() {
			this.getAgency();
			this.getEkontrak();
		},
		methods: {
			getAgency() {
				axios.get(this.url + 'api/ekontrak/instansi', {
					headers: {
						'x-api-key': this.apikey
					}
				}).then((res) => this.agencies = res.data.data);
			},
			getEkontrak() {
				this.tender();
				this.nontender();
				this.epurchasing();
				axios.get(this.url + 'api/ekontrak/angkaekontrak', {
					headers: {
						'x-api-key': this.apikey
					},
					params: {
						'opd': this.opd,
						'year': this.year
					}
				}).then((res) => this.ekontraks = res.data.data);
			},
			format_angka(value) {
				return toRupiah(value, {
					useUnit: true,
					symbol: null,
					floatingPoint: 0,
				});
			},

			tender() {
				// clean canvas first 
				if (window.tenderLineChart) {
					window.tenderLineChart.destroy();
				}
				axios.get(this.url + 'api/ekontrak/chartValues', {
					headers: {
						'x-api-key': this.apikey
					},
					params: {
						'opd': this.opd,
						'year': this.year,
						'method': 1
					}
				}).then((res) => {
					this.tender_chart = res.data.data;

					const data = {
						labels: this.labels,
						datasets: [{
								// label: 'Sirup',
								fill: false,
								backgroundColor: this.clr_sirup,
								borderColor: this.clr_sirup,
								data: this.tender_chart.sirup,
							},
							{
								// label: 'Proses',
								fill: false,
								backgroundColor: this.clr_proses,
								borderColor: this.clr_proses,
								data: this.tender_chart.proses,
							},
							{
								// label: 'Kontrak',
								fill: false,
								backgroundColor: this.clr_kontrak,
								borderColor: this.clr_kontrak,
								data: this.tender_chart.kontrak,
							},
							{
								// label: 'Selesai',
								fill: false,
								backgroundColor: this.clr_selesai,
								borderColor: this.clr_selesai,
								data: this.tender_chart.selesai,
							}
						]
					};

					const config = {
						type: 'line',
						data: data,
						options: {
							responsive: true,
							maintainAspectRatio: false,
							legend: {
								display: false
							},
							scales: {
								yAxes: [{
									ticks: {
										// max: maxVal,
										min: 0
									}
								}]
							}
						}
					};
					window.tenderLineChart = new Chart(
						document.getElementById('myChart'),
						config
					);
				});
			},

			nontender() {
				// clean canvas first 
				if (window.nontenderLineChart) {
					window.nontenderLineChart.destroy();
				}
				axios.get(this.url + 'api/ekontrak/chartValues', {
					headers: {
						'x-api-key': this.apikey
					},
					params: {
						'opd': this.opd,
						'year': this.year,
						'method': 2
					}
				}).then((res) => {
					this.nontender_chart = res.data.data;

					const data = {
						labels: this.labels,
						datasets: [{
								// label: 'Sirup',
								fill: false,
								backgroundColor: this.clr_sirup,
								borderColor: this.clr_sirup,
								data: this.nontender_chart.sirup,
							},
							{
								// label: 'Proses',
								fill: false,
								backgroundColor: this.clr_proses,
								borderColor: this.clr_proses,
								data: this.nontender_chart.proses,
							},
							{
								// label: 'Kontrak',
								fill: false,
								backgroundColor: this.clr_kontrak,
								borderColor: this.clr_kontrak,
								data: this.nontender_chart.kontrak,
							},
							{
								// label: 'Selesai',
								fill: false,
								backgroundColor: this.clr_selesai,
								borderColor: this.clr_selesai,
								data: this.nontender_chart.selesai,
							}
						]
					};

					const config = {
						type: 'line',
						data: data,
						options: {
							responsive: true,
							maintainAspectRatio: false,
							legend: {
								display: false
							},
							scales: {
								yAxes: [{
									ticks: {
										// max: maxVal,
										min: 0
									}
								}]
							}
						}
					};
					window.nontenderLineChart = new Chart(
						document.getElementById('myChart2'),
						config
					);
				});
			},
			epurchasing() {
				// clean canvas first 
				if (window.epurcLineChart) {
					window.epurcLineChart.destroy();
				}
				axios.get(this.url + 'api/ekontrak/chartValues', {
					headers: {
						'x-api-key': this.apikey
					},
					params: {
						'opd': this.opd,
						'year': this.year,
						'method': 3
					}
				}).then((res) => {
					this.epurc_chart = res.data.data;

					const data = {
						labels: this.labels,
						datasets: [{
								// label: 'Sirup',
								fill: false,
								backgroundColor: this.clr_sirup,
								borderColor: this.clr_sirup,
								data: this.epurc_chart.sirup,
							},
							{
								// label: 'Proses',
								fill: false,
								backgroundColor: this.clr_proses,
								borderColor: this.clr_proses,
								data: this.epurc_chart.proses,
							},
							{
								// label: 'Kontrak',
								fill: false,
								backgroundColor: this.clr_kontrak,
								borderColor: this.clr_kontrak,
								data: this.epurc_chart.kontrak,
							},
							{
								// label: 'Selesai',
								fill: false,
								backgroundColor: this.clr_selesai,
								borderColor: this.clr_selesai,
								data: this.epurc_chart.selesai,
							}
						]
					};

					const config = {
						type: 'line',
						data: data,
						options: {
							responsive: true,
							maintainAspectRatio: false,
							legend: {
								display: false
							},
							scales: {
								yAxes: [{
									ticks: {
										// max: maxVal,
										min: 0
									}
								}]
							}
						}
					};
					window.epurcLineChart = new Chart(
						document.getElementById('myChart3'),
						config
					);
				});
			}

		},
	})
</script>


<script>
	//READY FUNCTION
	$(function() {

		refresh();

		$(".btn-refresh").click(function() {
			refresh();
		})
	});



	// CSRF TOKEN {GLOBAL VARIABLES}
	const csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
		csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

	function refresh() {
		const opd = $("#fileterInstansi").val();
		const year = $("#filterTahun").val();
		getDataTable(opd, year);

		console.log('opd :>> ', opd);
		console.log('year :>> ', year);
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
</script>