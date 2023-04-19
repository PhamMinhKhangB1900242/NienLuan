<?php
require_once('data/dbhelper.php');
require_once('page.php');
?>

<!DOCTYPE html>
<html lang="vi">

<head>
	<meta charset="UTF-8">
	<title>Quản Lý San Pham</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<ul class="nav nav-tabs">
	<li class="nav-item">
		<a class="nav-link" href="index.php">Quản Lý Danh Mục</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="indexproduct.php">Quản Lý Sản Phẩm</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="indexorders.php">Quản Lý Đơn Hàng</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="logout.php">Đăng Xuất</a>
	</li>
</ul>
<body>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Quản Lý San Pham</h2>
			</div>
			<div class="panel-body">
				

				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="50px">STT</th>
							<th>Hinh Anh</th>
							<th>Tên San Pham</th>
							<th>Gia Ban</th>
						
							
						</tr>
					</thead>
					<tbody>
						<?php
						$limit = 10;
						$page = 1;
						if (isset($_GET['page'])) {
							$page = $_GET['page'];
						}
						if ($page <= 0) {
							$page = 1;
						}
						//search
						$s = '';
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
                        // SELECT orders.name, orders.address, orders.phone, orders_detail.*, product.title as product_name 
						// FROM orders
						// INNER JOIN orders_detail ON orders.id = orders_detail.id_orders
						// INNER JOIN product ON product.id = orders_detail.id_product
						// WHERE orders.id = 16
                        $sql  = 'select orders.name, orders.address, orders.phone, orders_detail.*, 
                        product.title as product_name, product.price as product_price, product.thumbnail as product_thumbnail
                        from orders 
                        inner join orders_detail on orders.id = orders_detail.id_orders 
                        inner join product on product.id = orders_detail.id_product
                        where 1' . $additional . ' limit ' . $firstIndex . ', ' . $limit;
                        
						$orders_detailList = excuteResult($sql);

						foreach ($orders_detailList as $item) {
							echo '<tr>
				<td>' . (++$firstIndex) . '</td>
				<td><img src="' . $item['product_thumbnail'] . '"
                style="max-width: 100px"/></td>
                <td>' . $item['product_name'] . '</td>
                <td>' . $item['product_price'] . '</td>
               
				
			
			</tr>';
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	<?= paginarion($number, $page, '&s=' . $s) ?>
</body>

</html>