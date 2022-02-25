<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['atendangnhap']) == 0) {
	header('location:index.php');
} else {

	if (isset($_POST['themsp'])) {
		$masp = '';
        $manccsp = $_POST['mancc'];
        $tensp = $_POST['tensp'];
        $maloaisp = $_POST['maloai'];
        $mathsp = $_POST['math'];
        $giasp = floatval($_POST['giasp']);
        $giakhuyenmaisp = floatval($_POST['giakhuyenmai']);
        $motasp = $_POST['mota'];

        //tăng số tự động
        $tang_so_tt = mysqli_query($conn, "SELECT max(ExtractNumber(sanpham.masp)) AS maxstt from sanpham where sanpham.maloai like '" . $maloaisp . "%'");
        $row = mysqli_fetch_array($tang_so_tt);
        if ($row > 0) {
            $stt = intval($row['maxstt']);
            $stt += 1;
            $masp = $maloaisp . $mathsp . $stt;
        } else {
            $masp = $maloaisp . $mathsp . "1";
        }
        //tăng số tự động

		$hinhanhsp = $_FILES['hinhanhsp']['name'];
		$dir = "hinhanhsp/$masp";
		if (!is_dir($dir)) {
			mkdir("hinhanhsp/" . $masp);
		}

		$sqlthemsp = "INSERT INTO sanpham(masp, mancc, tensp, maloai, giasp, giakhuyenmai, mota, hinhanhsp) VALUES ('" . $masp . "','" . $manccsp . "','" . $tensp . "','" . $maloaisp . "'," . $giasp . "," . $giakhuyenmaisp . ",'" . $motasp . "','" . $hinhanhsp . "')";
		if (mysqli_query($conn, $sqlthemsp)) {
			if (mysqli_affected_rows($conn) > 0) { //có thay đổi dữ liệu
				if ($mathsp == "") {
					echo "Record updated successfully";
					move_uploaded_file($_FILES["hinhanhsp"]["tmp_name"], "hinhanhsp/$masp/" . $_FILES["hinhanhsp"]["name"]);
					$_SESSION['thongbao'] = "Thêm sản phẩm (không có thương hiệu) thành công !!";//Insert dữ liệu sản phẩm không có thương hiệu thành công
				} else {
					$sql1 = "INSERT INTO thuonghieusanpham(mathuonghieu, masanpham) VALUE ('" . $mathsp . "','" . $masp . "')";
					if (mysqli_query($conn, $sql1)) {
						move_uploaded_file($_FILES["hinhanhsp"]["tmp_name"], "hinhanhsp/$masp/" . $_FILES["hinhanhsp"]["name"]);
						$_SESSION['thongbao'] = "Thêm sản phẩm thành công !!"; //Insert dữ liệu thành công
					} else {
						$_SESSION['thongbao'] = "Thêm sản phẩm không thành công !!"; //Không thành công
					}
				}
			} else {
				echo "Error updating record: " . $conn->error;
				$_SESSION['thongbao'] = "Thêm sản phẩm không thành công !!"; //Không thành công
			}
		} else {
			echo "Error updating record: " . $conn->error;
			$_SESSION['thongbao'] = "Thêm sản phẩm không thành công !!";  //Không thành công
		}
	}

?>
	<!DOCTYPE html>
	<html lang="vi">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin| Thêm sản phẩm</title>
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="css/theme.css" rel="stylesheet">
		<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>

		<!-- <script>
			function getSubcat(val) {
				$.ajax({
					type: "POST",
					url: "get_subcat.php",
					data: 'matl=' + val,
					success: function(data) {
						$("#mactl").html(data);
					}
				});
			}

			function selectCountry(val) {
				$("#search-box").val(val);
				$("#suggesstion-box").hide();
			}
		</script> -->

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
									<h3>Thêm sản phẩm</h3>
								</div>
								<div class="module-body">

									<?php if (isset($_POST['themsp'])) { ?>
										<div class="alert alert-success">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<strong><?php echo htmlentities($_SESSION['thongbao']); ?><?php echo htmlentities($_SESSION['thongbao'] = ""); ?></strong> 
										</div>
									<?php } ?>

									<br />
									<!-- Form thêm sản phẩm -->
									<form class="form-horizontal row-fluid" name="themsanpham" method="post" enctype="multipart/form-data">
										<div class="control-group">
											<label class="control-label" for="maloai">Thể loại</label>
											<div class="controls">
												<select name="maloai" class="span8 tip" onChange="getSubcat(this.value);" required>
													<option value="">Chọn thể loại</option>
													<?php $query = mysqli_query($conn, "select * from theloai");
													while ($row = mysqli_fetch_array($query)) { ?>
														<option value="<?php echo $row['matl']; ?>"><?php echo $row['tentl']; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Tên sản phẩm</label>
											<div class="controls">
												<input type="text" name="tensp" placeholder="Nhập tên sản phẩm" class="span8 tip" required>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="math">Thương hiệu</label>
											<div class="controls">
												<select name="math" class="span8 tip" required>
													<option value="">Chọn thương hiệu</option>
													<?php $query = mysqli_query($conn, "select * from thuonghieu");
													while ($row = mysqli_fetch_array($query)) { ?>
														<option value="<?php echo $row['math']; ?>"><?php echo $row['tenth']; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="mancc">Nhà cung cấp</label>
											<div class="controls">
												<select name="mancc" class="span8 tip" required>
													<option value="">Chọn nhà cung cấp</option>
													<option value="">Tạo nhà cung cấp</option>
													<?php $query = mysqli_query($conn, "select * from nhacungcap");
													while ($row = mysqli_fetch_array($query)) { ?>
														<option value="<?php echo $row['mancc']; ?>"><?php echo $row['tenncc']; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="giasp">Giá sản phẩm</label>
											<div class="controls">
												<input type="text" name="giasp" placeholder="Nhập giá sản phẩm" class="span8 tip" required>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="giakhuyenmai">Giá khuyến mãi</label>
											<div class="controls">
												<input type="text" value="0" name="giakhuyenmai" placeholder="Nhập giá khuyến mãi" class="span8 tip">
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="mota">Mô tả</label>
											<div class="controls">
												<textarea name="mota" placeholder="Nhập mô tả sản phẩm" rows="6" class="span8 tip"></textarea>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="hinhanhsp">Hình ảnh sản phẩm</label>
											<div class="controls">
												<input type="file" name="hinhanhsp" id="hinhanhsp" value="" class="span8 tip" required>
											</div>
										</div>

										<div class="control-group">
											<div class="controls">
												<button type="submit" name="themsp" class="btn">Thêm</button>
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