<?php
require_once('../data/dbhelper.php');
$id = '';
if (isset($_GET['id'])) {
  $id       = $_GET['id'];
  $sql      = 'select * from category where id = ' . $id;
  $category = executeSingleResult($sql);
  if ($category != null) {
    $name = $category['name'];
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Category Page</title>

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

  <div class="container">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h2 class="text-center"><?= $name ?></h2>
      </div>
      <div class="panel-body">
        <div class="row">
          <?php
          $sql          = 'select product.id, product.title, product.price, product.thumbnail,product.updated_at, 
            category.name category_name 
            from product left join category on product.id_category = category.id where category.id = ' . $id;
          $productList = excuteResult($sql);

          foreach ($productList as $item) {
            echo ' <div class="col-lg-4">
               <a href="detail.php?id=' . $item['id'] . '"> <img src="' . $item['thumbnail'] . '" style= "width: 100%"></a>
               <a href="detail.php?id=' . $item['id'] . '"> <p>' . $item['title'] . '</p></a>
                <p style= "color: red; font-weight: bold;">' . $item['price'] . '</p>
                
                </div>';
          }
          ?>


        </div>

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