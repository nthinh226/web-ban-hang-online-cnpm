<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['atendangnhap']) == 0) {
	header('location:index.php');
} else {
	date_default_timezone_set('Asia/Ho_Chi_Minh'); // change according timezone
	$currentTime = date('d-m-Y h:i:s A', time());
	if (isset($_POST['capnhap'])) {
		$manv = $_POST['manv'];
		$hotennv = $_POST['hotennv'];
		$ngaysinh = $_POST['ngaysinh'];
		$gioitinh = $_POST['gioitinh'];
		$sdt = $_POST['sdt'];
		$avatar = $_FILES['avatar']['name'];
		$dir = "avatar/$manv";
		if (!is_dir($dir)) {
			mkdir("avatar/" . $manv);
		}
		if($avatar==null){
			$sqlupdate = " UPDATE nhanvien SET hotennv='$hotennv', ngaysinh='$ngaysinh', gioitinh='$gioitinh', sdt='$sdt' where manv='$manv'";
			// echo "Record updated successfully";
			if ($conn->query($sqlupdate) === TRUE) {
				$_SESSION['thongbao'] = "Cập nhập thông tin thành công !!";
				// echo "Record updated successfully";
			} else {
				echo "Error updating record: " . $conn->error;
			}
		}else{
			$sqlupdate = " UPDATE nhanvien SET hotennv='$hotennv', ngaysinh='$ngaysinh', gioitinh='$gioitinh', sdt='$sdt', avatar='$avatar' where manv='$manv'";
			if ($conn->query($sqlupdate) === TRUE) {
				move_uploaded_file($_FILES['avatar']['tmp_name'], "avatar/" . $manv . "/" . $avatar);
				// echo "Record updated successfully";
				$_SESSION['thongbao'] = "Cập nhập thông tin thành công !!";
			} else {
				echo "Error updating record: " . $conn->error;
			}

		}
	}

?>
	<!DOCTYPE html>
	<html lang="vi">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin| Thông tin tài khoản</title>
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="css/theme.css" rel="stylesheet">
		<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>

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
									<h3>Thông tin tài khoản</h3>
								</div>
								<div class="module-body">

									<?php if (isset($_POST['capnhap'])) { ?>
										<div class="alert alert-success">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<strong>Thành công!</strong> <?php echo htmlentities($_SESSION['thongbao']); ?><?php echo htmlentities($_SESSION['thongbao'] = ""); ?>
										</div>
									<?php } ?>
									<br />

									<form class="form-horizontal row-fluid" name="thongtintaikhoan" method="post" enctype="multipart/form-data">

										<?php

										$query = mysqli_query($conn, "SELECT * FROM nhanvien WHERE tendangnhap='$username'");
										$cnt = 1;
										while ($row = mysqli_fetch_array($query)) {
										?>

											<div class="control-group">

												<div class="control-group">
													<label class="control-label" for="avatar">Ảnh đại diện</label>
													<div class="controls">
														<img src="avatar/<?php echo htmlentities($row['manv']); ?>/<?php echo htmlentities($row['avatar']); ?>" width="200" height="100">
														<input type="file" name="avatar" value="" class="span8 tip">
													</div>
												</div>

												<div class="control-group">
													<label class="control-label" for="manv">Mã nhân viên</label>
													<div class="controls">
														<input type="text" name="manv" readonly value="<?php echo htmlentities($row['manv']); ?>" class="span8 tip">
													</div>
												</div>

												<div class="control-group">
													<label class="control-label" for="hotennv">Họ tên nhân viên</label>
													<div class="controls">
														<input type="text" name="hotennv" placeholder="Nhập họ tên" value="<?php echo htmlentities($row['hotennv']); ?>" class="span8 tip">
													</div>
												</div>

												<div class="control-group">
													<label class="control-label" for="ngaysinh">Ngày sinh</label>
													<div class="controls">
														<input type="date" name="ngaysinh" value="<?php echo htmlentities($row['ngaysinh']); ?>" class="span8 tip">
													</div>
												</div>

												<div class="control-group">
													<label class="control-label" for="gioitinh">Giới tính</label>
													<div class="controls">
														<input type="text" name="gioitinh" placeholder="Nhập giới tính" value="<?php echo htmlentities($row['gioitinh']); ?>" class="span8 tip">
													</div>
												</div>

												<div class="control-group">
													<label class="control-label" for="sdt">Số điện thoại</label>
													<div class="controls">
														<input type="text" name="sdt" placeholder="Nhập số điện thoại" value="<?php echo htmlentities($row['sdt']); ?>" class="span8 tip">
													</div>
												</div>

												<div class="control-group">
													<label class="control-label" for="email">Email</label>
													<div class="controls">
														<input type="text" name="email" readonly value="<?php echo htmlentities($row['email']); ?>" class="span8 tip">
													</div>
												</div>

											</div>
											<!--control-group -->

										<?php } ?>
										<div class="control-group">
											<div class="controls">
												<button type="submit" name="capnhap" class="btn">Cập nhập</button>
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
		<script src="scripts/datatables/jquery.dataTables.js"></script>
	</body>
<?php } ?>