<?php
session_start();
error_reporting(0);
include("include/config.php");
if (isset($_POST['submit'])) {
	$username = $_POST['tendangnhap'];
	$password = md5($_POST['matkhau']);
	$ret = mysqli_query($conn, "SELECT * FROM nhanvien WHERE (tendangnhap='$username' or email='$username' or sdt='$username') and matkhau='$password'");
	$num = mysqli_fetch_array($ret);
	if ($num > 0) {
		$extra = "thong-tin-tai-khoan.php";
		$_SESSION['atendangnhap'] = $_POST['tendangnhap'];
		$_SESSION['manv'] = $num['manv'];
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("location:http://$host$uri/$extra");
		exit();
	} else {
		$_SESSION['errmsg'] = "Sai tài khoản hoặc mật khẩu";
		$extra = "index.php";
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("location:http://$host$uri/$extra");
		exit();
	}
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>WS Computer | Đăng nhập</title>
	<link rel="icon" href="images/logo.png" type="image/x-icon">
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>

<body>

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
					<i class="icon-reorder shaded"></i>
				</a>
				<a class="brand" href="index.php">
					WS Computer | Quản lý
				</a>
				<div class="nav-collapse collapse navbar-inverse-collapse">

					<ul class="nav pull-right">

						<li><a href="http://localhost/shopping/">
								Trở về cửa hàng
							</a></li>
					</ul>
				</div><!-- /.nav-collapse -->
			</div>
		</div><!-- /navbar-inner -->
	</div><!-- /navbar -->

	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="module module-login span4 offset4">
					<form class="form-vertical" method="post">
						<div class="module-head">
							<h3>Đăng nhập</h3>
						</div>
						<div class="module-body">
							<div class="control-group">
								<div class="controls row-fluid">
									<input class="span12" type="text" id="inputEmail" name="tendangnhap" value="" placeholder="Nhập tên đăng nhập">
								</div>
							</div>
							<div class="control-group">
								<div class="controls row-fluid">
									<input class="span12" type="password" id="inputPassword" name="matkhau" placeholder="Nhập mật khẩu">
								</div>
							</div>
						</div>
						<div class="module-foot">
							<div class="control-group">
								<div class="controls clearfix">
									<button type="submit" class="btn btn-primary pull-right" name="submit">Đăng nhập</button>
									<span style="color:red;"><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg'] = ""); ?></span>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!--/.wrapper-->

	<div class="footer">
		<div class="container">
			<b class="copyright">Copyright &copy; 2022 by White-Shark Group </b> All rights reserved.
		</div>
	</div>
	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>