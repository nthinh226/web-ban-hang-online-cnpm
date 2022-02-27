<div class="span3">
	<div class="sidebar">
		<ul class="widget widget-menu unstyled">
			<li>
				<a class="collapsed" data-toggle="collapse" href="#togglePages">
					<i class="menu-icon icon-cog"></i>
					<i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>
					Quản lý đơn hàng
				</a>
				<ul id="togglePages" class="collapse unstyled">
					<li>
						<a href="don-dat-hang-trong-ngay.php">
							<i class="icon-tasks"></i>
							Đơn đặt hàng trong ngày
							<?php
							$f1 = "00:00:00";
							$from = date('Y-m-d') . " " . $f1;
							$t1 = "23:59:59";
							$to = date('Y-m-d') . " " . $t1;
							$result = mysqli_query($conn, "SELECT * FROM dondathang where ngaydh Between '$from' and '$to'");
							$num_rows1 = mysqli_num_rows($result); {
							?>
								<b class="label orange pull-right"><?php echo htmlentities($num_rows1); ?></b>
							<?php } ?>
						</a>
					</li>
					<li>
						<a href="don-dat-hang-cho-xu-ly.php">
							<i class="icon-tasks"></i>
							Đơn chờ xử lý
							<?php
							$status = 0;
							$ret = mysqli_query($conn, "SELECT * FROM dondathang where trangthaidh = '$status' || trangthaidh is null ");
							$num = mysqli_num_rows($ret); { ?><b class="label orange pull-right"><?php echo htmlentities($num); ?></b>
							<?php } ?>
						</a>
					</li>
					<li>
						<a href="don-dat-hang-dang-van-chuyen.php">
							<i class="icon-inbox"></i>
							Đơn đang vận chuyển
							<?php
							$status = 1;
							$rt = mysqli_query($conn, "SELECT * FROM dondathang where trangthaidh='$status'");
							$num1 = mysqli_num_rows($rt); { ?><b class="label green pull-right"><?php echo htmlentities($num1); ?></b>
							<?php } ?>

						</a>
					</li>
					<li>
						<a href="quan-ly-don-hang.php">
							<i class="icon-tasks"></i>
							Quản lý đơn hàng
						</a>
					</li>
				</ul>
			</li>

			<li><a href="quan-ly-nhan-vien.php"><i class="menu-icon icon-tasks"></i>Quản lý nhân viên</a></li>
			<li><a href="quan-ly-nguoi-dung.php"><i class="menu-icon icon-tasks"></i>Quản lý khách hàng</a></li>
		</ul>

		<ul class="widget widget-menu unstyled">
			<li><a href="quan-ly-thuong-hieu.php"><i class="menu-icon icon-table"></i>Thương hiệu</a></li>
			<li><a href="tao-the-loai.php"><i class="menu-icon icon-tasks"></i>Tạo thể loại</a></li>
			<li><a href="them-san-pham.php"><i class="menu-icon icon-paste"></i>Thêm sản phẩm</a></li>
			<li><a href="quan-ly-san-pham.php"><i class="menu-icon icon-table"></i>Quản lý sản phẩm</a></li>

		</ul>
		<!--/.widget-nav-->

		<ul class="widget widget-menu unstyled">
			<li><a href="user-logs.php"><i class="menu-icon icon-tasks"></i>Lịch sử đăng nhập khách hàng </a></li>

			<li><a href="logout.php"><i class="menu-icon icon-signout"></i>Đăng xuất</a></li>
		</ul>

	</div>
	<!--/.sidebar-->
</div>
<!--/.span3-->