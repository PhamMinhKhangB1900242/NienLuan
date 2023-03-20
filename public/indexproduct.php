<?php
require_once ('data/dbhelper.php');
?>

<!DOCTYPE html>
<html  lang="vi">
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
           <a href= "addproduct.php">  <button class="btn btn-success" style="margin-bottom: 15px;">Thêm San Pham</button></a>
            <table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="50px">STT</th>
                            <th>Hinh Anh</th>
							<th>Tên San Pham</th>
                            <th>Gia Ban</th>
                            <th>Danh Muc</th>
                            <th>Ngay Cap Nhat</th>
							<th width="50px"></th>
							<th width="50px"></th>
						</tr>
					</thead>
                <tbody> 
				<?php 
                $sql          = 'select product.id, product.title, product.price, product.thumbnail,product.updated_at, 
                category.name category_name 
                from product left join category on product.id_category = category.id';
                $productList = excuteResult($sql);
                $index = 1;
            foreach ($productList as $item) {
	echo '<tr>
				<td>'.($index++).'</td>
				<td><img src="'.$item['thumbnail'].'"
                style="max-width: 100px"/></td>
                <td>'.$item['title'].'</td>
                <td>'.$item['price'].'</td>
                <td>'.$item['category_name'].'</td>
                <td>'.$item['updated_at'].'</td>
				<td>
                <a href="addproduct.php?id='.$item['id'].'"> <button class="btn btn-warning">Sửa</button></a>
				
				</td>
				<td>
					<button class="btn btn-danger" onclick="deleteProduct('.$item['id'].')">Xoá</button>
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
			if(!option) {
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
</body>
</html>