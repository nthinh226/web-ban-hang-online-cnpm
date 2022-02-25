<?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME', 'cuahangmaytinh');
$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME,3307);

// tránh bị lỗi font khi update
mysqli_set_charset($conn, 'UTF8');

// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>