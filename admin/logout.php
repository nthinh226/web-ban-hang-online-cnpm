<?php
session_start();
$_SESSION['atendangnhap']=="";
session_unset();
//session_destroy();
$_SESSION['errmsg']="Đăng xuất thành công";
?>
<script language="javascript">
document.location="index.php";
</script>
