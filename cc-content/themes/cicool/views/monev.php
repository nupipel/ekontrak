<div class="row">










	<div class="card radius-10">
		<div class="card-body">
			<div class="d-flex align-items-center">
				<div>
					<h5 class="mb-0">Realisasi per OPD</h5>
				</div>
				<div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
				</div>
			</div>
			<hr>
			<div class="card shadow-none bg-transparent border-bottom border-2">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-lg-2">
							<h4 class="mb-3 mb-md-0">Filter Data</h4>
						</div>
						<div class="col-lg-10">
							<form>
								<div class="row row-cols-md-auto">
									<label for="inputToDate" class="col-form-label">Tahun </label>
									<div class="col-md-4">
										<select class="form-control" name="tahun" onchange="getDataTable(true,this.value)">
											<option value="">== Pilih Tahun ==</option>
											<option value="2022">2022</option>
											<option value="2021">2021</option>
											<option value="2020">2020</option>
											<option value="2019">2019</option>
										</select>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-striped align-middle mb-0" id="dataTable_realisasi">
					<thead class="table-light">
						<tr>
							<th>No.</th>
							<th>Tahun</th>
							<th>Nama OPD</th>
								<th>Nama Sub Kegiatan</th>
							<th>Anggaran</th>
							<th>Anggaran Perubahan</th>
							<th>Jml. Realisasi</th>
							<th>Januari</th>
							<th>Februari</th>
							<th>Maret</th>
							<th>April</th>
							<th>Mei</th>
							<th>Juni</th>
							<th>Juli</th>
							<th>Agustus</th>
							<th>September</th>
							<th>Oktober</th>
							<th>November</th>
							<th>Desember</th>

						</tr>
					</thead>
					<tbody id="tbodyTableRealisasi">

					</tbody>
				</table>
			</div>
		</div>
	</div>



</div>

<script>
	function getDataTable(init, year) {
		// CSRF TOKEN
		var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
			csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
		var dataJson = {
			[csrfName]: csrfHash,
			"year": year
		};
		if (init) {
			$('#dataTable_realisasi').DataTable().destroy();
		}
		$('#dataTable_realisasi').DataTable({
			processing: true,
			serverSide: true,
			// searchable: true,
			ajax: {
				url: 'web/dataTableRealisasi',
				type: 'POST',
				data: dataJson,
				"dataSrc": function(json) {
					// $('.spinnerDataTableTender').hide();
					return json.data;
				},
				// beforeSend: function() {
				// 	$('.spinnerDataTableTender').show();
				// },

			},
		});

	};

	// READY FUNCTION 
	$(function() {
		getDataTable(false, 2022);
	})
</script>