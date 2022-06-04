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

<script>
	$(function() {
		$('#inputToDate').datepicker();
	})
</script>


<div class="card shadow-none bg-transparent border-bottom border-2">
	<div class="card-body">
		<div class="row align-items-center">
			<div class="col-lg-2">
				<h4 class="mb-3 mb-md-0">Filter Data</h4>
			</div>
			<div class="col-lg-10">
				<form>
					<div class="row row-cols-md-auto">
						<label for="inputToDate" class="col-form-label">Tahun</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="inputToDate">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="row row-cols-1 row-cols-xl-3">
	<div class="col">
		<div class="card radius-10 cursor-pointer">
			<div class="card-body text-center">
				<h3 class="mb-0 text-capitalize text-secondary">kontrak tender</h3>
			</div>
			<hr class="mx-auto">
			<div class="card-footer border-0 bg-transparent">
				<div class="row align-items-center text-center">
					<div class="col border-end">
						<h3 class="mb-0 text-danger">777</h3>
						<p class="extra-small-font">Nilai</p>
					</div>
					<div class="col">
						<h3 class="mb-0 text-primary">985</h3>
						<p class="extra-small-font">Paket</p>
					</div>
				</div>
			</div>
		</div>


	</div>
	<div class="col">
		<div class="card radius-10 cursor-pointer">
			<div class="card-body text-center">
				<h3 class="mb-0 text-capitalize text-secondary">kontrak non tender</h3>

			</div>
			<hr class="mx-auto">
			<div class="card-footer border-0 bg-transparent">
				<div class="row align-items-center text-center">
					<div class="col border-end">
						<h3 class="mb-0 text-danger">563M</h3>
						<p class="extra-small-font">Nilai</p>
					</div>
					<div class="col">
						<h3 class="mb-0 text-primary">985</h3>
						<p class="extra-small-font">Paket</p>
					</div>
				</div>
			</div>
		</div>


	</div>
	<div class="col">
		<div class="card radius-10 cursor-pointer">
			<div class="card-body text-center">
				<h3 class="mb-0 text-capitalize text-secondary">E-purchasing</h3>

			</div>
			<hr class="mx-auto">
			<div class="card-footer border-0 bg-transparent">
				<div class="row align-items-center text-center">
					<div class="col border-end">
						<h3 class="mb-0 text-danger nilai_epur"></h3>
						<p class="extra-small-font">Nilai</p>
					</div>
					<div class="col">
						<h3 class="mb-0 text-primary"><?= $paket_epur->paket; ?></h3>
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
	<div class="col">


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
	<div class="col">


		<div class="card radius-10 overflow-hidden w-100">
			<div class="card-body">
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



<div class="card radius-10">
	<div class="card-body">
		<div class="d-flex align-items-center">
			<div>
				<h5 class="mb-0">Table E-Purchasing</h5>
			</div>

		</div>
		<hr>
		<div class="table-responsive">
			<table class="table table-striped align-middle mb-0" id="dataTableEpur">
				<thead class="table-light">
					<tr>
						<!-- <th>No</th> -->
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


<script>
	let nilai_epur = toRupiah(<?= (int)$nilai_epur->nilai; ?>, {
		useUnit: true,
		symbol: null,
		floatingPoint: 0,
	});
	$(".nilai_epur").text(nilai_epur);

	$(function() {
		// CSRF TOKEN
		var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
			csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
		var dataJson = {
			[csrfName]: csrfHash,
			// thn: "2022"
		};

		$('#dataTableEpur').DataTable({
			processing: true,
			serverSide: true,
			// searchable: true,
			ajax: {
				url: 'web/dataTableEpur',
				// "dataType": "json",
				type: 'POST',
				data: dataJson,
			},

		});

		// $.ajax({
		// 	url: "<?= base_url('web/dataTableEpur') ?>",
		// 	type: "GET",
		// 	dataType: "JSON",
		// 	success: function(res) {
		// 		console.log(res)
		// var target = $('#dataTables_epur');
		// var html;
		// var no = 1;

		// $.each(res, function(i, val) {
		// 	html = "<tr>" +
		// 		"<th>" + no + "</th>" +
		// 		"<td>" + val.nama + "</td>" +
		// 		"<td>" + toRupiah(val.anggaran, {
		// 			floatingPoint: 0
		// 		}) + "</td>" +
		// 		"<td>" + toRupiah(val.anggaran_pergeseran, {
		// 			floatingPoint: 0
		// 		}) + "</td>" +
		// 		"<td>" + toRupiah(val.anggaran_perubahan, {
		// 			floatingPoint: 0
		// 		}) + "</td>" +
		// 		"</tr>";
		// 	target.append(html);
		// 	no++;
		// });
		// $('#dataTables_apbd').DataTable();
		// }
		// });
	})
</script>