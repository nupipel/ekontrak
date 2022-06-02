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
	<div class="col">
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
	<div class="col">
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
			<table class="table table-striped align-middle mb-0" id="dataTables">
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
			<table class="table table-striped align-middle mb-0" id="dataTables">
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

<!--<div class="row row-cols-1 row-cols-lg-3">-->
<!--	<div class="col">-->
<!--		<div class="card radius-10">-->
<!--			<div class="card-body">-->
<!--				<div class="d-flex align-items-center">-->
<!--					<div class="w_chart easy-dash-chart1" data-percent="60">-->
<!--						<span class="w_percent"></span>-->
<!--					</div>-->
<!--					<div class="ms-3">-->
<!--						<h6 class="mb-0">Facebook Followers</h6>-->
<!--						<small class="mb-0">22.14% <i class='bx bxs-up-arrow align-middle me-1'></i>Since Last Week</small>-->
<!--					</div>-->
<!--					<div class="ms-auto fs-1 text-facebook"><i class='bx bxl-facebook'></i></div>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="col">-->
<!--		<div class="card radius-10">-->
<!--			<div class="card-body">-->
<!--				<div class="d-flex align-items-center">-->
<!--					<div class="w_chart easy-dash-chart2" data-percent="65">-->
<!--						<span class="w_percent"></span>-->
<!--					</div>-->
<!--					<div class="ms-3">-->
<!--						<h6 class="mb-0">Twitter Tweets</h6>-->
<!--						<small class="mb-0">32.15% <i class='bx bxs-up-arrow align-middle me-1'></i>Since Last Week</small>-->
<!--					</div>-->
<!--					<div class="ms-auto fs-1 text-twitter"><i class='bx bxl-twitter'></i></div>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="col">-->
<!--		<div class="card radius-10">-->
<!--			<div class="card-body">-->
<!--				<div class="d-flex align-items-center">-->
<!--					<div class="w_chart easy-dash-chart3" data-percent="75">-->
<!--						<span class="w_percent"></span>-->
<!--					</div>-->
<!--					<div class="ms-3">-->
<!--						<h6 class="mb-0">Youtube Subscribers</h6>-->
<!--						<small class="mb-0">58.24% <i class='bx bxs-up-arrow align-middle me-1'></i>Since Last Week</small>-->
<!--					</div>-->
<!--					<div class="ms-auto fs-1 text-youtube"><i class='bx bxl-youtube'></i></div>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->
<!--End Row-->


<!--<div class="row">-->
<!--	<div class="col-12 col-lg-12 col-xl-6">-->
<!--		<div class="card radius-10">-->
<!--			<div class="card-body">-->
<!--				<div class="d-flex align-items-center mb-3">-->
<!--					<div>-->
<!--						<h6 class="mb-0">World Selling Region</h6>-->
<!--					</div>-->
<!--					<div class="font-22 ms-auto text-white"><i class="bx bx-dots-horizontal-rounded"></i>-->
<!--					</div>-->
<!--				</div>-->
<!--				<div id="dashboard-map" style="height: 330px;"></div>-->
<!--			</div>-->
<!--			<div class="table-responsive">-->
<!--				<table class="table table-hover align-items-center">-->
<!--					<thead class="table-light">-->
<!--						<tr>-->
<!--							<th>Country</th>-->
<!--							<th>Income</th>-->
<!--							<th>Trend</th>-->
<!--						</tr>-->
<!--					</thead>-->
<!--					<tbody>-->
<!--						<tr>-->
<!--							<td><i class="flag-icon flag-icon-ca me-2"></i> USA</td>-->
<!--							<td>$4,586</td>-->
<!--							<td><span id="trendchart1"></span></td>-->
<!--						</tr>-->
<!--						<tr>-->
<!--							<td><i class="flag-icon flag-icon-us me-2"></i>Canada</td>-->
<!--							<td>$2,089</td>-->
<!--							<td><span id="trendchart2"></span></td>-->
<!--						</tr>-->

<!--						<tr>-->
<!--							<td><i class="flag-icon flag-icon-in me-2"></i>India</td>-->
<!--							<td>$3,039</td>-->
<!--							<td><span id="trendchart3"></span></td>-->
<!--						</tr>-->

<!--						<tr>-->
<!--							<td><i class="flag-icon flag-icon-gb me-2"></i>UK</td>-->
<!--							<td>$2,309</td>-->
<!--							<td><span id="trendchart4"></span></td>-->
<!--						</tr>-->

<!--						<tr>-->
<!--							<td><i class="flag-icon flag-icon-de me-2"></i>Germany</td>-->
<!--							<td>$7,209</td>-->
<!--							<td><span id="trendchart5"></span></td>-->
<!--						</tr>-->

<!--					</tbody>-->
<!--				</table>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->

<!--	<div class="col-12 col-lg-12 col-xl-6">-->
<!--		<div class="row">-->
<!--			<div class="col-12 col-lg-6">-->
<!--				<div class="card radius-10 overflow-hidden">-->
<!--					<div class="card-body">-->
<!--						<p>Page Views</p>-->
<!--						<h4 class="mb-0">8,293 <small class="font-13">5.2% <i class="zmdi zmdi-long-arrow-up"></i></small></h4>-->
<!--					</div>-->
<!--					<div class="chart-container-2">-->
<!--						<canvas id="chart3"></canvas>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--			<div class="col-12 col-lg-6">-->
<!--				<div class="card radius-10 overflow-hidden">-->
<!--					<div class="card-body">-->
<!--						<p>Total Clicks</p>-->
<!--						<h4 class="mb-0">7,493 <small class="font-13">1.4% <i class="zmdi zmdi-long-arrow-up"></i></small></h4>-->
<!--					</div>-->
<!--					<div class="chart-container-2">-->
<!--						<canvas id="chart4"></canvas>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--			<div class="col-12 col-lg-6">-->
<!--				<div class="card radius-10">-->
<!--					<div class="card-body text-center">-->
<!--						<p class="mb-4">Total Downloads</p>-->
<!--						<input class="knob" data-width="190" data-height="190" data-readOnly="true" data-thickness=".2" data-angleoffset="90" data-linecap="round" data-bgcolor="rgba(0, 0, 0, 0.08)" data-fgcolor="#843cf7" data-max="15000" value="8550" />-->
<!--						<hr>-->
<!--						<p class="mb-0 small-font text-center">3.4% <i class="zmdi zmdi-long-arrow-up"></i> since yesterday</p>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--			<div class="col-12 col-lg-6">-->
<!--				<div class="card radius-10">-->
<!--					<div class="card-body">-->
<!--						<p>Device Storage</p>-->
<!--						<h4 class="mb-3">42620/50000</h4>-->
<!--						<hr>-->
<!--						<div class="progress-wrapper mb-4">-->
<!--							<p>Documents <span class="float-right">12GB</span></p>-->
<!--							<div class="progress" style="height:5px;">-->
<!--								<div class="progress-bar bg-success" style="width:80%"></div>-->
<!--							</div>-->
<!--						</div>-->

<!--						<div class="progress-wrapper mb-4">-->
<!--							<p>Images <span class="float-right">10GB</span></p>-->
<!--							<div class="progress" style="height:5px;">-->
<!--								<div class="progress-bar bg-danger" style="width:60%"></div>-->
<!--							</div>-->
<!--						</div>-->

<!--						<div class="progress-wrapper mb-4">-->
<!--							<p>Mails <span class="float-right">5GB</span></p>-->
<!--							<div class="progress" style="height:5px;">-->
<!--								<div class="progress-bar bg-primary" style="width:40%"></div>-->
<!--							</div>-->
<!--						</div>-->

<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->
<!--End Row-->

<!--<div class="row">-->
<!--	<div class="col-12 col-lg-6 col-xl-4 d-flex">-->
<!--		<div class="card radius-10 overflow-hidden w-100">-->
<!--			<div class="card-body">-->
<!--				<p>Total Earning</p>-->
<!--				<h4 class="mb-0">$287,493</h4>-->
<!--				<small>1.4% <i class="zmdi zmdi-long-arrow-up"></i> Since Last Month</small>-->
<!--				<hr>-->
<!--				<p>Total Sales</p>-->
<!--				<h4 class="mb-0">$87,493</h4>-->
<!--				<small>5.43% <i class="zmdi zmdi-long-arrow-up"></i> Since Last Month</small>-->
<!--				<div class="mt-5">-->
<!--					<div class="chart-container-4">-->
<!--						<canvas id="chart5"></canvas>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->


<!--</div>-->
<!--End Row-->