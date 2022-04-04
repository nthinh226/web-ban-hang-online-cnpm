<?php
session_start();
include('include/config.php');

if (strlen($_SESSION['atendangnhap']) == 0) {
	header('location:index.php');
} else {
	date_default_timezone_set('Asia/Kolkata'); // change according timezone
	$currentTime = date('d-m-Y h:i:s A', time());

	if (isset($_POST['submit'])) {
		$sql = mysqli_query($conn, "SELECT matkhau FROM nhanvien WHERE matkhau='" . md5($_POST['matkhau']) . "' and username='" . $_SESSION['atendangnhap'] . "'");
		$num = mysqli_fetch_array($sql);
		if ($num > 0) {
			// $con=mysqli_query($con,"UPDATE nhanvien SET matkhau='".($_POST['matkhaumoi'])."', thoigiancapnhap='$currentTime' WHERE username='".$_SESSION['atendangnhap']."'");

			$sql1111 = "UPDATE nhanvien SET matkhau='" . md5($_POST['matkhaumoi']) . "',thoigiancapnhap='$currentTime' WHERE username='" . $_SESSION['atendangnhap'] . "'";
			if ($conn->query($sql1111) === TRUE) {
				echo "Record updated successfully";
			} else {
				echo "Error updating record: " . $con->error;
			}
			// echo"<p>taikhoan: ".$_SESSION['atendangnhap']."</p>";
			// echo"<p>matkhaumoi: ".$_POST['matkhaumoi']."</p>";
			$_SESSION['msg'] = "Thay đổi mật khẩu thành công !!";
		} else {
			$_SESSION['msg'] = "Mật khẩu cũ không khớp !!";
		}
	}
?>
	<!DOCTYPE html>
	<html lang="vi">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Đổi mật khẩu</title>
		<link rel="icon" href="images/logo.png" type="image/x-icon">
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="css/theme.css" rel="stylesheet">
		<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
		<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
		<script src="plugins/sweetalert2/sweetalert2.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">	
		<script type="text/javascript">
			function kiemtramatkhau() {
				if (document.doimatkhau.matkhau.value == "") {
					alert("Vui lòng nhập mật khẩu hiện tại!!");
					document.doimatkhau.matkhau.focus();
					return false;
				} else if (document.doimatkhau.matkhaumoi.value == "") {
					alert("Vui lòng nhập mật khẩu mới!!");
					document.doimatkhau.matkhaumoi.focus();
					return false;
				} else if (document.doimatkhau.nhaplaimatkhau.value == "") {
					alert("Vui lòng nhập lại mật khẩu xác nhận");
					document.doimatkhau.nhaplaimatkhau.focus();
					return false;
				} else if (document.doimatkhau.matkhaumoi.value != document.doimatkhau.nhaplaimatkhau.value) {
					alert("Mật khẩu và mật khẩu xác nhận không khớp !!");
					document.doimatkhau.nhaplaimatkhau.focus();
					return false;
				}
				return true;
			}
		</script>
	</head>

	<body>
		<?php include('include/header.php'); ?>

		<div class="wrapper">
			<div class="container">
				<div class="row">
					<?php include('include/sidebar.php'); ?>
					<div class="span9">
						<div class="content">

							<div class="module">
								<div class="module-head">
									<h3>Thay đổi mật khẩu</h3>
								</div>
								<div class="module-body">

									<?php if (isset($_POST['submit'])) { ?>
										<div class="alert alert-success">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?>
										</div>
									<?php } ?>
									<br />

									<form class="form-horizontal row-fluid" name="doimatkhau" method="post" onSubmit="return kiemtramatkhau();">

										<div class="control-group">
											<label class="control-label" for="basicinput">Mật khẩu hiện tại</label>
											<div class="controls">
												<input type="password" placeholder="Nhập mật khẩu hiện tại" name="matkhau" class="span8 tip" required>
											</div>
										</div>


										<div class="control-group">
											<label class="control-label" for="basicinput">Mật khẩu mới</label>
											<div class="controls">
												<input type="password" placeholder="Nhập mật khẩu mới" name="matkhaumoi" class="span8 tip" required>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Xác nhận mật khẩu</label>
											<div class="controls">
												<input type="password" placeholder="Nhập lại mật khẩu mới" name="nhaplaimatkhau" class="span8 tip" required>
											</div>
										</div>

										<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn">Đồng ý</button>
											</div>
										</div>
									</form>
								</div>
							</div>



						</div>
						<!--/.content-->
					</div>
					<!--/.span9-->
				</div>
			</div>
			<!--/.container-->
		</div>
		<!--/.wrapper-->

		<?php include('include/footer.php'); ?>

		<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	</body>
<?php } ?>