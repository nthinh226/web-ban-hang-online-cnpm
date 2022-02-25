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
  if (isset($_POST['capnhat'])) {
    $trangthai = intval($_POST['trangthaidh']);
    $ghichu = $_POST['ghichu'];
    $capnhat = "UPDATE dondathang SET trangthaidh=".$trangthai.", manv='$manv', ngaythuctegiao='$currentTime', ghichu='$ghichu' where sodh='$sodh'";

    if (mysqli_query($conn, $capnhat)) {
      if (mysqli_affected_rows($conn) > 0) { //có thay đổi dữ liệu
      } else {
          echo "lỗi" . $conn->error; //Không thành công
      }
  } else {
      $_SESSION['msg'] = "Thêm nhân viên thất bại !!";
      echo "lỗi" . $conn->error;  //Không thành công
  }

    echo "<script>alert('Cập nhật đơn hàng thành công');</script>";
    //}
  }

?>
  <script language="javascript" type="text/javascript">
    function f2() {
      window.close();
    }
    ser

    function f3() {
      window.print();
    }
  </script>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Cập nhật đơn hàng</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link href="anuj.css" rel="stylesheet" type="text/css">
  </head>

  <body>

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
          $ret = mysqli_query($conn, "SELECT * FROM dondathang WHERE sodh='$sodh'");
          while ($row = mysqli_fetch_array($ret)) {
          ?>
            <tr height="20">
              <td class="fontkink1"><b>Ngày đặt hàng:</b></td>
              <td class="fontkink"><?php echo $row['ngaydh']; ?></td>
            </tr>
            <tr height="20">
              <td class="fontkink1"><b>Trạng thái:</b></td>
              <td class="fontkink">

              <?php                 
              $trangthai = $row['trangthaidh'];
                if($trangthai == 0){
                  echo "Đang xử lý";
                }else if($trangthai == 1){
                  echo "Đang vận chuyển";
                }else if($trangthai == 2){
                  echo "Đã hoàn thành";
                }else if($trangthai == 3){
                  echo "Đã huỷ";
                }
                ?>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <hr />
              </td>
            </tr>
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
                  <textarea cols="50" rows="7" name="ghichu"><?php
                    $ghichu = $row['ghichu'];
                    if($ghichu != null){
                      echo $ghichu;
                    }?>
                  </textarea>
                </span></td>
            </tr>
            <?php } ?>
            <tr>
              <td class="fontkink1">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="fontkink"> </td>
              <td class="fontkink"> <input type="submit" name="capnhat" value="Cập nhật" size="40" style="cursor: pointer;" /> &nbsp;&nbsp;
                <input name="Submit2" type="submit" class="txtbox4" value="Thoát" onClick="return f2();" style="cursor: pointer;" />
              </td>
            </tr>
      
        </table>
      </form>
    </div>

  </body>

  </html>
<?php } ?>