<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['atendangnhap']) == 0) {
	header('location:index.php');
} else {
	date_default_timezone_set('Asia/Kolkata'); // change according timezone
	$currentTime = date('d-m-Y h:i:s A', time());
?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Đơn đặt hàng trong ngày</title>
		<link rel="icon" href="images/logo.png" type="image/x-icon">
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="css/theme.css" rel="stylesheet">
		<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
		<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
		<script language="javascript" type="text/javascript">
			var popUpWin = 0;
			function popUpWindow(URLStr, left, top, width, height) {
				if (popUpWin) {
					if (!popUpWin.closed) popUpWin.close();
				}
				popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' + 600 + ',height=' + 600 + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
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
									<h3>Đơn hàng chờ xử lý</h3>
								</div>
								<div class="module-body table">
									<!-- thông báo xoá -->
									<?php if (isset($_GET['del'])) { ?>
										<div class="alert alert-error">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<strong>Oh snap!</strong> <?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
										</div>
									<?php } ?>
									<br />

									<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display table-responsive">
										<thead>
											<tr>
												<th>#</th>
												<th>Họ tên</th>
												<th>SDT</th>
												<th>Địa chỉ</th>
												<th>Tổng tiền </th>
												<th>Ngày đặt hàng</th>
												<th>Chỉnh sửa</th>
											</tr>
										</thead>

										<tbody>
											<?php
											$f1 = "00:00:00";
											$from = date('Y-m-d') . " " . $f1;
											$t1 = "23:59:59";
											$to = date('Y-m-d') . " " . $t1;
											$status = 0;
											$query = mysqli_query($conn, "select v.sodh, v.makh, v.hotenkh, v.email, v.sdt, v.diachigiaohang, v.ngaydh, v.tongtien, v.trangthaidh from view_donhang v where v.trangthaidh =" . $status . " and v.ngaydh between '" . $from . "' and '" . $to . "'");
											$cnt = 1;
											if ($query) {
												while ($row = mysqli_fetch_array($query)) {
											?>
													<tr>
														<td><?php echo htmlentities($cnt); ?></td>
														<td><?php echo htmlentities($row['hotenkh']); ?></td>
														<td><?php echo htmlentities($row['sdt']); ?></td>
														<td><?php echo htmlentities($row['diachigiaohang']); ?></td>
														<td><?php echo htmlentities($row['tongtien']); ?></td>
														<td><?php echo htmlentities($row['ngaydh']); ?></td>
														<td> <a href="cap-nhat-don-hang.php?sodh=<?php echo htmlentities($row['sodh']); ?>" title="Xác nhận đơn hàng" target="_blank"><i class="icon-edit"></i></a>
														</td>
													</tr>
											<?php
													$cnt = $cnt + 1;
												}
											} else {
											} ?>
										</tbody>
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