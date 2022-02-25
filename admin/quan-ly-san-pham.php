<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['atendangnhap']) == 0) {
	header('location:index.php');
} else {
	date_default_timezone_set('Asia/Kolkata'); // change according timezone
	$currentTime = date('d-m-Y h:i:s A', time());

	if (isset($_GET['del'])) {
		//xoá ràng buộc thuonghieusanpham
		mysqli_query($conn, "delete from thuonghieusanpham where masanpham = '" . $_GET['masp'] . "'");
		// $sql123="delete from thuonghieusanpham where masp = '".$_GET['masp']."'";
		// if ($conn->query($sql123) === TRUE) {
		// 	echo "delete successfully";
		// } else {
		// 	echo "Error: " . $conn->error;
		// }
		mysqli_query($conn, "delete from sanpham where masp = '" . $_GET['masp'] . "'");
		$_SESSION['delmsg'] = "Đã xoá sản phẩm !!";
	}

?>
	<!DOCTYPE html>
	<html lang="vi">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin| Quản lý sản phẩm</title>
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

							<div class="module">
								<div class="module-head">
									<h3>Quản lý sản phẩm</h3>
								</div>
								<div class="module-body table">
									<?php if (isset($_GET['del'])) { ?>
										<div class="alert alert-error">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<strong>Đã xoá!</strong> <?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
										</div>
									<?php } ?>

									<br />

									<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Mã SP</th>
												<th>Tên sản phẩm</th>
												<th>Thể loại </th>
												<th>Giá </th>
												<th>Giá KM </th>
												<th>Nhà cung cấp</th>
												<th>Hình ảnh</th>
												<th>Chỉnh sửa</th>
											</tr>
										</thead>
										<tbody>

											<?php $query = mysqli_query($conn, "select sanpham.*, theloai.tentl, nhacungcap.tenncc from sanpham join theloai on theloai.matl=sanpham.maloai join nhacungcap on nhacungcap.mancc=sanpham.mancc");
											$cnt = 1;
											while ($row = mysqli_fetch_array($query)) {
											?>
												<tr>
													<td><?php echo htmlentities($cnt); ?></td>
													<td><?php echo htmlentities($row['masp']); ?></td>
													<td><?php echo htmlentities($row['tensp']); ?></td>
													<td><?php echo htmlentities($row['tentl']); ?></td>
													<td><?php echo htmlentities($row['giasp']); ?></td>
													<td><?php echo htmlentities($row['giakhuyenmai']); ?></td>
													<td><?php echo htmlentities($row['tenncc']); ?></td>
													<td><img src="hinhanhsp/<?php echo htmlentities($row['masp']); ?>/<?php echo htmlentities($row['hinhanhsp']); ?>" width="100" height="100"></td>
													<td>
														<a href="sua-san-pham.php?masp=<?php echo $row['masp'] ?>"><i class="icon-edit"></i></a>
														<a href="quan-ly-san-pham.php?masp=<?php echo $row['masp'] ?>&del=delete" onClick="return confirm('Bạn có muốn xoá sản phẩm này không?')"><i class="icon-remove-sign"></i></a>
													</td>
												</tr>
											<?php $cnt = $cnt + 1;
											} ?>

									</table>
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