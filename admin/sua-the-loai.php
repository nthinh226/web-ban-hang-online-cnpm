<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['atendangnhap']) == 0) {
	header('location:index.php');
} else {
	date_default_timezone_set('Asia/Kolkata'); // change according timezone
	$currentTime = date('d-m-Y h:i:s A', time());


	if (isset($_POST['submit'])) {
		$matl = $_GET['matl'];
		$tentl = $_POST['tentl'];
		$mota = $_POST['mota'];
		// $sql=mysqli_query($conn,"update theloai set tentl='$tentl', mota='$mota' where matl='$matl'");
		$sql114 = "UPDATE theloai SET tentl=N'" . $tentl . "', mota=N'" . $mota . "', ngaycapnhat='" . $currentTime . "' where matl='" . $matl . "'";
		if ($conn->query($sql114) === TRUE) {
			// echo "Record updated successfully";
			$_SESSION['msg'] = "Cập nhập thể loại thành công !!";
			//sau 2s thì chuyển tiếp sang trang tao-the-loai.php
			header( "refresh:2; url=tao-the-loai.php" );
		} else {
			echo "Error updating record: " . $conn->error;
		}

	}

?>
	<!DOCTYPE html>
	<html lang="vi">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Sửa thể Loại</title>
		<link rel="icon" href="images/logo.png" type="image/x-icon">
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
		<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
		<link type="text/css" href="css/theme.css" rel="stylesheet">
		<script src="plugins/sweetalert2/sweetalert2.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">	
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
									<h3>Thể loại</h3>
								</div>
								<div class="module-body">

									<?php if (isset($_POST['submit'])) { ?>
										<div class="alert alert-success">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<strong>Thành công!</strong> <?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?>
										</div>
									<?php } ?>


									<br />

									<form class="form-horizontal row-fluid" name="theloai" method="post">
										<?php
										$matl = $_GET['matl'];
										echo "ma tl:" . $matl;
										$query = mysqli_query($conn, "select * from theloai where matl='$matl'");
										while ($row = mysqli_fetch_array($query)) {
										?>
											<div class="control-group">
												<label class="control-label" for="basicinput">Tên thể loại</label>
												<div class="controls">
													<input type="text" placeholder="Nhập tên thể loại" name="tentl" value="<?php echo  htmlentities($row['tentl']); ?>" class="span8 tip" required>
												</div>
											</div>


											<div class="control-group">
												<label class="control-label" for="basicinput">Mô tả</label>
												<div class="controls">
													<textarea class="span8" name="mota" rows="5"><?php echo  htmlentities($row['mota']); ?></textarea>
												</div>
											</div>
										<?php } ?>

										<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn">Cập nhập</button>
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