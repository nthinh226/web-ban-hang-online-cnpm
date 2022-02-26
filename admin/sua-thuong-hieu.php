<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['atendangnhap']) == 0) {
    header('location:index.php');
} else {
    date_default_timezone_set('Asia/Ho_Chi_Minh'); // change according timezone
    $currentTime = date('d-m-Y h:i:s A', time());

    $mathuonghieu = $_GET['math'];
    if (isset($_POST['capnhap'])) {
		$math = $_POST['math'];
		$tenth = $_POST['tenth'];
		$diachi = $_POST['diachi'];
        $email = $_POST['email'];
        $sdt = $_POST['sdt'];
        $fax = $_POST['fax'];
        $website = $_POST['website'];

        // $sql=mysqli_query($conn,"UPDATE sanpham SET tensp='$tensp',giasp='$giasp',giakhuyenmai='$giakhuyenmai',maloai='$maloai',mancc='$mancc',mota='$mota' WHERE masp='$masp'");
        $sqlcapnhap = "UPDATE thuonghieu SET tenth='$tenth', diachi='$diachi', sdt='$sdt', fax='$fax', email='$email', website='$website' where math='$mathuonghieu'";
        if ($conn->query($sqlcapnhap) === TRUE) {
            echo "Record updated successfully";
            $_SESSION['thongbao'] = "Cập nhập thương hiệu thành công !!";
            //sau 2s thì chuyển tiếp sang trang tao-the-loai.php
			header( "refresh:2; url=quan-ly-thuong-hieu.php" );
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
        <title>Admin| Insert Product</title>
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
                                    <h3>Cập nhập thương hiệu</h3>
                                </div>
                                <div class="module-body">

                                    <?php if (isset($_POST['capnhap'])) { ?>
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>Thành công!</strong> <?php echo htmlentities($_SESSION['thongbao']); ?><?php echo htmlentities($_SESSION['thongbao'] = ""); ?>
                                        </div>
                                    <?php } ?>


                                    <?php if (isset($_GET['del'])) { ?>
                                        <div class="alert alert-error">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>Đã xoá!</strong> <?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
                                        </div>
                                    <?php } ?>

                                    <br />

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

                                    <?php
										$query = mysqli_query($conn, "SELECT * from thuonghieu where math='$mathuonghieu'");
										$cnt = 1;
										while ($row = mysqli_fetch_array($query)) {
										?>

									<div class="control-group">
											<label class="control-label" for="math">Mã thương hiệu</label>
											<div class="controls">
												<input type="text" placeholder="Nhập mã thương hiệu" name="math" class="span8 tip" value="<?php echo htmlentities($row['math']); ?>" readonly>
											</div>
										</div>									

										<div class="control-group">
											<label class="control-label" for="tenth">Tên thương hiệu</label>
											<div class="controls">
												<input type="text" placeholder="Nhập tên thương hiệu" name="tenth" value="<?php echo htmlentities($row['tenth']); ?>" class="span8 tip" required>
											</div>
										</div>

                                        <div class="control-group">
											<label class="control-label" for="diachi">Địa chỉ</label>
											<div class="controls">
												<input type="text" placeholder="Nhập địa chỉ" name="diachi" value="<?php echo htmlentities($row['diachi']); ?>" class="span8 tip" required>
											</div>
										</div>

                                        <div class="control-group">
											<label class="control-label" for="email">Email</label>
											<div class="controls">
												<input type="text" placeholder="Nhập địa chỉ email" name="email" value="<?php echo htmlentities($row['email']); ?>" class="span8 tip" required>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="sdt">SDT</label>
											<div class="controls">
                                                <input type="text" placeholder="Nhập số điện thoại" name="sdt" value="<?php echo htmlentities($row['sdt']); ?>" class="span8 tip" required>
											</div>
										</div>

                                        <div class="control-group">
											<label class="control-label" for="fax">Fax</label>
											<div class="controls">
                                                <input type="text" placeholder="Nhập số Fax"  name="fax" value="<?php echo htmlentities($row['fax']); ?>" class="span8 tip" >
											</div>
										</div>

                                        <div class="control-group">
											<label class="control-label" for="website">Website</label>
											<div class="controls">
                                                <input type="text" placeholder="Địa chỉ trang web"  name="website" value="<?php echo htmlentities($row['website']); ?>" class="span8 tip" >
											</div>
										</div>
                                        <?php } ?>

										<div class="control-group">
											<div class="controls">
												<button type="submit" name="capnhap" class="btn">Cập nhập</button>
											</div>
										</div>
									</form>

								</div>
							</div>
						<!-- End form tạo thương hiệu -->
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