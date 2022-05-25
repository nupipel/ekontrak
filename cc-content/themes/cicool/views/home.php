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
	<title>Rukada - Responsive Bootstrap 5 Admin Template</title>


	<!-- DATATABLES -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
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
								<h4 class="logo-text">Rukada</h4>
							</div>
						</div>
						<div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>
						<div class="search-bar flex-grow-1">
							<div class="position-relative search-bar-box">
								<input type="text" class="form-control search-control" placeholder="Type to search..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
								<span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
							</div>
						</div>
						<div class="top-menu ms-auto">
							<ul class="navbar-nav align-items-center">
								<li class="nav-item mobile-search-icon">
									<a class="nav-link" href="#"> <i class='bx bx-search'></i>
									</a>
								</li>
								<li class="nav-item dropdown dropdown-large">
									<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <i class='bx bx-category'></i>
									</a>
									<div class="dropdown-menu dropdown-menu-end">
										<div class="row row-cols-3 g-3 p-3">
											<div class="col text-center">
												<div class="app-box mx-auto bg-gradient-cosmic text-white"><i class='bx bx-group'></i>
												</div>
												<div class="app-title">Teams</div>
											</div>
											<div class="col text-center">
												<div class="app-box mx-auto bg-gradient-burning text-white"><i class='bx bx-atom'></i>
												</div>
												<div class="app-title">Projects</div>
											</div>
											<div class="col text-center">
												<div class="app-box mx-auto bg-gradient-lush text-white"><i class='bx bx-shield'></i>
												</div>
												<div class="app-title">Tasks</div>
											</div>
											<div class="col text-center">
												<div class="app-box mx-auto bg-gradient-kyoto text-dark"><i class='bx bx-notification'></i>
												</div>
												<div class="app-title">Feeds</div>
											</div>
											<div class="col text-center">
												<div class="app-box mx-auto bg-gradient-blues text-dark"><i class='bx bx-file'></i>
												</div>
												<div class="app-title">Files</div>
											</div>
											<div class="col text-center">
												<div class="app-box mx-auto bg-gradient-moonlit text-white"><i class='bx bx-filter-alt'></i>
												</div>
												<div class="app-title">Alerts</div>
											</div>
										</div>
									</div>
								</li>
								<li class="nav-item dropdown dropdown-large">
									<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">7</span>
										<i class='bx bx-bell'></i>
									</a>
									<div class="dropdown-menu dropdown-menu-end">
										<a href="javascript:;">
											<div class="msg-header">
												<p class="msg-header-title">Notifications</p>
												<p class="msg-header-clear ms-auto">Marks all as read</p>
											</div>
										</a>
										<div class="header-notifications-list">
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="notify bg-light-primary text-primary"><i class="bx bx-group"></i>
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">New Customers<span class="msg-time float-end">14 Sec
																ago</span></h6>
														<p class="msg-info">5 new user registered</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="notify bg-light-danger text-danger"><i class="bx bx-cart-alt"></i>
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">New Orders <span class="msg-time float-end">2 min
																ago</span></h6>
														<p class="msg-info">You have recived new orders</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="notify bg-light-success text-success"><i class="bx bx-file"></i>
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">24 PDF File<span class="msg-time float-end">19 min
																ago</span></h6>
														<p class="msg-info">The pdf files generated</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="notify bg-light-warning text-warning"><i class="bx bx-send"></i>
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">Time Response <span class="msg-time float-end">28 min
																ago</span></h6>
														<p class="msg-info">5.1 min avarage time response</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="notify bg-light-info text-info"><i class="bx bx-home-circle"></i>
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">New Product Approved <span class="msg-time float-end">2 hrs ago</span></h6>
														<p class="msg-info">Your new product has approved</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="notify bg-light-danger text-danger"><i class="bx bx-message-detail"></i>
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">New Comments <span class="msg-time float-end">4 hrs
																ago</span></h6>
														<p class="msg-info">New customer comments recived</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="notify bg-light-success text-success"><i class='bx bx-check-square'></i>
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">Your item is shipped <span class="msg-time float-end">5 hrs
																ago</span></h6>
														<p class="msg-info">Successfully shipped your item</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="notify bg-light-primary text-primary"><i class='bx bx-user-pin'></i>
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">New 24 authors<span class="msg-time float-end">1 day
																ago</span></h6>
														<p class="msg-info">24 new authors joined last week</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="notify bg-light-warning text-warning"><i class='bx bx-door-open'></i>
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">Defense Alerts <span class="msg-time float-end">2 weeks
																ago</span></h6>
														<p class="msg-info">45% less alerts last 4 weeks</p>
													</div>
												</div>
											</a>
										</div>
										<a href="javascript:;">
											<div class="text-center msg-footer">View All Notifications</div>
										</a>
									</div>
								</li>
								<li class="nav-item dropdown dropdown-large">
									<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">8</span>
										<i class='bx bx-comment'></i>
									</a>
									<div class="dropdown-menu dropdown-menu-end">
										<a href="javascript:;">
											<div class="msg-header">
												<p class="msg-header-title">Messages</p>
												<p class="msg-header-clear ms-auto">Marks all as read</p>
											</div>
										</a>
										<div class="header-message-list">
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="user-online">
														<img src="<?php echo $web; ?>assets/images/avatars/avatar-1.png" class="msg-avatar" alt="user avatar">
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">Daisy Anderson <span class="msg-time float-end">5 sec
																ago</span></h6>
														<p class="msg-info">The standard chunk of lorem</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="user-online">
														<img src="<?php echo $web; ?>assets/images/avatars/avatar-2.png" class="msg-avatar" alt="user avatar">
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">Althea Cabardo <span class="msg-time float-end">14
																sec ago</span></h6>
														<p class="msg-info">Many desktop publishing packages</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="user-online">
														<img src="<?php echo $web; ?>assets/images/avatars/avatar-3.png" class="msg-avatar" alt="user avatar">
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">Oscar Garner <span class="msg-time float-end">8 min
																ago</span></h6>
														<p class="msg-info">Various versions have evolved over</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="user-online">
														<img src="<?php echo $web; ?>assets/images/avatars/avatar-4.png" class="msg-avatar" alt="user avatar">
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">Katherine Pechon <span class="msg-time float-end">15
																min ago</span></h6>
														<p class="msg-info">Making this the first true generator</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="user-online">
														<img src="<?php echo $web; ?>assets/images/avatars/avatar-5.png" class="msg-avatar" alt="user avatar">
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">Amelia Doe <span class="msg-time float-end">22 min
																ago</span></h6>
														<p class="msg-info">Duis aute irure dolor in reprehenderit</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="user-online">
														<img src="<?php echo $web; ?>assets/images/avatars/avatar-6.png" class="msg-avatar" alt="user avatar">
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">Cristina Jhons <span class="msg-time float-end">2 hrs
																ago</span></h6>
														<p class="msg-info">The passage is attributed to an unknown</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="user-online">
														<img src="<?php echo $web; ?>assets/images/avatars/avatar-7.png" class="msg-avatar" alt="user avatar">
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">James Caviness <span class="msg-time float-end">4 hrs
																ago</span></h6>
														<p class="msg-info">The point of using Lorem</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="user-online">
														<img src="<?php echo $web; ?>assets/images/avatars/avatar-8.png" class="msg-avatar" alt="user avatar">
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">Peter Costanzo <span class="msg-time float-end">6 hrs
																ago</span></h6>
														<p class="msg-info">It was popularised in the 1960s</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="user-online">
														<img src="<?php echo $web; ?>assets/images/avatars/avatar-9.png" class="msg-avatar" alt="user avatar">
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">David Buckley <span class="msg-time float-end">2 hrs
																ago</span></h6>
														<p class="msg-info">Various versions have evolved over</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="user-online">
														<img src="<?php echo $web; ?>assets/images/avatars/avatar-10.png" class="msg-avatar" alt="user avatar">
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">Thomas Wheeler <span class="msg-time float-end">2 days
																ago</span></h6>
														<p class="msg-info">If you are going to use a passage</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="user-online">
														<img src="<?php echo $web; ?>assets/images/avatars/avatar-11.png" class="msg-avatar" alt="user avatar">
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">Johnny Seitz <span class="msg-time float-end">5 days
																ago</span></h6>
														<p class="msg-info">All the Lorem Ipsum generators</p>
													</div>
												</div>
											</a>
										</div>
										<a href="javascript:;">
											<div class="text-center msg-footer">View All Messages</div>
										</a>
									</div>
								</li>
							</ul>
						</div>
						<div class="user-box dropdown">
							<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<img src="<?php echo $web; ?>assets/images/avatars/avatar-2.png" class="user-img" alt="user avatar">
								<div class="user-info ps-3">
									<p class="user-name mb-0">Pauline Seitz</p>
									<p class="designattion mb-0">Web Designer</p>
								</div>
							</a>
							<ul class="dropdown-menu dropdown-menu-end">
								<li><a class="dropdown-item" href="javascript:;"><i class="bx bx-user"></i><span>Profile</span></a>
								</li>
								<li><a class="dropdown-item" href="javascript:;"><i class="bx bx-cog"></i><span>Settings</span></a>
								</li>
								<li><a class="dropdown-item" href="javascript:;"><i class='bx bx-home-circle'></i><span>Dashboard</span></a>
								</li>
								<li><a class="dropdown-item" href="javascript:;"><i class='bx bx-dollar-circle'></i><span>Earnings</span></a>
								</li>
								<li><a class="dropdown-item" href="javascript:;"><i class='bx bx-download'></i><span>Downloads</span></a>
								</li>
								<li>
									<div class="dropdown-divider mb-0"></div>
								</li>
								<li><a class="dropdown-item" href="javascript:;"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
								</li>
							</ul>
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
						<h4 class="logo-text">Rukada</h4>
					</div>
					<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
					</div>
				</div>
				<nav class="navbar navbar-expand-xl w-100">
					<ul class="navbar-nav justify-content-start flex-grow-1 gap-1">
						<li class="nav-item dropdown">
							<a href="javascript:;" class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
								<div class="parent-icon"><i class='bx bx-home-circle'></i>
								</div>
								<div class="menu-title">Dashboard</div>
							</a>
							<ul class="dropdown-menu">
								<li> <a class="dropdown-item" href="index.html"><i class="bx bx-right-arrow-alt"></i>Default</a>
								</li>
								<li> <a class="dropdown-item" href="dashboard-eCommerce.html"><i class="bx bx-right-arrow-alt"></i>eCommerce</a>
								</li>
								<li> <a class="dropdown-item" href="dashboard-analytics.html"><i class="bx bx-right-arrow-alt"></i>Analytics</a>
								</li>
								<li> <a class="dropdown-item" href="dashboard-digital-marketing.html"><i class="bx bx-right-arrow-alt"></i>Digital Marketing</a>
								</li>
								<li> <a class="dropdown-item" href="dashboard-human-resources.html"><i class="bx bx-right-arrow-alt"></i>Human Resources</a>
								</li>
							</ul>
						</li>
						<li class="nav-item dropdown">
							<a href="javascript:;" class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
								<div class="parent-icon"><i class='bx bx-cart'></i>
								</div>
								<div class="menu-title">eCommerce</div>
							</a>
							<ul class="dropdown-menu">
								<li> <a class="dropdown-item" href="ecommerce-products.html"><i class="bx bx-right-arrow-alt"></i>Products</a>
								</li>
								<li> <a class="dropdown-item" href="ecommerce-products-details.html"><i class="bx bx-right-arrow-alt"></i>Product Details</a>
								</li>
								<li> <a class="dropdown-item" href="ecommerce-add-new-products.html"><i class="bx bx-right-arrow-alt"></i>Add New Products</a>
								</li>
								<li> <a class="dropdown-item" href="ecommerce-orders.html"><i class="bx bx-right-arrow-alt"></i>Orders</a>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="widgets.html">
								<div class="parent-icon"><i class='bx bx-cookie'></i>
								</div>
								<div class="menu-title">Widgets</div>
							</a>
						</li>
						<li class="nav-item dropdown">
							<a href="javascript:;" class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
								<div class="parent-icon"><i class="bx bx-category"></i>
								</div>
								<div class="menu-title">Application</div>
							</a>
							<ul class="dropdown-menu">
								<li> <a class="dropdown-item" href="app-emailbox.html"><i class="bx bx-right-arrow-alt"></i>Email</a>
								</li>
								<li> <a class="dropdown-item" href="app-chat-box.html"><i class="bx bx-right-arrow-alt"></i>Chat Box</a>
								</li>
								<li> <a class="dropdown-item" href="app-file-manager.html"><i class="bx bx-right-arrow-alt"></i>File Manager</a>
								</li>
								<li> <a class="dropdown-item" href="app-contact-list.html"><i class="bx bx-right-arrow-alt"></i>Contatcs</a>
								</li>
								<li> <a class="dropdown-item" href="app-to-do.html"><i class="bx bx-right-arrow-alt"></i>Todo List</a>
								</li>
								<li> <a class="dropdown-item" href="app-invoice.html"><i class="bx bx-right-arrow-alt"></i>Invoice</a>
								</li>
								<li> <a class="dropdown-item" href="app-fullcalender.html"><i class="bx bx-right-arrow-alt"></i>Calendar</a>
								</li>
							</ul>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
								<div class="parent-icon"><i class="bx bx-line-chart"></i>
								</div>
								<div class="menu-title">Charts</div>
							</a>
							<ul class="dropdown-menu">
								<li> <a class="dropdown-item" href="charts-apex-chart.html"><i class="bx bx-right-arrow-alt"></i>Apex</a>
								</li>
								<li> <a class="dropdown-item" href="charts-chartjs.html"><i class="bx bx-right-arrow-alt"></i>Chartjs</a>
								</li>
								<li> <a class="dropdown-item" href="charts-highcharts.html"><i class="bx bx-right-arrow-alt"></i>Highcharts</a>
								</li>
							</ul>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
								<div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
								</div>
								<div class="menu-title">Components</div>
							</a>
							<ul class="dropdown-menu">
								<li> <a class="dropdown-item" href="widgets.html"><i class="bx bx-right-arrow-alt"></i>Widgets</a>
								</li>
								<li> <a class="dropdown-item" href="component-alerts.html"><i class="bx bx-right-arrow-alt"></i>Alerts</a>
								</li>
								<li> <a class="dropdown-item" href="component-accordions.html"><i class="bx bx-right-arrow-alt"></i>Accordions</a>
								</li>
								<li> <a class="dropdown-item" href="component-buttons.html"><i class="bx bx-right-arrow-alt"></i>Buttons</a>
								</li>
								<li> <a class="dropdown-item" href="component-cards.html"><i class="bx bx-right-arrow-alt"></i>Cards</a>
								</li>
								<li> <a class="dropdown-item" href="component-list-groups.html"><i class="bx bx-right-arrow-alt"></i>List Groups</a>
								</li>
								<li> <a class="dropdown-item" href="component-media-object.html"><i class="bx bx-right-arrow-alt"></i>Media Objects</a>
								</li>
								<li> <a class="dropdown-item" href="component-modals.html"><i class="bx bx-right-arrow-alt"></i>Modals</a>
								</li>
								<li> <a class="dropdown-item" href="component-navs-tabs.html"><i class="bx bx-right-arrow-alt"></i>Navs & Tabs</a>
								</li>
								<li> <a class="dropdown-item" href="component-navbar.html"><i class="bx bx-right-arrow-alt"></i>Navbar</a>
								</li>
								<li> <a class="dropdown-item" href="component-popovers-tooltips.html"><i class="bx bx-right-arrow-alt"></i>Popovers & Tooltips</a>
								</li>
								<li> <a class="dropdown-item" href="component-progress-bars.html"><i class="bx bx-right-arrow-alt"></i>Progress</a>
								</li>
								<li> <a class="dropdown-item" href="component-spinners.html"><i class="bx bx-right-arrow-alt"></i>Spinners</a>
								</li>
								<li> <a class="dropdown-item" href="component-notifications.html"><i class="bx bx-right-arrow-alt"></i>Notifications</a>
								</li>
								<li> <a class="dropdown-item" href="component-avtars-chips.html"><i class="bx bx-right-arrow-alt"></i>Avatrs & Chips</a>
								</li>
							</ul>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
								<div class="parent-icon"><i class="bx bx-lock"></i>
								</div>
								<div class="menu-title">Authentication</div>
							</a>
							<ul class="dropdown-menu">
								<li> <a class="dropdown-item" href="authentication-signin.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Sign In</a>
								</li>
								<li> <a class="dropdown-item" href="authentication-signup.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Sign Up</a>
								</li>
								<li> <a class="dropdown-item" href="authentication-signin-with-header-footer.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Sign In with Header & Footer</a>
								</li>
								<li> <a class="dropdown-item" href="authentication-signup-with-header-footer.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Sign Up with Header & Footer</a>
								</li>
								<li> <a class="dropdown-item" href="authentication-forgot-password.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Forgot Password</a>
								</li>
								<li> <a class="dropdown-item" href="authentication-reset-password.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Reset Password</a>
								</li>
								<li> <a class="dropdown-item" href="authentication-lock-screen.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Lock Screen</a>
								</li>
							</ul>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
								<div class="parent-icon"><i class="bx bx-donate-blood"></i>
								</div>
								<div class="menu-title">Pages</div>
							</a>
							<ul class="dropdown-menu">
								<li> <a class="dropdown-item" href="user-profile.html"><i class="bx bx-right-arrow-alt"></i>User Profile</a>
								</li>
								<li> <a class="dropdown-item" href="timeline.html"><i class="bx bx-right-arrow-alt"></i>Timeline</a>
								</li>
								<li> <a class="dropdown-item" href="pricing-table.html"><i class="bx bx-right-arrow-alt"></i>Pricing</a>
								</li>
								<li> <a class="dropdown-item" href="errors-404-error.html"><i class="bx bx-right-arrow-alt"></i>404 Error</a>
								</li>
								<li> <a class="dropdown-item" href="errors-500-error.html"><i class="bx bx-right-arrow-alt"></i>500 Error</a>
								</li>
								<li> <a class="dropdown-item" href="errors-coming-soon.html"><i class="bx bx-right-arrow-alt"></i>Coming Soon</a>
								</li>
							</ul>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
								<div class="parent-icon"><i class="bx bx-message-square-edit"></i>
								</div>
								<div class="menu-title">Forms</div>
							</a>
							<ul class="dropdown-menu">
								<li> <a class="dropdown-item" href="form-elements.html"><i class="bx bx-right-arrow-alt"></i>Form Elements</a>
								</li>
								<li> <a class="dropdown-item" href="form-input-group.html"><i class="bx bx-right-arrow-alt"></i>Input Groups</a>
								</li>
								<li> <a class="dropdown-item" href="form-layouts.html"><i class="bx bx-right-arrow-alt"></i>Forms Layouts</a>
								</li>
								<li> <a class="dropdown-item" href="form-validations.html"><i class="bx bx-right-arrow-alt"></i>Form Validation</a>
								</li>
								<li> <a class="dropdown-item" href="form-wizard.html"><i class="bx bx-right-arrow-alt"></i>Form Wizard</a>
								</li>
								<li> <a class="dropdown-item" href="form-text-editor.html"><i class="bx bx-right-arrow-alt"></i>Text Editor</a>
								</li>
								<li> <a class="dropdown-item" href="form-file-upload.html"><i class="bx bx-right-arrow-alt"></i>File Upload</a>
								</li>
								<li> <a class="dropdown-item" href="form-date-time-pickes.html"><i class="bx bx-right-arrow-alt"></i>Date Pickers</a>
								</li>
								<li> <a class="dropdown-item" href="form-select2.html"><i class="bx bx-right-arrow-alt"></i>Select2</a>
								</li>
							</ul>
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
									<p class="mb-0 ms-auto">+4.2%<span><i class="bx bx-up-arrow-alt"></i></span></p>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<h5 class="mb-0 text-success">$8323</h5>
									<div class="ms-auto">
										<i class="bx bx-dollar fs-3 text-success"></i>
									</div>
								</div>
								<div class="progress my-2" style="height:4px;">
									<div class="progress-bar bg-success" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								<div class="d-flex align-items-center">
									<p class="mb-0">Total Pendapatan</p>
									<p class="mb-0 ms-auto">+1.2%<span><i class="bx bx-up-arrow-alt"></i></span></p>
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


					<div class="col-12 col-xl-5 d-flex">
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


					<div class="col-12 col-xl-7 d-flex">
						<div class="card radius-10 w-100">
							<div class="card-header border-bottom bg-transparent">
								<div class="d-flex align-items-center">
									<div>
										<h6 class="mb-0">Customer Review</h6>
									</div>
									<div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
									</div>
								</div>
							</div>
							<ul class="list-group list-group-flush">
								<li class="list-group-item bg-transparent">
									<div class="d-flex align-items-center">
										<img src="<?php echo $web; ?>assets/images/avatars/avatar-1.png" alt="user avatar" class="rounded-circle" width="55" height="55">
										<div class="ms-3">
											<h6 class="mb-0">iPhone X <small class="ms-4">08.34 AM</small></h6>
											<p class="mb-0 small-font">Sara Jhon : This is svery Nice phone in low budget.</p>
										</div>
										<div class="ms-auto star">
											<i class='bx bxs-star text-warning'></i>
											<i class='bx bxs-star text-warning'></i>
											<i class='bx bxs-star text-warning'></i>
											<i class='bx bxs-star text-light-4'></i>
											<i class='bx bxs-star text-light-4'></i>
										</div>
									</div>
								</li>
								<li class="list-group-item bg-transparent">
									<div class="d-flex align-items-center">
										<img src="<?php echo $web; ?>assets/images/avatars/avatar-2.png" alt="user avatar" class="rounded-circle" width="55" height="55">
										<div class="ms-3">
											<h6 class="mb-0">Air Pod <small class="ml-4">05.26 PM</small></h6>
											<p class="mb-0 small-font">Danish Josh : The brand apple is original !</p>
										</div>
										<div class="ms-auto star">
											<i class='bx bxs-star text-warning'></i>
											<i class='bx bxs-star text-warning'></i>
											<i class='bx bxs-star text-warning'></i>
											<i class='bx bxs-star text-light-4'></i>
											<i class='bx bxs-star text-light-4'></i>
										</div>
									</div>
								</li>
								<li class="list-group-item bg-transparent">
									<div class="d-flex align-items-center">
										<img src="<?php echo $web; ?>assets/images/avatars/avatar-3.png" alt="user avatar" class="rounded-circle" width="55" height="55">
										<div class="ms-3">
											<h6 class="mb-0">Mackbook Pro <small class="ml-4">06.45 AM</small></h6>
											<p class="mb-0 small-font">Jhon Doe : Excllent product and awsome quality</p>
										</div>
										<div class="ms-auto star">
											<i class='bx bxs-star text-warning'></i>
											<i class='bx bxs-star text-warning'></i>
											<i class='bx bxs-star text-warning'></i>
											<i class='bx bxs-star text-light-4'></i>
											<i class='bx bxs-star text-light-4'></i>
										</div>
									</div>
								</li>
								<li class="list-group-item bg-transparent">
									<div class="d-flex align-items-center">
										<img src="<?php echo $web; ?>assets/images/avatars/avatar-4.png" alt="user avatar" class="rounded-circle" width="55" height="55">
										<div class="ms-3">
											<h6 class="mb-0">Air Pod <small class="ml-4">08.34 AM</small></h6>
											<p class="mb-0 small-font">Christine : The brand apple is original !</p>
										</div>
										<div class="ms-auto star">
											<i class='bx bxs-star text-warning'></i>
											<i class='bx bxs-star text-warning'></i>
											<i class='bx bxs-star text-warning'></i>
											<i class='bx bxs-star text-light-4'></i>
											<i class='bx bxs-star text-light-4'></i>
										</div>
									</div>
								</li>
								<li class="list-group-item bg-transparent">
									<div class="d-flex align-items-center">
										<img src="<?php echo $web; ?>assets/images/avatars/avatar-7.png" alt="user avatar" class="rounded-circle" width="55" height="55">
										<div class="ms-3">
											<h6 class="mb-0">Mackbook <small class="ml-4">08.34 AM</small></h6>
											<p class="mb-0 small-font">Michle : The brand apple is original !</p>
										</div>
										<div class="ms-auto star">
											<i class='bx bxs-star text-warning'></i>
											<i class='bx bxs-star text-warning'></i>
											<i class='bx bxs-star text-warning'></i>
											<i class='bx bxs-star text-light-4'></i>
											<i class='bx bxs-star text-light-4'></i>
										</div>
									</div>
								</li>
							</ul>
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

				<div class="row row-cols-1 row-cols-lg-3">
					<div class="col">
						<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div class="w_chart easy-dash-chart1" data-percent="60">
										<span class="w_percent"></span>
									</div>
									<div class="ms-3">
										<h6 class="mb-0">Facebook Followers</h6>
										<small class="mb-0">22.14% <i class='bx bxs-up-arrow align-middle me-1'></i>Since Last Week</small>
									</div>
									<div class="ms-auto fs-1 text-facebook"><i class='bx bxl-facebook'></i></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div class="w_chart easy-dash-chart2" data-percent="65">
										<span class="w_percent"></span>
									</div>
									<div class="ms-3">
										<h6 class="mb-0">Twitter Tweets</h6>
										<small class="mb-0">32.15% <i class='bx bxs-up-arrow align-middle me-1'></i>Since Last Week</small>
									</div>
									<div class="ms-auto fs-1 text-twitter"><i class='bx bxl-twitter'></i></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div class="w_chart easy-dash-chart3" data-percent="75">
										<span class="w_percent"></span>
									</div>
									<div class="ms-3">
										<h6 class="mb-0">Youtube Subscribers</h6>
										<small class="mb-0">58.24% <i class='bx bxs-up-arrow align-middle me-1'></i>Since Last Week</small>
									</div>
									<div class="ms-auto fs-1 text-youtube"><i class='bx bxl-youtube'></i></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--End Row-->


				<div class="row">
					<div class="col-12 col-lg-12 col-xl-6">
						<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center mb-3">
									<div>
										<h6 class="mb-0">World Selling Region</h6>
									</div>
									<div class="font-22 ms-auto text-white"><i class="bx bx-dots-horizontal-rounded"></i>
									</div>
								</div>
								<div id="dashboard-map" style="height: 330px;"></div>
							</div>
							<div class="table-responsive">
								<table class="table table-hover align-items-center">
									<thead class="table-light">
										<tr>
											<th>Country</th>
											<th>Income</th>
											<th>Trend</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><i class="flag-icon flag-icon-ca me-2"></i> USA</td>
											<td>$4,586</td>
											<td><span id="trendchart1"></span></td>
										</tr>
										<tr>
											<td><i class="flag-icon flag-icon-us me-2"></i>Canada</td>
											<td>$2,089</td>
											<td><span id="trendchart2"></span></td>
										</tr>

										<tr>
											<td><i class="flag-icon flag-icon-in me-2"></i>India</td>
											<td>$3,039</td>
											<td><span id="trendchart3"></span></td>
										</tr>

										<tr>
											<td><i class="flag-icon flag-icon-gb me-2"></i>UK</td>
											<td>$2,309</td>
											<td><span id="trendchart4"></span></td>
										</tr>

										<tr>
											<td><i class="flag-icon flag-icon-de me-2"></i>Germany</td>
											<td>$7,209</td>
											<td><span id="trendchart5"></span></td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="col-12 col-lg-12 col-xl-6">
						<div class="row">
							<div class="col-12 col-lg-6">
								<div class="card radius-10 overflow-hidden">
									<div class="card-body">
										<p>Page Views</p>
										<h4 class="mb-0">8,293 <small class="font-13">5.2% <i class="zmdi zmdi-long-arrow-up"></i></small></h4>
									</div>
									<div class="chart-container-2">
										<canvas id="chart3"></canvas>
									</div>
								</div>
							</div>
							<div class="col-12 col-lg-6">
								<div class="card radius-10 overflow-hidden">
									<div class="card-body">
										<p>Total Clicks</p>
										<h4 class="mb-0">7,493 <small class="font-13">1.4% <i class="zmdi zmdi-long-arrow-up"></i></small></h4>
									</div>
									<div class="chart-container-2">
										<canvas id="chart4"></canvas>
									</div>
								</div>
							</div>
							<div class="col-12 col-lg-6">
								<div class="card radius-10">
									<div class="card-body text-center">
										<p class="mb-4">Total Downloads</p>
										<input class="knob" data-width="190" data-height="190" data-readOnly="true" data-thickness=".2" data-angleoffset="90" data-linecap="round" data-bgcolor="rgba(0, 0, 0, 0.08)" data-fgcolor="#843cf7" data-max="15000" value="8550" />
										<hr>
										<p class="mb-0 small-font text-center">3.4% <i class="zmdi zmdi-long-arrow-up"></i> since yesterday</p>
									</div>
								</div>
							</div>
							<div class="col-12 col-lg-6">
								<div class="card radius-10">
									<div class="card-body">
										<p>Device Storage</p>
										<h4 class="mb-3">42620/50000</h4>
										<hr>
										<div class="progress-wrapper mb-4">
											<p>Documents <span class="float-right">12GB</span></p>
											<div class="progress" style="height:5px;">
												<div class="progress-bar bg-success" style="width:80%"></div>
											</div>
										</div>

										<div class="progress-wrapper mb-4">
											<p>Images <span class="float-right">10GB</span></p>
											<div class="progress" style="height:5px;">
												<div class="progress-bar bg-danger" style="width:60%"></div>
											</div>
										</div>

										<div class="progress-wrapper mb-4">
											<p>Mails <span class="float-right">5GB</span></p>
											<div class="progress" style="height:5px;">
												<div class="progress-bar bg-primary" style="width:40%"></div>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--End Row-->

				<div class="row">
					<div class="col-12 col-lg-6 col-xl-4 d-flex">
						<div class="card radius-10 overflow-hidden w-100">
							<div class="card-body">
								<p>Total Earning</p>
								<h4 class="mb-0">$287,493</h4>
								<small>1.4% <i class="zmdi zmdi-long-arrow-up"></i> Since Last Month</small>
								<hr>
								<p>Total Sales</p>
								<h4 class="mb-0">$87,493</h4>
								<small>5.43% <i class="zmdi zmdi-long-arrow-up"></i> Since Last Month</small>
								<div class="mt-5">
									<div class="chart-container-4">
										<canvas id="chart5"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>


				</div>
				<!--End Row-->

			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
			<p class="mb-0">Copyright © 2021. All right reserved.</p>
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
	<script src="<?php echo $web; ?>assets/js/jquery.min.js"></script>
	<script src="<?php echo $web; ?>assets/plugins/simplebar/js/simplebar.min.js"></script>
	<!--<script src="<?php echo $web; ?>assets/plugins/metismenu/js/metisMenu.min.js"></script>-->
	<script src="<?php echo $web; ?>assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="<?php echo $web; ?>assets/plugins/chartjs/js/Chart.min.js"></script>
	<script src="<?php echo $web; ?>assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
	<script src="<?php echo $web; ?>assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="<?php echo $web; ?>assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="<?php echo $web; ?>assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
	<script src="<?php echo $web; ?>assets/plugins/jquery-knob/excanvas.js"></script>
	<script src="<?php echo $web; ?>assets/plugins/jquery-knob/jquery.knob.js"></script>

	<!-- datatables -->
	<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
	<script>
		$(function() {
			$(".knob").knob();

			$.ajax({
				url: "<?= base_url('web/clistApbd_OPD') ?>",
				type: "GET",
				dataType: "JSON",
				success: function(res) {
					var target = $('#dataTables_apbd_opd');
					var html;
					var no = 1;

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
					$('#dataTables').DataTable();
				}
			});
		});
	</script>

	<script src="https://unpkg.com/@develoka/angka-rupiah-js/index.min.js"></script>

	<script script src="<?php echo $web; ?>assets/js/index.js">
	</script>
	<!--app JS-->
	<script src="<?php echo $web; ?>assets/js/app.js"></script>
	<script>
		let tot_angg = toRupiah(<?= $total_anggaran->total_anggaran; ?>, {
			useUnit: true
		});
		$(".total_anggaran").text(tot_angg);
	</script>
</body>

</html>