<?php
$namaweb = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "https") . "://$_SERVER[HTTP_HOST]" . "/";
// $web=$namaweb.'cc-content/themes/cicool/rukada/';  
$web = base_url() . 'cc-content/themes/cicool/rukada/';
$apikey = '1D3722F472B241DED41E27953A850967';

function isMobile()
{
	return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
function rupiah($angka)
{
	$hasil_rupiah = "Rp. " . number_format($angka, 0, ',', '.');
	return $hasil_rupiah;
}
foreach ($get_infoumum as $key) :
	$nama_sistem = $key['nama_sekolah'];
	$alamat = $key['alamat'];
	$telepon = $key['telepon'];
	$email = $key['email'];
	$fax = $key['fax'];
	$logo = '/uploads/infoumum/' . $key['logo'];
	$facebook = $key['facebook'];
	$twitter = $key['twitter'];
	$instagram = $key['instagram'];
	$youtube = $key['youtube'];
	$peta = $key['peta'];
endforeach;

function tgl_indo($tanggal)
{
	$bulan = array(
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);

	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun

	return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
?>


<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="<?php echo $web; ?>assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="<?php echo $web; ?>assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
	<link href="<?php echo $web; ?>assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="<?php echo $web; ?>assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<!--<link href="<?php echo $web; ?>assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />-->
	<!-- loader-->
	<link href="<?php echo $web; ?>assets/css/pace.min.css" rel="stylesheet" />
	<script src="<?php echo $web; ?>assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="<?php echo $web; ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo $web; ?>assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="<?php echo $web; ?>assets/css/app.css" rel="stylesheet">
	<link href="<?php echo $web; ?>assets/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="<?php echo $web; ?>assets/css/dark-theme.css" />
	<link rel="stylesheet" href="<?php echo $web; ?>assets/css/semi-dark.css" />
	<link rel="stylesheet" href="<?php echo $web; ?>assets/css/header-colors.css" />
	<!-- jQuery  -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
	<script src="<?php echo $web; ?>assets/js/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
	<!-- DATATABLES -->
	<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css"> -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
	<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

	<!-- converter to rupiah  -->
	<script src="https://unpkg.com/@develoka/angka-rupiah-js/index.min.js"></script>


	<!-- loadingOverlay  -->
	<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

	<title>Ekontrak</title>

	<style>
		.active {
			color: white !important;
		}
	</style>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--start header wrapper-->
		<div class="header-wrapper">
			<!--start header -->
			<header>
				<div class="topbar d-flex align-items-center">
					<nav class="navbar navbar-expand">
						<div class="topbar-logo-header">
							<div class="">
								<img src="<?php echo $web; ?>assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
							</div>
							<div class="">
								<h4 class="logo-text">E-Kontrak Kota Semarang</h4>
							</div>
						</div>
						<div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>
						<div class="search-bar flex-grow-1">
							<!--<div class="position-relative search-bar-box">-->
							<!--	<input type="text" class="form-control search-control" placeholder="Type to search..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>-->
							<!--	<span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>-->
							<!--</div>-->
						</div>
						<div class="top-menu ms-auto">

						</div>

					</nav>
				</div>
			</header>
			<!--end header -->
			<!--navigation-->
			<div class="nav-container primary-menu">
				<div class="mobile-topbar-header">
					<div>
						<img src="<?php echo $web; ?>assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
					</div>
					<div>
						<h4 class="logo-text">E-Kontrak</h4>
					</div>
					<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
					</div>
				</div>
				<nav class="navbar navbar-expand-xl w-100">
					<ul class="navbar-nav justify-content-start flex-grow-1 gap-1">


						<li class="nav-item ">
							<a class="nav-link <?= $container == 'beranda' ? 'active' : ''; ?>" href="<?= base_url(); ?>">
								<div class="parent-icon"><i class='bx bx-home-alt'></i>
								</div>
								<div class="menu-title">APBD</div>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?= $container == 'pengadaan' ? 'active' : ''; ?>" href="<?= base_url(); ?>web/pengadaan">
								<div class="parent-icon"><i class='bx bx-briefcase-alt'></i>
								</div>
								<div class="menu-title">Pelelangan</div>
							</a>
						</li>



						<li class="nav-item">
							<a class="nav-link <?= $container == 'monev' ? 'active' : ''; ?>" href="<?= base_url(); ?>web/monev">
								<div class="parent-icon"><i class='bx bx-copy-alt'></i>
								</div>
								<div class="menu-title">Monev</div>
							</a>
						</li>

					</ul>
				</nav>
			</div>
			<!--end navigation-->
		</div>
		<!--end header wrapper-->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">

				<?= $this->template->build($container); ?>

			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
			<p class="mb-0">Copyright © 2022. All right reserved.</p>
		</footer>
	</div>
	<!--end wrapper-->
	<!--start switcher-->
	<div class="switcher-wrapper">
		<div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
		</div>
		<div class="switcher-body">
			<div class="d-flex align-items-center">
				<h5 class="mb-0 text-uppercase">Theme Customizer</h5>
				<button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
			</div>
			<hr />
			<h6 class="mb-0">Theme Styles</h6>
			<hr />
			<div class="d-flex align-items-center justify-content-between">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked>
					<label class="form-check-label" for="lightmode">Light</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
					<label class="form-check-label" for="darkmode">Dark</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark">
					<label class="form-check-label" for="semidark">Semi Dark</label>
				</div>
			</div>
			<hr />
			<div class="form-check">
				<input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
				<label class="form-check-label" for="minimaltheme">Minimal Theme</label>
			</div>
			<hr />
			<h6 class="mb-0">Header Colors</h6>
			<hr />
			<div class="header-colors-indigators">
				<div class="row row-cols-auto g-3">
					<div class="col">
						<div class="indigator headercolor1" id="headercolor1"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor2" id="headercolor2"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor3" id="headercolor3"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor4" id="headercolor4"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor5" id="headercolor5"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor6" id="headercolor6"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor7" id="headercolor7"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor8" id="headercolor8"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src="<?php echo $web; ?>assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="<?php echo $web; ?>assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="<?php echo $web; ?>assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="<?php echo $web; ?>assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="<?php echo $web; ?>assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
	<script src="<?php echo $web; ?>assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="<?php echo $web; ?>assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="<?php echo $web; ?>assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
	<script src="<?php echo $web; ?>assets/plugins/jquery-knob/excanvas.js"></script>
	<script src="<?php echo $web; ?>assets/plugins/jquery-knob/jquery.knob.js"></script>
	<script src="<?php echo $web; ?>assets/plugins/chartjs/js/Chart.min.js"></script>
	<script src="<?php echo $web; ?>assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="<?php echo $web; ?>assets/js/index.js"></script>
	<script src="<?php echo $web; ?>assets/js/app.js"></script>


</body>

</html>