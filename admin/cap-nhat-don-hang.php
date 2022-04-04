<?php
session_start();

include_once 'include/config.php';
if (strlen($_SESSION['atendangnhap']) == 0) {
  header('location:index.php');
} else {
  $sodh = $_GET['sodh'];
  $manv = $_SESSION['manv'];
  date_default_timezone_set('Asia/Ho_Chi_Minh'); // change according timezone
  $currentTime = date('d-m-Y h:i:s A', time());

?>
  <script language="javascript" type="text/javascript">
    function f2() {
      window.close();
    }

    function f3() {
      window.print();
    }
  </script>
  <!DOCTYPE html>
  <html>

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Cập nhật đơn hàng</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/js/jsuser.js"></script>
    <script src="plugins/sweetalert2/sweetalert2.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">	

  </head>

  <body>
    <?php
    include('include/header.php');
    if (isset($_POST['capnhat'])) {
      $trangthai = intval($_POST['trangthaidh']);
      $ghichu = $_POST['ghichu'];
      $query = mysqli_query($conn, "insert into theodoidonhang(sodh,trangthaidh,ghichu) values('$sodh','$trangthai','$ghichu')");
      $capnhat = "UPDATE dondathang SET trangthaidh=" . $trangthai . ", manv='$manv', ngaythuctegiao='$currentTime', ghichu='$ghichu' where sodh='$sodh'";

      if (mysqli_query($conn, $capnhat)) {
        if (mysqli_affected_rows($conn) > 0) { //có thay đổi dữ liệu

        } else {
          echo "lỗi" . $conn->error; //Không thành công
        }
      } else {
        echo "lỗi" . $conn->error;  //Không thành công
      }
      echo "<script>alert_success('Cập nhật đơn hàng thành công');</script>";

      //}
    } ?>

    <!-- a -->
    <div class="wrapper">
      <div class="container">
        <div class="row">
          <div class="span12">
            <div class="content">
              <div class="module">
                <div class="module-head">
                  <h3>Trạng thái đơn hàng</h3>
                </div>
                <div class="module-body">
                  <div style="margin-left:50px;">
                    <form name="updateticket" id="updateticket" method="post">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">

                        <tr height="50">
                          <td colspan="2" class="fontkink2" style="padding-left:0px;">
                            <div class="fontpink2"> <b>Cập nhập đơn hàng !</b></div>
                          </td>

                        </tr>
                        <tr height="30">
                          <td class="fontkink1"><b>Mã đơn hàng:</b></td>
                          <td class="fontkink"><?php echo $sodh; ?></td>
                        </tr>
                        <?php
                        $ret = mysqli_query($conn, "SELECT * FROM theodoidonhang WHERE sodh='$sodh'");
                        while ($row = mysqli_fetch_array($ret)) {
                        ?>
                          <tr height="20">
                            <td class="fontkink1"><b>Vào lúc:</b></td>
                            <td class="fontkink"><?php echo $row['ngaygiao']; ?></td>
                          </tr>
                          <tr height="20">
                            <td class="fontkink1"><b>Trạng thái:</b></td>
                            <td class="fontkink">

                              <?php
                              $trangthai = $row['trangthaidh'];
                              if ($trangthai == 0) {
                                echo "Đang xử lý";
                              } else if ($trangthai == 1) {
                                echo "Đang vận chuyển";
                              } else if ($trangthai == 2) {
                                echo "Đã hoàn thành";
                              } else if ($trangthai == 3) {
                                echo "Đã huỷ";
                              }
                              ?>
                            </td>
                          </tr>
                          </tr>
                          <tr height="20">
                            <td class="fontkink1"><b>Ghi chú:</b></td>
                            <td class="fontkink"><?php echo $row['ghichu']; ?></td>
                          </tr>
                          <tr>
                            <td colspan="2">
                              <hr />
                            </td>
                          </tr>
                        <?php } ?>
                        <?php
                        $st = 2;
                        $sthuy = 3;
                        $rt = mysqli_query($conn, "SELECT * FROM dondathang WHERE sodh='$sodh'");
                        while ($num = mysqli_fetch_array($rt)) {
                          $currrentSt = $num['trangthaidh'];
                        }
                        if ($st == $currrentSt) { ?>
                          <tr>
                            <td colspan="2"><b>
                                Sản phẩm đã giao tới khách </b></td>
                          <?php } elseif ($sthuy == $currrentSt) { ?>
                          <tr>
                            <td colspan="2"><b>
                                Đơn hàng đã huỷ </b></td>
                          <?php } else { ?>
                          <tr height="50">
                            <td class="fontkink1">Trạng thái: </td>
                            <td class="fontkink"><span class="fontkink1">
                                <select name="trangthaidh" class="fontkink" required="required">
                                  <option value="">Chọn trạng thái</option>
                                  <option value="0">Đang xử lý</option>
                                  <option value="1">Đang vận chuyển</option>
                                  <option value="2">Hoàn thành</option>
                                  <option value="3">Huỷ đơn</option>
                                </select>
                              </span></td>
                          </tr>

                          <tr style=''>
                            <td class="fontkink1">Ghi chú:</td>
                            <td class="fontkink" align="justify"><span class="fontkink">
                                <textarea class="form-control" cols="50" rows="7" name="ghichu"><?php
                                                                                                $ghichu = $row['ghichu'];
                                                                                                if ($ghichu != null) {
                                                                                                  echo $ghichu;
                                                                                                } ?></textarea>
                              </span></td>
                          </tr>

                          <tr>
                            <td class="fontkink1">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="fontkink"> </td>
                            <td class="fontkink"> <input type="submit" class="btn btn-primary" name="capnhat" value="Cập nhật" size="40" style="cursor: pointer;" /> &nbsp;&nbsp;
                              <input name="Submit2" type="submit" class="btn btn-secondary" value="Thoát" onClick="return f2();" style="cursor: pointer;" />
                            </td>
                          </tr>
                        <?php } ?>
                      </table>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!--/.content-->
          </div>
          <!--/.span9-->
        </div>
      </div>
      <!--/.container-->
      </d>
      <!--/.wrapper-->

      <?php include('include/footer.php'); ?>
      <!-- a -->
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

  </html>
<?php } ?>