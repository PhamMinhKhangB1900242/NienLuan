<?php
require_once ('../data/dbhelper.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Danh Mục</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
<ul class="nav nav-tabs">
<li class="nav-item">
    <a class="nav-link" href="home.php">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php">Danh Mục</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="../home/cart.php">Giỏ Hàng</a>
  </li>		
 
  <li class="nav-item">
    <a class="nav-link" href="../login.php">Đăng nhập</a>
  </li>
</ul>
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
				<td>'.($index++).'</td>
				<td><a href= "category.php?id='.$item['id'].'">'.$item['name'].'</a></td>
				
			</tr>';
}
                ?>
                </tbody>
                </table>
			</div>
		</div>
	</div>
 
</body>
</html>