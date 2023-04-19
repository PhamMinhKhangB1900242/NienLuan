<?php

require_once('../data/dbhelper.php');
?>

<!DOCTYPE html>
<html>

<head>
	<title>Danh Mục</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<link rel="stylesheet" href="../css/home.css">



	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
		<div class="container-fluid">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link active" href="home.php">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="index.php">Danh Mục</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="../home/cart.php">Giỏ Hàng</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="thanhtoan_cart.php">Thanh Toán</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="../login.php">Đăng nhập</a>
				</li>
			</ul>
			
		</div>
	</nav>


	</section>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center"> Danh Mục Sản Phẩm</h2>
			</div>
			<div class="panel-body">

				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="50px">STT</th>
							<th>Tên Danh Mục</th>

						</tr>
					</thead>
					<tbody>
						<?php
						$sql          = 'select * from category';
						$categoryList = excuteResult($sql);
						$index = 1;
						foreach ($categoryList as $item) {
							echo '<tr>
				<td>' . ($index++) . '</td>
				<td><a href= "category.php?id=' . $item['id'] . '">' . $item['name'] . '</a></td>
				
			</tr>';
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</body>
<footer id="footer" class="footer">
	<p> Hân Hạnh Phục Vụ Bạn</p>
	<a class="top" href="index.html"></a>
	<p>Liên hệ chúng tui qua
		<a href="fb.com"><i class="fa fa-facebook-f"></i></a>
		<a href="twitter.com"><i class="fa fa-twitter"></i></a> hoặc địa chỉ email <a href=""><i class="fas fa-mail-bulk"></i></a>
	</p>
</footer>

</html>