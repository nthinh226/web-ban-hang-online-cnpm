<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['atendangnhap']) == 0) {
    header('location:index.php');
} else {
    date_default_timezone_set('Asia/Ho_Chi_Minh'); // change according timezone
    $currentTime = date('d-m-Y h:i:s A', time());

    if (isset($_POST['taonv'])) {
        $hotennv = $_POST['hotennv'];
        $ngaysinhnv = $_POST['ngaysinh'];
        $gioitinhnv = $_POST['gioitinh'];
        $sdtnv = $_POST['sdt'];
        $emailnv = $_POST['email'];
        $tendangnhapnv = $_POST['tendangnhap'];
        $matkhaunv = md5($sdtnv);

        //tăng số tự động
        $tang_so_tt = mysqli_query($conn, "SELECT max(ExtractNumber(nv.manv)) AS maxstt from nhanvien nv");
        $row = mysqli_fetch_array($tang_so_tt);
        if ($row > 0) {
            $stt = intval($row['maxstt']);
            $stt += 1;
            $manv = "NV" . $stt;
        } else {
            $manv = "NV1";
        }
        //tăng số tự động   

        $rs = mysqli_query($conn, "select COUNT(*) as 'total' from nhanvien where manv='" . $manv . "' ");
        $row = mysqli_fetch_array($rs);
        if ((int)$row['total'] > 0) {
            $res["success"] = 2; //{success:2} //đều có nghĩa là đã trùng tên
        } else {
            $sql = "INSERT INTO nhanvien(manv, hotennv, ngaysinh, gioitinh, sdt, email, tendangnhap, matkhau) VALUES ('" . $manv . "','" . $hotennv . "','" . $ngaysinhnv . "','" . $gioitinhnv . "','" . $sdtnv . "','" . $emailnv . "','" . $tendangnhapnv . "','" . $matkhaunv . "')";
            if (mysqli_query($conn, $sql)) {
                if (mysqli_affected_rows($conn) > 0) { //có thay đổi dữ liệu
                    if (mysqli_affected_rows($conn)) {
                        $_SESSION['msg'] = "Thêm nhân viên thành công !!"; //Insert dữ liệu thành công
                    } else {
                        $_SESSION['msg'] = "Thêm nhân viên thất bại !!";
                        echo "lỗi" . $conn->error; //Không thành công
                    }
                } else {
                    $_SESSION['msg'] = "Thêm nhân viên thất bại !!";
                    echo "lỗi" . $conn->error; //Không thành công
                }
            } else {
                $_SESSION['msg'] = "Thêm nhân viên thất bại !!";
                echo "lỗi" . $conn->error;  //Không thành công
            }
        }
    }

?>
    <!DOCTYPE html>
    <html lang="vi">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Quản lý nhân viên</title>
        <link rel="icon" href="images/logo.png" type="image/x-icon">
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
                            <!-- Form tạo nhân viên -->
                            <div class="module">
                                <div class="module-head">
                                    <h3>Tạo nhân viên</h3>
                                </div>
                                <div class="module-body">
                                    <!-- Thông báo đã thêm thành công -->
                                    <?php if (isset($_POST['taonv'])) { ?>
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>Đã thêm!</strong> <?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?>
                                        </div>
                                    <?php } ?>
                                    <br />
                                    <!--End thông báo đã thêm thành công -->

                                    <form class="form-horizontal row-fluid" name="taonhanvien" method="post">

                                        <div class="control-group">
                                            <label class="control-label" for="hotennv">Họ tên nhân viên</label>
                                            <div class="controls">
                                                <input type="text" placeholder="Nhập họ tên nhân viên" name="hotennv" class="span8 tip" required>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="ngaysinh">Ngày sinh</label>
                                            <div class="controls">
                                                <input type="date" name="ngaysinh" class="span8 tip" required>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="gioitinh">Giới tính</label>
                                            <div class="controls">
                                                <select name="gioitinh">
                                                    <option value="Khác">Khác</option>
                                                    <option value="Nam">Nam</option>
                                                    <option value="Nữ">Nữ</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="sdt">Số điện thoại</label>
                                            <div class="controls">
                                                <input type="text" placeholder="Nhập số điện thoại" name="sdt" class="span8 tip" required>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="email">Email</label>
                                            <div class="controls">
                                                <input type="email" placeholder="Nhập email" name="email" class="span8 tip" required>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="tendangnhap">Tên đăng nhập</label>
                                            <div class="controls">
                                                <input type="text" placeholder="Nhập tên đăng nhập" name="tendangnhap" class="span8 tip" required>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="controls">
                                                <button type="submit" name="taonv" class="btn">Tạo</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <!-- End form tạo nhân viên-->
                            <div class="module">

                                <div class="module-head">
                                    <h3>Quản lý nhân viên</h3>
                                </div>
                                <div class="module-body table">
                                <?php } ?>
                                <br />
                                <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Mã NV</th>
                                            <th>Họ tên</th>
                                            <th>Email</th>
                                            <th>SDT</th>
                                            <th>Quyền hạn</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $query = mysqli_query($conn, "SELECT * FROM nhanvien");
                                        $cnt = 1;
                                        while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                            <tr>
                                                <td><?php echo htmlentities($cnt); ?></td>
                                                <td><?php echo htmlentities($row['manv']); ?></td>
                                                <td><?php echo htmlentities($row['hotennv']); ?></td>
                                                <td><?php echo htmlentities($row['email']); ?></td>
                                                <td> <?php echo htmlentities($row['sdt']); ?></td>
                                                <td><?php echo htmlentities($row['quyen']); ?></td>
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