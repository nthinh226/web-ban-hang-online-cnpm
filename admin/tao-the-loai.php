<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['atendangnhap']) == 0) {
	header('location:index.php');
} else {
	date_default_timezone_set('Asia/Ho_Chi_Minh'); // Thay đổi theo múi giờ
	$currentTime = date('d-m-Y h:i:s A', time());

	if (isset($_POST['tao'])) {
		$matl = $_POST['matl'];
		$tentl = $_POST['tentl'];
		$mota = $_POST['mota'];

		$sqltao = "INSERT INTO theloai(matl,tentl,mota) VALUES('" . $matl . "','" . $tentl . "','" . $mota . "')";
		if ($conn->query($sqltao) === TRUE) {
			$_SESSION['msg'] = "Thêm thể loại thành công !!";
			// echo "<script type='text/javascript'>alert('Thêm thể loại thành công !!');</script>";
			// echo header("refresh: 0; url = tao-the-loai.php");
		} else {
			echo "lỗi" . $conn->error;
		}
	}

	if (isset($_GET['del'])) {
		$sqlxoa = "DELETE FROM theloai WHERE matl ='" . $_GET['matl'] . "'";
		if ($conn->query($sqlxoa) === TRUE) {
			echo "<script type='text/javascript'>alert('Xoá thể loại thành công !!');</script>";
			echo header("refresh: 0; url = tao-the-loai.php");
			// echo "Xoá thành công";
			// $_SESSION['delmsg']="Đã xoá thành công !!";
			//refresh lại trang bằng php theo thời gian
		} else {
			echo "Xoá không thành công vì còn ràng buộc: " . $conn->error;
		}
	}

?>
	<!DOCTYPE html>
	<html lang="vi">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin| Thể loại</title>
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="css/theme.css" rel="stylesheet">


	</head>

	<body>
		<?php include('include/header.php'); ?>

		<div class="wrapper">
			<div class="container">
				<div class="row">
					<?php include('include/sidebar.php'); ?>
					<div class="span9">
						<div class="content">
							<!-- Form tạo thể loại -->
							<div class="module">
								<div class="module-head">
									<h3>Thể loại</h3>
								</div>
								<div class="module-body">
									<!-- Thông báo đã thêm thành công -->
									<?php if (isset($_POST['tao'])) { ?>
										<div class="alert alert-success">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<strong>Đã thêm!</strong> <?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?>
										</div>
									<?php } ?>
									<br />
									<!--End thông báo đã thêm thành công -->

									<form class="form-horizontal row-fluid" name="taotheloai" method="post">

										<div class="control-group">
											<label class="control-label" for="matl">Mã thể loại</label>
											<div class="controls">
												<input type="text" placeholder="Nhập mã thể loại" name="matl" class="span8 tip" required>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="tentl">Tên thể loại</label>
											<div class="controls">
												<input type="text" placeholder="Nhập tên thể loại" name="tentl" class="span8 tip" required>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="mota">Mô tả</label>
											<div class="controls">
												<textarea class="span8" name="mota" rows="5"></textarea>
											</div>
										</div>

										<div class="control-group">
											<div class="controls">
												<button type="submit" name="tao" class="btn">Tạo</button>
											</div>
										</div>
									</form>

								</div>
							</div>
							<!-- End form tạo thể loại -->

							<!-- Quản lý thể loại -->
							<div class="module">
								<div class="module-head">
									<h3>Quản lý thể loại</h3>
								</div>
								<div class="module-body table">
									<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Mã thể loại</th>
												<th>Tên thể loại</th>
												<th>Mô tả</th>
												<th>Ngày tạo</th>
												<th>Ngày cập nhập</th>
												<th>Chỉnh sửa</th>
											</tr>
										</thead>
										<tbody>

											<?php $query = mysqli_query($conn, "select * from theloai");
											$stt = 1;
											while ($row = mysqli_fetch_array($query)) {
											?>
												<tr>
													<td><?php echo htmlentities($stt); ?></td>
													<td><?php echo htmlentities($row['matl']); ?></td>
													<td><?php echo htmlentities($row['tentl']); ?></td>
													<td><?php echo htmlentities($row['mota']); ?></td>
													<td><?php echo htmlentities($row['ngaytao']); ?></td>
													<td><?php echo htmlentities($row['ngaycapnhat']); ?></td>
													<td>
														<a href="sua-the-loai.php?matl=<?php echo $row['matl'] ?>"><i class="icon-edit"></i></a>
														<a href="tao-the-loai.php?matl=<?php echo $row['matl'] ?>&del=delete" onClick="return confirm('Bạn có chắc là xoá thể loại này? Sau khi xoá bạn không thể phục hồi')"><i class="icon-remove-sign"></i></a>
													</td>
												</tr>
											<?php $stt = $stt + 1;
											} ?>
									</table>
								</div>
							</div>
							<!-- End quản lý thể loại -->
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
		<script>
			$(document).ready(function() {
				$('.datatable-1').dataTable();
				$('.dataTables_paginate').addClass("btn-group datatable-pagination");
				$('.dataTables_paginate > a').wrapInner('<span />');
				$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
				$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
			});
		</script>
	</body>
<?php } ?>