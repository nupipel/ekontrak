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
							<input type="number" placeholder="Masukkan Tahun" class="form-control" v-model="year">
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
	<div class="row">
		<!-- tender -->
		<div class="col-md-4">
			<div class="card radius-10 bg-info">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div>
							<h5 style="color:white;">Tender</h5>
						</div>
					</div>
				</div>
				<div class="card-footer bg-white">
					<div class="table-responsive">
						<table class="table table-striped align-middle mb-0">
							<thead class="table-light">
								<tr>
									<th>Jenis</th>
									<th>Paket</th>
									<th>Pagu</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(tender, index) in ekontraks.tender" :key="index">
									<td>{{tender.jenis}}</td>
									<td>{{tender.paket}}</td>
									<td>{{coba(tender.pagu)}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card radius-10 bg-info">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div>
							<h5 style="color:white;">Tender</h5>
						</div>
					</div>
				</div>
				<div class="card-footer bg-white">
					<canvas id="myChart" height="100%"></canvas>
				</div>
			</div>
		</div>
		<!-- end of tender -->

		<!-- non tender -->
		<div class="col-md-4">
			<div class="card radius-10 bg-success">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div>
							<h5 style="color:white;">Non Tender</h5>
						</div>
					</div>
				</div>
				<div class="card-footer bg-white">
					<div class="table-responsive">
						<table class="table table-striped align-middle mb-0">
							<thead class="table-light">
								<tr>
									<th>Jenis</th>
									<th>Paket</th>
									<th>Pagu</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(nontender, index) in ekontraks.nontender" :key="index">
									<td>{{nontender.jenis}}</td>
									<td>{{nontender.paket}}</td>
									<td>{{coba(nontender.pagu)}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card radius-10 bg-success">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div>
							<h5 style="color:white;">Non Tender</h5>
						</div>
					</div>
				</div>
				<div class="card-footer bg-white">
					<canvas id="myChart2" height="100%"></canvas>
				</div>
			</div>
		</div>
		<!-- end of non tender -->

		<!-- non tender -->
		<div class="col-md-4">
			<div class="card radius-10 bg-primary">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div>
							<h5 style="color:white;">E-Purchasing</h5>
						</div>
					</div>
				</div>
				<div class="card-footer bg-white">
					<div class="table-responsive">
						<table class="table table-striped align-middle mb-0">
							<thead class="table-light">
								<tr>
									<th>Jenis</th>
									<th>Paket</th>
									<th>Pagu</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(epurchasing, index) in ekontraks.epurchasing" :key="index">
									<td>{{epurchasing.jenis}}</td>
									<td>{{epurchasing.paket}}</td>
									<td>{{coba(epurchasing.pagu)}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card radius-10 bg-primary">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div>
							<h5 style="color:white;">E-Purchasing</h5>
						</div>
					</div>
				</div>
				<div class="card-footer bg-white">
					<canvas id="myChart3" width="400" height="100%"></canvas>
				</div>
			</div>
		</div>
		<!-- end of E-Purchasing -->


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
			url: '<?= base_url(); ?>',
			year: "",
			opd: "",
			message: "Hello",
			agencies: [],
			ekontraks: [],
			test: [0, 10, 5, 2, 20, 30, 45],
			year: new Date().getFullYear()
		},
		mounted() {
			this.getAgency();
			this.getEkontrak();
			this.tender();
			this.nontender();
			this.epurchasing();
		},
		methods: {
			getAgency() {
				axios.get(this.url + 'api/ekontrak/instansi', {
					headers: {
						'x-api-key': 'FD59804809A3DFD300C1E49F6E6FD23D'
					}
				}).then((res) => this.agencies = res.data.data);
			},
			getEkontrak() {
				axios.get(this.url + 'api/ekontrak/angkaekontrak', {
					headers: {
						'x-api-key': 'FD59804809A3DFD300C1E49F6E6FD23D'
					},
					params: {
						'opd': this.opd,
						'year': this.year
					}
				}).then((res) => this.ekontraks = res.data.data);
			},
			coba(value) {
				return toRupiah(value, {
					useUnit: true,
					symbol: null,
					floatingPoint: 0,
				});
			},
			tender() {
				const labels = this.test;

				const data = {
					labels: labels,
					datasets: [{
						label: 'My First dataset',
						backgroundColor: 'rgb(255, 99, 132)',
						borderColor: 'rgb(255, 99, 132)',
						data: this.test,
					}]
				};

				const config = {
					type: 'line',
					data: data,
					options: {}
				};
				const myChart = new Chart(
					document.getElementById('myChart'),
					config
				);
			},
			nontender() {
				const labels = this.test;

				const data = {
					labels: labels,
					datasets: [{
						label: 'My First dataset',
						backgroundColor: 'rgb(255, 99, 132)',
						borderColor: 'rgb(255, 99, 132)',
						data: this.test,
					}]
				};

				const config = {
					type: 'line',
					data: data,
					options: {}
				};
				const myChart = new Chart(
					document.getElementById('myChart2'),
					config
				);
			},
			epurchasing() {
				const labels = this.test;

				const data = {
					labels: labels,
					datasets: [{
						label: 'My First dataset',
						backgroundColor: 'rgb(255, 99, 132)',
						borderColor: 'rgb(255, 99, 132)',
						data: this.test,
					}]
				};

				const config = {
					type: 'line',
					data: data,
					options: {}
				};
				const myChart = new Chart(
					document.getElementById('myChart3'),
					config
				);
			}

		},
	})
</script>