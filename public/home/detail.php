<?php
require_once ('../data/dbhelper.php');
session_start();
$id = '';
if(isset($_GET['id'])) {
    $id       = $_GET['id'];
	$sql      = 'select * from product where id = '.$id;
	$product = executeSingleResult($sql);
	
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Chi Tiết</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <meta name='viewport' content='width=device-width, initial-scale=1'>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/home.css">



	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
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
<form  method="post"  action="/php/twig/frontend/giohang/themvaogiohang">
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center"><?=$product['title']?></h2>
        <h2 class="text-center" style= "color: red;"> <?=number_format($product['price'], 0, ",", ".") ?>Đ</h2>
       
			</div>
			<div class="panel-body">
            <div class="row">
        
            <div class="col-lg-5">
            <img src=" <?=$product['thumbnail']?>" style="width: 100%" id="img_thumbnail">
            
            </div>
         <div class="col-lg-7">
         <?=$product['content']?>
          </div>
            
			</div>
		</div>
	</div>
  </div>
  </form>
 
</body>
<footer id="footer" class="footer">
	<p> Hân Hạnh Phục Vụ Bạn</p>
	<a class="top" href="index.html"></a>
	<p>Liên hệ chúng tui qua
		<a href="https://www.facebook.com/pham.minhkhang.121"><i class="fa fa-facebook-f"></i></a>
		<a href="twitter.com"><i class="fa fa-twitter"></i></a> hoặc địa chỉ email <a href=""><i class="fas fa-mail-bulk"></i> khangro99@gmail.com</a>
	</p>
</footer>
</html>