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
				<h2 class="text-center">Quản Lý Sản Phẩm</h2>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-6">
						<a href="addproduct.php"> <button class="btn btn-success" style="margin-bottom: 15px;">Thêm San Pham</button></a>

					</div>
					<div class="col-lg-6">
						<form method="POST">
						
							<div class="form-group">
								<input type="text" class="form-control" id="s" name="s" style="margin-top:px;width:200px; float:right;"><button class="btn btn-success" style="margin-left: 287px;margin-bottom: 30px;">Tìm</button>
								
							</div>
					</div>
				</div>

				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="50px">STT</th>
							<th>Hinh Ảnh</th>
							<th>Tên Sản Phẩm</th>
							<th>Giá Bán</th>
							<th>Danh Mục</th>
							<th>Ngày Cập Nhật</th>
							<th width="50px"></th>
							<th width="50px"></th>
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
						

						$sql  = 'select product.id, product.title, product.price, product.thumbnail,product.updated_at, 
                category.name category_name 
                from product left join category on product.id_category = category.id where 1' . $additional . ' limit ' . $firstIndex . ', ' . $limit;
						$productList = excuteResult($sql);

						foreach ($productList as $item) {
							echo '<tr>
				<td>' . (++$firstIndex) . '</td>
				<td><img src="' . $item['thumbnail'] . '"
                style="max-width: 100px"/></td>
                <td>' . $item['title'] . '</td>
                <td>' . $item['price'] . '</td>
                <td>' . $item['category_name'] . '</td>
                <td>' . $item['updated_at'] . '</td>
				<td>
			<a  href="addproduct.php?id=' . $item['id'] . '" class="btn btn-warning"> Sửa</a>
			</td>
			<td>
			<button class="btn btn-danger" onclick="deleteProduct(' . $item['id'] . ')">Xóa</button>
			</td>
			</tr>';
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function deleteProduct(id) {
			var option = confirm('Bạn có chắc chắn muốn xoá san pham này không?')
			if (!option) {
				return;
			}
			console.log(id)
			$.post('ajaxproduct.php', {
				'id': id,
				'action': 'delete'
			}, function(data) {
				location.reload()
			})
		}
	</script>
	<?= paginarion($number, $page, '&s=' . $s) ?>
</body>

</html>