<div id="app">
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
								<select class="form-control" id="fileterInstansi">
									<option value="">== Pilih Instansi ==</option>
								</select>
							</div>

							<label for="filterTahun" class="col-form-label">Tahun</label>
							<div class="col-sm-3">
								<input type="number" placeholder="Masukkan Tahun" class="form-control" v-model="year" >
							</div>
							<div class="col-sm-3">
								<a class="btn btn-info rounded btn-refresh text-white mx-3"><i class='bx bx-refresh'></i>Refresh
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-5">
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
							<tr>
								<td>{{message}}</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-7">
			<div class="card radius-10 bg-info">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div>
							<h5 style="color:white;">Tender</h5>
						</div>
					</div>
				</div>
				<div class="card-footer bg-white">
					<canvas id="myChart" width="400" height="400"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>

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


<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
	var app = new Vue({
		el: '#app',
		data: {
			message: "Hello",
			test: [0, 10, 5, 2, 20, 30, 45],
			year: new Date().getFullYear()
		},
		mounted() {
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
		methods: {


		},
	})
</script>