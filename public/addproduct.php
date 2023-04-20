<?php
require_once('data/dbhelper.php');

$id = $title = $thumbnail = $price = $content = $id_category = '';
if (!empty($_POST)) {
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	}
	if (isset($_POST['title'])) {
		$title = $_POST['title'];
		$title = str_replace('"','\\"', $title);
	}
	if (isset($_POST['thumbnail'])) {
		$thumbnail = $_POST['thumbnail'];
		$thumbnail = str_replace('"','\\"', $thumbnail);
	}
	if (isset($_POST['price'])) {
		$price = $_POST['price'];
		$price = str_replace('"','\\"', $price);
	}
	if (isset($_POST['content'])) {
		$content = $_POST['content'];
		$content = str_replace('"','\\"', $content);
	}
	if (isset($_POST['id_category'])) {
		$id_category = $_POST['id_category'];
	}

	if (!empty($title)) {
		$created_at = $updated_at = date('Y-m-d H:s:i');
		//Luu vao database
		if ($id == '') {
			$sql = 'insert into product(title,thumbnail,price,content,id_category, created_at, updated_at) values ("' . $title . '","' . $thumbnail . '", "' . $price . '", "' . $content . '","' . $id_category . '","' . $created_at . '", "' . $updated_at . '")';
		} else {
			$sql = 'update product set title = "' . $title . '",thumbnail = "' . $thumbnail . '",price = "' . $price . '",content = "' . $content . '",id_category = "' . $id_category . '", updated_at = "' . $updated_at . '" where id = ' . $id;
		}

		execute($sql);

		header('Location: indexproduct.php');
		die();
	}
}

if (isset($_GET['id'])) {
	$id       = $_GET['id'];
	$sql      = 'select * from product where id = ' . $id;
	$product = executeSingleResult($sql);
	if ($product != null) {
		$title = $product['title'];
		$thumbnail = $product['thumbnail'];
		$price = $product['price'];
		$content = $product['content'];
		$id_category = $product['id_category'];
	}
}
?>


<!DOCTYPE html>
<html>

<head>
	<title>Thêm/Sửa San Pham</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
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
				<h2 class="text-center">Thêm/Sửa San Pham</h2>
			</div>
			<div class="panel-body">
				<form method="post">
					<div class="form-group">
						<label for="title">Tên Danh Mục:</label>
						<input type="text" name="id" value="<?= $id ?>" hidden="true">
						<input required="true" type="text" class="form-control" id="title" name="title" value="<?= $title ?>">
					</div>
					<div class="form-group">
						<label for="price">Chon Danh Muc</label>
						<select class="form-control" id="id_category" name="id_category" value="<?= $id_category ?>">
							<option>--Lua Chon Danh Muc--</option>
							<?php
							$sql = 'select * from category';
							$categoryList = excuteResult($sql);
							foreach ($categoryList as $item) {
								if ($item['id'] == $id_category) {
									echo '<option selected value="' . $item['id'] . '">' . $item['name'] . '</option>';
								} else {
									echo '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
								}
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="price">Gia Ban</label>
						<input required="true" type="number" class="form-control" id="price" name="price" value="<?= $price ?>">
					</div>
					<label for="thumbnail">thumbnail</label>
					<input required="true" type="text" class="form-control" id="thumbnail" name="thumbnail" value="<?= $thumbnail ?>" onchange="updatethumnnail()">
					<img src="<?= $thumbnail ?>" style="width: 100 px" id="img_thumbnail">
			</div>
			<label for="content">content</label>
			<textarea rows="5" class="form-control" id="content" name="content"> <?= $content ?></textarea>
		</div>
		<button class="btn btn-success">Lưu</button>
		</form>
	</div>
	</div>
	</div>
	<script>
		function updatethumnnail() {
			$('#img_thumbnail').attr('src', $('#thumbnail').val())
		}
		$(function() {
			$('#content').summernote({
				height: 250,
				codemirror: {
					theme: 'monokai'
				}
			});
		})
	</script>
</body>

</html>