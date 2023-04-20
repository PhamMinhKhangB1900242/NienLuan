<?php
require_once('../data/dbhelper.php');
require_once('../page.php');
$id = '';
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = 'select * from product where id = ' . $id;
	$product = excuteSingleResult($sql);
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Home Page</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<link rel="stylesheet" href="../css/home.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
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
			<form class="form-inline mt-2 mt-md-0" method="POST">
                    <div class="form-group">
                        <input type="text" style="margin-left: 200px;" class="form-control mr-lg-5" id="s" name="s" placeholder="Tìm Kiếm!!" style="width:200px;"><button class="btn btn-success" style="margin-left: -30px;">Tìm</button>
                    </div>
			</form>
		</ul>

	</div>
</nav>

<body>
	<div class="panel-heading">
		<h2 class="text-center"> Sản Phẩm</h2>
	</div>
	<div class="container">
		<div class="panel panel-primary">

			<div class="panel-body">
				<div class="row">

					<?php
					$limit = 9;
					$page = 1;
					if (isset($_GET['page'])) {
						$page = $_GET['page'];
					}
					if ($page <= 0) {
						$page = 1;
					}
					$s = '';
					$firstIndex = ($page - 1) * $limit;
					if (isset($_POST['s'])) {
						$s = $_POST['s'];
						$s = str_replace('"', '\"', $s);
					}
					$additional = '';
					if (!empty($s)) {
						$additional = ' and title like "%' . $s . '%"';
					}
					$sql = 'select count(id) as total from product ';
					$countResult = excuteSingleResult($sql);
		
					
						$count = $countResult['total'];
						$number = ceil($count / $limit);
					
					
					$firstIndex = ($page - 1) * $limit;


					$sql = 'select product.id, product.title, product.price, product.thumbnail,product.updated_at, 
				category.name category_name 
				from product left join category on product.id_category = category.id where 1 '. $additional . ' limit ' . $firstIndex . ', ' . $limit;
				
				$Listproduct = excuteResult($sql);
					// $query = "SELECT * FROM sanpham";


					foreach ($Listproduct as $item) {
						echo ' 
											
						<div class="col-lg-4" style="margin-top: 30px;margin-bottom: 30px;">
							<form method="post" id=' . $item['id'] . ' action="cart.php?action=addcart&id=' . $item['id'] . '">
							<div > 
								<a href="detail.php?id=' . $item['id'] . '"> <img src="' . $item['thumbnail'] . '" style="width:200px;height:210px,></a>
								
								<a href="detail.php?id=' . $item['id'] . ' " > <p>' . $item['title'] . '</p></a>
                				<p style= "color: red; font-weight: bold;">' . number_format($item['price'], 0, ",", ".") . 'Đ</p>
								<input type="submit" name="addcart"  class="u-full-width button-primary button" value="Thêm vào giỏ hàng"></input>
								
								</div>
								</form>
                		 </div>
						 
						 ';
					}

					?>

				</div>
			</div>
		</div>
		<!-- <a href="thanhtoan.php?id=' . $item['id'] . '" class="u-full-width button-primary button input add-to-sell">Mua ngay</a> -->
</body>
<?= paginarion($number, $page, '&s=' . $s) ?>
<footer id="footer" class="footer">
	<p> Hân Hạnh Phục Vụ Bạn</p>
	<a class="top" href="index.html"></a>
	<p>Liên hệ chúng tui qua
		<a href="https://www.facebook.com/pham.minhkhang.121"><i class="fa fa-facebook-f"></i></a>
		<a href="twitter.com"><i class="fa fa-twitter"></i></a> hoặc địa chỉ email <a href=""><i class="fas fa-mail-bulk"></i> khangro99@gmail.com</a>
	</p>
</footer>

</html>