<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['atendangnhap']) == 0) {
	header('location:index.php');
} else {
	date_default_timezone_set('Asia/Ho_Chi_Minh'); // Thay đổi theo múi giờ
	$currentTime = date('d-m-Y h:i:s A', time());

	if (isset($_POST['tao'])) {
		$math = $_POST['math'];
		$tenth = $_POST['tenth'];
		$diachi = $_POST['diachi'];
        $email = $_POST['email'];
        $sdt = $_POST['sdt'];
        $fax = $_POST['fax'];
        $website = $_POST['website'];

		$sqltao = "INSERT INTO thuonghieu(math, tenth, diachi, sdt, fax, email, website) VALUES('" . $math . "','" . $tenth . "','" . $diachi ."','" . $sdt ."','" . $fax ."','" . $email ."','" . $website . "')";
		if ($conn->query($sqltao) === TRUE) {
			$_SESSION['thongbao'] = "Thêm thương hiệu thành công !!";
			// echo "<script type='text/javascript'>alert('Thêm thể loại thành công !!');</script>";
			// echo header("refresh: 0; url = tao-the-loai.php");
		} else {
			echo "lỗi" . $conn->error;
		}
	}

	if (isset($_GET['del'])) {
		$sqlxoa = "DELETE FROM thuonghieu WHERE math ='" . $_GET['math'] . "'";
		if ($conn->query($sqlxoa) === TRUE) {
			echo "<script type='text/javascript'>alert('Xoá thương hiệu thành công !!');</script>";
			echo header("refresh: 0; url = quan-ly-thuong-hieu.php");
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
		<title>Admin| Quản lý thương hiệu</title>
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
		<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
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
						<!-- Form tạo thương hiệu -->
							<div class="module">
								<div class="module-head">
									<h3>Thương hiệu</h3>
								</div>
								<div class="module-body">
								<!-- Thông báo đã thêm thành công -->
									<?php if (isset($_POST['tao'])) { ?>
										<div class="alert alert-success">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<strong>Đã thêm!</strong> <?php echo htmlentities($_SESSION['thongbao']); ?><?php echo htmlentities($_SESSION['thongbao'] = ""); ?>
										</div>
									<?php } ?>
									<br />
								<!--End thông báo đã thêm thành công -->
								
									<form class="form-horizontal row-fluid" name="taotheloai" method="post">

									<div class="control-group">
											<label class="control-label" for="math">Mã thương hiệu</label>
											<div class="controls">
												<input type="text" placeholder="Nhập mã thương hiệu" name="math" class="span8 tip" required>
											</div>
										</div>									

										<div class="control-group">
											<label class="control-label" for="tenth">Tên thương hiệu</label>
											<div class="controls">
												<input type="text" placeholder="Nhập tên thương hiệu" name="tenth" class="span8 tip" required>
											</div>
										</div>

                                        <div class="control-group">
											<label class="control-label" for="diachi">Địa chỉ</label>
											<div class="controls">
												<input type="text" placeholder="Nhập địa chỉ" name="diachi" class="span8 tip" required>
											</div>
										</div>

                                        <div class="control-group">
											<label class="control-label" for="email">Email</label>
											<div class="controls">
												<input type="text" placeholder="Nhập địa chỉ email" name="email" class="span8 tip" required>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="sdt">SDT</label>
											<div class="controls">
                                                <input type="text" placeholder="Nhập số điện thoại" name="sdt" class="span8 tip" required>
											</div>
										</div>

                                        <div class="control-group">
											<label class="control-label" for="fax">Fax</label>
											<div class="controls">
                                                <input type="text" placeholder="Nhập số Fax"  name="fax" class="span8 tip" >
											</div>
										</div>

                                        <div class="control-group">
											<label class="control-label" for="website">Website</label>
											<div class="controls">
                                                <input type="text" placeholder="Địa chỉ trang web"  name="website" class="span8 tip" >
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
						<!-- End form tạo thương hiệu -->

						<!-- Quản lý thương hiệu -->
							<div class="module">
								<div class="module-head">
									<h3>Danh sách thương hiệu</h3>
								</div>
								<div class="module-body table">
									<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Mã thương hiệu</th>
												<th>Tên thương hiệu</th>
												<th>Địa chỉ</th>
												<th>Sdt</th>
                                                <th>Fax</th>
                                                <th>Email</th>
												<th>Chỉnh sửa</th>
											</tr>
										</thead>
										<tbody>

											<?php $query = mysqli_query($conn, "select * from thuonghieu");
											$stt = 1;
											while ($row = mysqli_fetch_array($query)) {
											?>
												<tr>
													<td><?php echo htmlentities($stt); ?></td>
													<td><?php echo htmlentities($row['math']); ?></td>
													<td><?php echo htmlentities($row['tenth']); ?></td>
													<td><?php echo htmlentities($row['diachi']); ?></td>
													<td><?php echo htmlentities($row['sdt']); ?></td>
                                                    <td><?php echo htmlentities($row['fax']); ?></td>
													<td><?php echo htmlentities($row['email']); ?></td>
													<td>
														<a href="sua-thuong-hieu.php?math=<?php echo $row['math'] ?>"><i class="icon-edit"></i></a>
														<a href="quan-ly-thuong-hieu.php?math=<?php echo $row['math'] ?>&del=delete" onClick="return confirm('Bạn có chắc là xoá thể loại này? Sau khi xoá bạn không thể phục hồi')"><i class="icon-remove-sign"></i></a>
													</td>
												</tr>
											<?php $stt = $stt + 1;
											} ?>
									</table>
								</div>
							</div>
							<!-- End quản lý thương hiệu -->
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