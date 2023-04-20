<?php
require_once('data/dbhelper.php');
require_once('page.php');
?>

<!DOCTYPE html>
<html lang="vi">

<head>
	<meta charset="UTF-8">
	<title>Quản Lý Đơn Hàng</title>

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
				<h2 class="text-center">Quản Lý Đơn Hàng</h2>
			</div>
			<div class="panel-body">

            <!-- Toàn văn
id	
name	
phone	
address	
total	
created_at	
updated_at				 -->

				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="50px">STT</th>
							<th>Name</th>
							<th>Phone</th>
							<th width="300px">Address</th>
							<th>total</th>
							<th>Ngay Cap Nhat</th>
							<th width="50px"></th>
							<th width="110px"></th>
                            <th width="50px"></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$limit = 5;
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
						$sql = 'select count(id) as total from orders ';
						$countResult = excuteSingleResult($sql);
						$count = $countResult['total'];
						$number = ceil($count / $limit);
						$firstIndex = ($page - 1) * $limit;


						$sql  = 'select * from orders where 1 ' . $additional . ' limit ' . $firstIndex . ', ' . $limit;
						$ordersList = excuteResult($sql);

						foreach ($ordersList as $item) {
							echo '<tr>
				<td>' . (++$firstIndex) . '</td>
				<td>' . $item['name'] . '</td>
                <td>' . $item['phone'] . '</td>
                <td>' . $item['address'] . '</td>
                <td>' . $item['total'] . '</td>
                <td>' . $item['updated_at'] . '</td>
                <td>
                <button class="btn btn-success btn-duyet">Duyệt</button>
                </td>
                <td>
                
                <a  href="orders_detail.php?id=' . $item['id'] . '" class="btn btn-warning"> Chi Tiết</a>
                
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
			var option = confirm('Bạn có chắc chắn muốn xoá đơn hàng này không?')
			if (!option) {
				return;
			}
			console.log(id)
			$.post('ajaxorders.php', {
				'id': id,
				'action': 'delete'
			}, function(data) {
				location.reload()
			})
		}
		duyetBtnList = document.getElementsByClassName("btn-duyet");
        console.log(duyetBtnList);
        for (let btn of duyetBtnList) {
            btn.addEventListener("click", ()=>{
                btn.innerText = "Đã Xác Nhận"
            }) 
        }
	</script>
	<?php 
	echo '
	<script>
        
    </script>
	'
	?>
	<?= paginarion($number, $page, '&s=' . $s) ?>
</body>

</html>