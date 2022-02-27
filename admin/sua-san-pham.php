<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['atendangnhap']) == 0) {
	header('location:index.php');
} else {
	date_default_timezone_set('Asia/Ho_Chi_Minh'); // change according timezone
	$currentTime = date('d-m-Y h:i:s A', time());

	$masp = $_GET['masp'];
	if (isset($_POST['submit'])) {
		$masanpham = $_POST['masanpham'];
		$math = $_POST['math'];
		$tensp = $_POST['tensp'];
		$giasp = $_POST['giasp'];
		$giakhuyenmai = $_POST['giakhuyenmai'];
		$maloai = $_POST['maloai'];
		$mancc = $_POST['mancc'];
		$mota = $_POST['mota'];

		// $sql=mysqli_query($conn,"UPDATE sanpham SET tensp='$tensp',giasp='$giasp',giakhuyenmai='$giakhuyenmai',maloai='$maloai',mancc='$mancc',mota='$mota' WHERE masp='$masp'");
		$sqlcapnhap = "UPDATE sanpham SET tensp='" . $tensp . "',giasp='" . $giasp . "',giakhuyenmai='" . $giakhuyenmai . "',maloai='" . $maloai . "',mancc='" . $mancc . "',mota='" . $mota . "', ngaycapnhat='" . $currentTime . "' WHERE masp='" . $masp . "'";
		if ($conn->query($sqlcapnhap) === TRUE) {
			$conn->query("UPDATE thuonghieusanpham SET mathuonghieu='$math', masanpham='$masanpham'");
			echo "Record updated successfully";
			            //sau 2s thì chuyển tiếp sang trang tao-the-loai.php
						header( "refresh:2; url=quan-ly-san-pham.php" );
		} else {
			echo "Error updating record: " . $conn->error;
		}


		$_SESSION['msg'] = "Cập nhập sản phẩm thành công !!";
	}


?>
	<!DOCTYPE html>
	<html lang="vi">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Sửa sản phẩm</title>
		<link rel="icon" href="images/logo.png" type="image/x-icon">
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
		<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
		<link type="text/css" href="css/theme.css" rel="stylesheet">
		<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
		<script type="text/javascript">
			bkLib.onDomLoaded(nicEditors.allTextAreas);
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
									<h3>Cập nhập sản phẩm</h3>
								</div>
								<div class="module-body">

									<?php if (isset($_POST['submit'])) { ?>
										<div class="alert alert-success">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<strong>Thành công!</strong> <?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?>
										</div>
									<?php } ?>


									<?php if (isset($_GET['del'])) { ?>
										<div class="alert alert-error">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<strong>Đã xoá!</strong> <?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
										</div>
									<?php } ?>

									<br />

									<form class="form-horizontal row-fluid" name="suasanpham" method="post" enctype="multipart/form-data">

										<?php
										$query = mysqli_query($conn, "SELECT sanpham.masp, sanpham.hinhanhsp, theloai.matl, theloai.tentl, sanpham.tensp, thuonghieu.math, thuonghieu.tenth, nhacungcap.mancc, nhacungcap.tenncc, sanpham.giasp, sanpham.giakhuyenmai,sanpham.mota FROM sanpham,thuonghieusanpham,thuonghieu,nhacungcap,theloai WHERE sanpham.masp=thuonghieusanpham.masanpham and thuonghieusanpham.mathuonghieu=thuonghieu.math and sanpham.mancc=nhacungcap.mancc and sanpham.maloai=theloai.matl and sanpham.masp='$masp'");
										$cnt = 1;
										while ($row = mysqli_fetch_array($query)) {
										?>

											<div class="control-group">
												<label class="control-label" for="masanpham">Mã SP</label>
												<div class="controls">
													<input type="text" name="masanpham" value="<?php echo htmlentities($row['masp']); ?>" class="span8 tip" readonly>
												</div>
											</div>

											<div class="control-group">
												<label class="control-label" for="basicinput">Thể loại</label>
												<div class="controls">
													<select name="maloai" class="span8 tip" required>
														<option value="<?php echo htmlentities($row['matl']); ?>"><?php echo htmlentities($row['tentl']); ?></option>
														<?php $query = mysqli_query($conn, "select * from theloai");
														while ($rw = mysqli_fetch_array($query)) {
															if ($row['tentl'] == $rw['tentl']) {
																continue;
															} else {
														?>
																<option value="<?php echo $rw['matl']; ?>"><?php echo $rw['tentl']; ?></option>
														<?php }
														} ?>
													</select>
												</div>
											</div>

											<div class="control-group">
												<label class="control-label" for="basicinput">Tên sản phẩm</label>
												<div class="controls">
													<input type="text" name="tensp" placeholder="Nhập tên sản phẩm" value="<?php echo htmlentities($row['tensp']); ?>" class="span8 tip">
												</div>
											</div>

											<div class="control-group">
												<label class="control-label" for="math">Thương hiệu</label>
												<div class="controls">
													<select name="math" class="span8 tip" required>
														<option value="<?php echo htmlentities($row['math']); ?>"><?php echo htmlentities($row['tenth']); ?></option>
														<?php $query = mysqli_query($conn, "select * from thuonghieu");
														while ($rw = mysqli_fetch_array($query)) {
															if ($row['math'] == $rw['tenth']) {
																continue;
															} else {
														?>
																<option value="<?php echo $rw['math']; ?>"><?php echo $rw['tenth']; ?></option>
														<?php }
														} ?>
													</select>
												</div>
											</div>

											<div class="control-group">
												<label class="control-label" for="basicinput">Nhà cung cấp</label>
												<div class="controls">
													<select name="mancc" class="span8 tip" required>
														<option value="<?php echo htmlentities($row['mancc']); ?>"><?php echo htmlentities($row['tenncc']); ?></option>
														<?php $query = mysqli_query($conn, "select * from nhacungcap");
														while ($rw = mysqli_fetch_array($query)) {
															if ($row['tenncc'] == $rw['tenncc']) {
																continue;
															} else {
														?>
																<option value="<?php echo $rw['mancc']; ?>"><?php echo $rw['tenncc']; ?></option>
														<?php }
														} ?>
													</select>
												</div>
											</div>

											<div class="control-group">
												<label class="control-label" for="basicinput">Giá</label>
												<div class="controls">
													<input type="text" name="giasp" placeholder="Nhập giá sản phẩm" value="<?php echo htmlentities($row['giasp']); ?>" class="span8 tip">
												</div>
											</div>

											<div class="control-group">
												<label class="control-label" for="basicinput">Giá khuyến mãi</label>
												<div class="controls">
													<input type="text" name="giakhuyenmai" placeholder="Nhập giá khuyến mãi" value="<?php echo htmlentities($row['giakhuyenmai']); ?>" class="span8 tip" required>
												</div>

												<div class="control-group">
													<label class="control-label" for="basicinput">Mô tả sản phẩm</label>
													<div class="controls">
														<textarea name="mota" placeholder="Nhập mô tả sản phẩm" rows="6" class="span8 tip"><?php echo htmlentities($row['mota']); ?></textarea>
													</div>
												</div>

												<div class="control-group">
													<label class="control-label" for="basicinput">Hình ảnh sản phẩm</label>
													<div class="controls">
														<img src="hinhanhsp/<?php echo htmlentities($masp); ?>/<?php echo htmlentities($row['hinhanhsp']); ?>" width="200" height="100"> <a href="doi-hinh-anh.php?masp=<?php echo $row['masp']; ?>">Đổi hình ảnh</a>
													</div>
												</div>

											</div>
											<!--control-group -->

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