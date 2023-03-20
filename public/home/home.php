<?php
require_once('../data/dbhelper.php');
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


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<ul class="nav nav-tabs">
<li class="nav-item">
    <a class="nav-link" href="home.php">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php">Danh Mục</a>
  </li>	
 
  <li class="nav-item">
    <a class="nav-link" href="../login.php">Đăng nhập</a>
  </li>
</ul>
<body>
<div class="panel-heading">
				<h2 class="text-center"> Sản Phẩm</h2>
			</div>
	<div class="container">
		<div class="panel panel-primary">

			<div class="panel-body">

				<?php

				$sql = 'select product.id, product.title, product.price, product.thumbnail,product.updated_at, 
category.name category_name 
from product left join category on product.id_category = category.id';
				$Listproduct = excuteResult($sql);
				$query = "SELECT * FROM sanpham";
		

				foreach ($Listproduct as $item) {
					echo ' 
						
						<div class="col-lg-3">
							<form method="post" id=' . $item['id'] . '> 
							<a href="detail.php?id='.$item['id'].'"> <img src="'.$item['thumbnail'].'" style= "width: 100%"></a>
								<a href="detail.php?id='.$item['id'].'"> <p>'.$item['title'].'</p></a>
                				<p style= "color: red; font-weight: bold;">' . $item['price'] . '</p>
							</form>
                		 </div>';
						
				}

				?>

		
			</div>

</body>

</html>