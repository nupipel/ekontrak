

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
						<label for="inputToDate" class="col-form-label">Tahun <?php $url= $_SERVER['REQUEST_URI']; ?></label>
						<div class="col-md-4">
							<!--<input type="text" class="form-control" id="inputToDate">-->
							<select class="form-control" name="tahun" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
							    <option value="">== Pilih Tahun ==</option>
							     <option value="/web/realisasi/2019" <?php if($url =='/web/realisasi/2019'){ echo 'selected=""';} ?>>Tahun 2019</option>
							      <option value="/web/realisasi/2020" <?php if($url =='/web/realisasi/2020'){ echo 'selected=""';} ?>>Tahun 2020</option>
							       <option value="/web/realisasi/2021" <?php if($url =='/web/realisasi/2021'){ echo 'selected=""';} ?>>Tahun 2021</option>
							        <option value="/web/realisasi/2022" <?php if($url =='/web/realisasi/2022'){ echo 'selected=""';} ?>>Tahun 2022</option>
							</select>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
		<div class="table-responsive">
			<table class="table table-striped align-middle mb-0" id="dataTables_apbd">
				<thead class="table-light">
					<tr>
						<th>No.</th>
							<th>Tahun</th>
						<th>Nama OPD</th>
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
				<tbody id="dataTables_apbd_opd">

				</tbody>
			</table>
		</div>
	</div>
</div>



</div>


<script>

<?php 
if($url =='/web/realisasi/2019'){ $ambil =base_url('web/clistrealisasi_OPD/2019');}
if($url =='/web/realisasi/2020'){ $ambil =base_url('web/clistrealisasi_OPD/2020');}
if($url =='/web/realisasi/2021'){ $ambil =base_url('web/clistrealisasi_OPD/2021');}
if($url =='/web/realisasi/2022'){ $ambil =base_url('web/clistrealisasi_OPD/2022');}
    
    

?>
	$(function() {
		// $(".knob").knob();
		//table apbd
		$.ajax({
			url: "<?php echo $ambil; ?>",
			type: "GET",
			dataType: "JSON",
			success: function(res) {
				var target = $('#dataTables_apbd_opd');
				var html;
				var no = 1;

				$.each(res, function(i, val) {
					html = "<tr>" +
						"<th>" + no + "</th>" +
						"<th>" + val.tahun + "</th>" +
						"<td>" + val.nama_skpd + "</td>" +
						"<td>" + toRupiah(val.anggaran, {
							floatingPoint: 0
						}) + "</td>" +
						"<td>" + toRupiah(val.perubahan, {
							floatingPoint: 0
						}) + "</td>" +
							"<td>" + toRupiah(val.jml_realisasi, {
							floatingPoint: 0
						}) + "</td>" +
						"<td>" + toRupiah(val.januari, {
							floatingPoint: 0
						}) + "</td>" +
						"<td>" + toRupiah(val.februari, {
							floatingPoint: 0
						}) + "</td>" +
						"<td>" + toRupiah(val.maret, {
							floatingPoint: 0
						}) + "</td>" +
						"<td>" + toRupiah(val.april, {
							floatingPoint: 0
						}) + "</td>" +
						"<td>" + toRupiah(val.mei, {
							floatingPoint: 0
						}) + "</td>" +
						"<td>" + toRupiah(val.juni, {
							floatingPoint: 0
						}) + "</td>" +
						"<td>" + toRupiah(val.juli, {
							floatingPoint: 0
						}) + "</td>" +
						"<td>" + toRupiah(val.agustus, {
							floatingPoint: 0
						}) + "</td>" +
						"<td>" + toRupiah(val.september, {
							floatingPoint: 0
						}) + "</td>" +
							"<td>" + toRupiah(val.oktober, {
							floatingPoint: 0
						}) + "</td>" +
						"<td>" + toRupiah(val.nopember, {
							floatingPoint: 0
						}) + "</td>" +
						"<td>" + toRupiah(val.desember, {
							floatingPoint: 0
						}) + "</td>" +
					
					
						"</tr>";
					target.append(html);
					no++;
				});
				$('#dataTables_apbd').DataTable();
			}
		});

	

	});
</script>