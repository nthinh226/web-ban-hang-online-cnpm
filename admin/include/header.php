<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
				<i class="icon-reorder shaded"></i>
			</a>

			<a class="brand" href="thong-tin-tai-khoan.php">NT226 Computer | Managerment</a>

			<div class="nav-collapse collapse navbar-inverse-collapse">
				<ul class="nav pull-right">
				<?php
							$username = trim($_SESSION['atendangnhap']);
							$query = mysqli_query($conn, "SELECT * FROM nhanvien WHERE tendangnhap='$username'");
							$cnt = 1;
							while ($row = mysqli_fetch_array($query)) {
							?>
					<li><a href="thong-tin-tai-khoan.php">Xin chào, <?php echo htmlentities($row['hotennv']); ?></a></li>
					<li class="nav-user dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">

								<img src="avatar/<?php echo htmlentities($row['manv']); ?>/<?php echo htmlentities($row['avatar']); ?>" class="nav-avatar" />
							<?php } ?>
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="thong-tin-tai-khoan.php">Thông tin tài khoản</a></li>
							<li><a href="doi-mat-khau.php">Thay đổi mật khẩu</a></li>
							<li class="divider"></li>
							<li><a href="logout.php">Đăng xuất</a></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.nav-collapse -->
		</div>
	</div><!-- /navbar-inner -->
</div><!-- /navbar -->