<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['atendangnhap']) == 0) {
	header('location:index.php');
} else {
	$masp = $_GET['masp'];
	if (isset($_POST['submit'])) {
		$tensp = $_POST['tensp'];
		$hinhanhsp = $_FILES["hinhanhsp"]["name"];
		//$dir="productimages";
		//unlink($dir.'/'.$pimage);

		move_uploaded_file($_FILES["hinhanhsp"]["tmp_name"], "hinhanhsp/$masp/" . $_FILES["hinhanhsp"]["name"]);
		$sql = mysqli_query($conn, "UPDATE  sanpham SET hinhanhsp='$hinhanhsp' WHERE masp='$masp' ");
		$_SESSION['msg'] = "Đổi hình ảnh thành công !!";
	}


?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin| Update Product Image</title>
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="css/theme.css" rel="stylesheet">
		<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
		<script type="text/javascript">
			bkLib.onDomLoaded(nicEditors.allTextAreas);
		</script>

		<script>
			function getSubcat(val) {
				$.ajax({
					type: "POST",
					url: "get_subcat.php",
					data: 'cat_id=' + val,
					success: function(data) {
						$("#subcategory").html(data);
					}
				});
			}

			function selectCountry(val) {
				$("#search-box").val(val);
				$("#suggesstion-box").hide();
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
									<h3>Cập nhập hình ảnh</h3>
								</div>
								<div class="module-body">

									<?php if (isset($_POST['submit'])) { ?>
										<div class="alert alert-success">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<strong>Thành công!</strong> <?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?>
										</div>
									<?php } ?>



									<br />

									<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">

										<?php

										$query = mysqli_query($conn, "SELECT tensp,hinhanhsp FROM sanpham WHERE masp='$masp'");
										$cnt = 1;
										while ($row = mysqli_fetch_array($query)) {

										?>

											<div class="control-group">
												<label class="control-label" for="basicinput">Tên sản phẩm</label>
												<div class="controls">
													<input type="text" name="tensp" readonly value="<?php echo htmlentities($row['tensp']); ?>" class="span8 tip" required>
												</div>
											</div>

											<div class="control-group">
												<label class="control-label" for="basicinput">Ảnh hiện tại</label>
												<div class="controls">
													<img src="hinhanhsp/<?php echo htmlentities($masp); ?>/<?php echo htmlentities($row['hinhanhsp']); ?>" width="200" height="100">
												</div>
											</div>



											<div class="control-group">
												<label class="control-label" for="basicinput">Hình ảnh mới</label>
												<div class="controls">
													<input type="file" name="hinhanhsp" id="hinhanhsp" value="" class="span8 tip" required>
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